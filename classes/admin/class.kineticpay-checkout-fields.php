<?php 
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( !class_exists( 'rlt_Checkout_Fields_Admin' ) ) { 

	class rlt_Checkout_Fields_Admin extends rlt_Checkout_Fields {


		public function __construct() {
			add_action( 'wp_loaded', array( $this, 'admin_init' ) );
			$this->module_settings = $this->get_module_settings();

			add_action('wp_ajax_update_billing_sortorder', array($this, 'update_billing_sortorder')); 
			add_action('wp_ajax_insert_billing_field', array($this, 'insert_billing_field')); 
			add_action('wp_ajax_del_billing_field', array($this, 'del_billing_field'));

			add_action('wp_ajax_update_shipping_sortorder', array($this, 'update_shipping_sortorder')); 
			add_action('wp_ajax_insert_shipping_field', array($this, 'insert_shipping_field')); 
			add_action('wp_ajax_del_shipping_field', array($this, 'del_shipping_field'));

			add_action('wp_ajax_update_additional_sortorder', array($this, 'update_additional_sortorder')); 
			add_action('wp_ajax_insert_additional_field', array($this, 'insert_additional_field')); 
			add_action('wp_ajax_del_additional_field', array($this, 'del_additional_field'));
			
			add_action('wp_ajax_save_all_data1', array($this, 'save_all_data1')); 
			

			add_action( 'add_meta_boxes', array($this, 'mv_other_fields' ));
			add_filter( 'woocommerce_admin_billing_fields' , array($this, 'rlt_billing_additioanl_admin_edit' )); 
			//add_action( 'woocommerce_order_formatted_shipping_address', array($this, 'rlt_exta_shipping_fields_admin_show' ), 60, 2);
			add_filter( 'woocommerce_admin_shipping_fields' , array($this, 'rlt_shipping_additioanl_admin_edit' ));
			add_action('wp_ajax_rlt_upload_pic', array($this, 'rlt_upload_pic'));
	       	add_action('wp_ajax_nopriv_rlt_upload_pic', array($this, 'rlt_upload_pic')); 
	       
		}
		
		public function mv_other_fields() {
	        add_meta_box( 'mv_other_fields1', __('Billing Custom Files/Images','woocommerce'),array($this, 'rlt_exta_billing_fields_admin_show') ,get_current_screen(), 'advanced' );
	        add_meta_box( 'mv_other_fields2', __('Shipping Custom Files/Images','woocommerce'),array($this, 'rlt_exta_shipping_fields_admin_show') ,get_current_screen(), 'advanced' );
	         add_meta_box( 'mv_other_fields3', __('Verification Custom Fields','woocommerce'),array($this, 'rlt_exta_additional_fields_admin_show') ,get_current_screen(), 'advanced' );
	    }

		public function admin_init() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );	
		}

		public function admin_scripts() {	
			$pagenow = isset($_GET['page']) ? $_GET['page'] : '';
			if ( 'kineticpay_checkoutfields' === $pagenow ) {
	         	wp_enqueue_style( 'rltknpfa-icon-css', RLTKN_PLUGIN_URL . 'assets/admin/css/icon.css', false );
	        	wp_enqueue_style( 'rltknpfa-admin-css', RLTKN_PLUGIN_URL . 'assets/admin/css/rltknp_style.css', false );
	        	wp_enqueue_script( 'rltknpfa-ui-script', '//code.jquery.com/ui/1.11.4/jquery-ui.js' );
	        }
        }

	    public function rlt_upload_pic() {
			
			$id = ( isset( $_REQUEST["id"] ) ? $_REQUEST["id"] : false );
			$value = ( isset( $_REQUEST["ext"] ) ? $_REQUEST["ext"] : false );
			$value = explode(',', $value);
			foreach ($value as $key ) {
               
				$file = array(
					'name'     => $_FILES[$id]['name'],
					'type'     => $_FILES[$id]['type'],
					'tmp_name' => $_FILES[$id]['tmp_name'],
					'error'    => $_FILES[$id]['error'],
					'size'     => $_FILES[$id]['size']
				);
				$file_Array = explode('.', $_FILES[$id]['name']);
				$ext = end($file_Array);
				if($key == "." . $ext){
					
					if(move_uploaded_file($file['tmp_name'], RLTKN_PLUGIN_DIR.'upload/'.time().$_FILES[$id]['name'])) {
					echo time().$_FILES[$id]['name'];

				    }		
				}		
			}
			die();
		}

		public function kineticpay_checkoutfields_settings() { 

			$def_data = $this->get_module_default_settings();

			if ($_POST['rltknp_module']['billing_title'] )  {
				$output['billing_title'] = sanitize_text_field($_POST['rltknp_module']['billing_title']);
			} else {
				$output['billing_title'] = $def_data['billing_title'];
			}

			if ($_POST['rltknp_module']['shipping_title'] )  {
				$output['shipping_title'] = sanitize_text_field($_POST['rltknp_module']['shipping_title']);
			} else {
				$output['shipping_title'] = $def_data['shipping_title'];
			}

			if ($_POST['rltknp_module']['additional_title'] )  {
				$output['additional_title'] = sanitize_text_field($_POST['rltknp_module']['additional_title']);
			} else {
				$output['additional_title'] = $def_data['additional_title'];
			}

			return $output;
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


        public function get_additional_fields() {
            
             global $wpdb;
             
             $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type!='' AND type = %s ORDER BY length(sort_order), sort_order", 'additional'));      

             return $result;
        }

        function update_billing_sortorder()
		{
			global $wpdb;
			$ids 	= $_POST['ids'];
            $result_new_bfield = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type ='heading' AND type ='billing' ORDER BY field_id DESC LIMIT 1"));
            $counter = 1;
			foreach ($ids as $id) {
				
				$did = intval($id);
                if ($did == 'newfield') {
                    $did = $result_new_bfield[0]->field_id;
                }
                $wpdb->query($wpdb->prepare("UPDATE " .$wpdb->rltknp_fields." SET sort_order = %d WHERE field_id = %d",
				    $counter,
				    $did
				));
				
				$counter = $counter + 1;	
			}
		}


		function update_shipping_sortorder()
		{
			global $wpdb;
			$ids 	= $_POST['ids'];
            $result_new_field = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type ='heading' AND type ='shipping' ORDER BY field_id DESC LIMIT 1"));
			$counter = 1;
			foreach ($ids as $id) {
				$did = intval($id);
                if ($did == 'snewfield') {
                    $did = $result_new_field[0]->field_id;
                }
                $wpdb->query($wpdb->prepare("UPDATE " .$wpdb->rltknp_fields." SET sort_order = %d WHERE field_id = %d",
				    $counter,
				    $did
				));

				$counter = $counter + 1;
			}
		}


		function update_additional_sortorder()
		{
			global $wpdb;
			$ids = $_POST['ids'];
            $result_new_afield = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_type ='heading' AND type ='additional' ORDER BY field_id DESC LIMIT 1"));
            $counter = 1;
			foreach ($ids as $id) {
				$did = intval($id);
                if ($did == 'anewfield') {
                    $did = $result_new_afield[0]->field_id;
                }
                $wpdb->query($wpdb->prepare("UPDATE " .$wpdb->rltknp_fields." SET sort_order = %d WHERE field_id = %d",
				    $counter,
				    $did
				));
				$counter = $counter + 1;	
			}	
		}


		function insert_billing_field()
		{
			global $wpdb;
			
			$last1 = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->rltknp_fields'");
        	$a = ($last1->Auto_increment);
        	
        	if(isset($_POST['fieldtype']) && $_POST['fieldtype']!='') {
				$fieldtype = $_POST['fieldtype'];
			} else { 
				$fieldtype = '';
			}
			
			if(isset($_POST['type']) && $_POST['type']!='') {
				$type = $_POST['type'];
			} else { $type = ''; }
			
			if(isset($_POST['label']) && $_POST['label']!='') {
				$label = $_POST['label'];
			} else { $label = ''; }
			
			$name = 'billing_field_'.$a;

			if(isset($_POST['mode']) && $_POST['mode']!='') {
				$mode = $_POST['mode'];
				$mode;
			}
		
			if($fieldtype!='' && $type!='' && $label!='') {
				$wpdb->query($wpdb->prepare( 
		            "INSERT INTO $wpdb->rltknp_fields
		            (field_name, field_label, field_type, type, field_mode, field_price)
		            VALUES (%s, %s, %s, %s, %s, %s)
		            ",
		            $name,
		            $label,
		            $fieldtype,
		            $type,
		            $mode,
		            0
	            ) );
			}
			
			$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->rltknp_fields'");
        	echo json_encode(array("field_id" => ($last->Auto_increment)-1, "field_label" => $label));
			exit();
		}


		function insert_shipping_field()
		{
			global $wpdb;
			$last1 = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->rltknp_fields'");
        	$a = ($last1->Auto_increment);
			if(isset($_POST['fieldtype']) && $_POST['fieldtype']!='') {
				$fieldtype = $_POST['fieldtype'];
			}
			else {
			    $fieldtype = '';
			}
			if(isset($_POST['type']) && $_POST['type']!='') {
				$type = $_POST['type'];
			} else { $type = ''; }
			if(isset($_POST['label']) && $_POST['label']!='') {
				$label = $_POST['label'];
			} else { $label = ''; }
			$name = 'shipping_field_'.$a;
			if(isset($_POST['mode']) && $_POST['mode']!='') {
				$mode = $_POST['mode'];
			} else { $mode = ''; }
			if($fieldtype!='' && $type!='' && $label!='') {
				$wpdb->query($wpdb->prepare(
	            "
	            INSERT INTO $wpdb->rltknp_fields
	            (field_name, field_label, field_type, type, field_mode)
	            VALUES (%s, %s, %s, %s, %s)
	            ",
	            $name,
	            $label,
	            $fieldtype,
	            $type,
	            $mode
	            ) );
			}
			
			$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->rltknp_fields'");
        	echo json_encode(array("field_id" => ($last->Auto_increment)-1, "field_label" => $label));
			exit();
		}


		function insert_additional_field()
		{
			global $wpdb;
			$last1 = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->rltknp_fields'");
        	$a = ($last1->Auto_increment);
			if(isset($_POST['fieldtype']) && $_POST['fieldtype']!='') {
				$fieldtype = $_POST['fieldtype'];
			} else { $fieldtype = ''; }
			if(isset($_POST['type']) && $_POST['type']!='') {
				$type = $_POST['type'];
			} else { $type = ''; }
			if(isset($_POST['label']) && $_POST['label']!='') {
				$label = $_POST['label'];
			} else { $label = ''; }
			$name = 'additional_field_'.$a;
			if(isset($_POST['mode']) && $_POST['mode']!='') {
				$mode = $_POST['mode'];
			}
			if($fieldtype!='' && $type!='' && $label!='') {
				$wpdb->query($wpdb->prepare( 
	            "
	            INSERT INTO $wpdb->rltknp_fields
	            (field_name, field_label, field_type, type, field_mode)
	            VALUES (%s, %s, %s, %s, %s)
	            ",
	            $name,
	            $label, 
	            $fieldtype,
	            $type,
	            $mode
	            
	            
	            ) );
			}
			
			$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->rltknp_fields'");
        	echo json_encode(array("field_id" => ($last->Auto_increment)-1, "field_label" => $label));
			exit();
		}


		function del_billing_field()
			{
				$field_id = intval($_POST['field_id']);
				global $wpdb;
				$wpdb->query( $wpdb->prepare( "DELETE FROM ".$wpdb->rltknp_fields . " WHERE field_id = %d", $field_id ) );
				die();
				return true;
			}

		function del_shipping_field()
		{
			$field_id = intval($_POST['field_id']);
			global $wpdb;
			$wpdb->query( $wpdb->prepare( "DELETE FROM ".$wpdb->rltknp_fields . " WHERE field_id = %d", $field_id ) );
			die();
			return true;
		}

		function del_additional_field()
		{
			$field_id = intval($_POST['field_id']);
			global $wpdb;
			$wpdb->query( $wpdb->prepare( "DELETE FROM ".$wpdb->rltknp_fields . " WHERE field_id = %d", $field_id ) );
			die();
			return true;
		}

		function save_all_data1() {

			global $wpdb;
			echo "<pre>";
//			 print_r($_POST);
//			 die();
			if(isset($_POST['option_field_ids']) && $_POST['option_field_ids']!='') {
				$option_field_ids = $_POST['option_field_ids']; 			
			} else {
				$option_field_ids = array();
			}

			if(isset($_POST['option_value']) && $_POST['option_value']!='') {
				$option_value = $_POST['option_value'];	
			} else {
				$option_value = array();
			}
			
			if(isset($_POST['option_text']) && $_POST['option_text']!='') {
				$option_text = $_POST['option_text'];			
			} else {
				$option_text = array();
			}

			if(isset($_POST['option_price']) && $_POST['option_price']!='') {
				$option_price = $_POST['option_price'];			
			} else {
				$option_price = array();
			}

			if(isset($_POST['fieldids']) && $_POST['fieldids']!='') {
				$fieldids = $_POST['fieldids'];			
			} else {
				$fieldids = array();
			}

			if(isset($_POST['fieldlabel']) && $_POST['fieldlabel']!='') {
				$fieldlabel = $_POST['fieldlabel'];			
			} else {
				$fieldlabel = array();
			}
			
			if(isset($_POST['fieldplaceholder']) && $_POST['fieldplaceholder']!='') {
				$fieldplaceholder = $_POST['fieldplaceholder'];			
			}
//			else {
//				$fieldplaceholder = array();
//			}
			
			if(isset($_POST['fieldrequired']) && $_POST['fieldrequired']!='') {
				$fieldrequired = $_POST['fieldrequired'];			
			} else {
				$fieldrequired = array();
			}
			
			if(isset($_POST['fieldhidden']) && $_POST['fieldhidden']!='') {
				$fieldhidden = $_POST['fieldhidden'];			
			} else {
				$fieldhidden = array();
			}
			
			if(isset($_POST['fieldwidth']) && $_POST['fieldwidth']!='') {
				$fieldwidth = $_POST['fieldwidth'];			
			} else {
				$fieldwidth = array();
			}
			
			if(isset($_POST['fieldext']) && $_POST['fieldext']!='') {
				$fieldext = $_POST['fieldext'];
			} elseif($fieldext == '') {

			} else {
				$fieldext = array();
			}

			if(isset($_POST['fieldprice']) && $_POST['fieldprice']!='') {
				$fieldprice = $_POST['fieldprice'];			
			} else {
				$fieldprice = array();
			}

			if(isset($_POST['showif']) && $_POST['showif']!='') {
				$showif = $_POST['showif'];
			} else { $showif = array(); }

			if(isset($_POST['cfield']) && $_POST['cfield']!='') {
				$cfield = $_POST['cfield'];
			} else { $cfield = array(); }

			if(isset($_POST['ccondition']) && $_POST['ccondition']!='') {
				$ccondition = $_POST['ccondition'];
			} else { $ccondition = array(); }

			if(isset($_POST['ccondition_value']) && $_POST['ccondition_value']!='') {
				$ccondition_value = $_POST['ccondition_value'];
			} else { $ccondition_value = array(); }

			$combined_array1 = array_map(function($a, $b, $c, $d) { 
				return $a.'-_-'.$b.'-_-'.$c.'-_-'.$d; }, 
				$option_field_ids, 
				$option_value, 
				$option_text,
				$option_price
			);

			
			$wpdb->query("DELETE FROM ".$wpdb->rltknp_meta );
			if($combined_array1!='') {
				foreach ($combined_array1 as $value) {

					$data = explode('-_-', $value);

				    $wpdb->query($wpdb->prepare( 
		            "
		            INSERT INTO $wpdb->rltknp_meta
		            (field_id, meta_key, meta_value, meta_price)
		            VALUES (%s, %s, %s, %s)
		            ",
		            intval($data[0]),
		            sanitize_text_field($data[1]), 
		            sanitize_text_field($data[2]),
		            $data[3]
		            
		            ) );

				} 
			}

			$combined_array = array_map(function($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l) { return $a.'-_-'.$b.'-_-'.$c.'-_-'.$d.'-_-'.$e.'-_-'.$f.'-_-'.$g.'-_-'.$h.'-_-'.$i.'-_-'.$j.'-_-'.$k.'-_-'.$l; }, $fieldids, $fieldlabel, $fieldplaceholder, $fieldrequired, $fieldhidden, $fieldwidth, $fieldext, $fieldprice, $showif, $cfield, $ccondition, $ccondition_value);

			if($combined_array!='') {

				foreach ($combined_array as $value) {
//				    print_r($value);
//                    exit();

                    $data = explode('-_-', $value);
//                    print_r($data);
					$field_id = intval($data[0]);
					$field_label = sanitize_text_field($data[1]);
					$field_placeholder = sanitize_text_field($data[2]);
					$field_required = sanitize_text_field($data[3]);
					$field_hide = sanitize_text_field($data[4]);
					$field_width = sanitize_text_field($data[5]);
					$field_ext = sanitize_text_field($data[6]);
					$field_price = sanitize_text_field($data[7]);
					$show_if = sanitize_text_field($data[8]);
					$c_field = sanitize_text_field($data[9]);
					$c_condition = sanitize_text_field($data[10]);
					$c_condition_value = sanitize_text_field($data[11]);

					$wpdb->query($wpdb->prepare(
						"UPDATE " .$wpdb->rltknp_fields." SET field_label = %s, field_placeholder = %s,is_required = %d, is_hide = %d, width = %s ,field_extensions = %s, field_price = %s, showif = %s, cfield = %s, ccondition = %s, ccondition_value = %s WHERE field_id = %d",
					    $field_label,
					    $field_placeholder,
					    $field_required,
					    $field_hide,
					    $field_width,
					    $field_ext,
					    $field_price,
					   	$show_if,
					    $c_field,
					    $c_condition,
					    $c_condition_value,
					    $field_id
					));
					//echo $field_ext;
				}
			}


			// echo "<pre>";
	        // print_r($_POST);
	        // exit;

			die();
			return true; 
		}


		public function getOptions($id)
		{
			global $wpdb;
             
             $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_meta." WHERE field_id = %d", $id));      

             return $result;
		}

		function getBillingFields()
		{
			global $wpdb;
             
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE type = %s AND field_mode = 'billing_additional'", 'billing'));      

            return $result;
		}
      	
      	function getAdditional()
		{
			global $wpdb;

           	$result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE type = %s AND field_mode = 'additional_additional'", 'additional'));      
            return $result;
		}

       	function rlt_exta_billing_fields_admin_show($order, $feild)
		{

			$billing_fields = $this->getBillingFields();
			foreach ($billing_fields as $billing_field) {
				if( $billing_field->field_type == "image"){

                    $value = get_post_meta_wc(get_the_id(),'_'.$billing_field->field_name,true) ;
                    if($value != ''){
                        list($filename, $ext) = explode('.', $value);
                        //echo $ext;
                        if($ext == 'doc'||$ext == 'docx'||$ext == 'DOC'||$ext == 'DOCX'){
                        	?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php
                        	//echo $billing_field->field_label.'<br>';
                        	echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong><br>' . $address[$billing_field->field_name]  = '<a href="'.plugins_url('ext-checkout-fields-attributes').'upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
					//echo $billing_field->field_label.'<br>';
                        } else if($ext == 'pdf' || $ext == 'PDF'){
                        	?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php
                        	
                        	echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong><br>' . $address[$billing_field->field_name]  = '<a href="'.plugins_url('ext-checkout-fields-attributes').'upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';

                        } else{
                        	
                        	echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong><br>' . $address[$billing_field->field_name] = '<img  src="'.RLTKN_PLUGIN_URL.'upload/'.$value.' " onclick="openModal(this);" class="hover-shadow" width="80" height="80"></p>';
                 		}
             		}
             		else{
             			echo '<p class="address"><strong>' . __( $billing_field->field_label ) . ': </strong><br> no file</p>';
             		}
				}
			}
        }
				
				
			
			
		function rlt_exta_shipping_fields_admin_show($fields, $order)
		{

			$shipping_fields = $this->getShippingFields();
			
		
			foreach ($shipping_fields as $shipping_field) {
	          
				
				if( $shipping_field->field_type == "image"){
          
                       $value = get_post_meta_wc(get_the_id(),'_'.$shipping_field->field_name,true) ;
                       if($value != ''){
                        list($filename, $ext) = explode('.', $value);
                       
                        if($ext == 'doc'||$ext == 'docx'||$ext == 'DOC'||$ext == 'DOCX'){
                        	?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php
                        
                        	echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong><br>' . $address[$shipping_field->field_name]  = '<a href="'.plugins_url('ext-checkout-fields-attributes').'upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
					
                        }else if($ext == 'pdf' || $ext == 'PDF'){
                        	?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php
                        	echo $shipping_field->field_label.'<br>';
                        	echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong><br>' . $address[$shipping_field->field_name]  = '<a href="'.plugins_url('ext-checkout-fields-attributes').'upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';

                        }else{
                        	
                        	echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong><br>' . $address[$shipping_field->field_name] = '<img  src="'.RLTKN_PLUGIN_URL.'upload/'.$value.' " onclick="openModal(this);" class="hover-shadow" width="80" height="80"></p>';

                      

                 }
             }else{
                        	
                        	echo '<p class="address"><strong>' . __( $shipping_field->field_label ) . ': </strong><br> no file</p>';


                      

                 }

				}
				
			}
        }
        function rlt_exta_additional_fields_admin_show()
		{

			$additional_fields = $this->getAdditional();
			
		
			foreach ($additional_fields as $additional_field) {
				if( $additional_field->field_type != "image" && $additional_field->field_type != "" ){
				 $value = get_post_meta_wc(get_the_id(),$additional_field->field_label,true) ;
	             echo '<p class="address"><strong>' . __( $additional_field->field_label ) . ': </strong><br>' . $address[$additional_field->field_name]  = $value.'</p>';
	         }


				if( $additional_field->field_type == "image"){
                      
                       
                       $value = get_post_meta_wc(get_the_id(),$additional_field->field_label,true) ;
                      
                        if($value != ''){
                        list($filename, $ext) = explode('.', $value);
                        if($ext == 'doc'||$ext == 'docx'||$ext == 'DOC'||$ext == 'DOCX'){
                        	?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php
                        
                        	echo '<p class="address"><strong>' . __( $additional_field->field_label ) . ': </strong><br>' . $address[$additional_field->field_name]  = '<a href="'.plugins_url('ext-checkout-fields-attributes').'upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';
					
                        }else if($ext == 'pdf'||$ext == 'PDF'){
                        	?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php
                        	
                        	echo '<p class="address"><strong>' . __( $additional_field->field_label ) . ': </strong><br>' . $address[$additional_field->field_name]  = '<a href="'.plugins_url('ext-checkout-fields-attributes').'upload/download.php?name='.$value.'"><i class="fa fa-file" style="font-size:80px;color:light gray"></i></a></p>';

                        }else{
                        	
                        	echo '<p class="address"><strong>' . __( $additional_field->field_label ) . ': </strong><br>' . $address[$additional_field->field_name] = '<img  src="'.RLTKN_PLUGIN_URL.'upload/'.$value.' " onclick="openModal(this);" class="hover-shadow" width="80" height="80"></p>';

                      

                 }
             }else{
             echo '<p class="address"><strong>' . __( $additional_field->field_label ) . ': </strong><br> no file</p>';


             }

				}
				
			}
        }

		function getShippingFields()
		{
			global $wpdb;
             
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE type = %s AND field_mode = 'shipping_additional'", 'shipping'));      

            return $result;
		}


		function rlt_billing_additioanl_admin_edit( $fields ) {
			global $post;
			$order_id = $post->ID;

			$billing_fields = $this->getBillingFields();
			foreach ($billing_fields as $billing_field) {
				$value = get_post_meta_wc( $order_id , '_'.$billing_field->field_name, true);

				if($billing_field->field_type == 'select' || $billing_field->field_type == 'radioselect') {
			   		$opts = $this->getSelectOptions($billing_field->field_id);
			   		foreach ($opts as $opt) {
			   			
			   			$options[$opt->meta_key] = $opt->meta_value;
			   		}
		   		}

				if($billing_field->field_type == 'select') {
					$fields[$billing_field->field_name] = array(
						'label' => __($billing_field->field_label, 'woocommerce'),
						'show' => true ,
						'value' => $value,
						'type'	=> $billing_field->field_type,
						'options'     => $options,
						'selected' => selected( $value, $option_key )
					);
				}

				else  {
					$fields[$billing_field->field_name] = array(
						'label' => __($billing_field->field_label, 'woocommerce'),
						'show' => true ,
						'value' => $value,
					);
				}

			}
			return $fields;
		}

		
		function rlt_shipping_additioanl_admin_edit( $fields ) {
			global $post;
			$order_id = $post->ID;

				$billing_fields = $this->getShippingFields();
				foreach ($billing_fields as $billing_field) {
				$value = get_post_meta_wc( $order_id , '_'.$billing_field->field_name, true);

				if($billing_field->field_type == 'select' || $billing_field->field_type == 'radioselect') {
			   		$opts = $this->getSelectOptions($billing_field->field_id);
			   		foreach ($opts as $opt) {
			   			
			   			$options[$opt->meta_key] = $opt->meta_value;
			   		}
		   		}

				if($billing_field->field_type == 'select') {
					$fields[$billing_field->field_name] = array(
					'label' => __($billing_field->field_label, 'woocommerce'),
					'show' => true ,
					'value' => $value,
					'type'	=> $billing_field->field_type,
					'options'     => $options,
					'selected' => selected( $value, $option_key )
					);
				}
				

				else  {
					$fields[$billing_field->field_name] = array(
					'label' => __($billing_field->field_label, 'woocommerce'),
					'show' => true ,
					'value' => $value,
					
					);
				}

			}
			return $fields;
		}


		function getSelectOptions($id)
		{
			global $wpdb;
             
            $result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_meta." WHERE field_id = %d", $id));      
            return $result;

		}
	} new rlt_Checkout_Fields_Admin();
}

?>