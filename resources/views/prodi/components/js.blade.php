<script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  $(document).ready(function() {

    bsCustomFileInput.init();

    var table = $("#example1").DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: true,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('.delete-form').on('submit', function(e) {
      e.preventDefault();
      var button = $(this);

      Swal.fire({
        icon: 'warning',
        text: "You won't be able to revert this!",
        title: 'Are you sure you want to delete this record?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'post',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: button.data('route'),
            data: {
              '_method': 'delete',
            },
            success: function(response, textStatus, xhr) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted..!',
                text: response,
                showDenyButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                location.reload();
              });
            }
          });
        }
      });
    });

    $('#detailShow').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang membuka modal
        var id = button.data('id'); // Mengambil ID dari atribut data-id

        // Ajax request untuk mengambil data dari server
        $.ajax({
            url: '/prodi/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                // Memasukkan data ke dalam modal
                $('.modal-body').html(response.html);
            }
        });
    });

  });
</script>

@if (session()->has('success'))
  <script>
    Toast.fire({
      icon: 'success',
      title: 'Success...',
      text: "{{ session('success') }}",
    });
  </script>
@endif
