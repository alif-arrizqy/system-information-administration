<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<?php
	foreach($get_pagu as $rs) {
		$pagu = $rs['pagu_anggaran'];
	}

	foreach($sum_realisasi as $rs) {
		$realisasi = $rs;
	}

	try {
		$persen_capaian = ($realisasi / $pagu) * 100;
	} catch (\Throwable $th) {
		$persen_capaian = 0;
	}
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
				<!-- alert -->
				<?php if (session()->getFlashdata('success')) { ?>
					<div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>
				<?php } ?>
				<?php if (session()->getFlashdata('error')) { ?>
					<div class="swal" data-swal-error="<?= session()->getFlashdata('error') ?>"></div>
				<?php } ?>
				<div class="box-header with-border">
					<h3 class="box-title">Realisasi Hasil Kegiatan</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Lembaga</center></th>
									<th><center>Pagu Anggaran</center></th>
									<th><center>Realisasi Anggaran</center></th>
									<th><center>Persen Capaian (%)</center></th>
									<th><center>Detail</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($get_anggaran as $rs) {
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?= $rs['nama_lembaga'] ?></center></td>
									<td><center>Rp<?= number_format($rs['pagu_anggaran']) ?></center></td>
									<?php
										$db      = \Config\Database::connect();
										$query = $db->query("SELECT SUM(realisasi_anggaran) AS realisasi_anggaran FROM laporan_kegiatan WHERE id_lembaga = '$rs[id_lembaga]'");
										foreach ($query->getRowArray() as $hs) {
											$col_persen_capaian = ($hs / $rs['pagu_anggaran']) * 100;
									?>
									<td><center>Rp<?= number_format($hs) ?></center></td>
									<td><center><?= round($col_persen_capaian) ?>%</center></td>
									<td><center>
										<span class='label label-primary'>
											<a href="<?= base_url('/detail_realisasi_kegiatan/'.$rs['id_lembaga'])?>" style='color:white'>
												<i class='fa fa-eye'></i>
											</a>
										</span>
									</center></td>
								</tr>
								<?php }}?>
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