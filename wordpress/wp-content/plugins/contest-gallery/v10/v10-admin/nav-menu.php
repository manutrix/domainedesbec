<?php

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

	if(!empty($GalleryName)){$GalleryName=$GalleryName;}
	else {$GalleryName="Contest Gallery";}
	
		$versionColor = "#444";

	echo "<tr><td align='center'><div style='width:180px;' ><strong>$GalleryName</strong><br/>$cgProVersionLink</div></td>";

$galeryNR = $GalleryID;

include("nav-shortcode.php");

	echo "</tr>";
	echo "</table>";
	
	echo "<br/>";

	echo "<table style='border: thin solid black;background-color:#ffffff;padding:15px;' width='937px;'>";
	echo "<tr>";
	echo "<td align='center'><div><a href='?page=".cg_get_version()."/index.php&option_id=$GalleryID&edit_gallery=true' class='cg_load_backend_link' ><input class='cg_backend_button cg_backend_button_back'  type='submit' value='<<< Back to gallery'  /></a><br/></div></td>";
	echo "<td align='center'><div><a href='?page=".cg_get_version()."/index.php&edit_options=true&option_id=$GalleryID' class='cg_load_backend_link'><input type='submit' class='cg_backend_button cg_backend_button_general'  value='Edit options'  /></a><br/></div></td>";
	echo "<td align='center'><div><a href='?page=".cg_get_version()."/index.php&option_id=$GalleryID&define_upload=true' class='cg_load_backend_link'><input type='submit' class='cg_backend_button cg_backend_button_general'  value='Edit upload form' /></form><br/></div></td>";
	echo "<td align='center'><div>";
		echo "<a href='?page=".cg_get_version()."/index.php&create_user_form=true&option_id=$GalleryID' class='cg_load_backend_link'><input type='hidden' name='option_id' value='$GalleryID'><input class='cg_backend_button cg_backend_button_general'  type='submit' value='Edit registration form'  /></a>";

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