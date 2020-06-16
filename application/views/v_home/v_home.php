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
                <li class=""><a href="#about">About</a></li>
                <li class=""><a href="#lowongan">Lowongan</a></li>
                <li class=""><a href="#event">Event</a></li>
                <li class=""><a href="#testimoni">Testimoni</a></li>
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
        
<!-- banner -->
<div class="banner" id="home">
    <div class="container">
        <div class="row banner-text">
            <div class="slider-info col-lg-6">
                <div class="banner-info-grid mt-lg-5">
                    <h2>Sistem Informasi Alumni</h2>
                    <p>Selamat datang pada website sistem informasi alumni SMK Pancasila 7 Pracimantoro.</p>
                </div>
                <a class="btn mr-2 text-capitalize" href="#popup1">read more </a>
            </div>
            <div class="col-lg-6 col-md-8 mt-lg-0 mt-sm-5 mt-3 banner-image text-lg-center">
                <img src="<?=base_url()?>assets/images/bg1.png" alt="" class="img-fluid"/>
            </div>
        </div>
    </div>
</div>
<!-- //banner -->

<!-- about -->
<section class="about py-5" id="about">
    <div class="container py-lg-5 py-sm-3">
        <div class="row">
            <div class="col-lg-3 about-left">   
                <h3 class="heading mb-lg-5 mb-4">Tentang Sekolah</h3>
            </div>
            <div class="col-lg-5 col-md-7 about-text">
                <h3>SMK Muhammadiyah 1.</h3>
                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
            </div> 
            <div class="col-lg-4 col-md-5 about-img">
                <img src="<?=base_url()?>assets/images/teacher.jpg" alt="" class="img-fluid"/>
            </div>
        </div>
    </div>
</section>
<!-- //about -->

<!-- why choose us -->
<section class="choose py-5" id="lowongan" style="background-color: #eaeaea;">
    <div class="container py-md-3">
        <h3 class="heading mb-5"> Lowongan Terbaru</h3>
        <div class="feature-grids row">
        <?php foreach($lowongan AS $l) :?>
            <div class="col-lg-3 col-sm-6 mt-sm-0 mt-4">
                <div class="f1 icon1 p-3">
                    <div class="icon">
                        <img src="<?=base_url()?>assets/uploads/file_berita/<?=$l['thumbnail']?>" alt="" style="width: 100%; height: 150px;" class="img-fluid"/>
                    </div>
                    <h3 class="mt-3"><a href="<?=base_url()?>lowongan/detail/<?=$l['slug']?>" class="text-dark"><?=ucwords($l['posisi_pekerjaan'])?></a></h3>
                    <small class="text-muted"><?=ucwords($l['perusahaan'])?> - <?=ucwords($l['penempatan'])?></small>
                    <p class="mt-3"><?php echo word_limiter($l['deskripsi'], 17)?></p>
                </div>
            </div>

        <?php endforeach; ?>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <a class="btn btn-primary mr-2 " href="<?=base_url('lowongan')?>">Lihat Semua Lowongan <span class="fa fa-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>
<!-- //why choose us -->

<!-- Offered Services -->
<section class="process py-5" id="event">
    <div class="container py-md-3">
        <h3 class="heading mb-5">Event Terbaru</h3>
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
                <h4 class="feed-title mt-3 mb-1"><a href="<?=base_url()?>event/detail/<?=$e['slug']?>" class="text-dark"><?=ucwords($e['judul_event'])?></a></h4>
                <small class="text-muted mb-5"><?=ucwords($e['lokasi_event'])?> - <?=$tgl?></small>
                <p> <?php echo word_limiter($e['deskripsi_event'], 17)?></p>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <a class="btn btn-primary mr-2 " href="<?=base_url('event')?>">Lihat Semua Event <span class="fa fa-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>
<!-- Offered Services -->

<!-- Team page -->
<!-- <section class="section pt-5" id="alumni" style="background-color: #eaeaea;">
    <div class="container py-lg-5">
        <h2 class="heading mb-sm-5 mb-4"> Alumni Kami</h2>
        <div class="section_header">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="teamy_preview">
                        <img src="<?=base_url()?>assets/images/team1.jpg" class="teamy_avatar" alt="The demo photo">
                    </div>
                    <div class="teamy_content mt-3">
                        <h3 class="teamy_name">Suzan Lois</h3>
                        <span class="teamy_post">CEO/Founder</span>
                    </div>
                    <div class="teamy_back">
                        <div class="teamy_back-inner">
                            <a href="#0" class="social"> 
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-twitter"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-envelope-open"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="teamy_preview">
                        <img src="<?=base_url()?>assets/images/team2.jpg" class="teamy_avatar" alt="The demo photo">
                    </div>
                    <div class="teamy_content mt-3">
                        <h3 class="teamy_name">Dora Caelan</h3>
                        <span class="teamy_post">Marketing Manager</span>
                    </div>
                    <div class="teamy_back">
                        <div class="teamy_back-inner">
                            <a href="#0" class="social"> 
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-twitter"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-envelope-open"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="teamy_preview">
                        <img src="<?=base_url()?>assets/images/team3.jpg" class="teamy_avatar" alt="The demo photo">
                    </div>    
                    <div class="teamy_content mt-3">
                        <h3 class="teamy_name">Rosanna</h3>
                        <span class="teamy_post">Sales Executive</span>
                    </div>
                    <div class="teamy_back">
                        <div class="teamy_back-inner">
                            <a href="#0" class="social"> 
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-twitter"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-envelope-open"></span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6 mb-5">
                    <div class="teamy_preview">
                        <img src="<?=base_url()?>assets/images/team5.jpg" class="teamy_avatar" alt="The demo photo">
                    </div>
                    <div class="teamy_content mt-3">
                        <h3 class="teamy_name">Suzan Lois</h3>
                        <span class="teamy_post">Sales Executive</span>
                    </div>
                    <div class="teamy_back">
                        <div class="teamy_back-inner">
                            <a href="#0" class="social"> 
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-twitter"></span>
                            </a>
                            <a href="#0" class="social">
                                <span class="fa fa-envelope-open"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mr-2 ">Lihat Semua Alumni <span class="fa fa-arrow-right"></span></button>
            </div>
        </div>
        </div>
    </div>
</section> -->
<!-- //Team page -->

<!-- Offered Services -->
<section class="process py-5" id="testimoni"  style="background-color: #eaeaea;">
    <div class="container py-md-3">
        <h3 class="heading mb-5">Apa Kata Alumni kami</h3>
        <div class="section_header">
        <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>   
				<!-- Wrapper for carousel items -->
				<div class="carousel-inner">
                    <?php
                    $flag = 1;
                    foreach($testimoni AS $t) :

                        if($flag == 1){
                            $class = 'active';
                        }else{
                            $class = '';
                        }
                        $flag++;
                    ?>
					<div class="item carousel-item <?=$class?>">
						<div class="row">
							<div class="col-sm-12">
								<div class="media">
									<div class="media-left d-flex mr-3">
										<a href="#">
											<img src="<?=base_url()?>assets/img/user/<?=$t['foto']?>" alt="">
										</a>
									</div>
									<div class="media-body">
										<div class="testimonial">
											<p><?=$t['testimoni']?></p>
											<p class="overview"><b><?=ucwords($t['nama'])?></b>  Alumni </p>
										</div>
									</div>
								</div>
							</div>
						</div>			
					</div>
                    <?php endforeach;?>
				</div>
			</div>
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

<!-- popup -->
<div id="popup1" class="popup-effect">
    <div class="popup">
        <img src="assets/images/banner.png" alt="Popup Image" class="img-fluid" />
        <p class="mt-4 ">Ini adalah Sistem Informasi Alumni berbasis web, dengan adanya sistem informasi ini diharapkan para user maupun pihak sekolah dapat dengan mudah melakukan pendataan / tracking alumninya. Aplikasi ini masih jauh dari kata sempurna, untuk itu masukan dan saran akan sangat kami terima. jika menemukan kejanggalan maupun kegagalan kerja aplikasi.</p>
        <a class="close" href="#">&times;</a>
    </div>
</div>
<!-- //popup -->

<!-- popup -->
<div id="popup2" class="popup-effect">
    <div class="popup">
        <iframe src="https://player.vimeo.com/video/188673754"></iframe>
        <p class="mt-4 ">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
            laudantium, totam rem aperiam, eaque ipsa quae ab illo quasi architecto beatae vitae dicta
            sunt explicabo.</p>
        <a class="close" href="#">&times;</a>
    </div>
</div>
<!-- //popup -->

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

<!-- popup for register -->
<div id="popup4" class="popup-effect">
    <div class="popup">
        <div class="login px-sm-4 mx-auto mw-100">
            <h5 class="text-center mb-4">Register Now</h5>
            <form action="#" method="post">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="" required="">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" id="validationDefault02" placeholder="" required="">
                </div>
                <div class="form-group">
                    <label class="mb-2">Password</label>
                    <input type="password" class="form-control" id="password1" placeholder="" required="">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="password2" placeholder="" required="">
                </div>

                <button type="submit" class="btn btn-primary submit">Register</button>
                <p class="text-center mt-3">
                    <a href="#">By clicking Register, I agree to your terms</a>
                </p>
            </form>
        </div>
        <a class="close" href="#">&times;</a>
    </div>
</div>
<!-- //popup for register -->

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