<script>
  $(document).ready(function() {
    $('#checkBtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;
      if (!checked) {
        swal.fire({
          icon: 'warning',
          title: 'You must check at least one checkbox.',
          confirmButtonText: 'Ok, i Check it!'
        });
      }
    });
    $('#myMessage').submit(function(e) {
      var check = $('.validate');
      var checked = false;
      for (var i = 0; i < check.length; i++) {
        if ($(check[i]).prop('checked')) {
          checked = true;
          break;
        }
      }
      if (!checked) {
        e.preventDefault();
        Swal.fire({
          title: 'Error',
          text: 'You must check at least one recepient',
          icon: 'error',
          confirmButtonText: 'Ok, i Check it!'
        });
      }
    });
    $('.select2').select2();
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      minimumInputLength: 3,
      required: true,
      allowClear: true,
      width: 'resolve',
      autoClose: true,
    });
    $('#cdosen').change(function() {
      if (this.checked) {
        $('#dosenShow').show();
        $('#dosen').prop('disabled', false);
      } else {
        $('#dosenShow').hide();
        $('#dosen').prop('disabled', true);
      }
    });
    if ($('#cdosen').prop('checked')) {
      $('#dosenShow').show();
      $('#dosen').prop('disabled', false);
    } else {
      $('#dosenShow').hide();
      $('#dosen').prop('disabled', true);
    }
    $('#ctendik').change(function() {
      if (this.checked) {
        $('#tendikShow').show();
        $('#tendik').prop('disabled', false);
      } else {
        $('#tendikShow').hide();
        $('#tendik').prop('disabled', true);
      }
    });
    if ($('#ctendik').prop('checked')) {
      $('#tendikShow').show();
      $('#tendik').prop('disabled', false);
    } else {
      $('#tendikShow').hide();
      $('#tendik').prop('disabled', true);
    }
    $('#cmahasiswa').change(function() {
      if (this.checked) {
        $('#mahasiswaShow').show();
        $('#mahasiswa').prop('disabled', false);
      } else {
        $('#mahasiswaShow').hide();
        $('#mahasiswa').prop('disabled', true);
      }
    });
    if ($('#cmahasiswa').prop('checked')) {
      $('#mahasiswaShow').show();
      $('#mahasiswa').prop('disabled', false);
    } else {
      $('#mahasiswaShow').hide();
      $('#mahasiswa').prop('disabled', true);
    }
    $('#cgroup').change(function() {
      if (this.checked) {
        $('#groupShow').show();
        $('#group').prop('disabled', false);
      } else {
        $('#groupShow').hide();
        $('#group').prop('disabled', true);
      }
    });
    if ($('#cgroup').prop('checked')) {
      $('#groupShow').show();
      $('#group').prop('disabled', false);
    } else {
      $('#groupShow').hide();
      $('#group').prop('disabled', true);
    }
    $('#cheader').change(function() {
      if (this.checked) {
        $('#headerShow').show();
        $('#header').prop('disabled', false);
      } else {
        $('#headerShow').hide();
        $('#header').prop('disabled', true);
      }
    });
    if ($('#cheader').prop('checked')) {
      $('#headerShow').show();
      $('#header').prop('disabled', false);
    } else {
      $('#headerShow').hide();
      $('#header').prop('disabled', true);
    }
    $('#cdoc').change(function() {
      if (this.checked) {
        $('#docShow').show();
        $('#doc').prop('disabled', false);
      } else {
        $('#docShow').hide();
        $('#doc').prop('disabled', true);
      }
    });
    if ($('#cdoc').prop('checked')) {
      $('#docShow').show();
      $('#doc').prop('disabled', false);
    } else {
      $('#docShow').hide();
      $('#doc').prop('disabled', true);
    }
    $('#cfile').change(function() {
      if (this.checked) {
        $('#fileShow').show();
        $('#file').prop('disabled', false);
      } else {
        $('#fileShow').hide();
        $('#file').prop('disabled', true);
      }
    });
    if ($('#cfile').prop('checked')) {
      $('#fileShow').show();
      $('#file').prop('disabled', false);
    } else {
      $('#fileShow').hide();
      $('#file').prop('disabled', true);
    }
    $('#cNoKontak').change(function() {
      if ($(this).prop('checked')) {
        $('#cdosen,#ctendik,#cmahasiswa,#cgroup').prop('checked', false).prop('disabled', true);
        $('#dosenShow,#tendikShow,#mahasiswaShow,#groupShow').hide();
        $('#dosen,#tendik,#mahasiswa,#group').prop('disabled', true);
      } else {
        $('#cdosen,#ctendik,#cmahasiswa,#cgroup').prop('disabled', false);
      }
    });
    // Menangani event change pada elemen select2
    $('.select2bs4').on('change', function() {
      var values = $(this).val();

      // Jika opsi "Select All" dipilih
      if (values.includes('all-dosen')) {
        // Memilih semua opsi lainnya
        $(this).find('option:not(:selected)').prop('selected', true);
      }
      // Jika opsi "Select All" tidak dipilih
      else {
        // Memastikan opsi "Select All" tidak dipilih
        $(this).find('option[value="all-dosen"]').prop('selected', false);
      }
      if (values.includes('all-tendik')) {
        // Memilih semua opsi lainnya
        $(this).find('option:not(:selected)').prop('selected', true);
      }
      // Jika opsi "Select All" tidak dipilih
      else {
        // Memastikan opsi "Select All" tidak dipilih
        $(this).find('option[value="all-tendik"]').prop('selected', false);
      }
      if (values.includes('all-mahasiswa')) {
        // Memilih semua opsi lainnya
        $(this).find('option:not(:selected)').prop('selected', true);
      } else {
        // Memastikan opsi "Select All" tidak dipilih
        $(this).find('option[value="all-mahasiswa"]').prop('selected', false);
      }
      $(this).trigger('change.select2'); // Memperbarui tampilan select2
    });
  });
</script>
