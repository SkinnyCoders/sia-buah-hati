
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pendaftaran</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.css') ?>">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css">
</head>


<body class="login-page">
<div class="daftar-box">
  <!-- <div class="login-logo">
    <a href="../../index2.html"><b>Login</b> Admin</a>
  </div> -->
  <!-- /.login-logo -->
  <div class="card mt-5">
    <div class="login-card-body">
      <h5 class="login-box-msg">Silahkan melengkapi formulir dibawah ini untuk mendaftar <hr style="border: 3px solid #dc3545;" class="text-danger"></h5>
      
      <form action="" method="post">
        
          <h6 class="text-muted text-header">Informasi Pendaftaran</h6>
          <hr>
          <div class="row">
          	<div class="col-md-8">
          		<div class="form-group">
		            <label>Nama Lengkap <span class="text-danger">*</span></label>
		            <div class="input-group mb-1">
		                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="">
		                <div class="input-group-append">
		                    <div class="input-group-text">
		                    <span class="fas fa-user"></span>
		                    </div>
		                </div>
		            </div>
		            <small class="text-danger"><?= form_error('nama') ?></small>
		        </div>
          	</div>
          	<div class="col-md-4">
          		<div class="form-group">
		            <label>NISN <span class="text-danger">*</span></label>
		            <input type="text" name="nisn" class="form-control" placeholder="NISN" value="">
		            <small class="text-danger"><?= form_error('nisn') ?></small>
		        </div>
          	</div>
          </div>
          
           <div class="row">
          	<div class="col-md-6">
          		<div class="form-group">
          			<label for="exampleInputPassword1">Tanggal Lahir <span class="text-danger">*</span></label>
		            <div class="input-group mb-1">
		                <input type="text" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="" id="datepicker">
		                <div class="input-group-append">
		                    <div class="input-group-text">
		                    <span class="fas fa-calendar"></span>
		                    </div>
		                </div>
		            </div>
		            <small class="text-danger"><?= form_error('tgl_lahir') ?></small>
		        </div>
          	</div>
          	<div class="col-md-6">
          		<div class="form-group">
                    <label for="exampleInputPassword1">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="L" type="radio" id="male" name="gender">
                    <label for="male" class="custom-control-label">Laki - Laki</label>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="P" type="radio" id="female" name="gender">
                    <label for="female" class="custom-control-label">Perempuan</label>
                    </div>
                    </div>
                    </div>
                    <small class="text-danger"><?= form_error('gender') ?></small>
                </div>
          	</div>
          </div>

          <div class="row">
          	<div class="col-md-6">
          		<div class="form-group">
		            <label>Tempat Lahir <span class="text-danger">*</span></label>
		            <div class="input-group mb-1">
		                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempar Lahir" value="">
		                <div class="input-group-append">
		                    <div class="input-group-text">
		                    <span class="fas fa-place"></span>
		                    </div>
		                </div>
		            </div>
		            <small class="text-danger"><?= form_error('tempat_lahir') ?></small>
		        </div>
          	</div>
          	<div class="col-md-6">
          		<div class="form-group">
		            <label>Agama <span class="text-danger">*</span></label>
		            <input type="text" name="agama" class="form-control" placeholder="Agama" value="">
		            <small class="text-danger"><?= form_error('agama') ?></small>
		        </div>
          	</div>
          </div>

          <div class="form-group">
          	<label for="alamat">Alamat Rumah <span class="text-danger">*</span></label>
            <textarea id="misi" name="alamat" class="form-control" style="height: 70px;" placeholder="Masukkan Alamat Rumah"></textarea>
          	<small class="text-danger"><?= form_error('alamat') ?></small>
          </div>

          <br>

        <h6 class="text-muted mt-3">Informasi Orang Tua / Wali</h6>
      	<hr>
      	<div class="row">
            <div class="col-md-8">
            <div class="form-group">
            <label>Nama Orang Tua</label>
                    <div class="input-group mb-1">
                        <input type="text" name="nama_ortu" class="form-control" placeholder="Nama Orang tua" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                </div>
                <small class="text-danger"><?= form_error('nama_ortu') ?></small>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
            <label>Telepon Orang Tua</label>
                    <div class="input-group mb-1">
                        <input type="text" name="telepon_ortu" class="form-control" placeholder="Telepon Orang tua" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                            </div>
                        </div>
                </div>
                <small class="text-danger"><?= form_error('telepon_ortu') ?></small>
            </div>
            </div>
          </div>
          <div class="row">
          	<div class="col-md-6">
          		<div class="form-group">
		          <label class="label text-nowrap">Pekerjaan Orang Tua</label>
		            <div class="input-group mb-1">
		            <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan Ortu">
		            <div class="input-group-append">
		                <div class="input-group-text">
		                <span class="fas fa-briefcase"><?= form_error('pekerjaan') ?></span>
		                </div>
		            </div>
		            </div>
		            <small class="text-danger"></small>
		        </div>
          	</div>
          	<div class="col-md-6">
          		<div class="form-group">
		          <label class="label text-nowrap">Penghasilan Orang Tua</label>
		            <div class="input-group mb-1">
		            <input type="text" name="penghasilan" class="form-control" placeholder="Penghasilan">
		            <div class="input-group-append">
		                <div class="input-group-text">
		                <span class="fas fa-lock"></span>
		                </div>
		            </div>
		            </div>
		            <small class="text-danger"><?= form_error('penghasilan') ?></small>
		        </div>
          	</div>
          </div>

          <div class="form-group">
          	<label for="alamat">Alamat Rumah Ortu <span class="text-danger">*</span></label>
            <textarea id="misi" name="alamat_ortu" class="form-control" style="height: 70px;" placeholder="Masukkan Alamat Rumah"></textarea>
          	<small class="text-danger"><?= form_error('alamat_ortu') ?></small>
          </div>
      
      	 <div class="row">
          <div class="col-9">
            <div class="icheck-danger">
              <input type="checkbox" name="agree" id="remember">
              <label for="remember" class="text-muted text-small">
              	<small class="text-muted">Dengan ini saya menyetujui untuk mengikuti pendaftaran dan segala peraturan yang telah ditetapkan penyelenggara.</small>
                
              </label>
            </div>
            <small class="text-danger"></small>
          </div>
          <!-- /.col -->
          <div class="col-3">
            <button type="submit" class="btn btn-danger btn-block">Mendaftar</button>
          </div>
          <!-- /.col -->
        </div>

      </form>

      <!-- <p class="mb-0 mt-3">
        Jika sudah mendaftar silahkan <a href="https://ppdb.si-20.xyz/?p=login" class="text-center">login disini</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>

<!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
    $(function() {
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
    })
  </script>

  <script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
  </script>

<script>
  $(document).ready(function(){
      $.ajax({
          type : "GET",
          url : "http://dev.farizdotid.com/api/daerahindonesia/provinsi",
          dataType : "json",
          success : function(data){
            var html = '<option></option>';
            var i;

            for (i = 0; i < data.semuaprovinsi.length; i++) {
                html += '<option value="' + data.semuaprovinsi[i].id + '">' + data.semuaprovinsi[i].nama + '</option>'
            }

            $('#provinsi').html(html);
          }
      })
  })
  </script>

  <script>
      $('#provinsi').on('change', function(){
          var id_provinsi = $('#provinsi').val();
          $('#kec').empty();
        $.ajax({
          type : "GET",
          url : "http://dev.farizdotid.com/api/daerahindonesia/provinsi/"+id_provinsi+"/kabupaten",
          dataType : "json",
          success : function(data){
            var html = '<option></option>';
            var i;

            for (i = 0; i < data.kabupatens.length; i++) {
                html += '<option value="' + data.kabupatens[i].id + '">' + data.kabupatens[i].nama + '</option>'
            }

            $('#kabupaten').html(html);
          }
        })
      })
  </script>

<script>
      $('#kabupaten').on('change', function(){
          var id_kab = $('#kabupaten').val();
        $.ajax({
          type : "GET",
          url : "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/"+id_kab+"/kecamatan",
          dataType : "json",
          success : function(data){
            var html = '<option></option>';
            var i;

            for (i = 0; i < data.kecamatans.length; i++) {
                html += '<option value="' + data.kecamatans[i].id + '">' + data.kecamatans[i].nama + '</option>'
            }

            $('#kec').html(html);
          }
        })
      })
  </script>

<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 4000
    });
    });
</script>
<script>
	$(document).ready(function(){
		var prodi = $('#jurusan').val();

		$.ajax({
        type : "POST",
        url : "https://ppdb.si-20.xyz/c_home/registrasi/getJalur",
        data : {'id_prodi' : prodi},
        async : false,
        dataType : "json",
        success : function(data){
          var html = '<option></option>';
          var i;

          for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }
              console.log(html);
              $(".jal").html(html);
          }
      	})
	});

	$('#jurusan').on('change', function(){
		var prodi = $('#jurusan').val();

		$.ajax({
        type : "POST",
        url : "https://ppdb.si-20.xyz/c_home/registrasi/getJalur",
        data : {'id_prodi' : prodi},
        async : false,
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }
              console.log(html);
              $(".jal").html(html);
          }
      	})
	})
</script>

<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 4000
    });
    <?php 
    if($this->session->flashdata('msg_failed')){
    ?>
      Toast.fire({
        type: 'error',
        title: '<?= $this->session->flashdata('msg_failed')?>'
      });
    <?php 
    }elseif($this->session->flashdata('msg_success')){
    ?>
    Toast.fire({
        type: 'success',
        title: '<?= $this->session->flashdata('msg_success')?>'
    });
    <?php
    }
    ?>
});
</script>

</body>
</html>
