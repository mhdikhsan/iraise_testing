<?php
$this->breadcrumbs=array(
	'Wisuda'=>array('index'),
	'SKL',
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
						<h3 class="pull-left"><span class="fa fa-pencil"></span> Surat Keterangan Lulus</h3>
						<button class="btn btn-success pull-right"> <i class="fa fa-save"></i>Ajukan SKL </button>			
					</div>
					<div class="panel-body"> 
						<div class="row"> 
							<h3>Judul</h3>
							<textarea name="wis_judul" class="form-control"><?= $modelWisuda->wis_judul; ?></textarea>
						</div>
						<br>
						<!--Tanggal-->
						<h3>Tanggal Lulus</h3>
						<div class="col-md-5">
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
								<?php
										$this->widget('zii.widgets.jui.CJuiDatePicker', array(
														'name'=>'wis_tgl_lulus',
														'value'=> $modelWisuda->wis_tgl_lulus,
														'options'=>array(
															'showAnim'=>'fold',
															'dateFormat'=>'yy-mm-dd',
														),
														'htmlOptions' => array(
															'class' => 'form-control',
															'placeholder'=>'Masukkan Tanggal Lulus',
															
														),
										));
								?>
							</div>  
							<span class="help-block"></span>
						</div>
						<!--End Tanggal-->
						<input type="hidden" name="wis_jurusan" value="<?php echo $modelSms->nm_lemb;?>"/>
						<input type="hidden" name="wis_smt" value="<?php echo $smt;?>"/>
						<!--End Form-->
					</div>
				</div>				
				<!-- Biodata -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="pull-left"><span class="fa fa-pencil"></span> Biodata</h3>
					</div>
					<div class="panel-body"> 
						<div class="row"> 
							<div class="col-md-2"><p><b>Tempat Lahir</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->tmpt_lahir; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Tanggal Lahir</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->tgl_lahir; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Semester</b></p></div>
							<div class="col-md-6"><h4>: <?= $smt; ?></h4></div>
						</div>
					</div>
				</div>				
			</div>
			<?php $this->endWidget(); ?>
			<!--End Formulir Wisuda-->
			
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