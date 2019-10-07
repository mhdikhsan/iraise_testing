
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
		'action'=>'javascript:alert("Validated!");',
		'role'=>'form',
		'class'=>'form-horizontal',
		'id'=>"wizard-validation"
    ),
)); ?>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
	<!-- START WIZARD WITH VALIDATION -->
            <div class="block">
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
            <h4>Lengkapi Biodata Anda</h4>                                
				<div class="wizard show-submit wizard-validation">
                    <ul>
						<li>
                            <a href="#step-1">
                                <span class="stepNumber">1</span>
                                <span class="stepDesc"><div style="min-height:20px;">NIM</div><br /><small>Informasi</small></span>
                            </a>
                        </li>
						<li>
                            <a href="#step-2">
                                <span class="stepNumber">2</span>
                                <span class="stepDesc"><div style="min-height:20px;">NIK</div><br /><small>Informasi</small></span>
                            </a>
                        </li>
						
                        <li>
                            <a href="#step-3">
                                <span class="stepNumber">3</span>
                                <span class="stepDesc"><div style="min-height:20px;">Orang Tua</div><br /><small>Informasi</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <span class="stepNumber">4</span>
                                <span class="stepDesc"><div style="min-height:20px;">Wali</div><br /><small>Informasi</small></span>
                            </a>
                        </li> 
						
                    </ul>
					<div id="step-1">   
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>1. Informasi Personal</strong> </h3>
                                    
                                </div>
                                
                                <div class="panel-body">                                                                        
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">NIMa</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                        <?php 
															
																echo $form->textField($model,'id_pd',array('size'=>50,'maxlength'=>50,'class'=>"form-control", 'required'=>'readonly'=>'readonly','required','placeholder'=>"Masukkan Nomor Induk Mahasiswa",'required'=>"required"));
															
														?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Nama</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        
															<input size="50" maxlength="50" class="form-control" placeholder="Masukkan Nama Lengkap Mahasiswa" value="<?php echo $model->nm_pd; ?>" type="text">
														
                                                    </div>            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Foto Profil</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                       
                                                        <?php 
																echo $form->fileField($modelObj,'blob_content'); 
								
														?>
							<div style="color:red;"><blink>Maksimal 800kb</blink></div>
                                                    </div>            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
											
                                                <label class="col-md-3 control-label">Jenis Kelamin</label>
                                                <div class="col-md-9 col-xs-12">
                                                    
													<?php echo $form->radioButton($model,'jk',array('value'=>'L','uncheckValue'=>null )); ?>Laki-Laki										
													<?php echo $form->radioButton($model,'jk',array('value'=>'P','uncheckValue'=>null )); ?>Perempuan										
																			
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Agama</label>
												
												<div class="col-md-9">
													<?php echo $form->dropDownList($model,'id_agama',CHtml::listData(Agama::model()->findAll(),'id_agama','nm_agama'),array('empty'=>'Pilih Agama','class'=>"form-control select", 'required'=>'required')); ?>
													<span class="help-block"></span>
												</div>
											</div>
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
                                            
											<div class="form-group">
                                                <label class="col-md-3 control-label">Tempat Lahir</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'tmpt_lahir',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Tempat Lahir Mahasiswa" ));?>
                                                    </div>            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
											<div class="form-group">             
                                                <label class="col-md-3 control-label">Tanggal Lahir</label>                           
                                                <div class="col-md-9">
                                                    <div class="input-group">                                
														<?php
														//ini utk tanggal : start----------------------------------------------------------------------------------
														for($i=1;$i<=31;$i++){
															$tgl[$i]=$i;
														}

														?>
														<?php

														for($i=1;$i<=12;$i++){
															$bln[$i]=$this->bulan($i);
														}

														?>
														<?php
														for($i=date('Y');$i>=1945;$i--){
															$thn[$i]=$i;
														}
														?>
														<div style="width:400px; float:left;">
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'tgl0',$tgl,array('empty'=>'Pilih Tanggal','class'=>"form-control select", 'style'=>"float:left;",'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'bln0',$bln,array('empty'=>'Pilih Bulan','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'thn0',$thn,array('empty'=>'Pilih Tahun','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
														//ini utk tgl : end-------------------------------------------------------------------
														?>
															</div>
														</div>
													</div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div><!--end form group-->
											<div class="form-group">
                                                <label class="col-md-3 control-label">Kewarganegaraan</label>
												
												<div class="col-md-9">
													<?php echo $form->dropDownList($model,'kewarganegaraan',CHtml::listData(Negara::model()->findAll(),'id_negara','nm_negara'),array('empty'=>'Pilih Kewarganegaraan','class'=>"form-control select", 'required'=>'required')); ?>
													
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
                    </div>
                           			
					<div id="step-2">
						<div class="panel panel-default">
                                <div class="panel-heading">
                                   <h3 class="panel-title"><strong>2. Alamat & Kontak </strong> </h3>
                                </div>
                                <div class="panel-body">                                                                          
                                    <div class="row">         
                                        <div class="col-md-6">           
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">NIK</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                       <?php echo $form->textField($model,'nik',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan NIK" ));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                           <div class="form-group">
                                                <label class="col-md-3 control-label">Jalan</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                       <?php echo $form->textField($model,'jln',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Jalan" ));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Dusun</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                      <?php echo $form->textField($model,'nm_dsn',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Dusun" )); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-md-3 control-label">Kelurahan</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'ds_kel',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan kelurahan" )); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-md-3 control-label">Kecamatan</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
														   <?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
																'name'=>'id_wil',
																// additional javascript options for the autocomplete plugin
																'options'=>array(
																	'minLength'=>'1',
																),
																'source'=>$this->createUrl("mahasiswa/ajax"),
																'htmlOptions'=>array(
																	'class'=>"form-control",
																	'placeholder'=>"Masukkan kec.",
								
																),
															)); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-md-3 control-label">Jenis Tinggal</label>
                                                <div class="col-md-9">                                            
													<?php echo $form->dropDownList($model,'id_jns_tinggal',CHtml::listData(JenisTinggal::model()->findAll(),'id_jns_tinggal','nm_jns_tinggal'),array('empty'=>'Pilih Jenis Tinggal','class'=>"form-control select", 'required'=>'required', 'style'=>'z-index:1000;')); ?>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-md-3 control-label">Telepon</label>
                                                <div class="col-md-5">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                       <?php echo $form->textField($model,'telepon_rumah',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan No telepon")); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-md-3 control-label">Email</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Email")); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Alat Transportasi</label>
												
												<div class="col-md-9">
													<?php echo $form->dropDownList($model,'id_alat_transport',CHtml::listData(AlatTransport::model()->findAll(),'id_alat_transport','nm_alat_transport'),array('empty'=>'Pilih Alat Transportasi','class'=>"form-control select" )); ?>
													<span class="help-block"></span>
												</div>
											</div>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
											</br>
											<br>
											</br>
											<br>
											</br>
											
											
											
											
											<div class="form-group">                                        
                                                <label class="col-md-2 control-label">RT</label>
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
											
											
											
                                            <div class="form-group">                                        
                                                <label class="col-md-2 control-label">Kodepos</label>
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                          <?php echo $form->textField($model,'kode_pos',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Kode pos")); ?>
                                                    </div>            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											
											<div class="form-group">                                        
                                                <label class="col-md-2 control-label">NoHp</label>
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'telepon_seluler',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan No Hp")); ?>
                                                    </div>            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                           
											<br>
											</br>
											
											
											
											
											
                                            
                                            
                                            
                                        </div>
                                        
                                    </div>
                                </div>

                        </div>
                    </div>
								
					<div id="step-3">   
					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title"><strong>3. Orang Tua</strong></h3>
                    </div>
                            <div class="panel-body">                                                                        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
											<label class="col-md-3 control-label">Nama Ayah &nbsp; <a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'nm_ayah',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ayah")); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                        </div>
										
										<div class="form-group">             
                                                <label class="col-md-3 control-label">Tanggal Lahir Ayah &nbsp; <a style="color:red;"><blink>*</blink></a></label>                           
                                                <div class="col-md-9">
                                                    <div class="input-group">
														<div style="width:400px; float:left;">
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'tgl1',$tgl,array('empty'=>'Pilih Tanggal','class'=>"form-control select", 'style'=>"float:left;",'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'bln1',$bln,array('empty'=>'Pilih Bulan','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'thn1',$thn,array('empty'=>'Pilih Tahun','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
														//ini utk tgl : end-------------------------------------------------------------------
																	?>
															</div>
														</div>
													</div>
                                                    <span class="help-block"></span>
                                                </div>
                                        </div><!--end form group-->
										<div class="form-group">
                                            <label class="col-md-3 control-label">Pendidikan Ayah &nbsp; <a style="color:red;"><blink>*</blink></a></label>
												<div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_jenjang_pendidikan_ayah',CHtml::listData(JenjangPendidikan::model()->findAll(),'id_jenj_didik','nm_jenj_didik'),array('empty'=>'Pilih jenjang pendidikan Ayah','class'=>"form-control select")); ?>
                                                <span class="help-block"></span>
												</div>
										</div>
											
										<div class="form-group">
                                            <label class="col-md-3 control-label">Pekerjaan Ayah &nbsp; <a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_pekerjaan_ayah',CHtml::listData(Pekerjaan::model()->findAll(),'id_pekerjaan','nm_pekerjaan'),array('empty'=>'Pilih pekerjaan Ayah','class'=>"form-control select")); ?>
                                               <span class="help-block"></span>
												</div>
                                        </div>
											
										<div class="form-group">
                                            <label class="col-md-3 control-label">Penghasilan Ayah &nbsp; <a style="color:red;"><blink>*</blink></a></label>
                                                 <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_penghasilan_ayah',CHtml::listData(Penghasilan::model()->findAll(),'id_penghasilan','nm_penghasilan'),array('empty'=>'Pilih penghasilan Ayah','class'=>"form-control select")); 
												?>
                                                <span class="help-block"></span>
												</div>
                                        </div>
										    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
											<label class="col-md-3 control-label">Nama Ibu &nbsp; <a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'nm_ibu_kandung',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Ibu")); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                        </div>
                                            
										<div class="form-group">             
                                                <label class="col-md-3 control-label">Tanggal Lahir Ibu &nbsp; <a style="color:red;"><blink>*</blink></a></label>                           
                                                <div class="col-md-9">
                                                    <div class="input-group">
														<div style="width:400px; float:left;">
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'tgl2',$tgl,array('empty'=>'Pilih Tanggal','class'=>"form-control select", 'style'=>"float:left;",'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'bln2',$bln,array('empty'=>'Pilih Bulan','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'thn2',$thn,array('empty'=>'Pilih Tahun','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
														//ini utk tgl : end-------------------------------------------------------------------
																	?>
															</div>
														</div>
													</div>
                                                    <span class="help-block"></span>
                                                </div>
                                        </div><!--end form group-->
										<div class="form-group">
                                             <label class="col-md-3 control-label">Pendidikan Ibu &nbsp; <a style="color:red;"><blink>*</blink></a></label>
												
												<div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_jenjang_pendidikan_ibu',CHtml::listData(JenjangPendidikan::model()->findAll(),'id_jenj_didik','nm_jenj_didik'),array('empty'=>'Pilih jenjang pendidikan Ibu','class'=>"form-control select")); ?>
                                                <span class="help-block"></span>
												</div>
										</div>
											
										<div class="form-group">
                                            <label class="col-md-3 control-label">Pekerjaan Ibu &nbsp; <a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_pekerjaan_ibu',CHtml::listData(Pekerjaan::model()->findAll(),'id_pekerjaan','nm_pekerjaan'),array('empty'=>'Pilih pekerjaan Ibu','class'=>"form-control select")); ?>
                                               <span class="help-block"></span>
												</div>
                                        </div>
											
										<div class="form-group">
                                             <label class="col-md-3 control-label">Penghasilan Ibu &nbsp; <a style="color:red;"><blink>*</blink></a></label>
                                                 <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_penghasilan_ibu',CHtml::listData(Penghasilan::model()->findAll(),'id_penghasilan','nm_penghasilan'),array('empty'=>'Pilih penghasilan Ibu','class'=>"form-control select")); ?>
                                               <span class="help-block"></span>
												</div> 
                                        </div>
                                            
                                            
                                    </div>
                                  
                                </div>

                            </div>
							  
                    </div>
					 <a style="color:red;"><blink>*: Data wajib diisi</blink></a>  
                    </div>

                    <div id="step-4">
					<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>4. Wali</strong></h3>
                                    
                    </div>
                            <div class="panel-body">                                                                        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nama Wali</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
														<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'nm_wali',array('size'=>60,'maxlength'=>60,'class'=>"form-control",'placeholder'=>"Masukkan nama Wali")); ?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                        </div>
										<div class="form-group">             
                                                <label class="col-md-3 control-label">Tanggal Lahir Wali</label>                           
                                                <div class="col-md-9">
                                                    <div class="input-group">
														<div style="width:400px; float:left;">
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'tgl3',$tgl,array('empty'=>'Pilih Tanggal','class'=>"form-control select", 'style'=>"float:left;",'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'bln3',$bln,array('empty'=>'Pilih Bulan','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
																	?>
															</div>
															<div style="float:left;">
																	<?php 
																	echo $form->dropDownList($model,'thn3',$thn,array('empty'=>'Pilih Tahun','class'=>"form-control select", 'style'=>"float:left;", 'required'=>'required')); 
														//ini utk tgl : end-------------------------------------------------------------------
																	?>
															</div>
														</div>
													</div>
                                                    <span class="help-block"></span>
                                                </div>
                                        </div><!--end form group-->
										<div class="form-group">
                                            <label class="col-md-3 control-label">Pendidikan Wali</label>
                                               <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_jenjang_pendidikan_wali',CHtml::listData(JenjangPendidikan::model()->findAll(),'id_jenj_didik','nm_jenj_didik'),array('empty'=>'Pilih jenjang pendidikan Wali','class'=>"form-control select")); ?>
                                                <span class="help-block"></span>
												</div>
                                        </div>
											
										<div class="form-group">
                                            <label class="col-md-3 control-label">Pekerjaan Wali</label>
                                                <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_pekerjaan_wali',CHtml::listData(Pekerjaan::model()->findAll(),'id_pekerjaan','nm_pekerjaan'),array('empty'=>'Pilih pekerjaan Wali','class'=>"form-control select")); ?>
												<span class="help-block"></span>
                                                </div>
                                        </div>
											
										<div class="form-group">
                                            <label class="col-md-3 control-label">Penghasilan Wali</label>
                                                <div class="col-md-9">
												<?php echo $form->dropDownList($model,'id_penghasilan_wali',CHtml::listData(Penghasilan::model()->findAll(),'id_penghasilan','nm_penghasilan'),array('empty'=>'Pilih penghasilan Wali','class'=>"form-control select")); ?>
												<span class="help-block"></span>
                                                </div>
										</div>
										
                                    </div>
                                </div>  
                            </div>
							
                    </div>  
					<a style="color:red;"><blink>Jika anda tidak tinggal dengan Wali maka anda dapat melewati tahap ini</blink></a>
					</div>          
				
                </div>
            </div>                        
    <!-- END WIZARD WITH VALIDATION -->					
        </div>
    </div>                    
                    
</div>
<!-- END PAGE CONTENT WRAPPER -->        				
<?php $this->endWidget(); ?>
</div><!-- form -->