<div class="modal fade" id="edit-dosen" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Dosen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body justify-content-center">
        <input type="hidden" id="id-dosen">
        <div class="form-group row">
          <label for="edit-name" class="col-sm-2 col-form-label">Nama Lengkap</label>
          <div class="col-sm-10 has-validation">
            <input type="text" class="form-control" placeholder="Nama Lengkap" id="edit-name"
              required autofocus />
            <div class="invalid-feedback" role="alert" id="alert-edit-name"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="edit-nip" class="col-sm-2 col-form-label">NIP</label>
          <div class="col-sm-10 has-validation">
            <input type="text" class="form-control" id="edit-nip" placeholder="Nomor Induk Pegawai" required />
            <div class="invalid-feedback" role="alert" id="alert-edit-nip"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="edit-nidn" class="col-sm-2 col-form-label">NIDN</label>
          <div class="col-sm-10 has-validation">
            <input type="text" class="form-control " id="edit-nidn" placeholder="Nomor Induk Dosen Nasional"
              required />
            <div class="invalid-feedback" role="alert" id="alert-edit-nidn"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="edit-no_hp" class="col-sm-2 col-form-label">Nomor HP</label>
          <div class="col-sm-10 has-validation">
            <input type="text" class="form-control " id="edit-no_hp" placeholder="Nomor HP" required />
            <div class="invalid-feedback" role="alert" id="alert-edit-no_hp"></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="edit-email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10 has-validation">
            <input type="email" class="form-control " id="edit-email" placeholder="Email" required />
            <div class="invalid-feedback" role="alert" id="alert-edit-email"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="update">Save changes</button>
      </div>
    </div>
  </div>
</div>
