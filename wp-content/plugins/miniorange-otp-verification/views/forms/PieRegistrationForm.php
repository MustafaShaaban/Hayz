<?php

use OTP\Helper\MoMessages;

echo' 	<div class="mo_otp_form" id="'.get_mo_class($handler).'">
 	        <input  type="checkbox" '.$disabled.' 
 	                id="pie_default" 
 	                class="app_enable" 
 	                data-toggle="pie_default_options" 
 	                name="mo_customer_validation_pie_default_enable" 
 	                value="1"
 	                '.$pie_enabled.' />
            <strong>'. $form_name .'</strong>';

echo'		<div    class="mo_registration_help_desc" '.$pie_hidden.' 
		            id="pie_default_options">
			    <b>'. mo_( "Choose between Phone or Email Verification" ).'</b>
                <p>
                    <input  type="radio" '.$disabled.' 
                            id="pie_phone" 
                            data-form="pie_phone" 
                            class="form_options app_enable" 
                            name="mo_customer_validation_pie_enable_type" 
                            value="'.$pie_type_phone.'" 
                            data-toggle="pie_phone_field"
                            '.( $pie_enable_type == $pie_type_phone ? "checked" : "").' />
                    <strong>'. mo_( "Enable Phone Verification" ).'</strong>
                </p>
                <div '.($pie_enable_type != $pie_type_phone ? "hidden" :"").' 
                        id="pie_phone_field" class="pie_form mo_registration_help_desc" >
                        '. mo_( "Enter the label of the phone field" ).': 
                        <input  class="mo_registration_table_textbox" 
                                id="mo_customer_validation_pie_phone_field_key" 
                                name="mo_customer_validation_pie_phone_field_key" 
                                type="text" 
                                value="'.$pie_field_key.'">
                        <div class="mo_otp_note">'
                            .mo_( "<b>Note :</b> Keep Phone field <i>required</i> and format set to <i>international</i>." ).'
                        </div>
                </div>
                <p>
                    <input  type="radio" '.$disabled.' 
                            id="pie_email" 
                            class="app_enable" 
                            name="mo_customer_validation_pie_enable_type" 
                            value="'.$pie_type_email.'"
                            '.( $pie_enable_type == $pie_type_email ? "checked" : "").' />
                    <strong>'. mo_( "Enable Email Verification" ).'</strong>
                </p>
                <p>
                    <input  type="radio" '.$disabled.' 
                            id="pie_both" 
                            data-form="pie_both" 
                            class="form_options app_enable" 
                            name="mo_customer_validation_pie_enable_type" 
                            value="'.$pie_type_both.'" 
                            data-toggle="pie_phone_field"
                            '.( $pie_enable_type == $pie_type_both ? "checked" : "").' />
                    <strong>'. mo_( "Let the user choose" ).'</strong>';

                    mo_draw_tooltip(
                        MoMessages::showMessage(MoMessages::INFO_HEADER),
                        MoMessages::showMessage(MoMessages::ENABLE_BOTH_BODY)
                    );

    echo'			<div    '.($pie_enable_type != $pie_type_both ? "hidden" :"").' 
                            class="pie_form mo_registration_help_desc" id="pie_both_field" >
                            '. mo_( "Enter the label of the phone field" ).': 
                            <input  class="mo_registration_table_textbox" 
                                    id="mo_customer_validation_pie_phone_field_key1" 
                                    name="mo_customer_validation_pie_phone_field_key" 
                                    type="text" 
                                    value="'.$pie_field_key.'">
                            <div class="mo_otp_note">'.
                                mo_( "<b>Note :</b> Keep Phone field <i>required</i> and format set to <i>international</i>." ).
                            '</div>
                    </div>      						
                </p>
            </div>
        </div>';