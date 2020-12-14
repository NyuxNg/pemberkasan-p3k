$(document).ready(function() {
    var
        path_mdl      = '/berkas/verifikasi',
        base_url      = $('base').attr('href'),
        mdl_base_url  = base_url + path_mdl,
        proses        = mdl_base_url + "/proses/",
        datatable_url = mdl_base_url + "/data";

    const Toast = Swal.mixin({
        toast: true,
        position: 'middle-center',
        showConfirmButton: false,
        timer: 2000
    });

    var dataTableDefault = $('#dataTableDefault').DataTable({
        processing: true,
        searching: false,
        bLengthChange: false,
        paging: false,
        info: false,
        serverSide: true,
        ajax: {
            url: datatable_url,
            data: function (d) {
                d.no_peserta = $('input[name=no_peserta]').val();
            }
        },
        columns: [
            { data: 'nama_jberkas', name: 'nama_jberkas', className: 'text-nowrap align-middle' },
            { data: 'action', name: 'action', className: 'text-nowrap text-center align-middle' },
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

    $('#formSearch').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/getdata/peserta",
            type: 'POST',
            data: { no_peserta: $('input[name=no_peserta]').val() },
            beforeSend: function () {
                Swal.fire({
                    html: 'Pencarian Data Peserta ... .',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success:function (response) {
                if (response.success) {
                    setTimeout(function(){
                        Swal.close()
                        $.each(response.content, function(index, val) {
                            $('#_' + index).html(val)
                        });
                        dataTableDefault.draw();
                    }, 1000);
                }
                if (response.errors) {
                    Swal.close()
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
                }
            }
        })
    });

    $('#dataTableDefault').on('click', '.btn-verifikasi', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah berkas ini valid?',
            html: "Klik <strong>Ya</strong> jika valid!",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
        }).then((result) => {
            if (result.value) {
                diterima($(this).attr('href'));
            }
            else{
                ditolak($(this).attr('href'));
            }
        })
    });

    $('#dataTableDefault').on('click', '.btn-diterima', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah berkas ini valid?',
            html: "Klik <strong>Ya</strong> jika valid!",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
        }).then((result) => {
            if (result.value) {
                diterima($(this).attr('href'));
            }
        })
    });

    $('#dataTableDefault').on('click', '.btn-ditolak', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah berkas ini tidak valid?',
            html: "Klik <strong>Ya</strong> jika valid!",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
        }).then((result) => {
            if (result.value) {
                ditolak($(this).attr('href'));
            }
        })
    });

    function diterima(url) {
        $.post(proses + url, {status: 'Diterima'}, function(data, textStatus, xhr) {
            if (data.success) {
                $('#dataTableDefault').DataTable().ajax.reload(null, false);
            }
        });
    }

    function ditolak(url) {
        $('#notif').val(null)
        $('#modalNotif').modal('show');
        $('.btn-notif').on('click', function(event) {
            event.preventDefault();
            var notif = $('#notif').val();
            if(notif == ""){
                alert('Keterangan berkas tidak valid tidak boleh kosong!')
                return false
            }
            else{
                $.post(proses + url, {status: 'Ditolak', keterangan: notif}, function(data, textStatus, xhr) {
                    if (data.success) {
                        $('#dataTableDefault').DataTable().ajax.reload(null, false);
                    }
                });
            }
        });
    }
});