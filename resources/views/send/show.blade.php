@extends('adminlte::page')

@section('meta_tags')
  <meta name="csrf_token" content="{{ csrf_token() }}">
@stop

@section('title', 'Anggota Group Kontak')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Anggota Group Kontak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('groupWa') }}">Group Kontak</a></li>
            <li class="breadcrumb-item active">Anggota</li>
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
          <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Group: {{ $sendWa->about }}</h5>
            Deskripsi : {!! $sendWa->messagge !!}
          </div>
          <div class="invoice p-3 mb-3">
            <hr>
            <div class="row invoice-info p-3 mt-3">
              <div class="col-md-12">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      {{-- <th>NIP</th> --}}
                      <th>Nomor Whatsapp</th>
                      <th>Jabatan</th>
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($recepient as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $list->kontak->nama }}</td>
                        <td>{{ $list->kontak->no_hp }}</td>
                        <td>{{ $list->jenis_text }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      {{-- <th>NIP</th> --}}
                      <th>Nomor Whatsapp</th>
                      <th>Jabatan</th>
                      {{-- <th>Action</th> --}}
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="row invoice-info p-3 mt-3">
                <a href="{{ url('sendWa') }}" class="btn btn-danger">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- </div> --}}
  </section>
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

      var group_id = $('#idGroup').val();

      $('.select2bs4').select2({
        theme: 'bootstrap4',
        minimumInputLength: 3,
        required: true,
        allowClear: true,
        width: 'resolve',
        autoClose: true,
      });

      function select2Dinamis(url) {
        var ajaxSettings = {
          url: url,
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              q: params.term
            };
          },
          processResults: function(data) {
            return {
              results: $.map(data, function(item) {
                return {
                  text: item.nama,
                  id: item.id
                }
              })
            };
          },
          cache: true
        };

        var select = {
          theme: 'bootstrap4',
          minimumInputLength: 3,
          required: true,
          allowClear: true,
          width: 'resolve',
          autoClose: true,
          ajax: ajaxSettings,
        };

        return select;
      }

      $('[data-toggle="collapse"]').click(function() {
        $('#dosen').val(null).trigger('change');
        $('#pegawai').val(null).trigger('change');
        $('#mahasiswa').val(null).trigger('change');
        $('#nonId').val(null).trigger('change');
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
              url: "/anggotaGroup/" + id,
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
