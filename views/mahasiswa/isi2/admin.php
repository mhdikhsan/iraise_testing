<?php
/* @var $this MatkulController */
/* @var $model Matkul */

$this->breadcrumbs=array(
	'Matkuls'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Matkul', 'url'=>array('index')),
	array('label'=>'Create Matkul', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#matkul-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Matkuls</h1>
<div class="box-content">
		<a href="index.php?r=Operator/matkul/create" class="btn btn-success" style="margin-left:1%" href="#">
		
			Tambah Mata Kuliah
		</a>
	</div>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'matkul-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_mk',
		'id_sms',
		'id_jenj_didik',
		'kode_mk',
		'nm_mk',
		'jns_mk',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
