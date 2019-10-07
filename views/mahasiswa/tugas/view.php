<?php
$this->breadcrumbs=array(
	'Tugases'=>array('index'),
	$model->id_tgs,
);

$this->menu=array(
array('label'=>'List Tugas','url'=>array('index')),
array('label'=>'Create Tugas','url'=>array('create')),
array('label'=>'Update Tugas','url'=>array('update','id'=>$model->id_tgs)),
array('label'=>'Delete Tugas','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tgs),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Tugas','url'=>array('admin')),
);
?>

<h1>View Tugas #<?php echo $model->id_tgs; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_tgs',
		'id_sms',
		'id_kls',
		'judul',
		'ket',
		'link',
		'tipe',
),
)); ?>
