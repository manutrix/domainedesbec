<?php

check_admin_referer('cg_admin');


$id = intval($_GET['option_id']);


//echo "<br>id: $id<br>";

global $wpdb;

$tablename = $wpdb->prefix . "contest_gal1ery";
$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";
$tablenameOptionsInput = $wpdb->prefix . "contest_gal1ery_options_input";
$tablename_ip = $wpdb->prefix . "contest_gal1ery_ip";
$tablename_mail_admin = $wpdb->prefix . "contest_gal1ery_mail_admin";
$tablenameemail = $wpdb->prefix . "contest_gal1ery_mail";
$tablename_f_input = $wpdb->prefix . "contest_gal1ery_f_input";
$tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";
//$tablename_mail_gallery = $wpdb->prefix . "contest_gal1ery_mail_gallery";
$tablename_mail_confirmation = $wpdb->prefix . "contest_gal1ery_mail_confirmation";

$wp_upload_dir = wp_upload_dir();
$galleryUploadFolder = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '';

if (!is_dir($galleryUploadFolder)) {
    mkdir($galleryUploadFolder, 0755, true);
}


/*foreach($_POST as $key => $post){
    if(!is_array($post)){
        $_POST[$key] = sanitize_text_field(htmlentities($post));
    }else{
        foreach($post as $keyKey => $postPost){
            if(!is_array($postPost)){
                $_POST[$key][$keyKey] = sanitize_text_field(htmlentities($postPost));
            }
        }
    }
}*/

if (!empty($_GET['reset_users_votes'])) {

    //  $wpdb->delete( $tablename_ip, array( 'GalleryID' => $id ), array( '%d' ) );

    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $tablename_ip WHERE GalleryID = %d AND Rating >= %d",
            $id, 1
        )
    );

    ?>
    <script>
        alert('All 5 stars users votes were deleted.\r\nFrontend needs to be reloaded.');
    </script>

    <?php

}

if (isset($_GET['reset_users_votes2'])) {

    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $tablename_ip WHERE GalleryID = %d AND RatingS = %d",
            $id, 1
        )
    );

    ?>
    <script>
        alert('All 1 star users votes were deleted.\nFrontend needs to be reloaded.');
    </script>

    <?php

}

$sortValuesArray = array();

if (!empty($_GET['reset_votes'])) {

    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $tablename_ip WHERE GalleryID = %d AND Rating >= %d",
            $id, 1
        )
    );

    $wpdb->update(
        "$tablename",
        array('CountR' => 0, 'Rating' => 0, 'CountR1' => 0, 'CountR2' => 0, 'CountR3' => 0, 'CountR4' => 0, 'CountR5' => 0),
        array('GalleryID' => $id),
        array('%d', '%d', '%d', '%d', '%d', '%d', '%d'),
        array('%d')
    );

    ?>
    <script>
        alert('All 5 stars votes were completely deleted.\nFrontend needs to be reloaded.');
    </script>

    <?php

    $imageDataJsonFiles = glob($wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '/json/image-data/*.json');

    foreach ($imageDataJsonFiles as $jsonFile) {
        $fp = fopen($jsonFile, 'r');
        $imageDataArray = json_decode(fread($fp, filesize($jsonFile)), true);
        fclose($fp);

        // get image id
        $stringArray = explode('/image-data-', $jsonFile);
        $subString = end($stringArray);
        $imageId = substr($subString, 0, -5);

        $imageDataArray['CountR'] = 0;
        $imageDataArray['CountR1'] = 0;
        $imageDataArray['CountR2'] = 0;
        $imageDataArray['CountR3'] = 0;
        $imageDataArray['CountR4'] = 0;
        $imageDataArray['CountR5'] = 0;
        $imageDataArray['Rating'] = 0;

        $fp = fopen($jsonFile, 'w');
        fwrite($fp, json_encode($imageDataArray));
        fclose($fp);

        $sortValuesArray[$imageId] = $imageDataArray;

    }

}

if (!empty($_GET['reset_votes2'])) {

    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $tablename_ip WHERE GalleryID = %d AND RatingS = %d",
            $id, 1
        )
    );

    $wpdb->update(
        "$tablename",
        array('CountS' => 0),
        array('GalleryID' => $id),
        array('%d'),
        array('%d')
    );

    ?>
    <script>
        alert('All 1 star votes were completely deleted.\nFrontend needs to be reloaded.');
    </script>

    <?php

    $imageDataJsonFiles = glob($wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '/json/image-data/*.json');

    foreach ($imageDataJsonFiles as $jsonFile) {
        $fp = fopen($jsonFile, 'r');
        $imageDataArray = json_decode(fread($fp, filesize($jsonFile)), true);
        fclose($fp);

        // get image id
        $stringArray = explode('/image-data-', $jsonFile);
        $subString = end($stringArray);
        $imageId = substr($subString, 0, -5);


        $imageDataArray['CountS'] = 0;
        $fp = fopen($jsonFile, 'w');
        fwrite($fp, json_encode($imageDataArray));
        fclose($fp);

        $sortValuesArray[$imageId] = $imageDataArray;


    }

}


if (!empty($_GET['reset_admin_votes'])) {

    $wpdb->update(
        "$tablename",
        array('addCountR1' => 0, 'addCountR2' => 0, 'addCountR3' => 0, 'addCountR4' => 0, 'addCountR5' => 0),
        array('GalleryID' => $id),
        array('%d'),
        array('%d')
    );

    ?>
    <script>
        alert('All 5 stars administrator votes were deleted.\nFrontend needs to be reloaded.');
    </script>

    <?php

    $imageDataJsonFiles = glob($wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '/json/image-data/*.json');

    foreach ($imageDataJsonFiles as $jsonFile) {

        $fp = fopen($jsonFile, 'r');
        $imageDataArray = json_decode(fread($fp, filesize($jsonFile)), true);
        fclose($fp);

        // get image id
        $stringArray = explode('/image-data-', $jsonFile);
        $subString = end($stringArray);
        $imageId = substr($subString, 0, -5);

        $imageDataArray['addCountR1'] = 0;
        $imageDataArray['addCountR2'] = 0;
        $imageDataArray['addCountR3'] = 0;
        $imageDataArray['addCountR4'] = 0;
        $imageDataArray['addCountR5'] = 0;

        $fp = fopen($jsonFile, 'w');
        fwrite($fp, json_encode($imageDataArray));
        fclose($fp);

        $sortValuesArray[$imageId] = $imageDataArray;


    }

}

if (!empty($_GET['reset_admin_votes2'])) {

    $wpdb->update(
        "$tablename",
        array('addCountS' => 0),
        array('GalleryID' => $id),
        array('%d'),
        array('%d')
    );

    ?>
    <script>
        alert('All 1 star administrator votes were deleted.\nFrontend needs to be reloaded.');
    </script>

    <?php

    $imageDataJsonFiles = glob($wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '/json/image-data/*.json');

    foreach ($imageDataJsonFiles as $jsonFile) {
        $fp = fopen($jsonFile, 'r');
        $imageDataArray = json_decode(fread($fp, filesize($jsonFile)), true);
        fclose($fp);

        // get image id
        $stringArray = explode('/image-data-', $jsonFile);
        $subString = end($stringArray);
        $imageId = substr($subString, 0, -5);

        $imageDataArray['addCountS'] = 0;
        $fp = fopen($jsonFile, 'w');
        fwrite($fp, json_encode($imageDataArray));
        fclose($fp);

        $sortValuesArray[$imageId] = $imageDataArray;

    }

}

/*echo "<pre>";
print_r($sortValuesArray);
echo "</pre>";*/

if (!empty($sortValuesArray)) {

    $jsonFile = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '/json/' . $id . '-images-sort-values.json';
    $fp = fopen($jsonFile, 'w');
    fwrite($fp, json_encode($sortValuesArray));
    fclose($fp);

}


// Values which should not be saved if not sended
$unsavingValues = $wpdb->get_row("SELECT * FROM $tablenameOptions WHERE id = '$id'");
$PicsPerSite = $unsavingValues->PicsPerSite;
$ScaleOnly = $unsavingValues->ScaleOnly;
$ScaleAndCut = $unsavingValues->ScaleAndCut;
$WidthThumb = $unsavingValues->WidthThumb;
$HeightThumb = $unsavingValues->HeightThumb;
$WidthGallery = $unsavingValues->WidthGallery;
$HeightGallery = $unsavingValues->HeightGallery;
$PicsInRow = $unsavingValues->PicsInRow;
$HeightLookHeight = $unsavingValues->HeightLookHeight;
$CheckCookieAlertMessage = $unsavingValues->CheckCookieAlertMessage;
$MaxResJPG = $unsavingValues->MaxResJPG;
$MaxResPNG = $unsavingValues->MaxResPNG;
$MaxResGIF = $unsavingValues->MaxResGIF;
$HeightGallery = $unsavingValues->HeightGallery;
$ContestEndTime = $unsavingValues->ContestEndTime;
$ContestStartTime = $unsavingValues->ContestStartTime;
$AdjustThumbLook = $unsavingValues->AdjustThumbLook;
$DistancePics = $unsavingValues->DistancePics;
$DistancePicsV = $unsavingValues->DistancePicsV;
$HideInfo = $unsavingValues->HideInfo;
$FbLikeGoToGalleryLink = $unsavingValues->FbLikeGoToGalleryLink;
$FullSize = $unsavingValues->FullSize;
$FullSizeGallery = $unsavingValues->FullSizeGallery;
$FullSizeSlideOutStart = $unsavingValues->FullSizeSlideOutStart;
$IpBlock = $unsavingValues->IpBlock;
$dbVersion = floatval($unsavingValues->Version);// IMPORTANT! Do not remove, required for json-options.php!!!


if (!empty($_POST['changeSize'])) {

    if (!$cgProVersion) {

        unset($_POST['ContestEndInstant']);
        unset($_POST['ContestEnd']);
        unset($_POST['ContestStart']);
        unset($_POST['checkLogin']);
        unset($_POST['HideUntilVote']);
        unset($_POST['VotesPerUser']);
        unset($_POST['VotesPerCategory']);
        unset($_POST['ShowOnlyUsersVotes']);
        unset($_POST['RegUserMaxUpload']);
        unset($_POST['RegUserGalleryOnly']);
        unset($_POST['InformAdmin']);
        unset($_POST['mConfirmSendConfirm']);
        unset($_POST['InformUsers']);
        unset($_POST['ShowNickname']);
        ###NORMAL###
        if($IpBlock!=1){
            unset($_POST['IpBlock']);
        }
        ###NORMAL-END###
        unset($_POST['MinusVote']);
        unset($_POST['ForwardAfterLoginUrlCheck']);
        unset($_POST['ForwardAfterLoginTextCheck']);
        unset($_POST['VotesInTime']);
        unset($_POST['HideRegFormAfterLogin']);
        unset($_POST['HideRegFormAfterLoginShowTextInstead']);
        unset($_POST['RegUserMaxUpload']);
        unset($_POST['FbLikeNoShare']);// added on 26.03.2020
        unset($_POST['VoteNotOwnImage']);// added on 13.04.2020
        unset($_POST['RegMailOptional']);// added on 13.07.2020
        unset($_POST['CustomImageName']);// added on 03.09.2020
        unset($_POST['VotesPerUserAllVotesUsedHtmlMessage']);// added on 01.02.2020
        $_POST['CustomImageNamePath'] = '';
        $_POST['multiple-pics']['cg_gallery_user']['pro']['ShowNickname'] = 0;
        $_POST['multiple-pics']['cg_gallery_no_voting']['pro']['ShowNickname'] = 0;
        $_POST['multiple-pics']['cg_gallery_winner']['pro']['ShowNickname'] = 0;

    }


// Values which should not be saved if not sended
    $unsavingValues = $wpdb->get_row("SELECT * FROM $tablename_pro_options WHERE GalleryID = '$id'");
    $ForwardAfterLoginUrl = $unsavingValues->ForwardAfterLoginUrl;
    $ForwardAfterLoginText = $unsavingValues->ForwardAfterLoginText;
    $RegUserUploadOnlyText = $unsavingValues->RegUserUploadOnlyText;
    $RegUserGalleryOnlyText = $unsavingValues->RegUserGalleryOnlyText;
    $GalleryUploadConfirmationText = $unsavingValues->GalleryUploadConfirmationText;
    $GalleryUploadTextBefore = $unsavingValues->GalleryUploadTextBefore;
    $GalleryUploadTextAfter = $unsavingValues->GalleryUploadTextAfter;
    $VotesInTimeQuantity = $unsavingValues->VotesInTimeQuantity;
    $VotesInTimeIntervalReadable = $unsavingValues->VotesInTimeIntervalReadable;
    $VotesInTimeIntervalSeconds = $unsavingValues->VotesInTimeIntervalSeconds;
    $VotesInTimeIntervalAlertMessage = $unsavingValues->VotesInTimeIntervalAlertMessage;
    $HideRegFormAfterLoginTextToShow = $unsavingValues->HideRegFormAfterLoginTextToShow;
    $RegUserMaxUpload = $unsavingValues->RegUserMaxUpload;
    $IsModernFiveStar = $unsavingValues->IsModernFiveStar;
    $FbLikeNoShareBefore = $unsavingValues->FbLikeNoShare;
    $FbLikeOnlyShareBefore = $unsavingValues->FbLikeOnlyShare;
    $ShowCatsUnchecked = $unsavingValues->ShowCatsUnchecked;
    $CatWidget = $unsavingValues->CatWidget;
    $ShowOther = $unsavingValues->ShowOther;
    $ShowCatsUnchecked = $unsavingValues->ShowCatsUnchecked;

    $HideRegFormAfterLogin = (!empty($_POST['HideRegFormAfterLogin'])) ? '1' : '0';
    $HideRegFormAfterLoginShowTextInstead = (!empty($_POST['HideRegFormAfterLoginShowTextInstead'])) ? '1' : '0';
    $HideRegFormAfterLoginTextToShow = (isset($_POST['HideRegFormAfterLoginTextToShow'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['HideRegFormAfterLoginTextToShow']) : $HideRegFormAfterLoginTextToShow;

    $CustomImageNamePath = $unsavingValues->CustomImageNamePath;

    $CustomImageName = (!empty($_POST['CustomImageName'])) ? 1 : 0;

    if(!empty($CustomImageName)){
        $CustomImageNamePath = trim(sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace($_POST['CustomImageNamePath'])));
    }

// Values which should not be saved if not sended
    $unsavingValuesVisual = $wpdb->get_row("SELECT * FROM $tablename_options_visual WHERE GalleryID = '$id'");
    $ThumbViewBorderWidth = $unsavingValuesVisual->ThumbViewBorderWidth;
    $ThumbViewBorderRadius = $unsavingValuesVisual->ThumbViewBorderRadius;
    $ThumbViewBorderColor = $unsavingValuesVisual->ThumbViewBorderColor;
    $ThumbViewBorderOpacity = $unsavingValuesVisual->ThumbViewBorderOpacity;
    $HeightViewBorderWidth = $unsavingValuesVisual->HeightViewBorderWidth;
    $HeightViewBorderRadius = $unsavingValuesVisual->HeightViewBorderRadius;
    $HeightViewSpaceWidth = $unsavingValuesVisual->HeightViewSpaceWidth;
    $HeightViewSpaceHeight = $unsavingValuesVisual->HeightViewSpaceHeight;
    $HeightViewBorderColor = $unsavingValuesVisual->HeightViewBorderColor;
    $HeightViewBorderOpacity = $unsavingValuesVisual->HeightViewBorderOpacity;
    $RowViewBorderWidth = $unsavingValuesVisual->RowViewBorderWidth;
    $RowViewBorderColor = $unsavingValuesVisual->RowViewBorderColor;
    $RowViewBorderOpacity = $unsavingValuesVisual->RowViewBorderOpacity;
    $RowViewBorderRadius = $unsavingValuesVisual->RowViewBorderRadius;
    $RowViewSpaceWidth = $unsavingValuesVisual->RowViewSpaceWidth;
    $RowViewSpaceHeight = $unsavingValuesVisual->RowViewSpaceHeight;
    $TitlePositionGallery = $unsavingValuesVisual->TitlePositionGallery;
    $RatingPositionGallery = $unsavingValuesVisual->RatingPositionGallery;
    $CommentPositionGallery = $unsavingValuesVisual->CommentPositionGallery;
    $ActivateGalleryBackgroundColor = $unsavingValuesVisual->ActivateGalleryBackgroundColor;
    $GalleryBackgroundColor = $unsavingValuesVisual->GalleryBackgroundColor;
    $GalleryBackgroundOpacity = $unsavingValuesVisual->GalleryBackgroundOpacity;
    $OriginalSourceLinkInSlider = $unsavingValuesVisual->OriginalSourceLinkInSlider;
    $PreviewInSlider = $unsavingValuesVisual->PreviewInSlider;
    $BlogLookFullWindow = $unsavingValuesVisual->BlogLookFullWindow;
    $ImageViewFullWindow = $unsavingValuesVisual->ImageViewFullWindow;
    $ImageViewFullScreen = $unsavingValuesVisual->ImageViewFullScreen;
    $SliderThumbNav = $unsavingValuesVisual->SliderThumbNav;

    $AllowSortOptionsArray = (!empty($_POST['AllowSortOptionsArray'])) ? $_POST['AllowSortOptionsArray'] : [];

    if (!empty($AllowSortOptionsArray)) {

        $AllowSortOptions = '';

        foreach ($AllowSortOptionsArray as $AllowSortOptionsValue) {
            if (empty($AllowSortOptions)) {
                $AllowSortOptions .= $AllowSortOptionsValue;
            } else {
                $AllowSortOptions .= ',' . $AllowSortOptionsValue;
            }
        }

    } else {
        $AllowSortOptions = 'empty';
    }

    $OriginalSourceLinkInSlider = (isset($_POST['OriginalSourceLinkInSlider'])) ? '1' : '0';

    if (!empty($_POST['PreviewInSlider']) && !empty($_POST['AllowGalleryScript'])) {

        $PreviewInSlider = $PreviewInSlider;

    } else {
        $PreviewInSlider = (isset($_POST['PreviewInSlider'])) ? '1' : '0';
    }

    $ShowNickname = (!empty($_POST['ShowNickname'])) ? '1' : '0';

    $ShowExif = (!empty($_POST['ShowExif'])) ? '1' : '0';

    // old code not required anymore 06.06.2020

    /*    if(function_exists('exif_read_data')){

            if(!empty($_POST['ShowExif'])){

                $lastActiveImageIdWithoutExif = $wpdb->get_var("SELECT id FROM $tablename WHERE GalleryID = '$id' AND Active = '1' AND (Exif = '' OR Exif IS NULL) ORDER BY id DESC LIMIT 1");

                // Dann bei allen aktiven Bildern Exif Daten einfügen
                if(!empty($lastActiveImageIdWithoutExif)){

                    $allActiveWpImageIds = $wpdb->get_results("SELECT id, WpUpload FROM $tablename WHERE GalleryID = '$id' AND Active = '1' AND (Exif = '' OR Exif IS NULL) ORDER BY id DESC");

                    foreach($allActiveWpImageIds as $row){

                        $imageId = $row->id;
                        $wpImageId = $row->WpUpload;

                        $imageDataFile = $galleryUploadFolder.'/json/image-data/image-data-'.$imageId.'.json';

                        $fp = fopen($imageDataFile, 'r');
                        $imageDataFileArray = json_decode(fread($fp, filesize($imageDataFile)),true);
                        fclose($fp);

                        //  if(empty($imageDataFileArray['Exif'] )){
                        $imageDataFileArray['Exif'] = cg_create_exif_data($wpImageId);
                        //  }
                        if(empty($imageDataFileArray['Exif'])){
                            $imageDataFileArray['Exif'] = 0;
                        }

                        $fp = fopen($imageDataFile, 'w');
                        fwrite($fp, json_encode($imageDataFileArray));
                        fclose($fp);

                        if(empty($imageDataFileArray['Exif'])){
                            $imageDataFileArraySerialized = 0;
                        }else{
                            $imageDataFileArraySerialized = serialize($imageDataFileArray['Exif']);
                        }


                        // Extra update von STRINGS hier notwendig
                        $wpdb->update(
                            "$tablename",
                            array('Exif'=>$imageDataFileArraySerialized),
                            array('id' => $imageId),
                            array('%s'),
                            array('%d')
                        );

                    }

                }

            }

        }*/


    $MinusVote = (!empty($_POST['MinusVote'])) ? '1' : '0';

    $SliderFullWindow = (!empty($_POST['SliderFullWindow'])) ? '1' : '0';

  //  var_dump($SliderFullWindow);

    $BlogLookFullWindow = (!empty($_POST['BlogLookFullWindow'])) ? 1 : 0;

  //  var_dump($BlogLookFullWindow);


    $SlideTransition = (!empty($_POST['SlideTransition'])) ? $_POST['SlideTransition'] : 'translateX';

    // Votes in a time start

    // var_dump($_POST['cg_date_hours_vote_interval']);
    // var_dump($_POST['cg_date_mins_vote_interval']);

    $VotesInTime = (!empty($_POST['VotesInTime'])) ? '1' : '0';
    $VotesInTimeQuantity = (!empty($_POST['VotesInTimeQuantity'])) ? $_POST['VotesInTimeQuantity'] : $VotesInTimeQuantity;
    if (!empty($_POST['cg_date_hours_vote_interval']) or $_POST['cg_date_hours_vote_interval'] == '00') {
        $_POST['VotesInTimeIntervalReadable'] = $_POST['cg_date_hours_vote_interval'] . ":" . $_POST['cg_date_mins_vote_interval'];

        /*        if(intval($_POST['cg_date_hours_vote_interval'])==0){
                    $_POST['VotesInTimeIntervalSeconds'] =  intval($_POST['cg_date_mins_vote_interval'])*60;
                }else{
                    $_POST['VotesInTimeIntervalSeconds'] = intval($_POST['cg_date_hours_vote_interval'])*(intval($_POST['cg_date_mins_vote_interval'])*60);
                }*/


        //   $str_time = "1:01";

        sscanf($_POST['VotesInTimeIntervalReadable'], "%d:%d:%d", $hours, $minutes, $seconds);

        $_POST['VotesInTimeIntervalSeconds'] = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;

    }
    //  var_dump($_POST['VotesInTimeIntervalSeconds']);

    $VotesInTimeIntervalReadable = (isset($_POST['VotesInTimeIntervalReadable'])) ? sanitize_text_field(htmlentities($_POST['VotesInTimeIntervalReadable'])) : $VotesInTimeIntervalReadable;
    $VotesInTimeIntervalSeconds = (isset($_POST['VotesInTimeIntervalSeconds'])) ? $_POST['VotesInTimeIntervalSeconds'] : $VotesInTimeIntervalSeconds;
    $VotesInTimeIntervalAlertMessage = (isset($_POST['VotesInTimeIntervalAlertMessage'])) ? sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace($_POST['VotesInTimeIntervalAlertMessage'])) : $VotesInTimeIntervalAlertMessage;

    // Votes in a time end

    $ActivateGalleryBackgroundColor = (isset($_POST['ActivateGalleryBackgroundColor'])) ? '1' : '0';

    $TitlePositionGallery = (isset($_POST['TitlePositionGallery'])) ? $_POST['TitlePositionGallery'] : $TitlePositionGallery;
    $RatingPositionGallery = (isset($_POST['RatingPositionGallery'])) ? $_POST['RatingPositionGallery'] : $RatingPositionGallery;
    $CommentPositionGallery = (isset($_POST['CommentPositionGallery'])) ? $_POST['CommentPositionGallery'] : $CommentPositionGallery;

    $ThumbViewBorderWidth = (!empty($_POST['ThumbViewBorderWidth'])) ? $_POST['ThumbViewBorderWidth'] : $ThumbViewBorderWidth;
    $ThumbViewBorderRadius = (!empty($_POST['ThumbViewBorderRadius'])) ? $_POST['ThumbViewBorderRadius'] : $ThumbViewBorderRadius;


    if (!isset($_POST['GalleryBackgroundColor'])) {
        $GalleryBackgroundColor = $GalleryBackgroundColor;
        $GalleryBackgroundOpacity = $GalleryBackgroundOpacity;
    } else {
        $GalleryBackgroundColorPOST = $_POST['GalleryBackgroundColor'];
        if ($GalleryBackgroundColorPOST) {
            foreach ($GalleryBackgroundColorPOST as $key1 => $value1) {
                $GalleryBackgroundOpacity = $key1;
                $GalleryBackgroundColor = $value1;
            }
        } else {
            $GalleryBackgroundColor = $GalleryBackgroundColor;
        }
    }

    $GalleryBackgroundOpacity = 1;

    if (!isset($_POST['ThumbViewBorderColor'])) {
        $ThumbViewBorderColor = $ThumbViewBorderColor;
        $ThumbViewBorderOpacity = $ThumbViewBorderOpacity;
    } else {
        $ThumbViewBorderColorPOST = $_POST['ThumbViewBorderColor'];
        if ($ThumbViewBorderColorPOST) {
            foreach ($ThumbViewBorderColorPOST as $key1 => $value1) {
                $ThumbViewBorderOpacity = sanitize_text_field(htmlentities($key1));
                $ThumbViewBorderColor = sanitize_text_field(htmlentities($value1));
            }
        } else {
            $ThumbViewBorderColor = sanitize_text_field(htmlentities($ThumbViewBorderColor));
        }
    }

    if (empty($ThumbViewBorderColor)) {
        $ThumbViewBorderColor = '#000000';
    }

    $ThumbViewBorderOpacity = 1;

    if (!isset($_POST['HeightViewBorderColor'])) {
        $HeightViewBorderColor = $HeightViewBorderColor;
        $HeightViewBorderOpacity = $HeightViewBorderOpacity;
    } else {
        $HeightViewBorderColorPOST = $_POST['HeightViewBorderColor'];
        if ($HeightViewBorderColorPOST) {
            foreach ($HeightViewBorderColorPOST as $key2 => $value2) {
                $HeightViewBorderOpacity = sanitize_text_field(htmlentities($key2));
                $HeightViewBorderColor = sanitize_text_field(htmlentities($value2));
            }
        } else {
            $HeightViewBorderColor = sanitize_text_field(htmlentities($HeightViewBorderColor));
        }
    }

    if (empty($HeightViewBorderColor)) {
        $HeightViewBorderColor = '#000000';
    }

    $HeightViewBorderOpacity = 1;

    if (!isset($_POST['RowViewBorderColor'])) {
        $RowViewBorderColor = $RowViewBorderColor;
        $RowViewBorderOpacity = $RowViewBorderOpacity;
    } else {
        $RowViewBorderColorPOST = $_POST['RowViewBorderColor'];
        if ($RowViewBorderColorPOST) {
            foreach ($RowViewBorderColorPOST as $key3 => $value3) {
                $RowViewBorderOpacity = sanitize_text_field(htmlentities($key3));
                $RowViewBorderColor = sanitize_text_field(htmlentities($value3));
            }
        } else {
            $RowViewBorderOpacity = sanitize_text_field(htmlentities($RowViewBorderOpacity));
        }
    }

    if (empty($RowViewBorderColor)) {
        $RowViewBorderColor = '#000000';
    }

    $RowViewBorderOpacity = 1;

    $GalleryName = trim(sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace($_POST['GalleryName'])));


    $RowViewBorderWidth = (isset($_POST['RowViewBorderWidth'])) ? $_POST['RowViewBorderWidth'] : $RowViewBorderWidth;
    $RowViewBorderRadius = (isset($_POST['RowViewBorderRadius'])) ? $_POST['RowViewBorderRadius'] : $RowViewBorderRadius;
    $RowViewSpaceWidth = (isset($_POST['RowViewSpaceWidth'])) ? $_POST['RowViewSpaceWidth'] : $RowViewSpaceWidth;
    $RowViewSpaceHeight = (isset($_POST['RowViewSpaceHeight'])) ? $_POST['RowViewSpaceHeight'] : $RowViewSpaceHeight;

    $HeightViewBorderWidth = (isset($_POST['HeightViewBorderWidth'])) ? $_POST['HeightViewBorderWidth'] : $HeightViewBorderWidth;
    $HeightViewBorderRadius = (isset($_POST['HeightViewBorderRadius'])) ? $_POST['HeightViewBorderRadius'] : $HeightViewBorderRadius;
    $HeightViewSpaceWidth = (isset($_POST['HeightViewSpaceWidth'])) ? $_POST['HeightViewSpaceWidth'] : $HeightViewSpaceWidth;
    $HeightViewSpaceHeight = (isset($_POST['HeightViewSpaceHeight'])) ? $_POST['HeightViewSpaceHeight'] : $HeightViewSpaceHeight;


//echo $HeightViewBorderWidth;


//    var_dump($OriginalSourceLinkInSlider);
//    var_dump($PreviewInSlider);

    $FeControlsStyle = (!empty($_POST['FeControlsStyle'])) ? $_POST['FeControlsStyle'] : 'white';
    $GalleryStyle = (!empty($_POST['GalleryStyle'])) ? $_POST['GalleryStyle'] : 'center-black';


    // view order

    $order = $_POST['order'];

    $i = 0;
    //echo "<br>Order:<br>";
    //print_r($order);
    //echo "<br>";

    foreach ($order as $key => $value) {

        $i++;

        if ($value == 't') {
            $t = $i;
        }
        if ($value == 'h') {
            $h = $i;
        }
        if ($value == 'r') {
            $r = $i;
        }
        if ($value == 's') {
            $s = $i;
        }
        if ($value == 'b') {
            $b = $i;
        }

    }

    $ThumbLook = (!empty($_POST['ThumbLook'])) ? '1' : '0';
    $HeightLook = (!empty($_POST['HeightLook'])) ? '1' : '0';
    $RowLook = (!empty($_POST['RowLook'])) ? '1' : '0';
    $SliderLook = (!empty($_POST['SliderLook'])) ? '1' : '0';
    $BlogLook = (!empty($_POST['BlogLook'])) ? 1 : 0;

    $ThumbLookOrder = $t;
    $HeightLookOrder = $h;
    $RowLookOrder = $r;
    $SliderLookOrder = $s;
    $BlogLookOrder = $b;

    //var_dump($ThumbLookOrder);
    //var_dump($HeightLookOrder);
    //var_dump($RowLookOrder);
    //var_dump($SliderLookOrder);
    //var_dump($BlogLookOrder);

    // view order --- END

    $ImageViewFullWindow = (!empty($_POST['ImageViewFullWindow'])) ? 1 : 0;
    $ImageViewFullScreen = (!empty($_POST['ImageViewFullScreen'])) ? 1 : 0;
    $SliderThumbNav = (!empty($_POST['SliderThumbNav'])) ? 1 : 0;
    $BorderRadius = (!empty($_POST['BorderRadius'])) ? 1 : 0;

    $wpdb->update(
        "$tablename_options_visual",
        array('ThumbViewBorderWidth' => $ThumbViewBorderWidth, 'ThumbViewBorderRadius' => $ThumbViewBorderRadius,
            'ThumbViewBorderColor' => $ThumbViewBorderColor, 'ThumbViewBorderOpacity' => $ThumbViewBorderOpacity,
            'HeightViewBorderWidth' => $HeightViewBorderWidth, 'HeightViewBorderRadius' => $HeightViewBorderRadius,
            'HeightViewBorderColor' => $HeightViewBorderColor, 'HeightViewBorderOpacity' => $HeightViewBorderOpacity, 'HeightViewSpaceWidth' => $HeightViewSpaceWidth, 'HeightViewSpaceHeight' => $HeightViewSpaceHeight,
            'RowViewBorderWidth' => $RowViewBorderWidth, 'RowViewBorderRadius' => $RowViewBorderRadius,
            'RowViewBorderColor' => $RowViewBorderColor, 'RowViewBorderOpacity' => $RowViewBorderOpacity, 'RowViewSpaceWidth' => $RowViewSpaceWidth, 'RowViewSpaceHeight' => $RowViewSpaceHeight,
            'TitlePositionGallery' => $TitlePositionGallery, 'RatingPositionGallery' => $RatingPositionGallery, 'CommentPositionGallery' => $CommentPositionGallery,
            'ActivateGalleryBackgroundColor' => $ActivateGalleryBackgroundColor, 'GalleryBackgroundColor' => $GalleryBackgroundColor, 'GalleryBackgroundOpacity' => $GalleryBackgroundOpacity,
            'OriginalSourceLinkInSlider' => $OriginalSourceLinkInSlider, 'PreviewInSlider' => $PreviewInSlider,
            'FeControlsStyle' => $FeControlsStyle, 'AllowSortOptions' => $AllowSortOptions, 'GalleryStyle' => $GalleryStyle,
            'BlogLook' => $BlogLook, 'BlogLookOrder' => $BlogLookOrder, 'BlogLookFullWindow' => $BlogLookFullWindow,
            'ImageViewFullWindow' => $ImageViewFullWindow, 'ImageViewFullScreen' => $ImageViewFullScreen,
            'SliderThumbNav' => $SliderThumbNav,'BorderRadius' => $BorderRadius),
        array('GalleryID' => $id),
        array('%d', '%d',
            '%s', '%s',
            '%d', '%d',
            '%s', '%s', '%d', '%d',
            '%d', '%d',
            '%s', '%s', '%d', '%d',
            '%d', '%d', '%d',
            '%d', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s',
            '%d', '%d', '%d',
            '%d', '%d',
            '%d', '%d'),
        array('%d')
    );

// Unix Zeitstempel wird eingetragen. Sp�ter browserabh�ngig verarbeitet.
// 86400 = Anzahl der Sekunden an einem Tag
// Man w�hlt immer den Tag aus an dem der Contest endet in, edit-options.php, das ist dann immer 00:00 und f�gt die Sekunden hinzu bis Ende des Taes.
// �berall anders aknn die Zeit dann direkt verarbeitet werden
//$unix = time();

    if (!empty($_POST['ContestEndTime'])) {

        $ContestEndTimeHours = (!empty($_POST['ContestEndTimeHours'])) ? $_POST['ContestEndTimeHours'] : '00';
        $ContestEndTimeMins = (!empty($_POST['ContestEndTimeMins'])) ? $_POST['ContestEndTimeMins'] : '00';

        $ContestEndTime = (!empty($_POST['ContestEndTime'])) ? strtotime($_POST['ContestEndTime'] . ' ' . $ContestEndTimeHours . ':' . $ContestEndTimeMins) : $ContestEndTime;

    }else{
        if (!empty($_POST['ContestEndTime']) AND !empty($_POST['ContestEndTimeHours']) AND !empty($_POST['ContestEndTimeMins'])) {
            $ContestEndTime = strtotime($_POST['ContestEndTime'] . ' ' . $_POST['ContestEndTimeHours'] . ':' . $_POST['ContestEndTimeMins']);
        }else{
            $ContestEndTime = $ContestEndTime;
        }
    }

    $DistancePics = (!empty($_POST['DistancePics'])) ? $_POST['DistancePics'] : $DistancePics;
    $DistancePicsV = (!empty($_POST['DistancePicsV'])) ? $_POST['DistancePicsV'] : $DistancePicsV;

    if (!empty($_POST['ContestStartTime'])) {

        $ContestStartTimeHours = (!empty($_POST['ContestStartTimeHours'])) ? $_POST['ContestStartTimeHours'] : '00';
        $ContestStartTimeMins = (!empty($_POST['ContestStartTimeMins'])) ? $_POST['ContestStartTimeMins'] : '00';

        $ContestStartTime = (!empty($_POST['ContestStartTime'])) ? strtotime($_POST['ContestStartTime'] . ' ' . $ContestStartTimeHours . ':' . $ContestStartTimeMins) : $ContestStartTime;

    }else{
        if (!empty($_POST['ContestStartTime']) AND !empty($_POST['ContestStartTimeHours']) AND !empty($_POST['ContestStartTimeMins'])) {
            $ContestStartTime = strtotime($_POST['ContestStartTime'] . ' ' . $_POST['ContestStartTimeHours'] . ':' . $_POST['ContestStartTimeMins']);
        }else{
            $ContestStartTime = $ContestStartTime;
        }
    }


    $DistancePics = (!empty($_POST['DistancePics'] )) ? $_POST['DistancePics'] : $DistancePics;
    $DistancePicsV = (!empty($_POST['DistancePicsV'])) ? $_POST['DistancePicsV'] : $DistancePicsV;

    if (isset($_POST['ThumbLook'])) {
        $AdjustThumbLook = (isset($_POST['AdjustThumbLook'])) ? 1 : 0;
    } else {
        $AdjustThumbLook = $AdjustThumbLook;
    }

    $WidthThumb = (!empty($_POST['WidthThumb'])) ? $_POST['WidthThumb'] : $WidthThumb;
    $HeightThumb = (!empty($_POST['HeightThumb'])) ? $_POST['HeightThumb'] : $HeightThumb;
    $WidthGallery = (!empty($_POST['WidthGallery'])) ? $_POST['WidthGallery'] : $WidthGallery;
    $HeightGallery = (!empty($_POST['HeightGallery'])) ? $_POST['HeightGallery'] : $HeightGallery;


    // echo "<br>WidthGalery: $WidthGalery<br>";
    // echo "<br>HeightGalery: $HeightGalery<br>";

// Ermittel die gesendeten Werte f�r die Gr��e der Bilder --- ENDE


// Ermittel zuerst die gesendeten Zahlenwerte der Einstellungen


    //$querySETvaluesThumbs = "UPDATE $tablenameOptions SET $WidthThumb $HeightThumb $WidthGallery $HeightGallery
    //$DistancePics $DistancePicsV  WHERE id = '$id'";
    //$wpdb->query($querySETvaluesThumbs);

    $ContestStart = (!empty($_POST['ContestStart'])) ? '1' : '0';

    $wpdb->update(
        "$tablenameOptions",
        array('WidthThumb' => $WidthThumb, 'HeightThumb' => $HeightThumb, 'WidthGallery' => $WidthGallery, 'HeightGallery' => $HeightGallery,
            'DistancePics' => $DistancePics, 'DistancePicsV' => $DistancePicsV, 'ContestEndTime' => $ContestEndTime, 'ContestStart' => $ContestStart, 'ContestStartTime' => $ContestStartTime),
        array('id' => $id),
        array('%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%s'),
        array('%d')
    );



//echo $PicsInRow; echo "<br/>";
//echo $LastRow; echo "<br/>";
//echo $DistancePics; echo "<br/>";
//echo $DistancePicsV; echo "<br/>";


// Ermittel zuerst die gesendeten Zahlenwerte der Einstellungen --- ENDE

// Ermittelt die gesendeten Einstellungen (checkboxes)


    $PicsPerSite = (isset($_POST['PicsPerSite'])) ? $_POST['PicsPerSite'] : $PicsPerSite;



    $OnlyGalleryView = (!empty($_POST['OnlyGalleryView'])) ? '1' : '0';
    $SinglePicView = (!empty($_POST['SinglePicView'])) ? '1' : '0';

    if (empty($_POST['ScaleWidthGalery']) or empty($_POST['ScaleSizesGalery'])) {

        if ($ScaleAndCut == 1 AND empty($_POST['ScaleWidthGalery'])) {
            $ScaleAndCut = 1;
        } else if ($ScaleOnly == 1 AND empty($_POST['ScaleSizesGalery'])) {
            $ScaleOnly = 1;
        } else if ($ScaleOnly != 1 AND empty($_POST['ScaleSizesGalery'])) {
            $ScaleOnly = 1;
        } else {
            $ScaleAndCut = 1;
        }

    } else {
        $ScaleOnly = (!empty($_POST['ScaleWidthGalery'])) ? '1' : '0';
        $ScaleAndCut = (!empty($_POST['ScaleSizesGalery'])) ? '1' : '0';
    }

    $AllowGalleryScript = (!empty($_POST['AllowGalleryScript'])) ? '1' : '0';

    $FullSizeGallery = (!empty($_POST['FullSizeGallery'])) ? '1' : '0';


    if (!empty($_POST['AllowGalleryScript'])) {
        $HideInfo = (!empty($_POST['HideInfo'])) ? '1' : 0;
    } else {
        $HideInfo = (!empty($_POST['HideInfo'])) ? '1' : $HideInfo;
    }

    $FbLikeNoShare = (!empty($_POST['FbLikeNoShare'])) ? 1 : 0;
    $FbLikeOnlyShare = (!empty($_POST['FbLikeOnlyShare'])) ? 1 : 0;

    // 1 = Height, 2 = Thumb, 3 = Row
    if (!empty($_POST['InfiniteScrollHeight'])) {
        $InfiniteScroll = 1;
    } else if (!empty($_POST['InfiniteScrollThumb'])) {
        $InfiniteScroll = 2;
    } else if (!empty($_POST['InfiniteScrollRow'])) {
        $InfiniteScroll = 3;
    } else {
        $InfiniteScroll = 0;
    }


    //echo "InfiniteScroll: $InfiniteScroll";


    $FullSizeImageOutGallery = (isset($_POST['FullSizeImageOutGallery'])) ? '1' : '0';
    $FullSizeImageOutGalleryNewTab = '1'; //Bei aktuellem Entwicklungsstand immer 1
    $ShowAlwaysInfoSlider = (isset($_POST['ShowAlwaysInfoSlider'])) ? '1' : '0';

    $HeightLookHeight = (isset($_POST['HeightLookHeight'])) ? $_POST['HeightLookHeight'] : $HeightLookHeight;
    $VotesPerUser = (!empty($_POST['VotesPerUser'])) ? sanitize_text_field($_POST['VotesPerUser']) : 0;

    $FbLikeGoToGalleryLink = (isset($_POST['FbLikeGoToGalleryLink'])) ? $_POST['FbLikeGoToGalleryLink'] : '';

    // Zuerst insert
    $backToGalleryFile = $wp_upload_dir["basedir"] . "/contest-gallery/gallery-id-$id/backtogalleryurl.js";
    $backToGalleryFileContent = 'backToGalleryUrl="' . $FbLikeGoToGalleryLink . '";';
    $FbLikeGoToGalleryLink = contest_gal1ery_htmlentities_and_preg_replace($FbLikeGoToGalleryLink, ENT_QUOTES, 'UTF-8');

    $fp = fopen($backToGalleryFile, 'w');
    fwrite($fp, $backToGalleryFileContent);
    fclose($fp);


    $PicsInRow = (!empty($_POST['PicsInRow'])) ? $_POST['PicsInRow'] : $PicsInRow;
    if ($PicsInRow == 0) {
        $PicsInRow = 1;
    }
    $LastRow = (!empty($_POST['LastRow'])) ? '1' : '0';
    $HideUntilVote = (!empty($_POST['HideUntilVote'])) ? '1' : '0';
    $ShowOnlyUsersVotes = (!empty($_POST['ShowOnlyUsersVotes'])) ? '1' : '0';
    $ActivateUpload = (!empty($_POST['ActivateUpload'])) ? '1' : '0';
    $ContestEnd = (!empty($_POST['ContestEnd'])) ? '1' : '0';
    $ContestStart = (!empty($_POST['ContestStart'])) ? '1' : '0';
    $ContestEndInstant = (!empty($_POST['ContestEndInstant'])) ? '1' : '0';

    if ($ContestEndInstant == 1) {
        $ContestEnd = 2;
    }

    $ThumbsInRow = (!empty($_POST['ThumbsInRow'])) ? '1' : '0';

    $FullSize = (!empty($_POST['FullSize'])) ? '1' : '0';
    $FullSizeGallery = (!empty($_POST['FullSizeGallery'])) ? '1' : '0';
    $OriginalSourceLinkInSlider = (!empty($_POST['OriginalSourceLinkInSlider'])) ? '1' : '0';


    $FullSizeSlideOutStart = (!empty($_POST['FullSizeSlideOutStart'])) ? '1' : '0';


    $AllowSort = (!empty($_POST['AllowSort'])) ? '1' : '0';
    $RandomSort = (!empty($_POST['RandomSort'])) ? '1' : '0';
    $RandomSortButton = (!empty($_POST['RandomSortButton'])) ? '1' : '0';

    $AllowComments = (!empty($_POST['AllowComments'])) ? '1' : '0';

    $CommentsOutGallery = (!empty($_POST['CommentsOutGallery'])) ? '1' : '0';
    $ShowAlways = (!empty($_POST['ShowAlways'])) ? '1' : '0';

    $AllowRating = (!empty($_POST['AllowRating'])) ? '1' : '0';

    if (!empty($_POST['AllowRating'])) {
        $AllowRating = 1;
    } else if (!empty($_POST['AllowRating2'])) {
        $AllowRating = 2;
    } else {
        $AllowRating = 0;
    }

    $RatingOutGallery = (!empty($_POST['RatingOutGallery'])) ? '1' : '0';
    $IpBlock = (!empty($_POST['IpBlock'])) ? '1' : '0';

    $CheckLogin = 0;
    $CheckCookie = 0;
    $CheckIp = 0;

    if (empty($_POST['CheckMethod'])) {

        $CheckIp = 1;

    } else {
        switch ($_POST['CheckMethod']) {
            case 'login':
                $CheckLogin = 1;
                break;
            case 'cookie':
                $CheckCookie = 1;
                break;
            case 'ip':
                $CheckIp = 1;
                break;
            default:
                $CheckIp = 1;
                break;
        }
    }

    $CheckCookieAlertMessage = (isset($_POST['CheckCookieAlertMessage'])) ? sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace($_POST['CheckCookieAlertMessage'])) : $CheckCookieAlertMessage;

    $RegistryUserRole = sanitize_text_field(htmlentities((isset($_POST['RegistryUserRole'])) ? $_POST['RegistryUserRole'] : ''));

    $Manipulate = (!empty($_POST['Manipulate'])) ? '1' : '0';
    $Search = (!empty($_POST['Search'])) ? '1' : '0';
    $GalleryUpload = (!empty($_POST['GalleryUpload'])) ? '1' : '0';
    $GalleryUploadOnlyUser = (!empty($_POST['GalleryUploadOnlyUser'])) ? '1' : '0';

    $VotePerCategory = (!empty($_POST['VotePerCategory'])) ? '1' : '0';

    // var_dump($GalleryUploadConfirmationText);
    //var_dump($_POST['GalleryUploadConfirmationText']);

    $GalleryUploadConfirmationText = contest_gal1ery_htmlentities_and_preg_replace((isset($_POST['GalleryUploadConfirmationText'])) ? $_POST['GalleryUploadConfirmationText'] : '');
    $GalleryUploadTextBefore = contest_gal1ery_htmlentities_and_preg_replace((isset($_POST['GalleryUploadTextBefore'])) ? $_POST['GalleryUploadTextBefore'] : '');
    $GalleryUploadTextAfter = contest_gal1ery_htmlentities_and_preg_replace((isset($_POST['GalleryUploadTextAfter'])) ? $_POST['GalleryUploadTextAfter'] : '');

    $FbLike = (!empty($_POST['FbLike'])) ? '1' : '0';
    $FbLikeGallery = (!empty($_POST['FbLikeGallery'])) ? '1' : '0';
    $FbLikeGalleryVote = (!empty($_POST['FbLikeGalleryVote'])) ? '1' : '0';

    $Inform = (!empty($_POST['InformUsers'])) ? '1' : '0';

    // Forward Images to URL options


    //Pr�fen ob bei Klick auf images weitergelitet werden soll

    //if(){}
    $ForwardToURL = 1;

    $ForwardType = (isset($_POST['ForwardType'])) ? '2' : '1';

    // Pauschal auf 1 wenn nichts gesendet wird
    // Slider = 1, Gallery = 2, SinglePic = 3
    $ForwardFrom = $wpdb->get_var("SELECT ForwardFrom FROM $tablenameOptions WHERE id = '$id'");
    // Wenn Gallerie Jquery gew�hlt ist dann 1 (Forward from Slider)
    if ($AllowGalleryScript == 1 && empty($_POST['ForwardFromGallery'])) {
        $ForwardFrom = 1;
    } // Wenn ForwardFromGallery mitgeschickt wurde dann 2
    else if (empty(['ForwardFromGallery'])) {
        $ForwardFrom = 2;
    } // Wenn SinglePic Ansicht gew�hlt ist dann 3
    else if ($SinglePicView == 1) {
        $ForwardFrom = 3;
    } else {
        $ForwardFrom = $ForwardFrom;
    }


    //echo "$ForwardFrom";
    //else {$ForwardFrom=$ForwardFrom;}



    // Ermitteln der maximalen Uploads beim Hochalden in MB

    $ActivatePostMaxMB = (isset($_POST['ActivatePostMaxMB'])) ? '1' : '0';
    $PostMaxMB = (isset($_POST['PostMaxMB'])) ? $_POST['PostMaxMB'] : 0;

    // Ermitteln des maximalen Uploads beim Hochladen in MB --- ENDE

    // Ermitteln ob und der Anzahl des Bulk Uploads

    $ActivateBulkUpload = (isset($_POST['ActivateBulkUpload'])) ? '1' : '0';

    $BulkUploadQuantity = (isset($_POST['BulkUploadQuantity'])) ? $_POST['BulkUploadQuantity'] : 0;

    $BulkUploadMinQuantity = (isset($_POST['BulkUploadMinQuantity'])) ? $_POST['BulkUploadMinQuantity'] : 0;

    // Ermitteln ob und der Anzahl des Bulk Uploads	 --- ENDE

    // Ermitteln der m�glichen Aufl�sung beim Hochalden

    $MaxResJPGon = (isset($_POST['MaxResJPGon'])) ? 1 : 0;

    $MaxResJPGwidth = (isset($_POST['MaxResJPGwidth'])) ? $_POST['MaxResJPGwidth'] : 0;
    $MaxResJPGheight = (isset($_POST['MaxResJPGheight'])) ? $_POST['MaxResJPGheight'] : 0;

    $MaxResPNGon = (isset($_POST['MaxResPNGon'])) ? 1 : 0;

    $MaxResPNGwidth = (isset($_POST['MaxResPNGwidth'])) ? $_POST['MaxResPNGwidth'] : 0;
    $MaxResPNGheight = (isset($_POST['MaxResPNGheight'])) ? $_POST['MaxResPNGheight'] : 0;

    $MaxResGIFon = (isset($_POST['MaxResGIFon'])) ? 1 : 0;

    $MaxResGIFwidth = (isset($_POST['MaxResGIFwidth'])) ? $_POST['MaxResGIFwidth'] : 0;
    $MaxResGIFheight = (isset($_POST['MaxResGIFheight'])) ? $_POST['MaxResGIFheight'] : 0;


    // Ermitteln der m�glichen Aufl�sung beim Hochalden --- ENDE


// Ermittelt die gesendeten Einstellungen (checkboxes) --- ENDE

    // Update non scale or cut values

    /*$querySETvalues = "UPDATE $tablenameOptions SET PicsPerSite='$PicsPerSite', MaxResJPGon='$MaxResJPGon', MaxResPNGon='$MaxResPNGon', MaxResGIFon='$MaxResGIFon',
    $MaxResJPG $MaxResPNG $MaxResGIF
    ScaleOnly='$ScaleOnly', ScaleAndCut='$ScaleAndCut', FullSize = '$FullSize', AllowSort = '$AllowSort',
    AllowComments = '$AllowComments', AllowRating = '$AllowRating', IpBlock = '$IpBlock', FbLike = '$FbLike', AllowGalleryScript='$AllowGalleryScript',
    ThumbLook = '$ThumbLook', HeightLook = '$HeightLook', RowLook = '$RowLook',
    ThumbLookOrder = '$ThumbLookOrder', HeightLookOrder = '$HeightLookOrder', RowLookOrder = '$RowLookOrder',
    $HeightLookHeight ThumbsInRow = '$ThumbsInRow', $PicsInRow LastRow = '$LastRow'
    WHERE id = '$id'";*/

    //$wpdb->query($querySETvalues);
    $ScaleOnly = 1;
    $ScaleAndCut = 0;

    $wpdb->update(
        "$tablenameOptions",
        array('PicsPerSite' => $PicsPerSite, 'GalleryName' => $GalleryName, 'MaxResJPGon' => $MaxResJPGon, 'MaxResPNGon' => $MaxResPNGon, 'MaxResGIFon' => $MaxResGIFon,
            'MaxResJPGwidth' => $MaxResJPGwidth, 'MaxResJPGheight' => $MaxResJPGheight, 'MaxResPNGwidth' => $MaxResPNGwidth, 'MaxResPNGheight' => $MaxResPNGheight, 'MaxResGIFwidth' => $MaxResGIFwidth, 'MaxResGIFheight' => $MaxResGIFheight,
            'OnlyGalleryView' => $OnlyGalleryView, 'SinglePicView' => $SinglePicView, 'ScaleOnly' => $ScaleOnly, 'ScaleAndCut' => $ScaleAndCut, 'FullSize' => $FullSize, 'FullSizeGallery' => $FullSizeGallery, 'FullSizeSlideOutStart' => $FullSizeSlideOutStart, 'AllowSort' => $AllowSort, 'RandomSort' => $RandomSort, 'RandomSortButton' => $RandomSortButton, 'ShowAlways' => $ShowAlways,
            'AllowComments' => $AllowComments, 'CommentsOutGallery' => $CommentsOutGallery, 'AllowRating' => $AllowRating, 'VotesPerUser' => $VotesPerUser, 'RatingOutGallery' => $RatingOutGallery, 'IpBlock' => $IpBlock,
            'CheckLogin' => $CheckLogin, 'FbLike' => $FbLike, 'FbLikeGallery' => $FbLikeGallery, 'FbLikeGalleryVote' => $FbLikeGalleryVote,
            'AllowGalleryScript' => $AllowGalleryScript, 'InfiniteScroll' => $InfiniteScroll, 'FullSizeImageOutGallery' => $FullSizeImageOutGallery, 'FullSizeImageOutGalleryNewTab' => $FullSizeImageOutGalleryNewTab,
            'Inform' => $Inform, 'ShowAlwaysInfoSlider' => $ShowAlwaysInfoSlider, 'ThumbLook' => $ThumbLook, 'AdjustThumbLook' => $AdjustThumbLook, 'HeightLook' => $HeightLook, 'RowLook' => $RowLook,
            'ThumbLookOrder' => $ThumbLookOrder, 'HeightLookOrder' => $HeightLookOrder, 'RowLookOrder' => $RowLookOrder,
            'HeightLookHeight' => $HeightLookHeight, 'ThumbsInRow' => $ThumbsInRow, 'PicsInRow' => $PicsInRow, 'LastRow' => $LastRow, 'HideUntilVote' => $HideUntilVote, 'ShowOnlyUsersVotes' => $ShowOnlyUsersVotes, 'HideInfo' => $HideInfo, 'ActivateUpload' => $ActivateUpload, 'ContestEnd' => $ContestEnd,
            'ForwardToURL' => $ForwardToURL, 'ForwardFrom' => $ForwardFrom, 'ForwardType' => $ForwardType,
            'ActivatePostMaxMB' => $ActivatePostMaxMB, 'PostMaxMB' => $PostMaxMB, 'ActivateBulkUpload' => $ActivateBulkUpload,
            'BulkUploadQuantity' => $BulkUploadQuantity, 'BulkUploadMinQuantity' => $BulkUploadMinQuantity, 'CheckIp' => $CheckIp, 'CheckCookie' => $CheckCookie),
        array('id' => $id),
        array('%d', '%s', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d'),
        array('%d')//HINZUFÜGEN WEITERER STRINGS NICHT MÖGLICH, FÜR STRINGS UPDATE GLEICH UNTEN VERWENDEN
    );

    // Extra update von STRINGS hier notwendig
    $wpdb->update(
        "$tablenameOptions",
        array('FbLikeGoToGalleryLink' => $FbLikeGoToGalleryLink, 'CheckCookieAlertMessage' => $CheckCookieAlertMessage, 'SliderLook' => $SliderLook, 'SliderLookOrder' => $SliderLookOrder, 'RegistryUserRole' => $RegistryUserRole),
        array('id' => $id),
        array('%s', '%s', '%d', '%d', '%s'),
        array('%d')
    );

    // input Options

    // Values which should not be saved if not sended
    $unsavingValuesInput = $wpdb->get_row("SELECT * FROM $tablenameOptionsInput WHERE GalleryID = '$id'");
    $Forward_URL = $unsavingValuesInput->Forward_URL;
    $confirmation_text = $unsavingValuesInput->Confirmation_Text;

    $Forward = (isset($_POST['forward'])) ? '1' : '0';
    $ShowFormAfterUpload = (!empty($_POST['ShowFormAfterUpload'])) ? 1 : 0;
    $Forward_URL = (isset($_POST['forward_url'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['forward_url']) : $Forward_URL;
    $confirmation_text = (isset($_POST['confirmation_text'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['confirmation_text']) : $confirmation_text;

    // input Options --- ENDE

    //$querySETvaluesInputOptions = "UPDATE $tablenameOptionsInput SET $Forward_URL $confirmation_text Forward = '$Forward' WHERE id = '$id'";
    //$wpdb->query($querySETvaluesInputOptions);

    $wpdb->update(
        "$tablenameOptionsInput",
        array('Forward' => $Forward, 'Forward_URL' => $Forward_URL, 'Confirmation_Text' => $confirmation_text, 'ShowFormAfterUpload' => $ShowFormAfterUpload),
        array('GalleryID' => $id),
        array('%d', '%s', '%s', '%d'),
        array('%d')
    );

    // Save changes in table name admin

    $content = contest_gal1ery_htmlentities_and_preg_replace($_POST['InformAdminText']);

    //nl2br($content);

    //print_r($content);

    //$content = htmlentities($content, ENT_QUOTES, 'UTF-8');

    // Magic Quotes on?

    // for old PHP versions less then 5.4.0
    // https://stackoverflow.com/questions/30736367/php-how-to-detect-magic-quotes-parameter-on-runtime
    if(function_exists('get_magic_quotes_gpc')){

        if (get_magic_quotes_gpc()) { // eingeschaltet?
            $_POST["from"] = stripslashes(isset($_POST['from']) ? $_POST['from'] : '');
            $_POST["reply"] = stripslashes(isset($_POST['reply']) ? $_POST['reply'] : '');
            $_POST["AdminMail"] = stripslashes(isset($_POST['AdminMail']) ? $_POST['AdminMail'] : '');
            $_POST["cc"] = stripslashes(isset($_POST['cc']) ? $_POST['cc'] : '');
            $_POST["bcc"] = stripslashes(isset($_POST['bcc']) ? $_POST['bcc'] : '');
            $_POST["url"] = stripslashes(isset($_POST['url']) ? $_POST['url'] : '');
        }

    }

    // Escape values wordpress sql
    $from = sanitize_text_field(isset($_POST['from']) ? $_POST['from'] : '');
    $reply = sanitize_text_field(isset($_POST['reply']) ? $_POST['reply'] : '');
    $AdminMail = sanitize_text_field(isset($_POST['AdminMail']) ? $_POST['AdminMail'] : '');
    $cc = sanitize_text_field(isset($_POST['cc']) ? $_POST['cc'] : '');
    $bcc = sanitize_text_field(isset($_POST['bcc']) ? $_POST['bcc'] : '');
    $header = sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['header']) ? $_POST['header'] : ''));
    $url = sanitize_text_field(isset($_POST['url']) ? $_POST['url'] : '');

    // Make htmlspecialchars
    htmlentities($from);
    htmlentities($reply);
    htmlentities($AdminMail);
    htmlentities($cc);
    htmlentities($bcc);
    htmlentities($url);

    // Update email-table content


    //$content = json_decode('"\uD83D\uDE00"');

    $wpdb->update(
        "$tablename_mail_admin",
        array(
            'Admin' => "$from", 'AdminMail' => "$AdminMail", 'Header' => "$header", 'Reply' => "$reply", 'BCC' => "$bcc",
            'CC' => "$cc", 'URL' => "$url", 'Content' => "$content"
        ),
        array('GalleryID' => $id),
        array('%s', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s'),
        array('%d')
    );


    if (!empty($_POST['InformAdmin'])) {

        //Echo "works";
        $InformAdmin = 1;

        $wpdb->update(
            "$tablenameOptions",
            array('InformAdmin' => '1'),
            array('id' => $id),
            array('%d'),
            array('%d')
        );

    } else {
        $InformAdmin = 0;

        $wpdb->update(
            "$tablenameOptions",
            array('InformAdmin' => '0'),
            array('id' => $id),
            array('%d'),
            array('%d')
        );

    }

    // Save changes in table name admin --- ENDE

    // Save changes in table user mail

    $contentUserMail = contest_gal1ery_htmlentities_and_preg_replace($_POST['cgEmailImageActivating']);

    //$content = htmlentities($content, ENT_QUOTES, 'UTF-8');

    // for old PHP versions less then 5.4.0
    // https://stackoverflow.com/questions/30736367/php-how-to-detect-magic-quotes-parameter-on-runtime
    if(function_exists('get_magic_quotes_gpc')){

        // Magic Quotes on?
        if (get_magic_quotes_gpc()) { // eingeschaltet?
            $_POST["from_user_mail"] = stripslashes(isset($_POST['from_user_mail']) ? $_POST['from_user_mail'] : '');
            $_POST["reply_user_mail"] = stripslashes(isset($_POST['reply_user_mail']) ? $_POST['reply_user_mail'] : '');
            $_POST["cc_user_mail"] = stripslashes(isset($_POST['cc_user_mail']) ? $_POST['cc_user_mail'] : '');
            $_POST["bcc_user_mail"] = stripslashes(isset($_POST['bcc_user_mail']) ? $_POST['bcc_user_mail'] : '');
            $_POST["url_user_mail"] = stripslashes(isset($_POST['url_user_mail']) ? $_POST['url_user_mail'] : '');
        }

    }


    // Escape values wordpress sql

    $from = sanitize_text_field(isset($_POST['from_user_mail']) ? $_POST['from_user_mail'] : '');
    $reply = sanitize_text_field(isset($_POST['reply_user_mail']) ? $_POST['reply_user_mail'] : '');
    $cc = sanitize_text_field(isset($_POST['cc_user_mail']) ? $_POST['cc_user_mail'] : '');
    $bcc = sanitize_text_field(isset($_POST['bcc_user_mail']) ? $_POST['bcc_user_mail'] : '');
    $header = sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['header_user_mail']) ? $_POST['header_user_mail'] : ''));
    $url = sanitize_text_field(isset($_POST['url_user_mail']) ? $_POST['url_user_mail'] : '');
    //$content = sanitize_text_field($content); <<< ansonten verschieden html eingaben wie <br> und andere

    // Make htmlspecialchars

    htmlentities($from);
    htmlentities($reply);
    htmlentities($cc);
    htmlentities($bcc);
    htmlentities($url);
    //htmlentities($content); <<< ansonten verschieden html eingaben wie <br> und andere


    //$querySETemail = "UPDATE $tablenameemail SET Admin='$from', Header = '$header', Reply='$reply', BCC='$bcc',
    //CC='$cc', URL='$url', Content='$content' WHERE GalleryID = '$GalleryID' ";
    //$updateSQLemail = $wpdb->query($querySETemail);

    $wpdb->update(
        "$tablenameemail",
        array(
            'Admin' => "$from", 'Header' => "$header", 'Reply' => "$reply", 'BCC' => "$bcc",
            'CC' => "$cc", 'URL' => "$url", 'Content' => "$contentUserMail"
        ),
        array('GalleryID' => $id),
        array('%s', '%s', '%s', '%s',
            '%s', '%s', '%s'),
        array('%d')
    );


    // Save Pro options here

    $ForwardAfterLoginUrlCheck = (!empty($_POST['ForwardAfterLoginUrlCheck'])) ? '1' : '0';
    $ForwardAfterLoginTextCheck = (!empty($_POST['ForwardAfterLoginTextCheck'])) ? '1' : '0';
    $RegUserUploadOnly = (isset($_POST['RegUserUploadOnly'])) ? $_POST['RegUserUploadOnly'] : 0;//1=login tracking, 2=cookie,3=ip

    $RegUserGalleryOnly = (!empty($_POST['RegUserGalleryOnly'])) ? '1' : '0';
    $VoteNotOwnImage = (!empty($_POST['VoteNotOwnImage'])) ? '1' : '0';

    // var_dump($_POST['RegUserUploadOnlyText']);die;

    $ForwardAfterLoginUrl = (isset($_POST['ForwardAfterLoginUrl'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['ForwardAfterLoginUrl']) : $ForwardAfterLoginUrl;
    $ForwardAfterLoginText = (isset($_POST['ForwardAfterLoginText'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['ForwardAfterLoginText']) : $ForwardAfterLoginText;
    $RegUserUploadOnlyText = (isset($_POST['RegUserUploadOnlyText'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['RegUserUploadOnlyText']) : $RegUserUploadOnlyText;
    $RegUserGalleryOnlyText = (isset($_POST['RegUserGalleryOnlyText'])) ? contest_gal1ery_htmlentities_and_preg_replace($_POST['RegUserGalleryOnlyText']) : $RegUserGalleryOnlyText;

    $ForwardAfterRegUrl = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['ForwardAfterRegUrl']) ? $_POST['ForwardAfterRegUrl'] : '');
    $ForwardAfterRegText = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['ForwardAfterRegText']) ? $_POST['ForwardAfterRegText'] : '');
    $TextEmailConfirmation = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['TextEmailConfirmation']) ? $_POST['TextEmailConfirmation'] : '');

    $TextAfterEmailConfirmation = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['TextAfterEmailConfirmation']) ? $_POST['TextAfterEmailConfirmation'] : '');
    $RegMailAddressor = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['RegMailAddressor']) ? $_POST['RegMailAddressor'] : '');
    $RegMailReply = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['RegMailReply']) ? $_POST['RegMailReply'] : '');
    $RegMailSubject = contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['RegMailSubject']) ? $_POST['RegMailSubject'] : '');

    $RegUserMaxUpload = (isset($_POST['RegUserMaxUpload'])) ? sanitize_text_field($_POST['RegUserMaxUpload']) : $RegUserMaxUpload;

    $PreselectSort = (isset($_POST['PreselectSort'])) ? sanitize_text_field($_POST['PreselectSort']) : 'date_descend';
    $UploadRequiresCookieMessage = (isset($_POST['UploadRequiresCookieMessage'])) ? sanitize_text_field($_POST['UploadRequiresCookieMessage']) : '';

    $RegMailOptional = (isset($_POST['RegMailOptional'])) ? 1 : 0;

    $DeleteFromStorageIfDeletedInFrontend = (isset($_POST['DeleteFromStorageIfDeletedInFrontend'])) ? 1 : 0;

    $VotesPerCategory = (!empty($_POST['VotesPerCategory'])) ? sanitize_text_field($_POST['VotesPerCategory']) : 0;

    // save number values extra
    $wpdb->update(
        "$tablename_pro_options",
        array(
            'ForwardAfterLoginUrlCheck' => $ForwardAfterLoginUrlCheck,'ForwardAfterLoginTextCheck' => $ForwardAfterLoginTextCheck,
            'Manipulate' => $Manipulate, 'Search' => $Search,
            'GalleryUpload' => $GalleryUpload,'ShowNickname' => $ShowNickname,
            'MinusVote' => $MinusVote, 'VotesInTime' => $VotesInTime,
            'VotesInTimeQuantity' => $VotesInTimeQuantity,'VotesInTimeIntervalSeconds' => $VotesInTimeIntervalSeconds,
            'ShowExif' => $ShowExif,'SliderFullWindow' => $SliderFullWindow,
            'HideRegFormAfterLogin' => $HideRegFormAfterLogin, 'HideRegFormAfterLoginShowTextInstead' => $HideRegFormAfterLoginShowTextInstead,
            'RegUserGalleryOnly' => $RegUserGalleryOnly,'RegUserMaxUpload' => $RegUserMaxUpload,
            'GalleryUploadOnlyUser' => $GalleryUploadOnlyUser,'FbLikeNoShare' => $FbLikeNoShare,
            'VoteNotOwnImage' => $VoteNotOwnImage,'RegMailOptional' => $RegMailOptional,
            'CustomImageName' => $CustomImageName,'RegUserUploadOnly' => $RegUserUploadOnly,
            'FbLikeOnlyShare' => $FbLikeOnlyShare,'DeleteFromStorageIfDeletedInFrontend' => $DeleteFromStorageIfDeletedInFrontend,
            'VotePerCategory' => $VotePerCategory,'VotesPerCategory' => $VotesPerCategory
        ),
        array('GalleryID' => $id),
        array(
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d',
            '%d','%d'
        ),
        array('%d')
    );

    // save string values extra
    $wpdb->update(
        "$tablename_pro_options",
        array(
            'ForwardAfterLoginUrl' => $ForwardAfterLoginUrl,'ForwardAfterRegText' => $ForwardAfterRegText,
            'ForwardAfterRegUrl' => $ForwardAfterRegUrl,'ForwardAfterRegText' => $ForwardAfterRegText,
            'ForwardAfterLoginText' => $ForwardAfterLoginText,'TextEmailConfirmation' => $TextEmailConfirmation,
            'TextAfterEmailConfirmation' => $TextAfterEmailConfirmation,'RegMailAddressor' => $RegMailAddressor,
            'RegMailReply' => $RegMailReply, 'RegMailSubject' => $RegMailSubject,
            'RegUserUploadOnlyText' => $RegUserUploadOnlyText,'GalleryUploadTextBefore' => $GalleryUploadTextBefore,
            'GalleryUploadTextAfter' => $GalleryUploadTextAfter,'GalleryUploadConfirmationText' => $GalleryUploadConfirmationText,

            'SlideTransition' => $SlideTransition,'VotesInTimeIntervalReadable' => $VotesInTimeIntervalReadable,
            'VotesInTimeIntervalAlertMessage' => $VotesInTimeIntervalAlertMessage,'HideRegFormAfterLoginTextToShow' => $HideRegFormAfterLoginTextToShow,
            'RegUserGalleryOnlyText' => $RegUserGalleryOnlyText,'PreselectSort' => $PreselectSort,
            'UploadRequiresCookieMessage' => $UploadRequiresCookieMessage,'CustomImageNamePath' => $CustomImageNamePath
        ),
        array('GalleryID' => $id),
        array(
            '%s','%s',
            '%s','%s',
            '%s','%s',
            '%s','%s',
            '%s','%s',
            '%s','%s',

            '%s','%s',
            '%s','%s',
            '%s','%s',
            '%s','%s',
        ),
        array('%d')
    );

  //  var_dump($wpdb->last_query);die;


    // Save Pro options here --- ENDE

    // Save changes in table user confirmation mail

    $mConfirmContent = contest_gal1ery_htmlentities_and_preg_replace($_POST['mConfirmContent']);

    $mConfirmConfirmationText = contest_gal1ery_htmlentities_and_preg_replace($_POST['mConfirmConfirmationText']);

    //$content = htmlentities($content, ENT_QUOTES, 'UTF-8');

    // for old PHP versions less then 5.4.0
    // https://stackoverflow.com/questions/30736367/php-how-to-detect-magic-quotes-parameter-on-runtime
    if(function_exists('get_magic_quotes_gpc')){

        // Magic Quotes on?
        if (get_magic_quotes_gpc()) { // eingeschaltet?
            $_POST["mConfirmAdmin"] = stripslashes(isset($_POST['mConfirmAdmin']) ? $_POST['mConfirmAdmin'] : '');
            $_POST["mConfirmReply"] = stripslashes(isset($_POST['mConfirmReply']) ? $_POST['mConfirmReply'] : '');
            $_POST["mConfirmCC"] = stripslashes(isset($_POST['mConfirmCC']) ? $_POST['mConfirmCC'] : '');
            $_POST["mConfirmBCC"] = stripslashes(isset($_POST['mConfirmBCC']) ? $_POST['mConfirmBCC'] : '');
            $_POST["mConfirmURL"] = stripslashes(isset($_POST['mConfirmURL']) ? $_POST['mConfirmURL'] : '');
            //	echo "<br>ja<br>";
        }
        //	stripslashes($content);
        //	echo "<br>content2: $content<br>";
    }



    $mConfirmSendConfirm = (isset($_POST['mConfirmSendConfirm'])) ? '1' : '0';

    // Escape values wordpress sql

    $mConfirmAdmin = sanitize_text_field(isset($_POST['mConfirmAdmin']) ? $_POST['mConfirmAdmin'] : '');
    $mConfirmReply = sanitize_text_field(isset($_POST['mConfirmReply']) ? $_POST['mConfirmReply'] : '');
    $mConfirmCC = sanitize_text_field(isset($_POST['mConfirmCC']) ? $_POST['mConfirmCC'] : '');
    $mConfirmBCC = sanitize_text_field(isset($_POST['mConfirmBCC']) ? $_POST['mConfirmBCC'] : '');
    $mConfirmHeader = sanitize_text_field(contest_gal1ery_htmlentities_and_preg_replace(isset($_POST['mConfirmHeader']) ? $_POST['mConfirmHeader'] : ''));
    $mConfirmURL = sanitize_text_field(isset($_POST['mConfirmURL']) ? $_POST['mConfirmURL'] : '');
    //$content = sanitize_text_field($content); <<< ansonten verschieden html eingaben wie <br> und andere

    // Make htmlspecialchars

    htmlentities($mConfirmAdmin);
    htmlentities($mConfirmReply);
    htmlentities($mConfirmCC);
    htmlentities($mConfirmBCC);
    htmlentities($mConfirmURL);
    //htmlentities($content); <<< ansonten verschieden html eingaben wie <br> und andere


    //$querySETemail = "UPDATE $tablenameemail SET Admin='$from', Header = '$header', Reply='$reply', BCC='$bcc',
    //CC='$cc', URL='$url', Content='$content' WHERE GalleryID = '$GalleryID' ";
    //$updateSQLemail = $wpdb->query($querySETemail);

    $wpdb->update(
        "$tablename_mail_confirmation",
        array(
            'Admin' => "$mConfirmAdmin", 'Header' => "$mConfirmHeader", 'Reply' => "$mConfirmReply", 'BCC' => "$mConfirmBCC",
            'CC' => "$mConfirmCC", 'URL' => "$mConfirmURL", 'Content' => "$mConfirmContent", 'ConfirmationText' => "$mConfirmConfirmationText",
            'SendConfirm' => "$mConfirmSendConfirm"
        ),
        array('GalleryID' => $id),
        array('%s', '%s', '%s', '%s',
            '%s', '%s', '%s', '%s', '%d'),
        array('%d')
    );

    // Save changes in table user confirmation mail --- ENDE

    // Save translations

    $translations = array();

    foreach ($_POST['translations'] as $defaultKey => $translation) {
        $translations[$defaultKey] = contest_gal1ery_htmlentities_and_preg_replace(trim($translation));
    }

    if(empty( $translations['pro'] )){
        $translations['pro'] = array();
    }

    // set PRO json messages here
    if(!empty($_POST['VotesPerUserAllVotesUsedHtmlMessage'])){
        $translations['pro']['VotesPerUserAllVotesUsedHtmlMessage'] =  contest_gal1ery_htmlentities_and_preg_replace(trim($_POST['VotesPerUserAllVotesUsedHtmlMessage']));
    }else {
        if(empty($translations['pro']['VotesPerUserAllVotesUsedHtmlMessage'])){
            $translations['pro']['VotesPerUserAllVotesUsedHtmlMessage'] = '';
        }
    }

    $translationsFile = $wp_upload_dir["basedir"] . "/contest-gallery/gallery-id-$id/json/$id-translations.json";

    $fp = fopen($translationsFile, 'w');
    fwrite($fp, json_encode($translations));
    fclose($fp);

    // Save translations --- ENDE

    $GalleryID = $id;

    include('json-options.php');

    $jsonOptionsAllGalleryVariants = array();

    // added in 10.9.8.9.2, do not remove in the moment! It is for fallback!
    // If somebody save the options and then switch back to older version, he will still be able to use gallery in frontend
    $jsonOptionsAllGalleryVariants = $jsonOptions;

    $jsonOptionsAllGalleryVariants[$GalleryID] = (!empty($jsonOptions[$GalleryID])) ? $jsonOptions[$GalleryID] : $jsonOptions;

    $isModernOptionsNew = false;

    if(empty($jsonOptions[$GalleryID.'-u'])){
        $isModernOptionsNew = true;
    }

    // adjustments AllowSortOptions

    $AllowSortOptionsCgGalleryUser = 'empty';

    if (!empty($_POST['multiple-pics'])) {
        if (!empty($_POST['multiple-pics']['cg_gallery_user'])) {
            if (!empty($_POST['multiple-pics']['cg_gallery_user']['visual'])) {
                if (!empty($_POST['multiple-pics']['cg_gallery_user']['visual']['AllowSortOptionsArray'])) {
                    foreach ($_POST['multiple-pics']['cg_gallery_user']['visual']['AllowSortOptionsArray'] as $AllowSortOptionsValue) {
                        if (empty($AllowSortOptions)) {
                            $AllowSortOptionsCgGalleryUser .= $AllowSortOptionsValue;
                        } else {
                            $AllowSortOptionsCgGalleryUser .= ',' . $AllowSortOptionsValue;
                        }
                    }
                }
            }
        }
    }

    $AllowSortOptionsCgGalleryNoVoting = 'empty';

    if (!empty($_POST['multiple-pics'])) {
        if (!empty($_POST['multiple-pics']['cg_gallery_no_voting'])) {
            if (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['visual'])) {
                if (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['visual']['AllowSortOptionsArray'])) {
                    foreach ($_POST['multiple-pics']['cg_gallery_no_voting']['visual']['AllowSortOptionsArray'] as $AllowSortOptionsValue) {
                        if (empty($AllowSortOptions)) {
                            $AllowSortOptionsCgGalleryNoVoting .= $AllowSortOptionsValue;
                        } else {
                            $AllowSortOptionsCgGalleryNoVoting .= ',' . $AllowSortOptionsValue;
                        }
                    }
                }
            }
        }
    }

    $AllowSortOptionsCgGalleryWinner = 'empty';

    if (!empty($_POST['multiple-pics'])) {
        if (!empty($_POST['multiple-pics']['cg_gallery_winner'])) {
            if (!empty($_POST['multiple-pics']['cg_gallery_winner']['visual'])) {
                if (!empty($_POST['multiple-pics']['cg_gallery_winner']['visual']['AllowSortOptionsArray'])) {
                    foreach ($_POST['multiple-pics']['cg_gallery_winner']['visual']['AllowSortOptionsArray'] as $AllowSortOptionsValue) {
                        if (empty($AllowSortOptions)) {
                            $AllowSortOptionsCgGalleryWinner .= $AllowSortOptionsValue;
                        } else {
                            $AllowSortOptionsCgGalleryWinner .= ',' . $AllowSortOptionsValue;
                        }
                    }
                }
            }
        }
    }

    // ADJUSTMENTS AllowGalleryScript and SliderFullWindow and BlogLookFullWindow

    $_POST['multiple-pics']['cg_gallery_user']['general']['AllowGalleryScript'] = (!empty($_POST['multiple-pics']['cg_gallery_user']['general']['AllowGalleryScript'])) ? 1 : 0;
    $_POST['multiple-pics']['cg_gallery_user']['pro']['SliderFullWindow'] = (!empty($_POST['multiple-pics']['cg_gallery_user']['pro']['SliderFullWindow'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_user']['visual']['BlogLookFullWindow'] = (!empty($_POST['multiple-pics']['cg_gallery_user']['visual']['BlogLookFullWindow'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_user']['general']['FullSizeImageOutGallery'] = (!empty($_POST['multiple-pics']['cg_gallery_user']['general']['FullSizeImageOutGallery'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_user']['general']['OnlyGalleryView'] = (!empty($_POST['multiple-pics']['cg_gallery_user']['general']['OnlyGalleryView'])) ? 1: 0;

    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['AllowGalleryScript'] = (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['general']['AllowGalleryScript'])) ? 1 : 0;
    $_POST['multiple-pics']['cg_gallery_no_voting']['pro']['SliderFullWindow'] = (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['pro']['SliderFullWindow'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_no_voting']['visual']['BlogLookFullWindow'] = (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['visual']['BlogLookFullWindow'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['FullSizeImageOutGallery'] = (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['general']['FullSizeImageOutGallery'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['OnlyGalleryView'] = (!empty($_POST['multiple-pics']['cg_gallery_no_voting']['general']['OnlyGalleryView'])) ? 1: 0;

    $_POST['multiple-pics']['cg_gallery_winner']['general']['AllowGalleryScript'] = (!empty($_POST['multiple-pics']['cg_gallery_winner']['general']['AllowGalleryScript'])) ? 1 : 0;
    $_POST['multiple-pics']['cg_gallery_winner']['pro']['SliderFullWindow'] = (!empty($_POST['multiple-pics']['cg_gallery_winner']['pro']['SliderFullWindow'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_winner']['visual']['BlogLookFullWindow'] = (!empty($_POST['multiple-pics']['cg_gallery_winner']['visual']['BlogLookFullWindow'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_winner']['general']['FullSizeImageOutGallery'] = (!empty($_POST['multiple-pics']['cg_gallery_winner']['general']['FullSizeImageOutGallery'])) ? 1: 0;
    $_POST['multiple-pics']['cg_gallery_winner']['general']['OnlyGalleryView'] = (!empty($_POST['multiple-pics']['cg_gallery_winner']['general']['OnlyGalleryView'])) ? 1: 0;

    // ADJUSTMENTS order look

    $order = $_POST['multiple-pics']['cg_gallery_user']['general']['order'];

    $i = 0;
/*    echo "<br>Order:<br>";
    print_r($order);
    echo "<br>";*/

    foreach ($order as $key => $value) {

        $i++;

        if ($value == 't') {
            $t = $i;
        }
        if ($value == 'h') {
            $h = $i;
        }
        if ($value == 'r') {
            $r = $i;
        }
        if ($value == 's') {
            $s = $i;
        }
        if ($value == 'b') {
            $b = $i;
        }

    }

    $_POST['multiple-pics']['cg_gallery_user']['general']['ThumbLookOrder'] = $t;
    $_POST['multiple-pics']['cg_gallery_user']['general']['HeightLookOrder'] = $h;
    $_POST['multiple-pics']['cg_gallery_user']['general']['RowLookOrder'] = $r;
    $_POST['multiple-pics']['cg_gallery_user']['general']['SliderLookOrder'] = $s;
    $_POST['multiple-pics']['cg_gallery_user']['visual']['BlogLookOrder'] = $b;

    $order = $_POST['multiple-pics']['cg_gallery_no_voting']['general']['order'];

    $i = 0;

    foreach ($order as $key => $value) {

        $i++;

        if ($value == 't') {
            $t = $i;
        }
        if ($value == 'h') {
            $h = $i;
        }
        if ($value == 'r') {
            $r = $i;
        }
        if ($value == 's') {
            $s = $i;
        }
        if ($value == 'b') {
            $b = $i;
        }

    }

    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['ThumbLookOrder'] = $t;
    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['HeightLookOrder'] = $h;
    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['RowLookOrder'] = $r;
    $_POST['multiple-pics']['cg_gallery_no_voting']['general']['SliderLookOrder'] = $s;
    $_POST['multiple-pics']['cg_gallery_no_voting']['visual']['BlogLookOrder'] = $b;

    $i = 0;

    $order = $_POST['multiple-pics']['cg_gallery_winner']['general']['order'];

    foreach ($order as $key => $value) {

        $i++;

        if ($value == 't') {
            $t = $i;
        }
        if ($value == 'h') {
            $h = $i;
        }
        if ($value == 'r') {
            $r = $i;
        }
        if ($value == 's') {
            $s = $i;
        }
        if ($value == 'b') {
            $b = $i;
        }

    }

    $_POST['multiple-pics']['cg_gallery_winner']['general']['ThumbLookOrder'] = $t;
    $_POST['multiple-pics']['cg_gallery_winner']['general']['HeightLookOrder'] = $h;
    $_POST['multiple-pics']['cg_gallery_winner']['general']['RowLookOrder'] = $r;
    $_POST['multiple-pics']['cg_gallery_winner']['general']['SliderLookOrder'] = $s;
    $_POST['multiple-pics']['cg_gallery_winner']['visual']['BlogLookOrder'] = $b;

    $jsonOptionsAllGalleryVariants[$GalleryID . '-u'] = (!empty($jsonOptions[$GalleryID . '-u'])) ? $jsonOptions[$GalleryID . '-u'] : $jsonOptions;

    $shortcodeSpecificToSetArray = include(__DIR__ . '/../../../vars/general/short-code-specific-to-set-array.php');

    // $type >>> general, input, visual, pro
    foreach ($jsonOptions as $type => $option) {
        foreach ($option as $key => $value) {
            if (!empty($_POST['multiple-pics']['cg_gallery_user'][$type][$key])) {
                if ($_POST['multiple-pics']['cg_gallery_user'][$type][$key] == 'on') {
                    $jsonOptionsAllGalleryVariants[$GalleryID . '-u'][$type][$key] = 1;
                } else {
                    if (in_array($key, $shortcodeSpecificToSetArray)) {
/*                        var_dump($key);
                        echo "<br>";
                        var_dump($value);
                        echo "<br>";*/
                        $jsonOptionsAllGalleryVariants[$GalleryID . '-u'][$type][$key] = $_POST['multiple-pics']['cg_gallery_user'][$type][$key];
                    } else {
                        $jsonOptionsAllGalleryVariants[$GalleryID . '-u'][$type][$key] = $jsonOptionsAllGalleryVariants[$GalleryID][$type][$key] ;
                    }
                }
            } else if ($key == 'AllowSortOptions') {
                $jsonOptionsAllGalleryVariants[$GalleryID . '-u'][$type][$key] = $AllowSortOptionsCgGalleryUser;
            } else if (isset($_POST['multiple-pics']['cg_gallery_user'][$type][$key])) {
                $jsonOptionsAllGalleryVariants[$GalleryID . '-u'][$type][$key] = 0;
            }
        }
    }

    if($GalleryUploadOnlyUser && $isModernOptionsNew){
        $jsonOptionsAllGalleryVariants[$GalleryID . '-u']['pro']['GalleryUpload'] = 1;
    }

    $jsonOptionsAllGalleryVariants[$GalleryID . '-nv'] = (!empty($jsonOptions[$GalleryID . '-nv'])) ? $jsonOptions[$GalleryID . '-nv'] : $jsonOptions;

    // $type >>> general, input, visual, pro
    foreach ($jsonOptions as $type => $option) {
        foreach ($option as $key => $value) {
            if (!empty($_POST['multiple-pics']['cg_gallery_no_voting'][$type][$key])) {
                if ($_POST['multiple-pics']['cg_gallery_no_voting'][$type][$key] == 'on') {
                    $jsonOptionsAllGalleryVariants[$GalleryID . '-nv'][$type][$key] = 1;
                } else {
                    if (in_array($key, $shortcodeSpecificToSetArray)) {
                        $jsonOptionsAllGalleryVariants[$GalleryID . '-nv'][$type][$key] = $_POST['multiple-pics']['cg_gallery_no_voting'][$type][$key];
                    } else {
                        $jsonOptionsAllGalleryVariants[$GalleryID . '-nv'][$type][$key] = $jsonOptionsAllGalleryVariants[$GalleryID][$type][$key] ;
                    }
                }
            } else if ($key == 'AllowSortOptions') {
                $jsonOptionsAllGalleryVariants[$GalleryID . '-nv'][$type][$key] = $AllowSortOptionsCgGalleryNoVoting;
            } else if (isset($_POST['multiple-pics']['cg_gallery_no_voting'][$type][$key])) {
                $jsonOptionsAllGalleryVariants[$GalleryID . '-nv'][$type][$key] = 0;
            }
        }
    }

    $jsonOptionsAllGalleryVariants[$GalleryID . '-w'] = (!empty($jsonOptions[$GalleryID . '-w'])) ? $jsonOptions[$GalleryID . '-w'] : $jsonOptions;

    // $type >>> general, input, visual, pro
    foreach ($jsonOptions as $type => $option) {
        foreach ($option as $key => $value) {
            if (!empty($_POST['multiple-pics']['cg_gallery_winner'][$type][$key])) {
                if ($_POST['multiple-pics']['cg_gallery_winner'][$type][$key] == 'on') {
                    $jsonOptionsAllGalleryVariants[$GalleryID . '-w'][$type][$key] = 1;
                } else {
                    if (in_array($key, $shortcodeSpecificToSetArray)) {
                        $jsonOptionsAllGalleryVariants[$GalleryID . '-w'][$type][$key] = $_POST['multiple-pics']['cg_gallery_winner'][$type][$key];
                    } else {
                        $jsonOptionsAllGalleryVariants[$GalleryID . '-w'][$type][$key] = $jsonOptionsAllGalleryVariants[$GalleryID][$type][$key] ;
                    }
                }
            } else if ($key == 'AllowSortOptions') {
                $jsonOptionsAllGalleryVariants[$GalleryID . '-w'][$type][$key] = $AllowSortOptionsCgGalleryWinner;
            } else if (isset($_POST['multiple-pics']['cg_gallery_winner'][$type][$key])) {
                $jsonOptionsAllGalleryVariants[$GalleryID . '-w'][$type][$key] = 0;
            }
        }
    }

    if(empty($jsonOptionsAllGalleryVariants['icons'])){
        $jsonOptionsAllGalleryVariants['icons'] = array();
    }
    if(!empty($_POST['iconVoteUndoneGalleryViewBase64'])){
        if($_POST['iconVoteUndoneGalleryViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteUndoneGalleryViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteUndoneGalleryViewBase64'] = $_POST['iconVoteUndoneGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteDoneGalleryViewBase64'])){
        if($_POST['iconVoteDoneGalleryViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteDoneGalleryViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteDoneGalleryViewBase64'] = $_POST['iconVoteDoneGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteHalfStarGalleryViewBase64'])){
        if($_POST['iconVoteHalfStarGalleryViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteHalfStarGalleryViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteHalfStarGalleryViewBase64'] = $_POST['iconVoteHalfStarGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteUndoneImageViewBase64'])){
        if($_POST['iconVoteUndoneImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteUndoneImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteUndoneImageViewBase64'] = $_POST['iconVoteUndoneImageViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteDoneImageViewBase64'])){
        if($_POST['iconVoteDoneImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteDoneImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteDoneImageViewBase64'] = $_POST['iconVoteDoneGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteHalfStarImageViewBase64'])){
        if($_POST['iconVoteHalfStarImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteHalfStarImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteHalfStarImageViewBase64'] = $_POST['iconVoteHalfStarImageViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteFiveStarsPercentageOverviewDoneImageViewBase64'])){
        if($_POST['iconVoteFiveStarsPercentageOverviewDoneImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteFiveStarsPercentageOverviewDoneImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteFiveStarsPercentageOverviewDoneImageViewBase64'] = $_POST['iconVoteDoneGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteRemoveImageViewBase64'])){
        if($_POST['iconVoteRemoveImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteRemoveImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteRemoveImageViewBase64'] = $_POST['iconVoteRemoveImageViewBase64'];
        }
    }
    if(!empty($_POST['iconVoteRemoveGalleryOnlyViewBase64'])){
        if($_POST['iconVoteRemoveGalleryOnlyViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconVoteRemoveGalleryOnlyViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconVoteRemoveGalleryOnlyViewBase64'] = $_POST['iconVoteRemoveGalleryOnlyViewBase64'];
        }
    }
    if(!empty($_POST['iconCommentUndoneGalleryViewBase64'])){
        if($_POST['iconCommentUndoneGalleryViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconCommentUndoneGalleryViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconCommentUndoneGalleryViewBase64'] = $_POST['iconCommentUndoneGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconCommentDoneGalleryViewBase64'])){
        if($_POST['iconCommentDoneGalleryViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconCommentDoneGalleryViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconCommentDoneGalleryViewBase64'] = $_POST['iconCommentDoneGalleryViewBase64'];
        }
    }
    if(!empty($_POST['iconCommentUndoneImageViewBase64'])){
        if($_POST['iconCommentUndoneImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconCommentUndoneImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconCommentUndoneImageViewBase64'] = $_POST['iconCommentUndoneImageViewBase64'];
        }
    }
    if(!empty($_POST['iconCommentDoneImageViewBase64'])){
        if($_POST['iconCommentDoneImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconCommentDoneImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconCommentDoneImageViewBase64'] = $_POST['iconCommentDoneImageViewBase64'];
        }
    }
    if(!empty($_POST['iconCommentAddImageViewBase64'])){
        if($_POST['iconCommentAddImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconCommentAddImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconCommentAddImageViewBase64'] = $_POST['iconCommentAddImageViewBase64'];
        }
    }
    if(!empty($_POST['iconInfoImageViewBase64'])){
        if($_POST['iconInfoImageViewBase64']=='off'){
            $jsonOptionsAllGalleryVariants['icons']['iconInfoImageViewBase64'] = '';
        }else{
            $jsonOptionsAllGalleryVariants['icons']['iconInfoImageViewBase64'] = $_POST['iconInfoImageViewBase64'];
        }
    }

    $fp = fopen($galleryUploadFolder . '/json/' . $GalleryID . '-options.json', 'w');
    fwrite($fp, json_encode($jsonOptionsAllGalleryVariants));
    fclose($fp);

    $tstampFile = $wp_upload_dir["basedir"] . "/contest-gallery/gallery-id-$id/json/$id-gallery-tstamp.json";
    $fp = fopen($tstampFile, 'w');
    fwrite($fp, time());
    fclose($fp);

    $isChangeFbLikeNoShare = false;
    if ($FbLikeNoShare != $FbLikeNoShareBefore) {
        $isChangeFbLikeNoShare = true;
    }

    $isChangeFbLikeOnlyShare = false;
    if ($FbLikeOnlyShare != $FbLikeOnlyShareBefore) {
        $isChangeFbLikeOnlyShare = true;
    }

    if ($isChangeFbLikeNoShare OR $isChangeFbLikeOnlyShare) {

        if ($FbLikeNoShare == 1) {
            $searchDataShare = 'data-share="true"';
            $replaceDataShare = 'data-share="false"';
            $searchClass = 'class="fb-share-button"';
            $replaceClass = 'class="fb-like"';
            $searchDataLayout = 'data-layout="button"';
            $replaceDataLayout = 'data-layout="button_count"';
        } else if ($FbLikeOnlyShare == 1) {
            $searchDataShare = 'data-share="false"';
            $replaceDataShare = 'data-share="true"';
            $searchClass = 'class="fb-like"';
            $replaceClass = 'class="fb-share-button"';
            $searchDataLayout = 'data-layout="button_count"';
            $replaceDataLayout = 'data-layout="button"';
        } else {
            $searchDataShare = 'data-share="false"';
            $replaceDataShare = 'data-share="true"';
            $searchClass = 'class="fb-share-button"';
            $replaceClass = 'class="fb-like"';
            $searchDataLayout = 'data-layout="button"';
            $replaceDataLayout = 'data-layout="button_count"';
        }

        $htmlFiles = glob($wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $id . '/*.html');

        foreach ($htmlFiles as $htmlFile) {

            $fp = fopen($htmlFile, 'r');
            $htmlFileData = fread($fp, filesize($htmlFile));
            fclose($fp);

            $htmlFileData = str_replace($searchDataShare, $replaceDataShare, $htmlFileData);
            $htmlFileData = str_replace($searchClass, $replaceClass, $htmlFileData);
            $htmlFileData = str_replace($searchDataLayout, $replaceDataLayout, $htmlFileData);

            $fp = fopen($htmlFile, 'w');
            fwrite($fp, $htmlFileData);
            fclose($fp);

        }

    }


}


?>