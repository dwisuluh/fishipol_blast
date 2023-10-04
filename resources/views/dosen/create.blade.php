@extends('adminlte::page')

@section('title', 'Add Data Dosen')

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
            <li class="breadcrumb-item"><a href="{{ url('dosen') }}">Data Dosen</a></li>
            <li class="breadcrumb-item active">Add Data</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@stop

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Input Data Dosen</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal needs-validation" novalidate method="POST" action="{{ route('dosen.store') }}">
              @csrf
              <div class="card-body">
                <div class="control-group after-add-more" id="input-fields">
                  @php $fieldCount = count(old('name',[''])); @endphp
                  {{-- @foreach (old('name', ['']) as $key => $value) --}}
                  @for ($i = 0; $i < $fieldCount; $i++)
                    {{-- @endfor --}}
                    <div class="form-group row">
                      <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                      <div class="col-sm-10 has-validation">
                        <input type="text" class="form-control @error('nama.' . $i) is-invalid @enderror"
                          placeholder="Nama Lengkap" name="nama[]" id="nama" value="{{ old('nama.' . $i) }}"
                          required autofocus />
                        {{-- <div class="valid-feedback">
                          Lecture its Good
                        </div> --}}
                        @error('nama.' . $i)
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        {{-- <div class="invalid-feedback">
                          Please choose a Nama Lengkap.
                        </div> --}}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="NIP" class="col-sm-2 col-form-label">NIP</label>
                      <div class="col-sm-10 has-validation">
                        <input type="text" class="form-control @error('nip.' . $i) is-invalid @enderror" id="NIP"
                          placeholder="Nomor Induk Pegawai" name="nip[]" value="{{ old('nip.' . $i) }}" required />
                        {{-- <div class="valid-feedback">
                          NIP its Good
                        </div> --}}
                        @error('nip.' . $i)
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        {{-- <div class="invalid-feedback">
                          Please choose a NIP.
                        </div> --}}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
                      <div class="col-sm-10 has-validation">
                        <input type="text" class="form-control @error('no_hp.' . $i) is-invalid @enderror"
                          id="NomorHp" placeholder="Nomor HP" name="no_hp[]" value="{{ old('no_hp.' . $i) }}"
                          required />
                        {{-- <div class="valid-feedback">
                          Nomor HP its Good
                        </div> --}}
                        @error('no_hp.' . $i)
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        {{-- <div class="invalid-feedback">
                          Please choose a No HP.
                        </div> --}}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10 has-validation">
                        <input type="email" class="form-control @error('email[]') is-invalid @enderror" id="email"
                          placeholder="Email" name="email[]" value="{{ old('email.' . $i) }}" required />
                        {{-- <div class="valid-feedback">
                          Email its Good
                        </div> --}}
                        @error('email[]')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        {{-- <div class="invalid-feedback">
                          Please choose a Email
                        </div> --}}
                      </div>
                    </div>
                  @endfor
                  <button class="btn btn-success add-more" type="button">
                    <i class="fa fa-user-plus"></i> Add
                  </button>
                  <hr>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <button onclick="location.href='{{ url('dosen') }}'" class="btn btn-default float-right">Cancel</button>
          </div>
          <!-- /.card-footer -->
          </form>
        </div>

      </div>
    </div>
    <!-- /.card -->
  </section>
  <div class="copy d-none">
    @include('dosen.component.copy-add')
  </div>
@stop
@section('footer')
  @include('components.footer')
@stop
{{-- @section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
  <script>
    $(document).ready(function() {
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          @if (Str::startsWith($error, 'The name.'))
            $('.control-group:not(:first)').removeClass('d-none').addClass('d-block');
          @endif
          @if (Str::startsWith($error, 'The email.'))
            $('.control-group:not(:first)').removeClass('d-none').addClass('d-block');
          @endif
        @endforeach
      @endif

      var inputFields = $('#input-fields');
      var fieldCount = inputFields.children().length;

      $(".add-more").click(function() {

        var newField = $(".copy").html();
        // var html = $(".copy").html();
        // $(".after-add-more").after(html);
        //         var newField = `<div class="control-group">
      //     <div class="form-group row">
      //       <label for="namaDosen" class="col-sm-2 col-form-label">Nama Lengkap</label>
      //       <div class="col-sm-10 has-validation">
      //         <input type="text" class="form-control @error('nama.' . $fieldCount) is-invalid @enderror"
      //           placeholder="Nama Lengkap" name="nama[]" required value="{{ old('nama.' . $fieldCount) }}"
      //           id="namaDosen">
      //         <div class="valid-feedback">
      //           Lecture its Good
      //         </div>
      //         @error('nama.' . $fieldCount)
      //           <span class="invalid-feedback" role="alert">
      //             <strong>{{ $message }}</strong>
      //           </span>
      //         @enderror
      //         <div class="invalid-feedback">
      //           Please choose a Nama Lengkap.
      //         </div>
      //       </div>
      //     </div>
      //     <div class="form-group row">
      //       <label for="NomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
      //       <div class="col-sm-10 has-validation">
      //         <input type="text"
      //           class="form-control @error('no_hp.' . $fieldCount) is-invalid
//           @enderror" id="NomorHp" value="{{ old('no_hp.' . $fieldCount) }}"
      //           placeholder="Nomor HP" name="no_hp[]" required>
      //         <div class="valid-feedback">
      //           Nomor HP its Good
      //         </div>
      //         @error('no_hp.' . $fieldCount)
      //           <span class="invalid-feedback" role="alert">
      //             <strong>{{ $message }}</strong>
      //           </span>
      //         @enderror
      //       </div>
      //     </div>
      //     <div class="form-group row">
      //       <label for="Email" class="col-sm-2 col-form-label">Email</label>
      //       <div class="col-sm-10 has-validation">
      //         <input type="email" class="form-control" id="Email" placeholder="Email" name="email[]"
      //           value="{{ old('email.' . $fieldCount) }}" required>
      //         <div class="valid-feedback">
      //           Email its Good
      //         </div>
      //         <div class="invalid-feedback">
      //           Please choose a Email
      //         </div>
      //       </div>
      //     </div>
      //     <button class="btn btn-danger remove" type="button">
      //       <i class="fa fa-fw fa-user-minus"></i> Add
      //     </button>
      //     <hr>
      //   </div>`;
        inputFields.append(newField);
        fieldCount++;
      });
      $("body").on("click", ".remove", function() {
        $(this).closest(".control-group").remove();
        fieldCount--;
      });
    });
  </script>
@stop
