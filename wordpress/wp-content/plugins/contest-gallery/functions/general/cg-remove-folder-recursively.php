<?php

if(!function_exists('cg_remove_folder_recursively')){
    function cg_remove_folder_recursively($dir){

        // .htaccess requires extra glob!
        $dirContentLikeHtaccess = glob($dir.'/.*');

        foreach($dirContentLikeHtaccess as $item){
            if(is_file($item)){
                unlink($item);
            }
        }

        $dirContent = glob($dir.'/*');

        foreach($dirContent as $item){
            // 1. Ebene
            if(is_dir($item)){
                cg_remove_folder_recursively($item);
            }
            else{
                if(is_file($item)){
                    unlink($item);
                }
            }

        }

        // is_dir check important here!
        if(is_dir($dir)){
            rmdir($dir);
        }

    }
}

?>