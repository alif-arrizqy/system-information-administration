<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Form Submit Proposal</h4>
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
                <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('gagal') ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('sukses') ?>
                        </div>
                <?php } ?>
                <form novalidate class="form" action="<?= base_url('/Main/save_proposal') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Submit Proposal</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Judul Kegiatan</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="judul" placeholder="Judul Kegiatan" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control" placeholder="Nama Instansi" value="<?= $nama_lembaga?>" readonly>
                            <input type="hidden" class="form-control" name="id_lembaga" placeholder="Nama Instansi" value="<?= $id_lembaga?>">
                        </div>
                        <div class="form-group">
                            <label>pengajuan Anggaran</label>
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
                            <i class="ti-trash"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<?= $this->endSection(); ?>