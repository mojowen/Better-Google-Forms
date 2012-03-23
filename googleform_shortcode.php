<?php

add_shortcode( 'gform', 'better_googleform_shortcode' );


function better_googleform_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'key' => '',
        'html' => '',
		'autofill' =>
    ), $atts ) );
	$autofill = isset($autofill) && $autofill ? 'autofill' : '';
    if( isset($key) ):
        if( $html != '' ) {
			$html = substr($html,4,-3);
			return '<form action="'.esc_attr($key).'" method="POST" target="_blank" class="better_googleform no_wysiwyg '.$autofill.'" >'.urldecode($html).'</form>';
        } else return '<form action="'.esc_attr($key).'" method="POST"  target="_blank" class="better_googleform wysiwyg '.$autofill.'" >'.$content.'</form>';
    endif;
    
}

?>