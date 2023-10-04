@extends('adminlte::page')

@section('title', 'Mahasiswa')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Data Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('mahasiswa') }}">Mahasiswa</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@stop
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Input Data Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal needs-validation" novalidate method="POST"
              action="{{ route('mahasiswa.update', $mahasiswa->id) }}" id="editMahasiswa">
              @method('PUT')
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="prodi"
                      placeholder="Nama Mahasiswa" name="nama" required value="{{ old('nama', $mahasiswa->nama) }}">
                    @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="prodi"
                      placeholder="Nomor Induk Mahasiswa" name="nim" required
                      value="{{ old('nim', $mahasiswa->nim) }}">
                    @error('nim')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="program studi" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('kodeProdi') is-invalid @enderror" name="kodeProdi"
                      data-placeholder="::Pilih Program Studi...::" required>
                      <option value="" selected disabled> </option>
                      @foreach ($prodi as $list)
                        @if (old('kodeProdi', $list->kode) === $mahasiswa->kode_prodi)
                          <option value="{{ $list->kode }}" selected>{{ $list->nama }} - {{ $list->jenjang }}</option>
                        @else
                          <option value="{{ $list->kode }}">{{ $list->nama }} - {{ $list->jenjang }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('kodeProdi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                      placeholder="Angkatan" name="angkatan" value="{{ old('no_hp', $mahasiswa->angkatan) }}" required>
                    <div class="invalid-feedback">
                        @if ($errors->has('angkatan'))
                        {{ $errors->first('angkatan') }}
                      @else
                        Please choose a Angkatan
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="NomorHP"
                      placeholder="Nomor HP" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}" required>
                    <div class="invalid-feedback">
                      @if ($errors->has('no_hp'))
                        {{ $errors->first('no_hp') }}
                      @else
                        Please choose a Nomor HP
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="Email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10 has-validation">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="Email"
                      placeholder="Email Student" name="email" value="{{ old('email', $mahasiswa->email) }}" required>
                    <div class="invalid-feedback">
                      @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                      @else
                        Please choose a Email
                      @endif
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            {{-- <button onclick="location.href='{{ url('mahasiswa') }}'" class="btn btn-default float-right">Cancel</button> --}}
            <a href="{{ url()->previous() }}" class="btn btn-default float-right">Cancel</a>
          </div>
          <!-- /.card-footer -->
          </form>
        </div>

      </div>
    </div>
    <!-- /.card -->
  </section>
@stop
@section('js')
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
    });
  </script>
@stop
@section('footer')
  @include('components.footer')
@stop
