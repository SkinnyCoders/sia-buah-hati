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
              <li class="breadcrumb-item active">Dashboard</li>
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
                  <h3 class="card-title"><i class="fa fa-bullhorn"></i> Pengumuman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <div class="card-body">
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
              </div> -->
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
          <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Jadwal hari ini
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
              <table class="table">
                  <thead>
                    <tr>
                      <th>Kelas</th>
                    <th>Mapel</th>
                    <th>Jam Mulai</th>
                    <th>Sampai</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if(!empty($jadwal)) :
                  foreach($jadwal AS $j) :
                  ?>
                    <tr>
                      <td><?=ucwords($j['nama_kelas'])?></td>
                      <td><?=ucwords($j['nama_mapel'])?></td>
                      <td><?=$j['jam_mulai']?> WIB</td>
                      <td><?=$j['jam_akhir']?> WIB</td>
                    </tr>
                    <?php
                    endforeach;
                    else :
                    ?>
                    <tr>
                      <td colspan="4" class="text-center"> -- Belum Ada jadwal --</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card bg-gradient-info">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-user"></i>
                  Absensi hari ini
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
              <table class="table">
                  <thead>
                    <tr>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Absen</th>
                    <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if(!empty($absensi)) :
                  foreach($absensi AS $s) :
                  ?>
                    <tr>
                      <td><?=ucwords($s['kelas'])?></td>
                      <td><?=DateTime::createFromFormat('Y-m-d', $s['tanggal'])->format('d F Y')?></td>
                      <td><b><i><?=ucwords($s['absen'])?></i></b></td>
                      <td><?=!empty($s['keterangan'])?$s['keterangan']:"Tidak Ada keterangan"?></td>
                    </tr>
                    <?php
                    endforeach;
                    else :
                    ?>
                    <tr>
                      <td colspan="4" class="text-center"> -- Belum Ada Absensi --</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
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
    // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

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
               window.location.href = "<?= base_url('tatausaha/dashboard') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('tatausaha/dashboard') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>