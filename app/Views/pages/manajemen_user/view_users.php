<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <?php
        foreach($get_profile as $as) {
            $id_user = $as['id_user'];
            $fullname = $as['fullname'];
            $username = $as['username'];
            $status = $as['status'];
            $img = $as['foto'];

            if ($img) {
                $foto = 'public/uploads/images/'.$img;
            } else {
                $foto = 'public/assets/images/avatar/avatar-13.png';
            }

            if($status == 0) {
                $status = 'Super Admin';
            } else if ($status == 1) {
                $status = 'User';
            } else if ($status == 3 || $status == 4) {
                $status = 'Guest';
            }

            $db = \Config\Database::connect();
            $query = $db->query("SELECT nama_lembaga FROM lembaga WHERE id_lembaga = '$as[id_lembaga]'");
            foreach($query->getResultArray() as $qr) {
                $nama_lembaga = $qr['nama_lembaga'];
                $nama_lembaga = str_replace('_', ' ', $nama_lembaga);
            }
        }
        ?>
        <!-- alert -->
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="swal" data-swal-error="<?= session()->getFlashdata('error') ?>"></div>
        <?php } ?>
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-black" style="background: url(<?= base_url('public/assets/images/bg/bg.jpg') ?>) center center;" alt="background img">
                    <h3 class="widget-user-username">
                        <?= $fullname; ?>
                        <button type="button" class="btn btn-secondary btn-sm" title="Edit Data" data-toggle="modal" data-target="#editModal<?=$as['id_user']?>">
                        <i class="fa fa-edit"></i>
                        </button>
                    </h3>
                    <h6 class="widget-user-desc"><?= $status; ?></h6>
                </div>
                <div class="widget-user-image">
                    <img class="rounded-circle" src="<?= base_url($foto) ?>" data-holder-rendered="true" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row mt-30">
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header"><?= $username; ?></h5>
                            <span class="description-text">USERNAME</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 br-1 bl-1">
                            <div class="description-block">
                            <h5 class="description-header"><?= $nama_lembaga; ?></h5>
                            <span class="description-text">LEMBAGA</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header"><?= $status; ?></h5>
                            <span class="description-text">ROLE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Edit -->
<?php foreach($get_profile as $rs) {
?>
<div class="modal fade" id="editModal<?=$rs['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form novalidate class="form" action="<?= base_url('/Users/update_profile/'.$rs['id_user']) ?>" method="post" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="box-body">
						<h4 class="box-title text-info"><i class="ti-book mr-15"></i> Edit Users</h4>
						<hr class="my-15">
						<div class="form-group">
							<label>Fullname</label>
							<div class="input-group">
								<input type="text" class="form-control" name="fullname" placeholder="Fullname" value="<?= $rs['fullname'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Username</label>
							<div class="input-group">
								<input type="text" class="form-control" name="username" placeholder="Username" value="<?= $rs['username'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Password</label>
							<div class="input-group">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<input type="hidden" class="form-control" name="passwordHidden" placeholder="Password" value="<?= $rs['password'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Upload Foto</label>
							<div class="controls">
								<label class="file">
									<input type="file" id="file" name="file">
									<input type="hidden" name="file_lama" value="<?= $rs['foto'] ?>">
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>
<?= $this->endSection(); ?>
