cgJsClass.gallery.blogLogic = {
    init: function (jQuery,gid,openPage,calledFromUpload,openImage,stepChange,viewChange,randomButtonClicked,isCopyUploadToAnotherGallery,isJustSetWidth,fullWindowRealIdToShow,isFromCheckStepsCutImageData) {

        // gallery index
        var gid = gid;

        //!IMPORTANT current view look for resize
        cgJsData[gid].vars.currentLook='blog';

        if(cgJsData[gid].image.length<1){
            return;
        }

        var $ = jQuery;

        if(cgJsClass.gallery.vars.fullwindow==gid){
            // -40 wegen padding 20 rechts links und 15 wege scroll bar die beim parent hinzugefügt wird
            //var widthMainCGallery = $(window).width()-55;
            var widthMainCGallery = $(window).width()-cgJsClass.gallery.function.general.tools.getScrollbarWidthDependsOnBrowser();
        }else{
            var widthMainCGallery = $('#mainCGdivContainer'+gid).width();
        }

        if(widthMainCGallery<247){
            widthMainCGallery = 247;
        }

        var widthmain = widthMainCGallery;

        if(widthmain>1300){
            widthmain = 1300;
        }

        cgJsClass.gallery.views.functions.destroyRangeSlider(gid);

        // Wenn pagination an ist, dann muss der erste Width Wert hier eingetragen werden

        var $mainCGallery = cgJsData[gid].vars.mainCGallery;
        var $mainCGslider = cgJsData[gid].vars.mainCGallery.find('#mainCGslider'+gid);
        var $mainCGdiv = cgJsData[gid].vars.mainCGdiv;

        // hide to go sure, might be not always be hidden
        // do it only in fullwindow
        if(cgJsData[gid].vars.cgCenterDiv){
            if(cgJsClass.gallery.vars.fullwindow){
                cgJsData[gid].vars.cgCenterDiv.addClass('cg_hide');
            }
        }

        // reset gallery content here completely
        //$mainCGallery.find('.cg_show').remove();
        //$mainCGslider.empty();

        /*for(var realId in cgJsData[gid].imageObject){
            if(!cgJsData[gid].imageObject.hasOwnProperty(realId)){
                break;
            }
            delete cgJsData[gid].imageObject[realId];
        }*/
        cgJsData[gid].vars.$cgVerticalSpaceCreatorThumbView = null;

        cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.addClass('cg_hide');

        $mainCGdiv.css('width',widthmain+'px');
        $mainCGallery.css('width',100+'%');
        $mainCGallery.css('visibility','hidden');
        $mainCGallery.removeClass('cg_fade_in_new');

        cgJsData[gid].vars.cgCenterDiv.css('width',widthmain+'px');
        cgJsData[gid].vars.widthmain = widthmain;

        $mainCGallery.removeClass('cg_thumb_look');

        $mainCGallery.find('.cg_show').addClass('cg_hide');// for gallery
        $mainCGslider.find('.cg_show').addClass('cg_hide');// for slider

        cgJsClass.gallery.views.functions.checkAndAppendFromSliderToGallery($mainCGallery,$mainCGslider);

        if(openPage==true || viewChange==true){
            $mainCGallery.removeClass('cg_fade_in_new').addClass('cg_hidden');
        }

        // manchmal wird width nicht gesetzt, deswegen sicherheithalber nochmal setzen
        if(openPage === true){
            if($mainCGdiv.css('width')!=true){
                $mainCGallery.css('visibility','hidden');
                setTimeout(function () {
                    $mainCGdiv.css('width',cgJsData[gid].vars.widthmain+'px');
                    setTimeout(function () {
                        //          $mainCGallery.css('visibility','visible').addClass('cg_fade_in_new');
                    },100);
                },100);
            }
        }else{

            $mainCGallery.addClass('cg_hidden');
            $mainCGallery.removeClass('cg_fade_in');
            $mainCGallery.css('visibility','visible');
        }

        $mainCGdiv.find('#cgVerticalSpaceCreator'+gid).remove();

        // cgJsClass.gallery.resize.galleryIcons($mainCGallery,openPage,false,gid,widthmain);

        var indexToStart = 0;

        // find out to where to start blog view then
        if(fullWindowRealIdToShow){
            $.each(cgJsData[gid].image, function( index,value ) {
                var firstKey = Object.keys(value)[0];
                var realId = cgJsData[gid].image[index][firstKey]['id'];
                if(realId==fullWindowRealIdToShow){
                    indexToStart = index;
                    return false;
                }
            });
        }

        // set URL of first image in image data then
        if(isFromCheckStepsCutImageData && cgJsClass.gallery.vars.fullwindow){
            $.each(cgJsData[gid].image, function( index,value ) {
                var firstKey = Object.keys(value)[0];
                var realId = cgJsData[gid].image[index][firstKey]['id'];
                cgJsClass.gallery.views.singleView.createImageUrl(gid,realId);
                return false;
            });
        }

      //  console.log('indexClicked');
     //   console.log(indexToStart);

        if(indexToStart>5){
            indexToStart = indexToStart-5;
          //  console.log('indexToStart');
         //   console.log(indexToStart);
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.removeClass('cg_hide');
        }

        var indexTotal;
        var blogViewImagesLoadedCount = 0;

        var isLoopStarted = false;

        if(!isJustSetWidth){
            $.each(cgJsData[gid].image, function( index,value ) {
                if(index < indexToStart && !(indexToStart <= 5)){return;}
                if(!isLoopStarted){
                    cgJsData[gid].vars.blogViewImagesLoadedFirstOrder = index;
                    isLoopStarted = true;
                }
                //console.log('blogViewImagesLoadedCount')
                //console.log(blogViewImagesLoadedCount)

                cgJsClass.gallery.views.singleView.openImage($,index,false,gid,'right',true,false,true,false,false,blogViewImagesLoadedCount,false);
              //  if(index>indexToStart+10){return;}// then no further processing required
                blogViewImagesLoadedCount = blogViewImagesLoadedCount + 1;
                indexTotal = index;
            });
        }

        if(cgJsData[gid].vars.blogViewImagesLoadedFirstOrder===0){
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.addClass('cg_hide');
        }else{
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.removeClass('cg_hide');
        }

        // has to be done after gallery load!
        cgJsData[gid].vars.mainCGallery.find('.cg_position_hr_1, .cg_position_hr_2, .cg_position_hr_3').remove();
        cgJsData[gid].vars.mainCGallery.find('.cg-slider-range-container').remove();

        $mainCGdiv.find('#cgLdsDualRingMainCGdivHide'+gid).addClass('cg_hide');
        if(!cgJsData[gid].vars.closeEventInitWithDataCGrealIdCloseButton){
            $mainCGallery.removeClass('cg_hide cg_hidden').addClass('cg_fade_in');
        }
        cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');

        cgJsClass.gallery.vars.switchViewsClicked=false;

        if(cgJsData[gid].vars.blogViewImagesLoadedLastOrder+1==Object.keys(cgJsData[gid].image).length){
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');
        }

        if(! cgJsData[gid].vars.blogViewImagesLoopOneTimeLoaded && indexTotal+1 == Object.keys(cgJsData[gid].image).length){// then must be loaded less then 10
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');
        }

        if(Object.keys(cgJsData[gid].image).length <= 10){
          //  if(cgJsData[gid].vars.$cg_further_images_container_bottom){
         //       cgJsData[gid].vars.$cg_further_images_container_bottom.removeClass('cg_hide');
           // }
        //    cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');
        }

        if(Object.keys(cgJsData[gid].image).length == 11){// exception for 11, because then all images can be loaded, otherwise 11 is not shown, research why
       //     if(cgJsData[gid].vars.$cg_further_images_container_bottom){
       //         cgJsData[gid].vars.$cg_further_images_container_bottom.removeClass('cg_hide');
         //   }
     //       cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');
        }

        if(Object.keys(cgJsData[gid].image).length <= 21 && isFromCheckStepsCutImageData){// exception for 11, because then all images can be loaded, otherwise 11 is not shown, research why
            cgJsClass.gallery.views.clickFurtherImagesStep.cloneStep(gid,cgJsData[gid].vars.$cg_further_images_container_top,true);
        }

    },
    prepareResizeFullWindow: function (gid){

        // width main can be taken because will be calculated for every logic start
        // and taken for cgCenterDiv
        var widthBeforeForBlogView = cgJsData[gid].vars.widthmain;
        var widthNowForBlogView = jQuery(window).width()-cgJsClass.gallery.function.general.tools.getScrollbarWidthDependsOnBrowser();
        if(widthNowForBlogView>1300){
            widthNowForBlogView = 1300;
        }
        // because of 20 padding left and right
        // widthNowForBlogView = widthNowForBlogView+40;
        var factor = widthNowForBlogView/widthBeforeForBlogView;

        cgJsData[gid].vars.widthmain = widthNowForBlogView;
        cgJsData[gid].vars.mainCGdiv.width(widthNowForBlogView).removeClass('cg_display_inline_block').addClass('cg_display_block');

        if(!cgJsClass.gallery.vars.isMobile){
            cgJsData[gid].vars.mainCGdiv.addClass('cg_margin_0_auto');
        }

        return {'factor':factor,'widthNowForBlogView':widthNowForBlogView};

    },
    changeWidth: function (widthNowForBlogView,factor,$mainCGdivHelperParent,gid){

        // because of 20 padding left and right will be added
        widthNowForBlogView = widthNowForBlogView-40;

        $mainCGdivHelperParent.find('.cgCenterDivForBlogView').each(function (index){

            var $cgCenterDiv = jQuery(this);

            if(widthNowForBlogView){
                $cgCenterDiv.width(widthNowForBlogView);
            }
            //console.log(index);
            cgJsClass.gallery.views.singleView.openImage(jQuery,index,false,gid,'right',false,false,true,true);

        });

        cgJsClass.gallery.vars.isInitFullWindowOpen = false;

    },
    reset: function (gid){

        cgJsData[gid].vars.mainCGdiv.find('.cgCenterDivForBlogView').remove();
        cgJsData[gid].vars.blogViewImagesLoadedFirstOrder = null;
        cgJsData[gid].vars.blogViewImagesLoaded = false;
        cgJsData[gid].vars.blogViewImagesLoadedGid = 0;
        cgJsData[gid].vars.blogViewImagesLoadedLastOrder = 0;
        cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');
        cgJsData[gid].vars.blogViewImagesLoopOneTimeLoaded = false;
        cgJsData[gid].vars.blogViewImagesLoadedFirstRealId = false;


    }
};
