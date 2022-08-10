<?= $this->extend('./layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
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
    <!-- submit lembaga -->
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title text-info"><i class="ti-book mr-15"></i> Struktural Lembaga</h4>
                </div>
                <form novalidate class="form" action="<?= base_url('/KelembagaanAnggaran/save_struktural_lembaga') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-write mr-15"></i> Submit Struktural Lembaga Tingkat <?= $jenis_lembaga?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lembaga</label>
                                        <div class="controls">
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="nama_lembaga" placeholder="Nama Lembaga" required>
                                            <input type="hidden" class="form-control" name="tingkat_lembaga" value="<?= $tingkat_lembaga ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-rounded btn-warning btn-outline mr-1">
                            <i class="ti-trash"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>

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
<?= $this->endSection(); ?>