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
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Program Studi</li>
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
              <h3 class="card-title">Data Program Studi</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='{{ route('prodi.create') }}'" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Program Studi</th>
                    <th>Departemen</th>
                    <th>Jenjang</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($prodis as $list)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $list->nama }}</td>
                      <td>{{ $list->departemen }}</td>
                      <td>{{ $list->jenjang }}</td>
                      <td>
                        <a href="{{ route('prodi.edit', $list->id) }}" class="btn btn-sm btn-primary mx-1 shadow"
                          data-toggle="tooltip" data-placement="top" title="Edit"><i
                            class="icon fas fa-fw fa-edit"></i></a>
                        <form data-route="{{ route('prodi.destroy', $list->id) }}" method="POST"
                          class="delete-form d-inline">
                          @method('delete')
                          <a href="#" data-toggle="modal" data-target="#detailShow" data-id="{{ $list->id }}"
                            class="btn btn-success btn-sm mx-1 shadow"><i class="fa fa-fw fa-eye"></i></a>
                          <button type="submit" class="btn btn-danger btn-sm btndelete"><i class="fa fa-fw fa-trash"
                              data-toggle="tooltip" data-placement="top" title="Delete"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Program Studi</th>
                    <th>Departemen</th>
                    <th>Jenjang</th>
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
  @include('prodi.components.showModal')
  @include('prodi.components.import')
@stop

@section('js')
  @include('prodi.components.js')
@stop

@section('footer')
  @include('components.footer')
@stop
