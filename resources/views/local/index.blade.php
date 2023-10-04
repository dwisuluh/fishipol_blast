@extends('adminlte::page')

@section('title', 'Local File')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kirim Whatsapp Local Fle</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Send Local</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@stop
@section('content')
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Quick Example</h3>
    </div>
    <form class="needs-validation" novalidate method="post" action="{{ route('local.store') }}"
      enctype="multipart/form-data">
      @csrf
      {{-- <input type="text" placeholder="081393961320,0821212122,08128282812"name='phones'>
      <input type="text" name="caption">
      <input type="file" name="file">
      <button type="submit"> Submit</button> --}}
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nomor Whatsapp</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Whatsapp Number" required
            name="phones">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Caption</label>
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Caption" required
            name="caption">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="exampleInputFile" required name="file">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            {{-- <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div> --}}
          </div>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>

@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
@stop

@section('plugins.BsCustomFileInput', true)
