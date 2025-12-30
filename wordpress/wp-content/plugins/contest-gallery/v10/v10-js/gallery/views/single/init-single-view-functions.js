cgJsClass.gallery.views.singleViewFunctions = {
    editCloseInfoUserGallery: function($cgCenterDiv){
        $cgCenterDiv.find('.cg-center-image-info-edit-icon-container').removeClass('cg_edit_started');
        var gid = $cgCenterDiv.attr('data-cg-gid');
        var realId = $cgCenterDiv.attr('data-cg-real-id');
        //var dataCgOrder = $cgCenterDiv.attr('data-cg-order');
        var gidForCenterDivElements = $cgCenterDiv.attr('data-cg-gid-for-center-div-elements');
        cgJsClass.gallery.views.setInfoSingleImageView(realId,gid,false,gidForCenterDivElements);
        cgJsClass.gallery.info.setInfoGalleryView(realId, gid, true,cgJsData[gid].imageObject[realId],(cgJsData[gid].imageObject[realId]) ? cgJsData[gid].imageObject[realId].height : undefined);
        var $cgCenterImageInfoDivParent = $cgCenterDiv.find('.cg-center-image-info-div-parent');
        $cgCenterImageInfoDivParent.removeClass('cg_edit');
    },
    editOpenInfoUserGallery: function($,object,$cgCenterDiv){

        $cgCenterDiv.find('.cg-center-image-info-edit-icon-container').addClass('cg_edit_started');
        var $cgCenterImageInfoDivParent = $(object).closest('.cg-center-image-info-div-parent');
        $cgCenterImageInfoDivParent.addClass('cg_edit');
        $cgCenterDiv.css({'height':'unset','min-height':'unset'});
        var realId = $cgCenterDiv.attr('data-cg-real-id');
        var gid = $cgCenterDiv.attr('data-cg-gid');

        var $cgCenterImageInfoDivContainer = $cgCenterImageInfoDivParent.find('.cg-center-image-info-div-container');
        $cgCenterImageInfoDivContainer.empty();

        for(var index in cgJsData[gid].singleViewOrder){
            if(!cgJsData[gid].singleViewOrder.hasOwnProperty(index)){
                break;
            }
            var fieldIdToBeEdited = cgJsData[gid].singleViewOrder[index]['id'];
            for(var fieldId in cgJsData[gid].forms.upload){
                if(!cgJsData[gid].forms.upload.hasOwnProperty(fieldId)){
                    break;
                }
                if(fieldIdToBeEdited==fieldId){
                    var Field_Type = cgJsData[gid].forms.upload[fieldId]['Field_Type'];
                    var content = '';
                    if(cgJsData[gid].vars.info[realId]){
                        if(cgJsData[gid].vars.info[realId][fieldId]){
                            content = cgJsData[gid].vars.info[realId][fieldId]['field-content'];
                        }
                    }

                    var fieldTitle = cgJsData[gid].forms.upload[fieldId]['Field_Content']['titel'];

                    var $cgCenterImageInfoDiv = $('<div class="cg-center-image-info-div"><p>'+cgJsData[gid].forms.upload[fieldId]['Field_Content']['titel']+':</p></div>');
                    //if(Field_Type=='url-f' || Field_Type=='select-f' || Field_Type=='date-f' || Field_Type=='selectc-f' || Field_Type=='text-f' || Field_Type=='comment-f'){// then there are fields to edit for user gallery
                    if(Field_Type=='text-f' || Field_Type=='url-f'){
                        $cgCenterImageInfoDiv.append('<div class="cg-center-image-info-div-content-input"><input type="text" name="cg-field-id['+fieldId+']" data-cg-input-field-id="'+fieldId+'" data-cg-input-field-title="'+fieldTitle+'" data-cg-input-field-type="'+Field_Type+'"  class="cg-field-id-input-content" value="'+content+'" /></div>');
                    }
                    if(Field_Type=='comment-f'){
                        $cgCenterImageInfoDiv.append('<div class="cg-center-image-info-div-content-input"><textarea name="cg-field-id['+fieldId+']" data-cg-input-field-id="'+fieldId+'" data-cg-input-field-title="'+fieldTitle+'" data-cg-input-field-type="'+Field_Type+'"  rows="4" class="cg-field-id-input-content" >'+content+'</textarea></div>');
                    }
                    if(Field_Type=='select-f'){
                        var content = cgJsData[gid].forms.upload[fieldId]['Field_Content']['content'];
                        content = content.replace( /\n/g, " " ).split(" ");
                        var $contentForSelect = $('<select class="cg-field-id-input-content"  data-cg-input-field-id="'+fieldId+'"  data-cg-input-field-title="'+fieldTitle+'" data-cg-input-field-type="'+Field_Type+'"  ><option value="0">'+cgJsClass.gallery.language.pleaseSelect+'</option></select>');
                        content.forEach(function (selectValue){
                            var selected = '';
                            if(cgJsData[gid].vars.info[realId]){
                                if(cgJsData[gid].vars.info[realId][fieldId]){
                                    // trim important here
                                    if(cgJsData[gid].vars.info[realId][fieldId]['field-content'].trim() == selectValue.trim()){
                                        selected = 'selected';
                                    }
                                }
                            }
                            $contentForSelect.append('<option value="'+selectValue+'" '+selected+'>'+selectValue+'</option>');
                        });
                        var $cgCenterImageInfoDivContentInput = $('<div class="cg-center-image-info-div-content-input"></div>');
                        $cgCenterImageInfoDivContentInput.append($contentForSelect);
                        $cgCenterImageInfoDiv.append($cgCenterImageInfoDivContentInput);
                    }
                    if(Field_Type=='selectc-f'){
                        var $contentForSelect = $('<select name="cg-cat-id" class="cg-cat-id-input-content"><option value="0">'+cgJsClass.gallery.language.pleaseSelect+'</option></select>');
                        for(var categoryId in cgJsData[gid].vars.categories){
                            if(!cgJsData[gid].vars.categories.hasOwnProperty(categoryId)){
                                break;
                            }
                            if(categoryId>0){
                                var selected = '';
                                if(cgJsData[gid].vars.rawData[realId].Category==categoryId){
                                    selected = 'selected';
                                }
                                $contentForSelect.append('<option value="'+categoryId+'" '+selected+'>'+cgJsData[gid].vars.categories[categoryId]['Name']+'</option>');
                            }
                        }
                        var $cgCenterImageInfoDivContentInput = $('<div class="cg-center-image-info-div-content-input"></div>');
                        $cgCenterImageInfoDivContentInput.append($contentForSelect);
                        $cgCenterImageInfoDiv.append($cgCenterImageInfoDivContentInput);
                    }
                    if(Field_Type=='date-f'){
                        var inputSelector = 'cg_input_date_id_'+realId;
                        var format = cgJsData[gid].forms.upload[fieldId]['Field_Content']['format'];
                        var content = '';
                        if(cgJsData[gid].vars.info[realId]){
                            if(cgJsData[gid].vars.info[realId][fieldId]){
                                content = cgJsData[gid].vars.info[realId][fieldId]['field-content'];
                            }
                        }
                        var $inputSelector = $('<input type="text" id="'+inputSelector+'" autocomplete="off" data-cg-date-format="'+format+'" data-cg-input-field-id="'+fieldId+'" data-cg-input-field-title="'+fieldTitle+'" data-cg-input-field-type="'+Field_Type+'"  value="'+content+'" name="cg-field-id['+fieldId+']" class="cg-field-id-input-content" />');
                        var cgCenterDivClass = 'cg_center_div_image_edit';
                        if(cgJsData[gid].vars.centerWhite){
                            cgCenterDivClass = cgCenterDivClass+' cg_center_white';
                        }
                        cgJsClass.gallery.uploadGeneral.functions.initInputDate($,$inputSelector,content,cgCenterDivClass);
                        $cgCenterImageInfoDiv.append($('<div class="cg-center-image-info-div-content-input"></div>').append($inputSelector));
                    }

                    $cgCenterImageInfoDivContainer.append($cgCenterImageInfoDiv);
                }
            }
        }

    },
    showExif: function(gid,realId,$cgCenterDiv,gidForCenterDivElements){

        if(cgJsData[gid].options.pro.hasOwnProperty('ShowExif')){

            if(cgJsData[gid].options.pro.ShowExif==1){

                if(!cgJsData[gid].vars.rawData[realId].hasOwnProperty('Exif')){

                    jQuery.getJSON( cgJsData[gid].vars.uploadFolderUrl+"/contest-gallery/gallery-id-"+cgJsData[gid].vars.gidReal+"/json/image-data/image-data-"+realId+".json",{_: new Date().getTime()}).done(function( data ) {

                    }).done(function(data) {

                        data = cgJsClass.gallery.function.general.tools.calculateSizeGetJsonImageData(data,realId,gid);

                        // has to be set here, because was not set in php. Also image Object has to be reset on some places.
                        data.id = realId;
                        data.imageObject = cgJsData[gid].imageObject[realId];


                        if(data.hasOwnProperty('Exif')){
                            if(data.Exif!=0){
                                cgJsData[gid].vars.rawData[realId].Exif = data.Exif;
                                cgJsClass.gallery.views.singleViewFunctions.showExifData(gid,realId,$cgCenterDiv,gidForCenterDivElements);
                            }
                        }

                    });

                }else{

                    if(cgJsData[gid].vars.rawData[realId].Exif!=0){
                        cgJsClass.gallery.views.singleViewFunctions.showExifData(gid,realId,$cgCenterDiv,gidForCenterDivElements);
                    }

                }

            }

        }


    },
    showExifData: function(gid,realId,$cgCenterDiv,gidForCenterDivElements){

        var show = false;

        if(!gidForCenterDivElements){
            gidForCenterDivElements = gid;
        }

        if(cgJsData[gid].vars.rawData[realId].Exif.hasOwnProperty('MakeAndModel')){

            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements+ ' .cg-exif-model').removeClass('cg_hide').find('.cg-exif-model-text').text(cgJsData[gid].vars.rawData[realId].Exif.MakeAndModel);
            show = true;

        }else if(cgJsData[gid].vars.rawData[realId].Exif.hasOwnProperty('Model')){

            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements+ ' .cg-exif-model').removeClass('cg_hide').find('.cg-exif-model-text').text(cgJsData[gid].vars.rawData[realId].Exif.Model);

            show = true;

        }

        if(cgJsData[gid].vars.rawData[realId].Exif.hasOwnProperty('ApertureFNumber')){

            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements+ ' .cg-exif-aperturefnumber').removeClass('cg_hide').find('.cg-exif-aperturefnumber-text').text(cgJsData[gid].vars.rawData[realId].Exif.ApertureFNumber);
            show = true;

        }

        if(cgJsData[gid].vars.rawData[realId].Exif.hasOwnProperty('ExposureTime')){

            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements+ ' .cg-exif-exposuretime').removeClass('cg_hide').find('.cg-exif-exposuretime-text').text(cgJsData[gid].vars.rawData[realId].Exif.ExposureTime);
            show = true;

        }

        if(cgJsData[gid].vars.rawData[realId].Exif.hasOwnProperty('ISOSpeedRatings')){

            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements+ ' .cg-exif-isospeedratings').removeClass('cg_hide').find('.cg-exif-isospeedratings-text').text(cgJsData[gid].vars.rawData[realId].Exif.ISOSpeedRatings);
            show = true;

        }
        if(cgJsData[gid].vars.rawData[realId].Exif.hasOwnProperty('FocalLength')){

            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements+ ' .cg-exif-focallength').removeClass('cg_hide').find('.cg-exif-focallength-text').text(cgJsData[gid].vars.rawData[realId].Exif.FocalLength);
            show = true;

        }

        if(show){
            $cgCenterDiv.find('#cgCenterImageExifData'+gidForCenterDivElements).removeClass('cg_hide');
        }

    },
    setFurtherSteps: function(gid,order,isFromBlogLogicNotFromScroll){

        // check steps
        var PicsPerSite = parseInt(cgJsData[gid].options.general.PicsPerSite);
        var stepNumber = Math.floor(order/PicsPerSite+1);
        var $cg_further_images_container = jQuery('#cgFurtherImagesContainerDiv'+gid);
        $cg_further_images_container.find('.cg_further_images').removeClass('cg_further_images_selected');
        $cg_further_images_container.find('[data-cg-step='+stepNumber+']').addClass('cg_further_images_selected');

        cgJsClass.gallery.views.clickFurtherImagesStep.cloneStep(gid,$cg_further_images_container,isFromBlogLogicNotFromScroll);

    },
    setSliderMargin: function(order,gid,direction,isGalleryOpenedSliderLook,realId){// old method scroll horizontal in slider

        var sliderView = false;

        if(cgJsData[gid].options.pro.SliderFullWindow==1 && cgJsClass.gallery.vars.fullwindow){
            sliderView = true;
        }

        if(cgJsData[gid].vars.currentLook=='slider'){

            /*            if(cgJsClass.gallery.vars.isEdge){

                            var mainCGdivWidth = jQuery('#mainCGdiv'+gid).width();
                            var $mainCGallery = jQuery('#mainCGallery'+gid);
                            var newMarginLeft;

                            //var id = jQuery('#mainCGslider'+gid).find('.cg_show[data-cg-order='+order+']').attr('id');
                            var multiplikator = Math.floor(order/cgJsData[gid].vars.maximumVisibleImagesInSlider);

                            newMarginLeft = multiplikator*mainCGdivWidth*-1;
                            $mainCGallery.css('margin-left',newMarginLeft+'px');

                            cgJsClass.gallery.views.singleViewFunctions.setFurtherSteps(gid,order);

                        }else{*/

            var checkStart = Math.floor(cgJsData[gid].vars.maximumVisibleImagesInSlider/2);
            var $mainCGslider = jQuery('#mainCGslider'+gid);

            if(isGalleryOpenedSliderLook == true){
                for(var index in cgJsData[gid].image){

                    if(!cgJsData[gid].image.hasOwnProperty(index)){
                        break;
                    }

                    // firstkey is rowid not realId
                    var firstKey = Object.keys(cgJsData[gid].image[index])[0];
                    if(cgJsData[gid].image[index][firstKey].id==realId){

                        order = parseInt(index);
                    }
                }
            }

            if(order>checkStart){

                //var id = jQuery('#mainCGslider'+gid).find('.cg_show[data-cg-order='+order+']').attr('id');
                // var multiplikator = Math.floor(order)/Math.floor(cgJsData[gid].vars.maximumVisibleImagesInSlider);
                var newMarginLeft = order*cgJsData[gid].vars.widthSliderPreview;

                newMarginLeft = newMarginLeft-((cgJsData[gid].vars.widthmain-cgJsData[gid].vars.widthSliderPreview)/2);

            }else{

                newMarginLeft = 0;

            }

            if(cgJsData[gid].vars.imageDataLength*cgJsData[gid].vars.widthSliderPreview > cgJsData[gid].vars.widthmain){
                //if(newMarginLeft > cgJsData[gid].vars.widthmain){
                $mainCGslider.removeClass('cgCenterDivBackgroundColor');
            }else{
                $mainCGslider.addClass('cgCenterDivBackgroundColor');
            }

            jQuery($mainCGslider).animate({
                scrollLeft: newMarginLeft+'px'
            }, 'fast');

            cgJsClass.gallery.views.singleViewFunctions.setFurtherSteps(gid,order);

            //  }

        }

    },
    slideOutAppend:function (gid,order,realId,firstKey,isGalleryOpened,offsetLeftClickedImage,imageObject,cgCenterDiv,gidForElements) {

        var last = parseInt(order)+1;

        var FbLike = cgJsData[gid].options.general.FbLike;
        var FbLikeGallery = cgJsData[gid].options.general.FbLikeGallery;
        var AllowRating = cgJsData[gid].options.general.AllowRating;


        //  var collectedWidth = 0;
        // debugger
        // Dann letztes Bild angeklickt
        if(typeof cgJsData[gid].image[last] === 'undefined'){

            cgCenterDiv.insertAfter(imageObject);
            //  cgCenterDiv.insertAfter(cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide'));
            cgCenterDiv.css('display','table');
            //    cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');
            //  cgJsClass.gallery.views.singleView.goToLocation(gid,realId,isGalleryOpened,order,firstKey);
            //     cgJsClass.gallery.views.singleView.createImageUrl(gid,realId,isGalleryOpened);

            cgCenterDiv.find('.cg-center-image').show();
            if(FbLike>=1){
                if(FbLikeGallery>=1){
                }else{
                    cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForElements).show();
                }
            }
            if(AllowRating>=1){
                cgCenterDiv.find('#cgCenterImageRatingDiv'+gidForElements).show();
            }

        }
        else{

            var set = false;

            for(var i = parseInt(order)+1; i<=1000; i++){

                if(typeof cgJsData[gid].image[i] !== 'undefined'){

                    //  debugger
                    var firstKeyToCompare = Object.keys(cgJsData[gid].image[i])[0];

                    var categoryId = cgJsData[gid].image[i][firstKeyToCompare]['Category'];

                    if(typeof cgJsData[gid].vars.categories[categoryId] != 'undefined'){


                        if(cgJsData[gid].vars.showCategories == true && cgJsData[gid].vars.categories[categoryId]['Checked']==false){

                            //cgJsData[gid].image[index][firstKey]['imageObject'].remove();

                            return;

                        }

                    }

                    var imageObjectToCompare = cgJsData[gid].image[i][firstKeyToCompare]['imageObject'];

                    var offsetLeftToCompare = imageObjectToCompare.get(0).offsetLeft;// so ist schneller

                    if(offsetLeftToCompare <= offsetLeftClickedImage){

                        set = true;

                        cgCenterDiv.insertBefore(imageObjectToCompare);
                        cgCenterDiv.css('display','table');
                        //      cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');
                        //    cgJsClass.gallery.views.singleView.goToLocation(gid,realId,isGalleryOpened,order,firstKey);
                        //   cgJsClass.gallery.views.singleView.createImageUrl(gid,realId,isGalleryOpened);

                        cgCenterDiv.find('.cg-center-image').show();
                        if(FbLike>=1){
                            if(FbLikeGallery>=1){
                            }else{
                                cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForElements).show();
                            }
                        }
                        if(AllowRating>=1){
                            cgCenterDiv.find('#cgCenterImageRatingDiv'+gidForElements).show();
                        }

                        break;

                    }

                }

            }

            // dann wurde ein bild in der letzten reihe geklickt
            if(set==false){

                var key = Object.keys(cgJsData[gid].image[cgJsData[gid].image.length-1])[0];
                var lastImageObject = cgJsData[gid].image[cgJsData[gid].image.length-1][key]['imageObject'];

                cgCenterDiv.insertAfter(lastImageObject);
                cgCenterDiv.css('display','table');
                //     cgJsData[gid].vars.cgCenterDivAppearenceHelper.addClass('cg_hide');

                cgCenterDiv.find('.cg-center-image').show();

                if(FbLike>=1){
                    if(FbLikeGallery>=1){
                    }else{
                        cgCenterDiv.find('#cgCenterImageFbLikeDiv'+gidForElements).show();
                    }
                }

                if(AllowRating>=1){
                    cgCenterDiv.find('#cgCenterImageRatingDiv'+gidForElements).show();
                }

            }else{
                //  cgJsData[gid].vars.mainCGdiv.removeClass('cg_display_inline_block');
            }


        }

    },
    clickNextStep:function (gid) {

        var sliderView = false;

        if(cgJsData[gid].vars.currentLook=='slider'){
            sliderView = true;
        }

        if(sliderView==false){
            var $cgCenterDiv = cgJsData[gid].vars.cgCenterDiv;
            var $nextStepArrow = $cgCenterDiv.find('.cg-center-arrow-right-next-step');
            if($nextStepArrow.length>=1){
                if($nextStepArrow.hasClass('cg_center_pointer_event_none')==false){
                    $nextStepArrow.click();
                }
            }
        }

    },
    clickPrevStep:function (gid) {

        var sliderView = false;

        if(cgJsData[gid].vars.currentLook=='slider'){
            sliderView = true;
        }

        if(sliderView==false){
            var $cgCenterDiv = cgJsData[gid].vars.cgCenterDiv;
            var $prevStepArrow = $cgCenterDiv.find('.cg-center-arrow-left-prev-step');
            if($prevStepArrow.length>=1){
                if($prevStepArrow.hasClass('cg_center_pointer_event_none')==false){
                    $prevStepArrow.click();
                }
            }
        }

    },
    showCGcenterDivAfterGalleryLoad: function (gid,$mainCGallery,gidForSingleViewElements) {

        setTimeout(function () {


            var $mainCGdiv = $mainCGallery.closest('.mainCGdiv');

            $mainCGdiv.find('#cgLdsDualRingMainCGdivHide'+gid).addClass('cg_hide');
            $mainCGallery.css('visibility','visible').addClass('cg_fade_in').removeClass('cg_hidden');

            $mainCGdiv.find('.cg_gallery_thumbs_control .cg_view_switcher').removeClass('cg_disabled');
        },400);

        return;

        $mainCGdiv.find('.cg_gallery_thumbs_control .cg_view_switcher').addClass('cg_disabled');

        setTimeout(function () {

            $mainCGallery.find('.cgCenterDiv').hide();
            $mainCGallery.css('visibility','visible');
            $mainCGallery.removeClass('cg_fade_in');
            $mainCGallery.removeClass('cg_fade_in_new');
            $mainCGallery.find('.cgCenterDiv').css('min-height','unset');
            $mainCGallery.find('.cgCenterDiv').css('height','unset');
            $mainCGallery.find('.cgCenterDiv').removeClass('cg_hide_override').slideDown(function () {
                $mainCGallery.find('.cgCenterDiv').css('display','table');
                $mainCGdiv.find('.cg_gallery_thumbs_control .cg_view_switcher').removeClass('cg_disabled');
            });

        },300);

    },
    cloneCommentDiv: function (gid,realId,cgCenterDiv,imageObject,gidForElements,isForBlogView) {

        // clone append comment div
        cgCenterDiv.find('#cgCenterImageCommentsDivTitle'+gidForElements+'').empty();

        if(isForBlogView){
            var commentsDivString = cgJsClass.gallery.comment.setComment(realId,0,gid,false,false,true);
            jQuery(commentsDivString).appendTo(cgCenterDiv.find('#cgCenterImageCommentsDivTitle'+gidForElements+'')).find('.cg_gallery_comments_div').removeClass('cg_center').removeClass('cg_right');
        }else{
            imageObject.find('.cg_gallery_comments_div').clone().appendTo(cgCenterDiv.find('#cgCenterImageCommentsDivTitle'+gidForElements+'')).find('.cg_gallery_comments_div').removeClass('cg_center').removeClass('cg_right');
        }

        cgCenterDiv.find('#cgCenterImageCommentsDivTitle'+gidForElements+'').append('<hr>');
        cgCenterDiv.find('.cg_gallery_comments_div').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
        cgCenterDiv.find('.cg_gallery_comments_div .cg_gallery_comments_div_icon').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
        cgCenterDiv.find('.cg_gallery_comments_div .cg_gallery_comments_div_count').removeClass('cg_sm').removeClass('cg_xs').removeClass('cg_xxs');
        cgCenterDiv.find('.cg_gallery_comments_div_icon').addClass('cg_inside_center_div');

        if(cgJsData[gid].rateAndCommentNumbers[realId].CountC == 0){
            cgCenterDiv.find('#cgCenterImageCommentsDivTitle'+gidForElements+'').append('<span class="cg-center-image-comments-div-add-comment"></span>');
        }

        if(cgJsData[gid].rateAndCommentNumbers[realId].CountC >= 1){
            cgCenterDiv.find('.cg-center-image-comments-div-parent > .cg-center-image-comments-div-add-comment').show();
        }

    },
    showCommentsAreaOnAddCommentClick: function ($object) {

        $object.hide();

        var $cgCenterDiv = $object.closest('.cgCenterDiv');
        var gid = $cgCenterDiv.attr('data-cg-gid');

        if(cgJsData[gid].vars.isUserGallery){
            $cgCenterDiv.find('.cg-center-image-comments-div-enter').empty().append(jQuery('<p class="cg-center-image-comments-div-enter-you-can-not-comment-in-own-gallery">'+cgJsClass.gallery.language.YouCanNotCommentInOwnGallery+'</p>')).show();
        }else{
            $cgCenterDiv.find('.cg-center-image-comments-div-parent').find('.cg-center-image-comments-div-enter').slideDown();
        }

    }
};