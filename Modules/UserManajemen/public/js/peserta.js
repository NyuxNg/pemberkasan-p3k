$(document).ready(function() {
    var
        path_mdl      = '/userman/peserta',
        base_url      = $('base').attr('href'),
        mdl_base_url  = base_url + path_mdl,
        datatable_url = mdl_base_url + "/data";

    const Toast = Swal.mixin({
        toast: true,
        position: 'middle-center',
        showConfirmButton: false,
        timer: 3000
    });

    var dataTableDefault = $('#dataTableDefault').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: datatable_url
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id', className: 'w-5 text-center align-middle' },
            { data: 'name', name: 'name', className: 'text-nowrap align-middle' },
            { data: 'username', name: 'username', className: 'text-nowrap align-middle' },
            { data: 'email', name: 'email', className: 'text-nowrap align-middle' },
            { data: 'action', name: 'action', className: 'w-10 text-center text-nowrap align-middle' },
        ],
        "initComplete": function(settings, json) {
            $('#dataTableDefault_filter input').unbind();
            $('#dataTableDefault_filter input').bind('keyup', function(e) {
                if (this.value == "" || e.keyCode == 13) {
                    $('#dataTableDefault').DataTable().search(this.value).draw();
                }
            });
        },
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });

    $('.btn-generate').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            url: mdl_base_url,
            type: 'POST',
            beforeSend: function () {
                Swal.fire({
                    title: 'Mohon Menunggu!',
                    text: 'Generate User Peserta ... ',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success:function (response) {
                if (response.errors) {
                    Swal.close()
                    console.log(response);
                }
                if (response.success) {
                    Swal.close()
                    $('#dataTableDefault').DataTable().ajax.reload(null, false);
                }
            }
        })
    });


    $('#dataTableDefault').on('click', '.btn-edit', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            beforeSend: function () {
                Swal.fire({
                    text: 'Permintaan sedang di proses',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success:function (response) {
                if (response.errors) {
                    Swal.close()
                    console.log(response);
                }
                if (response.success) {
                    Swal.close()
                    $('#formDefault').attr('action', mdl_base_url + "/" + response.content.id);
                    $('#formDefault').attr('method', "PUT");

                    $.each(response.content, function (index, val) {
                        $('#' + index).val(val)
                    });
                    $('#modalDefault').modal('show')
                }
            }
        })
    });

    $('#modalDefault').on('hidden.bs.modal', function () {
        $('#formDefault').attr('action', mdl_base_url);
        $('#formDefault').attr('method', "POST");
    });
});