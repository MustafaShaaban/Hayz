<?php

use OTP\Helper\MoUtility;

echo'	
        <div class="mo_otp_form" id="'.get_mo_class($handler).'">
            <input type="checkbox" '.$disabled.' id="caldera_basic" class="app_enable" data-toggle="caldera_options" 
                name="mo_customer_validation_caldera_enable" value="1" '.$is_caldera_enabled.' />
                <strong>'.$form_name.'</strong>
            <div class="mo_registration_help_desc" '.$is_caldera_hidden.' id="caldera_options">
                <b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
                <p>
                    <input type="radio" '.$disabled.' id="caldera_form_email" class="app_enable" 
                    data-toggle="caldera_email_option" name="mo_customer_validation_caldera_enable_type" 
                    value="'.$caldera_email_type.'" '.( $caldera_enabled_type == $caldera_email_type ? "checked" : "").' />
                    <strong>'. mo_( "Enable Email Verification" ).'</strong>
                </p>
                        
                
                <div '.($caldera_enabled_type != $caldera_email_type ? "hidden" :"").' class="mo_registration_help_desc" id="caldera_email_option"">
                    <ol>
                        <li><a href="'.$caldera_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> 
                            '. mo_( " to see your list of forms" ).'</li>
                        <li>'. mo_( "Click on the <b>Edit</b> option of your caldera Form." ).'</li>
                        <li>'. mo_( "Note the Form ID from the Form Settings Page.").'</li>
                        <li>'. mo_( "Add an Email Field to your form. Note the Field ID of the Email field." ).'</li>
                        <li>'. mo_( "Add a Verification Field to your form where users will enter the OTP sent to their Email Address. Note the Field ID of the Verification field." ).'</li>
                        <li>'. mo_( "Make sure Both Email Field and Verification Field are required Fields." ).'</li>
                        <li>'. mo_( "Enter your Form ID, Email Field ID and Verification Field ID below" ).':<br>
                            <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' 
                            onclick="add_caldera(\'email\',1);" class="button button-primary" />&nbsp;

                            <input type="button" value="-" '. $disabled .' onclick="remove_caldera(1);" class="button button-primary" />
                            <br/><br/>';

                        $form_results = get_multiple_form_select($caldera_list_of_forms_otp_enabled,TRUE,TRUE,$disabled,1,'caldera','ID');
                        $counter1     =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo '              </ol>
                </div>


                <p>
                    <input type="radio" '.$disabled.' id="caldera_form_phone" 
                        class="app_enable" data-toggle="caldera_phone_option" name="mo_customer_validation_caldera_enable_type" 
                        value="'.$caldera_phone_type.'"'.( $caldera_enabled_type == $caldera_phone_type ? "checked" : "").' />                                                                            
                    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
                </p>
                    
                <div '.($caldera_enabled_type != $caldera_phone_type ? "hidden" :"").' class="mo_registration_help_desc" 
                    id="caldera_phone_option" '.$disabled.'">
                    <ol>
                        <li><a href="'.$caldera_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> 
                            '. mo_( " to see your list of forms" ).'</li>
                        <li>'. mo_( "Click on the <b>Edit</b> option of your caldera Form." ).'</li>
                        <li>'. mo_( "Note the Form ID from the Form Settings Page.").'</li>
                        <li>'. mo_( "Add a <b>Phone Number</b> field to your form. Note the Field ID of the Phone field." ).'</li>
                        <li>'. mo_( "Add a Verification Field to your form where users will enter the OTP sent to their Phone. Note the Field ID of the Verification field." ).'</li>
                        <li>'. mo_( "Make sure Both Phone Field and Verification Field are required Fields." ).'</li>
                        <li>'. mo_( "Enter your Form ID, Phone Field ID and Verification Field ID below" ).':<br>
                            <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_caldera(\'phone\',2);
                                " class="button button-primary" />&nbsp; <input type="button" value="-" '. $disabled .' 
                                onclick="remove_caldera(2);" class="button button-primary" /><br/><br/>';

                                $form_results = get_multiple_form_select($caldera_list_of_forms_otp_enabled,TRUE,TRUE,$disabled,2,'caldera','ID');
                                $counter2     =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo
                        '</ol>
                    </div>  
                    <p style="margin-left:2%;">
                        <i><b>'.mo_("Verification Button text").':</b></i>
                        <input class="mo_registration_table_textbox" name="mo_customer_validation_caldera_button_text" type="text" value="'.$button_text.'">
                    </p>             
                </div>
        </div>';

        multiple_from_select_script_generator(TRUE,TRUE,'caldera','ID',[$counter1,$counter2,0]);

