<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Submit Dana Subsidi</h4>
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
                <form novalidate class="form" action="<?= base_url('/DanaSubsidi/save_dana_subsidi') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-flag mr-15"></i> Identitas Penerima</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="controls">
                                    <label for="jobTitle3">Lembaga Tujuan :</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" value="DIRMAWA" readonly>
                                        <input type="hidden" class="form-control" name="lembaga_penerima" value="4">
                                    </div>
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
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<?= $this->endSection(); ?>