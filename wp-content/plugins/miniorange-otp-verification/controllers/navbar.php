<?php

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Objects\Tabs;

$request_uri    = remove_query_arg(['addon','form'],$_SERVER['REQUEST_URI']);
$profile_url	= add_query_arg( array('page' => $tabDetails->_tabDetails[Tabs::ACCOUNT]->_menuSlug), $request_uri );
$help_url       = MoConstants::FAQ_URL;
$registerMsg    = MoMessages::showMessage(MoMessages::REGISTER_WITH_US,[ "url"=> $profile_url ]);
$activationMsg  = MoMessages::showMessage(MoMessages::ACTIVATE_PLUGIN,[ "url"=> $profile_url ]);
$active_tab 	= $_GET['page'];
$license_url	= add_query_arg( array('page' => $tabDetails->_tabDetails[Tabs::PRICING]->_menuSlug), $request_uri );

include MOV_DIR . 'views/navbar.php';