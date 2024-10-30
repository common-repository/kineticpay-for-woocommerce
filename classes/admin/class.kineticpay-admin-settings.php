<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Kineticpay_Admin
{
	
    public function __construct()
    {
        
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts( $hook )
    {
        global  $typenow ;
        $pagenow = isset($_GET['page']) ? $_GET['page'] : '';
        wp_enqueue_style(
            'kineticpay-admin',
            RLTKN_PLUGIN_URL . 'assets/admin/css/kineticpay-admin.css',
            array(),
            '',
            'all'
        );
        
        if ( 'kineticpay_banuserlist' === $pagenow || 'kineticpay_settings' === $pagenow ) {
            wp_enqueue_style( 'chosen-style', RLTKN_PLUGIN_URL . 'assets/admin/css/chosen.css' );
            wp_enqueue_style( 'main-style', RLTKN_PLUGIN_URL . 'assets/admin/css/style.css' );
            wp_enqueue_style( 'wp-jquery-ui-dialog' );
            wp_enqueue_script(
                'chosen-jquery',
                RLTKN_PLUGIN_URL . 'assets/admin/js/chosen.jquery.js',
                array( 'jquery' ),
                '',
                false
            );
            wp_enqueue_script(
                'kineticpay-admin',
                RLTKN_PLUGIN_URL . 'assets/admin/js/kineticpay-admin.js',
                array( 'jquery' ),
                '',
                false
            );
            wp_enqueue_script(
                'chosen-proto',
                RLTKN_PLUGIN_URL . 'assets/admin/js/chosen.proto.js',
                array( 'jquery' ),
                '',
                false
            );
            wp_enqueue_script(
                'jquery-validate',
                RLTKN_PLUGIN_URL . 'assets/admin/js/jquery.validate.min.js',
                array(),
                false
            );
            wp_enqueue_script(
                'jquery-knob-min-js',
                RLTKN_PLUGIN_URL . 'assets/admin/js/jquery.knob.min.js',
                array(),
                false
            );
            wp_localize_script( 'kineticpay-admin', 'kineticpay_admin', array(
                'ajaxurl'     => admin_url( 'admin-ajax.php' ),
                'ajax_icon'   => RLTKN_PLUGIN_URL . 'assets/admin/images/ajax-loader.gif',
                'nonce'       => wp_create_nonce( 'rltknp-ajax-nonce' ),
            ) );
            wp_enqueue_script( 'jquery-ui-dialog' );
        
        }
        $getpluginoption = get_option( 'rltknp_option' );
        $getkineticpayarray = json_decode( $getpluginoption, true );
        $fetchSelectedfirstname = ( !empty($getkineticpayarray['rltknp_block_firstname']) ? $getkineticpayarray['rltknp_block_firstname'] : '' );
        $optionsfirstname = ( !empty($fetchSelectedfirstname) ? wp_json_encode( $fetchSelectedfirstname ) : wp_json_encode( array() ) );
		$fetchSelectedlastname = ( !empty($getkineticpayarray['rltknp_block_lastname']) ? $getkineticpayarray['rltknp_block_lastname'] : '' );
        $optionslastname = ( !empty($fetchSelectedlastname) ? wp_json_encode( $fetchSelectedlastname ) : wp_json_encode( array() ) );
		$fetchSelectedkadpengenalan = ( !empty($getkineticpayarray['rltknp_block_kadpengenalan']) ? $getkineticpayarray['rltknp_block_kadpengenalan'] : '' );
        $optionskadpengenalan = ( !empty($fetchSelectedkadpengenalan) ? wp_json_encode( $fetchSelectedkadpengenalan ) : wp_json_encode( array() ) );
        $localize_php_variable_array = array(
            'getfirstnameOption'     => array(
            'firstnamearray' => $optionsfirstname,
        ),
			'getlastnameOption'     => array(
            'lastnamearray' => $optionslastname,
        ),
			'getkadpengenalanOption'     => array(
            'kadpengenalanarray' => $optionskadpengenalan,
        ),
        );
        ?>

		<input type="hidden" value='<?php 
        echo  esc_attr( wp_json_encode( $localize_php_variable_array ) ) ;
        ?>' name="localize_json_output">
	
	<?php 
    }
    
    /**
     * function to return update option in plugin
     */
    public function rltknp_add_update_options()
    {
        /**
         * get form action
         */
        $getformsumbitaction = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_STRING );
        $getformsumbitaction = ( !empty($getformsumbitaction) ? $getformsumbitaction : '' );
        $getformactiontype = filter_input( INPUT_POST, 'action-which', FILTER_SANITIZE_STRING );
        $getformactiontype = ( !empty($getformactiontype) ? $getformactiontype : '' );
        /**
         * check form action
         *
         */
        
        if ( !empty($getformsumbitaction) && 'submit_form_rltknp' === $getformsumbitaction && !empty($getformactiontype) && 'add' === $getformactiontype ) {
            
            //get user banned enabled
            $post_array_sanitise_ = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
            $firstname = ( !empty($post_array_sanitise_['firstname']) ? array_filter( $post_array_sanitise_['firstname'] ) : '' );
            $lastname = ( !empty($post_array_sanitise_['lastname']) ? array_filter( $post_array_sanitise_['lastname'] ) : '' );
            $kadpengenalan = ( !empty($post_array_sanitise_['kadpengenalan']) ? array_filter( $post_array_sanitise_['kadpengenalan'] ) : '' );
            
			//get blocking error messages
            
			$rltkn_fn_msg = filter_input( INPUT_POST, 'firstname_msg', FILTER_SANITIZE_STRING );
            $rltkn_ln_msg = filter_input( INPUT_POST, 'lastname_msg', FILTER_SANITIZE_STRING );
            $rltkn_kp_msg = filter_input( INPUT_POST, 'kadpengenalan_msg', FILTER_SANITIZE_STRING );
            
            $rltkn_fn_msg = ( !empty($rltkn_fn_msg) ? $rltkn_fn_msg : esc_html__( 'This first name has been banned, please try other first name or Kindly contact admin.', 'kineticpaywc' ) );
            $rltkn_ln_msg = ( !empty($rltkn_ln_msg) ? $rltkn_ln_msg : esc_html__( 'This last name has been banned, please try other last name or Kindly contact admin.', 'kineticpaywc' ) );
            $rltkn_kp_msg = ( !empty($rltkn_kp_msg) ? $rltkn_kp_msg : esc_html__( 'This identification card has been banned, please try other identification card or Kindly contact admin.', 'kineticpaywc' ) );
            
            $rltknpoption_array = array();
            $rltknpoption_array['rltknp_block_firstname'] = $firstname;
            $rltknpoption_array['rltknp_block_lastname'] = $lastname;
            $rltknpoption_array['rltknp_block_kadpengenalan'] = $kadpengenalan;
            $rltknpoption_array['rltkn_fn_msg'] = $rltkn_fn_msg;
            $rltknpoption_array['rltkn_ln_msg'] = $rltkn_ln_msg;
            $rltknpoption_array['rltkn_kp_msg'] = $rltkn_kp_msg;
            $rltknpoption_array = wp_json_encode( $rltknpoption_array );
            update_option( 'rltknp_option', $rltknpoption_array );
			wp_safe_redirect( add_query_arg( array(
				'page'    => 'kineticpay_banuserlist',
				'success' => 'true',
			), admin_url( 'admin.php' ) ) );
			exit;
        }
		
		if ( !empty($getformsumbitaction) && 'rltknp_submit_knsettings' === $getformsumbitaction && !empty($getformactiontype) && 'add' === $getformactiontype ) {
            
            //get user banned enabled
            $rltknp_enable_block = isset($_POST['rltknp_enable_block']) ? $_POST['rltknp_enable_block'] : '0';
			$rltknp_ww_enable_block = isset($_POST['rltknp_ww_enable_block']) ? $_POST['rltknp_ww_enable_block'] : '0';
			
			$rltknp_customfields_enabled = isset($_POST['rltknp_enable_customfields']) ? $_POST['rltknp_enable_customfields'] : '0';
			
			$settings_array = array("rltknp_enable_block" => $rltknp_enable_block, "rltknp_enable_customfields" => $rltknp_customfields_enabled, "rltknp_ww_enable_block" => $rltknp_ww_enable_block);
			
            update_option( 'rltknp_settings', $settings_array );
			wp_safe_redirect( add_query_arg( array(
				'page'    => 'kineticpay_settings',
				'success' => 'true',
			), admin_url( 'admin.php' ) ) );
			exit;
        }
        
    }
    
    /**
     * function for reset plugins all settings.
     *
     */
    public function rltknp_reset_settings()
    {
        update_option( 'rltknp_option', '' );
		die();
    }
    
    /**
     * function for wooCommerce banlist users create welcom screen page.
     */
    public function banlist_pages()
    {
        global  $GLOBALS ;
        if ( empty($GLOBALS['admin_page_hooks']['kineticpay']) ) {
            add_menu_page(
                'KineticPay',
                __( 'KineticPay', 'kineticpaywc' ),
                'manage_option',
                'kineticpay',
                array( $this, '' ),
                RLTKN_PLUGIN_URL . 'assets/admin/images/kineticpay.png',
                25
            );
        }
        
        add_submenu_page(
                'kineticpay',
                'WC Orders User Ban List By KineticPay',
                'WC Orders User Ban List',
                'manage_options',
                'kineticpay_banuserlist',
                array($this, 'rltknp_admin_setting')
        );
		
        add_submenu_page(
                'kineticpay',
                'WC Custom Checkout Fields By KineticPay',
                'Custom Checkout Fields',
                'manage_options',
                'kineticpay_checkoutfields',
                array($this, 'kineticpay_checkoutfields_settings')
        );
		
        add_submenu_page(
                'kineticpay',
                'KineticPay Features Setting',
                'KineticPay Features Setting',
                'manage_options',
                'kineticpay_settings',
                array($this, 'kineticpay_settings')
        );
    }

    function kineticpay_settings()
    {
        global $kineticpay_pl;
		?>

		<div id="rltknpmain">
			<div class="main-head">
				<header class="rltknp-header">
				<?php 
		global  $pagenow ;
		$rltknp_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
		
		$banuserlist_class = ( isset( $rltknp_page ) && 'kineticpay_banuserlist' === $rltknp_page ? 'active' : '' );
		$checkoutfields_class = ( isset( $rltknp_page ) && 'kineticpay_checkoutfields' === $rltknp_page ? 'active' : '' );
		
		$knsettings_class = ( isset( $rltknp_page ) && 'kineticpay_settings' === $rltknp_page ? 'active' : '' );
		
		?>
					<div class="rltknp-menu-main">
						<nav>
							<ul>
								<?php 
		?>
								<li>
									<a class="rltknp_pl <?php 
		esc_attr_e( $banuserlist_class, 'kineticpaywc' );
		?>" href="<?php 
		echo  esc_url( home_url( '/wp-admin/admin.php?page=kineticpay_banuserlist' ) ) ;
		?>"><?php 
		esc_html_e( 'User Ban List Settings', 'kineticpaywc' );
		?></a>
								</li>
								<li>
									<a class="rltknp_pl <?php 
		esc_attr_e( $checkoutfields_class, 'kineticpaywc' );
		?>" href="<?php 
		echo  esc_url( site_url( 'wp-admin/admin.php?page=kineticpay_checkoutfields' ) ) ;
		?>"><?php 
		esc_html_e( 'Checkout Custom Fields', 'kineticpaywc' );
		?></a>
						</li>
								<li>
									<a class="rltknp_pl <?php 
		esc_attr_e( $knsettings_class, 'kineticpaywc' );
		?>" href="<?php 
		echo  esc_url( site_url( 'wp-admin/admin.php?page=kineticpay_settings' ) ) ;
		?>"><?php 
		esc_html_e( 'Settings', 'kineticpaywc' );
		?></a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		<?php
            $success_note = filter_input( INPUT_GET, 'success', FILTER_SANITIZE_STRING );
            ?>

			<div class="rltknp-col-container rltknp-main-table">
				<?php 
            
            if ( !empty($success_note) ) {
                ?>
					<div id="message" class="updated notice is-dismissible"><p><?php 
                esc_html_e( 'Data has been updated.', 'kineticpaywc' );
                ?></p></div>
				<?php 
            }
            
            ?>
				<form id="rltknp_plugin_form_id" method="post"
				      action="<?php 
            esc_url( get_admin_url() );
            ?>admin-post.php"
				      enctype="multipart/form-data" novalidate="novalidate">
					<input type='hidden' name='action' value='rltknp_submit_knsettings'/>
					<input type='hidden' name='action-which' value='add'/>
					<?php 
            $getpluginoption = get_option( 'rltknp_settings' );
            $allow_html_args = array(
                'input'      => array(
                'type'     => array(
                'checkbox' => true,
                'text'     => true,
                'submit'   => true,
                'button'   => true,
                'file'     => true,
            ),
                'class'    => true,
                'name'     => true,
                'value'    => true,
                'id'       => true,
                'style'    => true,
                'selected' => true,
                'checked'  => true,
                'disabled' => array(),
            ),
                'select'     => array(
                'id'               => true,
                'data-placeholder' => true,
                'name'             => true,
                'multiple'         => true,
                'class'            => true,
                'style'            => true,
                'disabled'         => true,
            ),
                'a'          => array(
                'href'   => array(),
                'title'  => array(),
                'target' => array(),
            ),
                'b'          => array(
                'class' => true,
            ),
                'i'          => array(
                'class' => true,
            ),
                'p'          => array(
                'class' => true,
            ),
                'blockquote' => array(
                'class' => true,
            ),
                'h2'         => array(
                'class' => true,
            ),
                'h3'         => array(
                'class' => true,
            ),
                'ul'         => array(
                'class' => true,
            ),
                'ol'         => array(
                'class' => true,
            ),
                'li'         => array(
                'class' => true,
            ),
                'option'     => array(
                'value' => true,
            ),
                'table'      => array(
                'class' => true,
            ),
                'td'         => array(
                'class' => true,
            ),
                'th'         => array(
                'class' => true,
                'scope' => true,
            ),
                'tr'         => array(
                'class' => true,
            ),
                'tbody'      => array(
                'class' => true,
            ),
                'label'      => array(
                'for' => true,
            ),
                'div'        => array(
                'id'    => true,
                'class' => true,
                'title' => true,
                'style' => true,
            ),
                'textarea'   => array(
                'id'    => true,
                'class' => true,
                'name'  => true,
                'style' => true,
            ),
                'button'     => array(
                'type'  => true,
                'id'    => true,
                'class' => true,
                'name'  => true,
                'value' => true,
            ),
            );
            echo  wp_kses( $this->kineticpay_setting_html( $getpluginoption ), $allow_html_args ) ;
            ?>
				</form>

			</div>
			<?php 
    }
	function kineticpay_setting_html( $getkineticpayarray )
	{
		ob_start();
		$rltknp_block_enabled = ( !empty($getkineticpayarray['rltknp_enable_block']) ? $getkineticpayarray['rltknp_enable_block'] : '0' );
		$rltknp_ww_enable_block = ( !empty($getkineticpayarray['rltknp_ww_enable_block']) ? $getkineticpayarray['rltknp_ww_enable_block'] : '0' );
		$rltknp_customfields_enabled = ( !empty($getkineticpayarray['rltknp_enable_customfields']) ? $getkineticpayarray['rltknp_enable_customfields'] : '0' );
				
		?>

		<div class='heading_div'>
			<div class='heading_section'>
				<h2><?php esc_html_e( 'Enable/Disable Features', 'kineticpaywc' ); ?></h2>
			</div>
			<button type="submit" name="rltknp_submit" class="button button-primary rltknp_submit" value="<?php echo  esc_attr( 'Save Changes' ) ;?>"><?php esc_html_e( 'Save Changes', 'kineticpaywc' );?>
			</button>
		</div>
		<table class="table-outer">
			<tbody>
			<tr>
				<th scope="row" class="titledesc"><label
						for=""><?php esc_html_e( 'Woocommerce Orders User Ban List', 'kineticpaywc' ); ?></label>
				</th>
				<td>
					<?php 
		
		if ( empty($rltknp_block_enabled) && '' === $rltknp_block_enabled ) {
			?>
						<input checked type="checkbox" id="rltknp_enable_block"
							   name="rltknp_enable_block" value="">
						<label for="rltknp_enable_block"><?php 
			esc_html_e( 'Enable Ban List', 'kineticpaywc' );
			?></label>
						<?php 
		} else {
			?>
						<input <?php 
			if ( !empty($rltknp_block_enabled) && '1' === $rltknp_block_enabled ) {
				?> checked <?php 
			}
			?> type="checkbox" id="rltknp_enable_block" name="rltknp_enable_block" value="<?php 
			
			if ( !empty($rltknp_block_enabled) && '1' === $rltknp_block_enabled ) {
				echo  "1" ;
			} else {
				echo  "0" ;
			}
			
			?>">
						<label for="rltknp_enable_block"><?php 
			esc_html_e( 'Enable Ban List', 'kineticpaywc' );
			?></label>
					<?php 
		}
		
		?>
					<p><?php 
		echo  sprintf( wp_kses_post( '%1$sNote: Check to enable the ban list or uncheck to disable.%2$s' ), '<strong>', '</strong>' ) ;
		?></p>
					
				</td>
			</tr>
			<tr>
				<th scope="row" class="titledesc"><label
						for=""><?php esc_html_e( 'Woocommerce Custom Checkout Fields', 'kineticpaywc' ); ?></label>
				</th>
				<td>
					<?php 
		
		if ( empty($rltknp_customfields_enabled) && '' === $rltknp_customfields_enabled ) {
			?>
						<input checked type="checkbox" id="rltknp_enable_customfields"
							   name="rltknp_enable_customfields" value="">
						<label for="rltknp_enable_customfields"><?php 
			esc_html_e( 'Enable Ban List', 'kineticpaywc' );
			?></label>
						<?php 
		} else {
			?>
						<input <?php 
			if ( !empty($rltknp_customfields_enabled) && '1' === $rltknp_customfields_enabled ) {
				?> checked <?php 
			}
			?> type="checkbox" id="rltknp_enable_customfields" name="rltknp_enable_customfields" value="<?php 
			
			if ( !empty($rltknp_customfields_enabled) && '1' === $rltknp_customfields_enabled ) {
				echo  "1" ;
			} else {
				echo  "0" ;
			}
			
			?>">
						<label for="rltknp_enable_customfields"><?php 
			esc_html_e( 'Enable Custom Fields', 'kineticpaywc' );
			?></label>
					<?php 
		}
		
		?>
					<p><?php 
		echo  sprintf( wp_kses_post( '%1$sNote: Check to enable the custom fields.%2$s' ), '<strong>', '</strong>' ) ;
		?></p>
					
				</td>
			</tr>
			<tr>
				<th scope="row" class="titledesc"><label
						for=""><?php esc_html_e( 'Woocommerce Orders Worldwide Ban List', 'kineticpaywc' ); ?></label>
				</th>
				<td>
					<?php 
		
		if ( empty($rltknp_ww_enable_block) && '' === $rltknp_ww_enable_block ) {
			?>
						<input checked type="checkbox" id="rltknp_ww_enable_block"
							   name="rltknp_ww_enable_block" value="">
						<label for="rltknp_ww_enable_block"><?php 
			esc_html_e( 'Enable Worldwide Ban List', 'kineticpaywc' );
			?></label>
						<?php 
		} else {
			?>
						<input <?php 
			if ( !empty($rltknp_ww_enable_block) && '1' === $rltknp_ww_enable_block ) {
				?> checked <?php 
			}
			?> type="checkbox" id="rltknp_ww_enable_block" name="rltknp_ww_enable_block" value="<?php 
			
			if ( !empty($rltknp_ww_enable_block) && '1' === $rltknp_ww_enable_block ) {
				echo  "1" ;
			} else {
				echo  "0" ;
			}
			
			?>">
						<label for="rltknp_ww_enable_block"><?php 
			esc_html_e( 'Enable Worldwide Ban', 'kineticpaywc' );
			?></label>
					<?php 
		}
		
		?>
					<p><?php 
		echo  sprintf( wp_kses_post( '%1$sNote: Check to enable the worldwide ban.%2$s' ), '<strong>', '</strong>' ) ;
		?></p>
					
				</td>
			</tr>
			</tbody>
		</table>


		<p>
			<button type="submit" name="rltknp_submit_knsettings" class="button button-primary" value="<?php 
		echo  esc_attr( 'Save Changes' ) ;
		?>"><?php 
		esc_html_e( 'Save Changes', 'kineticpaywc' );
		?></button>
		</p>

		

		<?php 
		return ob_get_clean();
	}

	
	/**
        * function for admin side settings option
    */
    function rltknp_admin_setting()
    {
        global $kineticpay_pl;
		?>

		<div id="rltknpmain">
			<div class="main-head">
				<header class="rltknp-header">
				<?php 
		global  $pagenow ;
		$rltknp_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
		
		$banuserlist_class = ( isset( $rltknp_page ) && 'kineticpay_banuserlist' === $rltknp_page ? 'active' : '' );
		$checkoutfields_class = ( isset( $rltknp_page ) && 'kineticpay_checkoutfields' === $rltknp_page ? 'active' : '' );
		
		$knsettings_class = ( isset( $rltknp_page ) && 'kineticpay_settings' === $rltknp_page ? 'active' : '' );
		
		?>
					<div class="rltknp-menu-main">
						<nav>
							<ul>
								<?php 
		?>
								<li>
									<a class="rltknp_pl <?php 
		esc_attr_e( $banuserlist_class, 'kineticpaywc' );
		?>" href="<?php 
		echo  esc_url( home_url( '/wp-admin/admin.php?page=kineticpay_banuserlist' ) ) ;
		?>"><?php 
		esc_html_e( 'User Ban List Settings', 'kineticpaywc' );
		?></a>
								</li>
								<li>
									<a class="rltknp_pl <?php 
		esc_attr_e( $checkoutfields_class, 'kineticpaywc' );
		?>" href="<?php 
		echo  esc_url( site_url( 'wp-admin/admin.php?page=kineticpay_checkoutfields' ) ) ;
		?>"><?php 
		esc_html_e( 'Checkout Custom Fields', 'kineticpaywc' );
		?></a>
						</li>
								<li>
									<a class="rltknp_pl <?php 
		esc_attr_e( $knsettings_class, 'kineticpaywc' );
		?>" href="<?php 
		echo  esc_url( site_url( 'wp-admin/admin.php?page=kineticpay_settings' ) ) ;
		?>"><?php 
		esc_html_e( 'Settings', 'kineticpaywc' );
		?></a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		<?php
            $success_note = filter_input( INPUT_GET, 'success', FILTER_SANITIZE_STRING );
            ?>

			<div class="rltknp-col-container rltknp-main-table">
				<?php 
            
            if ( !empty($success_note) ) {
                ?>
					<div id="message" class="updated notice is-dismissible"><p><?php 
                esc_html_e( 'Data has been updated.', 'kineticpaywc' );
                ?></p></div>
				<?php 
            }
            
            ?>
				<form id="rltknp_plugin_form_id" method="post"
				      action="<?php 
            esc_url( get_admin_url() );
            ?>admin-post.php"
				      enctype="multipart/form-data" novalidate="novalidate">
					<input type='hidden' name='action' value='submit_form_rltknp'/>
					<input type='hidden' name='action-which' value='add'/>
					<?php 
            $getpluginoption = get_option( 'rltknp_option' );
            $getkineticpayarray = json_decode( $getpluginoption, true );
            $allow_html_args = array(
                'input'      => array(
                'type'     => array(
                'checkbox' => true,
                'text'     => true,
                'submit'   => true,
                'button'   => true,
                'file'     => true,
            ),
                'class'    => true,
                'name'     => true,
                'value'    => true,
                'id'       => true,
                'style'    => true,
                'selected' => true,
                'checked'  => true,
                'disabled' => array(),
            ),
                'select'     => array(
                'id'               => true,
                'data-placeholder' => true,
                'name'             => true,
                'multiple'         => true,
                'class'            => true,
                'style'            => true,
                'disabled'         => true,
            ),
                'a'          => array(
                'href'   => array(),
                'title'  => array(),
                'target' => array(),
            ),
                'b'          => array(
                'class' => true,
            ),
                'i'          => array(
                'class' => true,
            ),
                'p'          => array(
                'class' => true,
            ),
                'blockquote' => array(
                'class' => true,
            ),
                'h2'         => array(
                'class' => true,
            ),
                'h3'         => array(
                'class' => true,
            ),
                'ul'         => array(
                'class' => true,
            ),
                'ol'         => array(
                'class' => true,
            ),
                'li'         => array(
                'class' => true,
            ),
                'option'     => array(
                'value' => true,
            ),
                'table'      => array(
                'class' => true,
            ),
                'td'         => array(
                'class' => true,
            ),
                'th'         => array(
                'class' => true,
                'scope' => true,
            ),
                'tr'         => array(
                'class' => true,
            ),
                'tbody'      => array(
                'class' => true,
            ),
                'label'      => array(
                'for' => true,
            ),
                'div'        => array(
                'id'    => true,
                'class' => true,
                'title' => true,
                'style' => true,
            ),
                'textarea'   => array(
                'id'    => true,
                'class' => true,
                'name'  => true,
                'style' => true,
            ),
                'button'     => array(
                'type'  => true,
                'id'    => true,
                'class' => true,
                'name'  => true,
                'value' => true,
            ),
            );
            echo  wp_kses( $this->rltknp_get_setting_html( $getkineticpayarray ), $allow_html_args ) ;
            ?>
				</form>

			</div>
			<?php 
    }
	function rltknp_get_setting_html( $getkineticpayarray )
	{
		ob_start();
		$rltknp_enabled = ( !empty($getkineticpayarray['rltknp_enable_block']) ? $getkineticpayarray['rltknp_enable_block'] : '0' );
		$rltknp_ww_enable_block = ( !empty($getkineticpayarray['rltknp_ww_enable_block']) ? $getkineticpayarray['rltknp_ww_enable_block'] : '0' );
		$firstnames = ( !empty($getkineticpayarray['rltknp_block_firstname']) ? $getkineticpayarray['rltknp_block_firstname'] : '' );
		$lastnames = ( !empty($getkineticpayarray['rltknp_block_lastname']) ? $getkineticpayarray['rltknp_block_lastname'] : '' );
		$kadpengenalans = ( !empty($getkineticpayarray['rltknp_block_kadpengenalan']) ? $getkineticpayarray['rltknp_block_kadpengenalan'] : '' );
		$rltkn_fn_msg = ( !empty($getkineticpayarray['rltkn_fn_msg']) ? $getkineticpayarray['rltkn_fn_msg'] : esc_html__( 'This first name has been banned, please try other first name or Kindly contact admin.', 'kineticpaywc' ) );
		$rltkn_ln_msg = ( !empty($getkineticpayarray['rltkn_ln_msg']) ? $getkineticpayarray['rltkn_ln_msg'] : esc_html__( 'This last name has been banned, please try other last name or Kindly contact admin.', 'kineticpaywc' ) );
		$rltkn_kp_msg = ( !empty($getkineticpayarray['rltkn_kp_msg']) ? $getkineticpayarray['rltkn_kp_msg'] : esc_html__( 'This identification card has been banned, please try other identification card or Kindly contact admin.', 'kineticpaywc' ) );
		$rltkn_chk_selection = ( !empty($getkineticpayarray['rltkn_chk_selection']) ? $getkineticpayarray['rltkn_chk_selection'] : '' );		
		?>

		<div class='heading_div'>
			<div class='heading_section'>
				<h2><?php esc_html_e( 'Woocommerce Orders User Ban List Settings', 'kineticpaywc' ); ?></h2>
			</div>
			<button type="submit" name="rltknp_submit" class="button button-primary rltknp_submit" value="<?php echo  esc_attr( 'Save Changes' ) ;?>"><?php esc_html_e( 'Save Changes', 'kineticpaywc' );?>
			</button>
		</div>
		<table class="table-outer">
			<tbody>
			<tr>
				<th scope="row" class="titledesc"><label
						for="firstname"><?php 
		esc_html_e( 'First Name', 'kineticpaywc' );
		?></label>
				</th>
				<td>
					<select id="firstname" data-placeholder="<?php 
		esc_attr_e( 'Add first name separated by comma', 'kineticpaywc' );
		?>" name="firstname[]" multiple="true" class="chosen-select-firstname category-select chosen-rtl">
						<option value=""></option>
						<?php 
		if ( !empty($firstnames) ) {
			if ( is_array( $firstnames ) ) {
				foreach ( $firstnames as $firstname ) {
					?>
									<option value="<?php 
					echo  esc_attr( $firstname ) ;
					?>"><?php 
					esc_html_e( $firstname, 'kineticpaywc' );
					?></option>
									<?php 
				}
			}
		}
		?>
					</select>
					<p><?php 
		esc_html_e( 'Add multiple first names to ban users', 'kineticpaywc' );
		?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" class="titledesc"><label
						for="lastname"><?php 
		esc_html_e( 'Last Name', 'kineticpaywc' );
		?></label>
				</th>
				<td>
					<select id="lastname"
							data-placeholder="<?php 
		esc_attr_e( 'Add lastname separated by comma', 'kineticpaywc' );
		?>" name="lastname[]" multiple="true" class="chosen-select-lastname category-select chosen-rtl">
						<option value=""></option>
						<?php 
		if ( !empty($lastnames) ) {
			if ( is_array( $lastnames ) ) {
				foreach ( $lastnames as $lastname ) {
					?>
									<option value="<?php 
					echo  esc_attr( $lastname ) ;
					?>"><?php 
					esc_html_e( $lastname, 'kineticpaywc' );
					?></option>
									<?php 
				}
			}
		}
		?>
					</select>
					<p><?php 
		esc_html_e( 'Add multiple last names to ban users', 'kineticpaywc' );
		?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" class="titledesc"><label
						for="kadpengenalan"><?php 
		esc_html_e( 'Identification card', 'kineticpaywc' );
		?></label>
				</th>
				<td>
					<select id="kadpengenalan"
							data-placeholder="<?php 
		esc_attr_e( 'Add identification card separated by comma', 'kineticpaywc' );
		?>" name="kadpengenalan[]" multiple="true" class="chosen-select-kadpengenalan category-select chosen-rtl">
						<option value=""></option>
						<?php 
		if ( !empty($kadpengenalans) ) {
			if ( is_array( $kadpengenalans ) ) {
				foreach ( $kadpengenalans as $kadpengenalan ) {
					?>
									<option value="<?php 
					echo  esc_attr( $kadpengenalan ) ;
					?>"><?php 
					esc_html_e( $kadpengenalan, 'kineticpaywc' );
					?></option>
									<?php 
				}
			}
		}
		?>
					</select>
					<p><?php 
		esc_html_e( 'Add multiple identification card to ban users', 'kineticpaywc' );
		?></p>
				</td>
			</tr>
			</tbody>
		</table>

		<h2><?php 
		esc_html_e( 'In this section you can add your custom messages OR our message will be printed as by default.', 'kineticpaywc' );
		?></h2>
		<table class="form-table table-outer">
			<tbody>
			<tr>
				<th scope="row" class="titledesc"><label
						for="firstname_msg"><?php 
		esc_html_e( 'First Name error message', 'kineticpaywc' );
		?></label>
				</th>
				<td><textarea id="firstname_msg" class="set_message_box" style="width: 100%"
							  name="firstname_msg"><?php 
		echo  wp_kses_post( $rltkn_fn_msg ) ;
		?></textarea>
					<p><?php 
		esc_html_e( 'Enter the error message you want to show user when banned first name found.', 'kineticpaywc' );
		?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" class="titledesc"><label
						for="lastname_msg"><?php 
		esc_html_e( 'Last Name error message', 'kineticpaywc' );
		?></label>
				</th>
				<td><textarea id="lastname_msg" class="set_message_box" style="width: 100%"
							  name="lastname_msg"><?php 
		echo  wp_kses_post( $rltkn_ln_msg ) ;
		?></textarea>
					<p><?php 
		esc_html_e( 'Enter the error message you want to show user when banned last name found.', 'kineticpaywc' );
		?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" class="titledesc"><label
						for="kadpengenalan_msg"><?php 
		esc_html_e( 'Identification Card error message', 'kineticpaywc' );
		?></label>
				</th>
				<td><textarea id="kadpengenalan_msg" colspan="15" class="set_message_box" style="width: 100%" rows=""
							  name="kadpengenalan_msg"><?php 
		echo  wp_kses_post( $rltkn_kp_msg ) ;
		?></textarea>
					<p><?php 
		esc_html_e( 'Enter the error message you want to show user when banned identification card found.', 'kineticpaywc' );
		?></p>
				</td>
			</tr>
			</tbody>
		</table>


		<p>
			<button type="submit" name="rltknp_submit" class="button button-primary" value="<?php 
		echo  esc_attr( 'Save Changes' ) ;
		?>"><?php 
		esc_html_e( 'Save Changes', 'kineticpaywc' );
		?></button>
			<button type="button" name="rltknp_submit" id="rltknp_reset_settings" class="button button-primary" value="<?php 
		echo  esc_attr( 'Reset all settings' ) ;
		?>"><?php 
		esc_html_e( 'Reset all settings', 'kineticpaywc' );
		?></button>
		</p>

		

		<?php 
		return ob_get_clean();
	}
	
	public function kineticpay_checkoutfields_settings() {
		require RLTKN_PLUGIN_DIR . 'classes/admin/view/view.php';
	}
	
}