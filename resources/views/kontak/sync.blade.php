@extends('adminlte::page')

@section('title', 'Kontak Synchron')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Synchronize</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="kontak">Kontak</a></li>
            <li class="breadcrumb-item active">Synchronize</a></li>
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
        <div class="col-md-12 card">
          <div class="card-header">
            <h3 class="card-title">Contact Not Synchronize</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3 id="mahasiswa"></h3>

                    <p>Mahasiswa</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-plus"></i>
                  </div>
                  <a href="{{ route('mahasiswa-sync') }}" id="sync" class="small-box-footer">Synchonize <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3 id="dosen"></h3>

                    <p>Dosen</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="{{ route('dosen-sync') }}" class="small-box-footer">Synchronize <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3 id="pegawai"></h3>

                    <p>Pegawai</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="{{ route('tendik-sync') }}" class="small-box-footer">Synchronize <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3 id="total"></h3>

                    <p>Jumlah Belum Synchron</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="#" class="small-box-footer">Synchronize <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop

@section('js')
  <script>
    function syncData() {
      $.ajax({
        url: "{{ route('gets.counts') }}",
        dataType: 'json',
        success: function(data) {
          $('#mahasiswa').text(data.mahasiswa);
          $('#dosen').text(data.dosen);
          $('#pegawai').text(data.pegawai);
          $('#total').text(data.total);
        },
        // complete: function() {
        //   setTimeout(syncData, 5000);
        // }
      });
    }

    syncData();
  </script>
@stop
@section('footer')
  @include('components.footer')
@stop
