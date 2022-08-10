<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?php 
        if ($tingkat_lembaga == 1){
            $jenis_lembaga = "Universitas";
        } else if ($tingkat_lembaga == 2){
            $jenis_lembaga = "UKM";
        } else if ($tingkat_lembaga == 3){
            $jenis_lembaga = "Fakultas";
        } else if ($tingkat_lembaga == 4){
            $jenis_lembaga = "Program Studi";
        }
    ?>
    <!-- alert -->
    <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('sukses') ?>
        </div>
    <?php } ?>
    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
        <div class="alert alert-danger">
            <?php echo session()->getFlashdata('gagal') ?>
        </div>
    <?php } ?>
    <!-- submit lembaga -->
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Lembaga dan Anggaran</h4>
                </div>
                <form novalidate class="form" action="<?= base_url('/KelembagaanAnggaran/save_lembaga') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-write mr-15"></i> Submit Lembaga Tingkat <?= $jenis_lembaga?></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Lembaga</label>
                                        <div class="controls">
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="nama_lembaga" placeholder="Nama Lembaga" required>
                                            <input type="hidden" class="form-control" name="tingkat_lembaga" value="<?= $tingkat_lembaga ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($tingkat_lembaga == 1 or $tingkat_lembaga == 2) { ?>
                                        <label for="wLocation1"> Fakultas (Opsional) : </label>
                                        <select class="form-control select2" id="wLocation1" disabled="disabled" name="fakultas" style="width: 100%;">
                                            <option selected value="">Pilih Fakultas</option>
                                            <?php foreach($get_fakultas as $rs) { ?>
                                            <option value="<?= $rs['id_fakultas'] ?>"><?= $rs['nama_fakultas'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <label for="wLocation1"> Fakultas (Opsional) : </label>
                                        <select class="form-control select2" id="wLocation1" name="fakultas" style="width: 100%;">
                                            <option selected value="">Pilih Fakultas</option>
                                            <?php foreach($get_fakultas as $rs) { ?>
                                            <option value="<?= $rs['id_fakultas'] ?>"><?= $rs['nama_fakultas'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($tingkat_lembaga == 1 or $tingkat_lembaga == 2 or $tingkat_lembaga == 3) { ?>
                                        <label for="wLocation1"> Program Studi (Opsional) : </label>
                                        <select class="form-control select2" id="wLocation1" disabled="disabled" name="prodi" style="width: 100%;">
                                            <option selected value="">Pilih Program Studi</option>
                                            <?php foreach($get_prodi as $rs) { ?>
                                            <option value="<?= $rs['id_prodi'] ?>"><?= $rs['nama_prodi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <label for="wLocation1"> Program Studi (Opsional) : </label>
                                        <select class="form-control select2" id="wLocation1" name="prodi" style="width: 100%;">
                                            <option selected value="">Pilih Program Studi</option>
                                            <?php foreach($get_prodi as $rs) { ?>
                                            <option value="<?= $rs['id_prodi'] ?>"><?= $rs['nama_prodi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-rounded btn-warning btn-outline mr-1">
                            <i class="ti-trash"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>

    <!-- submit anggaran -->
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <form novalidate class="form" action="<?= base_url('/KelembagaanAnggaran/add_anggaran') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-write mr-15"></i> Submit Anggaran</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="behName3">Lembaga :</label>
                                    <div class="controls">
                                        <select class="form-control select2" required id="behName3" name="id_lembaga" style="width: 100%;">
                                            <?php foreach($get_no_anggaran as $rs) {?>
                                                <option value="<?= $rs['id_lembaga'] ?>"><?= $rs['nama_lembaga'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Anggaran :</label>
                                    <div class="controls">
                                        <div class="input-group"> <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control" name="anggaran" placeholder="Anggaran Lembaga" required onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                        <input type="hidden" class="form-control" name="tingkat_lembaga" value="<?= $tingkat_lembaga ?>">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-rounded btn-warning btn-outline mr-1">
                            <i class="ti-trash"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<?= $this->endSection(); ?>