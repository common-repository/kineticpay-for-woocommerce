jQuery(document).ready( function() {
    jQuery( '.datepick' ).datepicker();
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
    } );