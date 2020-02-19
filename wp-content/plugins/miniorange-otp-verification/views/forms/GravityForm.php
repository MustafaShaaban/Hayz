<?php

use OTP\Helper\MoUtility;

echo'			<div class="mo_otp_form" id="'.get_mo_class($handler).'">
			                    <input  type="checkbox" '.$disabled.'
			                            id="gf_contact" class="app_enable"
			                            data-toggle="gf_contact_options"
			                            name="mo_customer_validation_gf_contact_enable"
			                            value="1" '.$gf_enabled.' /><strong>'. $form_name . '</strong>';

echo'							<div class="mo_registration_help_desc" '.$gf_hidden.' id="gf_contact_options">
									<p><input 	type="radio" '.$disabled.' id="gf_contact_email" class="app_enable"
												data-toggle="gf_contact_email_instructions"
												name="mo_customer_validation_gf_contact_type"
												value="'.$gf_type_email.'"
												'.( $gf_enabled_type == $gf_type_email ? "checked" : "").' />
										<strong>'. mo_( "Enable Email Verification" ).'</strong>
									</p>

										<div '.($gf_enabled_type != $gf_type_email ? "hidden" :"").'
										     class="mo_registration_help_desc" id="gf_contact_email_instructions" >
											'. mo_( "Follow the following steps to enable Email Verification for" ).' Gravity form:
											<ol>
												<li><a href="'.$gf_field_list.'" target="_blank">
												    '. mo_( "Click Here" ).'</a> '. mo_( " to see your list of the Gravity Forms." ).'
												</li>
												<li>'. mo_( "Click on the Edit option of your form" ).'</li>
												<li>'. mo_( "Add an email field to your existing form" ).'</li>
												<li>'. mo_( "Add a text field with label \"Enter Validation Code\" in your existing form." ).'</li>
												<li>'. mo_( "Click on the Edit option of your form" ).'
												<li>'. mo_("Add the form id of your form below for which you want to enable Email verification:").'<br>
												<br/>'.mo_( "Add Form" ).' : <input  type="button"  value="+" '. $disabled .'
                                                                                            onclick="add_gravity(\'email\',1);"
                                                                                            class="button button-primary" />&nbsp;
													    <input  type="button" value="-" '. $disabled .'
													            onclick="remove_gravity(1);"
													            class="button button-primary" /><br/><br/>';

                                                $gf_form_results = get_multiple_form_select(
                                                    $gf_otp_enabled,TRUE,TRUE,$disabled,1,'gravity','Label'
                                                );
                                                $gfcounter1= !MoUtility::isBlank($gf_form_results['counter']) ? max($gf_form_results['counter']-1,0) : 0 ;

echo'
												</li>
												<li>'.mo_( "Click on the Save Button to save your settings and keep a track of your Form Ids." ).'</li>
											</ol>
									</div>
									<p><input 	type="radio" '.$disabled.' id="gf_contact_phone" class="app_enable"
												data-toggle="gf_contact_phone_instructions"
												name="mo_customer_validation_gf_contact_type"
												value="'.$gf_type_phone.'"
										'.( $gf_enabled_type == $gf_type_phone ? "checked" : "").' />
										<strong>'. mo_( "Enable Phone Verification" ).'</strong>
									</p>
									<div '.($gf_enabled_type != $gf_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="gf_contact_phone_instructions" >
											'. mo_( "Follow the following steps to enable phone Verification for Gravity form" ).':
											<ol>
												<li><a href="'.$gf_field_list.'" target="_blank">
												    '. mo_( "Click Here" ).'</a> '. mo_( " to see your list of the Gravity Forms." ).'</li>
												<li>'. mo_( "Click on the Edit option of your form" ).'</li>
												<li>'. mo_( "Add an phone field to your existing form" ).'</li>
												<li>'. mo_( "Add a text field with label \"Enter Validation Code\" in your existing form." ).'</li>
												<li>'. mo_( "Add the form id of your form below for which you want to enable Phone verification" ).':<br>
												<br/>'. mo_( "Add Form" ).' : <input type="button"  value="+" '. $disabled .'
												                                            onclick="add_gravity(\'phone\',2);"
												                                            class="button button-primary"/>&nbsp;
                                                    <input  type="button" value="-" '. $disabled .'
                                                            onclick="remove_gravity(2);"
                                                            class="button button-primary" /><br/><br/>';

                                                $gf_form_results = get_multiple_form_select(
                                                    $gf_otp_enabled,TRUE,TRUE,$disabled,2,'gravity','Label'
                                                );
                                                $gfcounter2	 = !MoUtility::isBlank($gf_form_results['counter']) ? max($gf_form_results['counter']-1,0) : 0 ;


echo                        	  				'</li>


												<li>'.mo_( "Click on the Save Button to save your settings and keep a track of your Form Ids." ).'</li>
											</ol>
									</div>
									<p style="margin-left:2%;">
                                        <i><b>'.mo_("Verification Button text").':</b></i>
                                        <input  class="mo_registration_table_textbox"
                                                name="mo_customer_validation_gf_button_text"
                                                type="text" value="'.$gf_button_text.'">
                                    </p>

								</div>
							</div>';


                            multiple_from_select_script_generator(TRUE,TRUE,'gravity','Label',[$gfcounter1,$gfcounter2,0]);
