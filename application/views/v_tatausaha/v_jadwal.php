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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel <?= ucwords($title) ?></h3>
                              <a href="<?=base_url('tatausaha/jadwal/tambah')?>"class="btn btn-sm btn-primary float-right ml-3"><i class="fa fa-plus"></i> Tambah Jadwal</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Nama Guru</th>
                                 <th class="text-nowrap">NUPTK</th>
                                 <th class="text-nowrap">Kelas</th>
                                 <th class="text-nowrap">Mapel</th>
                                 <th class="text-nowrap">Hari</th>
                                 <th class="text-nowrap">jam Ke</th>
                                 <th class="text-nowrap">Jam Mulai</th>
                                 <th class="text-nowrap">Jam Akhir</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $no = 1;
                             foreach($jadwal AS $m) :
                             ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?= ucwords($m['nama'])?></td>
                                <td><?= ucwords($m['nuptk'])?></td>
                                <td><?= ucwords($m['nama_kelas'])?></td>
                                <td><?= ucwords($m['nama_mapel'])?></td>
                                <td><?= ucwords($m['hari'])?></td>
                                <td><?= ucwords($m['jam_ke'])?></td>
                                <td><?= ucwords($m['jam_mulai'])?></td>
                                <td><?= ucwords($m['jam_akhir'])?></td>
                                <td><a href="<?=base_url('tatausaha/jadwal/perbarui/'. $m['id_jadwal'])?>" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" id="<?php echo $m['id_jadwal'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                              </tr>
                             <?php endforeach; ?>
                             </tbody>
                           </table>
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
       url: "<?= base_url('tatausaha/pengembangan_diri/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#nama2').text(data.pengembangan_diri);     
          $('#mapel_update').val(data.pengembangan_diri);  
          $('#id_mapel').val(data.id_pengembangan_diri);
       },
     });
   });

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Jadwal',
       text: "Apakah anda yakin ingin menghapus data jadwal ini?",
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
             url: "<?= base_url() ?>tatausaha/jadwal/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('tatausaha/jadwal') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('tatausaha/jadwal') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>