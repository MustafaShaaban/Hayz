<?php

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;

echo'
    <div class="mo_registration_divided_layout mo-otp-full">
        <div class="mo_registration_pricing_layout mo-otp-center">
            <table class="mo_registration_pricing_table">
                <h2>'.mo_("LICENSING PLANS").'
                    <span style="float:right">
                        <input type="button" '.$disabled.' name="check_btn" id="check_btn"
                                class="button button-primary button-large" value="'.mo_("Check License").'"/>
                        <input type="button" name="ok_btn" id="ok_btn" class="button button-primary button-large"
                                value="'.mo_("OK, Got It").'" onclick="window.location.href=\''.$formSettings.'\'" />
                    </span>
                <h2>
                <hr>
                <tr style="vertical-align:top;">

                    <!-----------------------------------------------------------------------------------------------------------------
                                                                    FREE PLAN
                    ------------------------------------------------------------------------------------------------------------------->
                    <td>
                        <div class="mo_registration_thumbnail">
                            <div class="mo_registration_pricing_paid_tab">
                                <h3 class="mo_registration_pricing_header">'.$free_plan_name.'</h3>
                                <hr>
                                <h4 class="mo_registration_pricing_sub_header">
                                    <div class="pricing-div">
                                        $0
                                    </div>
                                    10 Free Email and SMS Transactions
                                </h4>
                            </div>
                            <div class="mo_registration_pricing_free_tab">
                                <p class="mo_registration_pricing_text padding-features">'.mo_("Features:").'</p>
                                <p class="mo_registration_pricing_text features" >';

                                    foreach($free_plan_features as $feature){
                                        echo $feature . '<br/>';
                                    }
        echo'
                                </p>
                                <hr>
                                <p class="mo_registration_pricing_text padding">Basic Support by Email</p>
                            </div>    
                        </div>
                    </td>


                    <!-----------------------------------------------------------------------------------------------------------------
                                                                MINIORANGE GATEWAY
                    ------------------------------------------------------------------------------------------------------------------->

                    <td>
                        <div class="mo_registration_thumbnail">
                            <div class="mo_registration_pricing_paid_tab">
                                <h3 class="mo_registration_pricing_header">';
        echo 				        $mo_gateway_plan_name.'
                                </h3>
                                <hr>
                                <h4 class="mo_registration_pricing_sub_header">
                                    <div class="pricing-div">
                                        <table>
                                            <tr>
                                                <td class="mo_registration_pricing_text" style="width:27%">For Email:</td>
                                                <td style="width:100%"><select class="mo-form-control" style="width:100%">
                                                    <option>$2 per 100 Email</option>
                                                    <option>$5 per 500 Email</option>
                                                    <option>$7 per 1k Email</option>
                                                    <option>$20 per 5k Email</option>
                                                    <option>$30 per 10k Email</option>
                                                    <option>$45 per 50k Email</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mo_registration_pricing_text" style="width:27%">For SMS:</td>
                                                <td style="width:100%"><select class="mo-form-control" style="width:100%">
                                                    <option>(SMS DELIVERY CHARGES + $2) per 100 OTP*</option>
                                                    <option>(SMS DELIVERY CHARGES + $5) per 500 OTP*</option>
                                                    <option>(SMS DELIVERY CHARGES + $7) per 1k OTP*</option>
                                                    <option>(SMS DELIVERY CHARGES + $20) per 5k OTP*</option>
                                                    <option>(SMS DELIVERY CHARGES + $30) per 10k OTP*</option>
                                                    <option>(SMS DELIVERY CHARGES + $45) per 50k OTP*</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br><br>
                                    WooCommerce, Contact Form7<br/>
                                    30 + forms supported<br/>
                                    Passwordless Login<br/>
                                    SMS Notification<br/>
                                    Hassle Free Setup<br/>';

                                        if(strcmp($plan,MoConstants::PCODE)!=0 && strcmp($plan,MoConstants::BCODE)!=0
                                            && strcmp($plan,MoConstants::CCODE)!=0 && strcmp($plan,MoConstants::NCODE)!=0)
        echo'							    <input type="button"  '.$disabled.' class="button button-primary button-large"
                                                    onclick="mo2f_upgradeform(\'wp_otp_verification_basic_plan\')"
                                                    value="'.mo_("Upgrade Now").'"/>';
                                        else
        echo'							    <input type="button"  '.$disabled.' class="button button-primary button-large"
                                                    onclick="mo2f_upgradeform(\'wp_otp_verification_upgrade_plan\')"
                                                    value="'.mo_("Recharge").'"/>';

        echo' 			            <span class="pricing_question tooltip">
                                        <i class="dashicons dashicons-warning" data-toggle="onprem"></i>
                                        <span class="tooltiptext">
                                            <span class="header">
                                                <b><i>'
                                                    .MoMessages::showMessage(MoMessages::MO_GATEWAY_HEADER).'
                                                </i></b>
                                            </span>
                                            <br/><br/>
                                            <span class="body">'
                                                .MoMessages::showMessage(MoMessages::MO_GATEWAY_BODY).'
                                            </span>
                                        </span>
                                    </span>
                                </h4>
                            </div>
                            <div class="mo_registration_pricing_free_tab">
                                <p class="mo_registration_pricing_text padding-features">Features:</p>
                                <p class="mo_registration_pricing_text features" >';

                                    foreach($mo_gateway_plan_features as $feature) {
                                        echo $feature . '<br/>';
                                    }
        echo'
                                </p><hr>
                                <p class="mo_registration_pricing_text padding">'.mo_("Premium Support Plans").'</p>
                            </div>
                        </div>
                    </td>


                    <!-----------------------------------------------------------------------------------------------------------------
                                                            CUSTOM GATEWAY PLAN WITHOUT ADDONS
                    ------------------------------------------------------------------------------------------------------------------->

                    <td>
                        <div class="mo_registration_thumbnail">
                            <div class="mo_registration_pricing_paid_tab">
                                <h3 class="mo_registration_pricing_header">';

        echo 			            $gateway_minus_addon_name.'
                                </h3>
                                <hr>
                                <h4 class="mo_registration_pricing_sub_header">
                                    <div class="pricing-div">
                                        <b>'.$gateway_minus_addon.'</b>
                                    </div>
                                    One Time Payment<br/><br/>
                                    WooCommerce, Contact Form7<br/>
                                    30 + forms supported<br/>
                                    <br/>
                                    <br/>
                                    <br/>';

                                    if(strcmp($plan,MoConstants::NACODE)==0 || strcmp($plan,MoConstants::NACODE2)==0) {
                                        echo '<input type="button" ' . $disabled . '
                                                    class="button button-primary button-large"
                                                    onclick="mo2f_upgradeform(\'email_verification_no_addons_upgrade_instances_plan\')"
                                                    value="' . mo_("Buy More Instances") . '"/>';
                                    } else {
                                        echo '<input type="button" ' . $disabled . '
                                                    class="button button-primary button-large"
                                                    onclick="mo2f_upgradeform(\'wp_email_verification_intranet_standard_plan\')"
                                                    value="' . mo_("Upgrade Now") . '"/>';
                                    }

        echo'		                <span class="pricing_question tooltip">
                                        <i class="dashicons dashicons-warning" data-toggle="onprem"></i>
                                        <span class="tooltiptext">
                                            <span class="header">
                                                <b><i>'
                                                    .MoMessages::showMessage(MoMessages::YOUR_GATEWAY_HEADER).'
                                                </i></b>
                                            </span><br/><br/>
                                            <span class="body">'
                                                .MoMessages::showMessage(MoMessages::YOUR_GATEWAY_BODY).'
                                            </span>
                                        </span>
                                    </span>
                                </h4>
                            </div>
                            <div class="mo_registration_pricing_free_tab">
                                <p class="mo_registration_pricing_text padding-features">Features:</p>
                                <p class="mo_registration_pricing_text features" >';

                                    foreach($gateway_minus_addon_features as $feature) {
                                        echo $feature . '<br/>';
                                    }
        echo'
                                </p>
                                <hr>
                                <p class="mo_registration_pricing_text padding">'.mo_("Premium Support Plans").'</p>
                            </div>
                        </div>
                    </td>


                    <!-----------------------------------------------------------------------------------------------------------------
                                                            CUSTOM GATEWAY PLAN WITH ADDONS
                    ------------------------------------------------------------------------------------------------------------------->

                    <td>
                        <div class="mo_registration_thumbnail">
                            <div class="mo_registration_pricing_paid_tab">
                                <h3 class="mo_registration_pricing_header">';

        echo 			            $gateway_plus_addon_name.'
                                </h3>
                                <hr>
                                <h4 class="mo_registration_pricing_sub_header">
                                    <div class="pricing-div">
                                        <b>'.$gateway_plus_addon.'</b>
                                    </div>
                                    One Time Payment<br/><br/>
                                    WooCommerce, Contact Form7
                                    <br/>30 + forms supported<br/>
                                    Passwordless Login<br/>
                                    SMS Notification<br/>
                                    <br/>';
                                if(strcmp($plan,MoConstants::AACODE)==0 || strcmp($plan,MoConstants::AACODE2)==0
                                    || strcmp($plan,MoConstants::AACODE3)==0) {
                                    echo '<input type="button" ' . $disabled . '
                                                class="button button-primary button-large"
                                                onclick="mo2f_upgradeform(\'email_verification_upgrade_instances_plan\')"
                                                value="' . mo_("Buy More Instances") . '"/>';
                                } else {
                                    echo '<input type="button" ' . $disabled . '
                                                class="button button-primary button-large"
                                                onclick="mo2f_upgradeform(\'wp_email_verification_intranet_basic_plan\')"
                                                value="' . mo_("Upgrade Now") . '"/>';
                                }

        echo'		                <span class="pricing_question tooltip">
                                        <i class="dashicons dashicons-warning" data-toggle="onprem"></i>
                                        <span class="tooltiptext">
                                            <span class="header">
                                                <b><i>'
                                                    .MoMessages::showMessage(MoMessages::YOUR_GATEWAY_HEADER).'
                                                </i></b>
                                            </span><br/><br/>
                                            <span class="body">'
                                                .MoMessages::showMessage(MoMessages::YOUR_GATEWAY_BODY).'
                                            </span>
                                        </span>
                                    </span>
                                </h4>
                            </div>
                            <div class="mo_registration_pricing_free_tab">
                                <p class="mo_registration_pricing_text padding-features">Features:</p>
                                <p class="mo_registration_pricing_text features" >';

                                    foreach($gateway_plus_addon_features as $feature) {
                                        echo $feature . '<br/>';
                                    }
        echo'
                                </p>
                                <hr>
                                <p class="mo_registration_pricing_text padding">'.mo_("Premium Support Plans").'</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="mo_registration_divided_layout mo-otp-full">
        <div class="mo_registration_pricing_layout mo-otp-center">

            <!-----------------------------------------------------------------------------------------------------------------
                                                    EXTRA INFORMATION ABOUT THE PLANS
            ------------------------------------------------------------------------------------------------------------------->

            <br>
            <div id="disclaimer" style="margin-bottom:15px;">
                <span style="font-size:15px;">
                    <b>'.mo_("SMS gateway").'</b>
                        '.mo_(" is a service provider for sending SMS on your behalf to your users.").'<br>
                    <b>'.mo_("SMTP gateway").'</b>
                        '.mo_(" is a service provider for sending Emails on your behalf to your users.").'<br><br>
                    *'.mo_("Transaction prices may very depending on country. If you want to use more than 50k transactions, mail us at").'
                        <a href="mailto:'.MoConstants::SUPPORT_EMAIL.'"><b>'.MoConstants::SUPPORT_EMAIL.'</b></a>
                        '.mo_("or submit a support request using the Need Help button.").'<br/><br/>
                    **'.mo_("If you want to <b>use miniorange SMS/SMTP gateway</b>, and your country is not in list, mail us at").' <a href="mailto:'.MoConstants::SUPPORT_EMAIL.'">
                            <b>'.MoConstants::SUPPORT_EMAIL.'</b></a>
                            '.mo_("or submit a support request using the Need Help button.").'
                            '.mo_("We will get back to you promptly.").'<br><br>
                    ***'.mo_("<b>Custom integration charges</b> will be applied for supporting a registration form which is not already supported
                            by our plugin. Each request will be handled on a per case basis.").'<br>
                </span>
            </div>
        </div>
    </div>
    <div class="mo_registration_divided_layout mo-otp-full">
        <div class="mo_registration_pricing_layout mo-otp-center">
            <h3>'.mo_("Return Policy").'</h3>
            <p>'.mo_("At miniOrange, we want to ensure you are 100% happy with your purchase.".
                    " If the premium plugin you purchased is not working as advertised and you have attempted to ".
                    "resolve any feature issues with our support team, which couldn't get resolved. We will refund the".
                    " whole amount within 10 days of the purchase. Please email us at").'
                    <a href="mailto:'.MoConstants::SUPPORT_EMAIL.'">'.MoConstants::SUPPORT_EMAIL.'</a>
                '.mo_("for any queries regarding the return policy.<br> If you have any doubts regarding ".
                    "the licensing plans, you can mail us at").
                    ' <a href="mailto:'.MoConstants::SUPPORT_EMAIL.'">'.MoConstants::SUPPORT_EMAIL.'</a>
                '.mo_("or submit a query using the support form.").'</p>
            <h3>'.mo_("What is not covered?").'</h3>
            <p>
                <ol>
                    <li>'.mo_("Any returns that are because of features that are not advertised.").'</li>
                    <li>'.mo_("Any returns beyond 10 days.").'</li>
                    <li>
                        '.mo_("Any returns for Do it yourself plan if you are unable to do the setup on your own ".
                        "and need our help.").
                    '</li>
                </ol>
            </p>
        </div>
    </div>

    <form style="display:none;" id="mocf_loginform" action="'.$form_action.'" target="_blank" method="post">
        <input type="email" name="username" value="'.$email.'" />
        <input type="text" name="redirectUrl" value="'.$redirect_url.'" />
        <input type="text" name="requestOrigin" id="requestOrigin"  />
    </form>
    <form id="mo_ln_form" style="display:none;" action="" method="post">';

        wp_nonce_field($nonce);

    echo'<input type="hidden" name="option" value="check_mo_ln" />
    </form>
    <script>
        function mo2f_upgradeform(planType){
            jQuery("#requestOrigin").val(planType);
            jQuery("#mocf_loginform").submit();
        }
    </script>';