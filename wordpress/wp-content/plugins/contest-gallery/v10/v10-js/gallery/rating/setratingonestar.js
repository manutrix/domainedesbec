cgJsClass.gallery.rating.countSuserVotedAnImage = function(gid,realId){
    var userVoted = false;

    if(typeof cgJsData[gid].cgJsCountSuser[realId] != 'undefined'){
        if(cgJsData[gid].cgJsCountSuser[realId] > 0){
            userVoted = true;
        }
    }

    return userVoted;
};
cgJsClass.gallery.rating.generateRatingDivOneStar = function (realId,countS,firstLoad,gid) {

    var imageObject = cgJsData[gid].imageObject[realId];

    if(!imageObject && cgJsData[gid].vars.currentLook!='blog'){ // then must be not loaded on same gallery with same id like user gallery for example. It has to be found in dom then.
        imageObject = cgJsData[gid].vars.mainCGallery.find('#cg_show'+realId);
        if(imageObject.length==0){// then simply not existing in dome, nothing has to be done
            return;
        }
    }

    var userVoted = cgJsClass.gallery.rating.countSuserVotedAnImage(gid,realId);

    var position = '';

    if(cgJsData[gid].options.general.RatingOutGallery!='1'){
        var cg_rate_out_gallery_disallowed = 'cg_rate_out_gallery_disallowed';
    }else{
        var cg_rate_out_gallery_disallowed = '';
    }

    if(cgJsData[gid].options.visual['RatingPositionGallery']==2){
        position = 'cg_center';
    }

    if(cgJsData[gid].options.visual['RatingPositionGallery']==3){
        position = 'cg_right';
    }

    if (typeof firstLoad === 'undefined' || firstLoad == false) {

        if(countS>=1){
            var starLook = 'cg_gallery_rating_div_one_star_on';
        }else{
            var starLook = 'cg_gallery_rating_div_one_star_off';
        }

        var ratingDivChild =
            '<div data-cg_rate_star_id="' + realId + '" data-cg-gid="' + gid + '" class="cg_rate_star cg_gallery_rating_div_star cg_gallery_rating_div_star_one_star '+starLook+' '+cg_rate_out_gallery_disallowed+'">' +
            /*                '<img src="' + star + '" style="cursor:pointer;" class="cg_rate_star" id="cg_rate_star' + realId + '" data-cg_rate_star_id="' + realId + '">' +*/
            '</div><div id="rating_cg-' + realId + '" class="cg_gallery_rating_div_count">' + countS + '</div>'
        ;

        // does not load image rating in gallery if this condition is active
        //  if(cgJsData[gid].vars.currentLook!='blog'){

        imageObject.find('.cg_gallery_rating_div_child').empty().removeClass('cg-lds-dual-ring-star-loading').append(ratingDivChild);

        if(cgJsData[gid].options.pro.MinusVote==1 && userVoted && !cgJsData[gid].vars.isUserGallery){
            imageObject.find('.cg_gallery_rating_div_child').find('.cg_rate_minus').remove();
            imageObject.find('.cg_gallery_rating_div_child').append('<div data-cg_rate_star_id="' + realId + '" class="cg_rate_minus" data-cg-gid="' + gid + '"></div>');
        }else{
            imageObject.find('.cg_gallery_rating_div_child').find('.cg_rate_minus').remove();
        }

       // }

        if(cgJsData[gid].vars.currentLook=='blog'){

            var cgCenterDiv = cgJsData[gid].cgCenterDivBlogObject[realId];

            var ratingDivContainer = cgCenterDiv.find('.cg-center-image-rating-div');
            // have to be done if blog view otherwise still rating might be left from slider view
             ratingDivContainer.find('.cg_gallery_rating_div_child').removeClass('cg-lds-dual-ring-star-loading').append(ratingDivChild);
            if(cgJsData[gid].options.pro.MinusVote==1 && userVoted && !cgJsData[gid].vars.isUserGallery){
                ratingDivContainer.find('.cg_gallery_rating_div_child').find('.cg_rate_minus').remove();
                ratingDivContainer.find('.cg_gallery_rating_div_child').append('<div data-cg_rate_star_id="' + realId + '" class="cg_rate_minus" data-cg-gid="' + gid + '"></div>');
            }else{
                ratingDivContainer.find('.cg_gallery_rating_div_child').find('.cg_rate_minus').remove();
            }

        }else{
            var cgCenterDiv = cgJsData[gid].vars.cgCenterDiv;
            if(cgCenterDiv.is(':visible')){

                if(cgJsData[gid].vars.openedRealId==realId){
                    cgCenterDiv.find('#cgCenterImageRatingDiv'+gid).empty();
                    imageObject.find('.cg_gallery_rating_div').clone().appendTo(cgCenterDiv.find('#cgCenterImageRatingDiv'+gid));
                    cgCenterDiv.find('.cg_gallery_rating_div_star').removeClass('cg_rate_out_gallery_disallowed cg-lds-dual-ring-star-loading');
                }

            }
        }


    }
    else{

        if(countS>=1){
            var starLook = 'cg_gallery_rating_div_one_star_on';
        }else{
            var starLook = 'cg_gallery_rating_div_one_star_off';
        }

        if(cgJsData[gid].options.pro.MinusVote==1 && userVoted && !cgJsData[gid].vars.isUserGallery){
            var cg_rate_minus = '<div data-cg_rate_star_id="' + realId + '" class="cg_rate_minus" data-cg-gid="' + gid + '"></div>';
        }else{
            var cg_rate_minus = '';
        }

        // hide until vote condition -- END
        var ratingDiv = '<div class="cg_gallery_rating_div cg_gallery_rating_div_one_star" id="cg_gallery_rating_div' + realId + '">' +
            '<div class="cg_gallery_rating_div_child '+position+'" id="cg_gallery_rating_div_child' + realId + '">' +
            '<div data-cg_rate_star_id="' + realId + '" data-cg-gid="' + gid + '" class="cg_rate_star cg_gallery_rating_div_star cg_gallery_rating_div_star_one_star '+starLook+' '+cg_rate_out_gallery_disallowed+'">' +
            /*            '<img src="' + star + '" style="cursor:pointer;" class="cg_rate_star" id="cg_rate_star' + realId + '" data-cg_rate_star_id="' + realId + '">' +*/
            '</div><div id="rating_cg-' + realId + '" class="cg_gallery_rating_div_count">' + countS + '</div>' +
            cg_rate_minus+
            '</div>' +
            '</div>';

        if(cgJsData[gid].vars.currentLook=='blog'){
            var cgCenterDiv = cgJsData[gid].cgCenterDivBlogObject[realId];
            cgCenterDiv.find('.cg-center-image-rating-div').empty().append(ratingDiv);
        }else{
            if(cgJsData[gid].vars.modernHover){
                imageObject.find('.cg_gallery_info .cg_gallery_info_rating_comments').append(ratingDiv);
            }else{
                imageObject.find('.cg_gallery_info').append(ratingDiv);
            }
        }

    }

};
cgJsClass.gallery.rating.setRatingOneStarSameGalleryId = function (realId,addVoteS,firstLoad,gid,allVotesUsed,VotesInTimeExceeded,ratingFileData,isSetUserVoteToNull) {

// check if further galleries exists which have to be update user or normal, both ways
    if(String(gid).indexOf('-u')>=0){// then must be user gallery, check for normal gallery then
        return; // it can't be voted in user gallery
    }
    if(String(gid).indexOf('-u')==-1){// then must be normal gallery, check for user and winner gallery then

        var gidToCheck = gid+'-u';
        // then gallery must be existing
        if(cgJsData[gidToCheck]){
            cgJsClass.gallery.views.close(gidToCheck);
            cgJsClass.gallery.rating.setRatingOneStar(realId,addVoteS,firstLoad,gidToCheck,allVotesUsed,VotesInTimeExceeded,ratingFileData,isSetUserVoteToNull,true);
        }

        var gidToCheck = gid+'-w';
        // then gallery must be existing
        if(cgJsData[gidToCheck]){
            cgJsClass.gallery.views.close(gidToCheck);
            cgJsClass.gallery.rating.setRatingOneStar(realId,addVoteS,firstLoad,gidToCheck,allVotesUsed,VotesInTimeExceeded,ratingFileData,isSetUserVoteToNull,true);
        }

    }

};
cgJsClass.gallery.rating.setRatingOneStar = function (realId,addVoteS,firstLoad,gid,allVotesUsed,VotesInTimeExceeded,ratingFileData,isSetUserVoteToNull,isSetFromSameGalleryId) {

    if(cgJsData[gid].vars.isOnlyGalleryNoVoting){
        return;
    }

    // might happen when for example winner shortcode ist also on the page but without this realId (image)
    if(!cgJsData[gid].vars.rawData[realId]){
        return;
    }

    var onlyLoggedInUserImages = false;
    if(typeof cgJsData[gid].onlyLoggedInUserImages != 'undefined'){
        onlyLoggedInUserImages = true;
    }

    if(isSetUserVoteToNull){
        cgJsData[gid].cgJsCountSuser[realId] = 0;
    }

    if(typeof cgJsData[gid].cgJsCountSuser[realId]  == 'undefined' && addVoteS>0) {
        cgJsData[gid].cgJsCountSuser[realId]=1;
    }else if(cgJsData[gid].cgJsCountSuser[realId] == 0 && addVoteS>0){
        cgJsData[gid].cgJsCountSuser[realId]=1;
    }

    var data = cgJsData[gid].rateAndCommentNumbers[realId];
    var CheckLogin = cgJsData[gid].options.general.CheckLogin; // allow only registered uses to vote
    var ShowOnlyUsersVotes = cgJsData[gid].options.general.ShowOnlyUsersVotes;
    var Manipulate = cgJsData[gid].options.pro.Manipulate;

    if(!ratingFileData){
        data.CountS = parseInt(data.CountS) + addVoteS;
        // for indexDB save
        data.CountSreal = data.CountS;
    }else{

        if(ShowOnlyUsersVotes==1){
            data.CountS = cgJsData[gid].cgJsCountSuser[realId];
        }else{
            data.CountS  = parseInt(ratingFileData.CountS);
            data.addCountS  = parseInt(ratingFileData.addCountS);
        }

        // for indexDB save
        data.CountSreal = data.CountS;

        // do only if rating was done!!!!
        if(Manipulate==1 && ShowOnlyUsersVotes!=1){
            var addCountS = parseInt(data.addCountS);
            data.CountS = data.CountS + addCountS;
        }

    }

    // prüfen wozu das hier überhaupt da ist
/*    if(addVoteS>0){
        cgJsClass.gallery.dynamicOptions.setNewCountToMainImageArray(realId,'CountS',countS);
    }*/


    if(addVoteS){

        // !!!IMPORTANT SORTING WILL WORK AFTER VOTING WITH THIS
        for(var key in cgJsData[gid].fullImageDataFiltered){

            if(!cgJsData[gid].fullImageDataFiltered.hasOwnProperty(key)){
                break;
            }

            var firstKey = Object.keys(cgJsData[gid].fullImageDataFiltered[key])[0];

            if(cgJsData[gid].fullImageDataFiltered[key][firstKey]['id']==realId){

                cgJsData[gid].fullImageDataFiltered[key][firstKey]['CountS'] = data.CountS;

                break;
            }

        }

        var tstamp = parseInt(new Date().getTime())/1000;
        cgJsData[gid].rateAndCommentNumbers[realId] = data;
        cgJsClass.gallery.indexeddb.saveJsonSortValues(gid,cgJsData[gid].rateAndCommentNumbers,tstamp,true);
    }


    if(cgJsData[gid].options.general.HideUntilVote==1 && allVotesUsed==true && !onlyLoggedInUserImages){
        if(data.CountS>0){

            if(cgJsClass.gallery.rating.countSuserVotedAnImage(gid,realId)){
                if(ShowOnlyUsersVotes){
                    countStoSet = cgJsData[gid].cgJsCountSuser[realId];
                }else{
                    var countStoSet = data.CountS;
                }
            }else{
                var countStoSet = '';
            }

        }else{
            var countStoSet = '';
        }
        jQuery(cgJsClass.gallery.rating.generateRatingDivOneStar(realId,countStoSet,firstLoad,gid));
        if(VotesInTimeExceeded===true){
            cgJsClass.gallery.function.message.show(cgJsData[gid].options.pro.VotesInTimeIntervalAlertMessage);
            return;
        }
        return;
    }

    if (cgJsData[gid].options.general.HideUntilVote == 1 && !onlyLoggedInUserImages){

        if (typeof cgJsData[gid].cgJsCountSuser[realId] == 'undefined') {
            jQuery(cgJsClass.gallery.rating.generateRatingDivOneStar(realId,'',firstLoad,gid));
        }
        else{
            if (cgJsData[gid].cgJsCountSuser[realId] == 0) {// passiert wenn ShowOnlyUserVotes an ist
                jQuery(cgJsClass.gallery.rating.generateRatingDivOneStar(realId,'',firstLoad,gid));
            }else{
                jQuery(cgJsClass.gallery.rating.generateRatingDivOneStar(realId,data.CountS,firstLoad,gid));
            }
        }

    }else{
        if (data.CountS < 1){
            jQuery(cgJsClass.gallery.rating.generateRatingDivOneStar(realId,0,firstLoad,gid));
        }
        else{
            cgJsClass.gallery.rating.generateRatingDivOneStar(realId,data.CountS,firstLoad,gid);
        }
    }

    if(VotesInTimeExceeded===true){
        cgJsClass.gallery.function.message.show(cgJsData[gid].options.pro.VotesInTimeIntervalAlertMessage);
    }

    // Order important! Has to be done at the bottom!
    if(!isSetFromSameGalleryId && addVoteS){// then it is already done
        cgJsClass.gallery.rating.setRatingOneStarSameGalleryId(realId,addVoteS,firstLoad,gid,allVotesUsed,VotesInTimeExceeded,ratingFileData,isSetUserVoteToNull);
    }


};
