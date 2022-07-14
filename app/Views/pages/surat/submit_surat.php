<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Form Submit Surat</h4>
                </div>
                <!-- /.box-header -->
                <form class="form">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-email mr-15"></i> Submit Surat</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="no_surat" placeholder="contoh: 27/HMS/001/2019">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="format: 01/04/2019">
                        </div>
                        <div class="form-group">
                            <label>Nama Pengirim</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Nama pengirim surat">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Jabatan pengirim surat">
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Instansi pengirim surat">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <textarea type="text" class="form-control" name="pengajuan_anggaran" placeholder="Perihal pengirim surat"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Surat</label>
                            <label class="file">
                                <input type="file" id="file" name="file">
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