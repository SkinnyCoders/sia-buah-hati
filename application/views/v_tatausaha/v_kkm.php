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
                          <li class="breadcrumb-item active">Daftar KKM</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar KKM</h3>
                             
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add" class="btn btn-sm btn-primary float-right ml-3"><i class="fa fa-plus"></i> Tentukan KKM</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Mapel</th>
                                 <th class="text-nowrap">Kelas</th>
                                 <th class="text-nowrap">KKM</th>
                                 <th style="width: 15%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $no = 1;
                             foreach($kkm AS $k) :
                             ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?php echo ucwords($k['nama_mapel'])?></td>
                                <td><?php echo ucwords($k['nama_kelas'])?></td>
                                <td><?php echo ucwords($k['kkm'])?></td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$k['id_kkm']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$k['id_kkm']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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

              <!-- modal tambah -->
              <div class="modal fade" id="modal-add">
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Tambah KKM</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                       <div class="row  mb-3">
                           <div class="col-md-12">
                               <small class="text-muted"><span class="text-danger">*</span> KKM adalah kriteria ketuntasan belajar yang ditentukan oleh satuan pendidikan dengan mengacu pada standar kompetensi lulusan. Dalam menetapkan KKM, satuan pendidikan  harus merumuskannya secara bersama antara kepala sekolah, pendidik, dan tenaga kependidikan lainnya.</small>
                           </div>
                       </div>
                       <hr>
                         <!-- form start -->
                      <form action="<?= base_url('tatausaha/kkm/tambah') ?>" method="post" role="form">
                      <div class="row">
                      <div class="col-md-4">
                          <label for="kelas">Pilih Mapel</label>
                          <select name="mapel" class="form-control select2bs4" id="mapel" data-placeholder="Pilih Mapel">
                            <option></option>
                            <?php
                                foreach($mapel AS $m) {
                                    echo '<option value="'.$m['id_mapel'].'">'.$m['nama_mapel'].'</option>';
                                }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="kelas">Pilih Kelas</label>
                          <select name="kelas" class="form-control select2bs4" id="kelas_add" data-placeholder="Pilih Kelas">
                            <option></option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="text" class="form-control" name="kkm" id="" placeholder="Masukkan KKM" value="<?php echo set_value('kkm'); ?>">
                            <small class="text-danger mt-2"><?= form_error('kkm') ?></small>
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
                     <h4 class="modal-title">Edit <span id="nama2"></span></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('tatausaha/kkm/update') ?>" method="post" role="form">
                        <input type="hidden" name="id" id="id_kkm" value="">
                        <div class="row">
                      <div class="col-md-4">
                          <label for="kelas">Pilih Mapel</label>
                          <select name="mapel" class="form-control select2bs4" id="mapel_update" data-placeholder="Pilih Mapel">
                            <option></option>
                            <?php
                                foreach($mapel AS $m) {
                                    echo '<option value="'.$m['id_mapel'].'">'.$m['nama_mapel'].'</option>';
                                }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="kelas">Pilih Kelas</label>
                          <select name="kelas" class="form-control select2bs4 kelas2" id="kelas_update" data-placeholder="Pilih Kelas">
                            <option></option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="text" class="form-control" name="kkm" id="kkm_update" placeholder="Masukkan KKM" value="<?php echo set_value('kkm'); ?>">
                            <small class="text-danger mt-2"><?= form_error('kkm') ?></small>
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
       url: "<?= base_url('tatausaha/kkm/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#mapel_update').val(data.id_mapel).change();
          $('#kkm_update').val(data.kkm);
          $('#id_kkm').val(data.id_kkm);
          $('#tingkat').val(data.tingkat_kelas).change();  
        $.ajax({
            type: "post",
            url: "<?= base_url('tatausaha/kkm/get_kelas') ?>",
            data: {
                'id_mapel': data.id_mapel
            },
            dataType: "json",
            success: function(res) {
                var html = '';
                var i;
                var selected = '';

                for(i=0; i<res.length; i++){
                    if(data.id_mapel_kelas == res[i].id_mapel_kelas){
                        selected = 'Selected';
                    }else{
                        selected;
                    }
                    html += '<option value="'+res[i].id_mapel_kelas+'" '+selected+'>'+res[i].nama_kelas+'</option>';
                }
                console.log(html)
                $("#kelas_update").html(html);
            },
        });
       },
     });
   });

   $('#mapel').on('change', function(){
       var mapel = $('#mapel').val();
       $.ajax({
       type: "post",
       url: "<?= base_url('tatausaha/kkm/get_kelas') ?>",
       data: {
         'id_mapel': mapel
       },
       dataType: "json",
       success: function(data) {
        var html = '';
             var i;

            for(i=0; i<data.length; i++){
                html += '<option value="'+data[i].id_mapel_kelas+'">'+data[i].nama_kelas+'</option>';
            }
            $("#kelas_add").html(html);
       },
     });

   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data KKM',
       text: "Apakah anda yakin ingin menghapus data kkm ini?",
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
             url: "<?= base_url() ?>tatausaha/kkm/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('tatausaha/kkm') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('tatausaha/kkm') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>