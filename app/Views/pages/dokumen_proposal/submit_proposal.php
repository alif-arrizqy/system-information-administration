<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Submit Proposal</h4>
                </div>
                <!-- /.box-header -->
                <?php
                foreach ($get_lembaga->getResult() as $rs){
                    $id_lembaga = $rs->id_lembaga;
                    $nama_lembaga = $rs->nama_lembaga;
                    $tingkat_lembaga = $rs->tingkat_lembaga;
                }
                ?>
                <!-- alert -->
				<?php if (session()->getFlashdata('error')) { ?>
                    <div class="swal" data-swal-error="<?= session()->getFlashdata('error') ?>"></div>
				<?php } ?>

                <!-- cek 100% capaian -->
                <?php
                    foreach($get_pagu as $rs) {
                        $pagu = $rs['pagu_anggaran'];
                    }
                    foreach($sum_realisasi as $rs) {
                        $realisasi = $rs;
                    }
                    $persen_capaian = ($realisasi / $pagu) * 100;
                    if ($persen_capaian == 100) {
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fa fa-check"></i> Alert!</h5>
                                <?= $nama_lembaga ?> telah mencapai 100% persen capaian anggaran tahun <?= date('Y') ?>
                                <p>Silahkan ajukan proposal dengan menu Dana Subsidi </p>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>

                <form novalidate class="form" action="<?= base_url('/Proposal/save_proposal') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-flag mr-15"></i> Identitas Penerima</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                    <label for="jobTitle3">Lembaga Tujuan :</label>
                                    <select class="form-control select2" required id="behName3" name="lembaga_penerima" style="width: 100%;">
                                        <option value="">Pilih Lembaga Tujuan</option>
                                        <?php foreach($get_all_lembaga as $rs) {?>
                                            <option value="<?= $rs['id_lembaga'] ?>"><?= $rs['nama_lembaga'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="behName3">Disposisi :</label>
                                    <select class="form-control select2" required id="behName3" name="lembaga_disposisi" style="width: 100%;">
                                        <option value="">Pilih Lembaga Disposisi</option>
                                        <?php foreach($get_all_lembaga as $rs) {?>
                                            <option value="<?= $rs['id_lembaga'] ?>"><?= $rs['nama_lembaga'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                        <label for="behName3">Mengetahui :</label>
                                        <select class="form-control select2" required id="behName3" name="lembaga_mengetahui" style="width: 100%;">
                                            <option value="">Pilih Lembaga</option>
                                            <?php foreach($get_all_lembaga as $rs) {?>
                                                <option value="<?= $rs['id_lembaga'] ?>"><?= $rs['nama_lembaga'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-15">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Proposal Data</h4>
                        <div class="form-group">
                            <label>Judul Kegiatan</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="judul" placeholder="Judul Kegiatan" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lembaga</label>
                            <input type="text" class="form-control" placeholder="Nama Lembaga" value="<?= $nama_lembaga?>" readonly>
                            <input type="hidden" class="form-control" name="id_lembaga" value="<?= $id_lembaga?>">
                        </div>
                        <div class="form-group">
                            <label>Pengajuan Anggaran</label>
                            <div class="controls">
                                <div class="input-group"> <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Anggaran yang di ajukan" required onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload Proposal</label>
                            <div class="controls">
                                <label class="file">
                                    <input type="file" id="file" name="file">
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
                            <i class="ti-trash"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Simpan
                        </button>
                    </div>
                </form>
                <?php } ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<?= $this->endSection(); ?>