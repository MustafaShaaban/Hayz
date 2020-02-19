<?php

use OTP\Helper\MoUtility;

echo'		<div class="mo_otp_form" id="'.get_mo_class($handler).'"><input type="checkbox" '.$disabled.' id="formMaker" class="app_enable" 
                data-toggle="formMaker_form_options" name="mo_customer_validation_fm_enable" value="1"
                    '.$formMaker_form_enabled.' /><strong>'. $form_name . '</strong>';

echo'       <div class = "mo_registration_help_desc" '.$formMaker_form_hidden.'  id="formMaker_form_options">
                <p><input type="radio" '.$disabled.' id="formMaker_form_email" class="app_enable" data-toggle="fme_instructions" 
                    name="mo_customer_validation_fm_enable_type" value="'.$formMaker_form_type_email.'"
                    '.($formMaker_form_enabled_type == $formMaker_form_type_email ? "checked" : "").' />
                    <strong>'. mo_("Enable Email Verification").'</strong>
                </p>
                <div '.($formMaker_form_enabled_type != $formMaker_form_type_email ? "hidden" : "").' class ="mo_registration_help_desc" id="fme_instructions">
                    '. mo_( "Follow the following steps to enable Email Verification for Form Maker Forms" ).' 
                    <ol>
                    <li><a href="'.$formmaker_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of Form Maker forms" ).'</li>
                    <li>'. mo_( "Click on the <b>Edit</b> option of your Form Maker form." ).'</li>
                    <li>'. mo_( "Add an Email Field to your form. Note the Field label of the email field." ).'</li>
                    <li>'. mo_( "Add a Verification Field to your form where users will enter the OTP received. Keep the field required. Note the Field label of the verification field." ).'</li>
                    <li>'. mo_( "Enter your Form ID, the Email Field label and the Verification Field label below" ).':<br>
                        <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_formmaker(\'email\',1);" class="button button-primary" />&nbsp;
                                                    <input type="button" value="-" '. $disabled .' onclick="remove_formmaker(1);" class="button button-primary" /><br/><br/>';

                        $form_results = get_multiple_form_select($formMaker_form_otp_enabled,TRUE,TRUE,$disabled,1,'formmaker','Label');
                        $counter1 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'					</li>
                        <li>'. mo_( "Click on the Save Button below to save your settings" ).'</li>
                    </ol>
                </div>

                <p><input type="radio" '.$disabled.' id="formMaker_form_phone" class="app_enable" data-toggle="fmp_instructions" 
                    name="mo_customer_validation_fm_enable_type" value="'.$formMaker_form_type_phone.'"
                    '.($formMaker_form_enabled_type == $formMaker_form_type_phone ? "checked" : "").' />
                    <strong>'. mo_("Enable Phone Verification").'</strong>
                </p>
                <div '.($formMaker_form_enabled_type != $formMaker_form_type_phone ? "hidden" : "").' class ="mo_registration_help_desc" id="fmp_instructions">
                     '. mo_( "Follow the following steps to enable Phone Verification for Form Maker Forms" ).' 
                     <ol>
                     <li><a href="'.$formmaker_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of Form Maker forms" ).'</li>
                     <li>'. mo_( "Click on the <b>Edit</b> option of your Form Maker form." ).'</li>
                     <li>'. mo_( "Add an Phone Field to your form. Note the Field label of the Phone field." ).'</li>
                     <li>'. mo_( "Add a Verification Field to your form where users will enter the OTP received. Keep the field required. Note the Field label of the verification field." ).'</li>
                     <li>'. mo_( "Enter your Form ID, the Phone Field label and the Verification Field label below" ).':<br>
                        <br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_formmaker(\'phone\',2);" class="button button-primary" />&nbsp;
                                                    <input type="button" value="-" '. $disabled .' onclick="remove_formmaker(2);" class="button button-primary" /><br/><br/>';

                        $form_results = get_multiple_form_select($formMaker_form_otp_enabled,TRUE,TRUE,$disabled,2,'formmaker','Label');
                        $counter2 =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'       			</li>
                        <li>'. mo_( "Click on the Save Button below to save your settings" ).'</li>
                    </ol>
                </div>
                <p style="margin-left:2%;">
					<i><b>'.mo_("Verification Button text").':</b></i>
					<input class="mo_registration_table_textbox" name="mo_customer_validation_fm_button_text" type="text" value="'.$button_text.'">					
				</p>
            </div>
        </div>';

        multiple_from_select_script_generator(TRUE,TRUE,'formmaker','Label',[$counter1,$counter2,0]);





