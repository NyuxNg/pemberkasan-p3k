$(document).ready(function() {
    var
        path_mdl      = '/drh/perorangan',
        base_url      = $('base').attr('href'),
        provinsi      = base_url + '/getdata/provinsi',
        kabupaten     = base_url + '/getdata/kabupaten',
        kecamatan     = base_url + '/getdata/kecamatan',
        desa          = base_url + '/getdata/desa',
        mdl_base_url  = base_url + path_mdl,
        edit_url      = mdl_base_url + "/edit";
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
            { data: 'description', name: 'description', className: 'text-center text-nowrap align-middle' },
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

    $('.btn-update').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            url: edit_url,
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
                    $.each(response.content, function (index, val) {
                        $('#' + index).val(val)
                        $('#' + index).val(val).trigger('change')
                    });
                    $.post(kabupaten, function(data, textStatus, xhr) {
                        $('#tempat_lahir_id').empty();
                        $('#tempat_lahir_id').append('<option></option>')
                        $.each(data.content, function(index, val) {
                            $('#tempat_lahir_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                        });
                        $('#tempat_lahir_id').val(response.content.tempat_lahir_id).trigger('change')
                    });
                    $.post(provinsi, function(data, textStatus, xhr) {
                        $('#provinsi_id').empty();
                        $('#provinsi_id').append('<option></option>')
                        $.each(data.content, function(index, val) {
                            $('#provinsi_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                        });
                        $('#provinsi_id').val(response.content.provinsi_id).trigger('change')
                    });
                    $('#provinsi_id').change(function(event) {
                        $.post(kabupaten, {provinsi_id: $(this).val()}, function(kabupaten, textStatus, xhr) {
                            $('#kabupaten_id').empty();
                            $('#kabupaten_id').append('<option></option>')
                            $.each(kabupaten.content, function(index, val) {
                                $('#kabupaten_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                            $('#kabupaten_id').val(response.content.kabupaten_id).trigger('change')
                        });
                    });
                    $('#kabupaten_id').change(function(event) {
                        $.post(kecamatan, {kabupaten_id: $(this).val()}, function(kecamatan, textStatus, xhr) {
                            $('#kecamatan_id').empty();
                            $('#kecamatan_id').append('<option></option>')
                            $.each(kecamatan.content, function(index, val) {
                                $('#kecamatan_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                            $('#kecamatan_id').val(response.content.kecamatan_id).trigger('change')
                        });
                    });
                    $('#kecamatan_id').change(function(event) {
                        $.post(desa, {kecamatan_id: $(this).val()}, function(desa, textStatus, xhr) {
                            $('#desa_id').empty();
                            $('#desa_id').append('<option></option>')
                            $.each(desa.content, function(index, val) {
                                $('#desa_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                            $('#desa_id').val(response.content.desa_id).trigger('change')
                        });
                        Swal.close()
                        $('#modalDefault').modal('show')
                    });
                }
                else{
                    Swal.close()
                    $.post(provinsi, function(data, textStatus, xhr) {
                        $('#provinsi_id').empty();
                        $('#provinsi_id').append('<option></option>')
                        $.each(data.content, function(index, val) {
                            $('#provinsi_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                        });
                        $.post(kabupaten, function(data, textStatus, xhr) {
                            $('#tempat_lahir_id').empty();
                            $('#tempat_lahir_id').append('<option></option>')
                            $.each(data.content, function(index, val) {
                                $('#tempat_lahir_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                        });
                        $('#modalDefault').modal('show')
                    });
                    $('#provinsi_id').change(function(event) {
                        $.post(kabupaten, {provinsi_id: $(this).val()}, function(kabupaten, textStatus, xhr) {
                            $('#kabupaten_id').empty();
                            $('#kabupaten_id').append('<option></option>')
                            $.each(kabupaten.content, function(index, val) {
                                $('#kabupaten_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                        });
                    });
                    $('#kabupaten_id').change(function(event) {
                        $.post(kecamatan, {kabupaten_id: $(this).val()}, function(kecamatan, textStatus, xhr) {
                            $('#kecamatan_id').empty();
                            $('#kecamatan_id').append('<option></option>')
                            $.each(kecamatan.content, function(index, val) {
                                $('#kecamatan_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                        });
                    });
                    $('#kecamatan_id').change(function(event) {
                        $.post(desa, {kecamatan_id: $(this).val()}, function(desa, textStatus, xhr) {
                            $('#desa_id').empty();
                            $('#desa_id').append('<option></option>')
                            $.each(desa.content, function(index, val) {
                                $('#desa_id').append('<option value="'+ val.id +'">'+val.nama+'</option>')
                            });
                        });
                    });
                }
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    Toast.fire({
                        type: 'error',
                        title: res.message
                    })
                }
            }
        })
    });

    $('#formUpdate').submit(function (event) {
        event.preventDefault();
        action = $('#formUpdate').attr('action');
        method = $('#formUpdate').attr('method');
        data   = $('#formUpdate').serialize();

        $('#formUpdate').find('.help-block').remove();
        $('#formUpdate').find('.form-group').removeClass('has-error');

        $.ajax({
            url: action,
            type: method,
            data: data,
            beforeSend: function () {
                Swal.fire({
                    title: 'Mohon Menunggu ... .!',
                    html: 'Permintaan sedang di proses ... .',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = mdl_base_url
                }

                if (response.errors) {
                    Toast.fire({
                        type: 'error',
                        title: response.message
                    })
                }
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    Toast.fire({
                        type: 'error',
                        title: res.message
                    })
                    $.each(res.errors, function (key, value) {
                        $('#' + key)
                            .closest('.form-group')
                            .addClass('has-error')
                            .append('<span class="help-block">' + value[0] + '</span>');
                    });
                }
            }
        })
    });
});