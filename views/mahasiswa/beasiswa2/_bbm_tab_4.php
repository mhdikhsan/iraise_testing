<div class="col-md-6">
	<div class="form-group row">
		<label class="col-md-3 ">Nama Ayah</label>
			<div class="col-md-9">                                            
				: <?php echo $model->nm_ayah;?>  
			</div>
	</div>
	<div class="form-group row">      
		<label class="col-md-3 ">Status Ayah</label>
		<div class="col-md-9">
			<?php echo $form->dropDownList($modelBBM,'status_ayah',CHtml::listData(BidikmisiStatusOrtu::model()->findAll(),'id_status','nama_status'),array('empty'=>'Pilih','class'=>"form-control select")); ?>
		<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Tempat Lahir</label>
			<div class="col-md-9">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'tempat_lahir_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>

	<div class="form-group row">
			<label class="col-md-3 control-label">Tanggal Lahir<a style="color:red;"><blink>*</blink></a></label>
			<div class="col-md-9 col-xs-12">
				<div class="input-group">
					: <?php echo $model->tgl_lahir_ayah;?>
				</div>
			</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Alamat</label>
			<div class="col-md-9">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'alamat_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group row">
		<label class="col-md-3 ">No Hp</label>
			<div class="col-md-9">                                               
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'no_hp_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Pendidikan Ayah </label>
		   <div class="col-md-9">
		   <div class="input-group">
			  : <?php echo $model->jenjdidikayah['nm_jenj_didik'];?>
			</div>  
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Pekerjaan Ayah </label>
			<div class="col-md-9">
			 <div class="input-group">
			  : <?php echo $model->kerjaayah['nm_pekerjaan'];?>
			</div>  
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Bekerja Sebagai</label>
			<div class="col-md-9">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'bekerja_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group row">
		<label class="col-md-3 ">Penghasilan Ayah</label>
		<div class="col-md-9">
			<div class="input-group">
			  : <?php echo $model->penghasilanayah['nm_penghasilan'];?>
			</div> 
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Jml. Tanggungan Keluarga</label>
			<div class="col-md-9">                                                
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'jumlah_tanggungan',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>

</div>
<!--END COLUMB-->
<div class="col-md-6 row">
	<div class="form-group row">
		<label class="col-md-3 ">Nama Ibu</label>
			<div class="col-md-9">                                 
				: <?php echo $model->nm_ibu_kandung;?>  
			</div>
	</div>
	<div class="form-group row">                  
		<label class="col-md-3 ">Status Ibu</label>
		<div class="col-md-9">
			<?php echo $form->dropDownList($modelBBM,'status_ibu',CHtml::listData(BidikmisiStatusOrtu::model()->findAll(),'id_status','nama_status'),array('empty'=>'Pilih','class'=>"form-control select")); ?>
		<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Tempat Lahir</label>
			<div class="col-md-9">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					<?php echo $form->textField($modelBBM,'tempat_lahir_ibu',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group row">
		<label class="col-md-3 control-label">Tanggal Lahir<a style="color:red;"><blink>*</blink></a></label>
		<div class="col-md-9 col-xs-12">
			<div class="input-group">
				: <?php echo $model->tgl_lahir_ibu;?>
			</div>  
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-3 ">No HP</label>
			<div class="col-md-9">                                                 
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'no_hp_ibu',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>

	<div class="form-group">
		<label class="col-md-3 ">Pendidikan Ibu </label>
		   <div class="col-md-9">
			<div class="input-group">
			  : <?php echo $model->jenjdidikibu['nm_jenj_didik'];?>
			</div> 
			<span class="help-block"></span>
			</div>
	</div>
		
	<div class="form-group">
		<label class="col-md-3 ">Pekerjaan Ibu</label>
			<div class="col-md-9">
			<div class="input-group">
			  : <?php echo $model->kerjaibu['nm_pekerjaan'];?>
			</div> 
			<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 ">Penghasilan Ibu</label>
			<div class="col-md-9">
		<div class="input-group">
			  : <?php echo $model->penghasilanibu['nm_penghasilan'];?>
			</div> 
			<span class="help-block"></span>
			</div>
	</div>

</div>