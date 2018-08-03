define([
    'jquery',
    'swal',
], function ($, swal, ) {
    let jq = $.noConflict();
    let methods = {};

    methods.toArray = function (jsonObject) {
        return jq.parseJSON(jsonObject);
    };

    methods.notify = function (title, message) {
        swal({
            title: title,
            text: message,
            button: true
        });
    };

    return methods;
});
