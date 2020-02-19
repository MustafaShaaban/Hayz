<?php

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;

echo'		<div class="mo_otp_form" id="'.get_mo_class($handler).'">
		        <input  type="checkbox" 
		                '.$disabled.' 
		                id="wp_client" 
		                class="app_enable" 
		                data-toggle="wp_client_options" 
		                name="mo_customer_validation_wp_client_enable" value="1"
		                '.$wp_client_enabled.' />
                <strong>'. $form_name .'</strong>
                <div class="mo_registration_help_desc" '.$wp_client_hidden.' id="wp_client_options">
					
					<b>'. mo_("Choose between Phone or Email Verification").'</b>
					<p>
					    <input  type="radio" 
					            '.$disabled.' 
					            data-toggle="wp_client_phone_instructions" 
					            id="wp_client_phone" 
					            class="form_options app_enable" 
						        name="mo_customer_validation_wp_client_enable_type" 
						        value="'.$wp_client_type_phone.'"
							    '.( $wp_client_enable_type == $wp_client_type_phone ? "checked" : "").' />
                        <strong>'. mo_("Enable Phone verification").'</strong>
						
						<div    '.($wp_client_enable_type != $wp_client_type_phone ? "hidden" : "").' 
						        id="wp_client_phone_instructions" 
						        class="mo_registration_help_desc">
                                <input  type="checkbox" 
                                        '.$disabled.' 
                                        id="mo_customer_validation_wp_client_restrict_duplicates" 
                                        name="mo_customer_validation_wp_client_restrict_duplicates" 
                                        value="1"
                                        '.$restrict_duplicates.'/>
                                <strong>'. mo_( "Restrict Duplicate phone number to sign up." ).'</strong>
						</div>
					</p>
					<p>
					    <input  type="radio" 
					            '.$disabled.' 
					            id="wp_client_email" 
					            class="form_options app_enable" 
						        name="mo_customer_validation_wp_client_enable_type" 
						        value="'.$wp_client_type_email.'"
						        '.( $wp_client_enable_type == $wp_client_type_email? "checked" : "" ).' />
						<strong>'. mo_("Enable Email verification").'</strong>
					</p>
				</div>
			</div>';