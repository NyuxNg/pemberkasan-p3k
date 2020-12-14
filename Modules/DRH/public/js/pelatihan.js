$(document).ready(function() {
    var
        path_mdl      = '/drh/pelatihan',
        base_url      = $('base').attr('href'),
        kabupaten     = base_url + '/getdata/kabupaten',
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
            { data: 'nama_pelatihan', name: 'nama_pelatihan', className: 'text-nowrap align-middle' },
            { data: 'mulai', name: 'mulai', className: 'text-nowrap align-middle' },
            { data: 'selesai', name: 'selesai', className: 'text-nowrap align-middle' },
            { data: 'nomor', name: 'nomor', className: 'text-center text-nowrap align-middle' },
            { data: 'tempat', name: 'tempat', className: 'text-center text-nowrap align-middle' },
            { data: 'institusi_penyelenggara', name: 'institusi_penyelenggara', className: 'text-nowrap align-middle' },
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