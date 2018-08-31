define([
    'jquery',
    'swal',
], function ($, swal, ) {
    let jq = $.noConflict();
    let methods = {};

    /**
     * convert jsonObject to Array
     * @param jsonObject
     * @returns Array
     */
    methods.toArray = function (jsonObject) {
        return jq.parseJSON(jsonObject);
    };

    /**
     * sweet alert display message
     * @param title
     * @param message
     */
    methods.notify = function (title, message) {
        swal({
            title: title,
            text: message,
            button: true
        });
    };

    /**
     * reload the page with a certain delay in seconds.
     * @param delay
     */
    methods.reload = function (delay) {
        setTimeout(function () {
            window.location.reload(true);
        }, (delay * 1000))
    };

    /**
     *  redirect to a certain url with delay in seconds.
     * @param delay
     * @param path
     */
    methods.redirect = function (delay, path) {
        setTimeout(function () {
            window.location.href = path;
        }, (delay * 1000))
    };

    return methods;
});
