cgJsClass.gallery.user.events = function($){

    $(document).on('click','.cg_delete_user_image',function (e) {
        e.preventDefault();
        cgJsClass.gallery.user.deleteImageConfirmShow($(this));
    });

};

cgJsClass.gallery.user.isEventinProcess = false;
