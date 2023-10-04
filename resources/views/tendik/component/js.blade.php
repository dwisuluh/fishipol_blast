<script>
  $(function() {

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    bsCustomFileInput.init();

    var table = $('#data-table').DataTable({
      paging: true,
      //   lengthChange: true,
      searching: true,
      ordering: true,
      responsive: true,
      info: true,
      autoWidth: true,
      responsive: true,
      dom: 'Bfrtip',
      lengthMenu: [
        [10, 25, 50, -1],
        ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
      ],
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis', 'pageLength'],
      processing: true,
      serverSide: true,
      ajax: "{{ route('tendik.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'nip',
          name: 'nip'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'no_hp',
          name: 'no_hp'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          className: 'text-center',
        },
      ],
      // }).buttons().container().appendTo('#data-table .col-md-6:eq(0)');
    });

    //modal add
    $('body').on('click', '#btn-create', function() {
      $('#add-data').modal('show');
    });

    //reset modal add
    $('#add-data').on('hidden.bs.modal', function() {
      $(this).find('form').trigger('reset');
      $('#nama,#nip,#phones,#email').removeClass('is-invalid');
    });
    //store data
    $('#store').click(function(e) {
      e.preventDefault();

      let nama = $('#nama').val();
      let nip = $('#nip').val();
      let phones = $('#phones').val();
      let email = $('#email').val();
      let token = $("meta[name='csrf-token']").attr("content");

      $.ajax({
        url: `/tendik`,
        type: "POST",
        cache: false,
        data: {
          "nama": nama,
          "nip": nip,
          "phones": phones,
          "email": email,
          "_token": token
        },
        success: function(response) {

          $('#dataForm').trigger("reset");
          $('#add-data').modal('hide');
          //   $('#store').html('Save Changes');

          //   table.draw();
          table.ajax.reload();

          Toast.fire({
            icon: 'success',
            text: `${response.message}`,
            title: 'Success...',
          });
        },
        error: function(error) {
          if (error.responseJSON.nama) {
            // show alert
            $('#nama').addClass('is-invalid');
            //add message to alert
            $('#alert-nama').html(error.responseJSON.nama);
          }
          if (error.responseJSON.nip) {
            // show alert
            $('#nip').addClass('is-invalid');

            //add message to alert
            $('#alert-nip').html(error.responseJSON.nip);
          }
          if (error.responseJSON.phones) {
            //show alert
            $('#phones').addClass('is-invalid');
            //add message to alert
            $('#alert-phones').html(error.responseJSON.phones);
          }
          if (error.responseJSON.email) {
            //show alert
            $('#email').addClass('is-invalid');
            //add message to alert
            $('#alert-email').html(error.responseJSON.email);
          }
        }
      });
    });

    // delete function
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

            url: `/tendik/${id}`,
            type: "DELETE",
            cache: false,
            data: {
              "_token": token
            },
            success: function(response) {
              //show success message
              table.draw();
              Toast.fire({
                icon: 'success',
                title: 'Success...',
                text: `${response.message}`,
              });
            },
            error: function(error) {
              Swal.fire('Error', error.responseJSON.error, 'error');
            }
          });
        }
      })
    });

    //edit
    $('body').on('click', '.editData', function() {

      let id = $(this).data('id');
      //fetch detail post with ajax
      $.ajax({
        url: `/tendik/${id}`,
        type: "GET",
        cache: false,
        success: function(response) {
          //fill data to form
          $('#id-edit').val(response.data.id);
          $('#nama-edit').val(response.data.name);
          $('#nip-edit').val(response.data.nip);
          $('#phones-edit').val(response.data.no_hp);
          $('#email-edit').val(response.data.email);
          //open modal
          $('#edit-data').modal('show');
        }
      })
    });

    //update
    $('#update').click(function(e) {
      e.preventDefault();

      let id = $('#id-edit').val();
      let nama = $('#nama-edit').val();
      let nip = $('#nip-edit').val();
      let phones = $('#phones-edit').val();
      let email = $('#email-edit').val();
      let token = $("meta[name='csrf-token']").attr("content");

      $.ajax({
        url: `/tendik/${id}`,
        type: "PUT",
        cache: false,
        data: {
          //   "id": id,
          "nama": nama,
          "nip": nip,
          "phones": phones,
          "email": email,
          "_token": token
        },
        success: function(response) {

          $('#dataFormEdit').trigger("reset");
          $('#edit-data').modal('hide');
          //   $('#store').html('Save Changes');

          //   table.draw();
          table.ajax.reload();

          Toast.fire({
            icon: 'success',
            title: `${response.message}`,
          });
        },
        error: function(error) {
          if (error.responseJSON.nama) {
            // show alert
            $('#nama-edit').addClass('is-invalid');
            //add message to alert
            $('#alert-nama-edit').html(error.responseJSON.nama);
          }
          if (error.responseJSON.nip) {
            // show alert
            $('#nip-edit').addClass('is-invalid');

            //add message to alert
            $('#alert-nip-edit').html(error.responseJSON.nip);
          }
          if (error.responseJSON.phones) {
            //show alert
            $('#phones-edit').addClass('is-invalid');
            //add message to alert
            $('#alert-phones-edit').html(error.responseJSON.phones);
          }
          if (error.responseJSON.email) {
            //show alert
            $('#email-edit').addClass('is-invalid');
            //add message to alert
            $('#alert-email-edit').html(error.responseJSON.email);
          }
        }
      })
    });

  });
</script>
