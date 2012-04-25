<?php

add_shortcode( 'gform', 'better_googleform_shortcode' );


function better_googleform_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'key' => '',
		'html' => '',
		'autofill' => false
	), $atts ) );
	$autofill = isset($autofill) && $autofill == 'true' ? 'autofill' : '';
	$style = '<style type="text/css">form.better_googleform.no_wysiwyg{ width: 60%; text-align: right; margin: 30px 0 }form.better_googleform label{ padding: 0 4px }form.better_googleform ul{ list-style: none }form.better_googleform ul li{ text-align: left }</style>';
	if( isset($key) ):
		wp_enqueue_script( 'better', better_googleforms_base.'googleform.js',array( 'jquery' ), '0.5', true );
		if( $html != '' ) {
			$html = substr($html,4,-3);
			return $style.'<form action="'.esc_attr($key).'" method="POST" target="_blank" class="better_googleform no_wysiwyg '.$autofill.'" ><input type="hidden" value="Submit" name="submit">'.urldecode($html).'</form>';
		} else return $style.'<form action="'.esc_attr($key).'" method="POST"  target="_blank" class="better_googleform wysiwyg '.$autofill.'" ><input type="hidden" value="Submit" name="submit">'.$content.'</form>';
	endif;

}

?>