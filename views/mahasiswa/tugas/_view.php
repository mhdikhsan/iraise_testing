<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_tgs')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tgs),array('view','id'=>$data->id_tgs)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sms')); ?>:</b>
	<?php echo CHtml::encode($data->id_sms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kls')); ?>:</b>
	<?php echo CHtml::encode($data->id_kls); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judul')); ?>:</b>
	<?php echo CHtml::encode($data->judul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ket')); ?>:</b>
	<?php echo CHtml::encode($data->ket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipe')); ?>:</b>
	<?php echo CHtml::encode($data->tipe); ?>
	<br />


</div>