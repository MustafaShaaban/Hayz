<?php

use OTP\Helper\MoUtility;

echo'	
        <div class="mo_otp_form" id="'.get_mo_class($handler).'">
            <input type="checkbox" '.$disabled.' id="wpform_basic" class="app_enable" data-toggle="wpform_options" 
                name="mo_customer_validation_wpform_enable" value="1" '.$is_wpform_enabled.' />
                <strong>'.$form_name.'</strong>';

echo        '<div class="mo_registration_help_desc" '.$is_wpform_hidden.' id="wpform_options">
                <b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
                <p>
                    <input type="radio" '.$disabled.' id="wp_form_email" class="app_enable" 
                    data-toggle="wpform_email_option" name="mo_customer_validation_wpform_enable_type" 
                    value="'.$wpform_email_type.'" '.( $wpform_enabled_type == $wpform_email_type ? "checked" : "").' />
                    <strong>'. mo_( "Enable Email Verification" ).'</strong>
                </p>
                        
                
                <div '.($wpform_enabled_type != $wpform_email_type ? "hidden" :"").' class="mo_registration_help_desc" id="wpform_email_option"">
                    <ol>
                        <li><a href="'.$wpform_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> 
                            '. mo_( " to see your list of forms" ).'</li>
                        <li>'. mo_( "Click on the <b>Edit</b> option of your WPForm." ).'</li>
                        <li>'. mo_( "Add an Email Field to your form. Note the Field Label of the Email field." ).'</li>
                        <li>'. mo_( "Enter your Form ID, Email Field Label below" ).':<br>
                            <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' 
                            onclick="add_wpform(\'email\',1);" class="button button-primary" />&nbsp;

                            <input type="button" value="-" '. $disabled .' onclick="remove_wpform(1);" class="button button-primary" />
                            <br/><br/>';

                            $form_results = get_multiple_form_select($wpform_list_of_forms_otp_enabled,FALSE,TRUE,$disabled,1,'wpform','Label');
                            $counter1     =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo '              </ol>
                </div>


                <p>
                    <input type="radio" '.$disabled.' id="wp_form_phone" 
                        class="app_enable" data-toggle="wpform_phone_option" name="mo_customer_validation_wpform_enable_type" 
                        value="'.$wpform_phone_type.'"'.( $wpform_enabled_type == $wpform_phone_type ? "checked" : "").' />                                                                            
                    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
                </p>
                    
                <div '.($wpform_enabled_type != $wpform_phone_type ? "hidden" :"").' class="mo_registration_help_desc" 
                    id="wpform_phone_option" '.$disabled.'">
                    <ol>
                        <li><a href="'.$wpform_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> 
                            '. mo_( " to see your list of forms" ).'</li>
                        <li>'. mo_( "Click on the <b>Edit</b> option of your wp form." ).'</li>
                        <li>'. mo_( "Add an Phone Field to your form. Note the Field Label of the Phone field." ).'</li>
                        <li>'. mo_( "Enter your Form ID, Phone Field Label below" ).':<br>
                            <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_wpform(\'phone\',2);
                                " class="button button-primary" />&nbsp; <input type="button" value="-" '. $disabled .' \
                                onclick="remove_wpform(2);" class="button button-primary" /><br/><br/>';

                                $form_results = get_multiple_form_select($wpform_list_of_forms_otp_enabled,FALSE,TRUE,$disabled,2,'wpform','Label');
                                $counter2     =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo
    '</ol>
                    </div>  
                    <p style="margin-left:2%;">
                        <i><b>'.mo_("Verification Button text").':</b></i>
                        <input class="mo_registration_table_textbox" name="mo_customer_validation_wpforms_button_text" type="text" value="'.$button_text.'">
                    </p>             
                </div>
        </div>';

        multiple_from_select_script_generator(FALSE,TRUE,'wpform','Label',[$counter1,$counter2,0]);
