<?php

echo <<<HEREDOC

<div  class="cg_view cgSinglePicOptions cg_short_code_single_pic_configuration_cg_gallery_no_voting_container cg_short_code_single_pic_configuration_container cg_hide cgViewHelper2">
<div class='cg_view_container'>

HEREDOC;

$AllowGalleryScript = (!empty($jsonOptions[$GalleryID.'-nv']['general']['AllowGalleryScript'])) ? 'checked' : '';
$SliderFullWindow = (!empty($jsonOptions[$GalleryID.'-nv']['pro']['SliderFullWindow'])) ? 'checked' : '';
$BlogLookFullWindow = (!empty($jsonOptions[$GalleryID.'-nv']['visual']['BlogLookFullWindow'])) ? 'checked' : '';


echo <<<HEREDOC

<div class='cg_view_options_rows_container'>

        <p class='cg_view_options_rows_container_title'>Gallery slide out, slider view or blog view</p>
        
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width'>
                    <div class='cg_view_option_title'>
                        <p>Open image style<br><span class="cg_view_option_title_note">Select how an image should be opened on click in a gallery</span></p>
                    </div>
                    <div class='cg_view_option_radio_multiple'>
                        <div class='cg_view_option_radio_multiple_container AllowGalleryScriptContainer'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Gallery slide out
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="multiple-pics[cg_gallery_no_voting][general][AllowGalleryScript]" class="AllowGalleryScript cg_view_option_radio_multiple_input_field"  $AllowGalleryScript  />
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container SliderFullWindowContainer'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Full window slider
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="multiple-pics[cg_gallery_no_voting][pro][SliderFullWindow]" class="SliderFullWindow cg_view_option_radio_multiple_input_field"  $SliderFullWindow   />
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container BlogLookFullWindowContainer'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Full window blog view
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="multiple-pics[cg_gallery_no_voting][visual][BlogLookFullWindow]" class="BlogLookFullWindow cg_view_option_radio_multiple_input_field"  $BlogLookFullWindow  />
                            </div>
                        </div>
                </div>
            </div>
        </div>
HEREDOC;

if(empty($jsonOptions[$GalleryID.'-nv'])){
    $GalleryStyleCenterWhiteChecked = '';
}else{
    if(empty($jsonOptions[$GalleryID.'-nv']['visual']['GalleryStyle'])){
        $GalleryStyleCenterWhiteChecked = '';
    }else{
        $GalleryStyleCenterWhiteChecked = ($jsonOptions[$GalleryID.'-nv']['visual']['GalleryStyle']=='center-white') ? 'checked' : '';
    }
}

if(empty($jsonOptions[$GalleryID.'-nv'])){
    $GalleryStyleCenterBlackChecked = 'checked';
}else{
    if(empty($jsonOptions[$GalleryID.'-nv']['visual']['GalleryStyle'])){
        $GalleryStyleCenterBlackChecked = 'checked';
    }else{
        $GalleryStyleCenterBlackChecked = ($jsonOptions[$GalleryID.'-nv']['visual']['GalleryStyle']=='center-black') ? 'checked' : '';
    }
}


$SlideTransitionSlideHorizontalChecked = ($jsonOptions[$GalleryID.'-nv']['pro']['SlideTransition']=='translateX') ?  'checked' :  '';

$SlideTransitionSlideDownChecked = ($jsonOptions[$GalleryID.'-nv']['pro']['SlideTransition']=='slideDown') ?  'checked' :  '';


echo <<<HEREDOC

        <div class='GallerySlideOutSliderViewBlogViewContainer' style='padding:0;margin:0;'>

            <div class='cg_view_options_row GalleryStyleContainer'>
                    <div class='cg_view_option cg_view_option_full_width cg_border_top_none'>
                        <div class='cg_view_option_title'>
                            <p>Opened image background color</p>
                        </div>
                        <div class='cg_view_option_radio_multiple'>
                            <div class='cg_view_option_radio_multiple_container GalleryStyleCenterWhiteContainer'>
                                <div class='cg_view_option_radio_multiple_title'>
                                    bright style
                                </div>
                                <div class='cg_view_option_radio_multiple_input'>
                                     <input type="radio" name="multiple-pics[cg_gallery_no_voting][visual][GalleryStyle]" class="GalleryStyle cg_view_option_radio_multiple_input_field"  $GalleryStyleCenterWhiteChecked  value="center-white" />
                                </div>
                            </div>
                            <div class='cg_view_option_radio_multiple_container GalleryStyleCenterBlackContainer'>
                                <div class='cg_view_option_radio_multiple_title'>
                                    dark style
                                </div>
                                <div class='cg_view_option_radio_multiple_input'>
                                    <input type="radio" name="multiple-pics[cg_gallery_no_voting][visual][GalleryStyle]" class="GalleryStyle cg_view_option_radio_multiple_input_field"  $GalleryStyleCenterBlackChecked  value="center-black" >
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class='cg_view_options_row'>
                    <div class='cg_view_option cg_view_option_full_width cg_border_top_none'>
                        <div class='cg_view_option_title'>
                            <p>Slide effect</p>
                        </div>
                        <div class='cg_view_option_radio_multiple'>
                            <div class='cg_view_option_radio_multiple_container SlideTransitionTranslateXContainer'>
                                <div class='cg_view_option_radio_multiple_title'>
                                    horizontal
                                </div>
                                <div class='cg_view_option_radio_multiple_input'>
                                         <input type="radio" name="multiple-pics[cg_gallery_no_voting][pro][SlideTransition]" class="SlideTransition cg_view_option_radio_multiple_input_field"  $SlideTransitionSlideHorizontalChecked  value="translateX" />
                                </div>
                            </div>
                            <div class='cg_view_option_radio_multiple_container SlideTransitionSlideVerticalContainer'>
                                <div class='cg_view_option_radio_multiple_title'>
                                    vertical
                                </div>
                                <div class='cg_view_option_radio_multiple_input'>
                                    <input type="radio" name="multiple-pics[cg_gallery_no_voting][pro][SlideTransition]" class="SlideVertical cg_view_option_radio_multiple_input_field"  $SlideTransitionSlideDownChecked  value="slideDown" >
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_top_right_none FullSizeSlideOutStartContainer'>
                    <div class='cg_view_option_title'>
                        <p>Start gallery full window view<br>
        as slide out by clicking an image<br><span class="cg_view_option_title_note">Will not start automatically full window when clicking image in slider view</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][general][FullSizeSlideOutStart]" checked="{$jsonOptions[$GalleryID.'-nv']['general']['FullSizeSlideOutStart']}" class="cg_shortcode_checkbox FullSizeSlideOutStart">
                    </div>
                </div>
HEREDOC;

if(function_exists('exif_read_data')){

    echo <<<HEREDOC
            
                <div class='cg_view_option cg_border_top_right_none ShowExifContainer'>
                    <div class='cg_view_option_title'>
                        <p>Show EXIF data</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                       <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][pro][ShowExif]" checked="{$jsonOptions[$GalleryID.'-nv']['pro']['ShowExif']}" class="cg_shortcode_checkbox ShowExif">
                    </div>
                </div>
                
HEREDOC;

} else{

    echo <<<HEREDOC

            <div class='cg_view_option'>
                    <div class='cg_view_option_title'>
                        <p>Show EXIF data can not be activated.<br>Please contact your provider<br>to enable exif_read_data function.</p>
                    </div>
                </div>
HEREDOC;

}

$jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullWindow'] = (!isset($jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullWindow'])) ? 1 : $jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullWindow'];

$jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullScreen'] = (!isset($jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullScreen'])) ? 1 : $jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullScreen'];

echo <<<HEREDOC
        
                <div class='cg_view_option cg_border_top_none ImageViewFullWindowContainer'>
                    <div class='cg_view_option_title'>
                        <p>Enable full window button</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][visual][ImageViewFullWindow]" checked="{$jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullWindow']}" class="cg_shortcode_checkbox ImageViewFullWindow">
                    </div>
                </div>
            </div>

            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_top_right_none ImageViewFullScreenContainer'>
                    <div class='cg_view_option_title'>
                        <p>Enable full screen button<br><span class="cg_view_option_title_note">Will appear when joining full window</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][visual][ImageViewFullScreen]" checked="{$jsonOptions[$GalleryID.'-nv']['visual']['ImageViewFullScreen']}" class="cg_shortcode_checkbox ImageViewFullScreen">
                    </div>
                </div>
                <div class='cg_view_option cg_border_top_right_none OriginalSourceLinkInSliderContainer'>
                    <div class='cg_view_option_title'>
                        <p>Download button original image source</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][visual][OriginalSourceLinkInSlider]" checked="{$jsonOptions[$GalleryID.'-nv']['visual']['OriginalSourceLinkInSlider']}" class="cg_shortcode_checkbox OriginalSourceLinkInSlider">
                    </div>
                </div>
                <div class='cg_view_option cg_border_top_none ShowNicknameContainer $cgProFalse'>
                    <div class='cg_view_option_title'>
                        <p>Show Nickname who uploaded image<br><span class="cg_view_option_title_note">If a registered user uploaded an image</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="multiple-pics[cg_gallery_no_voting][pro][ShowNickname]" checked="{$jsonOptions[$GalleryID.'-nv']['pro']['ShowNickname']}" class="cg_shortcode_checkbox ShowNickname">
                    </div>
                </div>
            </div>

        </div>

    </div>

HEREDOC;

echo <<<HEREDOC

   <div class='cg_view_options_rows_container'>

        <p class='cg_view_options_rows_container_title'>Original source link only</p>

        <div class='cg_view_options_row'>
            <div class='cg_view_option cg_view_option_100_percent FullSizeImageOutGalleryContainer'>
                <div class='cg_view_option_title'>
                    <p>Forward directly to original source after clicking an image<br><span class="cg_view_option_title_note">Configuration of voting out of gallery is possible. Only for gallery views. Slider and blog view will work as usual.</span></p>
                </div>
                <div class='cg_view_option_radio cg_margin_top_5'>
                    <input type="radio" name="multiple-pics[cg_gallery_no_voting][general][FullSizeImageOutGallery]" checked="{$jsonOptions[$GalleryID.'-nv']['general']['FullSizeImageOutGallery']}" class="FullSizeImageOutGallery">
                </div>
            </div>
        </div>

    </div>

    <div class='cg_view_options_rows_container'>

        <p class='cg_view_options_rows_container_title'>Only gallery view</p>

        <div class='cg_view_options_row'>
            <div class='cg_view_option cg_view_option_100_percent OnlyGalleryViewContainer'>
                <div class='cg_view_option_title'>
                    <p>Make images unclickable<br><span class="cg_view_option_title_note">Images can not be clicked. Configuration of voting out of gallery is possible. Only for gallery views. Slider and blog view will work as usual.</span></p>
                </div>
                <div class='cg_view_option_radio cg_margin_top_5'>
                       <input type="radio" name="multiple-pics[cg_gallery_no_voting][general][OnlyGalleryView]" checked="{$jsonOptions[$GalleryID.'-nv']['general']['OnlyGalleryView']}" class="OnlyGalleryView">
                </div>
            </div>
        </div>

    </div>
    
HEREDOC;

echo <<<HEREDOC

    </div>
</div>
HEREDOC;

