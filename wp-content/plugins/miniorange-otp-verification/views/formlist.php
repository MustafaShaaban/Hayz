<?php

use OTP\Helper\MoMessages;

echo'			<div class="mo_registration_table_layout"';
                     echo $formName ? "hidden" : "";
echo'		         id="form_search">
					<table style="width:100%">
						<tr>
							<td colspan="2">
								<h2>
								    '.mo_("SELECT YOUR FORM FROM THE LIST BELOW").':';
                                    mo_draw_tooltip(
                                        MoMessages::showMessage(MOMessages::FORM_NOT_AVAIL_HEAD),
                                        MoMessages::showMessage(MOMessages::FORM_NOT_AVAIL_BODY)
                                    );
echo'							    
							        <span style="float:right;margin-top:-10px;">
							            <a  class="show_configured_forms button button-primary button-large" 
                                            href="'.$action.'">
                                            '.mo_("Show All Enabled Forms").'
                                        </a>
                                        <span   class="dashicons dashicons-arrow-up toggle-div" 
                                                data-show="false" 
                                                data-toggle="modropdown"></span>
                                    </span>
                                </h2>                                    
							</td>
						</tr>
						<tr>
							<td colspan="2">';
                            get_otp_verification_form_dropdown();
echo'							
							</td>
						</tr>
					</table>
				</div>';