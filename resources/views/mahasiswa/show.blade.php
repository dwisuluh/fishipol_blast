<div class="form-group row">
    <table id="example1" class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>{{ $mahasiswa->nama }}</td>
        </tr>
        <tr>
          <td>NIM</td>
          <td>:</td>
          <td>{{ $mahasiswa->nim }}</td>
        </tr>
        <tr>
          <td>Departemen</td>
          <td>:</td>
          <td>{{ $mahasiswa->prodi->departemen }}</td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td>{{ $mahasiswa->prodi->nama }}</td>
        </tr>
        <tr>
          <td>Jenjang</td>
          <td>:</td>
          <td>{{ $mahasiswa->prodi->jenjang }}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td>{{ $mahasiswa->email }}</td>
        </tr>
      </tbody>
    </table>
  </div>
