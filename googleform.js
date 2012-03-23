jQuery(document).ready(function($){
	$('.better_googleform.autofill').each( function() {
		var search = document.location.search.slice(1).split(/\&/), keys = [], vals = []
		for (var i=0; i < search.length; i++) {
			var key_vals = search[i].split('=');
			keys[i] = key_vals[0] != 'undefined' ?  key_vals[0] : '', vals[i] = key_vals[1] != 'undefined' ?  key_vals[1] : ''
		};
		var $this = $(this), $labels = $('label',$this);
		$labels.each( function() {
			var $label = $(this), indexd = keys.indexOf($label.text().replace(/ /g,'_').replace(/\*/,'').trim() )
			if( indexd !== -1 ) $label.nextAll('input').val( vals[indexd] );
		});
	});

});