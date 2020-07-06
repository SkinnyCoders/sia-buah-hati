  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=ucwords($title)?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('tatausaha/dashboard')?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('tatausaha/jadwal')?>">Daftar Jadwal</a></li>
              <li class="breadcrumb-item active">Perbarui</li>
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
                <h3 class="card-title"> Perbarui Jadwal Mengajar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Nama Guru <span class="text-danger">*</span></label>
                                <select name="guru" id="guru" class="form-control select2bs4" data-placeholder="Pilih Guru">
                                    <option></option>
                                    <?php 
                                    foreach($guru AS $g) :
                                    ?>
                                    <option value="<?=$g['id_gtk']?>" <?php if($jadwal['id_gtk'] == $g['id_gtk']){ echo 'selected'; }?>><?=ucwords($g['nama'])?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger mt-2"><?= form_error('status') ?></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Mata Pelajaran <span class="text-danger">*</span></label>
                                <select name="mapel" id="mapel" class="form-control select2bs4" data-placeholder="Pilih Mata Pelajaran">
                                    <option></option>
                                    <?php 
                                    foreach($mapel AS $g) :
                                    ?>
                                    <option value="<?=$g['id_mapel']?>" <?php if($jadwal['id_mapel'] == $g['id_mapel']){ echo 'selected'; }?>><?=ucwords($g['nama_mapel'])?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger mt-2"><?= form_error('status') ?></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Kelas <span class="text-danger">*</span></label>
                                <select name="kelas" id="kelas" class="form-control select2bs4" data-placeholder="Pilih Mengajar di Kelas mana">
                                    <option></option>
                                   
                                </select>
                                <small class="text-danger mt-2"><?= form_error('status') ?></small>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label >Hari <span class="text-danger">*</span></label>
                                <select name="hari" id="hari" class="form-control select2bs4" data-placeholder="Pilih Hari">
                                    <option></option>
                                    <option value="senin" <?php if($jadwal['hari'] == 'senin'){ echo 'selected'; }?>>Senin</option>
                                    <option value="selasa" <?php if($jadwal['hari'] == 'selasa'){ echo 'selected'; }?>>Selasa</option>
                                    <option value="rabu" <?php if($jadwal['hari'] == 'rabu'){ echo 'selected'; }?>>Rabu</option>
                                    <option value="kamis" <?php if($jadwal['hari'] == 'kamis'){ echo 'selected'; }?>>Kamis</option>
                                    <option value="jumat" <?php if($jadwal['hari'] == 'jumat'){ echo 'selected'; }?>>Jumat</option>
                                    <option value="sabtu" <?php if($jadwal['hari'] == 'sabtu'){ echo 'selected'; }?>>Sabtu</option>
                                    
                                </select>
                                <small class="text-danger mt-2"><?= form_error('status') ?></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jam_ke">Jam Ke <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="jam" id="jam_ke" placeholder="Masukkan Jam Ke" value="<?php echo !empty($jadwal['jam_ke'])?$jadwal['jam_ke']:set_value('jam')?>">
                                <small class="text-danger mt-2"><?= form_error('jam') ?></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Mulai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="jam_mulai" class="form-control float-right" placeholder="Pilih Waktu" id="datepicker1" value="<?php echo !empty($jadwal['jam_mulai'])?$jadwal['jam_mulai']:set_value('jam_mulai')?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('jam_mulai') ?></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Akhir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="jam_akhir" class="form-control float-right" placeholder="Pilih Waktu" id="datepicker1"  value="<?php echo !empty($jadwal['jam_akhir'])?$jadwal['jam_akhir']:set_value('jam_akhir')?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('jam_akhir') ?></small>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Tambahkan Jadwal!</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin');?>

  <!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker').datepicker({
              autoclose: true
          })
      });

      $(function() {
          //Date picker
          $('#datepicker2').datepicker({
              autoclose: true,
          })
      });

      $(function() {
          //Date picker
          $('#datepicker3').datepicker({
              autoclose: true,
          })
      });

      $(function() {
          //Date picker
          $('#datepicker4').datepicker({
              autoclose: true
          })
      });
  </script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

  <script>
      $(document).ready(function(){
        var id_jurusan = $('#mapel').val();
        var id_kelas = <?=$jadwal['id_kelas']?>;
        var id_mapel = <?=$jadwal['id_mapel']?>;

        $.ajax({
            type : "POST",
            url : "<?= base_url('tatausaha/jadwal/get_kelas')?>",
            data : {'id' : id_jurusan},
            dataType : "json",
            success : function(data){

                var html = '<option></option>';
                var i;

                for(i = 0; i<data.length; i++){
                    if(data[i].id_kelas == id_kelas){
                        var select = 'selected'; 
                    }else{
                        var select = '';
                    }
                    html += '<option value="'+data[i].id_kelas+'" '+select+'>'+data[i].nama_kelas+'</option>'
                }

                $('#kelas').html(html);

            }
        })

        // $.ajax({
        //     type : "POST",
        //     url : "<?= base_url('tatausaha/jadwal/get_mapel')?>",
        //     data : {'id' : id_kelas},
        //     dataType : "json",
        //     success : function(data){

        //         var html = '';
        //         var i;

        //         for(i = 0; i<data.length; i++){
        //             if(data[i].id_mapel == id_mapel){
        //                 var select = 'selected'; 
        //             }else{
        //                 var select = '';
        //             }

        //             html += '<option value="'+data[i].id_mapel+'" '+select+'>'+data[i].nama_mapel+'</option>'
        //         }

        //         $('#mapel').html(html);

        //     }
        // })
      })


    $('#mapel').on('change', function(){
        var id_jurusan = $('#mapel').val();

        $.ajax({
            type : "POST",
            url : "<?= base_url('tatausaha/jadwal/get_kelas')?>",
            data : {'id' : id_jurusan},
            dataType : "json",
            success : function(data){

                var html = '<option></option>';
                var i;

                for(i = 0; i<data.length; i++){
                    html += '<option value="'+data[i].id_kelas+'">'+data[i].nama_kelas+'</option>'
                }

                $('#kelas').html(html);

            }
        })
    });

    // $('#kelas').on('change', function(){
    //     var id_jurusan = $('#kelas').val();

    //     $.ajax({
    //         type : "POST",
    //         url : "<?= base_url('tatausaha/jadwal/get_mapel')?>",
    //         data : {'id' : id_jurusan},
    //         dataType : "json",
    //         success : function(data){

    //             var html = '';
    //             var i;

    //             for(i = 0; i<data.length; i++){
    //                 html += '<option value="'+data[i].id_mapel+'">'+data[i].nama_mapel+'</option>'
    //             }

    //             $('#mapel').html(html);

    //         }
    //     })
    // });
  </script>
  
