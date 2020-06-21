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
          <div class="col-md-4 my-auto">
            <div class="card card-primary ">
              <div class="card-header">
                  <h3 class="card-title"><i class="far fa-dollar"></i> Pengumuman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                  <div class="form-group">
                    <textarea style="width: 100%; height:200px;" class="form-control" name="" id="" placeholder="Tulis Pengumuman"></textarea>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <input type="file" class="dropify" data-min-height="400">
                  </div>
                </div>
                <button class="btn btn-sm btn-block btn-primary">Kirim Pengumuman</button>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-3">
                    <img src="<?=base_url('assets/img/user/default.png')?>" style="width:70px; height:70px;" class="rounded-circle elevation-2 mt-2" alt="User Image">
                  </div>
                  <div class="col-md-8">
                  <small class=" text-muted text-black"><span style="font-size: 20px; font-weight:bold;">bambang</span> - <span style="font-size: 15px; font-weight:bold;">06 Juni 2020</span> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, veritatis doloremque ipsam, eum aut dolor modi labore nemo sunt officiis non sint provident cupiditate optio quisquam quidem accusantium neque autem!</small>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-3">
                    <img src="<?=base_url('assets/img/user/default.png')?>" style="width:70px; height:70px;" class="rounded-circle elevation-2 mt-2" alt="User Image">
                  </div>
                  <div class="col-md-8">
                  <small class=" text-muted text-black"><span style="font-size: 20px; font-weight:bold;">bambang</span> - <span style="font-size: 15px; font-weight:bold;">06 Juni 2020</span> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, veritatis doloremque ipsam, eum aut dolor modi labore nemo sunt officiis non sint provident cupiditate optio quisquam quidem accusantium neque autem!</small>
                  </div>
                  <hr>
                </div>
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