cgJsClass.gallery.info.setInfoGalleryView = function (realId, gid, isJustChangeTextAfterEdit,$imageObject,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad) {

    if (typeof cgJsData[gid].infoGalleryViewAppended[realId] == 'undefined' && typeof cgJsData[gid].imageObject[realId] != 'undefined') {

        var inputFieldId = cgJsData[gid].options.visual['Field1IdGalleryView'];
        var infoData = cgJsData[gid].vars.info[realId];

        var hideTillHover = '';

        if (cgJsData[gid].options.general.ShowAlways != 1) {

            hideTillHover = 'cg_hide_till_hover';

        }

        var position = 'class="cg_gallery_info_content"';

        if (cgJsData[gid].options.visual['TitlePositionGallery'] == 2) {
            position = 'class="cg_gallery_info_content cg_center"';
        }

        if (cgJsData[gid].options.visual['TitlePositionGallery'] == 3) {
            position = 'class="cg_gallery_info_content cg_right"';
        }


        if (cgJsData[gid].options.visual['Field1IdGalleryView'] == cgJsData[gid].vars.categoriesUploadFormId) {

            var infoTitleDiv = cgJsData[gid].imageObject[realId].find('.cg_gallery_info_title');
            if(!infoTitleDiv.length){
                infoTitleDiv = jQuery('<div data-cg-id="' + realId + '" data-cg-gid="' + gid + '" class="cg_gallery_info_title ' + hideTillHover + '"></div>');
            }

            var categoryId = cgJsData[gid].vars.rawData[realId]['Category'];

            if (categoryId > 0) {
                var content = cgJsData[gid].vars.categories[categoryId].Name;
            } else {
                var content = cgJsClass.gallery.language.Other;
            }

            if(isJustChangeTextAfterEdit){
                if(cgJsData[gid].imageObject[realId]){
                    if(cgJsData[gid].imageObject[realId].find('.cg_gallery_info_content').length){
                        cgJsData[gid].imageObject[realId].find('.cg_gallery_info_content').empty().text(content);
                    }else{
                        cgJsData[gid].imageObject[realId].find('.cg_gallery_info_title').removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + '>'+content+'</div>');
                    }
                }
                return;
            }else{
                if(!cgJsData[gid].imageObject[realId].find('.cg_gallery_info_content').length){
                    infoTitleDiv.removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + '>' + content + '</div>');
                }
            }

            if(cgJsData[gid].vars.isUserGallery){
                infoTitleDiv.addClass('cg_is_user_gallery');
            }

            var cgShowObject = cgJsData[gid].imageObject[realId];

            if(cgJsData[gid].vars.modernHover){
                cgJsClass.gallery.function.general.tools.setHeightForInfoBlockInGallery(gid,infoTitleDiv,$imageObject,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad,true);
                //cgShowObject.find('.cg_gallery_info').prepend(infoTitleDiv);
            }else{
                cgShowObject.find('figure').append(infoTitleDiv);
            }

            cgJsData[gid].infoGalleryViewAppended[realId] = true;

            return;
        }

        if (infoData) {
            if (infoData.hasOwnProperty(inputFieldId)) {

                var infoTitleDiv = cgJsData[gid].imageObject[realId].find('.cg_gallery_info_title');
                if(!infoTitleDiv.length){
                    infoTitleDiv = jQuery('<div data-cg-id="' + realId + '" data-cg-gid="' + gid + '" class="cg_gallery_info_title ' + hideTillHover + '"></div>');
                }
                infoTitleDiv.removeClass('cg_gallery_info_title_no_title');

                var content = infoData[inputFieldId]['field-content'];
                var position = 'class="cg_gallery_info_content"';

                if (cgJsData[gid].options.visual['TitlePositionGallery'] == 2) {
                    position = 'class="cg_gallery_info_content cg_center"';
                }

                if (cgJsData[gid].options.visual['TitlePositionGallery'] == 3) {
                    position = 'class="cg_gallery_info_content cg_right"';
                }

                if(isJustChangeTextAfterEdit){
                    if(cgJsData[gid].imageObject[realId]){
                        if(infoData[inputFieldId]['field-type'] == 'url-f'){
                            cgJsData[gid].imageObject[realId].find('.cg_gallery_info_href').attr('href',content);
                        }else{
                            if(cgJsData[gid].imageObject[realId].find('.cg_gallery_info_content').length){
                                cgJsData[gid].imageObject[realId].find('.cg_gallery_info_content').empty().text(content);
                            }else{
                                cgJsData[gid].imageObject[realId].find('.cg_gallery_info_title').removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + '>'+content+'</div>');
                            }
                        }
                    }
                    return;
                }

                if (infoData[inputFieldId]['field-content'] != '') {
                    if(infoData[inputFieldId]['field-type'] == 'url-f'){

                        if(infoData[inputFieldId]['field-content'].indexOf('http')==-1){
                            infoData[inputFieldId]['field-content'] = 'http://'+infoData[inputFieldId]['field-content'].trim();
                        }
                        infoTitleDiv.removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + '><a class="cg_gallery_info_href" href="' + infoData[inputFieldId]['field-content'] + '" target="_href">' + infoData[inputFieldId]['field-title'].trim() + '</a></div>');

                    }else{
                        infoTitleDiv.removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + '>' + content + '</div>');
                    }
                }else{// set empty div for right look espcially user gallery where images can be deleted
                    if(!cgJsData[gid].vars.isUserGallery){
                        infoTitleDiv.removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + ' style="height:0;padding:0;"></div>');
                        infoTitleDiv.css({
                            'height':0,
                            'padding':0
                        });
                    }
                    if(cgJsData[gid].vars.isUserGallery){
                        infoTitleDiv.removeClass('cg_gallery_info_title_no_title').prepend('<div ' + position + '></div>');
                    }
                }

                if(cgJsData[gid].vars.isUserGallery){
                    infoTitleDiv.addClass('cg_is_user_gallery');
                }

                var cgShowObject = cgJsData[gid].imageObject[realId];

                //cgJsClass.gallery.function.general.tools.setHeightForInfoBlockInGallery(gid,infoTitleDiv,$imageObject,heightFromImageObjectSetInViewLoad);

                if(cgJsData[gid].vars.modernHover){
                    cgJsClass.gallery.function.general.tools.setHeightForInfoBlockInGallery(gid,infoTitleDiv,$imageObject,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad,true);
                    //cgShowObject.find('.cg_gallery_info').prepend(infoTitleDiv);
                }else{
                    cgShowObject.find('figure').append(infoTitleDiv);
                }
                cgJsData[gid].infoGalleryViewAppended[realId] = true;


                return;

            } else{
                    cgJsClass.gallery.function.general.tools.checkIfSmallWidthImageObject(gid,$imageObject,null,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad);
            }
        }else{
                cgJsClass.gallery.function.general.tools.checkIfSmallWidthImageObject(gid,$imageObject,null,heightFromImageObjectSetInViewLoad,widthFromImageObjectSetInViewLoad)
        }

    }


};