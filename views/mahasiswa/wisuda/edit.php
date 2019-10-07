<?php
$this->breadcrumbs=array(
	'Wisuda',
);
$id_pd=Yii::app()->session->get('username');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
	'enableAjaxValidation'=>false,
)); ?>

	
<div class="page-content-wrap">
                    
		<div class="row">                        
			<div class="col-md-3 col-sm-12 col-xs-12">		
				<?php $this->renderPartial('_profil',array('id_pd'=>$id_pd, 'model'=>$model, 'modelSms'=>$modelSms, 'ipk'=>$ipk));?>
			</div>
			<?php $this->endWidget(); ?>
			
			<!--Formulir Wisuda-->
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'mahasiswa-form',
				'enableAjaxValidation'=>false,
			)); ?>
			<div class="col-md-9 ">		
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="pull-left"><span class="fa fa-pencil"></span> Pendaftaran Wisuda</h3>
						<?php if(($modelWisuda->skl_status=='2')&&($modelWisuda->lib_univ_status=='2')): ?>
							<input type="hidden" name="form" value="<?= $id_pd; ?>">	
							<button class="btn btn-info pull-right"> <i class="fa fa-save"></i>Formulir Wisuda </button>		
						<?php else: ?>
							<button class="btn btn-default pull-right"> <i class="fa fa-save"></i>Formulir Wisuda </button>		
						<?php endif; ?>
					</div>
					<div class="panel-body"> 
						<p>Tahapan pendaftaran wisuda online terintegrasi dengan iRaise :</p>
						<p>
							<?php if(($modelWisuda->lib_univ_status=='2')&&($modelWisuda->skl_status=='2')): ?>
								<span class="fa fa-check-square" style="color:green;"></span>
							<?php else: ?>
								<span class="fa fa-clock-o" style="color:#cc1e1a;"></span>
							<?php endif; ?>
							1. Memiliki <u>Surat Keterangan Lulus</u> (SKL) dan <u>Bebas Pustaka Univ</u>.
						</p>
						<p>
							<?php if(($modelWisuda->tgl_daftar_wisuda>0)): ?>
								<span class="fa fa-check-square" style="color:green;"></span>
							<?php else: ?>
								<span class="fa fa-clock-o" style="color:#cc1e1a;"></span>
							<?php endif; ?>
							2. Memiliki Print Out <u>Formulir Wisuda</u>.
						</p>
						<p>
							<?php if($modelWisuda->validasi_status=="1"): ?>
								<span class="fa fa-check-square" style="color:green;"></span>
							<?php else: ?>
								<span class="fa fa-clock-o" style="color:#cc1e1a;"></span>
							<?php endif; ?>
							3. Melakukan Validasi di Akademik Universitas serta mendapatkan nomor ijazah dan periode wisuda.
						</p>
						<p>
							<?php if($modelWisuda->status_bayar=="1"): ?>
								<span class="fa fa-check-square" style="color:green;"></span>
							<?php else: ?>
								<span class="fa fa-clock-o" style="color:#cc1e1a;"></span>
							<?php endif; ?>
							4. Melakukan pembayaran wisuda <i>(Syarat Pengambilan Ijazah</i>). Selesai
						</p>
					</div>
				</div>				
			</div>
			<?php $this->endWidget(); ?>
			<!--End Formulir Wisuda-->
			
				<!--SKL-->
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'mahasiswa-form',
					'enableAjaxValidation'=>false,
				)); ?>
				<div class="col-md-9 ">		
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="pull-left"><span class="fa fa-pencil"></span> Surat Keterangan Lulus</h3>
							<?php if($modelWisuda->skl_tgl_daftar>0):?>
								<button class="btn btn-defaut pull-right"> <i class="fa fa-save"></i>Edit </button>
							<?php else:?>
								<button class="btn btn-success pull-right"> <i class="fa fa-save"></i>Ajukan SKL </button>
							<?php endif;?>
							<input type="hidden" name="skl" value="<?= $id_pd; ?>">
						</div>
						<div class="panel-body"> 
							
							<div style="color:red;"><?php echo $form->errorSummary($model,'Lengkapi data di bawah ini !'); ?></div>
							<div class="row">
								<div class="page-content-wrap">
									<div class="row">                                
										<?php if($modelWisuda->skl_status=='0'): ?>
											<?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/wisuda/skl00.jpg" alt="UIN SUSKA" width="100%"/>'; ?>
										<?php elseif($modelWisuda->skl_status=='1'): ?>
											<?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/wisuda/skl01.jpg" alt="UIN SUSKA" width="100%"/>'; ?>
										<?php elseif($modelWisuda->skl_status=='2'): ?>
											<?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/wisuda/selesai.jpg" alt="UIN SUSKA" width="100%"/>'; ?>
										<?php endif;?>
									</div>                    
								</div>
							</div>
						</div>
					</div>				
				</div>
				<?php $this->endWidget(); ?>
				<!--End SKL-->
				
				<!--Pustaka Univ-->
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'mahasiswa-form',
					'enableAjaxValidation'=>false,
				)); ?>
				<div class="col-md-9 ">		
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="pull-left"><span class="fa fa-pencil"></span> Bebas Pustaka Universitas</h3>
							<?php if($modelWisuda->lib_univ_tgl_daftar>0):?>
								<button class="btn btn-defaut pull-right"> <i class="fa fa-save"></i>Edit </button>
							<?php else:?>
								<button class="btn btn-success pull-right"> <i class="fa fa-save"></i>Ajukan Bebas Pustaka </button>			
							<?php endif;?>
							<input type="hidden" name="univ" value="<?= $id_pd; ?>">
						</div>
						<div class="panel-body"> 
							
							<div style="color:red;"><?php echo $form->errorSummary($model,'Lengkapi data di bawah ini !'); ?></div>
							<div class="row">
								<div class="page-content-wrap">
									<div class="row">     
										<?php if($modelWisuda->lib_univ_status=='0'): ?>
											<?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/wisuda/lib_univ00.jpg" alt="UIN SUSKA" width="100%"/>'; ?>
										<?php elseif($modelWisuda->lib_univ_status=='1'): ?>
											<?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/wisuda/lib_univ01.jpg" alt="UIN SUSKA" width="100%"/>'; ?>
										<?php else:?>
											<?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/wisuda/selesai.jpg" alt="UIN SUSKA" width="100%"/>'; ?>
										<?php endif;?>
									</div>                    
								</div>
							</div>
						</div>
					</div>				
				</div>
				<?php $this->endWidget(); ?>
				<!--End Pustaka Univ-->
				
		</div>
		<!-- END PAGE CONTENT WRAPPER --> 		
		
		  <div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Ubah Foto</h4>
                    </div>                    
                    <form id="cp_upload1" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/upload_image.php">
                    <div class="modal-body form-horizontal form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 control-label">New Photo</label>
                            <div class="col-md-4">
								<input type="hidden" name="id" value="<?php echo $id_pd;?>"/>
                                <input type="file" class="fileinput btn-info" name="file" id="cp_photo" title="Select file"/>
                            </div>                            
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <!--button type="button" class="btn btn-success disabled" id="cp_accept">Accept</button-->
						
						<input type="submit" class="btn btn-success" value="Simpan"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>	