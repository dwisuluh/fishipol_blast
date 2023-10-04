@extends('adminlte::page')

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
              <table id="example2" class="table table-bordered table-striped">
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
                  @foreach ($mahasiswas as $list)
                    <tr>
                      <input type="hidden" class="delete_id" value="{{ $list->id }}">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $list->nim }}</td>
                      <td>{{ $list->nama }}</td>
                      <td>{{ $list->nama_prodi }}</td>
                      <td>{{ $list->jenjang }}</td>
                      <td>{{ $list->no_hp }}</td>
                      <td>
                        <a href="{{ route('mahasiswa.edit', $list->id) }}" class="btn btn-sm btn-primary mx-1 shadow"
                          data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-fw fa-pen"></i></a>
                        <form action="{{ route('mahasiswa.destroy', $list->id) }}" method="POST"
                          class="delete-form d-inline">
                          @csrf
                          @method('delete')
                          <a href="{{ route('mahasiswa.edit', $list->id) }}"
                            class="btn btn-success btn-sm mx-1 shadow"><i class="fa fa-fw fa-eye"></i></a>
                          <button class="btn btn-danger btn-sm btndelete"><i class="fa fa-fw fa-trash"
                              data-toggle="tooltip" data-placement="top" title="Delete"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
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
  <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{ route('upload-mahasiswa') }}" enctype="multipart/form-data" class="needs-validation"
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
@stop

{{-- @section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
  <script>
    $(document).ready(function() {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.deleteData').click(function(e) {
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
      //   $("#example1").DataTable({
      //     "responsive": true,
      //     "lengthChange": false,
      //     "autoWidth": false,
      //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('mahasiswa.index') }}",
        "columns": [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center',
          },
          {
            data: 'nim',
            name: 'nim',
          },
          {
            data: 'nama',
            name: 'nama',
          },
          {
            data: 'nama_prodi',
            name: 'nama_prodi',
          },
          {
            data: 'jenjang',
            name: 'jenjang',
          },
          {
            data: 'no_hp',
            name: 'no_hp',
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            className: 'text-center',
          },
        ]
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
  @include('components.footer')
@stop
@section('plugins.BsCustomFileInput', true)
