@extends('adminlte::page')

@section('title', 'Kirim Whatsapp')

@section('content_header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kirim Whatsapp</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Send WA</li>
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
          @if ($phone['status'] == 'online')
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-check"></i> {{ $phone['status'] }} </h5>
              Success alert preview. This alert is dismissable.
            </div>
          @else
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> {{ $phone['status'] }}! </h5>
              Danger alert preview. This alert is dismissable.
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pengiriman Pesan</h3>
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Send Message" theme="primary"
                icon="fas fa-fw fa-paper-plane" onclick="location.href='{{ route('sendWa.create') }}'" />
              <x-adminlte-button class="btn-sm text-end float-sm-right mr-2" label=" Import" theme="info"
                icon="fas fa-upload" onclick="location.href='#'" />
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Judul Pesan</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Jumlah Penerima</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sendwa as $list)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $list->about }}</td>
                      <td>{{ $list->created_at }}</td>
                      <td class="text-center">
                        {{ $list->recipient_count }}
                      </td>
                      <td class="text-center">
                        <a href="{{ route('sendWa.show', $list->id) }}" class="btn btn-sm btn-success mx-1 shadow"
                          title="Details">
                          <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Judul Pesan</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Jumah Penerima</th>
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
@stop

@section('footer')
  @include('components.footer')
@stop
@section('js')
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        responsive: true,
      });
    });
  </script>
@stop
