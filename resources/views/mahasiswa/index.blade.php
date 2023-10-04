@extends('adminlte::page')

@section('meta_tags')
  <meta name="csrf_token" content="{{ csrf_token() }}">
@stop


@section('title', 'Mahasiswa')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Mahasiswa</li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Mahasiswa</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='{{ route('mahasiswa.create') }}'" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-data" class="table table-bordered table-striped">
                <thead class="text-center">
                  <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Jenjang</th>
                    <th>Nomor HP</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="text-center">
                  <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Jenjang</th>
                    <th>Nomor HP</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  @include('mahasiswa.components.import')
  @include('mahasiswa.components.showModal')
@stop

@section('footer')
  @include('components.footer')
@stop

@section('js')
  @include('mahasiswa.components.js')

  @if (session()->has('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success...',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500,
      });
    </script>
  @endif
@stop
{{-- @section('plugins.BsCustomFileInput',true) --}}
