<?php
/**
 * Plugin Name: kineticPay for WooCommerce
 * Plugin URI: https://kineticpay.my/
 * Description: Receive payment on your WooCommerce site via kineticPay.
 * Version: 2.0.8
 * Author: Kinetic Innovative Technologies Sdn Bhd
 * Author URI: https://www.kitsb.com.my/
 * WC requires at least: 6.6.0
 * WC tested up to: 6.3.2
 **/

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( !defined( 'RLTKN_PLUGIN_URL' ) ) {
    define( 'RLTKN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'RLTKN_PLUGIN_DIR' ) )
    define( 'RLTKN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'WP_CRON_LOCK_TIMEOUT' ) )
    define( 'WP_CRON_LOCK_TIMEOUT', 3 );

//Hpos compatible
add_action( 'before_woocommerce_init', function() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

// Init kineticPay
add_action( 'plugins_loaded', 'kineticpay_init', 0 );
function kineticpay_init() {
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
        return;
    }

    include_once( 'src/kineticpay.php' );
    include_once( 'src/wc.php' );

    add_filter( 'woocommerce_payment_gateways', 'add_kineticpay_to_woocommerce' );
    function add_kineticpay_to_woocommerce( $methods ) {
        $methods[] = 'kineticPay';

        return $methods;
    }
}

// Add setting link to plugin list
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'kineticpay_links' );
function kineticpay_links( $links ) {
    $plugin_links = array(
        '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=kineticpay' ) . '">' . __( 'Gateway Setting', 'kineticpaywc' ) . '</a>',
        '<a href="' . admin_url( 'admin.php?page=kineticpay_settings' ) . '">' . __( 'Features Setting', 'kineticpaywc' ) . '</a>',
    );

    return array_merge( $plugin_links, $links );
}

// Check init response
add_action( 'init', 'kineticpay_check_response', 15 );
function kineticpay_check_response() {
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
        return;
    }

    include_once( 'src/kineticpay.php' );

    $kineticpay = new kineticpay();
    $kineticpay->check_kineticpay_callback();
}
add_action('wp_head', function(){
    if (function_exists('is_checkout') && is_checkout()) {
        ?>
        <style>.payment_method_kineticPay label{display: flex;align-items: center;}.payment_method_kineticPay img{width: 80px!important;margin-left: 20px;}</style>
        <?php
    }
});
// Add bank list to Checkout page
add_filter( 'woocommerce_gateway_description', 'kineticpay_bank_list', 20, 2 );
function kineticpay_bank_list( $description, $payment_id ){
    if( 'kineticPay' === $payment_id ){
        ob_start();
        $bank_name = array(
            '' => __( 'Select Bank', 'kineticpaywc' ),
            'ABMB0212' => __( 'Alliance Bank Malaysia Berhad', 'kineticpaywc' ),
            'ABB0233' => __( 'Affin Bank Berhad', 'kineticpaywc' ),
            //'ABB0234' => __( 'Affin Bank Berhad', 'kineticpaywc' ),
            'AMBB0209' => __( 'AmBank (M) Berhad', 'kineticpaywc' ),
            //'BPMBMYKL' => __( 'AGROBANK', 'kineticpaywc' ),
            'BCBB0235' => __( 'CIMB Bank Berhad', 'kineticpaywc' ),
            'BIMB0340' => __( 'Bank Islam Malaysia Berhad', 'kineticpaywc' ),
            'BKRM0602' => __( 'Bank Kerjasama Rakyat Malaysia Berhad', 'kineticpaywc' ),
            'BMMB0341' => __( 'Bank Muamalat (Malaysia) Berhad', 'kineticpaywc' ),
            'BSN0601' => __( 'Bank Simpanan Nasional Berhad', 'kineticpaywc' ),
            'CIT0219' => __( 'Citibank Berhad', 'kineticpaywc' ),
            'HLB0224' => __( 'Hong Leong Bank Berhad', 'kineticpaywc' ),
            //'HBMBMYKL' => __( 'HSBC Bank Malaysia Berhad', 'kineticpaywc' ),
            'HSBC0223' => __( 'HSBC Bank Malaysia Berhad', 'kineticpaywc' ),
            'KFH0346' => __( 'Kuwait Finance House', 'kineticpaywc' ),
            'MB2U0227' => __( 'Maybank2u / Malayan Banking Berhad', 'kineticpaywc' ),
            //'MBBEMYKL' => __( 'Maybank2u / Malayan Banking Berhad', 'kineticpaywc' ),
            //'MBB0227' => __( 'Maybank2E / Malayan Banking Berhad E', 'kineticpaywc' ),
            'MBB0228' => __( 'Maybank2E / Malayan Banking Berhad E', 'kineticpaywc' ),
            'OCBC0229' => __( 'OCBC Bank (Malaysia) Berhad', 'kineticpaywc' ),
            'PBB0233' => __( 'Public Bank Berhad', 'kineticpaywc' ),
            //'RJHIMYKL' => __( 'AL RAJHI BANKING & INVESTMENT CORPORATION (MALAYSIA) BERHAD', 'kineticpaywc' ),
            //'RHBBMYKL' => __( 'RHB Bank Berhad', 'kineticpaywc' ),
            'RHB0218' => __( 'RHB Bank Berhad', 'kineticpaywc' ),
            'SCB0216' => __( 'Standard Chartered Bank (Malaysia) Berhad', 'kineticpaywc' ),
            'UOB0226' => __( 'United Overseas Bank (Malaysia) Berhad', 'kineticpaywc' ),
            //'UOB0229' => __( 'United Overseas Bank (Malaysia) Berhad', 'kineticpaywc' ),
        );

        echo '<div class="kineticpay-bank" style="padding:10px 0;">';
        woocommerce_form_field( 'kineticpay_bank', array(
            'type'          => 'select',
            'label'         => __( 'Choose Payment Method", "kineticpay' ),
            'class'         => array('form-row-wide'),
            'required'      => true,
            'options'       => $bank_name,
            'default'       => '',
        ), '');
        echo '<div>';
        $description .= ob_get_clean();
    }
    return $description;
}

// Check if bank is selected
add_action('woocommerce_checkout_process', 'kineticpay_check_bank' );
function kineticpay_check_bank() {
    if ( isset($_POST['payment_method']) && $_POST['payment_method'] === 'kineticPay'
        && isset($_POST['kineticpay_bank']) && empty($_POST['kineticpay_bank']) ) {
        wc_add_notice( __( 'Please select bank name for payment, please.', 'kineticpaywc' ), 'error' );
    }
}

// Add bank code to order
add_action('woocommerce_checkout_create_order', 'kineticpay_write_to_meta_data', 10, 2 );
function kineticpay_write_to_meta_data( $order, $data ) {
    if ( isset($_POST['kineticpay_bank']) && ! empty($_POST['kineticpay_bank']) ) {
        $order->update_meta_data( '_kineticpay_bank' , sanitize_text_field($_POST['kineticpay_bank']) );
    }
}

// Help to pass error on Checkout or Thank You page
add_action('woocommerce_before_checkout_form','kineticpay_err_param');
add_action('woocommerce_thankyou','kineticpay_err_param');
function kineticpay_err_param() {
    if (isset($_REQUEST['kp_notification'])) {
        wc_print_notice(esc_html( $_REQUEST['kp_msg'] ), esc_attr( $_REQUEST['kp_type'] ));
    }
}

// Add requery option to edit Order
add_action( 'woocommerce_order_actions', 'kineticpay_order_requery' );
function kineticpay_order_requery( $actions ) {
    global $theorder;

    if ( $theorder->is_paid() ) {
        return $actions;
    }

    $actions['kineticpay_do_query'] = __( 'Requery payment status from kineticPay', 'kineticpaywc' );
    return $actions;
}

// Process requery from kineticPay server
add_action( 'woocommerce_order_action_kineticpay_do_query', 'kineticpay_requery_process' );
function kineticpay_requery_process( $customer_order ) {
    $order_id = $customer_order->get_id();
    $urlparts = parse_url(home_url());
    $domain = substr($urlparts['host'], 0, 5);
    $invoice_id = strtoupper($domain) . (string)$order_id . 'KNWC';
    $url = "https://manage.kineticpay.my/payment/status";
    $ch = curl_init( $url . '?merchant_key=' . get_option('woocommerce_kineticPay_settings')['merchant_key'] . '&invoice=' . $invoice_id );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($result, true);

    if (isset($response["code"]) && $response["code"] == "00"){
        $customer_order->add_order_note( __( 'Payment via kineticPay was succeed.', 'kineticpaywc' ) . '<br>' . __( 'Transaction ID: ', 'kineticpaywc' ) . $response['id']);
        $customer_order->payment_complete();
    } else
        if (isset($response["code"])){
            $customer_order->add_order_note(__( 'Payment via kineticPay was failed.', 'kineticpaywc' ) . '<br>' . __( 'Error code: ', 'kineticpaywc' ) . $response['code'] . '<br>' . __( 'Transaction ID: ', 'kineticpaywc' ) . $response['id']);
        } else {
            $customer_order->add_order_note(__( 'Payment via kineticPay was failed without code.', 'kineticpaywc' ));
        }
}

add_filter( 'cron_schedules', 'kineticPay_orderstatus_cron_interval' );
function kineticPay_orderstatus_cron_interval( $schedules ) {
    $schedules['three_seconds'] = array(
        'interval' => 3,
        'display'  => esc_html__( 'Kineticpay Every Three Seconds' ), );
    return $schedules;
}

add_action( 'kineticpay_orderstatus_cron', 'kineticpay_change_order_status_three_sec' );
function kineticpay_change_order_status_three_sec() {
    $orders = wc_get_orders(
        array(
            'limit'    => 1,
            'type'     => 'shop_order',
            'orderby'  => 'ID',
            'order'    => 'DESC',
        )
    );
    $order_id = $orders[0]->get_id();
    $customer_order = $orders[0];
    $is_checked = get_post_meta_wc($order_id, 'rlt_checked', true);
    $order_is = wc_get_order($order_id);
    if ($is_checked == '1') {
        return;
    } else {
        if( strtotime('+3 seconds') > strtotime( $order_is->get_date_modified() ) ) {
            $url = "https://manage.kineticpay.my/payment/status";
            $ch = curl_init( $url . '?merchant_key=' . get_option('woocommerce_kineticPay_settings')['merchant_key'] . '&invoice=' . (string)$order_id );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result, true);
            if (isset($response["code"]) && $response["code"] == "00"){
                if (!$customer_order->is_paid()) {
                    $customer_order->add_order_note( __( 'Payment via kineticPay was succeed.', 'kineticpaywc' ) . '<br>' . __( 'Transaction ID: ', 'kineticpaywc' ) . $response['id']);
                    $customer_order->payment_complete();
                }
                $customer_order->update_status('completed');
            }
            update_post_meta_wc($order_id, 'rlt_checked', '1');
        }
    }
}

require plugin_dir_path( __FILE__ ) . 'classes/includes/class-kineticpay-main.php';

function run_kineticpay_features()
{
    $plugin = new KineticPay_Features_Woocommerce();
    $plugin->run();
}

add_action( 'plugins_loaded', 'rltknp_plugin_init' );
function rltknp_plugin_init()
{
    $wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );

    if ( current_user_can( 'activate_plugins' ) && false === $wc_active ) {
        return;
    } else {
        run_kineticpay_features();
    }

}

if ( !class_exists( 'rlt_Checkout_Fields' ) ) {

    class rlt_Checkout_Fields {

        public $module_settings = array();
        public $module_default_settings = array();

        function __construct() {
            $this->module_tables();

            if ( is_admin() ) {
                require_once( RLTKN_PLUGIN_DIR . 'classes/admin/class.kineticpay-checkout-fields.php' );
                register_activation_hook( __FILE__, array( $this, 'install_module' ) );
                register_deactivation_hook( __FILE__, array( $this, 'delete_tables' ) );
                $this->module_default_settings = $this->get_module_default_settings();
            } else {
                $settings_array = get_option( 'rltknp_settings' );
                $rltknp_customfields_enabled = ( !empty($settings_array['rltknp_enable_customfields']) ? $settings_array['rltknp_enable_customfields'] : '0' );
                if ( isset( $rltknp_customfields_enabled ) && !empty($rltknp_customfields_enabled) && '1' === $rltknp_customfields_enabled ) {
                    require_once( RLTKN_PLUGIN_DIR . 'classes/public/class.kineticpay-checkout-fields-public.php' );
                }
            }
        }

        public function install_module() {
            $this->module_tables();
            $this->create_module_data();
            wp_schedule_event( time(), 'three_seconds', 'kineticpay_orderstatus_cron' );
        }

        private function module_tables() {
            global $wpdb;

            $wpdb->rltknp_fields = $wpdb->prefix . 'rltknp_fields';
            $wpdb->rltknp_meta = $wpdb->prefix . 'rltknp_meta';
        }

        public function create_module_data() {
            $this->set_module_default_settings();
            global $wpdb;
            $this->create_tables();
            if ( $wpdb->get_var( "SHOW TABLES LIKE '$wpdb->rltknp_fields'" ) == $wpdb->rltknp_fields ) {
                $result = $wpdb->get_results( "SELECT * FROM ". $wpdb->prefix . "rltknp_fields" );
                if($wpdb->num_rows == 0) {
                    $this->set_module_default_data();
                }
            }
        }


        public function create_tables() {
            global $wpdb;
            $charset_collate = '';
            if ( !empty( $wpdb->charset ) )
                $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
            if ( !empty( $wpdb->collate ) )
                $charset_collate .= " COLLATE $wpdb->collate";
            if ( $wpdb->get_var( "SHOW TABLES LIKE '$wpdb->rltknp_meta'" ) != $wpdb->rltknp_meta ) {
                $sql1 = "CREATE TABLE " . $wpdb->rltknp_meta . " (
                              meta_id int(25) NOT NULL auto_increment,
                              field_id varchar(255) NULL,
                              meta_key varchar(255) NULL,
                              meta_value text(255) NULL,
                              meta_price varchar(255) NULL,

                              PRIMARY KEY (meta_id)
                              ) $charset_collate;";


                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql1 );
            }


            if ( $wpdb->get_var( "SHOW TABLES LIKE '$wpdb->rltknp_fields'" ) != $wpdb->rltknp_fields ) {
                $sql = "CREATE TABLE " . $wpdb->rltknp_fields . " (
                        field_id int(25) NOT NULL auto_increment,
                        field_name varchar(255) NULL,
                        field_label varchar(255) NULL,
                        field_placeholder varchar(255) NULL,
                        is_required int(25) NOT NULL,
                        is_hide int(25) NOT NULL,
                        width varchar(255) NULL,
                        sort_order int(25) NOT NULL,
                        field_type varchar(255) NULL,
                        type varchar(255) NULL,
                        options text NULL,
                        value varchar(255) NULL,
                        field_mode varchar(255) NULL,
                        field_extensions varchar(255) NULL,
                        field_price varchar(255) NULL,
                        showif varchar(255) NULL,
                        cfield int(25) NULL,
                        ccondition varchar(255) NULL,
                        ccondition_value varchar(255) NULL,
                        PRIMARY KEY (field_id)
                        ) $charset_collate;";


                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );
            }
        }

        public function delete_tables() {
            /*
            global $wpdb;
            $wpdb->rltknp_fields = $wpdb->prefix . 'rltknp_fields';
            $wpdb->rltknp_meta = $wpdb->prefix . 'rltknp_meta';
            $wpdb->query("DROP TABLE IF EXISTS $wpdb->rltknp_fields");
            $wpdb->query( "DROP TABLE IF EXISTS $wpdb->rltknp_meta" );
            **/
            $timestamp = wp_next_scheduled( 'kineticpay_orderstatus_cron' );
            wp_unschedule_event( $timestamp, 'kineticpay_orderstatus_cron' );

        }


        public function set_module_default_data() {
            global $wpdb;

            // Insert billing first name
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_first_name',
                'First Name',
                'First Name',
                '1',
                '0',
                'half',
                '1',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing last name
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_last_name',
                'Last Name',
                'Last Name',
                '1',
                '0',
                'half',
                '2',
                'text',
                'billing',
                'default'
            ) );

            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_company',
                'Company Name',
                'Company Name',
                '0',
                '0',
                'full',
                '3',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing email
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_email',
                'Email Address',
                'Email Address',
                '1',
                '0',
                'half',
                '4',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing phone number
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_phone',
                'Phone',
                'Phone',
                '1',
                '0',
                'half',
                '5',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing country
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_country',
                'Country',
                'Country',
                '1',
                '0',
                'full',
                '6',
                'select',
                'billing',
                'default'
            ) );

            // Insert billing address1
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_address_1',
                'Address',
                'Address',
                '1',
                '0',
                'full',
                '7',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing address2
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_address_2',
                'Address 2',
                'Address 2',
                '0',
                '0',
                'full',
                '8',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing city
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_city',
                'Town / City',
                'Town / City',
                '1',
                '0',
                'full',
                '9',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing state
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_state',
                'State / County',
                'State / County',
                '1',
                '0',
                'half',
                '10',
                'text',
                'billing',
                'default'
            ) );

            // Insert billing postcode
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'billing_postcode',
                'Postcode / Zip',
                'Postcode / Zip',
                '1',
                '0',
                'half',
                '11',
                'text',
                'billing',
                'default'
            ) );

            // Insert shipping first name
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_first_name',
                'First Name',
                'First Name',
                '1',
                '0',
                'half',
                '1',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping last name
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_last_name',
                'Last Name',
                'Last Name',
                '1',
                '0',
                'half',
                '2',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping company
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_company',
                'Company Name',
                'Company Name',
                '0',
                '0',
                'full',
                '3',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping country
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_country',
                'Country',
                'Country',
                '1',
                '0',
                'full',
                '4',
                'select',
                'shipping',
                'default'
            ) );

            // Insert shipping address1
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_address_1',
                'Address',
                'Address',
                '1',
                '0',
                'full',
                '5',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping address2
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_address_2',
                'Address 2',
                'Address 2',
                '0',
                '0',
                'full',
                '6',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping city
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_city',
                'Town / City',
                'Town / City',
                '1',
                '0',
                'full',
                '7',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping state
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_state',
                'State / County',
                'State / County',
                '1',
                '0',
                'half',
                '8',
                'text',
                'shipping',
                'default'
            ) );

            // Insert shipping postcode
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'shipping_postcode',
                'Postcode / Zip',
                'Postcode / Zip',
                '1',
                '0',
                'half',
                '9',
                'text',
                'shipping',
                'default'
            ) );

            // Insert kadpengenalan
            $wpdb->query($wpdb->prepare( "
                        INSERT INTO $wpdb->rltknp_fields
                        (field_name, field_label, field_placeholder, is_required, is_hide, width, sort_order, field_type, type, field_mode)
                        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                        ",
                'kadpengenalan',
                'Identification Card',
                'Identification Card',
                '0',
                '1',
                'full',
                '1',
                'text',
                'additional',
                'additional_additional'
            ) );
        }

        public function set_module_default_settings() {

            $module_settings = get_option( 'rltknp_settings' );
            if ( !$module_settings ) {
                update_option( 'rltknp_settings', $this->module_default_settings );
            }
        }

        public function get_module_default_settings() {

            $module_default_settings = array (
                'billing_title'                     => __( 'Billing Details', '  ' ),
                'shipping_title'                    => __( 'Ship to a different address?', 'kineticpaywc' ),
                'additional_title'              => __( 'Additional Information', 'kineticpaywc' )
            );

            return $module_default_settings;
        }

        public function get_module_settings() {
            $module_settings = get_option( 'rltknp_settings' );
            //print_r($module_settings);
            if ( !$module_settings ) {
                update_option( 'rltknp_settings', $this->module_default_settings );
                $module_settings = $this->module_default_settings;
            }
            return $module_settings;
        }

    }

    $rltknpfa = new rlt_Checkout_Fields();
}
load_plugin_textdomain( 'kineticpaywc', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );