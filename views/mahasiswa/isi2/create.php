<?php
/* @var $this MatkulController */
/* @var $model Matkul */

$this->breadcrumbs=array(
	'Matkuls'=>array('index'),
	'Create',
);

?>

<h1>Create Matkul</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>