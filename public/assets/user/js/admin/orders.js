$(document).ready(function () {
    // render The datatable if we are at a table page
    if (table_data_url !== 'undefined') {
        renderDataTable();
    }
});

/**
    * render Datatable
    */
function renderDataTable() {
    $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        language: language,
        ajax: table_data_url,
        columns: getTableColumns(),
        order: [[
            3,
            'desc'
        ]],
    });
}

function getTableColumns() {
    return [
        {
            data: 'id',
            name: 'id',
            searchable: true,
            orderable: true,
        },
        {
            data: 'platform',
            name: 'service.platform.name',
            searchable: true,
            orderable: true,
        },
        {
            data: 'service',
            name: 'service.name',
            searchable: true,
            orderable: true,
        },
        {
            data: 'profile',
            name: 'profile',
            searchable: true,
            orderable: true,
        },
        {
            data: 'created_at',
            name: 'created_at',
            searchable: true,
            orderable: true,
        },
        {
            data: 'actions',
            name: 'actions',
            searchable: false,
            orderable: false,
        },
    ];
}


$('#order-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    var action = btn.getAttribute('data-action');
    var method = btn.getAttribute('data-method');
    $(this).find('form').attr('action', action);
    $(this).find('form').attr('method', method);
    $("#modal-title").text(btn.getAttribute('data-header-title'));
    $('#platform-image').prop('src' , btn.getAttribute('data-platform-image'));
    $('#service-image').prop('src' , btn.getAttribute('data-service-image'));
    $('#service-name').html(btn.getAttribute('data-service-name'));

});
