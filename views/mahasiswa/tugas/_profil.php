<div class="col-md-4" style="margin:-2%">                                
	<div class="panel-body col-md-3">
	  
		<div class="text-center" id="user_image">
			<?php
			$modelBlob=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id_pd));
			foreach($modelBlob as $db){}
			if(!isset($db)){
				echo '<img src="'.Yii::app()->request->baseUrl.'/images/no-image.jpg" alt="UIN SUSKA"/>';
			}else{
				echo '<img src="https://iraise.uin-suska.ac.id/site/image/id/'.$idDosen.'" alt="UIN SUSKA" width="100%"/>';
			}
			?>
		</div>                                   
	</div>
</div>
<div class="col-md-8">
	<div class="panel-body form-group-separated">
		<div class="form-group row">
			<label class="col-md-4 col-xs-5 control-label"><h3>Nama Dosen</h3><small>NIP/NIK Dosen</small></label>
			<div class="col-md-8 col-xs-7">
				<h4><?php echo $namaDosen; ?></h4>
				<p><?php echo $idDosen; ?></p>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-xs-5 control-label"><h3>Mata Kuliah</h3></label>
			<div class="col-md-8 col-xs-7">
				<h4 class="pull-left"><?php echo $modelKls->mk->nm_mk;?></h4>
			</div>
		</div>
		<div class="form-group row" valign="center">
			<label class="col-md-4 col-xs-5 control-label"><h3>Kelas</h3><small>Mata Kuliah</small></label>
			<div class="col-md-8 col-xs-7">
				<h3 class="pull-right" style="font-size:40px;"> <?php echo $modelKls->nm_kls;?></h3>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-xs-5 control-label"><h3>Kode / SKS</h3><small>Kode / SKS Mata Kuliah</small></label>
			<div class="col-md-8 col-xs-7">
				<h4 class="pull-left"><?php echo $modelKls->mk->kode_mk;?> / <?php echo $modelKls->mk->sks_mk;?> <small>SKS</small></h4>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 col-xs-5 control-label"><h3>Waktu</h3><small>Pertemuan Mata Kuliah</small></label>
			<div class="col-md-8 col-xs-7">
				<h4 class="pull-left"><?php echo $modelKls->mk->sks_mk;?> x 50 <small>Menit</small></h4>
			</div>
		</div>
		
	</div>
</div>
<div class="row col-md-12">
	<div class="panel-body form-group-separated">
		<div class="form-group">
			<label class="col-md-2 col-xs-5 control-label"><h3>Deskripsi <small>Singkat</small></h3></label>
			<div class="col-md-10 col-xs-7">
				<?= $modelKls->sbs_deskripsi ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 col-xs-5 control-label"><h3>TUJUAN  <small>INSTRUKSIONAL UMUM</small></h3></label>
			<div class="col-md-10 col-xs-7">
				<?= $modelKls->sbs_tujuan ?>
			</div>
		</div>
	</div>
</div>