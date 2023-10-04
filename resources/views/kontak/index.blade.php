@extends('adminlte::page')
@section('css')
  {{-- <style>
    .dataTables_wrapper {
      min-height: 100%;
      position: relative;
      overflow-x: auto;
    }

    .dataTables_wrapper>.row {
      height: 100%;
    }

    .dataTables_wrapper .dataTables_scroll {
      position: relative;
      overflow: auto;
      max-height: 100%;
      min-height: 100%;
    }

    .dataTables_wrapper .dataTables_scrollBody {
      position: relative;
      overflow: auto;
      max-height: 100%;
      min-height: 100%;
    }
  </style> --}}

@stop
@section('title', 'Kontak WA')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kontak Whatsapp</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
            <li class="breadcrumb-item active">Kontak</a></li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Kontak</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='javascript:void(0)'" id="create-post" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Synchronize" theme="success"
                icon="fas fa-sync" onclick="location.href='{{ route('kontak-sync') }}'" id="sync-contact" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>

            <div class="card-body">
              {{-- <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nomor Whatsapp</th>
                    <th>Kelompok Kontak</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nomor Whatsapp</th>
                    <th>Kelompok Kontak</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table> --}}
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3">
                      <h3 class="card-title">Data Kontak</h3>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="dosen-tab" data-toggle="tab" href="#dosen" role="tab"
                        aria-controls="dosen" aria-selected="true">Dosen</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pegawai-tab" data-toggle="tab" href="#pegawai" role="tab"
                        aria-controls="pegawai" aria-selected="false">Pegawai</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="mahasiswa-tab" data-toggle="tab" href="#mahasiswa" role="tab"
                        aria-controls="mahasiswa" aria-selected="false">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="non-tab" data-toggle="tab"
                        href="#non" role="tab" aria-controls="non"
                        aria-selected="false">Non Rolle</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
                      <table id="table-dosen" class="table table-bordered table-striped">
                        <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Whatsapp</th>
                            <th>Kelompok Kontak</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Whatsapp</th>
                            <th>Kelompok Kontak</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div class="tab-pane fade" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
                      <table id="table-pegawai" class="table table-bordered table-striped">
                        <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Whatsapp</th>
                            <th>Kelompok Kontak</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Whatsapp</th>
                            <th>Kelompok Kontak</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div class="tab-pane fade" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
                      <table id="table-mahasiswa" class="table table-bordered table-striped">
                        <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Nomor Whatsapp</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <tr class="text-center">
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Nomor Whatsapp</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div class="tab-pane fade" id="non" role="tabpanel" aria-labelledby="non-tab">
                      <table id="table-non" class="table table-bordered table-striped">
                        <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Whatsapp</th>
                            <th>Kelompok Kontak</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Whatsapp</th>
                            <th>Kelompok Kontak</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('kontak.components.import')
@stop

@section('footer')
  @include('components.footer')
@stop

@section('js')
  @include('kontak.components.js')
  @if (session()->has('success'))
    <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
      });
    </script>
  @endif
@stop
