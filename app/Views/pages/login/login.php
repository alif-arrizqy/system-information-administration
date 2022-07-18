<?= $this->extend('./layout_login/template'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="row justify-content-center no-gutters">
        <div class="col-lg-5 col-md-5 col-12">
            <div class="bg-white rounded30 shadow-lg">
                <div class="content-top-agile p-20 pb-0">
                    <h2 class="text-primary">Sistem Informasi</h2>
                    <p class="mb-0">Direktur Kemahasiswaan Universitas Pakuan</p>							
                </div>
                <div class="p-40">
                    <!-- alert -->
                    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                        <div class="alert alert-warning">
                            <?php echo session()->getFlashdata('gagal') ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('sukses') ?>
                        </div>
                    <?php } ?>
                    <form action="<?= base_url('Login/cek_login') ?>" method="post">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control pl-15 bg-transparent" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                </div>
                                <input type="password" class="form-control pl-15 bg-transparent" name="password" placeholder="Password">
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-6">
                                <div class="checkbox">
                                <input type="checkbox" id="basic_checkbox_1" >
                                <label for="basic_checkbox_1">Remember Me</label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <!-- <div class="col-6">
                                <div class="fog-pwd text-right">
                                <a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
                                </div>
                            </div> -->
                            <!-- /.col -->
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
                            </div>
                            <!-- /.col -->
                            </div>
                    </form>	
                    <div class="text-center">
                        <p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ml-5">Sign Up</a></p>
                    </div>	
                </div>						
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>