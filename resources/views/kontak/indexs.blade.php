@extends('adminlte::page')

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
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Kontak</li>
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
              <h3 class="card-title">Data Kontak</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='javascript:void(0)'" id="create-post" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nomor Whatsapp</th>
                    <th>Kelompok Kontak</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kontaks as $list)
                    <tr>
                      <input type="hidden" class="delete_id" value="{{ $list->id }}">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $list->nama }}</td>
                      <td>{{ $list->no_hp }}</td>
                      <td> {{ $list->jenis == 1 ? 'Dosen' : ($list->jenis == 2 ? 'Tenaga Kependidikan' : ($list->jenis == 3 ? 'Mahasiswa' : ($list->jenis == 4 ? 'Alumni' : 'Tamu'))) }}</td>
                      <td>
                        <a href="{{ route('kontak.edit', $list->id) }}" class="btn btn-sm btn-primary mx-1 shadow"
                          data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-fw fa-pen"></i></a>
                        <form action="{{ route('kontak.destroy', $list->id) }}" method="POST"
                          class="delete-form d-inline">
                          @csrf
                          @method('delete')
                          <a href="{{ route('kontak.edit', $list->id) }}" class="btn btn-success btn-sm mx-1 shadow"><i
                              class="fa fa-fw fa-eye"></i></a>
                          <button class="btn btn-danger btn-sm btndelete"><i class="fa fa-fw fa-trash"
                              data-toggle="tooltip" data-placement="top" title="Delete"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nomor Whatsapp</th>
                    <th>Kelompok Kontak</th>
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
  <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{ route('upload-kontak') }}" enctype="multipart/form-data" class="needs-validation"
        novalidate>
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" id="exampleInputFile" name="file" required>
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @include('components.modal-create')
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
  <script>
    //button create post event
    $('body').on('click', '#create-post', function() {

      //open modal
      $('#modal-create').modal('show');
    });

    //action create post
    $('#store').click(function(e) {
      e.preventDefault();

      //define variable
      let title = $('#title').val();
      let content = $('#content').val();
      let token = $("meta[name='csrf-token']").attr("content");

      //ajax
      $.ajax({

        url: `/posts`,
        type: "POST",
        cache: false,
        data: {
          "title": title,
          "content": content,
          "_token": token
        },
        success: function(response) {

          //show success message
          Swal.fire({
            type: 'success',
            icon: 'success',
            title: `${response.message}`,
            showConfirmButton: false,
            timer: 3000
          });

          //data post
          let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.title}</td>
                        <td>${response.data.content}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

          //append to table
          $('#table-posts').prepend(post);

          //clear form
          $('#title').val('');
          $('#content').val('');

          //close modal
          $('#modal-create').modal('hide');


        },
        error: function(error) {

          if (error.responseJSON.title[0]) {

            //show alert
            $('#alert-title').removeClass('d-none');
            $('#alert-title').addClass('d-block');

            //add message to alert
            $('#alert-title').html(error.responseJSON.title[0]);
          }

          if (error.responseJSON.content[0]) {

            //show alert
            $('#alert-content').removeClass('d-none');
            $('#alert-content').addClass('d-block');

            //add message to alert
            $('#alert-content').html(error.responseJSON.content[0]);
          }

        }

      });

    });
  </script>
  <script>
    $(document).ready(function() {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.btndelete').click(function(e) {
        e.preventDefault();

        var deleteid = $(this).closest("tr").find('.delete_id').val();
        // var deleteid = $(this).closest("form").find('.delete_id').val();

        swal.fire({
            icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          })
          .then((willDelete) => {
            if (willDelete.isConfirmed) {

              var data = {
                "_token": $('input[name=_token]').val(),
                'id': deleteid,
              };
              $.ajax({
                type: "DELETE",
                url: 'mahasiswa/' + deleteid,
                data: data,
                success: function(response, textStatus, xhr) {
                  Swal.fire({
                      icon: 'success',
                      title: response,
                      showDenyButton: false,
                      showCancelButton: false,
                      showConfirmButton: false,
                      timer: 1500
                    })
                    .then((result) => {
                      location.reload();
                    });
                }
              });
            }
          });
      });

    });
  </script>
  <script>
    $(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
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


@section('footer')
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>FISHIPOL &copy; 2023 <a href="https://fishippol.uny.ac.id">fishipol.uny.ac.id</a>.</strong> All rights reserved.
@stop
@section('plugins.BsCustomFileInput', true)
