$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'middle-center',
        showConfirmButton: false,
        timer: 3000
    });

    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            "decimal": "",
            "emptyTable": "Tidak ada data tersedia",
            "info": "Menampilkan  _START_ sampai _END_ dari <strong>_TOTAL_</strong> data",
            "infoEmpty": "Menampilkan  0 sampai 0 dari <strong>0</strong> data",
            "infoFiltered": "(Tampilkan _MAX_ data)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Tampilkan _MENU_ data",
            "loadingRecords": "Sedang memuat...",
            "processing": "Sedang proses...",
            "search": "Cari Data",
            "searchPlaceholder": "Kata kunci pencarian",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
    });

    $('#formImport').submit(function(event) {
        event.preventDefault()
        action = $('#formImport').attr('action');
        method = $('#formImport').attr('method');
        data = new FormData($('#formImport')[0]);

        $('#formImport').find('.help-block').remove();
        $('#formImport').find('.form-group').removeClass('has-error');

        $.ajax({
            url: action,
            type: method,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Mohon Menunggu ... .!',
                    html: 'Sedang melakukan proses import data ... .',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function(response) {
                if (response.success) {
                    Swal.close()
                    Toast.fire({
                        type: 'success',
                        title: response.message
                    })
                    reload_datatable()
                    $('#modalImport').modal("hide");
                }

                if (response.errors) {
                    Swal.close()
                    Swal.fire({
                        icon: 'error',
                        title: response.message
                    })
                }
            },
            error: function(xhr) {
                var res = xhr.responseJSON;
                Swal.close()
                if (res.errors == null) {
                    Toast.fire({
                        type: 'error',
                        title: res.message
                    })
                }
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function(key, value) {
                        $('#' + key)
                            .closest('.form-group')
                            .addClass('has-error')
                            .append('<span class="help-block">' + value + '</span>');
                    });
                }
            }
        });
    });

    // Function
    function reload_datatable() {
        $('#dataTableDefault').DataTable().ajax.reload(null, false);
    }

});