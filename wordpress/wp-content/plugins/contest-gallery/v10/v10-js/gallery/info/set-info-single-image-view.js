cgJsClass.gallery.info.checkInfoSingleImageView = function (realId,gid,order,isBlogView,gidForElements) {

  //  setTimeout(function () {
        if(typeof cgJsData[gid].vars.info[realId]=='undefined'){
            cgJsClass.gallery.info.getInfo(realId,gid,true,order,false,false,gidForElements);
        }
        else{
            cgJsClass.gallery.views.setInfoSingleImageView(realId,gid,order,gidForElements);
        }
  //  },500);

};
cgJsClass.gallery.views.setInfoSingleImageView = function (realId,gid,infoCatched,gidForElements) {

    var $cgCenterInfoDiv = cgJsData[gid].vars.mainCGdiv.find('#cgCenterDiv'+gidForElements);

    $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).addClass('cg_hide');
    $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).empty();
    $cgCenterInfoDiv.find('#cgCenterImageInfoDivTitle'+gidForElements).addClass('cg_hide');

    var append = false;
    var thereIsImageInfo = false;

    if(typeof cgJsData[gid].vars.info[realId]=='undefined' && infoCatched!==true){

        cgJsClass.gallery.info.getInfo(realId,gid,true);
        return;

    }

    var data = cgJsData[gid].vars.info[realId];

    // then edit info icon can disappear for this image if user gallery and no info to edit
    if(!cgJsData[gid].vars.isUserGalleryAndHasFieldsToEdit){
        $cgCenterInfoDiv.find('#cgCenterImageInfoEditIcon'+gid).addClass('cg_hide');
    }else{
        $cgCenterInfoDiv.find('#cgCenterImageInfoEditIcon'+gid).removeClass('cg_hide');
    }

    for(var index in cgJsData[gid].singleViewOrder){

        if(!cgJsData[gid].singleViewOrder.hasOwnProperty(index)){
            break;
        }

        cgJsData[gid].singleViewOrder[index].append = null;

    }

    // data[realId] ist wie ein array aufgebaut
    for(var i in data){

        if(!data.hasOwnProperty(i)){
            break;
        }

        var fieldId = i;

        if(data[i]['field-content'] != ''){

            if(cgJsData[gid].forms.upload.hasOwnProperty(i)){
                if(cgJsData[gid].forms.upload[i].Show_Slider==1){

                    thereIsImageInfo = true;
                    cgJsClass.gallery.vars.thereIsImageInfo = true;

                    if(append == false){
                        //  jQuery('#cgCenterImageInfoDiv'+gid).removeClass('cg_hide');
                        //    jQuery('#cgCenterImageInfoDivTitle'+gid).removeClass('cg_hide');
                        append = true;
                    }

                    var title = data[i]['field-title'];
                    var content = data[i]['field-content'];

                    if(data[i]['field-type']=='url-f'){
                        if(content.indexOf('http')==-1){
                            content = 'http://'+content;
                        }
                        var $infoContent = jQuery('<div class="cg-center-image-info-div"><p><a href="'+content+'" target="_blank">'+title+'</a></p></div>');
                    }else{
                        var $infoContent = jQuery('<div class="cg-center-image-info-div"><p>'+title+':</p><p class="cg-center-image-info-div-content">'+content+'</p></div>');
                    }

                    for(var index in cgJsData[gid].singleViewOrder){

                        if(!cgJsData[gid].singleViewOrder.hasOwnProperty(index)){
                            break;
                        }

                        if(cgJsData[gid].singleViewOrder[index].id==fieldId){
                            cgJsData[gid].singleViewOrder[index].append = $infoContent.attr('data-cg-single-view-order',index);
                        }

                    }

                }

            }

        }

    }

    var Category = cgJsData[gid].vars.rawData[realId]['Category'];
    var categoryContentToAppear = '';

    if(((Category>0 && cgJsData[gid].vars.showCategories==true) || (cgJsData[gid].vars.showCategories==true && Category==0)) && (cgJsData[gid].vars.categoriesUploadFormField_Show_Slider == 1)){
        var title = cgJsData[gid].vars.categoriesUploadFormTitle;
        if(Category>0){
            var content = cgJsData[gid].vars.categories[Category].Name;
        }else{
            var content = cgJsClass.gallery.language.Other;
        }
        categoryContentToAppear = content;
        var $infoContent = jQuery('<div class="cg-center-image-info-div"><p>'+title+':</p><p class="cg-center-image-info-div-content">'+content+'</p></div>');
        // jQuery('#cgCenterImageInfoDiv'+gid).append(jQuery(infoContent));

        for(var index in cgJsData[gid].singleViewOrder){

            if(!cgJsData[gid].singleViewOrder.hasOwnProperty(index)){
                break;
            }
            if(cgJsData[gid].singleViewOrder[index].id==cgJsData[gid].vars.categoriesUploadFormId){
                cgJsData[gid].singleViewOrder[index].append = $infoContent.attr('data-cg-single-view-order',index);
                append = true;
            }

        }
    }

    if(append==true){

        for(var index in cgJsData[gid].singleViewOrder){
            if(!cgJsData[gid].singleViewOrder.hasOwnProperty(index)){
                break;
            }
            if(cgJsData[gid].singleViewOrder[index].append!=null){
                $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).append(jQuery(cgJsData[gid].singleViewOrder[index].append));
            }
        }

        if(cgJsData[gid].vars.translateX){
            $cgCenterInfoDiv.find('#cgCenterImageInfoDivTitle'+gidForElements).removeClass('cg_hide');
        }else{
            $cgCenterInfoDiv.find('#cgCenterImageInfoDivTitle'+gidForElements).removeClass('cg_hide');
        }

        // old logic 2019 03 09
        /*        jQuery('#cgCenterImageInfoDiv'+gid).hide().removeClass('cg_hide').slideDown().add(
                    setTimeout(function () {
                        jQuery('#cgCenterDiv'+gid).height('auto');
                    },400)
                );*/
        $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).removeClass('cg_hide');
    }

    if(cgJsData[gid].vars.isUserGallery && cgJsData[gid].vars.isUserGalleryAndHasFieldsToEdit){
        $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).empty();
        for(var fieldOrder in cgJsData[gid].forms.uploadUserEditFieldsSortedByFieldOrder){
            if(!cgJsData[gid].forms.uploadUserEditFieldsSortedByFieldOrder.hasOwnProperty(fieldOrder)){
                break;
            }

            var fieldId = cgJsData[gid].forms.uploadUserEditFieldsSortedByFieldOrder[fieldOrder]['fieldId'];
            var Field_Type = cgJsData[gid].forms.uploadUserEditFieldsSortedByFieldOrder[fieldOrder]['Field_Type'];
            var $infoContent = jQuery('<div class="cg-center-image-info-div"><p>'+cgJsData[gid].forms.uploadUserEditFieldsSortedByFieldOrder[fieldOrder].Field_Content.titel+':</p></div>');

            if(Field_Type=='selectc-f'){
                if(categoryContentToAppear){
                    $infoContent.append('<p class="cg-center-image-info-div-content">'+categoryContentToAppear+'</p>');
                }else{
                    $infoContent.append('<p class="cg-center-image-info-div-content">...</p>');
                }
            }else{
                if(cgJsData[gid].vars.info[realId]){
                    if(cgJsData[gid].vars.info[realId][fieldId]){
                        if(cgJsData[gid].vars.info[realId][fieldId]['field-content']){
                            $infoContent.append('<p class="cg-center-image-info-div-content">'+cgJsData[gid].vars.info[realId][fieldId]['field-content']+'</p>');
                        }else{
                            $infoContent.append('<p class="cg-center-image-info-div-content">...</p>');
                        }
                    }else{
                        $infoContent.append('<p class="cg-center-image-info-div-content">...</p>');
                    }
                }else{
                    $infoContent.append('<p class="cg-center-image-info-div-content">...</p>');
                }
            }



            $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).append($infoContent);
            $cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).removeClass('cg_hide');
        }
    }

    if(thereIsImageInfo==true){
        cgJsClass.gallery.views.checkIfTopBottomArrowsRequired(gid,gidForElements);
    }

    //  jQuery('#cgCenterDiv'+gid).height('auto');

    if($cgCenterInfoDiv.find('#cgCenterImageInfoDiv'+gidForElements).find('.cg-center-image-info-div').length){
        $cgCenterInfoDiv.find('#cgCenterImageInfoDivParent'+gidForElements).removeClass('cgCenterImageNoInfo');
        $cgCenterInfoDiv.find('#cgCenterImageCommentsDivParent'+gidForElements).removeClass('cgCenterImageNoInfo');
    }else{
        $cgCenterInfoDiv.find('#cgCenterImageInfoDivParent'+gidForElements).addClass('cgCenterImageNoInfo');
        $cgCenterInfoDiv.find('#cgCenterImageCommentsDivParent'+gidForElements).addClass('cgCenterImageNoInfo');
    }

};
cgJsClass.gallery.views.checkIfTopBottomArrowsRequired = function (gid,gidForElements) {

    var $cgCenterInfoDiv = cgJsData[gid].vars.mainCGdiv.find('#cgCenterDiv'+gidForElements);

    // falls diese funktion angwendet dann werden komments definitiv angzeigt und der separator kann auch angezeigt werden
    $cgCenterInfoDiv.find('.cg-center-image-info-info-separator').removeClass('cg_hide');

    setTimeout(function () {

        var collectedHeight = 0;

        $cgCenterInfoDiv.find('.cg-center-image-info-div').each(function () {
            // +10 because of margin bottom 10px
            collectedHeight = collectedHeight + jQuery(this).height()+10;+ jQuery(this).height();

        });

      //  var heightCheck = $cgCenterInfoDiv.find('.cg-center-image-info-div-parent').height();

        var noSlideOut = false;

        if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1){
            noSlideOut = true;
        }

        // max-height 500px, if there is padding, padding has also to be added
        if(collectedHeight>=500){
            $cgCenterInfoDiv.find('.cg-center-image-info-div-parent-parent .cg-top-bottom-arrow').removeClass('cg_hide');
            if(noSlideOut==false){
                $cgCenterInfoDiv.find('.cg-center-image-info-div-parent-parent .cg-top-bottom-arrow:first-child').addClass('cg_no_scroll');
            }
            $cgCenterInfoDiv.find('.cg-center-image-info-div-parent-parent .cg-top-bottom-arrow:last-child').removeClass('cg_no_scroll');
            $cgCenterInfoDiv.find('.cg-center-image-info-div-container').addClass('cg-center-image-info-div-parent-padding');
        }

    },300)

};