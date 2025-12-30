<?php

if(!function_exists('cg1l_sanitize_files')){

    function cg1l_sanitize_files($FILES) {

        if(empty($FILES['data'])){

            ?>

            <script data-cg-processing="true">

                cgJsClass.gallery.upload.doneUploadFailed = true;
                cgJsClass.gallery.upload.failMessage = <?php echo json_encode("Upload manipulation, no files sent");?>;

            </script>

            <?php

            echo "Upload manipulation, no files sent";
            die;

        }

        if(!function_exists('getimagesize')){

            ?>
            <script data-cg-processing="true">
                cgJsClass.gallery.upload.doneUploadFailed = true;
                cgJsClass.gallery.upload.failMessage = <?php echo json_encode("You require getimagesize function to be available for your server to be able to upload");?>;
            </script>
            <?php

            echo "You require getimagesize function to be available for your server to be able to upload";
            die;

        }

        foreach($FILES['data']['tmp_name'] as $key => $value){

            $getimagesize = getimagesize($FILES['data']['tmp_name'][$key]);

            if(empty($getimagesize)){
                ?>
                <script data-cg-processing="true">
                    cgJsClass.gallery.upload.doneUploadFailed = true;
                    cgJsClass.gallery.upload.failMessage = <?php echo json_encode("Only images allowed (jpg, png, gif), please do not manipulate");?>;
                </script>
                <?php
                echo "Only images allowed (jpg, png, gif), please do not manipulate";
                die;
            }else if(!empty($getimagesize['mime'])){
                if($getimagesize['mime']=='image/vnd.microsoft.icon'){
                    ?>
                    <script data-cg-processing="true">
                        cgJsClass.gallery.upload.doneUploadFailed = true;
                        cgJsClass.gallery.upload.failMessage = <?php echo json_encode("favicons are not allowed");?>;
                    </script>
                    <?php
                    echo "favicons are not allowed";
                    die;
                }
            }

        }

        // only images allowed
        $allowedMimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png'
        );

        foreach($FILES['data']['name'] as $key => $value){

            $FILES['data']['name'][$key] = sanitize_file_name($FILES['data']['name'][$key]);

            $fileInfo = wp_check_filetype(basename($FILES['data']['name'][$key]), $allowedMimes);

            if(empty($fileInfo['ext']) OR empty($fileInfo['type'])){
                ?>
                <script data-cg-processing="true">
                    cgJsClass.gallery.upload.doneUploadFailed = true;
                    cgJsClass.gallery.upload.failMessage = <?php echo json_encode("This file type is not allowed, please do not manipulate");?>;
                </script>
                <?php
                echo "This file type is not allowed, please do not manipulate";die;
            }

        }

        return $FILES;
    }
}



