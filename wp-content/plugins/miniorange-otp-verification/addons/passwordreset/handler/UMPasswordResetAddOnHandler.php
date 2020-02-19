<?php

namespace OTP\Addons\PasswordReset\Handler;

use OTP\Objects\BaseAddOnHandler;
use OTP\Traits\Instance;


class UMPasswordResetAddOnHandler extends BaseAddOnHandler
{
    use Instance;

    
    function __construct()
    {
        parent::__construct();
        if (!$this->moAddOnV()) return;
        UMPasswordResetHandler::instance();
    }

    
    function setAddonKey()
    {
        $this->_addOnKey = 'um_pass_reset_addon';
    }

    
    function setAddOnDesc()
    {
        $this->_addOnDesc = mo_("Allows your users to reset their password using OTP instead of email links."
            ."Click on the settings button to the right to configure settings for the same.");
    }

    
    function setAddOnName()
    {
        $this->_addOnName = mo_("Ultimate Member Password Reset Over OTP");
    }

    
    function setSettingsUrl()
    {
        $this->_settingsUrl = add_query_arg( array('addon'=> 'umpr_notif'), $_SERVER['REQUEST_URI']);
    }
}