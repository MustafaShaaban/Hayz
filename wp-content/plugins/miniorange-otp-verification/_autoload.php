<?php

use OTP\Helper\FormList;
use OTP\Helper\FormSessionData;
use OTP\Helper\MoUtility;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\SplClassLoader;

if(! defined( 'ABSPATH' )) exit;

define('MOV_DIR', plugin_dir_path(__FILE__));
define('MOV_URL', plugin_dir_url(__FILE__));

$response = wp_remote_retrieve_body(wp_remote_get(MOV_URL . 'package.json', ['sslverify'=> false]));
$packageData = empty($response) || (strpos($response, "not found") !== false) ? 
                                    initializePackageJson() :  $response;
$packageData =  json_decode($packageData);

define('MOV_VERSION', $packageData->version);
define('MOV_TYPE', $packageData->type);
define('MOV_HOST', $packageData->hostname);
define('MOV_DEFAULT_CUSTOMERKEY',$packageData->dCustomerKey);
define('MOV_DEFAULT_APIKEY',$packageData->dApiKey);
define('MOV_SSL_VERIFY',$packageData->sslVerify);
define('MOV_CSS_URL', MOV_URL . 'includes/css/mo_customer_validation_style.min.css?version='.MOV_VERSION);
define('MO_INTTELINPUT_CSS', MOV_URL.'includes/css/intlTelInput.min.css?version='.MOV_VERSION);
define('MOV_JS_URL', MOV_URL . 'includes/js/settings.min.js?version='.MOV_VERSION);
define('VALIDATION_JS_URL', MOV_URL . 'includes/js/formValidation.min.js?version='.MOV_VERSION);
define('MO_INTTELINPUT_JS', MOV_URL.'includes/js/intlTelInput.min.js?version='.MOV_VERSION);
define('MO_DROPDOWN_JS', MOV_URL.'includes/js/dropdown.min.js?version='.MOV_VERSION);
define('MOV_LOADER_URL', MOV_URL . 'includes/images/loader.gif');
define('MOV_LOGO_URL', MOV_URL . 'includes/images/logo.png');
define('MOV_ICON', MOV_URL . 'includes/images/miniorange_icon.png');
define('MOV_ADDON_DIR', MOV_DIR . 'add-ons/');
define('MOV_USE_POLYLANG', TRUE);
define('MO_TEST_MODE', $packageData->testMode);
define('MO_FAIL_MODE', $packageData->failMode);
define('MOV_SESSION_TYPE', $packageData->session);

include "SplClassLoader.php";

$idpClassLoader = new SplClassLoader('OTP', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'));
$idpClassLoader->register();
require_once 'views/common-elements.php';
initializeForms();

function initializeForms()
{
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(MOV_DIR . 'handler/forms',RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    
    foreach($iterator as $it){
        $filename = $it->getFilename();
        $className = "OTP\\Handler\\Forms\\" . str_replace('.php','',$filename);
        
        $handlerList = FormList::instance();
        
        $formHandler = $className::instance();
        $handlerList->add($formHandler->getFormKey(),$formHandler);
    }
}




function admin_post_url(){ return admin_url('admin-post.php'); }


function wp_ajax_url(){ return admin_url('admin-ajax.php'); }


function mo_($string)
{
    $textDomain = "miniorange-otp-verification";
    $string = preg_replace('/\s+/S', " ", $string);
    return is_scalar($string)
            ? (MoUtility::_is_polylang_installed() && MOV_USE_POLYLANG ? pll__($string) : __($string, $textDomain))
            : $string;
}


function get_mo_option($string,$prefix=null)
{
    $string = ($prefix===null ? "mo_customer_validation_" : $prefix) . $string;
    return apply_filters('get_mo_option',get_site_option($string));
}


function update_mo_option($string,$value,$prefix=null)
{
    $string = ($prefix===null ? "mo_customer_validation_" : $prefix) . $string;
    update_site_option($string,apply_filters('update_mo_option',$value,$string));
}


function delete_mo_option($string,$prefix=null)
{
    $string = ($prefix===null ? "mo_customer_validation_" : $prefix) . $string;
    delete_site_option($string);
}


function get_mo_class($obj)
{
    $namespaceClass = get_class($obj);
    return substr($namespaceClass, strrpos($namespaceClass, '\\') + 1);
}

function initializePackageJson(){
            $package = json_encode(["name"=>"miniorange-otp-verification","version"=>"3.4.2","type"=>"MiniOrangeGateway","testMode"=>false,"failMode"=>false,"hostname"=>"https://login.xecurify.com","dCustomerKey"=>"16555","dApiKey"=>"fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq","sslVerify"=>false,"session"=>"SESSION"]);
            return $package;
    }