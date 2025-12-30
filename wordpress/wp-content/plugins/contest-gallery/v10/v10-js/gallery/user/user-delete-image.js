cgJsClass.gallery.user.deleteImageConfirmShow = function($deleteButton){

    cgJsClass.gallery.function.message.show(cgJsClass.gallery.language.DeleteImageQuestion,true,'cgJsClass.gallery.user.deleteImageConfirmProcess',[$deleteButton.attr('data-cg-gid'),$deleteButton.attr('data-cg-image-id')],$deleteButton);

};
cgJsClass.gallery.user.deleteImageConfirmProcess = function($deleteImageConfirmButton){

    var gid = $deleteImageConfirmButton.attr('data-cg-gid');
    var imageId = $deleteImageConfirmButton.attr('data-cg-image-id');

    /*var $cgMessagesContainer = jQuery('#cgMessagesContainer');
    $cgMessagesContainer.height($cgMessagesContainer.height());
    $cgMessagesContainer.find('#cgMessagesClose, #cgMessagesContent').addClass('cg_hide');
    $cgMessagesContainer.find('#cgMessagesConfirm').remove();
    $cgMessagesContainer.append(jQuery(cgJsClass.gallery.function.message.loaderTemplate));
    $cgMessagesContainer.css('display','flex');*/

    var $cgMessagesContainer = cgJsClass.gallery.function.message.show(false,false,false,false,false,true);

    cgJsClass.gallery.user.isEventinProcess = true;

    jQuery.ajax({
        url: post_cg_gallery_user_delete_image_wordpress_ajax_script_function_name.cg_gallery_user_delete_image_ajax_url,
        method: 'post',
        data : {
            action : 'post_cg_gallery_user_delete_image',
            gid : cgJsData[gid].vars.gidReal,
            galeryIDuser : gid,
            uid : cgJsClass.gallery.vars.wpUserId,
            pid : imageId,
            galleryHash : cgJsData[gid].vars.galleryHash
        }
    }).done(function(response) {

        cgJsClass.gallery.user.isEventinProcess = false;

        $cgMessagesContainer.find('#cgMessagesClose').removeClass('cg_hide');
        $cgMessagesContainer.removeClass('cg-lds-dual-ring-star-loading');

        cgJsData[gid].vars.UploadedFilesAmountTotal = parseInt(cgJsData[gid].vars.UploadedFilesAmountTotal)-1;
        jQuery('#cg_upload_form_container[data-cg-gid="'+cgJsData[gid].vars.gidReal+'"]').find('#cgRegUserMaxUploadCount').val(cgJsData[gid].vars.UploadedFilesAmountTotal);// for gallery form normal
        jQuery('#cgRegUserMaxUploadCountInGallery'+gid).val(cgJsData[gid].vars.UploadedFilesAmountTotal); // for in gallery form

        var parser = new DOMParser();
        var parsedHtml = parser.parseFromString(response, 'text/html');
        var script = jQuery(parsedHtml).find('script[data-cg-processing="true"]').first().html();

        eval(script);

    }).fail(function(xhr, status, error) {

        $cgMessagesContainer.find('#cgMessagesClose').removeClass('cg_hide');
        $cgMessagesContainer.removeClass('cg-lds-dual-ring-star-loading');

        cgJsClass.gallery.function.message.show('Something went wrong, please contact adminstrator');
        jQuery('#cg_show'+imageId).removeClass('cg_opacity_0_3');

    }).always(function() {

    });

};
