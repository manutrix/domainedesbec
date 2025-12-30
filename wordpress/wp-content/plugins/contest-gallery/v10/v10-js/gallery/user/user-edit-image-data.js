cgJsClass.gallery.user.editImageDataProcess = function($saveImageDataButton){
    var $cgCenterDiv = $saveImageDataButton.closest('.cgCenterDiv');
    var gid = $cgCenterDiv.attr('data-cg-gid');
    var realId = $cgCenterDiv.attr('data-cg-real-id');

    var cgFieldIdsContent = {};
    var cgFieldIdsObjectToSafeForSearch = {};
    cgFieldIdsObjectToSafeForSearch[realId] = {};

    $cgCenterDiv.find('.cg-field-id-input-content').each(function (){
        cgFieldIdsContent[jQuery(this).attr('data-cg-input-field-id')] = jQuery(this).val();
        cgFieldIdsObjectToSafeForSearch[realId]['field-title'] = jQuery(this).attr('data-cg-input-field-title');
        cgFieldIdsObjectToSafeForSearch[realId]['field-content'] = jQuery(this).val();
        cgFieldIdsObjectToSafeForSearch[realId]['field-type'] = jQuery(this).attr('data-cg-input-field-type');
    });

    //console.log(cgFieldIdsContent);
    var cgCatId = null;
    if($cgCenterDiv.find('.cg-cat-id-input-content').length){
        cgCatId = $cgCenterDiv.find('.cg-cat-id-input-content').val();
    }

    var $cgMessagesContainer = cgJsClass.gallery.function.message.show(false,false,false,false,false,true);

    cgJsClass.gallery.vars.dom.body.addClass('cg_pointer_events_none');

    cgJsClass.gallery.user.isEventinProcess = true;

    jQuery.ajax({
        url: post_cg_gallery_user_edit_image_data_wordpress_ajax_script_function_name.cg_gallery_user_edit_image_data_ajax_url,
        method: 'post',
        data : {
            action : 'post_cg_gallery_user_edit_image_data',
            gid : cgJsData[gid].vars.gidReal,
            galeryIDuser : gid,
            uid : cgJsClass.gallery.vars.wpUserId,
            pid : realId,
            galleryHash : cgJsData[gid].vars.galleryHash,
            'cg-field-id' : cgFieldIdsContent,
            'cg-cat-id' : cgCatId
        }
    }).done(function(response) {

        setTimeout(function (){

            cgJsClass.gallery.user.isEventinProcess = false;

            $cgMessagesContainer.find('#cgMessagesClose').removeClass('cg_hide');
            $cgMessagesContainer.removeClass('cg-lds-dual-ring-star-loading');

            var parser = new DOMParser();
            var parsedHtml = parser.parseFromString(response, 'text/html');
            var script = jQuery(parsedHtml).find('script[data-cg-processing="true"]').first().html();
            eval(script);

            cgJsClass.gallery.vars.dom.body.removeClass('cg_pointer_events_none');

            // has to be done here that can be done again
            cgJsData[gid].infoGalleryViewAppended[realId] = undefined;

            // set new info for search here
            cgJsData[gid].vars.rawData[realId]['Category'] = cgCatId;

            cgJsClass.gallery.info.collectInfo(gid,realId,cgFieldIdsObjectToSafeForSearch);

            // has to be done this way, do not use cgCenterDiv.find('.cg-center-image-info-edit-icon').click();
            cgJsClass.gallery.views.singleViewFunctions.editCloseInfoUserGallery($cgCenterDiv);

        },1500);

    }).fail(function(xhr, status, error) {

        // have to be done before message container actions!!!! Because of click body event.
        $cgCenterDiv.find('.cg-center-image-info-edit-icon-container').click();

        cgJsClass.gallery.vars.dom.body.removeClass('cg_body_overflow_hidden');
        cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll cg_body_overflow_hidden');

        $cgMessagesContainer.find('#cgMessagesClose').removeClass('cg_hide');
        $cgMessagesContainer.removeClass('cg-lds-dual-ring-star-loading');

        cgJsClass.gallery.function.message.show('Something went wrong during saving image data, please contact adminstrator');

    }).always(function() {

    });

};
