<?php
$this->breadcrumbs=array(
	$judul,
);
?>
		<?php if(Yii::app()->user->hasFlash('flash')):?>
		<div class="col-md-12">
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
				</button>
				<h4 style="color:#fff;"> 
					<?php echo Yii::app()->user->getFlash('flash'); ?>
				</h4>
			</div>
		</div>
		<?php endif; ?>	
			<div class="col-md-12 ">		
				<div class="panel panel-default">
					 <div class="panel-body"> 
						<h3><span class="fa fa-pencil"></span> <?php echo $judul;?></h3>
						
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'mahasiswa-form',
							'enableAjaxValidation'=>false,
						)); ?>
						<div style="color:red;"><?php echo $form->errorSummary($modelBBM); ?></div>
						<div class="row">
							<?php //if($model->beasiswa_bidikmisi>0): ?>
							<?php if(($sess_smt=="1")||($model->beasiswa_bidikmisi>0)): ?>
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-12 col-xs-12">
										<?php echo CHtml::link('Cetak Form 3',array('form3Cetak'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
										<?php echo CHtml::link('Cetak Form 2',array('form2Cetak'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
										<?php echo CHtml::link('Cetak Form 1',array('formCetak'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
										<?php $this->renderPartial('status', array('status'=>$model->beasiswa_bidikmisi)); ?>
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php //if(($umur>21) || (($model->beasiswa_bidikmisi==5)) || ($jenj_didik!='30') ):?>
							<?php if(($umur>21) || (($model->beasiswa_bidikmisi==5)) ):?>
								<?php $this->renderPartial('gagal', array()); ?>
							<?php elseif($sess_smt==1):?>
							<?php 
								//$date = "2015-09-11";
								
								$dateopen = "2018-08-27";
								$date = "2018-09-06";
								
								
								if((date('Y-m-d') >=$dateopen && date('Y-m-d')<=$date)){
							?>
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-12 col-xs-12">
										<button class="btn btn-primary pull-right">Simpan & Ajukan </button>
										<?php echo CHtml::link('Lihat Syarat dan Info','https://drive.google.com/file/d/1Wd1uPI-NSYENrLzXNU3Gfw_yp_cbO8A0/view?usp=sharing',array('class'=>'btn btn-info pull-left','target'=>'blank')); ?>
									</div>
								</div>
								<br>
								<hr>
							</div>
							<div class="col-md-12">
										<p> <font color="red">Lengkapi Data pada form dibawah ini sebelum simpan dan ajukan.! </font></p>
								<hr>
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
													<?php $this->renderPartial('_bbm_tab_2', array('model'=>$model,'form'=>$form,'jurusan'=>$jurusan,'fakultas'=>$fakultas,'jk'=>$jk,'modelBBM'=>$modelBBM,'row'=>$row,'jenj_didik'=>$jenj_didik,'row2'=>$row2)); ?>
													<!--END TAB-->
												</div>
												<div class="tab-pane" id="tab-prestasi">
													<?php $this->renderPartial('_bbm_tab_3', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM,'row'=>$row)); ?>
													<!--END TAB-->
												</div>
											
												<div class="tab-pane" id="tab-ortu">
													<?php $this->renderPartial('_bbm_tab_4', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM,'row'=>$row,'rowayah'=>$rowayah,'rowibu'=>$rowibu)); ?>
													<!--END TAB-->
												</div>

												<div class="tab-pane" id="tab-eko"> 
													<?php $this->renderPartial('_bbm_tab_5', array('model'=>$model,'form'=>$form,'modelBBM'=>$modelBBM,'rowayah'=>$rowayah,'rowibu'=>$rowibu)); ?>
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
							<?php
								}else 
								{
									$date= date_create($date);
									$dateopen= date_create($dateopen);
									echo "<h4><b>Pendaftaran Bidikmisi Dapat dilakukan Pada Tanggal ". date_format($dateopen,"d F Y")." s/d ".date_format($date,"d F Y")."</b></h4>";
								
								}
								
								endif;
							
							?>
							<!--END CEK UMUR-->
						</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>				
			</div>
		</div>
		<!-- END PAGE CONTENT WRAPPER --> 		
</div><!-- form -->