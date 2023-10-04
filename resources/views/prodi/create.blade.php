@extends('adminlte::page')

@section('title', 'Program Studi')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Program Studi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('prodi.index') }}">Program Studi</a></li>
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
              <h3 class="card-title">Input Data Program Studi</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal needs-validation" novalidate method="POST" action="{{ route('prodi.store') }}"
              id="addProdi">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                      placeholder="Nama Program Studi" value="{{ old('prodi') }}" name="prodi" required>
                    @error('prodi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="departemen" class="col-sm-2 col-form-label">Departemen</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('departemen') is-invalid @enderror" name="departemen"
                      data-placeholder=":: Pilih Program Studi ....::" required>
                      <option selected disabled value=""></option>
                      <option value="Pendidikan Kewarganegaraan dan Hukum" {{ old('departemen') == "Pendidikan Kewarganegaraan dan Hukum" ? 'selected' : '' }}>Pendidikan Kewarganegaraan dan Hukum</option>
                      <option value="Pendidikan Geografi" {{ old('departemen') == "Pendidikan Geografi" ? 'selected' : '' }}>Pendidikan Geografi</option>
                      <option value="Pendidikan Sejarah" {{ old('departemen') == "Pendidikan Sejarah" ? 'selected' : '' }}>Pendidikan Sejarah</option>
                      <option value="Pendidikan Sosiologi" {{ old('departemen') == "Pendidikan Sosiologi" ? 'selected' : '' }}>Pendidikan Sosiologi</option>
                      <option value="Pendidikan Ilmu Pengetahuan Sosial" {{ old('departemen') == "Pendidikan Ilmu Pengetahuan Sosial" ? 'selected' : '' }}>Pendidikan Ilmu Pengetahuan Sosial</option>
                      <option value="Administrasi Publik" {{ old('departemen') == "Administrasi Publik" ? 'selected' : '' }}>Administrasi Publik</option>
                      <option value="Ilmu Komunikasi" {{ old('departemen') == "Ilmu Komunikasi" ? 'selected' : '' }}>Ilmu Komunikasi</option>
                    </select>
                    @error('departemen')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="kodeProdi" class="col-sm-2 col-form-label">Kode Prodi</label>
                  <div class="col-sm-10 has-validation">
                    <input type="number" class="form-control @error('kode_prodi') is-invalid @enderror" id="kodeProdi"
                      placeholder="Kode Program Studi" value="{{ old('kode_prodi') }}" name="kode_prodi" required>
                      @error('kode_prodi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="jenjang" class="col-sm-2 col-form-label">Jenjang</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('jenjang') is-invalid @enderror" name="jenjang"
                      data-placeholder=":: Pilih Jenjang..:: " required>
                      <option selected disabled value=""></option>
                      <option value="S1" {{ old('jenjang') == "S1" ? "selected" : "" }}>S1</option>
                      <option value="S2" {{ old('jenjang') == "S2" ? "selected" : "" }}>S2</option>
                      <option value="S3" {{ old('jenjang') == "S3" ? "selected" : "" }}>S3</option>
                      <option value="D3" {{ old('jenjang') == "D3" ? "selected" : "" }}>D3</option>
                      <option value="D4" {{ old('jenjang') == "D4" ? "selected" : "" }}>D4</option>
                    </select>
                    @error('jenjang')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  </div>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <button onclick="location.href='{{ route('prodi.index') }}'"
              class="btn btn-default float-right">Cancel</button>
          </div>
          <!-- /.card-footer -->
          </form>
        </div>

      </div>
    </div>
    <!-- /.card -->
  </section>
@stop
{{-- @section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4',
      });
    });
  </script>
@stop
@section('footer')
  @include('components.footer')
@stop
