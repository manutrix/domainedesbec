<?php
if(!defined('ABSPATH')){exit;}

global $wpdb;

$galeryNR = $_GET['option_id'];
$GalleryID = $_GET['option_id'];

$upload_dir = wp_upload_dir();
$uploadFolder = wp_upload_dir();

$isEditOptions = true;

$replyMailNote = '<b>(Note for testing: mail is send to and "Reply mail" can not be the same)</b>';

$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablename_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";
$tablename_form_input = $wpdb->prefix . "contest_gal1ery_f_input";
$tablename_email_admin = $wpdb->prefix . "contest_gal1ery_mail_admin";
$tablenameemail = $wpdb->prefix . "contest_gal1ery_mail";
$tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";
//$tablename_mail_gallery = $wpdb->prefix . "contest_gal1ery_mail_gallery";
$tablename_mail_confirmation = $wpdb->prefix . "contest_gal1ery_mail_confirmation";

/*$tinymceStyle = '<style type="text/css">
				   .switch-tmce {display:inline;}
				   .wp-editor-area{height:120px;}
				   .wp-editor-tabs{float:left;}
				   body#tinymce{width:unset !important;}
				   </style>';

// TINY MCE Settings here
$settingsHTMLarea = array(
    "media_buttons"=>false,
    'editor_class' => 'cg-small-textarea',
    'default_post_edit_rows'=> 10,
    "teeny" => true,
    "dfw" => true,
    'editor_css' => $tinymceStyle
);*/

//$optionID = @@$_POST['option_id'];
$galeryID = $GalleryID;
include(__DIR__ ."/../../../check-language.php");


$selectSQL1 = $wpdb->get_results( "SELECT * FROM $tablenameOptions WHERE id = '$galeryNR'" );
$selectSQL2 = $wpdb->get_results( "SELECT * FROM $tablename_options_input WHERE GalleryID = '$galeryNR'" );
$selectSQL3 = $wpdb->get_results( "SELECT * FROM $tablename_options_visual WHERE GalleryID = '$galeryNR'" );


$selectSQL4 = $wpdb->get_results( "SELECT * FROM $tablename_pro_options WHERE GalleryID = '$galeryNR'" );

/*var_dump($galeryNR);
var_dump("SELECT * FROM $tablename_pro_options WHERE GalleryID = '$galeryNR'");
var_dump($tablenameOptions);
var_dump($tablename_pro_options);

echo "<pre>";
print_r($selectSQL4);
echo "</pre>";*/

foreach($selectSQL4 as $value4){

    $ForwardAfterRegUrl = html_entity_decode(stripslashes($value4->ForwardAfterRegUrl));
    $ForwardAfterRegText = contest_gal1ery_convert_for_html_output_without_nl2br($value4->ForwardAfterRegText);
    $ForwardAfterLoginUrlCheck = ($value4->ForwardAfterLoginUrlCheck==1) ? 'checked' : '';
    $ForwardAfterLoginUrlStyle = ($value4->ForwardAfterLoginUrlCheck==1) ? 'style="height:100px;"' : 'disabled style="background-color:#e0e0e0;height:100px;"';
    $ForwardAfterLoginUrl = contest_gal1ery_no_convert($value4->ForwardAfterLoginUrl);
    $ForwardAfterLoginTextCheck = ($value4->ForwardAfterLoginTextCheck==1) ? 'checked' : '';
    $ForwardAfterLoginTextStyle = ($value4->ForwardAfterLoginTextCheck==1) ? 'style="height:100px;"' : 'disabled style="background-color:#e0e0e0;height:100px;"';
    $ForwardAfterLoginText = contest_gal1ery_convert_for_html_output_without_nl2br($value4->ForwardAfterLoginText);
    $TextEmailConfirmation = contest_gal1ery_convert_for_html_output_without_nl2br($value4->TextEmailConfirmation);
    $TextAfterEmailConfirmation = contest_gal1ery_convert_for_html_output_without_nl2br($value4->TextAfterEmailConfirmation);
    $RegMailAddressor = contest_gal1ery_convert_for_html_output_without_nl2br($value4->RegMailAddressor);
    $RegMailReply = contest_gal1ery_convert_for_html_output_without_nl2br($value4->RegMailReply);
    $RegMailSubject = contest_gal1ery_convert_for_html_output_without_nl2br($value4->RegMailSubject);
    $UploadRequiresCookieMessage = contest_gal1ery_convert_for_html_output_without_nl2br($value4->UploadRequiresCookieMessage);
    $RegUserUploadOnlyText = contest_gal1ery_convert_for_html_output_without_nl2br($value4->RegUserUploadOnlyText);

    $RegUserGalleryOnly = ($value4->RegUserGalleryOnly==1) ? 'checked' : '';

    $CheckLoginUpload = ($value4->RegUserUploadOnly==1) ? 'checked' : '';
    $CheckCookieUpload = ($value4->RegUserUploadOnly==2) ? 'checked' : '';
    $CheckIpUpload = ($value4->RegUserUploadOnly==3) ? 'checked' : '';

    $RegUserGalleryOnlyText = contest_gal1ery_convert_for_html_output_without_nl2br($value4->RegUserGalleryOnlyText);
    $RegUserMaxUpload = (empty($value4->RegUserMaxUpload)) ? '' : $value4->RegUserMaxUpload;
    $PreselectSort = (empty($value4->PreselectSort)) ? 'date_descend' : $value4->PreselectSort;

    $FbLikeNoShare = ($value4->FbLikeNoShare==1) ? 'checked' : '';
    $FbLikeOnlyShare = ($value4->FbLikeOnlyShare==1) ? 'checked' : '';

    $DeleteFromStorageIfDeletedInFrontend = ($value4->DeleteFromStorageIfDeletedInFrontend==1) ? 'checked' : '';

    $Manipulate = ($value4->Manipulate==1) ? 'checked' : '';
    $MinusVote = ($value4->MinusVote==1) ? 'checked' : '';
    $SliderFullWindow = ($value4->SliderFullWindow==1) ? 'checked' : '';
    $VoteNotOwnImage = ($value4->VoteNotOwnImage==1) ? 'checked' : '';
    $RegMailOptional = ($value4->RegMailOptional==1) ? 'checked' : '';

    $CustomImageName = ($value4->CustomImageName==1) ? 'checked' : '';
    $CustomImageNamePath = contest_gal1ery_convert_for_html_output_without_nl2br($value4->CustomImageNamePath);

    if(empty($value4->SlideTransition)){
        $value4->SlideTransition = 'translateX';
    }

    $checkIpCheckUpload = '';

    if(empty($RegUserMaxUpload) && empty($value4->RegUserUploadOnly)){// do this for upgrade version 10.9.8.4.3
        $checkIpCheckUpload = 'checked';
    }

    $SlideHorizontal = ($value4->SlideTransition=='translateX') ? 'checked' : '';
    $SlideVertical = ($value4->SlideTransition=='slideDown') ? 'checked' : '';
    $Search = ($value4->Search==1) ? 'checked' : '';
    $GalleryUpload = ($value4->GalleryUpload==1) ? 'checked' : '';
    $VotePerCategory = ($value4->VotePerCategory==1) ? 'checked' : '';
    $VotesPerCategory = $value4->VotesPerCategory;
    if($VotesPerCategory==0){$VotesPerCategory='';}

    $GalleryUploadOnlyUser = ($value4->GalleryUploadOnlyUser==1) ? 'checked' : '';
    $ShowNickname = ($value4->ShowNickname==1) ? 'checked' : '';
    $ShowExif = ($value4->ShowExif==1) ? 'checked' : '';
    $GalleryUploadConfirmationText = contest_gal1ery_convert_for_html_output_without_nl2br($value4->GalleryUploadConfirmationText);
    $GalleryUploadTextAfter = contest_gal1ery_convert_for_html_output_without_nl2br($value4->GalleryUploadTextAfter);
    $GalleryUploadTextBefore = contest_gal1ery_convert_for_html_output_without_nl2br($value4->GalleryUploadTextBefore);

    $VotesInTime = ($value4->VotesInTime==1) ? 'checked' : '';
    $VotesInTimeQuantity = html_entity_decode(stripslashes($value4->VotesInTimeQuantity));
    $VotesInTimeIntervalReadable = html_entity_decode(stripslashes($value4->VotesInTimeIntervalReadable));
    $VotesInTimeIntervalReadableExploded = explode(':',$VotesInTimeIntervalReadable);
    $cg_date_hours_vote_interval = $VotesInTimeIntervalReadableExploded[0];


    /*        if($cg_date_hours_vote_interval<10){
                $cg_date_hours_vote_interval = '0'.$cg_date_hours_vote_interval;
            }*/

    if(!empty($VotesInTimeIntervalReadableExploded[1])){
        $cg_date_mins_vote_interval = $VotesInTimeIntervalReadableExploded[1];
    }else{
        $cg_date_mins_vote_interval = '00';
    }

    /*        if($cg_date_mins_vote_interval<10){
                $cg_date_mins_vote_interval = '0'.$cg_date_mins_vote_interval;
            }*/

    $VotesInTimeIntervalSeconds = html_entity_decode(stripslashes($value4->VotesInTimeIntervalSeconds));
    $VotesInTimeIntervalAlertMessage = contest_gal1ery_no_convert($value4->VotesInTimeIntervalAlertMessage);

    $HideRegFormAfterLogin = ($value4->HideRegFormAfterLogin==1) ? 'checked' : '';
    $HideRegFormAfterLoginShowTextInstead = ($value4->HideRegFormAfterLoginShowTextInstead==1) ? 'checked' : '';
    $HideRegFormAfterLoginTextToShow = contest_gal1ery_convert_for_html_output_without_nl2br($value4->HideRegFormAfterLoginTextToShow);

    /*
            $VotesInTime = (!empty($_POST['VotesInTime'])) ? '1' : '0';
            $VotesInTimeQuantity = (!empty($_POST['VotesInTimeQuantity'])) ? @$_POST['VotesInTimeQuantity'] : $VotesInTimeQuantity;
            if(!empty($_POST['cg_date_hours_vote_interval']) && !empty($_POST['cg_date_mins_vote_interval'])){
                $_POST['VotesInTimeIntervalReadable'] = $_POST['cg_date_hours_vote_interval'].":".$_POST['cg_date_mins_vote_interval'];
                $_POST['VotesInTimeIntervalSeconds'] = intval($_POST['cg_date_hours_vote_interval'])*(intval($_POST['cg_date_mins_vote_interval'])*60);
            }
            $VotesInTimeIntervalReadable = (!empty($_POST['VotesInTimeIntervalReadable'])) ? @$_POST['VotesInTimeIntervalReadable'] : $VotesInTimeIntervalReadable;
            $VotesInTimeIntervalSeconds = (!empty($_POST['VotesInTimeIntervalSeconds'])) ? @$_POST['VotesInTimeIntervalSeconds'] : $VotesInTimeIntervalSeconds;
            $VotesInTimeIntervalAlertMessage = (!empty($_POST['VotesInTimeIntervalAlertMessage'])) ? @$_POST['VotesInTimeIntervalAlertMessage'] : $VotesInTimeIntervalAlertMessage;*/

}


$checkDataFormOutput = $wpdb->get_results("SELECT * FROM $tablename_form_input WHERE GalleryID = $galeryNR and (Field_Type = 'comment-f' or Field_Type = 'text-f' or Field_Type = 'email-f')");

$selectSQLemailAdmin = $wpdb->get_row( "SELECT * FROM $tablename_email_admin WHERE GalleryID = '$galeryNR'" );
$ContentAdminMail = $selectSQLemailAdmin->Content;
$ContentAdminMail = contest_gal1ery_convert_for_html_output_without_nl2br($ContentAdminMail);


// Reihenfolge der Gallerien wird ermittelt --- ENDE


foreach($selectSQL1 as $value){

    $galleryDbVersion = $value->Version;
    $selectedCheckComments = ($value->AllowComments==1) ? 'checked' : '';
    $selectedCheckRating = ($value->AllowRating==1) ? 'checked' : '';
    $selectedCheckRating2 = ($value->AllowRating==2) ? 'checked' : '';
    $selectedCheckFbLike = ($value->FbLike==1) ? 'checked' : '';
    $selectedCheckFbLikeGallery = ($value->FbLikeGallery==1) ? 'checked' : '';
    $selectedCheckFbLikeGalleryVote = ($value->FbLikeGalleryVote==1) ? 'checked' : '';
    $selectedRatingOutGallery = ($value->RatingOutGallery==1) ? 'checked' : '';
    $selectedCommentsOutGallery = ($value->CommentsOutGallery==1) ? 'checked' : '';
    $selectedCheckIp = ($value->IpBlock==1) ? 'checked' : '';
    $selectedCheckFb = ($value->FbLike==1) ? 'checked' : '';
    $CheckLogin = ($value->CheckLogin==1) ? 'checked' : '';
    $CheckIp = ($value->CheckIp==1) ? 'checked' : '';
    $CheckCookie = ($value->CheckCookie==1) ? 'checked' : '';
    $RegistryUserRole = html_entity_decode(stripslashes($value->RegistryUserRole));

    if($CheckLogin == '' && $CheckIp == '' && $CheckCookie == ''){
        $CheckLogin = 'checked';
    }

    $CheckCookieAlertMessage = contest_gal1ery_no_convert($value->CheckCookieAlertMessage);


    if(empty($CheckCookieAlertMessage)){
        $CheckCookieAlertMessage = 'Please allow cookies to vote';
    }

    $HideUntilVote = ($value->HideUntilVote==1) ? 'checked' : '';
    $ShowOnlyUsersVotes = ($value->ShowOnlyUsersVotes==1) ? 'checked' : '';
    $HideInfo = ($value->HideInfo==1) ? 'checked' : '';

    //echo "<br>HideInfo: $HideInfo<br>";

    $ActivateUpload = ($value->ActivateUpload==1) ? 'checked' : '';
    $ContestEnd = ($value->ContestEnd==1) ? 'checked' : '';
    $ContestEndInstant = ($value->ContestEnd==2) ? 'checked' : '';
    $ContestEndTime = date('Y-m-d',(!empty($value->ContestEndTime)) ? $value->ContestEndTime : 0);
    $ContestStart = ($value->ContestStart==1) ? 'checked' : '';
    $ContestStartTime = date('Y-m-d',(!empty($value->ContestStartTime)) ? $value->ContestStartTime : 0);

    $ContestEndTimeHours = '';
    $ContestEndTimeMins = '';
    if(!empty($ContestEndTime)){
        $ContestEndTimeHours = date('H',($value->ContestEndTime==='') ? 0 : $value->ContestEndTime);
        $ContestEndTimeMins = date('i',($value->ContestEndTime==='') ? 0 : $value->ContestEndTime);
    }

    $ContestStartTimeHours = '';
    $ContestStartTimeMins = '';
    if(!empty($ContestStartTime)){
        $ContestStartTimeHours = date('H',($value->ContestStartTime==='') ? 0 : $value->ContestStartTime);
        $ContestStartTimeMins = date('i',($value->ContestStartTime==='') ? 0 : $value->ContestStartTime);
    }

    echo "<input type='hidden' id='getContestEndTime' value='".@$ContestEndTime."'>";
    echo "<input type='hidden' id='getContestStartTime' value='".@$ContestStartTime."'>";
    $FullSize = ($value->FullSize==1) ? 'checked' : '';// full screen mode!
    $FullSizeGallery = ($value->FullSizeGallery==1) ? 'checked' : '';// full window mode!
    $FullSizeSlideOutStart = ($value->FullSizeSlideOutStart==1) ? 'checked' : '';
    $OnlyGalleryView = ($value->OnlyGalleryView==1) ? 'checked' : '';
    $SinglePicView = ($value->SinglePicView==1) ? 'checked' : '';
    $ScaleOnly = ($value->ScaleOnly==1) ? 'checked' : '';
    $ScaleAndCut = ($value->ScaleAndCut==1) ? 'checked' : '';

    $AllowGalleryScript = ($value->AllowGalleryScript==1) ? 'checked' : '';

    $InfiniteScroll = $value->InfiniteScroll;

    //echo "<br>InfiniteScroll: $InfiniteScroll<br>";


    //$InfiniteScroll = ($value->InfiniteScroll==1) ? 'checked' : '';


    $FullSizeImageOutGallery = ($value->FullSizeImageOutGallery==1) ? 'checked' : '';
    $FullSizeImageOutGalleryNewTab = ($value->FullSizeImageOutGalleryNewTab==1) ? 'checked' : '';
    $ShowAlwaysInfoSlider = ($value->ShowAlwaysInfoSlider==1) ? 'checked' : '';
    $HeightLook = ($value->HeightLook==1) ? 'checked' : '';
    $RowLook = ($value->RowLook==1) ? 'checked' : '';
    $ThumbsInRow = ($value->ThumbsInRow==1) ? 'checked' : '';
    $LastRow = ($value->LastRow==1) ? 'checked' : '';
    $AllowSort = ($value->AllowSort==1) ? 'checked' : '';
    $RandomSort = ($value->RandomSort==1) ? 'checked' : '';
    $RandomSortButton = ($value->RandomSortButton==1) ? 'checked' : '';
    $PicsInRow = $value->PicsInRow;
    $PicsPerSite = $value->PicsPerSite;
    $VotesPerUser = $value->VotesPerUser;
    if($VotesPerUser==0){$VotesPerUser='';}
    $GalleryName1 = $value->GalleryName;
    $ShowAlways = $value->ShowAlways;
    @$selectedShowAlways = ($value->ShowAlways==1) ? 'checked' : '';

    //echo "<br>GalleryName: $GalleryName<br>";

    // Forward images to URL options

    @$Use_as_URL = $wpdb->get_var( "SELECT Use_as_URL FROM $tablename_form_input WHERE GalleryID = '$galeryNR' AND Use_as_URL = '1' ");
    //echo "<br>Use_as_URL: $Use_as_URL<br>";
    @$ForwardToURL = ($value->ForwardToURL==1) ? 'checked' : '';
    @$ForwardType = ($value->ForwardType==2) ? 'checked' : '';
    //echo $ForwardType;
    //Prüfen ob Forward URL aus dem Slider oder aus der Gallerie weiterleiten soll
    @$ForwardFrom = $value->ForwardFrom;
    @$ForwardFromSlider = ($ForwardFrom==1) ? 'checked' : '';
    @$ForwardFromGallery = ($ForwardFrom==2) ? 'checked' : '';
    @$ForwardFromSinglePic = ($ForwardFrom==3) ? 'checked' : '';

    // Forward images to URL options --- ENDE

    $ThumbLook = ($value->ThumbLook==1) ? 'checked' : '';
    $SliderLook = ($value->SliderLook==1) ? 'checked' : '';
    $AdjustThumbLook = ($value->AdjustThumbLook==1) ? 'checked' : '';

    $WidthThumb = $value->WidthThumb;
    $HeightThumb = $value->HeightThumb;
    $DistancePics = $value->DistancePics;
    $DistancePicsV = $value->DistancePicsV;

    $WidthGallery = $value->WidthGallery;
    $HeightGallery = $value->HeightGallery;
    $HeightLookHeight = $value->HeightLookHeight;
    $Inform = $value->Inform;
    $InformAdmin = ($value->InformAdmin==1) ? 'checked' : '';
    $MaxResJPGwidth = $value ->MaxResJPGwidth;
    $MaxResJPGheight = $value ->MaxResJPGheight;
    //Leeren Wert kann man by MySQL nicht einfügen. Es entsteht immer eine NULL
    if($MaxResJPGwidth==0){$MaxResJPGwidth='';}
    if($MaxResJPGheight==0){$MaxResJPGheight='';}
    $MaxResPNGwidth = $value ->MaxResPNGwidth;
    $MaxResPNGheight = $value ->MaxResPNGheight;
    if($MaxResPNGwidth==0){$MaxResPNGwidth='';}
    if($MaxResPNGheight==0){$MaxResPNGheight='';}
    $MaxResGIFwidth = $value ->MaxResGIFwidth;
    $MaxResGIFheight = $value ->MaxResGIFheight;
    if($MaxResGIFwidth==0){$MaxResGIFwidth='';}
    if($MaxResGIFheight==0){$MaxResGIFheight='';}
    $MaxResJPGon = ($value->MaxResJPGon==1) ? 'checked' : '';
    $MaxResPNGon = ($value->MaxResPNGon==1) ? 'checked' : '';
    $MaxResGIFon = ($value->MaxResGIFon==1) ? 'checked' : '';
    $FbLikeGoToGalleryLink = (empty($value->FbLikeGoToGalleryLink)) ? '' : $value->FbLikeGoToGalleryLink;
    $FbLikeGoToGalleryLink = contest_gal1ery_no_convert($FbLikeGoToGalleryLink);

    $ActivatePostMaxMB = ($value->ActivatePostMaxMB==1) ? 'checked' : '';
    $PostMaxMB = $value ->PostMaxMB;
    if($PostMaxMB==0){$PostMaxMB='';}

    $ActivateBulkUpload = ($value->ActivateBulkUpload==1) ? 'checked' : '';
    $BulkUploadQuantity = $value ->BulkUploadQuantity;
    if($BulkUploadQuantity==0){$BulkUploadQuantity='';}

    $BulkUploadMinQuantity = $value->BulkUploadMinQuantity;
    if($BulkUploadMinQuantity==0){$BulkUploadMinQuantity='';}

    $GalleryName = $value->GalleryName;

}


//print_r($selectSQL2);

foreach($selectSQL2 as $value2){

    // Wenn 0 dann confirmation text, wenn 1 dann URL Weiterleitung
    $Forward = ($value2->Forward==1) ? 'checked' : '';
    $ForwardUploadConf = ($value2->Forward==0) ? 'checked' : '';
    $ForwardUploadURL = ($value2->Forward==1) ? 'checked' : '';
    $ShowFormAfterUpload = ($value2->ShowFormAfterUpload==1) ? 'checked' : '';
    //echo "$Forward";
    $forward_url_disabled = ($value2->Forward==1) ? 'style="width:500px;"' : 'disabled style="background: #e0e0e0;width:500px;"';
    $Forward_URL = $value2->Forward_URL;
    $Forward_URL = contest_gal1ery_no_convert($Forward_URL);
    $Confirmation_Text = $value2->Confirmation_Text;
    $Confirmation_Text = contest_gal1ery_convert_for_html_output_without_nl2br($Confirmation_Text);
    $Confirmation_Text_Disabled = ($value2->Forward==0) ? '' : 'disabled';

}

//	print_r($selectSQL3);

foreach($selectSQL3 as $value3){

    $Field1IdGalleryView = $value3->Field1IdGalleryView;
    $ThumbViewBorderWidth = $value3->ThumbViewBorderWidth;
    $ThumbViewBorderRadius = $value3->ThumbViewBorderRadius;
    $ThumbViewBorderColor = $value3->ThumbViewBorderColor;
    $ThumbViewBorderColorPlaceholder = (empty($ThumbViewBorderColor)) ? "placeholder='000000'" : '';
    $ThumbViewBorderOpacity = $value3->ThumbViewBorderOpacity;
    $HeightViewBorderWidth = $value3->HeightViewBorderWidth;
    $HeightViewBorderRadius = $value3->HeightViewBorderRadius;
    $HeightViewBorderColor = $value3->HeightViewBorderColor;
    $HeightViewBorderColorPlaceholder = (empty($HeightViewBorderColor)) ? "placeholder='000000'" : '';
    $HeightViewBorderOpacity = $value3->HeightViewBorderOpacity;
    $HeightViewSpaceWidth = $value3->HeightViewSpaceWidth;
    $HeightViewSpaceHeight = $value3->HeightViewSpaceHeight;
    $RowViewBorderWidth = $value3->RowViewBorderWidth;
    $RowViewBorderRadius = $value3->RowViewBorderRadius;
    $RowViewBorderColor = $value3->RowViewBorderColor;
    $RowViewBorderColorPlaceholder = (empty($RowViewBorderColor)) ? "placeholder='000000'" : '';
    $RowViewBorderOpacity = $value3->RowViewBorderOpacity;
    $RowViewSpaceWidth = $value3->RowViewSpaceWidth;
    $RowViewSpaceHeight = $value3->RowViewSpaceHeight;
    $TitlePositionGallery = $value3->TitlePositionGallery;
    $RatingPositionGallery = $value3->RatingPositionGallery;
    $CommentPositionGallery = $value3->CommentPositionGallery;
    $ActivateGalleryBackgroundColor = ($value3->ActivateGalleryBackgroundColor==1) ? 'checked' : '' ;
    $GalleryBackgroundColor = $value3->GalleryBackgroundColor;
    $GalleryBackgroundColorPlaceholder = (empty($GalleryBackgroundColor)) ? "placeholder='000000'" : '';
    $GalleryBackgroundOpacity = $value3->GalleryBackgroundOpacity;
    $OriginalSourceLinkInSlider = ($value3->OriginalSourceLinkInSlider==1) ? 'checked' : '';
    $PreviewInSlider = ($value3->PreviewInSlider==1) ? 'checked' : '';
    $FeControlsStyleWhite = ($value3->FeControlsStyle=='white' OR empty($value3->FeControlsStyle)) ? 'checked' : '';
    $FeControlsStyleBlack = ($value3->FeControlsStyle=='black') ? 'checked' : '';
    $GalleryStyleCenterWhiteChecked = ($value3->GalleryStyle=='center-white') ? 'checked' : '';
    $GalleryStyleCenterBlackChecked = ($value3->GalleryStyle=='center-black' OR empty($value3->GalleryStyle)) ? 'checked' : '';
    $AllowSortOptions = (!empty($value3->AllowSortOptions)) ? $value3->AllowSortOptions : 'date-desc,date-asc,rate-desc,rate-asc,rate-average-desc,rate-average-asc,comment-desc,comment-asc,random';
    $BlogLook = (!empty($value3->BlogLook)) ? 'checked' : '';
    $BlogLookOrder = (!empty($value3->BlogLookOrder)) ? $value3->BlogLookOrder : 5;
    $BlogLookFullWindow = ($value3->BlogLookFullWindow==1) ? 'checked' : '';
    $ImageViewFullWindow = ($value3->ImageViewFullWindow==1) ? 'checked' : '';
    $ImageViewFullScreen = ($value3->ImageViewFullScreen==1) ? 'checked' : '';
    $SliderThumbNav = ($value3->SliderThumbNav==1) ? 'checked' : '';
    $BorderRadius = ($value3->BorderRadius==1) ? 'checked' : '';

}

$AllowSortOptionsArray = explode(',',$AllowSortOptions);

//echo "source:".$OriginalSourceLinkInSlider;

$selectedRatingPositionGalleryLeft = ($RatingPositionGallery==1) ? "checked" : "";
$selectedRatingPositionGalleryCenter = ($RatingPositionGallery==2) ? "checked" : "";
$selectedRatingPositionGalleryRight = ($RatingPositionGallery==3) ? "checked" : "";

$selectedCommentPositionGalleryLeft = ($CommentPositionGallery==1) ? "checked" : "";
$selectedCommentPositionGalleryCenter = ($CommentPositionGallery==2) ? "checked" : "";
$selectedCommentPositionGalleryRight = ($CommentPositionGallery==3) ? "checked" : "";


$selectedTitlePositionGalleryLeft = ($TitlePositionGallery==1) ? "checked" : "";
$selectedTitlePositionGalleryCenter = ($TitlePositionGallery==2) ? "checked" : "";
$selectedTitlePositionGalleryRight = ($TitlePositionGallery==3) ? "checked" : "";

$GalleryBackgroundColorFields = ($value3->ActivateGalleryBackgroundColor==0) ? 'disabled' : '' ;
//$ThumbLookFieldsChecked = ($value->RowLook==0) ? 'checked' : '' ;
$GalleryBackgroundColorStyle = ($value3->ActivateGalleryBackgroundColor==0) ? 'background-color:#e0e0e0;' : '' ;

//echo "<br>ThumbViewBorderOpacity: $ThumbViewBorderOpacity<br>";
//echo "<br>HeightViewBorderOpacity: $HeightViewBorderOpacity<br>";
//	echo "<br>RowViewBorderOpacity: $RowViewBorderOpacity<br>";

// Disable enable RowLook and ThumbLook Fields

$RowLookFields = ($value->RowLook==0) ? 'disabled' : '' ;
$RowLookFieldsStyle = ($value->RowLook==0) ? 'background-color:#e0e0e0;' : '' ;
$HeightLookFields = ($value->HeightLook==0) ? 'disabled' : '' ;
$HeightLookFieldsStyle = ($value->HeightLook==0) ? 'background-color:#e0e0e0;' : '' ;
$ThumbLookFields = ($value->ThumbLook==0) ? 'disabled' : '' ;
//$ThumbLookFieldsChecked = ($value->RowLook==0) ? 'checked' : '' ;
$ThumbLookFieldsStyle = ($value->ThumbLook==0) ? 'background-color:#e0e0e0;' : '' ;

// Disable enable RowLook Fields  --------- END

// set order

$selectGalleryLookOrder = $wpdb->get_results( "SELECT SliderLookOrder, ThumbLookOrder, HeightLookOrder, RowLookOrder  FROM $tablenameOptions WHERE id = '$galeryNR'" );

// Reihenfolge der Gallerien wird ermittelt

$order = array();

$selectGalleryLookOrder[0]->BlogLookOrder = $BlogLookOrder;

foreach($selectGalleryLookOrder[0] as $key => $value){
    $order[$value]=$key;
}

ksort($order);

// set order --- END

// Inform set or not

$checkInform = ($Inform==1) ? 'checked' : '' ;

$id = $galeryNR;


//Update 4.00: Single Pic View Prüfung

if($AllowGalleryScript!= 'checked' AND $FullSizeImageOutGallery != 'checked' AND $SinglePicView != 'checked' AND $OnlyGalleryView != 'checked'){

    $SinglePicView = "checked";

}

//Update 4.00: Single Pic View Prüfung --- ENDE


//echo $SinglePicView;


// Get email text options

$selectSQLemail = $wpdb->get_row( "SELECT * FROM $tablenameemail WHERE GalleryID = '$galeryNR'" );

$selectSQLmailConfirmation = $wpdb->get_row("SELECT * FROM $tablename_mail_confirmation WHERE GalleryID = '$galeryNR'" );

$mConfirmSendConfirm = ($selectSQLmailConfirmation->SendConfirm==1) ? 'checked' : '' ;

//$selectSQLmailGallery = $wpdb->get_row("SELECT * FROM $tablename_mail_gallery WHERE GalleryID = '$galeryNR'" );

/*$mGallerySendToImageOff = ($selectSQLmailGallery->SendToImageOff==1) ? 'checked' : '' ;
$mGallerySendToNotConfirmedUsers = ($selectSQLmailGallery->SendToNotConfirmedUsers==1) ? 'checked' : '' ;*/


//$content = (@$_POST['editpost']) ? @$_POST['editpost'] : $selectSQLemail->Content;
//$contentUserMail = $selectSQLemail->Content;


// JSON options KORREKTUR SCRIPT HIER

$jsonOptionsFile = $upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryNR.'/json/'.$galeryNR.'-options.json';
$fp = fopen($jsonOptionsFile, 'r');
$jsonOptions = json_decode(fread($fp,filesize($jsonOptionsFile)),true);
fclose($fp);

$isModernOptionsNew = false;

if(empty($jsonOptions[$galeryID.'-u'])){

    $jsonOptionsNew = array();
    $jsonOptionsNew[$galeryNR] = $jsonOptions;
    $jsonOptionsNew[$galeryNR.'-u'] = $jsonOptions;
    $jsonOptionsNew[$galeryNR.'-nv'] = $jsonOptions;
    $jsonOptionsNew[$galeryNR.'-w'] = $jsonOptions;

    $jsonOptions = $jsonOptionsNew;
    $isModernOptionsNew = true;
}

// JSON options KORREKTUR SCRIPT HIER --- END

// get JSON PRO values here
// already converted for html output here (in check-language) if exists
$VotesPerUserAllVotesUsedHtmlMessage = (!empty($translations['pro']['VotesPerUserAllVotesUsedHtmlMessage'])) ? $translations['pro']['VotesPerUserAllVotesUsedHtmlMessage'] : '';

//$content = html_entity_decode(stripslashes($content));

//nl2br($contentBr);

// Get email text options --- ENDE

// get mail exception logs

$mailExceptions = '';
$fileName = md5(wp_salt( 'auth').'---cnglog---'.$GalleryID);
$fileMailExceptions = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$GalleryID.'/logs/errors/mail-'.$fileName.'.log';
if(file_exists($fileMailExceptions)){
    $mailExceptions = file_get_contents($fileMailExceptions);
}
// get mail exception logs --- END

$cg_get_version = cg_get_version();


// get possible domain mail ending
$bloginfo_wpurl = get_bloginfo('wpurl');
$cgYourDomainName = 'your domain name';

if(strpos($bloginfo_wpurl,'www.')!==false){
    $cgYourDomainName = 'your domain @'.substr($bloginfo_wpurl,strpos($bloginfo_wpurl,'www.')+4,strlen($bloginfo_wpurl));
}
// get possible domain mail ending --- END

$deprecatedGalleryHoverDivText = '';
$deprecatedGalleryHoverDisabledForever = '';

if(floatval($galleryDbVersion)>=12.10){
    $deprecatedGalleryHoverDivText = '<div style="margin-top: 10px;"><span style="font-weight: bold;">DEPRECATED</span><br>Not available for galleries created in version 12.1.0 or higher<br>New modern appearence will be used</div>';
    $deprecatedGalleryHoverDisabledForever = 'cg_disabled_forever';
}

require_once(dirname(__FILE__) . "/../nav-menu.php");

echo "<form action='?page=".cg_get_version()."/index.php&edit_options=true&option_id=$galeryNR' method='post' class='cg_load_backend_submit cg_load_backend_submit_save_data'>";

wp_nonce_field( 'cg_admin');

//echo '<input type="hidden" name="editOptions" value="true" >';
echo '<input type="hidden" name="option_id" value="'.$galeryNR.'" >';

//echo '<input type="hidden" id="checkLoginBgColor" value="'.$checkLoginBgColor.'" >';

$i=0;

echo <<<HEREDOC
<div id="cgGoTopOptions" class='cg_hide'>
^
</div>
<div id="cgOptionsLoader" class="cg_hide cg-lds-dual-ring-div-gallery-hide cg-lds-dual-ring-div-gallery-hide-mainCGallery">
    <div class="cg-lds-dual-ring-gallery-hide cg-lds-dual-ring-gallery-hide-mainCGallery">
    </div>
</div>
HEREDOC;

if(!empty($_POST['changeSize'])){

    echo "<p id='cg_changes_saved' style='font-size:18px;'><strong>Changes saved</strong></p>";

}


echo <<<HEREDOC

    <div id="cg_main_options" class="cg_hidden">
        <div id="cg_main_options_tab">
            <ul class="tabs" data-persist="true">
                <li class='cg_view_select cg_selected' data-view="#view1" data-count="1"><a data-view="#view1" data-href="cgViewHelper1">Gallery view options</a></li>
                <li class='cg_view_select' data-view="#view2" data-count="2"><a data-view="#view2" data-href="cgViewHelper2">Image view options</a></li>
                <li class='cg_view_select' data-view="#view3" data-count="3"><a data-view="#view3" data-href="cgViewHelper3">Gallery options</a></li>
                <li class='cg_view_select' data-view="#view4" data-count="4"><a data-view="#view4" data-href="cgViewHelper4">Voting options</a></li>
                <li class='cg_view_select' data-view="#view5" data-count="5"><a data-view="#view5" data-href="cgViewHelper5">Upload options</a></li>
                <li class='cg_view_select' data-view="#view6" data-count="6"><a data-view="#view6" data-href="cgViewHelper6">Registration options</a></li>
HEREDOC;
$styleTabContents="style='border-radius:none !important;position:relative;'";
echo <<<HEREDOC
                <div id="cg_main_options_tab_second_row">
                    <div id="cg_main_options_tab_second_row_inner">
                        <li class='cg_view_select' data-view="#view7" data-count="7"><a data-view="#view7" data-href="cgViewHelper7">Login options</a></li>
                        <li class='cg_view_select' data-view="#view8" data-count="8"><a data-view="#view8" data-href="cgViewHelper8">E-mail confirmation e-mail</a></li>
                        <li class='cg_view_select' data-view="#view9" data-count="9"><a data-view="#view9" data-href="cgViewHelper9">Image activation e-mail</a></li>
                        <li class='cg_view_select' data-view="#view10" data-count="10"><a data-view="#view10" data-href="cgViewHelper10">Translations</a></li>
                        <li class='cg_view_select' data-view="#view11" data-count="11"><a data-view="#view11" data-href="cgViewHelper11">Icons</a></li>
                        <li id="cgSaveOptionsNavButton"><input type="button" class="cg_backend_button_gallery_action" value="Save all options"></li>
                    </div>
                </div>
HEREDOC;

echo <<<HEREDOC
            </ul>
        </div>
        <div id="cg_main_options_content" class="tabcontents" $styleTabContents>
            <h4 id="view1" class="cg_view_header">Gallery view options</h4>
            
<div class="cg_short_code_multiple_pics_configuration_buttons">
    <div class="cg_short_code_multiple_pics_configuration_buttons_container">
        <div class="cg_short_code_multiple_pics_configuration cg_short_code_multiple_pics_configuration_cg_gallery cg_active"> cg_gallery</div>
        <div class="cg_short_code_multiple_pics_configuration cg_short_code_multiple_pics_configuration_cg_gallery_user" >cg_gallery_user</div>
        <div class="cg_short_code_multiple_pics_configuration cg_short_code_multiple_pics_configuration_cg_gallery_no_voting">cg_gallery_no_voting</div>
        <div class="cg_short_code_multiple_pics_configuration cg_short_code_multiple_pics_configuration_cg_gallery_winner">cg_gallery_winner</div>
    </div>
</div>

<div style="
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    line-height: 20px;
"><b>NOTE:</b> "Gallery view options" can be configured for every gallery shortcode</div>
            
            
HEREDOC;


/*
 * $tinymceStyle = '<style type="text/css">
				   .wp-editor-area{height:300px;}
				   </style>';*/

/*$timymceSettings = array(
    'plugins' => "preview",
    'menubar' => "view",
    'toolbar' => "preview",
    'plugin_preview_width'=> 650,
    'selector' => "textarea"
);*/

/*$settingsHTMLarea = array(
    "media_buttons"=>false,
    'editor_class' => 'html-active',
    'default_post_edit_rows'=> 10,
    "textarea_name"=>'upload[]',
    "teeny" => true,
    "dfw" => true,
    'editor_css' => $tinymceStyle
);*/

include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-multiple-pics/shortcode-multiple-pics-cg-gallery.php');
include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-multiple-pics/shortcode-multiple-pics-cg-gallery-user.php');
include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-multiple-pics/shortcode-multiple-pics-cg-gallery-no-voting.php');
include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-multiple-pics/shortcode-multiple-pics-cg-gallery-winner.php');


echo <<<HEREDOC

                       <h4 id="view2" class="cg_view_header">Image view options</h4>
                       
<div class="cg_short_code_single_pic_configuration_buttons">
    <div class="cg_short_code_single_pic_configuration_buttons_container">
        <div class="cg_short_code_single_pic_configuration cg_short_code_single_pic_configuration_cg_gallery cg_active">cg_gallery</div>
        <div class="cg_short_code_single_pic_configuration cg_short_code_single_pic_configuration_cg_gallery_user" >cg_gallery_user</div>
        <div class="cg_short_code_single_pic_configuration cg_short_code_single_pic_configuration_cg_gallery_no_voting">cg_gallery_no_voting</div>
        <div class="cg_short_code_single_pic_configuration cg_short_code_single_pic_configuration_cg_gallery_winner">cg_gallery_winner</div>
    </div>
</div>
                    
<div style="
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    line-height: 20px;
"><b>NOTE:</b> "Image view options" can be configured for every gallery shortcode</div>               

HEREDOC;

// old code
echo '<input type="hidden" name="ScaleSizesGalery"  '.$ScaleAndCut.'  class="ScaleSizesGalery">';
echo '<input type="hidden" name="ScaleWidthGalery"  '.$ScaleOnly.'  class="ScaleWidthGalery">';

include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-single-pic/shortcode-single-pic-cg-gallery.php');
include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-single-pic/shortcode-single-pic-cg-gallery-user.php');
include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-single-pic/shortcode-single-pic-cg-gallery-no-voting.php');
include(__DIR__.'/shortcodes-configuration/shortcodes-configuration-single-pic/shortcode-single-pic-cg-gallery-winner.php');


echo <<<HEREDOC
            <h4 id="view3" class="cg_view_header">Gallery options</h4>
            <div class="cg_view cgGalleryOptions cgViewHelper3">
HEREDOC;

$dateCurrent = date('Y-m-d H:i');

include(__DIR__.'/views-content/view-gallery-options.php');


echo <<<HEREDOC
</div>
HEREDOC;


echo <<<HEREDOC
 </div>
             <h4 id="view4" class="cg_view_header">Voting options</h4>

<div class="cg_view cgVotingOptions cgViewHelper4" id="cgVotingOptions">
HEREDOC;

$userIP = cg_get_user_ip();

$userIPunknown = '';

if($userIP=='unknown'){
    $userIPunknown = "<br><span style='color:red;'>Users IP can not be tracked because of your server system.<br>Your server provider track the IP in very unusual way.<br>
This recognition method would not work for you.<br>Please contact support@contest-gallery.com<br> and tell the name of your server provider<br>so it can be researched.</span>";
}

$FbLikeGoToGalleryLinkPlaceholder = site_url().'/';

include(__DIR__.'/views-content/view-voting-options.php');

echo <<<HEREDOC
 </div>
             <h4 id="view5" class="cg_view_header">Upload options</h4>

			   <div class="cg_view cgUploadOptions cgViewHelper5">
HEREDOC;
$get_site_url = get_site_url();

// Maximal möglich eingestellter Upload wird ermittelt
$upload_max_filesize = contest_gal1ery_return_mega_byte(ini_get('upload_max_filesize'));
$post_max_size = contest_gal1ery_return_mega_byte(ini_get('post_max_size'));

include(__DIR__.'/views-content/view-upload-options.php');

echo "</div>";


echo <<<HEREDOC
            <h4 id="view6" class="cg_view_header">Registration options</h4>
	<div class="cg_view cgRegistrationOptions cgViewHelper6">
HEREDOC;

include(__DIR__.'/views-content/view-registration-options.php');

echo "</div>";
echo <<<HEREDOC
            <h4 id="view7" class="cg_view_header">Login options</h4>
	<div class="cg_view cgLoginOptions cgViewHelper7">
HEREDOC;

include(__DIR__.'/views-content/view-login-options.php');

echo "</div>";

echo <<<HEREDOC
            <h4 id="view8" class="cg_view_header">E-mail confirmation e-mail</h4>
	<div class='cg_view cgEmailConfirmationEmail cgViewHelper8'>
HEREDOC;

include(__DIR__.'/views-content/view-email-confirmation-email-options.php');

echo "</div>";

echo <<<HEREDOC
            <h4 id="view9" class="cg_view_header">Image activation e-mail</h4>
	<div class="cg_view  cgViewHelper9">
HEREDOC;

include(__DIR__.'/views-content/view-image-activation-email-options.php');

echo "</div>";

echo <<<HEREDOC

            <h4 id="view10" class="cg_view_header">Translations</h4>
            <div class="cg_view cgTranslationOptions cgViewHelper10" id="cgTranslationOptions">
HEREDOC;

include(__DIR__.'/views-content/view-translations-options.php');

echo <<<HEREDOC
            </div>
            
HEREDOC;

echo <<<HEREDOC
            <h4 id="view11" class="cg_view_header">Icons</h4>
	<div class="cg_view  cgViewHelper11">
HEREDOC;

include(__DIR__.'/views-content/view-icons-options.php');

echo "</div>";


echo <<<HEREDOC
 </div>
<input type="hidden" name="changeSize" value="true" />
<div style="" id="cg_save_all_options" class="cg_hidden"><input  class="cg_backend_button_gallery_action" type="submit" value="Save all options" id="cgSaveOptionsButton" /></div>
            </div>
HEREDOC;



echo "</form>";



?>