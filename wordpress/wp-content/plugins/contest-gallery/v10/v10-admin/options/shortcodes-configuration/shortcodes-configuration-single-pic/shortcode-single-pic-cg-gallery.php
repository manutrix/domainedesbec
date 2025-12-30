<?php

echo <<<HEREDOC

<div  class="cg_view cgSinglePicOptions cg_short_code_single_pic_configuration_cg_gallery_container cg_short_code_single_pic_configuration_container cgViewHelper2">
<div class='cg_view_container'>

HEREDOC;

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
                                <input type="radio" name="AllowGalleryScript" class="AllowGalleryScript cg_view_option_radio_multiple_input_field"  $AllowGalleryScript  />
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container SliderFullWindowContainer'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Full window slider
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="SliderFullWindow" class="SliderFullWindow cg_view_option_radio_multiple_input_field"  $SliderFullWindow   />
                            </div>
                        </div>
                        <div class='cg_view_option_radio_multiple_container BlogLookFullWindowContainer'>
                            <div class='cg_view_option_radio_multiple_title'>
                                Full window blog view
                            </div>
                            <div class='cg_view_option_radio_multiple_input'>
                                <input type="radio" name="BlogLookFullWindow" class="BlogLookFullWindow cg_view_option_radio_multiple_input_field"  $BlogLookFullWindow  />
                            </div>
                        </div>
                </div>
            </div>
        </div>

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
                                     <input type="radio" name="GalleryStyle" class="GalleryStyle cg_view_option_radio_multiple_input_field"  $GalleryStyleCenterWhiteChecked  value="center-white" />
                                </div>
                            </div>
                            <div class='cg_view_option_radio_multiple_container GalleryStyleCenterBlackContainer'>
                                <div class='cg_view_option_radio_multiple_title'>
                                    dark style
                                </div>
                                <div class='cg_view_option_radio_multiple_input'>
                                    <input type="radio" name="GalleryStyle" class="GalleryStyle cg_view_option_radio_multiple_input_field"  $GalleryStyleCenterBlackChecked  value="center-black" >
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
                                         <input type="radio" name="SlideTransition" class="SlideTransition cg_view_option_radio_multiple_input_field"  $SlideHorizontal  value="translateX" />
                                </div>
                            </div>
                            <div class='cg_view_option_radio_multiple_container SlideTransitionSlideVerticalContainer'>
                                <div class='cg_view_option_radio_multiple_title'>
                                    vertical
                                </div>
                                <div class='cg_view_option_radio_multiple_input'>
                                    <input type="radio" name="SlideTransition" class="SlideVertical cg_view_option_radio_multiple_input_field"  $SlideVertical  value="slideDown" >
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
                        <input type="checkbox" name="FullSizeSlideOutStart" class="FullSizeSlideOutStart"  $FullSizeSlideOutStart  />
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
                        <input type="checkbox" name="ShowExif" class="ShowExif"  $ShowExif   />
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

echo <<<HEREDOC
        
                <div class='cg_view_option cg_border_top_none ImageViewFullWindowContainer'>
                    <div class='cg_view_option_title'>
                        <p>Enable full window button</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ImageViewFullWindow" class="ImageViewFullWindow"  $ImageViewFullWindow  >
                    </div>
                </div>
            </div>

            <div class='cg_view_options_row'>
                <div class='cg_view_option cg_border_top_right_none ImageViewFullScreenContainer'>
                    <div class='cg_view_option_title'>
                        <p>Enable full screen button<br><span class="cg_view_option_title_note">Will appear when joining full window</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ImageViewFullScreen" class="ImageViewFullScreen"  $ImageViewFullScreen  />
                    </div>
                </div>
                <div class='cg_view_option cg_border_top_right_none OriginalSourceLinkInSliderContainer'>
                    <div class='cg_view_option_title'>
                        <p>Download button original image source</p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="OriginalSourceLinkInSlider" class="OriginalSourceLinkInSlider"  $OriginalSourceLinkInSlider   />
                    </div>
                </div>
                <div class='cg_view_option cg_border_top_none ShowNicknameContainer $cgProFalse'>
                    <div class='cg_view_option_title'>
                        <p>Show Nickname who uploaded image<br><span class="cg_view_option_title_note">If a registered user uploaded an image</span></p>
                    </div>
                    <div class='cg_view_option_checkbox'>
                        <input type="checkbox" name="ShowNickname" class="ShowNickname"  $ShowNickname  >
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
                    <input type="radio" name="FullSizeImageOutGallery" class="FullSizeImageOutGallery"  $FullSizeImageOutGallery  />
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
                    <input type="radio" name="OnlyGalleryView" class="OnlyGalleryView"  $OnlyGalleryView  />
                </div>
            </div>
        </div>

    </div>
    
HEREDOC;

echo <<<HEREDOC

    </div>
</div>
HEREDOC;
