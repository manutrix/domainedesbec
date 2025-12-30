<?php


echo <<<HEREDOC

<div class="cg_view cgMultiplePicsOptions cg_short_code_multiple_pics_configuration_cg_gallery_no_voting_container cg_short_code_multiple_pics_configuration_container cg_hide cgViewHelper1">
<p style="text-align: center;font-size: 14px;margin-bottom: 15px;margin-top:0;"><b>NOTE:</b> Sort by voting and preselect by voting is not possible and not visible for cg_gallery_no_voting shortcode</p>
<div class='cg_view_container'>

HEREDOC;

if(!empty($jsonOptions[$galeryNR.'-nv']['visual']['AllowSortOptions'])){
    $AllowSortOptionsArrayCgGalleryNoVoting = explode(',',$jsonOptions[$galeryNR.'-nv']['visual']['AllowSortOptions']);
}else{
    $AllowSortOptionsArrayCgGalleryNoVoting = array();
}

echo <<<HEREDOC

<div class='cg_view_options_row'>
    <div class='cg_view_option'>
        <div class='cg_view_option_title'>
        <p>Number of images per screen<br><span class="cg_view_option_title_note">Pagination</span></p>
        </div>
        <div class='cg_view_option_input'>
        <input type="text" name="multiple-pics[cg_gallery_no_voting][general][PicsPerSite]" class="PicsPerSite" maxlength="3" value="{$jsonOptions["$GalleryID-nv"]["general"]["PicsPerSite"]}">
        </div>
    </div>

    <div  class='cg_view_option cg_border_left_right_none'>
        <div class='cg_view_option_title'>
        <p>Enable full window button</p>
        </div>
        <div class='cg_view_option_checkbox'>
        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][FullSizeGallery]" class="cg_shortcode_checkbox FullSizeGallery" checked="{$jsonOptions["$GalleryID-nv"]["general"]["FullSizeGallery"]}"><br/>
        </div>
    </div>

    <div  class='cg_view_option'>
        <div  class='cg_view_option_title'>
        <p>Enable full screen button<br><span class="cg_view_option_title_note">Will appear when joining full window</span></p>
        </div>
        <div class='cg_view_option_checkbox'>
        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][FullSize]" class="cg_shortcode_checkbox FullSize" checked="{$jsonOptions["$GalleryID-nv"]["general"]["FullSize"]}"><br/>
        </div>
    </div>
</div>

HEREDOC;

echo <<<HEREDOC


<div class='cg_view_options_row'>
    <div  class='cg_view_option cg_view_option_50_percent cg_border_top_right_bottom_none'>
        <div class='cg_view_option_title'>
        <p>Allow search for images<br/><span class="cg_view_option_title_note">Search by fields content, categories, picture name or EXIF data - if available</span></p>
        </div>
        <div  class='cg_view_option_checkbox'>
        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][pro][Search]" class="cg_shortcode_checkbox Search" checked="{$jsonOptions["$GalleryID-nv"]["pro"]["Search"]}">
        </div>
    </div>

    <div  class='cg_view_option cg_view_option_50_percent cg_border_top_bottom_none AllowSortContainer'>
        <div class='cg_view_option_title'>
        <p>Allow sort<br/><span class="cg_view_option_title_note">Order by rating is not available if <br>"Show only user votes" or <br>"Hide voting until user vote" is activated</span></p>
        </div>
        <div  class='cg_view_option_checkbox'>
                <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][AllowSort]" class="cg_shortcode_checkbox AllowSort" checked="{$jsonOptions["$GalleryID-nv"]["general"]["AllowSort"]}">
        </div>
    </div>
</div>

<div class='cg_view_options_row'>
    <div class='cg_view_option cg_view_option_full_width cgAllowSortOptionsContainerMain'>
        <div class='cg_view_option_title'>
        <p>Allow sort options<br><span class="cgAllowSortDependsOnMessage cg_hide" >Allow sort has to be activated</span></p>
        </div>
        <div>
HEREDOC;

$cgDateDescSortCheck = (in_array('date-desc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgDateAscSortCheck = (in_array('date-asc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgRateDescSortCheck = (in_array('rate-desc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgRateAscSortCheck = (in_array('rate-asc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgRateDescAverageSortCheck = (in_array('rate-average-desc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgRateAscAverageSortCheck = (in_array('rate-average-asc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgCommentDescSortCheck = (in_array('comment-desc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgCommentAscSortCheck = (in_array('comment-asc',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';
$cgRandomSortCheck = (in_array('random',$AllowSortOptionsArrayCgGalleryNoVoting)) ? '' : 'cg_unchecked';


echo <<<HEREDOC

        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='date-desc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='date-asc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='rate-desc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='rate-asc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='rate-average-desc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='rate-average-asc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='comment-desc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='comment-asc' class='cg-allow-sort-input' />
        <input type='hidden' name='multiple-pics[cg_gallery_no_voting][visual][AllowSortOptionsArray][]' value='random' class='cg-allow-sort-input' />

        <div class="cgAllowSortOptionsContainer">
        <label class="cg-allow-sort-option $cgDateDescSortCheck" data-cg-target="date-desc"><span class="cg-allow-sort-option-cat">Date desc</span><span class="cg-allow-sort-option-icon"></span></label>
        <label class="cg-allow-sort-option $cgDateAscSortCheck" data-cg-target="date-asc"><span class="cg-allow-sort-option-cat">Date asc</span><span class="cg-allow-sort-option-icon"></span></label>
        <label class="cg-allow-sort-option $cgCommentDescSortCheck" data-cg-target="comment-desc"><span class="cg-allow-sort-option-cat">Comments desc</span><span class="cg-allow-sort-option-icon"></span></label>
        <label class="cg-allow-sort-option $cgCommentAscSortCheck" data-cg-target="comment-asc"><span class="cg-allow-sort-option-cat">Comments asc</span><span class="cg-allow-sort-option-icon"></span></label>
        <label class="cg-allow-sort-option $cgRandomSortCheck" data-cg-target="random"><span class="cg-allow-sort-option-cat">Random</span><span class="cg-allow-sort-option-icon"></span></label>
        </div>
        </div>
    </div>
</div>

HEREDOC;

echo <<<HEREDOC

<div class='cg_view_options_row'>

    <div class='cg_view_option cg_view_option_flex_flow_column cg_border_top_none PreselectSortContainer'>
        <div class='cg_view_option_title cg_view_option_title_full_width'>
            <p>Preselect order when page loads<br><span class="cgPreselectSortMessage cg_view_option_title_note">Random sort has to be deactivated</span></p>
        </div>
        <div class='cg_view_option_select'>
        <select name='multiple-pics[cg_gallery_no_voting][pro][PreselectSort]' class='PreselectSort'>
HEREDOC;


$PreselectSort_date_descend_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='date_descend') ? 'selected' : '';
$PreselectSort_date_ascend_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='date_ascend') ? 'selected' : '';
$PreselectSort_rating_descend_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='rating_descend') ? 'selected' : '';
$PreselectSort_rating_ascend_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='rating_ascend') ? 'selected' : '';
$PreselectSort_rating_descend_average_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='rating_descend_average') ? 'selected' : '';
$PreselectSort_rating_ascend_average_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='rating_ascend_average') ? 'selected' : '';
$PreselectSort_comments_descend_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='comments_descend') ? 'selected' : '';
$PreselectSort_comments_ascend_selected = ($jsonOptions[$GalleryID.'-nv']['pro']['PreselectSort']=='comments_ascend') ? 'selected' : '';


echo <<<HEREDOC

        <option value='date_descend' $PreselectSort_date_descend_selected>Date descending</option>
        <option value='date_ascend' $PreselectSort_date_ascend_selected>Date ascending</option>
        <option value='comments_descend' $PreselectSort_comments_descend_selected>Comments descending</option>
        <option value='comments_ascend' $PreselectSort_comments_ascend_selected>Comments ascending</option>
        </select>
        </div>

    </div>

    <div class='cg_view_option cg_border_top_right_left_none RandomSortContainer'>
        <div class='cg_view_option_title'>
            <p>Random sort<br><span class="cg_view_option_title_note">Each page load.<br>Random sort option<br>will be preselected<br>if allow sort is activated.</span></p>
        </div>
        <div  class='cg_view_option_checkbox'>
            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][RandomSort]" class="cg_shortcode_checkbox RandomSort" checked="{$jsonOptions["$GalleryID-nv"]["general"]["RandomSort"]}"><br/>
        </div>
    </div>

    <div class='cg_view_option cg_border_top_none'>
        <div class='cg_view_option_title'>
            <p>Random sort button</p>
        </div>
        <div  class='cg_view_option_checkbox'>
            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][RandomSortButton]" class="cg_shortcode_checkbox RandomSortButton"  checked="{$jsonOptions["$GalleryID-nv"]["general"]["RandomSortButton"]}"><br/>
        </div>
    </div>

</div>

HEREDOC;

if(empty($jsonOptions[$GalleryID.'-nv'])){
    $FeControlsStyleWhiteChecked = 'checked';
}else{
    $FeControlsStyleWhiteChecked = ($jsonOptions[$GalleryID.'-nv']['visual']['FeControlsStyle']=='white') ? 'checked' : '';
}

if(empty($jsonOptions[$GalleryID.'-nv'])){
    $FeControlsStyleBlackChecked = '';
}else{
    $FeControlsStyleBlackChecked = ($jsonOptions[$GalleryID.'-nv']['visual']['FeControlsStyle']=='black') ? 'checked' : '0';
}

// add BorderRadius here
if (!isset($jsonOptions[$GalleryID.'-nv']['visual']['BorderRadius'])) {
    if(!empty($BorderRadius)){
        $jsonOptions[$GalleryID.'-nv']['visual']['BorderRadius'] = 1;
    }else{
        $jsonOptions[$GalleryID.'-nv']['visual']['BorderRadius'] = 0;
    }
}

echo <<<HEREDOC

<div class="cg_view_options_row">
        <div class="cg_view_option cg_view_option_100_percent cg_border_top_none" id="BorderRadiusContainer">
            <div class="cg_view_option_title">
                <p>NEW! Round borders for all control elements and containers</p>
            </div>
            <div class="cg_view_option_checkbox cg_view_option_checked">
                <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][visual][BorderRadius]" class="cg_shortcode_checkbox BorderRadius" checked="{$jsonOptions[$GalleryID.'-nv']['visual']['BorderRadius']}">
            </div>
        </div>
</div>

<div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none'>
                    <div class='cg_view_option_title'>
                        <p>Top controls color style<br><span class="cg_view_option_title_note">Spinning loader color is also included</span><br><a class="cg_go_to_image_view_background_style" href="#cgGoToImageViewBackgroundStyle">Opened image background color<br>can be configured here</a></p>
                    </div>
                    <div class='cg_view_option_radio_multiple'>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Bright color
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="multiple-pics[cg_gallery_no_voting][visual][FeControlsStyle]" class="FeControlsStyleWhite cg_view_option_radio_multiple_input_field" $FeControlsStyleWhiteChecked value="white"/>
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Dark color
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="multiple-pics[cg_gallery_no_voting][visual][FeControlsStyle]" class="FeControlsStyleBlack cg_view_option_radio_multiple_input_field" $FeControlsStyleBlackChecked value="black">
                            </div>
                        </div>
                </div>
            </div>
</div>

<div class='cg_view_options_row'>
    <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none GalleryUploadContainer'>
        <div class='cg_view_option_title'>
            <p>In gallery upload form button</p>
        </div>
        <div class='cg_view_option_checkbox'>
HEREDOC;

if($isModernOptionsNew){
    $jsonOptions[$GalleryID.'-nv']['pro']['GalleryUpload'] = 1;
}

echo <<<HEREDOC

<input class='cg_shortcode_checkbox GalleryUpload' type='checkbox' name='multiple-pics[cg_gallery_no_voting][pro][GalleryUpload]' checked="{$jsonOptions["$GalleryID-nv"]["pro"]["GalleryUpload"]}" >
        </div>
    </div>

    <div class='cg_view_option cg_view_option_50_percent cg_border_top_none'>
        <div class='cg_view_option_title cg_view_option_title_flex_flow_column'>
            <p>In gallery upload form text configuration</p>
            <a class="cg_no_outline_and_shadow_on_focus" href="#cgInGalleryUploadFormConfiguration"><p>Can be configured here...</p></a>
        </div>
    </div>


</div>

</div>

HEREDOC;


//print_r($order);

$showSliderViewOption = false;
$showSliderViewOptionSet = false;

if(!in_array("SliderLookOrder",$order)){
    $showSliderViewOption = true;
}

$showBlogViewOption = false;
$showBlogViewOptionSet = false;

if(!in_array("BlogLookOrder",$order)){
    $showBlogViewOption = true;
}

$i = 0;

if(!empty($jsonOptions[$GalleryID.'-nv']['general']['ThumbLookOrder'])){
    $order = array();
    $order[$jsonOptions[$GalleryID.'-nv']['general']['ThumbLookOrder']] = 'ThumbLookOrder';
    $order[$jsonOptions[$GalleryID.'-nv']['general']['SliderLookOrder']] = 'SliderLookOrder';
    $order[$jsonOptions[$GalleryID.'-nv']['general']['HeightLookOrder']] = 'HeightLookOrder';
    $order[$jsonOptions[$GalleryID.'-nv']['general']['RowLookOrder']] = 'RowLookOrder';

    if(empty($jsonOptions[$GalleryID.'-nv']['visual']['BlogLookOrder'])){
        $jsonOptions[$GalleryID.'-nv']['visual']['BlogLookOrder'] = 5;
    }

    $order[$jsonOptions[$GalleryID.'-nv']['visual']['BlogLookOrder']] = 'BlogLookOrder';

    ksort($order);

}else{
    $order = $order;
}


// add BlogLook here
$jsonOptions[$GalleryID.'-nv']['visual']['BlogLook'] = (!empty($jsonOptions[$GalleryID.'-nv']['visual']['BlogLook'])) ? $jsonOptions[$GalleryID.'-nv']['visual']['BlogLook'] : 0;

echo <<<HEREDOC


<div class='cg_options_sortable'>

<p class='cg_options_sortable_title'>View options and order</p>

HEREDOC;


$i = 0;

foreach ($order as $key => $value) {

    $i++;

    if ($value == "BlogLookOrder" or ($showBlogViewOption == true && $showBlogViewOptionSet == false)) {

        $showSliderViewOptionSet = true;

        echo <<<HEREDOC

        <div class='cg_options_sortableContainer'>
            <div class='cg_options_sortableDiv'>
             <div class="cg_options_order">$i.</div>
              <div class="cg_options_order_change_order cg_move_view_to_bottom"><i></i></div>
               <div class="cg_options_order_change_order cg_move_view_to_top"><i></i></div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_view_option_100_percent BlogLookContainer'>
                        <div class='cg_view_option_title'>
                                <input type="hidden" name="multiple-pics[cg_gallery_no_voting][general][order][]" value="b" >
                                <p>Activate <u>Blog View</u></p>
                         </div>
                         <div  class='cg_view_option_checkbox'>
                            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][visual][BlogLook]" class="cg_shortcode_checkbox BlogLook" checked="{$jsonOptions[$GalleryID.'-nv']['visual']['BlogLook']}">
                         </div>
                    </div>
                </div>
            </div>
        </div>
        
HEREDOC;

    }

    if ($value == "SliderLookOrder" or ($showSliderViewOption == true && $showSliderViewOptionSet == false)) {

        $showSliderViewOptionSet = true;

        $jsonOptions[$GalleryID.'-nv']['visual']['SliderThumbNav'] = (!isset($jsonOptions[$GalleryID.'-nv']['visual']['SliderThumbNav'])) ? 1 : $jsonOptions[$GalleryID.'-nv']['visual']['SliderThumbNav'];

        echo <<<HEREDOC

        <div class='cg_options_sortableContainer'>
            <div class='cg_options_sortableDiv'>
            <div class="cg_options_order">$i.</div>
            <div class="cg_options_order_change_order cg_move_view_to_bottom"><i></i></div>
                <div class="cg_options_order_change_order cg_move_view_to_top"><i></i></div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_border_right_none cg_view_option_50_percent SliderLookContainer'>
                        <div class='cg_view_option_title'>
                                <input type="hidden" name="multiple-pics[cg_gallery_no_voting][general][order][]" value="s" >
                                <p>Activate <u>Slider View</u></p>
                         </div>
                         <div  class='cg_view_option_checkbox'>
                            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][SliderLook]" class="cg_shortcode_checkbox SliderLook" checked="{$jsonOptions[$GalleryID.'-nv']['general']['SliderLook']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_view_option_50_percent SliderThumbNavContainer'>
                        <div class='cg_view_option_title'>
                                <p>Enable thumbnail navigation</p>
                         </div>
                         <div  class='cg_view_option_checkbox'>
                            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][visual][SliderThumbNav]" class="cg_shortcode_checkbox SliderThumbNav" checked="{$jsonOptions[$GalleryID.'-nv']['visual']['SliderThumbNav']}" >
                         </div>
                    </div>
                </div>
        </div>
    </div>
    
HEREDOC;

    }

    if ($value == "ThumbLookOrder") {

        echo <<<HEREDOC

        <div class='cg_options_sortableContainer'>
            <div class='cg_options_sortableDiv'>
            <div class="cg_options_order">$i.</div>
            <div class="cg_options_order_change_order cg_move_view_to_bottom"><i></i></div>
                <div class="cg_options_order_change_order cg_move_view_to_top"><i></i></div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_border_right_none ThumbLookContainer'>
                        <div class='cg_view_option_title'>
                                <input type="hidden" name="multiple-pics[cg_gallery_no_voting][general][order][]" value="t" >
                                <p>Activate <u>Thumb View</u></p>
                         </div>
                         <div  class='cg_view_option_checkbox'>
                            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][ThumbLook]" class="cg_shortcode_checkbox ThumbLook" checked="{$jsonOptions[$GalleryID.'-nv']['general']['ThumbLook']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_border_right_none WidthThumbContainer'>
                        <div class='cg_view_option_title'>
                                <p>Width thumbs (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="3" name="multiple-pics[cg_gallery_no_voting][general][WidthThumb]" class="WidthThumb" value="{$jsonOptions[$GalleryID.'-nv']['general']['WidthThumb']}" >
                         </div>
                    </div>
                    <div class='cg_view_option HeightThumbContainer'>
                        <div class='cg_view_option_title'>
                                <p>Height thumbs (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="3" name="multiple-pics[cg_gallery_no_voting][general][HeightThumb]" class="HeightThumb" value="{$jsonOptions[$GalleryID.'-nv']['general']['HeightThumb']}" >
                         </div>
                    </div>
                </div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none DistancePicsContainer'>
                        <div class='cg_view_option_title'>
                                <p>Distance between thumbs horizontal (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="multiple-pics[cg_gallery_no_voting][general][DistancePics]" class="DistancePics" value="{$jsonOptions[$GalleryID.'-nv']['general']['DistancePics']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_view_option_50_percent cg_border_top_none DistancePicsVContainer'>
                        <div class='cg_view_option_title'>
                                <p>Distance between thumbs vertical (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="DistancePicsV" class="multiple-pics[cg_gallery_no_voting][general][DistancePicsV]" value="{$jsonOptions[$GalleryID.'-nv']['general']['DistancePicsV']}">
                         </div>
                    </div>
                </div>
        </div>
    </div>

HEREDOC;
    }

    if ($value == "HeightLookOrder") {

        echo <<<HEREDOC

        <div class='cg_options_sortableContainer'>
            <div class='cg_options_sortableDiv'>
            <div class="cg_options_order">$i.</div>
            <div class="cg_options_order_change_order cg_move_view_to_bottom"><i></i></div>
                <div class="cg_options_order_change_order cg_move_view_to_top"><i></i></div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_border_right_none cg_view_option_50_percent HeightLookContainer'>
                        <div class='cg_view_option_title'>
                                <input type="hidden" name="multiple-pics[cg_gallery_no_voting][general][order][]" value="h" >
                                <p>Activate <u>Height View</u></p>
                         </div>
                         <div  class='cg_view_option_checkbox'>
                            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][HeightLook]" class="cg_shortcode_checkbox HeightLook" checked="{$jsonOptions[$GalleryID.'-nv']['general']['HeightLook']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_view_option_50_percent HeightLookHeightContainer'>
                        <div class='cg_view_option_title'>
                                <p>Height of pics in a row (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="3" name="multiple-pics[cg_gallery_no_voting][general][HeightLookHeight]" class="HeightLookHeight" value="{$jsonOptions[$GalleryID.'-nv']['general']['HeightLookHeight']}" >
                         </div>
                    </div>
                </div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none HeightViewSpaceWidthContainer'>
                        <div class='cg_view_option_title'>
                                <p>Horizontal distance between images (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="multiple-pics[cg_gallery_no_voting][visual][HeightViewSpaceWidth]" class="HeightViewSpaceWidth" value="{$jsonOptions[$GalleryID.'-nv']['visual']['HeightViewSpaceWidth']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_view_option_50_percent cg_border_top_none HeightViewSpaceHeightContainer'>
                        <div class='cg_view_option_title'>
                                <p>Vertical distance between images (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="multiple-pics[cg_gallery_no_voting][visual][HeightViewSpaceHeight]" class="HeightViewSpaceHeight" value="{$jsonOptions[$GalleryID.'-nv']['visual']['HeightViewSpaceHeight']}">
                         </div>
                    </div>
                </div>
        </div>
    </div>
    
HEREDOC;

    }

    if ($value == "RowLookOrder") {

        echo <<<HEREDOC

        <div class='cg_options_sortableContainer'>
            <div class='cg_options_sortableDiv'>
                <div class="cg_options_order">$i.</div>
                <div class="cg_options_order_change_order cg_move_view_to_bottom"><i></i></div>
                <div class="cg_options_order_change_order cg_move_view_to_top"><i></i></div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_border_right_none cg_view_option_50_percent RowLookContainer'>
                        <div class='cg_view_option_title'>
                                <input type="hidden" name="multiple-pics[cg_gallery_no_voting][general][order][]" value="r" >
                                <p>Activate <u>Row View</u><br><span class="cg_font_weight_normal">(Same amount of images in each row)</span></p>
                         </div>
                         <div  class='cg_view_option_checkbox'>
                            <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][RowLook]" class="cg_shortcode_checkbox RowLook" checked="{$jsonOptions[$GalleryID.'-nv']['general']['RowLook']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_view_option_50_percent PicsInRowContainer'>
                        <div class='cg_view_option_title'>
                                <p>Number of pics in a row</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="multiple-pics[cg_gallery_no_voting][general][PicsInRow]" class="PicsInRow" value="{$jsonOptions[$GalleryID.'-nv']['general']['PicsInRow']}" >
                         </div>
                    </div>
                </div>
                <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_view_option_50_percent cg_border_top_right_none RowViewSpaceWidthContainer'>
                        <div class='cg_view_option_title'>
                                <p>Horizontal distance between images (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="multiple-pics[cg_gallery_no_voting][visual][RowViewSpaceWidth]" class="RowViewSpaceWidth" value="{$jsonOptions[$GalleryID.'-nv']['visual']['RowViewSpaceWidth']}">
                         </div>
                    </div>
                    <div class='cg_view_option cg_view_option_50_percent cg_border_top_none RowViewSpaceHeightContainer'>
                        <div class='cg_view_option_title'>
                                <p>Vertical distance between images (px)</p>
                         </div>
                         <div  class='cg_view_option_input'>
                            <input type="text" maxlength="2" name="multiple-pics[cg_gallery_no_voting][visual][RowViewSpaceHeight]" class="RowViewSpaceHeight" value="{$jsonOptions[$GalleryID.'-nv']['visual']['RowViewSpaceHeight']}">
                         </div>
                    </div>
                </div>
        </div>
    </div>
HEREDOC;

    }

}

echo <<<HEREDOC

</div>
</div>

HEREDOC;

