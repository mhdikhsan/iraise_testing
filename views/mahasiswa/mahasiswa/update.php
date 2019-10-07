<?php
$this->breadcrumbs=array(
	'Edit Profil',
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
				<div class="panel panel-default">                                
					<div class="panel-body">
						<h3><span class="fa fa-user"></span> Welcome</h3>
					  
						<div class="text-center" id="user_image">
							<?php
							$modelBlob=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id_pd));
							foreach($modelBlob as $db){}
							if(!isset($db)){
								echo '<img src="'.Yii::app()->request->baseUrl.'/images/no-image.jpg" alt="UIN SUSKA"/>';
							}else{
								echo CHtml::image(Yii::app()->controller->createUrl('Mahasiswa/loadImage', array('id'=>$db->id_blob)),'',array('class'=>'img-thumbnail'));
							}
							?>
						</div>                                   
					</div>
					<div class="panel-body form-group-separated">
						
						<div class="form-group">                                        
							<div class="col-md-12 col-xs-12">
								<a href="#" class="btn btn-primary btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_photo">Change Photo</a>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Jurusan</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo $modelSms->nm_lemb;?>" class="form-control" disabled/>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-md-3 col-xs-5 control-label">PA</label>
							<div class="col-md-9 col-xs-7">
								<?php 
								if(isset($model->dosen['nm_ptk']))
								{
									$pa=$model->dosen['nm_ptk'];
								}else{
									$pa="-";
								}
								echo $pa;
								?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">NIM</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo $id_pd;?>" class="form-control" disabled/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Password</label>
							<div class="col-md-9 col-xs-7">
								<input type="password" value="how did you do that?" class="form-control"/>
							</div>
						</div>
						
						<div class="form-group">                                        
							<div class="col-md-12 col-xs-12">
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/password" class="btn btn-danger btn-block btn-rounded" >Change password</a>
							</div>
						</div>
						
					</div>
				</div>
						
			</div>
			
<?php $this->endWidget(); ?>
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'mahasiswa-form',
							'enableAjaxValidation'=>false,
						)); ?>
			<div class="col-md-9 ">		
				<div class="panel panel-default">
					<div class="panel-heading">
						
										  <button class="btn btn-primary pull-right"> <i class="fa fa-save"></i>Simpan </button>
									
					</div>
					<div class="panel-body"> 
						<?php if(Yii::app()->user->hasFlash('forgot')){?>
						<div class="col-md-12">
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<strong> 
									<?php echo Yii::app()->user->getFlash('forgot'); ?>
								</strong>
							</div>
						</div>
						<?php } ?>
						<h3><span class="fa fa-pencil"></span> Informasi Personal <small><a style="color:red;"><blink>*</blink></a> Wajib diisi</small></h3>
						
						
						<div style="color:red;"><?php echo $form->errorSummary($model,'Lengkapi data di bawah ini !'); ?></div>
						<div class="row">
							
				
							<div class="page-content-wrap">
								<div class="row">
									<?php if ($pesan) { ?>
									<div class="col-md-12">
										<div class="alert alert-success" role="alert">
											<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
											<strong> 
												LENGKAPI IDENTITAS, ALAMAT, KELUARGA DAN DATA WALI ANDA SEBELUM MELAKUKAN TINDAKAN YANG LAIN.<br/>
												
												Silahkan masukkan email aktif, jika lupa password, anda dapat melakukan reset lewat email
											</strong>
										</div>
									</div>
									<?php }?>
									<div class="col-md-12">
										<div class="panel panel-default tabs">                            
											<ul class="nav nav-tabs" role="tablist">
												<li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Identitas</a></li>
												<li><a href="#tab-second" role="tab" data-toggle="tab">Alamat</a></li>
												<li><a href="#tab-three" role="tab" data-toggle="tab">Keluarga</a></li>
												<li><a href="#tab-four" role="tab" data-toggle="tab">Wali</a></li>
											</ul>												
											<div class="panel-body tab-content">
												<div class="tab-pane active" id="tab-first">
													<div class="panel-body">                          
														<div class="row">
															<div class="col-md-6">
																<div class="form-group row">
																	<div class="col-md-3">
																	<label class="control-label">NIM &nbsp; </label>
																	</div>
																	<div class="col-md-9">                                            
																		<div class="input-group">
																			<?php 
																			
																				echo ': '.$model->id_pd;
																		
																			?>
																		</div>                          
																	</div>
																</div>
																					
																<div class="form-group row">                                        
																	<div class="col-md-3">
																		<label class="control-label">Nama &nbsp;</label>
																	</div>
																		<div class="col-md-9 col-xs-12">
																			<div class="input-group">
																				: <?php echo $model->nm_pd; ?>
																			</div>     
																		</div>
																</div>
																
															   <div class="form-group">
																	<label class="col-md-3 ">NIK <a style="color:red;"><blink>*</blink></a></label>
																		<div class="col-md-9">                                            
																			<div class="input-group">
																				<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																				   <?php echo $form->textField($model,'nik',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan NIK" ));?>
																			</div>                                              
																				 <span class="help-block"></span>
																		</div>
																</div>
																
																<div class="form-group">
																	<div class="col-md-3">
																	<label class="control-label">NISN <a style="color:red;"><blink>*</blink></a> </label>
																	</div>
																	<div class="col-md-9">                                            
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			<?php 
																			
																				echo $form->textField($model,'nisn',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan NISN"));
																		
																			?>
																		</div>                                              
																		<span class="help-block"></span>
																	</div>
																</div>
																			   
																<div class="form-group row">
																	<div class="col-md-3 col-xs-12">	
																			<label class="control-label">Jenis Kelamin <a style="color:red;"><blink>*</blink></a> </label>
																	</div>
																	<div class="col-md-9 col-xs-12">
																			<?php echo $form->radioButton($model,'jk',array('value'=>'L','uncheckValue'=>null )); ?>Laki-Laki										
																			<?php echo $form->radioButton($model,'jk',array('value'=>'P','uncheckValue'=>null )); ?>Perempuan													
																				<span class="help-block"></span>
																	</div>
																</div>
																					
																<div class="form-group">
																		<div class="col-md-3 col-xs-12">	
																			<label class="control-label">Agama <a style="color:red;"><blink>*</blink></a> </label>
																		</div>
																		<div class="col-md-9 col-xs-12">
																			<?php echo $form->dropDownList($model,'id_agama',CHtml::listData(Agama::model()->findAll(),'id_agama','nm_agama'),array('empty'=>'Pilih Agama','class'=>"form-control select")); ?>	
																				
																		</div>
																</div>
																		
															</div>
															<div class="col-md-6 row">
																<div class="form-group row">
																	<label class="col-md-4 control-label">Tanggal Lahir <a style="color:red;"><blink>*</blink></a></label>
																	<div class="col-md-8 col-xs-12">
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			
																			<?php
																					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
																									'name'=>'Mahasiswa[tgl_lahir]',
																									'value'=> $model->tgl_lahir,
																									'options'=>array(
																										'showAnim'=>'fold',
																										'dateFormat'=>'yy-mm-dd',
																									),
																									'htmlOptions' => array(
																										'class' => 'form-control',
																										'placeholder'=>'Masukkan Tanggal Lahir Mahasiswa',
																										
																									),
																					));
																			
																			
																			?>
																			
																		</div>  
																		
																		
																
																		<span class="help-block"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-md-4 control-label">Tempat Lahir <a style="color:red;"><blink>*</blink></a></label>
																	<div class="col-md-8 col-xs-12">
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			<?php 	echo $form->textField($model,'tmpt_lahir',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
																			?>
																		</div>  
																
																		<span class="help-block"></span>
																	</div>
																</div>
																<div class="form-group row">
																			<div class="col-md-4 col-xs-12">
																	<label class="control-label">Kewarganegaraan &nbsp; <a style="color:red;"><blink>*</blink></a></label>
																			</div>
																		<div class="col-md-8 col-xs-12">
																			<?php echo $form->dropDownList($model,'kewarganegaraan',CHtml::listData(Negara::model()->findAll(),'id_negara','nm_negara'),array('empty'=>'Pilih Kewarganegaraan','class'=>"form-control select")); ?>
																				<span class="help-block"></span>
																			<?php	
																				$modelNegara=Negara::model()->findAll('id_negara=:id_negara',array(':id_negara'=>$model->kewarganegaraan));
																					foreach($modelNegara as $db3)
																							{
																							}
																			?>
																		</div>
																</div>
																
															</div>
														  
															
														</div>
													</div>
													 
												</div>
												<div class="tab-pane" id="tab-second">
													<div class="col-md-6">
																			
														<div class="form-group">                                        
															<label class="col-md-3 ">Jalan</label>
																<div class="col-md-9 col-xs-12">
																	<div class="input-group">
																		 <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																		 <?php echo $form->textField($model,'jln',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Jalan" ));?>
																	</div>           
																		<span class="help-block"></span>
																</div>
														</div>
																			
														<div class="form-group">
															<label class="col-md-3 ">Dusun &nbsp; </label>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			<?php echo $form->textField($model,'nm_dsn',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Dusun" )); ?>
																	</div>                                             
																		<span class="help-block"></span>
																</div>
														</div>
														
														<div class="form-group">
																<div class="col-md-3">   
																	<label>Kelurahan &nbsp; <a style="color:red;"><blink>*</blink></a> </label>
																</div>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			   <?php echo $form->textField($model,'ds_kel',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan kelurahan" )); ?>
																	</div>                                                                                       
																	<span class="help-block"></span>
																</div>
														</div>
																
														<div class="form-group">
																<div class="col-md-3"> 
																	<label>Kecamatan&nbsp; <a style="color:red;"><blink>*</blink></a> </label>
																</div>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			    <?php
																				
																				$wil=Wilayah::model()->findByPk($model->id_wil,array('select'=>'nm_wil'));
																																			
																				$this->widget('zii.widgets.jui.CJuiAutoComplete', 		array(
																						'name'=>'willautocomplete',
																						'value'=>isset($wil->nm_wil)? $wil->nm_wil: "",
																					
																						'sourceUrl'=> array('mahasiswa/ajax2'),
																						'options'=>array(
																							'minLength'=>'1', // min chars to start search
																							'select'=>new CJavaScriptExpression('function(event, ui) { 
																								$("#Mahasiswa_id_wil").val(ui.item.id);
																								return true;
																								
																								}')
																						),
																						'htmlOptions'=>array(
																							'id'=>'value',
																							'rel'=>'val',
																							'class'=>'form-control',
																						),
																					)); 
																					
																					  
																					
																					?>
																					<?php echo $form->hiddenField($model,'id_wil');?>
																	</div>                   
																	<span class="help-block"></span>                                                                         
																</div>
														 </div>
														
														<div class="form-group row">
																<div class="col-md-3">   
																	<label>Kabupaten &nbsp; </label>
																</div>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		: <?= $model->kab['nm_wil']?>
																	</div>                                                                                       
																	<span class="help-block"></span>
																</div>
														</div>
														
														<div class="form-group row">
																<div class="col-md-3">   
																	<label>Provinsi &nbsp; </label>
																</div>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		: <?= $model->prov['nm_wil']?>
																	</div>                                                                                       
																	<span class="help-block"></span>
																</div>
														</div>
														
														<div class="form-group row">
																<div class="col-md-3">   
																	<label>Negara &nbsp; </label>
																</div>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		: <?= $model->negara['nm_wil']?>
																	</div>                                                                                       
																	<span class="help-block"></span>
																</div>
														</div>
														
														 <div class="form-group">                                        
																<label class="col-md-3 col-sm-12">RT</label>
																<div class="col-md-4 col-xs-10">
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																	  <?php echo $form->textField($model,'rt',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan RT")); ?>
																	</div>            
																	<span class="help-block"></span>
																</div>
																
																 <label class="col-md-1 control-label">RW</label>
																<div class="col-md-4 col-xs-10">
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																		<?php echo $form->textField($model,'rw',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan RW")); ?>
																	</div>            
																	<span class="help-block"></span>
																</div>
															</div>
											  
															<div class="form-group row">                                        
																<label class="col-md-3 col-sm-12">Kodepos</label>
																<div class="col-md-4 col-xs-12">
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																		  <?php echo $form->textField($model,'kode_pos',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Kode pos")); ?>
																	</div>            
																	<span class="help-block"></span>
																</div>
															</div>
														
													</div>
													
													<div class="col-md-6">
															
															
															<div class="form-group row">                                        
																<label class="col-md-3 col-sm-12">No Hp <a style="color:red;"><blink>*</blink></a></label>
																<div class="col-md-9 col-xs-12">
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																		<?php echo $form->textField($model,'telepon_seluler',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan No Hp")); ?>
																	</div>            
																	<span class="help-block"></span>
																</div>
															</div>
																
															<div class="form-group row">
																<label class="col-md-3 ">Telepon&nbsp; </label>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																				<?php echo $form->textField($model,'telepon_rumah',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan No telepon")); ?>
																	</div>                                                                                       
																		<span class="help-block"></span>
																</div>
															</div>
														 
															<div class="form-group">
																<label class="col-md-3 ">Email <a style="color:red;"><blink>*</blink></a> </label>
																	<div class="col-md-9">                                            
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																				<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan email" )); ?>
																		</div>                                             
																		<span class="help-block"></span>
																	</div>
															</div>
															
															<div class="form-group row">
																<label class="col-md-3 col-sm-12">Jenis Tinggal&nbsp; </label>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			   <?php echo $form->dropDownList($model,'id_jns_tinggal',CHtml::listData(JenisTinggal::model()->findAll(),'id_jns_tinggal','nm_jns_tinggal'),array('empty'=>'Pilih Jenis Tinggal','class'=>"form-control select", 'style'=>'z-index:1000;')); ?>
																	</div>                                
																</div>
															</div>
																
															<div class="form-group">
																<label class="col-md-3 ">Alat Transportasi &nbsp; </label>
																<div class="col-md-9">                                            
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																				  <?php echo $form->dropDownList($model,'id_alat_transport',CHtml::listData(AlatTransport::model()->findAll(),'id_alat_transport','nm_alat_transport'),array('empty'=>'Pilih Alat Transportasi','class'=>"form-control select" )); ?>
																	</div>                                                                                       
																		<span class="help-block"></span>
																</div>
															</div>
														</div> 
												</div>
											
												<div class="tab-pane" id="tab-three">
												
												<div class="col-md-6">
															<div class="form-group row">
																<label class="col-md-3 ">Nama Ayah <a style="color:red;"><blink>*</blink></a></label>
																	<div class="col-md-9">                                            
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			 <?php echo $form->textField($model,'nm_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
																		</div>                                            
																		<span class="help-block"></span>
																	</div>
															</div>
														
															<div class="form-group row">
																	<label class="col-md-3 control-label">Tanggal Lahir<a style="color:red;"><blink>*</blink></a></label>
																	<div class="col-md-9 col-xs-12">
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			<?php 	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
																									'name'=>'Mahasiswa[tgl_lahir_ayah]',
																									'value'=>$model->tgl_lahir_ayah,
																									'options'=>array(
																										'showAnim'=>'fold',
																										'dateFormat'=>'yy-mm-dd',
																									),
																									'htmlOptions' => array(
																										'class' => 'form-control',
																										'placeholder'=>'Masukkan Tanggal Lahir ayah'
																									),
																								));
																			?>
																		</div>  
																		<span class="help-block"></span>
																	</div>
															</div>
															<div class="form-group row">
																<label class="col-md-3 ">Pendidikan Ayah </label>
																   <div class="col-md-9">
																	  <?php echo $form->dropDownList($model,'id_jenjang_pendidikan_ayah',CHtml::listData(JenjangPendidikan::model()->findAll(),'id_jenj_didik','nm_jenj_didik'),array('empty'=>'Pilih jenjang pendidikan Ayah','class'=>"form-control select")); ?>
																	<span class="help-block"></span>
																	</div>
															</div>
															<div class="form-group row">
																<label class="col-md-3 ">Pekerjaan Ayah </label>
																	<div class="col-md-9">
																	<?php echo $form->dropDownList($model,'id_pekerjaan_ayah',CHtml::listData(Pekerjaan::model()->findAll(),'id_pekerjaan','nm_pekerjaan'),array('empty'=>'Pilih pekerjaan Ayah','class'=>"form-control select")); ?>
																			 
																	<span class="help-block"></span>
																	</div>
															</div>
																
															<div class="form-group row">
																<label class="col-md-3 ">Penghasilan Ayah</label>
																	<div class="col-md-9">
																<?php echo $form->dropDownList($model,'id_penghasilan_ayah',CHtml::listData(Penghasilan::model()->findAll(),'id_penghasilan','nm_penghasilan'),array('empty'=>'Pilih penghasilan Ayah','class'=>"form-control select")); 
																	?>
																	<span class="help-block"></span>
																	</div>
															</div>
														
												 </div>
												 
												 <div class="col-md-6">
															<div class="form-group row">
																<label class="col-md-3 ">Nama Ibu <a style="color:red;"><blink>*</blink></a></label>
																	<div class="col-md-9">                                            
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			 <?php echo $form->textField($model,'nm_ibu_kandung',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama ibu")); ?>
																		</div>                                            
																		<span class="help-block"></span>
																	</div>
															</div>
															<div class="form-group row">
																<label class="col-md-3 control-label">Tanggal Lahir<a style="color:red;"><blink>*</blink></a></label>
																<div class="col-md-9 col-xs-12">
																	<div class="input-group">
																		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																		<?php 	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
																								'name'=>'Mahasiswa[tgl_lahir_ibu]',
																								'value'=>$model->tgl_lahir_ibu,
																								'options'=>array(
																									'showAnim'=>'fold',
																									'dateFormat'=>'yy-mm-dd',
																								),
																								'htmlOptions' => array(
																									'class' => 'form-control',
																									'placeholder'=>'Masukkan Tanggal Lahir Ibu'
																								),
																							));
																		?>
																	</div>  
															
																	<span class="help-block"></span>
																</div>
															</div>

															<div class="form-group row">
																<label class="col-md-3 ">Pendidikan Ibu </label>
																   <div class="col-md-9">
																	 <?php echo $form->dropDownList($model,'id_jenjang_pendidikan_ibu',CHtml::listData(JenjangPendidikan::model()->findAll(),'id_jenj_didik','nm_jenj_didik'),array('empty'=>'Pilih jenjang pendidikan Ibu','class'=>"form-control select")); ?>
																	<span class="help-block"></span>
																	</div>
															</div>
																
															<div class="form-group row">
																<label class="col-md-3 ">Pekerjaan Ibu</label>
																	<div class="col-md-9">
																	<?php echo $form->dropDownList($model,'id_pekerjaan_ibu',CHtml::listData(Pekerjaan::model()->findAll(),'id_pekerjaan','nm_pekerjaan'),array('empty'=>'Pilih pekerjaan Ibu','class'=>"form-control select")); ?>
																			 
																	<span class="help-block"></span>
																	</div>
															</div>
																
															<div class="form-group row">
																<label class="col-md-3 ">Penghasilan Ibu</label>
																	<div class="col-md-9">
																<?php echo $form->dropDownList($model,'id_penghasilan_ibu',CHtml::listData(Penghasilan::model()->findAll(),'id_penghasilan','nm_penghasilan'),array('empty'=>'Pilih penghasilan Ibu','class'=>"form-control select")); ?>
																
																	<span class="help-block"></span>
																	</div>
															</div>
											
												</div>
										</div>

												<div class="tab-pane" id="tab-four">
										<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-3 ">Nama Wali</label>
																	<div class="col-md-9">                                            
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			<?php echo $form->textField($model,'nm_wali',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Wali")); ?>
																		</div>                                            
																		<span class="help-block"></span>
																	</div>
															</div>
															
															<div class="form-group">
																	<label class="col-md-3 control-label">Tanggal Lahir</label>
																	<div class="col-md-9 col-xs-12">
																		<div class="input-group">
																			<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
																			<?php 	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
																									'name'=>'Mahasiswa[tgl_lahir_wali]',
																									'value'=>$model->tgl_lahir_wali,
																									'options'=>array(
																										'showAnim'=>'fold',
																										'dateFormat'=>'yy-mm-dd',
																									),
																									'htmlOptions' => array(
																										'class' => 'form-control',
																										'placeholder'=>'Masukkan Tanggal Lahir Mahasiswa'
																									),
																								));
																			?>
																		</div>  
																
																		<span class="help-block"></span>
																	</div>
															</div>
															<br>
															<br>
															<br>
															<br>
															<div class="form-group">
																<label class="col-md-3 ">Pendidikan Wali</label>
																   <div class="col-md-9">
																	<?php echo $form->dropDownList($model,'id_jenjang_pendidikan_wali',CHtml::listData(JenjangPendidikan::model()->findAll(),'id_jenj_didik','nm_jenj_didik'),array('empty'=>'Pilih jenjang pendidikan Wali','class'=>"form-control select")); ?>
																	<span class="help-block"></span>
																	</div>
															</div>
															<br>
															<br>
															<br>
															<br>
																
															<div class="form-group">
																<label class="col-md-3 ">Pekerjaan Wali</label>
																	<div class="col-md-9">
																	<?php echo $form->dropDownList($model,'id_pekerjaan_wali',CHtml::listData(Pekerjaan::model()->findAll(),'id_pekerjaan','nm_pekerjaan'),array('empty'=>'Pilih pekerjaan Wali','class'=>"form-control select")); ?>
																	<span class="help-block"></span>
																	</div>
															</div>
															<br>
															<br>
															<br>
															<br>
																
															<div class="form-group">
																<label class="col-md-3 ">Penghasilan Wali</label>
																	<div class="col-md-9">
																	<?php echo $form->dropDownList($model,'id_penghasilan_wali',CHtml::listData(Penghasilan::model()->findAll(),'id_penghasilan','nm_penghasilan'),array('empty'=>'Pilih penghasilan Wali','class'=>"form-control select")); ?>
																	<span class="help-block"></span>
																	</div>
															</div>
															
														</div>
														
														
										
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