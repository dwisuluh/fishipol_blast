@extends('adminlte::page')

@section('meta_tags')
  <meta name="csrf_token" content="{{ csrf_token() }}">
@stop

@section('title', 'Tenaga Kependidikan')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tenaga Kependidikan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
            <li class="breadcrumb-item active">Tenaga Kependidikan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@stop

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row col-md-12">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Data Tenaga Kependidikan</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='javascript:void(0)'" id="btn-create" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped data-table" id="data-table">
                <thead class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('tendik.component.add')
  @include('tendik.component.edit')
  @include('tendik.component.import')
@stop

@section('footer')
  @include('components.footer')
@stop

@section('js')
  @include('tendik.component.js')
@stop
