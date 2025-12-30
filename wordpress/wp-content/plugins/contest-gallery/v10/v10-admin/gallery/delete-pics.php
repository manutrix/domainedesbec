<?php

if(!empty($_POST['cg_delete'])){

    $deletedWpUploads = array();

    $deletedWpUploads = cg_delete_images($GalleryID,$_POST['cg_delete'],$deletedWpUploads,false);

    if(!empty($deletedWpUploads)){
        cg_delete_images_of_deleted_wp_uploads($deletedWpUploads);
    }

}


?>