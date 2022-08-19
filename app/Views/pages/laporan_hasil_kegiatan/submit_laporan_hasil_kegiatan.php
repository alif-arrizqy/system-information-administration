<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-search mr-15"></i> Cari Proposal Kegiatan</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- alert -->
                            <?php if (session()->getFlashdata('error')) { ?>
                                <div class="swal" data-swal-error="<?= session()->getFlashdata('error') ?>"></div>
                            <?php } ?>
                            <form class="form" action="<?= base_url('/LaporanKegiatan/submit_laporan_hasil_kegiatan') ?>" method="post">
                            <?= csrf_field(); ?>
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="wLocation1"> Proposal Kegiatan : </label>
                                        <select class="form-control select2" required id="wLocation1" name="search_kegiatan" style="width: 100%;">
                                            <option selected value="">Pilih Proposal Kegiatan</option>
                                            <?php foreach($get_kegiatan as $rs) { ?>
                                            <option value="<?= $rs['id_proposal'] ?>"><?= $rs['judul_kegiatan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="waves-effect waves-light btn btn-sm btn-primary mb-5">
                                        <i class="fa fa-search"></i> Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>					
        </div>
    </div>

    <!-- form -->
    <?php foreach ($get_proposal as $hsl){?>
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Submit Laporan Hasil Kegiatan</h4>
                </div>
                <!-- /.box-header -->
                <?php
                foreach ($get_lembaga->getResult() as $rs){
                    $id_lembaga = $rs->id_lembaga;
                    $nama_lembaga = $rs->nama_lembaga;
                    $tingkat_lembaga = $rs->tingkat_lembaga;
                }
                ?>
                <form novalidate class="form" action="<?= base_url('/LaporanKegiatan/save_laporan_hasil_kegiatan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Proposal Info</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Judul Kegiatan</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="judul" value="<?= $hsl['judul_kegiatan'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pengajuan Anggaran</label>
                                        <div class="controls">
                                            <div class="input-group"> <span class="input-group-addon">Rp</span>
                                            <input type="text" class="form-control" name="pengajuan_anggaran" value="<?= number_format($hsl['pengajuan_anggaran'])?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Lembaga</label>
                                    <input type="text" class="form-control" placeholder="Nama Lembaga" value="<?= $nama_lembaga?>" readonly>
                                    <input type="hidden" class="form-control" name="id_lembaga" value="<?= $id_lembaga ?>">
                                    <input type="hidden" class="form-control" name="id_proposal" value="<?= $hsl['id_proposal'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Anggaran Diterima</label>
                                        <div class="controls">
                                            <div class="input-group"> <span class="input-group-addon">Rp</span>
                                            <input type="text" class="form-control" name="pengajuan_anggaran" value="<?= number_format($hsl['anggaran_diterima'])?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-15">
                        <h4 class="box-title text-info"><i class="ti-write mr-15"></i> Laporan Hasil Kegiatan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Realisasi Anggaran</label>
                                        <div class="controls">
                                            <div class="input-group"> <span class="input-group-addon">Rp</span>
                                            <input type="text" class="form-control" name="realisasi_anggaran" placeholder="Realisasi Anggaran" required onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Proposal</label>
                                    <div class="controls">
                                        <label class="file">
                                            <input type="file" id="file" name="file">
                                        </label>
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
                <?php } ?>

            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<?= $this->endSection(); ?>