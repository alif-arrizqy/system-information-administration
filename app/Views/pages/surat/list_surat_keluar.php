<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Data Surat Keluar</h3>
				</div>
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
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Nomor Surat</center></th>
									<th><center>Tanggal Surat</center></th>
									<th><center>Nama Penerima</center></th>
									<th><center>Lembaga Penerima</center></th>
									<th><center>Status</center></th>
									<th><center>File</center></th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($surat_keluar as $rs) {
									if ($rs['status'] == 0){
										$status_surat = "<span class='label label-warning'>unread</span>";
									} else if ($rs['status'] == 1){
										$status_surat = "<span class='label label-primary'>read</span>";
									}

								$db = \Config\Database::connect();
								$query = $db->query("SELECT nama_lembaga FROM lembaga WHERE id_lembaga = '$rs[lembaga_penerima]'");
								foreach($query->getResultArray() as $qr) {
									$nama_lembaga = $qr['nama_lembaga'];
								}
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?=$rs['no_surat']?></center></td>
									<td><center><?=$rs['tanggal_surat']?></center></td>
									<td><center><?=$rs['nama_penerima']?></center></td>
									<td><center><?=$nama_lembaga?></center></td>
									<td><center><?=$status_surat?></center></td>
									<td><center>
										<a href="<?= base_url('Main/download_surat/'.$rs['id_surat']) ?>">
											<img src="<?= base_url('public/assets/images/pdf.png') ?>" class="avatar avatar-lg" alt="<?= $rs['file'] ?>">
										</a>
										</center>
									</td>
									<td>
										<center>
											<button type="button" class="btn btn-warning" title="Hapus Data" data-toggle="modal" data-target="#hapusModal<?=$rs['id_surat']?>">
												<i class="fa fa-trash"></i>
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
<?php foreach($surat_keluar as $rs) { ?>
<div class="modal fade" id="hapusModal<?=$rs['id_surat']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('/Main/delete_surat' . '/' . $rs['id_surat']) ?>
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
<?php }?>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form class="form">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Edit Surat</h4>
                        <hr class="my-15">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="no_surat" placeholder="contoh: 27/HMS/001/2019">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="format: 01/04/2019">
                        </div>
                        <div class="form-group">
                            <label>Nama Pengirim</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Nama pengirim surat">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Jabatan pengirim surat">
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control" name="pengajuan_anggaran" placeholder="Instansi pengirim surat">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <textarea type="text" class="form-control" name="pengajuan_anggaran" placeholder="Perihal pengirim surat"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Surat</label>
                            <label class="file">
                                <input type="file" id="file" name="file">
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