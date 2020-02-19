<?php

use OTP\Helper\MoUtility;

echo'	<div class="mo_otp_form" id="'.get_mo_class($handler).'">
	        <input  type="checkbox" '.$disabled.' 
	                id="frm_form" 
	                class="app_enable" 
	                data-toggle="frm_form_options" 
	                name="mo_customer_validation_frm_form_enable" 
	                value="1"'.$frm_form_enabled.' />
	        <strong>'. $form_name .'</strong>';


echo'		<div class="mo_registration_help_desc" 
                 '.$frm_form_hidden.' 
                 id="frm_form_options">
                <p>
                    <input  type="radio" '.$disabled.' 
                            id="frm_form_email" 
                            class="app_enable" 
                            data-toggle="nfe_instructions" 
                            name="mo_customer_validation_frm_form_enable_type" 
                            value="'.$frm_form_type_email.'"
                            '.( $frm_form_enabled_type == $frm_form_type_email ? "checked" : "").' />
                    <strong>'. mo_( "Enable Email Verification" ).'</strong>
                </p>
                <div    '.($frm_form_enabled_type != $frm_form_type_email ? "hidden" :"").' 
                        class="mo_registration_help_desc" 
                        id="nfe_instructions" >
                        '. mo_( "Follow the following steps to enable Email Verification for Formidable Form" ).': 
                        <ol>
                            <li>
                                <a href="'.$frm_form_list.'" target="_blank">'.
                                    mo_("Click Here" ).
                                '</a> '. mo_(" to see your list of forms" ).'
                            </li>
                            <li>'. mo_("Note the ID of the form and Click on the <b>Edit</b> option of your Formidable form." ).'</li>
                            <li>'. mo_("Add an Email Field to your form. Note the Field Settings ID of the email field." ).'</li>
                            <li>'.
                                    mo_("Add another Text Field to your form for Entering OTP. ".
                                       "Note the Field Settings ID of the OTP Verification field." ).
                            '</li>
                            <li>'. mo_( "Make both Email Field and Verification Field Required." ).'</li>
                            <li>'. mo_( "Enter your Form ID, Email Field ID and Verification Field ID below" ).':
                                    <br><br/>'. mo_( "Add Form " ).': 
                                    <input  type="button"  
                                            value="+" '. $disabled .' 
                                            onclick="add_frm(\'email\',1);" 
                                            class="button button-primary" />&nbsp;
                                    <input  type="button"    
                                            value="-" '. $disabled .' 
                                            onclick="remove_frm(1);" 
                                            class="button button-primary" />
                                    <br/><br/>';

                                    $form_results = get_multiple_form_select (
                                        $frm_form_otp_enabled,
                                        TRUE,
                                        TRUE,
                                        $disabled,
                                        1,
                                        'frm',
                                        'ID'
                                    );
                                    $counter1 = !MoUtility::isBlank($form_results['counter'])
                                                ? max($form_results['counter']-1,0) : 0 ;

echo'					    </li>
                            <li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
                        </ol>
                </div>
                <p>
                    <input  type="radio" '.$disabled.' 
                            id="frm_form_phone" 
                            class="app_enable" 
                            data-toggle="nfp_instructions" 
                            name="mo_customer_validation_frm_form_enable_type" 
                            value="'.$frm_form_type_phone.'"
                            '.( $frm_form_enabled_type == $frm_form_type_phone ? "checked" : "").' />
                    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
                </p>
                <div    '.($frm_form_enabled_type != $frm_form_type_phone ? "hidden" : "").' 
                        class="mo_registration_help_desc" id="nfp_instructions" >
                        '. mo_( "Follow the following steps to enable Phone Verification for Formidable Form" ).': 
                        <ol>
                            <li>
                                <a href="'.$frm_form_list.'" target="_blank">'.
                                    mo_( "Click Here" ).
                                '</a> '.
                                mo_( " to see your list of forms" ).
                            '</li>
                            <li>'. mo_( "Note the ID of the form and Click on the <b>Edit</b> option of your Formidable form." ).'</li>
                            <li>'. mo_( "Add a Phone Field to your form. Note the Field Settings ID of the phone field." ).'</li>
                            <li>'.
                                    mo_( "Add another Text Field to your form for Entering OTP. ".
                                        "Note the Field Settings ID of the OTP Verification field." ).'
                            </li>
                            <li>'. mo_( "Make both Phone Field and Verification Field Required." ).'</li>
                            <li>'. mo_( "Enter your Form ID, Phone Field ID and Verification Field ID below" ).':<br>
                                <br/>'. mo_( "Add Form " ).': 
                                <input  type="button"  
                                        value="+" '. $disabled .' 
                                        onclick="add_frm(\'phone\',2);" 
                                        class="button button-primary" />&nbsp;
                                <input  type="button" 
                                        value="-" '. $disabled .' 
                                        onclick="remove_frm(2);" 
                                        class="button button-primary" /><br/><br/>';

                                $form_results = get_multiple_form_select (
                                    $frm_form_otp_enabled,
                                    TRUE,
                                    TRUE,
                                    $disabled,
                                    2,
                                    'frm',
                                    'ID'
                                );
                                $counter2 = !MoUtility::isBlank($form_results['counter'])
                                            ? max($form_results['counter']-1,0) : 0 ;
echo'						</li>
                            <li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
                        </ol>
                </div>
                <p style="margin-left:2%;">
					<i><b>'.mo_("Verification Button text").':</b></i>
					<input  class="mo_registration_table_textbox" 
					        name="mo_customer_validation_frm_button_text" 
					        type="text" 
					        value="'.$button_text.'">			
				</p>
            </div>
        </div>';

        multiple_from_select_script_generator(
            TRUE,
            TRUE,
            'frm',
            'ID',
            [$counter1,$counter2,0]
        );
