<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Data Surat Masuk</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th>No</th>
									<th>Nomor Surat</th>
									<th>Tanggal Surat</th>
									<th>Nama Pengirim</th>
									<th>Jabatan</th>
									<th>Instansi</th>
									<th>Perihal</th>
									<th>File</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>27/XYZ/2019</td>
									<td>20 Juni 2022</td>
									<td>Atik Medixa</td>
									<td>Staff</td>
									<td>Dirmawa</td>
									<td>Pengajuan dana untuk ITC</td>
									<td>Surat Pengajuan Dana.pdf</td>
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