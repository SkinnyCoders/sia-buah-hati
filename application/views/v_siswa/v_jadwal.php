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
                          <li class="breadcrumb-item"><a href="<?= base_url('guru_kelas/dashboard') ?>">Dashboard</a></li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> <?= ucwords($title) ?></h3>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-hari" data class="btn btn-sm btn-success float-right"><i class="fa fa-calendar"></i> Pilih Hari</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Hari</th>
                                 <th class="text-nowrap">Kelas</th>
                                 <th class="text-nowrap">Mapel</th>
                                 <th class="text-nowrap">jam Ke</th>
                                 <th class="text-nowrap">Jam Mulai</th>
                                 <th class="text-nowrap">Jam Akhir</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $no = 1;
                             foreach($jadwal AS $m) :
                             ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?= ucwords($m['hari'])?></td>
                                <td><?= ucwords($m['nama_kelas'])?></td>
                                <td><?= ucwords($m['nama_mapel'])?></td>
                                <td><?= ucwords($m['jam_ke'])?></td>
                                <td><?= ucwords($m['jam_mulai'])?></td>
                                <td><?= ucwords($m['jam_akhir'])?></td>
                              </tr>
                             <?php endforeach; ?>
                             </tbody>
                           </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>


                <!-- modal tampil tanggal -->
                <div class="modal fade" id="modal-hari">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tampilkan Jadwal Berdasarkan Hari</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <!-- form start -->
                            <form action="<?=base_url('siswa/jadwal/get_hari')?>" method="post" role="form">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="tgl">Pilih Hari</label>
                                <select name="hari" id="" data-placeholder="Pilih Hari" class="form-control select2bs4">
                                    <option></option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>

                                </select>
                                <small class="text-danger mt-2"><?= form_error('tgl') ?></small>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="simpan" class="btn btn-primary">Tampilkan</button>
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
 </script>