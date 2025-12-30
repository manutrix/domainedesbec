cgJsClass.gallery.function.message.init = function (){

    cgJsClass.gallery.function.message.clickConfirm();
    cgJsClass.gallery.function.message.clickClose();

};
cgJsClass.gallery.function.message.show = function (message,isShowConfirm,functionToProcess,processArguments,$clickedButton,isJustAddLoadingClass){

  //  if(cgJsClass.gallery.vars.fullwindow){
   //     var $cgMessagesContainer = jQuery('#mainCGdiv'+cgJsClass.gallery.vars.fullwindow).find('#cgMessagesContainer');
  //      $cgMessagesContainer.addClass('cg_hide');
    //}else{
    var $cgMessagesContainer = cgJsClass.gallery.vars.cgMessagesContainer;
   // }

    var $cgMessagesContent = $cgMessagesContainer.find('#cgMessagesContent');
    $cgMessagesContainer.css('height','unset');

    if(isJustAddLoadingClass){
        cgJsClass.gallery.function.message.resize();

        cgJsClass.gallery.function.general.tools.backdropShow();

        cgJsClass.gallery.function.message.containerDisplay($cgMessagesContainer);

        $cgMessagesContainer.removeClass('cg_confirm');
        $cgMessagesContainer.find('#cgMessagesClose').addClass('cg_hide');
        $cgMessagesContainer.find('#cgMessagesContent').empty();
        $cgMessagesContainer.find('#cgMessagesConfirm').remove();
        $cgMessagesContainer.addClass('cg-lds-dual-ring-star-loading');

        return $cgMessagesContainer;
    }

    if(isShowConfirm){
        $cgMessagesContainer.find('#cgMessagesContent').css({
            'display': 'table-cell',// required to position center user asking message
            'padding-top': '15px'
        });
    }else{
        $cgMessagesContainer.find('#cgMessagesContent').css({
            'display': 'block',// required to position center user asking message
            'padding-top': '7px'
        });
    }

    // values will be reseted this way
    if(cgJsClass.gallery.user.isEventinProcess){
        $cgMessagesContainer.find('.cg-lds-dual-ring-div-gallery-hide').remove();
        $cgMessagesContainer.removeClass('cg_confirm');
        $cgMessagesContainer.find('#cgMessagesClose, #cgMessagesContent').removeClass('cg_hide');
        $cgMessagesContent.html(message);
        cgJsClass.gallery.user.isEventinProcess = false;
        return;
    }else{
        $cgMessagesContainer.find('#cgMessagesContent').removeAttr('style');// set to normal becaus user question maybe changed it
    }

    jQuery('body').addClass('cg_message_opened');

    if(message=="" || message==0 || message==null){
        message='';
    }

    cgJsClass.gallery.function.message.resize();

    $cgMessagesContainer.find('#cgMessagesConfirm').remove();
    $cgMessagesContent.html(message);

    if(isShowConfirm){
        $cgMessagesContainer.addClass('cg_confirm');
        if($cgMessagesContainer.find('#cgMessagesConfirm').length){
            $cgMessagesContainer.find('#cgMessagesConfirm').remove();
        }
        $cgMessagesContainer.append('<span id="cgMessagesConfirm">' +
                '<span class="cg_messages_confirm_answer cg_messages_confirm_answer_yes" data-cg-gid="'+$clickedButton.attr('data-cg-gid')+'" data-cg-image-id="'+$clickedButton.attr('data-cg-image-id')+'" data-function-to-process="'+functionToProcess+'">'+cgJsClass.gallery.language.Yes+'</span>' +
                '<span class="cg_messages_confirm_answer cg_messages_confirm_answer_no">'+cgJsClass.gallery.language.No+'</span></span>');
        //$cgMessagesContainer.find('.cg_messages_confirm_answer_yes').data('processArguments',processArguments);
        $clickedButton.closest('.cg_show').addClass('cg_opacity_0_3');
    }

    /*    if(cgJsClass.gallery.vars.fullwindow){
            $cgMessagesContainer.removeClass('cg_hide');
        }*/

    cgJsClass.gallery.vars.messageContainerShown=true;

    // IMPORTANT! can be initiated again and again because bodyclick listener will be removed after close
    cgJsClass.gallery.function.message.addCloseMessageFrameOnBodyClick();

    cgJsClass.gallery.function.general.tools.backdropShow();

    cgJsClass.gallery.function.message.containerDisplay($cgMessagesContainer);


};
cgJsClass.gallery.function.message.containerDisplay = function ($cgMessagesContainer){

    if (cgJsClass.gallery.vars.fullscreen) {
        cgJsData[cgJsClass.gallery.vars.fullscreen].vars.mainCGdiv.prepend($cgMessagesContainer);
    }else{
        cgJsClass.gallery.vars.dom.body.prepend($cgMessagesContainer);
    }

    $cgMessagesContainer.removeClass('cg_messages_container_fade_in');
    $cgMessagesContainer.removeClass('cg_hide');

    setTimeout(function (){
        $cgMessagesContainer.addClass('cg_messages_container_fade_in');
    },1);

}
// for example if VotesPerUserAllVotesUsedHtmlMessage should be displayed
cgJsClass.gallery.function.message.showPro = function (message,isShowConfirm,functionToProcess,processArguments,$clickedButton,isJustAddLoadingClass){

  //  if(cgJsClass.gallery.vars.fullwindow){
   //     var $cgMessagesContainer = jQuery('#mainCGdiv'+cgJsClass.gallery.vars.fullwindow).find('#cgMessagesContainer');
  //      $cgMessagesContainer.addClass('cg_hide');
    //}else{
    var $cgMessagesContainer = cgJsClass.gallery.vars.cgMessagesContainerPro;
    cgJsClass.gallery.vars.cgMessagesContainerProIsVisible = true;

   // }

    var $cgMessagesContent = $cgMessagesContainer.find('#cgMessagesContent');
    $cgMessagesContainer.css('height','unset');

    if(isJustAddLoadingClass){
        cgJsClass.gallery.function.message.resize(true);
        cgJsClass.gallery.function.general.tools.backdropShow();
        cgJsClass.gallery.function.message.containerDisplay($cgMessagesContainer);
        $cgMessagesContainer.removeClass('cg_confirm');
        $cgMessagesContainer.find('#cgMessagesClose').addClass('cg_hide');
        $cgMessagesContainer.find('#cgMessagesContent').empty();
        $cgMessagesContainer.find('#cgMessagesConfirm').remove();
        $cgMessagesContainer.addClass('cg-lds-dual-ring-star-loading');

        return $cgMessagesContainer;
    }

    if(isShowConfirm){
        $cgMessagesContainer.find('#cgMessagesContent').css({
            'display': 'table-cell',// required to position center user asking message
            'padding-top': '15px'
        });
    }else{
        $cgMessagesContainer.find('#cgMessagesContent').css({
            'display': 'block',// required to position center user asking message
            'padding-top': '7px'
        });
    }

    // values will be reseted this way
    if(cgJsClass.gallery.user.isEventinProcess){
        $cgMessagesContainer.find('.cg-lds-dual-ring-div-gallery-hide').remove();
        $cgMessagesContainer.removeClass('cg_confirm');
        $cgMessagesContainer.find('#cgMessagesClose, #cgMessagesContent').removeClass('cg_hide');
        $cgMessagesContent.html(message);
        cgJsClass.gallery.user.isEventinProcess = false;
        return;
    }else{
        $cgMessagesContainer.find('#cgMessagesContent').removeAttr('style');// set to normal becaus user question maybe changed it
    }

    jQuery('body').addClass('cg_message_opened');

    if(message=="" || message==0 || message==null){
        message='';
    }

    cgJsClass.gallery.function.message.resize(true);

    $cgMessagesContainer.find('#cgMessagesConfirm').remove();
    $cgMessagesContent.html(message);

    if(isShowConfirm){
        $cgMessagesContainer.addClass('cg_confirm');
        if($cgMessagesContainer.find('#cgMessagesConfirm').length){
            $cgMessagesContainer.find('#cgMessagesConfirm').remove();
        }
        $cgMessagesContainer.append('<span id="cgMessagesConfirm">' +
                '<span class="cg_messages_confirm_answer cg_messages_confirm_answer_yes" data-cg-gid="'+$clickedButton.attr('data-cg-gid')+'" data-cg-image-id="'+$clickedButton.attr('data-cg-image-id')+'" data-function-to-process="'+functionToProcess+'">'+cgJsClass.gallery.language.Yes+'</span>' +
                '<span class="cg_messages_confirm_answer cg_messages_confirm_answer_no">'+cgJsClass.gallery.language.No+'</span></span>');
        //$cgMessagesContainer.find('.cg_messages_confirm_answer_yes').data('processArguments',processArguments);
        $clickedButton.closest('.cg_show').addClass('cg_opacity_0_3');
    }

    /*    if(cgJsClass.gallery.vars.fullwindow){
            $cgMessagesContainer.removeClass('cg_hide');
        }*/

    cgJsClass.gallery.vars.messageContainerShown=true;

    // IMPORTANT! can be initiated again and again because bodyclick listener will be removed after close
    cgJsClass.gallery.function.message.addCloseMessageFrameOnBodyClick();

    cgJsClass.gallery.function.general.tools.backdropShow();
    cgJsClass.gallery.function.message.containerDisplay($cgMessagesContainer);

};
cgJsClass.gallery.function.message.loaderTemplate = '<div class="cg-lds-dual-ring-div-gallery-hide"><div class="cg-lds-dual-ring-gallery-hide"></div></div>';
cgJsClass.gallery.function.message.clickConfirm = function(){

    jQuery(document).on('click','.cg_messages_container .cg_messages_confirm_answer_yes',function (e) {

        var $element = jQuery(this);
        var functionsArray = $element.attr('data-function-to-process').split('.');

        var fullLiteralFunctionObjectPath = window;

        var fullLiteralFunctionObjectPathFirstFromNameSpaceToDeleteLater;
        functionsArray.forEach(function(functionName){
            fullLiteralFunctionObjectPath = fullLiteralFunctionObjectPath[functionName]
            if(!fullLiteralFunctionObjectPathFirstFromNameSpaceToDeleteLater){
                fullLiteralFunctionObjectPathFirstFromNameSpaceToDeleteLater = functionName;
            }
        });

        fullLiteralFunctionObjectPath.call(null,$element);

        return false;

    });

    jQuery(document).on('click','.cg_messages_container .cg_messages_confirm_answer_no',function (e) {

        cgJsClass.gallery.function.message.close();
        return false;

    });

};
cgJsClass.gallery.function.message.addCloseMessageFrameOnBodyClick = function(){

    jQuery('body.cg_message_opened').on('click',function (e) {

        if(cgJsClass.gallery.user.isEventinProcess){
            return;
        }

        // can return because other events are responsible for this
        if(jQuery(e.target).closest('#cgMessagesContainer').length==1){
            return;
        }

        // can return because other events are responsible for this
        if(jQuery(e.target).closest('#cgMessagesContainerPro').length==1 || cgJsClass.gallery.vars.cgMessagesContainerProIsVisible){
            return;
        }

        cgJsClass.gallery.function.message.close();

        return false;

    });

};
cgJsClass.gallery.function.message.clickCloseInitieted = false;
cgJsClass.gallery.function.message.clickClose = function (){
    if(!cgJsClass.gallery.function.message.clickCloseInitieted){

        cgJsClass.gallery.function.message.clickCloseInitieted = true;

        jQuery(document).on('click','.cg_messages_container',function(e){
            if(cgJsClass.gallery.user.isEventinProcess){
                return;
            }
            if(jQuery(this).find('.cg_messages_confirm_answer').length>=1){
                return;
            }
            cgJsClass.gallery.function.message.close();
        });

        jQuery(document).on('click','.cg_messages_container',function(e){
            if(cgJsClass.gallery.user.isEventinProcess){
                return;
            }
            cgJsClass.gallery.function.message.close();
        });

        jQuery(document).on('click','#cgMessagesCloseProContainer',function(e){
            cgJsClass.gallery.vars.cgMessagesContainerPro.addClass('cg_hide');
            cgJsClass.gallery.vars.cgMessagesContainerProIsVisible = false;
            cgJsClass.gallery.function.general.tools.backdropHide();

        });

    }

};
cgJsClass.gallery.function.message.close = function (){

    var $cgMessagesContainer = jQuery('.cg_messages_container');
    var $cg_messages_confirm_answer_yes = $cgMessagesContainer.find('.cg_messages_confirm_answer_yes');

    if($cg_messages_confirm_answer_yes.length){
        var imageId = $cg_messages_confirm_answer_yes.attr('data-cg-image-id');
        var gid = $cg_messages_confirm_answer_yes.attr('data-cg-gid');
        jQuery('#mainCGallery'+gid).find('#cg_show'+imageId).removeClass('cg_opacity_0_3');
    }

    $cgMessagesContainer.addClass('cg_hide').removeAttr('style').removeClass('cg_confirm');
    $cgMessagesContainer.find('#cgMessagesContent').empty();
    $cgMessagesContainer.find('#cgMessagesConfirm').remove();
    $cgMessagesContainer.find('.cg-lds-dual-ring-div-gallery-hide').remove();
    $cgMessagesContainer.find('#cgMessagesClose, #cgMessagesContent').removeClass('cg_hide');
    $cgMessagesContainer.find('#cgMessagesContent').removeAttr('style');
    cgJsClass.gallery.vars.messageContainerShown=false;
    cgJsClass.gallery.function.message.removeCloseMessageFrameOnBodyClick();

    cgJsClass.gallery.vars.cgMessagesContainerPro.addClass('cg_hide');
    cgJsClass.gallery.vars.cgMessagesContainerProIsVisible = false;

    cgJsClass.gallery.function.general.tools.backdropHide();

};
cgJsClass.gallery.function.message.removeCloseMessageFrameOnBodyClick = function(){

    jQuery('body.cg_message_opened').off('click');
    jQuery('body').removeClass('cg_message_opened');

};
cgJsClass.gallery.function.message.resize = function (isPro){

    if(isPro){
        var $cgMessagesContainerPro = cgJsClass.gallery.vars.cgMessagesContainerPro;
        var windowWidth = jQuery(window).width();
        if(windowWidth < 500){
            $cgMessagesContainerPro.width(windowWidth);
        }else{
            $cgMessagesContainerPro.removeAttr('style');
        }
    }else{

        var $cgMessagesContainer = cgJsClass.gallery.vars.cgMessagesContainer;
        var left = jQuery(window).width()/2-250/2;
        $cgMessagesContainer.css('left',left+'px');
        //$cgMessagesContainer.removeClass('cg_hide');

    }


};