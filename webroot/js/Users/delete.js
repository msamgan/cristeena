define([
    'jquery',
    'swal',
    'methods'
], function ($, swal, methods) {
    setTimeout(function () {
        $('.delete-user').click(function() {
            swal({
                title: "Are you sure you want to delet user?",
                text: "Once deleted, you will not be able to recover this user data",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.get($(this).data('path')).done(function (response) {
                        response = methods.toArray(response);
                        if (response['status']) {
                            methods.notify(response['title'], response['message'], 'success');
                            setTimeout(function () {
                                $('#user-list-table').DataTable( {
                                    destroy: true,
                                    "ajax": "/api/users/index",
                                    "columns": [
                                        { "data": "count" },
                                        { "data": "name" },
                                        { "data": "email" },
                                        { "data": "actions" },
                                    ]
                                } );
                            }, 2000)
                        } else {
                            methods.notify(response['title'], response['message'], 'error');
                        }
                    });
                }
            });
        });
    }, 1000);
});