<?php

echo <<<HEREDOC
<div class='cg_view_container'>
HEREDOC;

echo <<<HEREDOC
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_margin_bottom_30" id="RegistryUserRoleContainer">
                <div class="cg_view_option_title">
                    <p>Select user role group for registered users over Contest Gallery</p>
                </div>
                <div class="cg_view_option_select">
                    <select name='RegistryUserRole'>
HEREDOC;

$roles = get_editable_roles();
// show as last!!!!
$wordPressRolesAndContestGalleryRoleKeys = ["contest_gallery_user","subscriber", "contributor", "editor", "author", "administrator"];

$cgRegistryUserRoleSelected = ($RegistryUserRole=='contest_gallery_user') ? 'selected' : '';
echo "<option value='contest_gallery_user' $cgRegistryUserRoleSelected>Contest Gallery User</option>";

foreach($roles as $keyOfRole => $roleValues){

    if(in_array($keyOfRole,$wordPressRolesAndContestGalleryRoleKeys)){
        continue;
    }
    $otherRegistryUserRoleSelected = ($RegistryUserRole==$keyOfRole) ? 'selected' : '';
    echo "<option value='$keyOfRole' $otherRegistryUserRoleSelected>".$roleValues['name']."</option>";

    // subscriber, contributor, editor, author, administrator
}

$subscriberRegistryUserRoleSelected = ($RegistryUserRole=='subscriber') ? 'selected' : '';
echo "<option value='subscriber' $subscriberRegistryUserRoleSelected>Subscriber</option>";
$contributorRegistryUserRoleSelected = ($RegistryUserRole=='contributor') ? 'selected' : '';
echo "<option value='contributor' $contributorRegistryUserRoleSelected>Contributor</option>";
$editorRegistryUserRoleSelected = ($RegistryUserRole=='editor') ? 'selected' : '';
echo "<option value='editor' $editorRegistryUserRoleSelected>Editor</option>";
$authorRegistryUserRoleSelected = ($RegistryUserRole=='author') ? 'selected' : '';
echo "<option value='author' $authorRegistryUserRoleSelected>Author</option>";
$administratorRegistryUserRoleSelected = ($RegistryUserRole=='administrator') ? 'selected' : '';
echo "<option value='administrator' $administratorRegistryUserRoleSelected>Administrator</option>";

if(empty($cgRegistryUserRoleSelected) and
    empty($otherRegistryUserRoleSelected) and
    empty($subscriberRegistryUserRoleSelected) and
    empty($contributorRegistryUserRoleSelected) and
    empty($editorRegistryUserRoleSelected) and
    empty($authorRegistryUserRoleSelected) and
    empty($administratorRegistryUserRoleSelected)
){
    echo "<option value='' selected>No role</option>";
}

echo <<<HEREDOC
                    </select>
                </div>
            </div>
        </div>
HEREDOC;

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Registration options</p>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent $cgProFalse" id="CustomImageNameContainer">
                <div class="cg_view_option_title">
                    <p>Login user immediately after registration<br><span class="cg_view_option_title_note">User account will be created right after registration and user will be logged in. 
User has not to confirm e-mail to be able to login. Confirmation e-mail will be sent additionally.</span></p>
                </div>
                <div class="cg_view_option_checkbox">
                    <input id='RegMailOptional' type='checkbox' name='RegMailOptional' $RegMailOptional >
                </div>
            </div>
       </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse" id="wp-ForwardAfterRegText-wrap-Container">
                <div class="cg_view_option_title">
                    <p>Confirmation text after registration</p>
                </div>
                <div class="cg_view_option_html">
                    <textarea class='cg-wp-editor-template' id='ForwardAfterRegText'  name='ForwardAfterRegText'>$ForwardAfterRegText</textarea>
                </div>
             </div>
        </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse" id="wp-TextAfterEmailConfirmation-wrap-Container">
                <div class="cg_view_option_title">
                    <p>Confirmation text after e-mail confirmation</p>
                </div>
                <div class="cg_view_option_html">
                    <textarea class='cg-wp-editor-template' id='TextAfterEmailConfirmation'  name='TextAfterEmailConfirmation'>$TextAfterEmailConfirmation</textarea>
                </div>
             </div>
        </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent cg_border_top_none $cgProFalse" id="HideRegFormAfterLoginContainer">
                    <div class="cg_view_option_title">
                        <p>Hide registration form if user is logged in</p>
                    </div>
                    <div class="cg_view_option_checkbox">
                        <input id='HideRegFormAfterLogin' type='checkbox' name='HideRegFormAfterLogin' $HideRegFormAfterLogin >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent cg_border_top_none $cgProFalse" id="HideRegFormAfterLoginShowTextInsteadContainer">
                    <div class="cg_view_option_title">
                        <p>Show text instead</p>
                    </div>
                    <div class="cg_view_option_checkbox">
                        <input id='HideRegFormAfterLoginShowTextInstead' type='checkbox' name='HideRegFormAfterLoginShowTextInstead' $HideRegFormAfterLoginShowTextInstead >
                    </div>
                </div>
            </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse" id="wp-HideRegFormAfterLoginTextToShow-wrap-Container">
                    <div class="cg_view_option_title">
                        <p  style="padding-right: 20px;">Text to show</p>
                    </div>
                    <div class="cg_view_option_html">
                        <textarea class='cg-wp-editor-template' id='HideRegFormAfterLoginTextToShow'  name='HideRegFormAfterLoginTextToShow'>$HideRegFormAfterLoginTextToShow</textarea>
                    </div>
                </div>
            </div>
    </div>
HEREDOC;

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Confirmation e-mail options
            <br><span class='cg_view_options_rows_container_title_note'><span class="cg_color_red">NOTE:</span> relating testing - e-mail where is send to should not contain $cgYourDomainName.<br>Many servers can not send to own domain.</span>
        </p>
HEREDOC;


if(strpos($mailExceptions,'User registration e-mail') !== false){
    echo "<div style=\"width:330px;margin: -8px auto 15px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_warning\" type=\"button\" value=\"There were mail exceptions for this mailing type\" style=\"width:330px;\"></a>
</div>";
}else{
    echo "<div style=\"width:280px;margin: -8px auto 15px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_success\" type=\"button\" value=\"No mail exceptions for this mailing type\" style=\"width:280px;\"></a>
</div>";
}

echo <<<HEREDOC
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width" id="RegMailAddressorContainer">
                <div class="cg_view_option_title">
                    <p>Header (like your company name or something like that, not an e-mail)</p>
                </div>
                <div class="cg_view_option_input">
                    <input type="text" name="RegMailAddressor" value="$RegMailAddressor"  maxlength="1000" >
                </div>
            </div>
       </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none" id="RegMailReplyContainer">
                <div class="cg_view_option_title">
                    <p>Reply mail (address From)</p>
                </div>
                <div class="cg_view_option_input">
                    <input type="text" name="RegMailReply" value="$RegMailReply"  maxlength="1000" >
                </div>
            </div>
       </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none" id="RegMailSubjectContainer">
                <div class="cg_view_option_title">
                    <p>Subject</p>
                </div>
                <div class="cg_view_option_input">
                    <input type="text" name="RegMailSubject" class="cg-long-input" value="$RegMailSubject"  maxlength="1000">
                </div>
            </div>
       </div>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse" id="wp-TextEmailConfirmation-wrap-Container">
                <div class="cg_view_option_title">
                    <p>Mail content<br><span class="cg_view_option_title_note">Put this variable in the mail content editor: <strong>\$regurl$</strong><br>(Link to confirmation page will appear in the e-mail<br>It will be the same page where your registration shortcode is inserted)
<br><a href="https://www.contest-gallery.com/documentation/#cgDisplayConfirmationURL" target="_blank" class="cg-documentation-link">Documentation: How to make the link clickable in e-mail</a></span></p>
                </div>
                <div class="cg_view_option_html">
                    <textarea class='cg-wp-editor-template' id='TextEmailConfirmation'  name='TextEmailConfirmation'>$TextEmailConfirmation</textarea
                </div>
            </div>
       </div>
    </div>
HEREDOC;

echo <<<HEREDOC
</div>
HEREDOC;

echo <<<HEREDOC
</div>
HEREDOC;


