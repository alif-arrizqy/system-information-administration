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
					<h3 class="box-title">Detail Kegiatan Lembaga</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    <form class="col-md-4">
                        <select class="form-control js-example-basic-single" name="lembaga">
                            <option>Select</option> 
                            <option>Himakom</option> 
                            <option>Himatika</option> 
                            <option>BEM FMIPA</option> 
                            <option>BEM KBM</option> 
                            <option>BLM KBM</option> 
                        </select>
                    </form>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<?= $this->endSection(); ?>