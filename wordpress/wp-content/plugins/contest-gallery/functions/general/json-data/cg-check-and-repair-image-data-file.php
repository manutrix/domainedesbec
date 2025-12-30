<?php

add_action('cg_check_and_repair_image_file_data','cg_check_and_repair_image_file_data');

if(!function_exists('cg_check_and_repair_image_file_data')){

    function cg_check_and_repair_image_file_data($GalleryID,$imageId,$ratingFileData,$IsModernFiveStar){

        $isRepair = false;
        if(!isset($ratingFileData['id'])){$isRepair = true;}
        if(!isset($ratingFileData['Rating'])){$isRepair = true;}
        if(!isset($ratingFileData['CountC'])){$isRepair = true;}
        if(!isset($ratingFileData['CountR'])){$isRepair = true;}
        if(!isset($ratingFileData['CountS'])){$isRepair = true;}
        if(!isset($ratingFileData['addCountS'])){$isRepair = true;}
        if(!isset($ratingFileData['addCountR1'])){$isRepair = true;}
        if(!isset($ratingFileData['addCountR2'])){$isRepair = true;}
        if(!isset($ratingFileData['addCountR3'])){$isRepair = true;}
        if(!isset($ratingFileData['addCountR4'])){$isRepair = true;}
        if(!isset($ratingFileData['addCountR5'])){$isRepair = true;}
        if(!isset($ratingFileData['CountR1'])){$isRepair = true;}
        if(!isset($ratingFileData['CountR2'])){$isRepair = true;}
        if(!isset($ratingFileData['CountR3'])){$isRepair = true;}
        if(!isset($ratingFileData['CountR4'])){$isRepair = true;}
        if(!isset($ratingFileData['CountR5'])){$isRepair = true;}
        if(!isset($ratingFileData['Category'])){$isRepair = true;}

        if(!$isRepair){
            return $ratingFileData;
        }else{

            global $wpdb;

            $tablename = $wpdb->prefix . "contest_gal1ery";
            $tablename_ip = $wpdb->prefix . "contest_gal1ery_ip";

            $data = $wpdb->get_row( "SELECT addCountS, addCountR1, addCountR2, addCountR3, addCountR4, addCountR5, CountC, Category FROM $tablename WHERE id = $imageId");
            $votingData = $wpdb->get_row("
          SELECT SUM(RatingS = 1) AS RatingScount, SUM(Rating = 1) AS RatingR1Count, SUM(Rating = 2) AS RatingR2Count, SUM(Rating = 3) AS RatingR3Count, SUM(Rating = 4) AS RatingR4Count, SUM(Rating = 5) AS RatingR5Count 
          FROM $tablename_ip WHERE (RatingS = 1 OR Rating = 1 OR Rating = 2 OR Rating = 3 OR Rating = 4 OR Rating = 5)  AND pid IN ($imageId) 
          ");

            // in case some data is NULL then it has to be repaired
            if(!isset($data->addCountS)){$data->addCountS = 0;}
            if(!isset($data->addCountR1)){$data->addCountR1 = 0;}
            if(!isset($data->addCountR2)){$data->addCountR2 = 0;}
            if(!isset($data->addCountR3)){$data->addCountR3 = 0;}
            if(!isset($data->addCountR4)){$data->addCountR4 = 0;}
            if(!isset($data->addCountR5)){$data->addCountR5 = 0;}
            if(!isset($data->CountC)){$data->CountC = 0;}
            if(empty($data->Category)){$data->Category = 0;}
            if(!isset($votingData->RatingScount)){$votingData->RatingScount = 0;}
            if(!isset($votingData->RatingR1Count)){$votingData->RatingR1Count = 0;}
            if(!isset($votingData->RatingR2Count)){$votingData->RatingR2Count = 0;}
            if(!isset($votingData->RatingR3Count)){$votingData->RatingR3Count = 0;}
            if(!isset($votingData->RatingR4Count)){$votingData->RatingR4Count = 0;}
            if(!isset($votingData->RatingR5Count)){$votingData->RatingR5Count = 0;}


            $ratingFileData['id'] = $imageId;
            $ratingFileData['Rating'] = $votingData->RatingR1Count*1+$votingData->RatingR2Count*2+$votingData->RatingR3Count*3+$votingData->RatingR4Count*4+$votingData->RatingR5Count*5;
            $ratingFileData['CountR'] = $votingData->RatingR1Count+$votingData->RatingR2Count+$votingData->RatingR3Count+$votingData->RatingR4Count+$votingData->RatingR5Count;
            $ratingFileData['CountS'] = $votingData->RatingScount;
            $ratingFileData['CountC'] = $data->CountC;

            $ratingFileData['addCountS'] = $data->addCountS;
            $ratingFileData['addCountR1'] = $data->addCountR1;
            $ratingFileData['addCountR2'] = $data->addCountR2;
            $ratingFileData['addCountR3'] = $data->addCountR3;
            $ratingFileData['addCountR4'] = $data->addCountR4;
            $ratingFileData['addCountR5'] = $data->addCountR5;

            if($IsModernFiveStar){
                $ratingFileData['CountR1'] = $votingData->RatingR1Count;
                $ratingFileData['CountR2'] = $votingData->RatingR2Count;
                $ratingFileData['CountR3'] = $votingData->RatingR3Count;
                $ratingFileData['CountR4'] = $votingData->RatingR4Count;
                $ratingFileData['CountR5'] = $votingData->RatingR5Count;
            }else{
                $ratingFileData['CountR1'] = 0;
                $ratingFileData['CountR2'] = 0;
                $ratingFileData['CountR3'] = 0;
                $ratingFileData['CountR4'] = 0;
                $ratingFileData['CountR5'] = 0;
            }

            $ratingFileData['Category'] = intval($data->Category);// to go sure, intval this

            return $ratingFileData;
        }



    }
}
