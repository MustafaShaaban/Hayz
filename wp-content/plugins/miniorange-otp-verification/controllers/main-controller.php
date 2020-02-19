<?php

use OTP\Handler\MoOTPActionHandlerHandler;
use OTP\Helper\MoUtility;
use OTP\Objects\PluginPageDetails;
use OTP\Objects\TabDetails;

$registered 	= MoUtility::micr();
$activated      = MoUtility::mclv();
$plan       	= MoUtility::micv();
$disabled  	 	= $registered && $activated ? "" : "disabled";
$current_user 	= wp_get_current_user();
$email 			= get_mo_option("admin_email");
$phone 			= get_mo_option("admin_phone");
$controller 	= MOV_DIR . 'controllers/';
$adminHandler 	= MoOTPActionHandlerHandler::instance();


$tabDetails = TabDetails::instance();

include $controller . 'navbar.php';

echo "<div class='mo-opt-content'>
        <div id='moblock' class='mo_customer_validation-modal-backdrop dashboard'>".
            "<img src='".MOV_LOADER_URL."'>".
        "</div>";

if(isset( $_GET[ 'page' ]))
{
    
    foreach ($tabDetails->_tabDetails as $tabs) {
        if($tabs->_menuSlug == $_GET['page']) {
            include $controller . $tabs->_view;
        }
    }

    do_action('mo_otp_verification_add_on_controller');
    include $controller . 'support.php';
}

echo "</div>";