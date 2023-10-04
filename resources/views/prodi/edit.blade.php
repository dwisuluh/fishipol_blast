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
              <h3 class="card-title">Input Data Program Studi</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal needs-validation" novalidate method="POST"
              action="{{ route('prodi.update', $programStudi->id) }}" id="addProdi">
              @method('PUT')
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                      placeholder="Nama Program Studi" name="prodi" value="{{ old('nama', $programStudi->nama) }}"
                      required>
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
                      required>
                      {{-- <option selected="selected"></option> --}}
                      <option> </option>
                      @if (old('departemen', $programStudi->departemen) === 'Pendidikan Kewarganegaraan dan Hukum')
                        <option selected>Pendidikan Kewarganegaraan dan Hukum</option>
                      @else
                        <option>Pendidikan Kewarganegaraan dan Hukum</option>
                      @endif
                      @if (old('departemen', $programStudi->departemen) === 'Pendidikan Geografi')
                        <option selected>Pendidikan Geografi/option>
                        @else
                        <option>Pendidikan Geografi</option>
                      @endif
                      @if (old('departemen', $programStudi->departemen) === 'Pendidikan Sejarah')
                        <option selected>Pendidikan Sejarah</option>
                      @else
                        <option>Pendidikan Sejarah</option>
                      @endif
                      @if (old('departemen', $programStudi->departemen) === 'Pendidikan Sosiologi')
                        <option selected>Pendidikan Sosiologi</option>
                      @else
                        <option>Pendidikan Sosiologi</option>
                      @endif
                      @if (old('departemen', $programStudi->departemen) === 'Pendidikan Ilmu Pengetahuan Sosial')
                        <option selected>Pendidikan Ilmu Pengetahuan Sosial</option>
                      @else
                        <option>Pendidikan Ilmu Pengetahuan Sosial</option>
                      @endif
                      @if (old('departemen', $programStudi->departemen) === 'Administrasi Publik')
                        <option selected>Administrasi Publik</option>
                      @else
                        <option>Administrasi Publik</option>
                      @endif
                      @if (old('departemen', $programStudi->departemen) === 'Ilmu Komunikasi')
                        <option selected>Ilmu Komunikasi</option>
                      @else
                        <option>Ilmu Komunikasi</option>
                      @endif
                    </select>
                    @error('departemen')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="kodeProdi" class="col-sm-2 col-form-label">Kode Prodi</label>
                <div class="col-sm-10 has-validation">
                  <input type="number" class="form-control @error('kode_prodi') is-invalid @enderror" id="kodeProdi"
                    placeholder="Kode Program Studi" name="kode_prodi" value="{{ old('nama', $programStudi->kode) }}"
                    required>
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
                  <select class="form-control select2bs4 @error('jenjang') is-invalid @enderror" name="jenjang" required>
                    {{-- <option selected="selected"></option> --}}
                    <option> </option>
                    @if (old('jenjang', $programStudi->jenjang) === 'S1')
                      <option selected>S1</option>
                    @else
                      <option>S1</option>
                    @endif
                    @if (old('jenjang', $programStudi->jenjang) === 'S2')
                      <option selected>S2</option>
                    @else
                      <option>S2</option>
                    @endif
                    @if (old('jenjang', $programStudi->jenjang) === 'S3')
                      <option selected>S3</option>
                    @else
                      <option>S3</option>
                    @endif
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
