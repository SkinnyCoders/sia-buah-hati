  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard Guru</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-6 my-auto">
            <div class="card card-primary ">
              <div class="card-header">
                  <h3 class="card-title"><i class="far fa-dollar"></i> Pengumuman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form action="<?=base_url('common/pengumuman/tambah')?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <input type="hidden" name="id_gtk" value="<?=$this->session->userdata('id_gtk')?>">
                  <div class="col-md-8">
                  <div class="form-group">
                    <textarea style="width: 100%; height:200px;" class="form-control" name="konten" id="" placeholder="Tulis Pengumuman"></textarea>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <input type="file" name="foto" class="dropify" data-min-height="400">
                  </div>
                </div>
                <button type="submit" class="btn btn-sm btn-block btn-primary">Kirim Pengumuman</button>
                </form>
              </div>
              <div class="card-footer">
                <?php
                  foreach($pengumumans AS $p) :
        
                    $tgl = DateTime::createFromFormat('Y-m-d H:i:s', $p['tanggal'])->format('d F Y');
                    $waktu = DateTime::createFromFormat('Y-m-d H:i:s', $p['tanggal'])->format('H:i');
                ?>
                <div class="row">
                  <div class="col-md-3">
                    <img src="<?=base_url('assets/img/user/'.$p['foto'])?>" style="width:70px; height:70px;" class="rounded-circle elevation-2 mt-2" alt="User Image">
                  </div>
                  <div class="col-md-8">
                  <small class=" text-muted text-black"><span style="font-size: 20px; font-weight:bold;"><?=ucwords($p['nama'])?></span> - <span style="font-size: 15px; font-weight:bold;"><?=$tgl?> pukul <?=$waktu?> WIB</span> <br> <?=$p['konten']?></small>
                    <?php 
                      if($p['gambar'] !== null) :
                    ?>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter<?=$p['id_pengumuman']?>"><img style="width: 100%; border-radius:5px;" src="<?=base_url('assets/img/pengumuman/'.$p['gambar'])?>" alt=""></a>
                      </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter<?=$p['id_pengumuman']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                          <img style="width: 100%; border-radius:5px;" src="<?=base_url('assets/img/pengumuman/'.$p['gambar'])?>" alt="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                      endif;
                    ?>
                    <?php
                    if($p['id_gtk'] == $this->session->userdata('id_gtk')) :
                    ?>
                    <div class="row mt-3">
                      <div class="col-md-12">
                      <a href="javascript:void(0)" id="<?=$p['id_pengumuman']?>" class="btn btn-xs btn-danger btn-pulse float-right delete"><i class="fa fa-times"> hapus</i></a>
                      <a href="javascript:void(0)" id="<?=$p['id_pengumuman']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-xs btn-success float-right update mr-2"><i class="fa fa-edit"> edit</i></a>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
                <hr>
                <?php
                  endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary ">
              <div class="card-header">
                  <h3 class="card-title"><i class="far fa-dollar"></i> Jadwal hari ini</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <table class="table">
                  <thead class="bg-info">
                    <tr>
                      <th>Kelas</th>
                    <th>Mapel</th>
                    <th>Jam Mulai</th>
                    <th>Sampai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Kelas 1</td>
                      <td>Bahasa</td>
                      <td>07:30 WIB</td>
                      <td>08:50 WIB</td>
                    </tr>
                    <tr>
                      <td>Kelas 3</td>
                      <td>Bahasa</td>
                      <td>07:30 WIB</td>
                      <td>08:50 WIB</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <div class="modal fade" id="modalEdit">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Perbarui Pengumuman <span id="nama2"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <!-- form start -->
                <form action="<?= base_url('common/pengumuman/update') ?>" method="post" role="form" enctype="multipart/form-data">
                  <input type="hidden" name="id" id="id_pengumuman" value="">
                  <div class="row">
                  <input type="hidden" name="id_gtk" value="<?=$this->session->userdata('id_gtk')?>">
                  <div class="col-md-8">
                  <div class="form-group">
                    <textarea style="width: 100%; height:200px;" class="form-control" name="konten" id="konten_update" placeholder="Tulis Pengumuman"></textarea>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <input type="file" name="foto" class="dropifyUpdate" data-min-height="400">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="modal-footer justify-content-between">
                <button type="submit" name="simpan" class="btn btn-primary">Perbarui</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php $this->load->view('templates/cdn_admin'); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

  <script>
  $(document).ready(function(){
    $('.dropify').dropify({
      messages: {
          default: 'Drag atau drop untuk memilih gambar',
          replace: 'Ganti',
          remove:  'Hapus',
          error:   'error'
      }
    });
  })

  $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('common/pengumuman/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#konten_update').text(data.konten);     
          $('#id_pengumuman').val(data.id_pengumuman);
          $('.dropifyUpdate').dropify({
            defaultFile: "<?=base_url('assets/img/pengumuman/')?>"+data.gambar,
            messages: {
                default: 'Drag atau drop untuk memilih gambar',
                replace: 'Ganti',
                remove:  'Hapus',
                error:   'error'
            }
        });
       },
     });
   });


  $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Pengumuman',
       text: "Apakah anda yakin ingin menghapus data pengumuman ini?",
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
             url: "<?= base_url() ?>common/pengumuman/hapus/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= $_SERVER['HTTP_REFERER'] ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= $_SERVER['HTTP_REFERER'] ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>