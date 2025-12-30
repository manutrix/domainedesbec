cgJsClass.gallery.sorting.desc = function (newData) {// by rowId sorted data!!!

    // create array for reverse
    var arr = [];

    for (var key in newData) {

        // add hasOwnPropertyCheck if needed
        var obj = {};

        obj[key] = newData[key];
        arr.push(obj);

    }

    var arrReverse = [];

    var iAdd = 0;

    for (var i=arr.length-1; i>=0; i--) {
        arrReverse[iAdd] =arr[i];
        iAdd++;
    }
    return arrReverse;


};
cgJsClass.gallery.sorting.findNewRowId = function(newData,newKey){

    newKey = parseInt(newKey);

    if(newData[newKey]){
        cgJsClass.gallery.sorting.findNewRowId(newData,newKey+1);
    }else{
        return newKey;
    }

};
cgJsClass.gallery.sorting.sortByRowId = function (gid,init,isDoNotAddToImageDataFiltered) {

    var data = cgJsData[gid].vars.rawData;

    if(!isDoNotAddToImageDataFiltered){
        cgJsData[gid].fullImageDataFiltered = [];
    }

    var newData = {};
    var i = 0;

    var startValue = 100000;
    var lastUnsortedValue;

    for (var key in data){

        if(!data.hasOwnProperty(key)){
            break;
        }

        // check rThumb
        if(init===true){

            if(data[key]['rThumb']=='90' || data[key]['rThumb']=='270'){
                var Width = data[key]['Width'];
                var Height = data[key]['Height'];
                data[key]['Width'] = Height;
                data[key]['Height'] = Width;
            }
        }

        if(data[key]['rowid']!='0'){
            var newKey = startValue + parseInt(data[key]['rowid']);

            // simply go sure, if saving go wrong, for example same rowids multiple times, then with this image will still appear
            if(newData[newKey]){
                newKey = cgJsClass.gallery.sorting.findNewRowId(newData,newKey);
            }

        }else{
            // HAS TO BE ALSO DONE IN sortByRowIdFiltered
            if(!lastUnsortedValue){
                lastUnsortedValue = startValue-1;
                var newKey = lastUnsortedValue;// earlier it was image id
            }else{
                lastUnsortedValue = lastUnsortedValue-1;// earlier it was image id
                var newKey = lastUnsortedValue;
            }
            //var newKey = key;// this is image id then!!!!

        }

        // old code
/*        if(newData[newKey]){
            newKey = newKey+'1';
            newData[newKey] = data[key];
        }else{
            newData[newKey] = data[key];
        }*/

        newData[newKey] = data[key];
        // add real id to new object value, to go sure
        newData[newKey]['id']  = parseInt(key);

      //  var newObject = {};
        //newObject[newData[newKey]['id']] = data[key];// für weitere verarbeitung in der art etabliert
        if(!isDoNotAddToImageDataFiltered){
            cgJsData[gid].fullImageDataFiltered[i] = {};
            cgJsData[gid].fullImageDataFiltered[i][newData[newKey]['id']] = data[key];
        }

        i++;

    }

    return newData;


};
cgJsClass.gallery.sorting.sortByRowIdFiltered = function (gid) {

    var newObj = {};
    var startValue = 100000;
    var lastUnsortedValue;

    jQuery.each(cgJsData[gid].fullImageDataFiltered, function( index,value ) {

        // index = array index
        // value = object
        // firstKey = object Key
        var firstKey = Object.keys(value)[0]; // objectKey = image ID
        var object = value[firstKey];

        var rowid = object['rowid']; // objectKey = image ID

        // HAS ALSO TO BE DONE ABOVE in sortByRowId!!!
        if(rowid!='0'){
            var rowid = startValue + parseInt(rowid);

            // simply go sure, if saving go wrong, for example same rowids multiple times, then with this image will still appear
            if(newObj[rowid]){
                rowid = cgJsClass.gallery.sorting.findNewRowId(newObj,rowid);
            }

        }else{
            if(!lastUnsortedValue){
                lastUnsortedValue = startValue-1;
                var rowid = lastUnsortedValue;// earlier it was image id
            }else{
                lastUnsortedValue = lastUnsortedValue-1;// earlier it was image id
                var rowid = lastUnsortedValue;
            }
           // rowid = object['id'];// this is image id then!!!!
        }

        // old code
/*        if(newObj[rowid]){
            rowid = rowid+'1';// key is id!!!!
            newObj[rowid] = object;
        }else{
            newObj[rowid] = object;
        }*/



        newObj[rowid] = object;

    });

    return newObj;


};