( function ($) {
	'use strict';
	$(window).load(function () {
		var firstname,
			firstnameString,
			selectedfirstnameglobalarr,
			selectedfirstnameArray,
			selectorfirstname,
			configfirstname,
			configssfirstname,
			arrfirstnameList,
			i,
			j,
			k,
			m,
			n,
			o,
			p,
			q,
			r,
			s,
			t,
			z,
			lastname,
			lastnameString,
			selectedlastnameglobalarr,
			selectedlastnameArray,
			selectorlastname,
			configlastname,
			configsslastname,
			arrlastnameList,
			kadpengenalan,
			kadpengenalanString,
			selectedkadpengenalanglobalarr,
			selectedkadpengenalanArray,
			selectorkadpengenalan,
			configkadpengenalan,
			configsskadpengenalan,
			arrkadpengenalanList,
			localize_json_output;
		localize_json_output = $.parseJSON($('input[name="localize_json_output"]').val());
		$('body').on('click', '#rltknp_reset_settings', function () {
			ajaxindicatorstart('Please wait..!!');
			jQuery.ajax({
				url: kineticpay_admin.ajaxurl,
				type: 'post',
				data: {
					action: 'rltknp_reset_settings',
				},
				success: function () {
					location.reload(true);
				},
			});
		});
		// Chosen firstname Start
		configfirstname = {
			'.chosen-select-firstname': {},
			'.chosen-select-deselect': { allow_single_deselect: true }, // eslint-disable-line
			'.chosen-select-no-single': { disable_search_threshold: 10 }, // eslint-disable-line
			'.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' }, // eslint-disable-line
			'.chosen-select-width': { width: '95%' },
		};
		for (selectorfirstname in configfirstname) {
			$(selectorfirstname).chosen(configfirstname[selectorfirstname]);
		}
		
		selectedfirstnameArray = localize_json_output.getfirstnameOption.firstnamearray;
		selectedfirstnameArray = $.parseJSON(selectedfirstnameArray);
		selectedfirstnameglobalarr = [];
		arrfirstnameList = [];
		for (k in selectedfirstnameArray) {
			selectedfirstnameglobalarr.push(selectedfirstnameArray[k]);
		}
		
		firstnameString = '';
		firstnameString = selectedfirstnameglobalarr.join(',');
		
		if ('' !== firstnameString) {
			$.each(firstnameString.split(','), function (i, e) {
				arrfirstnameList.push(e);
				$('#firstname option[value=\'' + e + '\']').prop('selected', true);
				$('#firstname').trigger('chosen:updated');
			});
		}
		
		$('body').on('keyup', '#firstname_chosen ul.chosen-choices li.search-field input', function (evt) {
			var c = evt.keyCode;
			var firstname;
			if (188 === c || 13 === c || 59 === c || 186 === c) {
				if (13 === c) {
					firstname = $(this).val();
				}
				if (186 === c) {
					firstname = $(this).val().replace(';', '');
				}
				if (59 === c) {
					firstname = $(this).val().replace(';', '');
				}
				if (188 === c) {
					firstname = $(this).val().replace(',', '');
				}
				if ('' !== firstname && -1 === $.inArray(firstname, arrfirstnameList)) {
					
					//add new first name in array
					arrfirstnameList.push(firstname);
					$('<option/>', { value: firstname, text: firstname }).appendTo('#firstname');
					$('#firstname option[value=\'' + firstname + '\']').prop('selected', true);
					$('#firstname').trigger('chosen:updated');
				} else {
					$('#firstname').trigger('chosen:updated');
				}
			}
		});
		
		$('body').on('blur', '#firstname_chosen ul.chosen-choices li.search-field input', function () {
			var firstname = $(this).val().replace(',', '');
			
			//var valid = Validatefirstname( firstname );
			if ('' !== firstname && -1 === $.inArray(firstname, arrfirstnameList)) {
				
				//add new first name in array
				arrfirstnameList.push(firstname);
				$('<option/>', { value: firstname, text: firstname }).appendTo('#firstname');
				$('#firstname option[value=\'' + firstname + '\']').prop('selected', true);
				$('#firstname').trigger('chosen:updated');
			} else {
				$('#firstname').trigger('chosen:updated');
			}
		});
		
		firstname = [];
		// Chosen firstname End

		// Chosen lastname Start
		configlastname = {
			'.chosen-select-lastname': {},
			'.chosen-select-deselect': { allow_single_deselect: true }, // eslint-disable-line
			'.chosen-select-no-single': { disable_search_threshold: 10 }, // eslint-disable-line
			'.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' }, // eslint-disable-line
			'.chosen-select-width': { width: '95%' },
		};
		for (selectorlastname in configlastname) {
			$(selectorlastname).chosen(configlastname[selectorlastname]);
		}
		
		selectedlastnameArray = localize_json_output.getlastnameOption.lastnamearray;
		selectedlastnameArray = $.parseJSON(selectedlastnameArray);
		selectedlastnameglobalarr = [];
		arrlastnameList = [];
		for (k in selectedlastnameArray) {
			selectedlastnameglobalarr.push(selectedlastnameArray[k]);
		}
		
		lastnameString = '';
		lastnameString = selectedlastnameglobalarr.join(',');
		
		if ('' !== lastnameString) {
			$.each(lastnameString.split(','), function (i, e) {
				arrlastnameList.push(e);
				$('#lastname option[value=\'' + e + '\']').prop('selected', true);
				$('#lastname').trigger('chosen:updated');
			});
		}
		
		$('body').on('keyup', '#lastname_chosen ul.chosen-choices li.search-field input', function (evt) {
			var c = evt.keyCode;
			var lastname;
			if (188 === c || 13 === c || 59 === c || 186 === c) {
				if (13 === c) {
					lastname = $(this).val();
				}
				if (186 === c) {
					lastname = $(this).val().replace(';', '');
				}
				if (59 === c) {
					lastname = $(this).val().replace(';', '');
				}
				if (188 === c) {
					lastname = $(this).val().replace(',', '');
				}
				if ('' !== lastname && -1 === $.inArray(lastname, arrlastnameList)) {
					
					//add new first name in array
					arrlastnameList.push(lastname);
					$('<option/>', { value: lastname, text: lastname }).appendTo('#lastname');
					$('#lastname option[value=\'' + lastname + '\']').prop('selected', true);
					$('#lastname').trigger('chosen:updated');
				} else {
					$('#lastname').trigger('chosen:updated');
				}
			}
		});
		
		$('body').on('blur', '#lastname_chosen ul.chosen-choices li.search-field input', function () {
			var lastname = $(this).val().replace(',', '');
			
			//var valid = Validatelastname( lastname );
			if ('' !== lastname && -1 === $.inArray(lastname, arrlastnameList)) {
				
				//add new first name in array
				arrlastnameList.push(lastname);
				$('<option/>', { value: lastname, text: lastname }).appendTo('#lastname');
				$('#lastname option[value=\'' + lastname + '\']').prop('selected', true);
				$('#lastname').trigger('chosen:updated');
			} else {
				$('#lastname').trigger('chosen:updated');
			}
		});
		
		lastname = [];
		// Chosen lastname End

		// Chosen kadpengenalan Start
		configkadpengenalan = {
			'.chosen-select-kadpengenalan': {},
			'.chosen-select-deselect': { allow_single_deselect: true }, // eslint-disable-line
			'.chosen-select-no-single': { disable_search_threshold: 10 }, // eslint-disable-line
			'.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' }, // eslint-disable-line
			'.chosen-select-width': { width: '95%' },
		};
		for (selectorkadpengenalan in configkadpengenalan) {
			$(selectorkadpengenalan).chosen(configkadpengenalan[selectorkadpengenalan]);
		}
		
		selectedkadpengenalanArray = localize_json_output.getkadpengenalanOption.kadpengenalanarray;
		selectedkadpengenalanArray = $.parseJSON(selectedkadpengenalanArray);
		selectedkadpengenalanglobalarr = [];
		arrkadpengenalanList = [];
		for (k in selectedkadpengenalanArray) {
			selectedkadpengenalanglobalarr.push(selectedkadpengenalanArray[k]);
		}
		
		kadpengenalanString = '';
		kadpengenalanString = selectedkadpengenalanglobalarr.join(',');
		
		if ('' !== kadpengenalanString) {
			$.each(kadpengenalanString.split(','), function (i, e) {
				arrkadpengenalanList.push(e);
				$('#kadpengenalan option[value=\'' + e + '\']').prop('selected', true);
				$('#kadpengenalan').trigger('chosen:updated');
			});
		}
		
		$('body').on('keyup', '#kadpengenalan_chosen ul.chosen-choices li.search-field input', function (evt) {
			var c = evt.keyCode;
			var kadpengenalan;
			if (188 === c || 13 === c || 59 === c || 186 === c) {
				if (13 === c) {
					kadpengenalan = $(this).val();
				}
				if (186 === c) {
					kadpengenalan = $(this).val().replace(';', '');
				}
				if (59 === c) {
					kadpengenalan = $(this).val().replace(';', '');
				}
				if (188 === c) {
					kadpengenalan = $(this).val().replace(',', '');
				}
				if ('' !== kadpengenalan && -1 === $.inArray(kadpengenalan, arrkadpengenalanList)) {
					
					//add new first name in array
					arrkadpengenalanList.push(kadpengenalan);
					$('<option/>', { value: kadpengenalan, text: kadpengenalan }).appendTo('#kadpengenalan');
					$('#kadpengenalan option[value=\'' + kadpengenalan + '\']').prop('selected', true);
					$('#kadpengenalan').trigger('chosen:updated');
				} else {
					$('#kadpengenalan').trigger('chosen:updated');
				}
			}
		});
		
		$('body').on('blur', '#kadpengenalan_chosen ul.chosen-choices li.search-field input', function () {
			var kadpengenalan = $(this).val().replace(',', '');
			
			//var valid = Validatekadpengenalan( kadpengenalan );
			if ('' !== kadpengenalan && -1 === $.inArray(kadpengenalan, arrkadpengenalanList)) {
				
				//add new first name in array
				arrkadpengenalanList.push(kadpengenalan);
				$('<option/>', { value: kadpengenalan, text: kadpengenalan }).appendTo('#kadpengenalan');
				$('#kadpengenalan option[value=\'' + kadpengenalan + '\']').prop('selected', true);
				$('#kadpengenalan').trigger('chosen:updated');
			} else {
				$('#kadpengenalan').trigger('chosen:updated');
			}
		});
		
		kadpengenalan = [];
		// Chosen kadpengenalan End


		$('body').on('click', '#rltknp_enable_block', function () {
			if ($(this).is(':checked')) {
				$(this).attr('value', '1');
			} else {
				$(this).attr('value', '0');
			}
		});
		
		$('body').on('click', '#rltknp_ww_enable_block', function () {
			if ($(this).is(':checked')) {
				$(this).attr('value', '1');
			} else {
				$(this).attr('value', '0');
			}
		});
		
		$('body').on('click', '#rltknp_enable_customfields', function () {
			if ($(this).is(':checked')) {
				$(this).attr('value', '1');
			} else {
				$(this).attr('value', '0');
			}
		});
		
		$(document).on('click', '#all_chk_selection', function () {
			var matches = /\[(.*?)\]/g.exec($(this).attr('name'));
			if ($(this).prop('checked') === true) {
				$('#' + matches[1] + ' option').prop('selected', true);
				$('#' + matches[1]).trigger('chosen:updated');
			} else {
				$('#' + matches[1] + ' option').prop('selected', false);
				$('#' + matches[1]).trigger('chosen:updated');
			}
		});

	});
	
	function ajaxindicatorstart (text) {
		var firstDiv,
			firstInnerDiv,
			subDiv;
		if ('resultLoading' !== $('body').find('#resultLoading').attr('id')) {
			firstDiv = $('<div/>', { id: 'resultLoading', style: 'display:none' }).appendTo('body');
			firstInnerDiv = $('<div/>').appendTo(firstDiv);
			$('<img/>', { src: kineticpay_admin.ajax_icon }).appendTo(firstInnerDiv);
			subDiv = $('<div/>').appendTo(firstInnerDiv);
			$('<span/>', { id: '', text: text }).appendTo(subDiv);
			$('<div/>', { class: 'bg' }).appendTo(firstDiv);
		} else {
			$('#ajax-quote').text(text);
		}
		
		$('#resultLoading').css({
			'width': '100%',
			'height': '100%',
			'position': 'fixed',
			'z-index': '10000000',
			'top': '0',
			'left': '0',
			'right': '0',
			'bottom': '0',
			'margin': 'auto',
		});
		$('#resultLoading .bg').css({
			'background': '#000000',
			'opacity': '0.7',
			'width': '100%',
			'height': '100%',
			'position': 'absolute',
			'top': '0',
		});
		$('#resultLoading>div:first').css({
			'width': '250px',
			'height': '75px',
			'text-align': 'center',
			'position': 'fixed',
			'top': '0',
			'left': '0',
			'right': '0',
			'bottom': '0',
			'margin': 'auto',
			'font-size': '16px',
			'z-index': '10',
			'color': '#ffffff',
		});
		$('#resultLoading .bg').height('100%');
		$('#resultLoading').fadeIn(300);
		$('body').css('cursor', 'wait');
		
	}
	
	function ajaxindicatorstop () {
		$('#resultLoading .bg').height('100%');
		$('#resultLoading').fadeOut(300);
		$('body').css('cursor', 'default');
	}

} )(jQuery);
