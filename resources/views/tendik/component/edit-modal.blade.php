<div class="modal fade" id="modal-edit" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Tenaga Kependidikan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form id="form" class="form-control" action="{{ route('tendik.store') }}">
          @csrf --}}
          <input type="hidden" id="id">
          <div class="modal-body justify-content-center">
            <div class="form-group row">
              <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
              <div class="col-sm-8 has-validation">
                <input type="text" class="form-control" id="nama-edit" placeholder="Nama Lengkap beserta Gelar" required>
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="phones" class="col-sm-3 col-form-label">Nomor Whatsapp</label>
              <div class="col-sm-8 has-validation">
                <input type="text" class="form-control @error('phones') is-invalid @enderror" id="phones-edit"
                  placeholder="Nomor Whatsapp tanpa spasi" name="phones" required value="{{ old('phones') }}">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-phones"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-8 has-validation">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-edit"
                  placeholder="Email" name="email" required value="{{ old('email') }}">
                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                <div class="valid-feedback">
                  Email its Good
                </div>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="invalid-feedback">
                  Please choose a Email.
                </div>
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
