<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css')?>">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
      .login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('https://image.freepik.com/free-vector/back-school-with-school-items-elements_3589-792.jpg');
  background-size: cover;
  background-position: center center;
}
  </style>
</head>

<body class="hold-transition login-page">

<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-8 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-4 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-5 text-center">Selamat Datang</h3>
                            <p class="text-muted mb-4">Silahkan Login, untuk mengakses sistem</p>
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="username" placeholder="username" name="username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-5">
                                    <input id="inputPassword" type="password" placeholder="Password" name="password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <!-- <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Remember password</label>
                                </div> -->
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Login</button>
                                <div class="text-center d-flex justify-content-between mt-4"><p>Copyright &copy; 2020 SIA SDIT Buah Hati</p></div>
                            </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js')?>"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js')?>"></script>

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
