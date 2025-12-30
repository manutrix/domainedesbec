<?php
if(!defined('ABSPATH')){exit;}

global $wpdb;

$tablename = $wpdb->prefix . "contest_gal1ery";
$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablenameComments = $wpdb->prefix . "contest_gal1ery_comments";
$tablename_f_input = $wpdb->prefix . "contest_gal1ery_f_input";
$tablename_f_output = $wpdb->prefix . "contest_gal1ery_f_output";
$tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";
$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";
$tablenameEntries = $wpdb->prefix . "contest_gal1ery_entries";
$tablenameIP = $wpdb->prefix ."contest_gal1ery_ip";
$table_posts = $wpdb->prefix ."posts";
$tablename_categories = $wpdb->prefix . "contest_gal1ery_categories";

$galeryIDuser = $galeryID;
$isUserGallery = false;
if(!empty($isOnlyGalleryUser)){
    $galeryIDuser = $galeryID.'-u';
    $isUserGallery = true;
    $isOnlyGalleryNoVoting = false;
    $isOnlyGalleryWinner = false;
} else if(!empty($isOnlyGalleryNoVoting)){
    $isOnlyGalleryNoVoting = true;
    $galeryIDuser = $galeryID.'-nv';
    $isOnlyGalleryWinner = false;
} else if(!empty($isOnlyGalleryWinner)){
    $isOnlyGalleryWinner = true;
    $galeryIDuser = $galeryID.'-w';
    $isOnlyGalleryNoVoting = false;
}else{
    $isOnlyGalleryNoVoting = false;
    $isOnlyGalleryWinner = false;
}

$options = (!empty($options[$galeryIDuser])) ? $options[$galeryIDuser] : $options;
$isModernOptions = (!empty($options[$galeryIDuser])) ? true : false;

$WpUserId = '';

if(is_user_logged_in()){
    $WpUserId = get_current_user_id();
}

$wp_upload_dir = wp_upload_dir();
$jsonImagesFile = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-images.json';
$fp = fopen($jsonImagesFile, 'r');
$jsonImages = json_decode(fread($fp,filesize($jsonImagesFile)),true);
fclose($fp);

/*FBLIKE-WIDTH-CORRECTION-START*/
if($options['general']['FbLike']==1){
    if(!file_exists($wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/fblike-width-correction-done.txt')){

        $htmlFiles = glob($wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $galeryID . '/*.html');

        $replace = '                        <!--FBLIKE-WIDTH-CORRECTION-START-->
                                                <style>
                                                    .fb_iframe_widget iframe {
                                                        width: unset !important;
                                                    }
                                                </style>
                                                <!--FBLIKE-WIDTH-CORRECTION-END-->
                                                 </head>';

        foreach ($htmlFiles as $htmlFile) {

            $fp = fopen($htmlFile, 'r');
            $htmlFileData = fread($fp, filesize($htmlFile));
            fclose($fp);

            if(strpos($htmlFileData,'<!--FBLIKE-WIDTH-CORRECTION-START-->')===false){
                $htmlFileDataNew = str_replace('</head>', $replace, $htmlFileData);
                $fp = fopen($htmlFile, 'w');
                fwrite($fp, $htmlFileDataNew);
                fclose($fp);
            }

        }

        $fp = fopen($wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/fblike-width-correction-done.txt', 'w');
        fwrite($fp, 'do not remove this txt file if you read this otherwise might break frontend gallery functionality');
        fclose($fp);

    }
}
/*FBLIKE-WIDTH-CORRECTION-END*/


$is_user_logged_in = is_user_logged_in();
$isShowGallery = true;

$IsModernFiveStar = (!empty($options['pro']['IsModernFiveStar'])) ? true : false;

if($options['pro']['RegUserGalleryOnly']==1 && $is_user_logged_in == false){
    $isShowGallery = false;
}

if($isShowGallery == true){

    // check if sort values files exists
    if(!file_exists($wp_upload_dir['basedir'] . "/contest-gallery/gallery-id-".$galeryID."/json/".$galeryID."-images-sort-values.json")){
        cg_actualize_all_images_data_sort_values_file($galeryID,true);
    }else{

        $jsonImagesSortValuesFile = $wp_upload_dir['basedir'] . "/contest-gallery/gallery-id-".$galeryID."/json/".$galeryID."-images-sort-values.json";

        if(filesize($jsonImagesSortValuesFile)<10){// then must be empty array or empty file and have to be repaired
            cg_actualize_all_images_data_sort_values_file($galeryID,false,$IsModernFiveStar);
        }else{

            $frontendAddedVotesDir = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/frontend-added-votes';

            if(is_dir($frontendAddedVotesDir)){
                if(count(scandir($frontendAddedVotesDir)) != 2){
                    $tstampFile = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-gallery-sort-values-tstamp.json';
                    if(file_exists($tstampFile)){
                        $fp = fopen($tstampFile, 'r');
                        $tstamp = json_decode(fread($fp, filesize($tstampFile)));
                        fclose($fp);
                        if(is_numeric($tstamp)){
                            if(time()>$tstamp+30){
                                cg_actualize_all_images_data_sort_values_file($galeryID,false,$IsModernFiveStar);
                            }
                        }else{// then string was put in old versions before in 109900 or so, have to be checked
                            cg_actualize_all_images_data_sort_values_file($galeryID,false,$IsModernFiveStar);
                        }
                    }
                }
            }

        }


    }
    // check if sort values files exists --- ENDE

    // check if image-info-values-file-exists
    if(!file_exists($wp_upload_dir['basedir'] . "/contest-gallery/gallery-id-".$galeryID."/json/".$galeryID."-images-info-values.json")){
        cg_actualize_all_images_data_info_file($galeryID);
    }else{

        $jsonImagesInfoValuesFile = $wp_upload_dir['basedir'] . "/contest-gallery/gallery-id-".$galeryID."/json/".$galeryID."-images-info-values.json";

        if(filesize($jsonImagesInfoValuesFile)<10){// then must be empty array or empty file and have to be repaired
            cg_actualize_all_images_data_info_file($galeryID);
        }else{

            $frontendAddedImagesDir = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/frontend-added-or-removed-images';

            if(is_dir($frontendAddedImagesDir)){
                if(count(scandir($frontendAddedImagesDir)) != 2){
                    $tstampFile = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-gallery-image-info-tstamp.json';
                    if(file_exists($tstampFile)){
                        $fp = fopen($tstampFile, 'r');
                        $tstamp = json_decode(fread($fp, filesize($tstampFile)));
                        fclose($fp);
                        if(is_numeric($tstamp)){
                            if(time()>$tstamp+60){
                                cg_actualize_all_images_data_info_file($galeryID);
                            }
                        }else{// then string was put in old versions before in 109900 or so, have to be checked
                            cg_actualize_all_images_data_info_file($galeryID);
                        }
                    }
                }
            }

        }

    }

    // if users were deleted
    if(file_exists($wp_upload_dir['basedir'] . "/contest-gallery/gallery-id-".$galeryID."/json/".$galeryID."-deleted-image-ids.json")){
        cg_actualize_all_images_data_deleted_images($galeryID);
    }

    $jsonImagesCount = count($jsonImages);

    $jsonGalleryTstampFile = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-gallery-tstamp.json';

    if(!file_exists($jsonGalleryTstampFile)){
        $fp = fopen($jsonGalleryTstampFile, 'w');
        fwrite($fp,json_encode(time()));
        fclose($fp);
    }

    $jsonCategories = array();

    $jsonCategoriesFile = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-categories.json';
    if(file_exists($jsonCategoriesFile)){
        $fp = fopen($jsonCategoriesFile, 'r');
        $jsonCategories = json_decode(fread($fp,filesize($jsonCategoriesFile)),true);
        fclose($fp);
    }

    $userIP = cg_get_user_ip();
    $userIPtype = cg_get_user_ip_type();
    $userIPisPrivate = cg_check_if_ip_is_private($userIP);
    $userIPtypesArray = cg_available_ip_getter_types();

    if($is_user_logged_in){
        $wpUserId = get_current_user_id();
    }
    else{
        $wpUserId=0;
    }

    $wp_create_nonce = wp_create_nonce("check");

    $LooksCount = 0;
    if($options['general']['ThumbLook'] == 1){$LooksCount++;}
    if($options['general']['HeightLook'] == 1){$LooksCount++;}
    if($options['general']['RowLook'] == 1){$LooksCount++;}
    if($options['general']['SliderLook'] == 1){$LooksCount++;}
    if(empty($options['visual']['BlogLook'])){
        $options['visual']['BlogLook'] = 0;
    }
    if($options['visual']['BlogLook'] == 1){$LooksCount++;}

    if(empty($options['pro']['SlideTransition'])){
        $options['pro']['SlideTransition']='translateX';
    }

    $ShowCatsUnchecked = 0;
    if(!empty($options['pro']['ShowCatsUnchecked'])){
        $ShowCatsUnchecked = 1;
    }

    $check = wp_create_nonce("check");
    $p_cgal1ery_db_version = get_option( "p_cgal1ery_db_version" );
    $upload_folder = wp_upload_dir();
    $upload_folder_url = $upload_folder['baseurl']; // Pfad zum Bilderordner angeben

    $wpNickname = '';

    if($is_user_logged_in){$current_user = wp_get_current_user();$wpNickname = $current_user->display_name;}

    if(is_ssl()){
        if(strpos($upload_folder_url,'http://')===0){
            $upload_folder_url = str_replace( 'http://', 'https://', $upload_folder_url );
        }
    }
    else{
        if(strpos($upload_folder_url,'https://')===0){
            $upload_folder_url = str_replace( 'https://', 'http://', $upload_folder_url );
        }
    }


    if($options['general']['CheckLogin']==1 and ($options['general']['AllowRating']==1 or $options['general']['AllowRating']==2)){
        if($is_user_logged_in){$UserLoginCheck = 1;$current_user = wp_get_current_user();$wpNickname = $current_user->display_name;} // Allow only registered users to vote (Wordpress profile) wird dadurch aktiviert
        else{$UserLoginCheck=0;}//Allow only registered users to vote (Wordpress profile): wird dadurch deaktiviert
    }
    else{$UserLoginCheck=0;}


    $cgGalleryStyle = 'center-black';
    $cgCenterWhite = false;

    if(!empty($options['visual']['GalleryStyle'])){
        if($options['visual']['GalleryStyle']=='center-white'){
            $cgGalleryStyle='center-white';
            $cgCenterWhite=true;
        }
    }

    $galeryID = $galeryID;
    include(__DIR__ ."/../../check-language.php");
    include('data/variables-javascript.php');
    include('data/check-language-javascript.php');

    if(empty($options['general']['CheckIp']) && empty($options['general']['CheckLogin']) && empty($options['general']['CheckCookie'])){
        $options['general']['CheckIp']=1;
    }

    if($options['general']['AllowRating']==1) {
        if(empty($isOnlyGalleryNoVoting)){
            include ('data/rating/configuration-five-star.php');
        }
    }

    if($options['general']['AllowRating']==2) {
        if(empty($isOnlyGalleryNoVoting)){
            include('data/rating/configuration-one-star.php');
        }
    }

    if(!empty($isOnlyGalleryUser)) {

        include('data/user-image-ids.php');

    }

    $cgFeControlsStyle = 'cg_fe_controls_style_white';
    $cgFeControlsStyleHideBlackSites ='';
    $cgFeControlsStyleHideWhiteSites ='cg_hide';

    if(!empty($options['visual']['FeControlsStyle'])){
        if($options['visual']['FeControlsStyle']=='black'){
            $cgFeControlsStyle='cg_fe_controls_style_black';
            $cgFeControlsStyleHideBlackSites ='cg_hide';
            $cgFeControlsStyleHideWhiteSites ='';
        }
    }

    echo "<div id='mainCGdivContainer$galeryIDuser' class='mainCGdivContainer' data-cg-gid='$galeryIDuser'>";
    echo "<div id='mainCGdivHelperParent$galeryIDuser' class='mainCGdivHelperParent $cgFeControlsStyle' data-cg-gid='$galeryIDuser'>";
    echo "<div id='cgLdsDualRingDivGalleryHide$galeryIDuser' class='cg-lds-dual-ring-div-gallery-hide cg-lds-dual-ring-div-gallery-hide-parent cg_hide $cgFeControlsStyle'><div class='cg-lds-dual-ring-gallery-hide $cgFeControlsStyle'></div></div>";
    echo "<div id='mainCGdiv$galeryIDuser' class='mainCGdiv cg_hide' style='display:none;' data-cg-gid='$galeryIDuser'>";

    if(is_user_logged_in()){
        if(current_user_can('manage_options')){

            $galleryJsonCommentsDir = $wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend';

            if (!is_dir($galleryJsonCommentsDir)) {
                mkdir($galleryJsonCommentsDir, 0755, true);
            }

            ###NORMAL###
            $cgPro = false;

            $arrayNew = array(
                '824f6b8e4d606614588aa97eb8860b7e',
                'add4012c56f21126ba5a58c9d3cffcd7',
                'bfc5247f508f427b8099d17281ecd0f6',
                'a29de784fb7699c11bf21e901be66f4e',
                'e5a8cb2f536861778aaa2f5064579e29',
                '36d317c7fef770852b4ccf420855b07b'
            );

            if(file_exists($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend/pro-check.txt')){
                $cgPro = file_get_contents($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend/pro-check.txt');
                if($cgPro=='true'){
                    include('normal/download-proper-pro-version-info-frontend-area.php');
                }
            }else if(!file_exists($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend/pro-check.txt')){// if not exists, then one check and create file

                // Check start from here:
                $p_cgal1ery_reg_code = get_option("p_cgal1ery_reg_code");
                $p_c1_k_g_r_8 = get_option("p_c1_k_g_r_9");
                if((!empty($p_cgal1ery_reg_code) AND $p_cgal1ery_reg_code!='1') OR (!empty($p_c1_k_g_r_8) AND $p_c1_k_g_r_8!='1')){
                    $cgPro = true;
                }

                if (!is_dir($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend')) {
                    mkdir($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend', 0755);
                }

                if($cgPro){
                    file_put_contents($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend/pro-check.txt','true');
                    include('normal/download-proper-pro-version-info-frontend-area.php');
                }else{
                    file_put_contents($wp_upload_dir['basedir'].'/contest-gallery/changes-messages-frontend/pro-check.txt','false');
                }
            }
            ###NORMAL-END###




            // general recognized file
            if(!file_exists($galleryJsonCommentsDir.'/cg-change-top-controls-style-option-recognized.txt')){
                if(!file_exists($wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/cg-change-top-controls-style-option-recognized.txt')){
                    echo "<div id='cgChangeTopControlsStyleOption$galeryIDuser' class='cgChangeTopControlsStyleOption $cgFeControlsStyle' data-cg-gid='$galeryIDuser' >";
                    echo "<input type='hidden' class='cgChangeTopControlsStyleOptionStartingStyle' value='$cgFeControlsStyle' />";
                    echo "<div class='cgChangeTopControlsStyleOptionClose' data-cg-gid='$galeryIDuser'></div>";
                    echo "<div class='cgChangeTopControlsStyleOptionMessage' data-cg-gid='$galeryIDuser'>";
                    echo "<div class='cgChangeTopControlsStyleText' ><strong>Contest Gallery information only visible for administrators:</strong></div>";
                    echo "<div class='cgChangeTopControlsStyleText'>You can switch between top controls styles</div>";
                    echo "<div class='cgChangeTopControlsStyleText'>Switch option can be found in \"Gallery view options\"</div>";
                    echo "<div class='cgChangeTopControlsStyleOptionTest cgChangeTopControlsStyleOptionTestBlackSites $cgFeControlsStyleHideBlackSites' data-cg-gid='$galeryIDuser'>Test dark sites style</div>";
                    echo "<div class='cgChangeTopControlsStyleOptionTest cgChangeTopControlsStyleOptionTestWhiteSites $cgFeControlsStyleHideWhiteSites' data-cg-gid='$galeryIDuser'>Test bright sites style</div>";
                    echo "<div class='cgChangeTopControlsStyleText' style='margin-top:20px;'><b>NEW!</b> You can now switch between dark and bright background style for image view</div>";
                    echo "<div class='cgChangeTopControlsStyleText'>Switch option can be found in \"Image view options\"</div>";
                    echo "<div class='cgChangeTopControlsStyleOptionTest cgChangeCenterToBlack $cgFeControlsStyleHideBlackSites' data-cg-gid='$galeryIDuser'>Test dark background style (open an image then)</div>";
                    echo "<div class='cgChangeTopControlsStyleOptionTest cgChangeCenterToWhite $cgFeControlsStyleHideWhiteSites' data-cg-gid='$galeryIDuser'>Test bright background style (open an image then)</div>";
                    //echo "<div>(dark style is old style, bright style is new one)</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }

        }
    }

    echo "<div id='mainCGdivHelperChild$galeryIDuser' class='mainCGdivHelperChild' data-cg-gid='$galeryIDuser'>";

    echo "<div id='mainCGdivFullWindowConfigurationArea$galeryIDuser' class='mainCGdivFullWindowConfigurationArea cg-header-controls-show-only-full-window cg_hide $cgFeControlsStyle' data-cg-gid='$galeryIDuser'>";
    echo "<div class='mainCGdivFullWindowConfigurationAreaCloseButtonContainer'><div class='mainCGdivFullWindowConfigurationAreaCloseButton'></div></div>";
    echo "</div>";

    echo "<span id='cgViewHelper$galeryIDuser' class='cg_view_helper'></span>";

    echo "<input type='hidden' id='cg_language_i_am_not_a_robot' value='$language_IamNotArobot' >";

    echo "<div id='cg_ThePhotoContestIsOver_dialog' style='display:none;' class='cg_show_dialog'><p>$language_ThePhotoContestIsOver</p></div>";
    echo "<div id='cg_AlreadyRated_dialog' style='display:none;' class='cg_show_dialog'><p>$language_YouHaveAlreadyVotedThisPicture</p></div>";
    echo "<div id='cg_AllVotesUsed_dialog' style='display:none;' class='cg_show_dialog'><p>$language_AllVotesUsed</p></div>";

    //include('gallery/comment-div.php');
    //include('gallery/slider-div.php');

    echo "<div class='cg_header'>";

    include('gallery/header.php');

    echo "</div>";
    echo "</div>";// Closing mainCGdivHelperChild

    include('gallery/further-images-steps-container.php');

    echo '<div class="cg-lds-dual-ring-div '.$cgFeControlsStyle.' cg_hide"><div class="cg-lds-dual-ring"></div></div>';
    echo "<div id='cgLdsDualRingMainCGdivHide$galeryIDuser' class='cg-lds-dual-ring-div-gallery-hide cg-lds-dual-ring-div-gallery-hide-mainCGallery $cgFeControlsStyle cg_hide'><div class='cg-lds-dual-ring-gallery-hide $cgFeControlsStyle cg-lds-dual-ring-gallery-hide-mainCGallery'></div></div>";

    include('gallery/cg-messages.php');

    echo "<div id='mainCGallery$galeryIDuser' data-cg-gid='$galeryIDuser' class='mainCGallery' >";
        echo "<div id='mainCGslider$galeryIDuser' data-cg-gid='$galeryIDuser' class='mainCGslider cg_hide cgCenterDivBackgroundColor' >";
        echo "</div>";
        include('gallery/inside-gallery-single-image-view.php');
        echo "<div id='cgLdsDualRingCGcenterDivHide$galeryIDuser' class='cg-lds-dual-ring-div-gallery-hide $cgFeControlsStyle cg-lds-dual-ring-div-gallery-hide-cgCenterDiv cg_hide'><div class='cg-lds-dual-ring-gallery-hide $cgFeControlsStyle cg-lds-dual-ring-gallery-hide-cgCenterDiv'></div></div>";
    echo "</div>";
    echo "<div id='cgLdsDualRingCGcenterDivLazyLoader$galeryIDuser' class='cg-lds-dual-ring-div-gallery-hide cg-lds-dual-ring-div-gallery-hide-mainCGallery $cgFeControlsStyle cg_hide'><div class='cg-lds-dual-ring-gallery-hide $cgFeControlsStyle cg-lds-dual-ring-gallery-hide-mainCGallery'></div></div>";
    echo "</div>";
    echo "<div id='cgCenterDivAppearenceHelper$galeryIDuser' class='cgCenterDivAppearenceHelper'>
    </div>";



    echo "</div>";


    echo "<noscript>";

    echo "<div id='mainCGdivNoScriptContainer$galeryIDuser' class='mainCGdivNoScriptContainer' data-cg-gid='$galeryIDuser'>";

    if(file_exists($upload_folder["basedir"].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-noscript.html')){
        include($upload_folder["basedir"].'/contest-gallery/gallery-id-'.$galeryID.'/json/'.$galeryID.'-noscript.html');
    }

    echo "</div>";

    echo "</noscript>";


    echo "</div>";

//include('gallery/further-images-steps-container.html');

}else{

    echo "<div id='cgRegUserGalleryOnly$galeryIDuser' class='cgRegUserGalleryOnly' data-cg-gid='$galeryIDuser'>";

        echo contest_gal1ery_convert_for_html_output($options['pro']['RegUserGalleryOnlyText']);

    echo "</div>";

}



?>