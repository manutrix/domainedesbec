cgJsClass.gallery.comment.showSetCommentsSameGalleryId = function (realId,gid) {

    // check if further galleries exists which have to be update user or normal, both ways
    if(String(gid).indexOf('-u')>=0){// then must be user gallery, check for normal gallery then
        return; // it can't be voted in user gallery
    }
    if(String(gid).indexOf('-u')==-1){// then must be normal gallery, check for user gallery then
        var gidToCheck = gid+'-u';
        // then gallery must be existing
        if(cgJsData[gidToCheck]){
            cgJsClass.gallery.views.close(gidToCheck);
            cgJsClass.gallery.rating.showSetComments(realId,gidToCheck,true);
        }
    }

};
cgJsClass.gallery.comment.appendComment = function (realId,gid,name,comment,gidForElements) {

    if(!gidForElements){
        gidForElements = gid;
    }

    var $cgCenterDiv = cgJsData[gid].vars.mainCGdiv.find('#cgCenterDiv'+gidForElements);

    $cgCenterDiv.find('#cgCenterImageCommentsDivEnterTitle'+gidForElements).val('');
    $cgCenterDiv.find('#cgCenterImageCommentsDivEnterTextarea'+gidForElements).val('');

    $cgCenterDiv.find('#cgCenterImageCommentsDiv'+gidForElements).removeClass('cg_hide');
    $cgCenterDiv.find('#cgCenterImageCommentsDivTitle'+gidForElements).removeClass('cg_hide');
    $cgCenterDiv.find('#cgCenterInfoDiv'+gidForElements).find('.cg-center-image-comments-div-parent-parent').removeClass('cg_hide');

    $cgCenterDiv.find('#cgCenterImageCommentsDivEnterTitleError'+gidForElements).addClass('cg_hide');
    $cgCenterDiv.find('#cgCenterImageCommentsDivEnterTextareaError'+gidForElements).addClass('cg_hide');

    // in der function später kommt *1000 vor weil auf php unix time eingestellt ist welches mit 1000 weniger zurückgibt
    var timestamp = parseInt(new Date().getTime())/1000;

    var date = cgJsClass.gallery.comment.getDateDependsOnLocaleLang(timestamp);

    var commentDiv = jQuery('<div class="cg-center-image-comments-div"></div>');
    commentDiv.append('<p>'+comment+'</p>');
    commentDiv.prepend('<p>'+name+'</p>');
    commentDiv.prepend('<p>'+date+'</p>');
    $cgCenterDiv.find("#cgCenterImageCommentsDiv"+gidForElements).prepend(commentDiv);
    $cgCenterDiv.find("#cgCenterImageCommentsDiv"+gidForElements).find('.cg-center-for-your-comment-message').remove();


    if(String(gid).indexOf('-u')==-1) {// then must be normal gallery, check for user gallery then
        var thankYouDiv = jQuery('<div class="cg-center-image-comments-div"></div>');
        thankYouDiv.prepend('<p class="cg-center-for-your-comment-message">'+cgJsClass.gallery.language.ThankYouForYourComment+'</p>');
        $cgCenterDiv.find("#cgCenterImageCommentsDiv"+gidForElements).prepend(thankYouDiv);
    }

};
cgJsClass.gallery.comment.appendCommentUserGalleryIfExists = function (realId,gid,name,comment) {

    // check if further galleries exists which have to be update user or normal, both ways
    if(String(gid).indexOf('-u')>=0){// then must be user gallery, check for normal gallery then
        return; // it can't be voted in user gallery
    }
    if(String(gid).indexOf('-u')==-1){// then must be normal gallery, check for user gallery then
        var gidToCheck = gid+'-u';
        // then gallery must be existing
        if(cgJsData[gidToCheck]){
         //   cgJsClass.gallery.views.close(gidToCheck);
          //  cgJsClass.gallery.rating.showSetComments(realId,gidToCheck,true);

            // commentar count aktualisieren!
            cgJsClass.gallery.comment.setComment(realId,1,gidToCheck);
            if(cgJsData[gidToCheck].vars.rawData[realId]){// check if image exists in this gallery
                cgJsClass.gallery.comment.appendComment(realId,gidToCheck,name,comment);
                cgJsClass.gallery.comment.checkIfTopBottomArrowsRequired(gidToCheck);
                cgJsClass.gallery.views.scrollInfoOrCommentTopFullHeight(gidToCheck);
            }
        }
    }

};
cgJsClass.gallery.comment.showSetComments = function (realId,gid,isSetFromSameGalleryId,gidForElements) {

    if(!gidForElements){
        gidForElements = gid;
    }

    if(String(gid).indexOf('-u')>=0){// then must be from user gallery, user can not comment in own gallery
        cgJsClass.gallery.function.message.show(cgJsClass.gallery.language.YouCanNotCommentInOwnGallery);
        return;
    }

    var name = cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivEnterTitle'+gidForElements).val();
    var comment = cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivEnterTextarea'+gidForElements).val();

    if(name.length<2){
        var errorMessage = cgJsClass.gallery.language.TheNameFieldMustContainTwoCharactersOrMore;
        cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivEnterTitleError'+gidForElements).text(errorMessage).removeClass('cg_hide');
    }

    if(comment.length<3){
        var errorMessage = cgJsClass.gallery.language.TheCommentFieldMustContainThreeCharactersOrMore;
        cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivEnterTextareaError'+gidForElements).text(errorMessage).removeClass('cg_hide');
    }

    if(name.length<2 || comment.length<3){ return; }

    cgJsClass.gallery.comment.appendComment(realId,gid,name,comment,gidForElements);

    // Anders funktioniert es ansonsten im FullWindow nicht
    if(cgJsClass.gallery.vars.fullwindow){

        location.href = '#cgCenterImageCommentsDiv'+gidForElements;
        cgJsClass.gallery.views.singleView.createImageUrl(gid,realId);

    }else{
        cgJsClass.gallery.vars.dom.html.animate({
            scrollTop: cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDiv'+gidForElements).offset().top - 110+'px'
        }, 'fast');
    }

    // commentar count aktualisieren!
    cgJsClass.gallery.comment.setComment(realId,1,gid);

    cgJsClass.gallery.comment.appendCommentUserGalleryIfExists(realId,gid,name,comment,gidForElements);

    var $cgCenterImageCommentsDivEnterSubmit = cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivEnterSubmit'+gidForElements)

    var widthButton = cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDivEnterSubmit'+gidForElements).width();
    $cgCenterImageCommentsDivEnterSubmit.width(widthButton);
    $cgCenterImageCommentsDivEnterSubmit.css({
                'pointer-events': 'none',
                'cursor': 'none'
            });

    // timer disabled submit button
    var checkRecursive = function checkRecursive(i){

        setTimeout(function () {

                i--;

                if(i==0){
                    $cgCenterImageCommentsDivEnterSubmit.prop('disabled',false);
                    $cgCenterImageCommentsDivEnterSubmit.text(cgJsClass.gallery.language.Send);
                    $cgCenterImageCommentsDivEnterSubmit.removeAttr('style');
                    return;
                }

            $cgCenterImageCommentsDivEnterSubmit.text(i);
                checkRecursive(i,false);

        },1000);

    };

    checkRecursive(11);

    cgJsClass.gallery.comment.checkIfTopBottomArrowsRequired(gid,gidForElements);
    cgJsClass.gallery.views.scrollInfoOrCommentTopFullHeight(gid,gidForElements);


    // 09.03.2020 vorläufig noch nicht aktiviert!!!!
    /*    if(!isSetFromSameGalleryId){// then it is already done
            // maybe same user id or same general id is on same page
            setTimeout(function () {
                cgJsClass.gallery.comment.showSetCommentsSameGalleryId(realId,gid);
            },100);
        }*/

            jQuery.ajax({
                url : cg_show_set_comments_v10_wordpress_ajax_script_function_name.cg_show_set_comments_v10_ajax_url,
                type : 'post',
                data : {
                    action : 'cg_show_set_comments_v10',
                    pid : realId,
                    gid : cgJsData[gid].vars.gidReal,
                    name : name,
                    comment : comment,
                    galeryIDuser : gid,
                    galleryHash : cgJsData[gid].vars.galleryHash
                },
                }).done(function(response) {

                    var parser = new DOMParser();
                    var parsedHtml = parser.parseFromString(response, 'text/html');
                    var script = jQuery(parsedHtml).find('script[data-cg-processing="true"]').first();

                    if(!script.length){

                        cgJsClass.gallery.function.message.show('Your comment could not be saved. Please contact administrator.');
                        // commentar count aktualisieren!
                        cgJsClass.gallery.comment.setComment(realId,-1,gid);
                        cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDiv'+gidForElements).find('.cg-center-image-comments-div').first().remove().next().remove();

                    } else{

                        // set comment here again but with addCountC as 0, maybe file data had to be repaired
                        jQuery(parsedHtml).find('script[data-cg-processing="true"]').each(function () {
                            var script = jQuery(this).html();
                            eval(script);
                        });

                    }


                }).fail(function(xhr, status, error) {

                cgJsClass.gallery.function.message.show('Your comment could not be saved. Please contact administrator.');

                // commentar count aktualisieren!
                cgJsClass.gallery.comment.setComment(realId,-1,gid);
                cgJsData[gid].vars.mainCGdiv.find('#cgCenterImageCommentsDiv'+gidForElements).find('.cg-center-image-comments-div').first().remove().next().remove();

            }).always(function() {

            });


};

