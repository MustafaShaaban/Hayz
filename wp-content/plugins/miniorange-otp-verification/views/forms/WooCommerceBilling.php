<?php

echo'	<div class="mo_otp_form" id="'.get_mo_class($handler).'">
	        <input  type="checkbox" '.$disabled.' 
	                id="wc_billing" 
	                class="app_enable"  
					data-toggle="wc_billing_options" 
					name="mo_customer_validation_wc_billing_enable" 
					value="1"
					'.$wc_billing_enable.' />
			<strong>'. mo_( "Woocommerce Billing Form" ).'</strong>';

echo'		<div class="mo_registration_help_desc" '.$wc_billing_hidden.' id="wc_billing_options">
				<b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
				<p>
				    <input  type="radio" '.$disabled.' 
				            id="wc_billing_phone" 
				            class="app_enable" 
				            name="mo_customer_validation_wc_billing_type_enabled" 
				            value="'.$wc_billing_type_phone.'"
						    '.($wc_billing_type_enabled == $wc_billing_type_phone ? "checked" : "" ).' />
                    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
				</p>
				<p>
				    <input  type="radio" '.$disabled.' 
				            id="wc_billing_email" 
				            class="app_enable" 
				            name="mo_customer_validation_wc_billing_type_enabled" 
				            value="'.$wc_billing_type_email.'"
						    '.($wc_billing_type_enabled == $wc_billing_type_email ? "checked" : "" ).' />
                    <strong>'. mo_( "Enable Email Verification" ).'</strong>
				</p>
				<p>
				    <input  type="checkbox" '.$disabled.' 
				            name="mo_customer_validation_wc_billing_restrict_duplicates" 
				            value="1"
				            '.$wc_restrict_duplicates.' />
                    <strong>'.
                        mo_( "Do not allow users to use the same Phone number or Email for multiple accounts." ).
                    '</strong>
				</p>
		</div></div>';