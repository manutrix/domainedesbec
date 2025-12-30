<?php

    $collect = "";

        $imageRatingArray = array();

        // erst mal alle aktivieren, die aktiviert gehören!!!
        if(!empty($_POST['cg_activate'])){

            $querySETrowActive = 'UPDATE ' . $tablename . ' SET Active = CASE';
            $querySETaddRowActive = ' ELSE Active END WHERE (id) IN (';

            foreach($activate as $key => $value){

                $value = sanitize_text_field($value);

                $querySETrowActive .= " WHEN (id = $value) THEN 1";
                $querySETaddRowActive .= "($value), ";

            }

            $querySETaddRowActive = substr($querySETaddRowActive,0,-2);
            $querySETaddRowActive .= ")";

            $querySETrowActive .= $querySETaddRowActive;

            $wpdb->query($querySETrowActive);

        }

        // Dann die bearbeiten, die geschickt wurden und nicht DEAKTIVIERT wurden!!!
        if(!empty($_POST['cg_activate'])){

            $ids = $_POST['cg_activate'];

            foreach($ids as $id => $rowid){

                if($collect==''){
                    $collect .= "$tablename.id = $id";
                }else{
                    $collect .= " OR $tablename.id = $id";
                }

            }

        }

        if(!empty($_POST['cg_winner'])){

            $ids = $_POST['cg_winner'];

            foreach($ids as $id => $rowid){

                if(!empty($_POST['cg_activate'])){
                    if(array_search($id,$_POST['cg_activate'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['addCountChange'])){
                    if(array_search($id,$_POST['addCountChange'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_row'])){
                    if(array_search($id,$_POST['cg_row'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner_not'])){
                    if(array_search($id,$_POST['cg_winner_not'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['imageCategory'])){
                    if(array_key_exists($id,$_POST['imageCategory'])===true){
                        continue;
                    }
                }

                if($collect==''){
                    $collect .= "$tablename.id = $id";
                }else{
                    $collect .= " OR $tablename.id = $id";
                }

            }

        }
        if(!empty($_POST['cg_winner_not'])){

            $ids = $_POST['cg_winner_not'];

            foreach($ids as $id => $rowid){

                if(!empty($_POST['cg_activate'])){
                    if(array_search($id,$_POST['cg_activate'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['addCountChange'])){
                    if(array_search($id,$_POST['addCountChange'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_row'])){
                    if(array_search($id,$_POST['cg_row'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner'])){
                    if(array_search($id,$_POST['cg_winner'])!==false){
                        continue;
                    }
                }


                if(!empty($_POST['imageCategory'])){
                    if(array_key_exists($id,$_POST['imageCategory'])===true){
                        continue;
                    }
                }

                if($collect==''){
                    $collect .= "$tablename.id = $id";
                }else{
                    $collect .= " OR $tablename.id = $id";
                }

            }

        }

        if(!empty($_POST['cg_row'])){

            $ids = $_POST['cg_row'];

            foreach($ids as $id => $rowid){

                if(!empty($_POST['cg_activate'])){
                    if(array_search($id,$_POST['cg_activate'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['addCountChange'])){
                    if(array_search($id,$_POST['addCountChange'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner'])){
                    if(array_search($id,$_POST['cg_winner'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner_not'])){
                    if(array_search($id,$_POST['cg_winner_not'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['imageCategory'])){
                    if(array_key_exists($id,$_POST['imageCategory'])===true){
                        continue;
                    }
                }

                if($collect==''){
                    $collect .= "$tablename.id = $id";
                }else{
                    $collect .= " OR $tablename.id = $id";
                }

            }

        }

        if(!empty($_POST['addCountChange'])){

            $ids = $_POST['addCountChange'];

            foreach($ids as $id => $addCountChange){

                if(!empty($_POST['cg_activate'])){
                    if(array_search($id,$_POST['cg_activate'])!==false){
                        continue;
                    }
                }


                if(!empty($_POST['cg_winner'])){
                    if(array_search($id,$_POST['cg_winner'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner_not'])){
                    if(array_search($id,$_POST['cg_winner_not'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_row'])){
                    if(array_search($id,$_POST['cg_row'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['imageCategory'])){
                    if(array_key_exists($id,$_POST['imageCategory'])===true){
                        continue;
                    }
                }

                if($collect==''){
                    $collect .= "$tablename.id = $id";
                }else{
                    $collect .= " OR $tablename.id = $id";
                }

            }

        }

        if(!empty($_POST['imageCategory'])){

            $ids = $_POST['imageCategory'];

            foreach($ids as $id => $imageCategory){

                if(!empty($_POST['cg_activate'])){
                    if(array_search($id,$_POST['cg_activate'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['addCountChange'])){
                    if(array_search($id,$_POST['addCountChange'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner'])){
                    if(array_search($id,$_POST['cg_winner'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_winner_not'])){
                    if(array_search($id,$_POST['cg_winner_not'])!==false){
                        continue;
                    }
                }

                if(!empty($_POST['cg_row'])){
                    if(array_search($id,$_POST['cg_row'])!==false){
                        continue;
                    }
                }

                if($collect==''){
                    $collect .= "$tablename.id = $id";
                }else{
                    $collect .= " OR $tablename.id = $id";
                }

            }

        }

     //   var_dump($_POST['addCountChange']);
       // var_dump($collect);

        if(!empty($collect)){

            $picsSQL = $wpdb->get_results( "SELECT $table_posts.*, $tablename.* FROM $table_posts, $tablename WHERE ($collect) AND $tablename.GalleryID='$GalleryID' AND $tablename.Active='1' and $table_posts.ID = $tablename.WpUpload ORDER BY $tablename.id DESC");

            // Gr��e der Bilder bei ThumbAnsicht (gew�hnliche Ansicht mit Bewertung)
            $uploadFolder = wp_upload_dir();
            $urlSource = site_url();

            $blog_title = get_bloginfo('name');
            $blog_description = get_bloginfo('description');

            // first get user ids in this array $imageId
            $wpUserIdsAndDisplayNames = array();
            $collect = "";
            foreach($picsSQL as $object){
                if(!empty($object->WpUserId)){
                    $wpUserIdsAndDisplayNames[$object->id] = $object->WpUserId;
                    if($collect==''){
                        $collect .= "ID = $object->WpUserId";
                    }else{
                        $collect .= " OR ID = $object->WpUserId";
                    }
                }
                else{
                    $wpUserIdsAndDisplayNames[$object->id] = '';
                }
            }

            if(!empty($collect)){
                $displayNames = $wpdb->get_results( "SELECT ID, display_name FROM $table_users WHERE ($collect) ORDER BY ID DESC");
            }

            // now get user names in this array
            if(!empty($displayNames)){
                foreach($displayNames as $wpUser){

                    if(in_array($wpUser->ID,$wpUserIdsAndDisplayNames)){
                        foreach($wpUserIdsAndDisplayNames as $imageId => $wpUserId){

                            if($wpUserId==$wpUser->ID){
                                //$imageArray[$rowObject->id]['display_name'] = '' wurde pauschal in cg_create_json_files_when_activating
                                $imageArray[$imageId]['display_name'] = $wpUser->display_name;
                                $wpUserIdsAndDisplayNames[$imageId] = $wpUser->display_name;

                            }

                        }
                    }
                }
            }

            // get wpUser display_name --- END

            // add all json files and generate images array
            foreach($picsSQL as $object){

                $imageArray = cg_create_json_files_when_activating($GalleryID,$object,$thumbSizesWp,$uploadFolder,$imageArray,$wpUserIdsAndDisplayNames);

                include('4_2_fb-creation.php');

            }


        }

















