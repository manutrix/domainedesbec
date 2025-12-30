cgJsClass.gallery.function.search.input = function(){

        jQuery(document).on('input','.cg_search_input',function () {

            var $element = jQuery(this);

            var gid = $element.attr('data-cg-gid');
            var searchInputValue = this.value;

            if(searchInputValue==cgJsData[gid].vars.searchInput){
                // then must be same value, must be empty and then can be returned, otherwise broken gallery might appear
                return;
            }

            // has to be done with timeout otherwise gallery might be broken if fast input remove with remove/back button
            setTimeout(function (){

                if(cgJsClass.gallery.function.general.tools.setWaitingForValues(gid,$element,'input',true)){
                    return;
                }

                cgJsClass.gallery.vars.inputWritten = true;
                cgJsClass.gallery.vars.hasToAppend = true;

                if(cgJsData[gid].vars.currentLook=='blog'){
                    cgJsClass.gallery.blogLogic.reset(gid);
                }

                cgJsData[gid].vars.mainCGallery.css('height',cgJsData[gid].vars.mainCGallery.height()+'px');

                //   cgJsClass.gallery.getJson.abortGetJson(gid);

                cgJsData[gid].vars.searchInput = searchInputValue;

                // falls ein Bild geöffnet ist, muss alles zurückgesetzt werden!!!!
                if(cgJsData[gid].vars.openedRealId>0){
                    cgJsClass.gallery.views.close(gid);
                }

                var ids = cgJsClass.gallery.function.search.collectData(gid);

                cgJsClass.gallery.categories.prepareAndAddCategoriesImagesCountAfterSearch(gid,cgJsData[gid].vars.searchInputCollectedIdsWithoutCategoryDependency,cgJsData[gid].vars.rawData);

                cgJsClass.gallery.function.search.getFullImageDataFiltered(gid,ids);

                var step = 1; // Weil fängt mit erstem Schritt an
                cgJsClass.gallery.dynamicOptions.checkStepsCutImageData(jQuery,step,true,false,gid);
                //var $step = jQuery('#cgFurtherImagesContainerDiv'+gid).find('.cg_further_images[data-cg-step="1"]');
                //$step.click();

                cgJsClass.gallery.vars.inputWritten = false;

                cgJsData[gid].vars.mainCGallery.css('height','auto');
            },1);

        });

};