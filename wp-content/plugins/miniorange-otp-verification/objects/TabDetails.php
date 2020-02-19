<?php

namespace OTP\Objects;

use OTP\Helper\MoUtility;
use OTP\Traits\Instance;

final class TabDetails
{
    use Instance;

    
    public $_tabDetails;

    
    public $_parentSlug;

    
    private function __construct()
    {
        $registered = MoUtility::micr();
        $this->_parentSlug = 'mosettings';
        $request_uri = remove_query_arg('addon',$_SERVER['REQUEST_URI']);

        $this->_tabDetails = [
            Tabs::ACCOUNT => new PluginPageDetails(
                "OTP Verification - Accounts",
                "otpaccount",
                !$registered ? 'Account Setup' : 'User Profile',
                !$registered ? "Account Setup" : "Profile",
                $request_uri,
                'account.php',
                'account',
                '',
                false
            ),
            Tabs::FORMS => new PluginPageDetails(
                'OTP Verification - Forms',
                $this->_parentSlug,
                mo_('Forms'),
                mo_('Forms'),
                $request_uri,
                'settings.php',
                'tabID'
            ),
            Tabs::OTP_SETTINGS => new PluginPageDetails(
                'OTP Verification - OTP Settings',
                'otpsettings',
                mo_('OTP Settings'),
                mo_('OTP Settings'),
                $request_uri,
                'otpsettings.php',
                'otpSettingsTab'
            ),
            Tabs::SMS_EMAIL_CONFIG => new PluginPageDetails(
                'OTP Verification - SMS & Email',
                'config',
                mo_('SMS/Email Config'),
                mo_('SMS/Email Config'),
                $request_uri,
                'configuration.php',
                'emailSmsTemplate'
            ),
            Tabs::MESSAGES => new PluginPageDetails(
                'OTP Verification - Messages',
                'messages',
                mo_('Common Messages'),
                mo_('Common Messages'),
                $request_uri,
                'messages.php',
                'messagesTab'
            ),
            Tabs::DESIGN => new PluginPageDetails(
                'OTP Verification - Design',
                'design',
                mo_('Pop-Up Design'),
                mo_('Pop-Up Design'),
                $request_uri,
                'design.php',
                'popDesignTab'
            ),
            Tabs::PRICING   => new PluginPageDetails(
                'OTP Verification - License',
                'pricing',
                "<span style='color:#ffc700;font-weight:bold'>" .mo_('Licensing Plans')."</span>",
                mo_('Licensing Plans'),
                $request_uri,
                'pricing.php',
                'upgradeTab',
                "background:#ffd231"
            ),
            Tabs::ADD_ONS   => new PluginPageDetails(
                'OTP Verification - Add Ons',
                'addon',
                "<span style='color:#84cc1e;font-weight:bold'>".mo_('AddOns')."</span>",
                mo_('AddOns'),
                $request_uri,
                'add-on.php',
                'addOnsTab',
                "background:#a2ec3b"
            ),
        ];
    }
}