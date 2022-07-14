<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-xl-4">
			<a href="#" class="box">
				<div class="box-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>								
							<div class="text-dark font-weight-700 h3 mb-2 mt-5">Rp <?php echo number_format(930045221); ?></div>
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
							<div class="text-dark font-weight-700 h3 mb-2 mt-5">Rp <?php echo number_format(530045221); ?></div>
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
							<div class="text-dark font-weight-700 h3 mb-2 mt-5">80%</div>
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
				<div class="box-header with-border">
					<h3 class="box-title">Realisasi Hasil Kegiatan</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th>No</th>
									<th>Instansi</th>
									<th>Pagu Anggaran</th>
									<th>Realisasi Anggaran</th>
									<th>Persen Capaian (%)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Himafar</td>
									<td>Rp 50.000.000</td>
									<td>Rp 50.000.000</td>
									<td>100 %</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Himakom</td>
									<td>Rp 50.000.000</td>
									<td>Rp 90.000.000</td>
									<td>-40 %</td>
								</tr>
								<tr>
									<td>3</td>
									<td>BEM FMIPA</td>
									<td>Rp 40.000.000</td>
									<td>Rp 70.000.000</td>
									<td>-30 %</td>
								</tr>
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