<?php

$selectWinnersOnly = '';
if (!empty($_POST['cg_show_only_winners'])) {
    $selectWinnersOnly = " AND Winner = 1 ";
}

$selectActiveOnly = '';

if (!empty($_POST['cg_show_only_active'])) {
    $selectActiveOnly = " AND Active = 1 ";
}

$selectInactiveOnly = '';

if (!empty($_POST['cg_show_only_inactive'])) {
    $selectInactiveOnly = " AND Active = 0 ";
}

if ($order == 'date_desc') {
    $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY rowid DESC LIMIT $start, $step ");
}

if ($order == 'date_asc') {
    $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY rowid ASC LIMIT $start, $step ");
}

if ($order == 'rating_desc') {
    if ($AllowRating == 1) {
        $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY CountR DESC, rowid DESC LIMIT $start, $step ");
    }
    if ($AllowRating == 2) {
        $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY CountS DESC, rowid DESC LIMIT $start, $step ");
    }
}

if ($order == 'rating_asc') {
    if ($AllowRating == 1) {
        $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY CountR ASC, rowid DESC LIMIT $start, $step ");
    }
    if ($AllowRating == 2) {
        $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY CountS ASC, rowid DESC LIMIT $start, $step ");
    }
}

if ($order == 'rating_desc_with_manip') {
    if ($AllowRating == 1) {
        $selectSQL = $wpdb->get_results("SELECT *, CountR + addCountR1 + addCountR2 + addCountR3 + addCountR4 + addCountR5 as totalCountR  FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY totalCountR DESC, rowid DESC LIMIT $start, $step ");
    }
    if ($AllowRating == 2) {
        $selectSQL = $wpdb->get_results("SELECT *, CountS + addCountS  as totalCountS  FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY totalCountS DESC, rowid DESC LIMIT $start, $step ");
    }
}

if ($order == 'rating_asc_with_manip') {
    if ($AllowRating == 1) {
        $selectSQL = $wpdb->get_results("SELECT *, CountR + addCountR1 + addCountR2 + addCountR3 + addCountR4 + addCountR5 as totalCountR  FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY totalCountR ASC, rowid DESC LIMIT $start, $step ");
    }
    if ($AllowRating == 2) {
        $selectSQL = $wpdb->get_results("SELECT *, CountS + addCountS  as totalCountS  FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY totalCountS ASC, rowid DESC LIMIT $start, $step ");
    }
}

if ($order == 'comments_desc') {
    $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY CountC DESC, rowid DESC LIMIT $start, $step ");
}

if ($order == 'comments_asc') {
    $selectSQL = $wpdb->get_results("SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' $selectWinnersOnly$selectActiveOnly$selectInactiveOnly ORDER BY CountC ASC, rowid DESC LIMIT $start, $step ");
}

?>