<div class="col-md-6">
	<div class="form-group row">
		<label class="col-md-4 ">Penghasilan Ayah</label>
			<div class="col-md-8">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'penghasilan_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan Penghasilan Ayah")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 ">Penghasilan Ibu</label>
			<div class="col-md-8">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php echo $form->textField($modelBBM,'penghasilan_ibu',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan Penghasilan Ibu")); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
</div>