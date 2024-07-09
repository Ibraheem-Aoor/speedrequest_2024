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
            data: 'barber',
            name: 'barber.name',
            searchable: true,
            orderable: true,
        },
        {
            data: 'client_name',
            name: 'client_name',
            searchable: true,
            orderable: true,
        },
        {
            data: 'client_phone',
            name: 'client_phone',
            searchable: true,
            orderable: true,
        },
        {
            data: 'date',
            name: 'date',
            searchable: true,
            orderable: true,
        },
        {
            data: 'time',
            name: 'time',
            searchable: true,
            orderable: true
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


$('#booking-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    var headerTitle = btn.getAttribute('data-header-title');
    var services = JSON.parse(btn.getAttribute('data-services'));

    $("#modal-title").text(headerTitle);

    var tbody = $("#services-table-body");
    tbody.empty(); // Clear previous content

    services.forEach(function (service) {
        var row = `<tr>
            <td class="p-3">${service.title}</td>
            <td class="p-3">${service.price}</td>
        </tr>`;
        tbody.append(row);
    });
});
