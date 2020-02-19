<?php

namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;


class NinjaForm extends FormHandler implements IFormHandler
{
    use Instance;

    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::NINJA_FORM;
        $this->_typePhoneTag = 'mo_ninja_form_phone_enable';
        $this->_typeEmailTag = 'mo_ninja_form_email_enable';
        $this->_typeBothTag = 'mo_ninja_form_both_enable';
        $this->_formKey = 'NINJA_FORM';
        $this->_formName = mo_('Ninja Forms ( Below version 3.0 )');
        $this->_isFormEnabled = get_mo_option('ninja_form_enable');
        $this->_formDocuments = MoOTPDocs::NINJA_FORMS_LINK;
        parent::__construct();
    }

    
    function handleForm()
    {
        $this->_otpType = get_mo_option('ninja_form_enable_type');
        $this->_formDetails = maybe_unserialize(get_mo_option('ninja_form_otp_enabled'));
        if(empty($this->_formDetails)) return;
        foreach ($this->_formDetails as $key => $value) {
            array_push($this->_phoneFormId,'input[name=ninja_forms_field_'.$value['phonekey'].']');
        }

        if($this->checkIfOTPOptions()) return;
        if($this->checkIfNinjaFormSubmitted()) $this->_handle_ninja_form_submit($_REQUEST);
    }


    
    function checkIfOTPOptions()
    {
        return array_key_exists('option',$_POST) && (strpos($_POST['option'], 'verification_resend_otp')
            || $_POST['option']=='miniorange-validate-otp-form' || $_POST['option']=='miniorange-validate-otp-choice-form');
    }


    
    function checkIfNinjaFormSubmitted()
    {
        return array_key_exists('_ninja_forms_display_submit',$_REQUEST)  && array_key_exists('_form_id',$_REQUEST);
    }


    
    function isPhoneVerificationEnabled()
    {
        $otpType = $this->getVerificationType();
        return $otpType===VerificationType::PHONE || $otpType===VerificationType::BOTH;
    }


    
    function isEmailVerificationEnabled()
    {
        $otpType = $this->getVerificationType();
        return $otpType===VerificationType::EMAIL || $otpType===VerificationType::BOTH;
    }


    
    function _handle_ninja_form_submit($requestData)
    {
        if(!array_key_exists($requestData['_form_id'],$this->_formDetails)) return;
        $formData = $this->_formDetails[$requestData['_form_id']];
        $email = $this->processEmail($formData,$requestData);
        $phone = $this->processPhone($formData,$requestData);
        $this->miniorange_ninja_form_user($email,null,$phone);
    }


    
    function processPhone($formData, $requestData)
    {
        if($this->isPhoneVerificationEnabled())
        {
            $field = "ninja_forms_field_".$formData['phonekey'];
            return array_key_exists($field,$requestData) ? $requestData[$field] : NULL;
        }
        return null;
    }


    
    function processEmail($formData, $requestData)
    {
        if($this->isEmailVerificationEnabled())
        {
            $field = "ninja_forms_field_".$formData['emailkey'];
            return array_key_exists($field,$requestData) ? $requestData[$field] : NULL;
        }
        return null;
    }


    
    function miniorange_ninja_form_user($user_email,$user_name,$phone_number)
    {

        MoUtility::initialize_transaction($this->_formSessionVar);
        $errors = new WP_Error();
        if(strcasecmp($this->_otpType,$this->_typePhoneTag)==0)
            $this->sendChallenge($user_name,$user_email,$errors,$phone_number,VerificationType::PHONE);
        else if(strcasecmp($this->_otpType,$this->_typeBothTag)==0)
            $this->sendChallenge($user_name,$user_email,$errors,$phone_number,VerificationType::BOTH);
        else
            $this->sendChallenge($user_name,$user_email,$errors,$phone_number,VerificationType::EMAIL);
    }


    
    function handle_failed_verification($user_login,$user_email,$phone_number,$otpType)
    {

        $otpVerType = $this->getVerificationType();
        $fromBoth = $otpVerType===VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form(
            $user_login,$user_email,$phone_number, MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth
        );
    }


    
    function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data,$otpType)
    {

        $this->unsetOTPSessionVariables();
    }


    
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession([$this->_txSessionId,$this->_formSessionVar]);
    }


    
    public function getPhoneNumberSelector($selector)
    {

        if($this->isFormEnabled() && $this->isPhoneVerificationEnabled()) {
            $selector = array_merge($selector, $this->_phoneFormId);
        }
        return $selector;
    }


    
    function handleFormOptions()
    {
        if(!MoUtility::areFormOptionsBeingSaved($this->getFormOption())) return;
        if(isset($_POST['mo_customer_validation_nja_enable'])) return;

        $form = $this->parseFormDetails();

        $this->_isFormEnabled = $this->sanitizeFormPOST('ninja_form_enable');
        $this->_otpType = $this->sanitizeFormPOST('ninja_form_enable_type');
        $this->_formDetails = !empty($form) ? $form : "";

        update_mo_option('ninja_form_enable',$this->_isFormEnabled);
        update_mo_option('nja_enable',0);
        update_mo_option('ninja_form_enable_type',$this->_otpType);
        update_mo_option('ninja_form_otp_enabled',maybe_serialize($this->_formDetails));
    }

    
    function parseFormDetails()
    {
        $form = [];
        if(!array_key_exists('ninja_form',$_POST)) return array();
        foreach (array_filter($_POST['ninja_form']['form']) as $key => $value) {
            $form[$value]=array('emailkey'=>$_POST['ninja_form']['emailkey'][$key],
                                'phonekey'=>$_POST['ninja_form']['phonekey'][$key]);
        }
        return $form;
    }

}