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
                          <li class="breadcrumb-item active">Daftar Semester</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Semester</h3>
                             
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add" class="btn btn-sm btn-primary float-right ml-3"><i class="fa fa-plus"></i> Tambah Semester</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Semester</th>
                                 <th class="text-nowrap">Tanggal Mulai</th>
                                 <th class="text-nowrap">Tanggal Berakhir</th>
                                 <th class="text-nowrap">Tahun Ajaran</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php
                              $no = 1;
                              foreach($semesters AS $s) :
                                $tgl_mulai = DateTime::createFromFormat('Y-m-d', $s['tanggal_mulai'])->format('d F Y');
                                $tgl_akhir = DateTime::createFromFormat('Y-m-d', $s['tanggal_akhir'])->format('d F Y');
                             ?>
                                 <tr>
                                     <td><?=$no++?></td>
                                     <td><?php echo ucwords($s['semester'])?></td>
                                     <td><?=$tgl_mulai?></td>
                                     <td><?=$tgl_akhir?></td>
                                     <td><?=$s['tahun_mulai']?>/<?=$s['tahun_akhir']?></td>
                                     <td><a href="javascript:void(0)" data-toggle="modal" id="<?php echo $s['id_semester'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?php echo $s['id_semester'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                                 </tr>
                              <?php
                                endforeach;
                              ?>
                             </tbody>
                           </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>

              <!-- modal tambah -->
              <div class="modal fade" id="modal-add">
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Tambah Semester</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('tatausaha/semester/tambah') ?>" method="post" role="form">
                      <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="smstr">Pilih Semester</label>
                            <select name="semester" id="smstr" class="form-control select2bs4" data-placeholder="Pilih Mata Pelajaran"> 
                                <option></option>
                                <option value="genap">Genap</option>
                                <option value="ganjil">Ganjil</option>
                                </select>
                                <small class="text-danger mt-2"><?= form_error('mapel') ?></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Mulai <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tgl_mulai" class="form-control float-right" placeholder="Pilih tanggal" id="datepicker1" value="<?php echo set_value('tanggal_lahir') ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('tgl_lahir') ?></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Akhir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tgl_akhir" class="form-control float-right" placeholder="Pilih tanggal" id="datepicker2" value="<?php echo set_value('tanggal_lahir') ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('tgl_lahir') ?></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="tahun_ajaran">Pilih Tahun Ajaran</label>
                            <select name="tahun_ajaran" id="tahun_ajaran" class="form-control select2bs4" data-placeholder="Pilih Tahun Ajaran"> 
                                <option></option>
                                <?php foreach($tahun_ajaran AS $t) :?>
                                <option value="<?=$t['id_tahun_ajaran']?>"><?=$t['tahun_mulai']?>/<?=$t['tahun_akhir']?></option>
                                <?php endforeach; ?>
                                </select>
                                <small class="text-danger mt-2"><?= form_error('mapel') ?></small>
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

              <div class="modal fade" id="modal-lg">
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Perbarui data semester</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('tatausaha/semester/update') ?>" method="post" role="form">
                      <input type="hidden" id="id_semester" name="id">
                      <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="smstr">Pilih Semester</label>
                            <select name="semester" id="semester_update" class="form-control select2bs4" data-placeholder="Pilih Mata Pelajaran"> 
                                <option></option>
                                <option value="genap">Genap</option>
                                <option value="ganjil">Ganjil</option>
                                </select>
                                <small class="text-danger mt-2"><?= form_error('mapel') ?></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Mulai <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tgl_mulai" class="form-control float-right tgl_1" placeholder="Pilih tanggal" id="datepicker3" value="<?php echo set_value('tanggal_lahir') ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('tgl_lahir') ?></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Akhir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tgl_akhir" class="form-control float-right tgl_2" placeholder="Pilih tanggal" id="datepicker4" value="<?php echo set_value('tgl_akhir') ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('tgl_lahir') ?></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="tahun_ajaran">Pilih Tahun Ajaran</label>
                            <select name="tahun_ajaran" id="tahun_ajaran-update" class="form-control select2bs4" data-placeholder="Pilih Tahun Ajaran"> 
                                <option></option>
                                <?php foreach($tahun_ajaran AS $t) :?>
                                <option value="<?=$t['id_tahun_ajaran']?>"><?=$t['tahun_mulai']?>/<?=$t['tahun_akhir']?></option>
                                <?php endforeach; ?>
                                </select>
                                <small class="text-danger mt-2"><?= form_error('mapel') ?></small>
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
      </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>

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
          });

          $('#datepicker2').datepicker({
              autoclose: true
          });

          $('#datepicker3').datepicker({
              autoclose: true
          });

          $('#datepicker4').datepicker({
              autoclose: true
          });
    });
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('tatausaha/semester/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#id_semester').val(data.id);     
          $('#semester_update').val(data.semester).change();
          $('#tahun_ajaran-update').val(data.tahun_ajaran).change();  
          $('.tgl_1').val(data.tanggal_mulai);
          $('.tgl_2').val(data.tanggal_akhir);
       },
     });
   });

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Semester',
       text: "Apakah anda yakin ingin menghapus data Semester ini?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Hapus!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>tatausaha/semester/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('tatausaha/semester') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('tatausaha/semester') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>