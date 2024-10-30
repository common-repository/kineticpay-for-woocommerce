<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * The public-facing functionality of the plugin.
 *
 */
class kineticpay_public
{
    
    public function __construct()
    {
        
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    2.0.0
     */
    public function enqueue_scripts()
    {
        /**`
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Kineticpay_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Kineticpay_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        if ( is_checkout() ) {
            wp_enqueue_style(
                'kineticpay-public',
                RLTKN_PLUGIN_URL . 'assets/public/css/kineticpay-public.css',
                array(),
                '',
                'all'
            );
            $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '' );
            wp_enqueue_script(
                'kineticpay-public',
                RLTKN_PLUGIN_URL . 'assets/public/js/kineticpay-public' . $suffix . '.js',
                array( 'jquery' ),
                '',
                false
            );
        }
    
    }
    
	 // woocommerce checkout page functionality
    /**
     * Function to return email and domain validation
     */
    public function wc_rltknp_validation()
    {
        global $wpdb;
        $getrltknpoption = get_option( 'rltknp_option' );
        $getrltknparray = json_decode( $getrltknpoption, true );
		
		$settings_array = get_option( 'rltknp_settings' );
        $rltknp_enabled = ( !empty($settings_array['rltknp_enable_block']) ? $settings_array['rltknp_enable_block'] : '0' );
		
		$rltknp_ww_enable_block = ( !empty($settings_array['rltknp_ww_enable_block']) ? $settings_array['rltknp_ww_enable_block'] : '0' );
		
		$billing_firstname = filter_input( INPUT_POST, 'billing_first_name', FILTER_SANITIZE_STRING );
		$billing_lastname = filter_input( INPUT_POST, 'billing_last_name', FILTER_SANITIZE_STRING );
		$billing_phone = filter_input( INPUT_POST, 'billing_phone', FILTER_SANITIZE_STRING );
			
		$shipping_firstname = filter_input( INPUT_POST, 'shipping_first_name', FILTER_SANITIZE_STRING );
		$shipping_lastname = filter_input( INPUT_POST, 'shipping_last_name', FILTER_SANITIZE_STRING );
		$shipping_phone = filter_input( INPUT_POST, 'shipping_phone', FILTER_SANITIZE_STRING );
		$kadpengenalan = filter_input( INPUT_POST, 'kadpengenalan', FILTER_SANITIZE_STRING );
		$errorBFN = '';
		$errorBLN = '';
		
		$errorSFN = '';
		$errorSLN = '';
		$errorKPN = '';
		if ( isset( $rltknp_enabled ) && !empty($rltknp_enabled) && '1' === $rltknp_enabled ) {
			
			$errorBFN = $this->verify_name('firstname', $billing_firstname);
			if ( $errorBFN ) {
                wc_add_notice( $errorBFN, 'error' );
            }
			
			$errorSFN = $this->verify_name('firstname', $shipping_firstname);
			if ( $errorSFN ) {
                wc_add_notice( $errorSFN, 'error' );
            }
			
			$errorBLN = $this->verify_name('lastname', $billing_lastname);
			if ( $errorBLN ) {
                wc_add_notice( $errorBLN, 'error' );
            }
			
			$errorSLN = $this->verify_name('lastname', $shipping_lastname);
			if ( $errorSLN ) {
                wc_add_notice( $errorSLN, 'error' );
            }
			
			$errorKPN = $this->verify_name('kadpengenalan', $kadpengenalan);
			if ( $errorKPN ) {
                wc_add_notice( $errorKPN, 'error' );
            }
			
		}
		
		if ( isset( $rltknp_ww_enable_block ) && !empty($rltknp_ww_enable_block) && '1' === $rltknp_ww_enable_block ) {
			
			$billing_error = $this->get_worldwide_ban_data($billing_firstname, $billing_lastname, $kadpengenalan, $billing_phone);
			
			if (empty($errorBFN) && isset($billing_error[0]['fn']) && $billing_error[0]['fn'] === true)
			{
				wc_add_notice( __( 'First Name has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
			if (empty($errorBLN) && isset($billing_error[0]['ln']) && $billing_error[0]['ln'] === true)
			{
				wc_add_notice( __( 'Last Name has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
			if (isset($billing_error[0]['ph']) && $billing_error[0]['ph'] === true)
			{
				wc_add_notice( __( 'Phone has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
			if (empty($errorKPN) && isset($billing_error[0]['kap']) && $billing_error[0]['kap'] === true)
			{
				wc_add_notice( __( 'Identification Card has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
			$shipping_error = $this->get_worldwide_ban_data($shipping_firstname, $shipping_lastname, $kadpengenalan, $shipping_phone);
			if (empty($errorSFN) && isset($shipping_error[0]['fn']) && $shipping_error[0]['fn'] === true)
			{
				wc_add_notice( __( 'First Name has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
			if (empty($errorSLN) && isset($shipping_error[0]['ln']) && $shipping_error[0]['ln'] === true)
			{
				wc_add_notice( __( 'Last Name has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
			if (isset($shipping_error[0]['ph']) && $shipping_error[0]['ph'] === true)
			{
				wc_add_notice( __( 'Phone has been blocked by worldwide ban.', 'kineticpaywc' ), 'error' );
			}
		}
	}
	
    /**
     * @param $country
     * @param $state
     *
     * @return string
     * function to retirn verify key and values
     */
    private function verify_name ( $key, $value )
    {
		if ($key === 'firstname') {
			$get_key = 'rltknp_block_firstname';
			$error_key = 'rltkn_fn_msg';
		} else if ($key === 'lastname') {
			$get_key = 'rltknp_block_lastname';
			$error_key = 'rltkn_ln_msg';
		} else if ($key === 'kadpengenalan') {
			$get_key = 'rltknp_block_kadpengenalan';
			$error_key = 'rltkn_kp_msg';
		}
        $getpluginoption = get_option( 'rltknp_option' );
        $getpluginoptionarray = json_decode( $getpluginoption, true );
        $status = '';
        //get blacklisted names from database
        $fetchSelecetedName = ( !empty($getpluginoptionarray[$get_key]) ? array_filter( $getpluginoptionarray[$get_key] ) : '' );
        if ( isset( $fetchSelecetedName ) && !empty($fetchSelecetedName) ) {
            if ( is_array( $fetchSelecetedName ) ) {
                foreach ( $fetchSelecetedName as $singleName ) {
                    $singleName = strtolower( $singleName );
                    $valueName = strtolower( $value );
                    
                    if ( $valueName === $singleName ) {
						$status = convert_smilies( ( empty($getpluginoptionarray[$error_key]) ? __( 'Your details has been blacklisted.', 'kineticpaywc' ) : $getpluginoptionarray[$error_key] ) );
                        break;
                    }
                
                }
            }
        } else {
            $status = '';
        }
                        
        return $status;
    }
	
	function get_worldwide_ban_data($fn,$ln,$kap,$ph) {
		$apiUrl = "https://blacklist.kineticpay.my/wp-json/rltkinetic/v1/globalbanlist/";
		$obj = array("data" => array("fn" => $fn, "ln" => $ln, "kap" => $kap, "ph" => $ph));
		$data = json_encode($obj);
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $apiUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => [
					'Accept: application/json',
					'Content-Type: application/json'
			],
		]);
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			return [];
		} else {
			$result = json_decode($response, true);
			return $result;
		}
		return [];
	}
}