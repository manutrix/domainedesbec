<?php
if(!defined('ABSPATH')){exit;}

if(!is_user_logged_in()){
    ?>
    <script data-cg-processing="true">

        var message = <?php echo json_encode('Please do not manipulate image delete! (0)');?>;
        cgJsClass.gallery.function.message.show(message);

    </script>
    <?php

    return;
}
else{
    $wp_get_current_user = wp_get_current_user();
    $WpUserIdLoggedIn = $wp_get_current_user->data->ID;
}

$_REQUEST = cg1l_sanitize_post($_REQUEST);
$_POST = cg1l_sanitize_post($_POST);

$galeryID = intval(sanitize_text_field($_REQUEST['gid']));
$pictureID = intval(sanitize_text_field($_REQUEST['pid']));
$userId = intval(sanitize_text_field($_REQUEST['uid']));
$galeryIDuser = sanitize_text_field($_REQUEST['galeryIDuser']);
$galleryHash = sanitize_text_field($_REQUEST['galleryHash']);
$galleryHashDecoded = wp_salt( 'auth').'---cngl1---'.$galeryIDuser;
$galleryHashToCompare = cg_hash_function('---cngl1---'.$galeryIDuser, $galleryHash);

if($WpUserIdLoggedIn!=$userId){
    ?>
    <script data-cg-processing="true">

        var message = <?php echo json_encode('Please do not manipulate image delete! (1)');?>;
        cgJsClass.gallery.function.message.show(message);

    </script>
    <?php

    return;
}

if (!is_numeric($pictureID) or !is_numeric($galeryID) or !is_numeric($userId) or ($galleryHash != $galleryHashToCompare)){
    ?>
    <script data-cg-processing="true">

        var message = <?php echo json_encode('Please do not manipulate image delete! (2)');?>;
        cgJsClass.gallery.function.message.show(message);

    </script>
    <?php

    return;
}
else {

    $tablename = $wpdb->prefix ."contest_gal1ery";
    $tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";

    $isUserImage = $wpdb->get_var( $wpdb->prepare(
        "
        SELECT COUNT(*) AS UserImages
        FROM $tablename 
        WHERE id = %d and GalleryID = %d and WpUserId = %d and Active = %d
    ",
        $pictureID,$galeryID,$userId,1
    ) );

    if(empty($isUserImage)){

        ?>
        <script data-cg-processing="true">

            var message = <?php echo json_encode('Please do not manipulate image delete! (3)');?>;
            cgJsClass.gallery.function.message.show(message);

        </script>
        <?php

        return;

    }else{

        $valuesToDeleteArray = array($pictureID => $pictureID);

        $DeleteFromStorageIfDeletedInFrontend = $wpdb->get_var("SELECT DeleteFromStorageIfDeletedInFrontend FROM $tablename_pro_options WHERE GalleryID = '$galeryID'");

        if(!empty($DeleteFromStorageIfDeletedInFrontend)){
            $DeleteFromStorageIfDeletedInFrontend = true;
        }else{
            $DeleteFromStorageIfDeletedInFrontend = false;
        }

        $deletedWpUploads = array();
        $deletedWpUploads = cg_delete_images($galeryID,$valuesToDeleteArray,$deletedWpUploads,$DeleteFromStorageIfDeletedInFrontend);

        if(!empty($deletedWpUploads)){
            cg_delete_images_of_deleted_wp_uploads($deletedWpUploads);
        }

        ?>
        <script data-cg-processing="true">
            //  alert(1);
            var gid = <?php echo json_encode($galeryIDuser);?>;
            var realIdToDelete = <?php echo json_encode($pictureID);?>;

            cgJsClass.gallery.getJson.removeImageFromImageData(gid,realIdToDelete,true);

            cgJsClass.gallery.views.close(gid,true);

            cgJsClass.gallery.function.message.show(cgJsClass.gallery.language.DeleteImageConfirm);

        </script>
        <?php

    }

}

?>



