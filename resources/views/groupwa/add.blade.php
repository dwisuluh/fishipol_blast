<div class="modal fade" id="add-data" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Group Kontak Whatsapp</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="dataForm" name="dataForm" class="form-horizontal">
        <div class="modal-body justify-content-center">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="name">Nama Group</label>
            <div class="col-sm-8 has-validation">
              <input type="text" class="form-control" id="name" placeholder="Nama Group Kontak"
                required>
              <div class="invalid-feedback" role="alert" id="alert-name"></div>
            </div>
          </div>
          <div class="form-group row">
            <label for="scope" class="col-sm-3 col-form-label">Lingkup Group</label>
            <div class="col-sm-8 has-validation">
              <input type="text" class="form-control " id="scope" placeholder="Lingkup Group" required>
              <div class="invalid-feedback" role="alert" id="alert-scope"></div>
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="store">Save changes</button>
      </div>
    </div>
  </div>
</div>
