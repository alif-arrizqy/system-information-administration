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

<?= $this->endSection(); ?>