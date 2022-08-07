<?= $this->extend('../layout/template'); ?>
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
			<div class="box">
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
			</div>
		</div>
		<div class="col-xl-4">
			<div class="box">
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
			</div>
		</div>
		<div class="col-xl-4">
			<div class="box">
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
			</div>
		</div>

		<div class="col-lg-12 col-12">
			<div class="box">
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
<?= $this->endSection(); ?>