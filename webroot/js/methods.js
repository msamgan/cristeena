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

    methods.reload = function (delay) {
        setTimeout(function () {
            window.location.reload(true);
        }, (delay*1000))
    };

    methods.redirect = function (delay, path) {
        setTimeout(function () {
            window.location.href = path;
        }, (delay*1000))
    };

    return methods;
});
