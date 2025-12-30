<?php

add_action('cg_edit_images','cg_edit_images');
if(!function_exists('cg_edit_images')){
    function cg_edit_images($GalleryID,$imageId,$imageDataArray,$isSetCategory){

        $upload_dir = wp_upload_dir();

        if($isSetCategory){

            $jsonFile = $upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/".$GalleryID."-images.json";
            $fp = fopen($jsonFile, 'r');
            $imagesArray = json_decode(fread($fp, filesize($jsonFile)),true);
            fclose($fp);

            $imagesArray[$imageId] = $imageDataArray;

            $jsonFile = $upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/".$GalleryID."-images.json";
            $fp = fopen($jsonFile, 'w');
            fwrite($fp, json_encode($imagesArray));
            fclose($fp);

            // !IMPORTANT otherwise indexed db will be not reloaded
            $jsonFile = $upload_dir['basedir']."/contest-gallery/gallery-id-".$GalleryID."/json/".$GalleryID."-gallery-tstamp.json";
            $fp = fopen($jsonFile, 'w');
            fwrite($fp, json_encode(time()));
            fclose($fp);

        }

    }
}



?>