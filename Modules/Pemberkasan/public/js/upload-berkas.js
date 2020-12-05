$(document).ready(function() {
    var
        path_mdl      = '/berkas/upload',
        base_url      = $('base').attr('href'),
        mdl_base_url  = base_url + path_mdl,
        kirim         = mdl_base_url + "/kirim"
        datatable_url = mdl_base_url + "/data";

    const Toast = Swal.mixin({
        toast: true,
        position: 'middle-center',
        showConfirmButton: false,
        timer: 3000
    });

    var dataTableDefault = $('#dataTableDefault').DataTable({
        processing: true,
        searching: false,
        bLengthChange: false,
        paging: false,
        info: false,
        serverSide: true,
        ajax: {
            url: datatable_url
        },
        columns: [
            { data: 'nama_jberkas', name: 'nama_jberkas', className: 'text-nowrap align-middle' },
            { data: 'keterangan_jberkas', name: 'keterangan_jberkas', className: 'w-50 align-middle' },
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

    $('#dataTableDefault').on('click', '.btn-upload', function (event) {
        event.preventDefault();
        $('#formUpload').attr('action', $(this).attr('href'));
        $('#modalUpload').modal('show');
    });

    $('#dataTableDefault').on('click', '.btn-cekstatus', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            beforeSend: function () {
                Swal.fire({
                    text: 'Cek status berkas sedang di proses',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success:function (response) {
                if (response.errors) {
                    Swal.close()
                    console.log(response)
                }
                if (response.success) {
                    Swal.close()
                    $('#modalBasic').modal('show');
                    $.each(response.content, function(index, val) {
                        $('#' + index).html(val)
                    });
                }
            }
        })
    });

    $('.btn-kirim-berkas').on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Kirim Berkas?',
            html: "Klik Tombol <strong>Ya</strong> jika anda ingin melanjutkan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: kirim,
                    type: 'POST',
                    beforeSend: function () {
                        Swal.fire({
                            html: 'Sedang melakukan proses pengiriman berkas ... .',
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            }
                        })
                    },
                    success:function (response) {
                        if (response.success) {
                            setTimeout(function(){
                                Swal.close()
                                $('#dataTableDefault').DataTable().ajax.reload(null, false);
                                Toast.fire({
                                    type: 'success',
                                    title: response.message
                                })
                            }, 5000);
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
            }
        })
    });
});