<?php

namespace OTP\Addons\UmSMSNotification\Helper\Notifications;

use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;


class UltimateMemberNewCustomerNotification extends SMSNotification
{
	public static $instance;

	function __construct()
	{
		parent::__construct();
		$this->title 			= 'New Account';
		$this->page 			= 'um_new_customer_notif';
		$this->isEnabled 		= FALSE;
		$this->tooltipHeader 	= 'NEW_UM_CUSTOMER_NOTIF_HEADER';
		$this->tooltipBody 		= 'NEW_UM_CUSTOMER_NOTIF_BODY';
		$this->recipient 		= 'mobile_number';
		$this->smsBody 			=  UltimateMemberSMSNotificationMessages::showMessage(
		                                UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_SMS
                                );
		$this->defaultSmsBody	=  UltimateMemberSMSNotificationMessages::showMessage(
		                                UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_SMS
                                );
		$this->availableTags 	= '{site-name},{username},{accountpage-url},{password},{login-url},{email},{firtname},{lastname}';
		$this->pageHeader 		= mo_("NEW ACCOUNT NOTIFICATION SETTINGS");
		$this->pageDescription 	= mo_("SMS notifications settings for New Account creation SMS sent to the users");
		$this->notificationType = mo_("Customer");
		self::$instance 		= $this;
	}


	
	public static function getInstance()
	{
		return self::$instance === null ? new self() : self::$instance;
	}


	
	function sendSMS(array $args)
	{
		if(!$this->isEnabled) return;
		$username 		= um_user( 'user_login' );
        $phoneNumber 	= $args[$this->recipient];
		$profileUrl     = um_user_profile_url();
		$password       = um_user( '_um_cool_but_hard_to_guess_plain_pw' );
		$loginUrl       = um_get_core_page( 'login' );
		$firstName      = um_user( 'first_name' );
		$lastName       = um_user( 'last_name' );
		$email          = um_user( 'user_email' );

        $replacedString = [
            'site-name'         => get_bloginfo() ,
            'username'          => $username,
            'accountpage-url'   => $profileUrl,
            'password'          => $password,
            'login-url'         => $loginUrl,
            'firstname'         => $firstName,
            'lastname'          => $lastName,
            'email' => $email,
        ];
        $replacedString = apply_filters('mo_um_new_customer_notif_string_replace',$replacedString);
		$smsBody 		= MoUtility::replaceString($replacedString, $this->smsBody);

		if(MoUtility::isBlank($phoneNumber)) return;
		MoUtility::send_phone_notif($phoneNumber, $smsBody);
	}
}