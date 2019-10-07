<?php
/* @var $this MatkulController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Matkuls',
);

$this->menu=array(
	array('label'=>'Create Matkul', 'url'=>array('create')),
	array('label'=>'Manage Matkul', 'url'=>array('admin')),
);
?>

<h1>Matkuls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
