@extends('adminlte::page')

@section('title', 'Mahasiswa')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Data Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('mahasiswa') }}">Mahasiswa</a></li>
            <li class="breadcrumb-item active">Create</li>
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
              action="{{ route('mahasiswa.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                      placeholder="Nama Mahasiswa" name="nama" required value="{{ old('nama') }}">
                    <div class="invalid-feedback">
                      @if ($errors->has('nama'))
                        {{ $errors->first('nama') }}
                      @else
                        Please choose a Nama Mahasiswa.
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                      placeholder="Nomor Induk Mahasiswa" name="nim" required value="{{ old('nim') }}">
                    <div class="invalid-feedback">
                      @if ($errors->has('nim'))
                        {{ $errors->first('nim') }}
                      @else
                        Please choose a Nomor Induk Mahasiswa.
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="program studi" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('kodeProdi') is-invalid
                    @enderror"
                      data-placeholder="::Pilih Program Studi... ::" name="kodeProdi" required>
                      <option value="" selected disabled> </option>
                      @foreach ($prodis as $list)
                        <option value="{{ $list->kode }}" {{ old('kodeProdi') == $list->kode ? 'selected' : '' }}>
                          {{ $list->nama }} - {{ $list->jenjang }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">
                      @if ($errors->has('kodeProdi'))
                        {{ $errors->first('kodeProdi') }}
                      @else
                        Please choose a Program Studi.
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                      placeholder="Angkatan" name="angkatan" value="{{ old('angkatan') }}" required>
                    <div class="invalid-feedback">
                      @if ($errors->has('angkatan'))
                        {{ $errors->first('angkatan') }}
                      @else
                        Please choose a Angkatan.
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="NomorHP"
                      placeholder="Nomor HP" name="no_hp" value="{{ old('no_hp') }}" required>
                    <div class="invalid-feedback">
                      @if ($errors->has('no_hp'))
                        {{ $errors->first('no_hp') }}
                      @else
                        Please choose a No HP.
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="Email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10 has-validation">
                    <input type="email" class="form-control @error('email')is-invalid @enderror" id="kodeProdi"
                      placeholder="Email Student" name="email" value="{{ old('email') }}" required>
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
            <button onclick="location.href='{{ url('mahasiswa') }}'" class="btn btn-default float-right">Cancel</button>
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
