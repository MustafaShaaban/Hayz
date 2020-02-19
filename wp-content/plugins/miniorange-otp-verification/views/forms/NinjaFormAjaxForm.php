<?php

use OTP\Helper\MoUtility;

echo'	<div class="mo_otp_form" id="'.get_mo_class($handler).'"><input type="checkbox" '.$disabled.' id="ninja_form" class="app_enable" data-toggle="ninja_ajax_form_options" name="mo_customer_validation_nja_enable" value="1"
										'.$ninja_ajax_form_enabled.' /><strong>'. $form_name .'</strong>';

echo'							<div class="mo_registration_help_desc" '.$ninja_ajax_form_hidden.' id="ninja_ajax_form_options">
									<p><input type="radio" '.$disabled.' id="ninja_ajax_form_email" class="app_enable" data-toggle="nfae_instructions" name="mo_customer_validation_nja_enable_type" value="'.$ninja_ajax_form_type_email.'"
										'.( $ninja_ajax_form_enabled_type == $ninja_ajax_form_type_email ? "checked" : "").' />
										<strong>'. mo_( "Enable Email Verification" ).'</strong>
									</p>
									<div '.($ninja_ajax_form_enabled_type != $ninja_ajax_form_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="nfae_instructions" >
											'. mo_( "Follow the following steps to enable Email Verification for" ).' Ninja Form: 
											<ol>
												<li><a href="'.$ninja_ajax_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of forms" ).'</li>
												<li>'. mo_( "Click on the <b>Edit</b> option of your ninja form." ).'</li>
												<li>'. mo_( "Add an Email Field to your form. Note the Field Key of the email field. You will need to enable Dev Mode for this." ).'</li>
												<li>'. mo_( "Add an Verification Field to your form where users will enter the OTP received. Note the Field Key of the verification field." ).'</li>
												<li>'. mo_( "Enter your Form ID, the Email Field Key and the Verification Field Key below" ).':<br>
													<br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_ninja_ajax(\'email\',1);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_ninja_ajax(1);" class="button button-primary" /><br/><br/>';

													$form_results = get_multiple_form_select($ninja_ajax_form_otp_enabled,TRUE,TRUE,$disabled,1,'ninja_ajax','Key');
													$counter1 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'											</li>
												<li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="ninja_ajax_form_phone" class="app_enable" data-toggle="nfap_instructions" name="mo_customer_validation_nja_enable_type" value="'.$ninja_ajax_form_type_phone.'"
										'.( $ninja_ajax_form_enabled_type == $ninja_ajax_form_type_phone ? "checked" : "").' />
										<strong>'. mo_( "Enable Phone Verification" ).'</strong>
									</p>
									<div '.($ninja_ajax_form_enabled_type != $ninja_ajax_form_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="nfap_instructions" >
											'. mo_( "Follow the following steps to enable Phone Verification for Ninja Form" ).': 
											<ol>
												<li><a href="'.$ninja_ajax_form_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of forms" ).'</li>
												<li>'. mo_( "Click on the <b>Edit</b> option of your ninja form." ).'</li>
												<li>'. mo_( "Add an Phone Field to your form. Note the Field Key of the phone field. You will need to enable Dev Mode for this." ).'</li>
												<li>'. mo_( "Make sure you have set the Input Mask type to None for the phone field." ).'</li>
												<li>'. mo_( "Add an Verification Field to your form where users will enter the OTP received. Note the Field Key of the verification field." ).'</li>
												<li>'. mo_( "Enter your Form ID, the Phone Field Key and the Verification Field Key below" ).':<br>
													<br/>'. mo_( "Add Form " ).': <input type="button"  value="+" '. $disabled .' onclick="add_ninja_ajax(\'phone\',2);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_ninja_ajax(2);" class="button button-primary" /><br/><br/>';

                                                    $form_results = get_multiple_form_select($ninja_ajax_form_otp_enabled,TRUE,TRUE,$disabled,2,'ninja_ajax','Key');
													$counter2 	  = !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo'											</li>
												<li>'. mo_( "Click on the Save Button to save your settings" ).'</li>
											</ol>
									</div>
									<p style="margin-left:2%;">
                                        <i><b>'.mo_("Verification Button text").':</b></i>
                                        <input class="mo_registration_table_textbox" name="mo_customer_validation_nja_button_text" type="text" value="'.$button_text.'">					
                                    </p>
								</div>
							</div>';

                            multiple_from_select_script_generator(TRUE,TRUE,'ninja_ajax','Key',[$counter1,$counter2,0]);

