<?php
/* @var $this MatkulController */
/* @var $model Matkul */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_mk'); ?>
		<?php echo $form->textField($model,'id_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_sms'); ?>
		<?php echo $form->textField($model,'id_sms',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_jenj_didik'); ?>
		<?php echo $form->textField($model,'id_jenj_didik',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_mk'); ?>
		<?php echo $form->textField($model,'kode_mk',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nm_mk'); ?>
		<?php echo $form->textField($model,'nm_mk',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jns_mk'); ?>
		<?php echo $form->textField($model,'jns_mk',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kel_mk'); ?>
		<?php echo $form->textField($model,'kel_mk',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_mk'); ?>
		<?php echo $form->textField($model,'sks_mk',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_tm'); ?>
		<?php echo $form->textField($model,'sks_tm',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_prak'); ?>
		<?php echo $form->textField($model,'sks_prak',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_prak_lap'); ?>
		<?php echo $form->textField($model,'sks_prak_lap',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sks_sim'); ?>
		<?php echo $form->textField($model,'sks_sim',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metode_pelaksanaan_kuliah'); ?>
		<?php echo $form->textField($model,'metode_pelaksanaan_kuliah',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a_sap'); ?>
		<?php echo $form->textField($model,'a_sap',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a_silabus'); ?>
		<?php echo $form->textField($model,'a_silabus',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a_bahan_ajar'); ?>
		<?php echo $form->textField($model,'a_bahan_ajar',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acara_prak'); ?>
		<?php echo $form->textField($model,'acara_prak',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a_diktat'); ?>
		<?php echo $form->textField($model,'a_diktat',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_mulai_efektif'); ?>
		<?php echo $form->textField($model,'tgl_mulai_efektif'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_akhir_efektif'); ?>
		<?php echo $form->textField($model,'tgl_akhir_efektif'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->