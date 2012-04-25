<?php

add_action('admin_init', 'better_googleform_options_init' );

function better_googleform_options_init(){
    add_action('media_buttons', 'better_googleform_button', 20);
    add_action('wp_ajax_better_googleform_button_iframe', 'better_googleform_button_iframe');
    add_action('wp_ajax_better_googleform_render', 'better_googleform_render');
}

// Adds the Button
function better_googleform_button(){
    $title = _('Insert a Google Form');
    $button = '<a href="'.admin_url('admin-ajax.php').'?action=better_googleform_button_iframe&amp;TB_iframe=true&amp;height=150&amp;respect_dimensions=true" class="thickbox" title="'.$title.'" onclick="return false;"><img src="'.better_googleforms_base.'googleform.png'.'" alt="'.$title.'" width="11" height="11" /></a>';

    echo $button;
}

// AJAX call used to retrieve the Google Form
function better_googleform_render() {
    if( strlen($_GET['key']) == 34 ):
        include_once('simple_html_dom.php');
        $html = new simple_html_dom();
        $html->load_file('https://spreadsheets.google.com/spreadsheet/viewform?formkey='.$_GET['key']);

        foreach($html->find('.ss-form-entry') as $element) {
            echo '<p>';
            if( $element->find('table') != null ) {
                    echo $element->find('label',0);
                    echo $element->find('label',1);

                foreach( $element->find('table') as $t) 
                    echo $t;
            } else if ($element->find('input[type=submit]') ) {
				echo "<input type='submit' value='Submit'>";
			} else echo $element->innertext;
            echo '</p>';
        }
    endif;
    exit();
}

// iFrame
function better_googleform_button_iframe(){
    wp_enqueue_script( 'better', better_googleforms_base.'googleform_admin.js',array( 'jquery' ), '0.5', true );
    wp_enqueue_style( 'better', better_googleforms_base.'googleform_admin.css','', '0.5', 'all' );
    wp_iframe('better_googleform_button_iframe_content');
    exit();
}

function better_googleform_button_iframe_content(){
    ?>
    <style type="text/css">
    div.option{
        margin-bottom: 30px;
    }

    div#submit {
        float: right;
        margin: 8px 24px;
    }
    body, html {
        height: auto !important;
    } 
    form {
      padding: 12px 30px;
    }
	span.googleform_option {
		font-size: 10px;
	}
    .GoogleForm {
        width: 300px;
        text-align: left;
        margin-left: 30px;
    }
    .GoogleForm textarea {
        max-width: 130px;
        max-height: 50px;
    }
    .GoogleForm table {
        float: left;
        margin: -14px 0px 30px;
    }
    .GoogleForm p {
        clear:both;
        line-height: 2em;
    }
    form.GoogleForm label  {
        margin-bottom: 0.5em;
    }
    form.GoogleForm .disclaimer {
        margin: -10px -30px 30px;
        border-bottom: 2px dotted black;
        padding-bottom: 10px;
    }
    </style>

    <form >
        <h2>Enter a Google Form's URL</h2>
		<input type="text" name="key" style="width: 448px; font-size: 8px"><br>
        It'll look something like this: <em style="font-size: 7px;">https://spreadsheets.google.com/spreadsheet/viewform?formkey=dGdRbFFWZzNlbkFCaExYdDhNY1ZOSGc6MQ</em><br>
        <br>
        
        <input type="submit" value="Grab It">
    </form>
    <form class="GoogleForm">
    </form>
    <script>

        // get main window
        jQuery(document).ready( function($) {
            $('form').submit( function(e) {
                key = '';
                var hashstrip = $('input[type=text]').val().split('#')[0]
                var parsed = hashstrip.trim().split('=');
                $(parsed).each( function() {
                    key = this.length == 34 ? this : key;
                });
                
                if ( key == '' ) $(this).find('input:first').notice('Not quite champ','mean');
                else if ( key == 'dGdRbFFWZzNlbkFCaExYdDhNY1ZOSGc6MQ' ) $(this).find('input:first').notice('<br>That\'s the one from the example, I, I can\'t even look at you right now.','mean');
                else {
                    $('form:first [type=submit]').notice('Grabbing the form...').hide();
                    $('#return').remove();
					$('span#fucking').remove();
                    $.get(
                        document.location.href.split('?')[0],
                        'action=better_googleform_render&key='+key,
                        function(response) {
                            var disclaimer = "<div class='disclaimer'>PREVIEW</div>";
                            $('.GoogleForm').html(disclaimer+response);
                            post_package = response.replace("</t","&nbsp;</t");
                            $('span.notice').remove();
                            $('form:first [type=submit]').show().val('No good? Try again.');
                            $('form:first [type=submit]').before('<a href="#" style="margin-right: 148px;" id="return">Look good? Insert into Post!</a>');
                            $('form:first [type=submit]').after('<span class="googleform_option" id="#autofill"><br><input type="checkbox" name="autofill" value="yes">&nbsp;&nbsp;<strong>Autofill</strong> the form using $_GET variables?<br />Matched by label, with spaces as "_"</span>');
                            $('form:first [type=submit]').after('<span class="googleform_option" id="#fucking"><br><input type="checkbox" name="fucking" value="yes">&nbsp;&nbsp;Keep editing the HTML in your post</span>');
                            $('a#return').focus();
                        }
                    );
                }
                e.preventDefault();
            });
            $('a#return').live('click', function(e){
				var autofill = $('input[name=autofill]:checked').length > 0;
                post_package = $('input[name=fucking]:checked').length > 0 ? 
                    "[gform (don\'t fuck with this) autofill='"+autofill+"' key='https://spreadsheets.google.com/spreadsheet/formResponse?formkey="+key+"&ifq'] <br><br>"+post_package+"[/gform]" : 
                    "[gform (don\'t fuck with this) autofill='"+autofill+"' key='https://spreadsheets.google.com/spreadsheet/formResponse?formkey="+key+"&ifq' html='<!-- "+escape(post_package)+" -->']<br>[/gform]";
                wind.send_to_editor(post_package);
    
                e.stopPropagation();
                return false;
            });
        });

        wind = window.dialogArguments || opener || parent || top;

        jQuery('#cancel').click(function(e){
            w.tb_remove();
            e.stopPropagation();
            return false;
        });
    </script>

    <?php
}


?>