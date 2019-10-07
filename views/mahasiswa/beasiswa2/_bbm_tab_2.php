<div class="col-md-6">
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">PADA JALUR </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $row['nama_jalur_masuk'];?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">NO UJIAN </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $row['no_registrasi'];?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">KATEGORI UKT </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $row['jenis_tarif'];?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">NAMA </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $model->nm_pd;?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">Jenis Kelamin </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $jk;?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">Tempat/Tgl-Bln-Thn Lahir </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $model->tmpt_lahir."/".$model->tgl_lahir;?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">Agama </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $model->agama['nm_agama'];?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">NIM </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $model->id_pd;?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">JURUSAN </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $jurusan;?>
		</div>
	</div>
	<!--END ROW-->
	<div class="row">                                        
		<label class="col-md-6 col-xs-6 control-label">FAKULTAS </label>
		<div class="col-md-6 col-xs-6">
			: <?php echo $fakultas;?>
		</div>
	</div>
	<!--END ROW-->
</div>