cgJsClass.gallery.rating.setDetailsPositionInSlider = function (gid,realId,$cg_gallery_rating_div_child) {

    return;// should not be visible in slider anymore

    var $cg_gallery_rating_div_five_star_details = $cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details');

    var sliderView = false;

    if(cgJsData[gid].vars.currentLook=='slider'){
        sliderView = true;
    }

    // remove in general at the beginning
    $cg_gallery_rating_div_five_star_details.removeAttr('style');
    $cg_gallery_rating_div_five_star_details.find('progress').removeAttr('style');

    if(sliderView && $cg_gallery_rating_div_child.closest('.mainCGslider').length){

        var $cgShow = $cg_gallery_rating_div_child.closest('#cg_show'+realId);
        var positionTop = $cgShow.find('#cgGalleryInfo'+realId).position().top*-1-5;
        var marginLeft = $cgShow.find('#cg_gallery_rating_div'+realId).position().left*-1;
        $cg_gallery_rating_div_five_star_details.css({'top':positionTop+'px','margin-left':marginLeft+'px'});
        var cg_gallery_rating_div_five_star_details_WIDTH = $cg_gallery_rating_div_five_star_details.removeClass('cg_hide').outerWidth();
        var cg_gallery_rating_div_five_star_details_HEIGHT = $cg_gallery_rating_div_five_star_details.height();
        $cg_gallery_rating_div_five_star_details.addClass('cg_hide');

        var widthDifference = $cgShow.outerWidth()-cg_gallery_rating_div_five_star_details_WIDTH;
        var progressWidth = $cg_gallery_rating_div_five_star_details.find('progress').first().width();
        var progressNewWidth = progressWidth+widthDifference;
        $cg_gallery_rating_div_five_star_details.find('progress').width(progressNewWidth);
        $cg_gallery_rating_div_five_star_details.height(cg_gallery_rating_div_five_star_details_HEIGHT+4);

    }

};
cgJsClass.gallery.rating.clickRateFiveStar = function () {

        // start mobile here
        jQuery( document ).on('click','.cg_gallery_rating_div_five_star_details.cg_opened_for_mobile_voting',function(e) {

            if(!cgJsClass.gallery.vars.isMobile){return;}
            if(jQuery(this).hasClass('cg_voting_in_process')){return;}
            if(jQuery(e.target).hasClass('cg_rate_star_five_star') || jQuery(e.target).hasClass('cg_rate_minus_five_star')){
                return;
            }else{
                return; // not required anymore, will be closed by closed button
                jQuery(this).removeClass('cg_opened_for_mobile_voting');
                jQuery(this).find('.cg_gallery_rating_div').remove();
                jQuery(this).addClass('cg_hide');
                cgJsClass.gallery.vars.dom.body.removeClass('cg_gallery_rating_div_five_star_details_is_opened');
                cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                cgJsClass.gallery.vars.dom.body.removeClass('cg_no_scroll cg_visibility_hidden');

            }
        });

        jQuery( document ).on( 'click', '#cg_gallery_rating_div_five_star_details_is_opened', function(e) {

            if(!cgJsClass.gallery.vars.isMobile){return;}

            if(jQuery(e.target).hasClass('cg_gallery_rating_div_five_star_details_close_button')){return;}
            if(!jQuery(this).hasClass('cg_opened_for_mobile_voting')){
                var $cg_gallery_rating_div_child = jQuery(this).closest('.cg_gallery_rating_div_child');
                cgJsClass.gallery.rating.set_five_star_details_opened_for_mobile_voting($cg_gallery_rating_div_child);
            }else{
                return;
            }
        });

        jQuery( document ).on('click','.cg_gallery_rating_div_five_star_details_close_button',function() {

            if(!cgJsClass.gallery.vars.isMobile){return;}
            jQuery(this).closest('.cg_gallery_rating_div_five_star_details').addClass('cg_hide').removeClass('cg_opened_for_mobile_voting');
            jQuery(this).find('.cg_gallery_rating_div').remove();
            jQuery(this).closest('.cg_gallery_rating_div_child').removeClass('cg_opacity_1');
            cgJsClass.gallery.vars.dom.body.removeClass('cg_gallery_rating_div_five_star_details_is_opened');
            
            cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
            cgJsClass.gallery.vars.dom.body.removeClass('cg_no_scroll cg_visibility_hidden');

        });

        jQuery( document ).on('click touchstart','body.cg_gallery_rating_div_five_star_details_is_opened',function(e) {

            if(!cgJsClass.gallery.vars.isMobile){return;}

            var $cg_gallery_rating_div_five_star_details = jQuery(e.target).closest('.cg_gallery_rating_div_five_star_details');

            if((jQuery(e.target).hasClass('cg_gallery_rating_div_five_star_details') || $cg_gallery_rating_div_five_star_details.length) && cgJsClass.gallery.vars.isMobile){return;}

            if(jQuery(e.target).hasClass('cg_rate_star_five_star') || jQuery(e.target).hasClass('cg_rate_minus_five_star') || jQuery(e.target).closest('.cg_rate_star_five_star').length || jQuery(e.target).closest('.cg_rate_minus_five_star').length){
                return;
            }

            e.preventDefault();

            if($cg_gallery_rating_div_five_star_details.length || jQuery(e.target).hasClass('cg_gallery_rating_div_five_star_details') || jQuery(e.target).closest('.cg_gallery_rating_div_star').length || jQuery(e.target).hasClass('cg_rate_minus')){
                $cg_gallery_rating_div_five_star_details.addClass('cg_hide');
                jQuery(this).removeClass('cg_gallery_rating_div_five_star_details_is_opened');
                
                cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                cgJsClass.gallery.vars.dom.body.removeClass('cg_no_scroll cg_visibility_hidden');

                return;
            }else{
                var $cg_gallery_rating_div_five_star_details_is_opened = jQuery('#cg_gallery_rating_div_five_star_details_is_opened');
                if($cg_gallery_rating_div_five_star_details_is_opened.length>=1){
                    $cg_gallery_rating_div_five_star_details_is_opened.addClass('cg_hide');
                    $cg_gallery_rating_div_five_star_details_is_opened.removeAttr('id');
                    jQuery(this).removeClass('cg_gallery_rating_div_five_star_details_is_opened');
                    
                    cgJsClass.gallery.vars.dom.html.removeClass('cg_no_scroll');
                    cgJsClass.gallery.vars.dom.body.removeClass('cg_no_scroll cg_visibility_hidden');

                }
            }
        });

        jQuery( document ).on( 'click', '.cg_gallery_rating_div_child.cg_gallery_rating_div_child_five_star', function(e) {

            // RETURN IN THE MOMENT
            return;

            if(!cgJsClass.gallery.vars.isMobile){return;}
            if(jQuery(e.target).hasClass('cg_gallery_rating_div_five_star_details_close_button')){return;}

            e.preventDefault();

            var gid = jQuery(this).attr('data-cg-gid');
            var realId = jQuery(this).attr('data-cg-real-id');

            if(cgJsData[gid].options.pro.IsModernFiveStar==1){


                if(jQuery(this).find('.cg_gallery_rating_div_five_star_details').hasClass('cg_hide')){

                    cgJsClass.gallery.rating.setDetailsPositionInSlider(gid,realId,jQuery(this));

                    var $cg_gallery_rating_div_five_star_details_is_opened = jQuery('#cg_gallery_rating_div_five_star_details_is_opened');
                    if($cg_gallery_rating_div_five_star_details_is_opened.length>=1){
                        $cg_gallery_rating_div_five_star_details_is_opened.addClass('cg_hide');
                        $cg_gallery_rating_div_five_star_details_is_opened.removeAttr('id');
                    }

                    jQuery(this).find('.cg_gallery_rating_div_five_star_details').removeClass('cg_hide');
                    jQuery(this).find('.cg_gallery_rating_div_five_star_details').attr('id','cg_gallery_rating_div_five_star_details_is_opened');
                    cgJsClass.gallery.vars.dom.body.addClass('cg_gallery_rating_div_five_star_details_is_opened');
                    cgJsClass.gallery.vars.dom.html.addClass('cg_no_scroll');
                    cgJsClass.gallery.vars.dom.body.addClass('cg_no_scroll cg_visibility_hidden');

                }else{

                }

            }
        });

        jQuery( document ).on( 'click', '.mainCGslider .cg_gallery_rating_div_five_star_details', function(e) {

            if(!cgJsClass.gallery.vars.isMobile){return;}

            e.preventDefault();
            var $element = jQuery(this);
            //   setTimeout(function () {
            var gid = $element.attr('data-cg-gid');
            var realId = $element.attr('data-cg-real-id');

            var $toClick = jQuery('#mainCGslider'+gid+' .cgGalleryInfo'+realId);
            //  $toClick.addClass('cg-pass-through');
            cgJsClass.gallery.vars.passThrough = true;
            $toClick.click();
            //         },10);

        });

        // end mobile here

        jQuery( document ).on( 'mousemove', '.cg_gallery_rating_div_child.cg_gallery_rating_div_child_five_star', function(e) {

            e.preventDefault();

            var gid = jQuery(this).attr('data-cg-gid');
            var realId = jQuery(this).attr('data-cg-real-id');

            var sliderView = false;

            if(cgJsData[gid].vars.currentLook=='slider'){
                sliderView = true;
            }

            var $mainCGslider = jQuery(this).closest('.mainCGslider');

            if(sliderView && $mainCGslider.length){// remove only in slider! Do not remove in single view!
                return;
            }


            if(cgJsData[gid].options.pro.IsModernFiveStar==1){
                if(cgJsData[gid].options.general.HideUntilVote == 1 && (cgJsData[gid].cgJsCountRuser[realId] == 0 || typeof cgJsData[gid].cgJsCountRuser[realId] == 'undefined')){
                    return;
                }
            }

            if(cgJsData[gid].options.pro.IsModernFiveStar==1 && !cgJsClass.gallery.vars.isMobile){

             //   if($mainCGslider.length){

                    cgJsClass.gallery.rating.setDetailsPositionInSlider(gid,realId,jQuery(this));

          //      }

                if(jQuery(e.target).hasClass('.cg_gallery_rating_div_child ') || jQuery(e.target).closest('.cg_gallery_rating_div_child').length>=1){
                    var $cg_gallery_rating_div_five_star_details = jQuery(this).find('.cg_gallery_rating_div_five_star_details');
                    $cg_gallery_rating_div_five_star_details.removeAttr('style');//remove margin-left

                    if((cgJsData[gid].options.visual.RatingPositionGallery==3 || cgJsData[gid].vars.currentLook=='row') && !sliderView){// most like right space is very low in this cases

                        //might happen because of fast clicking!
                        //error would appear then in console
                        if(!$cg_gallery_rating_div_five_star_details.offset()){
                            return;
                        }

                        // calculation if margn left required
                        var windowWidth = jQuery(window).width();
                        var eventuallyMinusMarginLeftToSet = $cg_gallery_rating_div_five_star_details.offset().left+$cg_gallery_rating_div_five_star_details.width()-windowWidth+25;//+16=average scrollbar width, but some space left also requied
                        if(eventuallyMinusMarginLeftToSet>0){
                            $cg_gallery_rating_div_five_star_details.css('margin-left','-'+eventuallyMinusMarginLeftToSet+'px');
                        }
                    }

                    if(sliderView && (cgJsClass.gallery.vars.fullwindow || cgJsClass.gallery.vars.fullscreen)){
                        $cg_gallery_rating_div_five_star_details.addClass('cg_hidden').removeClass('cg_hide');// this way real outerHeight can be get
                        var topToSet = $cg_gallery_rating_div_five_star_details.outerHeight()+4;
                        $cg_gallery_rating_div_five_star_details.css('top','-'+topToSet+'px');
                    }else{
                        $cg_gallery_rating_div_five_star_details.removeAttr('style');
                    }

                    $cg_gallery_rating_div_five_star_details.removeClass('cg_hidden cg_hide cg_fade_out');
                    jQuery(this).addClass('cg_opacity_1');

                }else{
                    jQuery(this).find('.cg_gallery_rating_div_five_star_details').addClass('cg_hide');
                    jQuery(this).removeClass('cg_opacity_1');
                }
            }

        });

        jQuery( document ).on( 'mouseleave', '.cg_gallery_rating_div_child.cg_gallery_rating_div_child_five_star', function(e) {

            e.preventDefault();
            var gid = jQuery(this).attr('data-cg-gid');
            if(cgJsData[gid].options.pro.IsModernFiveStar==1 && !cgJsClass.gallery.vars.isMobile){
                jQuery(this).find('.cg_gallery_rating_div_five_star_details').addClass('cg_hide');
                jQuery(this).removeClass('cg_opacity_1');
            }

        });



    jQuery( document ).on( 'click', '.cg_rate_star_five_star,.cg_rate_minus.cg_rate_minus_five_star', function(e) {
        e.preventDefault();
        var gid = jQuery(this).attr('data-cg-gid');

        var cgCenterDiv = jQuery(this).closest('.cgCenterDiv');

        // for mobile make voting only in cgCenterDiv
        // otherwise not right behaviour, too complex because of stars at gallery view and stars at image when slide out is activated
        if(cgJsClass.gallery.vars.isMobile && !cgCenterDiv.length && (cgJsData[gid].options.general.FullSizeImageOutGallery!=1 && cgJsData[gid].options.general.OnlyGalleryView!=1)){
            return;
        }

        // take care of order, this here has to be done before details check
        if(cgJsData[gid].vars.currentLook=='slider'){
            // then clicked from slider preview
            if(jQuery(this).closest('.mainCGslider').length>=1){
                return;
            }
        }

        var $cg_gallery_rating_div_child = jQuery(this).closest('.cg_gallery_rating_div_child');
        // check also if it is not done already in cg_gallery_rating_div_five_star_details
        if(cgJsData[gid].options.pro.IsModernFiveStar==1 && cgJsClass.gallery.vars.isMobile && !$cg_gallery_rating_div_child.closest('.cg_gallery_rating_div_five_star_details').length){// open for mobile first
            // old logic does not allow for OnlyGalleryView and FullSizeImageOutGallery
            //if(!$cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details').hasClass('cg_opened_for_mobile_voting') && cgJsData[gid].options.general.FullSizeImageOutGallery!=1 && cgJsData[gid].options.general.OnlyGalleryView!=1){
            if(!$cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details').hasClass('cg_opened_for_mobile_voting')){
                cgJsClass.gallery.rating.set_five_star_details_opened_for_mobile_voting($cg_gallery_rating_div_child);
                return;
            }
        }

        var minusVoteNow = 0;

        if(jQuery(this).hasClass('cg_rate_out_gallery_disallowed') && cgJsData[gid].options.general.RatingOutGallery!='1' && cgJsData[gid].vars.currentLook!='blog'){
            return;
        }

        if(cgJsData[gid].options.general.AllowRating!='1'){
            return;
        }

        if(String(gid).indexOf('-w')>=0){
            return;
        }

        if(jQuery(this).parent().parent().parent().parent().hasClass('cg_gallery_info')){
            var order = jQuery(this).closest('.cg_show').attr('data-cg-order');
            if(cgJsData[gid].vars.openedGalleryImageOrder!=order && cgJsData[gid].options.general.RatingOutGallery!='1'){
                cgJsClass.gallery.views.singleView.openImage(jQuery,order,false,gid);
            }
        }

        if(cgJsData[gid].vars.cg_check_login==1 && cgJsData[gid].vars.cg_user_login_check==0){
            cgJsClass.gallery.function.message.show(cgJsClass.gallery.language.OnlyRegisteredUsersCanVote);
            return false;
        }


        if(cgJsData[gid].options.pro.MinusVote==1 && jQuery(this).hasClass('cg_rate_minus')){
            minusVoteNow = 1;
        }

        var cg_picture_id = jQuery(this).attr('data-cg_rate_star_id');

        var cg_rate_value = 1;

        if(!jQuery(this).hasClass('cg_rate_minus')){
            cg_rate_value = jQuery(this).attr('data-cg_rate_star');
        }

        if(cgJsData[gid].vars.currentLook=='blog'){

          //  cgJsData[gid].cgCenterDivBlogObject[cg_picture_id].find('.cg_gallery_rating_div_child').empty().addClass('cg-lds-dual-ring-star-loading');

            var isFromSingleView = true;

            var $cg_gallery_rating_div_child = cgJsData[gid].cgCenterDivBlogObject[cg_picture_id].find('.cg_gallery_rating_div_child');

            if($cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details').hasClass('cg_opened_for_mobile_voting')){
                //var $cg_gallery_rating_div_count_new = jQuery( "<div class='cg_gallery_rating_div_count'></div>");
                //$cg_gallery_rating_div_count_new.append($cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details').clone().empty().addClass('cg-lds-dual-ring-star-loading cg_voting_in_process'));
                //$cg_gallery_rating_div_child.empty().addClass('cg-lds-dual-ring-star-loading').append($cg_gallery_rating_div_count_new);
                cgJsClass.gallery.rating.reset_cg_gallery_rating_div_five_star_details_for_loading($cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details'));
            }else{
                $cg_gallery_rating_div_child.height($cg_gallery_rating_div_child.height());
                $cg_gallery_rating_div_child.empty().addClass('cg-lds-dual-ring-star-loading');
            }

        }else{

            var imageObject = cgJsData[gid].imageObject[cg_picture_id];

            var $cg_gallery_rating_div_childImageObject = imageObject.find('.cg_gallery_rating_div_child');

            /// TO CONTINUE HERE!!!!
            if(cgJsData[gid].options.general.FullSizeImageOutGallery!=1 && cgJsData[gid].options.general.OnlyGalleryView!=1) {
                $cg_gallery_rating_div_childImageObject.height($cg_gallery_rating_div_child.height());
                $cg_gallery_rating_div_childImageObject.empty().addClass('cg-lds-dual-ring-star-loading');
            }else if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1) {

                if(cgJsData[gid].vars.currentLook=='blog' || cgJsData[gid].vars.currentLook=='slider'){
                    $cg_gallery_rating_div_childImageObject.height($cg_gallery_rating_div_child.height());
                    $cg_gallery_rating_div_childImageObject.empty().addClass('cg-lds-dual-ring-star-loading');
                }

            }

            var isFromSingleView = false;

            if(cgCenterDiv.length>=1){
                isFromSingleView = true;
            }

            if(cgCenterDiv.is(':visible')){
                if(cgJsData[gid].vars.openedRealId==cg_picture_id){

                    var $cg_gallery_rating_div_child = cgCenterDiv.find('.cg_gallery_rating_div_child');

                    if($cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details').hasClass('cg_opened_for_mobile_voting')){
                       // var $cg_gallery_rating_div_count_new = jQuery( "<div class='cg_gallery_rating_div_count'></div>");
                       // $cg_gallery_rating_div_count_new.append($cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details').clone().empty().addClass('cg-lds-dual-ring-star-loading cg_voting_in_process'));
                       // $cg_gallery_rating_div_child.empty().addClass('cg-lds-dual-ring-star-loading').append($cg_gallery_rating_div_count_new);
                        cgJsClass.gallery.rating.reset_cg_gallery_rating_div_five_star_details_for_loading($cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details'));
                    }else{
                        $cg_gallery_rating_div_child.height($cg_gallery_rating_div_child.height());
                        $cg_gallery_rating_div_child.empty().addClass('cg-lds-dual-ring-star-loading');
                    }

                }
            }else{

                /// TO CONTINUE HERE!!!!!
                if(cgJsData[gid].options.general.FullSizeImageOutGallery==1 || cgJsData[gid].options.general.OnlyGalleryView==1) {
                    var $cg_gallery_rating_div_five_star_details = jQuery(this).closest('.cg_gallery_rating_div_five_star_details');
                    if($cg_gallery_rating_div_five_star_details.hasClass('cg_opened_for_mobile_voting')){
                        cgJsClass.gallery.rating.reset_cg_gallery_rating_div_five_star_details_for_loading(jQuery(this).closest('.cg_gallery_rating_div_five_star_details'));
                    }else{
                        $cg_gallery_rating_div_childImageObject.empty().addClass('cg-lds-dual-ring-star-loading');
                    }
                }

            }


        }

        jQuery.ajax({
            url : post_cg_rate_v10_fiveStar_wordpress_ajax_script_function_name.cg_rate_v10_fiveStar_ajax_url,
            type : 'post',
            data : {
                action : 'post_cg_rate_v10_fiveStar',
                gid : cgJsData[gid].vars.gidReal,
                galeryIDuser : gid,
                pid : cg_picture_id,
                value : cg_rate_value,
                minusVoteNow : minusVoteNow,
                galleryHash : cgJsData[gid].vars.galleryHash,
                isFromSingleView : isFromSingleView
            }
            }).done(function(response) {

                if($cg_gallery_rating_div_childImageObject){
                    $cg_gallery_rating_div_childImageObject.height('auto');
                }

                var parser = new DOMParser();
                var parsedHtml = parser.parseFromString(response, 'text/html');

                jQuery(parsedHtml).find('script[data-cg-processing="true"]').each(function () {

                    var script = jQuery(this).html();
                    eval(script);

                });


        }).fail(function(xhr, status, error) {

            cgJsClass.gallery.rating.setRatingFiveStar(cg_picture_id,0,0,false,gid,false,false);

        }).always(function() {

        });


    });

};
cgJsClass.gallery.rating.set_five_star_details_opened_for_mobile_voting = function($cg_gallery_rating_div_child)
{
    var $cg_gallery_rating_div = $cg_gallery_rating_div_child.closest('.cg_gallery_rating_div').clone();
    $cg_gallery_rating_div.find('.cg_gallery_rating_div_star_hover').remove();
    $cg_gallery_rating_div.find('.cg_gallery_rating_div_five_star_details').remove();
    $cg_gallery_rating_div_child.find('.cg_gallery_rating_div').remove();
    $cg_gallery_rating_div_child.addClass('cg_opacity_1');
    var $cg_gallery_rating_div_five_star_details = $cg_gallery_rating_div_child.find('.cg_gallery_rating_div_five_star_details');
    // width required to be set because of developer toos handling. Developer tools might simulate monitor width in some cases for CSS.
    $cg_gallery_rating_div_five_star_details.width(jQuery(window).width()-18);// -18 because of padding
    $cg_gallery_rating_div_five_star_details.removeClass('cg_hide').prepend($cg_gallery_rating_div).addClass('cg_opened_for_mobile_voting');

   // cgJsClass.gallery.vars.dom.body.removeClass('cg_gallery_rating_div_five_star_details_is_opened');
    cgJsClass.gallery.vars.dom.body.addClass('cg_gallery_rating_div_five_star_details_is_opened');
    cgJsClass.gallery.vars.dom.html.addClass('cg_no_scroll');
    cgJsClass.gallery.vars.dom.body.addClass('cg_no_scroll cg_visibility_hidden');

}
cgJsClass.gallery.rating.reset_cg_gallery_rating_div_five_star_details_for_loading = function($cg_gallery_rating_div_five_star_details)
{
    //console.log($cg_gallery_rating_div_five_star_details.length);

    $cg_gallery_rating_div_five_star_details.find('.cg_gallery_rating_div').remove();
    $cg_gallery_rating_div_five_star_details.find('.cg_five_star_details_row').remove();
    $cg_gallery_rating_div_five_star_details.find('.cg_five_star_details_average').remove();
    $cg_gallery_rating_div_five_star_details.find('.cg_gallery_rating_div_five_star_details_close_button').remove();
    $cg_gallery_rating_div_five_star_details.addClass('cg-lds-dual-ring-star-loading');
  //  $cg_gallery_rating_div_five_star_details.closest('.cg_gallery_rating_div_child').addClass('cg_opacity_1');

}