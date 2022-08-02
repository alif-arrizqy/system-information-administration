<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>
<?php
	foreach($get_pagu as $rs) {
		$pagu = $rs['pagu_anggaran'];
	}

	foreach($sum_realisasi as $rs) {
		$realisasi = $rs;
	}

	$persen_capaian = ($realisasi / $pagu) * 100;
?>
<section class="content">
	<div class="row">
		<div class="col-xl-4">
			<a href="#" class="box">
				<div class="box-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>								
							<div class="text-dark font-weight-700 h3 mb-2 mt-5">Rp <?php echo number_format($pagu); ?></div>
							<div class="font-size-16">Total Rencana</div>
						</div>
						<div class="bg-danger-light rounded-circle h-80 w-80 text-center l-h-100">
							<span class="text-danger font-size-40 icon-Wallet1"><span class="path1"></span><span class="path2"></span></span>									
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-4">
			<a href="#" class="box">
				<div class="box-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<div class="text-dark font-weight-700 h3 mb-2 mt-5">Rp <?php echo number_format($realisasi); ?></div>
							<div class="font-size-16">Total Realisasi</div>
						</div>
						<div class="bg-warning-light rounded-circle h-80 w-80 text-center l-h-100">
							<span class="text-warning font-size-40 icon-Smile"><span class="path1"></span><span class="path2"></span></span>									
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-4">
			<a href="#" class="box">
				<div class="box-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>								
							<div class="text-dark font-weight-700 h3 mb-2 mt-5"><?= round($persen_capaian) ?> %</div>
							<div class="font-size-16">Persen Capaian</div>
						</div>
						<div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
							<span class="text-success font-size-40 icon-Bottle"><span class="path1"></span><span class="path2"></span></span>								
						</div>
					</div>
				</div>
			</a>
		</div>

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
					<h3 class="box-title">Data Laporan Hasil Kegiatan</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Judul Proposal</center></th>
									<th><center>Pengajuan Anggaran</center></th>
									<th><center>Anggaran Diterima</center></th>
									<th><center>Realisasi Anggaran</center></th>
									<th><center>File</center></th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($get_laporan as $rs) {
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?= $rs['judul_kegiatan'] ?></center></td>
									<td><center>Rp<?= number_format($rs['pengajuan_anggaran']) ?></center></td>
									<td><center>Rp<?= number_format($rs['anggaran_diterima']) ?></center></td>
									<td><center>Rp<?= number_format($rs['realisasi_anggaran']) ?></center></td>
									<td><center>
										<a href="<?= base_url('LaporanKegiatan/download_laporan_kegiatan/'.$rs['id_laporan_keg']) ?>">
											<img src="<?= base_url('public/assets/images/pdf.png') ?>" class="avatar avatar-lg">
										</a>
									</center></td>
									<td>
										<center>
											<button type="button" class="btn btn-warning" title="Hapus Data" data-toggle="modal" data-target="#hapusModal<?=$rs['id_laporan_keg']?>">
												<i class="fa fa-trash"></i>
											</button>
											<button type="button" class="btn btn-success" title="Edit Data" data-toggle="modal" data-target="#editModal<?=$rs['id_laporan_keg']?>">
												<i class="fa fa-edit"></i>
											</button>
										</center>
									</td>
								</tr>
								<?php }?>
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
<?php foreach($get_laporan as $rs) { ?>
<div class="modal fade" id="hapusModal<?=$rs['id_laporan_keg']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('/LaporanKegiatan/delete_laporan_keg' . '/' . $rs['id_laporan_keg']) ?>
			<div class="modal-body">
				<p>Hapus Data Terpilih ? </p>
				<input type="hidden" name="file" value="<?= $rs['files'] ?>">
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
<?php foreach($get_laporan as $rs) { ?>
<div class="modal fade" id="editModal<?=$rs['id_laporan_keg']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Laporan Hasil Kegiatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form novalidate class="form" action="<?= base_url('/LaporanKegiatan/edit_laporan_keg') ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
				<div class="modal-body">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Edit Laporan Hasil Kegiatan</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Realisasi Anggaran</label>
							<div class="controls">
								<div class="input-group"> <span class="input-group-addon">Rp</span>
								<input type="text" class="form-control" name="realisasi_anggaran" required value="<?= number_format($rs['realisasi_anggaran'])?>" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
								<input type="hidden" class="form-control" name="id_laporan_keg" required value="<?= $rs['id_laporan_keg']?>">
								</div>
							</div>
                        </div>
                        <div class="form-group">
                            <label>Upload Laporan</label>
                            <label class="file">
								<input type="file" id="file" name="file">
								<input type="hidden" name="file_lama" value="<?= $rs['files'] ?>">
                            </label>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php }?>
<?= $this->endSection(); ?>