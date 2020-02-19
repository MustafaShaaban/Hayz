<?php

use OTP\Helper\MoMessages;

echo'	<div class="mo_otp_form" id="'.get_mo_class($handler).'">
							<input type="checkbox" '.$disabled.' id="upme_default" class="app_enable" data-toggle="upme_default_options" name="mo_customer_validation_upme_default_enable" value="1"
								 '.$upme_enabled.' /><strong>'. $form_name .'</strong>';

echo '								<div class="mo_registration_help_desc" '.$upme_hidden.' id="upme_default_options">
									<b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
									<p><input type="radio" '.$disabled.' data-toggle="upme_phone_instructions" id="upme_phone" class="form_options app_enable" name="mo_customer_validation_upme_enable_type" value="'.$upme_type_phone.'"
										'.( $upme_enable_type == $upme_type_phone ? "checked" : "").' />
											<strong>'. mo_( "Enable Phone Verification" ).'</strong>';

echo'									</p>
										<div '.($upme_enable_type != $upme_type_phone ? "hidden" : "").' id="upme_phone_instructions" class="mo_registration_help_desc">
											'. mo_( "Follow the following steps to enable Phone Verification" ).':
											<ol>
												<li><a href="'.$upme_field_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of fields" ).'</li>
												<li>'. mo_( "Click on <b>Click here to add new field</b> button to add a new phone field." ).' </li>
												<li>'. mo_( "Fill up the details of your new field and click on <b>Submit New Field</b>." ).' </li>
												<li>'. mo_( "Keep the <b>Meta Key</b> handy as you will need it later on." ).' </li>
												<li>'. mo_( "Enter the Meta Key of the phone field" ).': <input class="mo_registration_table_textbox" id="mo_customer_validation_upme_phone_field_key" name="mo_customer_validation_upme_phone_field_key" type="text" value="'.$upme_field_key.'"></li>
											</ol>
										</div>

									<p><input type="radio" '.$disabled.' id="upme_email" class="form_options app_enable" name="mo_customer_validation_upme_enable_type" value="'.$upme_type_email.'"
										'.( $upme_enable_type == $upme_type_email ? "checked" : "").' />
											<strong>'. mo_( "Enable Email Verification" ).'</strong>
									</p>
									<p><input type="radio" '.$disabled.' data-toggle="upme_both_instructions" id="upme_both" class="form_options app_enable" name="mo_customer_validation_upme_enable_type" value="'.$upme_type_both.'"
										'.( $upme_enable_type == $upme_type_both ? "checked" : "").' />
											<strong>'. mo_( "Let the user choose" ).'</strong>';

										mo_draw_tooltip(
										    MoMessages::showMessage(MoMessages::INFO_HEADER),
                                            MoMessages::showMessage(MoMessages::ENABLE_BOTH_BODY)
                                        );

echo'									<div '.($upme_enable_type != $upme_type_both ? "hidden" :"").' id="upme_both_instructions" class="mo_registration_help_desc">
											'. mo_( "Follow the following steps to enable both Email and Phone Verification" ).':
											<ol>
												<li><a href="'.$upme_field_list.'" target="_blank">'. mo_( "Click Here" ).'</a> '. mo_( " to see your list of fields" ).'</li>
												<li>'. mo_( "Click on <b>Click here to add new field</b> button to add a new phone field." ).'</li>
												<li>'. mo_( "Fill up the details of your new field and click on <b>Submit New Field</b>." ).'</li>
												<li>'. mo_( "Keep the <b>Meta Key</b> handy as you will need it later on." ).'</li>
												<li>'. mo_( "Enter the Meta Key of the phone field" ).': <input class="mo_registration_table_textbox" id="mo_customer_validation_upme_phone_field_key1" name="mo_customer_validation_upme_phone_field_key" type="text" value="'.$upme_field_key.'"></li>
											</ol>
										</div>
									</p>
								</div>
							</div>';