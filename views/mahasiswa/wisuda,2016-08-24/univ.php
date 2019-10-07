<?php
$judul='Bebas Pustaka Universitas';
$this->breadcrumbs=array(
	'Wisuda'=>array('index'),
	$judul,
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
						<h3 class="pull-left"><span class="fa fa-pencil"></span> <?= $judul; ?></h3>
						<button class="btn btn-success pull-right"> <i class="fa fa-save"></i>Ajukan <?= $judul; ?> </button>			
						<input type="hidden" name="id_pd" value="<?= $id_pd; ?>">
					</div>
					<div class="panel-body"> 
						Klik Ajukan
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