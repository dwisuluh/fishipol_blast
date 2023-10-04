@extends('adminlte::page')

@section('meta_tags')
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Tenaga Kependidikan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@stop

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Tenaga Kependidikan</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='javascript:void(0)'" id="btn-create" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>
            <div class="card-body">
              <table id="tabel" class="table table-bordered table-striped">
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
                <tbody id="table-tendik">
                  @foreach ($tendiks as $list)
                    <tr id="index_{{ $list->id }}">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $list->name }}</td>
                      <td>{{ $list->nip }}</td>
                      <td>{{ $list->email }}</td>
                      <td>{{ $list->no_hp }}</td>
                      <td class="text-center">
                        <a href="javascript:void(0)" id="btn-edit" data-id="{{ $list->id }}"
                          class="btn btn-primary btn-sm"><i class="far fa-fw fa-edit" data-toggle="tooltip"
                            data-placement="top" title="Edit"></i></a>
                        <a href="javascript:void(0)" id="btn-delete" data-id="{{ $list->id }}"
                          class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash" data-toggle="tooltip"
                            data-placement="top" title="Delete"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
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
  </div>
  @include('tendik.component.add-modal')
  @include('tendik.component.edit-modal')
@stop

@section('footer')
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>FISHIPOL &copy; 2023 <a href="https://fishippol.uny.ac.id">fishipol.uny.ac.id</a>.</strong> All rights reserved.
@stop

@section('js')
  <script>
    $(function() {
      // Fungsi untuk memuat ulang data pada DataTable menggunakan AJAX
      function reloadDataTable() {
        $.ajax({
          url: "{{ route('tendik-reload') }}",
          type: "GET",
          success: function(data) {
            // Hapus data lama pada DataTable
            tabel.clear();

            // Tambahkan data baru pada DataTable
            $.each(data, function(index, value) {
              tabel.row.add([
                index + 1,
                value.name,
                value.nip,
                value.email,
                value.no_hp,
                '<button type="button" class="btn btn-primary btn-edit" data-id="' + value.id +
                '">Edit</button>' +
                '<button type="button" id="btn-delete" class="btn btn-danger btn-delete" data-id="' +value.id +
                '"><i class="icon fas fa-fw fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></button>'
              ]).draw();
            });
          }
        });
      }
      var tabel = $('#tabel').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        render: function(data, type, row, meta) {
          return meta.row + 1;
        }
      });
      // });
      $('body').on('click', "#btn-create", function() {
        $('#modal-create').modal('show');
      });
      $('body').on('click', "#btn-delete", function() {
        let id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");
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

            console.log('test');
            //fetch to delete data
            $.ajax({

              url: `/tendik/${id}`,
              type: "DELETE",
              cache: false,
              data: {
                "_token": token
              },
              success: function(response) {
                //show success message
                reloadDataTable();
                Swal.fire({
                    // type: 'success',
                    icon: 'success',
                    text: 'Success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                //remove post on table
                // $(`#index_${id}`).remove();
              }
            });
          }
        })
      });
      $('#store').click(function(e) {
        e.preventDefault();
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        let nama = $('#nama').val();
        let nip = $('#nip').val();
        let phones = $('#phones').val();
        let email = $('#email').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
          url: `/tendik`,
          type: "POST",
          cache: false,
          data: {
            "nama": nama,
            "nip": nip,
            "phones": phones,
            "email": email,
            "_token": token
          },
          success: function(response) {
            //   Swal.fire({
            //     type: 'success',
            //     icon: 'success',
            //     title: `${response.message}`,
            //     showConfirmButton: false,
            //     timer: 3000
            //   });
            //   window.location.reload();
            tabel.row.add([
              tabel.data().length + 1,
              name,
              nip,
              email,
              phones,
              '<button type="button" class="btn btn-primary btn-edit" data-id="">Edit</button>' +
              '<button type="button" class="btn btn-danger btn-delete" data-id="">Delete</button>'
            ]).draw();
            reloadDataTable();

            Toast.fire({
              // type: 'success',
              icon: 'success',
              title: `${response.message}`,
            });
            // setTimeout(function() {
            //   tabel.ajax.reload();
            // }, 1500);
            //   window.location.reload();
            // $('#tabel').DataTable().draw();
            //   let tendik = `
          //           <tr id="index_${response.data.id}">
          //               <td>${response.data.name}</td>
          //               <td>${response.data.email}</td>
          //               <td>${response.data.no_hp}</td>
          //               <td class="text-center">
          //                   <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-edit" data-toggle="tooltip"
          //                     data-placement="top" title="Edit"></a>
          //                   <a href="javascript:void(0)" id="btn-delete" data-id="${response.data.id}" class="btn btn-danger btn-sm"><i class="far fa-fw fa-trash" data-toggle="tooltip"
          //                     data-placement="top" title="Edit"></a>
          //               </td>
          //           </tr>
          //       `;
            //append to table
            //   $('#tabel').prepend(tendik);
            //clear form
            $('#nama').val('');
            $('#nip').val('');
            $('#phones').val('');
            $('#email').val('');
            //close modal
            $('#modal-create').modal('hide');
          },
          error: function(error) {
            if (error.responseJSON.nama) {
              // show alert
              $('#alert-nama').removeClass('d-none');
              $('#alert-nama').addClass('d-block');
              $('#nama').addClass('is-invalid');

              //add message to alert
              $('#alert-nama').html(error.responseJSON.nama);
            }
            if (error.responseJSON.nip) {
              // show alert
              $('#alert-nip').removeClass('d-none');
              $('#alert-nip').addClass('d-block');
              $('#nip').addClass('is-invalid');

              //add message to alert
              $('#alert-nip').html(error.responseJSON.nip);
            }
            if (error.responseJSON.phones) {
              //show alert
              $('#alert-phones').removeClass('d-none');
              $('#alert-phones').addClass('d-block');
              //add message to alert
              $('#alert-phones').html(error.responseJSON.phones);
            }
            if (error.responseJSON.email) {
              //show alert
              $('#alert-email').removeClass('d-none');
              $('#alert-email').addClass('d-block');
              //add message to alert
              $('#alert-email').html(error.responseJSON.email);
            }
          }
        });
      });
      $('body').on('click', '#btn-edit', function() {

        let id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
          url: `/tendik/${id}`,
          type: "GET",
          cache: false,
          success: function(response) {
            //fill data to form
            $('#id').val(response.data.id);
            $('#nama-edit').val(response.data.name);
            $('#phones-edit').val(response.data.no_hp);
            $('#email-edit').val(response.data.email);
            //open modal
            $('#modal-edit').modal('show');
          }
        });
      });
      //action update post
      $('#update').click(function(e) {
        e.preventDefault();
        //define variable
        let id = $('#id').val();
        let nama = $('#nama-edit').val();
        let phones = $('#phones-edit').val();
        let email = $('#email-edit').val();
        let token = $("meta[name='csrf-token']").attr("content");
        //ajax
        $.ajax({
          url: `/posts/${post_id}`,
          type: "PUT",
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
            let tendik = `
            <tr id="index_${response.data.id}">
                <td>${response.data.nama}</td>
                <td>${response.data.email}</td>
                <td>${response.data.no_hp}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-edit" data-toggle="tooltip"
                            data-placement="top" title="Edit"></a>
                    <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm"><i class="far fa-fw fa-trash" data-toggle="tooltip"
                            data-placement="top" title="Edit"></a>
                </td>
            </tr>
        `;
            //append to post data
            $(`#index_${response.data.id}`).replaceWith(post);
            //close modal
            $('#modal-edit').modal('hide');
          },
          error: function(error) {
            if (error.responseJSON.title[0]) {
              //show alert
              $('#alert-title-edit').removeClass('d-none');
              $('#alert-title-edit').addClass('d-block');
              //add message to alert
              $('#alert-title-edit').html(error.responseJSON.title[0]);
            }
            if (error.responseJSON.content[0]) {
              //show alert
              $('#alert-content-edit').removeClass('d-none');
              $('#alert-content-edit').addClass('d-block');
              //add message to alert
              $('#alert-content-edit').html(error.responseJSON.content[0]);
            }
          }
        });
      });
    });
  </script>
@stop
