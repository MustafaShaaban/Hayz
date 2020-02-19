<?php

namespace OTP\Addons\CustomMessage\Handler;

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;


class CustomMessages extends BaseAddOnHandler
{
    use Instance;

    
    public $_adminActions = [
        'mo_customer_validation_admin_custom_phone_notif'   =>  '_mo_validation_send_sms_notif_msg',
        'mo_customer_validation_admin_custom_email_notif'   =>  '_mo_validation_send_email_notif_msg',
    ];

    
    function __construct()
    {
        parent::__construct();
        $this->_nonce = 'mo_admin_actions';
	    if(!$this->moAddOnV()) return;
                foreach ($this->_adminActions as $action => $callback) {
            add_action("wp_ajax_{$action}",[$this,$callback]);
            add_action("admin_post_{$action}",[$this,$callback]);
        }
    }

    
    public function _mo_validation_send_sms_notif_msg()
    {
        $_isAjax = MoUtility::sanitizeCheck('ajax_mode',$_POST);
        $_isAjax ? $this->isValidAjaxRequest('security') : $this->isValidRequest();         $phone_numbers = explode(";",$_POST['mo_phone_numbers']);
        $message = $_POST['mo_customer_validation_custom_sms_msg'];
        $content = null;

        foreach ($phone_numbers as $phone) {
            $content = MoUtility::send_phone_notif($phone,$message);
        }
                $_isAjax ? $this->checkStatusAndSendJSON($content) : $this->checkStatusAndShowMessage($content);
    }


    
    public function _mo_validation_send_email_notif_msg()
    {
        $_isAjax = MoUtility::sanitizeCheck('ajax_mode',$_POST);
        $_isAjax ? $this->isValidAjaxRequest('security') : $this->isValidRequest();         $email_addresses = explode(";",$_POST['toEmail']);
        $content = null;

        foreach ($email_addresses as $email) {
            $content = MoUtility::send_email_notif(
                $_POST['fromEmail'],
                $_POST['fromName'],
                $email,
                $_POST['subject'],
                stripslashes($_POST['content'])
            );
        }

                $_isAjax ? $this->checkStatusAndSendJSON($content) : $this->checkStatusAndShowMessage($content);
    }


    
    private function checkStatusAndShowMessage($content)
    {
        if(is_null($content)) return;
        $msg = $content ? MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT)
                        : MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT_FAIL);
        $msgType = $content ? MoConstants::SUCCESS : MoConstants::ERROR;
        do_action("mo_registration_show_message",$msg,$msgType);
        wp_safe_redirect(wp_get_referer());
    }

    
    private function checkStatusAndSendJSON($content)
    {
        if(is_null($content)) return;
        if($content) {
            wp_send_json(MoUtility::createJson(
                MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT),
                MoConstants::SUCCESS_JSON_TYPE
            ));
        }else{
            wp_send_json(MoUtility::createJson(
                MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT_FAIL),
                MoConstants::ERROR_JSON_TYPE
            ));
        }
    }


    

    
    function setAddonKey()
    {
        $this->_addOnKey = 'custom_messages_addon';
    }

    
    function setAddOnDesc()
    {
        $this->_addOnDesc = mo_("Send Customized message to any phone or email directly from the dashboard.");
    }

    
    function setAddOnName()
    {
        $this->_addOnName = mo_("Custom Messages");
    }

    
    function setSettingsUrl()
    {
        $this->_settingsUrl = add_query_arg( array('addon'=> 'custom'), $_SERVER['REQUEST_URI'] );
    }
}