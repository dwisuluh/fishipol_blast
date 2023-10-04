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
            <h5><i class="fas fa-info"></i> Group: {{ $groupWa->name }}</h5>
            Deskripsi : {{ $groupWa->scope }}
          </div>
          <div class="invoice p-3 mb-3">
            <div class="col-12" id="accordion">
              <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <i class="fas fa-plus"> Tambah Anggota Group </i>
                    </h4>
                  </div>
                </a>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <form class="form-horizontal needs-validation" id="dataForm">
                      @csrf
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-labinputNon">Dosen</label>
                        <div class="col-sm-10 has-validation">
                          <select class="form-control select2Dosen" data-placeholder=":: Pilih Penerima Dosen .... ::"
                            name="dosen[]" id="dosen"required multiple></select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="inputPegawai">Pegawai</label>
                        <div class="col-sm-10 has-validation">
                          <select class="form-control select2Pegawai" data-placeholder=":: Pilih Pegawai .... ::"
                            name="pegawai[]" id="pegawai" required multiple>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="inputMahasiswa">Mahasiswa</label>
                        <div class="col-sm-10 has-validation">
                          <select class="form-control select2Mahasiswa" data-placeholder=":: Pilih Mahasiswa .... ::"
                            name="mahasiswa[]" id="mahasiswa" required multiple>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="inputNon">Non Role</label>
                        <div class="col-sm-10 has-validation">
                          <select class="form-control select2Non" data-placeholder=":: Pilih Penerima Non Id .... ::"
                            name="nonId[]" id="nonId" required multiple>
                          </select>
                        </div>
                      </div>
                      <input type="hidden" value="{{ $groupWa->id }}" name="idGroup" id="idGroup">
                      <div class="form-group row">
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-info" id="store">Submit</button>
                        </div>
                        <div class="col-sm-6">
                          <button onclick="location.href=''" class="btn btn-danger float-right"
                            type="reset">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      {{-- <th>NIP</th> --}}
                      <th>Nomor Whatsapp</th>
                      <th>Jabatan</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="row invoice-info p-3 mt-3">
                <a href="{{ url('groupWa') }}" class="btn btn-danger">Back</a>
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
      var group = "{{ route('get-pegawai', $groupWa->id) }}";
      var pegawai = $('.select2Pegawai').select2(select2Dinamis("{{ route('get-pegawai', $groupWa->id) }}"));
      var dosen = $('.select2Dosen').select2(select2Dinamis("{{ route('get-dosen', $groupWa->id) }}"));
      var mahasiswa = $('.select2Mahasiswa').select2(select2Dinamis("{{ route('get-mahasiswa', $groupWa->id) }}"));
      var mahasiswa = $('.select2Non').select2(select2Dinamis("{{ route('get-non', $groupWa->id) }}"));

      var table = $('#example2').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        responsive: true,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('anggota.getData', $groupWa->id) }}",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center',
          },
          {
            data: 'nama',
            name: 'nama',
          },
          //   {
          //     data: 'nip',
          //     name: 'nip',
          //   },
          {
            data: 'no_hp',
            name: 'no_hp',
          },
          {
            data: 'jenis_text',
            name: 'jenis_text',
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
      $('[data-toggle="collapse"]').click(function() {
        $('#dosen').val(null).trigger('change');
        $('#pegawai').val(null).trigger('change');
        $('#mahasiswa').val(null).trigger('change');
        $('#nonId').val(null).trigger('change');
      });

      $('#store').click(function(e) {

        e.preventDefault();

        var formData = $('#dataForm').serialize();

        $.ajax({
          type: 'POST',
          url: "{{ route('anggotaGroup.store') }}",
          data: formData + '&_token={{ csrf_token() }}',
          success: function(data) {

            // $("#collapseOne").collapse("hide");
            $('#dosen').val(null).trigger('change');
            $('#pegawai').val(null).trigger('change');
            $('#mahasiswa').val(null).trigger('change');
            $('#nonId').val(null).trigger('change');

            event.preventDefault();

            table.ajax.reload();
            Toast.fire({
              icon: 'success',
              title: 'Success...',
              text: `${data.message}`,
            });
          }
        });
      });

      //   $('body').on('click', '.editData', function() {

      //     let id = $(this).data('id');
      //     //   console.log(id);

      //     $.get('/dosen/' + id + '/edit', function(response) {
      //       // console.log(response);
      //       //fill data to form
      //       $('#id-dosen').val(response.id);
      //       $('#edit-name').val(response.name);
      //       $('#edit-nip').val(response.nip);
      //       $('#edit-nidn').val(response.nidn);
      //       $('#edit-no_hp').val(response.no_hp);
      //       $('#edit-email').val(response.email);

      //     });
      //   });

      // Mendapatkan tombol close modal
      //   let closeButton = document.querySelector('.close');

      // Menambahkan event listener untuk menangani klik pada tombol close
      //   closeButton.addEventListener('click', function() {
      //     // Menghapus kelas is-invalid pada semua input dan menghapus pesan error pada semua input
      //     let inputElements = document.querySelectorAll('.form-control');
      //     let errorElements = document.querySelectorAll('.invalid-feedback');
      //     for (let i = 0; i < inputElements.length; i++) {
      //       inputElements[i].classList.remove('is-invalid');
      //     }
      //     for (let i = 0; i < errorElements.length; i++) {
      //       errorElements[i].innerHTML = '';
      //     }
      //   });
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
