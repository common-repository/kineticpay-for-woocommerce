

(function( $ ){

	"use strict"
	
	$.fn.Dependency = function( options ) {
		// console.log(options);
		var id = options.parentID;
		// console.log(id);
		var id1 = options.fieldID;
		var _settings = $.extend( {
			fieldID: 			null,
			parentID: 			null,
			conditionAction: 	null,
			condition: 			null,
			conditionValue: 	null,
			parentType: 		null,
			field: 				null,
			fieldWrapper: 		null,
			parent: 			null,
			parentWrapper: 		null
		}, options );
		
		var init = function() {

			getFields();
			bindEvts();
		};


		var getFields = function() {
			_settings.fieldWrapper = $("#"+_settings.fieldID+"_field");
			_settings.field = $("#"+_settings.fieldID);
			_settings.parentWrapper = $("#"+_settings.parentID+"_field");
			_settings.parent = $(_settings.parentWrapper).find("#"+_settings.parentID);
		};


		var bindEvts = function() {

			if(_settings.parentType == "radioselect") {
				_settings.parentWrapper.find("input[type=radio]").each(function() {
					$(this).on("change", function() {
						var arg = $(this).val() == _settings.conditionValue ? true : false;
						applyDependency($(this).val(), arg);
					});
				});
			}
			else if(_settings.parentType == "checkbox") {
				$(_settings.parent).on("change", function() {
					applyDependency('', $(this).is(":checked"));
				});
			}
			else if(_settings.parentType == "multiselect") {
				$('.select_'+id).on("change", function() {
					applyDependency($(this).val());
				});
			}
			else {

				$(_settings.parent).on("change", function() {
					applyDependency($(this).val());
				});
			}
			applyDependency(_settings.parent.val());
		};

		var applyDependency = function(fieldValue, truthValue) {

			let ct = checkDependency(fieldValue, truthValue);
			if(_settings.conditionAction == "Hide" && ct) {
				$(_settings.fieldWrapper).hide();
				$(_settings.field).hide();
			} else if(_settings.conditionAction == "Hide" && ct === false) {
				$(_settings.fieldID).show();
				$(_settings.fieldWrapper).show();
			}

			if(_settings.conditionAction == "Show" && ct) {
				$(_settings.fieldWrapper).show();
				$(_settings.field).show();
				var i = _settings.fieldID.match(/\d+/);

				$('#additional_field_'+_settings.fieldID+'_field').show();
				$('#'+i[0]+'_field').show();
				$('#additional_field_'+_settings.fieldID).show();

			} else if(_settings.conditionAction == "Show" && ct === false) {
				$(_settings.fieldWrapper).hide();
				$(_settings.field).hide();
				var i = _settings.fieldID.match(/\d+/);
				$('#additional_field_'+_settings.fieldID+'_field').hide();
				$('#'+i[0]+'_field').hide();
				$('#additional_field_'+_settings.fieldID).hide();
			}

			if(_settings.parentType != "multiselect") {

				if(_settings.conditionAction == "Show" && ct) {
					$('.'+id1).show();
				} else if(_settings.conditionAction == "Show" && ct === false) {

					$("."+id1).hide();
				}

			}
		};

		var checkDependency = function(fieldValue, truthValue) {
			if(_settings.condition == "is_not_empty" && (fieldValue != "" &&
				typeof fieldValue != "undefined" && fieldValue != null) ) {
				return true;
			} else if(_settings.condition == "is_equal_to" && fieldValue == _settings.conditionValue) {
				return true;
			} else if(_settings.condition == "is_not_equal_to" && fieldValue != _settings.conditionValue) {
				return true;
			} else if(_settings.condition == "is_checked" && truthValue === true) {
				return true;
			} else {
				return false;
			}
		};
		init();
	};

	$(window).on("load", function() {
		// $("#"+1).Dependency({
		// 	fieldID: 1,
		// 	parentID: 25,
		// 	conditionAction: 'show',
		// 	condition: 'is_checked',
		// 	conditionValue: 'female',
		// 	parentType: 'radioselect'
		// });
	});
	// $(document).ready(function () {
	// 	$('.select').on('change' , function () {
	// 		alert('dd');
	// 	});
	// });

}(jQuery));

