<div class="panel panel-default">                                
	<div class="panel-body">
		<h3><span class="fa fa-user"></span> Wisuda Online</h3>
	  
		<div class="text-center" id="user_image">
			<?php
			$modelBlob=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id_pd));
			foreach($modelBlob as $db){}
			if(!isset($db)){
				echo '<img src="'.Yii::app()->request->baseUrl.'/images/no-image.jpg" alt="UIN SUSKA"/>';
			}else{
				echo CHtml::image(Yii::app()->controller->createUrl('Mahasiswa/loadImage', array('id'=>$db->id_blob)),'',array('class'=>'img-thumbnail'));
			}
			?>
		</div>                                   
	</div>
	<div class="panel-body form-group-separated">
		
		<div class="form-group">                                        
			<div class="col-md-12 col-xs-12">
				<a href="#" class="btn btn-primary btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_photo">Change Photo</a>
			</div>
		</div>
		
		<div class="form-group row">
			<label class="col-md-3 col-xs-5 control-label">Nama</label>
			<div class="col-md-9 col-xs-7">
				<p><?php echo $model->nm_pd;?></p>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-3 col-xs-5 control-label">Nim</label>
			<div class="col-md-9 col-xs-7">
				<p><?php echo $id_pd;?></p>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-3 col-xs-5 control-label">Jurusan</label>
			<div class="col-md-9 col-xs-7">
				<p><?php echo $modelSms->nm_lemb;?></p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 col-xs-5 control-label">IPK</label>
			<div class="col-md-9 col-xs-7">
				<p><?= $ipk; ?></p>
			</div>
		</div>
		
	</div>
</div>