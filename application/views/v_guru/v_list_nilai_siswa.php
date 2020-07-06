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
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12"> 
                      <!-- general form elements -->
                      <div class="card card-default ">
                          <div class="card-header">
                              <h3 class="card-title"><i class="far fa-dollar"></i><?=$title?></h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                          <form action="" method="POST">
                            <div class="row">
                           
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Pilih Mata Pelajaran</label>
                                    <select name="mapel" id="mapel" class="form-control select2bs4" data-placeholder="Pilih Mata Pelajaran">
                                        <option></option>
                                        <?php
                                        foreach($mapel AS $k) :
                                        ?>
                                        <option value="<?=$k['id_mapel']?>"><?=$k['nama_mapel']?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('kelas')?></small>
                                  </div>          
                              </div>
                              <div class="col-md-4">
                                <form action="" method="POST">
                                  <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control select2bs4" data-placeholder="Pilih Kelas">
                                      <option></option>

                                    </select>
                                    <small class="text-danger"><?= form_error('kelas')?></small>
                                  </div>          
                              </div>
                              <div class="col-md-4">
                                <form action="" method="POST">
                                  <div class="form-group">
                                    <label>Pilih Semester</label>
                                    <select name="semester" id="semester" class="form-control select2bs4" data-placeholder="Pilih Semester">
                                      <option></option>
                                      <?php
                                        foreach($semester AS $s) :
                                        ?>
                                        <option value="<?=$s['id_semester']?>"><?=ucwords($s['semester'])?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('semester')?></small>
                                  </div>          
                                  <button type="submit" name="tampil" class="btn btn-primary float-right">Tampilkan Siswa</button>
                              </div>
                            </div>
                            </form>

                            <?php 
                            if (!empty($siswa)) : 
                              ?>
                            <div class="row mt-5">
                              <div class="col-md-12">
                                <table id="example1" class="table table-striped">
                                 <thead>
                                   <tr>
                                     <th class="text-nowrap" style="width: 5%">No</th>
                                     <th class="text-nowrap" style="width: 15%">NISN</th>
                                     <th class="text-nowrap" style="width: 20%">Nama Siswa</th>
                                     <th style="width: 10%">Aksi</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                  $no = 1;
                                  foreach ($siswa as $peserta) :
                                  ?>
                                    <tr>
                                      <td><?=$no++?></td>
                                      <td><?=$peserta['nisn']?></td>
                                      <td><?=ucwords($peserta['nama_siswa'])?></td>
                                      <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-ubah" id="<?=$peserta['nisn']?>" class="btn btn-sm btn-success update">Ubah</a></td>
                                    </tr>
                                  <?php endforeach; ?>
                                 </tbody>
                               </table>
                              </div>
                            </div>
                          <?php endif; ?>
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

    <!-- bootstrap datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $(function() {
          //Date picker
          $('#datepicker1').datepicker({
              autoclose: true
          })
      });
    </script>


  <script>
      function ambil(nisn, tanggal){
        $.ajax({
            method : "POST",
            url : "<?=base_url('tatausaha/absensi/update')?>",
            data : {'nisn_update' : nisn, 'tanggal' : tanggal},
            dataType : "json",
            success : function(data){
                $('#absensi').val(data.status).change();
                $('#id_absensi').val(data.nisn);
                $('#tanggal').val(data.tanggal);
            }
        })
      }

      $('#mapel').on('change', function(){
        var id_mapel = $('#mapel').val();

        $.ajax({
           method : "POST",
            url : "<?=base_url('guru_kelas/nilai/get_kelas')?>",
            data : {'id_mapel' : id_mapel},
            dataType : "json",
            success : function(data){
              var html = '<option></option>';
              var i;

              for(i = 0; i<data.length; i++){
                html += '<option value="'+data[i].id_kelas+'">'+data[i].nama_kelas+'</option>'
              }

              console.log(html);

              $('#kelas').html(html);
            }
        })
      })
  </script>