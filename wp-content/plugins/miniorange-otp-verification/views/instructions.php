<?php

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;

echo '<div class="mo_registration_table_layout mo-otp-left">';
echo'	    <table style="width:100%">
	            <tr>
                    <td colspan="2">
                        <h2>'.mo_("USING THE PLUGIN").'
                            <span style="float:right;margin-top:-10px;">
                                <span   class="dashicons dashicons-arrow-up toggle-div" 
                                        data-show="false" 
                                        data-toggle="mo_form_instructions">                                            
                                </span>
                            </span>
                        </h2> <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="mo_form_instructions">
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="how_to_use_the_otp_plugin">
                                    '.mo_('HOW DO I USE THE PLUGIN').'
                                    </div></b>
                                <div id="how_to_use_the_otp_plugin" hidden >
                                    <b>'.mo_("By following these easy steps you can verify your users email or phone number instantly").':
                                    <ol>
                                        <li>'.mo_("Select the form from the list\.");
                                            mo_draw_tooltip(MoMessages::showMessage(MoMessages::FORM_NOT_AVAIL_HEAD),
                                                            MoMessages::showMessage(MoMessages::FORM_NOT_AVAIL_BODY));
echo'									</li>
                                        <li>'.mo_("Save your form settings from under the <a href='''#mo_forms'>Form Settings</a> section.").'</li>
                                        <li>'.mo_("To add a dropdown to your phone field or select a default country code check the ").'
                                            <a href="'.$otpSettings.'">'.mo_("OTP Settings Tab").'</a></li>
                                        <li>'.mo_("To customize your SMS/Email messages/gateway check under").'
                                            <a href="'.$config.'"> '.mo_("SMS/Email Templates Tab").'</a></li>
                                        <li>'.mo_("Log out and go to your registration or landing page for testing.").'</li>
                                        <li>'.mo_("For any query related to custom SMS/Email messages/gateway check our").' 
                                            <a href="'.$help_url.'"> '.mo_("FAQs").'</a></li>
                                        <li>
                                            <div>
                                                <i><b>'.mo_("Cannot see your registration form in the list above? Have your own custom registration form?"
                                                            ).'</b></i>';
                                                mo_draw_tooltip(MoMessages::showMessage(MoMessages::FORM_NOT_AVAIL_HEAD),
                                                                MoMessages::showMessage(MoMessages::FORM_NOT_AVAIL_BODY));
echo'										</div>
                                        </li>
                                        </b>
                                    </ol>
                                </div>
                            </div>
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="wp_dropdown">
                                    '.mo_('HOW DO I SHOW A COUNTRY CODE DROP-DOWN ON MY FORM?').'
                                    </div></b>
                                <div id="wp_dropdown" hidden >
                                    <i>'.mo_( "To enable a country dropdown for your phone number field simply enable the option from the Country Code Settings under <a href='".$otpSettings."'>OTP Settings Tab</a>").'</i>
                                </div>
                            </div>
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_email_template">
                                    '.mo_('HOW DO I CHANGE THE BODY OF THE SMS AND EMAIL GOING OUT?').'
                                    </div></b>
                                <div id="wp_sms_email_template" hidden >
                                    <i>'.mo_( "You can change the body of the SMS and Email going out to users by following instructions under the <a href='".$config."'>SMS/Email Template Tab</a>").'</i>
                                </div>
                            </div>
                            <div class="mo_otp_note">
                                <!--<div class="mo_corner_ribbon shadow">'.mo_("NEW").'</div>-->
                                <b><div class="mo_otp_dropdown_note notification" data-toggle="wc_sms_notif_addon">
                                    '.mo_('LOOKING FOR A WOOCOMMERCE OR ULTIMATE MEMBER SMS NOTIFICATION PLUGIN?').'
                                    </div></b>
                                <div id="wc_sms_notif_addon" hidden >
                                    '.mo_( " <b> Looking for a plugin that will send out SMS notifications to users and admin for WooCommerce or Ultimate Member? </b> <i>We have a separate add-on for that. Check the <a href='".$addon."'>AddOns Tab</a> for more information.</i>").'
                                </div>
                            </div>
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_transaction_upgrade">
                                    '.mo_('HOW DO I BUY MORE TRANSACTIONS? HOW DO I UPGRADE?').'
                                    </div></b>
                                <div id="wp_sms_transaction_upgrade" hidden >
                                    <i>'.mo_( "You can upgrade and recharge at any time. You can even configure any external SMS/Email gateway provider with the plugin. <a href='".$license_url."'>Click Here</a> or the upgrade button on the top of the page to check our pricing and plans.").'</i>
                                </div>
                            </div>
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="wp_design_custom">
                                    '.mo_('HOW DO I CHANGE THE DESIGN OF THE POPUP?').'
                                    </div></b>
                                <div id="wp_design_custom" hidden >
                                    '.mo_( " <i>If you wish to change how the popup looks to match your sites look and feel then you can do so from the <a href='".$design."'>PopUp Design Tab.</a></i>").'
                                </div>
                            </div>   
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_integration">
                                    '.mo_('NEED A DEVELOPER DOCUMENTATION? WISH TO INTEGRATE YOUR FORM WITH THE PLUGIN?').'
                                    </div></b>
                                <div id="wp_sms_integration" hidden >
                                    '.mo_( " <i>If you wish to integrate the plugin with your form then you can follow our documentation. Contact us at ".$support." or use the support form to send us a query.</i>").'
                                </div>
                            </div>    
                            <div class="mo_otp_note">
                                <b><div class="mo_otp_dropdown_note" data-toggle="wp_reports">
                                    '.mo_('NEED TO TRACK TRANSACTIONS?').'
                                    </div></b>
                                <div id="wp_reports" hidden>
                                    <div >
                                        <b>'.mo_("Follow these steps to view your transactions:").'</b>
                                        <ol>
                                            <li>'.mo_("Click on the button below.").'</li>
                                            <li>'.mo_("Login using the credentials you used to register for this plugin.").'</li>
                                            <li>'.mo_("You will be presented with <i><b>View Transactions</b></i> page.").'</li>
                                            <li>'.mo_("From this page you can track your remaining transactions").'</li>
                                        </ol>
                                        <div style="margin-top:2%;text-align:center">
                                            <input  type="button" 
                                                    title="'.mo_("Need to be registered for this option to be available").'" 
                                                    value="'.mo_("View Transactions").'" 
                                                    onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\''.MoConstants::VIEW_TRANSACTIONS.'\');" 
                                                    class="button button - primary button - large" style="margin - right: 3%;">
                                        </div>
                                    </div>
                                    <form id="showExtraSettings" action="'.MoConstants::HOSTNAME.'/moas/login" target="_blank" method="post">
                                       <input type="hidden" id="extraSettingsUsername" name="username" value="'.$email.'" />
                                       <input type="hidden" id="extraSettingsRedirectURL" name="redirectUrl" value="" />
                                       <input type="hidden" id="" name="requestOrigin" value="'.$plan_type.'" />
                                    </form>
                                </div>
                            </div>                            
                        </div>
                    </td>
                </tr>
            </table>
        </div>';