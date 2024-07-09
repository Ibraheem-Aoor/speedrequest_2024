$(document).ready(function () {
    // render The datatable if we are at a table page
    if (table_data_url !== 'undefined') {
        renderDataTable();
    }
    // change image and preveiw
    $('#uploadButton').on('click', function () {
        $('#changeImg').click();
    })

    $('#changeImg').change(function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            $('.image-input-wrapper').css('background-image', 'url("' + reader.result + '")');
        }
        if (file) {
            reader.readAsDataURL(file);
        }
    });

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
            5,
            'desc'
        ]],
    });
}

function getTableColumns() {
    return [
        {
            data: 'image',
            name: 'image',
            searchable: true,
            orderable: true,
        },
        {
            data: 'title',
            name: 'title',
            searchable: true,
            orderable: true,
        },

        {
            data: 'description',
            name: 'description',
            searchable: true,
            orderable: true,
        },
        {
            data: 'price',
            name: 'price',
            searchable: true,
            orderable: true,
        },
        {
            data: 'status',
            name: 'status',
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

/**
 * Project Info modal
 */

$('#service-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    $(this).find('textarea').text(btn.getAttribute('data-message'));
});

// Quick Toggle is Active status from the table row
function toggleStatus(input) {
    var id = input.data('id');
    var route = input.data('route');
    var status = input.prop('checked') == true ? 1 : 0;
    $.get(route, {
        id: id,
        status: status,
    }, function (reseponse) {
        if (reseponse.status) {
            toastr.success(reseponse.message);
        } else {
            toastr.error(reseponse.message);
        }
    });
}

/**
 * Project Info modal
 */

$('#service-modal').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    var action = btn.getAttribute('data-action');
    var method = btn.getAttribute('data-method');
    var isCreate = btn.getAttribute('data-is-create');
    $(this).find('form').attr('action', action);
    $(this).find('form').attr('method', method);
    // create or update
    if (isCreate == 1) {
        $("#modal-title").text(btn.getAttribute('data-header-title'));
        $('form[name="service-form"]')[0].reset();
        $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');

    } else {
        $("#modal-title").text(btn.getAttribute('data-header-title'));
        $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');
        $(this).find('#title').val(btn.getAttribute('data-title'));
        $(this).find('#description').val(btn.getAttribute('data-description'));
        $(this).find('#price').val(btn.getAttribute('data-price'));
        $(this).find('#time_between_bookings').val(btn.getAttribute('data-time-between-bookings'));
        var status = btn.getAttribute('data-status') == 1 ? 'checked' : null;
        $(this).find('#status').prop('checked', status);
    }
});



