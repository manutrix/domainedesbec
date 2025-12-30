<?php

    $thumbnail_size_w = get_option("thumbnail_size_w");
    $medium_size_w = get_option("medium_size_w");
    $large_size_w = get_option("large_size_w");

    $valueCollect = array();

    $jsonOptions = array();
    $jsonOptions['visual'] = array();
    $jsonOptions['general'] = array();
    $jsonOptions['input'] = array();
    $jsonOptions['pro'] = array();

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        $valueCollect[$key] = $value;
        $jsonOptions['general'][$key] = $value;

    }

    if (!empty($valueCollect['GalleryName'])) {
        $valueCollect['GalleryName'] = $valueCollect['GalleryName'] . ' - COPY';
    }
    if (!empty($valueCollect['FbLikeGoToGalleryLink'])) {
        $FbLikeGoToGalleryLink = $valueCollect['FbLikeGoToGalleryLink'];
    }

    $galleryDBversion = cg_get_db_version();
    $valueCollect['Version'] = $galleryDBversion;
    $jsonOptions['general']['Version'] = $valueCollect['Version'];

    // V10 adaption
    if ($cgVersion < 10) {

        $valueCollect['AllowGalleryScript'] = 1;
        $valueCollect['FullSize'] = 0;
        $valueCollect['FullSizeGallery'] = 1;
        $valueCollect['FullSizeImageOutGallery'] = 0;
        $valueCollect['OnlyGalleryView'] = 0;
        $valueCollect['RandomSortButton'] = 1;
        $valueCollect['FbLikeGoToGalleryLink'] = '';
        $valueCollect['CheckIp'] = ($valueCollect['CheckLogin'] == 1) ? 0 : 1;
        $valueCollect['CheckCookie'] = 0;
        $valueCollect['CheckCookieAlertMessage'] = 'Please allow cookies to vote';
        $valueCollect['SliderLook'] = 1;

        $jsonOptions['general']['AllowGalleryScript'] = $valueCollect['AllowGalleryScript'];
        $jsonOptions['general']['FullSize'] = $valueCollect['FullSize'];
        $jsonOptions['general']['FullSizeGallery'] = $valueCollect['FullSizeGallery'];
        $jsonOptions['general']['FullSizeImageOutGallery'] = $valueCollect['FullSizeImageOutGallery'];
        $jsonOptions['general']['OnlyGalleryView'] = $valueCollect['OnlyGalleryView'];
        $jsonOptions['general']['RandomSortButton'] = $valueCollect['RandomSortButton'];
        $jsonOptions['general']['FbLikeGoToGalleryLink'] = $valueCollect['FbLikeGoToGalleryLink'];
        $jsonOptions['general']['CheckIp'] = $valueCollect['CheckIp'];
        $jsonOptions['general']['CheckCookie'] = $valueCollect['CheckCookie'];
        $jsonOptions['general']['SliderLook'] = 1;
        $jsonOptions['general']['ContestStart'] = 0;
        $jsonOptions['general']['ContestStartTime'] = '';

    }

    // falls was schief gelaufen ist
    if((empty($valueCollect['HeightLook']) && empty($valueCollect['ThumbLook']) && empty($valueCollect['RowLook']) && empty($valueCollect['SliderLook']))
    OR $cgVersion < 10
    ){

        $valueCollect['SliderLook'] = 1;
        $valueCollect['HeightLook'] = 1;
        $valueCollect['ThumbLook'] = 1;
        $valueCollect['RowLook'] = 1;

        $jsonOptions['general']['HeightLook'] = $valueCollect['HeightLook'];
        $jsonOptions['general']['ThumbLook'] = $valueCollect['ThumbLook'];
        $jsonOptions['general']['RowLook'] = $valueCollect['RowLook'];
        $jsonOptions['general']['SliderLook'] = $valueCollect['SliderLook'];

        $valueCollect['HeightLookOrder'] = 1;
        $valueCollect['ThumbLookOrder'] = 2;
        $valueCollect['RowLookOrder'] = 3;
        $valueCollect['SliderLookOrder'] = 4;

        $jsonOptions['general']['HeightLookOrder'] = $valueCollect['HeightLookOrder'];
        $jsonOptions['general']['ThumbLookOrder'] = $valueCollect['ThumbLookOrder'];
        $jsonOptions['general']['RowLookOrder'] = $valueCollect['RowLookOrder'];
        $jsonOptions['general']['SliderLookOrder'] = $valueCollect['SliderLookOrder'];

    }


###NORMAL###
if(empty($cgPro)){
    $jsonOptions['general']['IpBlock'] = 0;
    $valueCollect['IpBlock'] = 0;
}
###NORMAL-END###

    // !IMPORTANT: The last %s is RegistryUserRole
    $wpdb->insert(
        $tablenameOptions,
        $valueCollect,
        array(
            '%s', '%s', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d',
            '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%d',
            '%d', '%d', '%s', '%d', '%d', '%s', '%d', '%s'
        )
    );

    // get the latest id of copied gallery
    $nextIDgallery = $wpdb->get_var("SELECT MAX(id) FROM $tablenameOptions");

    // Erschaffen eines Galerieordners

    $galleryUpload = $uploadFolder['basedir'] . '/contest-gallery/gallery-id-' . $nextIDgallery . '';
    $galleryJsonFolder = $uploadFolder['basedir'] . '/contest-gallery/gallery-id-' . $nextIDgallery . '/json';
    $galleryJsonImagesFolder = $uploadFolder['basedir'] . '/contest-gallery/gallery-id-' . $nextIDgallery . '/json/image-data';
    $galleryJsonInfoDir = $uploadFolder['basedir'] . '/contest-gallery/gallery-id-' . $nextIDgallery . '/json/image-info';
    $galleryJsonCommentsDir = $uploadFolder['basedir'] . '/contest-gallery/gallery-id-' . $nextIDgallery . '/json/image-comments';

    if (!is_dir($galleryUpload)) {
        mkdir($galleryUpload, 0755, true);
    }

    if (!is_dir($galleryJsonFolder)) {
        mkdir($galleryJsonFolder, 0755, true);
    }

    if (!is_dir($galleryJsonImagesFolder)) {
        mkdir($galleryJsonImagesFolder, 0755);
    }

    if (!is_dir($galleryJsonInfoDir)) {
        mkdir($galleryJsonInfoDir, 0755);
    }

    if (!is_dir($galleryJsonCommentsDir)) {
        mkdir($galleryJsonCommentsDir, 0755);
    }

    $galleryJsonFolderReadMeFile = $galleryJsonFolder . '/do not remove json or txt files manually.txt';

    $fp = fopen($galleryJsonFolderReadMeFile, 'w');
    fwrite($fp, 'Removing json or txt files manually will break functionality of your gallery');
    fclose($fp);

    $fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-categories.json', 'w');
    fwrite($fp, json_encode(array()));
    fclose($fp);

    $fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-form-upload.json', 'w');
    fwrite($fp, json_encode(array()));
    fclose($fp);

    $fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-images.json', 'w');
    fwrite($fp, json_encode(array()));
    fclose($fp);

    $fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-single-view-order.json', 'w');
    fwrite($fp, json_encode(array()));
    fclose($fp);


    // Gleich auf die Version ab der mit der neuen Art des Hinzufügens von Images updaten
    $wpdb->update(
        "$tablenameOptions",
        array('Version' => $valueCollect['Version']),
        array('id' => $nextIDgallery),
        array('%s'),
        array('%d')
    );

    // Create f_input

    $galleryToCopy = $wpdb->get_results("SELECT * FROM $tablename_form_input WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    $collectInputIdsArray = array();

    foreach ($galleryToCopy as $key => $value) {

        foreach ($value as $key1 => $value1) {

            if ($key1 == 'id') {
                $lastInputIdOld = $value1;
                $value1 = '';
            }
            if ($key1 == 'GalleryID') {
                $value1 = $nextIDgallery;
            }
            if ($key1 == 'Field_Content') {
                $fieldContent = unserialize($value1);
            }
            $valueCollect[$key1] = $value1;

        }
        $wpdb->insert(
            $tablename_form_input,
            $valueCollect,
            array(
                '%s', '%d', '%s',
                '%d', '%s', '%d', '%d', '%d', '%s', '%s', '%s'
            )// last one is Version
        );

        $lastInputInfo = $wpdb->get_var("SELECT MAX(id) FROM $tablename_form_input");
        $lastInputId = $lastInputInfo;
        $collectInputIdsArray[$lastInputIdOld] = $lastInputId;

        $valueCollect = array();

    }

    do_action('cg_json_upload_form', $nextIDgallery);

    // Create Options Visual

    $galleryToCopy = $wpdb->get_row("SELECT * FROM $tablename_options_visual WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    $Field1IdGalleryView = 0;
    $Field2IdGalleryView = 0;

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        if ($key == 'GalleryID') {
            $value = $nextIDgallery;
        }
        if ($key == 'Field1IdGalleryView') {
            if(!empty($collectInputIdsArray[$value])){
                $value = $collectInputIdsArray[$value];
                $Field1IdGalleryView = $value;
            }else{
                $value = 0;
            }
        }
        if ($key == 'Field2IdGalleryView') {
            if(!empty($collectInputIdsArray[$value])){
                $value = $collectInputIdsArray[$value];
                $Field2IdGalleryView = $value;
            }else{
                $value = 0;
            }
        }
        if ($key == 'ThumbViewBorderRadius') {
            $value = 0;
        }
        if ($key == 'ThumbViewBorderOpacity') {
            $value = 1;
        }
        if ($key == 'HeightViewBorderRadius') {
            $value = 0;
        }
        if ($key == 'HeightViewBorderOpacity') {
            $value = 1;
        }
        if ($key == 'RowViewBorderRadius') {
            $value = 0;
        }
        if ($key == 'RowViewBorderOpacity') {
            $value = 1;
        }
        $valueCollect[$key] = $value;
        $jsonOptions['visual'][$key] = $value;

    }

    // v10 adaption
    if ($cgVersion < 10) {

        $valueCollect['OriginalSourceLinkInSlider'] = 1;
        $valueCollect['FeControlsStyle'] = 'white';
        $valueCollect['AllowSortOptions'] = 'date-desc,date-asc,rate-desc,rate-asc,rate-average-desc,rate-average-asc,comment-desc,comment-asc,random';
        $valueCollect['GalleryStyle'] = 'center-white';
        $valueCollect['BlogLook'] = 1;
        $valueCollect['BlogLookOrder'] = 5;
        $valueCollect['BlogLookFullWindow'] = 0;
        $valueCollect['ImageViewFullWindow'] = 1;
        $valueCollect['ImageViewFullScreen'] = 1;
        $valueCollect['SliderThumbNav'] = 1;
        $valueCollect['BorderRadius'] = 1;

        $jsonOptions['visual']['OriginalSourceLinkInSlider'] = $valueCollect['OriginalSourceLinkInSlider'];
        $jsonOptions['visual']['FeControlsStyle'] = $valueCollect['FeControlsStyle'];
        $jsonOptions['visual']['AllowSortOptions'] = $valueCollect['AllowSortOptions'];
        $jsonOptions['visual']['BlogLook'] = $valueCollect['BlogLook'];
        $jsonOptions['visual']['BlogLookOrder'] = $valueCollect['BlogLookOrder'];
        $jsonOptions['visual']['BlogLookFullWindow'] = $valueCollect['BlogLookFullWindow'];
        $jsonOptions['visual']['ImageViewFullWindow'] = $valueCollect['ImageViewFullWindow'];
        $jsonOptions['visual']['ImageViewFullScreen'] = $valueCollect['ImageViewFullScreen'];
        $jsonOptions['visual']['SliderThumbNav'] = $valueCollect['SliderThumbNav'];
        $jsonOptions['visual']['BorderRadius'] = $valueCollect['BorderRadius'];

    }

    // copy all as %s string here
    $wpdb->insert(
        $tablename_options_visual,
        $valueCollect,
        array(
            '%s', '%s', '%s', '%s',
            '%s', '%s', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s',
            '%s', '%s', '%s',
            '%s', '%s',
            '%s', '%s'  // copy all as %s string here
        )// BorderRadius is last one
    );

    // Create Options Input

    $galleryToCopy = $wpdb->get_row("SELECT * FROM $tablename_options_input WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        if ($key == 'GalleryID') {
            $value = $nextIDgallery;
        }
        $valueCollect[$key] = $value;
        $jsonOptions['input'][$key] = $value;

    }

    $wpdb->insert(
        $tablename_options_input,
        $valueCollect,
        array(
            '%s', '%d', '%d',
            '%s', '%s', '%d'
        )// ShowFormAfterUpload is last
    );

    // Create email user

    $galleryToCopy = $wpdb->get_row("SELECT * FROM $tablenameMail WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        if ($key == 'GalleryID') {
            $value = $nextIDgallery;
        }
        $valueCollect[$key] = $value;

    }


    $wpdb->insert(
        $tablenameMail,
        $valueCollect,
        array(
            '%s', '%d', '%s',
            '%s', '%s', '%s',
            '%s', '%s', '%s'
        )
    );


    // Create email admin

    $galleryToCopy = $wpdb->get_row("SELECT * FROM $tablename_email_admin WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        if ($key == 'GalleryID') {
            $value = $nextIDgallery;
        }
        $valueCollect[$key] = $value;

    }


    $wpdb->insert(
        $tablename_email_admin,
        $valueCollect,
        array(
            '%s', '%d', '%s', '%s',
            '%s', '%s', '%s',
            '%s', '%s', '%s'
        )
    );

    // Create email gallery


    // Create confirmation email

    $galleryToCopy = $wpdb->get_row("SELECT * FROM $tablename_mail_confirmation WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        if ($key == 'GalleryID') {
            $value = $nextIDgallery;
        }
        $valueCollect[$key] = $value;

    }


    $wpdb->insert(
        $tablename_mail_confirmation,
        $valueCollect,
        array(
            '%s', '%d', '%s',
            '%s', '%s', '%s',
            '%s', '%s', '%s',
            '%s'
        )
    );


    // Create categories

    if ($cgVersion >= 0) {

        $galleryCategoriesToCopy = $wpdb->get_results("SELECT * FROM $tablenameCategories WHERE GalleryID = '$idToCopy' ");

        if (!empty($galleryCategoriesToCopy)) {

            $valueCollect = array();
            $categoriesJson = array();
            $collectCatIdsArray = array();

            foreach ($galleryCategoriesToCopy as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if ($key1 == 'id') {
                        //$collectCatIdsArray[$value1] = 0;// pauschal erstmal null setzen
                        $catIdOld = $value1;
                        $value1 = '';
                    }
                    if ($key1 == 'GalleryID') {
                        $value1 = $nextIDgallery;
                    }
                    $valueCollect[$key1] = $value1;

                }

                $wpdb->insert(
                    $tablenameCategories,
                    $valueCollect,
                    array(
                        '%s', '%d', '%s',
                        '%d', '%s', '%d', '%d'
                    )
                );

                $lastCategoryId = $wpdb->get_var("SELECT MAX(id) FROM $tablenameCategories");
                $collectCatIdsArray[$catIdOld] = $lastCategoryId;

/*                $lastCategoryInfo = $wpdb->get_var("SELECT MAX(id) FROM $tablenameCategories");
                $lastCategoryId = $lastCategoryInfo;
                $collectCatIdsArray[$catIdOld] = $lastCategoryId;
                $valueCollect['id'] = $lastCategoryId;
                $categoriesJson[] = $valueCollect;

                $valueCollect = array();*/

            }


            $galleryCategoriesCopied = $wpdb->get_results("SELECT * FROM $tablenameCategories WHERE GalleryID = '$nextIDgallery' ");

            $categoriesJson = array();

            if(!empty($galleryCategoriesCopied)){

                foreach ($galleryCategoriesCopied as $key => $value) {

                    $categoriesJson[$value->id] = array();
                    $categoriesJson[$value->id]['id'] = $value->id;
                    $categoriesJson[$value->id]['GalleryID'] = $value->GalleryID;
                    $categoriesJson[$value->id]['Name'] = $value->Name;
                    $categoriesJson[$value->id]['Field_Order'] = $value->Field_Order;
                    $categoriesJson[$value->id]['Active'] = $value->Active;

                }

                $jsonFile = $uploadFolder['basedir'] . '/contest-gallery/gallery-id-' . $nextIDgallery . '/json/' . $nextIDgallery . '-categories.json';
                $fp = fopen($jsonFile, 'w');
                fwrite($fp, json_encode($categoriesJson));
                fclose($fp);

            }


        }

    }


// Create Pro Options

    $galleryToCopy = $wpdb->get_row("SELECT * FROM $tablename_pro_options WHERE GalleryID = '$idToCopy' ");

    $valueCollect = array();

    foreach ($galleryToCopy as $key => $value) {

        if ($key == 'id') {
            $value = '';
        }
        if ($key == 'GalleryID') {
            $value = $nextIDgallery;
        }
        $valueCollect[$key] = $value;
        $jsonOptions['pro'][$key] = $value;

    }

// v10 adaption
    if ($cgVersion < 10) {
        $valueCollect['Search'] = 1;
        $valueCollect['GalleryUpload'] = 1;
        $valueCollect['MinusVote'] = 0;
        $valueCollect['SlideTransition'] = 'translateX';

        $valueCollect['HideRegFormAfterLogin'] = 0;
        $valueCollect['HideRegFormAfterLoginShowTextInstead'] = 0;
        $valueCollect['HideRegFormAfterLoginTextToShow'] = '';


        $GalleryUploadTextBefore = "<h2>Welcome to the photo contest</h2><p>Upload your image to be a part of the photo contest</p>";
        $GalleryUploadTextBefore = htmlentities($GalleryUploadTextBefore, ENT_QUOTES, 'UTF-8');
        $valueCollect['GalleryUploadTextBefore'] = $GalleryUploadTextBefore;
        $valueCollect['GalleryUploadTextAfter'] = '';

        $confirmationText = '<p>Your picture upload was successful<br><br><br><b>Note for first time Contest Gallery user:</b>
<br/>This text can be configurated in "Edit options" > "Upload options" > "In gallery upload form configuration"<br>
"Automatically activate users images after frontend upload" can be activated/deactivated in "Edit options" >>> "Upload options"
</p>';
        $confirmationText = htmlentities($confirmationText, ENT_QUOTES, 'UTF-8');
        $valueCollect['GalleryUploadConfirmationText'] = $confirmationText;

        $jsonOptions['pro']['GalleryUploadTextBefore'] = $GalleryUploadTextBefore;
        $jsonOptions['pro']['GalleryUploadTextAfter'] = '';
        $jsonOptions['pro']['GalleryUploadConfirmationText'] = $confirmationText;

        $VotesInTime = 0;
        $VotesInTimeQuantity = 1;
        $VotesInTimeIntervalReadable = '24:00';
        $VotesInTimeIntervalSeconds = 86400;
        $VotesInTimeIntervalAlertMessage = "You can vote only 1 time per day";

        $jsonOptions['pro']['VotesInTime'] = $VotesInTime;
        $jsonOptions['pro']['VotesInTimeQuantity'] = $VotesInTimeQuantity;
        $jsonOptions['pro']['VotesInTimeIntervalReadable'] = $VotesInTimeIntervalReadable;
        $jsonOptions['pro']['VotesInTimeIntervalSeconds'] = $VotesInTimeIntervalSeconds;
        $jsonOptions['pro']['VotesInTimeIntervalAlertMessage'] = $VotesInTimeIntervalAlertMessage;

        $jsonOptions['pro']['HideRegFormAfterLogin'] = $valueCollect['HideRegFormAfterLogin'];
        $jsonOptions['pro']['HideRegFormAfterLoginShowTextInstead'] = $valueCollect['HideRegFormAfterLoginShowTextInstead'];
        $jsonOptions['pro']['HideRegFormAfterLoginTextToShow'] = $valueCollect['HideRegFormAfterLoginTextToShow'];

        $jsonOptions['pro']['SliderFullWindow'] = 0;

        $ShowExif = 0;

        if(function_exists('exif_read_data')){
            $jsonOptions['pro']['ShowExif'] = 1;
        }

        $jsonOptions['pro']['RegUserGalleryOnly'] = 0;
        $jsonOptions['pro']['RegUserGalleryOnlyText'] = '';

        $jsonOptions['pro']['RegUserMaxUpload'] = 0;
        $jsonOptions['pro']['IsModernFiveStar'] = 0;// old created galleries have to be additionally converted to get modern five star

        $jsonOptions['pro']['GalleryUploadOnlyUser'] = 0;

        $jsonOptions['pro']['FbLikeNoShare'] = 0;
        $jsonOptions['pro']['FbLikeOnlyShare'] = 0;
        $jsonOptions['pro']['VoteNotOwnImage'] = 0;
        $jsonOptions['pro']['PreselectSort'] = '';
        $jsonOptions['pro']['UploadRequiresCookieMessage'] = 'Please allow cookies to upload';
        $jsonOptions['pro']['ShowCatsUnchecked'] = 1;
        $jsonOptions['pro']['RegMailOptional'] = 0;

        $jsonOptions['pro']['CustomImageName'] = 0;
        $jsonOptions['pro']['CustomImageNamePath'] = '';

        $jsonOptions['pro']['DeleteFromStorageIfDeletedInFrontend'] = 0;
        $jsonOptions['pro']['VotePerCategory'] = 0;
        $jsonOptions['pro']['VotesPerCategory'] = 0;

    }

    $wpdb->insert(
        $tablename_pro_options,
        $valueCollect,
        array(
            '%s', '%d', '%s', '%s',
            '%d', '%s',
            '%d', '%s',
            '%s', '%s',
            '%s', '%s', '%s', '%d', '%s',
            '%d', '%d', '%d', '%d',
            '%d', '%s', '%s', '%s', '%d', '%d', '%s',
            '%d', '%d', '%s', '%d', '%s', '%d', '%d',
            '%d', '%d', '%s',
            '%d', '%s', '%d', '%d',
            '%d', '%d', '%d', '%s',
            '%s', '%d', '%d',
            '%d', '%s', '%d',
            '%d', '%d', '%d'
        )// VotesPerCategory was last one
    );

    $shortcodeSpecificToSetArray = include(__DIR__.'/../../vars/general/short-code-specific-to-set-array.php');

    $jsonOptionsGalleryPrev = $wp_upload_dir['basedir'].'/contest-gallery/gallery-id-'.$idToCopy.'/json/'.$idToCopy.'-options.json';
    if(file_exists($jsonOptionsGalleryPrev)){

        $fp = fopen($jsonOptionsGalleryPrev, 'r');
        $jsonOptionsPrev = json_decode(fread($fp, filesize($jsonOptionsGalleryPrev)),true);
        fclose($fp);

        // only then shortcode specific options can be copied
        if(!empty($jsonOptionsPrev[$idToCopy])){
/*
            echo "<pre>";
            print_r($jsonOptionsPrev);
            echo "</pre>";*/

            // this is only for example, to show that old options will be copied in old way also and still available if user want to switch to old version
            // added in 10990, do not remove in the moment! It is for fallback!
            // If somebody save the options and then switch back to older version, he will still be able to use gallery in frontend
            $jsonOptions = $jsonOptions;

            if(!empty($jsonOptionsPrev[$idToCopy])){
                if(!empty($jsonOptionsPrev[$idToCopy]['general'])){
                    $jsonOptionsPrev[$idToCopy]['general']['Version'] = $galleryDBversion;// update db version here additionally requires
                }
            }
            if(!empty($jsonOptionsPrev[$idToCopy.'-u'])){
                if(!empty($jsonOptionsPrev[$idToCopy.'-u']['general'])){
                    $jsonOptionsPrev[$idToCopy.'-u']['general']['Version'] = $galleryDBversion;// update db version here additionally requires
                }
            }
            if(!empty($jsonOptionsPrev[$idToCopy.'-nv'])){
                if(!empty($jsonOptionsPrev[$idToCopy.'-nv']['general'])){
                    $jsonOptionsPrev[$idToCopy.'-nv']['general']['Version'] = $galleryDBversion;// update db version here additionally requires
                }
            }
            if(!empty($jsonOptionsPrev[$idToCopy.'-w'])){
                if(!empty($jsonOptionsPrev[$idToCopy.'-w']['general'])){
                    $jsonOptionsPrev[$idToCopy.'-w']['general']['Version'] = $galleryDBversion;// update db version here additionally requires
                }
            }

            $jsonOptions[$nextIDgallery] = $jsonOptionsPrev[$idToCopy];
            $jsonOptions[$nextIDgallery.'-u'] = $jsonOptionsPrev[$idToCopy.'-u'];
            $jsonOptions[$nextIDgallery.'-nv'] = $jsonOptionsPrev[$idToCopy.'-nv'];
            $jsonOptions[$nextIDgallery.'-w'] = $jsonOptionsPrev[$idToCopy.'-w'];
            if(!empty($Field1IdGalleryView)){
                $jsonOptions[$nextIDgallery]['visual']['Field1IdGalleryView'] = $Field1IdGalleryView;
                $jsonOptions[$nextIDgallery.'-u']['visual']['Field1IdGalleryView'] = $Field1IdGalleryView;
                $jsonOptions[$nextIDgallery.'-nv']['visual']['Field1IdGalleryView'] = $Field1IdGalleryView;
                $jsonOptions[$nextIDgallery.'-w']['visual']['Field1IdGalleryView'] = $Field1IdGalleryView;
            }
            if(!empty($Field2IdGalleryView)){
                $jsonOptions[$nextIDgallery]['visual']['Field2IdGalleryView'] = $Field2IdGalleryView;
                $jsonOptions[$nextIDgallery.'-u']['visual']['Field2IdGalleryView'] = $Field2IdGalleryView;
                $jsonOptions[$nextIDgallery.'-nv']['visual']['Field2IdGalleryView'] = $Field2IdGalleryView;
                $jsonOptions[$nextIDgallery.'-w']['visual']['Field2IdGalleryView'] = $Field2IdGalleryView;
            }

        }

        if(!empty($jsonOptionsPrev['icons'])){
            $jsonOptions['icons'] = $jsonOptionsPrev['icons'];
        }

    }

    $fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-options.json', 'w');
    fwrite($fp, json_encode($jsonOptions));
    fclose($fp);

// Create f_output

$galleryToCopy = $wpdb->get_results("SELECT * FROM $tablename_form_output WHERE GalleryID = '$idToCopy' ");

$valueCollect = array();

foreach ($galleryToCopy as $key => $value) {

    foreach ($value as $key1 => $value1) {

        if ($key1 == 'id') {
            $value1 = '';
        }
        if ($key1 == 'GalleryID') {
            $value1 = $nextIDgallery;
        }
        $valueCollect[$key1] = $value1;

    }
    $wpdb->insert(
        $tablename_form_output,
        $valueCollect,
        array(
            '%s', '%d', '%d',
            '%s', '%d', '%s'
        )
    );

    $valueCollect = array();

}

// Create create user form

$galleryToCopy = $wpdb->get_results("SELECT * FROM $tablename_create_user_form WHERE GalleryID = '$idToCopy' ");

$valueCollect = array();

foreach ($galleryToCopy as $key => $value) {

    foreach ($value as $key1 => $value1) {

        if ($key1 == 'id') {
            $value1 = '';
        }
        if ($key1 == 'GalleryID') {
            $value1 = $nextIDgallery;
        }
        $valueCollect[$key1] = $value1;

    }
//var_dump($valueCollect);
    $wpdb->insert(
        $tablename_create_user_form,
        $valueCollect,
        array(
            '%s', '%d', '%s', '%s',
            '%s', '%s', '%d', '%d',
            '%d', '%d', '%s', '%s'
        )
    );

    $valueCollect = array();

}


// write $collectInputIdsArray json for getting it later when processing images
$fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-collect-input-ids-array.json', 'w');
fwrite($fp, json_encode($collectInputIdsArray));
fclose($fp);

if(empty($collectCatIdsArray)){
    $collectCatIdsArray = array();
}

// write $collectCatIdsArray json for getting it later when processing images
$fp = fopen($galleryUpload . '/json/' . $nextIDgallery . '-collect-cat-ids-array.json', 'w');
fwrite($fp, json_encode($collectCatIdsArray));
fclose($fp);

$tstampJson = array();
$fp = fopen($galleryUpload.'/json/'.$nextIDgallery.'-gallery-tstamp.json', 'w');
fwrite($fp, json_encode(time()));
fclose($fp);

// copy translations
$translationsFileToCopy = $uploadFolder["basedir"]."/contest-gallery/gallery-id-$idToCopy/json/$idToCopy-translations.json";

$translations = array();

if(file_exists($translationsFileToCopy)){
    $fp = fopen($translationsFileToCopy, 'r');
    $translations = json_decode(fread($fp, filesize($translationsFileToCopy)),true);
}

$translationsFileNextGallery = $uploadFolder["basedir"]."/contest-gallery/gallery-id-$nextIDgallery/json/$nextIDgallery-translations.json";
$fp = fopen($translationsFileNextGallery, 'w');
fwrite($fp, json_encode($translations));
fclose($fp);


?>