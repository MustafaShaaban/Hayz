<?php

namespace OTP\Helper;

if(! defined( 'ABSPATH' )) exit;

use OTP\Addons\CustomMessage\MiniOrangeCustomMessage;
use OTP\Addons\PasswordReset\UltimateMemberPasswordReset;
use OTP\Addons\UmSMSNotification\UltimateMemberSmsNotification;
use OTP\Addons\WcSMSNotification\WooCommerceSmsNotification;
use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\IGatewayFunctions;
use OTP\Objects\NotificationSettings;
use OTP\Traits\Instance;


class MiniOrangeGateway implements IGatewayFunctions
{
    use Instance;

    
    private $applicationName = 'wp_otp_verification';

    

    public function registerAddOns()
    {
        UltimateMemberSmsNotification::instance();
        WooCommerceSmsNotification::instance();
        MiniOrangeCustomMessage::instance();
        UltimateMemberPasswordReset::instance();
    }

    public function showAddOnList()
    {
        
        $addonList = AddOnList::instance();
        $addonList = $addonList->getList();

        
        foreach ($addonList as $addon) {
            echo    '<tr>
                    <td class="addon-table-list-status">
                        '.$addon->getAddOnName().'
                    </td>
                    <td class="addon-table-list-name">
                        <i>
                            '.$addon->getAddOnDesc().'
                        </i>
                    </td>
                    <td class="addon-table-list-actions">
                        <a  class="button-primary button tips" 
                            href="'.$addon->getSettingsUrl().'">
                            '.mo_("Settings").'
                        </a>
                    </td>
                </tr>';
        }
    }

    

    public function hourlySync()
    {
        $customerKey = get_mo_option('admin_customer_key');
        $apiKey = get_mo_option('admin_api_key');
        if(isset($customerKey) && isset($apiKey)) {
            MoUtility::_handle_mo_check_ln(FALSE, $customerKey, $apiKey);
        }
    }

    public function flush_cache()
    {
        return;
    }

    public function _vlk($post)
    {
        return;
    }

    
    public function mclv()
    {
        return TRUE;
    }

    
    public function isMG()
    {
        return $this->mclv();
    }

    
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    

    public function custom_wp_mail_from_name($original_email_from)
    {
                return $original_email_from;
    }

    function _mo_configure_sms_template($posted)
    {
        return;     }

    function _mo_configure_email_template($posted)
    {
        return;     }

    public function showConfigurationPage($disabled)
    {
        include MOV_DIR . 'views/mconfiguration.php';
    }

    

    
    public function mo_send_otp_token($authType, $email, $phone)
    {
        if(MO_TEST_MODE) {
            return ['status'=>'SUCCESS','txId'=> MoUtility::rand()];
        } else {
            $content = MocURLOTP::mo_send_otp_token($authType,$email,$phone);
            return json_decode($content,TRUE);
        }
    }

    
    public function mo_send_notif(NotificationSettings $settings)
    {
        $url 		 = MoConstants::HOSTNAME . '/moas/api/notify/send';
        $customerKey = get_mo_option('admin_customer_key');
        $apiKey 	 = get_mo_option('admin_api_key');

        $fields 	 = [
            'customerKey' => $customerKey,
            'sendEmail' => $settings->sendEmail,
            'sendSMS' => $settings->sendSMS,
            'email' => [
                'customerKey' => $customerKey,
                'fromEmail' => $settings->fromEmail,
                'bccEmail' => $settings->bccEmail,
                'fromName' => $settings->fromName,
                'toEmail' => $settings->toEmail,
                'toName' => $settings->toEmail,
                'subject' => $settings->subject,
                'content' => $settings->message
            ],
            'sms' => [
                'customerKey' => $customerKey,
                'phoneNumber' => $settings->phoneNumber,
                'message' => $settings->message
            ]
        ];

        $json 		 = json_encode ( $fields );
        $authHeader  = MocURLOTP::createAuthHeader($customerKey,$apiKey);
        $response 	 = MocURLOTP::callAPI($url, $json, $authHeader);
        return $response;
    }

    

    
    public function mo_validate_otp_token($txId, $otp_token)
    {
        if(MO_TEST_MODE) {
            return MO_FAIL_MODE ? ['status' => ''] : ['status' => 'SUCCESS'];
        } else {
            $content = MocURLOTP::validate_otp_token($txId, $otp_token);
            return json_decode($content,TRUE);
        }
    }

    

    
    public function getConfigPagePointers()
    {
        
        $visualTour = MOVisualTour::instance();
        return [
            $visualTour->tourTemplate(
                'configuration_instructions',
                'right',
                '',
                '<br>Check the links here to see how to change email/sms template, custom gateway, senderID, etc.',
                'Next',
                'emailSms.svg',
                1
            )
        ];
    }
}