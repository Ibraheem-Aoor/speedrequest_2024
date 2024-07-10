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
            3,
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
            data: 'name',
            name: 'name',
            searchable: true,
            orderable: true,
        },

        {
            data: 'platform',
            name: 'platform.name',
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
        $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');
        $("#modal-title").text(btn.getAttribute('data-header-title'));
        $('form[name="service-form"]')[0].reset();
        // Get the file input element
        var fileInput = document.getElementById('changeImg');

        // Reset the file input by clearing its value
        fileInput.value = null;
        $('.removeable').remove();

        $('#features-btn').after('');

    } else {
        $('.image-input-wrapper').css('background-image', 'url("' + btn.getAttribute('data-image') + '")');
        // Get the file input element
        var fileInput = document.getElementById('changeImg');

        // Reset the file input by clearing its value
        fileInput.value = null;
        $("#modal-title").text(btn.getAttribute('data-header-title'));
        $(this).find('#title').val(btn.getAttribute('data-title'));
        $(this).find('#task_title').val(btn.getAttribute('data-task_title'));
        $(this).find('#offer_url').val(btn.getAttribute('data-offer_url'));
        $(this).find('#platform_id').val(btn.getAttribute('data-platform_id'));
        var service_features = JSON.parse((btn.getAttribute('data-features')));
        var html = ``;
        $('.removeable').remove();
        if (service_features.length > 0) {
            $.each(service_features, function (key, value) {
                html += `<div class="col-sm-12 removeable mb-2">
                <div class="form-group d-flex">
                    ✔️ &nbsp; &nbsp;
                    <input type="text" name="features[]" value="${value}" class="form-control d-flex"> &nbsp;
                    <button type="button" class="add_feature btn btn-xs btn-primary" onclick="addNewFeature($(this));"><i
                            class="fa fa-plus"></i></button>&nbsp;
                    <button type="button" class="remove_feature btn btn-xs btn-danger" onclick="deleteFeature($(this));"><i class="fa fa-trash"></i></button>
                </div>
            </div>`;
            });
        }
        $('#features-btn').after(html);
        var status = btn.getAttribute('data-status') == 1 ? 'checked' : null;
        $(this).find('#status').prop('checked', status);
    }

});





function addNewFeature(btn) {
    var html = `<div class="col-sm-12 removeable mb-2">
                <div class="form-group d-flex">
                    ✔️ &nbsp; &nbsp;
                    <input type="text" name="features[]" class="form-control d-flex"> &nbsp;
                    <button type="button" class="add_feature btn btn-xs btn-primary" onclick="addNewFeature($(this));"><i
                            class="fa fa-plus"></i></button>&nbsp;
                    <button type="button" class="remove_feature btn btn-xs btn-danger" onclick="deleteFeature($(this));"><i class="fa fa-trash"></i></button>
                </div>
            </div>`;
    btn.parent().parent().after(html);
};

function deleteFeature(btn) {
    btn.parent().parent().remove();
};
