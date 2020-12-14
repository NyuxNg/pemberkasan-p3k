$(document).ready(function() {
    var
        path_mdl      = '/drh/pendidikan',
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
            { data: 'tingkat', name: 'tingkat', className: 'text-nowrap align-middle' },
            { data: 'nama_lembaga', name: 'nama_lembaga', className: 'text-nowrap align-middle' },
            { data: 'tempat_id', name: 'tempat_id', className: 'text-nowrap align-middle' },
            { data: 'akreditasi', name: 'akreditasi', className: 'text-center text-nowrap align-middle' },
            { data: 'gelar_depan', name: 'gelar_depan', className: 'text-center text-nowrap align-middle' },
            { data: 'gelar_belakang', name: 'gelar_belakang', className: 'text-nowrap align-middle' },
            { data: 'ijazah_nomor', name: 'ijazah_nomor', className: 'text-center text-nowrap align-middle' },
            { data: 'ijazah_tanggal', name: 'ijazah_tanggal', className: 'text-center text-nowrap align-middle' },
            { data: 'ijazah_pejabat', name: 'ijazah_pejabat', className: 'text-nowrap align-middle' },
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

    $('.btn-add').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            url: kabupaten,
            type: 'POST',
            beforeSend: function () {
                Swal.fire({
                    html: 'Permintaan sedang di proses ... .',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success:function (response) {
                if (response.success) {
                    $.post(kabupaten, function(kabupaten, textStatus, xhr) {
                        $('#tempat_id').empty();
                        $('#tempat_id').append('<option></option>')
                        $.each(kabupaten.content, function(index, val) {
                            $('#tempat_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                        });
                    });
                    Swal.close()
                    $('#modalDefault').modal('show')
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
                    $('#formDefault').attr('action', mdl_base_url + "/update/" + response.content.id);
                    $('#formDefault').attr('method', "PUT");

                    $.each(response.content, function (index, val) {
                        $('#' + index).val(val)
                    });
                    $.post(kabupaten, function(kabupaten, textStatus, xhr) {
                        $('#tempat_id').empty();
                        $('#tempat_id').append('<option></option>')
                        $.each(kabupaten.content, function(index, val) {
                            $('#tempat_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                        });
                        $('#tempat_id').val(response.content.tempat_id).trigger('change');
                        $('#modalDefault').modal('show')
                        Swal.close()
                    });
                }
            }
        })
    });

    $('#modalDefault').on('hidden.bs.modal', function () {
        $('#formDefault').attr('action', mdl_base_url);
        $('#formDefault').attr('method', "POST");
    });
});