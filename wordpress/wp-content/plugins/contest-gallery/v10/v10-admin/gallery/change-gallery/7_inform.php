<?php
if ($informORnot == 1) {

//echo "Post:";

    if (!empty($_POST['cg_activate']) && !empty($_POST['cg_email'])) {

        // if informed cg_email will be not send!
        $emails = $_POST['cg_email'];

        $informIds = $_POST['cg_activate'];

        $isInformedAtLeastOnce = false;

        $querySETrowForInformedIds = 'UPDATE ' . $tablename . ' SET Informed = CASE id ';
        $querySETaddRowForInformedIds = ' ELSE Informed END WHERE id IN (';

        foreach ($informIds as $key => $value) {

            $key = sanitize_text_field($key);
            $value = sanitize_text_field($value);

            if (!empty($emails[$value])) {

                $To = sanitize_text_field($emails[$value]);

                if (is_email($To)) {

                    $post_title = $_POST['cg_image_name'][$value];

                    if ($urlCheck == 1 and $url == true) {

                        $url1 = $url . "#!gallery/$GalleryID/image/$value/$post_title";
                        $replacePosUrl = '$url$';

                        $Msg = str_ireplace($replacePosUrl, $url1, $contentMail);

                    }else{
                        $Msg = $contentMail;
                    }

                    $headers = array();
                    $headers[] = "From: $Admin <" . strip_tags(@$Reply) . ">\r\n";
                    $headers[] = "Reply-To: " . @strip_tags(@$Reply) . "\r\n";


                    if (strpos($cc, ';')) {
                        $cc = explode(';', $cc);
                        foreach ($cc as $ccValue) {
                            $ccValue = trim($ccValue);
                            $headers[] = "CC: $ccValue\r\n";
                        }
                    } else {
                        $headers[] = "CC: $cc\r\n";
                    }

                    if (strpos($bcc, ';')) {
                        $bcc = explode(';', $bcc);
                        foreach ($bcc as $bccValue) {
                            $bccValue = trim($bccValue);
                            $headers[] = "BCC: $bccValue\r\n";
                        }
                    } else {
                        $headers[] = "BCC: $bcc\r\n";
                    }


                    $headers[] = "MIME-Version: 1.0";
                    $headers[] = "Content-Type: text/html; charset=utf-8";


                    global $cgMailAction;
                    global $cgMailGalleryId;
                    $cgMailAction = "Image activation e-mail backend";
                    $cgMailGalleryId = $GalleryID;
                    add_action('wp_mail_failed', 'cg_on_wp_mail_error', 10, 1);
                    wp_mail($To, $Subject, $Msg, $headers);

                    $isInformedAtLeastOnce = true;

                    $querySETrowForInformedIds .= " WHEN $key THEN 1";
                    $querySETaddRowForInformedIds .= "$key,";

                }

            }

        }

        if($isInformedAtLeastOnce){



            $querySETaddRowForInformedIds = substr($querySETaddRowForInformedIds,0,-1);
            $querySETaddRowForInformedIds .= ")";

            $querySETrowForInformedIds .= $querySETaddRowForInformedIds;
            $updateSQL = $wpdb->query($querySETrowForInformedIds);

        }

    }

}
