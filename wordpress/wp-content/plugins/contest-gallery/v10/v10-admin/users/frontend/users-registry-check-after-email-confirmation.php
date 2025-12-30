<?php
if (!defined('ABSPATH')) {
    exit;
}

//echo "222";
$tablenameWpUsers = $wpdb->base_prefix . "users";
$tablenameWpUserMeta = $wpdb->base_prefix . "usermeta";
$tablenameCreateUserEntries = $wpdb->prefix . "contest_gal1ery_create_user_entries";

$cgkey = sanitize_text_field($_GET["cgkey"]);

if(strpos($cgkey,'-confirmed')!==false OR strpos($cgkey,'-unconfirmed')!==false){// then somebody must try to manipualte
    return;
}

$checkUserViaKey = $wpdb->get_row("SELECT * FROM $tablenameWpUsers WHERE user_activation_key LIKE '%$cgkey%'");

// check if user exists, if exists then TextAfterEmailConfirmation can be always shown
if (!empty($checkUserViaKey)) {

    // activation key can be emptied then, user confirmed then
    // in case that account was created right after registration empty activation_key in $tablenameCreateUserEntries
    $wpdb->update(
        "$tablenameCreateUserEntries",
        array('activation_key' => ''),
        array('activation_key' => $cgkey),
        array('%s'),
        array('%s')
    );

    // '-confirmed' was added in update 10.9.8.8.0
    // has to done with prepare because of LIKE syntax!
    $wpdb->query($wpdb->prepare(
        "
				UPDATE $tablenameWpUsers SET user_activation_key = %s WHERE user_activation_key LIKE %s
			",
        $cgkey."-confirmed","%$cgkey%"
    ));

    echo "<a href='#cg_activation'></a>";
    echo "<div>";
    echo "<p>";
    echo nl2br(html_entity_decode(stripslashes($pro_options->TextAfterEmailConfirmation)));
    echo "</p>";
    echo "</div>";

} else {

    $userAccountEntries = $wpdb->get_results("SELECT Field_Type, Field_Content FROM $tablenameCreateUserEntries WHERE activation_key='$cgkey'");

    //var_dump($userAccountEntries);
    // then registration was done and user should be directly logged and created account without waiting for mail
    if (count($userAccountEntries)) {

        $checkWpUserId = $wpdb->get_var("SELECT DISTINCT wp_user_id FROM $tablenameCreateUserEntries WHERE activation_key='$cgkey' AND wp_user_id >= 1");
        $isUnconfirmedUser = $wpdb->get_row("SELECT * FROM $tablenameWpUsers WHERE user_activation_key='$cgkey-unconfirmed'");

        if (!empty($checkWpUserId) AND empty($isUnconfirmedUser)) {// If user is completely confirmed then show this here, make this check because it works also for users registered in lower version then 10.9.8.8.0 for sure

            echo "<a href='#cg_activation'></a>";
            echo "<div>";
            echo "<p>";
            echo "This user is already registered.";
            echo "</p>";
            echo "</div>";

        } else {

            // !!!IMPORTANT!!!, THIS HERE HAS TO WORK FOR UNCONFIRMED USERS AND NOT CREATED USERS!!!!!!

            $i = 0;
            $fieldRow = '';
            foreach ($userAccountEntries as $key => $value) {

                foreach ($value as $key1 => $value1) {
                    $i++;
                    if ($value1 == "password") {
                        $fieldRow = "password";
                        continue;
                    }
                    if ($fieldRow == "password") {
                        $user_pass = $value1;
                        $fieldRow = '';
                        continue;
                    }
                    if ($value1 == "main-mail") {
                        $fieldRow = "main-mail";
                        continue;
                    }
                    if ($fieldRow == "main-mail") {
                        $user_email = $value1;
                        $fieldRow = '';
                        continue;
                    }
                    if ($value1 == "main-user-name") {
                        $fieldRow = "main-user-name";
                        continue;
                    }
                    if ($fieldRow == "main-user-name") {
                        $user_login = $value1;
                        $user_nicename = $value1;
                        $display_name = $value1;
                        $fieldRow = '';
                    }
                }

            }

            if(!empty($user_login) AND !empty($user_email) AND !empty($user_pass)){

                $user_registered = date("Y-m-d H:i:s");

                if(empty($isUnconfirmedUser)){
                    // '-confirmed' was added update 10.9.8.8.0
                    $wpdb->query($wpdb->prepare(
                        "
                                INSERT INTO $tablenameWpUsers
                                ( id, user_login, user_pass, user_nicename, user_email, user_url,
                                user_registered, user_activation_key, user_status, display_name)
                                VALUES (%s,%s,%s,%s,%s,%s,
                                %s,%s,%d,%s)
                            ",
                        '', $user_login, $user_pass, $user_nicename, $user_email, '',
                        $user_registered, $cgkey.'-confirmed', '', $display_name
                    ));
                }else{// since 10.9.8.8.0
                    // if is unconfirmed user that already created after registration!!!!!!!!

                    $wpdb->update(
                        "$tablenameWpUsers",
                        array('user_activation_key' => $cgkey.'-confirmed'),
                        array('wp_user_id' => $isUnconfirmedUser->ID),
                        array('%s'),
                        array('%d')
                    );

                }

                // '-confirmed' was added update 10.9.8.8.0
                $newWpId = $wpdb->get_var("SELECT ID FROM $tablenameWpUsers WHERE user_activation_key='$cgkey-confirmed'");

                // Add new wp_user_id
                $wpdb->update(
                    "$tablenameCreateUserEntries",
                    array('wp_user_id' => $newWpId, 'activation_key' => ''),
                    array('activation_key' => $cgkey),
                    array('%d', '%s'),
                    array('%s')
                );

                $wpdb->query($wpdb->prepare(
                    "
                                    DELETE FROM $tablenameCreateUserEntries WHERE GalleryID = %d AND (Field_Type = %s OR Field_Type = %s) AND wp_user_id = %s
                                ",
                    $GalleryID, "password", "password-confirm", $newWpId
                ));

                // User Rolle wird gesetzt
                wp_update_user(array('ID' => $newWpId, 'role' => $RegistryUserRole));

                echo "<div id='cg_activation'>";

                if(!empty($pro_options)){
                    echo "<p>";
                    echo html_entity_decode(stripslashes(nl2br($pro_options->TextAfterEmailConfirmation)));
                    echo "</p>";

                }else{ // Fallback text if gallery was deleted

                    echo "<p>Thank you for your registration. <br>You are now able to log in.</p>";

                }

                echo "</div>";


                ?>

                <script>

                    location.href = "#cg_activation";


                </script>

                <?php


            }else{

                echo "<div id='cg_activation'>";

                echo "<p>Fields must be deleted manually from database.<br>Please contact administrator.</p>";

                echo "</div>";

            }


        }


    } else {

        echo "<div id='cg_activation'>";

        echo "<p>Your mail must be already confirmed or you are using wrong registration link.</p>";

        echo "</div>";

    }

}


?>