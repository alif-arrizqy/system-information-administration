<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box bg-img" style="background-image: url(http://powerbi-admin-template.multipurposethemes.com/bs4/images/abstract-1.svg);background-position: right top; background-size: 30% auto;">
                <div class="box-body">
                    <?php
                        foreach($get_lembaga->getResult() as $rs) {
                            $id_lembaga = $rs->id_lembaga;
                            $nama_lembaga = $rs->nama_lembaga;
                            $nama_lembaga = str_replace('_', ' ', $nama_lembaga);
                            $tingkat_lembaga = $rs->tingkat_lembaga;
                        }

                        $id_status = session()->get('status');
                        if ($id_status == 0){
                            $status = "Admin";
                        } else {
                            $status = "User";
                        }

                        date_default_timezone_set('Asia/Jakarta');
                        $jam = date('H:i');
                        if ($jam > '06:00' && $jam < '10:00') {
                            $salam = "Selamat pagi, ";
                        } else if ($jam > '10:01' && $jam < '15:00') {
                            $salam = "Selamat Siang, ";
                        } else if ($jam > '15:01' && $jam < '18:00') {
                            $salam = 'Selamat sore, ';
                        } else {
                            $salam = 'Selamat Malam, ';
                        }
                    ?>
                    <a href="#" class="box-title font-weight-600 text-muted hover-primary font-size-18"><?= $salam . $status ." - ". $nama_lembaga ?></a>
                    <div class="font-weight-bold text-success font-size-16 mt-20 mb-10">Selamat Datang</div>
                    <p class="text-mute font-weight-500 font-size-16">
                        Silahkan pilih menu yang tersedia untuk mengakses aplikasi ini.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- /.content -->
<?= $this->endSection(); ?>