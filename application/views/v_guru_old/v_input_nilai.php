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
        <div class="col-md-12">
            <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-dollar"></i> Data Siswa</h3>
            </div>
                <div class="card-body">
                <table class="table table-borderless">
                      <tr>
                        <th style="width: 15%">NISN</th>
                        <td>: <?=$siswa['nisn']?></td>
                      </tr>
                      <tr>
                        <th style="width: 15%">Nama Siswa</th>
                        <td>: <?=ucwords($siswa['nama_siswa'])?></td>
                      </tr>
                      
                      <tr>
                        <th style="width: 15%">Jenis Kelamin</th>
                        <td>: <?php if($siswa['jenis_kelamin'] == 'P'){ echo 'Prempuan';}else{echo 'Laki - Laki';}?></td>
                      </tr>
                      <tr>
                        <th style="width: 15%">Kelas</th>
                        <td>: <?=ucwords($siswa['nama_kelas'])?></td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <!-- /.row -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-default ">
            
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
              <table id="example" class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th class="text-nowrap" style="width: 5%">No</th>
                    <th class="text-nowrap" style="width: 15%">Mata Pelajaran</th>
                    <th class="text-nowrap" style="width: 15%">Nilai Tugas</th>
                    <th class="text-nowrap" style="width: 15%">Nilai UTS</th>
                    <th class="text-nowrap" style="width: 15%">Nilai UAS</th>
                    <!-- <th class="text-nowrap" style="width: 15%">Nilai Total</th> -->
                  </tr>
                </thead>
                
                <tbody class="table-peserta">
                    <form id="formNilai" method="post">
                    <input type="hidden" name="kelas" value="<?=$siswa['id_kelas']?>">
                    <input type="hidden" name="nisn" id="nisn" value="<?=$this->uri->segment(4)?>">
                    <?php
                        $no = 1;
                        foreach($mapel AS $m) :
                    ?>
                    <input type="hidden" name="kode_mapel[]" value="<?=$m['kode_mapel']?>">
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=ucwords($m['nama_mapel'])?></td>
                        <td><input type="text" name="tugas[]" class="form-control" placeholder="Nilai Tugas" required><small style="color: red;"><?php echo form_error("tugas[]")?></small></td>
                        <td><input type="text" name="uts[]" class="form-control" placeholder="Nilai UTS" required></td>
                        <td><input type="text" name="uas[]" class="form-control" placeholder="Nilai UAS" required></td>
                        <!-- <td><input type="text" name="total[]" class="form-control" placeholder="Nilai Total"></td> -->
                    </tr>
                        <?php endforeach;?>
                    
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <div class="icheck-danger">
                    <input type="checkbox" name="naik_kelas" id="naik">
                    <label for="naik" class="text-muted text-small">
                        <p>Siswa dinyatakan naik kelas</p>
                    </label>
                    </div>
                    <small class="text-muted"><span style="color:red">*</span> pilih untuk naik kelas, biarkan kosong untuk tinggal kelas</small>
                </div>
                <div class="col-md-6">
                    <button type="submit" id="simpan" class="btn btn-primary float-right">Simpan Penilain Siswa</button>
                    </form>
                </div>
            </div>
            
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div>
  </section>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/cdn_admin'); ?>

<script>
    $('#simpan').click(function(e){
        var nisn = $('#nisn').val();
        
        if($('#naik').prop('checked') == true){
            e.preventDefault();
        
            Swal.fire({
            title: 'Siswa Dinyatakan Naik Kelas',
            text: "Apakah anda yakin?",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Konfirmasi!'
            }).then(
            function(isConfirm) {
                if (isConfirm.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>guru/nilai/input/<?=$this->uri->segment(4)?>",
                    data: $('#formNilai').serialize(),
                    success: function(respone) {
                    window.location.href = "<?= base_url('guru/nilai/input/') ?><?=$this->uri->segment(4)?>";
                    },
                    error: function(request, error) {
                    window.location.href = "<?= base_url('guru/nilai/input/') ?><?=$this->uri->segment(4)?>";
                    },
                });
                } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        }else{
            e.preventDefault();
        
            Swal.fire({
            title: 'Siswa Dinyatakan Tinggal Kelas',
            text: "Apakah anda yakin?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Konfirmasi!'
            }).then(
            function(isConfirm) {
                if (isConfirm.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>guru/nilai/input/<?=$this->uri->segment(4)?>",
                    data: $('#formNilai').serialize(),
                    success: function(respone) {
                    window.location.href = "<?= base_url('guru/nilai/input/') ?><?=$this->uri->segment(4)?>";
                    },
                    error: function(request, error) {
                    window.location.href = "<?= base_url('guru/nilai/input/') ?><?=$this->uri->segment(4)?>";
                    },
                });
                } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        }
        
    })


    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
  </script>

<script>
  $(function() {
    $("#example1").DataTable({});
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
    });
  });
</script>