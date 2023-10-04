<div class="modal fade" id="modal-create" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Data Tenaga Kependidikan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- <form id="form" class="form-control" action="{{ route('tendik.store') }}">
        @csrf --}}
      <div class="modal-body justify-content-center">
        <div class="form-group row">
          <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
          <div class="col-sm-8 has-validation">
            <input type="text" class="form-control " id="nama" placeholder="Nama Lengkap beserta Gelar"
              required>
            <div class="invalid-feedback" role="alert" id="alert-nama"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nip" class="col-sm-3 col-form-label">NIP</label>
          <div class="col-sm-8 has-validation">
            <input type="text" class="form-control " id="nip" placeholder="Nomor Induk Pegawai" required>
            <div class="invalid-feedback" role="alert" id="alert-nip"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="phones" class="col-sm-3 col-form-label">Nomor Whatsapp</label>
          <div class="col-sm-8 has-validation">
            <input type="text" class="form-control" id="phones" placeholder="Nomor Whatsapp tanpa spasi"
              name="phones" required value="{{ old('phones') }}">
            <div class="invalid-feedback" role="alert" id="alert-phones"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-8 has-validation">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
              placeholder="Email" name="email" required value="{{ old('email') }}">
            <div class="invalid-feedback" role="alert" id="alert-email"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="store">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal -->
