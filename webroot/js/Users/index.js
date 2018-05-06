define([
    'jquery',
    'datatables'
], function ($, DataTable) {
    $('#user-list-table').DataTable({
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