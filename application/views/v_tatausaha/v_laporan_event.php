<!DOCTYPE html>
<html>
<head>
  <title>Rekap Lowongan Bulan <?=date('F')?></title>
  <style type="text/css">
    .table-me{
      font-size: 14px;
      width: 100%;
      text-align: center;
    }

    .table-me thead{
      border-bottom: 2px solid #000; 
      margin-bottom: 5px;
    }

    .header .header-text{
      text-align: center;
    }

    .header .header-text small{
      font-size: 12px;
      color: #333 ;
    }

    .table-me tbody{
      border-bottom: 2px solid #eaeaea !important;
    }
  </style>
</head>
<body>
  <div id="outtable">
    <div class="header">
      <table border="0" width="100%">
        <tr>
          <td width="10">
            <div class="header-img">
              <img style="width: 100px; height: 100px; border-radius: 5px;" src="/opt/lampp/htdocs/project_alumni/assets/img/nopreview.png">
            </div>
          </td>
          <td width="100%">
            <div class="header-text">
              <h2>Rekap Event<br> SMK Pancasila 7 Pracimantoro</h2>
              <small>Godang, Pracimantoro, Pracimantoro, Kec. Pracimantoro Kab. Wonogiri</small>
            </div>
          </td>
        </tr>
      </table>
    </div>
      
      <!-- <p>SMK Muhammadiyah Mlati <span style="margin-left: 270px;">No.Pendaftaran : </span></p> -->
      <hr>
      <div style="overflow-x:auto;">
      <table class="table-me" border="0" cellpadding="3">
        <thead>
          <tr>
            <th style="width: 3%">No</th>
            <th>Nama Acara</th>
            <th>Lokasi Acara</th>
            <th>Tanggal & Waktu</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($event)){
            $no = 1;
            foreach($event AS $e) :  
                $tgl = DateTime::createFromFormat('Y-m-d', $e['tanggal_event'])->format('d F Y');       
          ?>
          <tr>
            <td><?=$no++?></td>
            <td><?= ucwords($e['judul_event'])?></td>
            <td><?= ucwords($e['lokasi_event'])?></td>
            <td><?=$tgl?> Pukul <?=$e['waktu_event']?></td>
          </tr>
            <?php 
                endforeach;
            }else{ ?>
            <tr>
                <td colspan="8" style="text-align: center; margin-top: 50px; margin-bottom: 50px;">--- Belum Ada Data ---</td>
            </tr>
           <?php }
            ?>
        </tbody>   
      </table>
    </div>
   </div>
</body>
</html>