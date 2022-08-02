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
					<h3 class="box-title">Data Proposal</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Judul Kegiatan</center></th>
									<th><center>Instansi</center></th>
									<th><center>Pengajuan Anggaran</center></th>
									<th><center>Anggaran Diterima</center></th>
									<th><center>File</center></th>
									<th><center>Status</center></th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($get_proposal as $rs) {
									if ($rs['status'] == 0){
										$approve = "<span class='label label-warning'>Pending</span>";
									} else if ($rs['status'] == 1){
										$approve = "<span class='label label-success'>Approved</span>";
									} else if ($rs['status'] == 2){
										$approve = "<span class='label label-danger'>Rejected</span>";
									}
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?= $rs['judul_kegiatan'] ?></center></td>
									<td><center><?= $rs['id_lembaga'] ?></center></td>
									<td><center>Rp<?= number_format($rs['pengajuan_anggaran']) ?></center></td>
									<td><center>Rp<?= number_format($rs['anggaran_diterima']) ?></center></td>
									<td><center>
										<a href="<?= base_url('Main/download_proposal/'.$rs['id_proposal']) ?>">
											<img src="<?= base_url('public/assets/images/pdf.png') ?>" class="avatar avatar-lg" title="<?= $rs['judul_kegiatan']?>" alt="<?= $rs['file'] ?>">
										</a>
									</center></td>
									<td><center><?= $approve ?></center></td>
									<td>
										<center>
											<button type="button" class="btn btn-warning" title="Hapus Data" data-toggle="modal" data-target="#hapusModal<?=$rs['id_proposal']?>">
												<i class="fa fa-trash"></i>
											</button>
											<button type="button" class="btn btn-success" title="Edit Data" data-toggle="modal" data-target="#editModal<?=$rs['id_proposal']?>">
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
<?php foreach($get_proposal as $rs) { ?>
<div class="modal fade" id="hapusModal<?=$rs['id_proposal']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('/Main/delete_proposal' . '/' . $rs['id_proposal']) ?>
			<div class="modal-body">
				<p>Hapus Data Terpilih ? </p>
				<input type="hidden" name="file" value="<?= $rs['file'] ?>">
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
<?php foreach($get_proposal as $rs) { ?>
<div class="modal fade" id="editModal<?=$rs['id_proposal']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form novalidate class="form" action="<?= base_url('/Main/edit_proposal') ?>" method="post" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="box-body">
						<h4 class="box-title text-info"><i class="ti-book mr-15"></i> Edit Proposal</h4>
						<hr class="my-15">
						<div class="form-group">
							<label>Judul Kegiatan</label>
							<div class="controls">
								<input type="text" class="form-control" name="judul" required value="<?= $rs['judul_kegiatan'] ?>">
								<input type="hidden" class="form-control" name="id_lembaga" value="<?= $rs['id_lembaga']?>">
								<input type="hidden" class="form-control" name="id_proposal" value="<?= $rs['id_proposal']?>">
							</div>
						</div>
						<div class="form-group">
							<label>Pengajuan Anggaran</label>
							<div class="controls">
								<div class="input-group"> <span class="input-group-addon">Rp</span>
								<input type="text" class="form-control" name="pengajuan_anggaran" required value="<?= number_format($rs['pengajuan_anggaran'])?>" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Upload Proposal</label>
							<label class="file">
								<div class="controls">
									<input type="file" id="file" name="file">
									<input type="hidden" name="file_lama" value="<?= $rs['file'] ?>">
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