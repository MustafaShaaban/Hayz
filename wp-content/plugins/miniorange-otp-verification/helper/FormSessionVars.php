<?php

namespace OTP\Helper;

if(! defined( 'ABSPATH' )) exit;


class FormSessionVars
{
    const TX_SESSION_ID 		    = 'mo_otp_site_txID';
    const WC_DEFAULT_REG 		    = 'woocommerce_registration';
    const WC_CHECKOUT    		    = 'woocommerce_checkout_page';
    const WC_SOCIAL_LOGIN 		    = 'wc_social_login';
    const PB_DEFAULT_REG 		    = 'profileBuilder_registration';
    const UM_DEFAULT_REG 		    = 'ultimate_members_registration';
    const CRF_DEFAULT_REG 		    = 'crf_user_registration';
    const UULTRA_REG 	 		    = 'uultra_user_registration';
    const SIMPLR_REG 	 		    = 'simplr_registration';
    const BUDDYPRESS_REG 		    = 'buddyPress_user_registration';
    const PIE_REG 		 		    = 'pie_user_registration';
    const WP_DEFAULT_REG 		    = 'default_wp_registration';
    const TML_REG 		 		    = 'tml_registration';
    const UPME_REG		 		    = 'upme_user_registration';
    const NINJA_FORM 	 		    = 'ninja_form_submit';
    const USERPRO_FORM 			    = 'userpro_form_submit';
    const GF_FORMS				    = 'gf_form';
    const CF7_FORMS 	 		    = 'cf7_contact_page';
    const WP_DEFAULT_LOGIN		    = 'default_wp_login';
    const WP_LOGIN_REG_PHONE 	    = 'default_wp_reg_phone';
    const WPMEMBER_REG			    = 'wp_member_registration';
    const ULTIMATE_PRO			    = 'ultimatepro_verified';
    const CLASSIFY_REGISTER 	    = 'classify_form';
    const REALESWP_REGISTER		    = 'realeswp_form';
    const NINJA_FORM_AJAX 		    = 'nj_ajax_submit';
    const EMEMBER 				    = 'wp_emeber_form';
    const FORMCRAFT 			    = 'formcraftform';
    const WPCOMMENT 			    = 'wp_comment';
    const DOCDIRECT_REG 		    = 'docdirect_theme_registration';
    const WPFORM 				    = 'wpform';
    const CALDERA 				    = 'caldera';
    const MEMBERPRESS_REG		    = 'memberpress_user_registration';
    const REALESTATE_7              = 'realestate7_registration';
    const MULTISITE 			    = 'multisite_registration';
    const PMPRO_REGISTRATION        = 'paid_membership_plugin';
    const FORM_MAKER                = 'form_maker_form';
    const UM_PROFILE_UPDATE         = 'ultimate_member_profile';
    const UM_DEFAULT_PASS           = 'um_password_reset_form';
    const WC_PRODUCT_VENDOR         = 'wc_product_vendor';
    const VISUAL_FORM               = 'visual_form';
    const FORMIDABLE_FORM           = 'frm_form';
    const WC_BILLING                = 'wc_billing';
    const WP_CLIENT_REG 		    = 'wp_client_registration';
}