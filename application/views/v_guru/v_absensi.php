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
                          <h3 class="card-title"><i class="far fa-dollar"></i><?=$title." ".$nama_kelas['nama_kelas']?></h3>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add" class="btn btn-warning float-right mr-3"><i class="fa fa-calendar"></i> Tampilkan Berdasarkan Tanggal</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
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
                            <div class="col-md-12">
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
  </script>