<?php

		$cg_wp_upload_ids = $_REQUEST['action1'];
		$galeryID = $_REQUEST['action2'];


$table_posts = $wpdb->prefix."posts";
$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablename_pro_options = $wpdb->prefix . "contest_gal1ery_pro_options";

$selectSQL1 = $wpdb->get_row( "SELECT * FROM $tablenameOptions WHERE id = '$galeryID'" );
$cgVersion = $selectSQL1->Version;
$tablename = $wpdb->prefix . "contest_gal1ery";


$proOptions = $wpdb->get_row( "SELECT * FROM $tablename_pro_options WHERE GalleryID = '$galeryID'" );
$DataShare = ($proOptions->FbLikeNoShare==1) ? 'false' : 'true';
$DataClass = ($proOptions->FbLikeOnlyShare==1) ? 'fb-share-button' : 'fb-like';
$DataLayout = ($proOptions->FbLikeOnlyShare==1) ? 'button' : 'button_count';

//var_dump("asdfsad");die;

foreach($cg_wp_upload_ids as $key => $value){
	
	
$wp_image_info = $wpdb->get_row("SELECT * FROM $table_posts WHERE ID = '$value'");
$image_url = $wp_image_info->guid;
$post_title = $wp_image_info->post_title;
$post_type = $wp_image_info->post_mime_type;
$wp_image_id = $wp_image_info->ID;

// Notwendig: wird in convert-several-pics so verabeitet. Darf keine Sonderzeichen enthalten!
$search = array(" ", "!", '"', "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "/", ":", ";", "=", "?", "@", "[","]","‘");
$post_title = str_replace($search,"_",$post_title);
    //var_dump($post_title); die;
    $NamePic = $post_title;

$doNotProcess=0;

if($post_type=="image/jpeg"){$post_type="jpg";}
else if($post_type=="image/jpg"){$post_type="jpg";}
else if($post_type=="image/png"){$post_type="png";}
else if($post_type=="image/gif"){$post_type="gif";}
else{	
	$doNotProcess=1;
}
//echo "post_type $post_type<br>";
$uploads = wp_upload_dir();

//$check = explode($uploads['baseurl'],$image_url);

//echo $uploads['basedir'].$check[1].$post_title.".".$post_type;

// = $uploads['basedir'].$check[1];

    $uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/image-comments';
    if(!is_dir($uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/image-comments')){
        mkdir($uploads['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/image-comments',0755,true);
    }
//echo "post_type $filename<br>";

   // var_dump($filename); die;

  //  var_dump($NamePic); die;


if($doNotProcess!=1){

	$unix = time();
	$unixadd = $unix+2;

  //  list($current_width, $current_height) = getimagesize($filename);
    $imageInfoArray = wp_get_attachment_image_src($wp_image_id,'full');
    $current_width = $imageInfoArray[1];
    $current_height = $imageInfoArray[2];

	$WpUserId = get_current_user_id();

    $userIP = cg_get_user_ip();

    $Version = cg_get_version_for_scripts();
    $uploadFolder = wp_upload_dir();

    $dirHTML = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/'.$unixadd."_".$NamePic."413.html";

    // can only happen if images with same name was added in same time!!!!
    if(file_exists($dirHTML)){
        $NamePic = $NamePic.'-copy';
    }

        // updating string after all the 0 at the end does not work. That is why version is not inserted there
    // default 0 to countr1-5 was added lately on 15.05.2020
    $wpdb->query( $wpdb->prepare(
		"
			INSERT INTO $tablename
			( id, rowid, Timestamp, NamePic,
			ImgType, CountC, CountR, Rating,
			GalleryID, Active, Informed, WpUpload,Width,Height,WpUserId,IP,
			CountR1,CountR2,CountR3,CountR4,CountR5)
			VALUES ( %s,%s,%d,%s,
			%s,%d,%s,%s,
			%d,%s,%s,%s,%s,%s,%s,%s,
			%d,%d,%d,%d,%d
			 )
		", 
			'','',$unixadd,$NamePic,
			$post_type,0,'','',
			$galeryID,'','',$wp_image_id,$current_width,$current_height,$WpUserId,$userIP,
            0,0,0,0,0,0
	 ) );

    $cgTableData = $wpdb->get_row("SELECT * FROM $tablename WHERE Timestamp='$unixadd' AND NamePic='$NamePic'");
	$nextId = $cgTableData->id;

	//echo "nextId $nextId<br>";

    // updating string after all the 0 at the end does not work at the top insert query. That is why version have to be inserted here
    $wpdb->update(
		"$tablename",
		array('rowid' => $nextId,'Version' => $Version),
		array('id' => $nextId), 
		array('%d','%s'),
		array('%d')
	);

    cg_create_fb_html($cgTableData,$galeryID,$DataShare,$DataClass,$DataLayout);

    if(file_exists($uploadFolder['basedir'] . '/contest-gallery/cg-copying-gallery.txt')){
        unlink($uploadFolder['basedir'] . '/contest-gallery/cg-copying-gallery.txt');
    };

    if(!is_dir($uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/frontend-added-or-removed-images')){
        mkdir($uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/frontend-added-or-removed-images',0755,true);
    }

    // simply create empty file for later check
    $jsonFile = $uploadFolder['basedir'].'/contest-gallery/gallery-id-'.$galeryID.'/json/frontend-added-or-removed-images/'.$galeryID.'.txt';
    $fp = fopen($jsonFile, 'w');
    fwrite($fp, '');
    fclose($fp);

}
else{
	echo "One of your selected file types is unsupported. Only JPG, PNG and GIF are allowed.";
}
	
}


