<?php
	$this->breadcrumbs=array(
	'BAK',
	);
//ID Mhs
	$id_ptk=$_GET['ptk'];
	//Kuliah Mhs
	$id_pd=$_GET['id'];
	$modelMhs=Mahasiswa::model()->findByPk($id_pd,array('select'=>'id_pd,nm_pd,regpd_id_sms'));
	
	$modelDosen=Dosen::model()->findByPk($id_ptk,array('select'=>'nm_ptk'));
	//Semester
	$modelSmt=Semester::model()->findAll('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
	foreach($modelSmt as $smt){}
	//Semester Aktif
	$modelKuliah=KuliahMhs::model()->findAll('id_smt=:id_smt AND id_reg_pd=:id_reg_pd',array(':id_smt'=>$smt->id_smt,':id_reg_pd'=>$id_pd));
	foreach($modelKuliah as $dbKuliah){}
	if(!isset($dbKuliah))
	{
		$this->redirect(array('bak'));
	}
	$modelTahun=TahunAjaran::model()->findByPk($smt->id_thn_ajaran);
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
			<h2 class="pull-left"><span class="fa fa-copy"></span> Persetujuan KRS</h2>
			<br>
			<button class="btn btn-primary pull-right">Simpan </button>
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
					<h5> : <?php echo $dbKuliah->semester.' - '; echo $smt->nm_smt=="1"? "Ganjil":"Genap"; ?> </h5>
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
			</div>
		
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
			<div class="row">          
						
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
														'dataProvider'=>$model->acc($id_pd,$dbKuliah->semester),
														'filter'=>$model,
														'columns'=>array(	
																array('header'=>'No','value'=>'$row+1'),
																'mk.kode_mk',
																'mk.nm_mk',
																'mk.sks_mk',
																'dosen2.nm_ptk',
																'kls.nm_kls',
																array('name'=>'semester','value'=>'$data->mk["semester"]'), 
																'k.nm_kurikulum',
																array(
																	'header'=>'Persetujuan KRS',
																	'value'=>'$data->acc_pa ? \'Sudah Disetujui\':\'Setujui\'',
																	'htmlOptions'=>array('style'=>'width: 90px;margin:10px;','class'=>'btn btn-info btn-rounded'),
																),
																array(
																	'header'=>'Syarat Mata Kuliah',
																	'type'=>'raw',
																	'value'=>array($this,'syarat'),
																),
																array(
																	'id'=>'id_nilai',
																	'value'=>'$data->id_nilai',
																	'class'=>'CCheckBoxColumn',
																),
																array(    
																	'header'=>'Hapus',
																	'type'=>'raw', 
																	'value'=>'CHtml::link("", Yii::app()->createUrl("#",array("id"=>$data->id_nilai)),array("class"=>"btn btn-danger fa fa-times","submit"=>array("deleteAcc","id"=>$data->id_nilai),"confirm"=>"Are you sure you want to delete this item?"))',
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