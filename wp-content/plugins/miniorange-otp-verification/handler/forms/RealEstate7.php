<?php

namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;


class RealEstate7 extends FormHandler implements IFormHandler
{
    use Instance;

    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::REALESTATE_7;
        $this->_phoneFormId = "input[name=ct_user_phone_miniorange]";
        $this->_formKey = 'REAL_ESTATE_7';
        $this->_typePhoneTag = "mo_realestate_contact_phone_enable";
        $this->_typeEmailTag = "mo_realestate_contact_email_enable";
        $this->_formName = mo_("Real Estate 7 Pro Theme");
        $this->_isFormEnabled = get_mo_option('realestate_enable');
        $this->_formDocuments = MoOTPDocs::REALESTATE7_THEME_LINK;
        parent::__construct();
    }

    

    public function handleForm()
    {
        $this->_otpType= get_mo_option('realestate_otp_type');

        add_action('wp_enqueue_scripts', array($this,'addPhoneFieldScript'));
        add_action('user_register', array($this,'miniorange_registration_save'), 10, 1 );

        if(!array_key_exists('option',$_POST))return;

        switch($_POST['option'])
        {
            case "realestate_register":
                if($this->sanitizeData($_POST))
                    $this->routeData($_POST);           break;

            case 'miniorange-validate-otp-form':
                $this->_startValidation();              break;
        }
    }


    
    public function unsetOTPSessionVariables()
    {
        Sessionutils::unsetSession([$this->_txSessionId,$this->_formSessionVar]);
    }

    
    public function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data,$otpType)
    {

        SessionUtils::addStatus($this->_formSessionVar,self::VALIDATED,$otpType);
        $this->unsetOTPSessionVariables();
    }


    
    public function handle_failed_verification($user_login,$user_email,$phone_number,$otpType)
    {

        $otpVerType = $this->getVerificationType();
        $fromBoth = $otpVerType===VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form(
            $user_login,$user_email,$phone_number, MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth
        );
    }

    
    public function sanitizeData($postData)
    {
        if (isset( $postData["ct_user_login"] ) && wp_verify_nonce($postData['ct_register_nonce'], 'ct-register-nonce'))
        {
            $user_login		= $postData["ct_user_login"];
            $user_email		= $postData["ct_user_email"];
            $user_first 	= $postData["ct_user_first"];
            $user_last	 	= $postData["ct_user_last"];
            $user_pass		= $postData["ct_user_pass"];
            $pass_confirm 	= $postData["ct_user_pass_confirm"];

            if(username_exists($user_login) || !validate_username($user_login) || $user_login == ''
                || !is_email($user_email) || email_exists($user_email) || $user_pass == ''
                || $user_pass != $pass_confirm) {
                return false;
            }

            return true;
        }
        return false;
    }

    
    public function miniorange_registration_save($user_id){

        $otpType = $this->getVerificationType();
        $phone = MoPHPSessions::getSessionVar("phone_number_mo");
        if($otpType===VerificationType::PHONE && $phone){
            add_user_meta($user_id, 'phone', $phone);
        }
    }


    
    private function _startValidation()
    {

        $otpType = $this->getVerificationType();
        if(!SessionUtils::isOTPInitialized($this->_formSessionVar)) return;
        if(SessionUtils::isStatusMatch($this->_formSessionVar,self::VALIDATED,$otpType)) return;
        $this->validateChallenge($otpType);
    }


    
    public function routeData($postData)
    {

        Moutility::initialize_transaction($this->_formSessionVar);
        if(strcasecmp($this->_otpType,$this->_typePhoneTag)==0){
            $this->_processPhone($postData);
        }
        else if (strcasecmp($this->_otpType, $this->_typeEmailTag)==0){
            $this->_processEmail($postData);
        }
    }


    
    private function _processPhone($postData)
    {
        if(!array_key_exists('ct_user_phone_miniorange', $postData) || !isset($postData['ct_user_phone_miniorange'])) return;
        $this->sendChallenge('','',null, trim($postData['ct_user_phone_miniorange']),VerificationType::PHONE);
    }


    

    private function _processEmail($postData)
    {
        if(!array_key_exists('ct_user_email', $postData) || !isset($postData['ct_user_email'])) return;
        $this->sendChallenge('', $postData['ct_user_email'], null, null,VerificationType::EMAIL,"");
    }


    
    public function addPhoneFieldScript()
    {
        wp_enqueue_script('realEstate7Script', MOV_URL . 'includes/js/realEstate7.min.js?version='.MOV_VERSION , array('jquery'));
    }


    
    public function getPhoneNumberSelector($selector)
    {

        if(self::isFormEnabled() && $this->_otpType==$this->_typePhoneTag) {
            array_push($selector, $this->_phoneFormId);
        }
        return $selector;
    }


    
    public function handleFormOptions()
    {
        if(!MoUtility::areFormOptionsBeingSaved($this->getFormOption())) return;

        $this->_isFormEnabled = $this->sanitizeFormPOST('realestate_enable');
        $this->_otpType = $this->sanitizeFormPOST('realestate_contact_type');

        update_mo_option('realestate_enable',$this->_isFormEnabled);
        update_mo_option('realestate_otp_type',$this->_otpType);
    }
}
