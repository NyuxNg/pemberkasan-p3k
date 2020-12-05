{{-- Modal Notif --}}
@if ($modalType == "modalNotif")
    <div id="{{ $id }}" class="modal {{ $modalClass }} fade" data-backdrop="{{ $backdrop }}">
        <div class="modal-dialog {{ $modalDiaglogClass }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-weight-bold">{{ $title }}</h4>
                </div>
                    <div class="modal-body">
                        {!! $body !!}
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning btn-notif" data-dismiss="modal"><i class="fa fa-send mr-2"></i>Kirim Notifikasi</button>
                    </div>
            </div>
        </div>
    </div>
@endif
{{-- Modal Basic --}}
@if ($modalType == "modalBasic")
    <div id="{{ $id }}" class="modal {{ $modalClass }} fade" data-backdrop="{{ $backdrop }}">
        <div class="modal-dialog {{ $modalDiaglogClass }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-weight-bold">{{ $title }}</h4>
                </div>
                    <div class="modal-body">
                        {!! $body !!}
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                    </div>
            </div>
        </div>
    </div>
@endif
{{-- Modal Import --}}
@if ($modalType == "modalImport")
    <div id="{{ $id }}" class="modal {{ $modalClass }} fade" data-backdrop="{{ $backdrop }}">
        <div class="modal-dialog {{ $modalDiaglogClass }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-weight-bold">{{ $title }}</h4>
                </div>
                <form id="{{ $formId }}" class="{{ $formClass }}" action="{{ $formAction }}" method="{{ $formMethod }}">
                    <div class="modal-body">
                        {!! $body !!}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-upload mr-2"></i>Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
{{-- Modal Upload --}}
@if ($modalType == "modalUpload")
    <div id="{{ $id }}" class="modal {{ $modalClass }} fade" data-backdrop="{{ $backdrop }}">
        <div class="modal-dialog {{ $modalDiaglogClass }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-weight-bold">{{ $title }}</h4>
                </div>
                <form id="{{ $formId }}" class="{{ $formClass }}" action="{{ $formAction }}" method="{{ $formMethod }}">
                    <div class="modal-body">
                        {!! $body !!}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info"><i class="fa fa-upload mr-2"></i>Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
{{-- Modal Import --}}
@if ($modalType == "modalFormBasic")
    <div id="{{ $id }}" class="modal {{ $modalClass }} fade" data-backdrop="{{ $backdrop }}">
        <div class="modal-dialog {{ $modalDiaglogClass }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-weight-bold">{{ $title }}</h4>
                </div>
                <form id="{{ $formId }}" class="{{ $formClass }}" action="{{ $formAction }}" method="{{ $formMethod }}">
                    <div class="modal-body">
                        {!! $body !!}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif