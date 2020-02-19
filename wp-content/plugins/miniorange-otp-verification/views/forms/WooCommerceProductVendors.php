<?php

echo'	<div class="mo_otp_form" id="'.get_mo_class($handler).'">
	        <input  type="checkbox" '.$disabled.' 
	                id="wc_pv_default" 
	                data-toggle="wc_pv_default_options" 
	                class="app_enable" 
	                name="mo_customer_validation_wc_pv_default_enable" 
	                value="1"
		            '.$wc_pv_registration.' />
            <strong>'.$form_name.'</strong>';

echo'		<div class="mo_registration_help_desc" '.$wc_pv_hidden.' id="wc_pv_default_options">
				<b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
				<p>
					<input  type="radio" '.$disabled.' 
					        id="wc_pv_phone" 
					        class="app_enable" 
					        data-toggle="wc_pv_phone_options" 
					        name="mo_customer_validation_wc_pv_enable_type" 
					        value="'.$wc_pv_reg_type_phone.'"
						    '.($wc_pv_enable_type == $wc_pv_reg_type_phone ? "checked" : "" ).'/>
				    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
				</p>
				<div '.($wc_pv_enable_type != $wc_pv_reg_type_phone  ? "hidden" :"").' 
				        class="mo_registration_help_desc" 
						id="wc_pv_phone_options" >
						<input  type="checkbox" '.$disabled.' 
						        name="mo_customer_validation_wc_pv_restrict_duplicates" value="1"
								'.$wc_pv_restrict_duplicates.' />
                        <strong>'. mo_( "Do not allow users to use the same phone number for multiple accounts." ).'</strong>
				</div>
				<p>
					<input  type="radio" '.$disabled.' 
					        id="wc_pv_email" 
					        class="app_enable" 
					        name="mo_customer_validation_wc_pv_enable_type" 
					        value="'.$wc_pv_reg_type_email.'"
						    '.($wc_pv_enable_type == $wc_pv_reg_type_email? "checked" : "" ).'/>
					<strong>'. mo_( "Enable Email Verification" ).'</strong>
				</p>
			</div>
		</div>';