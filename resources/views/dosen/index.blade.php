@extends('adminlte::page')

@section('title', 'Data Dosen')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dosen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Data Dosen</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@stop
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ __('Daftar Dosen') }}</h3>
              {{-- <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='{{ route('dosen.create') }}'" /> --}}
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Add Data" theme="primary"
                icon="fas fa-plus" onclick="location.href='javascript:void(0)'" id="btn-create" data-target="#add-data"
                data-toggle="modal" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" data-toggle="modal" data-target="#importExcel" data-backdrop="static"
                data-keyboard="false" />
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Nomor Whatsapp</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Nomor Whatsapp</th>
                    <th>Email</th>
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
  @include('dosen.component.import')
  @include('dosen.component.editModal')
  @include('dosen.component.add')
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

      bsCustomFileInput.init();

      var table = $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('dosen.index') }}",
        "columns": [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center',
          },
          {
            data: 'name',
            name: 'name',
          },
          {
            data: 'nip',
            name: 'nip',
          },
          {
            data: 'no_hp',
            name: 'no_hp',
          },
          {
            data: 'email',
            name: 'email',
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

      $('body').on('click', '.editData', function() {

        let id = $(this).data('id');
        //   console.log(id);

        $.get('/dosen/' + id + '/edit', function(response) {
          // console.log(response);
          //fill data to form
          $('#id-dosen').val(response.id);
          $('#edit-name').val(response.name);
          $('#edit-nip').val(response.nip);
          $('#edit-nidn').val(response.nidn);
          $('#edit-no_hp').val(response.no_hp);
          $('#edit-email').val(response.email);

        });
      });

      $('#update').click(function(e) {
        e.preventDefault();

        let id = $('#id-dosen').val();
        let name = $('#edit-name').val();
        let nip = $('#edit-nip').val();
        let nidn = $('#edit-nidn').val();
        let no_hp = $('#edit-no_hp').val();
        let email = $('#edit-email').val();
        let inputElements = document.querySelectorAll('.form-control');
        let errorElements = document.querySelectorAll('.invalid-feedback');
        // console.log(id, nama, nip, nidn, no_hp, email);
        $.ajax({
          url: '/dosen/' + id,
          // url: `/dosen/${id}`,
          type: 'PUT',
          //   cache: false,
          data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'name': name,
            'nip': nip,
            'nidn': nidn,
            'no_hp': no_hp,
            'email': email
          },
          success: function(response) {
            //   console.log(response);
            $('#edit-dosen').trigger('reset');
            $('#edit-dosen').modal('hide');
            // Mendapatkan semua elemen input dan pesan error

            // Menghapus kelas is-invalid pada semua input
            for (let i = 0; i < inputElements.length; i++) {
              inputElements[i].classList.remove('is-invalid');
            }

            // Menghapus pesan error pada semua input
            for (let i = 0; i < errorElements.length; i++) {
              errorElements[i].innerHTML = '';
            }
            //   $('#data-dosen').DataTable().ajax.reload();
            table.ajax.reload();
            // table.draw();
            Toast.fire({
                  icon: 'success',
                  title: 'Success...',
                  text: `${response.message}`,
                });
          },
          error: function(error) {
            console.log(error);
            if (error.responseJSON.name) {
              $('#edit-name').addClass('is-invalid');
              $('#alert-edit-name').html(error.responseJSON.name);
            }
            if (error.responseJSON.nip) {
              $('#edit-nip').addClass('is-invalid');
              $('#alert-edit-nip').html(error.responseJSON.nip);
            }
            if (error.responseJSON.nidn) {
              $('#edit-nidn').addClass('is-invalid');
              $('#alert-edit-nidn').html(error.responseJSON.nidn);
            }
            if (error.responseJSON.no_hp) {
              $('#edit-no_hp').addClass('is-invalid');
              $('#alert-edit-no_hp').html(error.responseJSON.no_hp);
            }
            if (error.responseJSON.email) {
              $('#edit-email').addClass('is-invalid');
              $('#alert-edit-email').html(error.responseJSON.email);
            }
          }
        })
      });

      //delete data Dosen
      $('body').on('click', ".deleteData", function() {
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

              url: `/dosen/${id}`,
              type: "DELETE",
              cache: false,
              data: {
                "_token": token
              },
              success: function(response) {
                //show success message
                table.draw();
                Toast.fire({
                  icon: 'success',
                  title: 'Success...',
                  text: `${response.message}`,
                });
              }
            });
          }
        })
      });
      // Mendapatkan tombol close modal
      let closeButton = document.querySelector('.close');

      // Menambahkan event listener untuk menangani klik pada tombol close
      closeButton.addEventListener('click', function() {
        // Menghapus kelas is-invalid pada semua input dan menghapus pesan error pada semua input
        let inputElements = document.querySelectorAll('.form-control');
        let errorElements = document.querySelectorAll('.invalid-feedback');
        for (let i = 0; i < inputElements.length; i++) {
          inputElements[i].classList.remove('is-invalid');
        }
        for (let i = 0; i < errorElements.length; i++) {
          errorElements[i].innerHTML = '';
        }
      });

      $('#add-data').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
        $('#nama,#nip,#phones,#email,#nidn').removeClass('is-invalid');
      });

      $('#store').click(function(e) {
        e.preventDefault();

        let nama = $('#nama').val();
        let nip = $('#nip').val();
        let nidn = $('#nidn').val();
        let phones = $('#phones').val();
        let email = $('#email').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
          url: `/dosen`,
          type: "POST",
          cache: false,
          data: {
            "nama": nama,
            "nip": nip,
            "nidn": nidn,
            "phones": phones,
            "email": email,
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
            if (error.responseJSON.nama) {
              // show alert
              $('#nama').addClass('is-invalid');
              //add message to alert
              $('#alert-nama').html(error.responseJSON.nama);
            }
            if (error.responseJSON.nip) {
              // show alert
              $('#nip').addClass('is-invalid');

              //add message to alert
              $('#alert-nip').html(error.responseJSON.nip);
            }
            if (error.responseJSON.nidn) {
              // show alert
              $('#nidn').addClass('is-invalid');

              //add message to alert
              $('#alert-nidn').html(error.responseJSON.nidn);
            }

            if (error.responseJSON.phones) {
              //show alert
              $('#phones').addClass('is-invalid');
              //add message to alert
              $('#alert-phones').html(error.responseJSON.phones);
            }
            if (error.responseJSON.email) {
              //show alert
              $('#email').addClass('is-invalid');
              //add message to alert
              $('#alert-email').html(error.responseJSON.email);
            }
          }
        });
      });
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
