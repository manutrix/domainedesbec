<?php

/*                echo "SELECT
                                                DISTINCT $tablename.*
                                                FROM
                                                  $tablename,
                                                  $tablenameentries
                                                WHERE
                                                  ($tablename.GalleryID = $GalleryID AND
                                                  $tablenameentries.GalleryID = $GalleryID AND
                                                  $tablename.id = $tablenameentries.pid AND
                                                  ($tablenameentries.Short_Text like '%$search%' OR $tablenameentries.Long_Text = '%$search%'))
                                                  UNION
                                                 SELECT
                                                DISTINCT $tablename.*
                                                FROM
                                                  $tablename,
                                                  $tablename_categories
                                                WHERE
                                                  ($tablename.GalleryID = $GalleryID AND
                                                  $tablename_categories.GalleryID = $GalleryID AND
                                                  $tablename.GalleryID = $GalleryID AND
                                                  $tablename.Category = $tablename_categories.id AND
                                                  ($tablename_categories.GalleryID = $GalleryID AND $tablename_categories.Name LIKE '%$search%'))
                                            ";*/

$orderBy = 'rowid';
switch($order){
    case 'date_desc': $orderBy ='rowid'; break;
    case 'date_asc': $orderBy ='rowid'; break;
    case 'rating_desc': $orderBy = ($AllowRating==1) ? 'CountR' : 'CountS'; break;
    case 'rating_asc': $orderBy = ($AllowRating==1) ? 'CountR' : 'CountS'; break;
    case 'comments_desc': $orderBy ='CountC'; break;
    case 'comments_asc': $orderBy ='CountC';
}

$direction = 'DESC';
switch($order){
    case 'date_desc': $direction ='DESC'; break;
    case 'date_asc': $direction ='ASC'; break;
    case 'rating_desc': $direction = 'DESC'; break;
    case 'rating_asc': $direction = 'ASC'; break;
    case 'comments_desc': $direction ='DESC'; break;
    case 'comments_asc': $direction ='ASC';
}

$orderByCount = '';

if($order=='rating_desc_with_manip'){
    if($AllowRating==1){
        $orderByCount = ", $tablename.CountR + $tablename.addCountR1 + $tablename.addCountR2 + $tablename.addCountR3 + $tablename.addCountR4 + $tablename.addCountR5 as totalCountR ";
        $orderBy = 'totalCountR';
        $direction = 'DESC';
    }
    if($AllowRating==2){
        $orderByCount = ", $tablename.CountS + $tablename.addCountS  as totalCountS ";
        $orderBy = 'totalCountS';
        $direction = 'DESC';
    }
}

if($order=='rating_asc_with_manip'){
    if($AllowRating==1){
        $orderByCount = ", $tablename.CountR + $tablename.addCountR1 + $tablename.addCountR2 + $tablename.addCountR3 + $tablename.addCountR4 + $tablename.addCountR5 as totalCountR ";
        $orderBy = 'totalCountR';
        $direction = 'ASC';
    }
    if($AllowRating==2){
        $orderByCount = ", $tablename.CountS + $tablename.addCountS  as totalCountS ";
        $orderBy = 'totalCountS';
        $direction = 'ASC';
    }
}

$checkCookieIdOrIP = '';

/*if($pro_options->RegUserUploadOnly=='2'){
    $checkCookieIdOrIP = "SELECT
                                    DISTINCT $tablename.*$orderByCount
                                    FROM
                                      $tablename
                                    WHERE
                                      $tablename.GalleryID = $GalleryID AND
                                      $tablename.CookieId LIKE '%$search%'
                                      UNION";
}else if($pro_options->RegUserUploadOnly=='3'){
    $checkCookieIdOrIP = "SELECT
                                    DISTINCT $tablename.*$orderByCount
                                    FROM
                                      $tablename
                                    WHERE
                                      $tablename.GalleryID = $GalleryID AND
                                      $tablename.IP LIKE '%$search%'
                                      UNION";
}*/

$selectWinnersOnly = 'AND';
if(!empty($_POST['cg_show_only_winners'])){
    $selectWinnersOnly = "AND $tablename.Winner = 1 ";
}

$selectActiveOnly = '';

if(!empty($_POST['cg_show_only_active'])){
    if(empty($_POST['cg_show_only_winners'])){
        $selectWinnersOnly = "";
    }
    $selectActiveOnly = " AND $tablename.Active = 1 ";
}

$selectInactiveOnly = '';

if(!empty($_POST['cg_show_only_inactive'])){
    if(empty($_POST['cg_show_only_winners'])){
        $selectWinnersOnly = "";
    }
    $selectInactiveOnly = " AND $tablename.Active = 0 ";
}

if(empty($_POST['cg_show_only_winners']) AND empty($_POST['cg_show_only_active']) AND empty($_POST['cg_show_only_inactive'])){
    $selectWinnersOnly = "";
}

//    var_dump("$selectWinnersOnly$selectActiveOnly$selectInactiveOnly" );
//  var_dump("$search" );

// partial connect with max two tables at same time, otherwise load to long!!!
$countSearchSQL = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM (
                                                $checkCookieIdOrIP
                                                SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $tablenameentries
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND                                            
                                                  $tablenameentries.GalleryID = $GalleryID AND 
                                                  $tablename.id = $tablenameentries.pid AND 
                                                  ($tablenameentries.Short_Text like '%$search%' OR $tablenameentries.Long_Text like '%$search%' OR $tablename.id like '%$search%' OR $tablename.Exif like '%$search%')
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $tablename_categories
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename_categories.GalleryID = $GalleryID AND 
                                                  $tablename.Category = $tablename_categories.id AND 
                                                  ($tablename_categories.GalleryID = $GalleryID AND $tablename_categories.Name LIKE '%$search%')
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $table_posts
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename.WpUpload = $table_posts.ID AND 
                                                  ($table_posts.post_content LIKE '%$search%' OR $table_posts.post_title LIKE '%$search%' OR $table_posts.post_name LIKE '%$search%')
                                                 UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $wpUsers
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename.WpUserId = $wpUsers.ID AND 
                                                  ($wpUsers.user_login LIKE '%$search%' OR $wpUsers.user_nicename LIKE '%$search%' OR $wpUsers.user_email LIKE '%$search%' OR $wpUsers.display_name LIKE '%$search%')
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename.id LIKE '%$search%' 
                                                  ) A
                                            ");

// partial connect with max two tables at same time, otherwise load to long!!!
$selectSQL = $wpdb->get_results( "SELECT * FROM (
                                                $checkCookieIdOrIP
                                                SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $tablenameentries
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablenameentries.GalleryID = $GalleryID AND 
                                                  $tablename.id = $tablenameentries.pid AND 
                                                  ($tablenameentries.Short_Text like '%$search%' OR $tablenameentries.Long_Text like '%$search%' OR $tablename.id like '%$search%' OR $tablename.Exif like '%$search%') AND 
                                                  $tablenameentries.f_input_id >= 1 
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $tablename_categories
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename_categories.GalleryID = $GalleryID AND 
                                                  $tablename.Category = $tablename_categories.id AND 
                                                  ($tablename_categories.GalleryID = $GalleryID AND $tablename_categories.Name LIKE '%$search%')
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $table_posts
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename.WpUpload = $table_posts.ID AND 
                                                  ($table_posts.post_content LIKE '%$search%' OR $table_posts.post_title LIKE '%$search%' OR $table_posts.post_name LIKE '%$search%')
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename,
                                                  $wpUsers
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename.WpUserId = $wpUsers.ID AND 
                                                  ($wpUsers.user_login LIKE '%$search%' OR $wpUsers.user_nicename LIKE '%$search%' OR $wpUsers.user_email LIKE '%$search%' OR $wpUsers.display_name LIKE '%$search%')
                                                  UNION
                                                 SELECT 
                                                DISTINCT $tablename.*$orderByCount
                                                FROM 
                                                  $tablename
                                                WHERE 
                                                  $tablename.GalleryID = $GalleryID  
                                                  $selectWinnersOnly$selectActiveOnly$selectInactiveOnly AND  
                                                  $tablename.id LIKE '%$search%' 
                                                  ) A
                                                 group by id order by $orderBy $direction LIMIT $start, $step
                                            ");

//  echo "<br>";
//   echo "<br>";
//  var_dump(count($selectSQL));die;

?>