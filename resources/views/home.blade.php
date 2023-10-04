@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  <h1>Dashboard</h1>
@stop
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="justify-content-center">
        <div class="col-12">
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="mahasiswa">{{ $mahasiswa }}</h3>

                  <p>Mahasiswa</p>
                </div>
                <div class="icon">
                  <i class="fas fa-graduation-cap"></i>
                </div>
                <a href="{{ route('mahasiswa-sync') }}" id="sync" class="small-box-footer">Details <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="dosen">{{ $dosen }}</h3>

                  <p>Dosen</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-tie"></i>
                </div>
                <a href="{{ route('dosen-sync') }}" class="small-box-footer">Details <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="pegawai">{{ $pegawai }}</h3>

                  <p>Pegawai</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users-cog"></i>
                </div>
                <a href="{{ route('tendik-sync') }}" class="small-box-footer">Details <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total">{{ $total }}</h3>

                  <p>Jumlah</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

        </div>
      </div>
    </div>
  </section>
@stop

@section('footer')
  @include('components.footer')
@stop
@section('js')
  <script>
    console.log('Hi!');
  </script>
@stop
