cgJsClass.gallery.views.switchView = {
    init: function () {

        jQuery(document).on('click', '.cg_header .cg_gallery_thumbs_control .cg_view_switcher', function () {

            var $element = jQuery(this);

            if ($element.hasClass('cg_view_switcher_on')) {
                return;
            }

            var mainCGallery = $element.closest('.mainCGdiv');
            var gid = mainCGallery.attr('data-cg-gid');

            // falls ein Bild geöffnet ist, muss alles zurückgesetzt werden!!!!
            if (cgJsData[gid].vars.openedRealId > 0 && cgJsData[gid].vars.currentLook != 'blog') {
                cgJsClass.gallery.views.close(gid);
            }
            cgJsData[gid].vars.openedRealId = 0;

            // !important, because display flex might be set if thumb view was used!
            cgJsData[gid].vars.mainCGallery.removeClass('cg_thumb_look');
            // is used in blog view
            cgJsData[gid].vars.mainCGdiv.removeClass('cg_margin_0_auto');

            cgJsData[gid].vars.cgCenterDivLastHeight = null;

            cgJsClass.gallery.vars.switchViewsClicked = true;
            cgJsData[gid].vars.openedGalleryImageOrder = null;
            // cgJsData[gid].vars.cgCenterDiv.css('display','none');

            // mainCGallery.find('.cg_view_switcher_off').removeClass('cg_hide');
            //mainCGallery.find('.cg_view_switcher_on').addClass('cg_hide');

            var $mainCGdiv = cgJsData[gid].vars.mainCGdiv;

            if (cgJsData[gid].vars.currentLook == 'blog') {
                cgJsClass.gallery.blogLogic.reset(gid);
            }

            var previousLook = cgJsData[gid].vars.currentLook;

            //     console.log($mainCGdiv.find('.cg_gallery_thumbs_control').height());

            //     $mainCGdiv.find('.cg_gallery_view_sort_control').height($mainCGdiv.find('.cg_sort_div').height());
            //      $mainCGdiv.find('.cg_thumbs_and_categories_control').height($mainCGdiv.find('.cg_gallery_thumbs_control').height());
            $mainCGdiv.find('.cg_gallery_thumbs_control').height($mainCGdiv.find('.cg_gallery_thumbs_control').height());

            cgJsData[gid].vars.cgCenterDivLastHeight = null;

            // !IMPORTANT: zuerst das ausführen! Ansonsten scheint Höheberechnung problematisch wegen box-sizing was zum Springen des Contents führt!
            mainCGallery.find('.cg_view_switcher_on').addClass('cg_hide');

            mainCGallery.find('.cg_view_switcher_off').removeClass('cg_hide');
            mainCGallery.find('.mainCGslider').addClass('cg_hide');

            $element.addClass('cg_hide');

            // Cut data here or something like this if data length higher then PicsPerSite
            var $step = cgJsData[gid].vars.mainCGdiv.find('#cgFurtherImagesContainerDiv' + gid).find('.cg_further_images[data-cg-step="1"]').removeClass('cg_further_images_selected');
            // var $step = jQuery('#cgFurtherImagesContainerDiv'+gid).find('.cg_further_images[data-cg-step='+cgJsData[gid].vars.currentStep+']');

            if (!$element.hasClass('cg_view_slider')) {
                cgJsData[gid].vars.mainCGdiv.removeClass('cg-slider-view');
                cgJsData[gid].vars.mainCGallery.removeClass('cg_slider');
            }

            if ($element.hasClass('cg_view_height')) {
                $mainCGdiv.find('.cg_further_images_container').removeClass('cg_hide');
                mainCGallery.find('.cg_view_switcher.cg_view_height.cg_view_switcher_on').removeClass('cg_hide');
                cgJsData[gid].vars.currentLook = 'height';

                if ($step.length >= 1 && cgJsData[gid].vars.sorting != 'search') {
                    $step.addClass('cg_view_change').click();
                } else {
                    if(previousLook=='slider'){
                        cgJsClass.gallery.vars.hasToAppend = true;
                    }
                    cgJsClass.gallery.heightLogic.init(jQuery, gid, null, null, null, true);
                    cgJsClass.gallery.vars.hasToAppend = false;
                }
            }

            if ($element.hasClass('cg_view_thumb')) {
                $mainCGdiv.find('.cg_further_images_container').removeClass('cg_hide');

                mainCGallery.find('.cg_view_switcher.cg_view_thumb.cg_view_switcher_on').removeClass('cg_hide');
                cgJsData[gid].vars.currentLook = 'thumb';

                if ($step.length >= 1 && cgJsData[gid].vars.sorting != 'search') {
                    $step.addClass('cg_view_change').click();
                } else {
                    if(previousLook=='slider'){
                        cgJsClass.gallery.vars.hasToAppend = true;
                    }
                    cgJsClass.gallery.thumbLogic.init(jQuery, gid, null, null, null, true);
                    cgJsClass.gallery.vars.hasToAppend = false;
                }

            }

            if ($element.hasClass('cg_view_blog')) {

                if (cgJsClass.gallery.vars.fullwindow) {
                    cgJsData[gid].vars.mainCGdiv.removeClass('cg_display_inline_block');
                    cgJsData[gid].vars.mainCGdiv.addClass('cg_margin_0_auto');
                }

                $mainCGdiv.find('.cg_further_images_container').removeClass('cg_hide');

                mainCGallery.find('.cg_view_switcher.cg_view_blog.cg_view_switcher_on').removeClass('cg_hide');
                cgJsData[gid].vars.currentLook = 'blog';
                cgJsData[gid].vars.openedRealId = 0;

                if ($step.length >= 1 && cgJsData[gid].vars.sorting != 'search') {
                    $step.addClass('cg_view_change').click();
                } else {
                    cgJsClass.gallery.blogLogic.init(jQuery, gid, null, null, null, true);
                }

            }

            if ($element.hasClass('cg_view_row')) {
                $mainCGdiv.find('.cg_further_images_container').removeClass('cg_hide');

                mainCGallery.find('.cg_view_switcher.cg_view_row.cg_view_switcher_on').removeClass('cg_hide');
                cgJsData[gid].vars.currentLook = 'row';

                if ($step.length >= 1 && cgJsData[gid].vars.sorting != 'search') {
                    $step.addClass('cg_view_change').click();
                } else {
                    if(previousLook=='slider'){
                        cgJsClass.gallery.vars.hasToAppend = true;
                    }
                    cgJsClass.gallery.rowLogic.init(jQuery, gid, null, null, null, true);
                    cgJsClass.gallery.vars.hasToAppend = false;
                }

            }

            if ($element.hasClass('cg_view_slider')) {

                cgJsData[gid].vars.cgCenterDiv.find('#cgCenterArrowLeft' + gid).addClass('cg-center-arrow-left').removeClass('cg-center-arrow-left-prev-step');

                $mainCGdiv.find('.cg_further_images_container').addClass('cg_hide');

                $mainCGdiv.find('#cgLdsDualRingMainCGdivHide' + gid).removeClass('cg_hide');

                // sisable till slider fully loaded
                $mainCGdiv.find('.cg_gallery_thumbs_control .cg_view_switcher').addClass('cg_disabled');

                mainCGallery.find('.cg_view_switcher.cg_view_slider.cg_view_switcher_on').removeClass('cg_hide');
                cgJsData[gid].vars.currentLook = 'slider';
                cgJsClass.gallery.vars.hasToAppend = true;

                cgJsClass.gallery.views.switchView.sortViewSlider(gid);

                cgJsClass.gallery.thumbLogic.init(jQuery, gid, true, null, null, null, true);

            }


            cgJsClass.gallery.vars.switchViewsClicked = false;

        });


    },
    sortViewSlider: function (gid, cuttedDataSorted) {

        if (typeof cuttedDataSorted == 'dsafdsaf') {

            cgJsData[gid].image = cuttedDataSorted;

            if (cgJsData[gid].vars.sorting == 'random') {
                cgJsData[gid].vars.sortedRandomFullData = cuttedDataSorted;
            } else if (cgJsData[gid].vars.sorting == 'date-desc') {
                cgJsData[gid].vars.sortedDateDescFullData = cuttedDataSorted;
            } else if (cgJsData[gid].vars.sorting == 'date-asc') {
                cgJsData[gid].vars.sortedDateAscFullData = cuttedDataSorted;
            } else if (cgJsData[gid].vars.sorting == 'rating-desc') {
                cgJsData[gid].vars.sortedRatingDescFullData = cuttedDataSorted;
            } else if (cgJsData[gid].vars.sorting == 'rating-asc') {
                cgJsData[gid].vars.sortedRatingAscFullData = cuttedDataSorted;
            } else if (cgJsData[gid].vars.sorting == 'comments-desc') {
                cgJsData[gid].vars.sortedCommentsDescFullData = cuttedDataSorted;
            } else if (cgJsData[gid].vars.sorting == 'comments-asc') {
                cgJsData[gid].vars.sortedCommentsAscFullData = cuttedDataSorted;
            }

        } else {

            if (cgJsData[gid].vars.sorting == 'random') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedRandomFullData;
            } else if (cgJsData[gid].vars.sorting == 'date-desc') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedDateDescFullData;
            } else if (cgJsData[gid].vars.sorting == 'date-asc') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedDateAscFullData;
            } else if (cgJsData[gid].vars.sorting == 'rating-desc') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedRatingDescFullData;
            } else if (cgJsData[gid].vars.sorting == 'rating-asc') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedRatingAscFullData;
            } else if (cgJsData[gid].vars.sorting == 'rating-desc-average') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedRatingDescAverageFullData;
            } else if (cgJsData[gid].vars.sorting == 'rating-asc-average') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedRatingAscAverageFullData;
            } else if (cgJsData[gid].vars.sorting == 'comments-desc') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedCommentsDescFullData;
            } else if (cgJsData[gid].vars.sorting == 'comments-asc') {
                cgJsData[gid].image = cgJsData[gid].vars.sortedCommentsAscFullData;
            } else {
                cgJsData[gid].vars.sorting = 'date-desc';
                cgJsData[gid].image = cgJsClass.gallery.sorting.desc(cgJsData[gid].vars.rawData);
                cgJsClass.gallery.sorting.initSort(gid);
            }

        }

    },
    switch: function () {

    }
};