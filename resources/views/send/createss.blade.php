@extends('adminlte::page')

@section('title', 'Whatsapp')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Send Message</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('sendwa') }}">Message</a></li>
            <li class="breadcrumb-item active">Send</li>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Input Data Message</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal needs-validation" novalidate method="POST" action="{{ route('sendwa.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="perihal" class="col-sm-2 col-form-label">Perihal Pesan</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal"
                      placeholder="Perihal Pesan...." name="perihal" required value="{{ old('perihal') }}">
                    <div class="valid-feedback">
                      Perihal its Good
                    </div>
                    @error('perihal')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <div class="invalid-feedback">
                      Please choose a Perihal Pesan.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nim" class="col-sm-2 col-form-label">Scope Recepient</label>
                  <div class="col-sm-6">
                    <!-- checkbox -->
                    <span class="ml-2">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="dosen" value="0">
                        <label for="dosen">
                          Set Dosen
                        </label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="tendik" value="0">
                        <label for="tendik">
                          Set Tendik
                        </label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="mahasiswa" value="0">
                        <label for="mahasiswa">
                          Set Mahasiswa
                        </label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="group">
                        <label for="group">
                          Set Group
                        </label>
                      </div>
                    </span>
                    <span class="ml-5">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="noKontak">
                        <label for="noKontak">
                          Set Non Kontak
                        </label>
                      </div>
                    </span>
                  </div>
                </div>
                <div class="form-group row" id="dosenShow" style="display: none">
                  <label for="program studi" class="col-sm-2 col-form-label">Send To Dosen</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4" data-placeholder=" :: Pilih Dosen :: " multiple="multiple"
                      name="dosenPenerima[]" id="dosen" required>
                      @foreach ($kontaks->where('jenis', 1) as $list)
                        <option value="{{ $list->id }}">{{ $list->nama }} </option>
                      @endforeach
                    </select>
                    <div class="valid-feedback">
                      Nama Penerima its Good
                    </div>
                    <div class="invalid-feedback">
                      Please choose a Nama Penerima.
                    </div>
                  </div>
                </div>
                <div class="form-group row" id="tendikShow" style="display: none">
                  <label for="program studi" class="col-sm-2 col-form-label">Send To Tendik</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4" data-placeholder=" :: Pilih Tendik :: " multiple="multiple"
                      name="tendikPenerima[]" id="tendik">
                      @foreach ($kontaks->where('jenis', 2) as $list)
                        <option value="{{ $list->id }}">{{ $list->nama }} </option>
                      @endforeach
                    </select>
                    <div class="valid-feedback">
                      Nama Penerima its Good
                    </div>
                    <div class="invalid-feedback">
                      Please choose a Nama Penerima.
                    </div>
                  </div>
                </div>
                <div class="form-group row" id="mahasiswaShow" style="display: none">
                  <label for="program studi" class="col-sm-2 col-form-label">Send To Mahasiswa</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4" data-placeholder=" :: Pilih Mahasiswa :: "
                      multiple="multiple" name="mahasiswaPenerima[]" id="mahasiswa">
                      @foreach ($kontaks->where('jenis', 3) as $list)
                        <option value="{{ $list->id }}">{{ $list->nama }} </option>
                      @endforeach
                    </select>
                    <div class="valid-feedback">
                      Nama Penerima its Good
                    </div>
                    <div class="invalid-feedback">
                      Please choose a Nama Penerima.
                    </div>
                  </div>
                </div>
                <div class="form-group row" id="groupShow" style="display: none">
                  <label for="program studi" class="col-sm-2 col-form-label">Group Kontak</label>
                  <div class="col-sm-10 has-validation">
                    <select class="form-control select2bs4" data-placeholder=" :: Pilih Group Kontak :: "
                      multiple="multiple" name="groupPenerima[]" id="group">
                      @foreach ($kontaks as $list)
                        <option value="{{ $list->id }}">{{ $list->nama }} </option>
                      @endforeach
                    </select>
                    <div class="valid-feedback">
                      Group Kontak its Good
                    </div>
                    <div class="invalid-feedback">
                      Please choose a Group Kontak.
                    </div>
                  </div>
                </div>
                <div class="form-group row" id="noKontakShow" style="display: none">
                  <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
                  <div class="col-sm-10">
                    <table class="table table-bordered" id="dynamicAddRemove">
                      <tr>
                        <td>
                          <div class="col-sm-8 has-validation input-group">
                            {{-- <input type="text" name="no_hp[0][subject]" placeholder="Enter subject" --}}
                            <input type="text" name="no_hp[]" multiple placeholder="Enter Number"
                              class="form-control" id="no_kontak" />
                            <span class="input-group-append">
                              <button type="button" class="btn btn-info btn-flat" name="add" id="dynamic-ar">Add
                                Phone</button>
                            </span>
                            <div class="valid-feedback">
                              Nomor HP its Good
                            </div>
                            <div class="invalid-feedback">
                              Please choose a No HP.
                            </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pengirim" class="col-sm-2 col-form-label">Header</label>
                  <div class="col-sm-10 has-validation">
                    <textarea class="form-control" name="header" rows="2" placeholder="Enter text..." required></textarea>
                    <div class="valid-feedback">
                      Message its Good
                    </div>
                    <div class="invalid-feedback">
                      Please Write a Message.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pengirim" class="col-sm-2 col-form-label">Isi Pesan</label>
                  <div class="col-sm-10 has-validation">
                    <textarea class="form-control" name="message" rows="8" placeholder="Enter text..." required></textarea>
                    <div class="valid-feedback">
                      Message its Good
                    </div>
                    <div class="invalid-feedback">
                      Please Write a Message.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">
                    <span class="ml-2">
                      <div class="icheck-primary d-inline">
                        <label for="doc" class="mr-2">
                          Add Document
                        </label>
                        <input type="checkbox" id="doc" value="0">
                        {{-- <span class="input-group-append">
                          <button type="button" class="btn btn-info btn-flat" name="add"
                            id="addLink">Add</button>
                        </span> --}}
                        {{-- <input type="checkbox" id="doc" value="0"> --}}
                      </div>
                    </span>
                  </div>
                  <div class="col-sm-10 has-validation" id="docShow" style="display: none">
                    <label for="dokumen" class="col-form-label">Link Dokument</label>
                    <input type="text" class="form-control @error('dokumen') is-invalid @enderror" id="doc"
                      placeholder="Link Dokumen...." name="dokumen" value="{{ old('dokumen') }}">
                    <div class="valid-feedback">
                      Perihal its Good
                    </div>
                    @error('dokumen')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <div class="invalid-feedback">
                      Please choose a link document.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                  <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control" id="kodeProdi" placeholder="Email Student"
                      name="email" required readonly value="{{ Auth::user()->name }}">
                    <div class="valid-feedback">
                      Email its Good
                    </div>
                    <div class="invalid-feedback">
                      Please choose a Email
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info" id="checkBtn">Submit</button>
            <button type="reset" onclick="location.href='{{ url('sendwa') }}'"
              class="btn btn-default float-right">Cancel</button>
          </div>
          <!-- /.card-footer -->
          </form>
        </div>

      </div>
    </div>
    <!-- /.card -->
  </section>
@stop
@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4',
        minimumInputLength: 3,
        required: true,
        allowClear: true,
        width: 'resolve',
        // maximumSelectionLength: 2,
        autoclose: true,
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#checkBtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;

        if (!checked) {
          swal.fire({
            icon: 'warning',
            title: 'You must check at least one checkbox.',
            // showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Ok, i check it!'
          })
          //   alert("You must check at least one checkbox.");
          //   return false;
        }

      });
    });
  </script>
  <script type="text/javascript">
    $('#dosen').change(function() {
      $('#dosenShow').toggle();
      if ($('select[id="dosen"]').attr('required')) {
        $('select[id="dosen"]').removeAttr('required');
      } else {
        $('select[id="dosen"]').attr('required', 'required');
      }
    });
    $('#tendik').change(function() {
      $('#tendikShow').toggle();
      if ($('select[id="tendik"]').attr('required')) {
        $('select[id="tendik"]').removeAttr('required');
      } else {
        $('select[id="tendik"]').attr('required', 'required');
      }
    });
    $('#mahasiswa').change(function() {
      $('#mahasiswaShow').toggle();
      if ($('select[id="mahasiswa"]').attr('required')) {
        $('select[id="mahasiswa"]').removeAttr('required');
      } else {
        $('select[id="mahasiswa"]').attr('required', 'required');
      }
    });
    $('#group').change(function() {
      $('#groupShow').toggle();
      if ($('select[id="group"]').attr('required')) {
        $('select[id="group"]').removeAttr('required');
      } else {
        $('select[id="group"]').attr('required', 'required');
      }
    });
    $('#noKontak').change(function() {
      $('#noKontakShow').toggle();
      if ($('input[id="no_kontak"]').attr('required')) {
        $('input[id="no_kontak"]').removeAttr('required');
      } else {
        $('input[id="no_kontak"]').attr('required', 'required');
      }
    });
    $('#doc').change(function() {
      $('#docShow').toggle();
      if ($('input[id="doc"]').attr('required')) {
        $('input[id="doc"]').removeAttr('required');
      } else {
        $('input[id="doc"]').attr('required', 'required');
      }
    });
    // $('#addLink').click(function() {
    //   $('#docShow').toggle();
    //   if ($('input[id="doc"]').attr('required')) {
    //     $('input[id="doc"]').removeAttr('required');
    //   } else {
    //     $('input[id="doc"]').attr('required', 'required');
    //   }
    // });
  </script>
  <script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
      ++i;
      $("#dynamicAddRemove").append(
        '<tr><td><div class="col-sm-8 has-validation input-group"><input type="text" name="no_hp[]' +
        '" multiple placeholder="Enter subject" class="form-control" required /><span class="input-group-append">' +
        '<button type="button" class="btn btn-danger btn-flat remove-input-field" > Remove </button> </span>' +
        '<div class="valid-feedback">Nomor HP its Good</div > <div div class = "invalid-feedback" > Please choose a No HP.</div></td></tr>'
        // '</div></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></div></td></tr>'
      );
      //   $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
      //     '][subject]" placeholder="Enter subject" class="form-control" required /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
      //   );
    });
    $(document).on('click', '.remove-input-field', function() {
      $(this).parents('tr').remove();
    });
  </script>
@stop
@section('footer')
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>FISHIPOL &copy; 2023 <a href="https://fishippol.uny.ac.id">fishipol.uny.ac.id</a>.</strong> All rights
  reserved.
@stop
