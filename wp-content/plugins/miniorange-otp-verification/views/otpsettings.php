<?php

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;

echo'	<div class="mo_registration_divided_layout mo-otp-full">
			<form name="f" method="post" action="" id="mo_otp_verification_settings">
			    <input type="hidden" name="option" value="mo_otp_extra_settings" />';

                wp_nonce_field( $nonce );

echo'			<div class="mo_registration_table_layout mo-otp-half">
					<table style="width:100%">
						<tr>
							<td>
								<h3>
									'.mo_("COUNTRY CODE: ").'
									<span style="float:right;margin-top:-10px;">
                                        <input  type="submit" '.$disabled.' 
                                                name="save" 
                                                class="button button-primary button-large" 
                                                value="'.mo_("Save Settings").'"/>
                                            <span   class="dashicons dashicons-arrow-up toggle-div" 
                                                    data-show="false" 
                                                    data-toggle="country_code_settings"></span>
                                    </span>
								</h3><hr>
							</td>
						</tr>
					</table>
					<div id="country_code_settings">
						<table style="width:100%">
							<tr>
							    <td><strong><i>'.mo_("Select Default Country Code").': </i></strong></td>
								<td>';
									get_country_code_dropdown();
echo							'</td>
                                <td>';
                                    mo_draw_tooltip(
                                        MoMessages::showMessage(MoMessages::COUNTRY_CODE_HEAD),
                                        MoMessages::showMessage(MoMessages::COUNTRY_CODE_BODY)
                                    );
echo                            '</td>
							</tr>
							<tr>
							    <td></td>
							    <td><i style="margin-left:1%">'.mo_("Country Code").': <span id="country_code"></span></i></td>
							    <td></td>
							</tr>
							<tr>
								<td colspan="3">
								    <input  type="checkbox" '.$disabled.' 
								            name="show_dropdown_on_form"
								            id="dropdownEnable" 
								            value="1"'.$show_dropdown_on_form.' />
								    '.mo_("Show a country code dropdown on the phone field.").'
                                </td>
							</tr>
							<tr><td colspan="3"></td></tr>
							<tr><td colspan="3"></td></tr>
						</table>
					</div>
				</div>
				<div id="otpLengthValidity" class="mo_registration_table_layout mo-otp-half">';

echo'	            <table style="width:100%">
                        <tr>
                            <td colspan="2">
                                <h3>
                                    '.mo_("OTP PROPERTIES: ").'
                                    <span style="float:right;margin-top:-10px;">';
                                            if(!$showTransactionOptions)
                                            {
echo'                                           <input  type="submit" '.$disabled.' 
                                                        name="save" 
                                                        class="button button-primary button-large" 
                                                        value="'.mo_("Save Settings").'"/>';
                                            }
echo'                                       <span  class="dashicons dashicons-arrow-up toggle-div" 
                                                    data-show="false" 
                                                    data-toggle="otp_settings">                                                    
                                            </span>
                                    </span>
                                </h3>
                                <hr>
                            </td>
                        </tr>
                    </table>
                    <div id="otp_settings">';

                if($showTransactionOptions)
                {
                    echo '<table>
                            <tr>
                                <td><strong><i>'.mo_("OTP LENGTH: ").'</i></strong></td>
                                <td><strong><i>'.mo_("OTP VALIDITY (in mins): ").'</i></strong></td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <div class="mo_otp_note" style="padding:10px;">
                                        <div class="mo_otp_dropdown_note">
                                            <a href="'.MoConstants::FAQ_BASE_URL.'change-length-otp/" target="_blank">
                                                '.mo_("Click here to see how you can change OTP Length").'
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td width="50%">
                                    <div class="mo_otp_note" style="padding:10px;">
                                        <div class="mo_otp_dropdown_note">
                                            <a href="'.MoConstants::FAQ_BASE_URL.'change-time-otp-stays-valid/" target="_blank">
                                                '.mo_("Click here to see how you can change OTP Validity").'</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                }
                else
                {

					echo'<table>
							<tr>
                                <td><strong><i>'.mo_("OTP LENGTH: ").'</i></strong></td>
                                <td><strong><i>'.mo_("OTP VALIDITY (in mins): ").'</i></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <input  type="text" 
                                            class="mo_registration_table_textbox" 
                                            value="'.$mo_otp_length.'" 
                                            name="mo_otp_length"/>
                                    <div class="mo_otp_note" style="color:#942828;">
                                        <i>'.mo_("Enter the length that you want the OTP to be. Default is 5").'</i>
                                    </div>
                                </td>
                                <td>
                                    <input  type="text" 
                                            class="mo_registration_table_textbox" 
                                            value="'.$mo_otp_validity.'" 
                                            name="mo_otp_validity"/>
                                    <div class="mo_otp_note" style="color:#942828;">
                                        <i>'.mo_("Enter the time in minutes an OTP will stay valid for. Default is 5 mins").'</i>
                                    </div>
                                </td>
                            </tr>';
                }

    echo'    		    </table>
    		        </div>
                </div>
				<div id="blockedEmailList" class="mo_registration_table_layout mo-otp-half">
					<table style="width:100%">
						<tr>
							<td colspan="2">
								<h3>
									<i>'.mo_("BLOCKED EMAIL DOMAINS: ").'</i>
									<span style="float:right;margin-top:-10px;">
									    <input  type="submit" '.$disabled.' 
									            name="save"  
                                                class="button button-primary button-large" 
                                                value="'.mo_("Save Settings").'"/>
                                        <span   class="dashicons dashicons-arrow-up toggle-div" 
                                                data-show="false" 
                                                data-toggle="blocked_email_settings">
                                        </span>
                                    </span>
								</h3><hr>
							</td>
						</tr>
					</table>
					<div id="blocked_email_settings">
						<table style="width:100%">
							<tr>
								<td colspan="2">
								    <textarea   name="mo_otp_blocked_email_domains" 
								                rows="5" 
									            placeholder="'.mo_(" Enter semicolon separated domains that 
                                                you want to block. Eg. gmail.com ").'">'.
                                        $otp_blocked_email_domains.
                                    '</textarea>
                                </td>
							</tr>
						</table>
					</div>
				</div>
				<div id="blockedPhoneList" class="mo_registration_table_layout mo-otp-half">
					<table style="width:100%">
						<tr>
							<td colspan="2">
								<h3>
									<i>'.mo_("BLOCKED PHONE NUMBERS: ").'</i>
									<span style="float:right;margin-top:-10px;">
									    <input  type="submit" '.$disabled.' 
									            name="save"  
                                                class="button button-primary button-large" 
                                                value="'.mo_("Save Settings").'"/>
									    <span   class="dashicons dashicons-arrow-up toggle-div" 
									            data-show="false" 
									            data-toggle="blocked_sms_settings"></span>
									</span>
								</h3><hr>
							</td>
						</tr>
					</table>
					<div id="blocked_sms_settings">
						<table style="width:100%">
							<tr>
								<td colspan="2">
								    <textarea   name="mo_otp_blocked_phone_numbers" 
								                rows="5" 
									            placeholder="'.mo_(" Enter semicolon separated phone numbers 
									            (with country code) that you want to block. Eg. +1XXXXXXXX ").'">'.
                                    $otp_blocked_phones.
                                    '</textarea>
                                </td>
							</tr>	
						</table>
					</div>
				</div>
			</form>
		</div>';
