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
              <li class="breadcrumb-item active">Dashboard Tatausaha</li>
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
                <form action="<?=base_url('tatausaha/pengumuman/tambah')?>" method="POST" enctype="multipart/form-data">
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
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter"><img style="width: 100%; border-radius:5px;" src="<?=base_url('assets/img/pengumuman/'.$p['gambar'])?>" alt=""></a>
                      </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  </div>
                </div>
                <hr>
                <?php
                  endforeach;
                ?>
              </div>
            </div>
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
  </script>0