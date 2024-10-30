<?php 
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( !class_exists( 'rlt_Checkout_Fields_Public' ) ) { 

	class rlt_Checkout_Fields_Public extends rlt_Checkout_Fields {
		
		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
			add_filter( 'user_has_cap', array( $this,'give_permissions'), 10, 3 );
			//add_filter( 'ajax_query_attachments_args', array( $this, 'filter_media' ) );
			  
			$this->module_settings = $this->get_module_settings();
			add_filter( 'woocommerce_billing_fields', array($this, 'rlt_billing_fields' ));
			add_filter( 'woocommerce_shipping_fields', array($this, 'rlt_shipping_fields' ));
			add_action( 'woocommerce_before_order_notes', array($this, 'rlt_additional_checkout_fields' ));
			add_action('woocommerce_checkout_process', array($this, 'rlt_additional_checkout_field_process'));
			add_action('woocommerce_checkout_update_order_meta', array($this, 'rlt_additional_checkout_field_update_order_meta' ));
			add_action( 'woocommerce_thankyou', array($this, 'rlt_display_order_additioanl_data'), 20 );
			add_action( 'woocommerce_view_order', array($this, 'rlt_display_order_additioanl_data'), 20 );
			add_action('woocommerce_checkout_update_user_meta', array($this, 'rlt_custom_checkout_field_update_user_meta'));
			
			
			add_filter( 'woocommerce_order_formatted_billing_address', array( $this, 'rlt_order_formatted_billing_address' ), 10, 2 );
			add_filter( 'woocommerce_order_formatted_shipping_address', array( $this, 'rlt_order_formatted_shipping_address' ), 10, 2 );
			add_filter( 'woocommerce_my_account_my_address_formatted_address', array( $this, 'rlt_my_account_my_address_formatted_address' ), 10, 3 );
	       
	       	// add_action('wp_ajax_rlt_additional_checkout_field_update_order_meta', array($this, 'rlt_additional_checkout_field_update_order_meta')); 

	       	add_filter( 'woocommerce_form_field_multiselect', array($this, 'rlt_custom_multiselect_handler'), 10, 4 );
	       	add_filter('woocommerce_email_order_meta_keyxs', array($this, 'rlt_checkout_field_order_meta_keys'));
	    	
			// add_action('woocommerce_before_checkout_billing_form', array($this, 'rlt_additional_checkout_field_update_order_meta' ));
			           
			// add_action("woocommerce_checkout_process", array($this, "wccs_upload_file_func_callback2"));
	       	add_action( 'woocommerce_cart_calculate_fees', array($this, 'rlt_woo_add_cart_fee' ));
	       	// add_action("wp_loaded", array($this, "df"));
		}

		public function front_scripts() {
        	wp_enqueue_media();
        	wp_enqueue_script(
        		'rltknpfa-ui-script',
        		'//code.jquery.com/ui/1.11.4/jquery-ui.js',
        		array('jquery'),
        		false
        	);
        	wp_enqueue_script('rltknp_timepickrr', RLTKN_PLUGIN_URL.'assets/public/js/wickedpicker.min.js');
        	wp_enqueue_script( 	'rltknpfa-front-timepicker', 
        		RLTKN_PLUGIN_URL . 'assets/public/js/jquery-ui-timepicker-addon.js', array('jquery'), false );
        	wp_enqueue_script( 	'rltknpfa-dependency-js', 
        		RLTKN_PLUGIN_URL . 'assets/public/js/fields-dependency.js' );
        	wp_enqueue_style( 	'rltknpfa-front-css', 
        		RLTKN_PLUGIN_URL . 'assets/public/css/rltknp_style_public.css', false );
        	wp_enqueue_style( 	'rltknpfa-icon-css', 
        		RLTKN_PLUGIN_URL . 'assets/public/css/icon.css', false );
        	wp_enqueue_style( 	'rltknpfa-UI-css', 
        		'//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css', false );
        	wp_enqueue_script( 	'rltknp_color_spectrum_js', 
        		RLTKN_PLUGIN_URL . 'assets/public/js/color_spectrum.js', array('jquery'), false );
        	wp_enqueue_style( 	'rltknp_color_spectrum_css', 
        		RLTKN_PLUGIN_URL . 'assets/public/css/color_spectrum.css', false );


        	wp_enqueue_style(	'rltknp_timepicker', 
        		RLTKN_PLUGIN_URL .'assets/public/css/wickedpicker.min.css', false );
        	wp_enqueue_script( 'front_time_date_pick', RLTKN_PLUGIN_URL . 'assets/public/js/datepick_timepick.js', true );

        }
       
        public function give_permissions( $allcaps, $cap, $args ) {
                $allcaps['edit_post'] = true;
                $allcaps['upload_files'] = true;
                return $allcaps;
        }

        public function filter_media( $query ) {
			// admins get to see everything
			if ( ! current_user_can( 'manage_options' ) )
				 wp_die( __('You are not allowed to access this part of the site') );
				$query['author'] = get_current_user_id();
			return $query;
		}

		public function rlt_billing_fields($fields) {
		    global $wpdb;
		    $bfields = $this->get_billing_fields();
		    
		    $default_text_fields = array( "billing_first_name", "billing_last_name", "billing_email", "billing_company", "billing_address_1", "billing_address_2", "billing_city", "billing_state", "billing_postcode", "billing_phone" );

			$i = 0;
		    foreach ($bfields as $bfield) {
//		        echo "<pre>";
//		        print_r($bfield);
//		        exit();
			   	if($bfield->is_hide == 0) {
			   		$bfield->class = array();
			    	array_push($bfield->class, $bfield->width);
			   		if($bfield->field_type == 'heading') {
			   			
			   			$fields[$bfield->field_name] = array(
					        'label'         => "<".$bfield->field_placeholder." id='".$bfield->field_id."'>".__($bfield->field_label, 'kineticpaywc')."</".$bfield->field_placeholder.">",
					        'input_class'   => array('exthide'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'message') {
			   			$fields[$bfield->field_name] = array(
					        'label'         => __(stripslashes($bfield->field_label), 'kineticpaywc'),
					        'class'         => array('full'),
					        'input_class'   => array('exthide'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'datepicker') {
			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'input_class'   => array('datepick'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'timepicker') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'input_class'   => array('input-text timepick'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'radioselect') {
			   			$opts = $this->getSelectOptions($bfield->field_id);
			   			$options1 = array();
				   		foreach ($opts as $opt) {
				   			$options1[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce'),
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'radio',
					        'options'     	=> $options1,
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'multiselect') {
			   		    $opts = $this->getSelectOptions($bfield->field_id);
                        $options2 = array();
				   		foreach ($opts as $opt) {
				   			$options2[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}

			   			$fields[$bfield->field_name.'[]'] = array(
					        'label'         => __($bfield->field_label, 'woocommerce'),
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> $bfield->field_type,
					        'options'     	=> $options2,
					        'priority'		=> $bfield->sort_order * 10
				        );

			   		} else if($bfield->field_type == 'select') {
			   			$opts = $this->getSelectOptions($bfield->field_id);
                        $options = array();
                        $options['Choose'] = 'Choose';
				   		foreach ($opts as $opt) {
				   			$options[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
			   			if($bfield->field_name == "billing_country") {
			   				$fields[$bfield->field_name]["label"] 		= __($bfield->field_label, 'woocommerce').$fprice;
				   			$fields[$bfield->field_name]["required"] 	= $bfield->is_required == 0 ? 0 : 1;
				   			$fields[$bfield->field_name]["class"] 		= array_merge($fields[$bfield->field_name]["class"], $bfield->class);
				   			$fields[$bfield->field_name]["id"] 			= $bfield->field_id;
				   			$fields[$bfield->field_name]["priority"] 	= $bfield->sort_order * 10;
			   			} else {
				   			$fields[$bfield->field_name.'[]'] = array(
						        'label'         => __($bfield->field_label, 'woocommerce'),
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> $bfield->field_type,
						        'options'     	=> $options,
						        'priority'		=> $bfield->sort_order * 10
					        );
				   		}

			   		} else if($bfield->field_type == 'image') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			if($bfield->is_required == 1)
				   			$label = __($bfield->field_label.'<span class = req>*<span><input type="file" name="image_billing" id="image_billing'.$i.'" >');
				   		else
				   			$label = __($bfield->field_label.'<span> (optional)<span><input type="file" name="image_billing" id="image_billing'.$i.'" >');

                     	$fields[$bfield->field_name] = array(
                        	'type' => 'text',
					   		'label'      => $label.$fprice,
					   		'id' => 'billing_file_name'.$i,
					   		'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					   		'required'      => ($bfield->is_required == 0 ? false : true),
					    	'class'         => $bfield->class,
					    	'priority'		=> $bfield->sort_order * 10
				        );

			   		} else if($bfield->field_type == 'phone') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'kineticpaywc').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => $bfield->class,
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'color') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'kineticpaywc').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => $bfield->class,
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'input_class'   => array('color_sepctrum'),
					        'priority'		=> $bfield->sort_order * 10
					    );

					    ?>
						<script>
							jQuery(function($){
								jQuery(".color_sepctrum").spectrum({
								    color: "#f00",
								    preferredFormat: "hex",
								});
							});
						</script>
						<?php 

			   		} else if($bfield->field_type == 'text') {
						$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

				   		if(in_array($bfield->field_name, $default_text_fields)) {
				   			$fields[$bfield->field_name]["label"] 		= __($bfield->field_label, 'woocommerce').$fprice;
				   			$fields[$bfield->field_name]["placeholder"] = _x($bfield->field_placeholder, 'placeholder', 'woocommerce');
				   			$fields[$bfield->field_name]["required"] 	= $bfield->is_required == 0 ? 0 : 1;
				   			$fields[$bfield->field_name]["class"] 		= array_merge($fields[$bfield->field_name]["class"], $bfield->class);
				   			$key = array_search('screen-reader-text', $fields[$bfield->field_name]["class"]);
				   			if($key !== FALSE) {
				   				unset($fields[$bfield->field_name]["class"][$key]);
				   			}
				   			$fields[$bfield->field_name]["id"] 			= $bfield->field_id;
				   			$fields[$bfield->field_name]["priority"] 	= $bfield->sort_order * 10;
				   		} else {
				   			$fields[$bfield->field_name] = array(
						        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'required'      => ($bfield->is_required == 0 ? false : true),
						        'class'         => $bfield->class,
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> $bfield->field_type,
						        'priority'		=> $bfield->sort_order * 10
						    );
				   		}

			   		} else {
				   		$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

					    $fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => $bfield->class,
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> $bfield->field_type,
					        'priority'		=> $bfield->sort_order * 10
					    );
					    
					} 
			
					if($bfield->field_type == 'image'){
						?>
				        <script type="text/javascript">
							document.addEventListener('DOMContentLoaded', function() {	
								
							  	document.getElementById('billing_file_name<?php echo $i;?>').value = '';
							});
							jQuery(document).ready(function($) {
								window.onload = function(){
									var imgs = document.getElementsByName('image_billing<?php echo $i;?>');
				      				for(imgIndex in imgs) {
				      					var pnode = imgs[imgIndex].parentNode;
				      					if(typeof pnode != 'undefined' ) {
				      						pnode.nextSibling.firstChild.value = '';
				      					}
				      				}
				     
								}
							 	var input = document.getElementById("billing_file_name<?php echo $i;?>");
							 	jQuery(input).on('change', function() {

							 		if(jQuery(this).val() == '') {
							 			jQuery( "#image_billing<?php echo $i;?>").val('');
							 		}
							 		jQuery('body').trigger('update_checkout');
							 	});
							 	formdata = formnames = [], loadfiles = [];
								if(window.FormData) {
									formdata = new FormData();
								}
								jQuery( "#image_billing<?php echo $i;?>" ).change(function() {
									let $this = this;
									
						        	var file_data = jQuery("#image_billing<?php echo $i;?>")[0].files[0];
				           
									formdata.append('image_billing<?php echo $i;?>', file_data);
								
									$.ajax({
									    url         : "<?php echo admin_url('/admin-ajax.php?action=rlt_upload_pic&id='.'image_billing'.$i.'&ext='.$bfield->field_extensions.'');  ?>",
									    cache       : false,
									    contentType : false,
									    processData : false,
									    data        : formdata,                         
									    type        : 'post',
									    success     : function(output) {
									    	// console.log(output);
									     	if(output == '') {
									     		alert('invalid extension');
									     		jQuery("#image_billing<?php echo $i;?>").val('');
									     	 	// window.location.reload();
									     	} else {
									       		document.getElementById("billing_file_name<?php echo $i;?>").value = output;
											 	jQuery('body').trigger('update_checkout');
									   		}
							    		}
							        });
					         	});
							});
						</script>
						<?php
						$i++;
					}

					if($bfield->field_type != 'select' && $bfield->field_type != 'radioselect' && $bfield->field_type != 'multiselect') {
						?>
					    <input type="hidden" name="price_<?php echo $bfield->field_id; ?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $bfield->field_price; ?>" />
					    <?php
					}

					if($bfield->field_type == "multiselect") { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						        $('select[name="billing_field_<?php echo $bfield->field_id; ?>[]"]').on('change',function() {
						            jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
						<?php
					} else if($bfield->field_type == "radioselect") { ?>
						<script type="text/javascript">
						    jQuery(document).ready(function( $ ) {
						        $("#<?php echo $bfield->field_id; ?>_field").find('input').on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
					<?php }else { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						        $("#<?php echo $bfield->field_id; ?>").on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
						<?php
					}

					if($bfield->showif != '' && $bfield->cfield != '' && $bfield->ccondition != '') { 
						$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id=%d", $bfield->cfield), ARRAY_A);
						?>
						<script>
							jQuery( document ).ready(function( $ ) {
								$("#<?php echo $bfield->field_id; ?>").Dependency({
									fieldID: "<?php echo $bfield->field_id; ?>",
									parentID: "<?php echo $bfield->cfield; ?>",
									conditionAction: "<?php echo $bfield->showif; ?>",
									condition: "<?php echo $bfield->ccondition; ?>",
									conditionValue: "<?php echo $bfield->ccondition_value; ?>",
									parentType: "<?php echo $result['field_type']; ?>"
								});
							});
						</script>
						<?php 
					}
				} else {

					if(array_key_exists($bfield->field_name, $fields) !== FALSE) {
						unset( $fields[$bfield->field_name] );
					}
				}
			}
			return $fields;
		}

		public function rlt_additional_checkout_field_update_order_meta($order_id) {
			foreach ($_POST as $key => $value) {
				$er = $this->getAdditional($key);
				if($er!='') {
					if ( ! empty( $_POST[$key] ) && $er->field_mode == 'additional_additional' ) {
						if($er->field_type == 'multiselect') {
							$prefix = '';
							foreach ($_POST[$key] as $value) {
								$multi .= $prefix.$value;
	    						$prefix = ', ';
							}
							update_post_meta_wc( $order_id, $er->field_label, $multi );
						} else {
							update_post_meta_wc( $order_id, $er->field_label, $_POST[$key] );
						}
					}
				}
			}
		}

		public function rlt_shipping_fields($fields) {
		    global $wpdb;

		    $bfields = $this->get_shipping_fields();
		    $default_text_fields = array( "billing_first_name", "billing_last_name", "billing_email", "billing_company", "billing_address_1", "billing_address_2", "billing_city", "billing_state", "billing_postcode", "billing_phone" );
		    $i=0;
		    foreach ($bfields as $bfield) {
			   	if($bfield->is_hide == 0) {
			   		$bfield->class = array();
			    	array_push($bfield->class, $bfield->width);
			   		if($bfield->field_type == 'heading') {
			   			
			   			$fields[$bfield->field_name] = array(
					        'label'         => "<".$bfield->field_placeholder." id='".$bfield->field_id."'>".__($bfield->field_label, 'kineticpaywc')."</".$bfield->field_placeholder.">",
					        'input_class'   => array('exthide'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'message') {
			   			$fields[$bfield->field_name] = array(
					        'label'         => __(stripslashes($bfield->field_label), 'kineticpaywc'),
					        'class'         => array('full'),
					        'input_class'   => array('exthide'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'datepicker') {
			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'input_class'   => array('input-text datepick'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'timepicker') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'input_class'   => array('input-text timepick'),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'radioselect') {
			   			$opts = $this->getSelectOptions($bfield->field_id);
			   			$options1 = array();
				   		foreach ($opts as $opt) {
				   			$options1[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce'),
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'radio',
					        'options'     	=> $options1,
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'multiselect') {
			   			$opts = $this->getSelectOptions($bfield->field_id);
                        $options2 = array();
				   		foreach ($opts as $opt) {
				   			$options2[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
			   			$fields[$bfield->field_name.'[]'] = array(
					        'label'         => __($bfield->field_label, 'woocommerce'),
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
//					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> $bfield->field_type,
					        'options'     	=> $options2,
					        'priority'		=> $bfield->sort_order * 10
				        );

			   		} else if($bfield->field_type == 'select') {
			   			$opts = $this->getSelectOptions($bfield->field_id);
                        $options = array();
                        $options['Choose'] = 'Choose';
				   		foreach ($opts as $opt) {
				   			$options[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
			   			if($bfield->field_name == "billing_country") {
			   				$fields[$bfield->field_name]["label"] 		= __($bfield->field_label, 'woocommerce').$fprice;
				   			$fields[$bfield->field_name]["required"] 	= $bfield->is_required == 0 ? 0 : 1;
				   			$fields[$bfield->field_name]["class"] 		= array_merge($fields[$bfield->field_name]["class"], $bfield->class);
				   			$fields[$bfield->field_name]["id"] 			= $bfield->field_id;
				   			$fields[$bfield->field_name]["priority"] 	= $bfield->sort_order * 10;
			   			} else {
				   			$fields[$bfield->field_name.'[]'] = array(
						        'label'         => __($bfield->field_label, 'woocommerce'),
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> $bfield->field_type,
						        'options'     	=> $options,
						        'priority'		=> $bfield->sort_order * 10
					        );
				   		}

			   		} else if($bfield->field_type == 'image') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			if($bfield->is_required == 1)
				   			$label = __($bfield->field_label.'<span class = req>*<span><input type="file" name="image_shipping" id="image_shipping'.$i.'" >');
				   		else
				   			$label = __($bfield->field_label.'<span> (optional)<span><input type="file" name="image_shipping" id="image_shipping'.$i.'" >');

                     	$fields[$bfield->field_name] = array(
                        	'type' => 'text',
					   		'label'      => $label.$fprice,
					   		'id' => 'shipping_file_name'.$i,
					   		'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					   		'required'      => ($bfield->is_required == 0 ? false : true),
					    	'class'         => $bfield->class,
					    	'priority'		=> $bfield->sort_order * 10
				        );

			   		} else if($bfield->field_type == 'phone') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'kineticpaywc').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => $bfield->class,
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'priority'		=> $bfield->sort_order * 10
					    );

			   		} else if($bfield->field_type == 'color') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			$fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'kineticpaywc').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => $bfield->class,
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> 'text',
					        'input_class'   => array('color_sepctrum'),
					        'priority'		=> $bfield->sort_order * 10
					    );

					    ?>
						<script>
							jQuery(function($){
								jQuery(".color_sepctrum").spectrum({
								    color: "#f00",
								    preferredFormat: "hex",
								});
							});
						</script>
						<?php 

			   		} else if($bfield->field_type == 'text') {
			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

				   		if(in_array($bfield->field_name, $default_text_fields)) {
				   			$fields[$bfield->field_name]["label"] 		= __($bfield->field_label, 'woocommerce').$fprice;
				   			$fields[$bfield->field_name]["placeholder"] = _x($bfield->field_placeholder, 'placeholder', 'woocommerce');
				   			$fields[$bfield->field_name]["required"] 	= $bfield->is_required == 0 ? 0 : 1;
				   			$fields[$bfield->field_name]["class"] 		= array_merge($fields[$bfield->field_name]["class"], $bfield->class);
				   			$key = array_search('screen-reader-text', $fields[$bfield->field_name]["class"]);
				   			if($key !== FALSE) {
				   				unset($fields[$bfield->field_name]["class"][$key]);
				   			}
				   			$fields[$bfield->field_name]["id"] 			= $bfield->field_id;
				   			$fields[$bfield->field_name]["priority"] 	= $bfield->sort_order * 10;
				   		} else {
				   			$fields[$bfield->field_name] = array(
						        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'required'      => ($bfield->is_required == 0 ? false : true),
						        'class'         => $bfield->class,
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> $bfield->field_type,
						        'priority'		=> $bfield->sort_order * 10
						    );
				   		}

			   		} else {
				   		$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

					    $fields[$bfield->field_name] = array(
					        'label'         => __($bfield->field_label, 'woocommerce').$fprice,
					        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					        'required'      => ($bfield->is_required == 0 ? false : true),
					        'class'         => $bfield->class,
					        'clear'         => false,
					        'id'         	=> $bfield->field_id,
					        'type'			=> $bfield->field_type,
					        'priority'		=> $bfield->sort_order * 10
					    );
					} 
			
					if($bfield->field_type == 'image'){
						?>
				        <script type="text/javascript">
							document.addEventListener('DOMContentLoaded', function() {	
								
							  	document.getElementById('shipping_file_name<?php echo $i;?>').value = '';
							});
							jQuery(document).ready(function($) {
								window.onload = function(){
									var imgs = document.getElementsByName('image_shipping<?php echo $i;?>');
				      				for(imgIndex in imgs) {
				      					var pnode = imgs[imgIndex].parentNode;
				      					if(typeof pnode != 'undefined' ) {
				      						pnode.nextSibling.firstChild.value = '';
				      					}
				      				}
				     
								}
							 	var input = document.getElementById("shipping_file_name<?php echo $i;?>");
							 	jQuery(input).on('change', function() {
							 		if(jQuery(this).val() == '') {
							 			jQuery( "#image_shipping<?php echo $i;?>").val('');
							 		}
							 		jQuery('body').trigger('update_checkout');
							 	});
							 	formdata = formnames = [], loadfiles = [];
								if(window.FormData) {
									formdata = new FormData();
								}
								jQuery( "#image_shipping<?php echo $i;?>" ).change(function() {
						        	var file_data = jQuery("#image_shipping<?php echo $i;?>")[0].files[0];
				           
									formdata.append('image_shipping<?php echo $i;?>', file_data);
								
									$.ajax({
									    url         : "<?php echo admin_url('/admin-ajax.php?action=rlt_upload_pic&id='.'image_shipping'.$i.'&ext='.$bfield->field_extensions.'');  ?>",
									    cache       : false,
									    contentType : false,
									    processData : false,
									    data        : formdata,                         
									    type        : 'post',
									    success     : function(output) {
									    	// console.log(output);
									     	if(output == '') {
									     		alert('invalid extension');
									     		jQuery("#image_shipping<?php echo $i;?>").val('');
									     	 	// window.location.reload();
									     	} else {
									       		document.getElementById("shipping_file_name<?php echo $i;?>").value = output;
									       		jQuery('body').trigger('update_checkout');
									   		}
							    		}
							        });
					         	});
							});
						</script>
						<?php
						$i++;
					}

					if($bfield->field_type != 'select' && $bfield->field_type != 'radioselect' && $bfield->field_type != 'multiselect') {
						?>
					    <input type="hidden" name="price_<?php echo $bfield->field_id; ?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $bfield->field_price; ?>" />
					    <?php
					}

					if($bfield->field_type == "multiselect") { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						        $('select[name="billing_field_<?php echo $bfield->field_id; ?>[]"]').on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
						<?php
					} else if($bfield->field_type == "radioselect") { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						        $("#<?php echo $bfield->field_id; ?>_field").find('input').on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
					<?php }else { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						        $("#<?php echo $bfield->field_id; ?>").on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
						<?php
					}

					if($bfield->showif != '' && $bfield->cfield != '' && $bfield->ccondition != '') { 
						$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id=%d", $bfield->cfield), ARRAY_A);
						?>
						<script>
							jQuery( document ).ready(function( $ ) {
								$("#<?php echo $bfield->field_id; ?>").Dependency({
									fieldID: "<?php echo $bfield->field_id; ?>",
									parentID: "<?php echo $bfield->cfield; ?>",
									conditionAction: "<?php echo $bfield->showif; ?>",
									condition: "<?php echo $bfield->ccondition; ?>",
									conditionValue: "<?php echo $bfield->ccondition_value; ?>",
									parentType: "<?php echo $result['field_type']; ?>"
								});
							});
						</script>
						<?php 
					}

				} else {

					if(array_key_exists($bfield->field_name, $fields) !== FALSE) {
						unset( $fields[$bfield->field_name] );
					}
				}
			}

			return $fields;
		}

		public function get_billing_fields() {
			global $wpdb;
             
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type!='' AND type = %s ORDER BY length(sort_order), sort_order", 'billing'));      
            return $result;
		}

		public function get_shipping_fields() {
			global $wpdb;
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type!='' AND type = %s ORDER BY length(sort_order), sort_order", 'shipping'));      
            return $result;
		}

		public function getSelectOptions($id) {
			global $wpdb;
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_meta." WHERE field_id = %d", $id));      
            return $result;
		}

		public function rlt_additional_checkout_fields($checkout) {
			global $wpdb;
			$add_fields = $this->getAdditionlFields();
			if(is_array($add_fields) && count($add_fields) > 0 ) {
				echo '<div class="rlt_additional_checkout_field"><h3>Verification Information</h3>';
			} else {
				return;
			}
			
			$i=0;

			foreach ($add_fields as $bfield) {
				if($bfield->is_hide == 0) {

					$bfield->class = array();
			    	array_push($bfield->class, $bfield->width);

			    	$country_classes = array( "form-row-wide", "address-field", "update_totals_on_change" );

					if($bfield->field_type == 'datepicker') {
			   			woocommerce_form_field(
			   				$bfield->field_name,
			   				array(
							   	'type' 			=> 'text',
							   	'label'      	=> __($bfield->field_label, 'woocommerce'),
							   	'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
							   	'required'      => ($bfield->is_required == 0 ? false : true),
							   	'input_class'   => array('input-text datepick'),
							   	'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
							   	'clear'     	=> false,
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );

			   		} else if($bfield->field_type == 'heading') {
			   			woocommerce_form_field(
							$bfield->field_name,
							array(
					   			'label' 		=> "<".$bfield->field_placeholder." id='".$bfield->field_id."'>".__($bfield->field_label, 'kineticpaywc')."</".$bfield->field_placeholder.">",
						        'class'         => array('full'),
						        'input_class'   => array('exthide'),
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> 'text',
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );

			   		} else if($bfield->field_type == 'message') {
			   			woocommerce_form_field(
			   				$bfield->field_name,
			   				array(
						        'label'         => __(stripslashes($bfield->field_label), 'kineticpaywc'),
						        'class'         => array('full'),
						        'input_class'   => array('exthide'),
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> 'text',
						    	'priority'		=> $bfield->sort_order * 10
						    ),
			   				$checkout->get_value( $bfield->field_name )
			   			);

			   		} else if($bfield->field_type == 'timepicker') {
			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}
			   			woocommerce_form_field(
			   				$bfield->field_name,
			   				array(
							   	'type' => 'text',
							   	'label'      => __($bfield->field_label, 'woocommerce').$fprice,
							   	'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
							   	'required'      => ($bfield->is_required == 0 ? false : true),
							   	'input_class'   => array('input-text timepick'),
							   	'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
							   	'clear'     => false,
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );

			   		} else if($bfield->field_type == 'multiselect') {	
				   		$opts = $this->getSelectOptions($bfield->field_id);
                        $options2 = array();
				   		foreach ($opts as $opt) {
				   			$options2[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
				   		woocommerce_form_field(
				   			$bfield->field_name.'[]',
				   			array(
					   			'type' 			=> $bfield->field_type,
							   	'label'      	=> __($bfield->field_label, 'woocommerce'),
							   	'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
//							   	'required'      => ($bfield->is_required == 0 ? false : true),
							   	'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
							   	'clear'    	 	=> false,
							   	'id'         	=> $bfield->field_id,
							   	'options' 		=> $options2,
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );

			   		} else if($bfield->field_type == 'radioselect') {	

					    $opts = $this->getSelectOptions($bfield->field_id);
                        $options1 = array();
				   		foreach ($opts as $opt) {
				   			$options1[$opt->meta_key] = $opt->meta_value;
				   			?>
					    	<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
					    	<?php
				   		}
			   			woocommerce_form_field(
			   				$bfield->field_name,
			   				array(
						        'label'         => __($bfield->field_label, 'woocommerce'),
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'required'      => ($bfield->is_required == 0 ? false : true),
						        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> 'radio',
						        'options'     	=> $options1,
						        'priority'		=> $bfield->sort_order * 10
						    ),
						    $checkout->get_value( $bfield->field_name )
					    );

			   		} else if($bfield->field_type == 'select') {

			   			$opts = $this->getSelectOptions($bfield->field_id);
                        $options = array();
                        $options['Choose'] = 'Choose';
				   		foreach ($opts as $opt) {
				   			$options[$opt->meta_key] = $opt->meta_value;
				   			?>
				   				<input type="hidden" name="price_<?php echo $opt->meta_key;?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $opt->meta_price;?>" />
				   			<?php
				   		}

				   		woocommerce_form_field( $bfield->field_name.'[]',
				   			array(
							   	'type' 			=> 'select',
							   	'label'      	=> __($bfield->field_label, 'woocommerce'),
							   	'placeholder'	=> _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
							   	'class'         	=> array(($bfield->width == 'full' ? 'full' : 'half')),
							   	'clear'     		=> false,
							   	'id'         	=> 'additional_field_'.$bfield->field_id,
							   	'options' 		=> $options,
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );

			   		} else if($bfield->field_type == 'image') {
			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}
                      	if ( current_user_can( 'upload_files' ,get_current_user_id()) ) {
				   			woocommerce_form_field(
				   				$bfield->field_name,
				   				array(
								   	'type' => 'text',
								   	'label'      => __($bfield->field_label, 'woocommerce').$fprice,
								   	'id' => 'additional_file_name'.$i,
								   	'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
								   	'required'      => ($bfield->is_required == 0 ? false : true),
								   	'class'         => array(($bfield->width == 'full' ? 'full display1' : 'half display1')),
						    		'priority'		=> $bfield->sort_order * 10
						       	),
				   				$checkout->get_value( $bfield->field_name )
				   			);
			   				?>
			   				<input class="form-control" type="file" id="image_additional<?php echo $i; ?>" name="image_addtional" >

	        				<script type="text/javascript">
	         					jQuery(document).ready(function($) {
									var input = document.getElementById("image_additional<?php echo $i; ?>"); 
									formdata = formnames = [], loadfiles = [];

									if(window.FormData) {
										formdata = new FormData();
									}
						  
									input.addEventListener("change", function (evt) {
										var file_data = $("#image_additional<?php echo $i; ?>")[0].files[0];
										formdata.append('image_additional<?php echo $i; ?>', file_data);
										$.ajax({
											url: "<?php echo admin_url('/admin-ajax.php?action=rlt_upload_pic&id='.'image_additional'.$i.'&ext='.$bfield->field_extensions.'');  ?>",
											cache: false,
											contentType: false,
											processData: false,
											data: formdata,                         
											type: 'post',
											success: function(output){
												console.log(output);
												if(output == '') {
													alert('invalid extension');
													$("#image_additional<?php echo $i; ?>").val('');
													// window.location.reload();
												} else {
													document.getElementById("additional_file_name<?php echo $i;?>").value = output;
													jQuery('body').trigger('update_checkout');
												}
											}
										});
									}, false);
									});
							</script>
							<?php
                           	$i++;
						}

					} else if($bfield->field_type == 'phone') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			woocommerce_form_field(
			   				$bfield->field_name,
			   				array(
						        'label'         => __($bfield->field_label, 'kineticpaywc').$fprice,
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'required'      => ($bfield->is_required == 0 ? false : true),
						        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
						        'clear'         => false,
						        'id'         	=> 'additional_field_'.$bfield->field_id,
						        'type'			=> 'text',
							    'priority'		=> $bfield->sort_order * 10
						    ),
			   				$checkout->get_value( $bfield->field_name )
						);

					    ?>
					    <input type="hidden" name="price_<?php echo $bfield->field_id; ?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $bfield->field_price; ?>" />
					    <?php

			   		} else if($bfield->field_type == 'color') {

			   			$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}

			   			woocommerce_form_field(
			   				$bfield->field_name,
			   				array(
						        'label'         => __($bfield->field_label, 'kineticpaywc').$fprice,
						        'placeholder'   => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
						        'required'      => ($bfield->is_required == 0 ? false : true),
						        'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
						        'clear'         => false,
						        'id'         	=> $bfield->field_id,
						        'type'			=> 'text',
						        'input_class'   => array('color_sepctrum'),
						    	'priority'		=> $bfield->sort_order * 10
						    ),
			   				$checkout->get_value( $bfield->field_name )
			   			);

					    ?>
					    <input type="hidden" name="price_<?php echo $bfield->field_id; ?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $bfield->field_price; ?>" />
						<script>
							jQuery(function($){
								jQuery(".color_sepctrum").spectrum({
								    color: "#f00",
								    preferredFormat: "hex",
								});
							});
						</script>
						<?php 

					} else if($bfield->field_type == 'countries') {
						woocommerce_form_field(
							$bfield->field_name,
							array(
					   			'type' 			=> 'country',
					   			'label' 		=> __($bfield->field_label, 'woocommerce'),
					   			'placeholder' 	=> _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					   			'required'      => ($bfield->is_required == 0 ? false : true),
					   			'class'         => array_merge( $bfield->class, $country_classes ),
					   			'clear'     	=> false,
					   			'autocomplete' => 'country',
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );

					} else {
						$field_price = (float)$bfield->field_price;
						if($field_price != 0) {
				   			$fprice = "(".wc_price($bfield->field_price).")";
				   		} else {
				   			$fprice = "";
				   		}
						woocommerce_form_field(
							$bfield->field_name,
							array(
					   			'type' => $bfield->field_type,
					   			'label' => __($bfield->field_label, 'woocommerce').$fprice,
					   			'placeholder' => _x($bfield->field_placeholder, 'placeholder', 'woocommerce'),
					   			'required'      => ($bfield->is_required == 0 ? false : true),
					   			'class'         => array(($bfield->width == 'full' ? 'full' : 'half')),
					   			'clear'     => false,
						    	'priority'		=> $bfield->sort_order * 10
					       	),
					       	$checkout->get_value( $bfield->field_name )
					    );
					}
					?>
						<input type="hidden" name="price_<?php echo $bfield->field_id; ?>" id="price_<?php echo $bfield->field_id; ?>" value="<?php echo $bfield->field_price; ?>" />

					<?php

					if($bfield->field_type == "multiselect") { ?>
						<script type="text/javascript">
							
						    jQuery( document ).ready(function( $ ) {
						        $('select[name="additional_field_<?php echo $bfield->field_id; ?>[]"]').on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
					<?php
					} if($bfield->field_type == "select") { ?>
						<script type="text/javascript">
							var id = "#field_<?php echo $bfield->field_id;?>";
						    jQuery( document ).ready(function( $ ) {
						        $(id).on('change', function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
					<?php
					} else if($bfield->field_type == "radioselect") { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						    	var id = "#<?php echo $bfield->field_id;?>_field";
						        $(id).find('input').on('click',function() {
						        	jQuery('body').trigger('update_checkout');
						        	$(this).on('click',function() {
							        	jQuery('body').trigger('update_checkout');
							        });
						    	});
						    });
					    </script>
					<?php } else { ?>
						<script type="text/javascript">
						    jQuery( document ).ready(function( $ ) {
						        $("#additional_field_<?php echo $bfield->field_id; ?>").on('change',function() {
						        	jQuery('body').trigger('update_checkout');
						    	});
						    });
					    </script>
						<?php
					}

					if($bfield->field_type == "datepicker") { ?>
						<script>
							jQuery(document).ready( function() {
							    jQuery( '.datepick' ).datepicker();
							} );
						</script>
					<?php }
					if($bfield->field_type == "timepicker") { ?>
						<script type="text/javascript">
							var timePickerOpions = {
						        twentyFour: false, 
						        upArrow: 'wickedpicker__controls__control-up',
						        downArrow: 'wickedpicker__controls__control-down',
						        close: 'wickedpicker__close',
						        hoverState: 'hover-state',
						        title: 'Timepicker',
						        showSeconds: false,
						        timeSeparator: ' : ',
						        secondsInterval: 1,
						        minutesInterval: 1,
						        beforeShow: null,
						        afterShow: null,
						        show: null,
						        clearable: true,
						    };

							jQuery('.timepick').wickedpicker(timePickerOpions);
							jQuery('.timepick').val('');
						</script>

					<?php }

					if($bfield->showif != '' && $bfield->cfield != '' && $bfield->ccondition != '') {
						$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id=%d", $bfield->cfield), ARRAY_A);
						?>
						<script>
							jQuery( document ).ready(function( $ ) {

								$("#<?php echo $bfield->field_id; ?>").Dependency({
									fieldID: "<?php echo $bfield->field_id; ?>",
									parentID: "<?php echo $bfield->cfield; ?>",
									conditionAction: "<?php echo $bfield->showif; ?>",
									condition: "<?php echo $bfield->ccondition; ?>",
									conditionValue: "<?php echo $bfield->ccondition_value; ?>",
									parentType: "<?php echo $result['field_type']; ?>"
								});
							});
						</script>
						<?php
					}

					if($bfield->showif != '' && $bfield->cfield != '' && $bfield->ccondition != '') {
						$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id=%d", $bfield->cfield), ARRAY_A);
						?>
						<script>
							jQuery( document ).ready(function( $ ) {
								$("#<?php echo $bfield->field_id; ?>").Dependency({
									fieldID: "additional_field_<?php echo $bfield->field_id; ?>",
									parentID: "additional_field_<?php echo $bfield->cfield; ?>",
									conditionAction: "<?php echo $bfield->showif; ?>",
									condition: "<?php echo $bfield->ccondition; ?>",
									conditionValue: "<?php echo $bfield->ccondition_value; ?>",
									parentType: "<?php echo $result['field_type'] == 'countries' ? 'select' : $result['field_type']; ?>"
								});
							});
						</script>
						<?php
					}
				}
			}
			echo "</div>";
		}

		public function getAdditionlFields() {
			global $wpdb;
             
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type!='' AND type = %s ORDER BY length(sort_order), sort_order", 'additional'));      
            return $result;
		}

		public function rlt_additional_checkout_field_process() {
			foreach ($_POST as $key => $value) {
				$er = $this->getRequired($key);
				if($er!='') {
					if ( $_POST[$key] == '' && $er->is_required == 1 ) {
	       				wc_add_notice( __( $er->field_label.' is a required field', 'kineticpaywc' ), 'error' );

	       			}
	       			if($er->field_type == 'phone') {

	       				$phone = Preg_replace("/[^\d]/", "", $_POST[$key]);

		       			if(strlen($phone) <= 10 && $_POST[$key]!='') {
					        wc_add_notice(__('Invalid '.$er->field_label.', please check your input.', 'kineticpaywc'), 'error');
					    }
					}
       			}
			}

			$add_fields = $this->getAdditionlFields();
			foreach ($add_fields as $add_field) {
		    	$er = $this->getRequired($add_field->field_name);

		    	if($er!='') {
			    	if(!array_key_exists($add_field->field_name, $_POST)) {
			    		if($er->is_required == 1 && $er->is_hide == 0) {
			    			wc_add_notice( __( $add_field->field_label.' is a required field', 'kineticpaywc' ), 'error' );
			    		}
			    	}
		    	}
		    }


		    $badd_fields = $this->getBillingFields();
			foreach ($badd_fields as $badd_field) {
		    	$er = $this->getRequired($badd_field->field_name);

		    	if($er!='') {
			    	if(!array_key_exists($badd_field->field_name, $_POST)) {
			    		if($er->is_required == 1 && $er->is_hide == 0) {
			    			wc_add_notice( __( $badd_field->field_label.' is a required field', 'kineticpaywc' ), 'error' );
			    		}


			    	}
		    	}
		    }


		    $sadd_fields = $this->getShippingFields();
			foreach ($sadd_fields as $sadd_field) {
		    	$er = $this->getRequired($sadd_field->field_name);

		    	if($er!='') {
			    	if(!array_key_exists($sadd_field->field_name, $_POST)) {
			    		if($er->is_required == 1 && $er->is_hide == 0) {
			    			wc_add_notice( __( $sadd_field->field_label.' is a required field' ), 'error' );
			    		}
			    	}
		    	}
		    }
		}

		public function getRequired($name) { 
			global $wpdb;
           	$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_mode!='default' AND field_name = %s", $name));      
            return $result;
		}

		public function getAdditional($name) {
			global $wpdb;
           	$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_name = %s", $name));      
            return $result;
		}

		public function getAllAdditional() {
			global $wpdb;
           	$result = $wpdb->get_results( "SELECT * FROM ".$wpdb->rltknp_fields);      
            return $result;
		}

		public function getAdditionalBylabel($name){
			global $wpdb;
           	$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_label = %s", $name));      
            return $result;
		}

		public function rlt_custom_checkout_field_update_user_meta($user_id) {
			//global $wpdb, $woocommerce, $post; // this is how you get access to the database
			foreach ($_POST as $key => $value) {
				$er = $this->getAdditional($key);
				if($er!='') {
					if ( ! empty( $_POST[$key] ) && ($er->field_mode == 'billing_additional' || $er->field_mode == 'shipping_additional') ) {
						update_user_meta( $user_id, $er->field_name, $_POST[$key] );
					}
				}

			}
		}

		public function rlt_display_order_additioanl_data($order_id) { ?> 

			<h2>Verification Information</h2>

		    <table class="shop_table shop_table_responsive additional_info">
		        <tbody>
		        	<?php 
		        	$add_fields = $this->getAdditionlFields();
		        	$imgs = array();
		        	foreach ($add_fields as $add_field) {
		        		$check = get_post_meta_wc( $order_id, $add_field->field_label, true );
		        		$label = $this->getAdditionalBylabel($add_field->field_label);
		        		if($check!='') {
		        			$value = get_post_meta_wc( $order_id, $add_field->field_label, true );	
		        			//print_r($value);
		        			?>
			            	<tr>
			                	<th><?php _e( $add_field->field_label.':' ); ?></th>
			                	<td class="">
			                		<?php 
				                		if($label->field_type=='checkbox' && $value==1) {
				                			echo "Yes";
				                		} else if($label->field_type=='checkbox' && $value==0) {
				                			echo "No";
				                		}
				                		else {
				                			
				                			if($label->field_type == 'image') {
			                					array_push($imgs, $value);
			                					list($filename, $ext) = explode('.', $value);
			                	
			                					if($ext == 'pdf') {
			                						echo '<p class="address"><strong>' . __( $add_field->field_label ) . ': </strong><br>' . $address[$add_field->field_name]  = '<a href="'.RLTKN_PLUGIN_URL .'/upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
	                                   
			                					} else if($ext == 'doc' || $ext == 'docx') {
			                						echo '<p class="address"><strong>' . __( $add_field->field_label ) . ': </strong><br>' . $address[$add_field->field_name] = '<a href="'.RLTKN_PLUGIN_URL .'/upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
	                              				} else {
			                						?>
			                						<img  src="<?php echo RLTKN_PLUGIN_URL.'/upload/'.$value; ?>" onclick="openModal(this);" class="hover-shadow" width="80" height="80">
													<?php
												}
											} else {
			                					echo $value;
			                				}
			                			}
			                		?>
			               	 	</td>
		            		</tr>
		        			<?php
		        		}
		        	}
		        	?>
		            
		        </tbody>
		    </table>

	 		<div id="myModal" class="modal">
			 	<span class="close cursor" onclick="closeModal(this)">&times;</span>
				<div class="modal-content">
					<div id="modal-slides-wrapper" style="background-color: black;">
			      		<div class="mySlides">
			        		<div class="numbertext"></div>
			        		<img id="modal-img" src="<?php //echo wp_upload_dir()['baseurl'].'/'.$img ?>" style="width:100%">
			      		</div>

					</div>
						    
				</div>
			</div>

			<?php 
				wp_enqueue_script( 'rltknpfa-front-js', RLTKN_PLUGIN_URL . 'assets/public/js/script.js', array('jquery'), false );
		}

		public function rlt_order_formatted_billing_address($address, $order) { 
			$billing_fields = $this->getBillingFields();
			$imgs = array();
			foreach ($billing_fields as $billing_field) {

				$label = $this->getAdditional($billing_field->field_name);

				$key = '_'.$billing_field->field_name;
                $data = get_post_meta_wc( $order->get_ID(),$key ,false);	
                   
                foreach ($data as $ky => $value) {
                 	
					if($label->field_type=='checkbox' && $value==1) {
						echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong>' . 'Yes' . '</p>';
					} else if($label->field_type=='checkbox' && $value==0) {
						echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong>' . 'No' . '</p>';
					} else {
						if( $billing_field->field_type == 'image'&&$value!='') {
							array_push($imgs, $value);
		                	list($filename, $ext) = explode('.', $value);
		                	
		                	if($ext == 'pdf') {
		                		echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong><br>' . $address[$billing_field->field_name]  = '<a href="'.RLTKN_PLUGIN_URL .'/upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';   
		                	} else if($ext == 'doc' || $ext == 'docx') {
		                		echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong><br>' . $address[$billing_field->field_name] = '<a href="'.RLTKN_PLUGIN_URL .'/upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
		                	}else{
		                		echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong>' . $address[$billing_field->field_name] = '<img  src="'.RLTKN_PLUGIN_URL.'upload/'.$value.' " onclick="openModal(this);" class="hover-shadow" width="80" height="80"></p>';
		                	}
						} else {
							echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong>' . $address[$billing_field->field_name] = $value . '</p>';
						}					
					}
                }
			}
			return $address;	
		}

		public function getBillingFields() {
			global $wpdb;
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE type = %s AND field_mode = 'billing_additional'", 'billing'));      
            return $result;
		}

		public function rlt_order_formatted_shipping_address($address, $order) { 

			$shipping_fields = $this->getShippingFields();
			$imgs = array();
			foreach ($shipping_fields as $shipping_field) {

				$label = $this->getAdditional($shipping_field->field_name);

				$key = '_'.$shipping_field->field_name;
                $data = get_post_meta_wc( $order->get_ID(),$key ,	false);	
                foreach ($data as $ky => $value) {
					if($label->field_type=='checkbox' && $value==1) {
						echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong>' . 'Yes' . '</p>';
					} else if($label->field_type=='checkbox' && $value==0) {
						echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong>' . 'No' . '</p>';
					} else {
           				if( $shipping_field->field_type == 'image' && $value!='' ) {
							array_push($imgs, $value);
	                		list($filename, $ext) = explode('.', $value);
	                		if($ext == 'pdf'){
	                			echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong><br>' . $address[$shipping_field->field_name]  = '<a href="'.RLTKN_PLUGIN_URL .'/upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
	                		} else if($ext == 'doc' || $ext == 'docx') {
	                			echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong><br>' . $address[$shipping_field->field_name] = '<a href="'.RLTKN_PLUGIN_URL .'/upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
                        	} else {				
				         		echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong>' . $address[$shipping_field->field_name] = '<img  src="'.RLTKN_PLUGIN_URL.'/upload/'.$value.' " onclick="openModal(this);" class="hover-shadow" width="80" height="80"></p>';
							}
						} else {
							echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong>' . $address[$shipping_field->field_name] = $value . '</p>';
					 	}
					}
				}
			}
			return $address;
		}

		public function getShippingFields() {
			global $wpdb;
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE type = %s AND field_mode = %s", 'shipping', 'shipping_additional'));
            return $result;
		}

		public function rlt_my_account_my_address_formatted_address( $fields, $customer_id, $name ) {
			if($name == 'billing') {
				$billing_fields = $this->getBillingFields();
				foreach ($billing_fields as $billing_field) {
					echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong>' . get_user_meta( $customer_id, $billing_field->field_name, true ) . '</p>';
				}
			}

			if($name == 'shipping') {
				$billing_fields = $this->getShippingFields();
				foreach ($billing_fields as $billing_field) {
					echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong>' . get_user_meta( $customer_id, $billing_field->field_name, true ) . '</p>';
				}
			}

			return $fields;
		}

		public function rlt_checkout_field_order_meta_keys($keys) {
			$add_fields = $this->getAllAdditional();
			foreach ($add_fields as $add_field) {
				$keys[$add_field->field_label] = $add_field->field_label;
			}

			$add_fields = $this->getBillingFields();
			foreach ($add_fields as $add_field) {
				$keys[$add_field->field_label] = $add_field->field_name;
			}
		    return $keys;
		}

		public function rlt_custom_multiselect_handler( $field, $key, $args, $value  ) {
            $id2 = preg_replace("/[^0-9\.]/", '', $key);
		    $options = '';
		    $ekey = explode('[', $key);
		    $er = $this->getRequired($ekey[0]);
		    if($er!='') {
		    	if($er->is_required == 1) {
		    		$required = '<abbr class="required" title="required">*</abbr>';
		    	} else {
		    		$required = '';
		    	}
		    }
		    if ( ! empty( $args['options'] ) ) {
		        foreach ( $args['options'] as $option_key => $option_text ) {
		            $options .= '<option value="' . $option_key . '" '. selected( $value, $option_key, false ) . '>' . $option_text .'</option>';
		        }

		        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' '.$id2.' additional_field_'.$id2.'" id="' . $key . '_field ">
		            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'].$required.'</label>
		            <select data-attr="kjhjk"  name="' . $key . '" id="' . $key .' '.$id2 . '" class="select_'.$id2.' select" multiple="multiple">
		                ' . $options . '
		            </select>
		        </p>';
		    }

		    return $field;
		}

		public function get_fields_price() {
			global $wpdb;
            $result = $wpdb->get_results( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE ( is_hide != 1)" );
            return $result;
		}

		public function get_field_option_text($field_id, $option_value) {
			$return_array = array();
			$options = $this->getSelectOptions($field_id);
			foreach ($options as $option) {
				if($option->meta_key == $option_value) {

					array_push($return_array, $option->meta_key);
				}
			}
			return $return_array;
		}

		public function rlt_woo_add_cart_fee( $cart ) {
			// echo "<pre>";
			// print_r($_POST);
			// echo "</pre>";

	        if ( ! $_POST || ( is_admin() && ! is_ajax() ) )
	        	return;

	        $default_text_fields = array( "billing_first_name", "billing_last_name", "billing_email", "billing_company", "billing_address_1", "billing_address_2", "billing_city", "billing_state", "billing_postcode", "billing_phone", "billing_country" );

		    if ( isset( $_POST['post_data'] ) )
		        parse_str( $_POST['post_data'], $post_data );
		    else
		        $post_data = $_POST; // fallback for final checkout (non-ajax)
			
			$billing_price_fields = $this->get_fields_price();
			// echo "<pre>";
			// print_r($billing_price_fields);
			// echo "</pre>";
			$i = 0;
	    	if(!empty($billing_price_fields)) {
		    	foreach($billing_price_fields as $bprice_field) {
		    		// if($i > 1)
		    		// 	return;
		    		// $i++;
					if( isset($post_data[$bprice_field->field_name]) && $post_data[$bprice_field->field_name]!='' ) {
						// if( $bprice_field->field_type != "select" &&
						// 	$bprice_field->field_type != "radioselect" && 
						// 	$bprice_field->field_type != "multiselect" ) {
						// 	if((int)$post_data['price_'.$bprice_field->field_id] > 0) {
				  //   			WC()->cart->add_fee( 
				  //   				__(
				  //   					$bprice_field->field_label.$bprice_field->field_type,
				  //   					"rltknpfa").'('.$post_data[$bprice_field->field_name].')',
				  //   					$post_data['price_'.$bprice_field->field_id]
				  //   			);
				  //   		}
			   //  		} else
			    		


			    		if($bprice_field->field_type == "radioselect") {
			    			$option_text = 'price_'.$post_data[$bprice_field->field_name];
			    			if((int)$post_data[$option_text] > 0) {
				    			WC()->cart->add_fee( 
				    				__(
				    					$bprice_field->field_label,
				    					"rltknpfa").'('.$post_data[$bprice_field->field_name].')',
				    					$post_data[$option_text]
				    			);
				    		}
			    		} else if($bprice_field->field_type == "select") {

				    		$option_text = 'price_'.$post_data[$bprice_field->field_name][0];
				    		if( array_key_exists($option_text, $post_data) && 
				    				(int)$post_data[$option_text] > 0) {
				    			WC()->cart->add_fee( 
				    				__(
				    					$bprice_field->field_label,
				    					"rltknpfa").'('.$post_data[$bprice_field->field_name][0].')',
				    					$post_data[$option_text]
				    			);
				    		}
			    		} else if($bprice_field->field_type == "multiselect") {
			    			$option_texts = $post_data[$bprice_field->field_name];
			    			foreach($option_texts as $option_text) {
				    			if( array_key_exists('price_'.$option_text, $post_data) && 
				    				(int)$post_data['price_'.$option_text] > 0) {
					    			WC()->cart->add_fee( 
					    				__(
					    					$bprice_field->field_label,
					    					"rltknpfa").'('.$option_text.')',
					    					$post_data['price_'.$option_text]
					    			);
					    		}
					    	}
			    		} else if($bprice_field->field_type == "password") {
			    			$option_text = 'price_'.$bprice_field->field_id;
			    			if((int)$post_data[$option_text] > 0) {
				    			WC()->cart->add_fee( 
				    				__(
			    					$bprice_field->field_label,
			    					"rltknpfa"),
			    					$post_data[$option_text]
				    			);
				    		}
			    		}  else {
			    			$option_text = 'price_'.$bprice_field->field_id;
			    			if( array_key_exists($option_text, $post_data) && 
			    				(int)$post_data[$option_text] > 0) {
			    				$field_value = '';
			    				if($bprice_field->field_type != "checkbox")
			    					$field_value = '('.$post_data[$bprice_field->field_name].')';
				    			WC()->cart->add_fee( 
				    				__(
			    					$bprice_field->field_label,
			    					"rltknpfa").$field_value,
			    					$post_data[$option_text]
				    			);
				    		}
			    		}
		    		}
		    	}
			}
		}
	}

	new rlt_Checkout_Fields_Public();
}

?>