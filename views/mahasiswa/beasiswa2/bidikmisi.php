<?php
$this->breadcrumbs=array(
	$judul,
);
//Databas sireg
$connection=Yii::app()->db2;
$sql="
select * 
FROM mahasiswa as m
JOIN jalur_masuk as jm ON m.id_jalur_masuk=jm.id_jalur_masuk
JOIN tarif as t ON m.id_tarif=t.id_tarif
JOIN riwayat_pendidikan as rp ON m.id_mahasiswa=rp.id_mahasiswa
WHERE m.nim=".($model->id_pd)."";
$command=$connection->createCommand($sql);
$dataReader=$command->query();
$no=1;
$row=$dataReader->read();
//Umur
$tgl_lahir=($model->tgl_lahir);
$tgl_skrg=(date('Y-m-d'));
$umur=$tgl_skrg-$tgl_lahir;
if($umur>'21')
{
	$this->redirect(array('gagal'));
}
?>

			<div class="col-md-12 ">		
				<div class="panel panel-default">
					 <div class="panel-body"> 
						<h3><span class="fa fa-pencil"></span> <?php echo $judul;?></h3>
						
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'mahasiswa-form',
							'enableAjaxValidation'=>false,
						)); ?>
						<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-12 col-xs-5">
										  <button class="btn btn-primary pull-right">Simpan </button>
									</div>
								</div>
							</div>
				
							<div class="page-content-wrap">
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default tabs">                            
											<ul class="nav nav-tabs" role="tablist">
												<li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Sekolah</a></li>
												<li><a href="#tab-lulus" role="tab" data-toggle="tab">UIN</a></li>
												<li><a href="#tab-prestasi" role="tab" data-toggle="tab">Prestasi</a></li>
												<li><a href="#tab-ortu" role="tab" data-toggle="tab">Orang Tua</a></li>
												<li><a href="#tab-eko" role="tab" data-toggle="tab">Ekonomi </a></li>
												<li><a href="#tab-rumah" role="tab" data-toggle="tab">Rumah </a></li>
											</ul>												
											<div class="panel-body tab-content">
												<div class="tab-pane active" id="tab-first">
													<?php $this->renderPartial('_bbm_tab_1', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM,'row'=>$row,'umur'=>$umur)); ?>
													<!--END TAB-->
												</div>
												<div class="tab-pane" id="tab-lulus">
													<?php $this->renderPartial('_bbm_tab_2', array('model'=>$model,'form'=>$form,'jurusan'=>$jurusan,'fakultas'=>$fakultas,'jk'=>$jk,'modelBBM'=>$modelBBM,'row'=>$row)); ?>
													<!--END TAB-->
												</div>
												<div class="tab-pane" id="tab-prestasi">
													<?php $this->renderPartial('_bbm_tab_3', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM,'row'=>$row)); ?>
													<!--END TAB-->
												</div>
											
												<div class="tab-pane" id="tab-ortu">
													<?php $this->renderPartial('_bbm_tab_4', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM)); ?>
													<!--END TAB-->
												</div>

												<div class="tab-pane" id="tab-eko">
													<?php $this->renderPartial('_bbm_tab_5', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM)); ?>
													<!--END TAB-->
												</div>
												<div class="tab-pane" id="tab-rumah">
													<?php $this->renderPartial('_bbm_tab_6', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM)); ?>
													<!--END TAB-->
												</div>
											</div>		
										</div>                                
									</div>
								</div>                    
							</div>

						</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>				
			</div>
		</div>
		<!-- END PAGE CONTENT WRAPPER --> 		
</div><!-- form -->