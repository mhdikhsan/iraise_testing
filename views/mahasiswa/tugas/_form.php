<?php 
//Deklarasi Id_kls
$id_kls=$_GET['id'];
//SMS
$sms=Yii::app()->session->get('sms');
//form
$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'tugas-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->hiddenField($model,'id_sms',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>25,'value'=>$sms)))); ?>
	
	<?php //echo $form->hiddenField($model,'id_kls',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','value'=>$id_kls)))); ?>
	
	<?php echo $form->hiddenField($model,'id_sms',array('size'=>50,'maxlength'=>50,'value'=>$sms)); ?>
	
	<?php echo $form->hiddenField($model,'id_kls',array('size'=>50,'maxlength'=>50,'value'=>$model->isNewRecord ? $id_kls:$model->id_kls)); ?>
	
	<lable>Pilih Materi atau Tugas</lable>
	<?php echo $form->dropDownList($model,'tipe', array(''=>"Pilih",'materi'=>"Materi",'tugas'=>"Tugas"),array('class'=>"form-control select")); ?>
	<br>
	
	<?php //echo $form->textFieldGroup($model,'tipe',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>25)))); ?>

	<?php echo $form->textFieldGroup($model,'judul',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php echo $form->textAreaGroup($model,'ket', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php //echo $form->textAreaGroup($model,'link', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
	
	<lable>Pilih File</lable>
	<?php echo $form->fileField($model,'link',array('size'=>50,'maxlength'=>50,'class'=>'btn')); ?>
	
	<br>
	<br>
	
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
