<div class="col-md-6">
	<div class="row">                                        
		<label class="col-md-3 col-xs-3 control-label">NAMA </label>
		<div class="col-md-9 col-xs-9">
			: <?php echo $model->nm_pd;?>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">UMUR </label>
		<div class="col-md-9 col-xs-9">
			: <?php echo $umur;?> Tahun
		</div>
	</div>
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
				echo $form->textField($modelBBM,'anak_ke',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Anak ke",'required'=>"required",'value'=>$anak_ke));
				?>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">JUMLAH SAUDARA </label>
		<div class="col-md-4 col-xs-4">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'jumlah_saudara',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Jumlah Saudra",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">NPSN </label>
		<div class="col-md-9 col-xs-9">
			: <?php echo $row['npsn'];?>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">NISN </label>
		<div class="col-md-9 col-xs-9">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nisn',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<br>
	<div class="row">																
		<div class="form-group">
			<label class="col-md-3 col-xs-3 control-label">TAHUN MASUK <a style="color:red;"><blink>*</blink></a></label>
			<div class="col-md-9 col-xs-9">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'tahun_masuk',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
			</div>
		</div>
	</div>
	<div class="row">																
		<div class="form-group">
			<label class="col-md-3 col-xs-3 control-label">LULUS TAHUN <a style="color:red;"><blink>*</blink></a></label>
			<div class="col-md-9 col-xs-9">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'tahun_keluar',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">NAMA SEKOLAH ASAL </label>
		<div class="col-md-9 col-xs-9">
			: <?php echo $row['nama_sekolah'];?>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">ALAMAT SEKOLAH </label>
		<div class="col-md-9 col-xs-9">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'alamat_sekolah',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<!--END ROW-->
</div>
<div class="col-md-6">
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">RERATA NILAI UN </label>
		<div class="col-md-3 col-xs-5">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'rata2_un',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">RERATA RAPOR </label>
		<div class="col-md-3 col-xs-5">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'rata2_raport',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<br>
	<!--END ROW-->
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">KLS XI SMTR II </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				echo $form->textField($modelBBM,'nilai_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				echo $form->textField($modelBBM,'peringkat_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<br>
	<!--END ROW-->
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">KLS XII SMTR I </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				echo $form->textField($modelBBM,'nilai_xii_i',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				echo $form->textField($modelBBM,'peringkat_xii_i',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<br>
	<!--END ROW-->
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">KLS XII SMTR II </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				echo $form->textField($modelBBM,'nilai_xii_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				echo $form->textField($modelBBM,'peringkat_xii_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
				?>
			</div>
		</div>
	</div>
	<br>
	<!--END ROW-->
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">NO TELP/HP </label>
		<div class="col-md-9 col-xs-9">
			: <?php echo $model->telepon_seluler; ?>
		</div>
	</div>
</div>