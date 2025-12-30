<?php

echo <<<HEREDOC

<div class='cg_view_container'>

HEREDOC;


echo <<<HEREDOC

        <div class='cg_view_options_row cg_margin_bottom_30'>
            <div class='cg_view_option cg_view_option_100_percent'>
                <div class='cg_view_option_title'>
                    <p>Allow manipulate rating by administrator (you)<br>
                    <span class="cg_view_option_title_note">After activating and saving this option
                    just go "Back to gallery" and you will
                    be able to change rating of each image</span></p>
                </div>
                <div class='cg_view_option_checkbox'>
                    <input type="checkbox" name="Manipulate" id="Manipulate" $Manipulate>
                </div>
            </div>
        </div>
        
    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>User recognition methods</p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent CheckMethodContainer' id="CheckIpContainer" >
                    <div class='cg_view_option_title'>
                        <p>Check by IP<br/><span class="cg_view_option_title_note">IP will be tracked always$userIPunknown</span></p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="CheckMethod" class="CheckMethod" id="CheckIp" value="ip" $CheckIp>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent CheckMethodContainer cg_border_top_none $cgProFalse'  id="CheckCookieContainer"  >
                    <div class='cg_view_option_title'>
                        <p>Check by Cookie<br/><span class="cg_view_option_title_note">Cookie will be only set and tracked if this option is activated</span></p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="CheckMethod" class="CheckMethod" id="CheckCookie" value="cookie" $CheckCookie>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="CheckCookieAlertMessageContainer">
                    <div class='cg_view_option_title'>
                        <p>Check Cookie alert message if user browser does not allow cookies</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" class="cg-long-input" placeholder="Please allow cookies to vote" id="CheckCookieAlertMessage" name="CheckCookieAlertMessage" maxlength="1000" value="$CheckCookieAlertMessage">
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent CheckMethodContainer cg_border_top_none $cgProFalse'   id="CheckLoginContainer"   >
                    <div class='cg_view_option_title'>
                        <p>Check if is registered user<br/><span class="cg_view_option_title_note">User have to be registered and logged in to be able to vote <br>User WordPress ID based voting  – uncheatable<br>User WordPress ID will be always tracked if user is logged in.</span></p>
                    </div>
                    <div class='cg_view_option_radio'>
                        <input type="radio" name="CheckMethod" class="CheckMethod" id="CheckLogin" value="login" $CheckLogin>
                    </div>
                </div>
            </div>
    </div>
HEREDOC;
echo <<<HEREDOC

    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Limit votes</p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_right_none' id="VotePerCategoryContainer" >
                    <div class='cg_view_option_title'>
                        <p>One vote per category<br/><span class="cg_view_option_title_note">For every category can be voted only one time by a user. Categories field with categories has to be added in "Edit upload form".</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="VotePerCategory"  id="VotePerCategory" $VotePerCategory>
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_50_percent $cgProFalse' id="VotesPerCategoryContainer" >
                    <div class='cg_view_option_title'>
                        <p>Votes per category<br/><span class="cg_view_option_title_note">0 or empty = no limit</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="VotesPerCategory" id="VotesPerCategory" maxlength="3" value="$VotesPerCategory">
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none $cgProFalse' id="IpBlockContainer" >
                    <div class='cg_view_option_title'>
                        <p>One vote per picture<br/><span class="cg_view_option_title_note">Every picture can be voted only one time by a user</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="IpBlock"  id="IpBlock" $selectedCheckIp>
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_none $cgProFalse' id="VotesPerUserContainer" >
                    <div class='cg_view_option_title'>
                        <p>Votes per user<br/><span class="cg_view_option_title_note">0 or empty = no limit</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="VotesPerUser" id="VotesPerUser" maxlength="3" value="$VotesPerUser">
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="VotesPerUserAllVotesUsedHtmlMessageContainer" >
                    <div class='cg_view_option_title'>
                        <p>Show this HTML content instead of translation message when all "Votes per user" are used<br/><span class="cg_view_option_title_note">If empty then 
<a class="cg_go_to_link cg_no_outline_and_shadow_on_focus" href="#" data-cg-go-to-link="l_AllVotesUsed">translation</a> will be shown</span></p>
                    </div>
                    <div class='cg_view_option_html'>
                        <textarea class='cg-wp-editor-template' id='VotesPerUserAllVotesUsedHtmlMessage'  name='VotesPerUserAllVotesUsedHtmlMessage'>$VotesPerUserAllVotesUsedHtmlMessage</textarea>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_100_percent cg_border_top_none $cgProFalse' id="VoteNotOwnImageContainer" >
                    <div class='cg_view_option_title'>
                        <p>Voting of self-added picture is not allowed<br/><span class="cg_view_option_title_note">User can not vote own uploaded image. Works only for voting recognition methods:<br>- Check by IP (images added since version 10.9.3.7)<br> - Check by registration</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="VoteNotOwnImage"  id="VoteNotOwnImage" $VoteNotOwnImage>
                    </div>
                </div>
            </div>
    </div>
HEREDOC;
echo <<<HEREDOC

    <div class='cg_view_options_rows_container'>
        <p class='cg_view_options_rows_container_title'>Voting configuration</p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_right_none' id="AllowRating2Container" >
                    <div class='cg_view_option_title'>
                        <p>Allow vote via 1 star rating</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="AllowRating2" id="AllowRating2" $selectedCheckRating2>
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_50_percent' >
                    <div class='cg_view_option_content'>
                      <div>
                        <a class="cg-rating-reset" href="?page=$cg_get_version/index.php&edit_options=true&option_id=$galeryNR&reset_votes2=true" id="cg_reset_votes2" >
                        <button type="button">Reset votes completely</button></a></div>
                        <div>
                        <a class="cg-rating-reset"
                         href="?page=$cg_get_version/index.php&edit_options=true&option_id=$galeryNR&reset_users_votes2=true" id="cg_reset_users_votes2">
                        <button type="button">Reset users votes only</button></a></div>
                        <div>
                        <a class="cg-rating-reset cg-rating-reset-administrator-votes"
                         href="?page=$cg_get_version/index.php&edit_options=true&option_id=$galeryNR&reset_admin_votes2=true" id="cg_reset_admin_votes2">
                        <button type="button">Reset administrator votes only</button></a></div>
                        <span class='cg-info-container' id='cg_reset_votes2_explanation' style='display: none;'>
                        - Images with 1 star votes counter will be deleted (starts with 0 again)<br>- All tracked users 1 star voting data for every image will be also deleted<br>- By Administrator manually added votes will be not deleted
                        </span>
                        <span class='cg-info-container' id='cg_reset_users_votes2_explanation' style='display: none;'>
                        - Images with 1 star votes counter will be not deleted<br>- All tracked users 1 star voting data for every image will be deleted<br>- Users can start vote again if their used all their votes<br>- By Administrator manually added votes will be not deleted
                        </span>
                        <span class='cg-info-container' id='cg_reset_admin_votes2_explanation' style='display: none;'>
                        - Images with 1 star votes counter will be not deleted<br>- All tracked users 1 star voting data for every image will be not deleted<br>- By administrator through manipulation added votes will be deleted
                        </span>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none' id="AllowRatingContainer" >
                    <div class='cg_view_option_title'>
                        <p>Allow vote via 5 star rating</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="AllowRating" id="AllowRating" $selectedCheckRating>
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_none' >
                    <div class='cg_view_option_content'>
                      <div>
                        <a class="cg-rating-reset"
                         href="?page=$cg_get_version/index.php&edit_options=true&option_id=$galeryNR&reset_votes=true" id="cg_reset_votes">
                        <button type="button">Reset votes completely</button></a></div>
                        <div>
                        <a class="cg-rating-reset" 
                        href="?page=$cg_get_version/index.php&edit_options=true&option_id=$galeryNR&reset_users_votes=true" id="cg_reset_users_votes"><button type="button">Reset users votes only</button></a></div>
                        <div>
                        <a class="cg-rating-reset cg-rating-reset-administrator-votes" 
                          href="?page=$cg_get_version/index.php&edit_options=true&option_id=$galeryNR&reset_admin_votes=true" id="cg_reset_admin_votes">
                        <button type="button">Reset administrator votes only</button></a></div>
                        <span class='cg-info-container' id='cg_reset_votes_explanation' style='display: none;'>
                        - Images with 5 stars votes counter will be deleted (starts with 0 again)<br>- All tracked users 5 stars voting data for every image will be also deleted<br>- By Administrator manually added votes will be not deleted
                        </span>
                        <span class='cg-info-container' id='cg_reset_users_votes_explanation' style='display: none;'>
                        - Images with 5 stars votes counter will be not deleted<br>- All tracked users 5 stars voting data for every image will be deleted<br>- Users can start vote again if their used all their votes<br>- By Administrator manually added votes will be not deleted
                        </span>
                        <span class='cg-info-container' id='cg_reset_admin_votes_explanation' style='display: none;'>
                        - Images with 5 stars votes counter will be not deleted<br>- All tracked users 5 stars voting data for every image will be not deleted<br>- By administrator through manipulation added votes will be deleted
                        </span>
                    </div>
                </div>
            </div>
HEREDOC;

echo <<<HEREDOC
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none' id="RatingOutGalleryContainer" >
                    <div class='cg_view_option_title'>
                        <p>Allow vote out of gallery<br/><span class="cg_view_option_title_note">It is not necessary to open image for voting, just vote out of gallery</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="RatingOutGallery" id="RatingOutGallery" $selectedRatingOutGallery>
                    </div>
                </div>
                <div class='cg_view_option cg_view_option_half_width cg_border_top_none $deprecatedGalleryHoverDisabledForever' id="RatingPositionGalleryContainer" >
                    <div class='cg_view_option_title'>
                        <p>Rating star position on gallery image</p>
                    </div>
                    <div class='cg_view_option_radio_multiple'>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Left
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="RatingPositionGallery" class="RatingPositionGallery cg_view_option_radio_multiple_input_field" $selectedRatingPositionGalleryLeft value="1" >
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Center
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="RatingPositionGallery" class="RatingPositionGallery cg_view_option_radio_multiple_input_field" $selectedRatingPositionGalleryCenter value="2" >
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Right
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="RatingPositionGallery" class="RatingPositionGallery cg_view_option_radio_multiple_input_field" $selectedRatingPositionGalleryRight value="3" >
                            </div>
                        </div>
                </div>
                $deprecatedGalleryHoverDivText
                </div>
            </div>
HEREDOC;

echo <<<HEREDOC
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none $cgProFalse' id="ShowOnlyUsersVotesContainer" >
                    <div class='cg_view_option_title'>
                        <p>Show only user votes<br/><span class="cg_view_option_title_note">User see only his votes not the whole rating</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ShowOnlyUsersVotes" id="ShowOnlyUsersVotes" $ShowOnlyUsersVotes>
                    </div>
                </div>
               <div class='cg_view_option cg_view_option_50_percent cg_border_top_none $cgProFalse' id="HideUntilVoteContainer" >
                    <div class='cg_view_option_title'>
                        <p>Hide rating of a picture<br/>until user voted for this picture</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="HideUntilVote" id="HideUntilVote" $HideUntilVote>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
               <div class='cg_view_option cg_view_option_100_percent cg_border_top_none $cgProFalse' id="MinusVoteContainer" >
                    <div class='cg_view_option_title'>
                        <p>Delete votes<br/><span class="cg_view_option_title_note">Frontend users can delete their votes<br>and give them to another picture</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="MinusVote" id="MinusVote" $MinusVote>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none $cgProFalse' id="VotesInTimeContainer" >
                    <div class='cg_view_option_title'>
                        <p>Votes in time interval per user</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="VotesInTime" id="VotesInTime" $VotesInTime>
                    </div>
                </div>
               <div class='cg_view_option cg_view_option_50_percent cg_border_top_none $cgProFalse' id="VotesInTimeQuantityContainer" >
                    <div class='cg_view_option_title'>
                        <p>Votes in time interval per user amount<br/>(empty = 1)</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" placeholder="1" name="VotesInTimeQuantity" id="VotesInTimeQuantity" maxlength="3" value="$VotesInTimeQuantity">
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_half_width cg_border_top_right_none $cgProFalse' id="VotesInTimeHoursMinutesContainer" >
                    <div class='cg_view_option_title'>
                        <p>Votes in time interval per user interval<br/><span class="cg_view_option_title_note">(Hours:Minutes)</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="number" id="cg_date_hours_vote_interval" class="cg_date_hours_unlimited" name="cg_date_hours_vote_interval" placeholder="0" min="-1" max="1000" value="$cg_date_hours_vote_interval" maxlength="3" style="width:60px;" >
                        <input type="number" id="cg_date_mins_vote_interval" class="cg_date_mins" name="cg_date_mins_vote_interval" placeholder="00" 
       min="-1" max="60" value="$cg_date_mins_vote_interval" style="width:60px;" >
                    </div>
                </div>
               <div class='cg_view_option cg_view_option_half_width cg_border_top_none $cgProFalse' id="VotesInTimeIntervalAlertMessageContainer" >
                    <div class='cg_view_option_title'>
                        <p>Votes in time interval per user<br/>alert message</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" placeholder="You can vote only 1 time per day" name="VotesInTimeIntervalAlertMessage" id="VotesInTimeIntervalAlertMessage" maxlength="200" value="$VotesInTimeIntervalAlertMessage">
                    </div>
                </div>
            </div>
    </div>

HEREDOC;

$FbLikeNoShareChecked = '';
if(!empty($FbLikeNoShare)){
    $FbLikeNoShareChecked = '';
}

echo <<<HEREDOC
    <div class='cg_view_options_rows_container'>
            <p class='cg_view_options_rows_container_title'>Facebook like button options</p>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_right_none' id="FbLikeContainer" >
                    <div class='cg_view_option_title'>
                        <p>Vote via Facebook like button<br/><span class="cg_view_option_title_note">New fields will be added to images backend area and also new field types will be added to upload form if activated. Upload form field types are connected to images backend area fields.</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="FbLike" id="FbLike" $selectedCheckFbLike>
                    </div>
                </div>
               <div class='cg_view_option cg_view_option_50_percent' id="FbLikeGalleryContainer" >
                    <div class='cg_view_option_title'>
                        <p>Show Facebook like button out of gallery<br><span class="cg_view_option_title_note">Slower browser loading of gallery. Needs more computing power. Pagination with not so many images at one step is better in that case. Will be not shown in small images overview of slider.</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="FbLikeGallery" id="FbLikeGallery" $selectedCheckFbLikeGallery>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none $cgProFalse' id="FbLikeNoShareContainer" >
                    <div class='cg_view_option_title'>
                        <p>Hide Facebook share button</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="FbLikeNoShare" id="FbLikeNoShare" $FbLikeNoShare>
                    </div>
                </div>
               <div class='cg_view_option cg_view_option_50_percent cg_border_top_none $cgProFalse' id="FbLikeOnlyShareContainer" >
                    <div class='cg_view_option_title'>
                        <p>Show Facebook share button only</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="FbLikeOnlyShare" id="FbLikeOnlyShare" $FbLikeOnlyShare>
                    </div>
                </div>
            </div>
            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse' id="FbLikeGoToGalleryLinkContainer" >
                    <div class='cg_view_option_title'>
                        <p>Gallery shortcode URL for Facebook share button<br><span class="cg_view_option_title_note">It will be forwarded to this page when Facebook share button is used</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type='text' class='' name='FbLikeGoToGalleryLink' id='FbLikeGoToGalleryLink' maxlength='1000' placeholder='$FbLikeGoToGalleryLinkPlaceholder' value='$FbLikeGoToGalleryLink'>
                    </div>
                </div>
            </div>
    </div>

HEREDOC;

echo <<<HEREDOC
</div>
HEREDOC;


