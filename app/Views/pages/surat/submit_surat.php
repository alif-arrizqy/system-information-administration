<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-email mr-15"></i> Submit Surat</h4>
                </div>
                <!-- /.box-header -->
                <?php
                foreach ($get_lembaga->getResult() as $rs){
                    $id_lembaga = $rs->id_lembaga;
                    $nama_lembaga = $rs->nama_lembaga;
                    $tingkat_lembaga = $rs->tingkat_lembaga;
                }
                ?>
                <form novalidate class="form" action="<?= base_url('/Surat/save_surat') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Identitas Surat</h4>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                <label>Nomor Surat</label>
                                <input type="text" class="form-control" required name="no_surat" placeholder="Nomor Surat">
                                <input type="hidden" class="form-control" name="id_lembaga" value="<?= $id_lembaga?>">
                            </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <div class="controls">
                                    <label>Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tgl_surat" required placeholder="Tanggal Surat">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="wLocation1"> Jenis Surat : <span class="danger">*</span> </label>
                                    <select class="form-control select2" required id="wLocation1" name="jenis_surat" style="width: 100%;">
                                        <option value="0">Surat Undangan</option>
                                        <option value="1">Surat Tugas</option>
                                        <option value="2">Surat Keputusan</option>
                                        <option value="3">Surat Permohonan</option>
                                    </select>
                                </div>    
                            </div>    
                            </div>
                        </div>
                        <hr class="my-15">
                        <h4 class="box-title text-info"><i class="ti-save mr-15"></i> Identitas Penerima</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                    <label for="jobTitle3">Nama Penerima :</label>
                                    <input type="text" class="form-control" required id="jobTitle3" placeholder="Nama Penerima" name="nama_penerima">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                    <div class="controls">
                                        <label for="behName3">Lembaga Penerima :</label>
                                        <select class="form-control select2" required id="behName3" name="lembaga_penerima" style="width: 100%;">
                                            <?php foreach($get_all_lembaga as $rs) {?>
                                                <option value="<?= $rs['id_lembaga'] ?>"><?= $rs['nama_lembaga'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-15">
                        <h4 class="box-title text-info"><i class="ti-save mr-15"></i> Identitas Pengirim</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <div class="controls">
                                    <label for="wint1">Nama Pengirim :</label>
                                    <input type="text" class="form-control" required id="wint1" placeholder="Nama Pengirim" name="nama_pengirim">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <div class="controls">
                                    <label for="wjobTitle4">Jabatan Pengirim :</label>
                                    <input type="text" class="form-control" required id="wjobTitle4" name="jabatan">
                                </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-15">
                        <h4 class="box-title text-info"><i class="ti-save mr-15"></i> Submit Surat</h4>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Upload Surat</label>
                                    <div class="col-lg-10">
                                        <div class="custom-file">
                                            <label class="file">
                                                <input type="file" required id="file" name="file">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="shortDescription3">Perihal :</label>
                                <textarea name="perihal" id="shortDescription3" rows="6" class="form-control"></textarea>
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