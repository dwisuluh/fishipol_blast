@extends('adminlte::page')

@section('title', 'Edit Data Dosen')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dosen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('dosen') }}">Data Dosen</a></li>
            <li class="breadcrumb-item active">Edit Data</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@stop

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Data Dosen</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal needs-validation" novalidate method="POST"
              action="{{ route('dosen.update', $dosen->id) }}">
              @method('PUT')
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                      placeholder="Nama Lengkap" name="nama" id="nama" value="{{ old('nama', $dosen->name) }}"
                      required autofocus />
                    @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="NIP" class="col-sm-2 col-form-label">NIP</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="NIP"
                      placeholder="Nomor Induk Pegawai" name="nip" value="{{ old('nip', $dosen->nip) }}" required />
                    @error('nip')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="NIDN" class="col-sm-2 col-form-label">NIDN</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="NIDN"
                      placeholder="Nomor Induk Dosen Nasional" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" required />
                    @error('nidn')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="NomorHp"
                      placeholder="Nomor HP" name="no_hp[]" value="{{ old('no_hp', $dosen->no_hp) }}" required />
                    @error('no_hp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10 has-validation">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                      placeholder="Email" name="email" value="{{ old('email', $dosen->email) }}" required />
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Submit</button>
                <button onclick="location.href='{{ url('dosen') }}'" class="btn btn-default float-right">Cancel</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
@stop
@section('footer')
  @include('components.footer')
@stop
