<?php
	
	global $wpdb;
	$tablename = $wpdb->prefix."contest_gal1ery";
	//$proUploads = $wpdb->get_var( "SELECT COUNT(*) FROM $tablename WHERE id > '0' ");

	if(!get_option("p_cgal1ery_reminder_time")){
		add_option( "p_cgal1ery_reminder_time", time() );
	}

echo "<div id='cgAddFieldsPressedAfterContentModificationContent' class='cg_hide'><span class='cg_message_close'></span><p>There were changes done without saving</p><a class='cg_image_action_href' href=\"?page=".cg_get_version()."/index.php&define_upload=true&option_id=$GalleryID\"><span class='cg_image_action_span'>Continue without saving?</span>
</a></div>";
echo "<div id='cgAddFieldsPressedAfterContentModification' class='cg_hide'></div>";

echo "<div id='cgDocumentation'>";
echo "<a href='https://www.contest-gallery.com/documentation/' target='_blank'><span>";
echo "Contest Gallery documentation";
echo "</span></a>";
echo "</div>";
echo "<input type='hidden' id='cgGetVersionForUrlJs' value='".cg_get_version()."' />";

###NORMAL###
if(!empty($cgProVersion)){// check with no empty!
    include('normal/download-proper-pro-version-info-general-headers-area.php');
}
###NORMAL-END###
	
	echo "<table style='border: thin solid black;background-color:#ffffff;' width='937px;' id='cg_shortcode_table' class='cg_shortcode_table'>";
	
	if(@$GalleryName){@$GalleryName="$GalleryName";}
	else {@$GalleryName="Contest Gallery";}
	
		$versionColor = "#444";

if(empty($cgProVersionLink)){
    $cgProVersionLink = '';
}

echo "<tr><td align='center'><div style='text-align:center;width:180px;' ><strong>$GalleryName</strong><br/>$cgProVersionLink</div></td>";
$galeryNR = $GalleryID;

    include("nav-shortcode.php");

echo "</tr>";
	echo "</table>";
	
	echo "<br/>";
	//fef050 fcd729
	echo "<table style='border: thin solid black;background-color:#ffffff;padding:15px 0;' width='937px;'>";
	echo "<tr>";
	echo "<td align='center'><div><a href='?page=".cg_get_version()."/index.php'  class='cg_load_backend_link'><input class='cg_backend_button cg_backend_button_back' type='button' value='<<< Back to menu' ></a></div></td>";
	echo "<td align='center'><div><a href='?page=".cg_get_version()."/index.php&edit_options=true&option_id=$GalleryID' class='cg_load_backend_link'><input type='button' class='cg_backend_button cg_backend_button_general' value='Edit options' /></a></div></td>";
	echo "<td align='center'><div><a href='?page=".cg_get_version()."/index.php&define_upload=true&option_id=$GalleryID'  class='cg_load_backend_link'><input type='button' class='cg_backend_button cg_backend_button_general' value='Edit upload form'  /></a></div></td>";
	echo "<td align='center'><div>";

		//echo "<form method='POST' action='?page=".cg_get_version()."/index.php&create_user_form=true&option_id=$GalleryID'><input type='hidden' name='option_id' value='$GalleryID'><input type='submit' value='PRO users management' style='text-align:center;width:180px;background:linear-gradient(0deg, #ffbe4e 50%, #ffbe4e 50%);' /></form><br/>";
		echo "<a href='?page=".cg_get_version()."/index.php&create_user_form=true&option_id=$GalleryID'  class='cg_load_backend_link'><input class='cg_backend_button cg_backend_button_general'  type='button' value='Edit registration form'  /></a>";
		


	echo "</div></td>"; 
	echo "</tr>";
	
	echo "</table>";


    if(!empty($isEditOptions)){
        include('nav-users-management-with-status-and-repair.php');
    }else{
        echo "<br/>";
        include('nav-users-management.php');
    }


?>