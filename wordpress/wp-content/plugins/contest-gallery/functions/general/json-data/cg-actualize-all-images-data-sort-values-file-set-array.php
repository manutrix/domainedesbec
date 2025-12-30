<?php

add_action('cg_actualize_all_images_data_sort_values_file_set_array','cg_actualize_all_images_data_sort_values_file_set_array');

if(!function_exists('cg_actualize_all_images_data_sort_values_file_set_array')){
    function cg_actualize_all_images_data_sort_values_file_set_array($allImagesArray,$imageDataArray,$imageId,$IsModernFiveStar = false){
        $allImagesArray[$imageId]['id'] = $imageId;
        $allImagesArray[$imageId]['Rating'] = (!empty($imageDataArray['Rating']) ? $imageDataArray['Rating'] : 0);
        $allImagesArray[$imageId]['CountC'] = (!empty($imageDataArray['CountC']) ? $imageDataArray['CountC'] : 0);
        $allImagesArray[$imageId]['CountR'] = (!empty($imageDataArray['CountR']) ? $imageDataArray['CountR'] : 0);
        $allImagesArray[$imageId]['CountS'] = (!empty($imageDataArray['CountS']) ? $imageDataArray['CountS'] : 0);
        $allImagesArray[$imageId]['addCountS'] = (!empty($imageDataArray['addCountS']) ? $imageDataArray['addCountS'] : 0);
        $allImagesArray[$imageId]['addCountR1'] = (!empty($imageDataArray['addCountR1']) ? $imageDataArray['addCountR1'] : 0);
        $allImagesArray[$imageId]['addCountR2'] = (!empty($imageDataArray['addCountR2']) ? $imageDataArray['addCountR2'] : 0);
        $allImagesArray[$imageId]['addCountR3'] = (!empty($imageDataArray['addCountR3']) ? $imageDataArray['addCountR3'] : 0);
        $allImagesArray[$imageId]['addCountR4'] = (!empty($imageDataArray['addCountR4']) ? $imageDataArray['addCountR4'] : 0);
        $allImagesArray[$imageId]['addCountR5'] = (!empty($imageDataArray['addCountR5']) ? $imageDataArray['addCountR5'] : 0);
        if($IsModernFiveStar){
            $allImagesArray[$imageId]['CountR1'] = (!empty($imageDataArray['CountR1']) ? $imageDataArray['CountR1'] : 0);
            $allImagesArray[$imageId]['CountR2'] = (!empty($imageDataArray['CountR2']) ? $imageDataArray['CountR2'] : 0);
            $allImagesArray[$imageId]['CountR3'] = (!empty($imageDataArray['CountR3']) ? $imageDataArray['CountR3'] : 0);
            $allImagesArray[$imageId]['CountR4'] = (!empty($imageDataArray['CountR4']) ? $imageDataArray['CountR4'] : 0);
            $allImagesArray[$imageId]['CountR5'] = (!empty($imageDataArray['CountR5']) ? $imageDataArray['CountR5'] : 0);
        }else{
            $allImagesArray[$imageId]['CountR1'] = 0;
            $allImagesArray[$imageId]['CountR2'] = 0;
            $allImagesArray[$imageId]['CountR3'] = 0;
            $allImagesArray[$imageId]['CountR4'] = 0;
            $allImagesArray[$imageId]['CountR5'] = 0;
        }

        return $allImagesArray;


    }
}

