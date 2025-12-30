cgJsClass.gallery.indexeddb = {
    instances: {},
    versionNumber: 2,// since sortValues was added it is 2 now!!!
    versionNumberGallery: 2,// since sortValues was added it is 2 now!!!
    versionNumberSortValues: 2,// since sortValues was added it is 2 now!!!
    init: function (uploadFolderUrl,gid,tstamp) {
        // OLD BROWSER SUPPORT
        // Internet Explorer 10, Firefox 16, Chrome 24.

        // In der folgenden Zeile sollten Sie die Präfixe einfügen, die Sie testen wollen.
        window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
        // Verwenden Sie "var indexedDB = ..." NICHT außerhalb einer Funktion.
        // Ferner benötigen Sie evtl. Referenzen zu einigen window.IDB* Objekten:
        window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;
        window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
        // (Mozilla hat diese Objekte nie mit Präfixen versehen, also brauchen wir kein window.mozIDB*)

        // ZWISCHENPRÜFUNG OB BROWSER ERLAUBT
        if (!window.indexedDB) {
            console.log("Dieser Browser unterstützt kein indexedDb");
            cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);
            return false;
        }

        var request = indexedDB.open('contest-gal1ery-'+gid,cgJsClass.gallery.indexeddb.versionNumber);// zweiter parameter ist versionsnummer

        request.onerror = function(event) {
            console.log("Verbindung zu indexed DB nicht möglich oder anderer Fehler");
            console.log(event);
            cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);
            return false;
        };

        // onupgradeneeded runs before on success!!!!
        // AUTOCREATING DATABASE IF NOT EXISTS
        // version number when indexedDB open will be checked. If higher then before then this onupgradeneeded will be running
        // there is no other option to check if the database already exists or not then this one
        request.onupgradeneeded = function(event) { // BEISPIEL WENN ES EINEN VERSIONSUPGRADE DER DATENBANK GAB
            //  is the only place where you can alter the structure of the database !!!!!

            var db = event.target.result;

            try{
                db.createObjectStore("sortValuesJson", { keyPath: "versionNumber" });
                db.createObjectStore("galleryJson", { keyPath: "versionNumber" });
            }catch (e){
                console.log('galleryJson couldn\t be created, must be already crated')
                console.log(e)
            }

        };

        request.onsuccess = function() {

            var db = request.result;

            cgJsClass.gallery.indexeddb.instances[gid] = db;

            var galleryJsonRequest = db.transaction("galleryJson").objectStore("galleryJson").get(cgJsClass.gallery.indexeddb.versionNumberGallery);

            galleryJsonRequest.onsuccess = function(event) {

                if(typeof event.target.result == 'undefined'){cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);return;}

                var data = event.target.result;

                if(!Object.keys(data).length>=1){
                    cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);// new data has to be collected
                    return;
                }

                if(!data.hasOwnProperty('tstamp')){
                    cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);// new data has to be collected
                }
                else if(data.tstamp!=tstamp){
                    cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);// new data has to be collected
                }else{
                    cgJsData[gid].vars.preRawData = data;
                    cgJsClass.gallery.getJson.imageDataPreProcess(gid,data.data,true);// no changes indexeddb data can be taken
                }

            };

            galleryJsonRequest.onerror = function (event) {
                    cgJsClass.gallery.getJson.getImages(uploadFolderUrl,gid,tstamp,true);
                    console.log('galleryJsonRequest error');
                    console.log(event);
            }

        }
    },
    saveJsonGallery: function (gid,data,tstamp) {

        try{

            cgJsClass.gallery.indexeddb.instances[gid].transaction('galleryJson','readwrite').objectStore('galleryJson').put({
                versionNumber:cgJsClass.gallery.indexeddb.versionNumberGallery,
                tstamp:tstamp,
                data:data
            });

        }catch(e){

            console.log('saveJsonGallery did not worked');
            console.log(e);

        }

    },
    saveJsonSortValues: function (gid,data,tstamp,isFromSaveAfterRatingOrCommenting) {

        // see cg_check_and_repair_image_file_data php function get all required values
        // CountSreal is for correcting of CountS if addCountS was added
        var valuesToSaveForSortArray = cgJsClass.gallery.vars.ratingAndCommentsProperties;

        var dataNew = {};

        // filter here for all values that are just required for sorting
        // and don't destroy the current data object it might be processed in further functions

        for(var realId in data){
            if(!data.hasOwnProperty(realId)){
                break;
            }
            for(var property in data[realId]){
                if(!data[realId].hasOwnProperty(property)){
                    break;
                }
                if(!dataNew[realId]){
                    dataNew[realId] = {};
                }
                if(valuesToSaveForSortArray.indexOf(property)>-1){
                    // parse existing values here to go sure
                    data[realId][property] = parseInt(data[realId][property]);
                    dataNew[realId][property] = data[realId][property];
                }
            }
        }

        var dataToSave = dataNew;

        if(isFromSaveAfterRatingOrCommenting){

            // recreate object for saving here
            var dataToSave = {};

            // save right values for indexDB:
            // so addCount not considered
            for(var realId in dataNew){

                if(!dataNew.hasOwnProperty(realId)){
                    break;
                }

                if(!dataToSave[realId]){
                    dataToSave[realId] = {};
                }

                for(var property in dataNew[realId]){

                    if(!dataNew[realId].hasOwnProperty(property)){
                        break;
                    }

                    dataToSave[realId][property] = dataNew[realId][property];
                }

                if(dataToSave[realId].CountSreal){
                    dataToSave[realId].CountS = dataToSave[realId].CountSreal;
                    delete dataToSave[realId].CountSreal;
                }

            }

            // overwrite the current one with the new one cleaned, that does not contain not required image-data
            // this image-data will be only added when setratingone, setratingfive or setcomment is done, file data comes frome there
            cgJsData[gid].rateAndCommentNumbers = dataToSave;

        }

        try{

            cgJsClass.gallery.indexeddb.instances[gid].transaction('sortValuesJson','readwrite').objectStore('sortValuesJson').put({
                versionNumber:cgJsClass.gallery.indexeddb.versionNumberSortValues,
                tstamp:tstamp,
                data:dataToSave
            });

        }catch(e){

            console.log('saveJsonSortValues did not worked');
            console.log(e);

        }

    },
    getJsonSortValues: function (uploadFolderUrl,gid,tstamp,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues,newImageIdsArrayFromUpload) {

        if(cgJsClass.gallery.indexeddb.instances[gid]){

            var db = cgJsClass.gallery.indexeddb.instances[gid];

            var sortValuesJsonRequest = db.transaction("sortValuesJson").objectStore("sortValuesJson").get(cgJsClass.gallery.indexeddb.versionNumberSortValues);

            sortValuesJsonRequest.onsuccess = function(event) {

                if(typeof event.target.result == 'undefined'){cgJsClass.gallery.getJson.getSortValuesRequest(uploadFolderUrl,gid,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues);return;}

                var data = event.target.result;

                //console.log('data');
                //console.log(data);

                if(!Object.keys(data).length>=1){
                    cgJsClass.gallery.getJson.getSortValuesRequest(uploadFolderUrl,gid,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues);// new data has to be collected
                    return;
                }

                if(!data.hasOwnProperty('tstamp')){
                    cgJsClass.gallery.getJson.getSortValuesRequest(uploadFolderUrl,gid,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues);// new data has to be collected
                }
                else if(parseInt(data.tstamp)<tstamp && !newImageIdsArrayFromUpload){// if from upload then timestamp was set already and this processing is irrelevant, because might overwrite right values if get json!!!!!!
                    cgJsClass.gallery.getJson.getSortValuesRequest(uploadFolderUrl,gid,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues);// new data has to be collected
                }else{// then database tstamp is higher then checked tstamp and database data should be used
                    cgJsClass.gallery.getJson.setSortingData(gid,data.data,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues,false,newImageIdsArrayFromUpload);
                }

            };

            sortValuesJsonRequest.onerror = function (event) {
                cgJsClass.gallery.getJson.getSortValuesRequest(uploadFolderUrl,gid,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues);// new data has to be collected
                console.log('galleryJsonRequest error');
                console.log(event);
            }

        }else{
            cgJsClass.gallery.getJson.getSortValuesRequest(uploadFolderUrl,gid,imageDataPassedArgumentsWithoutIsDoNotCheckSortValues);
        }
    }
};