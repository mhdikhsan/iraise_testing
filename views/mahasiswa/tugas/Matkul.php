<?php
//ID Mhs
	$id_ptk=Yii::app()->session->get('username');
	$modeldsn=Dosen::model()->findByPk($id_ptk);
	// $id_nl=Yii::app()->session->get('kode_mk');
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
<h1>Nilai Mata Kuliah</h1>
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
			<h3><span class="fa fa-pencil"></span> Nilai Mata Kuliah</h3>
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
			<div class="row">          
					
						
				<div class="page-content-wrap">
					<div class="row">
						<div class="col-md-12">
					<div><h3>Nama Dosen :<?php 	 echo $modeldsn->nm_ptk; ?></h3></div>
					<div><h3>Nip :<?php 	echo $id_ptk;?></div></h3>
							<form class="form-horizontal">
							<div class="panel panel-default tabs">
								<div class="panel-body tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="panel-body">                          
											<div class="row">
												<?php $no=1;$this->widget('booster.widgets.TbGridView', array(
														'id'=>'Arsip',
														'selectableRows'=>2,
														'dataProvider'=>$model->search(),
														'filter'=>$model,
														'columns'=>array(	
																array(
																	'header'=>'No',
																	'value'=>'$row+1',
																),
																'mk.kode_mk',
																'mk.nm_mk',
																'mk.sks_mk',
																'smt.smt',
																'kls.nm_kls',
																'k.nm_kurikulum',
																array(    
																 'header'=>'Open',
																 'type'=>'raw', 
																 'value'=>'CHtml::link("Milis", Yii::app()->createUrl("dosen/tugas/milis",array("id"=>$data->id_kls)),array("class"=>"btn btn-success"))',
																),
														),

												)); ?>
											</div>
											<div>

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