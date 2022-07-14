<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Data Pengajuan Proposal</h3>
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
									<th>Pengajuan Anggaran</th>
									<th>Anggaran Diterima</th>
									<th>File</th>
									<th>Status</th>
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
									<td>proposal.pdf</td>
									<td>Approve</td>
									<td>
										<center>
											<button type="button" class="btn btn-primary" title="Approve Data" data-toggle="modal" data-target="#approveModal">
                                                <i class="fa fa-receipt"></i>
											</button>
										</center>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>ITC 2020</td>
									<td>Himakom</td>
									<td>Rp 50.000.000</td>
									<td>Rp 0</td>
									<td>proposal.pdf</td>
									<td>Pending</td>
									<td>
										<center>
                                            <button type="button" class="btn btn-primary" title="Approve Data" data-toggle="modal" data-target="#approveModal">
												<i class="fa fa-receipt"></i>
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

<!-- Modal Approve -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Approve Proposal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form class="form">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-pencil-alt2 mr-15"></i> Approve Proposal</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Judul Kegiatan</label>
                            <input type="text" readonly class="form-control" placeholder="Judul Kegiatan">
                        </div>
                        <div class="form-group">
                            <label>Pengajuan Anggaran</label>
							<input type="text" readonly class="form-control" name="pengajuan_anggaran" placeholder="Anggaran yang di ajukan">
                        </div>
                        <div class="form-group">
                            <label>Anggaran Di Berikan</label>
							<input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Anggaran yang di ajukan" onKeyPress="return numbersonly(this, event)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                        <div class="form-group">
                            <label>Approve Status</label>
                            <select class="form-control">
                            <option>Approve</option>
                            <option>Pending</option>
                            <option>Rejected</option>
                            </select>
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