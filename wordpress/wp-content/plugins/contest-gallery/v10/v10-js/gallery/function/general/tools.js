cgJsClass.gallery.function.general.tools = {
    setHeightForInfoBlockInGallery: function(gid,$infoTitleDiv,$imageObject,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad,isPrependInfoTitleDiv,isFromHover){

        if($imageObject.attr('data-cg-id') == '12641'){
               //debugger
        }

        if($imageObject.attr('data-cg-id') == '12593' && !cgJsData[gid].vars.isUserGallery){
             // debugger
        }

        if(cgJsData[gid].options.general.FbLike==1 && cgJsData[gid].options.general.FbLikeGallery==1 && $imageObject){
            $imageObject.find('.cg_gallery_info').removeClass('cg_justify_content_flex_start');// do this here generally at the beginning
        }

        if($infoTitleDiv && $imageObject){
            $infoTitleDiv.removeClass('cg_overflow_y_scroll').removeAttr('style');// do this here generally at the beginning, remove attr style with height also here
        }

        if($imageObject && widthFromImageObjectSetInViewLoad && !$infoTitleDiv){
            cgJsClass.gallery.function.general.tools.checkIfSmallWidthImageObject(gid,$imageObject,null,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad);
        }else{


            if(heightFromImageObjectSetInViewLoad && $infoTitleDiv && cgJsData[gid].vars.modernHover && $imageObject){
                if(cgJsData[gid].vars.currentLook=='slider' && $infoTitleDiv.length){

                    $infoTitleDiv.addClass('cg_hide');
                    $imageObject.find('.cg_gallery_info').removeClass('cg_justify_content_flex_start');

                }else{

                    if($infoTitleDiv.length && true){

                        // cg_small_width_xs cg_small_width_xss or has to be removed or added here before real calculation
                        cgJsClass.gallery.function.general.tools.checkIfSmallWidthImageObject(gid,$imageObject,null,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad);

                        var $cg_gallery_info = $imageObject.find('.cg_gallery_info');

                        $cg_gallery_info.addClass('cg_visibility_hidden');

                        if(isFromHover){
                            $cg_gallery_info.removeClass('cg_hide_till_hover');
                        }

                        $infoTitleDiv.removeAttr('style').removeClass('cg_hide cg_hide_till_hover');// cg_hide might be added as switched to slider view, cg_hide_till_hover is added when info should be only displayed on hover

                        if(isPrependInfoTitleDiv){
                            $cg_gallery_info.prepend($infoTitleDiv);
                        }

                        var heightCheck = 0;
                        var heightCheckWithoutInfoTitleDiv = 0;

                        if(cgJsData[gid].vars.isUserGallery){
                            heightCheck = 35; // then can be started with 55 because of delete option at the top
                            heightCheckWithoutInfoTitleDiv = 35; // then can be started with 55 because of delete option at the top
                        }

                        if(cgJsData[gid].options.general.AllowRating==2 || cgJsData[gid].options.general.AllowComments==1){
                            var $cg_gallery_info_rating_comments = $imageObject.find('.cg_gallery_info_rating_comments');
                            if($cg_gallery_info_rating_comments.length){
                                heightCheck = heightCheck+$cg_gallery_info_rating_comments.outerHeight() + parseInt($cg_gallery_info_rating_comments.css('marginBottom'));
                                heightCheckWithoutInfoTitleDiv = heightCheck;
                            }
                        }

                        if(cgJsData[gid].options.general.AllowRating==1){
                            var $cg_gallery_rating_div = $imageObject.find('.cg_gallery_rating_div');
                            if($cg_gallery_rating_div.length){
                                heightCheck = heightCheck + $cg_gallery_rating_div.outerHeight() + parseInt($cg_gallery_rating_div.css('marginBottom'));
                                heightCheckWithoutInfoTitleDiv = heightCheck;
                            }
                        }

                        if(cgJsData[gid].options.general.FbLike==1 && cgJsData[gid].options.general.FbLikeGallery==1){
                            var $cg_gallery_facebook_div = $imageObject.find('.cg_gallery_facebook_div');
                            if($cg_gallery_facebook_div.length){
                                heightCheck = heightCheck+$cg_gallery_facebook_div.outerHeight() + 5;// is distance bottom
                                heightCheckWithoutInfoTitleDiv = heightCheck;
                            }
                        }

                        // outerHeight might be not calculated correctly in this case, this why max-height is set further bottom
                        heightCheck = heightCheck+ $infoTitleDiv.outerHeight() + parseInt($infoTitleDiv.css('marginBottom'));

                        var heightFromImageObjectSetInViewLoad = $imageObject.height();

                        if(heightCheck  > heightFromImageObjectSetInViewLoad){

                            if(cgJsData[gid].options.general.AllowRating==1 && (cgJsData[gid].options.general.FbLike==1 && cgJsData[gid].options.general.FbLikeGallery==1)){
                                $infoTitleDiv.height(heightFromImageObjectSetInViewLoad - heightCheckWithoutInfoTitleDiv-15); // - 15 for right appearence
                            }else if(cgJsData[gid].options.general.AllowRating==1){
                                $infoTitleDiv.height(heightFromImageObjectSetInViewLoad - heightCheckWithoutInfoTitleDiv-10 ); // - 10 for right appearence
                            }else{
                                //if((cgJsData[gid].options.general.FbLike==1 && cgJsData[gid].options.general.FbLikeGallery==1) && (heightFromImageObjectSetInViewLoad-heightCheckWithoutInfoTitleDiv) < 30){
                                if((cgJsData[gid].options.general.FbLike==1 && cgJsData[gid].options.general.FbLikeGallery==1)){
                                    //  (heightFromImageObjectSetInViewLoad-heightCheckWithoutInfoTitleDiv) < 30 then text might be pretty far at bottom and overlap facebook button
                                    $infoTitleDiv.height(heightFromImageObjectSetInViewLoad - heightCheckWithoutInfoTitleDiv-15); // - 15 for right appearence
                                }else{
                                    $infoTitleDiv.height(heightFromImageObjectSetInViewLoad - heightCheckWithoutInfoTitleDiv-10); // for right appearence
                                }
                            }

                            // set max height always additionally to go sure
                            $infoTitleDiv.css('max-height',heightFromImageObjectSetInViewLoad-heightCheckWithoutInfoTitleDiv-15+'px');

                            $infoTitleDiv.addClass('cg_overflow_y_scroll');

                            if(cgJsData[gid].options.general.FbLike==1 && cgJsData[gid].options.general.FbLikeGallery==1){// simply flex start from top in this case
                                $cg_gallery_info.addClass('cg_justify_content_flex_start');
                            }

                        }else{// set max height to go sure, because outerHeight might be not calculated correctly
                            $infoTitleDiv.css('max-height',heightFromImageObjectSetInViewLoad-heightCheckWithoutInfoTitleDiv-15+'px');
                        }

                        if($imageObject.attr('data-cg-id') == '12593'){
                           // debugger
                        }

                        $cg_gallery_info.removeClass('cg_visibility_hidden');

                    }
                }
            }
        }

    },
    checkIfSmallWidthImageObject: function (gid,$imageObject,$cg_gallery_rating_div,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad,isFromHover){

        if($imageObject.attr('data-cg-id') == '12641'){
            //debugger
        }

        if($imageObject.attr('data-cg-id') == '12592' && !cgJsData[gid].vars.isUserGallery){
            // debugger
        }

        if($imageObject && widthFromImageObjectSetInViewLoad){

            if(cgJsData[gid].vars.modernHover){

                if(cgJsData[gid].options.general.AllowRating==1){
                    if(!$cg_gallery_rating_div){
                        $cg_gallery_rating_div = $imageObject.find('.cg_gallery_rating_div');
                    }
                    if(widthFromImageObjectSetInViewLoad<=150 || heightFromImageObjectSetInViewLoad<=150){
                        $imageObject.addClass('cg_small_width_xss').removeClass('cg_small_width_xs');
                    }else if(widthFromImageObjectSetInViewLoad<200 || heightFromImageObjectSetInViewLoad<200){
                        $imageObject.addClass('cg_small_width_xs').removeClass('cg_small_width_xss');
                    }else{
                        $imageObject.removeClass('cg_small_width_xs cg_small_width_xss');
                    }
                }else{
                    if(widthFromImageObjectSetInViewLoad<=150 || heightFromImageObjectSetInViewLoad<=150){
                        $imageObject.addClass('cg_small_width_xss').removeClass('cg_small_width_xs');
                    }else if(widthFromImageObjectSetInViewLoad<200 || heightFromImageObjectSetInViewLoad<200){
                        $imageObject.addClass('cg_small_width_xs').removeClass('cg_small_width_xss');
                    }else{
                        $imageObject.removeClass('cg_small_width_xs cg_small_width_xss');
                    }
                }
            }
        }

    },
    correctNewAddedOptionsIfRequired: function(options){

        if(options.visual['ImageViewFullWindow']===undefined || options.visual['ImageViewFullWindow']===''){
            options.visual['ImageViewFullWindow'] = 1;// this was normal behaviour in old versions
        }

        if(options.visual['ImageViewFullScreen']===undefined || options.visual['ImageViewFullScreen']===''){
            options.visual['ImageViewFullScreen'] = 1;// this was normal behaviour in old versions
        }

        if(options.visual['SliderThumbNav']===undefined || options.visual['SliderThumbNav']===''){
            options.visual['SliderThumbNav'] = 1;// this was normal behaviour in old versions
        }

    },
    resetGallery: function(gid){

        // reset search and reset categories here!!!
        cgJsData[gid].vars.mainCGdiv.find('#cgSearchInput'+gid).val('');
        cgJsData[gid].vars.searchInput = '';

        if(cgJsData[gid].vars.showCategories){
            for(var categoryId in cgJsData[gid].vars.categories){
                if(!cgJsData[gid].vars.categories.hasOwnProperty(categoryId)){
                    break;
                }
                cgJsData[gid].vars.categories[categoryId]['Checked'] = true;
            }
            if(cgJsData[gid].options.pro.CatWidget==1){
                if(cgJsData[gid].options.pro.ShowCatsUnchecked==1){
                    cgJsData[gid].vars.mainCGdiv.find('#cgCatSelectArea'+gid+' .cg_select_cat_label').removeClass('cg_cat_checkbox_checked').addClass('cg_cat_checkbox_unchecked');
                }else{
                    cgJsData[gid].vars.mainCGdiv.find('#cgCatSelectArea'+gid+' .cg_select_cat_label').removeClass('cg_cat_checkbox_unchecked').addClass('cg_cat_checkbox_checked');
                }
            }
        }

        if(cgJsData[gid].vars.mainCGdiv.find('#cg_select_order'+gid+' .cg_date_descend').length){
            cgJsData[gid].options.pro.PreselectSort='date_descend'// set PreselectSort also to go sure
            cgJsData[gid].vars.sorting = 'date-desc';
            cgJsData[gid].vars.mainCGdiv.find('#cg_select_order'+gid).val("1");
        }

        if(cgJsData[gid].vars.currentLook=='blog'){
            if(cgJsData[gid].vars.$cg_further_images_container_top){
                cgJsData[gid].vars.$cg_further_images_container_top.addClass('cg_hide');
            }
            if(cgJsData[gid].vars.$cg_further_images_container_bottom){
                cgJsData[gid].vars.$cg_further_images_container_bottom.addClass('cg_hide');
            }
            cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.addClass('cg_margin_top_0').removeClass('cg_hide');
            cgJsData[gid].vars.cgLdsDualRingMainCGdivHide.addClass('cg_hide');

            cgJsClass.gallery.views.scrollUp(gid);
            cgJsClass.gallery.blogLogic.reset(gid);
        }

    },
    setWaitingForValues: function(gid,$element,action,isWaitForInfoData){

        if((!cgJsClass.gallery.vars.isSortingDataAvailable && !cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval)
            ||
            (isWaitForInfoData && !cgJsClass.gallery.vars.isInfoDataAvailable && !cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval)
        ){

            var $mainCGdiv = jQuery('#mainCGdiv'+gid);
            var $mainCGslider = jQuery('#mainCGslider'+gid);
            $mainCGdiv.find('#mainCGallery'+gid).find('.cg_show').remove();
            $mainCGdiv.find('#cgLdsDualRingMainCGdivHide'+gid).removeClass('cg_hide');
            $mainCGslider.find('#cgLdsDualRingMainCGdivHide'+gid).removeClass('cg_hide');

            cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval = setInterval(function() {

                if(action=='click'){
                    $element.click();
                }
                if(action=='change'){
                    $element.trigger('change');
                }
            },500);

            return true;
        }

        if((cgJsClass.gallery.vars.isSortingDataAvailable && cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval)
            || (isWaitForInfoData && cgJsClass.gallery.vars.isInfoDataAvailable && cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval)){
            clearInterval(cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval);
            cgJsClass.gallery.views.clickFurtherImagesStep.waitingInterval = null;
            var $mainCGdiv = jQuery('#mainCGdiv'+gid);
            var $mainCGslider = jQuery('#mainCGslider'+gid);
            $mainCGdiv.find('#cgLdsDualRingMainCGdivHide'+gid).removeClass('cg_hide');
            $mainCGslider.find('#cgLdsDualRingMainCGdivHide'+gid).removeClass('cg_hide');
            return false;
        }else if((!cgJsClass.gallery.vars.isSortingDataAvailable) || (isWaitForInfoData && !cgJsClass.gallery.vars.isInfoDataAvailable)){
            return true;
        }

        return false;

    },
    modifyFullImageData: function(gid,realId,data){

        // do not forget it because of modifiying data!
        // id is not available in data!
        data['id'] = realId;

        for(var index in cgJsData[gid].fullImageData){

            if(!cgJsData[gid].fullImageData.hasOwnProperty(index)){
                break;
            }

            var firstKey = Object.keys(cgJsData[gid].fullImageData[index])[0];
            var realIdToCompare = cgJsData[gid].fullImageData[index][firstKey]['id'];

            if(realId == realIdToCompare){
                cgJsData[gid].fullImageData[index][firstKey] = data;
                break;
            }

        }

        for(var index in cgJsData[gid].fullImageDataFiltered){

            if(!cgJsData[gid].fullImageDataFiltered.hasOwnProperty(index)){
                break;
            }

            var firstKey = Object.keys(cgJsData[gid].fullImageDataFiltered[index])[0];
            var realIdToCompare = cgJsData[gid].fullImageDataFiltered[index][firstKey]['id'];

            if(realId == realIdToCompare){
                cgJsData[gid].fullImageDataFiltered[index][firstKey] = data;
                break;
            }

        }

    },
    isFullSizeSlideOutStartNormally: function (gid) {

        if(cgJsData[gid].options.general.FullSizeSlideOutStart==1
            &&
         (cgJsData[gid].vars.currentLook=='thumb' || cgJsData[gid].vars.currentLook=='height' || cgJsData[gid].vars.currentLook=='row')
        ) {
            return true;
        } else{
            return false;
        }

    },
    checkSsl: function (imgUrl) {

        if(cgJsClass.gallery.vars.isSsl){
            if(imgUrl.indexOf('http://')===0){
                imgUrl = imgUrl.replace("http://", "https://");
                return imgUrl;
            }else{
                return imgUrl;
            }
        }else{
            if(imgUrl.indexOf('https://')===0){
                imgUrl = imgUrl.replace("https://", "http://");
                return imgUrl;
            }else{
                return imgUrl;
            }
        }

    },
    checkIfIsEdge: function () {

        // checks if edge

        var ua = window.navigator.userAgent;

/*        var msie = ua.indexOf('MSIE ');

        if (msie > 0) {
            // IE 10 or older => return version number
            cgJsClass.gallery.vars.isEdge = true;
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
            // IE 11 => return version number
            var rv = ua.indexOf('rv:');
            cgJsClass.gallery.vars.isEdge = true;
        }*/

        if (ua.indexOf('Edge/') > 0 || ua.indexOf('Edg/')) {
            cgJsClass.gallery.vars.isEdge = true;
        }

    },
    checkIfInternetExplorer: function () {

        cgJsClass.gallery.vars.isInternetExplorer = false;

        // checks if edge or ie !

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
        {
            cgJsClass.gallery.vars.isInternetExplorer = true;
        }

    },
    checkIfIsChrome: function () {

        // please note,
        // that IE11 now returns undefined again for window.chrome
        // and new Opera 30 outputs true for window.chrome
        // but needs to check if window.opr is not undefined
        // and new IE Edge outputs to true now for window.chrome
        // and if not iOS Chrome check
        // so use the below updated condition
        var isChromium = window.chrome;
        var winNav = window.navigator;
        var vendorName = winNav.vendor;
        var isOpera = typeof window.opr !== "undefined";
        var isIEedge = winNav.userAgent.indexOf("Edge") > -1;
        var isIOSChrome = winNav.userAgent.match("CriOS");

        if (isIOSChrome) {
            // is Google Chrome on IOS
        } else if(
            isChromium !== null &&
            typeof isChromium !== "undefined" &&
            vendorName === "Google Inc." &&
            isOpera === false &&
            isIEedge === false
        ) {
            cgJsClass.gallery.vars.isChrome = true;// is Google Chrome
        } else {
            cgJsClass.gallery.vars.isChrome = false;// not Google Chrome
        }

    },
    checkIfIsSafari: function () {

        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf('safari') != -1) {
            if (ua.indexOf('chrome') > -1) {
                cgJsClass.gallery.vars.isSafari = false;// Chrome
            } else {
                cgJsClass.gallery.vars.isSafari = true; // Safari
            }
        }

    },
    checkIfIsFF: function () {

        cgJsClass.gallery.vars.isFF = false;

        if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
            cgJsClass.gallery.vars.isFF = true;
        }

    },
    checkError: function ($cgCenterDiv,gid,realId) {

        cgJsData[gid].vars.jsonGetImageCheck.push(jQuery.getJSON( cgJsData[gid].vars.uploadFolderUrl+"/contest-gallery/gallery-id-"+cgJsData[gid].vars.gidReal+"/json/image-data/image-data-"+realId+".json", {_: new Date().getTime()}).done(function( data ) {

        }).done(function(data){

            data = cgJsClass.gallery.function.general.tools.calculateSizeGetJsonImageData(data,realId,gid);

            // has to be set here, because was not set in php. Also image Object has to be reset on some places.
            data.id = realId;
            data.imageObject = cgJsData[gid].imageObject[realId];


        }).fail(function (error) {

            if(error.status=='404'){
                cgJsClass.gallery.function.general.tools.removeImageWhenError(gid,realId);
            }

        }));


    },
    checkErrorAbort: function (gid) {

        for(var key in cgJsData[gid].vars.jsonGetImageCheck){

            if(!cgJsData[gid].vars.jsonGetImageCheck.hasOwnProperty(key)){
                break;
            }

            cgJsData[gid].vars.jsonGetImageCheck[key].abort();
        }
        cgJsData[gid].vars.jsonGetImageCheck = [];


    },
    removeImageWhenError: function (gid,realId) {

        cgJsClass.gallery.getJson.removeImageFromImageData(gid,realId);
        cgJsClass.gallery.function.message.show(cgJsClass.gallery.language.ImageDeleted);

    },
    checkSetUserGalleryOptions: function (gid) {

        if(cgJsData[gid].vars.isUserGallery){
            cgJsData[gid].options.general.HideUntilVote = 0;
            cgJsData[gid].options.general.ShowOnlyUsersVotes = 0;
        }

    },
    checkIfSettingsRequiredInFullWindow: function (gid) {

        if((cgJsData[gid].options.pro.CatWidget==1  || cgJsData[gid].options.pro.Search==1 || cgJsData[gid].options.general.RandomSortButton==1 || cgJsData[gid].options.general.AllowSort==1)==false){
            jQuery('#cgCenterImageFullWindowConfiguration'+gid).remove();
            jQuery('#cgCenterDivCenterImageFullWindowConfiguration'+gid).remove();
        }

    },
    setBackgroundColor: function(gid){

        if(!cgJsClass.gallery.vars.backgroundColor){
            var $mainCGdivContainer = jQuery('#mainCGdivContainer'+gid);
            cgJsClass.gallery.function.general.tools.getBackgroundColor($mainCGdivContainer);
        }

        if(cgJsClass.gallery.vars.backgroundColor){
            var bgColor = cgJsClass.gallery.vars.backgroundColor;
            if(bgColor.indexOf(',')){
                var parts = bgColor.split(',');
                if(parts.length>3){
                    var opacityValue = parts[parts.length-1].split(')')[0].trim();
                    if(opacityValue.indexOf('0')!=-1){// must have opacity lower 1. So is transparent.
                        var newBgColor = '';
                        parts.forEach(function (value,index) {

                            if(index==parts.length-1){
                                newBgColor+='1)';
                            }else{
                                newBgColor+=value+',';
                            }
                        });
                        cgJsClass.gallery.vars.backgroundColor = newBgColor;

                    }
                }
            }

            jQuery('#mainCGdivUploadForm'+gid).css('background-color',cgJsClass.gallery.vars.backgroundColor);
            jQuery('#mainCGdivHelperParent'+gid).css('background-color',cgJsClass.gallery.vars.backgroundColor);
            jQuery('#mainCGdivFullWindowConfigurationArea'+gid).css('background-color',cgJsClass.gallery.vars.backgroundColor);// reinserted again in >= 12.1.1
        }

    },
    getBackgroundColor: function($mainCGdivContainer,$parent){

        if(!$parent){
            $parent = $mainCGdivContainer.parent();
        }else{
            $parent = $parent.parent();
        }

        var backgroundColor = $parent.css('backgroundColor');
        var tagName = $parent.prop('tagName').toLowerCase();

        if((backgroundColor=='rgba(0, 0, 0, 0)' || backgroundColor=='transparent') && tagName!='html'){//if not set transparent is in IE
            this.getBackgroundColor(undefined,$parent);
        }else{
            cgJsClass.gallery.vars.backgroundColor = backgroundColor;
        }

    },
    testTopControlsStyle: function($){

        $(document).on('click','.cgChangeTopControlsStyleOptionTestWhiteSites',function () {
            var $element = $(this);
            var gid = $element.attr('data-cg-gid');
            $('#mainCGdivUploadForm'+gid).find('.cg_fe_controls_style_black').addClass('cg_fe_controls_style_white').removeClass('cg_fe_controls_style_black');

            var $mainCGdivHelperParent = $(this).closest('.mainCGdivHelperParent ');
            $mainCGdivHelperParent.addClass('cg_fe_controls_style_white').removeClass('cg_fe_controls_style_black');
            $mainCGdivHelperParent.find('.cg_fe_controls_style_black').addClass('cg_fe_controls_style_white').removeClass('cg_fe_controls_style_black');
            $('#cgMessagesContainer').addClass('cg_fe_controls_style_white').removeClass('cg_fe_controls_style_black');
            $('#cgMessagesContainerPro').addClass('cg_fe_controls_style_white').removeClass('cg_fe_controls_style_black');
            $(this).addClass('cg_hide');
            $(this).closest('.cgChangeTopControlsStyleOptionMessage').find('.cgChangeTopControlsStyleOptionTestBlackSites').removeClass('cg_hide');
        });

        $(document).on('click','.cgChangeTopControlsStyleOptionTestBlackSites',function () {
            var $element = $(this);
            var gid = $element.attr('data-cg-gid');
            $('#mainCGdivUploadForm'+gid).find('.cg_fe_controls_style_white').addClass('cg_fe_controls_style_black').removeClass('cg_fe_controls_style_white');

            var $mainCGdivHelperParent = $(this).closest('.mainCGdivHelperParent ');
            $mainCGdivHelperParent.addClass('cg_fe_controls_style_black').removeClass('cg_fe_controls_style_white');
            $mainCGdivHelperParent.find('.cg_fe_controls_style_white').addClass('cg_fe_controls_style_black').removeClass('cg_fe_controls_style_white');
            $('#cgMessagesContainer').addClass('cg_fe_controls_style_black').removeClass('cg_fe_controls_style_white');
            $('#cgMessagesContainerPro').addClass('cg_fe_controls_style_black').removeClass('cg_fe_controls_style_white');
            $(this).addClass('cg_hide');
            $(this).closest('.cgChangeTopControlsStyleOptionMessage').find('.cgChangeTopControlsStyleOptionTestWhiteSites').removeClass('cg_hide');
        });

        $(document).on('click','.cgChangeCenterToBlack',function () {
            var $element = $(this);
            var gid = $element.attr('data-cg-gid');
            cgJsData[gid].vars.centerWhite = false;
            cgJsData[gid].vars.mainCGallery.removeClass('cg_center_white');
            cgJsData[gid].vars.mainCGallery.find('.cgCenterDiv').removeClass('cg_center_white');
            $(this).addClass('cg_hide');
            $(this).closest('.cgChangeTopControlsStyleOptionMessage').find('.cgChangeCenterToWhite').removeClass('cg_hide');
        });

        $(document).on('click','.cgChangeCenterToWhite',function () {
            var $element = $(this);
            var gid = $element.attr('data-cg-gid');
            cgJsData[gid].vars.centerWhite = true;
            cgJsData[gid].vars.mainCGallery.addClass('cg_center_white');
            cgJsData[gid].vars.mainCGallery.find('.cgCenterDiv').addClass('cg_center_white');
            $(this).addClass('cg_hide');
            $(this).closest('.cgChangeTopControlsStyleOptionMessage').find('.cgChangeCenterToBlack').removeClass('cg_hide');
        });

        cgJsClass.gallery.function.general.ajax.changesRecognized($);


    },
    getScrollbarWidthDependsOnBrowser: function () {

        if(cgJsClass.gallery.vars.isMobile){
            return 0;
        }

        if(cgJsClass.gallery.vars.isChrome){
            return 13;
        }else if(cgJsClass.gallery.vars.isSafari){
            return 16;
        }else if(cgJsClass.gallery.vars.isFF){
            return 17;
        }else if(cgJsClass.gallery.vars.isEdge){
            return 16;
        }else{
            return 16;
        }

    },
    getValueForPreselectSort: function (valueForPreselectSort) {

        if(valueForPreselectSort=='date_descend'){
            return 'date-desc';
        }
        if(valueForPreselectSort=='date_ascend'){
            return 'date-asc';
        }

        if(valueForPreselectSort=='comments_descend'){
            return 'comments-desc';
        }
        if(valueForPreselectSort=='comments_ascend'){
            return 'comments-asc';
        }

        if(valueForPreselectSort=='rating_descend'){
            return 'rating-desc';
        }
        if(valueForPreselectSort=='rating_ascend'){
            return 'rating-asc';
        }

        if(valueForPreselectSort=='rating_descend_average'){
            return 'rating-desc-average';
        }
        if(valueForPreselectSort=='rating_ascend_average'){
            return 'rating-asc-average';
        }

        return 'date-desc';

    },
    checkHasNoBottomSpace: function (gid,data) {

        var hasNoFieldContent = true;

        for(var property in data){

            if(!data.hasOwnProperty(property)){
                break;
            }

            if(data[property]['field-content']){
                hasNoFieldContent = false;
                break;
            }

        }
        if (hasNoFieldContent && cgJsData[gid].options.general.FbLike!=1 && cgJsData[gid].options.general.AllowComments!=1) {
            return true;
        }else{
            return false;
        }

    },
    getOrderByGidAndRealId: function (gid,realId) {

        var order = 0;

        for(var index in cgJsData[gid].image){

            if(!cgJsData[gid].image.hasOwnProperty(index)){
                break;
            }

            var firstKey = Object.keys(cgJsData[gid].image[index])[0];

            var id = cgJsData[gid].image[index][firstKey]['id'];

            if(id==realId){
                order = index;
                break;
            }

        }

        return order;

    },
    calculateSizeImageDataPreProcess: function (data,gid) {

        for(var realId in data){

            if(!data.hasOwnProperty(realId)){
                break;
            }

            if(data[realId]['thumbnail_size_w'] && data[realId]['thumbnail']){
                data[realId]['thumbnail_size_w'] = cgJsClass.gallery.function.general.tools.calculateSize(data[realId]['thumbnail'],parseInt(data[realId]['thumbnail_size_w']),data[realId],'thumbnail_size_w',realId,gid);
            }
            if(data[realId]['medium_size_w'] && data[realId]['medium']){
                data[realId]['medium_size_w'] = cgJsClass.gallery.function.general.tools.calculateSize(data[realId]['medium'],parseInt(data[realId]['medium_size_w']),data[realId],'medium_size_w',realId,gid);
            }
            if(data[realId]['large_size_w'] && data[realId]['large']){
                data[realId]['large_size_w'] = cgJsClass.gallery.function.general.tools.calculateSize(data[realId]['large'],parseInt(data[realId]['large_size_w']),data[realId],'large_size_w',realId,gid);
            }

        }

        return data;

    },
    calculateSizeGetJsonImageData: function (data,realId,gid) {

        if(data['thumbnail_size_w'] && data['thumbnail']){
            data['thumbnail_size_w'] = cgJsClass.gallery.function.general.tools.calculateSize(data['thumbnail'],parseInt(data['thumbnail_size_w']),data,'thumbnail_size_w',realId,gid);
        }
        if(data['medium_size_w'] && data['medium']){
            data['medium_size_w'] = cgJsClass.gallery.function.general.tools.calculateSize(data['medium'],parseInt(data['medium_size_w']),data,'medium_size_w',realId,gid);
        }
        if(data['large_size_w'] && data['large']){
            data['large_size_w'] = cgJsClass.gallery.function.general.tools.calculateSize(data['large'],parseInt(data['large_size_w']),data,'large_size_w',realId,gid);
        }

        return data;

    },
    calculateSize: function (imagePath,fallbackSize,data,type,realId,gid) {

        try{

            var splitImagePath = imagePath.split('x');
            var splitWidthPart = splitImagePath[splitImagePath.length-2].split('-');
            var width = splitWidthPart[splitWidthPart.length-1];

            if(isNaN(width)){
                width = fallbackSize;
            }else{
                width = parseInt(width);
            }

        }catch(e){// happens only for small uploaded images
            //debugger;
            //console.log(data);
            //console.log(imagePath);
            width = fallbackSize;

            try{// to go sure, it is in try and catch
                jQuery("<img/>",{
                    load : function(){
                        //console.log(this.width+' '+this.height);
                        if(cgJsData[gid].vars.rawData[realId]){
                            cgJsData[gid].vars.rawData[realId][type] = this.width;
                        }
                    },
                    src  : imagePath
                });
            }catch(e){
                //debugger;
                console.log(e);
            }

        }

        return width;

    },
    checkAndSetCustomIconsStyle: function ($,data,gid){
        if(data.icons){
            var $style = $("<style>").prop("type", "text/css");
            var hasStyleToAppend = false;

            var cgCenterDivIconBackgroundColor = '';

            if(!cgJsData[gid].vars.centerWhite){
                cgCenterDivIconBackgroundColor = 'background-color: #222;';
            }

            if(data.icons.iconVoteUndoneGalleryViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cg_show .cg_gallery_rating_div_one_star_off{background: url(\"" + data.icons.iconVoteUndoneGalleryViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconVoteDoneGalleryViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cg_show .cg_gallery_rating_div_one_star_on{background: url(\"" + data.icons.iconVoteDoneGalleryViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconVoteHalfStarGalleryViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cg_show .cg_gallery_rating_div_one_star_half_off{background: url(\"" + data.icons.iconVoteHalfStarGalleryViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconVoteUndoneImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg_gallery_rating_div_one_star_off{background: url(\"" + data.icons.iconVoteUndoneImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconVoteDoneImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg_gallery_rating_div_one_star_on{background: url(\"" + data.icons.iconVoteDoneImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconVoteHalfStarImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg_gallery_rating_div_one_star_half_off{background: url(\"" + data.icons.iconVoteHalfStarImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconVoteFiveStarsPercentageOverviewDoneImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cg_gallery_rating_div .cg_gallery_rating_div_five_star_details .cg_five_star_details_row .cg_five_star_details_row_star{background: url(\"" + data.icons.iconVoteFiveStarsPercentageOverviewDoneImageViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconVoteRemoveImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg_gallery_rating_div .cg_rate_minus{background: url(\"" + data.icons.iconVoteRemoveImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconVoteRemoveGalleryOnlyViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + ".cg_only_gallery_view .cg_gallery_rating_div  .cg_rate_minus{background: url(\"" + data.icons.iconVoteRemoveGalleryOnlyViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconCommentUndoneGalleryViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cg_show .cg_gallery_comments_div .cg_gallery_comments_div_icon_off{background: url(\"" + data.icons.iconCommentUndoneGalleryViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconCommentDoneGalleryViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cg_show .cg_gallery_comments_div .cg_gallery_comments_div_icon_on{background: url(\"" + data.icons.iconCommentDoneGalleryViewBase64 + "\") no-repeat center;background-size:contain;}");
            }
            if(data.icons.iconCommentUndoneImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg_gallery_comments_div .cg_gallery_comments_div_icon_off{background: url(\"" + data.icons.iconCommentUndoneImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconCommentDoneImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg_gallery_comments_div .cg_gallery_comments_div_icon_on{background: url(\"" + data.icons.iconCommentDoneImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconCommentAddImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg-center-image-comments-div-add-comment{background: url(\"" + data.icons.iconCommentAddImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(data.icons.iconInfoImageViewBase64){
                hasStyleToAppend = true;
                $style.append("#mainCGallery" + gid + " .cgCenterDiv .cg-center-info-div .cg-center-image-info-div-title .cg-center-image-info-icon{background: url(\"" + data.icons.iconInfoImageViewBase64 + "\") no-repeat center;background-size:contain;"+cgCenterDivIconBackgroundColor+"}");
            }
            if(hasStyleToAppend){
                $style.appendTo("head");
            }
        }
    },
    backdropShow: function ($mainCGdivUploadForm,isFullWindowOrFullScreenAndForUploadFormBackdrop){

        var $cgModalBackdrop = jQuery('<div id="cgModalBackdrop" class="cgModalBackdrop"></div>');

        cgJsClass.gallery.function.general.tools.backdropHide();

        if ($mainCGdivUploadForm && isFullWindowOrFullScreenAndForUploadFormBackdrop) {
            $mainCGdivUploadForm.parent().prepend($cgModalBackdrop);
        } else if (cgJsClass.gallery.vars.fullscreen) {
            cgJsData[cgJsClass.gallery.vars.fullscreen].vars.mainCGdiv.prepend($cgModalBackdrop);
        } else {
            cgJsClass.gallery.vars.dom.body.prepend($cgModalBackdrop);
        }

        setTimeout(function (){
            $cgModalBackdrop.addClass('cg_modal_backdrop_fade_in');
        },1);

    },
    backdropHide: function (){

        jQuery('.cgModalBackdrop').remove();

    }
};