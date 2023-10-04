<div class="modal fade" id="edit-data" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Tenaga Kependidikan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="dataFormEdit" name="dataFormEdit" class="form-horizontal">
          <div class="modal-body justify-content-center">
            <input type="hidden" id="id-edit" value="" >
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="nama">Nama Lengkap</label>
              <div class="col-sm-8 has-validation">
                <input type="text" class="form-control" id="nama-edit" placeholder="Nama Lengkap Beserta dengan Gelar"
                  required value="">
                <div class="invalid-feedback" role="alert" id="alert-nama-edit"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="nip" class="col-sm-3 col-form-label">NIP</label>
              <div class="col-sm-8 has-validation">
                <input type="text" class="form-control " id="nip-edit" placeholder="Nomor Induk Pegawai" value="" required>
                <div class="invalid-feedback" role="alert" id="alert-nip-edit"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="phones" class="col-sm-3 col-form-label">Nomor Whatsapp</label>
              <div class="col-sm-8 has-validation">
                <input type="text" class="form-control" id="phones-edit" placeholder="Nomor Whatsapp tanpa spasi"
                  name="phones" required value="{{ old('phones') }}">
                <div class="invalid-feedback" role="alert" id="alert-phones-edit"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-8 has-validation">
                <input type="email" class="form-control " id="email-edit" placeholder="Email" name="email" required
                  value="{{ old('email') }}">
                <div class="invalid-feedback" role="alert" id="alert-email-edit"></div>
              </div>
            </div>
          </div>
        </form>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="update">Save changes</button>
        </div>
      </div>
    </div>
  </div>