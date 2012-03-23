var saving = true;

(function( $ ){

	$.fn.notice = function(msg, flavor, time) {
		if ( time == undefined ) var time = 5000;
		var thisclass = 'notice '+flavor;
		this.next('span').remove();
		this.after('<span class="'+thisclass+'">'+msg+'</span>').next('span').fadeOut(time, function() {$(this).remove() });
		return this;
	}

	$.fn.nowloading = function() {
		$(this).addClass('loading');
		$('#loading').show();
	}

	$.fn.endloading = function() {
		$(this).removeClass('loading');
		$('#loading').hide();
	}
	

    $.fn.intpicker = function() {
        this.keydown(function(e) {
            var press = String.fromCharCode(e.keyCode)
            var keycodes = { 
                8: 'backspace',
                9: 'tab',
                13: 'enter',
                16: 'shift',
                17: 'ctrl',
                18: 'alt',
                19: 'pause/break',
                20: 'caps lock',
                27: 'escape',
                33: 'page up',
                34: 'page down',
                35: 'end',
                36: 'home',
                37: 'left arrow',
                38:'up arrow',
                39: 'right arrow',
                40: 'down arrow',
                45: 'insert',
                46: 'delete',
                190: 'period'
            };
            the_press = e.keyCode;
            if( /[^0-9]/.test(press) && keycodes[e.keyCode] == null ) e.preventDefault();
        });
    }


    $.fn.campaignpicker = function() {
        this.change(function(e) {
            var fellow = document.location.href.split('f=')[1] !== null ? '&f='+document.location.href.split('f=')[1] : '';
            if( $(this).val().length > 0 ) location.href = '?c='+$(this).val()+fellow;
        });
    }
    $.fn.othering = function() {
        this.ready( function(e) {
            $(this).val('');
        });
        
        this.parent().change( function(e) { 
                if( $(this).find('.Other:selected').length > 0 ) {
                    var r = '';
                    if( $(this).prev('label:contains(*)').length > 0 ) {
                        var r = ' *';
                        $(this).prev('label:contains(*)').text($(this).prev('label:contains(*)').text().replace(' *',''));
                    }
                    var i = '<input type="text" name="'+$(this).find('.Other').attr('name')+'">';
                    var l = '<label for="'+$(this).find('.Other').attr('name')+'">'+$(this).find('.Other').attr('label')+r+'</label>';
                    $(this).after(l+i);
                } else {
                    if( $('label[for='+$(this).find('.Other').attr('name')+']:contains(*)').length > 0 ) $(this).prev('label').text( $(this).prev('label').text()+' *');
                    $('input[name='+$(this).find('.Other').attr('name')+'], label[for='+$(this).find('.Other').attr('name')+']').remove();
                }
        });
        
    }
    
})(jQuery);


jQuery(document).ready( function($) {


});