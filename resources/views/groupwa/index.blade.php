@extends('adminlte::page')

@section('meta_tags')
  <meta name="csrf_token" content="{{ csrf_token() }}">
@stop

@section('title', 'Group Kontak WA')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Group Kontak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
            <li class="breadcrumb-item active">Group Kontak</li>
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
              <h3 class="card-title"> Data Group</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='javascript:void(0)'" id="btn-create" />
              {{-- <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" /> --}}
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped data-table">
                <thead class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Nama Group</th>
                    <th>Lingkungan Group</th>
                    <th>Jumlah Anggota</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Nama Group</th>
                    <th>Lingkungan Group</th>
                    <th>Jumlah Anggota</th>
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
  @include('groupwa.add')
@stop

@section('footer')
  @include('components.footer')
@stop

@section('js')
  <script>
    $(document).ready(function() {

      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      var table = $('.data-table').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('data-group') }}",
          type: "GET",
        //   dataSrc: '',
        },
        // console.log(data);
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center',
          },
          {
            data: 'name',
            name: 'name',
          },
          {
            data: 'scope',
            name: 'scope',
          },
          {
            data: 'jumlah',
            name: 'jumlah',
            className: 'text-center',
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

      $('body').on('click', '#btn-create', function() {
        $('#add-data').modal('show');
      });

      $('#store').click(function(e) {
        e.preventDefault();

        let name = $('#name').val();
        let scope = $('#scope').val();
        let token = $("meta[name='csrf-token']").attr("content");

        console.log(name);

        $.ajax({
          url: `/groupWa`,
          type: "POST",
          cache: false,
          data: {
            "name": name,
            "scope": scope,
            "_token": token
          },
          success: function(response) {

            $('#dataForm').trigger("reset");
            $('#add-data').modal('hide');
            //   $('#store').html('Save Changes');

            //   table.draw();
            table.ajax.reload();

            Toast.fire({
              icon: 'success',
              title: `${response.message}`,
            });
          },
          error: function(error) {
            if (error.responseJSON.name) {
              // show alert
              $('#name').addClass('is-invalid');
              //add message to alert
              $('#alert-name').html(error.responseJSON.name);
            }
            if (error.responseJSON.scope) {
              // show alert
              $('#scope').addClass('is-invalid');

              //add message to alert
              $('#alert-scope').html(error.responseJSON.scope);
            }
          }
        });
      });
      $('body').on('click', ".deleteData", function() {
        let id = $(this).data('id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: "DELETE",
              url: "/groupWa/" + id,
              cache: false,
              data: {
                _token: '{{ csrf_token() }}',
              },
              success: function(response) {
                table.ajax.reload();
                Toast.fire({
                  icon: 'success',
                  title: 'Success...',
                  text: `${response.message}`,
                });
              },
            });
          }
        });
      });

    });
  </script>
@stop
