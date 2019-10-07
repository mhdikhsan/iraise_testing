<?php
//ID Mhs
	$id_pd=Yii::app()->session->get('username');
	$modelMhs=Mahasiswa::model()->findByPk($id_pd);
	$getSmt=$_GET['semester'];
//Breadcrumbs
$this->breadcrumbs=array(
	'Download Tugas',
);
//ID ptk
	$modelBak=Bak::model()->findAll('id_pd=:id_pd',array(':id_pd'=>$id_pd));
	foreach($modelBak as $bak){}
	$id_ptk=$bak->id_ptk;
	$modelDosen=Dosen::model()->findByPk($id_ptk);
	//Semester
	$modelNilai=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id_pd,':semester'=>$getSmt));
	foreach($modelNilai as $db){}
	$modelSmt=Semester::model()->findByPk($db->smtKrs['id_smt']);
	$modelTahun=TahunAjaran::model()->findByPk($modelSmt->id_thn_ajaran);
	$modelSms=Sms::model()->findByPk($modelMhs->regpd_id_sms);
	//Fakultas
	$modelFak=Sms::model()->findByPk($modelSms->id_induk_sms);
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
<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-5">
			<h1 class="pull-left"><span class="fa fa-file"></span> Pilih Mata Kuliah</h1>
			<br>
		</div>
	</div>
</div>
<?php if(Yii::app()->user->hasFlash('flash')): ?>
	<div class="col-md-12">                        
		<form action="#" class="form-horizontal">
		 <div class="panel panel-default">
			<div class="panel-body"> 
					<?php echo Yii::app()->user->getFlash('flash'); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="col-md-12">                        
	<form action="#" class="form-horizontal">
     <div class="panel panel-default">
        <div class="panel-body"> 
			<div class="col-md-12">
				<div style="float:left;padding-right:3px;">
					<h5>Nama Mahasiswa</h5>
					<h5>Penasehat Akademis</h5>
					<h5>Fakultas</h5>
					<h5>Semester</h5>
					
				</div>
				<div style="float:left;">
					<h5> : <?php echo $modelMhs->nm_pd; ?> </h5>
					<h5> : <?php echo $modelDosen->nm_ptk; ?> </h5>
					<h5> : <?php echo $modelFak->nm_lemb; ?></h5>
					<h5> : <?php echo $getSmt.' - '.$modelSmt->nm_smt; ?> </h5>
				</div>
	
				<div style="float:right;margin-right:50px;">
					<h5> : <?php echo $modelMhs->id_pd; ?> </h5>
					<h5> : <?php echo $modelTahun->nm_thn_ajaran; ?></h5>
					<h5> : <?php echo $modelSms->nm_lemb; ?></h5>
					
					</div>
				<div style="float:right;padding-right:3px;margin-right:50px;">
					<h5>NIM</h5>
					<h5>Tahun </h5>
					<h5>Prodi/Lokal </h5>
				</div>

			</div >
						
				<div class="page-content-wrap">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal">
							<div class="panel panel-default tabs">
								<div class="panel-body tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="panel-body">                          
											<div class="row">
												<?php $no=1;$this->widget('booster.widgets.TbGridView', array(
														'id'=>'Arsip',
														'selectableRows'=>2,
														'dataProvider'=>$model->krs($_GET['semester']),
														'filter'=>$model,
														'columns'=>array(	
																'mk.kode_mk',
																'mk.nm_mk',
																'mk.sks_mk',
																'dosen2.nm_ptk',
																'kls.nm_kls',
																'k.nm_kurikulum',
																array(    
																 'header'=>'Open',
																 'type'=>'raw', 
																 'value'=>'CHtml::link("Milis", Yii::app()->createUrl("mahasiswa/tugas/milis",array("id"=>$data->id_kls)),array("class"=>"btn btn-success"))',
																),
														),
												)); ?>
											</div>
										</div>					 
									</div>
								</div>		
							</div>                                
							</form>
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