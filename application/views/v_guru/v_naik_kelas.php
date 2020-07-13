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
                          <li class="breadcrumb-item active"><?= ucwords($title) ?></li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i>Data Siswa Pada Kelas</h3> <br>
                              <small>Pilih siswa dibawah ini untuk naik kelas</small>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                        <form action="<?=base_url()?>guru_kelas/naik_kelas/proses" method="post">
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">Pilih</th>
                                 <th class="text-nowrap">Nama</th>
                                 <th class="text-nowrap">NISN</th>
                                 <th class="text-nowrap">Jenis Kelamin</th>
                                 <th class="text-nowrap">Keterangan</th>
                               </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $no = 0;
                                    foreach($siswa AS $s) :

                                        switch($s['gender']){
                                            case 'L':
                                                $gender = 'Laki - Laki';
                                            break;

                                            case 'P':
                                                $gender = 'Perempuan';
                                            break;
                                        }

                                        if($s['lulus'] == 'lulus'){
                                            $label = '<label class="btn btn-sm btn-success"> Naik Kelas</label>';
                                            $disabel = '';
                                        }else{
                                            $disabel = 'disabled';
                                            $label = '<label class="btn btn-sm btn-warning"> Masih Ada Nilai Yang Kurang</label>';
                                        }
                                 ?>
                                <tr>
                                  <td><input type="checkbox" class="form-control" name="naik[]" id="siswa<?=$no?>" value="<?=$s['nisn']?>" style="width: 20px;" <?=$disabel?>></td>
                                  <td><?=ucwords($s['nama'])?></td>
                                  <td><?=$s['nisn']?></td>
                                  <td><?=$gender?></td>
                                  <td><?=$label?></td>
                                </tr>
                                <?php
                                endforeach;
                                ?>
                             </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <hr>
                              <label for="kelas">Pilih Kelas</label>
                              <select name="kelas" id="" class="form-control select2bs4" data-placeholder="Pilih kelas untuk kenaikan">
                                  <option></option>
                                  <?php
                                foreach($kelas AS $k) :
                                  ?>
                                  <option value="<?=$k['id_kelas']?>"><?=ucwords($k['nama_kelas'])?></option>
                                  <?php
                                  endforeach;
                                  ?>
                              </select>
                              <button name="simpan" type="submit" class="btn btn-primary mt-4 float-right">Simpan</button>
                          </div>
                         </div>
                        </form>
                      <!-- /.card -->
                  </div>
              </div>
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