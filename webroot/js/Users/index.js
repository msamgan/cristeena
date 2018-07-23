define([
    'jquery',
    'datatables'
], function ($, DataTable) {
    $('#user-list-table').DataTable({
        "fnDrawCallback": function( settings ) {
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
                            } else {
                                methods.notify(response['title'], response['message'], 'error');
                            }
                        });
                    }
                });
            });
        },
        destroy: true,
        "ajax": "/api/users/index",
        "columns": [
            { "data": "count" },
            { "data": "name" },
            { "data": "email" },
            { "data": "actions" },
        ]
        /* NOTE: if you are editing the table, please also make changes in Users/delete.js*/
    });
});
