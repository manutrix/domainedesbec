cgJsClass.gallery.views.initSingleViewScroll = function (){

    jQuery(document).on('click','.cg-center-go-up-button',function () {

        var gid = jQuery(this).attr('data-cg-gid');
        cgJsClass.gallery.views.scrollUp(gid);

    });

    //*= benutzen, falls die zweite classe nicht mit -parent endet

    jQuery(document).on('click','.cg-scroll-info-single-image-view .cg-top-bottom-arrow:first-child',function () {

        var $object = jQuery(this);
        cgJsClass.gallery.views.scrollInfoOrCommentTop($object);

    });


    jQuery(document).on('click','.cg-scroll-info-single-image-view .cg-top-bottom-arrow:last-child',function () {

        var $object = jQuery(this);
        cgJsClass.gallery.views.scrollInfoOrCommentBottom($object);

    });

    // mousehold actions
    var interval;

    jQuery(document).on('mousedown touchstart','.cg-scroll-info-single-image-view .cg-top-bottom-arrow:first-child',function () {

        var $object = jQuery(this);

        interval = setInterval(function() {
            cgJsClass.gallery.views.scrollInfoOrCommentTop($object);
        },100);

    });
    jQuery(document).on('mousedown touchstart','.cg-scroll-info-single-image-view .cg-top-bottom-arrow:last-child',function () {

        var $object = jQuery(this);

        interval = setInterval(function() {
            cgJsClass.gallery.views.scrollInfoOrCommentBottom($object);
        },100);

    });

    jQuery(document).on('mouseup touchend',function () {

        clearInterval(interval);

    });


    jQuery( window ).scroll(function() {

        if(cgJsClass.gallery.vars.fullwindow){
           // return;
        }

        cgJsClass.gallery.views.scrollBlogView(this);

    });

    jQuery( '.mainCGdivHelperParent ' ).scroll(function() {

        if(!cgJsClass.gallery.vars.fullwindow){
            return;
        }

        if(cgJsClass.gallery.vars.isInitFullWindowOpen){
            return;
        }
        //console.log('scroll mainCGdivHelperParent');
        cgJsClass.gallery.views.scrollBlogView(this);

    });

};
cgJsClass.gallery.views.scrollUp = function (gid){
    if(cgJsClass.gallery.vars.fullwindow){
        cgJsData[gid].vars.mainCGdivHelperParent.animate({
            scrollTop: 0+'px'
        }, 'fast', function () {
        });

    }else{
        cgJsClass.gallery.vars.dom.html.animate({
            scrollTop: cgJsData[gid].vars.mainCGdivHelperParent.find('.cg_header').offset().top - 40+'px'
        }, 'fast', function () {
        });
    }
};
cgJsClass.gallery.views.scrollBlogView = function (object,isWindowScroll){

    var windowScrollTop = jQuery(object).scrollTop();

    cgJsClass.gallery.vars.loadedGalleryIDs.forEach(function (gid){
/*
        if(cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted){
            return;
        }*/

        if(windowScrollTop>cgJsClass.gallery.vars.lastScrollTopCurrentScrollObject){// then scroll to bottom
            cgJsClass.gallery.views.scrollBlogViewBottom(gid,object,windowScrollTop);

            if(cgJsClass.gallery.vars.fullwindow == gid){
                cgJsClass.gallery.views.setUrl(gid,windowScrollTop,'bottom');
            }

        }

        if(windowScrollTop<cgJsClass.gallery.vars.lastScrollTopCurrentScrollObject){// then scroll to top
            cgJsClass.gallery.views.scrollBlogViewTop(gid,object,windowScrollTop);

            if(cgJsClass.gallery.vars.fullwindow == gid){
                cgJsClass.gallery.views.setUrl(gid,windowScrollTop,'top');
            }

        }

    });

    cgJsClass.gallery.vars.lastScrollTopCurrentScrollObject = windowScrollTop;

};

cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow = undefined;
cgJsClass.gallery.views.currentScrollImageDataImageIdBlogViewFullWindow = 0;

cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindowCalculation = function (gid,realIdToCompare){

    var partOfWindowHeightForCalculation = jQuery(window).height()/8;

    jQuery.each(cgJsData[gid].image, function( index ) {

        var firstKey = Object.keys(cgJsData[gid].image[index])[0];
        var realId = cgJsData[gid].image[index][firstKey]['id'];

        if(cgJsData[gid].cgCenterDivBlogObject[realId]){
            if(realId==realIdToCompare){
               // cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow = index;
                //cgJsClass.gallery.views.currentScrollImageDataImageIdBlogViewFullWindow = realId;
                //cgJsClass.gallery.views.currentScrollImageDataImageIdBlogViewFullWindowForLoop = 0;// reset here
                //console.log('currentScrollImageDataOrderBlogViewFullWindow start');
                //console.log(index);
                return false;
            }
        }

    });

}

cgJsClass.gallery.views.setUrl = function (gid,windowScrollTop,scrollDirection){

    if(cgJsClass.gallery.vars.fullwindow){

        var fullWindowHeight = jQuery(window).height();
        var partOfWindowHeightForCalculationForScrollTop = fullWindowHeight/2;
        var partOfWindowHeightForCalculationForScrollBottom = fullWindowHeight/3;

        jQuery.each(cgJsData[gid].image, function( index ) {

            var firstKey = Object.keys(cgJsData[gid].image[index])[0];
            var realId = cgJsData[gid].image[index][firstKey]['id'];

            if(cgJsData[gid].cgCenterDivBlogObject[realId]){
                var positionTop = cgJsData[gid].cgCenterDivBlogObject[realId].position().top;

                if(scrollDirection=='top'){
                    if(windowScrollTop <= positionTop+partOfWindowHeightForCalculationForScrollTop){

                        var isHigherRealIdIndex = false;

                        if(cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow!==undefined){
                            if(index>=cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow){
                                isHigherRealIdIndex = true;
                            }
                        }

                        if(isHigherRealIdIndex){
                            return;
                        }else{
                            cgJsClass.gallery.views.currentScrollImageDataImageIdBlogViewFullWindow = realId;
                            cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow = index;
                            cgJsClass.gallery.views.singleView.createImageUrl(gid,realId);
                        }
                    }
                }

                if(scrollDirection=='bottom'){
                    if(windowScrollTop > positionTop-partOfWindowHeightForCalculationForScrollBottom){

                        var isLowerRealIdIndex = false;

                        if(cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow!==undefined){
                            if(index<=cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow){
                                isLowerRealIdIndex = true;
                            }
                        }

                        if(isLowerRealIdIndex){
                            return;
                        }else{
                            cgJsClass.gallery.views.currentScrollImageDataImageIdBlogViewFullWindow = realId;
                            cgJsClass.gallery.views.currentScrollImageDataOrderBlogViewFullWindow = index;
                            cgJsClass.gallery.views.singleView.createImageUrl(gid,realId);
                        }
                    }
                }
            }

        });

    }

}

cgJsClass.gallery.views.scrollBlogViewBottom = function (gid,object,windowScrollTop){

    if(cgJsData[gid].vars.blogViewImagesLoaded){

        if(cgJsClass.gallery.vars.fullwindow){
            var distanceToTop = cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.position().top;
            //console.log(distanceToTop);
            var factorToCheck = 1000;
        }else{
            var distanceToTop = cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.offset().top;
            // console.log(distanceToTop);
            var factorToCheck = 800;
        }

        if(windowScrollTop+factorToCheck>distanceToTop && !cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted && !cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.hasClass('cg_hide')){
            cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted = true;
            cgJsData[gid].vars.blogViewImagesLoaded = false;
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');

            var order = 0;
            var isFirstScrollOrder = true;
            var blogViewImagesLoadedCount = 0;

            jQuery.each(cgJsData[gid].image, function( index,value ) {

                if(index<=cgJsData[gid].vars.blogViewImagesLoadedLastOrder){return;}
                order = index;
                //    console.log('scroll');
                //    console.log(index);
                if(isFirstScrollOrder){
                    var returnedValue = cgJsClass.gallery.views.singleView.openImage(jQuery,index,false,gid,'right',true,false,true,false,true,blogViewImagesLoadedCount);
                    isFirstScrollOrder = false;
                }else{
                    var returnedValue = cgJsClass.gallery.views.singleView.openImage(jQuery,index,false,gid,'right',true,false,true,false,false,blogViewImagesLoadedCount);
                }

                blogViewImagesLoadedCount = blogViewImagesLoadedCount + 1;

                if(returnedValue=='break'){
                    return false;
                }

            });

            if(cgJsData[gid].vars.blogViewImagesLoadedLastOrder + 1 == Object.keys(cgJsData[gid].image).length){
                if(cgJsData[gid].vars.$cg_further_images_container_bottom){
                    cgJsData[gid].vars.$cg_further_images_container_bottom.removeClass('cg_hide');
                }
                cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.addClass('cg_hide');
            }else{
                if(cgJsData[gid].vars.$cg_further_images_container_bottom){
                    cgJsData[gid].vars.$cg_further_images_container_bottom.addClass('cg_hide');
                }
                cgJsData[gid].vars.cgLdsDualRingCGcenterDivLazyLoader.removeClass('cg_hide');
            }
            cgJsData[gid].vars.blogViewImagesLoaded = true;
            cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted = false;

        }

    }

}

cgJsClass.gallery.views.scrollBlogViewTop = function (gid,object,windowScrollTop){

    if(cgJsData[gid].vars.blogViewImagesLoaded || cgJsData[gid].vars.blogViewImagesLoadedAllImages){

        if(windowScrollTop!=0){return;}// then no further checks required, because scrollBlogViewTop is always in fullWindow mainCGdivHelperParent in the moment

        if(cgJsClass.gallery.vars.fullwindow){
            var distanceToTop = cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.position().top;
            //console.log(distanceToTop);
            var factorToCheck = 1000;
        }else{
            var distanceToTop = cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.offset().top;
            // console.log(distanceToTop);
            var factorToCheck = 800;
        }

        // cgJsData[gid].vars.blogViewImagesLoadedFirstOrder!=0, then must be already at the top and click further images step must be clicked for example
        if(windowScrollTop==0 && !cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted && !cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.hasClass('cg_hide') && cgJsData[gid].vars.blogViewImagesLoadedFirstOrder!=0){

            cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted = true;
            cgJsData[gid].vars.blogViewImagesLoaded = false;
            cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.addClass('cg_hide');
            cgJsData[gid].vars.blogViewImagesLoadedLastRealIdForTopScroll = null; // reset here!

            var $current_top_element = cgJsData[gid].vars.mainCGallery.find('.cgCenterDivForBlogView').first();// for later offset

            var order;
            var isFirstScrollOrder = true;
            var blogViewImagesLoadedCount = 0;

            var isLoopBreak = false;

            // go from top to bottom!!!!!!
            for (var i=cgJsData[gid].image.length-1; i>=0; i--) {
                order = i;
                if(i>=cgJsData[gid].vars.blogViewImagesLoadedFirstOrder){continue;}// take care, have to be smaller then first order last-first order thats why equal compare

                // console.log(order);

                if(isFirstScrollOrder){
                    var returnedValue = cgJsClass.gallery.views.singleView.openImage(jQuery,i,false,gid,'right',true,false,true,false,true,blogViewImagesLoadedCount,true);
                    isFirstScrollOrder = false;
                }else{
                    var returnedValue = cgJsClass.gallery.views.singleView.openImage(jQuery,i,false,gid,'right',true,false,true,false,false,blogViewImagesLoadedCount,true);
                }

                blogViewImagesLoadedCount = blogViewImagesLoadedCount + 1;

                if(returnedValue=='break'){

                    cgJsData[gid].vars.blogViewImagesLoadedFirstOrder = i-1;// because i was not processed!
                    isLoopBreak = true
                    break;
                }

            }

            if(!isLoopBreak){// then must be first image, and order must be 0
                cgJsData[gid].vars.blogViewImagesLoadedFirstOrder = i;
            }

        //    setTimeout(function (){
                var previous_height = 0;
                $current_top_element.prevAll().each(function() {
                    if(jQuery(this).hasClass('cg_hide')){return;}
                    previous_height += jQuery(this).outerHeight();
                });

                jQuery(object).scrollTop(previous_height-650);// +650 because of loader height!
        //    },100);


            if(order==0){
                if(cgJsData[gid].vars.$cg_further_images_container_top){
                    cgJsData[gid].vars.$cg_further_images_container_top.removeClass('cg_hide');
                }
                cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.addClass('cg_hide');
            }else{
                if(cgJsData[gid].vars.$cg_further_images_container_top){
                    cgJsData[gid].vars.$cg_further_images_container_top.addClass('cg_hide');
                }
                cgJsData[gid].vars.cgLdsDualRingCGcenterDivHide.removeClass('cg_hide');
            }

            cgJsData[gid].vars.blogViewImagesLoaded = true;
            cgJsData[gid].vars.blogViewImagesLoadFromScrollStarted = false;


        }

    }

}

cgJsClass.gallery.views.scrollInfoOrCommentTopFullHeight = function (gid,gidForElements){

    if(!gidForElements){
        gidForElements = gid;
    }

    var $element = cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDiv'+gidForElements);
    var $elementParent = cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivParentParent'+gidForElements);

    if($element.length){
        $element.scrollTop(0);
        if($elementParent.find('.cg-top-bottom-arrow:first-child').length){
            if($elementParent.find('.cg-top-bottom-arrow:first-child').is(':visible')){
                $elementParent.find('.cg-top-bottom-arrow:first-child').addClass('cg_no_scroll');
            }
        }
        if($elementParent.find('.cg-top-bottom-arrow:last-child').length){
            if($elementParent.find('.cg-top-bottom-arrow:last-child').is(':visible')){
                $elementParent.find('.cg-top-bottom-arrow:last-child').removeClass('cg_no_scroll');
            }
        }
    }

};
cgJsClass.gallery.views.scrollInfoOrCommentTop = function ($object){

    var gid = $object.attr('data-cg-gid');

    $object.parent().find('.cg-top-bottom-arrow:last-child').removeClass('cg_no_scroll');

   // var $scrollElement = $object.closest('.cg-scroll-info-single-image-view').find('[class*="-parent"]');
    var $scrollElement = $object.closest('.cg-scroll-info-single-image-view').find('.cg-center-image-info-div-parent-padding');
    $scrollElement.scrollTop($scrollElement.scrollTop()-50);

/*
    var noSlideOut = false;

    if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1){
        noSlideOut = true;
    }
*/

    if($scrollElement.scrollTop()==0){
       // if(noSlideOut==false){
            $object.addClass('cg_no_scroll');
       // }
    }else{
        $object.removeClass('cg_no_scroll');
    }
};
cgJsClass.gallery.views.scrollInfoOrCommentBottom = function ($object){

    var gid = $object.attr('data-cg-gid');

    $object.parent().find('.cg-top-bottom-arrow:first-child').removeClass('cg_no_scroll');

   // var $scrollElement = $object.closest('.cg-scroll-info-single-image-view').find('[class*="-parent"]');
    var $scrollElement = $object.closest('.cg-scroll-info-single-image-view').find('.cg-center-image-info-div-parent-padding');
    $scrollElement.scrollTop($scrollElement.scrollTop()+50);

    var countHeight = 0;

    $scrollElement.find('.cg-center-image-info-div, .cg-center-image-comments-div').each(function () {

        // +10 because of margin bottom 10px
        countHeight = countHeight + jQuery(this).height()+0;

    });

    var scrollCheck = $scrollElement.scrollTop()+$scrollElement.height();
    var scrollHeightElement = countHeight;
/*


    var noSlideOut = false;

    if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1){
        noSlideOut = true;
    }
*/

    if(scrollCheck>=scrollHeightElement){
  //      if(noSlideOut==false){
            $object.addClass('cg_no_scroll');
    //    }
    }
    else{
        $object.removeClass('cg_no_scroll');
    }

};
cgJsClass.gallery.comment.scrollInterval = null;
