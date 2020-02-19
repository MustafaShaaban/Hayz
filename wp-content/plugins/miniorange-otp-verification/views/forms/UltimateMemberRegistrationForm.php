<?php

use OTP\Helper\MoMessages;

echo'		<div class="mo_otp_form" id="'.get_mo_class($handler).'">
		        <input  type="checkbox" '.$disabled.' 
		                id="um_default" 
		                data-toggle="um_default_options" 
		                class="app_enable" 
		                name="mo_customer_validation_um_default_enable" 
		                value="1"
					    '.$um_enabled.' /><strong>'. $form_name . '</strong>';

echo'		<div class="mo_registration_help_desc" '.$um_hidden.' id="um_default_options">
				<b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
				
				<!--------------------------------------------------------------------------------------------
                                                              UM AJAX 
                 --------------------------------------------------------------------------------------------->
				<p>
                    <input  type ="checkbox" 
                            '.$disabled.' 
                            id ="um_mo_view" 
                            data-toggle = "um_mo_ajax_view_option" 
                            class="app_enable" 
                            name = "mo_customer_validation_um_is_ajax_form" 
                            value= "1"
                            '.$is_ajax_mode_enabled.'/>
                    <Strong>'. mo_( "Do not show a popup. Validate user on the form itself." ).'</strong>
                    
                    <!--------------------------------------------------------------------------------------------
                                                           UM AJAX OPTIONS
                    --------------------------------------------------------------------------------------------->
                    <div  '. ($is_ajax_form ? "" : "hidden") .' 
                           id="um_mo_ajax_view_option" 
                           class="mo_registration_help_desc">
                        <div class="mo_otp_note" style="color:red">
                            '. mo_( "This mode does not work with Let the user choose option. 
                                    Please use either phone or email only." ).'
                        </div>   
                        '. mo_( "You will need to add a verification field on your form, for users to enter their OTP." ).'
                        <ol>
							<li>
							    <a href="'.$um_forms.'"  target="_blank">'.
                                    mo_( "Click Here" ).
                                '</a> '. mo_( " to see your list of forms" ).'
							</li>
							<li>'. mo_( "Click on the <b>Edit link</b> of your form." ).'</li>
							<li>
							    '. mo_( "Add a new <b>OTP Verification</b> Field. 
                                        Note the meta key and enter it below.").'
                            </li>
							<li>'. mo_( "Click on <b>update</b> to save your form." ).'</li>
						</ol>
						<p style="margin-left:2%;">
                            <i><b>'.mo_("Verification Field Meta Key").':</b></i>
                            <input  class="mo_registration_table_textbox" 
                                    name="mo_customer_validation_um_verify_meta_key" 
                                    type="text" 
                                    value="'.$um_otp_meta_key.'">					
                        </p>
                        <p style="margin-left:2%;">
                            <i><b>'.mo_("Verification Button text").':</b></i>
                            <input  class="mo_registration_table_textbox" 
                                    name="mo_customer_validation_um_button_text" 
                                    type="text" 
                                    value="'.$um_button_text.'">					
                        </p>
                    </div>
			    </p>
			    
			    <!--------------------------------------------------------------------------------------------
                                                             UM PHONE
                --------------------------------------------------------------------------------------------->
				<p>
					<input  type="radio" '.$disabled.' 
					        id="um_phone" 
					        data-toggle="um_phone_instructions" 
					        class="app_enable" 
					        name="mo_customer_validation_um_enable_type" 
					        value="'.$um_type_phone.'"
					        '.( $um_enabled_type == $um_type_phone ? "checked" : "").'/>
				    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
					
					<!--------------------------------------------------------------------------------------------
                                                           UM PHONE OPTIONS
                    --------------------------------------------------------------------------------------------->
					<div '.($um_enabled_type != $um_type_phone ? "hidden" : "").' 
					     id="um_phone_instructions" 
					     class="mo_registration_help_desc">
						 '. mo_( "Follow the following steps to enable Phone Verification" ).':
						<ol>
							<li>
							    <a href="'.$um_forms.'" target="_blank">'.
                                    mo_( "Click Here" ).'
							    </a> '. mo_( " to see your list of forms" ).'
							</li>
							<li>'. mo_( "Click on the <b>Edit link</b> of your form." ).'</li>
							<li>'. mo_( "Add a new <b>Mobile Number</b> Field from the list of predefined fields." ).'</li>
							<li>'. mo_( "Enter the phone User Meta Key" );

                                    mo_draw_tooltip(
                                        MoMessages::showMessage(MoMessages::META_KEY_HEADER),
                                        MoMessages::showMessage(MoMessages::META_KEY_BODY)
                                    );

echo'					            : <input class="mo_registration_table_textbox"
                                             id="mo_customer_validation_um_phone_key_1_0"
                                             name="mo_customer_validation_um_phone_key"
                                             type="text"
                                             value="'.$um_register_field_key.'">
                                    <div class="mo_otp_note">
                                        '.mo_( "If you don't know the metaKey against which the phone number 
                                                is stored for all your users then put the default value as phone." ).'
									</div>
						    </li>
						</ol>
						<input  type="checkbox" '.$disabled.' 
						        name="mo_customer_validation_um_restrict_duplicates" 
						        value="1"'.$um_restrict_duplicates.'/>
				        <strong>'. mo_( "Do not allow users to use the same phone number for multiple accounts." ).'</strong>
					</div>
				</p>
				
				<!--------------------------------------------------------------------------------------------
                                                             UM EMAIL
                --------------------------------------------------------------------------------------------->
				<p>
					<input  type="radio" '.$disabled.' 
					        id="um_email" 
					        class="app_enable" 
					        name="mo_customer_validation_um_enable_type" 
					        value="'.$um_type_email.'"
					        '.( $um_enabled_type == $um_type_email ? "checked" : "").' />
				    <strong>'. mo_( "Enable Email Verification" ).'</strong>
				</p>
				
				<!--------------------------------------------------------------------------------------------
                                                             UM BOTH
                --------------------------------------------------------------------------------------------->
				<p>
					<input  type="radio" '.$disabled.' 
					        id="um_both" 
					        data-toggle="um_both_instructions" 
					        class="app_enable" 
					        name="mo_customer_validation_um_enable_type" 
					        value="'.$um_type_both.'"
						    '.( $um_enabled_type == $um_type_both ? "checked" : "").' />
				    <strong>'. mo_( "Let the user choose" ).'</strong>';

                    mo_draw_tooltip(
                        MoMessages::showMessage(MoMessages::INFO_HEADER),
                        MoMessages::showMessage(MoMessages::ENABLE_BOTH_BODY)
                    );

echo'				<!--------------------------------------------------------------------------------------------
                                                         UM BOTH OPTIONS
                    --------------------------------------------------------------------------------------------->
                    <div '.($um_enabled_type != $um_type_both ? "hidden" : "").' 
                        id="um_both_instructions" 
                        class="mo_registration_help_desc">
						'. mo_( "Follow the following steps to enable Email and Phone Verification" ).':
						<ol>
							<li>
							    <a href="'.$um_forms.'">'.
                                    mo_( "Click Here" ).'
							    </a> '. mo_( " to see your list of forms" ).'
							</li>
							<li>'. mo_( "Click on the <b>Edit link</b> of your form." ).'</li>
							<li>'. mo_( "Add a new <b>Mobile Number</b> Field from the list of predefined fields." ).'</li>
							<li>'. mo_( "Enter the phone User Meta Key" );

                                    mo_draw_tooltip(
                                        MoMessages::showMessage(MoMessages::META_KEY_HEADER),
                                        MoMessages::showMessage(MoMessages::META_KEY_BODY)
                                    );

echo'					            : <input class="mo_registration_table_textbox"
                                             id="mo_customer_validation_um_phone_key_2_0"
                                             name="mo_customer_validation_um_phone_key"
                                             type="text"
                                             value="'.$um_register_field_key.'">
                                    <div class="mo_otp_note">
                                        '.mo_( "If you don't know the metaKey against which the phone number 
                                                is stored for all your users then put the default value as phone." ).'
									</div>
							</li>
						</ol>
						<input  type="checkbox" '.$disabled.' 
						        name="mo_customer_validation_um_restrict_duplicates" 
						        value="1"'.$um_restrict_duplicates.'/>
				        <strong>'. mo_( "Do not allow users to use the same phone number for multiple accounts." ).'</strong>
					</div>
				</p>
			</div>
		</div>';