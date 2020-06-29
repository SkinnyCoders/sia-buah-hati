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
              <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title"><i class="fa fa-user-plus"></i> Tambah Jadwal Mengajar</h3>
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
                                    <option value="<?=$g['id_gtk']?>"><?=ucwords($g['nama'])?></option>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Mata Pelajaran <span class="text-danger">*</span></label>
                                <select name="mapel" id="mapel" class="form-control select2bs4" data-placeholder="Pilih Mata Pelajaran">
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
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kami">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>
                                    
                                </select>
                                <small class="text-danger mt-2"><?= form_error('status') ?></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jam_ke">Jam Ke <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="jam" id="jam_ke" placeholder="Masukkan Jam Ke" value="<?php echo set_value('jam')?>">
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
                                    <input type="time" name="jam_mulai" class="form-control float-right" placeholder="Pilih Waktu" id="datepicker1">
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
                                    <input type="time" name="jam_akhir" class="form-control float-right" placeholder="Pilih Waktu" id="datepicker1">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('jam_mulai') ?></small>
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
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };

    $('#guru').on('change', function(){
        var id_jurusan = $('#guru').val();

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

    $('#kelas').on('change', function(){
        var id_jurusan = $('#kelas').val();

        $.ajax({
            type : "POST",
            url : "<?= base_url('tatausaha/jadwal/get_mapel')?>",
            data : {'id' : id_jurusan},
            dataType : "json",
            success : function(data){

                var html = '';
                var i;

                for(i = 0; i<data.length; i++){
                    html += '<option value="'+data[i].id_mapel+'">'+data[i].nama_mapel+'</option>'
                }

                $('#mapel').html(html);

            }
        })
    });

    $('#status').on('change', function(){
        var status = $('#status').val();

        if(status == 'guru mapel'){
            $('.profil').hide();
        }else{
            $('.profil').show();
        }
    })
  </script>
  
