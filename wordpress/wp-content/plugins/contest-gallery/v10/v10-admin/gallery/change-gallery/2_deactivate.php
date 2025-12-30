<?php

if (!empty($_POST['cg_deactivate'])) {

    // erst mal alle deaktivieren, die deaktiviert gehören!!!

    $querySETrowDeactivate = 'UPDATE ' . $tablename . ' SET Active = CASE';
    $querySETaddRowDeactivate = ' ELSE Active END WHERE (id) IN (';

    foreach($_POST['cg_deactivate'] as $key => $value){

        $key = sanitize_text_field($key);

        $querySETrowDeactivate .= " WHEN (id = $key) THEN 0";
        $querySETaddRowDeactivate .= "($key), ";

        if(!empty($imageArray[$key])){
            unset($imageArray[$key]);
        }

        if(file_exists($wp_upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/image-data/image-data-".$key.".json")){
            unlink($wp_upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/image-data/image-data-".$key.".json");
        }
        if(file_exists($wp_upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/image-comments/image-comments-".$key.".json")){
            unlink($wp_upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/image-comments/image-comments-".$key.".json");
        }
        if(file_exists($wp_upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/image-info/image-info-".$key.".json")){
            unlink($wp_upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/image-info/image-info-".$key.".json");
        }

    }

    $querySETaddRowDeactivate = substr($querySETaddRowDeactivate,0,-2);
    $querySETaddRowDeactivate .= ")";

    $querySETrowDeactivate .= $querySETaddRowDeactivate;

    $wpdb->query($querySETrowDeactivate);

}


