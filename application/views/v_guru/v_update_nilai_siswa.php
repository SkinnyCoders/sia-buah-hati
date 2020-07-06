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
                          <li class="breadcrumb-item"><a href="<?= base_url('guru_kelas/nilai') ?>">Nilai</a></li>
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
                <div class="col-md-12">
                    <div class="card card-default">
                    <div class="card-header">
                    <h3 class="card-title"><i class="far fa-dollar"></i> Data Siswa</h3>
                    </div>
                        <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 15%">NISN</th>
                                <td>: <?=$siswa['nisn']?></td>
                            </tr>
                            <tr>
                                <th style="width: 15%">Nama Siswa</th>
                                <td>: <?=ucwords($siswa['nama_siswa'])?></td>
                            </tr>
                            <tr>
                                <th style="width: 15%">Kelas</th>
                                <td>:  <?=ucwords($siswa['nama_kelas'])?></td>
                            </tr>
                            <tr>
                                <th style="width: 15%">Semester</th>
                                <td>: <?=ucwords($semester['semester'])?></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                              <div class="col-md-12">
                                <table id="example1" class="table table-striped">
                                 <thead>
                                   <tr>
                                     <th class="text-nowrap" style="width: 5%">No</th>
                                     <th class="text-nowrap" style="width: 15%">Nilai</th>
                                     <th class="text-nowrap" style="width: 20%">Nilai Tertulis</th>
                                     <th class="text-nowrap" style="width: 20%">Nilai Lisan</th>
                                     <th class="text-nowrap" style="width: 20%">Nilai Praktek</td>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 <tr>
                                      <td>1</td>
                                      <td>Ulangan Harian</td>
                                      <td><input type="text" class="form-control" name="tertulis_harian" placeholder="Masukkan Nilai Tertulis" value="<?=!empty($harian['nilai_tertulis'])?$harian['nilai_tertulis']:set_value('tertulis_harian')?>"> <small class="text-danger"><?=form_error('tertulis_harian')?></small></td>
                                      <td><input type="text" class="form-control" name="lisan_harian" placeholder="Masukkan Nilai Lisan" value="<?=!empty($harian['nilai_lisan'])?$harian['nilai_lisan']:set_value('lisan_harian')?>"> <small class="text-danger"><?=form_error('lisan_harian')?></small></td>
                                      <td><input type="text" class="form-control" name="praktek_harian" placeholder="Masukkan Nilai Praktek" value="<?=!empty($harian['nilai_praktek'])?$harian['nilai_praktek']:set_value('praktek_harian')?>"> <small class="text-danger"><?=form_error('praktek_harian')?></small></td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td>UTS</td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Tertulis" value="<?=!empty($uts['nilai_tertulis'])?$uts['nilai_tertulis']:set_value('tertulis_uts')?>"> <small class="text-danger"><?=form_error('tertulis_uts')?></small></td>
                                      <td><input type="text" class="form-control" name="lisan_uts" placeholder="Masukkan Nilai Lisan" value="<?=!empty($uts['nilai_lisan'])?$uts['nilai_lisan']:set_value('lisan_uts')?>"> <small class="text-danger"><?=form_error('lisan_uts')?></small></td>
                                      <td><input type="text" class="form-control" name="praktek_uts" placeholder="Masukkan Nilai Praktek" value="<?=!empty($uts['nilai_praktek'])?$uts['nilai_praktek']:set_value('praktek_uts')?>"> <small class="text-danger"><?=form_error('praktek_uts')?></small></td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td>UAS</td>
                                      <td><input type="text" class="form-control" name="tertulis_uas" placeholder="Masukkan Nilai Tertulis" value="<?=!empty($uas['nilai_tertulis'])?$uas['nilai_tertulis']:set_value('tertulis_uas')?>"> <small class="text-danger"><?=form_error('tertulis_uas')?></small></td>
                                      <td><input type="text" class="form-control" name="lisan_uas" placeholder="Masukkan Nilai Lisan" value="<?=!empty($uas['nilai_lisan'])?$uas['nilai_lisan']:set_value('lisan_uas')?>"> <small class="text-danger"><?=form_error('lisan_uas')?></small></td>
                                      <td><input type="text" class="form-control" name="praktek_uas" placeholder="Masukkan Nilai Praktek" value="<?=!empty($uas['nilai_praktek'])?$uas['nilai_praktek']:set_value('praktek_uas')?>"> <small class="text-danger"><?=form_error('praktek_uas')?></small></td>
                                    </tr>
                                    
                                    <tr>
                                      <td>4</td>
                                      <td>Tugas</td>
                                      <td><input type="text" class="form-control" name="tertulis_tugas" placeholder="Masukkan Nilai Tertulis" value="<?=!empty($tugas['nilai_tertulis'])?$tugas['nilai_tertulis']:set_value('tertulis_tugas')?>"><small class="text-danger"><?=form_error('tertulis_tugas')?></small></td>
                                      <td><input type="text" class="form-control" name="lisan_tugas" placeholder="Masukkan Nilai Lisan" value="<?=!empty($tugas['nilai_lisan'])?$tugas['nilai_lisan']:set_value('lisan_tugas')?>"><small class="text-danger"><?=form_error('lisan_tugas')?></small></td>
                                      <td><input type="text" class="form-control" name="praktek_tugas" placeholder="Masukkan Nilai Praktek" value="<?=!empty($tugas['nilai_praktek'])?$tugas['nilai_praktek']:set_value('praktek_tugas')?>"><small class="text-danger"><?=form_error('praktek_tugas')?></small></td>
                                    </tr>
                                 </tbody>
                               </table>
                               <button class="btn btn-primary float-right" style="width: 200px;" type="submit">Perbarui Nilai</button>
                              </div>
                            </div>
                            </form>
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