<?php

echo <<<HEREDOC

<div class='cg_view_container'>

HEREDOC;


echo <<<HEREDOC

        <div class='cg_view_options_row cg_margin_bottom_30'>
            <div class='cg_view_option cg_view_option_full_width '>
                <div class='cg_view_option_title'>
                    <p>Gallery name</p>
                </div>
                <div class='cg_view_option_input'>
                    <input type="text" placeholder="Your gallery name" class="cg-long-input" id="GalleryName" name="GalleryName" maxlength="100" value="$GalleryName1">
                </div>
            </div>
        </div>
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Photo contest start options for voting and uploading<br>
                    <span class='cg_view_options_rows_container_title_note'>cg_gallery_no_voting shortcode can be also used to display gallery without voting</span>
            </p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_right_none $cgProFalse' id="ContestStartContainer">
                    <div class='cg_view_option_title'>
                        <p>Activate photo contest start time<br/><span class="cg_view_option_title_note">To rate images will be not possible.<br/>Does not work for Facebook like button.<br/>If not activated then photo contest is started.</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ContestStart" id="ContestStart"  $ContestStart  >
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_two_third_width $cgProFalse' id="cg_datepicker_start_container">
                    <div class='cg_view_option_title'>
                        <p>Select start day and time of photo contest (server time)<br/><span class="cg_view_option_title_note">You select server time here. <br> Your current server time is: $dateCurrent<br>To refresh current server time reload this window.</span></p>
                    </div>
                    <div class='cg_view_option_select'>
                        <div id='cg_datepicker_table'>
                        <input type="text" autocomplete="off" id="cg_datepicker_start"  name="ContestStartTime" value="$ContestStartTime" >
                        <input type="hidden" id="cg_datepicker_start_value_to_set" value="$ContestStartTime" >
                        <input type="number" id="cg_date_hours_contest_start" class="cg_date_hours" name="ContestStartTimeHours" placeholder="00" 
                               min="-1" max="25" value="$ContestStartTimeHours" > : 
                        <input type="number" id="cg_date_mins_contest_start" class="cg_date_mins" name="ContestStartTimeMins" placeholder="00" 
                               min="-1" max="60" value="$ContestStartTimeMins" >
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Photo contest end options for voting and uploading<br>
                    <span class='cg_view_options_rows_container_title_note'>cg_gallery_no_voting shortcode can be also used to display gallery without voting</span>
            </p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent $cgProFalse' id="ContestEndInstantContainer">
                    <div class='cg_view_option_title'>
                        <p>End photo contest immediately</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ContestEndInstant" id="ContestEndInstant"   $ContestEndInstant  > 
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_top_right_none $cgProFalse' id="ContestEndContainer">
                    <div class='cg_view_option_title'>
                        <p>Activate photo contest end time<br/><span class="cg_view_option_title_note">To rate images will be not possible anymore.<br/>Does not work for Facebook like button.</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ContestEnd" id="ContestEnd"   $ContestEnd  >
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_two_third_width cg_border_top_none $cgProFalse' id="cg_datepicker_container">
                    <div class='cg_view_option_title'>
                        <p>Select last day and time of photo contest (server time)<br/><span class="cg_view_option_title_note">You select server time here. <br> Your current server time is: $dateCurrent<br>To refresh current server time reload this window.</span></p>
                    </div>
                    <div class='cg_view_option_select'>
<input type="text" autocomplete="off" id="cg_datepicker"  name="ContestEndTime" value="$ContestEndTime" >
<input type="hidden" id="cg_datepicker_value_to_set" value="$ContestEndTime" >
<input type="number" id="cg_date_hours_contest_end" class="cg_date_hours" name="ContestEndTimeHours" placeholder="00" 
                               min="-1" max="25" value="$ContestEndTimeHours" > : 
<input type="number" id="cg_date_mins_contest_end" class="cg_date_mins" name="ContestEndTimeMins" placeholder="00" 
                               min="-1" max="60" value="$ContestEndTimeMins" >
                        </div>
                    </div>
                </div>
     </div>
     
HEREDOC;

echo <<<HEREDOC
    

    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>General gallery view options for all views<br>
            </p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent'>
                    <div class='cg_view_option_title'>
                        <p>Show constantly (without hovering)<br>vote, comments and image title in gallery view<br><span class="cg_view_option_title_note">You see it by hovering if not activated.<br>Image title can be configured in "Edit upload form" >>> "Show as title in gallery".</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ShowAlways"  $selectedShowAlways >
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $deprecatedGalleryHoverDisabledForever'>
                    <div class='cg_view_option_title'>
                        <p>Title position on gallery image<br><span class="cg_view_option_title_note">If "Show as title in gallery" in "Edit upload form" is activated </span></p>
                    </div>
                    <div class='cg_view_option_radio_multiple'>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Left
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="TitlePositionGallery" class="TitlePositionGallery cg_view_option_radio_multiple_input_field"  $selectedTitlePositionGalleryLeft  value="1">
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Center
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="TitlePositionGallery" class="TitlePositionGallery cg_view_option_radio_multiple_input_field" $selectedTitlePositionGalleryCenter  value="2">
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Right
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="TitlePositionGallery" class="TitlePositionGallery cg_view_option_radio_multiple_input_field"  $selectedTitlePositionGalleryRight  value="3">
                            </div>
                        </div>
                </div>
                $deprecatedGalleryHoverDivText
            </div>
        </div>
            
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent cg_border_top_none $cgProFalse' id="RegUserGalleryOnlyContainer">
                    <div class='cg_view_option_title'>
                        <p>Allow only registered users to see the gallery<br><span class="cg_view_option_title_note">User have to be registered and logged in to be able to see the gallery</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="RegUserGalleryOnly" id="RegUserGalleryOnly" $RegUserGalleryOnly>
                    </div>
                </div>
            </div>
            
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="wp-RegUserGalleryOnlyText-wrap-Container">
                    <div class='cg_view_option_title'>
                        <p>Show text instead of gallery</p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='RegUserGalleryOnlyText'  name='RegUserGalleryOnlyText'>$RegUserGalleryOnlyText</textarea>
                    </div>
                </div>
            </div>
            
 </div>
 
HEREDOC;

echo <<<HEREDOC

<div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Comment Options<br>
            </p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent' id="AllowCommentsContainer">
                    <div class='cg_view_option_title'>
                        <p>Allow comments</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="AllowComments"  id="AllowComments" $selectedCheckComments>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $deprecatedGalleryHoverDisabledForever' id="CommentPositionGalleryContainer">
                    <div class='cg_view_option_title'>
                        <p>Comments icon position on gallery image</p>
                    </div>
                    <div class='cg_view_option_radio_multiple'>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Left
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="CommentPositionGallery" class="CommentPositionGallery cg_view_option_radio_multiple_input_field"  id="CommentPositionGalleryLeft" $selectedCommentPositionGalleryLeft  value="1" >
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Center
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="CommentPositionGallery" class="CommentPositionGallery cg_view_option_radio_multiple_input_field" id="CommentPositionGalleryCenter"   $selectedCommentPositionGalleryCenter  value="2"  >
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Right
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="CommentPositionGallery" class="CommentPositionGallery cg_view_option_radio_multiple_input_field" id="CommentPositionGalleryRight"   $selectedCommentPositionGalleryRight  value="3" >
                            </div>
                        </div>
                </div>
                $deprecatedGalleryHoverDivText
            </div>
        </div>
            
 </div>

HEREDOC;


