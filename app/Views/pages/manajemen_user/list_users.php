<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="box">
				<!-- alert -->
				<?php if (!empty(session()->getFlashdata('sukses'))) { ?>
					<div class="alert alert-success">
						<?php echo session()->getFlashdata('sukses') ?>
					</div>
				<?php } ?>
				<?php if (!empty(session()->getFlashdata('gagal'))) { ?>
					<div class="alert alert-danger">
						<?php echo session()->getFlashdata('gagal') ?>
					</div>
				<?php } ?>
				<div class="box-header with-border">
					<h3 class="box-title">Data Admin</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Fullname</center></th>
									<th><center>Username</center></th>
									<th><center>Status</center></th>
									<th><center>Lembaga</center></th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($get_users as $rs) {
									if ($rs['status'] == 0){
										$approve = "<span class='label label-success'>super admin</span>";
									} else if ($rs['status'] == 1){
										$approve = "<span class='label label-primary'>user</span>";
									} else if ($rs['status'] == 2){
										$approve = "<span class='label label-warning'>sub-admin</span>";
									} else if ($rs['status'] == 3 || $rs['status'] == 4){
										$approve = "<span class='label label-danger'>guest</span>";
									}
                                $db = \Config\Database::connect();
                                $query = $db->query("SELECT nama_lembaga FROM lembaga WHERE id_lembaga = '$rs[id_lembaga]'");
                                foreach($query->getResultArray() as $qr) {
                                    $nama_lembaga = $qr['nama_lembaga'];
                                }
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?= $rs['fullname'] ?></center></td>
									<td><center><?= $rs['username'] ?></center></td>
									<td><center><?= $approve ?></center></td>
									<td><center><?= $nama_lembaga ?></center></td>
									<td>
										<center>
											<button type="button" class="btn btn-warning" title="Hapus Data" data-toggle="modal" data-target="#hapusModal<?=$rs['id_user']?>">
												<i class="fa fa-trash"></i>
											</button>
											<button type="button" class="btn btn-success" title="Edit Data" data-toggle="modal" data-target="#editModal<?=$rs['id_user']?>">
												<i class="fa fa-edit"></i>
											</button>
										</center>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>

<!-- Modal Delete -->
<?php foreach($get_users as $rs) { ?>
<div class="modal fade" id="hapusModal<?=$rs['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('/Users/delete_users' . '/' . $rs['id_user']) ?>
			<div class="modal-body">
				<p>Hapus Data Terpilih ? </p>
				<input type="hidden" name="file" value="<?= $rs['foto'] ?>">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-danger">Hapus</button>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>
<?php } ?>

<!-- Modal Edit -->
<?php foreach($get_users as $rs) {
	if ($rs['status'] == 0){
		$status = 'Admin';
	} else if ($rs['status'] == 1){
		$status = 'User';
	} else if ($rs['status'] == 2){
		$status = 'Sub-Admin';
	} else if ($rs['status'] == 3){
		$status = 'Guest';
	}

	$db = \Config\Database::connect();
	$query = $db->query("SELECT nama_lembaga FROM lembaga WHERE id_lembaga = '$rs[id_lembaga]'");
	foreach($query->getResultArray() as $qr) {
		$nama_lembaga = $qr['nama_lembaga'];
	}
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
			<form novalidate class="form" action="<?= base_url('/Users/update_users/'.$rs['id_user']) ?>" method="post" enctype="multipart/form-data">
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
							<div class="controls">
								<label for="wLocation1"> Status user : </label>
								<select class="form-control select2" id="wLocation1" name="status" style="width: 100%;">
									<option selected value="<?= $rs['status'] ?>"><?= $status ?></option>
									<option value="">Pilih Status User</option>
									<option value="0">Admin</option>
									<option value="1">User</option>
									<option value="2">Sub-Admin</option>
									<option value="3">Guest</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="controls">
								<label for="wLocation1"> Lembaga User : </label>
								<select class="form-control select2" id="wLocation1" name="id_lembaga" style="width: 100%;">
									<option selected value="<?= $rs['id_lembaga'] ?>"><?= $nama_lembaga ?></option>
									<option value="">Pilih Lembaga User</option>
									<?php foreach($get_all_lembaga as $hs) { ?>
									<option value="<?= $hs['id_lembaga'] ?>"><?= $hs['nama_lembaga'] ?></option>
									<?php } ?>
								</select>
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