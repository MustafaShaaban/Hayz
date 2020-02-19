<?php

use OTP\Helper\MoConstants;
use OTP\Helper\MoUtility;
use OTP\Objects\Tabs;

$form_action 	  			= MoConstants::HOSTNAME.'/moas/login';
$redirect_url	  			= MoConstants::HOSTNAME .'/moas/initializepayment';
$free_plan_name 			= 'FREE';
$gateway_plus_addon_name	= 'CUSTOM GATEWAY <br/>WITH ADDONS';
$gateway_minus_addon_name	= 'CUSTOM GATEWAY <br/>WITHOUT ADDONS';
$mo_gateway_plan_name		= 'MINIORANGE GATEWAY <br/>WITH ADDONS';
$free_plan_price			= 'Free';
$gateway_minus_addon		= '$9';
$gateway_plus_addon			= '$19';
$mo_gateway_plan			= '$0';
$vl 						= MoUtility::mclv() && !MoUtility::isMG();
$nonce              		= $adminHandler->getNonceValue();

$formSettings = add_query_arg( array('page' => $tabDetails->_tabDetails[Tabs::FORMS]->_menuSlug), $_SERVER['REQUEST_URI'] );

$free_plan_features = [
	"<span class='available'></span>" 	. mo_(" 30+ registration forms supported"),
	"<span class='available'></span>" 	. mo_(" WooCommerce Forms"),
	"<span class='available'></span>" 	. mo_(" Contact Form 7 Forms"),
	"<span class='available'></span>" 	. mo_(" WooCommerce SMS Notifications"),
	"<span class='available'></span>" 	. mo_(" Ultimate Member SMS Notifications"),
	"<span class='available'></span>" 	. mo_(" Passwordless Login"),
	"<span class='available'></span>" 	. mo_(" Password Reset Over OTP"),
	"<span class='unavailable'></span>" . mo_(" Custom SMS/SMTP Gateway"),
	"<span class='available'></span>" 	. mo_(" Custom Email Template"),
	"<span class='available'></span>" 	. mo_(" Custom SMS Template"),
	"<span class='available'></span>" 	. mo_(" Block Email Domains"),
	"<span class='available'></span>" 	. mo_(" Block SMS numbers"),
	"<span class='available'></span>" 	. mo_(" Send Custom SMS Messages"),
	"<span class='available'></span>" 	. mo_(" Country Code Dropdown for form"),
	"<span class='available'></span>" 	. mo_(" Custom OTP Length"),
	"<span class='available'></span>" 	. mo_(" Custom OTP Validity Time"),
	"<span class='available'></span>" 	. mo_(" OTP pop-up Customization")
];

$gateway_plus_addon_features = [
	"<span class='available'></span>" 	. mo_(" 30+ registration forms supported"),
	"<span class='available'></span>" 	. mo_(" WooCommerce Forms"),
	"<span class='available'></span>" 	. mo_(" Contact Form 7 Forms"),
	"<span class='available'></span>" 	. mo_(" WooCommerce SMS Notifications"),
	"<span class='available'></span>" 	. mo_(" Ultimate Member SMS Notifications"),
	"<span class='available'></span>" 	. mo_(" Passwordless Login"),
	"<span class='available'></span>" 	. mo_(" Password Reset Over OTP"),
	"<span class='available'></span>" 	. mo_(" Custom SMS/SMTP Gateway"),
	"<span class='available'></span>" 	. mo_(" Custom Email Template"),
	"<span class='available'></span>" 	. mo_(" Custom SMS Template"),
	"<span class='available'></span>" 	. mo_(" Block Email Domains"),
	"<span class='available'></span>" 	. mo_(" Block SMS numbers"),
	"<span class='available'></span>" 	. mo_(" Send Custom SMS Messages"),
	"<span class='available'></span>" 	. mo_(" Country Code Dropdown for form"),
	"<span class='available'></span>" 	. mo_(" Custom OTP Length"),
	"<span class='available'></span>" 	. mo_(" Custom OTP Validity Time"),
	"<span class='available'></span>" 	. mo_(" OTP pop-up Customization")
];


$gateway_minus_addon_features = [
	"<span class='available'></span>" 		. mo_(" 30+ registration forms supported"),
	"<span class='available'></span>" 		. mo_(" WooCommerce Forms"),
	"<span class='available'></span>" 		. mo_(" Contact Form 7 Forms"),
	"<span class='unavailable'></span>" 	. mo_(" WooCommerce SMS Notifications"),
	"<span class='unavailable'></span>" 	. mo_(" Ultimate Member SMS Notifications"),
	"<span class='unavailable'></span>" 	. mo_(" Passwordless Login"),
	"<span class='unavailable'></span>" 	. mo_(" Password Reset Over OTP"),
	"<span class='available'></span>" 		. mo_(" Custom SMS/SMTP Gateway"),
	"<span class='available'></span>" 		. mo_(" Custom Email Template"),
	"<span class='available'></span>" 		. mo_(" Custom SMS Template"),
	"<span class='available'></span>" 		. mo_(" Block Email Domains"),
	"<span class='available'></span>" 		. mo_(" Block SMS numbers"),
	"<span class='unavailable'></span>" 	. mo_(" Send Custom SMS Messages"),
	"<span class='available'></span>" 		. mo_(" Country Code Dropdown for form"),
	"<span class='available'></span>" 		. mo_(" Custom OTP Length"),
	"<span class='available'></span>" 		. mo_(" Custom OTP Validity Time"),
	"<span class='available'></span>" 		. mo_(" OTP pop-up Customization")
];


$mo_gateway_plan_features = [
	"<span class='available'></span>" 		. mo_(" 30+ registration forms supported"),
	"<span class='available'></span>" 		. mo_(" WooCommerce Forms"),
	"<span class='available'></span>" 		. mo_(" Contact Form 7 Forms"),
	"<span class='available'></span>" 		. mo_(" WooCommerce SMS Notifications"),
	"<span class='available'></span>" 		. mo_(" Ultimate Member SMS Notifications"),
	"<span class='available'></span>" 		. mo_(" Passwordless Login"),
	"<span class='available'></span>" 		. mo_(" Password Reset Over OTP"),
	"<span class='unavailable'></span>"		. mo_(" Custom SMS/SMTP Gateway"),
	"<span class='available'></span>" 		. mo_(" Custom Email Template"),
	"<span class='available'></span>" 		. mo_(" Custom SMS Template"),
	"<span class='available'></span>" 		. mo_(" Block Email Domains"),
	"<span class='available'></span>" 		. mo_(" Block SMS numbers"),
	"<span class='available'></span>" 		. mo_(" Send Custom SMS Messages"),
	"<span class='available'></span>" 		. mo_(" Country Code Dropdown for form"),
	"<span class='available'></span>" 		. mo_(" Custom OTP Length"),
	"<span class='available'></span>" 		. mo_(" Custom OTP Validity Time"),
	"<span class='available'></span>" 		. mo_(" OTP pop-up Customization")
];

include MOV_DIR . 'views/pricing.php';