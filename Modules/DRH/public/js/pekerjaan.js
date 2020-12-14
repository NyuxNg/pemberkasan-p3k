$(document).ready(function() {
    var
        path_mdl      = '/drh/pekerjaan',
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
            { data: 'instansi', name: 'instansi', className: 'text-nowrap align-middle' },
            { data: 'jabatan', name: 'jabatan', className: 'text-nowrap align-middle' },
            { data: 'mulai', name: 'mulai', className: 'text-nowrap align-middle' },
            { data: 'selesai', name: 'selesai', className: 'text-center text-nowrap align-middle' },
            { data: 'gaji_pokok', name: 'gaji_pokok', className: 'text-right text-nowrap align-middle' },
            { data: 'sk_nomor', name: 'sk_nomor', className: 'text-nowrap align-middle' },
            { data: 'sk_tanggal', name: 'sk_tanggal', className: 'text-nowrap align-middle' },
            { data: 'sk_pejabat_penandatangan', name: 'sk_pejabat_penandatangan', className: 'text-nowrap align-middle' },
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
                    $('#formDefault').attr('action', mdl_base_url + "/update/" + response.content.id);
                    $('#formDefault').attr('method', "PUT");

                    $.each(response.content, function (index, val) {
                        $('#' + index).val(val)
                    });
                    $('#modalDefault').modal('show')
                    Swal.close()
                }
            }
        })
    });

    $('#modalDefault').on('hidden.bs.modal', function () {
        $('#formDefault').attr('action', mdl_base_url);
        $('#formDefault').attr('method', "POST");
    });
});