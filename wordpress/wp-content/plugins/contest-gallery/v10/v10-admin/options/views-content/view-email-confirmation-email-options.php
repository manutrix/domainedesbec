<?php

echo <<<HEREDOC
<div class='cg_view_container'>
HEREDOC;

if(strpos($mailExceptions,'E-mail confirmation e-mail') !== false){
    echo "<div style=\"width:330px;margin: 0 auto 18px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_warning\" type=\"button\" value=\"There were mail exceptions for this mailing type\" style=\"width:330px;\"></a>
</div>";
}else{
    echo "<div style=\"width:280px;margin: 0 auto 18px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_success\" type=\"button\" value=\"No mail exceptions for this mailing type\" style=\"width:280px;\"></a>
</div>";
}

$mConfirmAdmin = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->Admin);
$mConfirmReply = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->Reply);
$mConfirmCC = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->CC);
$mConfirmBCC = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->BCC);
$mConfirmHeader = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->Header);
$mConfirmURL = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->URL);
$mConfirmContent = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->Content);
$mConfirmContentText = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLmailConfirmation->ConfirmationText);

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
                <p class='cg_view_options_rows_container_title'>Create e-mail field in "Edit upload form" to send this confirmation e-mail after an upload. After an e-mail address is confirmed this e-mail will not be send anymore.</p>
                <p class='cg_view_options_rows_container_title'><strong>Use this shortcode on the confirmation page</strong>: <br><span class='cg_shortcode_parent'><span class='cg_shortcode_copy cg_shortcode_copy_mail_confirm cg_tooltip'></span><span class='cg_shortcode_copy_text'>[cg_mail_confirm id="$GalleryID"]</span></span></p>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent $cgProFalse" id="mConfirmSendConfirmContainer">
                <div class="cg_view_option_title">
                    <p>Activate this confirmation e-mail<br><span class="cg_view_option_title_note"><span class="cg_color_red">NOTE:</span> relating testing - e-mail where is send to should not contain $cgYourDomainName.<br>Many servers can not send to own domain.</span></span></p>
                </div>
                <div class="cg_view_option_checkbox">
                    <input type="checkbox" name="mConfirmSendConfirm" id="mConfirmSendConfirm" value="1" $mConfirmSendConfirm >
                </div>
            </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="mConfirmAdminContainer" >
                    <div class='cg_view_option_title'>
                        <p>Header<br><span class="cg_view_option_title_note">Like your company name or something like that, not an e-mail</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="mConfirmAdmin" id="mConfirmAdmin" value="$mConfirmAdmin"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="mConfirmReplyContainer" >
                    <div class='cg_view_option_title'>
                        <p>Reply mail (address From)</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="mConfirmReply" id="mConfirmReply" value="$mConfirmReply"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="mConfirmCCContainer" >
                    <div class='cg_view_option_title'>
                        <p>CC mail<br><span class="cg_view_option_title_note">Should not be the same as "Reply mail"<br>Sending to multiple recipients example (mail1@example.com; mail2@example.com; mail3@example.com</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="mConfirmCC" id="mConfirmCC" value="$mConfirmCC"  maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="mConfirmBCCContainer" >
                    <div class='cg_view_option_title'>
                        <p>BCC mail<br><span class="cg_view_option_title_note">Should not be the same as "Reply mail"<br>Sending to multiple recipients example (mail1@example.com; mail2@example.com; mail3@example.com</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="mConfirmBCC" id="mConfirmBCC" value="$mConfirmBCC"  maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="mConfirmHeaderContainer" >
                    <div class='cg_view_option_title'>
                        <p>Subject</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="mConfirmHeader" id="mConfirmHeader" value="$mConfirmHeader"  maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="mConfirmURLContainer" >
                    <div class='cg_view_option_title'>
                        <p>URL to confirmation page<br><span class="cg_view_option_title_note">URL of same page where the shortcode [cg_mail_confirm id="$GalleryID"] is inserted</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="mConfirmURL" id="mConfirmURL" value="$mConfirmURL"  placeholder="$get_site_url" maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse'  id="wp-mConfirmContent-wrap-Container" >
                    <div class='cg_view_option_title'>
                        <p>Mail content<br><span class="cg_view_option_title_note">Put this variable in the mail content editor: <strong>\$url$</strong><br>Link to confirmation page will appear in the e-mail then<br><a href="https://www.contest-gallery.com/documentation/#cgDisplayConfirmationURL" target="_blank" class="cg-documentation-link">Documentation: How to make the link clickable in e-mail</a></span></p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='mConfirmContent'  name='mConfirmContent'>$mConfirmContent</textarea>
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse'  id="wp-mConfirmConfirmationText-wrap-Container" >
                    <div class='cg_view_option_title'>
                        <p>Text after e-mail confirmation</p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='mConfirmConfirmationText'  name='mConfirmConfirmationText'>$mConfirmContentText</textarea>
                    </div>
                </div>
        </div>
</div>
HEREDOC;


echo <<<HEREDOC
</div>
HEREDOC;


