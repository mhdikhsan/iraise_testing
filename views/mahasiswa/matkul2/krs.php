<?php
//ID Mhs
	$id_pd=Yii::app()->session->get('username');
//Semester
	$smt=Yii::app()->session->get('semester');
	$genap=false;
	$ganjil=false;
	//Semester Aktif
	$modelSmt=Semester::model()->findAll('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
	foreach($modelSmt as $db){}
	if(($db->smt)%2==0){$genap=true;}else{$ganjil=true;}
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>	
<?php echo $form->errorSummary($model); ?>
<h1>Mata Kuliah</h1>
<?php if(Yii::app()->user->hasFlash('flash')): ?>
	<div class="col-md-12">                        
		<form action="#" class="form-horizontal">
		 <div class="panel panel-default">
			<div class="panel-body"> 
					<h3><span class="fa fa-check-circle-o"></span> <?php echo Yii::app()->user->getFlash('flash'); ?></h3>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="col-md-12">                        
	<form action="#" class="form-horizontal">
     <div class="panel panel-default">
        <div class="panel-body"> 
			<h3><span class="fa fa-pencil"></span> Pilih Mata Kuliah - <?php echo $modelSms->nm_lemb;?> (<?php echo $modelNilai->totalKrsPreview($smt); ?>)</h3>
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
			<div class="row">          
				<div class="col-md-12">            
					<div class="form-group">
						<div class="col-md-12">
							<div class="row">
								<button class="btn btn-primary pull-right">Simpan </button>
								<?php echo CHtml::link('Preview KRS2',array('../../../matkul/preview'),array('class'=>'btn btn-default pull-right')); ?>
							</div>
						</div>
					</div>
				</div>
						
				<div class="page-content-wrap">
					<div class="row">
						<div class="col-md-12">
							<?php
							if($ganjil)
							{
								echo CHtml::link('Semester 1',array('matkul2/krs/semester/1'),array('class'=>'btn btn-default pull-left'));
							}else{
								echo CHtml::link('Semester 2',array('matkul2/krs/semester/2'),array('class'=>'btn btn-default pull-left'));
							}
							for($i=3;$i<=8;$i++)
							{
								$active1="";
								$active2="";
								if($genap)
								{
									$active2="active";
									if($i%2==0)
									{
										echo CHtml::link('Semester '.$i,array('matkul2/krs/semester/'.$i),array('class'=>'btn btn-default pull-left'));
									}
								}else{
									$active1="active";
									if($i%2!=0)
									{
										echo CHtml::link('Semester '.$i,array('matkul2/krs/semester/'.$i),array('class'=>'btn btn-default pull-left'));
									}
								}
							}
							?>
							<div class="panel-body">                          
								<div class="row">
									<?php $this->widget('booster.widgets.TbGridView', array(
											'id'=>'Arsip',
											'selectableRows'=>2,
											'dataProvider'=>$modelSearch->semester($semester),
											'filter'=>$modelSearch,
											'columns'=>array(				
													array('header'=>'No','value'=>'$row+1'), 
													array('name'=>'kode_mk','value'=>'$data->mk->kode_mk'), 
													array('name'=>'nm_mk','value'=>'$data->mk->nm_mk'), 
													array('name'=>'sks_mk','value'=>'$data->mk->sks_mk'), 
													'dosen2.nm_ptk',
													array(
														'header'=>'Syarat Mata Kuliah',
														'type'=>'raw',
														'value'=>array($this,'syarat'),
													),
													array('name'=>'nm_kls','value'=>'$data->nm_kls'), 
													'hari.hari',
													'jadwal.jam_mulai',
													array('name'=>'nm_kurikulum','value'=>'$data->k->nm_kurikulum'),
													array(
														'id'=>'id_kls',
														'value'=>'$data->id_kls',
														'class'=>'CCheckBoxColumn',
													),
											),
									)); ?>
								</div>
							</div>		
						</div>
					</div>                    
				</div>
				
			</div>
		</div> 
	</div>
    </form>                                                    
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->