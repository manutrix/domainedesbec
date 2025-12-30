jQuery(document).ready(function ($) {

    /*    $(document).on('click', '.cg_step ', function(e){

            var $field = $(this);

            setTimeout(function () {
                $('.cg_step').removeClass('cg_step_selected');
                setTimeout(function () {
                    $field.addClass('cg_step_selected');
                },200);
            },200);

        });*/


// View control ajax posts and similiar

    var removeCgActiveFromViewControl = function (){
        $('.cg_image_checkbox_container_view_control .cg_image_checkbox').removeClass('cg_active');
    }

    var cgChangedAndSearchedValueSelector = cgJsClassAdmin.gallery.vars.cgChangedAndSearchedValueSelector;

    $(document).on('click', '#cgGalleryBackendContainer #cgSortable .informdiv .cg_go_to_save_button', function (e) {
        e.preventDefault();
        $("html, body").animate({scrollTop: $(document).height()}, 0);

    });

    $(document).on('mouseenter', '#cgGalleryBackendContainer .cg_backend_info_container.cg_searched_value', function () {

        $(this).parent().find('.cg-info-container').first().show();

    });

    $(document).on('mouseleave', '#cgGalleryBackendContainer .cg_backend_info_container.cg_searched_value', function () {

        $(this).parent().find('.cg-info-container').first().hide();

    });


    // send only values that are needed to send
    $(document).on('change', cgChangedAndSearchedValueSelector, function () {
        $(this).addClass('cg_value_changed');
    });


    $(document).on('click', '#cgGalleryBackendContainer #cgPicsPerSite .cg_step', function (e) {
        e.preventDefault();
        cgJsClassAdmin.gallery.functions.abortRequest();

        $('#cgPicsPerSite .cg_step').removeClass('cg_step_selected');

        // have to start from 0 again then
        $('#cgStepsChanged').prop('disabled', false);

        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        removeCgActiveFromViewControl();

        cgJsClassAdmin.gallery.functions.changeViewByControl($, $(this).addClass('cg_step_selected'));

    });

    $(document).on('click', '#cgGalleryBackendContainer .cg_steps_navigation .cg_step', function (e) {
        e.preventDefault();
        cgJsClassAdmin.gallery.functions.abortRequest();

        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        cgJsClassAdmin.gallery.functions.changeViewByControl($, null, $(this));

        if ($(this).closest('.cg_steps_navigation').attr('id') == 'cgStepsNavigationBottom') {
            document.getElementById('cgGalleryForm').scrollIntoView();
        }

    });

    $(document).on('change', '#cgGalleryBackendContainer #cgOrderSelect', function () {
        cgJsClassAdmin.gallery.functions.abortRequest();

        var $selected = $(this).find(':selected');

        // reset to date desc in custom or further fields selected
        if($selected.closest('#cgOrderSelectCustomFields').length || $selected.closest('#cgOrderSelectFurtherFields').length){
            $('#cgOrderValue').val($selected.val());
        }else{
            $('#cgOrderValue').val($selected.val());
        }

        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        removeCgActiveFromViewControl();

        cgJsClassAdmin.gallery.functions.changeViewByControl($,false,false,false,false,false,$selected);

    });

    $(document).on('input', '#cgGalleryBackendContainer #cgSearchInput', function () {

        cgJsClassAdmin.gallery.functions.abortRequest();

        var $el = $(this);
        $el.val($el.val().trim());
        $('#cgStartValue').val('0');
        if ($el.val().length >= 1) {
            $el.addClass('cg_searched_value');
            $('#cgSearchInputButton').removeClass('cg_hide');
            $('#cgSearchInputClose').removeClass('cg_hide');
        } else {
            $el.removeClass('cg_searched_value');
            //$('#cgSearchInputButton').addClass('cg_hide');
            //$('#cgSearchInputClose').addClass('cg_hide');
        }

    });

    $(document).on('keypress', '#cgGalleryBackendContainer #cgSearchInput', function (e) {

        if (e.which == 13) {

            cgJsClassAdmin.gallery.functions.searchInputButtonClick();
            e.preventDefault();
            return false;

        }

    });

    $(document).on('click', '#cgSearchInputButton', function () {

        removeCgActiveFromViewControl();
        cgJsClassAdmin.gallery.functions.searchInputButtonClick();

    });

    $(document).on('click', '#cgShowOnlyWinnersCheckbox', function () {

        if($(this).prop('checked')){
            $(this).addClass('cg_searched_value_checkbox');
        }else{
            $(this).removeClass('cg_searched_value_checkbox');
        }


        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        removeCgActiveFromViewControl();

        cgJsClassAdmin.gallery.functions.abortRequest();
        cgJsClassAdmin.gallery.functions.changeViewByControl($, null, null, null, true);

    });

    $(document).on('click', '#cgShowOnlyActiveCheckbox', function () {

        $('#cgShowOnlyInactiveCheckbox').prop('checked',false);

        if($(this).prop('checked')){
            $(this).addClass('cg_searched_value_checkbox');
        }else{
            $(this).removeClass('cg_searched_value_checkbox');
        }

        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        removeCgActiveFromViewControl();

        cgJsClassAdmin.gallery.functions.abortRequest();
        cgJsClassAdmin.gallery.functions.changeViewByControl($, null, null, null, true);

    });

    $(document).on('click', '#cgShowOnlyInactiveCheckbox', function () {

        $('#cgShowOnlyActiveCheckbox').prop('checked',false);

        if($(this).prop('checked')){
            $(this).addClass('cg_searched_value_checkbox');
        }else{
            $(this).removeClass('cg_searched_value_checkbox');
        }

        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        removeCgActiveFromViewControl();

        cgJsClassAdmin.gallery.functions.abortRequest();
        cgJsClassAdmin.gallery.functions.changeViewByControl($, null, null, null, true);

    });

    $(document).on('submit', '#cgGalleryBackendContainer #cgGalleryForm', function (e) {
        e.preventDefault();
        cgJsClassAdmin.gallery.functions.abortRequest();
        $('#cgViewControl .cg_image_checkbox').removeClass('cg_active');
        // disable all fields which were not changed!!!!
        $(cgChangedAndSearchedValueSelector).not(".cg_value_changed").prop('disabled', true);
        cgJsClassAdmin.gallery.functions.changeViewByControl($, null, null, true,false,true);
    });

    $(document).on('click', '#cgGalleryBackendContainer #cgSearchInputClose', function (e) {
        e.preventDefault();
        cgJsClassAdmin.gallery.functions.abortRequest();

        var $cgSearchInput = $('#cgSearchInput');

        $cgSearchInput.removeClass('cg_searched_value');

        $(this).addClass('cg_hide');
        $('#cgSearchInputButton').addClass('cg_hide');

        $cgSearchInput.val('');

        localStorage.setItem('cgSearch_BG_' + gid, '');


        // to go simply sure that nothing will be deleted!!!
        $('#cgGalleryForm').find('.cg_delete').remove();

        cgJsClassAdmin.gallery.functions.changeViewByControl($);
    });


// View control ajax posts and similiar -- END


    $(document).on('click', '#cgGalleryBackendContainer #CatWidget', function (e) {

        if ($(this).is(":checked")) {
            $("#ShowCatsUnchecked").removeClass("cg_disabled");
        }
        else {
            $("#ShowCatsUnchecked").addClass("cg_disabled");
        }

    });

    $(document).on('keypress', '#cgGalleryBackendContainer .cg_manipulate_plus_value .cg_manipulate_5_star_input', function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            // $("#cg_options_errmsg").html("Only numbers are allowed").show().fadeOut("slow");
            return false;
        }
    });


    $(document).on('input', '#cgGalleryBackendContainer .cg_manipulate_countS_input', function (e) {

        if (parseInt(this.value) < 0) {
            this.value = 0;
        }

        var cgSortableDiv = $(this).closest('.cgSortableDiv');
        var $cg_backend_info_container = $(this).closest('.cg_backend_info_container');


        var cg_rating_value_text = cgSortableDiv.find('.cg_rating_value').text();
        cg_rating_value_width = cg_rating_value_text.length * 8;

        var originValue = parseInt(cgSortableDiv.find('.cg_value_origin').val());

        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8);
            var addValue = parseInt(this.value);
        }
        else {
            var addValue = parseInt(this.value);
        }

        if (isNaN(addValue)) {
            addValue = 0;
        }

        if (isNaN(originValue)) {
            originValue = 0;
        }

        var newValue = originValue + addValue;

        if (newValue < 1) {
            cgSortableDiv.find('.cg_rating_center img').attr('src', cgJsClassAdmin.gallery.vars.setStarOffSrc);
            newValue = 0;
        }
        else {
            cgSortableDiv.find('.cg_rating_center img[src$="_reduced_with_border.png"]').attr('src', cgJsClassAdmin.gallery.vars.setStarOnSrc);

        }

        cgSortableDiv.find('.cg_rating_value').text(newValue);
        cgSortableDiv.find('.cg_value_add_one_star').val(addValue).removeClass('cg_disabled_send');

        if (addValue >= 1) {
            $cg_backend_info_container.find('.cg_rating_value_countR_additional_votes').text(addValue).removeClass('cg_hide');
        } else {
            $cg_backend_info_container.find('.cg_rating_value_countR_additional_votes').addClass('cg_hide');
        }


    });

    $(document).on('input', '#cgGalleryBackendContainer .cg_manipulate_5_star_input', function (e) {

        if (parseInt(this.value) < 0) {
            this.value = 0;
        }

        if (this.value.length > 7) {
            this.value = this.value.slice(0, 7);
            var addValue = this.value;
        }
        else {
            var addValue = this.value;
        }

        if (isNaN(addValue)) {
            addValue = 0;
        }

        $(this).removeClass('cg_disabled_send');

        var $cg_backend_info_container = $(this).closest('.cg_backend_info_container');
        var dataStar = $(this).attr('data-star');

        var container = $(this).closest('.cgSortableDiv');
        var countRbefore = container.find('.cg_value_origin_5_star_count').val();

        var ratingRnew = container.find('.cg_value_origin_5_star_rating').val();

        addValue = addValue.trim();


        countRbefore = countRbefore.trim();
        ratingRnew = ratingRnew.trim();

        addValue = parseInt(addValue);

        countRbefore = parseInt(countRbefore);
        ratingRnew = parseInt(ratingRnew);


        if ($(this).hasClass('cg_manipulate_1_star_number')) {

            var originCountR = container.find('.cg_value_origin_5_only_value_1').val();
            originCountR = originCountR.trim();
            originCountR = parseInt(originCountR);

            if (isNaN(originCountR)) {
                originCountR = 0;
            }

            var valueCountR = originCountR + addValue;

            if (valueCountR < 0) {

                return false;

            }

            container.find('.cg_value_origin_5_star_addCountR1').val(addValue).removeClass('cg_disabled_send');

            container.find('.cg_rating_value_countR1').text(valueCountR);


        }


        if ($(this).hasClass('cg_manipulate_2_star_number')) {

            var originCountR = container.find('.cg_value_origin_5_only_value_2').val();
            originCountR = originCountR.trim();
            originCountR = parseInt(originCountR);

            if (isNaN(originCountR)) {
                originCountR = 0;
            }

            var valueCountR = originCountR + addValue;

            if (valueCountR < 0) {

                return false;

            }

            container.find('.cg_value_origin_5_star_addCountR2').val(addValue).removeClass('cg_disabled_send');

            container.find('.cg_rating_value_countR2').text(valueCountR);

        }


        if ($(this).hasClass('cg_manipulate_3_star_number')) {

            var originCountR = container.find('.cg_value_origin_5_only_value_3').val();
            originCountR = originCountR.trim();
            originCountR = parseInt(originCountR);

            if (isNaN(originCountR)) {
                originCountR = 0;
            }

            var valueCountR = originCountR + addValue;

            if (valueCountR < 0) {

                return false;

            }

            container.find('.cg_value_origin_5_star_addCountR3').val(addValue).removeClass('cg_disabled_send');

            container.find('.cg_rating_value_countR3').text(valueCountR);

        }


        if ($(this).hasClass('cg_manipulate_4_star_number')) {

            var originCountR = container.find('.cg_value_origin_5_only_value_4').val();
            originCountR = originCountR.trim();
            originCountR = parseInt(originCountR);

            if (isNaN(originCountR)) {
                originCountR = 0;
            }

            var valueCountR = originCountR + addValue;

            if (valueCountR < 0) {

                return false;

            }

            container.find('.cg_value_origin_5_star_addCountR4').val(addValue).removeClass('cg_disabled_send');

            container.find('.cg_rating_value_countR4').text(valueCountR);

        }


        if ($(this).hasClass('cg_manipulate_5_star_number')) {

            var originCountR = container.find('.cg_value_origin_5_only_value_5').val();
            originCountR = originCountR.trim();
            originCountR = parseInt(originCountR);

            if (isNaN(originCountR)) {
                originCountR = 0;
            }

            var valueCountR = originCountR + addValue;

            if (valueCountR < 0) {

                return false;

            }

            container.find('.cg_value_origin_5_star_addCountR5').val(addValue).removeClass('cg_disabled_send');

            container.find('.cg_rating_value_countR5').text(valueCountR);

        }

        if (addValue >= 1) {
            $cg_backend_info_container.find('.cg_rating_value_countR_additional_votes_' + dataStar + '').text(addValue).removeClass('cg_hide');
        } else {
            $cg_backend_info_container.find('.cg_rating_value_countR_additional_votes_' + dataStar + '').addClass('cg_hide');
        }


        var addValue = 0;

        //  console.log('ratingRnew: '+ratingRnew);

        var addCountRtotal = 0;
        container.find('.cg_stars_overview .cg_rating_value_countR_additional_votes').each(function (index) {
            addCountRtotal = addCountRtotal + parseInt($(this).text());
        });

/*        if (addCountRtotal > 0) {
            container.find('.cg_rating_value_countR_additional_votes_total').removeClass('cg_hide').text(addCountRtotal);
        } else {
            container.find('.cg_rating_value_countR_additional_votes_total').removeClass('cg_hide').text(0);
        }*/

        container.find('.cg_value_origin_5_star_to_cumulate').each(function (index) {

            var r = index + 1;

            if ($(this).val() == '') {

                var valueToAdd = 0;

            }
            else {

                var valueToAdd = parseInt($(this).val());

            }


            if ($(this).hasClass('cg_value_origin_5_star_addCountR1')) {
                //   console.log('ratingRnew1: '+valueToAdd);

                ratingRnew = ratingRnew + valueToAdd * 1;
                //   console.log('ratingRnew1ratingRnew: '+ratingRnew);


            }
            if ($(this).hasClass('cg_value_origin_5_star_addCountR2')) {

                ratingRnew = ratingRnew + valueToAdd * 2;

            }
            if ($(this).hasClass('cg_value_origin_5_star_addCountR3')) {

                ratingRnew = ratingRnew + valueToAdd * 3;

            }
            if ($(this).hasClass('cg_value_origin_5_star_addCountR4')) {

                ratingRnew = ratingRnew + valueToAdd * 4;

            }
            if ($(this).hasClass('cg_value_origin_5_star_addCountR5')) {
                ratingRnew = ratingRnew + valueToAdd * 5;
            }


            if (valueToAdd >= 1 || valueToAdd <= 1) {
                addValue = addValue + valueToAdd;
            }

            if (r == 5) {


                cgJsClassAdmin.gallery.vars.addValue = addValue;
                cgJsClassAdmin.gallery.vars.ratingRnew = ratingRnew;

                return;
            }

        });

        var countRnew = countRbefore + parseInt(cgJsClassAdmin.gallery.vars.addValue);

        var average = cgJsClassAdmin.gallery.vars.ratingRnew / countRnew;
        average = Math.round(average * 10) / 10;
        if(average<1){average=0;}

        $cg_backend_info_container.find('.cg_rating_value_countR_average').text(average)

        var stars = {};

        stars.star1 = 'cg_gallery_rating_div_one_star_off';
        stars.star2 = 'cg_gallery_rating_div_one_star_off';
        stars.star3 = 'cg_gallery_rating_div_one_star_off';
        stars.star4 = 'cg_gallery_rating_div_one_star_off';
        stars.star5 = 'cg_gallery_rating_div_one_star_off';

        if (average >= 1) {
            stars.star1 = 'cg_gallery_rating_div_one_star_on'
        }
        if (average >= 1.25 && average < 1.75) {
            stars.star2 = 'cg_gallery_rating_div_one_star_half_off'
        }

        if (average >= 1.75) {
            stars.star2 = 'cg_gallery_rating_div_one_star_on'
        }
        if (average >= 2.25 && average < 2.75) {
            stars.star3 = 'cg_gallery_rating_div_one_star_half_off'
        }

        if (average >= 2.75) {
            stars.star3 = 'cg_gallery_rating_div_one_star_on'
        }
        if (average >= 3.25 && average < 3.75) {
            stars.star4 = 'cg_gallery_rating_div_one_star_half_off'
        }

        if (average >= 3.75) {
            stars.star4 = 'cg_gallery_rating_div_one_star_on'
        }
        if (average >= 4.25 && average < 4.75) {
            stars.star5 = 'cg_gallery_rating_div_one_star_half_off'
        }

        if (average >= 4.75) {
            stars.star5 = 'cg_gallery_rating_div_one_star_on'
        }

        // all classes has to be removed before the class which should affect will be added
        $cg_backend_info_container.find('.cg_rating_5_star_img_div_one_star').removeClass('cg_gallery_rating_div_one_star_off cg_gallery_rating_div_one_star_half_off cg_gallery_rating_div_one_star_on').addClass(stars.star1);
        $cg_backend_info_container.find('.cg_rating_5_star_img_div_two_star').removeClass('cg_gallery_rating_div_one_star_off cg_gallery_rating_div_one_star_half_off cg_gallery_rating_div_one_star_on').addClass(stars.star2);
        $cg_backend_info_container.find('.cg_rating_5_star_img_div_three_star').removeClass('cg_gallery_rating_div_one_star_off cg_gallery_rating_div_one_star_half_off cg_gallery_rating_div_one_star_on').addClass(stars.star3);
        $cg_backend_info_container.find('.cg_rating_5_star_img_div_four_star').removeClass('cg_gallery_rating_div_one_star_off cg_gallery_rating_div_one_star_half_off cg_gallery_rating_div_one_star_on').addClass(stars.star4);
        $cg_backend_info_container.find('.cg_rating_5_star_img_div_five_star').removeClass('cg_gallery_rating_div_one_star_off cg_gallery_rating_div_one_star_half_off cg_gallery_rating_div_one_star_on').addClass(stars.star5);

        container.find('.cg_rating_value_countR_content').text(countRnew);

    });


    $(document).on('input', '#cgGalleryBackendContainer .cg_image_title, .cg_image_description, .cg_manipulate_plus_value, .cg_manipulate_5_star_input', function () {

        if (!cgJsClassAdmin.gallery.vars.inputsChanged) {
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');
            cgJsClassAdmin.gallery.vars.inputsChanged = true;
        }

    });

    $(document).on('change', '#cgGalleryBackendContainer .cg_category_select', function () {

        if (!cgJsClassAdmin.gallery.vars.selectChanged) {
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');
            cgJsClassAdmin.gallery.vars.selectChanged = true;
        }

    });

    // without cgGalleryBackendContainer this one!!!! because is over!
    $(document).on('click', '#cgAddFieldsPressedAfterContentModification.cg_active', function (e) {

        if ($(e.target).closest('#cgAddFieldsPressedAfterContentModificationContent').length || $(e.target).is('#cgAddFieldsPressedAfterContentModificationContent')) {

        } else {

            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_hide');

        }

    });

    // without cgGalleryBackendContainer this one!!!! because is over!
    $(document).on('click', '#cgAddFieldsPressedAfterContentModificationContent .cg_message_close', function (e) {

        $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_hide');

    });

    $(document).on('click', '#cgGalleryBackendContainer .cg_fields_div_add_fields', function (e) {

        if (cgJsClassAdmin.gallery.vars.inputsChanged || cgJsClassAdmin.gallery.vars.selectChanged) {
            e.preventDefault();
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').removeClass('cg_hide');
        }

    });

    // cgPreviewToDelete logic

    $(document).on('click', '#cgGallerySubmit #cg_gallery_backend_submit', function (e) {

        var $highlightedRemoveable = $(' .cg_sortable_div.highlightedRemoveable');

        if($highlightedRemoveable.length){
            e.preventDefault();

            var $cgPreviewImagesToDeleteContainer = $('#cgPreviewImagesToDeleteContainer');
            var $cgPreviewImagesToDeleteContainerFadeBackground = $('#cgPreviewImagesToDeleteContainerFadeBackground');
            var $cgPreviewImagesToDeleteContainerOverview = $cgPreviewImagesToDeleteContainer.find('#cgPreviewImagesToDeleteContainerOverview');
            $cgPreviewImagesToDeleteContainerOverview.empty();

            $highlightedRemoveable.find('.cg_backend_image_full_size_target').each(function (){

                var $element = $(this).clone();

                $element.removeAttr('style');

                var $img = $element.find('img');
                var backgroundUrl = $img.attr('src');
                $img.remove();
                $element.find('a').remove();

                var $divContainer = $('<div class="cg_backend_image_full_size_target_container"></div>');
                $element.css('background','url("'+backgroundUrl+'") center center no-repeat');

                $divContainer.append($element);
                $divContainer.find('.cg_backend_image_full_size_target');

                $cgPreviewImagesToDeleteContainerOverview.append($divContainer);

            });

            $cgPreviewImagesToDeleteContainer.removeClass('cg_hide');$cgPreviewImagesToDeleteContainerFadeBackground.removeClass('cg_hide');
            $cgPreviewImagesToDeleteContainer.addClass('cg_active');$cgPreviewImagesToDeleteContainerFadeBackground.addClass('cg_active');
            $('#cgPreviewImagesToDeleteOriginalSourceDeleteConfirmCheckboxMessage').addClass('cg_hide');

            $('#cgPreviewImagesToDeleteOriginalSourceDeleteConfirmCheckbox').prop('checked',false);

            $("#cgPreviewImagesToDeleteContainer").animate({scrollTop: jQuery('#cgPreviewImagesToDeleteButtonContinueWithDeletingOriginalSource').position().top}, 0);

        }

    });

    var getCgPreviewToDeleteBoxes = function (){

       var cgPreviewToDeleteBoxes = $('#cgPreviewImagesToDeleteContainer, #cgPreviewImagesToDeleteContainerFadeBackground');

        return cgPreviewToDeleteBoxes;

    }

    // without cgGalleryBackendContainer this one!!!! because is over!
    $(document).on('click', '#cgPreviewImagesToDeleteContainerFadeBackground.cg_active', function (e) {

        if ($(e.target).closest('#cgPreviewImagesToDeleteContainer').length || $(e.target).is('#cgPreviewImagesToDeleteContainer')) {

        } else {

            getCgPreviewToDeleteBoxes().addClass('cg_hide');
            getCgPreviewToDeleteBoxes().removeClass('cg_active');

        }

    });

    $(document).on('click', '#cgPreviewImagesToDeleteContainer .cg_message_close', function (e) {

        getCgPreviewToDeleteBoxes().addClass('cg_hide');
        getCgPreviewToDeleteBoxes().removeClass('cg_active');

    });

    $(document).on('click', '#cgPreviewImagesToDeleteButtonGoBackToEdit', function (e) {

        getCgPreviewToDeleteBoxes().addClass('cg_hide');
        getCgPreviewToDeleteBoxes().removeClass('cg_active');

    });

    $(document).on('click', '#cgPreviewImagesToDeleteButtonContinue', function (e) {

        $('#cgGalleryForm').submit();
        getCgPreviewToDeleteBoxes().addClass('cg_hide');
        getCgPreviewToDeleteBoxes().removeClass('cg_active');

    });

    $(document).on('click', '#cgPreviewImagesToDeleteButtonContinueWithDeletingOriginalSource .cg_image_action_span', function (e) {

        if(!$('#cgPreviewImagesToDeleteOriginalSourceDeleteConfirmCheckbox').prop('checked')){
            e.preventDefault();
            $('#cgPreviewImagesToDeleteOriginalSourceDeleteConfirmCheckboxMessage').removeClass('cg_hide');
        }else{
            var $cgGalleryForm = $('#cgGalleryForm');
            $cgGalleryForm.prepend('<input type="hidden" name="cgDeleteOriginalImageSourceAlso" id="cgDeleteOriginalImageSourceAlso" value="true">');
            $cgGalleryForm.submit();

           setTimeout(function (){
               // to go sure remove it straight away
               $('#cgDeleteOriginalImageSourceAlso').remove();
           },10);

            getCgPreviewToDeleteBoxes().addClass('cg_hide');
            getCgPreviewToDeleteBoxes().removeClass('cg_active');
        }

    });

    // cgPreviewToDelete logic --- END

    $(document).on('change', '#cgGalleryBackendContainer .cg_long_text, #cgGalleryBackendContainer .cg_short_text, #cgGalleryBackendContainer .cg_category_select', function () {
        $(this).removeClass('cg_disabled_send');
    });


    $(document).on('click', '#cgGalleryBackendContainer .cg_title_icon', function () {

        var post_title = $(this).closest('.cg_image_title_container').find('.post_title').val();
        if (post_title === '' || typeof post_title == 'undefined') {
            //$(this).parent().find('.cg_image_title').addClass('cg_value_changed');
            if ($(this).closest('.cg_image_title_container').find('.cg_image_title').val() == '') {
                $(this).closest('.cg_image_title_container').find('.cg_image_title').attr('placeholder', 'No WordPress title available');
            }
        }
        else {
            cgJsClassAdmin.gallery.vars.inputsChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');
            var val = $(this).closest('.cg_image_title_container').find('.cg_image_title').val();
            $(this).closest('.cg_image_title_container').find('.cg_image_title').val(val + ' ' + post_title).addClass('cg_value_changed');
        }

        $(this).closest('.cg_image_title_container').find('.cg_image_title').removeClass('cg_disabled_send');

    });

    $(document).on('click', '#cgGalleryBackendContainer .cg_description_icon', function () {

        var post_description = $(this).closest('.cg_image_description_container').find('.post_description').val();
        post_description = post_description.replace(/(<([^>]+)>)/ig, "");

        if (post_description === '' || typeof post_description == 'undefined') {
            //$(this).parent().parent().find('.cg_image_description').addClass('cg_value_changed');
            if ($(this).closest('.cg_image_description_container').find('.cg_image_description').val() == '') {
                $(this).closest('.cg_image_description_container').find('.cg_image_description').attr('placeholder', 'No WordPress description available').addClass('cg_value_changed');
            }
        }
        else {
            cgJsClassAdmin.gallery.vars.inputsChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');
            var val = $(this).closest('.cg_image_description_container').find('.cg_image_description').val();
            $(this).closest('.cg_image_description_container').find('.cg_image_description').val(val + ' ' + post_description).addClass('cg_value_changed');
        }

        $(this).closest('.cg_image_description_container').find('.cg_image_description').removeClass('cg_disabled_send');


    });


    $(document).on('click', '#cgGalleryBackendContainer .cg_excerpt_icon', function () {

        var post_excerpt = $(this).closest('.cg_image_excerpt_container').find('.post_excerpt').val();

        if (post_excerpt === '' || typeof post_excerpt == 'undefined') {
            //$(this).parent().parent().find('.cg_image_excerpt').addClass('cg_value_changed');
            if ($(this).closest('.cg_image_excerpt_container').find('.cg_image_excerpt').val() == '') {
                $(this).closest('.cg_image_excerpt_container').find('.cg_image_excerpt').attr('placeholder', 'No WordPress excerpt available');
            }
        }
        else {
            cgJsClassAdmin.gallery.vars.inputsChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');
            var val = $(this).closest('.cg_image_excerpt_container').find('.cg_image_excerpt').val();
            $(this).closest('.cg_image_excerpt_container').find('.cg_image_excerpt').val(val + ' ' + post_excerpt).addClass('cg_value_changed');
        }

        $(this).closest('.cg_image_excerpt_container').find('.cg_image_excerpt').removeClass('cg_disabled_send');

    });


// Nicht löschen, wurde ursprünglich dazu markiert alle Felder auswählen zu lassen die im Slider gezeigt werden sollen, Logik könnte noch nützlich sein! --- ENDE


    //alert(allFieldClasses);

    function countChar(val) {
        var len = val.value.length;
        if (len >= 1000) {
            val.value = val.value.substring(0, 1000);
        } else {
            $('#charNum').text(1000 - len);
        }
    };


    $(document).on('click', '.clickMore', function () {
        // Zeigen oder Verstecken:

        $(this).next().slideDown('slow');
        $(this).next(".mehr").next(".clickBack").toggle();
        $(this).hide();


    });

    $(document).on('click', '.clickBack', function () {
        $(this).prev().slideUp('slow');
        $(this).prev(".mehr").prev(".clickMore").toggle();
        $(this).hide();


    });

    $(document).on('click', '.cg_image_checkbox_activate', function () {

        $(this).closest('.informdiv').find('.cg_image_checkbox_checkbox').prop('disabled', true);

        $('.cg_image_checkbox_deactivate_all, .cg_image_checkbox_delete_all, .cg_image_checkbox_move_all').removeClass('cg_active');
        $(this).closest('.informdiv').find('.cg_image_checkbox_deactivate, .cg_image_checkbox_delete, .cg_image_checkbox_move').removeClass('cg_active');

        cgJsClassAdmin.gallery.vars.selectChanged = true;
        $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

        var chooseAction = $("#chooseAction1 option:selected").val();

        $(this).closest('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

        if ($(this).hasClass('cg_active')) {

            $(this).removeClass('cg_active');
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', true);

            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');

            $('.cg_image_checkbox_activate_all').removeClass('cg_active');

        } else {

            $(this).addClass('cg_active');
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', false);

            $(this).closest('.cgSortableDiv').addClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');

            if(!$('#cgSortable .cg_image_checkbox_move.cg_active').length){
                $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);
            }

        }

    });

    $(document).on('click', '.cg_image_checkbox_activate_all', function () {


        var $cgGalleryBackendContainer = $('#cgGalleryBackendContainer');

        if (!$(this).hasClass('cg_active')) {// then activate all

            $(this).parent().find('.cg_image_checkbox').removeClass('cg_active');
            $(this).addClass('cg_active');


            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate .cg_image_checkbox_checkbox').prop('disabled', false);

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate').addClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

            $cgGalleryBackendContainer.find('.cgSortableDiv.cg_sortable_div_inactive').addClass('highlightedActivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedDeactivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedRemoveable');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedMoveable');

            $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);

        } else {

            $(this).removeClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate').removeClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedActivate');

        }


    });

    $(document).on('click', '.cg_image_checkbox_deactivate', function () {

        $(this).closest('.informdiv').find('.cg_image_checkbox_checkbox').prop('disabled', true);

        $('.cg_image_checkbox_activate_all, .cg_image_checkbox_delete_all, .cg_image_checkbox_move_all').removeClass('cg_active');
        $(this).closest('.informdiv').find('.cg_image_checkbox_activate, .cg_image_checkbox_delete, .cg_image_checkbox_move').removeClass('cg_active');


        cgJsClassAdmin.gallery.vars.selectChanged = true;
        $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

        var chooseAction = $("#chooseAction1 option:selected").val();

        $(this).closest('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

        if ($(this).hasClass('cg_active')) {

            $(this).removeClass('cg_active');
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', true);

            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');

            $('.cg_image_checkbox_deactivate_all').removeClass('cg_active');

        } else {

            $(this).addClass('cg_active');
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', false);

            $(this).closest('.cgSortableDiv').addClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');


            if(!$('#cgSortable .cg_image_checkbox_move.cg_active').length){
                $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);
            }

        }

    });

    $(document).on('click', '.cg_image_checkbox_deactivate_all', function () {

        var $cgGalleryBackendContainer = $('#cgGalleryBackendContainer');

        if (!$(this).hasClass('cg_active')) {// then deactivate all

            $(this).parent().find('.cg_image_checkbox').removeClass('cg_active');
            $(this).addClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate .cg_image_checkbox_checkbox').prop('disabled', false);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate .cg_image_checkbox_checkbox').prop('disabled', true);

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate').addClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate').removeClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

            $cgGalleryBackendContainer.find('.cgSortableDiv.cg_sortable_div_active').addClass('highlightedDeactivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedActivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedRemoveable');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedMoveable');

            $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);

        } else {

            $(this).removeClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate').removeClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedDeactivate');

        }


    });

    $(document).on('click', '.cg_image_checkbox_winner_all', function () {

        var $cgGalleryBackendContainer = $('#cgGalleryBackendContainer');

        $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

        cgJsClassAdmin.gallery.vars.selectChanged = true;

        if (!$(this).hasClass('cg_active')) {
            $(this).parent().find('.cg_image_checkbox').removeClass('cg_active');
            $(this).addClass('cg_active');
       //     $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true').removeClass('cg_active');
    //        $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false').addClass('cg_active');
        //    $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false .cg_status_winner_checkbox').prop('disabled', false);

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false:not(.cg_active)').each(function (){
                $(this).addClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', false);
            });

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true.cg_active').each(function (){
                $(this).removeClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', true);
            });


        } else {
            $(this).removeClass('cg_active');
  //          $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false').removeClass('cg_active');
    //        $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false .cg_status_winner_checkbox').prop('disabled', true);

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false.cg_active').each(function (){
                $(this).removeClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', true);
            });

           $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true:not(.cg_active)').each(function (){
                $(this).addClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', false);
            });

        }

    });

    $(document).on('click', '.cg_image_checkbox_not_winner_all', function () {

        var $cgGalleryBackendContainer = $('#cgGalleryBackendContainer');

        $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

        cgJsClassAdmin.gallery.vars.selectChanged = true;

        if (!$(this).hasClass('cg_active')) {
            $(this).parent().find('.cg_image_checkbox').removeClass('cg_active');
            $(this).addClass('cg_active');
        //    $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true').addClass('cg_active');
     //       $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true .cg_status_winner_checkbox').prop('disabled', false);

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true:not(.cg_active)').each(function (){
                $(this).addClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', false);
            });

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false.cg_active').each(function (){
                $(this).removeClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', true);
            });

        } else {
            $(this).removeClass('cg_active');
      //      $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true').removeClass('cg_active');
           // $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true .cg_status_winner_checkbox').prop('disabled', true);

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_true.cg_active').each(function (){
                $(this).removeClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', true);
            });

            $cgGalleryBackendContainer.find('.cg_sortable_div .cg_status_winner.cg_status_winner_false:not(.cg_active)').each(function (){
                $(this).addClass('cg_active');
                $(this).find('.cg_status_winner_checkbox').prop('disabled', false);
            });

        }

    });

    $(document).on('click', '.cg_image_checkbox_delete', function () {

        $(this).closest('.informdiv').find('.cg_image_checkbox_checkbox').prop('disabled', true);

        $('.cg_image_checkbox_activate_all, .cg_image_checkbox_deactivate_all, .cg_image_checkbox_move_all').removeClass('cg_active');
        $(this).closest('.informdiv').find('.cg_image_checkbox_activate, .cg_image_checkbox_deactivate, .cg_image_checkbox_move').removeClass('cg_active');

        cgJsClassAdmin.gallery.vars.selectChanged = true;
        $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

        var chooseAction = $("#chooseAction1 option:selected").val();

        $(this).closest('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

        if ($(this).hasClass('cg_active')) {
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', true);
            $(this).removeClass('cg_active');

            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');

            $('.cg_image_checkbox_delete_all').removeClass('cg_active');

        } else {

            $(this).addClass('cg_active');
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', false);

            $(this).closest('.cgSortableDiv').addClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');

            if(!$('#cgSortable .cg_image_checkbox_move.cg_active').length){
                $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);
            }

        }

    });


    $(document).on('click', '.cg_image_checkbox_delete_all', function () {

        var $cgGalleryBackendContainer = $('#cgGalleryBackendContainer');

        if (!$(this).hasClass('cg_active')) {// then delete all

            $(this).parent().find('.cg_image_checkbox').removeClass('cg_active');
            $(this).addClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete .cg_image_checkbox_checkbox').prop('disabled', false);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move .cg_image_checkbox_checkbox').prop('disabled', true);

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete').addClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move').removeClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

            $cgGalleryBackendContainer.find('.cgSortableDiv').addClass('highlightedRemoveable');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedActivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedDeactivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedMoveable');

            $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);

        } else {

            $(this).removeClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete').removeClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedRemoveable');

        }

    });

    $(document).on('click', '.cg_image_checkbox_move', function () {

        $(this).closest('.informdiv').find('.cg_image_checkbox_checkbox').prop('disabled', true);

        $('.cg_image_checkbox_activate_all, .cg_image_checkbox_deactivate_all, .cg_image_checkbox_delete_all').removeClass('cg_active');
        $(this).closest('.informdiv').find('.cg_image_checkbox_activate, .cg_image_checkbox_deactivate, .cg_image_checkbox_delete').removeClass('cg_active');

        cgJsClassAdmin.gallery.vars.selectChanged = true;
        $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

        var chooseAction = $("#chooseAction1 option:selected").val();

        $(this).closest('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

        if ($(this).hasClass('cg_active')) {// then do not move
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', true);
            $(this).removeClass('cg_active');

            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').removeClass('highlightedMoveable');

            $('.cg_image_checkbox_move_all').removeClass('cg_active');

            if(!$('#cgSortable .cg_image_checkbox_move.cg_active').length){
                $('#cgMoveSelect').addClass('cg_hide').find('select').prop('disabled',true);
            }

        } else {

            $(this).addClass('cg_active');
            $(this).find('.cg_image_checkbox_checkbox').prop('disabled', false);

            $(this).closest('.cgSortableDiv').removeClass('highlightedActivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedDeactivate');
            $(this).closest('.cgSortableDiv').removeClass('highlightedRemoveable');
            $(this).closest('.cgSortableDiv').addClass('highlightedMoveable');

            $('#cgMoveSelect').removeClass('cg_hide').find('select').prop('disabled',false);

        }

    });


    $(document).on('click', '.cg_image_checkbox_move_all', function () {

        var $cgGalleryBackendContainer = $('#cgGalleryBackendContainer');

        if (!$(this).hasClass('cg_active')) {// then move all

            $(this).parent().find('.cg_image_checkbox').removeClass('cg_active');
            $(this).addClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move .cg_image_checkbox_checkbox').prop('disabled', false);

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_deactivate').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_activate').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_delete').removeClass('cg_active');
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move').addClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');

            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedActivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedDeactivate');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedRemoveable');
            $cgGalleryBackendContainer.find('.cgSortableDiv').addClass('highlightedMoveable');

            $('#cgMoveSelect').removeClass('cg_hide').find('select').prop('disabled',false);

        } else {

            $(this).removeClass('cg_active');

            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move .cg_image_checkbox_checkbox').prop('disabled', true);
            $cgGalleryBackendContainer.find('.informdiv').find('.cg_image_checkbox_move').removeClass('cg_active');

            cgJsClassAdmin.gallery.vars.selectChanged = true;
            $('#cgAddFieldsPressedAfterContentModification, #cgAddFieldsPressedAfterContentModificationContent').addClass('cg_active');

            $cgGalleryBackendContainer.find('.cg_sortable_div').find(cgJsClassAdmin.gallery.vars.cgChangedValueSelectorInTargetedSortableDiv).addClass('cg_value_changed');
            $cgGalleryBackendContainer.find('.cgSortableDiv').removeClass('highlightedMoveable');

        }

    });


// Duplicate email to a hidden field for form


    $(document).on('change', '.email', function () {

        var email = $(this).val();
        $(this).parent().find(".email-clone").val(email);

    });

// Duplicate email to a hidden field for form -- END 


    $(document).on('click', 'div input #activate', function () {
        $("input #inform").prop("disabled", this.checked);
    });

    /*function informAll(){

    //alert(arg);
    alert(arg1);

    if($("#informAll").is( ":checked" )){
    $( "input[class*=inform]").removeAttr("checked",true);
    $( "input[class*=inform]").click();
    }

    else{
    $( "input[class*=inform]").click();

    }

    }*/


// show exif data

    /*    $(document).on('click','.cg-exif-container button',function () {

            $(this).closest('.cg-exif-container').find('.cg-exif-append').show();

        });*/


// show exif data --- ENDE

    $(document).on('click', '.cg_category_checkbox_images_area input[type="checkbox"]', function () {

        var $element = $(this);

        //   setTimeout(function () {
        if (!$element.prop('checked') == true) {
            $element.addClass('cg_checked');
        } else {
            $element.removeClass('cg_checked');
        }
        //    },1000);


    });


    // save category changes


    $(document).on('click', '#cgSaveCategoriesForm', function () {

        var form = document.getElementById('cgCategoriesForm');
        var formPostData = new FormData(form);

        $('#cgSaveCategoriesLoader').removeClass('cg_hide');

        setTimeout(function () {

            $.ajax({
                url: 'admin-ajax.php',
                method: 'post',
                data: formPostData,
                dataType: null,
                contentType: false,
                processData: false
            }).done(function (response) {
                $('#cgSaveCategoriesLoader').addClass('cg_hide');
                $("#cg_changes_saved_categories").show().fadeOut(4000);

            }).fail(function (xhr, status, error) {

                $('#cgSaveCategoriesLoader').addClass('cg_hide');
                var test = 1;

            }).always(function () {

                var test = 1;

            });

        }, 1000);

    });

    // check active images count by categories

    $(document).on('click', '.cg-categories-check', function () {

        var totalVisibleActivatedImagesCount = 0;

        $('.cg-categories-check').each(function () {
            if ($(this).prop('checked')) {
                totalVisibleActivatedImagesCount = totalVisibleActivatedImagesCount + parseInt($(this).attr('data-cg-images-in-category-count'));
            }
        });

        $('#cgCategoryTotalActiveImagesValue').text(totalVisibleActivatedImagesCount);

    });

    // init date time fields

    $(document).on('keydown', '.cg_input_date_class', function (e) {

        e.preventDefault();

        if (e.which == 46 || e.which == 8) {// back, delete
            this.value = '';
        }

    });

    // make winner

    $(document).on('click', '.cg_status_winner', function (e) {// then set to true

        e.preventDefault();

        if ($(this).hasClass('cg_active')) {
            $(this).removeClass('cg_active');
            $(this).closest('.cg_sortable_div').find('.cg_status_winner_checkbox').prop('disabled', true);
        } else {
            $(this).addClass('cg_active');
            $(this).closest('.cg_sortable_div').find('.cg_status_winner_checkbox').prop('disabled', false);
        }

    });

    // rotate events
    $(document).on('click','#cgRotateSource',function () {
        if($('#cgImgThumbContainerMain').length){
            //   cgSameHeightDivImage();
            if(!$('#cgImgSource').hasClass('cg90degree') && !$('#cgImgSource').hasClass('cg180degree') && !$('#cgImgSource').hasClass('cg270degree')){
                $('#cgImgSource').addClass('cg90degree');
                $('#rSource').val(90);
            }
            else if($('#cgImgSource').hasClass('cg90degree')){
                $('#cgImgSource').removeClass('cg90degree');
                $('#cgImgSource').addClass('cg180degree');
                $('#rSource').val(180);
            }
            else if($('#cgImgSource').hasClass('cg180degree')){
                $('#cgImgSource').removeClass('cg180degree');
                $('#cgImgSource').addClass('cg270degree');
                $('#rSource').val(270);
            }
            else if($('#cgImgSource').hasClass('cg270degree')){
                $('#cgImgSource').removeClass('cg270degree');
                $('#rSource').val(0);
            }
        }
    });

    $(document).on('click','#cgResetSource',function () {
        if($('#cgImgThumbContainerMain').length){
            cgJsClassAdmin.gallery.functions.cgRotateSameHeightDivImage($);
            $('#cgImgSource').removeClass('cg90degree');
            $('#cgImgSource').removeClass('cg180degree');
            $('#cgImgSource').removeClass('cg270degree');
            $('#rSource').val(0);
        }
    });

    $(document).on('click','#cgRotateThumb',function () {
        if($('#cgImgThumbContainerMain').length){
            if(!$('#cgImgThumb').hasClass('cg90degree') && !$('#cgImgThumb').hasClass('cg180degree') && !$('#cgImgThumb').hasClass('cg270degree')){
                $('#cgImgThumb').addClass('cg90degree');
                $('#rThumb').val(90);
            }
            else if($('#cgImgThumb').hasClass('cg90degree')){
                $('#cgImgThumb').removeClass('cg90degree');
                $('#cgImgThumb').addClass('cg180degree');
                $('#rThumb').val(180);
            }
            else if($('#cgImgThumb').hasClass('cg180degree')){
                $('#cgImgThumb').removeClass('cg180degree');
                $('#cgImgThumb').addClass('cg270degree');
                $('#rThumb').val(270);
            }
            else if($('#cgImgThumb').hasClass('cg270degree')){
                $('#cgImgThumb').removeClass('cg270degree');
                $('#rThumb').val(0);
            }
        }
    });

    $(document).on('click','#cgResetThumb',function () {
        if($('#cgImgThumbContainerMain').length){
            $('#cgImgThumb').removeClass('cg90degree');
            $('#cgImgThumb').removeClass('cg180degree');
            $('#cgImgThumb').removeClass('cg270degree');
            $('#rThumb').val(0);
        }
    });

    // rotate events end


});