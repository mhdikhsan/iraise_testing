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
						<?php if($modelWisuda->skl_tgl_daftar>0):?>
							<button class="btn btn-default pull-right"> <i class="fa fa-save"></i>Perbaiki SKL </button>
						<?php else:?>
							<button class="btn btn-success pull-right"> <i class="fa fa-save"></i>Ajukan SKL </button>			
						<?php endif;?>
					</div>
					<div class="panel-body"> 
						<div class="row"> 
							<h3>Judul Skripsi</h3>
							<textarea name="wis_judul" class="form-control"><?= $modelWisuda->wis_judul; ?></textarea>
						</div>
						<!------------------------------------------------------------------------------------------------------------------------------------------------>
						<br>
						<div class="col-md-6">
							<!--Pembimbing-->
							<div class="row">
								<div class="form-group">
									<h3>Pembimbing</h3>
									<div class="col-md-12">                                                                                
										<select class="form-control select" data-live-search="true" name="wis_pembimbing">
											<?php 
												//cek fakultas
												$modelCekFak=Sms::model()->findByPk($modelSms->id_sms);
												$modelCekFak2=Sms::model()->findAll('id_induk_sms=:id_induk_sms',array(':id_induk_sms'=>$modelCekFak->id_induk_sms));
												$end=count($modelCekFak2);
												if($end>1)
												{
													$no=1;
													$fap='(';
													$fapfap[':id_ptk']='';
													foreach($modelCekFak2 as $db)
													{
														if($no==$end)
														{
															$fap.='regptk_id_sms=:regptk_id_sms'.$no.' ) ';
															$fapfap[':regptk_id_sms'.$no]=$db->id_sms;
														}else{
															$fap.='regptk_id_sms=:regptk_id_sms'.$no.' OR ';
															$fapfap[':regptk_id_sms'.$no]=$db->id_sms;
														}
														$no++;
													}
													//$modelPemb=Dosen::model()->findAll('id_ptk!=:id_ptk AND '.$fap.' ORDER BY nm_ptk', $fapfap);
													$modelPemb=Dosen::model()->findAll("nidn!=''");
												}else{
													//$modelPemb=Dosen::model()->findAll('id_ptk!=:id_ptk AND regptk_id_sms=:regptk_id_sms ORDER BY nm_ptk', array(':id_ptk'=>'', ':regptk_id_sms'=>$modelSms->id_sms));
													$modelPemb=Dosen::model()->findAll("nidn!=''");
												}
												//END Cek Fakultas
												// $modelPemb=Dosen::model()->findAll('id_ptk!=:id_ptk ORDER BY nm_ptk', array(':id_ptk'=>''));
												$modelPembAktif=Dosen::model()->findByPk($modelWisuda->wis_pembimbing);
												if(empty($modelPembAktif->id_ptk))
												{
													echo '<option>Pilih</option>';
												}else{
													echo '<option value="'.$modelPembAktif->id_ptk.'">'.$modelPembAktif->nm_ptk.'</option>';
												}
												foreach($modelPemb as $db)
												{
													echo '<option value="'.$db->id_ptk.'">'.$db->nm_ptk.'</option>';
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<!--End Pembimbing-->
							<!------------------------------------------------------------------------------------------------------------------------------------------------>
							<!--Tanggal-->
							<br>
							<div class="row">
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
							</div>
							<!--End Tanggal-->
							<!------------------------------------------------------------------------------------------------------------------------------------------------>
						</div>
						<div class="col-md-6">
							<!--Konsentrasi-->
							<div class="row">
								<div class="form-group">
									<h3>Konsentrasi</h3>
									<div class="col-md-12">                                                                                
										<select class="form-control select" data-live-search="true" name="wis_kons">
											<?php 
												$modelKons=Konsentrasi::model()->findAll();
												if($modelWisuda->wis_kons>0)
												{
													$modelKonsAktif=Konsentrasi::model()->findByPk($modelWisuda->wis_kons);
													echo '<option value="'.$modelKonsAktif->kons_id.'">'.$modelKonsAktif->kons_nama.'</option>';
												}
												foreach($modelKons as $db)
												{
													echo '<option value="'.$db->kons_id.'">'.$db->kons_nama.'</option>';
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<!--End Konsentrasi-->
							<br>
							<!--IPK-->
							<div class="row">
								<div class="form-group">
									<h3>IPK : <?= $ipk; ?></h3>
									<div class="col-md-12">                                                                                
										Buka <a href="<?= Yii::app()->request->baseUrl ?>/mahasiswa/transkip/akhir">Transkip Nilai</a> untuk melihat IPK.
									</div>
								</div>
							</div>
							<!--End IPK-->
							<!------------------------------------------------------------------------------------------------------------------------------------------------>
						</div>
						<br>
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
							<div class="col-md-6"><h4>: <?= $this->ubahTgl($model->tgl_lahir); ?></h4></div>
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