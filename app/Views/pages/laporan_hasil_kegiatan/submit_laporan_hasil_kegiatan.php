<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Form Submit Laporan Hasil Kegiatan</h4>
                </div>
                <!-- /.box-header -->
                <form class="form">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Submit Laporan Hasil Kegiatan</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Judul Kegiatan</label>
                            <input type="text" class="form-control" name="judul" placeholder="Judul Kegiatan">
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control" name="instansi" placeholder="Nama Instansi">
                        </div>
                        <div class="form-group">
                            <label>Anggaran Diterima</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Anggaran yang di ajukan" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                        <div class="form-group">
                            <label>Realisasi Anggaran</label>
                            <input type="text" class="form-control" name="realisasi_anggaran" placeholder="Anggaran yang sudah digunakan" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                        <div class="form-group">
                            <label>Upload Laporan</label>
                            <label class="file">
                                <input type="file" id="file">
                            </label>
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