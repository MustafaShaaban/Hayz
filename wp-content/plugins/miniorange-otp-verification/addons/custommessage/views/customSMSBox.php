<?php

echo ' <div id="custom_sms_box">
            <table style="width:100%">
                <tr>
                    <td>
                        <b>'.mo_("Phone Numbers:").'</b>
                        <input '.$disabled.'
                                class="mo_registration_table_textbox"
                                style="border:1px solid #ddd"
                                name="mo_phone_numbers"
                                placeholder="'.mo_("Enter semicolon(;) separated Phone Numbers").'"
                            value="" required="">
                        <br/><br/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>'.mo_("Message").'</b>
                        <span id="characters">Remaining Characters : <span id="remaining"></span> </span>
                        <textarea '.$disabled.' 
                            id="custom_sms_msg" 
                            class="mo_registration_table_textbox"
                            name="mo_customer_validation_custom_sms_msg"
                            placeholder="'.mo_("Enter OTP SMS Message").'"
                            required/></textarea>
                        <div class="mo_otp_note">
                            '.mo_('You can have new line characters in your sms text body.
                            To enter a new line character use the <b><i>%0a</i></b> symbol.
                            To enter a "#" character you can use the <b><i>%23</i></b> symbol.
                            To see a complete list of special characters that you can send in a
                            SMS check with your gateway provider.').'
                        </div>
                    </td>
                </tr>
            </table>
        </div>';