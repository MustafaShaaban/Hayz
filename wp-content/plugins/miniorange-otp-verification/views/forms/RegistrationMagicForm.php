<?php

use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;

echo' 	<div class="mo_otp_form" id="'.get_mo_class($handler).'"><input type="checkbox" '.$disabled.' id="crf_default" class="app_enable" data-toggle="crf_default_options" name="mo_customer_validation_crf_default_enable" value="1"
				'.$crf_enabled.' /><strong>'. $form_name . ' <i>( RegistrationMagic )</i></strong>';

echo'			<div class="mo_registration_help_desc" '.$crf_hidden.' id="crf_default_options">
					<b>'. mo_( "Choose between Phone or Email Verification").'</b>
					<p><input type="radio" '.$disabled.' id="crf_phone" data-toggle="crf_phone_instructions" class="form_options app_enable" name="mo_customer_validation_crf_enable_type" value="'.$crf_type_phone.'"
						'.( $crf_enable_type == $crf_type_phone ? "checked" : "" ).' />
							<strong>'. mo_( "Enable Phone Verification").'</strong>';

echo'					<div '.($crf_enable_type != $crf_type_phone ? "hidden" :"").' id="crf_phone_instructions" class="mo_registration_help_desc">
							'. mo_( "Follow the following steps to enable Phone Verification").':
							<ol>
								<li><a href="'.$crf_form_list.'" target="_blank">'. mo_( "Click Here").'</a> '. mo_( " to see your list of forms").'</li>
								<li>'. mo_( "Click on <b>fields</b> link of your form to see <i>special field</i> list of fields.").'</li>
								<li>'. mo_( "Choose <b>phone number / mobile number </b> field from the list.").'</li>
								<li>'. mo_( "Enter the <b>Label</b> of your new field. Keep this handy as you will need it later.").'</li>
								<li>'. mo_( "Under RULES section check the box which says <b>Is Required</b>.").'</li>
								<li>'. mo_( "Click on <b>Save</b> button to save your new field.").'<br/>
								<br/>'. mo_( "Add Form" ).' : <input type="button"  value="+" '. $disabled .' onclick="add_crf(\'phone\',2);" class="button button-primary" />&nbsp;
								<input type="button" value="-" '. $disabled .' onclick="remove_crf(2);" class="button button-primary" /><br/><br/>';

								$form_results = get_multiple_form_select($crf_form_otp_enabled,FALSE,TRUE,$disabled,2,'crf','Label');
								$crfcounter2 = !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo'											
								</li>								
								<li>'.mo_( "Click on the Save Button to save your settings and keep a track of your Form Ids." ).'</li>
							</ol>
						</div>
					</p>
					<p><input type="radio" '.$disabled.' id="crf_email" data-toggle="crf_email_instructions" class="form_options app_enable" name="mo_customer_validation_crf_enable_type" value="'.$crf_type_email.'"
						'.( $crf_enable_type == $crf_type_email ? "checked" : "").' />
						<strong>'. mo_( "Enable Email Verification").'</strong>
					</p>
					<div '.($crf_enable_type != $crf_type_email ? "hidden" :"").' id="crf_email_instructions" class="crf_form mo_registration_help_desc">
						<ol>
							<li><a href="'.$crf_form_list.'" target="_blank">'. mo_( "Click Here").'</a> '. mo_( " to see your list of forms").'</li>
							<li>'. mo_( "Click on <b>fields</b> link of your form to see <i>special field</i> list of fields.").'</li>
							<li>'. mo_( "Choose <b>email</b> field from the list.").'</li>
							<li>'. mo_( "Enter the <b>Label</b> of your new field. Keep this handy as you will need it later.").'</li>
							<li>'. mo_( "Under RULES section check the box which says <b>Is Required</b>.").'</li>
							<li>'. mo_( "Click on <b>Save</b> button to save your new field.").'<br/>
							<br/>'. mo_( "Add Form" ).' : <input type="button"  value="+" '. $disabled .' onclick="add_crf(\'email\',1);" class="button button-primary"/>&nbsp;
								<input type="button" value="-" '. $disabled .' onclick="remove_crf(1);" class="button button-primary" /><br/><br/>';

								$form_results = get_multiple_form_select($crf_form_otp_enabled,FALSE,TRUE,$disabled,1,'crf','Label');
								$crfcounter1 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo                        '</li>
						
							
							<li>'.mo_( "Click on the Save Button to save your settings and keep a track of your Form Ids." ).'</li>
						</ol>
					</div>
					<p><input type="radio" '.$disabled.' id="crf_both" data-toggle="crf_both_instructions"  class="form_options app_enable" name="mo_customer_validation_crf_enable_type" value="'.$crf_type_both.'"
						'.( $crf_enable_type == $crf_type_both? "checked" : "" ).' />
						<strong>'. mo_( "Let the user choose").'</strong>';

						mo_draw_tooltip(
						    MoMessages::showMessage(MoMessages::INFO_HEADER),MoMessages::showMessage(MoMessages::ENABLE_BOTH_BODY)
                        );

echo'				<div '.($crf_enable_type != $crf_type_both ? "hidden" :"").' id="crf_both_instructions" class="mo_registration_help_desc">
						'. mo_( "Follow the following steps to enable both Email and Phone Verification").':
						<ol>
							<li><a href="'.$crf_form_list.'" target="_blank">'. mo_( "Click Here").'</a> '. mo_( " to see your list of forms").'</li>
							<li>'. mo_( "Click on <b>fields</b> link of your form to see <i>special field</i> list of fields.").'</li>
							<li>'. mo_( "Choose <b>phone number / mobile number </b> field from the list.").'</li>
							<li>'. mo_( "Enter the <b>Label</b> of your new field. Keep this handy as you will need it later.").'</li>
							<li>'. mo_( "Under RULES section check the box which says <b>Is Required</b>.").'</li>
							<li>'. mo_( "Click on <b>Save</b> button to save your new field.").'<br/>
							<br/>'. mo_( "Add Form" ).' : <input type="button"  value="+" '. $disabled .' onclick="add_crf(\'both\',3);" class="button button-primary"/>&nbsp;
								<input type="button" value="-" '. $disabled .' onclick="remove_crf(3);" class="button button-primary" /><br/><br/>';

								$form_results = get_multiple_form_select($crf_form_otp_enabled,FALSE,TRUE,$disabled,3,'crf','Label');
                                $crfcounter3	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo                        '</li>
						
							
							<li>'.mo_( "Click on the Save Button to save your settings and keep a track of your Form Ids." ).'</li>
						</ol>
					</div>
				</p>
			</div>
		</div>';

        multiple_from_select_script_generator(FALSE,TRUE,'crf','Label',[$crfcounter1,$crfcounter2,$crfcounter3]);