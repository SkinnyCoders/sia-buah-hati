<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Digital Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    
    <!-- css files -->
    <link href="<?= base_url('assets/css/bootstrap.css') ?>" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet"><!-- fontawesome css -->
    <!-- //css files -->
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css')?>">
    
    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    <!-- //google fonts -->

    <style>
        .carousel {
	margin: 50px auto;
	padding: 0 70px;
}
.carousel .item {
	color: #999;
	overflow: hidden;
    min-height: 120px;
	font-size: 13px;
}
.carousel .media img {
	width: 80px;
	height: 80px;
	display: block;
	border-radius: 50%;
}
.carousel .testimonial {
	padding: 0 15px 0 60px ;
	position: relative;
}
.carousel .testimonial::before {
	content: '';
	color: #e2e2e2;
	font-weight: bold;
	font-size: 68px;
	line-height: 54px;
	position: absolute;
	left: 15px;
	top: 0;
}
.carousel .overview b {
	text-transform: uppercase;
	color: #1c47e3;
}
.carousel .carousel-indicators {
	bottom: -40px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 18px;
    height: 18px;
	border-radius: 50%;
	margin: 1px 3px;
}
.carousel-indicators li {	
    background: #e2e2e2;
    border: 4px solid #fff;
}
.carousel-indicators li.active {
	color: #fff;
    background: #1c47e3;    
    border: 5px double;    
}
    </style>
    
</head>
<body>

<!-- //header -->
<header class="py-4">
    <div class="container">
            <div id="logo">
                <h1> <a href="<?=base_url()?>"><span class="fa fa-home" aria-hidden="true"></span> SMK Pancasila 7</a></h1>
            </div>
        <!-- nav -->
        <nav class="d-lg-flex">

            <label for="drop" class="toggle"><span class="fa fa-bars" aria-hidden="true"></span></label>
            <input type="checkbox" id="drop" />
            <ul class="menu mt-2 ml-auto">
                <li class=""><a href="<?=base_url()?>">Home</a></li>
                <li class=""><a href="<?=base_url()?>#about">About</a></li>
                <li class=""><a href="<?=base_url()?>/lowongan">Lowongan</a></li>
                <li class=""><a href="<?=base_url()?>/event">Event</a></li>
                <li class=""><a href="<?=base_url()?>#testimoni">Testimoni</a></li>
                <!-- <li class=""><a href="#alumni">Galeri Alumni</a></li> -->
                <!-- <li class=""> -->
                <!-- First Tier Drop Down -->
    <!--            <label for="drop-2" class="toggle">Dropdown <span class="fa fa-angle-down" aria-hidden="true"></span> </label>
                <a href="#">Dropdown <span class="fa fa-angle-down" aria-hidden="true"></span></a>
                <input type="checkbox" id="drop-2"/>
                <ul class="inner-ul">
                    <li><a href="#process">Marketing Process</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#partners">Partners</a></li>
                </ul>
                </li> -->
            </ul>
            <div class="login-icon ml-lg-2">
            <?php if($this->session->userdata('is_login') && $this->session->userdata('is_login') == 'punten' ){
                if($this->session->userdata('nama_role') == 'Alumni'){
                    echo '<a class="user" href="'.base_url().'alumni/dashboard"> Dashboard <i class="fa fa-arrow-right"></i></a>';
                }else{
                    echo '<a class="user" href="'.base_url().'admin/dashboard"> Dashboard <i class="fa fa-arrow-right"></i></a>';
                }
            }else{
                echo '<a class="user" href="#login"> Login</a>';
            }?>
            </div>
        </nav>
        <div class="clear"></div>
        <!-- //nav -->
    </div>
</header>
<!-- //header -->

<div class="banner" id="home">
    <div class="container" style=" height:100px;">
        <div class="row mb-5">
        </div>
    </div>
</div>
<!-- //banner -->

<!-- Offered Services -->
<section class="process py-5" id="event">
    <div class="container py-md-3">
        <h3 class="heading mb-5 text-center">Event Terbaru</h3>
        <div class="row process-grids">
        <?php foreach($event AS $e) : 
            if(!empty($e['tanggal_event'])){
                $tgl = DateTime::createFromFormat('Y-m-d', $e['tanggal_event'])->format('d F Y');
            }
            ?>
            <div class="col-lg-3 col-md-6 my-lg-4 w3pvt-ab position-relative">
                <div class="">
                    <img src="<?=base_url()?>assets/uploads/file_berita/<?=$e['gambar_event']?>" alt="" style="width: 100%; height: 200px;" class="img-fluid">
                </div>
                <h4 class="feed-title my-md-3 mb-3"><a href="<?=base_url()?>event/detail/<?=$e['slug']?>" class="text-dark"><?=ucwords($e['judul_event'])?></a></h4>
                <small class="text-muted mb-3"><?=ucwords($e['lokasi_event'])?> - <?=$tgl?></small>
                <p> <?php echo word_limiter($e['deskripsi_event'], 17)?></p>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Offered Services -->

<!-- copyright -->
<div class="copy-right-top border-top">
    <p class="copy-right text-center py-4">&copy; 2020. All Rights Reserved 
    </p>
</div>
<!-- //copyright -->    
    
<!-- move top -->
<div class="move-top text-right">
    <a href="#home" class="move-top"> 
        <span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
    </a>
</div>
<!-- move top -->

<!-- popup for login -->
<div id="login" class="popup-effect">
    <div class="popup">
        <div class="login px-sm-4 mx-auto mw-100">
            <h5 class="text-center mb-4">Login Sistem</h5>
            <form action="<?=base_url('alumni/auth')?>" method="post">
                <div class="form-group">
                    <label class="mb-2">Alamat Email / NISN</label>
                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email atau NISN" required="">
                    <small id="emailHelp" class="form-text text-muted">Kami tidak akan membagikan alamat email anda.</small>
                </div>
                <div class="form-group">
                    <label class="mb-2">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-block submit mt-5">Login</button>
                <!-- <p class="text-center mt-2">
                    <a href="#popup4"> Registrasi Jika Belum Mempunyai Akun!</a>
                </p> -->
            </form>
        </div>

        <a class="close" href="#">&times;</a>
    </div>
</div>
<!-- //popup for login -->

<?php $this->load->view('templates/cdn_admin'); ?>

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