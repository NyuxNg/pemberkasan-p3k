$(document).ready(function() {
    var
        path_mdl = '/tabref/jenis-berkas',
        base_url = $('base').attr('href'),
        mdl_base_url = base_url + path_mdl,
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
            { data: 'nama', name: 'nama', className: 'w-50 align-middle' },
            { data: 'kode', name: 'kode', className: 'text-center text-nowrap align-middle' },
            { data: 'format', name: 'format', className: 'text-center text-nowrap align-middle' },
            { data: 'size', name: 'size', className: 'text-center text-nowrap align-middle' },
            { data: 'keterangan', name: 'keterangan', className: 'text-nowrap align-middle' },
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
});