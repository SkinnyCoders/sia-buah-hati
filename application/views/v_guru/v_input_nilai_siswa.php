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
                        <td>: 3r2332432423</td>
                      </tr>
                      <tr>
                        <th style="width: 15%">Nama Siswa</th>
                        <td>: jhfjewhfkewf</td>
                      </tr>
                      <tr>
                        <th style="width: 15%">Kelas</th>
                        <td>: dewfewf</td>
                      </tr>
                      <tr>
                        <th style="width: 15%">Semester</th>
                        <td>: dewfewf</td>
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
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Tertulis"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Lisan"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Praktek"></td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td>UTS</td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Tertulis"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Lisan"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Praktek"></td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td>UAS</td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Tertulis"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Lisan"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Praktek"></td>
                                    </tr>
                                    
                                    <tr>
                                      <td>4</td>
                                      <td>Tugas</td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Tertulis"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Lisan"></td>
                                      <td><input type="text" class="form-control" name="tertulis_uts" placeholder="Masukkan Nilai Praktek"></td>
                                    </tr>
                                 </tbody>
                               </table>
                               <button class="btn btn-primary float-right" style="width: 200px;" type="submit">Simpan Nilai</button>
                              </div>
                            </div>
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