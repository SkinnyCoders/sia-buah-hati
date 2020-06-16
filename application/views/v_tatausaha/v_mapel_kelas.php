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
                          <li class="breadcrumb-item active">Konfigurasi Mapel Kelas</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Konfigurasi Mapel Kelas</h3>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add" class="btn btn-sm btn-primary float-right ml-3"><i class="fa fa-plus"></i> Tambah Konfigurasi</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <div class="card-body">
                          
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap" style="width: 15%">Mapel</th>
                                 <th class="text-nowrap">Kelas</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $no = 1;
                             foreach($list AS $l) :
                                $kelas = explode(',', $l['kelas']);
                             ?>
                              <tr>
                                <td><?=$no?></td>
                                <td><?=ucwords($l['nama_mapel'])?></td>
                                <td>
                                <?php for($i=0; $i<count($kelas); $i++){
                                    echo '<label class="btn btn-sm btn-info mr-2">'.$kelas[$i].'</label>';
                                } ?>
                                </td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$l['kode_mapel']?>" data-target="#modal-update" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$l['kode_mapel']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                              </tr>
                             <?php endforeach;?>
                             </tbody>
                           </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>

              <div class="modal fade" id="modal-add">
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Tambah Konfigurasi</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="" method="post" role="form">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="guru">Pilih Mapel</label>
                            <select name="mapel" id="guru" class="form-control select2bs4" data-placeholder="Pilih Mata Pelajaran"> 
                                <option></option>
                                <?php foreach($mapel AS $g) :?>
                                <option value="<?=$g['kode_mapel']?>"><?=$g['nama_mapel']?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('mapel') ?></small>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="kelas">Pilih Kelas</label>
                            <select name="datakelas[]" id="kelas" class="form-control select2bs4" multiple="multiple" data-placeholder="Pilih Kelas"> 
                                <option></option>
                                <?php foreach($kelas_list AS $k) :?>
                                <option value="<?=$k['id_kelas']?>"><?=$k['nama_kelas']?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('kelas') ?></small>
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

             <div class="modal fade" id="modal-update">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Edit Mapel Kelas</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('admin/mapel/update_mapel_kelas') ?>" method="post" role="form">
                        <input type="hidden" name="kode_mapel" id="kode_mapel_update" value="">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="kelas">Nama Kelas</label>
                            <select name="kelas[]" id="kelas_update" class="form-control select2bs4" multiple="multiple" data-placeholder="Pilih Kelas"> 
                                <option></option>
                                <?php foreach($kelas_list AS $k) :?>
                                <option value="<?=$k['id_kelas']?>"><?=$k['nama_kelas']?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('kelas') ?></small>
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/mapel/update_mapel_kelas') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {   
          $('#kelas_update').val(data.id_kelas).change();
          $('#kode_mapel_update').val(data.kode_mapel);  
       },
     });
   });

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Konfigurasi',
       text: "Apakah anda yakin ingin menghapus data Konfigurasi ini?",
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
             url: "<?= base_url() ?>admin/mapel/delete_konfigurasi/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/mapel/mapel_kelas') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/mapel/mapel_kelas') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>