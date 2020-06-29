 <?php
switch($siswa['jenis_kelamin']){
    case 'L' :
        $gender = 'Laki - Laki';
    break;

    case 'P' : 
        $gender = 'Perempuan';
    break;
}

$tgl = DateTime::createFromFormat('Y-m-d', $siswa['tanggal_lahir'])->format('d F Y');
 ?>
 
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
                          <li class="breadcrumb-item"><a href="<?= base_url('tatausaha/dashboard') ?>">Dashboard</a></li>
                          <li class="breadcrumb-item"><a href="<?= base_url('tatausaha/siswa') ?>">Daftar Siswa</a></li>
                          <li class="breadcrumb-item active">Detail Siswa</li>
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
                        <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                        </div>
                            <img class="img-circle elevation-2 ml-5 my-3" style="width: 200px; position:absolute; top:0px;"  src="<?=base_url()?>/assets/img/siswa/<?=$siswa['foto']?>" id="foto" alt="User Avatar">
                        <div class="card-footer">
                            <div class="row mt-5">
                            <div class="col-sm-6">
                                <table class="table table-borderless">
                                <tr>
                                    <th style="width: 10%">NISN</th>
                                    <td>: <span class="ml-3"><?=ucwords($siswa['nisn'])?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Nama Siswa</th>
                                    <td>: <span class="ml-3"><?=ucwords($siswa['nama_siswa'])?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Tanggal Lahir</th>
                                    <td>: <span class="ml-3"><?=ucwords($tgl)?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 35%">Tempat Lahir</th>
                                    <td>: <span class="ml-3"><?=ucwords($siswa['tempat_lahir'])?></span></td>
                                </tr>
                                
                                <tr>
                                    <th style="width: 35%">Jenis Kelamin</th>
                                    <td>: <span class="ml-3"><?=ucwords($gender)?></span>
                                </tr>
                                <tr>
                                    <th style="width: 35%">No. Telepon</th>
                                    <td>: <span class="ml-3"><?=ucwords($siswa['no_hp'])?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 35%">Alamat</th>
                                    <td>: <span class="ml-3"><?=ucwords($siswa['alamat'])?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 35%">Kelas</th>
                                    <td>:  <span class="ml-3"><?=ucwords($siswa['nama_kelas'])?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 35%">Nama Ayah</th>
                                    <td>: <span class="ml-3"><?=ucwords($siswa['nama_ayah'])?></span></td>
                                </tr>
                                <tr>
                                    <th style="width: 35%">Nama Ibu</th>
                                    <td>:  <span class="ml-3"><?=ucwords($siswa['nama_ibu'])?></span></td>
                                </tr>
                                </table>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        </div>
                        <!-- /.widget-user -->
                  </div>
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

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Siswa',
       text: "Apakah anda yakin ingin menghapus data siswa ini?",
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
             url: "<?= base_url() ?>tatausaha/siswa/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('tatausaha/siswa') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('tatausaha/siswa') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>