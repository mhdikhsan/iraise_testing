<?php
/* @var $this MahasiswaController */
/* @var $model Mahasiswa */

$this->breadcrumbs=array(
	'Mahasiswas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mahasiswa', 'url'=>array('index')),
	array('label'=>'Create Mahasiswa', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mahasiswa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mahasiswas</h1>

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
	'id'=>'mahasiswa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_pd',
		'nm_pd',
		'jk',
		'nisn',
		'nik',
		'tmpt_lahir',
		/*
		'tgl_lahir',
		'id_agama',
		'id_kk',
		'id_sp',
		'jln',
		'rt',
		'rw',
		'nm_dsn',
		'ds_kel',
		'id_wil',
		'kode_pos',
		'id_jns_tinggal',
		'id_alat_transport',
		'telepon_rumah',
		'telepon_seluler',
		'email',
		'a_terima_kps',
		'no_kps',
		'stat_pd',
		'nm_ayah',
		'tgl_lahir_ayah',
		'id_jenjang_pendidikan_ayah',
		'id_pekerjaan_ayah',
		'id_penghasilan_ayah',
		'id_kebutuhan_khusus_ayah',
		'nm_ibu_kandung',
		'tgl_lahir_ibu',
		'id_jenjang_pendidikan_ibu',
		'id_penghasilan_ibu',
		'id_pekerjaan_ibu',
		'id_kebutuhan_khusus_ibu',
		'nm_wali',
		'tgl_lahir_wali',
		'id_jenjang_pendidikan_wali',
		'id_pekerjaan_wali',
		'id_penghasilan_wali',
		'kewarganegaraan',
		'regpd_id_reg_pd',
		'regpd_id_sms',
		'regpd_id_pd',
		'regpd_id_sp',
		'regpd_id_jns_daftar',
		'regpd_nipd',
		'regpd_tgl_masuk_sp',
		'regpd_id_jns_keluar',
		'regpd_tgl_keluar',
		'regpd_ket',
		'regpd_skhun',
		'regpd_a_pernah_paud',
		'regpd_a_pernah_tk',
		'regpd_mulai_smt',
		'regpd_sks_diakui',
		'regpd_jalur_skripsi',
		'regpd_judul_skripsi',
		'regpd_bln_awal_bimbingan',
		'regpd_bln_akhir_bimbingan',
		'regpd_sk_yudisium',
		'regpd_tgl_sk_yudisium',
		'regpd_ipk',
		'regpd_no_seri_ijazah',
		'regpd_sert_prof',
		'regpd_a_pindah_mhs_asing',
		'regpd_nm_pt_asal',
		'regpd_nm_prodi_asal',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
