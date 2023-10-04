  <div class="control-group">
    <div class="form-group row">
      <label for="namaDosen" class="col-sm-2 col-form-label">Nama Lengkap</label>
      <div class="col-sm-10 has-validation">
        <input type="text" class="form-control @error('nama.' . $fieldCount) is-invalid @enderror"
          placeholder="Nama Lengkap" name="nama[]" required value="{{ old('nama.' . $fieldCount) }}" id="namaDosen">
        @error('nama.' . $fieldCount)
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
        <div class="invalid-feedback">
          Please choose a Nama Lengkap.
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="NIP" class="col-sm-2 col-form-label">NIP</label>
      <div class="col-sm-10 has-validation">
        <input type="text" class="form-control @error('nip.' . $fieldCount) is-invalid @enderror"
          value="{{ old('nip.' . $fieldCount) }}" id="nip" placeholder="Nomor Induk Pegawai" name="nip[]"
          required>
        @error('nip.' . $fieldCount)
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
      <div class="col-sm-10 has-validation">
        <input type="text" class="form-control @error('no_hp.' . $fieldCount) is-invalid @enderror"
          value="{{ old('no_hp.' . $fieldCount) }}" id="NomorHp" placeholder="Nomor HP" name="no_hp[]" required>
        @error('no_hp.' . $fieldCount)
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
        {{-- <div class="invalid-feedback">
          Please choose a No HP.
        </div> --}}
      </div>
    </div>
    <div class="form-group row">
      <label for="Email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10 has-validation">
        <input type="email" class="form-control @error('email.' . $fieldCount) is-invalid @enderror" id="Email"
          placeholder="Email" name="email[]" value="{{ old('email.' . $fieldCount) }}" required>
        @error('email.' . $fieldCount)
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
        <div class="invalid-feedback">
          Please choose a Email
        </div>
      </div>
    </div>
    <button class="btn btn-danger remove" type="button">
      <i class="fa fa-fw fa-user-minus"></i> Add
    </button>
    <hr>
  </div>
