<?php
/* @var $this MatkulController */
/* @var $model Matkul */

$this->breadcrumbs=array(
	'Matkuls'=>array('index'),
	$model->id_mk=>array('view','id'=>$model->id_mk),
	'Update',
);

$this->menu=array(
	array('label'=>'List Matkul', 'url'=>array('index')),
	array('label'=>'Create Matkul', 'url'=>array('create')),
	array('label'=>'View Matkul', 'url'=>array('view', 'id'=>$model->id_mk)),
	array('label'=>'Manage Matkul', 'url'=>array('admin')),
);
?>

<h1>Update Matkul <?php echo $model->id_mk; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>