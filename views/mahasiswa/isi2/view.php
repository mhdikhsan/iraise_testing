<?php
/* @var $this MatkulController */
/* @var $model Matkul */

$this->breadcrumbs=array(
	'Matkuls'=>array('index'),
	$model->id_mk,
);

$this->menu=array(
	array('label'=>'List Matkul', 'url'=>array('index')),
	array('label'=>'Create Matkul', 'url'=>array('create')),
	array('label'=>'Update Matkul', 'url'=>array('update', 'id'=>$model->id_mk)),
	array('label'=>'Delete Matkul', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_mk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Matkul', 'url'=>array('admin')),
);
?>

<h1>View Matkul #<?php echo $model->id_mk; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_mk',
		'id_sms',
		'id_jenj_didik',
		'kode_mk',
		'nm_mk',
		'jns_mk',
		'kel_mk',
		'sks_mk',
		'sks_tm',
		'sks_prak',
		'sks_prak_lap',
		'sks_sim',
		'metode_pelaksanaan_kuliah',
		'a_sap',
		'a_silabus',
		'a_bahan_ajar',
		'acara_prak',
		'a_diktat',
		'tgl_mulai_efektif',
		'tgl_akhir_efektif',
	),
)); ?>
