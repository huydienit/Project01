'use strict';

angular
    .module("AdtechApp")
    .service('removeByAttr', function(){
        this.func = function(arr, attr, value) {
            var i = arr.length;
            while (i--) {
                if (arr[i]
                    && arr[i].hasOwnProperty(attr)
                    && (arguments.length > 2 && arr[i][attr] === value )) {
                    arr.splice(i, 1);
                }
            }
            return arr;
        };
        this.sort = function compare(a,b) {
            if (a.id < b.id)
                return -1;
            if (a.id > b.id)
                return 1;
            return 0;
        };
    });