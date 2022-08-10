<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <!-- alert -->
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
                    <h4 class="box-title text-info"><i class="ti-user mr-15"></i> New Users</h4>
                </div>
                <form novalidate class="form" action="<?= base_url('/Users/save_users') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fullname</label>
                                        <div class="controls">
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="fullname" placeholder="Fullname" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Username</label>
                                        <div class="controls">
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                        <div class="controls">
                                            <div class="input-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="wLocation1"> Status user : </label>
                                        <select class="form-control select2" required id="wLocation1" name="status" style="width: 100%;">
                                            <option selected value="">Pilih Status User</option>
                                            <option value="0">Admin</option>
                                            <option value="1">User</option>
                                            <option value="2">Sub-Admin</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="wLocation1"> Lembaga User : </label>
                                        <select class="form-control select2" required id="wLocation1" name="id_lembaga" style="width: 100%;">
                                            <option selected value="">Pilih Lembaga User</option>
                                            <?php foreach($get_all_lembaga as $rs) { ?>
                                            <option value="<?= $rs['id_lembaga'] ?>"><?= $rs['nama_lembaga'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Upload Foto</label>
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
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<?= $this->endSection(); ?>