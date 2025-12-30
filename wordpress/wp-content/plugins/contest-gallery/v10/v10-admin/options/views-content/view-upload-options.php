<?php

echo <<<HEREDOC

<div class='cg_view_container'>

HEREDOC;

echo <<<HEREDOC
        <div class='cg_view_options_row cg_margin_bottom_30'>
            <div class='cg_view_option cg_view_option_100_percent' id="ActivateUploadContainer">
                <div class='cg_view_option_title' >
                    <p>Automatically activate users images after frontend upload</p>
                </div>
                <div class='cg_view_option_checkbox'>
                    <input type="checkbox" name="ActivateUpload" id="ActivateUpload" $ActivateUpload>
                </div>
            </div>
        </div>


    <div class='cg_view_options_rows_container' id="cgInGalleryUploadFormConfiguration">
        <p class='cg_view_options_rows_container_title'>In gallery upload form text configuration</p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width' >
                    <div class='cg_view_option_title'>
                        <p>In gallery upload form button<br/><span class="cg_view_option_title_note"><a class="cg_no_outline_and_shadow_on_focus" href="#cgInGalleryUploadFormButton"  style="padding-top: 10px; display: block;">Can be activated here...</a></span></p>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' id="wp-GalleryUploadConfirmationText-wrap-Container">
                    <div class='cg_view_option_title'>
                        <p>Confirmation text after upload</p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='GalleryUploadConfirmationText'  name='GalleryUploadConfirmationText'>$GalleryUploadConfirmationText</textarea>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' id="wp-GalleryUploadTextBefore-wrap-Container">
                    <div class='cg_view_option_title'>
                        <p>Text before upload form</p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='GalleryUploadTextBefore'  name='GalleryUploadTextBefore'>$GalleryUploadTextBefore</textarea>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' id="wp-GalleryUploadTextAfter-wrap-Container">
                    <div class='cg_view_option_title'>
                        <p>Text after upload form</p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='GalleryUploadTextAfter'  name='GalleryUploadTextAfter'>$GalleryUploadTextAfter</textarea>
                    </div>
                </div>
            </div>
    </div>
HEREDOC;

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Upload form shortcode configuration<br><span class="cg_view_options_rows_container_title_note">Is not for in gallery upload form. It is for upload form shortcode: [cg_users_upload id="$galeryNR"]</span></p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent' id="forwardContainer" >
                    <div class='cg_view_option_title'>
                        <p>Forward to another page after upload</p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="forward"  id="forward" $ForwardUploadURL>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' id="forward_urlContainer" >
                    <div class='cg_view_option_title'>
                        <p>Forward to URL</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input id="forward_url" placeholder="$get_site_url" type="text" name="forward_url" maxlength="999" value="$Forward_URL" />
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent cg_border_top_none' id="cg_confirm_textContainer" >
                    <div class='cg_view_option_title'>
                        <p>Confirmation text on same page after upload instead of forwarding</p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="cg_confirm_text"  id="cg_confirm_text" $ForwardUploadConf>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent cg_border_top_none' id="ShowFormAfterUploadContainer" >
                    <div class='cg_view_option_title'>
                        <p>Show upload form again after upload<br><span class="cg_view_option_title_note">Under the confirmation text</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ShowFormAfterUpload"  id="ShowFormAfterUpload" $ShowFormAfterUpload>
                    </div>
                </div>
            </div>
             <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' id="wp-confirmation_text-wrap-Container">
                        <div class='cg_view_option_title'>
                            <p>Confirmation text after upload</p>
                        </div>
                        <div class='cg_view_option_html'>
                            <textarea class='cg-wp-editor-template' id='confirmation_text'  name='confirmation_text'>$Confirmation_Text</textarea>
                        </div>
                </div>
            </div>
     
    </div>
HEREDOC;


echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Limit uploads and user recognition methods</span></p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width $cgProFalse' id="RegUserMaxUploadContainer" >
                    <div class='cg_view_option_title'>
                        <p>Uploads per user<br><span class="cg_view_option_title_note">0 or empty = no limit</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input id="RegUserMaxUpload" type="text" name="RegUserMaxUpload" value="$RegUserMaxUpload" maxlength="20" >
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent cg_border_top_none CheckMethodUploadContainer $cgProFalse' id="CheckIpUploadContainer" >
                    <div class='cg_view_option_title'>
                        <p>Check by IP<br/><span class="cg_view_option_title_note">IP will be tracked always$userIPunknown</span></p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="RegUserUploadOnly" class="CheckMethodUpload" id="CheckIpUpload" value="3" $CheckIpUpload $checkIpCheckUpload>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent CheckMethodUploadContainer cg_border_top_none $cgProFalse'  id="CheckCookieUploadContainer"  >
                    <div class='cg_view_option_title'>
                        <p>Check by Cookie<br/><span class="cg_view_option_title_note">Cookie will be only set and tracked if this option is activated. Will be not set if administrator uploads images in WordPress backend area.</span></p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="RegUserUploadOnly" class="CheckMethodUpload" id="CheckCookieUpload" value="2" $CheckCookieUpload>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="UploadRequiresCookieMessageContainer">
                    <div class='cg_view_option_title'>
                        <p>Check Cookie alert message if user browser does not allow cookies</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" class="cg-long-input" placeholder="Please allow cookies to upload" id="UploadRequiresCookieMessage" name="UploadRequiresCookieMessage" maxlength="1000" value="$UploadRequiresCookieMessage" >
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent CheckMethodUploadContainer cg_border_top_none $cgProFalse'   id="CheckLoginUploadContainer"   >
                    <div class='cg_view_option_title'>
                        <p>Check if is registered user<br/><span class="cg_view_option_title_note">User have to be registered and logged in to be able to upload.<br>User WordPress ID will be always tracked if user is logged in.</span></p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="RegUserUploadOnly" class="CheckMethodUpload" id="CheckLoginUpload" value="1" $CheckLoginUpload>
                    </div>
                </div>
            </div>
             <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="RegUserUploadOnlyTextContainer" >
                    <div class='cg_view_option_title'>
                        <p>Show text instead of upload form<br/><span class="cg_view_option_title_note">if user is not logged in</span></p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='RegUserUploadOnlyText'  name='RegUserUploadOnlyText'>$RegUserUploadOnlyText</textarea>
                    </div>
                </div>
            </div>
    </div>
HEREDOC;


echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
HEREDOC;
echo <<<HEREDOC
        <p class='cg_view_options_rows_container_title'>Image size upload options</span></p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_right_none cg_view_option_33_percent' id="ActivatePostMaxMBContainer">
                    <div class='cg_view_option_title'>
                        <p>Restrict frontend upload size</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" id="ActivatePostMaxMB" name="ActivatePostMaxMB" $ActivatePostMaxMB>
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_67_percent' id="PostMaxMBContainer">
                    <div class='cg_view_option_title' >
                        <p>Maximum upload size in MB per image<br><span class="cg_view_option_title_note">If empty then no restrictions<br><br>
                        <span class="cg-info-position-relative">Maximum <b>upload_max_filesize</b> in your PHP configuration: <b>$upload_max_filesize MB</b><br>
<span class="cg-info-icon">more info</span>
 <span class="cg-info-container" style="top: 52px;left: 148px;display: none;">Maximum upload size per image<br><br>To increase in .htaccess file use:<br><b>php_value upload_max_filesize 10MB</b> (example, no equal to sign!)
 <br>To increase in php.ini file use:<br><b>upload_max_filesize = 10MB</b> (example, equal to sign required!)<br><br><b>Some server providers does not allow manually increase in files.<br>It has to be done in providers backend or they have to be contacted.</b></span>
 </span>
 <span class="cg-info-position-relative">Maximum <b>post_max_size</b> in your PHP configuration: <b>$post_max_size MB</b><br>
<span class="cg-info-icon">more info</span>
 <span class="cg-info-container" style="top: 52px;left: 130px;display: none;">Describes the maximum size of a post which can be done when a form submits.<br>
 Example: you try to upload 3 images with each 3MB and post_max_size is 6MB, then it will not work.<br><br>To increase in htaccess file use:<br><b>php_value post_max_size 10MB</b> (example, no equal to sign!)
 <br>To increase in php.ini file use:<br><b>post_max_size = 10MB</b> (example, equal to sign required!)<br><br><b>Some server providers does not allow manually increase in files.<br>It has to be done in providers backend or they have to be contacted.</b></span>
 </span>
 </span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input id="PostMaxMB" type="text" name="PostMaxMB" value="$PostMaxMB" maxlength="20" style="width:width:300px;" >
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_top_right_none' id="ActivateBulkUploadContainer">
                    <div class='cg_view_option_title'>
                        <p>Activate bulk (multiple images) upload in frontend</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" id="ActivateBulkUpload" name="ActivateBulkUpload" $ActivateBulkUpload>
                    </div>
                </div>
                <div class='cg_view_option cg_border_top_right_none' id="BulkUploadQuantityContainer">
                    <div class='cg_view_option_title'>
                        <p>Maximum number of images<br>for bulk upload<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input id="BulkUploadQuantity" type="text" name="BulkUploadQuantity" value="$BulkUploadQuantity" maxlength="20" >
                    </div>
                </div>
                <div class='cg_view_option cg_border_top_none' id="BulkUploadMinQuantityContainer">
                    <div class='cg_view_option_title'>
                        <p>Minimum number of images<br>for bulk upload<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input id="BulkUploadMinQuantity" type="text" name="BulkUploadMinQuantity" value="$BulkUploadMinQuantity" maxlength="20" >
                    </div>
                </div>
            </div>
HEREDOC;

echo <<<HEREDOC
<div class='cg_view_options_row'>
        <div class='cg_view_option cg_border_top_right_none cg-allow-res' id="MaxResJPGonContainer">
            <div class='cg_view_option_title'>
                <p>Restrict resolution for uploading<br>of JPG pics<span class="cg_view_option_title_note">
                <span class="cg-info-position-relative"><br>
<span class="cg-info-icon">more info</span>
 <span class="cg-info-container" style="top: 52px; left: 10px; display: none;">This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics. If your webhosting service is not so powerfull then you should use this restriction.
 </span>
 </span>
 </span>
  <span class="cg_allow_res_note cg_hide">
  <span class="cg_allow_res_note_title">Pay attention:</span>If resolution of an image is to high some servers have not enough power to convert that to lower
resoultions. Official WordPress Api which is used by plugin converts every uploaded image
to lower resolution. Then image with required resolution can be taken to reduce traffic and image load in frontend.
You have to find out by testing on yourself what resolution your server can handle. If your server can not handle the resolution it will lead in some timeout or overload error when uploading.
</span>
 </p>
             </div>
            <div class='cg_view_option_checkbox'>
                <input id='MaxResJPGon' type='checkbox' class="cg-allow-res-checkbox" name='MaxResJPGon' $MaxResJPGon >
            </div>
        </div>
        <div class='cg_view_option cg_border_top_right_none' id="MaxResJPGwidthContainer">
            <div class='cg_view_option_title'>
                <p>Maximum resolution width<br>for JPGs in pixel<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
            </div>
            <div class='cg_view_option_input'>
                <input id="MaxResJPGwidth" class="cg_font_size_14" type="text" name="MaxResJPGwidth" value="$MaxResJPGwidth" maxlength="20"  >
            </div>
        </div>
        <div class='cg_view_option cg_border_top_none' id="MaxResJPGheightContainer">
            <div class='cg_view_option_title'>
                <p>Maximum resolution height<br>for JPGs in pixel<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
            </div>
            <div class='cg_view_option_input'>
                <input id="MaxResJPGheight" class="cg_font_size_14" type="text" name="MaxResJPGheight" value="$MaxResJPGheight" maxlength="20" >
            </div>
        </div>
</div>
HEREDOC;

echo <<<HEREDOC
<div class='cg_view_options_row'>
        <div class='cg_view_option cg_border_top_right_none cg-allow-res' id="MaxResPNGonContainer">
            <div class='cg_view_option_title'>
                <p>Restrict resolution for uploading<br>of PNG pics<span class="cg_view_option_title_note">
                <span class="cg-info-position-relative"><br>
<span class="cg-info-icon">more info</span>
 <span class="cg-info-container" style="top: 52px; left: 10px; display: none;">This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics. If your webhosting service is not so powerfull then you should use this restriction.
 </span>
 </span>
 </span>
  <span class="cg_allow_res_note cg_hide">
  <span class="cg_allow_res_note_title">Pay attention:</span>If resolution of an image is to high some servers have not enough power to convert that to lower
resoultions. Official WordPress Api which is used by plugin converts every uploaded image
to lower resolution. Then image with required resolution can be taken to reduce traffic and image load in frontend.
You have to find out by testing on yourself what resolution your server can handle. If your server can not handle the resolution it will lead in some timeout or overload error when uploading.
</span>
 </p>
            </div>
            <div class='cg_view_option_checkbox'>
                <input id='MaxResPNGon' type='checkbox' class="cg-allow-res-checkbox" name='MaxResPNGon' $MaxResPNGon >
            </div>
        </div>
        <div class='cg_view_option cg_border_top_right_none' id="MaxResPNGwidthContainer">
            <div class='cg_view_option_title'>
                <p>Maximum resolution width<br>for PNGs in pixel<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
            </div>
            <div class='cg_view_option_input'>
                <input id="MaxResPNGwidth" class="cg_font_size_14" type="text" name="MaxResPNGwidth" value="$MaxResPNGwidth" maxlength="20"  >
            </div>
        </div>
        <div class='cg_view_option cg_border_top_none' id="MaxResPNGheightContainer">
            <div class='cg_view_option_title'>
                <p>Maximum resolution height<br>for PNGs in pixel<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
            </div>
            <div class='cg_view_option_input'>
                <input id="MaxResPNGheight" class="cg_font_size_14" type="text" name="MaxResPNGheight" value="$MaxResPNGheight" maxlength="20" >
            </div>
        </div>
</div>
HEREDOC;


echo <<<HEREDOC
<div class='cg_view_options_row'>
        <div class='cg_view_option cg_border_top_right_none cg-allow-res' id="MaxResGIFonContainer">
            <div class='cg_view_option_title'>
                <p>Restrict resolution for uploading<br>of GIF pics<span class="cg_view_option_title_note">
                <span class="cg-info-position-relative"><br>
<span class="cg-info-icon">more info</span>
 <span class="cg-info-container" style="top: 52px; left: 10px; display: none;">This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics. If your webhosting service is not so powerfull then you should use this restriction.
 </span>
 </span>
 </span>
  <span class="cg_allow_res_note cg_hide">
  <span class="cg_allow_res_note_title">Pay attention:</span>If resolution of an image is to high some servers have not enough power to convert that to lower
resoultions. Official WordPress Api which is used by plugin converts every uploaded image
to lower resolution. Then image with required resolution can be taken to reduce traffic and image load in frontend.
You have to find out by testing on yourself what resolution your server can handle. If your server can not handle the resolution it will lead in some timeout or overload error when uploading.
</span>
 </p>
            </div>
            <div class='cg_view_option_checkbox'>
                <input id='MaxResGIFon' type='checkbox'  class="cg-allow-res-checkbox" name='MaxResGIFon' $MaxResGIFon >
            </div>
        </div>
        <div class='cg_view_option cg_border_top_right_none' id="MaxResGIFwidthContainer">
            <div class='cg_view_option_title'>
                <p>Maximum resolution width<br>for GIFs in pixel<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
            </div>
            <div class='cg_view_option_input'>
                <input id="MaxResGIFwidth" class="cg_font_size_14" type="text" name="MaxResGIFwidth" value="$MaxResGIFwidth" maxlength="20"  >
            </div>
        </div>
        <div class='cg_view_option cg_border_top_none' id="MaxResGIFheightContainer">
            <div class='cg_view_option_title'>
                <p>Maximum resolution height<br>for GIFs in pixel<br><span class="cg_view_option_title_note">If empty then no restrictions</span></p>
            </div>
            <div class='cg_view_option_input'>
                <input id="MaxResGIFheight" class="cg_font_size_14" type="text" name="MaxResGIFheight" value="$MaxResGIFheight" maxlength="20" >
            </div>
        </div>
</div>
HEREDOC;

echo <<<HEREDOC
</div>
HEREDOC;

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Modify image name frontend upload</p>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_50_percent cg_border_right_none $cgProFalse" id="CustomImageNameContainer">
                <div class="cg_view_option_title">
                    <p>Modify image name frontend upload</p>
                </div>
                <div class="cg_view_option_checkbox">
                    <input id='CustomImageName' type='checkbox' name='CustomImageName' $CustomImageName >
                </div>
            </div>
            <div class="cg_view_option cg_view_option_50_percent cg_view_option_flex_flow_column $cgProFalse" id="CustomImageNamePathContainer">
                <div class="cg_view_option_title cg_view_option_title_full_width">
                    <p>Preselect order when page loads<br><span class="cgPreselectSortMessage cg_view_option_title_note cg_hide">(Random sort has to be deactivated)</span>
                    </p>
                </div>
                <div class="cg_view_option_select">
                    <select name='CustomImageNamePath' id='CustomImageNamePath' class='$cgProFalse'>
HEREDOC;


$CustomImageNamePathSelectedValuesArray = array(
    'GalleryId-ImageName','GalleryName-ImageName','WpUserId-ImageName','WpUserName-ImageName',
    'GalleryId-WpUserId-ImageName','GalleryId-WpUserName-ImageName',
    'GalleryName-WpUserId-ImageName','GalleryName-WpUserName-ImageName',
    'WpUserId-GalleryId-ImageName','WpUserId-GalleryName-ImageName',
    'WpUserName-GalleryId-ImageName','WpUserName-GalleryName-ImageName'
);

foreach($CustomImageNamePathSelectedValuesArray as $CustomImageNamePathArrayValue){
    $CustomImageNamePathArrayValueSelected = '';
    if($CustomImageNamePathArrayValue==$CustomImageNamePath){
        $CustomImageNamePathArrayValueSelected = 'selected';
    }
    echo "<option value='$CustomImageNamePathArrayValue' $CustomImageNamePathArrayValueSelected >$CustomImageNamePathArrayValue</option>";
}

echo <<<HEREDOC
                    </select>
                </div>
            </div>
        </div>
</div>
HEREDOC;

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Delete by frontend user deleted images from storage also</span></p>
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent cg_border" id="DeleteFromStorageIfDeletedInFrontendContainer">
                <div class="cg_view_option_title">
                    <p>When [cg_gallery_user id="$GalleryID"] shortcode is used<br>and user delete images in frontend<br>images should be deleted from storage also.<br><span class="cg_view_option_title_note">From storage deleted images can not be restored<br>they are permanently deleted.</span></p>
                </div>
                <div class="cg_view_option_checkbox">
                    <input id='DeleteFromStorageIfDeletedInFrontend' type='checkbox' name='DeleteFromStorageIfDeletedInFrontend' $DeleteFromStorageIfDeletedInFrontend >
                </div>
            </div>
        </div>
</div>
HEREDOC;


if(strpos($mailExceptions,'E-mail to administrator after upload') !== false){
    $mailExceptionAdminMail = "<div style=\"width:330px;margin: -8px auto 15px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_warning\" type=\"button\" value=\"There were mail exceptions for this mailing type\" style=\"width:330px;\"></a>
</div>";
}else{
    $mailExceptionAdminMail = "<div style=\"width:280px;margin: -8px auto 15px;\"><a href=\"?page=".cg_get_version()."/index.php&amp;corrections_and_improvements=true&amp;option_id=$galeryNR\" class='cg_load_backend_link'><input class=\"cg_backend_button cg_backend_button_back cg_backend_button_success\" type=\"button\" value=\"No mail exceptions for this mailing type\" style=\"width:280px;\"></a>
</div>";
}

$informAdminFrom = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemailAdmin->Admin);
$informAdminMail = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemailAdmin->AdminMail);
$informAdminReply = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemailAdmin->Reply);
$informAdminCC = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemailAdmin->CC);
$informAdminBCC = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemailAdmin->BCC);
$informAdminHeader = contest_gal1ery_convert_for_html_output_without_nl2br($selectSQLemailAdmin->Header);

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>E-mail to administator after upload</p>
        $mailExceptionAdminMail
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent $cgProFalse" id="InformAdminContainer">
                <div class="cg_view_option_title">
                    <p>Inform admin after upload in frontend</p>
                </div>
                <div class="cg_view_option_checkbox">
                    <input id='InformAdmin' type='checkbox' name='InformAdmin' $InformAdmin >
                </div>
            </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="cgInformAdminFromContainer" >
                    <div class='cg_view_option_title'>
                        <p>Header<br><span class="cg_view_option_title_note">Like your company name or something like that, not an e-mail</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="from" id="cgInformAdminFrom" value="$informAdminFrom"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="cgInformAdminAdminMailContainer" >
                    <div class='cg_view_option_title'>
                        <p>Admin mail (To)<br><span class="cg_view_option_title_note">
                            <span class="cg_color_red">NOTE:</span> relating testing - e-mail where is send to should not contain $cgYourDomainName.<br>Many servers can not send to own domain.</span>
                            </span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="AdminMail" id="cgInformAdminAdminMail" value="$informAdminMail"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="cgInformAdminReplyContainer" >
                    <div class='cg_view_option_title'>
                        <p>Reply mail (address From)<br><span class="cg_view_option_title_note">Should not be the same as "Admin mail"</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="reply" id="cgInformAdminReply" value="$informAdminReply"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="cgInformAdminCCContainer" >
                    <div class='cg_view_option_title'>
                        <p>CC mail<br><span class="cg_view_option_title_note">Should not be the same as "Reply mail"<br>Sending to multiple recipients example (mail1@example.com; mail2@example.com; mail3@example.com</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="cc" id="cgInformAdminCC" value="$informAdminCC"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="cgInformAdminBCCContainer" >
                    <div class='cg_view_option_title'>
                        <p>BCC mail<br><span class="cg_view_option_title_note">Should not be the same as "Reply mail"<br>Sending to multiple recipients example (mail1@example.com; mail2@example.com; mail3@example.com</span>
                        </p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="bcc" id="cgInformAdminBCC" value="$informAdminBCC"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="cgInformAdminHeaderContainer" >
                    <div class='cg_view_option_title'>
                        <p>Subject</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="header" id="cgInformAdminHeader" value="$informAdminHeader"  maxlength="1000" >
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse'  id="wp-InformAdminText-wrap-Container" >
                    <div class='cg_view_option_title'>
                        <p>Mail content<br><span class="cg_view_option_title_note">Use <strong>\$info$</strong> in the editor if you like to attach user info</span></p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='InformAdminText'  name='InformAdminText'>$ContentAdminMail</textarea>
                    </div>
                </div>
        </div>
</div>
HEREDOC;


echo <<<HEREDOC
</div>
HEREDOC;


