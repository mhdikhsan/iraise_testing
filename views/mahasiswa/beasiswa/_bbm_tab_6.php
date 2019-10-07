<div class="col-md-6">
	<div class="form-group row">          
		<label class="col-md-4 ">Kepemilikan Rumah</label>
		<div class="col-md-8">
			<?php echo $form->dropDownList($modelBBM,'kepemilikan_rumah',CHtml::listData(BidikmisiKepemilikanRumah::model()->findAll(),'id_kepemilikan_rumah','nama'),array('empty'=>'Pilih Kepemilikan Rumah','class'=>"form-control select")); ?>
		<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group row">          
		<label class="col-md-4 ">Atap Rumah</label>
		<div class="col-md-8">
			<?php 
			echo $form->dropDownList($modelBBM,'atap_rumah',CHtml::listData(BidikmisiKondisiRumah::model()->findAll(array('condition'=>'bagian="Atap"')),'id_kondisi_rumah','keterangan'),array('empty'=>'Pilih Jenis Atap Rumah','class'=>"form-control select", 'required'=>'required')); ?>
		<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group row">          
		<label class="col-md-4 ">Dinding Rumah</label>
		<div class="col-md-8">
			<?php 
			echo $form->dropDownList($modelBBM,'dinding_rumah',CHtml::listData(BidikmisiKondisiRumah::model()->findAll(array('condition'=>'bagian="Dinding"')),'id_kondisi_rumah','keterangan'),array('empty'=>'Pilih Jenis Dinding Rumah','class'=>"form-control select", 'required'=>'required')); ?>
		<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group row">          
		<label class="col-md-4 ">Lantai Rumah</label>
		<div class="col-md-8">
			<?php 
			echo $form->dropDownList($modelBBM,'lantai_rumah',CHtml::listData(BidikmisiKondisiRumah::model()->findAll(array('condition'=>'bagian="Lantai Rumah"')),'id_kondisi_rumah','keterangan'),array('empty'=>'Pilih Jenis Lantai Rumah','class'=>"form-control select", 'required'=>'required')); ?>
		<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group row">          
		<label class="col-md-4 ">Lantai Kamar Mandi</label>
		<div class="col-md-8">
			<?php 
			echo $form->dropDownList($modelBBM,'lantai_kamar_mandi',CHtml::listData(BidikmisiKondisiRumah::model()->findAll(array('condition'=>'bagian="Lantai Kamar Mandi"')),'id_kondisi_rumah','keterangan'),array('empty'=>'Pilih Jenis Lantai Rumah','class'=>"form-control select", 'required'=>'required')); ?>
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group row">
		<label class="col-md-4 ">Tahun Peroleh</label>
			<div class="col-md-8">                                               
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
					 <?php
						for($i=2000;$i<=date('Y');$i++){
						$thn[$i]=$i;
						}
					?>
					<?php 
						echo $form->dropDownList($modelBBM,'tahun_peroleh_rumah',$thn,array('empty'=>'Pilih Tahun Peroleh','class'=>"form-control", 'style'=>"float:left;")); 
					?>	
				</div>                                            
				<span class="help-block"></span>
			</div>
	</div>

	<div class="form-group row">                
		<label class="col-md-4 ">Sumber Listrik</label>
		<div class="col-md-8">
			<?php echo $form->dropDownList($modelBBM,'sumber_listrik',CHtml::listData(BidikmisiListrik::model()->findAll(),'id_listrik','nama_listrik'),array('empty'=>'Pilih Sumber Listrik Rumah','class'=>"form-control select")); ?>
		<span class="help-block"></span>
		</div>
	</div>
</div>