<?php
/* @var $this MatkulController */
/* @var $data Matkul */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_mk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_mk), array('view', 'id'=>$data->id_mk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sms')); ?>:</b>
	<?php echo CHtml::encode($data->id_sms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jenj_didik')); ?>:</b>
	<?php echo CHtml::encode($data->id_jenj_didik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_mk')); ?>:</b>
	<?php echo CHtml::encode($data->kode_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_mk')); ?>:</b>
	<?php echo CHtml::encode($data->nm_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jns_mk')); ?>:</b>
	<?php echo CHtml::encode($data->jns_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kel_mk')); ?>:</b>
	<?php echo CHtml::encode($data->kel_mk); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_mk')); ?>:</b>
	<?php echo CHtml::encode($data->sks_mk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_tm')); ?>:</b>
	<?php echo CHtml::encode($data->sks_tm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_prak')); ?>:</b>
	<?php echo CHtml::encode($data->sks_prak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_prak_lap')); ?>:</b>
	<?php echo CHtml::encode($data->sks_prak_lap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sks_sim')); ?>:</b>
	<?php echo CHtml::encode($data->sks_sim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metode_pelaksanaan_kuliah')); ?>:</b>
	<?php echo CHtml::encode($data->metode_pelaksanaan_kuliah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_sap')); ?>:</b>
	<?php echo CHtml::encode($data->a_sap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_silabus')); ?>:</b>
	<?php echo CHtml::encode($data->a_silabus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_bahan_ajar')); ?>:</b>
	<?php echo CHtml::encode($data->a_bahan_ajar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acara_prak')); ?>:</b>
	<?php echo CHtml::encode($data->acara_prak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_diktat')); ?>:</b>
	<?php echo CHtml::encode($data->a_diktat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_mulai_efektif')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_mulai_efektif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_akhir_efektif')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_akhir_efektif); ?>
	<br />

	*/ ?>

</div>