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
			: UKT <?php echo $row['kelompok_ukt'];?>
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

<div class="col-md-6">
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">NIK (No.KTP)</label>
		<div class="col-md-4 col-xs-4">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($model,'nik',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"NIK"));
				?>
			</div>
		</div>
	</div>
	
	<br>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">ANAK KE </label>
		<div class="col-md-4 col-xs-4">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				if(empty($modelBBM->anak_ke))
				{
					$anak_ke=$row['anak_ke'];
				}else{
					$anak_ke=$modelBBM->anak_ke;
				}
				
				
				echo $form->textField($modelBBM,'anak_ke',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Ke",'value'=>$anak_ke));
				?>
			</div>
		</div>
	</div>
	<br>

	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">JUMLAH SAUDARA </label>
		<div class="col-md-4 col-xs-4">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				if(empty($modelBBM->jumlah_saudara))
				{
					$jlhsaudara=$row2['ttlsaudara'];
				}else{
					$jlhsaudara=$modelBBM->jumlah_saudara;
				}
				echo $form->textField($modelBBM,'jumlah_saudara',array('size'=>2,'maxlength'=>2,'class'=>"form-control", 'required'=>'required','placeholder'=>"Jumlah Saudara",'value'=>$jlhsaudara));
				?>
			</div>
		</div>
	</div>
</div>