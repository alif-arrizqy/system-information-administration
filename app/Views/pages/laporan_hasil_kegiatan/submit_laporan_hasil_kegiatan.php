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
                            <form>
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="wLocation1"> Proposal Kegiatan : </label>
                                        <select class="form-control select2" required id="wLocation1" name="jenis_surat" style="width: 100%;">
                                            <option value="0">Surat Undangan</option>
                                            <option value="1">Surat Tugas</option>
                                            <option value="2">Surat Keputusan</option>
                                            <option value="3">Surat Permohonan</option>
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-primary mb-5">
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
                <form novalidate class="form" action="<?= base_url('#') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Proposal Info</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Judul Kegiatan</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="judul" value="Judul" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pengajuan Anggaran</label>
                                        <div class="controls">
                                            <div class="input-group"> <span class="input-group-addon">Rp</span>
                                            <input type="text" class="form-control" name="pengajuan_anggaran" value="<?= number_format('10000000')?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Lembaga</label>
                                    <input type="text" class="form-control" placeholder="Nama Lembaga" value="<?= $nama_lembaga?>" readonly>
                                    <input type="hidden" class="form-control" name="id_lembaga" value="<?= $id_lembaga?>">
                                </div>
                                <div class="form-group">
                                    <label>Anggaran Diterima</label>
                                        <div class="controls">
                                            <div class="input-group"> <span class="input-group-addon">Rp</span>
                                            <input type="text" class="form-control" name="pengajuan_anggaran" value="<?= number_format('10000000')?>" readonly>
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
                                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Anggaran yang di ajukan" required onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
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