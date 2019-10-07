<div class="col-md-6">
	<div class="form-group row">          
		<label class="col-md-4 ">Kepemilikan Rumah</label>
		<div class="col-md-8">
			<?php echo $form->dropDownList($modelBBM,'kepemilikan_rumah',CHtml::listData(BidikmisiKepemilikanRumah::model()->findAll(),'id_kepemilikan_rumah','nama'),array('empty'=>'Pilih','class'=>"form-control select")); ?>
		<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 ">Tahun Peroleh</label>
			<div class="col-md-8">                                               
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'tahun_peroleh_rumah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan Tahun Peroleh Rumah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group row">                
		<label class="col-md-4 ">Sumber Listrik</label>
		<div class="col-md-8">
			<?php echo $form->dropDownList($modelBBM,'sumber_listrik',CHtml::listData(BidikmisiListrik::model()->findAll(),'id_listrik','nama_listrik'),array('empty'=>'Pilih','class'=>"form-control select")); ?>
		<span class="help-block"></span>
		</div>
	</div>
</div>