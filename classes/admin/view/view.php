<?php
require_once RLTKN_PLUGIN_DIR . 'classes/admin/class.kineticpay-checkout-fields.php';
$manage_fields = new rlt_Checkout_Fields_Admin();

$billing_fields = $manage_fields->get_billing_fields();
$shipping_fields = $manage_fields->get_shipping_fields();
$additional_fields = $manage_fields->get_additional_fields();

$displayedPlaceholderFields = array( "text", "textarea", "datepicker", "timepicker", "image", "password", "phone", "number", "color", "countries" );



$hiddenPlaceholderFields = array( "message", "select", "radioselect", "multiselect", "checkbox" );

?>
<div class="wrap">
	<h2><?php _e('Custom Checkout Fields','kineticpaywc'); ?></h2>
	
	<ul id="info-nav">
        <li><a href="#billing-info"><span><?php echo __("Billing Information", 'kineticpaywc'); ?></span></a></li>
        <li><a href="#shipping-info"><span><?php echo __("Shipping Information", 'kineticpaywc'); ?></span></a></li>
        <li><a href="#additional-info"><span><?php echo __("Verification Information", 'kineticpaywc'); ?></span></a></li>
    </ul>
    <div id="info">
        <div id="billing-info" class="hide">

        	<div class="div.widget-liquid-left">
        		<div class="form-left">
        			<h3><?php echo __("Form Fields", 'kineticpaywc'); ?></h3>
        			<div class="shop-container" id="bdrag">
					    <ul>
					    	<!-- Text field -->
					    	<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle">
							  			<h4>Text<span class="in-widget-title"></span></h4>
							  		</div>
							  		<input type="hidden" name="fieldtype" value="text" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Text" id="label" />
							  		<input type="hidden" name="name" value="billing_text" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat" />
							  		</p>

							  		<p>
							  			<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  			<input type="checkbox" value="1" name="fieldrequired[]" class="widefat" />
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat" />
							  		</p>

							  		<p>
							  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldplaceholder[]" class="widefat" />
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Textarea field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Textarea<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="textarea" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Textarea" id="label" />
							  		<input type="hidden" name="name" value="billing_textarea" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Selectbox field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Select Box<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="select" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Select Box" id="label" />
							  		<input type="hidden" name="name" value="billing_select" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">
							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>

							  		<div class="field_wrapper">
										<div>
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
									        <a href="javascript:void(0);"  title="Add Option">
									        	<img onClick="" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/>
									        </a>
									    </div>
									</div>
							  		</p>
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" value="0" name="fieldprice[]" class="widefat">
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Multi-selectbox field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Multi Select Box<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="multiselect" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Multi Select Box" id="label" />
							  		<input type="hidden" name="name" value="billing_multi_select" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
							  		<div class="field_wrapper">
										<div>
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
									        <a href="javascript:void(0);"  title="Add Option">
									        	<img onClick="" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/>
									        </a>
									    </div>
									</div>
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" value="0" name="fieldprice[]" class="widefat">
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Checkbox field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Checkbox<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="checkbox" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Checkbox" id="label" />
							  		<input type="hidden" name="name" value="billing_checkbox" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>


							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- <?php _e('Radio Select','kineticpaywc'); ?> field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Radio Select','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="radioselect" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Radio Select','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="billing_radio_select" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
						  				<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
						  				<div class="field_wrapper">
											<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
							  				</div>
							  				<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
							  				</div>

						  				</div>
						  			</p>
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" value="0" name="fieldprice[]" class="widefat">
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- <?php _e('Date Picker','kineticpaywc'); ?> field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Date Picker','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="datepicker" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Date Picker','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="billing_date_picker" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- <?php _e('Time Picker','kineticpaywc'); ?> field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Time Picker','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="timepicker" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Time Picker','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="billing_time_picker" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                     <input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Image upload field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e("Image upload", 'kineticpaywc');?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="image" id="fieldtype" />

							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Image upload" id="label" />
							  		<input type="hidden" name="name" value="billing_image_upload" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<p><label for="placeholder"><?php _e('File Extensions(seperate by ,):','kineticpaywc'); ?></label>

							  			<input type="text" value="" name="fieldext[]" class="widefat" required>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

							  		<input type="hidden" placeholder="Option Text"  value="half" name="fieldwidth[]" />

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>

							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  	</div>
							</li>

							<!-- Heading field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Heading", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="heading" id="fieldtype" />

							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Heading" id="label" />
							  		<input type="hidden" name="name" value="billing_heading" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>

							  		<p>
							  			<input type="hidden" value="0" name="fieldrequired[]">
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="placeholder"><?php _e('Heading Type:','kineticpaywc'); ?></label>
							  			<select name="fieldplaceholder[]" class="widefat">
						  					<option value="h1">H1</option>
						  					<option value="h2">H2</option>
						  					<option value="h3">H3</option>
						  					<option value="h4">H4</option>
						  					<option value="h5">H5</option>
						  					<option value="h6">H6</option>
						  				</select>
							  		</p>
							  		<input type="hidden" value="full" name="fieldwidth[]" />

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Message only field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle">
							  			<h4>
							  				<?php echo __("Message Only", 'kineticpaywc'); ?>
							  				<span class="in-widget-title"></span>
							  			</h4>
							  		</div>
							  		<input type="hidden" name="fieldtype" value="message" id="fieldtype" />
							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Message" id="label" />
							  		<input type="hidden" name="name" value="billing_heading" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">
							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>
							  		<p>
							  			<input type="hidden" value="0" name="fieldrequired[]" />
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" class="widefat" />
							  	</div>
							</li>

							<!-- Password field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Password", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="password" id="fieldtype" />

							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Password" id="label" />
							  		<input type="hidden" name="name" value="billing_password" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Phone number field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Phone Number", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="phone" id="fieldtype" />

							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Phone" id="label" />
							  		<input type="hidden" name="name" value="billing_phone" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Number field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Number", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="number" id="fieldtype" />

							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Number" id="label" />
							  		<input type="hidden" name="name" value="billing_number" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>

							<!-- Color picker field -->
							<li id="bf" class="bf ui-state-default widget draggable">
							  	<div id="bwt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Color Picker", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="color" id="fieldtype" />

							  		<input type="hidden" name="type" value="billing" id="type" />
							  		<input type="hidden" name="label" value="Color" id="label" />
							  		<input type="hidden" name="name" value="billing_color" id="name" />
							  		<input type="hidden" name="mode" value="billing_additional" id="mode" />
							  	</div>
							  	<div id="bw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">

								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>

								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" class="widefat">
							  	</div>
							</li>
					    </ul>
					</div>
        		</div>

        		<div class="form-right">
        			<h3>Billing Form Fields</h3>
        			<div id="bfields">
        			<form method="post" action="" id="savefields" accept-charset="utf-8">
            			<ul id="sortable" class="sortable">
            				<?php foreach ($billing_fields as $billing_field) { ?>

						<li id="<?php echo $billing_field->field_id; ?>" class="ui-state-default widget">
						  	<div id="bwt<?php echo $billing_field->field_id; ?>" class="widget-top">
						  		<div class="widget-title-action">
									<a href="#available-widgets" class="widget-action"></a>
								</div>
						  		<div class="widget-title ui-sortable-handle">
						  			<h4>
						  				<?php echo $billing_field->field_label; ?>
						  				<span class="in-widget-title"></span>
						  			</h4>
						  		</div>
						  	</div>
						  	<div id="bw<?php echo $billing_field->field_id; ?>" class="widget-inside win">

						  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
						  		<input type="text" value="<?php echo $billing_field->field_label; ?>" name="fieldlabel[]" class="widefat"></p>

						  		<?php if($billing_field->field_type == 'heading' || $billing_field->field_type == 'message') { ?>
						  			<p>
						  				<input type="hidden" value="1" name="fieldrequired[]" />
						  			</p>
							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input <?php checked($billing_field->is_hide,1); ?> type="checkbox" value="1" name="fieldhidden[]" class="widefat">
							  		</p>
						  		<?php } else { ?>
						  			<p>
						  				<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
						  				<input <?php checked($billing_field->is_required,1); ?> type="checkbox" value="1" name="fieldrequired[]" class="widefat">
						  			</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input <?php checked($billing_field->is_hide,1); ?> type="checkbox" value="1" name="fieldhidden[]" class="widefat">
							  		</p>
						  		<?php } ?>


						  		<?php if(($billing_field->field_type == 'select' || $billing_field->field_type == 'multiselect') && ($billing_field->field_mode == 'billing_additional')) { ?>

						  			<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
							  		<div class="field_wrapper">
										<div style="width:100%; float:left">

									        <a href="javascript:void(0);"  title="Add Option">
									        <img style="float:right; clear:both" onClick="getdata('<?php echo $billing_field->field_id; ?>')" id="<?php echo $billing_field->field_id; ?>" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/></a>
									    </div>

											<?php
												$options = $manage_fields->getOptions($billing_field->field_id);
												$a = 1;
												foreach ($options as $option) {


											?>
									  		 <div style="width:100%; float:left" id="b<?php echo $a; ?>">
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value="<?php echo $option->meta_key; ?>"/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value="<?php echo $option->meta_value; ?>"/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value="<?php echo $option->meta_price; ?>"/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="<?php echo $billing_field->field_id; ?>"/>
									        <a href="javascript:void(0);" class="remove_bt"  title="Remove Option">
									        <img onClick="deldata('b<?php echo $a; ?>')"  class="remove_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/remove-icon.png"/></a>
									        </div>
									        <?php $a++;  } ?>

									</div>

						  		<?php } else if($billing_field->field_type == 'radioselect' && $billing_field->field_mode == 'billing_additional') { ?>

						  			<p>
						  				<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
						  				<div class="field_wrapper">
						  					<?php
												$options = $manage_fields->getOptions($billing_field->field_id);
												$a = 1;
												foreach ($options as $option) {


											?>
											<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value="<?php echo $option->meta_key; ?>"/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value="<?php echo $option->meta_value; ?>"/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value="<?php echo $option->meta_price; ?>" />
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="<?php echo $billing_field->field_id; ?>"/>
							  				</div>
							  				<?php } ?>

						  				</div>
						  			</p>

						  		<?php } else if($billing_field->field_type == 'heading') { ?>

						  			<p>
						  				<label for="placeholder"><?php _e('Heading Type:','kineticpaywc'); ?></label>
								  		<select name="fieldplaceholder[]" class="widefat">
							  				<option value="h1" <?php selected($billing_field->field_placeholder,'h1'); ?>>H1</option>
							  				<option value="h2" <?php selected($billing_field->field_placeholder,'h2'); ?>>H2</option>
							  				<option value="h3" <?php selected($billing_field->field_placeholder,'h3'); ?>>H3</option>
							  				<option value="h4" <?php selected($billing_field->field_placeholder,'h4'); ?>>H4</option>
							  				<option value="h5" <?php selected($billing_field->field_placeholder,'h5'); ?>>H5</option>
							  				<option value="h6" <?php selected($billing_field->field_placeholder,'h6'); ?>>H6</option>
							  			</select>
							  		</p>

						  		<?php }
						  			if(in_array($billing_field->field_type, $displayedPlaceholderFields)) { ?>
								  		<p>
								  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
								  			<input type="text" value="<?php echo $billing_field->field_placeholder; ?>" name="fieldplaceholder[]" class="widefat">
								  		</p>
						  		<?php } else if(in_array($billing_field->field_type, $hiddenPlaceholderFields)) { ?>
						  			<p>
							  			<input type="hidden" value="<?php echo $billing_field->field_placeholder; ?>" name="fieldplaceholder[]" class="widefat">
							  		</p>
						  		<?php } ?>

						  		<?php if($billing_field->field_type == 'image'){ ?>
						  			<p><label for="required"><?php _e('File Extensions(seperate by ,):','kineticpaywc'); ?></label>
                                    <input type="text" value="<?php echo $billing_field->field_extensions; ?>" name="fieldext[]" class="widefat" required ></p>
                                <?php }?>



						  		<?php if($billing_field->field_type == 'heading' || $billing_field->field_type == 'message') { ?>
					  				<p>
						  				<input name="fieldwidth[]" type="hidden" value="" />
						  			</p>
						  		<?php } else { ?>
							  		<p>
							  			<label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option <?php selected($billing_field->width,'full'); ?> value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option <?php selected($billing_field->width,'half'); ?> value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
						  		<?php } ?>

						  		<?php if($billing_field->field_type != 'heading' && $billing_field->field_type != 'message')
						  		// || $billing_field->field_type == 'textarea' || $billing_field->field_type == 'datepicker'  || $billing_field->field_type == 'timepicker'  || $billing_field->field_type == 'password' || $billing_field->field_type == 'image' || $billing_field->field_type == 'phone' || $billing_field->field_type == 'number' || $billing_field->field_type == 'color' || $billing_field->field_type == 'checkbox')
						  		{ ?>

						  			<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="<?php echo $billing_field->field_price; ?>" name="fieldprice[]" class="widefat">
						  			</p>

						  		<?php } ?>
						  		<p>
						  			<label for="clogic"><?php _e('Conditional Logic:','kineticpaywc'); ?></label>
							  		<div class="cd-wrapper">
							  			<div class="showf">
							  				<select name="showif[]">
							  					<option value="" <?php echo selected($billing_field->showif,''); ?>><?php _e('Select','kineticpaywc'); ?></option>
							  					<option value="Show" <?php echo selected($billing_field->showif,'Show'); ?>><?php _e('Show','kineticpaywc'); ?></option>
							  					<option value="Hide" <?php echo selected($billing_field->showif,'Hide'); ?>><?php _e('Hide','kineticpaywc'); ?></option>
							  				</select>
							  			</div>
							  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
							  			<div class="showf clshowf" id="cl">
							  				<?php
							  				global $wpdb;
								            $results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id!=%d", $billing_field->field_id));
								            ?>
								            <select name="cfield[]" class="cfields">
								            <option value=""><?php _e('Select','kineticpaywc'); ?></option>
								            <?php
								            foreach($results as $res) { ?>
												<option value="<?php echo $res->field_id; ?>" <?php echo selected($billing_field->cfield,$res->field_id); ?>><?php echo $res->field_label; ?></option>
								            <?php } ?>
								            </select>
							  			</div>
							  			<div class="showf" id="cll">
							  				<select id="cll_select" name="ccondition[]" class="cfields">
							  					<option value="" <?php echo selected($billing_field->ccondition,''); ?>><?php _e('Select','kineticpaywc'); ?></option>
							  					<option value="is_not_empty" <?php echo selected($billing_field->ccondition,'is_not_empty'); ?>><?php _e('is not empty','kineticpaywc'); ?></option>
							  					<option value="is_equal_to" <?php echo selected($billing_field->ccondition,'is_equal_to'); ?>><?php _e('is equal to','kineticpaywc'); ?></option>
							  					<option value="is_not_equal_to" <?php echo selected($billing_field->ccondition,'is_not_equal_to'); ?>><?php _e('is not equal to','kineticpaywc'); ?></option>
							  					<option value="is_checked" <?php echo selected($billing_field->ccondition,'is_checked'); ?>><?php _e('is checked','kineticpaywc'); ?></option>

							  				</select>
							  			</div>

							  			<div class="showf" id="clll">
							  				<input type="text" name="ccondition_value[]" class="clll_field" size="13" value="<?php echo $billing_field->ccondition_value; ?>">
							  			</div>
							  		</div>
							  	</p>

						  		<p>
						  			<?php if($billing_field->field_mode == 'billing_additional') { ?>
						  				<a onClick="deleteBillingDiv('<?php echo $billing_field->field_id; ?>','<?php echo $billing_field->field_label; ?>')" class="widget-control-remove" href="javascript:void(0)">Delete</a>
										|
									<?php } ?>
									<a onClick="closeBillingDiv('<?php echo $billing_field->field_id; ?>')" class="widget-control-close" href="javascript:void(0)">Close</a>
						  		</p>

						  		<input type="hidden" value="<?php echo $billing_field->field_id; ?>" name="fieldids[]" class="widefat"></p>
						  		<?php if($billing_field->field_type != 'image') { ?>
						  			<input type="hidden" value="" name="fieldext[]" class="widefat">
						  		<?php	} ?>
						  	</div>
						  </li>
						  <?php } ?>
            			</ul>
            			</form>
        			</div>

        		</div>

        	</div>

        </div>
        <!-- End Billing -->


        <div id="shipping-info" class="hide">
        	<div class="div.widget-liquid-left">
        		<div class="form-left">
        			<h3>Form Fields</h3>
        			<div class="shop-container" id="sdrag">
					    <ul>
					    	<!-- Text field -->
					    	<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Text<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="text" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Text" id="label" />
							  		<input type="hidden" name="name" value="shipping_text" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldplaceholder[]" class="widefat">
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Textarea field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Textarea<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="textarea" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Textarea" id="label" />
							  		<input type="hidden" name="name" value="shipping_textarea" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldplaceholder[]" class="widefat">
							  		</p>
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Selectbox field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Select Box<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="select" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Select Box" id="label" />
							  		<input type="hidden" name="name" value="shipping_select" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>

							  		<div class="field_wrapper">
										<div>
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
									        <a href="javascript:void(0);"  title="Add Option">
									        	<img onClick="" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/>
									        </a>
									    </div>
									</div>
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Multi-selectbox field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Multi Select Box<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="multiselect" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Multi Select Box" id="label" />
							  		<input type="hidden" name="name" value="shipping_multi_select" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
							  		<div class="field_wrapper">
										<div>
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
									        <a href="javascript:void(0);"  title="Add Option">
									        	<img onClick="" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/>
									        </a>
									    </div>
									</div>
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Checkbox field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Checkbox<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="checkbox" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Checkbox" id="label" />
							  		<input type="hidden" name="name" value="shipping_checkbox" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>


							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- <?php _e('Radio Select','kineticpaywc'); ?> field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Radio Select','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="radioselect" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Radio Select','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="shipping_radio_select" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
						  				<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
						  				<div class="field_wrapper">
											<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
							  				</div>
							  				<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
							  				</div>

						  				</div>
						  			</p>


							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- <?php _e('Date Picker','kineticpaywc'); ?> field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Date Picker','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="datepicker" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Date Picker','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="shipping_date_picker" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  			<input type="checkbox" value="1" name="fieldrequired[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldplaceholder[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- <?php _e('Time Picker','kineticpaywc'); ?> field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Time Picker','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="timepicker" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Time Picker','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="shipping_time_picker" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />  
                            		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>
							
							<!-- Image upload field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Image upload<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="image" id="fieldtype" />
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Image upload" id="label" />
							  		<input type="hidden" name="name" value="shipping_image_upload" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<p>
							  			<label for="placeholder">Extension(Seperate by ,):</label>
							  			<input type="text" value="" name="fieldext[]" class="widefat" required>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" placeholder="Option Text"  value="full" name="fieldwidth[]" />
							  		<input type="hidden" name="fieldids[]" value="half" id="fieldids" />
							  	</div>
							</li>

							<!-- Heading field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Heading", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="heading" id="fieldtype" />
							  		
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Heading" id="label" />
							  		<input type="hidden" name="name" value="shipping_heading" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">
							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>
							  		<p>
							  			<input type="hidden" value="0" name="fieldrequired[]" />
							  		</p>
							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>
							  		<p>
							  			<label for="placeholder"><?php _e('Heading Type:','kineticpaywc'); ?></label>
							  			<select name="fieldplaceholder[]" class="widefat">
						  					<option value="h1">H1</option>
						  					<option value="h2">H2</option>
						  					<option value="h3">H3</option>
						  					<option value="h4">H4</option>
						  					<option value="h5">H5</option>
						  					<option value="h6">H6</option>
						  				</select>
							  		</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" value="full" name="fieldwidth[]" />
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
<!--							  		<input type="hidden" value="" name="fieldplaceholder[]" />-->
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Message only field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Message Only", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="message" id="fieldtype" />
							  		
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Message" id="label" />
							  		<input type="hidden" name="name" value="shipping_message" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">
							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>
							  		
							  		<p>
							  			<input type="hidden" value="0" name="fieldrequired[]">
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldplaceholder[]" class="widefat">
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Password field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Password", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="password" id="fieldtype" />
							  		
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Password" id="label" />
							  		<input type="hidden" name="name" value="shipping_password" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Phone number field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Phone Number", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="phone" id="fieldtype" />
							  		
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Phone" id="label" />
							  		<input type="hidden" name="name" value="shipping_phone" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
							  		<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Number field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Number", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="number" id="fieldtype" />
							  		
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Number" id="label" />
							  		<input type="hidden" name="name" value="shipping_number" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Color picker field -->
							<li id="sf" class="bf ui-state-default widget draggable">
							  	<div id="swt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Color Picker", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="color" id="fieldtype" />
							  		
							  		<input type="hidden" name="type" value="shipping" id="type" />
							  		<input type="hidden" name="label" value="Color" id="label" />
							  		<input type="hidden" name="name" value="shipping_color" id="name" />
							  		<input type="hidden" name="mode" value="shipping_additional" id="mode" />
							  	</div>
							  	<div id="sw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		
							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
							  	
						  			<p>
						  				<label for="clogic">
							  				<?php _e('Conditional Logic:','kineticpaywc'); ?>
							  			</label>
							  			<div class="cd-wrapper">
								  			
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf" id="cl">
								  				<select name="cfield[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value=""><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13">
								  			</div>
								  		</div>
							  		</p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>
					    </ul>
					</div>
        		</div>

        		<div class="form-right">
        			<h3>Shipping Form Fields</h3>
        			<div id="bfields">
        				<form method="post" action="" id="ssavefields" accept-charset="utf-8">
            			<ul id="ssortable" class="sortable">
            				<?php foreach ($shipping_fields as $shipping_field) { ?>
						  	
							<li id="<?php echo $shipping_field->field_id; ?>" class="ui-state-default widget">
							  	<div id="swt<?php echo $shipping_field->field_id; ?>" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle">
							  			<h4>
							  				<?php echo $shipping_field->field_label; ?>
							  				<span class="in-widget-title"></span>
							  			</h4>
							  		</div>
							  	</div>
							  	<div id="sw<?php echo $shipping_field->field_id; ?>" class="widget-inside win">
							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="<?php echo $shipping_field->field_label; ?>" name="fieldlabel[]" class="widefat">
							  		</p>

							  		<?php if($shipping_field->field_type == 'heading' || $shipping_field->field_type == 'message') { ?>
							  			<p>
							  				<input type="hidden" value="1" name="fieldrequired[]" />
							  			</p>
								  		<p>
								  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
								  			<input <?php checked($shipping_field->is_hide,1); ?> type="checkbox" value="1" name="fieldhidden[]" class="widefat">
								  		</p>
							  		<?php } else { ?>
							  			<p>
							  				<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  				<input <?php checked($shipping_field->is_required,1); ?> type="checkbox" value="1" name="fieldrequired[]" class="widefat">
							  			</p>
	                                
								  		<p>
								  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
								  			<input <?php checked($shipping_field->is_hide,1); ?> type="checkbox" value="1" name="fieldhidden[]" class="widefat">
								  		</p>
							  		<?php } ?>


							  		<?php if(($shipping_field->field_type == 'select' || $shipping_field->field_type == 'multiselect') && ($shipping_field->field_mode == 'shipping_additional')) { ?>
							  		
							  			<p>
									  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
									  		<div class="field_wrapper">
												<div style="width:100%; float:left">

											        <a href="javascript:void(0);"  title="Add Option">
											        <img style="float:right; clear:both" onClick="getdata('<?php echo $shipping_field->field_id; ?>')" id="<?php echo $shipping_field->field_id; ?>" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/></a>
											    </div>

													<?php 
														$options = $manage_fields->getOptions($shipping_field->field_id);
														$a = 1;
														foreach ($options as $option) {
															

													?>
											  		 <div style="width:100%; float:left" id="b<?php echo $a; ?>">
											    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value="<?php echo $option->meta_key; ?>"/>
											    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value="<?php echo $option->meta_value; ?>"/>
											    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value="<?php echo $option->meta_price; ?>"/>
											    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="<?php echo $shipping_field->field_id; ?>"/>
											        <a href="javascript:void(0);" class="remove_bt"  title="Remove Option">
											        <img onClick="deldata('b<?php echo $a; ?>')"  class="remove_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/remove-icon.png"/></a>
											        </div>
											        <?php $a++;  } ?>
											</div>
								  		</p>
							  		<?php } else if($shipping_field->field_type == 'radioselect' && $shipping_field->field_mode == 'shipping_additional') { ?>

							  			<p>
							  				<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
							  				<div class="field_wrapper">
							  					<?php 
													$options = $manage_fields->getOptions($shipping_field->field_id);
													$a = 1;
													foreach ($options as $option) { ?>
														<div style="width:100%; float:left">
										  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value="<?php echo $option->meta_key; ?>"/>
													    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value="<?php echo $option->meta_value; ?>"/>
													    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value="<?php echo $option->meta_price; ?>" />
													    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="<?php echo $shipping_field->field_id; ?>"/>
										  				</div>
								  				<?php } ?>
								  				
							  				</div>
							  			</p>

							  		<?php } else if($shipping_field->field_type == 'heading') { ?>

							  			<p><label for="placeholder"><?php _e('Heading Type:','kineticpaywc'); ?></label>

								  		<select name="fieldplaceholder[]" class="widefat">
							  				<option  value="h1" <?php selected($shipping_field->field_placeholder,'h1'); ?>>H1</option>
							  				<option  value="h2" <?php selected($shipping_field->field_placeholder,'h2'); ?>>H2</option>
							  				<option  value="h3" <?php selected($shipping_field->field_placeholder,'h3'); ?>>H3</option>
							  				<option  value="h4" <?php selected($shipping_field->field_placeholder,'h4'); ?>>H4</option>
							  				<option  value="h5" <?php selected($shipping_field->field_placeholder,'h5'); ?>>H5</option>
							  				<option  value="h6" <?php selected($shipping_field->field_placeholder,'h6'); ?>>H6</option>

							  			</select></p>


							  		<?php }
								  		if(in_array($shipping_field->field_type, $displayedPlaceholderFields)) { ?>
									  		<p>
									  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
									  			<input type="text" value="<?php echo $shipping_field->field_placeholder; ?>" name="fieldplaceholder[]" class="widefat">
									  		</p>
							  		<?php } else if(in_array($shipping_field->field_type, $hiddenPlaceholderFields)) { ?>
								  			<p>
									  			<input type="hidden" value="<?php echo $shipping_field->field_placeholder; ?>" name="fieldplaceholder[]" class="widefat">
									  		</p>
							  		<?php } ?>

							  		<?php if($shipping_field->field_type == 'image') { ?>
							  			 <p><label for="required"><?php _e('File Extensions(seperate by ,):','kineticpaywc'); ?></label>
	                                    <input type="text" value="<?php echo $shipping_field->field_extensions; ?>" name="fieldext[]" class="widefat" required ></p>
	                                <?php }?>

							  		<?php if($shipping_field->field_type == 'heading' || $shipping_field->field_type == 'message') { ?>
						  				<p>
							  				<input name="fieldwidth[]" type="hidden" value="" />
							  			</p>
							  		<?php } else { ?>
								  		<p>
								  			<label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label> 
								  			<select name="fieldwidth[]" class="widefat">
								  				<option <?php selected($shipping_field->width,'full'); ?> value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
								  				<option <?php selected($shipping_field->width,'half'); ?> value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
								  			</select>
								  		</p>

							  		<?php } if($shipping_field->field_type != 'heading' && $shipping_field->field_type != 'message') { ?>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="<?php echo $shipping_field->field_price; ?>" name="fieldprice[]" class="widefat">
						  			</p>
						  			<?php } ?>

						  			<p>
							  			<label for="clogic"><?php _e('Conditional Logic:','kineticpaywc'); ?></label>
								  		<div class="cd-wrapper">
								  			<div class="showf">
								  				<select name="showif[]">
								  					<option value="" <?php echo selected($shipping_field->showif,''); ?>><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="Show" <?php echo selected($shipping_field->showif,'Show'); ?>><?php _e('Show','kineticpaywc'); ?></option>
								  					<option value="Hide" <?php echo selected($shipping_field->showif,'Hide'); ?>><?php _e('Hide','kineticpaywc'); ?></option>
								  				</select>
								  			</div>
								  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
								  			<div class="showf clshowf" id="cl">
								  				<?php 
								  				global $wpdb;
									            $results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id!=%d", $shipping_field->field_id));      
									            ?>
									            <select name="cfield[]" class="cfields">
									            <option value=""><?php _e('Select','kineticpaywc'); ?></option>
									            <?php 
									            foreach($results as $res) { ?>
													<option value="<?php echo $res->field_id; ?>" <?php echo selected($shipping_field->cfield,$res->field_id); ?>><?php echo $res->field_label; ?></option>
									            <?php } ?>
									            </select>
								  			</div>
								  			<div class="showf" id="cll">
								  				<select id="cll_select" name="ccondition[]" class="cfields">
								  					<option value="" <?php echo selected($shipping_field->ccondition,''); ?>><?php _e('Select','kineticpaywc'); ?></option>
								  					<option value="is_not_empty" <?php echo selected($shipping_field->ccondition,'is_not_empty'); ?>><?php _e('is not empty','kineticpaywc'); ?></option>
								  					<option value="is_equal_to" <?php echo selected($shipping_field->ccondition,'is_equal_to'); ?>><?php _e('is equal to','kineticpaywc'); ?></option>
								  					<option value="is_not_equal_to" <?php echo selected($shipping_field->ccondition,'is_not_equal_to'); ?>><?php _e('is not equal to','kineticpaywc'); ?></option>
								  					<option value="is_checked" <?php echo selected($shipping_field->ccondition,'is_checked'); ?>><?php _e('is checked','kineticpaywc'); ?></option>
								  					
								  				</select>
								  			</div>

								  			<div class="showf" id="clll">
								  				<input type="text" name="ccondition_value[]" class="clll_field" size="13" value="<?php echo $shipping_field->ccondition_value; ?>">
								  			</div>
								  		</div>
								  	</p>
							  		<p>
							  			<?php if($shipping_field->field_mode == 'shipping_additional') { ?>
							  			<a onClick="deleteBillingDiv('<?php echo $shipping_field->field_id; ?>','<?php echo $shipping_field->field_label; ?>')" class="widget-control-remove" href="javascript:void(0)">Delete</a>
											|
										<?php } ?>
										<a onClick="closeShippingDiv('<?php echo $shipping_field->field_id; ?>')" class="widget-control-close" href="javascript:void(0)">Close</a>
							  		</p>

							  		<input type="hidden" value="<?php echo $shipping_field->field_id; ?>" name="fieldids[]" class="widefat"></p>
							  		<?php if($shipping_field->field_type != 'image'){ ?>
							  			<input type="hidden" value="" name="fieldext[]" class="widefat">
							  		<?php	} ?>
							  	</div>
							</li>
						  <?php } ?>
            			</ul>
            			</form>
        			</div>
        			
        		</div>
        	</div>
        </div>
        <!-- End Shipping -->


        <!-- Additional fields -->
        <div id="additional-info" class="hide">
        	<div class="div.widget-liquid-left">
        		<div class="form-left">
        			<h3>Form Fields</h3>
        			<div class="shop-container" id="adrag">
					    <ul>
					    	<!-- Text field -->
					    	<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Text<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="text" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Text" id="label" />
							  		<input type="hidden" name="name" value="additional_text" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Textarea field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Textarea<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="textarea" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Textarea" id="label" />
							  		<input type="hidden" name="name" value="additional_textarea" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  			<input type="checkbox" value="1" name="fieldrequired[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldplaceholder[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Select box field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Select Box<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="select" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Select Box" id="label" />
							  		<input type="hidden" name="name" value="additional_select" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>

							  		<div class="field_wrapper">
										<div>
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
									        <a href="javascript:void(0);"  title="Add Option">
									        <img onClick="" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/></a>
									    </div>
									</div>


							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Multiselect box field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Multi Select Box<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="multiselect" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Multi Select Box" id="label" />
							  		<input type="hidden" name="name" value="additional_multi_select" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
							  		<div class="field_wrapper">
										<div>
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
									        <a href="javascript:void(0);"  title="Add Option">
									        <img onClick="" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/></a>
									    </div>
									</div>
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Checkbox field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Checkbox<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="checkbox" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Checkbox" id="label" />
							  		<input type="hidden" name="name" value="additional_checkbox" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">
							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  			<input type="checkbox" value="1" name="fieldrequired[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<p><input type="hidden" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- <?php _e('Radio Select','kineticpaywc'); ?> field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Radio Select','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="radioselect" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Radio Select','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="additional_radio_select" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p>
						  				<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
						  				<div class="field_wrapper">
											<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
							  				</div>
							  				<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value=""/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value=""/>
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value=""/>
							  				</div>
						  				</div>
						  			</p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<p>
							  			<input type="hidden" value="" name="fieldplaceholder[]" class="widefat">
							  		</p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- <?php _e('Date Picker','kineticpaywc'); ?> field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Date Picker','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="datepicker" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Date Picker','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="additional_date_picker" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- <?php _e('Time Picker','kineticpaywc'); ?> field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php _e('Time Picker','kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="timepicker" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="<?php _e('Time Picker','kineticpaywc'); ?>" id="label" />
							  		<input type="hidden" name="name" value="additional_time_picker" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Upload image field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4>Image upload<span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="image" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Image upload" id="label" />
							  		<input type="hidden" name="name" value="additional_image_upload" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>
							  		<p>
							  			<label for="placeholder">Extension(Seperate by ,):</label>
							  			<input type="text" value="" name="fieldext[]" class="widefat" required>
							  		</p>
							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
							  		<input type="hidden" placeholder="Option Text"  value="half" name="fieldwidth[]" />

							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  	</div>
							</li>

							<!-- Heading field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle">
							  			<h4><?php echo __("Heading", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4>
							  		</div>
							  		<input type="hidden" name="fieldtype" value="heading" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Heading" id="label" />
							  		<input type="hidden" name="name" value="additional_heading" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>

							  		<p>
							  			<input type="hidden" value="0" name="fieldrequired[]" />
							  		</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>

							  		<p>
							  			<label for="placeholder"><?php _e('Heading Type:','kineticpaywc'); ?></label>
							  			<select name="fieldplaceholder[]" class="widefat">
						  					<option value="h1">H1</option>
						  					<option value="h2">H2</option>
						  					<option value="h3">H3</option>
						  					<option value="h4">H4</option>
						  					<option value="h5">H5</option>
						  					<option value="h6">H6</option>
						  				</select>
							  		</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<input type="hidden" value="full" name="fieldwidth[]" />
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Message only field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Message Only", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="message" id="fieldtype" />

							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Message" id="label" />
							  		<input type="hidden" name="name" value="additional_message" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">
							  		<p>
							  			<label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  			<input type="text" value="" name="fieldlabel[]" class="widefat">
							  		</p>
							  		<p>
							  			<input type="hidden" value="0" name="fieldrequired[]" />
							  		</p>
							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input  type="checkbox" value="1" name="fieldhide[]" class="widefat">
							  		</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldplaceholder[]" class="widefat">
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Password field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Password", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="password" id="fieldtype" />

							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Password" id="label" />
							  		<input type="hidden" name="name" value="additional_password" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>

                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Phone number field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Phone Number", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="phone" id="fieldtype" />

							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Phone" id="label" />
							  		<input type="hidden" name="name" value="additional_phone" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Number field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Number", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="number" id="fieldtype" />

							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Number" id="label" />
							  		<input type="hidden" name="name" value="additional_number" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

							<!-- Color picker field -->
							<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle"><h4><?php echo __("Color Picker", 'kineticpaywc'); ?><span class="in-widget-title"></span></h4></div>
							  		<input type="hidden" name="fieldtype" value="color" id="fieldtype" />

							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Color" id="label" />
							  		<input type="hidden" name="name" value="additional_color" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>

							  		<p>
						  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
						  				<input type="text" value="" name="fieldprice[]" class="widefat">
						  			</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
							  		<input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>

					    	<!-- Countries field -->
					    	<li id="af" class="bf ui-state-default widget draggable">
							  	<div id="awt" class="widget-top">
							  		<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
							  		<div class="widget-title ui-sortable-handle">
							  			<h4>
							  				Countries<span class="in-widget-title"></span>
							  			</h4>
							  		</div>
							  		<input type="hidden" name="fieldtype" value="countries" id="fieldtype" />
							  		<input type="hidden" name="type" value="additional" id="type" />
							  		<input type="hidden" name="label" value="Country" id="label" />
							  		<input type="hidden" name="name" value="additional_country" id="name" />
							  		<input type="hidden" name="mode" value="additional_additional" id="mode" />
							  	</div>
							  	<div id="aw" class="widget-inside win">

							  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldlabel[]" class="widefat"></p>

							  		<p><label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
							  		<input type="checkbox" value="1" name="fieldrequired[]" class="widefat"></p>

							  		<p><label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  		<input  type="checkbox" value="1" name="fieldhide[]" class="widefat"></p>

							  		<p><label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
							  		<input type="text" value="" name="fieldplaceholder[]" class="widefat"></p>

							  		<p><label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option  value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option  value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
                                    <p>
                                        <label for="clogic">
                                            <?php _e('Conditional Logic:','kineticpaywc'); ?>
                                        </label>
                                    <div class="cd-wrapper">

                                        <div class="showf">
                                            <select name="showif[]">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="Show"><?php _e('Show','kineticpaywc'); ?></option>
                                                <option value="Hide"><?php _e('Hide','kineticpaywc'); ?></option>
                                            </select>
                                        </div>
                                        <div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
                                        <div class="showf" id="cl">
                                            <select name="cfield[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>

                                            </select>
                                        </div>
                                        <div class="showf" id="cll">
                                            <select id="cll_select" name="ccondition[]" class="cfields">
                                                <option value=""><?php _e('Select','kineticpaywc'); ?></option>
                                                <option value="is_not_empty"><?php _e('is not empty','kineticpaywc'); ?></option>
                                                <option value="is_equal_to"><?php _e('is equal to','kineticpaywc'); ?></option>
                                                <option value="is_not_equal_to"><?php _e('is not equal to','kineticpaywc'); ?></option>
                                                <option value="is_checked"><?php _e('is checked','kineticpaywc'); ?></option>

                                            </select>
                                        </div>

                                        <div class="showf" id="clll">
                                            <input type="text" name="ccondition_value[]" class="clll_field" size="13">
                                        </div>
                                    </div>
                                    </p>
							  		<p id="textapp"></p>
							  		<input type="hidden" name="fieldids[]" value="" id="fieldids" />
                                    <input type="hidden" value="" name="fieldext[]" />
							  	</div>
							</li>
					    </ul>
					</div>
        		</div>

        		<div class="form-right">
        			<h3><?php _e('Verification Form Fields','kineticpaywc'); ?></h3>
        			<div id="afields">
        				<form method="post" action="" id="asavefields" accept-charset="utf-8">
            			<ul id="asortable" class="sortable">
            				<?php foreach ($additional_fields as $additional_field) { ?>

						  	<li id="<?php echo $additional_field->field_id; ?>" class="ui-state-default widget">
						  		<div id="awt<?php echo $additional_field->field_id; ?>" class="widget-top">
						  			<div class="widget-title-action">
										<a href="#available-widgets" class="widget-action"></a>
									</div>
						  			<div class="widget-title ui-sortable-handle">
						  				<h4><?php echo $additional_field->field_label; ?><span class="in-widget-title"></span></h4>
						  			</div>
						  		</div>

						  		<div id="aw<?php echo $additional_field->field_id; ?>" class="widget-inside win">

						  		<p><label for="label"><?php _e('Label:','kineticpaywc'); ?></label>
						  		<input type="text" value="<?php echo $additional_field->field_label; ?>" name="fieldlabel[]" class="widefat"></p>

						  		<?php if($additional_field->field_type == 'heading' || $additional_field->field_type == 'message') { ?>
						  			<p>
						  				<input type="hidden" value="1" name="fieldrequired[]" />
						  			</p>
							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input <?php checked($additional_field->is_hide,1); ?> type="checkbox" value="1" name="fieldhidden[]" class="widefat">
							  		</p>
						  		<?php } else { ?>
						  			<p>
						  				<label for="required"><?php _e('Required:','kineticpaywc'); ?></label>
						  				<input <?php checked($additional_field->is_required,1); ?> type="checkbox" value="1" name="fieldrequired[]" class="widefat">
						  			</p>

							  		<p>
							  			<label for="hide"><?php _e('Hide:','kineticpaywc'); ?></label>
							  			<input <?php checked($additional_field->is_hide,1); ?> type="checkbox" value="1" name="fieldhidden[]" class="widefat">
							  		</p>
						  		<?php } ?>


						  		<?php if(($additional_field->field_type == 'select' || $additional_field->field_type == 'multiselect') && ($additional_field->field_mode == 'additional_additional')) { ?>

						  			<p>
							  		<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
							  		<div class="field_wrapper">
										<div style="width:100%; float:left">

									        <a href="javascript:void(0);"  title="Add Option">
									        <img style="float:right; clear:both" onClick="getdata('<?php echo $additional_field->field_id; ?>')" id="<?php echo $additional_field->field_id; ?>" class="add_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/admin/images/add-icon.png"/></a>
									    </div>

											<?php
												$options = $manage_fields->getOptions($additional_field->field_id);
												$a = 1;
												foreach ($options as $option) {
											?>
									  		 <div style="width:100%; float:left" id="b<?php echo $a; ?>">
									    	<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value="<?php echo $option->meta_key; ?>"/>
									    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value="<?php echo $option->meta_value; ?>"/>
									    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value="<?php echo $option->meta_price; ?>"/>
									    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="<?php echo $additional_field->field_id; ?>"/>
									        <a href="javascript:void(0);" class="remove_bt"  title="Remove Option">
									        <img onClick="deldata('b<?php echo $a; ?>')"  class="remove_button" src="<?php echo RLTKN_PLUGIN_URL; ?>assets/assets/admin/images/remove-icon.png"/></a>
									        </div>
									        <?php $a++;  } ?>

									</div>
						  		<?php } else if($additional_field->field_type == 'radioselect' && $additional_field->field_mode == 'additional_additional') { ?>

						  			<p>
						  				<label for="options"><?php _e('Options:','kineticpaywc'); ?></label>
						  				<div class="field_wrapper">
						  					<?php
												$options = $manage_fields->getOptions($additional_field->field_id);
												$a = 1;
												foreach ($options as $option) {
											?>
											<div style="width:100%; float:left">
							  					<input class="opval" placeholder="Option Value" type="text" name="option_value[]" value="<?php echo $option->meta_key; ?>"/>
										    	<input class="opval" placeholder="Option Text" type="text" name="option_text[]" value="<?php echo $option->meta_value; ?>"/>
										    	<input class="opval" placeholder="Option Price" type="text" name="option_price[]" value="<?php echo $option->meta_price; ?>" />
										    	<input id="option_field_ids" class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="<?php echo $additional_field->field_id; ?>"/>
							  				</div>
							  				<?php } ?>

						  				</div>
						  			</p>

						  		<?php } else if($additional_field->field_type == 'heading') { ?>

						  			<p><label for="placeholder"><?php _e('Heading Type:','kineticpaywc'); ?></label>

							  		<select name="fieldplaceholder[]" class="widefat">
						  				<option  value="h1" <?php selected($additional_field->field_placeholder,'h1'); ?>>H1</option>
						  				<option  value="h2" <?php selected($additional_field->field_placeholder,'h2'); ?>>H2</option>
						  				<option  value="h3" <?php selected($additional_field->field_placeholder,'h3'); ?>>H3</option>
						  				<option  value="h4" <?php selected($additional_field->field_placeholder,'h4'); ?>>H4</option>
						  				<option  value="h5" <?php selected($additional_field->field_placeholder,'h5'); ?>>H5</option>
						  				<option  value="h6" <?php selected($additional_field->field_placeholder,'h6'); ?>>H6</option>

						  			</select></p>


						  		<?php }
							  		if(in_array($additional_field->field_type, $displayedPlaceholderFields)) { ?>
								  		<p>
								  			<label for="placeholder"><?php _e('Placeholder:','kineticpaywc'); ?></label>
								  			<input type="text" value="<?php echo $additional_field->field_placeholder; ?>" name="fieldplaceholder[]" class="widefat">
								  		</p>
						  		<?php } else if(in_array($additional_field->field_type, $hiddenPlaceholderFields)) { ?>
							  			<p>
								  			<input type="hidden" value="<?php echo $additional_field->field_placeholder; ?>" name="fieldplaceholder[]" class="widefat">
								  		</p>
						  		<?php } ?>

						  		<?php if($additional_field->field_type == 'image'){ ?>
						  			 <p><label for="required"><?php _e('File Extensions(seperate by ,):','kineticpaywc'); ?></label>
                                    <input type="text" value="<?php echo $additional_field->field_extensions; ?>" name="fieldext[]" class="widefat" required ></p>
                                <?php }?>

						  		<?php if($additional_field->field_type == 'heading' || $additional_field->field_type == 'message') { ?>
					  				<p>
						  				<input name="fieldwidth[]" type="hidden" value="" />
						  			</p>
						  		<?php } else { ?>
							  		<p>
							  			<label for="width"><?php _e('Field Width:','kineticpaywc'); ?></label>
							  			<select name="fieldwidth[]" class="widefat">
							  				<option <?php selected($additional_field->width,'full'); ?> value="full"><?php _e('Full Width','kineticpaywc'); ?></option>
							  				<option <?php selected($additional_field->width,'half'); ?> value="half"><?php _e('Half Width','kineticpaywc'); ?></option>
							  			</select>
							  		</p>
						  		<?php } ?>

						  		<?php if($additional_field->field_type != 'heading' && $additional_field->field_type != 'message') { ?>
					  			<p>
					  				<label for="placeholder"><?php echo __("Price:", 'kineticpaywc'); ?></label>
					  				<input type="text" value="<?php echo $additional_field->field_price; ?>" name="fieldprice[]" class="widefat">
					  			</p>
					  			<?php } ?>

					  			<p>
							  		<label for="clogic"><?php _e('Conditional Logic:','kineticpaywc'); ?></label>
							  		<div class="cd-wrapper">
							  			<div class="showf">
							  				<select name="showif[]">
							  					<option value="" <?php echo selected($additional_field->showif,''); ?>><?php _e('Select','kineticpaywc'); ?></option>
							  					<option value="Show" <?php echo selected($additional_field->showif,'Show'); ?>><?php _e('Show','kineticpaywc'); ?></option>
							  					<option value="Hide" <?php echo selected($additional_field->showif,'Hide'); ?>><?php _e('Hide','kineticpaywc'); ?></option>
							  				</select>
							  			</div>
							  			<div class="showf_text"><?php _e('if value of','kineticpaywc'); ?></div>
							  			<div class="showf clshowf" id="cl">
							  				<?php
							  				global $wpdb;
								            $results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->rltknp_fields." WHERE field_id!=%d", $additional_field->field_id));
								            ?>
								            <select name="cfield[]" class="cfields">
								            <option value=""><?php _e('Select','kineticpaywc'); ?></option>
								            <?php
								            foreach($results as $res) { ?>
												<option value="<?php echo $res->field_id; ?>" <?php echo selected($additional_field->cfield,$res->field_id); ?>><?php echo $res->field_label; ?></option>
								            <?php } ?>
								            </select>
							  			</div>
							  			<div class="showf" id="cll">
							  				<select id="cll_select" name="ccondition[]" class="cfields">
							  					<option value="" <?php echo selected($additional_field->ccondition,''); ?>><?php _e('Select','kineticpaywc'); ?></option>
							  					<option value="is_not_empty" <?php echo selected($additional_field->ccondition,'is_not_empty'); ?>><?php _e('is not empty','kineticpaywc'); ?></option>
							  					<option value="is_equal_to" <?php echo selected($additional_field->ccondition,'is_equal_to'); ?>><?php _e('is equal to','kineticpaywc'); ?></option>
							  					<option value="is_not_equal_to" <?php echo selected($additional_field->ccondition,'is_not_equal_to'); ?>><?php _e('is not equal to','kineticpaywc'); ?></option>
							  					<option value="is_checked" <?php echo selected($additional_field->ccondition,'is_checked'); ?>><?php _e('is checked','kineticpaywc'); ?></option>

							  				</select>
							  			</div>

							  			<div class="showf" id="clll">
							  				<input type="text" name="ccondition_value[]" class="clll_field" size="13" value="<?php echo $additional_field->ccondition_value; ?>">
							  			</div>
							  		</div>
							  	</p>
						  		<p>
						  			<?php if ($additional_field->field_mode == 'additional_additional' && $additional_field->field_label !== 'Identification Card' ) { ?>
						  			<a onClick="deleteBillingDiv('<?php echo $additional_field->field_id; ?>','<?php echo $additional_field->field_label; ?>')" class="widget-control-remove" href="javascript:void(0)">Delete</a>
										|
									<?php } ?>
									<a onClick="closeAdditionalDiv('<?php echo $additional_field->field_id; ?>')" class="widget-control-close" href="javascript:void(0)">Close</a>
						  		</p>

						  		<input type="hidden" value="<?php echo $additional_field->field_id; ?>" name="fieldids[]" class="widefat"></p>
						  		<?php if($additional_field->field_type != 'image'){ ?>
						  			<input type="hidden" value="" name="fieldext[]" class="widefat">
						  		<?php	} ?>
						  	</div>
						  </li>
						  <?php } ?>
            			</ul>
            			</form>
        			</div>

        		</div>

        	</div>


        </div>
        <!-- End Additional-->
    </div>

    <div class="savebt">
		<input type="button" onClick="savedata()" value="Save Changes" class="button button-primary widget-control-save right" id="widget-archives-2-savewidget" name="savewidget">
		<span class="spinner"></span>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
	  $( '#info #shipping-info' ).hide();
	  $( '#info #additional-info' ).hide();
	  
	  $('#info-nav li').click(function(e) {
	    $('#info .hide').hide();
	    $('#info-nav .current').removeClass("current");
	    $(this).addClass('current');
	    
	    var clicked = $(this).find('a:first').attr('href');
	    $('#info ' + clicked).fadeIn('fast');
	    e.preventDefault();
	  }).eq(0).addClass('current');
	});
</script>


<script>
	jQuery(document).ready(function($){
        
		$( "#sortable" ).sortable({ revert: true, update: function( event, ui ) {

			var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
			var order = $(this).sortable('toArray');
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: ajaxurl, // Including ajax file
				data: {"action": "update_billing_sortorder","ids":order}, // Sending data dname to post_word_count function.
				success: function(data){ 

				}
			});                                                            
		}});

        $( "#bdrag .draggable" ).draggable({ 
            connectToSortable: "#sortable",
            helper: "clone",
            revert: "invalid",

            stop: function(event, ui) {

            	$("#sortable .draggable").attr( "style", "" );
            	$("#sortable .draggable").attr( "id", "newfield" );

            	$('#newfield #bf').removeClass('ui-state-default widget').addClass('ui-state-default widget open');
			    $("#newfield  #bw").slideDown('slow');
            	$('#newfield #bwt').toggle(function(){
			       $('#newfield #bf').removeClass('ui-state-default widget').addClass('ui-state-default widget open');
			       $("#newfield  #bw").slideDown('slow');
			   	},function(){
			   		$('#newfield  #bf').removeClass('ui-state-default widget open').addClass('ui-state-default widget');
			       	$("#newfield  #bw").slideUp('slow');
			   	});

            	var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
				var fieldtype = $("#newfield #fieldtype").val();
				var type = $("#newfield #type").val();

				var label = $("#newfield #label").val();
				var name = $("#newfield #name").val();
				var extensions = $("#newfield #extensions").val();
				var mode = $("#newfield #mode").val();
				jQuery.ajax({
					type: 'POST',   // Adding Post method
					url: ajaxurl, // Including ajax file
					data: {"action": "insert_billing_field","fieldtype":fieldtype,"type":type,"label":label,"name":name,"mode":mode ,"extensions":extensions}, // Sending data dname to post_word_count function.
					dataType: 'json',
					beforeSend: function(){

					},
					success: function(data) {

	                  	// console.log(data);
						if($("#sortable .draggable").attr( "id" ) == 'newfield') {
							$('#sortable #newfield').attr( 'id', data.field_id );
						}
						$('#sortable #'+data.field_id).attr('class', '');
						$('#sortable #'+data.field_id).attr('class', 'ui-state-default widget ui-sortable-handle');
						$('#sortable #'+data.field_id+' #textapp').html('');
						$('#sortable #'+data.field_id+' #textapp').append("<a class='widget-control-remove' href='javascript:void(0)'>Delete</a> | <a onClick='closeBillingDiv("+data.field_id+")' class='widget-control-close' href='javascript:void(0)'>Close</a>");
						$('#sortable #'+data.field_id+' #textapp').find("a")[0].
							addEventListener("click", function() {
								deleteBillingDiv(data.field_id , "'"+data.field_label+"'");
							});
						$('#sortable #'+data.field_id+' #bwt').attr('id','bwt'+data.field_id);
						$('#sortable #'+data.field_id+' #bw').attr('id','bw'+data.field_id);
						$('#sortable #'+data.field_id+' img').attr('id','bi'+data.field_id);
						$('#sortable #'+data.field_id+' img').attr('onClick','getdata('+data.field_id+')');
						$('#sortable #'+data.field_id+' #option_field_ids').val(data.field_id);
						$('#sortable #'+data.field_id+' #fieldids').val(data.field_id);

// 						$('#bwt'+data.field_id).toggle(function(){
// 					       $('#'+data.field_id).removeClass('ui-state-default widget').addClass('ui-state-default widget open');
// 					       $("#bw"+data.field_id).slideDown('slow');
// 					   	},function(){
// 					   		$('#'+data.field_id).removeClass('ui-state-default widget open').addClass('ui-state-default widget');
// 					       	$("#bw"+data.field_id).slideUp('slow');
// 					   	});
					   	
jQuery("#bw"+data.field_id).slideDown('slow');
						jQuery("#bwt"+data.field_id).show();
// alert(data.field_id)
					jQuery('body').on('click','#bwt'+data.field_id ,function(){
// 						alert(data.field_id)
						if(jQuery(this).next().is(":hidden")){
// 							alert('yes')
							jQuery(this).next().show();
						}else{
// 							alert('no')
							jQuery(this).next().hide();
						}						
					});
					}
				});
		    }
        });
    });


	jQuery(document).ready(function($){ 
	  	<?php foreach ($billing_fields as $billing_field) { ?>
	   jQuery('body').on('click','#bwt<?php echo filter_var($billing_field->field_id); ?>' ,function(){
				var x = document.getElementById('bw<?php echo filter_var($billing_field->field_id); ?>');
				if (x.style.display === "" || x.style.display=='none') {
					x.style.display = "block";
				} else if(x.style.display==='block') {
					x.style.display = "none";
				} 
			});

	   	<?php } ?>
	});

	function deleteBillingDiv(field_id, field_label) { 
		// alert(field_label);
		// return;
		var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
		if(confirm("Are you sure to delete "+field_label+" field?")) {
				jQuery.ajax({
					type: "POST",
					url: ajaxurl,
					data: {"action": "del_billing_field", "field_id":field_id},
					success: function() {
						jQuery("#"+field_id).fadeOut('slow');
						jQuery("#"+field_id).remove();
					}
				});

		}
		return false;
	}

	function closeBillingDiv(field_id) { 

		jQuery('#'+field_id).removeClass('ui-state-default widget open').addClass('ui-state-default widget');
	    jQuery("#bw"+field_id).slideUp('slow');
	}

	//End Billing



	jQuery(document).ready(function($){
        
		$( "#ssortable" ).sortable({ revert: true, update: function( event, ui ) {

			var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
			var order = $(this).sortable('toArray');
			console.log(order);
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: ajaxurl, // Including ajax file
				data: {"action": "update_shipping_sortorder","ids":order}, // Sending data dname to post_word_count function.
				success: function(data){
				    // console.log(data);
				}
			});
		}});

			

        $( "#sdrag .draggable" ).draggable({ 
            connectToSortable: "#ssortable",
            helper: "clone",
            revert: "invalid",

            stop: function(event, ui) { 
            	$("#ssortable .draggable").attr( "style", "" );
            	$("#ssortable .draggable").attr( "id", "snewfield" );

            	$('#snewfield #sf').removeClass('ui-state-default widget').addClass('ui-state-default widget open');
			    $("#snewfield  #sw").slideDown('slow');
            	$('#snewfield #swt').toggle(function(){
			       $('#snewfield #sf').removeClass('ui-state-default widget').addClass('ui-state-default widget open');
			       $("#snewfield  #sw").slideDown('slow');
			   	},function(){
			   		$('#snewfield  #sf').removeClass('ui-state-default widget open').addClass('ui-state-default widget');
			       	$("#snewfield  #sw").slideUp('slow');
			   	});

            	var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
				var fieldtype = $("#snewfield #fieldtype").val();
				var type = $("#snewfield #type").val();
				var label = $("#snewfield #label").val();
				var name = $("#snewfield #name").val();
				var mode = $("#snewfield #mode").val();
				jQuery.ajax({
					type: 'POST',   // Adding Post method
					url: ajaxurl, // Including ajax file
					data: {"action": "insert_shipping_field","fieldtype":fieldtype,"type":type,"label":label,"name":name,"mode":mode}, // Sending data dname to post_word_count function.
					dataType: 'json',
					success: function(data) {

						if($("#ssortable .draggable").attr( "id" ) == 'snewfield') {
							$('#ssortable #snewfield').attr( 'id', data.field_id );
						}
						$('#ssortable #'+data.field_id).attr('class', '');
						$('#ssortable #'+data.field_id).attr('class', 'ui-state-default widget ui-sortable-handle');
						$('#ssortable #'+data.field_id+' #textapp').html('');
						$('#ssortable #'+data.field_id+' #textapp').append("<a  class='widget-control-remove' href='javascript:void(0)'>Delete</a> | <a onClick='closeBillingDiv("+data.field_id+")' class='widget-control-close' href='javascript:void(0)'>Close</a>");
                        $('#ssortable #'+data.field_id+' #textapp').find("a")[0].
							addEventListener("click", function() {
								deleteBillingDiv(data.field_id , "'"+data.field_label+"'");
							});
						$('#ssortable #'+data.field_id+' #swt').attr('id','swt'+data.field_id);
						$('#ssortable #'+data.field_id+' #sw').attr('id','sw'+data.field_id);
						$('#ssortable #'+data.field_id+' img').attr('id','si'+data.field_id);
						$('#ssortable #'+data.field_id+' img').attr('onClick','getdata('+data.field_id+')');
						$('#ssortable #'+data.field_id+' #option_field_ids').val(data.field_id);
						$('#ssortable #'+data.field_id+' #fieldids').val(data.field_id);


// 						$('#swt'+data.field_id).toggle(function(){ 
// 					       $('#'+data.field_id).removeClass('ui-state-default widget').addClass('ui-state-default widget open');
// 					       $("#sw"+data.field_id).slideDown('slow');
					       
// 					   	},function(){
// 					   		$('#'+data.field_id).removeClass('ui-state-default widget open').addClass('ui-state-default widget');
// 					       	$("#sw"+data.field_id).slideUp('slow');
// 					   	});
					  jQuery("#sw"+data.field_id).slideDown('slow');
						jQuery("#swt"+data.field_id).show();
// alert(data.field_id)
					jQuery('body').on('click','#swt'+data.field_id ,function(){
// 						alert(data.field_id)
						if(jQuery(this).next().is(":hidden")){
// 							alert('yes')
							jQuery(this).next().show();
						}else{
// 							alert('no')
							jQuery(this).next().hide();
						}						
					});
					}
				});
			}
		});
    });


jQuery(document).ready(function($){
  	<?php foreach ($shipping_fields as $shipping_field) { ?>
  jQuery('body').on('click','#swt<?php echo filter_var($shipping_field->field_id); ?>' ,function(){
				var x = document.getElementById('sw<?php echo filter_var($shipping_field->field_id); ?>');
				if (x.style.display === "" || x.style.display=='none') {
					x.style.display = "block";
				} else if(x.style.display==='block') {
					x.style.display = "none";
				} 
			});

   <?php } ?>
});

function deleteShippingDiv(field_id,field_label) { 
	var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
	if(confirm("Are you sure to delete "+field_label+" field?"))
		{
			jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			data: {"action": "del_shipping_field", "field_id":field_id},
			success: function() {

				jQuery("#"+field_id).fadeOut('slow');
				jQuery("#"+field_id).remove();

			}
			});

		}
	return false;
}

function closeShippingDiv(field_id) { 

	jQuery('#'+field_id).removeClass('ui-state-default widget open').addClass('ui-state-default widget');
    jQuery("#sw"+field_id).slideUp('slow');
}


//End shipping



jQuery(document).ready(function($){
        

	$( "#asortable" ).sortable({ revert: true, update: function( event, ui ) {
		var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
		var order = $(this).sortable('toArray');
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: ajaxurl, // Including ajax file
			data: {"action": "update_additional_sortorder","ids":order}, // Sending data dname to post_word_count function.
			success: function(data){ 

			}
		});                                                            
	}});

    $( "#adrag .draggable" ).draggable({ 
        connectToSortable: "#asortable",
        helper: "clone",
        revert: "invalid",

        stop: function(event, ui) { 
        	$("#asortable .draggable").attr( "style", "" );
        	$("#asortable .draggable").attr( "id", "anewfield" );

        	$('#anewfield #af').removeClass('ui-state-default widget').addClass('ui-state-default widget open');
		    $("#anewfield  #aw").slideDown('slow');
        	$('#anewfield #awt').toggle(function(){
		       $('#anewfield #af').removeClass('ui-state-default widget').addClass('ui-state-default widget open');
		       $("#anewfield  #aw").slideDown('slow');
		   	},function(){
		   		$('#anewfield  #af').removeClass('ui-state-default widget open').addClass('ui-state-default widget');
		       	$("#anewfield  #aw").slideUp('slow');
		   	});

        	var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
			var fieldtype = $("#anewfield #fieldtype").val();
			var type = $("#anewfield #type").val();
			var label = $("#anewfield #label").val();
			var name = $("#anewfield #name").val();
			var mode = $("#anewfield #mode").val();
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: ajaxurl, // Including ajax file
				data: {"action": "insert_additional_field","fieldtype":fieldtype,"type":type,"label":label,"name":name,"mode":mode}, // Sending data dname to post_word_count function.
				dataType: 'json',
				success: function(data) {

					if($("#asortable .draggable").attr( "id" ) == 'anewfield') {
						$('#asortable #anewfield').attr( 'id', data.field_id );
					}
					$('#asortable #'+data.field_id).attr('class', '');
					$('#asortable #'+data.field_id).attr('class', 'ui-state-default widget ui-sortable-handle');
					$('#asortable #'+data.field_id+' #textapp').html('');
					$('#asortable #'+data.field_id+' #textapp').append("<a class='widget-control-remove' href='javascript:void(0)'>Delete</a> | <a onClick='closeBillingDiv("+data.field_id+")' class='widget-control-close' href='javascript:void(0)'>Close</a>");
                    $('#asortable #'+data.field_id+' #textapp').find("a")[0].
							addEventListener("click", function() {
								deleteBillingDiv(data.field_id , "'"+data.field_label+"'");
							});
					$('#asortable #'+data.field_id+' #awt').attr('id','awt'+data.field_id);
					$('#asortable #'+data.field_id+' #aw').attr('id','aw'+data.field_id);
					$('#asortable #'+data.field_id+' img').attr('id','ai'+data.field_id);
					$('#asortable #'+data.field_id+' img').attr('onClick','getdata('+data.field_id+')');
					$('#asortable #'+data.field_id+' #option_field_ids').val(data.field_id);
					$('#asortable #'+data.field_id+' #fieldids').val(data.field_id);


// 					$('#awt'+data.field_id).toggle(function(){ 
// 				       $('#'+data.field_id).removeClass('ui-state-default widget').addClass('ui-state-default widget open');
// 				       $("#aw"+data.field_id).slideDown('slow');
				       
// 				   },function(){
// 				   	$('#'+data.field_id).removeClass('ui-state-default widget open').addClass('ui-state-default widget');
// 				       $("#aw"+data.field_id).slideUp('slow');
// 				   });
				  jQuery("#aw"+data.field_id).slideDown('slow');
						jQuery("#awt"+data.field_id).show();
// alert(data.field_id)
					jQuery('body').on('click','#awt'+data.field_id ,function(){
// 						alert(data.field_id)
						if(jQuery(this).next().is(":hidden")){
// 							alert('yes')
							jQuery(this).next().show();
						}else{
// 							alert('no')
							jQuery(this).next().hide();
						}						
					});
				}
			});
		}
    });
});


jQuery(document).ready(function($) { 
  	<?php foreach ($additional_fields as $additional_field) { ?>
   jQuery('body').on('click','#awt<?php echo filter_var($additional_field->field_id); ?>' ,function(){
				var x = document.getElementById('aw<?php echo filter_var($additional_field->field_id); ?>');
				if (x.style.display === "" || x.style.display=='none') {
					x.style.display = "block";
				} else if(x.style.display==='block') {
					x.style.display = "none";
				} 
			});
   <?php } ?>
});

function deleteAdditionalDiv(field_id,field_label) { 
	var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
	if(confirm("Are you sure to delete "+field_label+" field?"))
		{
		jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: {"action": "del_additional_field", "field_id":field_id},
		success: function() {

			jQuery("#"+field_id).fadeOut('slow');
			jQuery("#"+field_id).remove();

		}
		});

	}
	return false;
}

function closeAdditionalDiv(field_id) { 

	jQuery('#'+field_id).removeClass('ui-state-default widget open').addClass('ui-state-default widget');
    jQuery("#aw"+field_id).slideUp('slow');
}
//End Additional






function savedata() { 
	jQuery('#savefields').find(':checkbox:not(:checked)').attr('value', '0').prop('checked', true);
	// console.log(jQuery('#savefields').find(':checkbox:not(:checked)').attr('value', '0').prop('checked', true));
	jQuery('#ssavefields').find(':checkbox:not(:checked)').attr('value', '0').prop('checked', true);
	jQuery('#asavefields').find(':checkbox:not(:checked)').attr('value', '0').prop('checked', true);
	var data2 = jQuery('#savefields, #ssavefields, #asavefields').serialize();
	var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
	jQuery.ajax({
	    type: 'POST',
	    url: ajaxurl,
	    data: data2 + '&action=save_all_data1',
	    success: function(data) {
	    	// console.log(data);
	    	// return;
	        window.location.reload(true);
	    }
	});
}
</script>

<script type="text/javascript">
function getdata(id) {
	var maxField = 10000; //Input fields increment limitation
	
	
	var x = 1; //Initial field counter is 1
	 //Once add button is clicked
		//var id = this.id; alert(id);
		var wrapper = jQuery('#'+id+' .field_wrapper'); //Input field wrapper
		var fieldHTML = '<div><input class="opval" placeholder="Option Value" type="text" name="option_value[]" value=""/><input class="opval opval2" placeholder="Option Text" type="text" name="option_text[]" value=""/><input class="opval opval2" placeholder="Option Price" type="text" name="option_price[]" value=""/><a href="javascript:void(0);" class="remove_bt"  title="Remove Option"><input class="opval" placeholder="" type="hidden" name="option_field_ids[]" value="'+id+'"/><img class="remove_button" src="<?php echo RLTKN_PLUGIN_URL; ?>images/remove-icon.png"/></a></div>'; //New input field html 
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			jQuery(wrapper).append(fieldHTML); // Add field html
		}
		jQuery(wrapper).on('click', '.remove_bt', function(e){ //Once remove button is clicked
		e.preventDefault();
		jQuery(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
		

}


function deldata(id) {
	
	jQuery("#"+id).remove();	

}
</script>



