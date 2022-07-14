<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Data Laporan Hasil Kegiatan</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th>No</th>
									<th>Judul Kegiatan</th>
									<th>Instansi</th>
									<th>Anggaran Diterima</th>
									<th>Realisasi Anggaran</th>
									<th>File</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>ITC 2019</td>
									<td>Himakom</td>
									<td>Rp 50.000.000</td>
									<td>Rp 50.000.000</td>
									<td>laporan lomba.pdf</td>
									<td>
										<center>
											<button type="button" class="btn btn-warning" title="Hapus Data" data-toggle="modal" data-target="#hapusModal">
												<i class="fa fa-trash"></i>
											</button>
											<button type="button" class="btn btn-success" title="Edit Data" data-toggle="modal" data-target="#editModal">
												<i class="fa fa-edit"></i>
											</button>
										</center>
									</td>
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

<!-- Modal Delete -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Hapus Data Terpilih ? </p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-danger">Hapus</button>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Laporan Hasil Kegiatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form class="form">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Edit Laporan Hasil Kegiatan</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Judul Kegiatan</label>
                            <input type="text" class="form-control" name="judul" placeholder="Judul Kegiatan">
                        </div>
                        <div class="form-group">
                            <label>Anggaran Diterima</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Anggaran yang di ajukan" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                        <div class="form-group">
                            <label>Realisasi Anggaran</label>
                            <input type="text" class="form-control" name="realisasi_anggaran" placeholder="Anggaran yang sudah digunakan" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                        <div class="form-group">
                            <label>Upload Laporan</label>
                            <label class="file">
                                <input type="file" id="file">
                            </label>
                        </div>
                    </div>
                </form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-success">Simpan</button>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>