<?php

use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;

echo'	<div class="mo_otp_form" id="'.get_mo_class($handler).'">
	        <input type="checkbox" '.$disabled.' id="ninja_form" class="app_enable" data-toggle="ninja_form_options" 
	            name="mo_customer_validation_ninja_form_enable" value="1"'.$ninja_form_enabled.' /><strong>'. $form_name .'</strong>';
echo'		<div class="mo_registration_help_desc" '.$ninja_form_hidden.' id="ninja_form_options">
                    <p><input type="radio" '.$disabled.' id="ninja_form_email" class="app_enable" data-toggle="nfe_instructions" name="mo_customer_validation_ninja_form_enable_type" value="'.$ninja_form_type_email.'"
                        '.( $ninja_form_enabled_type == $ninja_form_type_email ? "checked" : "").' />
                        <strong>'. mo_( "Enable Email Verification" ).'</strong>
                    </p>
                    <div '.($ninja_form_enabled_type != $ninja_form_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="nfe_instructions" >
                            '. mo_( "Follow the following steps to enable Email Verification for Ninja Form" ).': 
                            <ol>
                                <li><a href="'.$ninja_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of forms" ).'</li>
                                <li>'. mo_( "Click on the <b>Edit</b> option of your ninja form." ).'</li>
                                <li>'. mo_( "Add an Email Field to your form. Note the Field Key of the email field." ).'</li>
                                <li>'. mo_( "Enter your Form ID and the Email Field ID below" ).':<br>
                                    <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_ninja(\'email\',1);" class="button button-primary" />&nbsp;
                                    <input type="button" value="-" '. $disabled .' onclick="remove_ninja(1);" class="button button-primary" /><br/><br/>';

                                    $form_results = get_multiple_form_select($ninja_form_otp_enabled,FALSE,TRUE,$disabled,1,'ninja','ID');
                                    $counter1 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'											</li>
                                <li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
                            </ol>
                    </div>
                    <p><input type="radio" '.$disabled.' id="ninja_form_phone" class="app_enable" data-toggle="nfp_instructions" name="mo_customer_validation_ninja_form_enable_type" value="'.$ninja_form_type_phone.'"
                        '.( $ninja_form_enabled_type == $ninja_form_type_phone ? "checked" : "").' />
                        <strong>'. mo_( "Enable Phone Verification" ).'</strong>
                    </p>
                    <div '.($ninja_form_enabled_type != $ninja_form_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="nfp_instructions" >
                            '. mo_( "Follow the following steps to enable Phone Verification for Ninja Form" ).': 
                            <ol>
                                <li><a href="'.$ninja_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of forms" ).'</li>
                                <li>'. mo_( "Click on the <b>Edit</b> option of your ninja form." ).'</li>
                                <li>'. mo_( "Add a Phone Field to your form. Note the Field ID of the phone field." ).'</li>
                                <li>'. mo_( "Make sure you have set the Input Mask type to None for the phone field." ).'</li>
                                <li>'. mo_( "Enter your Form ID and the Email Field ID below" ).':<br>
                                    <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_ninja(\'phone\',2);" class="button button-primary" />&nbsp;
                                    <input type="button" value="-" '. $disabled .' onclick="remove_ninja(2);" class="button button-primary" /><br/><br/>';

                                    $form_results = get_multiple_form_select($ninja_form_otp_enabled,FALSE,TRUE,$disabled,2,'ninja','ID');
                                    $counter2 	  = !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo'							</li>
                                <li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
                            </ol>
                    </div>
                    <p><input type="radio" '.$disabled.' id="ninja_form_both" class="app_enable" data-toggle="nfb_instructions" name="mo_customer_validation_ninja_form_enable_type" value="'.$ninja_form_type_both.'"
                        '.( $ninja_form_enabled_type == $ninja_form_type_both ? "checked" : "").' />
                            <strong>'. mo_( "Let the user Choose" ).'</strong>';

                    mo_draw_tooltip(MoMessages::showMessage(MoMessages::INFO_HEADER),MoMessages::showMessage(MoMessages::ENABLE_BOTH_BODY));

echo				'</p>
                    <div '.($ninja_form_enabled_type != $ninja_form_type_both ? "hidden" : "").' class="mo_registration_help_desc" id="nfb_instructions" >
                            '. mo_( "Follow the following steps to enable Phone and Email Verification for Ninja Form" ).':
                            <ol>
                                <li><a href="'.$ninja_form_list.'" target="_blank">Click Here</a> to see your list of forms.</li>
                                <li>'. mo_( "Click on the <b>Edit</b> option of your ninja form." ).'</li>
                                <li>'. mo_( "Add an Email and Phone Field to your form. Note the Field ID of the fields." ).'</li>
                                <li>'. mo_( "Make sure you have set the Input Mask type to None for the phone field." ).'</li>
                                <li>'. mo_( "Enter your Form ID, Email Field ID and Phone Field ID below:" ).'<br>
                                    <br/>'. mo_( "Add Form" ).': <input type="button"  value="+" '. $disabled .' onclick="add_ninja(\'both\',3);" class="button button-primary" />&nbsp;
                                    <input type="button" value="-" '. $disabled .' onclick="remove_ninja(3);" class="button button-primary" /><br/><br/>';

                                    $form_results = get_multiple_form_select($ninja_form_otp_enabled,FALSE,TRUE,$disabled,3,'ninja','ID');
                                    $counter3	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo'							</li>
                                <li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
                            </ol>
                    </div>
                </div>
            </div>';

            multiple_from_select_script_generator(FALSE,TRUE,'ninja','ID',[$counter1,$counter2,$counter3]);



