<div class="col-md-6">
	<div class="form-group row">
		<label class="col-md-4 ">Penghasilan Ayah</label>
			<div class="col-md-8">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php 
					 if (empty($rowayah->penghasilan)){
						 $penghasilan_ayah = $rowayah['penghasilan'];
					 }else{
						 $penghasilan_ayah = $rowBBM->penghasilan_ayah;
					 }
					 
					 echo $form->textField($modelBBM,'penghasilan_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan Penghasilan Ayah",'value'=>$penghasilan_ayah)); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 ">Penghasilan Ibu</label>
			<div class="col-md-8">                                            
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php 
					 if (empty($modelBBM->penghasilan_ibu)) {
						 $penghasilan_ibu = $rowibu['penghasilan'];
					 }else{
						 $penghasilan_ibu = $modelBBM->penghasilan_ibu;
					 }
					 echo $form->textField($modelBBM,'penghasilan_ibu',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan Penghasilan Ibu",'value'=>$penghasilan_ibu)); ?>
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>
</div>