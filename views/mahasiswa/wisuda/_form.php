<?php
$judul="Formulir Wisuda";
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
				<!-- Biodata -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="pull-left"><a href="<?= Yii::app()->request->baseUrl ?>/mahasiswa/Mahasiswa/update/id/<?= date('Y')?>"><span class="fa fa-pencil"></span></a> Biodata</h3>
						<a href="<?= Yii::app()->request->baseUrl ?>/mahasiswa/wisuda/formcetak" target="blank" class="btn btn-success pull-right"> <i class="fa fa-print"></i>Cetak Form Wisuda </a>	
					</div>
					<div class="panel-body"> 
						<div class="row"> 
							<div class="col-md-2"><p><b>Tempat Lahir</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->tmpt_lahir; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Tanggal Lahir</b></p></div>
							<div class="col-md-6"><h4>: <?= $this->ubahTgl($model->tgl_lahir); ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Semester</b></p></div>
							<div class="col-md-6"><h4>: <?= $smt; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Jenis Kelamin</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->jk=='L'?'Laki - Laki':'Perempuan'; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>No SKL</b></p></div>
							<div class="col-md-6"><h4>: <?= $modelWisuda->skl_no_fak.$modelWisuda->skl_no.'/'.$modelWisuda->skl_no_tahun; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>No Bebas Pustaka Univ</b></p></div>
							<div class="col-md-6"><h4>: <?= $modelWisuda->lib_univ.$modelWisuda->lib_univ_no.'/'.$modelWisuda->lib_univ_tahun; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Nama Ayah</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->nm_ayah; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Nama Ibu</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->nm_ibu_kandung; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Alamat</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->jln.' RT '.$model->rt.' RW '.$model->rw.' '.$model->nm_dsn; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Kelurahan/Desa</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->ds_kel; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Kecamatan</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->kec['nm_wil']; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Kabupaten</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->kab['nm_wil']; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Provinsi</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->prov['nm_wil']; ?></h4></div>
						</div>
						<br>
						<div class="row"> 
							<div class="col-md-2"><p><b>Negara</b></p></div>
							<div class="col-md-6"><h4>: <?= $model->negara['nm_wil']; ?></h4></div>
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