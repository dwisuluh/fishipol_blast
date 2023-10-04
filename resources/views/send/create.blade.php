@extends('adminlte::page')

@section('title', 'Send WA')

@section('content_header')
  <section class="content-header">
    <div class="container-header">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Send Message</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('sendwa') }}">Send Whatsapp</a></li>
            <li class="breadcrumb-item active">Send Message</li>
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
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Entri Message</h3>
            </div>
            <form class="form-horizontal needs-validation" novalidate method="POST" action="{{ route('sendWa.store') }}"
              id="myMessage" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="perihal" class="col-sm-2 col-form-label">Perihal Pesan</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal"
                      placeholder=":: Perihal Pesan ... :: " name="perihal" value="{{ old('perihal') }}" name="perihal"
                      required>
                    <div class="invalid-feedback">
                      Perihal Pesan is Required
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="penerima" class="col-sm-2 col-form-label">Daftar Penerima</label>
                  <div class="col-sm-10">
                    <span class="ml-2">
                      <div class="custom-control custom-checkbox d-inline">
                        <input type="checkbox"
                          class="custom-control-input custom-control-input-primary custom-control-input-outline validate"
                          id="cdosen" value="cdosen" name="cdosen" @checked(old('cdosen'))>
                        <label class="custom-control-label ml-1" for="cdosen"> Set Dosen</label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="custom-control custom-checkbox d-inline">
                        <input type="checkbox" id="ctendik"
                          class="custom-control-input custom-control-input-primary custom-control-input-outline validate"
                          value="ctendik" name="ctendik" @checked(old('ctendik'))>
                        <label for="ctendik" class="custom-control-label ml-1">Set Tendik</label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="custom-control custom-checkbox d-inline">
                        <input type="checkbox" id="cmahasiswa"
                          class="custom-control-input custom-control-input-primary custom-control-input-outline validate"
                          value="cmahasiswa" name="cmahasiswa" @checked(old('cmahasiswa'))>
                        <label for="cmahasiswa" class="custom-control-label ml-1">Set Mahasiswa</label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="custom-control custom-checkbox d-inline">
                        <input type="checkbox" id="cgroup"
                          class="custom-control-input custom-control-input-primary custom-control-input-outline validate"
                          value="cgroup" name="cgroup" @checked(old('cgroup'))>
                        <label for="cgroup" class="custom-control-label ml-1">Set Group</label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="custom-control custom-checkbox d-inline">
                        <input type="checkbox" id="cNoKontak"
                          class="custom-control-input custom-control-input-primary custom-control-input-outline validate"
                          value="cNoKontak" name="cNoKontak" @checked(old('cNoKontak'))>
                        <label for="cNoKontak" class="custom-control-label ml-1">Set No Whatsapp</label>
                      </div>
                    </span>
                  </div>
                </div>
                <div class="form-group row" id="dosenShow" style="display: none">
                  <label for="dosen" class="col-sm-2 col-form-label">Send to Dosen</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('dosen') is-invalid @enderror"
                      data-placeholder=":: Pilih Penerima Dosen .... ::" name="dosen[]" id="dosen" disabled
                      multiple>
                      {{-- <option value="" disabled selected></option> --}}
                      <option value="all-dosen">:: Semua Dosen ... ::</option>
                      @foreach ($kontaks->where('jenis', 1) as $list)
                        <option value="{{ $list->id }}"
                          {{ collect(old('dosen'))->contains($list->id) ? 'selected' : '' }}>{{ $list->nama }}</option>
                      @endforeach
                    </select>
                    @error('dosen')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row" id="tendikShow" style="display: none">
                  <label for="tendik" class="col-sm-2 col-form-label">Send to Tendik</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('tendik') is-invalid @enderror"
                      data-placeholder=" :: Pilih Penerima Tendik ... :: " name="tendik[]" id="tendik" disabled
                      multiple>
                      <option value="all-tendik">:: Semua Tendik ... ::</option>
                      @foreach ($kontaks->where('jenis', 2) as $list)
                        <option value="{{ $list->id }}"
                          {{ collect(old('tendik'))->contains($list->id) ? 'selected' : '' }}>{{ $list->nama }}</option>
                      @endforeach
                    </select>
                    @error('tendik')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row" id="mahasiswaShow" style="display: none">
                  <label for="mahasiswa" class="col-sm-2 col-form-label">Send to Mahasiswa</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('mahasiswa') is-invalid @enderror"
                      data-placeholder=" :: Pilih Penerima Mahasiswa...:: " name="mahasiswa[]" id="mahasiswa" disabled
                      multiple>
                      <option value="all-mahasiswa">:: Semua Mahasiswa ... :::</option>
                      @foreach ($mahasiswas as $list)
                        <option value="{{ $list->id }}"
                          {{ collect(old('mahasiswa'))->contains($list->id) ? 'selected' : '' }}>{{ $list->nama }} - ({{ $list->mahasiswa->nim }})</option>
                      @endforeach
                    </select>
                    @error('mahasiswa')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row" id="groupShow" style="display: none">
                  <label for="mahasiswa" class="col-sm-2 col-form-label">Send to Group</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4 @error('group') is-invalid @enderror"
                      data-placeholder=" :: Pilih Penerima Group...:: " name="group[]" id="group" disabled
                      multiple>
                      @foreach ($groups as $list)
                        <option value="{{ $list->id }}"
                          {{ collect(old('group'))->contains($list->id) ? 'selected' : '' }}>{{ $list->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('group')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">
                    <label for="header" class="col-form-label mr-4">Header</label>
                    <input type="checkbox" id="cheader" value="cheader" name="cheader" @checked(old('cheader'))>
                  </div>
                  <div class="col-sm-10 has-validation" id="headerShow" style="display: none">
                    <textarea class="form-control @error('header') is-invalid @enderror" placeholder="Enter text introduction..."
                      name="header" id="header" rows="4" disabled required>{{ old('header') }}</textarea>
                    @error('header')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row" id="message">
                  <label for="message" class="col-sm-2 col-form-label">Message</label>
                  <div class="col-sm-10 has-validation">
                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10"
                      placeholder="Enter text message..." required>{{ old('message') }}</textarea>
                    @error('message')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">
                    <label for="doc" class="col-form-label mr-4">Link Document</label>
                    <input type="checkbox" id="cdoc" value="cdoc" name="cdoc" @checked(old('cdoc'))>
                  </div>
                  <div class="col-sm-10 has-validation" id="docShow" style="display: none">
                    <textarea class="form-control @error('header') is-invalid @enderror" name="doc" rows="1"
                      placeholder="Text Introduction ..." id="doc" disabled required>{{ old('doc') }}</textarea>
                    @error('header')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">
                    <label for="file" class="col-form-label mr-4">File Upload</label>
                    <input type="checkbox" id="cfile" value="cfile" name="cfile" @checked(old('cfile'))>
                  </div>
                  <div class="col-sm-10 has-validation" id="fileShow" style="display: none">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                          id="file" required name="file" disabled value="{{ old('file') }}">
                        <label class="custom-file-label" for="file">Choose file</label>
                      </div>
                    </div>
                    @error('file')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control" id="kodeProdi" placeholder="Email Student"
                      name="email" required readonly value="{{ Auth::user()->email }}">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Send</button>
                <button onclick="location.href='{{ url('sendWa') }}'" class="btn btn-default float-right"
                  type="reset">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
@section('footer')
  {{-- <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
  </div>
  <strong>FISHIPOL &copy; 2023 <a href="https://fishippol.uny.ac.id">fishipol.uny.ac.id</a>.</strong> All rights
  reserved.</strong> --}}
  @include('components.footer')
@stop
@section('js')
  @include('send.component.js')
  @if ($errors->any())
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ $errors->first() }}',
        confirmButtonText: 'Ok, i Check it!'
      });
    </script>
  @endif
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
@stop
