<?php
/* @var $this MatkulController */
/* @var $model Matkul */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'matkul-form',
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

<!-- START WIZARD WITH VALIDATION -->
            <div class="block">
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
            <h4>Lengkapi Data Mata kuliah</h4>                                
				<div class="wizard show-submit wizard-validation">
                    <ul>
						<li>
                            <a href="#step-1">
                                <span class="stepNumber">1</span>
                                <span class="stepDesc"><div style="min-height:20px;">Mata Kuliah</div><br /><small>Informasi</small></span>
                            </a>
                        </li>
						<li>
                            <a href="#step-2">
                                <span class="stepNumber">2</span>
                                <span class="stepDesc"><div style="min-height:20px;">Data </div><br /><small>Mata Kuliah</small></span>
                            </a>
                        </li>
						
                    </ul>
					<div id="step-1">   
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>1. Informasi Mata Kuliah</strong> </h3>
                                    
                                </div>
                                
                                <div class="panel-body">                                                                        
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">ID Mata Kuliah<a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'id_mk',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan ID Mata Kuliah"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">ID SMS<a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'id_sms',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan ID SMS"));?>
                                                       
                                                    </div>      
															
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Jenjang Pendidikan<a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'id_jenj_didik',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan jenjang pendidikan"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Kode Mata Kuliah <a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'kode_mk',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan kode mata kuliah"));?>
                                                    </div> 
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Nama Mata Kuliah <a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'nm_mk',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan nama mata kuliah"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Jenis Mata Kuliah</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'jns_mk',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Jenis mata kuliah"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
											
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Kelompok Mata Kuliah</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'kel_mk',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan kelompok mata kuliah"));?>
                                                       
                                                    </div>      
															
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">SKS Mata Kuliah</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'sks_mk',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan SKS mata kuliah"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">SKS TM</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'sks_tm',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan SKS TM"));?>
                                                    </div> 
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">SKS Praktek</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'sks_prak',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan SKS praktek"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											
											<div class="form-group">                                        
                                                <label class="col-md-3 control-label">SKS Praktek Lapangan</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'sks_prak_lap',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan SKS praktek lapangan"));?>
                                                    </div> 
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">SKS SIM</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'sks_sim',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan SKS sim"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											
										</div>
									</div>
                                </div>
                            </div>
							<a style="color:red;margin-left:3%"><blink>*: Data wajib diisi</blink></a>  
                    </div>
                           			
					<div id="step-2">
						<div class="panel panel-default">
                                <div class="panel-heading">
                                   <h3 class="panel-title"><strong>2. Data Mata Kuliah </strong> </h3>
                                </div>
                                <div class="panel-body">                                                                          
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Metode Pelaksanaan Kuliah</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'metode_pelaksanaan_kuliah',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan metode pelaksaan kuliah"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">SAP</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'a_sap',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan SAP"));?>
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Silabus</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'a_silabus',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan Silabus"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Bahan Ajar</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'a_bahan_ajar',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan bahan ajar"));?>
                                                    </div> 
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
										</div>
                                        <div class="col-md-6">
											<div class="form-group">
                                                <label class="col-md-3 control-label">Acara Praktek</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'acara_prak',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan acara praktek"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Diktat</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'a_diktat',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan diktat"));?>
                                                       
                                                    </div>      
															
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tanggal Mulai Efektif<a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'tgl_mulai_efektif',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan tanggal mulai efektif"));?>
                                                    </div>                                            
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Tanggal Akhir Efektif<a style="color:red;"><blink>*</blink></a></label>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <?php echo $form->textField($model,'tgl_akhir_efektif',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Masukkan tanggal akhir efektif"));?>
                                                    </div> 
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                          
											
										</div>
									</div>
                                </div>
								

                        </div>
						<a style="color:red;margin-left:3%"><blink>*: Data wajib diisi</blink></a>  
                    </div>         
				
                </div>
            </div>                        
    <!-- END WIZARD WITH VALIDATION -->	

<?php $this->endWidget(); ?>

</div><!-- form -->