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
				if(empty($modelBBM->nisn))
				{
					$nisn=$row['nis'];
				}else{
					$nisn=$modelBBM->nisn;
				}
				echo $form->textField($modelBBM,'nisn',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Nomor Induk Siswa Nasional",'value'=>$nisn));
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
						for($i=2000;$i<=date('Y');$i++){
						$thn[$i]=$i;
						}
					?>
					<?php 
						echo $form->dropDownList($modelBBM,'tahun_masuk',$thn,array('empty'=>'Pilih Tahun Masuk','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
					?>
			</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">																
		<div class="form-group">
			<label class="col-md-3 col-xs-3 control-label">LULUS TAHUN <a style="color:red;"><blink>*</blink></a></label>
			<div class="col-md-9 col-xs-9">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
						for($i=2000;$i<=date('Y');$i++){
						$thn[$i]=$i;
						}
					?>
					<?php 
						echo $form->dropDownList($modelBBM,'tahun_keluar',$thn,array('empty'=>'Pilih Tahun Lulus','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
					?>	
			</div>
			</div>
		</div>
	</div>
	<br>
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
				echo $form->textField($modelBBM,'alamat_sekolah',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Alamat Sekolah"));
				?>
			</div>
		</div>
	</div>
	<!--END ROW-->
</div>
<div class="col-md-6">
	<div class="row">
	<p> <font color="red">JIka Nilai Desimal, gunakan tanda titik</font></p>
		<label class="col-md-3 col-xs-3 control-label">RERATA NILAI UN </label>
		<div class="col-md-3 col-xs-5">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'rata2_un',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Rerata UN"));
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
				echo $form->textField($modelBBM,'rata2_raport',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Rerata Rapor"));
				?>
			</div>
		</div>
	</div>
	<br>
	<!--END ROW-->

	<div class="row">
		
		<label class="col-md-3 col-xs-3 control-label">KLS X SMTR I </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nilai_x_i',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Nilai"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				// echo $form->textField($modelBBM,'peringkat_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Peringkat"));
				?>
				<?php
					for($i=1;$i<=10;$i++)
					{
						$rank[$i]=$i;
					}
					echo $form->dropDownList($modelBBM,'peringkat_x_i',$rank,array('empty'=>'Pilih','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
				?>	
			</div>
		</div>
	</div>
	<br>
	
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">KLS X SMTR II </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nilai_x_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Nilai"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				// echo $form->textField($modelBBM,'peringkat_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Peringkat"));
				?>
				<?php
					for($i=1;$i<=10;$i++)
					{
						$rank[$i]=$i;
					}
					echo $form->dropDownList($modelBBM,'peringkat_x_ii',$rank,array('empty'=>'Pilih','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
				?>	
			</div>
		</div>
	</div>
	<br>
	
	
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">KLS XI SMTR I </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nilai_xi_i',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Nilai"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				// echo $form->textField($modelBBM,'peringkat_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Peringkat"));
				?>
				<?php
					for($i=1;$i<=10;$i++)
					{
						$rank[$i]=$i;
					}
					echo $form->dropDownList($modelBBM,'peringkat_xi_i',$rank,array('empty'=>'Pilih','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
				?>	
			</div>
		</div>
	</div>
	<br>
	
	<div class="row">
		<label class="col-md-3 col-xs-3 control-label">KLS XI SMTR II </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nilai_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Nilai"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				// echo $form->textField($modelBBM,'peringkat_xi_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Peringkat"));
				?>
				<?php
					for($i=1;$i<=10;$i++)
					{
						$rank[$i]=$i;
					}
					echo $form->dropDownList($modelBBM,'peringkat_xi_ii',$rank,array('empty'=>'Pilih','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
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
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nilai_xii_i',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Nilai"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				// echo $form->textField($modelBBM,'peringkat_xii_i',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Peringkat"));
				echo $form->dropDownList($modelBBM,'peringkat_xii_i',$rank,array('empty'=>'Pilih','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
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
				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
				<?php
				echo $form->textField($modelBBM,'nilai_xii_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Nilai"));
				?>
			</div>
		</div>
		<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
		<div class="col-md-3 col-xs-3">
			<div class="input-group">
				<?php
				// echo $form->textField($modelBBM,'peringkat_xii_ii',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'required','placeholder'=>"Masukkan Peringkat"));
				echo $form->dropDownList($modelBBM,'peringkat_xii_ii',$rank,array('empty'=>'Pilih','class'=>"form-control", 'style'=>"float:left;", 'required'=>'required')); 
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