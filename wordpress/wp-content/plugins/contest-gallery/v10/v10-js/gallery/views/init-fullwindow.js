cgJsClass.gallery.views.fullwindow = {
    init:function () {

        this.openEvent();
        this.closeEvent();

    },
    openEvent:function(){

        jQuery(document).on('click', '.cg-center-image-fullwindow', function () {

            var gid = jQuery(this).attr('data-cg-gid');
            var $mainCGdivContainer = jQuery('#mainCGdivContainer'+gid);

            // !Important, otherwise buggy behaviour appearing centerDiv not in right place
            cgJsData[gid].vars.cgCenterDiv.hide();

            $mainCGdivContainer.css('height','1200px');

            cgJsData[gid].vars.mainCGdivHelperParent.animate({
                scrollTop: $mainCGdivContainer.offset().top - 70+'px'
            }, 0, function () {
            });

            cgJsClass.gallery.views.fullwindow.openFunction(gid,jQuery(this));

        });

        jQuery(document).on('click', '.cg-fullwindow-configuration-button', function () {

            var $element = jQuery(this);

            var gid = $element.attr('data-cg-gid');

            cgJsClass.gallery.upload.close(gid);

            var $mainCGdivHelperParent = $element.closest('.mainCGdivHelperParent');

            if(cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened){
                $mainCGdivHelperParent.find('.mainCGdivFullWindowConfigurationArea').removeClass('cg_opened');
                cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened = false;
            }else{
                $mainCGdivHelperParent.find('.mainCGdivFullWindowConfigurationArea').addClass('cg_opened');
                setTimeout(function () {
                    cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened = true;
                },10);
            }

        });

        jQuery(document).on('click', '.mainCGdivFullWindowConfigurationAreaCloseButtonContainer', function () {

            var $element = jQuery(this);

            var gid = $element.attr('data-cg-gid');

            cgJsClass.gallery.upload.close(gid);

            var $mainCGdivHelperParent = $element.closest('.mainCGdivHelperParent');

            $mainCGdivHelperParent.find('.mainCGdivFullWindowConfigurationArea').removeClass('cg_opened');
            cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened = false;

        });

        jQuery(document).on("click", "body > .mainCGdivHelperParent .mainCGdivFullWindowConfigurationArea .cg_select_order", function(){
            var $mainCGdivFullWindowConfigurationArea = jQuery(this).closest('.mainCGdivFullWindowConfigurationArea');
            $mainCGdivFullWindowConfigurationArea.addClass('cg_cant_be_closed');// otherwise will close settings
            if(jQuery(this).is(':focus')){
                $mainCGdivFullWindowConfigurationArea.find('.cg_search_input').addClass('cg_opacity_0_3');
                $mainCGdivFullWindowConfigurationArea.find('.cg-cat-select-area').addClass('cg_opacity_0_3');
            }
            setTimeout(function () {
                $mainCGdivFullWindowConfigurationArea.removeClass('cg_cant_be_closed');
            },10);
        });

        jQuery(document).on("change", "body > .mainCGdivHelperParent .mainCGdivFullWindowConfigurationArea .cg_select_order", function(){
            var $mainCGdivFullWindowConfigurationArea = jQuery(this).closest('.mainCGdivFullWindowConfigurationArea');
            setTimeout(function () {
                $mainCGdivFullWindowConfigurationArea.find('.cg_search_input').removeClass('cg_opacity_0_3');
                $mainCGdivFullWindowConfigurationArea.find('.cg-cat-select-area').removeClass('cg_opacity_0_3');
                $mainCGdivFullWindowConfigurationArea.removeClass('cg_cant_be_closed');
            },10);
        });

        jQuery(document).on("change", "body > .mainCGdivHelperParent .mainCGdivFullWindowConfigurationArea .cg_select_cat_label ", function(){
            var $mainCGdivFullWindowConfigurationArea = jQuery(this).closest('.mainCGdivFullWindowConfigurationArea');
            $mainCGdivFullWindowConfigurationArea.addClass('cg_cant_be_closed');// otherwise will close settings
            setTimeout(function () {
                $mainCGdivFullWindowConfigurationArea.find('.cg_search_input').removeClass('cg_opacity_0_3');
                $mainCGdivFullWindowConfigurationArea.find('.cg-cat-select-area').removeClass('cg_opacity_0_3');
                $mainCGdivFullWindowConfigurationArea.removeClass('cg_cant_be_closed');
            },10);
        });

        jQuery(document).on("focusout", "body > .mainCGdivHelperParent .mainCGdivFullWindowConfigurationArea .cg_select_order", function(){
            var $mainCGdivFullWindowConfigurationArea = jQuery(this).closest('.mainCGdivFullWindowConfigurationArea');
            $mainCGdivFullWindowConfigurationArea.find('.cg_search_input').removeClass('cg_opacity_0_3');
            $mainCGdivFullWindowConfigurationArea.find('.cg-cat-select-area').removeClass('cg_opacity_0_3');
        });


        // consider order! Has to be before configuration button!
        jQuery(document).on("click", "body > .mainCGdivHelperParent", function(e){

            if(cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened){

                var $eTarget = jQuery(e.target);

                var gid = jQuery(this).attr('data-cg-gid');

                var sliderView = false;

                if(cgJsData[gid].vars.currentLook=='slider'){
                    sliderView = true;
                }

                // check !($eTarget.hasClass('cg_append') && sliderView==true) important! Otherwise settings will always disappear when something changed slider is visible
                // for !$eTarget.hasClass('cg_further_images') is same!!!
                if(!$eTarget.is('.mainCGdivFullWindowConfigurationArea') && $eTarget.closest('.mainCGdivFullWindowConfigurationArea').length==0 &&
                    !$eTarget.hasClass('cg_further_images') && !$eTarget.hasClass('cg_fe_controls_style_white') && !($eTarget.hasClass('cg_append') && sliderView==true)
                    && !$eTarget.hasClass('cgChangeTopControlsStyleOptionTest')){
                    var $element = jQuery(this);
                    var gid = $element.attr('data-cg-gid');
                    if(!$element.find('#mainCGdivFullWindowConfigurationArea'+gid).hasClass('cg_cant_be_closed')){
                        $element.find('#mainCGdivFullWindowConfigurationArea'+gid).removeClass('cg_opened');
                    }
                    cgJsClass.gallery.vars. fullWindowConfigurationAreaIsOpened = false;
                }

            }

        });


    },
    openFunction: function (gid,$openButton) {

        // remember, then switch views in full window is not possible, thats why that can be done!
        if(cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1){
            cgJsData[gid].vars.previousLook = cgJsData[gid].vars.currentLook;
        }

        cgJsData[gid].vars.widthmainPrevious = cgJsData[gid].vars.widthmain;

        var BlogLookFullWindowInitiated = false;

        //if slider then open as slider
        if(cgJsData[gid].options.visual.BlogLookFullWindow==1 && cgJsData[gid].vars.currentLook!='slider'){
            if(cgJsData[gid].vars.currentLook!='blog'){
                BlogLookFullWindowInitiated = true;
            }
            cgJsData[gid].vars.currentLook='blog';
        }// if blog then still open as blog
        else if(cgJsData[gid].options.pro.SliderFullWindow==1 && cgJsData[gid].vars.currentLook!='blog'){
            cgJsData[gid].vars.currentLook='slider';
            sliderView = true;
        }

        cgJsClass.gallery.upload.close(gid);

        cgJsData[gid].vars.mainCGdiv.addClass('cg_display_inline_block');
        cgJsData[gid].vars.mainCGallery.addClass('cg_full_window');

        cgJsClass.gallery.vars.fullwindow = gid;
        cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened = false;
        cgJsClass.gallery.vars.isInitFullWindowOpen = true;

        cgJsData[gid].vars.cgCenterDivLastHeight = null;

        if(cgJsData[gid].vars.currentLook=='blog'){
            var prepareResizeFullWindow = cgJsClass.gallery.blogLogic.prepareResizeFullWindow(gid);
        }

        var $mainCGdivHelperParent = cgJsData[gid].vars.mainCGdivHelperParent;
        $mainCGdivHelperParent.find('#mainCGslider'+gid).addClass('cg_hide_override');
        $mainCGdivHelperParent.appendTo('body');

        var $mainCGdivFullWindowConfigurationArea = jQuery('#mainCGdivFullWindowConfigurationArea'+gid);
        $mainCGdivFullWindowConfigurationArea.removeClass('cg_opened');
        $mainCGdivHelperParent.find('.cg_sort_div').appendTo($mainCGdivFullWindowConfigurationArea);
        $mainCGdivHelperParent.find('.cg-cat-select-area').appendTo($mainCGdivFullWindowConfigurationArea);

        cgJsClass.gallery.categories.setRemoveTitleAttributeForSmallWindow();

        // is required because full window might clicked right after load!
        cgJsClass.gallery.sorting.showRandomButtonInstantly(gid);

        var sliderView = false;

        if(cgJsData[gid].vars.currentLook=='slider'){
            sliderView = true;
        }

        if(sliderView){

            if(cgJsData[gid].options.pro.SliderFullWindow==1){
                $mainCGdivHelperParent.find('.cg_gallery_thumbs_control').addClass('cg_hide');// switch views can be removed then
            }

            cgJsClass.gallery.views.switchView.sortViewSlider(gid);
            $mainCGdivHelperParent.find('.cg_further_images_container').addClass('cg_hide');
        }

        // jQuery('#mainCGdivHelperParent'+gid).addClass('cg_hide').appendTo('body').removeClass('cg_hide').addClass('cg_blink_image_appear_gallery_load');
        $mainCGdivHelperParent.find('.cg_header .cg-center-image-close').removeClass('cg_hide');
        $mainCGdivHelperParent.find('.cg-center-image-fullwindow.cg_gallery_control_element').addClass('cg_hide');
        $mainCGdivHelperParent.find('.cg-inside-center-image-div').addClass('cg-center-image-close-fullwindow').removeClass('cg-center-image-fullwindow');
        cgJsClass.gallery.vars.dom.body.addClass('cg_body_overflow_hidden');
        cgJsClass.gallery.vars.dom.html.addClass('cg_no_scroll cg_body_overflow_hidden');
        //cgJsData[gid].vars.cgCenterDivAppearenceHelper.removeClass('cg_hide');
        cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');

        if(cgJsData[gid].vars.currentLook!='blog'){
            cgJsClass.gallery.views.initOrderGallery(gid,false,null,$openButton.attr('data-cg-real-id'),false,false,false,sliderView);
        }

        $mainCGdivHelperParent.find('#mainCGdiv'+gid).removeClass('cg_hide_override');
        $mainCGdivHelperParent.find('#mainCGslider'+gid).removeClass('cg_hide_override');
        $mainCGdivHelperParent.find('.cg-header-controls-show-only-full-window').removeClass('cg_hide');
        $mainCGdivHelperParent.find('.cg_sort_div .cg-gallery-upload').addClass('cg_hide');

        // FullSize is full screen and full size gallery is full window
        if(!cgJsClass.gallery.vars.fullscreen && cgJsData[gid].options.general.FullSize==1 && cgJsData[gid].options.general.FullSizeGallery==1){
            $mainCGdivHelperParent.find('.cgCenterDiv .cg-fullscreen-button').removeClass('cg_hide');
            $mainCGdivHelperParent.find('.cg-center-image-close-fullwindow').removeClass('cg_hide');
        }

        if(cgJsClass.gallery.vars.isMobile==true){
            $mainCGdivHelperParent.find('#cgFullScreenButton'+gid).addClass('cg_hide');
            if(cgJsData[gid].vars.currentLook=='blog'){
                $mainCGdivHelperParent.find('.cgCenterDiv .cg-fullscreen-button').addClass('cg_hide');
            }
        }

        if(cgJsData[gid].vars.currentLook=='blog' && !BlogLookFullWindowInitiated){
            cgJsClass.gallery.blogLogic.changeWidth(prepareResizeFullWindow.widthNowForBlogView,prepareResizeFullWindow.factor,$mainCGdivHelperParent,gid);
        }

        if(cgJsData[gid].vars.currentLook=='blog' && BlogLookFullWindowInitiated){// blogview has to be created then
            $mainCGdivHelperParent.find('.cg_header .cg-center-image-close-fullwindow, .cg_header .cg-fullscreen-button').addClass('cg_hide');// full screen and close button can be also removed then, because available in single view, same behaviour like open in full window slider
            $mainCGdivHelperParent.find('.cg_gallery_thumbs_control').addClass('cg_hide');// switch views can be removed then
            cgJsData[gid].vars.mainCGdivHelperParent.find('.cg_header .cg-gallery-upload, .cg_header .cg-fullwindow-configuration-button').addClass('cg_hide');// upload button and categoriesSearchSortButton can be also removed then in header
            cgJsClass.gallery.blogLogic.reset(gid);// reset for sure
            cgJsData[gid].vars.mainCGdiv.removeClass('cg_display_inline_block').addClass('cg_margin_0_auto');
            cgJsClass.gallery.blogLogic.init(jQuery,gid,null,null,null,true,false,false,false,false,$openButton.attr('data-cg-real-id'));
            cgJsClass.gallery.vars.isInitFullWindowOpen = false;
        }

        if(cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1){
            cgJsData[gid].vars.mainCGdivHelperParent.find('.cg_header .cg-gallery-upload, .cg_header .cg-fullwindow-configuration-button').addClass('cg_hide');// upload button and categoriesSearchSortButton can be also removed then in header
            $mainCGdivHelperParent.find('.cg_gallery_thumbs_control').addClass('cg_hide');// switch views can be removed then
            $mainCGdivHelperParent.find('.cg_header .cg-center-image-close-fullwindow, .cg_header .cg-fullscreen-button').addClass('cg_hide');// full screen and close button can be also removed then, because available in single view, same behaviour like open in full window slider
        }else{
            if(cgJsData[gid].options.general.FullSizeGallery==1){
                $mainCGdivHelperParent.find('.cg_header .cg-center-image-close-fullwindow').removeClass('cg_hide');
            }else{
                $mainCGdivHelperParent.find('.cg_header .cg-center-image-close-fullwindow').addClass('cg_hide');
            }
        }

        cgJsClass.gallery.views.fullwindow.checkAndHideFullWindowConfigurationButton(gid);

        if($openButton.attr('data-cg-real-id') && cgJsData[gid].vars.currentLook=='blog'){

            cgJsData[gid].vars.mainCGdiv.addClass('cg_hidden');
            //cgJsData[gid].vars.cgLdsDualRingDivGalleryHide.removeClass('cg_hide').addClass('cg_padding_top_75');
            cgJsData[gid].vars.mainCGdivHelperParent.addClass('cg_no_scroll');

            setTimeout(function () {
                cgJsData[gid].vars.mainCGdivHelperParent.removeClass('cg_no_scroll');
                if(cgJsData[gid].cgCenterDivBlogObject[$openButton.attr('data-cg-real-id')]){
                    cgJsData[gid].vars.mainCGdivHelperParent.animate({
                        //scrollTop: cgJsData[gid].cgCenterDivBlogObject[$openButton.attr('data-cg-real-id')].position().top+cgJsData[gid].vars.mainCGallery.position().top+cgJsData[gid].vars.cgLdsDualRingDivGalleryHide.height()+75+'px'
                        //scrollTop: cgJsData[gid].cgCenterDivBlogObject[$openButton.attr('data-cg-real-id')].position().top+cgJsData[gid].vars.mainCGallery.position().top+'px'
                        scrollTop: cgJsData[gid].cgCenterDivBlogObject[$openButton.attr('data-cg-real-id')].position().top+cgJsData[gid].vars.mainCGallery.position().top+10+'px'
                    }, 0, function () {
                        cgJsData[gid].vars.mainCGdiv.removeClass('cg_hidden');
                        cgJsData[gid].vars.cgLdsDualRingDivGalleryHide.addClass('cg_hide').removeClass('cg_padding_top_75');
                    });
                }else{
                    cgJsData[gid].vars.mainCGdiv.removeClass('cg_hidden');
                    cgJsData[gid].vars.cgLdsDualRingDivGalleryHide.addClass('cg_hide').removeClass('cg_padding_top_75');
                }

                cgJsClass.gallery.views.singleView.createImageUrl(gid,$openButton.attr('data-cg-real-id'));
                cgJsClass.gallery.views.currentScrollImageDataImageIdBlogViewFullWindow = 0;// ! reset here!
                cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow = undefined;// ! reset here!
                //cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindowCalculation(gid,$openButton.attr('data-cg-real-id'));

            },0);

        }

        cgJsData[gid].vars.mainCGdiv.css('height','unset');

    },
    checkAndHideFullWindowConfigurationButton: function (gid,$cgCenterDiv) {

        var categoriesCheck = false;

        if(cgJsData[gid].vars.showCategories){
            if(Object.keys(cgJsData[gid].vars.categories).length>=2){
                categoriesCheck = true;// then at least 2 categories will be displayed in header controls
            }
        }

        if(!categoriesCheck && cgJsData[gid].options.general.AllowSort!=1 && cgJsData[gid].options.pro.Search!=1 && cgJsData[gid].options.general.RandomSortButton!=1){
            if($cgCenterDiv){
                $cgCenterDiv.find('.cg-fullwindow-configuration-button').addClass('cg_hide');
            }else{
                cgJsData[gid].vars.mainCGdivHelperParent.find('.cg-fullwindow-configuration-button').addClass('cg_hide');
            }
        }

    },
    closeEvent: function () {

        jQuery(document).on('click', '.cg-center-image-close-fullwindow', function () {

            cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');

            var gid = jQuery(this).attr('data-cg-gid');

            if(cgJsClass.gallery.vars.fullscreen){
                cgJsClass.gallery.views.fullscreen.close(gid);
                cgJsData[gid].vars.cgCenterDivLastHeight = null;
            }else{
                var $element = jQuery(this);
                cgJsClass.gallery.views.fullwindow.closeFunction(gid,true,$element);
            }

        });

    },
    closeFunction: function (gid,openImage,$closeButton) {

        // remember, then switch views in full window is not possible, thats why that can be done!
        if(cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1){
            cgJsData[gid].vars.currentLook = cgJsData[gid].vars.previousLook;
        }

        if(!$closeButton){// then must be from escape button for example
            $closeButton = jQuery('<div></div>');
            $closeButton.attr('data-cg-real-gid',gid);
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.addClass('cg_hide');// do this also first otherwise might be still visible
            if(cgJsData[gid].vars.previousLook=='slider'){// if escape button was clicked and slider view was opened, then this here is required
                $closeButton.attr('data-cg-real-id',cgJsData[gid].vars.openedRealId);
            }
        }

        // blog view might have slider classes
        /*if(cgJsData[gid].vars.currentLook!='blog' && cgJsData[gid].vars.mainCGdiv.hasClass('cg-slider-view')){
            if(cgJsData[gid].vars.openedRealId){// slider view close should always have real id for right processing
                // this might happen if close button at top was clicked or escape was clicked
                $closeButton.attr('data-cg-real-id',cgJsData[gid].vars.openedRealId);
            }
        }*/

        cgJsData[gid].vars.openedGalleryImageOrder = null;
        cgJsClass.gallery.vars.switchViewsClicked = true;

        cgJsData[gid].vars.openedRealId = parseInt($closeButton.attr('data-cg-real-id'));

        var sliderView = false;

        if(cgJsData[gid].vars.currentLook=='slider'){
            sliderView = true;
        }

        if($closeButton.attr('data-cg-real-id')){
            cgJsData[gid].vars.closeEventInitWithDataCGrealIdCloseButton = true;
        }

        cgJsData[gid].vars.mainCGdiv.addClass('cg_center_pointer_event_none');

        cgJsClass.gallery.upload.close(gid);

        cgJsData[gid].vars.mainCGdiv.removeClass('cg_display_inline_block cg_margin_0_auto');

        // !important, because display flex might be set if thumb view was used!
        cgJsData[gid].vars.mainCGallery.removeClass('cg_thumb_look');

        cgJsClass.gallery.vars.fullwindow = null;
        cgJsData[gid].vars.cgCenterDivLastHeight = null;

        cgJsClass.gallery.vars.isInitFullWindowClose = true;

        if(cgJsData[gid].vars.currentLook=='blog'){
            cgJsData[gid].vars.openedRealId = cgJsData[gid].vars.firstOrderRealIdBlogView;// !important, otherwise broken scroll behaviour to blog view!
        }

        cgJsClass.gallery.vars.fullWindowConfigurationAreaIsOpened = false;

        cgJsData[gid].vars.mainCGallery.addClass('cg_invisible').css('height','1000px');
        cgJsData[gid].vars.mainCGdivContainer.css('height','1200px');

        //cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');

        cgJsData[gid].vars.cgCenterDiv.hide();
        var $mainCGdivHelperParent = jQuery('#mainCGdivHelperParent'+gid);

        var $mainCGdivFullWindowConfigurationArea = jQuery('#mainCGdivFullWindowConfigurationArea'+gid);
        $mainCGdivFullWindowConfigurationArea.find('.cg_sort_div').appendTo($mainCGdivHelperParent.find('.cg_gallery_view_sort_control'));
        $mainCGdivFullWindowConfigurationArea.find('.cg-cat-select-area').prependTo($mainCGdivHelperParent.find('.cg_thumbs_and_categories_control '));
        $mainCGdivFullWindowConfigurationArea.removeClass('cg_opened');

        cgJsClass.gallery.categories.removeTitleAttributeGeneral(gid);

        history.pushState("", document.title, window.location.pathname + window.location.search);

        /* cgJsClass.gallery.vars.dom.html.animate({
             scrollTop: $mainCGdivHelperParent.offset().top - 70+'px'
             }, 0, function () {
         });*/

        $mainCGdivHelperParent.prependTo(cgJsData[gid].vars.mainCGdivContainer).slideDown();
        $mainCGdivHelperParent.find('.cg_gallery_thumbs_control').removeClass('cg_hide');

        var $mainCGslider = $mainCGdivHelperParent.find('.mainCGslider');
        $mainCGslider.addClass('cg_hide');
        $mainCGdivHelperParent.find('#cgCenterImageFullwindowHeader'+gid).removeClass('cg_hide');

        if(cgJsData[gid].vars.currentLook=='blog'){
            $mainCGdivHelperParent.find('.cgCenterDiv .cg-center-image-close-fullwindow').addClass('cg-center-image-fullwindow').removeClass('cg-center-image-close-fullwindow');
        }else{
            $mainCGdivHelperParent.find('#cgCenterImageFullwindow'+gid).addClass('cg-center-image-fullwindow').removeClass('cg-center-image-close-fullwindow');
        }

        $mainCGdivHelperParent.find('#cgCenterImageClose'+gid).addClass('cg_hide');

        cgJsClass.gallery.vars.dom.body.removeClass('cg_body_overflow_hidden');
        cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll cg_body_overflow_hidden');
        cgJsData[gid].vars.cgCenterDivLastHeight = undefined;

        // has to be done extra and in this order. Maybe developer tools started before for mobile view check and then ended. Then this will stay always hidden!
        // show has also to be done!
        $mainCGdivHelperParent.find('.cg-center-image-fullwindow').show().removeClass('cg_hide');

        var sliderView = false;

        if(cgJsData[gid].vars.currentLook=='slider'){
            sliderView = true;
        }

        // have to be done here because escape button might be clicked for closing full window
        if(cgJsData[gid].vars.openedRealId && sliderView && !$closeButton){
            cgJsData[gid].vars.mainCGallery.addClass('cg_slider_view_hidden');
            cgJsData[gid].vars.cgCenterDiv.addClass('cg_slider_view_hidden');
        }

        if((cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1) && cgJsData[gid].vars.previousLook!='blog'){
            if(cgJsData[gid].options.visual.BlogLookFullWindow==1){
                cgJsClass.gallery.blogLogic.reset(gid);// reset for sure
            }
            if(!sliderView){
                var $step = cgJsClass.gallery.dynamicOptions.getCurrentStep(gid,cgJsData[gid].vars.openedRealId); // If blog view then current step will appear and image will be opened
                cgJsClass.gallery.dynamicOptions.checkStepsCutImageData(jQuery,$step,false,true,gid);// <<< no append here and no cg show remove with this parameters
                $mainCGslider.find('.cg_show').remove();
                cgJsClass.gallery.vars.hasToAppend=true;
                cgJsData[gid].vars.openedRealId = 0;// !important!!! Otherwise will open SliderFullWindow right again :)
            }
        }

        if(sliderView){// steps can be hidden then
            if(cgJsData[gid].vars.$cg_further_images_container_top){
                cgJsData[gid].vars.$cg_further_images_container_top.addClass('cg_hide');
            }
            if(cgJsData[gid].vars.$cg_further_images_container_bottom){
                cgJsData[gid].vars.$cg_further_images_container_bottom.addClass('cg_hide');
            }
        }

        /*        var sliderView = false;

                if(cgJsData[gid].vars.currentLook=='slider'){
                    sliderView = true;
                }*/

        if(cgJsData[gid].vars.previousLookSlider==false){
            //  cgJsData[gid].vars.openedRealId = 0;
        }

        $mainCGdivHelperParent.find('.mainCGdiv').css('width','unset');
        $mainCGdivHelperParent.find('.mainCGallery ').css('width','unset');
        $mainCGdivHelperParent.find('.cg-slider-range-container').remove();

        if(cgJsData[gid].vars.currentLook!='blog'){
            // Important to close ipened view false, otherwise complete dom template might be broken!!!
            cgJsClass.gallery.views.close(gid,false,false,true);
            if(sliderView){
                cgJsClass.gallery.views.initOrderGallery(gid,true,null,openImage,false,false,false,sliderView,false,false);
            }else{
                var openPage = false;
                var isFromFullWindowSliderOrBlogView = false;
                if(cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1
                    ||
                    cgJsClass.gallery.function.general.tools.isFullSizeSlideOutStartNormally(gid)
                ){
                    openPage = true;
                    isFromFullWindowSliderOrBlogView = true;
                }
                cgJsClass.gallery.views.initOrderGallery(gid,openPage,null,openImage,false,false,false,sliderView,false,isFromFullWindowSliderOrBlogView);
            }
        }

        // 04.04.2020 seems to be the best behaviour doing scrolling already here!
        cgJsClass.gallery.vars.dom.html.addClass('cg_scroll_behaviour_initial');
        cgJsClass.gallery.vars.dom.body.addClass('cg_scroll_behaviour_initial');
        $mainCGdivHelperParent.find('#cgViewHelper'+gid).get(0).scrollIntoView();
        cgJsClass.gallery.vars.dom.html.removeClass('cg_scroll_behaviour_initial');
        cgJsClass.gallery.vars.dom.body.removeClass('cg_scroll_behaviour_initial');

        cgJsData[gid].vars.mainCGdiv.removeClass('cg_fade_in cg_fade_in_2');

        // first timeout here
        // second might be required at if close button of some image was used and it have to be scrolled to the image
        setTimeout(function () {

            if(cgJsData[gid].vars.currentLook!='blog'){
                // only then can be unsetted, otherwise do not do this, otherwise jump!
                if(!$closeButton.attr('data-cg-real-id')){
                    cgJsData[gid].vars.mainCGdivContainer.css('height','unset');
                    cgJsData[gid].vars.mainCGallery.removeClass('cg_hidden cg_invisible cg_blog_view_hidden cg_blog_view_hidden cg_slider_view_hidden');// otherwise gallery will be not displayed!!!
                    cgJsData[gid].vars.mainCGdiv.removeClass('cg_center_pointer_event_none');// otherwise controll elements can not be clicked!
                }
                //  debugger
            }else{
                setTimeout(function () {
                    cgJsClass.gallery.vars.dom.html.addClass('cg_scroll_behaviour_initial');// !important!!! do this
                    cgJsClass.gallery.vars.dom.body.addClass('cg_scroll_behaviour_initial');
                    cgJsClass.gallery.vars.dom.html.addClass('cg_no_scroll');// first it has to scroll
                    // do not do this, otherwise jump!
                    if(!$closeButton.attr('data-cg-real-id')){// only then can be unsetted, otherwise do not do this, otherwise jump!
                        cgJsData[gid].vars.mainCGdiv.addClass('cg_fade_in_2');
                        setTimeout(function () {
                            cgJsData[gid].vars.mainCGdiv.removeClass('cg_fade_in_2');
                        },2200);// remove this again otherwise might be executed again and again

                        cgJsData[gid].vars.mainCGdivContainer.css('height','unset');// do it only for blog view!

                    }
                    //setTimeout(function () {
                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');// first it has to scroll
                    cgJsClass.gallery.vars.dom.html.animate({
                        //    scrollTop: cgJsData[gid].vars.mainCGdivHelperParent.find('.cg_header').offset().top+'px'
                    }, 0, function () {
                        cgJsClass.gallery.vars.dom.html.removeClass('cg_scroll_behaviour_initial');// !important!!! do this
                        cgJsClass.gallery.vars.dom.body.removeClass('cg_scroll_behaviour_initial');// !important!!! do this
                    });
                    //  },10);

                },50);// important!!! This has to be 200, otherwise to slow if to an image has to be scrolled
            }

            if(!cgJsData[gid].vars.openedRealId && cgJsData[gid].vars.currentLook!='blog'){
                cgJsData[gid].vars.mainCGallery.removeClass('cg_invisible').css('height','unset').addClass('cg_fade_in');
            }else if($closeButton && cgJsData[gid].vars.currentLook=='blog'){
                cgJsData[gid].vars.mainCGallery.removeClass('cg_invisible').css('height','unset').addClass('cg_fade_in');
            }else if(cgJsData[gid].vars.currentLook=='blog'){
                cgJsData[gid].vars.mainCGallery.removeClass('cg_invisible').css('height','unset').addClass('cg_fade_in');
            }else{

            }
            // have to be done here because escape button might be clicked for closing full window
            if(cgJsData[gid].vars.openedRealId && sliderView && !$closeButton){
                cgJsData[gid].vars.mainCGallery.removeClass('cg_slider_view_hidden');
                cgJsData[gid].vars.cgCenterDiv.removeClass('cg_slider_view_hidden');
            }

            if(!$closeButton){
                cgJsData[gid].vars.mainCGdiv.removeClass('cg_center_pointer_event_none');
            }

            if($closeButton){
                if(!$closeButton.attr('data-cg-real-id')){
                    cgJsData[gid].vars.mainCGdiv.removeClass('cg_center_pointer_event_none');
                }
            }

        },100);

        /*
                    var order = cgJsData[gid].vars.openedGalleryImageOrder;

                    cgJsClass.gallery.views.close(gid);
                    cgJsClass.gallery.views.singleView.openAgain(gid, order);*/

        $mainCGdivHelperParent.find('.cg_sort_div .cg-gallery-upload').removeClass('cg_hide');
        $mainCGdivHelperParent.find('.cg-fullwindow-configuration-button').addClass('cg_hide');
        $mainCGdivHelperParent.find('.cg-fullscreen-button').addClass('cg_hide');

        $mainCGdivHelperParent.find('.cg-gallery-upload.cg-header-controls-show-only-full-window').addClass('cg_hide');

        // FullSize is full screen and full sull size gallery is full window
        if(cgJsData[gid].options.general.FullSize==1 && cgJsData[gid].options.general.FullSizeGallery==1){
            $mainCGdivHelperParent.find('.cgCenterDiv .cg-fullscreen-button').addClass('cg_hide');
        }

        cgJsData[gid].vars.mainCGallery.removeClass('cg_full_window');

        if(cgJsData[gid].vars.currentLook=='blog'){
            cgJsClass.gallery.blogLogic.init(jQuery,gid,null,null,null,true,false,false,false,true);
            var factor = cgJsData[gid].vars.widthmain/cgJsData[gid].vars.widthmainPrevious;
            cgJsClass.gallery.blogLogic.changeWidth(cgJsData[gid].vars.widthmain,factor,$mainCGdivHelperParent,gid);
        }

        cgJsData[gid].vars.cgCenterDivLastHeight = null;

        // second timeout here
        // second might be required at if close button of some image was used and it have to be scrolled to the image
        if($closeButton.attr('data-cg-real-id')){

            cgJsData[gid].vars.mainCGallery.addClass('cg_invisible cg_hidden cg_blog_view_hidden cg_slider_view_hidden');
            if(sliderView){
                cgJsData[gid].vars.cgCenterDiv.addClass('cg_slider_view_hidden');
            }
            cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.removeClass('cg_hide');
            if(sliderView){
                cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.addClass('cg_slider_view_visible_and_display_table');
            }

            cgJsClass.gallery.vars.dom.html.addClass('cg_scroll_behaviour_initial');
            cgJsClass.gallery.vars.dom.body.addClass('cg_scroll_behaviour_initial');

            cgJsClass.gallery.vars.dom.html.animate({
                //     scrollTop: cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.offset().top-cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.height()-200+'px'
            }, 0, function () {
                cgJsClass.gallery.vars.dom.html.addClass('cg_no_scroll');// first it has to scroll

            });

            var timeout = 200;

            if(sliderView){// for nice loading
                timeout = 1000;
            }

            if(cgJsData[gid].vars.currentLook=='blog'){// then with animation  scroll!

                var $cgCenterDiv = cgJsData[gid].cgCenterDivBlogObject[$closeButton.attr('data-cg-real-id')];

                setTimeout(function () {

                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                    // important flex and height unset, otherwise height might be set and break the gallery
                    if(cgJsData[gid].vars.currentLook=='thumb' && !sliderView){
                        cgJsData[gid].vars.mainCGallery.addClass('cg_thumb_look');
                    }
                    cgJsData[gid].vars.mainCGallery.css('height','unset');

                    // animating here at top and at the bottom, seems to be best behvaiour
                    /*cgJsClass.gallery.vars.dom.html.animate({
                        scrollTop: $cgCenterDiv.offset().top-50+'px'
                    }, 0, function () {

                    });*/

                    if(sliderView){// !mportant to do it also here because of previous look slider might was
                        cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.removeClass('cg_slider_view_visible_and_display_table');
                    }
                    cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.removeClass('cg_margin_top_0').addClass('cg_hide');
                    cgJsData[gid].vars.mainCGallery.removeClass('cg_hide cg_hidden cg_invisible cg_blog_view_hidden cg_slider_view_hidden').addClass('cg_fade_in');
                    if(sliderView){// !mportant to do it also here because of previous look slider might was
                        cgJsData[gid].vars.cgCenterDiv.removeClass('cg_slider_view_hidden');
                    }
                    cgJsData[gid].vars.closeEventInitWithDataCGrealIdCloseButton = false;
                    cgJsData[gid].vars.mainCGdiv.removeClass('cg_center_pointer_event_none');

                    cgJsClass.gallery.vars.dom.html.removeClass('cg_scroll_behaviour_initial');
                    cgJsClass.gallery.vars.dom.body.removeClass('cg_scroll_behaviour_initial');


                    $mainCGdivHelperParent.find('#cgViewHelper'+gid).get(0).scrollIntoView();

                    var $cgHeightController = jQuery('<div id="cgHeightController"></div>').height(cgJsData[gid].vars.mainCGdivContainer.outerHeight());// for proper scroll displaying!
                    //$cgHeightController.insertBefore(cgJsData[gid].vars.mainCGdivContainer);// for proper scroll displaying!
                    // debugger
                    cgJsData[gid].vars.mainCGdiv.addClass('cg_fade_in_2');// do it only for blog view!
                    setTimeout(function () {
                        cgJsData[gid].vars.mainCGdiv.removeClass('cg_fade_in_2');
                    },2200);// remove this again otherwise might be executed again and again

                    // then unset here
                    cgJsData[gid].vars.mainCGdivContainer.css('height','unset');



                    // scroll into view
                    setTimeout(function () {
                        $cgCenterDiv.get(0).scrollIntoView();
                    },200);
                    //  $cgHeightController.remove();


                    //jQuery(window).scrollTop($cgCenterDiv.offset().top-50+'px');// make instant animation for this case!

                    // animating here at top and at the bottom, seems to be best behvaiour
                    /* cgJsClass.gallery.vars.dom.html.animate({
                         scrollTop: $cgCenterDiv.offset().top-50+'px'
                     }, 0, function () {

                     });*/

                },1500);
            }else{// no animation scroll required because image will be opened

                // all variants should be considered this way for $divToScroll

                cgJsClass.gallery.vars.isFromFullWindowAndDataCgRealIdHasToBeOpened = true;

                if(cgJsData[gid].options.visual.BlogLookFullWindow==1){
                    cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.addClass('cg_hide');
                }

                var $divToScroll = cgJsData[gid].vars.cgCenterDiv;

                // then has to scroll where it was opened
                if((cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1) && !sliderView){
                    $divToScroll = cgJsData[gid].imageObject[$closeButton.attr('data-cg-real-id')];
                }else if(cgJsClass.gallery.function.general.tools.isFullSizeSlideOutStartNormally(gid)
                    && !sliderView
                ){
                    $divToScroll = cgJsData[gid].imageObject[$closeButton.attr('data-cg-real-id')];
                }
                if(sliderView){
                    $divToScroll = cgJsData[gid].vars.mainCGdiv;
                }

                setTimeout(function () {
                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                    // important flex and height unset, otherwise height might be set and break the gallery
                    if(cgJsData[gid].vars.currentLook=='thumb' && !sliderView){
                        cgJsData[gid].vars.mainCGallery.addClass('cg_thumb_look');
                    }
                    cgJsData[gid].vars.mainCGallery.css('height','unset');
                    cgJsData[gid].vars.mainCGdivContainer.css('height','unset');

                    cgJsData[gid].vars.mainCGallery.removeClass('cg_hidden cg_invisible cg_blog_view_hidden cg_blog_view_hidden cg_slider_view_hidden');

                    var setRemoveClassClasses = function (){
                        if(sliderView){
                            cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.removeClass('cg_slider_view_visible_and_display_table');
                        }
                        cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.removeClass('cg_margin_top_0').addClass('cg_hide');
                        if(sliderView){
                            cgJsData[gid].vars.cgCenterDiv.removeClass('cg_slider_view_hidden');
                        }
                        cgJsData[gid].vars.mainCGallery.removeClass('cg_fade_in');
                        cgJsData[gid].vars.mainCGallery.addClass('cg_fade_in');
                        cgJsData[gid].vars.cgCenterDiv.addClass('cg_fade_in');
                        cgJsData[gid].vars.closeEventInitWithDataCGrealIdCloseButton = false;
                        cgJsData[gid].vars.mainCGdiv.removeClass('cg_center_pointer_event_none');

                        cgJsClass.gallery.vars.dom.html.removeClass('cg_scroll_behaviour_initial');
                        cgJsClass.gallery.vars.dom.body.removeClass('cg_scroll_behaviour_initial');

                    }

                    if(cgJsData[gid].vars.currentLook=='slider'){
                        /*cgJsClass.gallery.vars.dom.html.animate({
                            scrollTop: $divToScroll.offset().top-50+'px'
                        }, 0, function () {
                            setClasses();
                        });*/
                        setRemoveClassClasses();
                    }else{//
                        if((cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1)
                            ||
                            cgJsClass.gallery.function.general.tools.isFullSizeSlideOutStartNormally(gid)
                        ){
                            cgJsClass.gallery.vars.dom.html.animate({
                                scrollTop: $divToScroll.offset().top-50+'px'
                            }, 0, function () {
                                setRemoveClassClasses();
                            });
                        }else{
                            setRemoveClassClasses();
                        }
                    }

                    // latest here it can be removed to go sure
                    cgJsClass.gallery.vars.isFromFullWindowAndDataCgRealIdHasToBeOpened = false;

                },timeout);
            }

        }

    },
    checkIfGalleryAlreadyFullWindow: function (gid) {

        if(cgJsClass.gallery.vars.isMobile){
            var windowWidth = screen.width;
        }else{
            var windowWidth = jQuery(window).width();
        }

        // var widthMainCGallery = parseInt(jQuery('#mainCGdivContainer'+gid).parent().width());
        //   var cssWidth = jQuery('#mainCGdivContainer'+gid).parent().css('width');
        var mainCGdivContainerWidth = jQuery('#mainCGdivContainer'+gid).width();
        //   debugger
        var widthDifferenceCheck = windowWidth-mainCGdivContainerWidth;

        if(widthDifferenceCheck<100){
            cgJsData[gid].vars.galleryAlreadyFullWindow = true;
            jQuery('#cgCenterImageFullwindowHeader'+gid).hide();
            jQuery('#cgCenterImageFullwindow'+gid).hide();
        }else{
            cgJsData[gid].vars.galleryAlreadyFullWindow = false;
            if(!cgJsClass.gallery.vars.fullwindow){
                jQuery('#cgCenterImageFullwindowHeader'+gid).show();
            }
            jQuery('#cgCenterImageFullwindow'+gid).show();
        }

    }
};