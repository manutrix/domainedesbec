cgJsClass.gallery.uploadGeneral.functions = {
    events: function ($) {

        if(!cgJsClass.gallery.uploadGeneral.functions.eventsInitiated){

            cgJsClass.gallery.uploadGeneral.functions.eventsInitiated = true;

            $(document).on('keydown','.cg_input_date_class',function(e) {

                e.preventDefault();

                if(e.which==46 || e.which==8){// back, delete
                    this.value = '';
                }

            });

            cgJsClass.gallery.uploadGeneral.functions.initInputDate($);

             $( "#ui-datepicker-div" ).hide();

        }


    },
    initInputDate: function ($,inputSelector,valueToSet,cgCenterDivClasses){// if inputSelector then must be from user gallery edit
        var inputSelectorToCheck = '.cg_input_date_class';
        if(inputSelector){inputSelectorToCheck=inputSelector;}
        $(inputSelectorToCheck).datepicker({
            beforeShow: function(input, inst) {

                var $uiDatepickerDiv = $('#ui-datepicker-div');

             //   if(!inputSelector){
                    $uiDatepickerDiv.addClass('cg_upload_form_container');

                    if(cgCenterDivClasses){
                        $uiDatepickerDiv.addClass(cgCenterDivClasses);
                    }else{
                        $uiDatepickerDiv.removeClass('cg_center_div_image_edit cg_center_white');
                    }

             //   }
                //$('#ui-datepicker-div').addClass($('#cg_fe_controls_style_user_upload_form_shortcode').val()); no style check in the moment
                $uiDatepickerDiv.find('.ui-datepicker-next').attr('title','');

                if(cgJsClass.gallery.vars.fullscreen){
                    $uiDatepickerDiv.appendTo('#mainCGdivHelperParent'+cgJsClass.gallery.vars.fullscreen)
                }else{
                    $uiDatepickerDiv.appendTo('body');
                }

            },
            changeMonth: true,
            changeYear: true,
            monthNames: ["01","02","03","04","05","06","07","08","09","10","11","12"],
            monthNamesShort: ["01","02","03","04","05","06","07","08","09","10","11","12"],
            yearRange: "-100:+100"
        });

        if(inputSelector){// then is for user gallery
            var cgDateFormat =  $(inputSelectorToCheck).attr('data-cg-date-format').toLowerCase().replace('yyyy','yy');
            $( inputSelectorToCheck ).datepicker("option", "dateFormat", cgDateFormat);
            $( inputSelectorToCheck ).val(valueToSet);// value has to be set again after format is set!
        }else{// then is for upload forms
            $(inputSelectorToCheck).each(function () {
                var cgDateFormat =  $(this).closest('.cg_form_div').find('.cg_date_format').val().toLowerCase().replace('yyyy','yy');
                // have to be done in extra row here
                $( this ).datepicker("option", "dateFormat", cgDateFormat);
            });
        }

    },
    eventsInitiated: false
};