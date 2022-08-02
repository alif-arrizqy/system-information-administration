<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="box">
				<?php 
					if ($tingkat_lembaga == 1){
						$jenis_lembaga = "Universitas";
					} else if ($tingkat_lembaga == 2){
						$jenis_lembaga = "UKM";
					} else if ($tingkat_lembaga == 3){
						$jenis_lembaga = "Fakultas";
					} else if ($tingkat_lembaga == 4){
						$jenis_lembaga = "Program Studi";
					}
				?>
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
					<h3 class="box-title">Data Lembaga dan Anggaran <?= $jenis_lembaga ?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Nama Lembaga</center></th>
									<th><center>Pagu Anggaran</center></th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($get_pagu as $rs) {
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?= $rs['nama_lembaga'] ?></center></td>
									<td><center>Rp<?= number_format($rs['pagu_anggaran']) ?></center></td>
									<td>
										<center>
											<button type="button" class="btn btn-warning" title="Hapus Data" data-toggle="modal" data-target="#hapusModal<?=$rs['id_lembaga']?>">
												<i class="fa fa-trash"></i>
											</button>
											<button type="button" class="btn btn-success" title="Edit Data" data-toggle="modal" data-target="#editModal<?=$rs['id_lembaga']?>">
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
<?php foreach($get_pagu as $rs) { ?>
<div class="modal fade" id="hapusModal<?=$rs['id_lembaga']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('/KelembagaanAnggaran/delete_lembaga' . '/' . $rs['id_lembaga']) ?>
			<div class="modal-body">
				<p>Hapus Data Terpilih ? </p>
				<input type="hidden" name="tingkat_lembaga" value="<?= $tingkat_lembaga ?>">
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
<?php foreach($get_pagu as $rs) { ?>
<div class="modal fade" id="editModal<?=$rs['id_lembaga']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('/KelembagaanAnggaran/update_lembaga' . '/' . $rs['id_lembaga']) ?>
				<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="box-body">
						<h4 class="box-title text-info"><i class="ti-book mr-15"></i> Edit Data <?= $rs['nama_lembaga'] ?></h4>
						<hr class="my-15">
						<div class="form-group">
							<label>Nama Lembaga</label>
							<div class="controls">
								<input type="text" class="form-control" name="nama_lembaga" required value="<?= $rs['nama_lembaga'] ?>">
								<input type="hidden" class="form-control" name="id_lembaga" value="<?= $rs['id_lembaga']?>">
								<input type="hidden" name="tingkat_lembaga" value="<?= $tingkat_lembaga ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Anggaran</label>
							<div class="controls">
								<div class="input-group"> <span class="input-group-addon">Rp</span>
								<input type="text" class="form-control" name="anggaran" required value="<?= number_format($rs['pagu_anggaran'])?>" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>
<?php } ?>
<?= $this->endSection(); ?>