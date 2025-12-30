<?php

echo <<<HEREDOC
<div class='cg_view_container'>
HEREDOC;

if(strpos($mailExceptions,'Image activation e-mail frontend') !== false){
    echo "<div style=\"width:330px;margin: 0 auto 18px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_warning\" type=\"button\" value=\"There were mail exceptions for this mailing type\" style=\"width:330px;\"></a>
</div>";
}else{
    echo "<div style=\"width:280px;margin: 0 auto 18px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_success\" type=\"button\" value=\"No mail exceptions for this mailing type\" style=\"width:280px;\"></a>
</div>";
}

$InformUsersAdmin = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->Admin);
$InformUsersReply = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->Reply);
$InformUsersCC = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->CC);
$InformUsersBCC = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->BCC);
$InformUsersHeader = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->Header);
$InformUsersURL = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->URL);
$InformUsersContent = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemail->Content);

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
                <p class='cg_view_options_rows_container_title'>Create e-mail field in "Edit upload form" to inform users when activating their image.</p>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent $cgProFalse" id="InformUsersContainer">
                <div class="cg_view_option_title">
                    <p>Send this activation e-mail when activating users images<br><span class="cg_view_option_title_note"><span class="cg_color_red">NOTE:</span> relating testing - e-mail where is send to should not contain $cgYourDomainName.<br>Many servers can not send to own domain.</span></span></p>
                </div>
                <div class="cg_view_option_checkbox">
                    <input type="checkbox" name="InformUsers" id="InformUsers" value="1" $checkInform >
                </div>
            </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="InformUsersAdminContainer" >
                    <div class='cg_view_option_title'>
                        <p>Header<br><span class="cg_view_option_title_note">Like your company name or something like that, not an e-mail</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="from_user_mail" id="InformUsersAdmin" value="$InformUsersAdmin"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="InformUsersReplyContainer" >
                    <div class='cg_view_option_title'>
                        <p>Reply mail (address From)<span class="cg_view_option_title_note">$replyMailNote</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="reply_user_mail" id="InformUsersReply" value="$InformUsersReply"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="InformUsersCCContainer" >
                    <div class='cg_view_option_title'>
                        <p>CC mail<br><span class="cg_view_option_title_note">Should not be the same as "Reply mail"<br>Sending to multiple recipients example (mail1@example.com; mail2@example.com; mail3@example.com</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="cc_user_mail" id="InformUsersCC" value="$InformUsersCC"  maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="InformUsersBCCContainer" >
                    <div class='cg_view_option_title'>
                        <p>Bcc mail<br><span class="cg_view_option_title_note">Should not be the same as "Reply mail"<br>Sending to multiple recipients example (mail1@example.com; mail2@example.com; mail3@example.com</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="bcc_user_mail" id="InformUsersBCC" value="$InformUsersBCC"  maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="InformUsersHeaderContainer" >
                    <div class='cg_view_option_title'>
                        <p>Subject</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="header_user_mail" id="InformUsersHeader" value="$InformUsersHeader"  maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="InformUsersURLContainer" >
                    <div class='cg_view_option_title'>
                        <p>URL<br><span class="cg_view_option_title_note">URL of same page where shortcode [cg_gallery id="$GalleryID"] of this gallery is inserted</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="url_user_mail" id="InformUsersURL" value="$InformUsersURL"  placeholder="$get_site_url" maxlength="1000">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse'  id="wp-InformUsersContent-wrap-Container" >
                    <div class='cg_view_option_title'>
                        <p>Mail content<br><span class="cg_view_option_title_note">Put this variable in the mail content editor: <strong>\$url$</strong><br>Link to users image in confirmation mail will appear when the image is activated<br><a href="https://www.contest-gallery.com/documentation/#cgDisplayConfirmationURL" target="_blank" class="cg-documentation-link">Documentation: How to make the link clickable in e-mail</a></span></p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='InformUsersContent'  name='cgEmailImageActivating'>$InformUsersContent</textarea>
                    </div>
                </div>
        </div>
</div>
HEREDOC;


echo <<<HEREDOC
</div>
HEREDOC;


