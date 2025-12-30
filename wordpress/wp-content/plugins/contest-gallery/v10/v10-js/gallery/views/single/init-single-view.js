cgJsClass.gallery.views.singleView = {
    openImage:function ($,order,openComment,gid,direction,isGalleryOpened,isGalleryOpenedSliderLook,isBlogView,isResizeBlogViewOnly,isFirstScrollOrder,blogViewImagesLoadedCount,isFromTopScroll) {

        if(cgJsData[gid].vars.blogViewImagesLoaded && !isResizeBlogViewOnly){
            return;
        }

        var cgJsDataGidImageLength = Object.keys(cgJsData[gid].image).length;
        if(cgJsData[gid].vars.currentLook=='blog' && !isResizeBlogViewOnly && !isFirstScrollOrder && blogViewImagesLoadedCount){
            // load max 10 images if 10, or 20nth or so on come then break
            // order!=9 because then exactly 10 images loaded, otherwise if 10 images loaded will be last one not shown!
        //    console.log(blogViewImagesLoadedCount);
            //if(((blogViewImagesLoadedCount) % 10 === 0 && order!=0 && cgJsDataGidImageLength != 11)){// exception for 11, because then all images can be loaded, otherwise 11 is not shown, research why
            if(((blogViewImagesLoadedCount) % 10 === 0 && order>10 && cgJsDataGidImageLength != 21)){// if 21 then can be simply loaded
                cgJsData[gid].vars.blogViewImagesLoaded = true;
                cgJsData[gid].vars.blogViewImagesLoadedGid = gid;
                cgJsData[gid].vars.blogViewImagesLoadedLastOrder = order-1;// because was not processed, that why -1 !!!!!
                cgJsData[gid].vars.blogViewImagesLoopOneTimeLoaded = true;
                if(isFromTopScroll && order!=0){
                    cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.removeClass('cg_hide');
                }else{
                    cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.removeClass('cg_hide');
                }
                return 'break';
            }
        }

        // from here on it must be loaded!!!!
        cgJsData[gid].vars.blogViewImagesLoadedLastOrder = order;

        var noSlideOut = false;

        var gidForCenterDivElements = gid;

        var firstKey = Object.keys(cgJsData[gid].image[order])[0];
        var realId = cgJsData[gid].image[order][firstKey]['id'];

    //    console.log('orderProcessing');
    //    console.log(order);
   //     console.log('realId');
   //     console.log(realId);

        if(isBlogView){
            gidForCenterDivElements = gid+'-'+order;
            if(order+1==cgJsDataGidImageLength){
                cgJsData[gid].vars.blogViewImagesLoadedAllImages = true;
            }else{
                cgJsData[gid].vars.blogViewImagesLoadedAllImages = false;
            }
        }

        if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1){
            noSlideOut = true;
        }

        if(noSlideOut==false){
           // jQuery('html').addClass('cg_no_scroll');
        }

        // prüfen ob eine andere gallerie geöffnet ist falls mehrere shortcodes vorhanden
        if(cgJsClass.gallery.vars.openedGallery!=null){
            if(cgJsClass.gallery.vars.openedGallery!=gid){
              //  cgJsClass.gallery.views.close(cgJsClass.gallery.vars.openedGallery,true);
            }
        }

        cgJsClass.gallery.vars.openedGallery = gid;

        // braucht man zur Orientierung zwecks hash change
        cgJsClass.gallery.vars.showImageClicked = true;

        var sliderView = false;

        if(cgJsData[gid].vars.currentLook=='slider'){
            sliderView = true;
        }

        if(isBlogView){
            sliderView = true;
        }

        if(sliderView){
            cgJsData[gid].vars.mainCGallery.addClass('cg_slider').removeClass('cg_hide');
        }else{
            cgJsData[gid].vars.mainCGallery.removeClass('cg_slider');
        }

        var windowHeight = jQuery(window).height();
     //   var windowWidth = jQuery(window).width();

        var cgCenterDivWidth = cgJsData[gid].vars.widthmain;

        var scalingMultiplicatorCenterDiv = 9;

        if(windowHeight<640){
            scalingMultiplicatorCenterDiv = 4;
        }else if(windowHeight<700){
            scalingMultiplicatorCenterDiv = 4.5;
        }else if(windowHeight<800){
            scalingMultiplicatorCenterDiv = 5;
        }else if(windowHeight<900){
            scalingMultiplicatorCenterDiv = 5.4;
        }else if(windowHeight<1000){
            scalingMultiplicatorCenterDiv = 5.9;
        }else if(windowHeight<1100){
            scalingMultiplicatorCenterDiv = 6.3;
        }else if(windowHeight<1200){
            scalingMultiplicatorCenterDiv = 6.7;
        }else{
            scalingMultiplicatorCenterDiv = 7.1;
            if(windowHeight>2000){// for very huge monitors
                scalingMultiplicatorCenterDiv = 9;
            }
        }

        var scalingMultiplicatorForDivImageParent = 2.5;

        if(cgCenterDivWidth>=400){
            scalingMultiplicatorForDivImageParent = 3
        }
        if(cgCenterDivWidth>=700){
            scalingMultiplicatorForDivImageParent = 4
        }
        if(cgCenterDivWidth>=800){
            scalingMultiplicatorForDivImageParent = 4.5
        }
        if(cgCenterDivWidth>=1000){
            scalingMultiplicatorForDivImageParent = 5
        }
        if(cgCenterDivWidth>=1200){
            scalingMultiplicatorForDivImageParent = 5.5
        }
        if(cgCenterDivWidth>=1400 && sliderView==false){
            scalingMultiplicatorForDivImageParent = 6
        }
        if(cgCenterDivWidth>=1600 && sliderView==false){
            scalingMultiplicatorForDivImageParent = 6.5
        }

        if(cgCenterDivWidth>=1800 && sliderView==false){
            scalingMultiplicatorForDivImageParent = 7
        }
        if(cgCenterDivWidth>=1900 && sliderView==false){
            scalingMultiplicatorForDivImageParent = 7
        }

        if(cgJsClass.gallery.vars.isMobile==true){
            if(screen.height >= screen.width){//vertical view
                scalingMultiplicatorForDivImageParent = 9;
            }else{
                scalingMultiplicatorForDivImageParent = 8.5;
            }
        }else if(sliderView && cgJsClass.gallery.vars.fullwindow){
            if(windowHeight<640){
                scalingMultiplicatorForDivImageParent = 4;
            }else if(windowHeight<700){
                scalingMultiplicatorForDivImageParent = 4.5;
            }else if(windowHeight<800){
                scalingMultiplicatorForDivImageParent = 5;
            }else if(windowHeight<900){
                scalingMultiplicatorForDivImageParent = 5.4;
            }else if(windowHeight<1000){
                scalingMultiplicatorForDivImageParent = 5.9;
            }else if(windowHeight<1100){
                scalingMultiplicatorForDivImageParent = 6.3;
            }else if(windowHeight<1200){
                scalingMultiplicatorForDivImageParent = 6.7;
            }else{
                scalingMultiplicatorForDivImageParent = 7.1;
                if(windowHeight>2000){// for very huge monitors
                    scalingMultiplicatorForDivImageParent = 7.3;
                }
            }
        }

/*         if(cgJsClass.gallery.vars.fullwindow){
             scalingMultiplicatorForDivImageParent = 7.5;
         }*/

/*        if(cgJsClass.gallery.vars.isMobile==true){
            scalingMultiplicatorCenterDiv = 9;
            scalingMultiplicatorForDivImageParent = 8;
            scalingMultiplicatorForDivImage = 7.8;
        }

        if(windowHeight>windowWidth){// dann verticale Ansicht!
            scalingMultiplicatorCenterDiv = 7;
            scalingMultiplicatorForDivImageParent = 4;
            scalingMultiplicatorForDivImage = 3.8;

            if(cgJsClass.gallery.vars.isMobile==true){
                scalingMultiplicatorCenterDiv = 7;
                scalingMultiplicatorForDivImageParent = 6;
                scalingMultiplicatorForDivImage = 5.8;
            }

        }*/

        if(cgJsClass.gallery.vars.fullwindow){

            var setHeightToMakeDivStable = windowHeight/10*scalingMultiplicatorCenterDiv;
            var cgCenterImageParentHeight = windowHeight/10*scalingMultiplicatorForDivImageParent;

        }else{
            var setHeightToMakeDivStable = windowHeight/10*scalingMultiplicatorCenterDiv;
            var cgCenterImageParentHeight = windowHeight/10*scalingMultiplicatorForDivImageParent;
        }

        // new since 28.09.2020
        if(true){
            setHeightToMakeDivStable = windowHeight;
            cgCenterImageParentHeight = windowHeight/5*4;
        }

        // height setzten damit es nicht springt, später wieder entfernen ganz unten
        //jQuery('#cgCenterDiv'+gidForCenterDivElements).height(setHeightToMakeDivStable);
        var cgCenterDiv = cgJsData[gid].vars.cgCenterDiv;

        if(sliderView){
            // remove cg_hide first
            cgCenterDiv.removeClass('cg_hide');

            // otherwise blink in not full window if slider view is activated
            cgCenterDiv.removeClass('cg_blog_view_visible');
        }else{
            cgCenterDiv.removeClass('cg_blog_view_visible');
        }

        // can be removed here generallay otherwise might always appear as fade in
        cgCenterDiv.removeClass('cg_fade_in');

        if(isBlogView){

            if(isResizeBlogViewOnly){
                //console.log('get per realId');
                cgCenterDiv = cgJsData[gid].cgCenterDivBlogObject[realId];
            }else{
                cgCenterDiv = cgCenterDiv.clone();
                cgCenterDiv.removeClass('cg_hide');// has to done additionally in case of blog view, because cgCenterDiv got class cg_hide at beginning of blog-logic.js
                //console.log('clone');
                cgJsData[gid].cgCenterDivBlogObject[realId] = cgCenterDiv;
            }

            //console.trace();
            cgCenterDiv.addClass('cgCenterDivForBlogView');
            cgCenterDiv.removeClass('cg_fade_in');

            cgCenterDiv.attr('data-cg-real-id',+realId);
            cgCenterDiv.find('#cgCenterImageFullwindow'+gid).attr('data-cg-real-id',+realId);

            if(order==0){
                cgCenterDiv.addClass('cg_margin_top_0');
                cgJsData[gid].vars.firstOrderRealIdBlogView = realId;
            }

            if(!isResizeBlogViewOnly){
                cgCenterDiv.attr('id',cgCenterDiv.attr('id')+'-'+order);
                cgCenterDiv.attr('data-cg-gid-with-order',gid+'-'+order);
                cgCenterDiv.attr('data-cg-order',order);
            }

            if(!isResizeBlogViewOnly){
                // modify id for every element
                cgCenterDiv.find('*').each(function (){
                    var $element = $(this);
                    if($element.attr('id')){
                         $element.attr('id',$element.attr('id')+'-'+order);
                    }
                });
            }

            cgCenterDiv.find('.cg-center-arrow').remove();

            // for blogView cloned cgCenterDiv has to insertAfter(scroll top) or append(scroll bottom)!!!!
            if(!isResizeBlogViewOnly){

                if(isFromTopScroll){
                    //console.log('prepend real order and real Id');
                //    console.log(order);
                //    console.log(realId);
                    cgCenterDiv.insertAfter(cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide);
                }else{
                    cgJsData[gid].vars.mainCGallery.append(cgCenterDiv);
                }
                cgCenterDiv.addClass('cg_fade_in');
            }

      }

        cgCenterDiv.attr('data-cg-real-id',realId);
        cgCenterDiv.attr('data-cg-gid-for-center-div-elements',gidForCenterDivElements);

        if(sliderView && cgJsData[gid].vars.currentLook!='blog'){
            cgCenterDiv.find('#cgCenterGoUpButton'+gidForCenterDivElements).addClass('cg_hide');
        }else{
            if(cgJsData[gid].vars.currentLook=='blog'){
                if(order==0){// do not when first image at top in the moment
                    cgCenterDiv.find('#cgCenterGoUpButton'+gidForCenterDivElements).addClass('cg_hide');
                }else{
                    cgCenterDiv.find('#cgCenterGoUpButton'+gidForCenterDivElements).removeClass('cg_hide');
                }
            }else{
                // has to be always done because if switch to slider view it gets cg_hide!!!
                cgCenterDiv.find('#cgCenterGoUpButton'+gidForCenterDivElements).removeClass('cg_hide');
            }
        }

        if(cgJsData[gid].vars.centerWhite){
            cgCenterDiv.addClass('cg_center_white');
        }

        if(sliderView){
            cgCenterDiv.closest('.mainCGdiv').addClass('cg-slider-view');
            cgCenterDiv.find('.cg-center-div-helper').addClass('cg-slider-view');
        }else{
            cgCenterDiv.closest('.mainCGdiv').removeClass('cg-slider-view');
            cgCenterDiv.find('.cg-center-div-helper').removeClass('cg-slider-view');
        }

        if(cgJsData[gid].vars.currentLook!='slider'){
            cgCenterDiv.css('width',cgCenterDivWidth+'px');
        }

        if(sliderView){
            cgCenterDivWidth = cgCenterDivWidth;
            cgCenterDiv.css('width',cgCenterDivWidth+'px');
        }

        if(sliderView && cgJsClass.gallery.vars.fullwindow && !isBlogView){
            cgCenterDiv.addClass('cg_margin_bottom_0');
            cgJsData[gid].vars.mainCGdiv.addClass('cg_margin_bottom_0 cg_padding_bottom_0');
        }else{
            cgCenterDiv.removeClass('cg_margin_bottom_0');
            cgJsData[gid].vars.mainCGdiv.removeClass('cg_margin_bottom_0 cg_padding_bottom_0');
        }

        if(isBlogView){
            if(order+1==cgJsDataGidImageLength){
                cgCenterDiv.addClass('cg_margin_bottom_0');
            }
        }


        if(!isResizeBlogViewOnly){

            if(cgJsData[gid].vars.translateX){

                cgCenterDiv.find('#cgCenterImageDiv'+gidForCenterDivElements).show();

                var minus = '';

                if(typeof direction == 'undefined'){
                    direction = 'right';
                }
                if(direction=='left'){
                    minus = '-';
                }
                cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).addClass('cg_hide cg_translateX').removeClass('cg_transition');
            }else{

                cgCenterDiv.find('#cgCenterImageDiv'+gidForCenterDivElements).show();
                cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).hide();
            }
            //cgCenterDiv.css('min-height',setHeightToMakeDivStable+'px');

        }


        if(!cgJsData[gid].vars.cgCenterDivLastHeight){
            cgCenterDiv.css('min-height',setHeightToMakeDivStable+'px');
            cgCenterDiv.css('height','unset');// important to unset height here, maybe was slider view before

            if(sliderView){
                cgCenterDiv.css('height',setHeightToMakeDivStable+'px');
            }
        }else{
            cgCenterDiv.css('min-height',''+String(cgJsData[gid].vars.cgCenterDivLastHeight)+'px');
            cgCenterDiv.css('height','unset');// important to unset height here, maybe was slider view before

            if(sliderView){
                cgCenterDiv.css('height',''+String(cgJsData[gid].vars.cgCenterDivLastHeight)+'px');
            }
        }

        var spaceForShowExif = 0;

        if(cgJsData[gid].options.pro.ShowExif==1){
            spaceForShowExif = 85;

            cgCenterImageParentHeight = cgCenterImageParentHeight+spaceForShowExif;

        }

        // since 19.09.2020 not anymore
        /*cgCenterDiv.find('#cgCenterImageParent'+gid).css({
            'min-height':cgCenterImageParentHeight+'px',
            'max-height':cgCenterImageParentHeight+'px',
            'height':cgCenterImageParentHeight+'px'
        });*/

        cgCenterDiv.find('#cgCenterImageParent'+gidForCenterDivElements).css({
            'min-height':'unset',
            'max-height':'unset',
            'height':'unset'
        });

        order = parseInt(order);

        if(cgJsClass.gallery.vars.openedGallery != gid && cgJsClass.gallery.vars.openedGallery!=null){
                cgJsClass.gallery.views.close(cgJsClass.gallery.vars.openedGallery,true);
        }

        cgJsClass.gallery.vars.openedGallery = gid;
        cgJsClass.gallery.vars.thereIsImageInfo = false;

        // pauschal schließen falls mehrere gallerien auf einer seite sind
/*        $('.cgCenterDiv').css({
            'display':'none',
            'width':''
        });*/

        // erstmal auf display none setzen um die höhe der images für offest genau berechnen zu können
      //  cgJsData[gid].vars.cgCenterDivAppearenceHelper.removeClass('cg_hide');

        if(!isBlogView){
            cgCenterDiv.find('.cg-center-image-div').hide();
        }

/*        cgCenterDiv.css({
            'display':'none',
            'margin-top': 'unset',
            'margin-bottom': 'unset'
        });*/

        // wichtig! display none!!! ansonsten kann insert an falscher stelle stattfinden!


        var PicsPerSite = parseInt(cgJsData[gid].options.general.PicsPerSite);

        var rowId = cgJsData[gid].image[order][firstKey]['rowid'];

        // var imageObject = cgJsData[gid].image[order][firstKey]['imageObject'];
        var imageObject = cgJsData[gid].imageObject[realId];

        if(sliderView && !isBlogView){

            for(var propertyName in cgJsData[gid].imageObject){
                if(!cgJsData[gid].imageObject.hasOwnProperty(propertyName)){
                    break;
                }
                cgJsData[gid].imageObject[propertyName].removeClass('cg_selected')
            }
            imageObject.addClass('cg_selected');

            cgJsData[gid].vars.mainCGallery.find('.cg_position_hr_1, .cg_position_hr_2, .cg_position_hr_3').remove();
            imageObject.append($(cgJsClass.gallery.vars.cg_position_hrs));

        }

        var ShowNickname = cgJsData[gid].options.pro.ShowNickname;

        // fblike extra append back wenn fblikeoutgallery on
        var FbLike = cgJsData[gid].options.general.FbLike;
        var FbLikeGallery = cgJsData[gid].options.general.FbLikeGallery;
        if(FbLike >=1 && FbLikeGallery>=1 && cgJsData[gid].vars.openedRealId>=1 && !isBlogView){

            if(!cgJsData[gid].vars.isOnlyGalleryNoVoting){
                // clone append rating div
                //   var fbContent = cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).html();
                // fb like zurücksetzen in gallery view hier
                if(sliderView==true){
                    cgJsData[gid].imageObject[cgJsData[gid].vars.openedRealId].find('.cg_gallery_facebook_div').html(fbContent).addClass('cg_hide');
                }else{
                    cgJsData[gid].imageObject[cgJsData[gid].vars.openedRealId].find('.cg_gallery_facebook_div').html(fbContent).removeClass('cg_hide');
                }
            }

          //  jQuery('#cgFacebookGalleryDiv'+realId).html(fbContent);
         //   jQuery('#cgFacebookGalleryDiv'+realId).removeClass('cg_hide');

        }

        cgJsClass.gallery.vars.openedGalleryImageOrder = order;
        cgJsData[gid].vars.openedGalleryImageOrder = order;

        var cgRotationThumbNumber = cgJsData[gid].image[order][firstKey].rThumb;
        var $cgCenterImage = cgCenterDiv.find('.cg-center-image');

        if(!isResizeBlogViewOnly){

            if(sliderView){
             //   cgCenterDiv.find('#cgCenterImageClose'+gidForCenterDivElements).addClass('cg_hide');
            }else{
               // cgCenterDiv.find('#cgCenterImageClose'+gidForCenterDivElements).removeClass('cg_hide');
            }

            // 25.04.2020 always hide this button now!!! Modern style
            cgCenterDiv.find('#cgCenterImageClose'+gidForCenterDivElements).addClass('cg_hide');

            if(cgJsClass.gallery.vars.fullwindow && cgJsData[gid].options.visual['ImageViewFullScreen']==1){
                cgCenterDiv.find('.cg-header-controls-show-only-full-window').removeClass('cg_hide');

                // somehow the full window needs to be closed then!
                //if(!cgJsData[gid].vars.mainCGdiv.find('.cg_header .cg-center-image-close-fullwindow').length){// check if close button available in header before hide
                    cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).removeClass('cg_hide');
                //}

            }else{
                cgCenterDiv.find('.cg-header-controls-show-only-full-window').addClass('cg_hide');
            }

            cgCenterDiv.attr('data-cg-cat-id',cgJsData[gid].image[order][firstKey]['Category']);
            cgCenterDiv.find('.cg-center-image-comments-div-enter').hide();
            cgCenterDiv.find('.cg-center-image-comments-div-parent > .cg-center-image-comments-div-add-comment').hide().addClass('cg_hidden');
            cgCenterDiv.find('.cg-top-bottom-arrow').addClass('cg_hide');
            cgCenterDiv.find('#cgCenterImageCommentsDiv'+gidForCenterDivElements).addClass('cg_hide');
            cgCenterDiv.find('#cgCenterImageCommentsDivParentParent'+gidForCenterDivElements).addClass('cg_hide');
            cgCenterDiv.find('.cg-center-image-info-div-parent-padding').removeClass('cg-center-image-info-div-parent-padding');
            cgCenterDiv.find('.cg-center-image-info-info-separator').addClass('cg_hide');
           // cgCenterDiv.find('.cg-center-image-info-comments-separator').addClass('cg_hide');
            cgCenterDiv.find('.cg-center-image-comments-div-parent-parent').addClass('cg_hide');
            cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements).addClass('cg_hide').find('.cg-exif').addClass('cg_hide');

            if(!cgJsData[gid].vars.translateX){
                cgCenterDiv.find('.cg-center-image').hide();
            }

            cgCenterDiv.find('.cg-center-image').removeClass('cg_contain');
            cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).hide().removeClass('cg_hide');
            cgCenterDiv.find('#cgCenterImageRatingDiv'+gidForCenterDivElements).hide();
            $cgCenterImage.removeClass('cg180degree cg270degree cg90degree cg0degree');
            $cgCenterImage.find('.cg-center-image-rotated').hide();

            if(cgRotationThumbNumber=='180'){
                $cgCenterImage.find('.cg-center-image-rotated').addClass('cg180degree').removeClass('cg90degree cg270degree cg0degree').show();
            }
            else if(cgRotationThumbNumber=='270'){
                $cgCenterImage.find('.cg-center-image-rotated').addClass('cg270degree').removeClass('cg90degree cg180degree cg0degree').show();
            }
            else if(cgRotationThumbNumber=='90'){
                $cgCenterImage.find('.cg-center-image-rotated').addClass('cg90degree').removeClass('cg270degree cg180degree cg0degree').show();
            }
            else{
            }

            if(cgJsData[gid].options.general.FullSize != '1'){
                cgCenterDiv.find('.cg-center-image-download').hide();
            }

        }

        cgJsData[gid].vars.openedGalleryImageOrder = order;
        var galleryId = gid;
        var AllowRating = cgJsData[gid].options.general.AllowRating;
        var AllowComments = cgJsData[gid].options.general.AllowComments;

        if(!isResizeBlogViewOnly){

            cgCenterDiv.find('#cgCenterImageInfoDiv'+gidForCenterDivElements).empty();
            cgCenterDiv.find('#cgCenterImageCommentsDiv'+gidForCenterDivElements).empty();

            var fullImageDataToUse;

            if(cgJsData[gid].vars.sorting == 'random'){
                fullImageDataToUse = cgJsData[gid].vars.sortedRandomFullData;
            }
            else if(cgJsData[gid].vars.sorting == 'date-desc'){
                fullImageDataToUse = cgJsData[gid].vars.sortedDateDescFullData;
            }
            else if(cgJsData[gid].vars.sorting == 'date-asc'){
                fullImageDataToUse = cgJsData[gid].vars.sortedDateAscFullData;
            }
            else if(cgJsData[gid].vars.sorting == 'rating-desc'){
                fullImageDataToUse = cgJsData[gid].vars.sortedRatingDescFullData;
            }
            else if(cgJsData[gid].vars.sorting == 'rating-asc'){
                fullImageDataToUse = cgJsData[gid].vars.sortedRatingAscFullData;
            }
            else if(cgJsData[gid].vars.sorting == 'comments-desc'){
                fullImageDataToUse = cgJsData[gid].vars.sortedCommentsDescFullData;
            }
            else if(cgJsData[gid].vars.sorting == 'comments-asc'){
                fullImageDataToUse = cgJsData[gid].vars.sortedCommentsAscFullData;
            }else{
                fullImageDataToUse = cgJsData[gid].fullImageDataFiltered;
            }



            if(order==0 && cgJsData[gid].vars.currentStep>1){

                //   var checkFirstCurrentStep = false;
                var imageObjectToCompare = undefined;
                var imageObjectLastPrevStep = undefined;

                for (var i = 0, len = cgJsData[gid].vars.imageDataLength; i < len; i++) {

                    /*
                                    if(checkFirstCurrentStep){
                                        imageObjectLastPrevStep = imageObjectToCompare;
                                        break;
                                    }
                    */

                    var firstKeyToCompare = Object.keys(fullImageDataToUse[i])[0];

                    if(fullImageDataToUse[i][firstKeyToCompare].rowid==rowId){
                        // checkFirstCurrentStep = true;
                        imageObjectLastPrevStep = imageObjectToCompare;
                        break;
                    }

                    imageObjectToCompare=fullImageDataToUse[i][firstKeyToCompare];

                }

                if(typeof imageObjectLastPrevStep != 'undefined'){

                    var prevRealId = imageObjectLastPrevStep.id;
                    var prevStepNumber = parseInt(cgJsData[gid].vars.currentStep);
                    prevStepNumber--;
                    cgCenterDiv.find('#cgCenterArrowLeft'+gidForCenterDivElements).removeClass('cg-center-arrow-left cg_center_pointer_event_none').addClass('cg-center-arrow-left-prev-step cg_further_images').attr({
                        'data-cg-step':prevStepNumber,
                        'data-cg-step-prev-real-id':prevRealId,
                        'data-cg-gid':gid
                    });

                }else{
                    cgCenterDiv.find('#cgCenterArrowLeft'+gidForCenterDivElements).addClass('cg_center_pointer_event_none');
                }

            }
            else{
                cgCenterDiv.find('#cgCenterArrowLeft'+gidForCenterDivElements).removeClass('cg_center_pointer_event_none cg-center-arrow-left-prev-step cg_further_images')
                    .addClass('cg-center-arrow-left').removeAttr('data-cg-step data-cg-step-prev-real-id data-cg-step-next-real-id');// Pauschal die eventuell gesetzten Attribute für Pagination entfernen

                if(order==0){
                    cgCenterDiv.find('#cgCenterArrowLeft'+gidForCenterDivElements).addClass('cg_center_pointer_event_none');
                }
                else{
                    cgCenterDiv.find('#cgCenterArrowLeft'+gidForCenterDivElements).removeClass('cg_center_pointer_event_none');
                }

            }

            var orderCheck = order+1;

            if(cgJsData[gid].image.length==orderCheck && cgJsData[gid].vars.imageDataLength>PicsPerSite){

                var imageObjectNext = undefined;

                for (var i = 0, len = cgJsData[gid].vars.imageDataLength; i < len; i++) {

                    var firstKeyToCompare = Object.keys(fullImageDataToUse[i])[0];

                    if(fullImageDataToUse[i][firstKeyToCompare].rowid==rowId){

                        var iToCheck = i+1;

                        if(typeof fullImageDataToUse[iToCheck] != 'undefined'){

                            var firstKeyToCompare = Object.keys(fullImageDataToUse[iToCheck])[0];
                            imageObjectNext=fullImageDataToUse[iToCheck][firstKeyToCompare];

                        }

                        break;
                    }

                }


                if(typeof imageObjectNext != 'undefined'){
                    var nextRealId = imageObjectNext.id;
                    var nextStepNumber = parseInt(cgJsData[gid].vars.currentStep);
                    nextStepNumber++;
                    cgCenterDiv.find('#cgCenterArrowRight'+gidForCenterDivElements).removeClass('cg-center-arrow-right cg_center_pointer_event_none').addClass('cg-center-arrow-right-next-step cg_further_images').attr({
                        'data-cg-step':nextStepNumber,
                        'data-cg-step-next-real-id':nextRealId,
                        'data-cg-gid':gid
                    });

                }else{
                    cgCenterDiv.find('#cgCenterArrowRight'+gidForCenterDivElements).addClass('cg_center_pointer_event_none');
                }

            }
            else{
                cgCenterDiv.find('#cgCenterArrowRight'+gidForCenterDivElements).removeClass('cg_center_pointer_event_none cg-center-arrow-right-next-step cg_further_images')
                    .addClass('cg-center-arrow-right').removeAttr('data-cg-step data-cg-step-prev-real-id data-cg-step-next-real-id');// Pauschal die eventuell gesetzten Attribute für Pagination entfernen

                if(cgJsData[gid].image.length==orderCheck){
                    cgCenterDiv.find('#cgCenterArrowRight'+gidForCenterDivElements).addClass('cg_center_pointer_event_none');
                }
                else{
                    cgCenterDiv.find('#cgCenterArrowRight'+gidForCenterDivElements).removeClass('cg_center_pointer_event_none');
                }

            }

        }

        var mainCGalleryWidth = cgCenterDiv.closest('#mainCGallery'+gid).width();

        var hundertPercentWidth = cgJsClass.gallery.resize.resizeCenter(cgCenterDiv,gid,mainCGalleryWidth,gidForCenterDivElements);

        if(!isResizeBlogViewOnly){
            if(hundertPercentWidth){
                cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements).addClass('cg_hide');
            }else{
                cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements).removeClass('cg_hide');
            }
        }

        cgJsClass.gallery.info.setDeleteImageIcon(realId,gid,gidForCenterDivElements,true);

        cgJsClass.gallery.resize.resizeInfoAndCommentAreas(cgCenterDiv,gid,mainCGalleryWidth,gidForCenterDivElements);

        // Code falls man auf das selbe Bild nochmal klickt soll centerDiv zugehen
        /*        if(cgJsClass.gallery.vars.openedGalleryImageOrder==order){
                    cgCenterDiv.css('display','none');
                    cgJsClass.gallery.vars.openedGalleryImageOrder = null;
                    $('#cgCenterOrientation').cgGoTo();
                    return;
                }else{
                    cgJsClass.gallery.vars.openedGalleryImageOrder = order;
                }*/


        cgCenterDiv.attr('data-cg-order',order);

        if(cgJsData[gid].vars.isUserGallery){
            cgCenterDiv.find('#cgCenterImageInfoDivParent'+gidForCenterDivElements).removeClass('cg_edit');
        }

        var mainObject = cgJsData[gid].image[order][firstKey];

        var realId = cgJsData[gid].image[order][firstKey]['id'];

        cgCenterDiv.find('.cg-center-image-close').attr('data-cg-actual-realId',realId);
        cgCenterDiv.find('.cg-center-arrow-left').attr('data-cg-actual-realId',realId);
        cgCenterDiv.find('.cg-center-arrow-right').attr('data-cg-actual-realId',realId);

        cgJsClass.gallery.vars.openedRealId = realId;
        cgJsData[gid].vars.openedRealId = realId;

        var FullSizeGallery = cgJsData[gid].options.general.FullSizeGallery;

        if(cgJsClass.gallery.vars.fullwindow && cgJsData[gid].options.visual['ImageViewFullScreen']==1){
            // 05.10.2020, do not remove this. Works right if full window has always to be available in single image view
            if(cgJsData[gid].vars.mainCGdiv.find('.cg_header .cg-center-image-close-fullwindow').length){// check if close button available in header before hide
                cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).removeClass('cg_hide');
            }
        }else{
            // 05.10.2020, do not remove this. Works right if full window has always to be available in single image view
            if((cgJsData[gid].vars.galleryAlreadyFullWindow==true || (FullSizeGallery!=1 &&  cgJsData[gid].options.pro.SliderFullWindow!=1)) && !cgJsClass.gallery.vars.fullwindow){
                if(cgJsData[gid].vars.mainCGdiv.find('.cg_header .cg-center-image-close-fullwindow').length){// check if close button available in header before hide
                    cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).addClass('cg_hide');
                }else{
                    if(cgJsData[gid].options.visual['ImageViewFullWindow']==1){
                        cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).removeClass('cg_hide');
                    }else{
                        cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).addClass('cg_hide');
                    }

                }
            }else{
                if(cgJsData[gid].options.visual['ImageViewFullWindow']==1){
                    cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).removeClass('cg_hide');
                }else{
                    cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).addClass('cg_hide');
                }
            }
        }


        if((cgJsData[gid].options.pro.SliderFullWindow==1 || cgJsData[gid].options.visual.BlogLookFullWindow==1) && cgJsClass.gallery.vars.fullwindow){
            cgCenterDiv.find('#cgCenterImageFullwindow'+gidForCenterDivElements).attr('data-cg-real-id',realId).removeClass('cg_hide');
        }

        if(AllowRating>=1 && !cgJsData[gid].vars.isOnlyGalleryNoVoting && !isResizeBlogViewOnly){

            if(isBlogView){
                // comment set source is different, not here
                cgJsClass.gallery.dynamicOptions.setRatingAndComments(realId,order,false,gid);
            }else{
                    // clone append rating div
                    cgCenterDiv.find('#cgCenterImageRatingDiv'+gidForCenterDivElements).empty();
                    imageObject.find('.cg_gallery_rating_div').clone().appendTo(cgCenterDiv.find('#cgCenterImageRatingDiv'+gid)).find('.cg_gallery_rating_div_child').removeClass('cg_center').removeClass('cg_right');
                    cgCenterDiv.find('.cg_gallery_rating_div').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                    cgCenterDiv.find('.cg_gallery_rating_div .cg_rate_star').removeClass('cg_rate_out_gallery_disallowed').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                    cgCenterDiv.find('.cg_gallery_rating_div .cg_gallery_rating_div_count').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                    cgCenterDiv.find('.cg_gallery_rating_div_five_star_details').addClass('cg_hide');
            }

        }

        if(AllowComments>=1 && !isBlogView && !isResizeBlogViewOnly){

            // have to be done here before get comments data
            cgJsClass.gallery.views.singleViewFunctions.cloneCommentDiv(gid,realId,cgCenterDiv,imageObject,gidForCenterDivElements);

        }else if(AllowComments>=1 && isBlogView && !isResizeBlogViewOnly){

            // have to be done here before get comments data
            cgJsClass.gallery.views.singleViewFunctions.cloneCommentDiv(gid,realId,cgCenterDiv,imageObject,gidForCenterDivElements,isBlogView);

        }else{
            if(!isResizeBlogViewOnly){
                cgCenterDiv.find('#cgCenterImageCommentsDivParent'+gidForCenterDivElements+'').remove();
            }
        }

        if(FbLike>=1 && !isBlogView && !isResizeBlogViewOnly){

            if(!cgJsData[gid].vars.isOnlyGalleryNoVoting){

                if(FbLikeGallery>=1 && isGalleryOpened !== true){
                    // clone append rating div
                    var fbContent = imageObject.find('.cg_gallery_facebook_div').html();
                    var $cgCenterImageFbLikeDiv = cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).empty().html(fbContent).show();
                    imageObject.find('#cgFacebookGalleryDiv'+realId).addClass('cg_hide');
                }else{
                    cgJsData[gid].imageObject[cgJsData[gid].vars.openedRealId].find('.cg_gallery_facebook_div').addClass('cg_hide');
                    var fbContent = cgJsClass.gallery.fbLike.createFbLike(realId,gid);
                    var $cgCenterImageFbLikeDiv = cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).empty().show().append(fbContent);
                }

                if(cgJsData[gid].options.general.AllowRating!=1 && cgJsData[gid].options.general.AllowRating!=2){
                    if($cgCenterImageFbLikeDiv){
                        cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).addClass('cg_margin_top_10');
                    }
                }

            }

        }else if(FbLike>=1 && isBlogView && !isResizeBlogViewOnly){

            if(!cgJsData[gid].vars.isOnlyGalleryNoVoting){
                var fbContent = cgJsClass.gallery.fbLike.createFbLike(realId,gid);
                var $cgCenterImageFbLikeDiv = cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).empty().show().append(fbContent);
            }

            if(cgJsData[gid].options.general.AllowRating!=1 && cgJsData[gid].options.general.AllowRating!=2){
                if($cgCenterImageFbLikeDiv){
                    cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).addClass('cg_margin_top_10');
                }
            }

        }

        if(ShowNickname==1 && cgJsData[gid].vars.rawData[realId]['display_name']!=''){
            cgCenterDiv.find('#cgCenterImageDivButtonsBorder'+gidForCenterDivElements).removeClass('cg_hide');
            cgCenterDiv.find('#cgCenterShowNicknameParent'+gidForCenterDivElements).removeClass('cg_hide').css({
                'height':'auto',
                'visibility':'visible'
            });
            cgCenterDiv.find('#cgCenterShowNicknameText'+gidForCenterDivElements).text(cgJsData[gid].vars.rawData[realId]['display_name']);
        }else{
            if(ShowNickname==1){
                cgCenterDiv.find('#cgCenterImageDivButtonsBorder'+gidForCenterDivElements).addClass('cg_hide');
                cgCenterDiv.find('#cgCenterShowNicknameParent'+gidForCenterDivElements).addClass('cg_hide');
            }
        }

        var widthImage = cgJsData[gid].image[order][firstKey]['Width'];
        var heightImage = cgJsData[gid].image[order][firstKey]['Height'];
        if(!isBlogView){
            var imageObjectOuterWidth = imageObject.outerWidth();
            var offsetLeftClickedImage = imageObject.get(0).offsetLeft;// so ist schneller
        }else{
            offsetLeftClickedImage = 0;
        }

        var imageOffsetPrev = false;

        var firstImage = false;
        if(offsetLeftClickedImage==0){
            firstImage=true;
        }else{

       //     var imageObjectPref = cgJsData[gid].image[order-1][Object.keys(cgJsData[gid].image[order-1])[0]]['imageObject'];
     //       imageOffsetPrev = (typeof imageObjectPref != 'undefined') ? imageObjectPref.offset().top : false;
            //  var imageObjectNext = cgJsData[gid].image[i+1][Object.keys(cgJsData[gid].image[i+1])[0]]['imageObject'];
            //  var imageOffsetNext = (typeof imageObjectNext != 'undefined') ? imageObjectNext.offset().top : false;
        }

        var addDistancePics = true;
     //   if(imageOffsetPrev){
       //     if(imageOffsetPrev!=offsetTopClickedImage){
      //          addDistancePics = false;
         //   }
      //  }
        if(firstImage){addDistancePics=false}

        var widthOrientation;

        if(cgJsData[gid].vars.currentLook=='row'){

            //cgCenterDiv.css('margin-bottom', cgJsData[gid].options.visual.RowViewSpaceHeight+'px');

            if(addDistancePics){
                var positionLeftOrientation = imageObject.position().left+parseInt(cgJsData[gid].options.visual.RowViewSpaceWidth);
            }else{
                var positionLeftOrientation = imageObject.position().left;
            }

            widthOrientation = imageObjectOuterWidth;

        }

        if(cgJsData[gid].vars.currentLook=='height'){

         //   cgCenterDiv.css('margin-bottom', cgJsData[gid].options.visual.HeightViewSpaceHeight+'px');

            if(addDistancePics){
                var positionLeftOrientation = imageObject.position().left+parseInt(cgJsData[gid].options.visual.HeightViewSpaceWidth);
            }else{
                var positionLeftOrientation = imageObject.position().left;
            }

            widthOrientation = imageObjectOuterWidth;
        }

        if(cgJsData[gid].vars.currentLook=='thumb'){

            var distancePicsV = cgJsData[gid].options.general.DistancePicsV;

            if(sliderView){
                distancePicsV = 0;
            }

            positionLeftOrientation = cgJsClass.gallery.views.singleView.positionLeftOrientationThumbLook(gid,imageObject,addDistancePics,sliderView);

            widthOrientation = imageObjectOuterWidth;
        }

        if(!sliderView){
            cgCenterDiv.find('#cgCenterOrientation'+gidForCenterDivElements).width(widthOrientation);
            cgCenterDiv.find('#cgCenterOrientation'+gidForCenterDivElements).css('margin-left',positionLeftOrientation+'px');
            cgCenterDiv.find('#cgCenterOrientation'+gidForCenterDivElements).removeClass('cg_hide');
        }else{
            cgCenterDiv.find('#cgCenterOrientation'+gidForCenterDivElements).addClass('cg_hide');
        }

        var newHeightImage;
        var widthCgCenterImageDiv;

        if(cgJsData[gid].options.pro.ShowExif==1){
            newHeightImage = cgCenterImageParentHeight-spaceForShowExif;
        }else{
            newHeightImage = cgCenterImageParentHeight;
        }

        widthCgCenterImageDiv = newHeightImage*widthImage/heightImage;

        var cgCenterImageParentWidth = cgCenterDivWidth-40; // 20 padding left and right

        var maxCenterImageWidth = 1260;

        if(sliderView){
            maxCenterImageWidth = cgJsClass.gallery.vars.maxImageWidth + 60;
        }

        if(cgCenterImageParentWidth>maxCenterImageWidth){
            cgCenterImageParentWidth = maxCenterImageWidth;
        }

        // für verticale hohe Bilder
        if(widthCgCenterImageDiv>cgCenterImageParentWidth){
            widthCgCenterImageDiv = cgCenterImageParentWidth;
            newHeightImage = widthCgCenterImageDiv*heightImage/widthImage;
        }

        // margin cgCenterImage to cgCenterImageParent ausrechnen
        var cgCenterImageMargin = (cgCenterImageParentHeight-newHeightImage)/2;
        if(cgCenterImageMargin>=40){
            cgCenterImageMargin = cgCenterImageMargin-20;
        }

        // since 19.09.2020 not anymore
      //  cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).css('margin-top',cgCenterImageMargin+'px');


        // thumbnail_size_w, medium_size_w and large_size_w calculation will be done in init-gallery-getjson imageDataPreProcess with calculateSizeImageDataPreProcess function

        if(cgRotationThumbNumber=='270' || cgRotationThumbNumber=='90'){

            // !IMPORTANT Always image large to go sure when rotated!!! Otherwsise could be looking washed because low resolution.
            if(widthCgCenterImageDiv<parseInt(cgJsData[gid].vars.rawData[realId]['thumbnail_size_w'])){var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['large']);}
            else if(widthCgCenterImageDiv<parseInt(cgJsData[gid].vars.rawData[realId]['medium_size_w'])){var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['large']);}
            else if(widthCgCenterImageDiv<parseInt(cgJsData[gid].vars.rawData[realId]['large_size_w'])){var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['large']);}
            else{
                var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['full']);
            }

        }else{

            if(widthCgCenterImageDiv<parseInt(cgJsData[gid].vars.rawData[realId]['thumbnail_size_w'])){var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['thumbnail']);}
            else if(widthCgCenterImageDiv<parseInt(cgJsData[gid].vars.rawData[realId]['medium_size_w'])){var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['medium']);}
            else if(widthCgCenterImageDiv<parseInt(cgJsData[gid].vars.rawData[realId]['large_size_w'])){var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['large']);}
            else{
                var backGroundUrl = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['full']);
            }

        }


        if(cgJsData[gid].options.visual.OriginalSourceLinkInSlider == '1'){
            var originalSource = cgJsClass.gallery.function.general.tools.checkSsl(mainObject['full']);

            if(cgCenterDiv.find('.cg-center-image-download').parent().is('a')){
                cgCenterDiv.find('.cg-center-image-download').unwrap();
            }

            if(cgJsClass.gallery.vars.isInternetExplorer){
                cgCenterDiv.find('.cg-center-image-download').wrap( "<a href='"+originalSource+"' class='cg-center-image-download-link' target='_blank'></a>" );
            }else{
                cgCenterDiv.find('.cg-center-image-download').wrap( "<a download='"+cgJsData[gid].vars.rawData[realId]['NamePic']+"'  href='"+originalSource+"' class='cg-center-image-download-link' target='_blank'></a>" );
            }

            cgCenterDiv.find('.cg-center-image-download').show();
        }

        if(cgJsData[gid].options.pro.GalleryUpload == '1' && !cgJsData[gid].vars.isOnlyGalleryWinner){
            cgCenterDiv.find('.cg-gallery-upload').show();
        }

       // cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).hide();

        // !IMPORTANT Do not remove
        if(cgJsData[gid].vars.translateX){
            cgCenterDiv.find('#cgCenterImageDiv'+gidForCenterDivElements).show();
        }else{
            cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).hide();
        }

        if(typeof cgJsData[gid].vars.rawData[realId]['imgSrcOriginalWidth']!='undefined'){
            if(cgRotationThumbNumber=='270' || cgRotationThumbNumber=='90' || cgRotationThumbNumber=='180'){
                $cgCenterImage.css({
                    'background' : 'unset',
                    'max-width' : cgJsData[gid].vars.rawData[realId]['imgSrcOriginalWidth']+'px',
                    'max-height' : cgJsData[gid].vars.rawData[realId]['imgSrcOriginalHeight']+'px'
                }).find('.cg-center-image-rotated').css({
                    'background': 'url("'+backGroundUrl+'") no-repeat center center',
                    'max-width' : cgJsData[gid].vars.rawData[realId]['imgSrcOriginalWidth']+'px',
                    'max-height': cgJsData[gid].vars.rawData[realId]['imgSrcOriginalHeight']+'px'
                });
            }else{
                $cgCenterImage.css({
                    'background':'url("'+backGroundUrl+'") no-repeat center center',
                    'max-width' : cgJsData[gid].vars.rawData[realId]['imgSrcOriginalWidth']+'px',
                    'max-height' : cgJsData[gid].vars.rawData[realId]['imgSrcOriginalHeight']+'px'
                });
            }


        }else{
            if(cgRotationThumbNumber=='270' || cgRotationThumbNumber=='90' || cgRotationThumbNumber=='180'){
                $cgCenterImage.css({
                    'background' : 'transparent',
                    'max-width' : 'none',
                    'max-height' : 'none'
                }).find('.cg-center-image-rotated').css({
                    'background': 'url("'+backGroundUrl+'") no-repeat center center',
                    'max-width' : 'none',
                    'max-height' : 'none'
                });
            }else{
                $cgCenterImage.css({
                    'background':'url("'+backGroundUrl+'") no-repeat center center',
                    'max-width' : 'none',
                    'max-height' : 'none'
                });
            }
        }


        // For small images extra condition
        if(cgJsData[gid].vars.rawData[realId]['Height']<newHeightImage){

            if(cgRotationThumbNumber=='270' || cgRotationThumbNumber=='90'){
                $cgCenterImage.height(cgJsData[gid].vars.rawData[realId]['Height']).width(cgJsData[gid].vars.rawData[realId]['Width']).find('.cg-center-image-rotated').height(cgJsData[gid].vars.rawData[realId]['Width']).width(cgJsData[gid].vars.rawData[realId]['Height']);
            }else if(cgRotationThumbNumber=='180') {
                $cgCenterImage.height(cgJsData[gid].vars.rawData[realId]['Height']).width(cgJsData[gid].vars.rawData[realId]['Width']).find('.cg-center-image-rotated').height('100%').width('100%');
            }
            else {
                $cgCenterImage.height(cgJsData[gid].vars.rawData[realId]['Height']).width(cgJsData[gid].vars.rawData[realId]['Width']);
            }


            // dann ein sehr kleines Bild. Margin top muss geändert werden
            // margin cgCenterImage to cgCenterImageParent ausrechnen

            var cgCenterImageMargin = (cgCenterImageParentHeight-cgJsData[gid].vars.rawData[realId]['Height'])/2;
            if(cgCenterImageMargin>=40){
                cgCenterImageMargin = cgCenterImageMargin-20;
            }

            // since 19.09.2020 not anymore
          //  cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).css('margin-top',cgCenterImageMargin+'px');


            cgCenterDiv.css({
                'min-height':'unset',
                'height':'auto'
            });

            if(cgJsData[gid].vars.translateX){
                var widthCgCenterImageDivTransform = cgJsData[gid].vars.rawData[realId]['Width']+65;
                cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).css({
                    'webkit-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    '-moz-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    '-ms-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    '-o-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    'transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)'
                });
            }

        }else{

            if(cgRotationThumbNumber=='270' || cgRotationThumbNumber=='90'){
                $cgCenterImage.height(newHeightImage).width(widthCgCenterImageDiv).find('.cg-center-image-rotated').height(widthCgCenterImageDiv).width(newHeightImage);
            }else if(cgRotationThumbNumber=='180') {
                $cgCenterImage.height(newHeightImage).width(widthCgCenterImageDiv).find('.cg-center-image-rotated').height('100%').width('100%');
            }
            else{
                $cgCenterImage.height(newHeightImage).width(widthCgCenterImageDiv);
            }

       //     cgCenterDiv.height(newHeightForCenter);

            if(cgJsData[gid].vars.translateX){
                var widthCgCenterImageDivTransform = widthCgCenterImageDiv+65;
                cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).css({
                    'webkit-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    '-moz-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    '-ms-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    '-o-transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)',
                    'transform':'translateX('+minus+''+widthCgCenterImageDivTransform+'px)'
                });
            }
        }

        if(cgJsClass.gallery.vars.isMobile==true){

            cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).css('margin-top','15px');

           /* cgCenterDiv.find('#cgCenterImageParent'+gidForCenterDivElements).css({
                'min-height':'unset',
                'max-height':'unset',
            }).height($cgCenterImage.height());*/

        }

        if(!isResizeBlogViewOnly){


            if(sliderView){

                $("#mainCGallery"+gidForCenterDivElements).append(cgCenterDiv);

                if(FbLike>=1){

                    if(!cgJsData[gid].vars.isOnlyGalleryNoVoting){
                        if(FbLikeGallery>=1){
                        }else{
                            cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForCenterDivElements).show();
                        }
                    }

                }
                if(AllowRating>=1 && !cgJsData[gid].vars.isOnlyGalleryNoVoting){
                    cgCenterDiv.find('#cgCenterImageRatingDiv'+gidForCenterDivElements).show();
                }

            }else if(isBlogView){

                cgJsData[gid].vars.mainCGallery.append(cgCenterDiv);

            }
            else{

                cgJsClass.gallery.views.singleViewFunctions.slideOutAppend(gid,order,realId,firstKey,isGalleryOpened,offsetLeftClickedImage,imageObject,cgCenterDiv,gidForCenterDivElements);

            }

            //if(set == true){
            if(cgJsData[gid].vars.currentLook=='thumb'){

                if(cgJsData[gid].vars.thumbViewWidthFromLastImageInRow && cgJsData[gid].vars.currentLook!='slider'){
                    cgCenterDiv.css('width',cgJsData[gid].vars.thumbViewWidthFromLastImageInRow+'px');
                }

            }

            // GET JSON AND IMAGE INFO DATA HERE
            cgJsClass.gallery.views.singleViewFunctions.showExif(gid,realId,cgCenterDiv,gidForCenterDivElements);

            cgJsClass.gallery.info.checkInfoSingleImageView(realId,gid,order,isBlogView,gidForCenterDivElements);

            if(AllowComments==1){// only get comments data if there are comments
                if(cgJsData[gid].rateAndCommentNumbers[realId]){// only get comments data if there are comments
                    if(cgJsData[gid].rateAndCommentNumbers[realId].CountC){// only get comments data if there are comments
                        cgJsClass.gallery.comment.setCommentsSingleImageView(realId,gid,cgCenterDiv,imageObject,gidForCenterDivElements);
                    }
                }
            }

            // GET JSON AND IMAGE INFO DATA HERE --- END

            // IMPORTANT!!!! Display table have to be set, othervwise overflow visible for cgCenterDiv will not work
            if(sliderView==false){
                cgCenterDiv.css({
                    'display': 'table'
                });
            }else{
                /*            if(isGalleryOpened!==true && isGalleryOpenedSliderLook!==true){

                                cgCenterDiv.css({
                                    'display': 'table'
                                });
                            }*/
                cgCenterDiv.css({
                    'display': 'table'
                });

                cgJsClass.gallery.views.singleViewFunctions.showCGcenterDivAfterGalleryLoad(gid,cgCenterDiv.closest('#mainCGallery'+gid),gidForCenterDivElements);

            }

            if(cgJsData[gid].vars.translateX){
                cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements).removeClass('cg_hide');
                //   cgCenterDiv.find('#cgCenterImageDiv'+gidForCenterDivElements).show();
                cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).removeClass('cg_hide');
                setTimeout(function () {
                    cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).addClass('cg_transition');
                },100);
            }else{

                /*            cgCenterDiv.find('#cgCenterImageDiv'+gidForCenterDivElements).slideDown(700,function () {
                                if(hundertPercentWidth){
                                    cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements).slideDown(300);
                                }
                            });*/
                cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements).removeClass('cg_hide');
                cgCenterDiv.find('#cgCenterImageDiv'+gidForCenterDivElements).show();

                // setTimeout(function () {

                // cgCenterDiv.find('#cgCenterImage'+gid).hide().removeClass('cg_hide').slideDown(700);
                cgCenterDiv.find('#cgCenterImage'+gidForCenterDivElements).hide().slideDown(500);
                //  },700);

            }

        }


        if(cgJsData[gid].vars.isUserGallery && !cgJsData[gid].vars.isUserGalleryAndHasFieldsToEdit){
            cgCenterDiv.find('#cgCenterImageInfoEditIconContainer'+gidForCenterDivElements).addClass('cg_hide');
        }

        // hide if no comments allowed and no info
        if(!cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements+' .cg-center-image-info-div').length && cgJsData[gid].options.general.AllowComments!=1){
            cgCenterDiv.find('#cgCenterInfoDiv'+gidForCenterDivElements).addClass('cg_hide');
        }

        cgCenterDiv.css('min-height','unset');

        if(sliderView){
            cgCenterDiv.css('height','unset');
        }

        //  jQuery('html, body').scrollTop(800);
        // alter code
        /*        if(cgJsClass.gallery.vars.fullscreen==true){

                    setTimeout(function () {
                        //location.href = '#cg_show29';
                    //    $('#cgCenterOrientation'+gidForCenterDivElements).cgGoTo();

                        cgJsClass.gallery.views.singleView.goToLocation(gid,realId,isGalleryOpened,isGalleryOpenedSliderLook,windowHeight);
                        cgJsClass.gallery.vars.fullscreenStartOpenImage = false;
                        cgJsClass.gallery.views.singleView.createImageUrl(gid,realId,isGalleryOpened,isGalleryOpenedSliderLook);

                    },500)

                }*/

        if(!isBlogView && !isResizeBlogViewOnly){
            cgJsClass.gallery.views.singleView.createImageUrl(gid,realId);

            cgJsClass.gallery.vars.dom.html.addClass('cg_scroll_behaviour_initial');
            cgJsClass.gallery.vars.dom.body.addClass('cg_scroll_behaviour_initial');
            cgJsClass.gallery.views.singleView.goToLocation(gid,realId,isGalleryOpened,isGalleryOpenedSliderLook,windowHeight,sliderView);
            cgJsClass.gallery.vars.dom.html.removeClass('cg_scroll_behaviour_initial');
            cgJsClass.gallery.vars.dom.body.removeClass('cg_scroll_behaviour_initial');
        }

        if(cgJsClass.gallery.vars.fullwindow && !isResizeBlogViewOnly){// have to be done for all in full window, blog, slide out and slider
            cgJsClass.gallery.views.fullwindow.checkAndHideFullWindowConfigurationButton(gid,cgCenterDiv);
        }

        if(!isResizeBlogViewOnly){

            //$('html, body').animate({scrollTop:800}, 500);
            // höhe mit timeout wieder entfernen wenn info geladen wurde
            setTimeout(function () {

                // ansonsten wird height aus cgJsClass.gallery.views.setInfoSingleImageView gemacht
                if(cgJsClass.gallery.vars.thereIsImageInfo==false){

                    //jQuery('#cgCenterDiv'+gidForCenterDivElements).height(setHeightToMakeDivStable);
                    //var heightToSet = jQuery('#cgCenterImage'+gidForCenterDivElements).height()+80;
                    //  var heightToAnimate = jQuery('#cgCenterOrientation'+gidForCenterDivElements).height()+jQuery('#cgCenterDivHelper'+gidForCenterDivElements).height();
                    //jQuery('#cgCenterDiv'+gidForCenterDivElements).css('min-height','unset');
                    //   jQuery('#cgCenterDiv'+gidForCenterDivElements).animate({height: ''+heightToAnimate+'px'},'fast');
                }

                if(openComment){
                    jQuery('html, body').animate({
                        scrollTop: cgCenterDiv.find('#cgCenterImageCommentsDivEnter'+gidForCenterDivElements).offset().top - 80+'px'
                    }, 'fast');
                }

                if(cgJsData[gid].vars.mainCGdiv.is(':visible')){
                    cgJsData[gid].vars.mainCGdiv.find('.cg-lds-dual-ring-div').addClass('cg_hide');
                }

                cgCenterDiv.find('.cg_gallery_rating_div').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                cgCenterDiv.find('.cg_gallery_rating_div .cg_gallery_rating_div_star').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                cgCenterDiv.find('.cg_gallery_rating_div .cg_gallery_rating_div_count').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');

                cgCenterDiv.find('.cg_gallery_comments_div').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                cgCenterDiv.find('.cg_gallery_comments_div .cg_gallery_comments_div_icon').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                cgCenterDiv.find('.cg_gallery_comments_div .cg_gallery_comments_div_count').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
                if(!isBlogView){
                    cgJsClass.gallery.views.cloneFurtherImagesStep(gid);
                }
            },1000);
        }

        // reset this parameter!!!!
        cgJsClass.gallery.vars.backButtonClicked = false;

        // Damit die Breite sich wirklich anpasst beim erstmaligen reingehen in full window view

        if(cgJsClass.gallery.vars.fullwindow && cgJsData[gid].vars.currentLook=='thumb' && cgJsData[gid].vars.currentLook!='slider' && !isResizeBlogViewOnly){

            setTimeout(function () {

                if(cgJsData[gid].vars.thumbViewWidthFromLastImageInRow){

                    positionLeftOrientation = cgJsClass.gallery.views.singleView.positionLeftOrientationThumbLook(gid,imageObject,addDistancePics,sliderView);

                    cgCenterDiv.css('width',cgJsData[gid].vars.thumbViewWidthFromLastImageInRow+'px');
                    cgCenterDiv.find('#cgCenterOrientation'+gidForCenterDivElements).css('margin-left',positionLeftOrientation+'px');

                }

            },100);

        }

        // 05.10.2020 correction because of some margin to bottom of info content in gallery image not required in the moment
        if((cgRotationThumbNumber=='270' || cgRotationThumbNumber=='90') && cgJsData[gid].vars.currentLook=='thumb' && !sliderView){

            // required, otherwise some kind of CSS browser jumping cg_gallery_info bug
            if(imageObject && !sliderView && cgJsData[gid].vars.currentLook=='thumb'){
                imageObject.find('figure').hide();
                setTimeout(function (){
                    imageObject.find('figure').show();
                },10);
            }
        }

        cgJsData[gid].vars.cgCenterDivLastHeight = cgCenterDiv.outerHeight()+parseInt(cgCenterDiv.css('padding-top'))+parseInt(cgCenterDiv.css('padding-bottom'));

        cgCenterDiv.css('min-height',''+String(cgJsData[gid].vars.cgCenterDivLastHeight)+'px');

        if(sliderView){
            cgCenterDiv.css('height',''+String(cgJsData[gid].vars.cgCenterDivLastHeight)+'px');
        }

        if(sliderView && cgJsClass.gallery.vars.fullwindow){
            var restHeight = windowHeight - (cgJsData[gid].vars.mainCGdiv.find('#mainCGslider'+gid).height()+65+cgJsData[gid].vars.cgCenterDivLastHeight);
            if(restHeight>0){
                cgJsData[gid].vars.cgCenterDivLastHeight = cgJsData[gid].vars.cgCenterDivLastHeight + restHeight;
                cgCenterDiv.css('height',''+String(cgJsData[gid].vars.cgCenterDivLastHeight)+'px');
            }
        }

        if(!isResizeBlogViewOnly){
            cgJsClass.gallery.views.singleView.checkIfImageExists(cgCenterDiv, gid,realId);
        }

        // to go sure that it never appear in not full window!
        if(!cgJsClass.gallery.vars.fullwindow){
            //cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');
        }

        if(cgJsClass.gallery.vars.isMobile){
            cgCenterDiv.find('#cgCenterImageFullScreenButton'+gidForCenterDivElements).addClass('cg_hide');
        }else{
            if(cgJsClass.gallery.vars.fullscreen){
                cgCenterDiv.find('#cgCenterImageFullScreenButton'+gidForCenterDivElements).addClass('cg_hide');
            }else{
                if(cgJsData[gid].options.visual['ImageViewFullScreen']!=1){
                    cgCenterDiv.find('#cgCenterImageFullScreenButton'+gidForCenterDivElements).addClass('cg_hide');
                }else if(cgJsClass.gallery.vars.fullwindow && cgJsData[gid].options.visual['ImageViewFullScreen']==1){
                    cgCenterDiv.find('#cgCenterImageFullScreenButton'+gidForCenterDivElements).removeClass('cg_hide');
                }else{
                    if(cgJsClass.gallery.vars.isMobile){
                        cgCenterDiv.find('#cgCenterImageFullScreenButton'+gidForCenterDivElements).addClass('cg_hide');
                    }
                }
            }
        }

        if(cgJsData[gid].vars.mainCGallery.hasClass('cg_called_from_upload')){
            // do not remove cg_hide
            cgJsData[gid].vars.mainCGallery.removeClass('cg_hide cg_called_from_upload').addClass('cg_fade_in');
        }

        if(isBlogView && cgJsClass.gallery.vars.fullwindow){
            cgCenterDiv.css('height','unset');
            cgCenterDiv.css('min-height','unset');
        }else if(isResizeBlogViewOnly || sliderView){
            cgCenterDiv.css('height','unset');
            cgCenterDiv.css('min-height','unset');
        }

    },
    checkIfImageExists: function($cgCenterDiv, gid,realId){

        setTimeout(function () {
            if($cgCenterDiv.is(':visible') && realId==cgJsData[gid].vars.openedRealId){
                cgJsClass.gallery.function.general.tools.checkError($cgCenterDiv,gid,realId);
            }
        },3000);

    },
    positionLeftOrientationThumbLook: function(gid,imageObject,addDistancePics,sliderView){

        var distancePics = parseInt(cgJsData[gid].options.general.DistancePics);

        if(imageObject.position().left<=30){
            distancePics = 0;
        }

        if(sliderView===true){
            distancePics = 0;
        }

        var positionLeftOrientation;

        if(addDistancePics){
            // *2 borderwidth wegen der art des borders weil auf cg_append
            positionLeftOrientation = imageObject.position().left+parseInt(cgJsData[gid].options.visual.ThumbViewBorderWidth)+distancePics;
        }else{
            positionLeftOrientation = imageObject.position().left+parseInt(cgJsData[gid].options.visual.ThumbViewBorderWidth);
        }

        return positionLeftOrientation;

    },
    openAgain: function (gid,order) {

        var firstKey = Object.keys(cgJsData[gid].image[order])[0];
        var realId = cgJsData[gid].image[order][firstKey]['id'];
        jQuery('#cg_show'+realId).find('.cg_append').click();

        cgJsClass.gallery.vars.fullscreenStartOpenImage = true;


    },
    goToLocation: function (gid,realId,isGalleryOpened,isGalleryOpenedSliderLook,windowHeight,sliderView){

        cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.removeClass('cg_margin_top_0').addClass('cg_hide');

        var distanceTop = 40;
        if(sliderView===true){
            distanceTop = 120;
            if(windowHeight<800){
                distanceTop = 0;
            }
        }

        var noSlideOut = false;

        if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1){
            noSlideOut = true;
        }

        if(cgJsClass.gallery.vars.isMobile==true){
         //   window.location.href = '#cgCenterOrientation'+gid;

            if(isGalleryOpened===true){

                if(cgJsData[gid].vars.currentLook!='slider' || (cgJsData[gid].vars.currentLook=='slider' && isGalleryOpened)){

                    if(sliderView && isGalleryOpenedSliderLook){
                        setTimeout(function () {
                            if(cgJsData[gid].options.pro.SliderFullWindow!=1){
                                if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                                }
                            }
                        },600);
                        return;
                    }

                    if(cgJsClass.gallery.vars.fullwindow==false){
                      //  jQuery('#mainCGdiv'+gid).find('.cg-lds-dual-ring-div').removeClass('cg_hide').addClass('cg_fade_in_loader');
                    }

                    if(noSlideOut==false){
                      //  jQuery('html').addClass('cg_no_scroll');
                    }

                    setTimeout(function () {

                        cgJsClass.gallery.vars.dom.html.animate({
                            scrollTop: cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId).offset().top - distanceTop+'px'
                        }, 'fast', function () {
                        });


                        setTimeout(function () {
                            if(cgJsData[gid].options.pro.SliderFullWindow!=1){
                                if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                                }
                            }
                        },600);

                    },1500);
                }


            }else{

/*                if(cgJsData[gid].options.general.SliderLook!=1){
                    document.getElementById('cgCenterOrientation'+gid).scrollIntoView();
                }
                if(cgJsData[gid].options.general.SliderLook==1 && isGalleryOpened){
                    document.getElementById('cgCenterOrientation'+gid).scrollIntoView();
                }*/

                if(cgJsClass.gallery.vars.isMobile==true){

                    if(screen.height >= screen.width){//vertical view
                        cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId+'[data-cg-gid="'+gid+'"]').get(0).scrollIntoView();
                    }else{//horizontal view
                        jQuery('#cgCenterImageDiv'+gid).get(0).scrollIntoView();
                    }

                }else{

                    if(sliderView===true && isGalleryOpenedSliderLook!==true){
                        cgJsClass.gallery.vars.dom.html.animate({
                            scrollTop: cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId).offset().top - distanceTop+'px'
                        }, 'fast', function () {
                        });
                    }else{
                        if(isGalleryOpenedSliderLook!==true){
                            // have to check out gid also if user and normal gallery are on same site
                            cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId+'[data-cg-gid="'+gid+'"]').get(0).scrollIntoView();
                        }
                    }

                }

                if(cgJsData[gid].options.pro.SliderFullWindow!=1){
                    if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                        cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                    }
                }

            }

            setTimeout(function () {
                if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                }
                cgJsClass.gallery.vars.dom.body.removeClass('cg_body_overflow_hidden');
            },300);

            //   window.location.replace(location.href+'#cgCenterOrientation'+gid);
        }else{
/*            setTimeout(function(){
                location.href = '#cgShowPositionHelper'+realId;
            },0)*/
         //   location.href = '#cgShowPositionHelper'+realId;

            if(isGalleryOpened===true || (sliderView && isGalleryOpened)){

                if(isGalleryOpened===true){


                    if(sliderView && isGalleryOpenedSliderLook){
                        setTimeout(function () {
                            if(cgJsData[gid].options.pro.SliderFullWindow!=1){
                                if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                                }
                            }
                        },600);
                        return;
                    }

                    if(cgJsClass.gallery.vars.fullwindow==false){
                  //      jQuery('#mainCGdiv'+gid).find('.cg-lds-dual-ring-div').removeClass('cg_hide').addClass('cg_fade_in_loader');
                    }

                    if(noSlideOut==false){
                    //    jQuery('html').addClass('cg_no_scroll');
                    }
                    setTimeout(function () {
                        cgJsClass.gallery.vars.dom.html.animate({
                            scrollTop: cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId).offset().top - distanceTop+'px'
                        }, 'fast', function () {
                            // jQuery('#mainCGdiv'+gid).find('.cg-lds-dual-ring-div').addClass('cg_hide').removeClass('cg_fade_in_loader');
                        });

                        setTimeout(function () {
                            if(cgJsData[gid].options.pro.SliderFullWindow!=1){
                                if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                                }
                            }
                        },600);

                    },1500);

                }

            }else{

/*                if(cgJsData[gid].options.general.SliderLook!=1){
                    document.getElementById('cgShowPositionHelper'+realId).scrollIntoView();
                }
                if(cgJsData[gid].options.general.SliderLook==1 && isGalleryOpened){
                    document.getElementById('cgShowPositionHelper'+realId).scrollIntoView();
                }*/

                  //  document.getElementById('cgShowPositionHelper'+realId).scrollIntoView();

                //eventuelle Korrektur so möglich
/*                jQuery('#cg_append'+realId).css('top',jQuery('#cg_append'+realId).position().top*-1);
                jQuery('#cgGalleryInfo'+realId).css('bottom',jQuery('#cg_append'+realId).position().top);*/

                if(cgJsClass.gallery.vars.isMobile==true){

                    if(screen.height >= screen.width){//vertical view
                        cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId+'[data-cg-gid="'+gid+'"]').get(0).scrollIntoView();
                    }else{//horizontal view
                        jQuery('#cgCenterImageDiv'+gid).get(0).scrollIntoView();
                    }

                }else{

                    // FullSizeImageOutGallery OnlyGalleryView might cause if switch from thumb look to slider look
                    if(sliderView===true && isGalleryOpenedSliderLook!==true && cgJsData[gid].options.general.FullSizeImageOutGallery!=1 && cgJsData[gid].options.general.OnlyGalleryView!=1){
                        //if(jQuery(document).height()-(cgJsData[gid].vars.cgCenterDiv.offset().top+cgJsData[gid].vars.cgCenterDiv.height())>300){// otherwise would always jump a bit if at bottom of the page!
                        if(jQuery(window).scrollTop()+100<cgJsData[gid].vars.mainCGdiv.find('#mainCGslider'+gid).offset().top){// new since 19.06.2020
                            cgJsClass.gallery.vars.dom.html.animate({
                                scrollTop: cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId).offset().top - distanceTop+'px'
                            }, 'fast', function () {
                            });
                        }
                    }else{
                        if(isGalleryOpenedSliderLook!==true){
                            if(sliderView===true && (cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1)){
                                // no return here because of bottom processing!
                            }else{
                                // have to check out gid also if user and normal gallery are on same site
                                if(cgJsClass.gallery.vars.isFromFullWindowAndDataCgRealIdHasToBeOpened){
                                    setTimeout(function (){// the do it with timeout, because normal gallery has to load
                                        cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId+'[data-cg-gid="'+gid+'"]').get(0).scrollIntoView();
                                        cgJsClass.gallery.vars.isFromFullWindowAndDataCgRealIdHasToBeOpened = false;
                                    },1000);
                                }else{
                                    cgJsData[gid].vars.mainCGallery.find('#cgShowPositionHelper'+realId+'[data-cg-gid="'+gid+'"]').get(0).scrollIntoView();
                                }
                            }
                        }
                    }

                    if(cgJsData[gid].options.pro.SliderFullWindow!=1){
                        if(!cgJsClass.gallery.vars.dom.body.hasClass('cg_gallery_rating_div_five_star_details_is_opened')){
                            cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                        }
                    }

                }



            }

            //   window.location.replace(location.href+'#cgShowPositionHelper'+realId);
        }



    },
    createImageUrl: function (gid,realId) {

        if(cgJsData[gid].vars.currentLook=='slider'){
            //return;
        }

        var imageTitle = cgJsData[gid].vars.rawData[realId]['post_title'];
        var imageHref = '!gallery/'+gid+'/image/'+realId+'/'+imageTitle;
        var newUrlForHistory = location.protocol + '//' + location.host + location.pathname+location.search+'#'+imageHref;
        //window.location.replace(newUrlForHistory);
        window.location.href = newUrlForHistory;

    }
};