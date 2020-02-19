<?php

use OTP\Helper\MoMessages;

echo'	<div class="mo_registration_divided_layout">
			<form name="f" method="post" action="'.$action.'" id="mo_otp_verification_settings">
			    <input type="hidden" id="error_message" name="error_message" value="">
				<input type="hidden" name="option" value="mo_customer_validation_settings" />';

					wp_nonce_field( $nonce );

                    if($formName && !$showConfiguredForms) {
                        include MOV_DIR . 'views/formsettings.php';
                    } else {
                        include MOV_DIR . 'views/formlist.php';
                    }
                    include MOV_DIR . 'views/configuredforms.php';

echo'		</form>
		</div>';