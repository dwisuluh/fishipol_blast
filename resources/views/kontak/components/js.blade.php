<script>
  $(document).ready(function() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
      $.fn.dataTable.tables({
        visible: true,
        api: true
      }).columns.adjust();
    });

    bsCustomFileInput.init();

    // $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
    //   $.fn.dataTable.tables({
    //     visible: true,
    //     api: true
    //   }).columns.adjust();
    // });

    var tableDosen = $('#table-dosen').DataTable({
      paging: true,
      // pagingType: 'full_numbers',
      //   lengthMenu: [
      //     [10, 25, 50, -1],
      //     [10, 25, 50, "All"]
      //   ],
      autoWidth: true,
      //   scrollY: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('getDosen') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
          //   width:'5%',
        },
        {
          data: 'nama',
          name: 'nama',
          //   width:'45%',
        },
        {
          data: 'no_hp',
          name: 'no_hp',
          //   width:'25%',
        },
        {
          data: 'jenis_text',
          name: 'jenis_text',
          //   width:'10%',
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          className: 'text-center',
          //   width:'15%',
        },
      ],
      //   scrollY: 200,
      scrollCollapse: true,
    });
    var tablePegawai = $('#table-pegawai').DataTable({
      paging: true,
      autoWidth: true,
      scrollY: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('getPegawai') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
          //   width:'5%',
        },
        {
          data: 'nama',
          name: 'nama',
          //   width:'45%',
        },
        {
          data: 'no_hp',
          name: 'no_hp',
          //   width:'25%',
        },
        {
          data: 'jenis_text',
          name: 'jenis_text',
          //   width:'10%',
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          className: 'text-center',
          //   width:'15%',
        },
      ],
      // scrollY: 200,
      scrollCollapse: true,
    });

    var tableMahasiswa = $('#table-mahasiswa').DataTable({
      paging: true,
      responsive: true,
      autoWidth: true,
      scrollY: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('getMahasiswa') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'mahasiswa.nim',
          name: 'mahasiswa.nim'
        },
        {
          data: 'nama',
          name: 'nama',
        },
        {
          data: 'mahasiswa.prodi.nama',
          name: 'mahasiswa.prodi.nama',
        },
        {
          data: 'no_hp',
          name: 'no_hp',
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          className: 'text-center',
        },
      ],
    });

    var tableNon = $('#table-non').DataTable({
      paging: true,
      responsive: true,
      autoWidth: true,
      scrollY: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('getNonKontak') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'nama',
          name: 'nama',
        },
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
      ],
    });

    $(document).on('click', '.moveAlumni', function() {
      var contactId = $(this).data('contact-id');
      moveAlumni(contactId);
    });

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    function moveAlumni(contactId) {

      $.ajax({
        url: 'kontak/'+contactId+'/update-alumni',
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {

          tableMahasiswa.ajax.reload();
          tableNon.ajax.reload();

          Toast.fire({
            icon: 'success',
            text: `${response.message}`,
            title: 'Success...',
          });
        },
        error: function() {
          alert('An error occurred. Please try again.');
        }

      });
    }

  });

</script>
