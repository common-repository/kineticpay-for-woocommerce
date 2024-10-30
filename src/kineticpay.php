<?php
/**

 * kineticPay Payment Gateway Classs

 */

class kineticpay extends WC_Payment_Gateway {

    /**
     * The unique identifier of this plugin.
     *
     * @since    2.0.7
     * @access   protected
     * @var      string $kp_enabled The string used to uniquely identify the kp_enabled.
     */
    protected  $kp_enabled;
    /**
     * The unique identifier of this plugin.
     *
     * @since    2.0.7
     * @access   protected
     * @var      string $merchant_key The string used to uniquely identify the merchant_key.
     */
    protected  $merchant_key;

    function __construct(){

        add_action( 'woocommerce_api_callback', 'check_kineticpay_callback' );

        $this->id = "kineticPay";
        $this->method_title = __("kineticPay", 'kineticpaywc');
        $this->method_description = __("Enable your customers to make payments securely via kineticPay.", 'kineticpaywc');
        $this->title = __("kineticPay", 'kineticpaywc');
        $this->icon = RLTKN_PLUGIN_URL . 'assets/public/images/kineticpay-logo.png';
        $this->has_fields = true;
        $this->init_form_fields();
        $this->init_settings();

        foreach ($this->settings as $setting_key => $value) {
            $this->$setting_key = $value;
        }

        if (is_admin()) {
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(
                $this,
                'process_admin_options'
            ));
        }
    }

    public function init_form_fields()

    {

        $this->form_fields = array(
            'kp_enabled'        => array(
                'title'   => __('Enable / Disable', 'kineticpaywc'),
                'label'   => __('Enable this payment gateway', 'kineticpaywc'),
                'type'    => 'checkbox',
                'default' => 'no',
            ),

            'title'          => array(
                'title'    => __('Title', 'kineticpaywc'),
                'type'     => 'text',
                'default'  => __('kineticPay', 'kineticpaywc'),
            ),

            'description'    => array(
                'title'    => __('Description', 'kineticpaywc'),
                'type'     => 'textarea',
                'default'  => __('Pay securely with kineticPay.', 'kineticpaywc'),
                'css'      => 'max-width:350px;',
            ),

            'merchant_key'      => array(
                'title'    => __('Merchant Key', 'kineticpaywc'),
                'type'     => 'text',
                'desc_tip' => __('Required', 'kineticpaywc'),
                'description' => __('Obtain your merchant key from your kineticPay dashboard.', 'kineticpaywc'),
            ),
            // Future if category implemented
            /*'category_key' => array(
                'title'    => __('Category Code', 'kineticpaywc'),
                'type'     => 'text',
                'desc_tip' => __('Required', 'kineticpaywc'),
                'description' => __('Create a category at your kineticPay dashboard and fill in your category code here.', 'kineticpaywc'),
            ),*/
        );
    }

    public function process_payment($order_id)

    {
        do_action( 'woocommerce_loaded' );
        $customer_order = wc_get_order($order_id);
        $callbackURL = add_query_arg(array('wc-api' => 'kineticpay', 'order' => $order_id, 'process' => 'processing'), home_url('/'));
        $name = $customer_order->get_billing_first_name() . ' ' . $customer_order->get_billing_last_name();
        $email = $customer_order->get_billing_email();
        $phone = $customer_order->get_billing_phone();
        $bankid = $customer_order->get_meta('_kineticpay_bank');

        if($name == NULL || $phone == NULL || $email == NULL){
            wc_add_notice( __( 'Error! Please complete your details (Name, phone, and e-mail are compulsory).', 'kineticpaywc' ), 'error' );
            return;
        }

        return array(
            'result'    => 'success',
            'redirect'  => $callbackURL
        );
    }

    public function check_kineticpay_callback()

    {
        do_action( 'woocommerce_loaded' );
        if (isset($_REQUEST['order'])){
            $order_id = absint( $_REQUEST['order'] );
            $customer_order = wc_get_order($order_id);

            if ($customer_order && $order_id != 0 && isset($_REQUEST['process'])){
                $bankid     = $customer_order->get_meta('_kineticpay_bank');
                if ($_REQUEST['process'] == 'processing'){
                    $amount = $customer_order->get_total();
                    $redirectURL = add_query_arg(array('wc-api' => 'kineticpay'), home_url('/'));
                    $verifyURL = add_query_arg(array('wc-api' => 'kineticpay', 'verify'=>$order_id), home_url('/'));
                    $secretkey = $this->merchant_key;
                    // $categorycode = $this->category_key;
                    $name = $customer_order->get_billing_first_name() . ' ' . $customer_order->get_billing_last_name();
                    $email = $customer_order->get_billing_email();
                    $phone = $customer_order->get_billing_phone();
                    $description = "Payment for Order No " .  $order_id . ", Buyer Name " . $name . ", Email " . $phone . ", Phone No. " . $phone;
                    $urlparts = parse_url(home_url());
                    $domain = substr($urlparts['host'], 0, 5);
                    $invoice_id = strtoupper($domain) . (string)$order_id . 'KNWC';
                    $data = [
                        'callback_success'  => $verifyURL,
                        'callback_status'  => $verifyURL,
                        'callback_error'    => $verifyURL,
                        'amount'            => $amount,
                        'description'       => $description,
                        'invoice'           => $invoice_id,
                        'merchant_key'      => $secretkey,
                        'bank'              => $bankid,
                    ];

                    // API Endpoint URL
                    $url = "https://manage.kineticpay.my/payment/create";
                    $ch = curl_init( $url );
                    // Setup request to send POST request.
                    $payload = json_encode( $data );
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $response = json_decode($result, true);
                    if (isset($response["error"])) {
                        if (is_array($response["error"])) {
                            foreach($response["error"] as $error_note) {
                                wc_add_notice($error_note[0], 'error');
                            }
                        } else {
                            wc_add_notice($response["error"], 'error');
                            wp_redirect(wc_get_checkout_url());
                        }
                    }
                    if (isset($response["html"])) {
                        $customer_order->add_order_note('Customer made a payment attempt using bank ID '. $bankid .' via kineticPay.');
                        print_r($response['html']);
                    } else {
                        $eror = isset($response[0]) ? $response[0] : "Payment was declined. Something error with payment gateway, please contact store manager.";
                        wc_add_notice($eror, 'error');
                        wp_redirect(wc_get_checkout_url());
                    }
                    exit();
                }
            }
        } else if (isset($_REQUEST['verify'])) {
            global $fpxData;
            $fpxData = json_decode(stripslashes($_POST['encoded_transaction_data']));
            $order_id = $_REQUEST['verify'];
            $urlparts = parse_url(home_url());
            $domain = substr($urlparts['host'], 0, 5);
            $invoice_id = str_replace(strtoupper($domain),'',$order_id);
            $invoice_id = str_replace('KNWC','',$invoice_id);
            $customer_order = wc_get_order($invoice_id);
            if ($customer_order) {
               if(isset($fpxData->record->transaction_status_code)) {
                    if($fpxData->record->transaction_status_code === "00") {
                        $customer_order->add_order_note('Payment via kineticPay was succeed.<br>Transaction ID: ' . $response['id']);
                        $customer_order->payment_complete();
                        wp_safe_redirect(add_query_arg( array(
                            'kp_notification' => 1,
                            'kp_msg' => __('Payment Successful. Your payment has been successfully completed.', 'kineticpaywc'),
                            'kp_type' => 'success'),
                            $customer_order->get_checkout_order_received_url()));
                    } else if($fpxData->record->transaction_status_code !== "00") {
                        $customer_order->add_order_note('Payment via kineticPay was failed.<br>Error code: ' . $response['code'] . '<br>Transaction ID: ' . $response['id']);
                        wp_safe_redirect(add_query_arg( array(
                            'kp_notification' => 2,
                            'kp_msg' => __('Sorry, your payment failed. No charges were made.', 'kineticpaywc'),
                            'kp_type' => 'error'),
                            wc_get_checkout_url()));
                    }
                } else {
                    $customer_order->add_order_note('Payment via kineticPay was failed without code.');
                    wp_safe_redirect(add_query_arg( array(
                        'kp_notification' => 3,
                        'kp_msg' => __('Sorry, your payment failed. No charges were made.', 'kineticpaywc'),
                        'kp_type' => 'error'),
                        wc_get_checkout_url()));
                }
            }
            exit();
        }
    }
}
