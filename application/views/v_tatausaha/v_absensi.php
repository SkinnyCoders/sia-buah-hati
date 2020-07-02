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
                              <a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary float-right"> Inputkan Absensi Hari Ini</a>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add" class="btn btn-warning float-right mr-3"><i class="fa fa-calendar"></i> Tampilkan Berdasarkan Tanggal</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <form action="" method="POST">
                                  <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <select name="kelas" class="form-control select2bs4" data-placeholder="Pilih Kelas">
                                        <option></option>
                                        <?php
                                        foreach($kelas AS $k) :
                                        ?>
                                        <option value="<?=$k['id_kelas']?>"><?=$k['nama_kelas']?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('kelas')?></small>
                                  </div>
                                  <button type="submit" class="btn btn-primary float-right" name="search">Lihat Absensi</button>
                                  
                                </form>
                              </div>
                            </div>

                            <?php 
                            if (!empty($absensi)) : 
                              ?>
                            <div class="row mt-5">
                              <div class="col-md-12">
                                <table id="example1" class="table table-striped">
                                 <thead>
                                   <tr>
                                     <th class="text-nowrap" style="width: 5%">No</th>
                                     <th class="text-nowrap" style="width: 15%">NISN</th>
                                     <th class="text-nowrap" style="width: 20%">Nama Siswa</th>
                                     <th class="text-nowrap" >Kelas</th>
                                     <th class="text-nowrap" >Tanggal</th>
                                     <th class="text-nowrap" >Absen</th>
                                     <th class="text-nowrap" >Keterangan</th>
                                     <th style="width: 10%">Aksi</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                  $no = 1;
                                  foreach ($absensi as $peserta) :
                                    switch($peserta['absen']){
                                        case 'hadir':
                                            $label = '<label class="btn btn-sm btn-info">Hadir</label>';
                                        break;

                                        case 'ijin':
                                            $label = '<label class="btn btn-sm btn-warning">Ijin</label>';
                                        break;

                                        case 'sakit':
                                            $label = '<label class="btn btn-sm btn-warning">Sakit</label>';
                                        break;

                                        case 'bolos':
                                            $label = '<label class="btn btn-sm btn-danger">Bolos</label>';
                                        break;
                                    }
                                  ?>
                                    <tr>
                                      <td><?=$no++?></td>
                                      <td><?=$peserta['nisn']?></td>
                                      <td><?=ucwords($peserta['nama'])?></td>
                                      <td><?=ucwords($peserta['kelas'])?></td>
                                      <td><?=DateTime::createFromFormat('Y-m-d', $peserta['tanggal'])->format('d F Y')?></td>
                                      <td><?=$label?></td>
                                      <td><?=!empty($peserta['keterangan'])?ucwords($peserta['keterangan']):"Tidak Ada Keterangan"?></td>
                                      <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-ubah" onclick="ambil(<?=$peserta['nisn']?>, '<?=$peserta['tanggal']?>')" id="<?=$peserta['nisn']?>" class="btn btn-sm btn-success update">Ubah</a></td>
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

                      <!-- modal tampil tanggal -->
                    <div class="modal fade" id="modal-add">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tampilkan Absensi Berdasarkan tanggal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <!-- form start -->
                            <form action="" method="post" role="form">
                            <div class="row">
                            <div class="col-md-6">
                                <label for="kelas1">Pilih Kelas</label>
                                <select name="kelas1" class="form-control select2bs4" id="" data-placeholder="Pilih Kelas">
                                <option></option>
                                <?php
                                foreach($kelas AS $k) :
                                ?>
                                <option value="<?=$k['id_kelas']?>"><?=$k['nama_kelas']?></option>
                                <?php
                                endforeach;
                                ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="tgl">Pilih Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tgl" class="form-control float-right" placeholder="Pilih tanggal" id="datepicker1">
                                </div>
                                <small class="text-danger mt-2"><?= form_error('tgl') ?></small>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                    <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Absensi Hari ini</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <!-- form start -->
                            <form action="<?=base_url('tatausaha/absensi/tambah')?>" method="post" role="form">
                            <div class="row">
                              <div class="col-md-6">
                                  <label for="kelas_tambah">Pilih Kelas</label>
                                  <select name="kelas_tambah" class="form-control select2bs4" id="kelas_tambah" data-placeholder="Pilih Kelas">
                                  <option></option>
                                  <?php
                                  foreach($kelas AS $k) :
                                  ?>
                                  <option value="<?=$k['id_kelas']?>"><?=$k['nama_kelas']?></option>
                                  <?php
                                  endforeach;
                                  ?>
                                  </select>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="siswa">Pilih Siswa</label>
                                  <select name="siswa" class="form-control select2bs4" id="siswa" data-placeholder="Pilih Siswa">
                                  
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                              <div class="form-group">
                                <label for="absen">Pilih Absen</label>
                                <select name="absen" class="form-control select2bs4" data-placeholder="Pilih Absen">
                                <option></option>
                                <option value="ijin">Ijin</option>
                                <option value="sakit">Sakit</option>
                                <option value="bolos">Bolos</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="tgl">Keterangan</label>
                                  <input type="text" name="ket" class="form-control float-right" placeholder="Masukkan Keterangan">
                                  <small class="text-danger mt-2"><?= form_error('ket') ?></small>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                    <div class="modal fade" id="modal-ubah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Perbarui Absensi <span id="nisn-nama"></span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <!-- form start -->
                            <form action="<?=base_url('tatausaha/absensi/update')?>" method="post" role="form">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="hidden" name="nisn" id="id_absensi" value="">
                                    <input type="hidden" name="tanggal" id="tanggal" value="">
                                    <label for="absensi">Pilih Absensi</label>
                                    <select name="absensi" class="form-control select2bs4" id="absensi" data-placeholder="Pilih Absensi">
                                    <option></option>
                                    <option value="hadir">Hadir</option>
                                    <option value="ijin">Ijin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="bolos">Bolos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="misi">Keterangan <span class="text-danger">*</span></label>
                                <textarea id="misi" name="keterangan" class="form-control" style="height: 150px;" placeholder="Masukkan Keterangan"></textarea>
                                <small class="text-danger mt-2"><?= form_error('keterangan') ?></small>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="simpan" class="btn btn-primary">Perbarui Absensi</button>
                            </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
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

      $('#kelas_tambah').on('change', function(){
        var id_kelas = $('#kelas_tambah').val();

        $.ajax({
           method : "POST",
            url : "<?=base_url('tatausaha/absensi/get_siswa')?>",
            data : {'id_kelas' : id_kelas},
            dataType : "json",
            success : function(data){
               var html = '<option></option>';
               var i;

               for(i = 0; i<data.length; i++){
                console.log(data);
                    html += '<option value="'+data[i].nisn+'">'+data[i].nisn+' - '+data[i].nama_siswa+'</option>'
                }


               $('#siswa').html(html);
            }
        })
      })
  </script>