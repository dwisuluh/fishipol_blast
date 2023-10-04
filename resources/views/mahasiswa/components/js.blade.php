<script>
  $(document).ready(function() {

    bsCustomFileInput.init();

    var table = $('#table-data').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ajax": "{{ route('mahasiswa.index') }}",
      "columns": [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'nim',
          name: 'nim',
        },
        {
          data: 'nama',
          name: 'nama',
        },
        {
          data: 'prodi.nama',
          name: 'prodi.nama',
        },
        {
          data: 'prodi.jenjang',
          name: 'prodi.jenjang',
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
      ]
    });

   $('#detailShow').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang membuka modal
        var id = button.data('id'); // Mengambil ID dari atribut data-id

        // Ajax request untuk mengambil data dari server
        $.ajax({
            url: '/mahasiswa/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                // Memasukkan data ke dalam modal
                $('.modal-body').html(response.html);
            }
        });
    });

    //delete mahasiswa
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

            url: `/mahasiswa/${id}`,
            type: "DELETE",
            cache: false,
            data: {
              "_token": token
            },
            success: function(response) {
              //show success message
              table.draw();
              Swal.fire({
                icon: 'success',
                title: 'Success..!!',
                text: response,
                showDenyButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1500
              });
            }
          });
        }
      })
    });
  })
</script>
