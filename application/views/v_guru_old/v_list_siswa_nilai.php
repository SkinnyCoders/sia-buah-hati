<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= ucwords($title) ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= ucwords($title) ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

        <!-- /.row -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-default ">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-dollar"></i> Data Siswa</h3>
                <div class="form-group">
                <select name="kelas" class="form-control float-right ml-3" style="width: 200px;" id="kelas">
                <?php
                    foreach($kelas AS $k){
                        echo '<option value="'.$k['id_kelas'].'">'.$k['nama_kelas'].'</option>';
                    }
                ?>
                </select>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-nowrap" style="width: 5%">No</th>
                    <th class="text-nowrap" style="width: 10%">NISN</th>
                    <th class="text-nowrap" style="width: 20%">Nama</th>
                    <th class="text-nowrap" style="width: 20%">Kelas</th>

                    <th class="text-nowrap" style="width: 10%">Jenis Kelamin</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody class="table-peserta">

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div>
  </section>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/cdn_admin'); ?>

<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
  </script>

<script>
  $(function() {
    $("#example1").DataTable({});
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

  $(document).ready(function(){
    var id_kelas = $('#kelas').val();
    $.ajax({
        type: 'POST',
        url: "<?= base_url('/guru/siswa/get_siswa') ?>",
        data : {'kelas' : id_kelas},
        dataType: "json",
        success: function(data) {
            var html = '';
            var i;
            var no = 1;

            if (data.length != 0) {
              for (i = 0; i < data.length; i++) {
                if(data[i].jenis_kelamin == 'P'){
                  var gender = 'Perempuan';
                }else{
                  var gender = 'Laki - Laki';
                }
                  html += '<tr><td>'+no+'</td><td>' + data[i].nisn + '</td><td>' + data[i].nama_siswa + '</td><td>' + data[i].nama_kelas + '</td><td>'+ gender +'</td><td><a href="<?=base_url()?>guru/nilai/input/'+ data[i].nisn +'" class="btn btn-sm btn-primary mr-1 detail"><i class="fa fa-edit"></i> Input Nilai</a></td></tr>'
                no++;
              }
            } else {
                html += '<tr><td colspan="6" class="text-center">-- Belum Ada Data Siswa --</td></tr>'
            }
            $('.table-peserta').html(html);
        }
    });
  });

  $('#kelas').on('change', function(){
    var id_kelas = $('#kelas').val();
    $.ajax({
        type: 'POST',
        url: "<?= base_url('/guru/siswa/get_siswa') ?>",
        data : {'kelas' : id_kelas},
        dataType: "json",
        success: function(data) {
            var html = '';
            var i;
            var no = 1;

            if (data.length != 0) {
              for (i = 0; i < data.length; i++) {
                if(data[i].jenis_kelamin == 'P'){
                  var gender = 'Perempuan';
                }else{
                  var gender = 'Laki - Laki';
                }
                  html += '<tr><td>'+no+'</td><td>' + data[i].nisn + '</td><td>' + data[i].nama_siswa + '</td><td>' + data[i].nama_kelas + '</td><td>'+ gender +'</td><td><a href="<?=base_url()?>guru/nilai/input/'+ data[i].nisn +'" class="btn btn-sm btn-primary mr-1 detail"><i class="fa fa-edit"></i> Input Nilai</a></td></tr>'
                no++;
              }
            } else {
                html += '<tr><td colspan="6" class="text-center">-- Belum Ada Data Siswa --</td></tr>'
            }
            $('.table-peserta').html(html);
        }
    });
  })
</script>