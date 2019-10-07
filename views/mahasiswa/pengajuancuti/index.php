<?php
$this->breadcrumbs=array(
	'Pengajuan Cuti Online',
);
$id_pd=Yii::app()->session->get('username');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
	'enableAjaxValidation'=>false,
)); ?>

	
<div class="page-content-wrap">
                    
		<div class="row">                        

			<?php $this->endWidget(); ?>
			
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'mahasiswa-form',
				'enableAjaxValidation'=>false,
			)); ?>
			<div class="col-md-9 ">		
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="pull-left"><span class="fa fa-pencil"></span> Pengajuan Cuti (Minimal Semester 2)</h3>
					</div>
					<div class="panel-body"> 
						<p>Tahapan Pengajuan Cuti online terintegrasi dengan iRaise :</p>
						<p>
					
							1. Lama Cuti <u>2 Semester</u> 
						</p>
						<p>
							2. Melakukan Verifikasi ke Pembimbing Akademik (PA).
						</p>
						<p>
							3. Melakukan Verifikasi ke Admin Prodi.
						</p>
						<p>
							4. Melakukan Verifikasi ke Admin Akademik Rektorat <i>(Membawa Syarat Cuti</i>)
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

					<?php						
					//Semester Aktif
					$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
					$smt=$modelSmt->id_smt;
					if($smt[4]=='1')
					{
						$smt=$smt[0].$smt[1].$smt[2].$smt[3].'2';
					}else{
						$smt=$smt[0].$smt[1].$smt[2].($smt[3]+1).'1';
					}
					$pengajuancek=PengajuanCuti::model()->find('id_pd=:id_pd AND id_smt=:id_smt',array(':id_pd'=>$id_pd,':id_smt'=>$smt));
					if(!isset($pengajuancek)){
					?>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/mahasiswa/mahasiswa/ajukanCuti" class="btn btn-success pull-right"><span class="fa fa-sign-out"></span> Ajukan Cuti</a>
                    <?php
					}else { ?>
					
					<div class="panel-heading">
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/mahasiswa/pengajuancuti/download" class="btn btn-default pull-left"><span class="fa fa-sign-out"></span> Download Surat Pengajuan</a>
						
					</div>
						
						<table> 
						<tr>
							<td>
						<?php if ($pengajuancek->verifikasi_pa=='1') { ?>
							<a class="btn btn-success pull-left">1.PA</a>
						<?php }else{ ?>
							<a class="btn btn-danger pull-left">1.PA</a>
						
						<?php }?>
						</td>
						<td>
						
						<?php if ($pengajuancek->verifikasi_prodi=='1') { ?>
							<a class="btn btn-success pull-left">2.Prodi</a>
						<?php }else{ ?>
							<a class="btn btn-danger pull-left">2.Prodi</a>
						
						<?php }?>
						</td>
						
						<td>
						<?php if ($pengajuancek->status_pengajuan=='1') { ?>
							<a class="btn btn-success pull-left">3.Akademik</a>
						<?php }else{ ?>
							<a class="btn btn-danger pull-left">3.Akademik</a>
						
						<?php }?>						
							</td> 
						</tr>
						</table>
						
					<?php }
					?>
					
					
						</div>
						<div class="panel-body"> 
							
							<div style="color:red;"><?php echo $form->errorSummary($model,'Lengkapi data di bawah ini !'); ?></div>
							<div class="row">
								<div class="page-content-wrap">
									<div class="row">                                

									</div>                    
								</div>
							</div>
						</div>
					</div>				
				</div>
				<?php $this->endWidget(); ?>
				<!--End SKL-->
				
				
			
			
			<div class="message-box animated fadeIn" data-sound="alert" id="ajukan-cuti">
				<div class="mb-container">
					<div class="mb-middle">
						<div class="mb-title"><span class="fa fa-sign-out"></span> Apakah anda yakin ingin mengajukan <strong>Cuti</strong> pada semester berikutnya ?</div>
						<div class="mb-content">
							<p>Apakah yakin?</p>                    
							<p>Tekan "Tidak" jika ingin membatalkan. Tekan "Iya" jika yakin ingin mengajukan.</p>
						</div>
						<div class="mb-footer">
							<div class="pull-right">
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/mahasiswa/mahasiswa/ajukanCuti" class="btn btn-success btn-lg">Iya</a>
								<button class="btn btn-default btn-lg mb-control-close">Tidak</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		
		</div>
</div>

		<!-- END PAGE CONTENT WRAPPER --> 		
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                      
		
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/jquery-validation/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
		<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/jquery/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/form/jquery.form.js"></script>
		<!--
        <script type="text/javascript" src="<?php // echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/cropper/cropper.min.js"></script>-->
        
        <!-- START TEMPLATE -->
       <script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins/datatables/jquery.dataTables.min.js"></script>    
        
        <script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/themes/admin/js/plugins.js"></script>        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/actions.js"></script>    
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/demo_edit_profile.js"></script>

				
	