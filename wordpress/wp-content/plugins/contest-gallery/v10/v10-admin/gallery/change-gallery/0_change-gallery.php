<?php

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

/*error_reporting(E_ALL); 
ini_set('display_errors', 'On');*/

/*echo "<pre>";
echo print_r($_POST);
echo "</pre>";*/

$start = 0; // Startwert setzen (0 = 1. Zeile)
$step = 10;

if (isset($_GET["start"])) {
    $muster = "/^[0-9]+$/"; // reg. Ausdruck f�r Zahlen
    if (preg_match($muster, @$_GET["start"]) == 0) {
        $start = 0; // Bei Manipulation R�ckfall auf 0
    } else {
        $start = intval(@$_GET["start"]);
    }
}

if (isset($_GET["step"])) {
    $muster = "/^[0-9]+$/"; // reg. Ausdruck f�r Zahlen
    if (preg_match($muster, @$_GET["start"]) == 0) {
        $step = 10; // Bei Manipulation R�ckfall auf 0
    } else {
        $step = intval(@$_GET["step"]);
    }
}

global $wpdb;

// Set table names
$tablename = $wpdb->prefix . "contest_gal1ery";
$table_posts = $wpdb->prefix . "posts";
$table_users = $wpdb->base_prefix . "users";
$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablenameentries = $wpdb->prefix . "contest_gal1ery_entries";
$tablename_categories = $wpdb->prefix . "contest_gal1ery_categories";
$tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";
$tablename_comments = $wpdb->prefix . "contest_gal1ery_comments";
$tablename_options_visual = $wpdb->prefix . "contest_gal1ery_options_visual";

$tablename_form_input = $wpdb->prefix . "contest_gal1ery_f_input";

// check which fileds are allowed for json save because allowed gallery or single view
$uploadFormFields = $wpdb->get_results("SELECT * FROM $tablename_form_input WHERE GalleryID = $GalleryID");
$Field1IdGalleryView = $wpdb->get_var("SELECT Field1IdGalleryView FROM $tablename_options_visual WHERE GalleryID = $GalleryID");

$fieldsForFrontendArray = array();

foreach ($uploadFormFields as $field) {
    if ($field->id == $Field1IdGalleryView or $field->Show_Slider == 1) {
        $fieldsForFrontendArray[] = $field->id;
    }
}

$fieldsForSaveContentArray = array();

foreach ($uploadFormFields as $field) {
    if (empty($fieldsForSaveContentArray[$field->id])) {
        $fieldsForSaveContentArray[$field->id] = array();
    }
    $fieldsForSaveContentArray[$field->id]['Field_Type'] = $field->Field_Type;
    $fieldsForSaveContentArray[$field->id]['Field_Order'] = $field->Field_Order;
    $fieldContent = unserialize($field->Field_Content);
    $fieldsForSaveContentArray[$field->id]['Field_Title'] = $fieldContent['titel'];
    if ($field->Field_Type == 'date-f') {
        $fieldsForSaveContentArray[$field->id]['Field_Format'] = $fieldContent['format'];
    }
}


$wpUsers = $wpdb->base_prefix . "users";

$imageInfoArray = array();

$wp_upload_dir = wp_upload_dir();

$jsonUpload = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $GalleryID . '/json';
$jsonUploadImageData = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $GalleryID . '/json/image-data';
$jsonUploadImageInfoDir = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $GalleryID . '/json/image-info';
$jsonUploadImageCommentsDir = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $GalleryID . '/json/image-comments';

$thumbSizesWp = array();
$thumbSizesWp['thumbnail_size_w'] = get_option("thumbnail_size_w");
$thumbSizesWp['medium_size_w'] = get_option("medium_size_w");
$thumbSizesWp['large_size_w'] = get_option("large_size_w");

$uploadFolder = wp_upload_dir();

// DELTE PICS FIRST

//echo "DELETE PICS!<br>";
include(__DIR__.'/../delete-pics.php');

$activate = '';
if (!empty($_POST['cg_activate'])) {
    $activate = $_POST['cg_activate'];
}else{
    $_POST['cg_activate'] = array();
}

if (empty($_POST['cg_deactivate'])) {
    $_POST['cg_deactivate'] = array();
}

if (!empty($_POST['cg_row'])) {
    $rowids = $_POST['cg_row'];
} else {
    $rowids = [];
}

$content = array();

if (!empty($_POST['content'])) {
    $content = $_POST['content'];
}else{
    $_POST['content'] = array();
}

if (empty($_POST['imageCategory'])) {
    $_POST['imageCategory'] = array();
}

// unset rowids if Deleted!!!!
if (!empty($_POST['cg_delete'])) {

    foreach ($_POST['cg_delete'] as $key => $value) {
        unset($rowids[$key]);
        unset($content[$key]);
        unset($_POST['imageCategory'][$key]);
        // activate or deactivate can't be send if delete is send! But unset to go sure :)
        unset($_POST['cg_activate'][$key]);
        unset($_POST['cg_deactivate'][$key]);

    }

}

if (!is_dir($jsonUpload)) {
    mkdir($jsonUpload, 0755, true);
}

if (!is_dir($jsonUploadImageData)) {
    mkdir($jsonUploadImageData, 0755, true);
}

if (!is_dir($jsonUploadImageInfoDir)) {
    mkdir($jsonUploadImageInfoDir, 0755, true);
}

if (!is_dir($jsonUploadImageCommentsDir)) {
    mkdir($jsonUploadImageCommentsDir, 0755, true);
}

$jsonFile = $wp_upload_dir['basedir'] . '/contest-gallery/gallery-id-' . $GalleryID . '/json/' . $GalleryID . '-images.json';
$fp = fopen($jsonFile, 'r');
$imageArray = json_decode(fread($fp, filesize($jsonFile)), true);
fclose($fp);

//print_r($_POST['imageCategory']);

if (!empty($_POST['imageCategory'])) {

    $querySETrowForCategoryIds = 'UPDATE ' . $tablename . ' SET Category = CASE id ';
    $querySETaddRowForCategoryIds = ' ELSE Category END WHERE id IN (';

    foreach ($_POST['imageCategory'] as $imageId => $categoryId) {

        if ($categoryId == 'off' && is_string($categoryId)) {
            continue;
        } else {

            $imageId = intval(sanitize_text_field($imageId));
            $categoryId = intval(sanitize_text_field($categoryId));

            $querySETrowForCategoryIds .= " WHEN $imageId THEN ".$categoryId."";
            $querySETaddRowForCategoryIds .= "$imageId,";

        }
    }

    $querySETaddRowForCategoryIds = substr($querySETaddRowForCategoryIds,0,-1);
    $querySETaddRowForCategoryIds .= ")";

    $querySETrowForCategoryIds .= $querySETaddRowForCategoryIds;
    $updateSQL = $wpdb->query($querySETrowForCategoryIds);

}


// DATEN L�schen und exit

/* Siehe Datei delete-pics.php
	// 2 = delete Pics
	if (@$_POST['chooseAction1']==2) {
	
	echo "TEST DELTE";
	
		$deleteQuery = 'DELETE FROM ' . $tablename . ' WHERE';
	
		$deleteParameters = '';

		/*
		foreach($activate as $key => $value){
	
		
					$deleteQuery .= ' id = "' . $value . '"';
					$deleteQuery .= ' or';
					
					$deleteParameters .= $value.",";
	
		} */

/*
foreach($activate as $key => $value){


            $deleteQuery .= ' id = %d';
            $deleteQuery .= ' or';

            $deleteParameters .= $value.",";

}

$deleteQuery = substr($deleteQuery,0,-3);
$deleteParameters = substr($deleteParameters,0,-1);


$wpdb->query( $wpdb->prepare(
    "
        $deleteQuery
    ",
        $deleteParameters
 ));

echo $deleteQuery;
echo "<br>";
echo $deleteParameters;

$imageUnlink = @$_POST['imageUnlink'];

foreach($imageUnlink as $key1 => $valueunlink){

@unlink("../wp-content/uploads/$valueunlink");

}

//$deleteQuery = substr($deleteQuery,0,-3);
//$deleteSQL = $wpdb->query($deleteQuery);


// Path to admin

$path = plugins_url();

$path .= "/contest-gallery/admin/certain-gallery.php";



}*/


// DATEN L�schen und exit ENDE	


/*
// Change Order Auswahl
if (@$_GET['dauswahl']==true) {

$dauswahl = (@$_POST['dauswahl']=='dab') ? 0 : 1;

$updateorder = "UPDATE $tablenameOptions SET OrderPics='$dauswahl' WHERE id = '$GalleryID' ";
$updateSQLorder = $wpdb->query($updateorder);	

}*/

// Change Order Auswahl --- ENDE
$galeryrow = $wpdb->get_row("SELECT * FROM $tablenameOptions WHERE id = '$GalleryID'");

$informORnot = $galeryrow->Inform;
//$AllowGalleryScript = $galeryrow->AllowGalleryScript;


// Update Inform

//$updateInformIds = '(';

// START QUERIES --- END

$tablenameemail = $wpdb->prefix . "contest_gal1ery_mail";
$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";
$contest_gal1ery_f_input = $wpdb->prefix . "contest_gal1ery_f_input";
$selectSQLemail = $wpdb->get_row("SELECT * FROM $tablenameemail WHERE GalleryID = '$GalleryID'");
$proOptions = $wpdb->get_row("SELECT * FROM $tablename_pro_options WHERE GalleryID = '$GalleryID'");
$Manipulate = $proOptions->Manipulate;
$FbLikeNoShare = $proOptions->FbLikeNoShare;
$DataShare = ($FbLikeNoShare == 1) ? 'true' : 'false';
$DataClass = ($proOptions->FbLikeOnlyShare==1) ? 'fb-share-button' : 'fb-like';
$DataLayout = ($proOptions->FbLikeOnlyShare==1) ? 'button' : 'button_count';

$Subject = contest_gal1ery_convert_for_html_output($selectSQLemail->Header);
$Admin = $selectSQLemail->Admin;
$Reply = $selectSQLemail->Reply;
$cc = $selectSQLemail->CC;
$bcc = $selectSQLemail->BCC;
$contentMail = contest_gal1ery_convert_for_html_output($selectSQLemail->Content);

$url = trim(sanitize_text_field($selectSQLemail->URL));
//	$url = (strpos($url,'?')) ? $url.'&' : $url.'?';

$posUrl = "\$url\$";

// echo $posUrl;

$urlCheck = (stripos($contentMail, $posUrl)) ? 1 : 0;

if (!empty($_POST['cg_winner'])) {

    $querySETrowWinner = 'UPDATE ' . $tablename . ' SET Winner = CASE';
    $querySETaddRowWinner = ' ELSE Winner END WHERE (id) IN (';

    foreach ($_POST['cg_winner'] as $key => $value) {

        $key = intval(sanitize_text_field($key));

        $querySETrowWinner .= " WHEN (id = $key) THEN 1";
        $querySETaddRowWinner .= "($key), ";

    }

    $querySETaddRowWinner = substr($querySETaddRowWinner, 0, -2);
    $querySETaddRowWinner .= ")";

    $querySETrowWinner .= $querySETaddRowWinner;

    $wpdb->query($querySETrowWinner);

}

if (!empty($_POST['cg_winner_not'])) {

    $querySETrowWinnerNot = 'UPDATE ' . $tablename . ' SET Winner = CASE';
    $querySETaddRowWinnerNot = ' ELSE Winner END WHERE (id) IN (';

    foreach ($_POST['cg_winner_not'] as $key => $value) {

        $key = intval(sanitize_text_field($key));

        $querySETrowWinnerNot .= " WHEN (id = $key) THEN 0";
        $querySETaddRowWinnerNot .= "($key), ";

    }

    $querySETaddRowWinnerNot = substr($querySETaddRowWinnerNot, 0, -2);
    $querySETaddRowWinnerNot .= ")";

    $querySETrowWinnerNot .= $querySETaddRowWinnerNot;

    $wpdb->query($querySETrowWinnerNot);

}

$_POST['addCountChange'] = array();


// Rating manipulieren hier

if ($Manipulate == 1) {

    if ($galeryrow->AllowRating == 2) {

        if (!empty($_POST['addCountS'])) {

            $querySETrowAddCount = 'UPDATE ' . $tablename . ' SET addCountS = CASE';
            $querySETaddRowAddCount = ' ELSE addCountS END WHERE (id) IN (';

            foreach ($_POST['addCountS'] as $key => $value) {

                $_POST['addCountChange'][$key] = $key;

                $key = intval(sanitize_text_field($key));
                $value = intval(sanitize_text_field($value));

                $querySETrowAddCount .= " WHEN (id = $key) THEN $value";
                $querySETaddRowAddCount .= "($key), ";

            }

            $querySETaddRowAddCount = substr($querySETaddRowAddCount, 0, -2);
            $querySETaddRowAddCount .= ")";

            $querySETrowAddCount .= $querySETaddRowAddCount;

            $wpdb->query($querySETrowAddCount);

        }
    }

    if ($galeryrow->AllowRating == 1) {

        if (!empty($_POST['addCountR1'])) {

            $querySETrowAddCount = 'UPDATE ' . $tablename . ' SET addCountR1 = CASE';
            $querySETaddRowAddCount = ' ELSE addCountR1 END WHERE (id) IN (';


            foreach ($_POST['addCountR1'] as $key => $value) {

                $_POST['addCountChange'][$key] = $key;

                $key = intval(sanitize_text_field($key));
                $value = intval(sanitize_text_field($value));

                $querySETrowAddCount .= " WHEN (id = $key) THEN $value";
                $querySETaddRowAddCount .= "($key), ";

            }

            $querySETaddRowAddCount = substr($querySETaddRowAddCount, 0, -2);
            $querySETaddRowAddCount .= ")";

            $querySETrowAddCount .= $querySETaddRowAddCount;

            $wpdb->query($querySETrowAddCount);

        }

        if (!empty($_POST['addCountR2'])) {

            $querySETrowAddCount = 'UPDATE ' . $tablename . ' SET addCountR2 = CASE';
            $querySETaddRowAddCount = ' ELSE addCountR2 END WHERE (id) IN (';

            foreach ($_POST['addCountR2'] as $key => $value) {

                $_POST['addCountChange'][$key] = $key;

                $key = intval(sanitize_text_field($key));
                $value = intval(sanitize_text_field($value));

                $querySETrowAddCount .= " WHEN (id = $key) THEN $value";
                $querySETaddRowAddCount .= "($key), ";

            }

            $querySETaddRowAddCount = substr($querySETaddRowAddCount, 0, -2);
            $querySETaddRowAddCount .= ")";

            $querySETrowAddCount .= $querySETaddRowAddCount;

            $wpdb->query($querySETrowAddCount);

        }
        if (!empty($_POST['addCountR3'])) {

            $querySETrowAddCount = 'UPDATE ' . $tablename . ' SET addCountR3 = CASE';
            $querySETaddRowAddCount = ' ELSE addCountR3 END WHERE (id) IN (';


            foreach ($_POST['addCountR3'] as $key => $value) {

                $_POST['addCountChange'][$key] = $key;

                $key = intval(sanitize_text_field($key));
                $value = intval(sanitize_text_field($value));

                $querySETrowAddCount .= " WHEN (id = $key) THEN $value";
                $querySETaddRowAddCount .= "($key), ";

            }

            $querySETaddRowAddCount = substr($querySETaddRowAddCount, 0, -2);
            $querySETaddRowAddCount .= ")";

            $querySETrowAddCount .= $querySETaddRowAddCount;

            $wpdb->query($querySETrowAddCount);

        }
        if (!empty($_POST['addCountR4'])) {

            $querySETrowAddCount = 'UPDATE ' . $tablename . ' SET addCountR4 = CASE';
            $querySETaddRowAddCount = ' ELSE addCountR4 END WHERE (id) IN (';

            foreach ($_POST['addCountR4'] as $key => $value) {

                $_POST['addCountChange'][$key] = $key;

                $key = intval(sanitize_text_field($key));
                $value = intval(sanitize_text_field($value));

                $querySETrowAddCount .= " WHEN (id = $key) THEN $value";
                $querySETaddRowAddCount .= "($key), ";

            }

            $querySETaddRowAddCount = substr($querySETaddRowAddCount, 0, -2);
            $querySETaddRowAddCount .= ")";

            $querySETrowAddCount .= $querySETaddRowAddCount;

            $wpdb->query($querySETrowAddCount);

        }
        if (!empty($_POST['addCountR5'])) {

            $querySETrowAddCount = 'UPDATE ' . $tablename . ' SET addCountR5 = CASE';
            $querySETaddRowAddCount = ' ELSE addCountR5 END WHERE (id) IN (';

            foreach ($_POST['addCountR5'] as $key => $value) {

                $_POST['addCountChange'][$key] = $key;

                $key = intval(sanitize_text_field($key));
                $value = intval(sanitize_text_field($value));

                $querySETrowAddCount .= " WHEN (id = $key) THEN $value";
                $querySETaddRowAddCount .= "($key), ";

            }

            $querySETaddRowAddCount = substr($querySETaddRowAddCount, 0, -2);
            $querySETaddRowAddCount .= ")";

            $querySETrowAddCount .= $querySETaddRowAddCount;

            $wpdb->query($querySETrowAddCount);

        }
    }
}

// Insert fields content

include('1_content.php');

// Insert fields content fb like

include('1_content-fb-like.php');

// Insert fields content --- END

// 	Bilder daktivieren
include('2_deactivate.php');

// Reinfolge Bilder ändern
include('3_row-order.php');

// 	Bilder aktivieren
include('4_activate.php');

// !IMPORTANT: have to be done before 5_create-no-script-html
include('5_set-image-array.php');

include('5_create-no-script-html.php');

// Reset informierte Felder

// Reset informierte Felder ---- END

// Inform Users if picture is activated per Mail
include('7_inform.php');

// Move to another gallery selected images to move
//include('8_move-to-another-gallery.php');

// Inform Users if picture is activated per Mail --- END

echo "<p id='cg_changes_saved' style='font-size:18px;'><strong>Changes saved</strong></p>";


// END QUERIES


//echo "<br/>";
//echo "Query Set:";
//echo $querySET;
//echo "<br/>";

//echo "<br/>";
//echo "Update Inform:";
//echo $updateInform;
//echo "<br/>";


//	echo "<br/>";
//echo "Change Row of pics:";
//echo $querySETrow;
//echo "<br/>";

// END QUERIES ENDE


?>