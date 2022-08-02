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
					<h3 class="box-title">Data Surat Masuk</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Nomor Surat</center></th>
									<th><center>Tanggal Surat</center></th>
									<th><center>Nama Pengirim</center></th>
									<th><center>Instansi</center></th>
									<th><center>Status</center></th>
									<th><center>File</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($surat_masuk as $rs) {
									if ($rs['status'] == 0){
										// $status_surat = "<span class='label label-warning'>unread</span>";
										$status_surat = "<span class='label label-warning'>
											<a href='".base_url('/Main/status_baca/'.$rs['id_surat'])."' style='color:white'>unread</a>
											</span>";
									} else if ($rs['status'] == 1){
										$status_surat = "<span class='label label-primary'>read</span>";
									}

								$db = \Config\Database::connect();
								$query = $db->query("SELECT nama_lembaga FROM lembaga WHERE id_lembaga = '$rs[id_lembaga]'");
								foreach($query->getResultArray() as $qr) {
									$nama_lembaga = $qr['nama_lembaga'];
								}
								?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><center><?=$rs['no_surat']?></center></td>
									<td><center><?=$rs['tanggal_surat']?></center></td>
									<td><center><?=$rs['nama_pengirim']?></center></td>
									<td><center><?=$nama_lembaga?></center></td>
									<td><center><?=$status_surat?></center></td>
									<td><center>
										<a href="<?= base_url('Main/download_surat/'.$rs['id_surat']) ?>">
											<img src="<?= base_url('public/assets/images/pdf.png') ?>" class="avatar avatar-lg" alt="<?= $rs['file'] ?>">
										</a>
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
<?= $this->endSection(); ?>