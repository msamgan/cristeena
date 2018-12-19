define([
    'jquery',
    'dataTables',
    'methods'
], function ($, dataTable, methods) {

    /**
     * js for deleting the user.
     */
    function deleteUser() {
        $('.delete-user').click(function() {
            swal({
                title: "Are you sure you want to delete user?",
                text: "Once deleted, you will not be able to recover this user data",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.get($(this).data('path')).done(function (response) {
                        if (response['status']) {
                            methods.notify(
                                response['title'],
                                response['message'],
                                'success'
                            );
                            methods.reload(2);
                        } else {
                            methods.notify(response['title'], response['message'], 'error');
                        }
                    });
                }
            });
        });
    }

    /**
     * fetching all the users in the system.
     */
    $('#user-list-table').DataTable({
        "fnDrawCallback": function() {
            deleteUser();
        },
        destroy: true,
        "ajax": "/api/users/index",
        "columns": [
            { "data": "count" },
            { "data": "name" },
            { "data": "email" },
            { "data": "actions" },
        ]
    });

    /**
     * fetching all the admins in the system.
     */
    $('#admin-list-table').DataTable({
        "fnDrawCallback": function() {
            deleteUser();
        },
        destroy: true,
        "ajax": "/api/users/admins",
        "columns": [
            { "data": "count" },
            { "data": "name" },
            { "data": "email" },
            { "data": "actions" },
        ]
    });
});
