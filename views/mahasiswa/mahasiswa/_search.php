<?php
/* @var $this MahasiswaController */
/* @var $model Mahasiswa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_pd'); ?>
		<?php echo $form->textField($model,'id_pd',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nm_pd'); ?>
		<?php echo $form->textField($model,'nm_pd',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jk'); ?>
		<?php echo $form->textField($model,'jk',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nisn'); ?>
		<?php echo $form->textField($model,'nisn',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nik'); ?>
		<?php echo $form->textField($model,'nik',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tmpt_lahir'); ?>
		<?php echo $form->textField($model,'tmpt_lahir',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lahir'); ?>
		<?php echo $form->textField($model,'tgl_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_agama'); ?>
		<?php echo $form->textField($model,'id_agama'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_kk'); ?>
		<?php echo $form->textField($model,'id_kk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_sp'); ?>
		<?php echo $form->textField($model,'id_sp',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jln'); ?>
		<?php echo $form->textField($model,'jln',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rt'); ?>
		<?php echo $form->textField($model,'rt',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rw'); ?>
		<?php echo $form->textField($model,'rw',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nm_dsn'); ?>
		<?php echo $form->textField($model,'nm_dsn',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ds_kel'); ?>
		<?php echo $form->textField($model,'ds_kel',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_wil'); ?>
		<?php echo $form->textField($model,'id_wil',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_pos'); ?>
		<?php echo $form->textField($model,'kode_pos',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_jns_tinggal'); ?>
		<?php echo $form->textField($model,'id_jns_tinggal',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_alat_transport'); ?>
		<?php echo $form->textField($model,'id_alat_transport',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telepon_rumah'); ?>
		<?php echo $form->textField($model,'telepon_rumah',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telepon_seluler'); ?>
		<?php echo $form->textField($model,'telepon_seluler',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a_terima_kps'); ?>
		<?php echo $form->textField($model,'a_terima_kps',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_kps'); ?>
		<?php echo $form->textField($model,'no_kps',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stat_pd'); ?>
		<?php echo $form->textField($model,'stat_pd',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nm_ayah'); ?>
		<?php echo $form->textField($model,'nm_ayah',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lahir_ayah'); ?>
		<?php echo $form->textField($model,'tgl_lahir_ayah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_jenjang_pendidikan_ayah'); ?>
		<?php echo $form->textField($model,'id_jenjang_pendidikan_ayah',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pekerjaan_ayah'); ?>
		<?php echo $form->textField($model,'id_pekerjaan_ayah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_penghasilan_ayah'); ?>
		<?php echo $form->textField($model,'id_penghasilan_ayah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_kebutuhan_khusus_ayah'); ?>
		<?php echo $form->textField($model,'id_kebutuhan_khusus_ayah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nm_ibu_kandung'); ?>
		<?php echo $form->textField($model,'nm_ibu_kandung',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lahir_ibu'); ?>
		<?php echo $form->textField($model,'tgl_lahir_ibu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_jenjang_pendidikan_ibu'); ?>
		<?php echo $form->textField($model,'id_jenjang_pendidikan_ibu',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_penghasilan_ibu'); ?>
		<?php echo $form->textField($model,'id_penghasilan_ibu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pekerjaan_ibu'); ?>
		<?php echo $form->textField($model,'id_pekerjaan_ibu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_kebutuhan_khusus_ibu'); ?>
		<?php echo $form->textField($model,'id_kebutuhan_khusus_ibu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nm_wali'); ?>
		<?php echo $form->textField($model,'nm_wali',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_lahir_wali'); ?>
		<?php echo $form->textField($model,'tgl_lahir_wali'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_jenjang_pendidikan_wali'); ?>
		<?php echo $form->textField($model,'id_jenjang_pendidikan_wali',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pekerjaan_wali'); ?>
		<?php echo $form->textField($model,'id_pekerjaan_wali'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_penghasilan_wali'); ?>
		<?php echo $form->textField($model,'id_penghasilan_wali'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kewarganegaraan'); ?>
		<?php echo $form->textField($model,'kewarganegaraan',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_id_reg_pd'); ?>
		<?php echo $form->textField($model,'regpd_id_reg_pd',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_id_sms'); ?>
		<?php echo $form->textField($model,'regpd_id_sms',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_id_pd'); ?>
		<?php echo $form->textField($model,'regpd_id_pd',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_id_sp'); ?>
		<?php echo $form->textField($model,'regpd_id_sp',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_id_jns_daftar'); ?>
		<?php echo $form->textField($model,'regpd_id_jns_daftar',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_nipd'); ?>
		<?php echo $form->textField($model,'regpd_nipd',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_tgl_masuk_sp'); ?>
		<?php echo $form->textField($model,'regpd_tgl_masuk_sp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_id_jns_keluar'); ?>
		<?php echo $form->textField($model,'regpd_id_jns_keluar',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_tgl_keluar'); ?>
		<?php echo $form->textField($model,'regpd_tgl_keluar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_ket'); ?>
		<?php echo $form->textField($model,'regpd_ket',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_skhun'); ?>
		<?php echo $form->textField($model,'regpd_skhun',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_a_pernah_paud'); ?>
		<?php echo $form->textField($model,'regpd_a_pernah_paud',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_a_pernah_tk'); ?>
		<?php echo $form->textField($model,'regpd_a_pernah_tk',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_mulai_smt'); ?>
		<?php echo $form->textField($model,'regpd_mulai_smt',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_sks_diakui'); ?>
		<?php echo $form->textField($model,'regpd_sks_diakui',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_jalur_skripsi'); ?>
		<?php echo $form->textField($model,'regpd_jalur_skripsi',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_judul_skripsi'); ?>
		<?php echo $form->textField($model,'regpd_judul_skripsi',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_bln_awal_bimbingan'); ?>
		<?php echo $form->textField($model,'regpd_bln_awal_bimbingan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_bln_akhir_bimbingan'); ?>
		<?php echo $form->textField($model,'regpd_bln_akhir_bimbingan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_sk_yudisium'); ?>
		<?php echo $form->textField($model,'regpd_sk_yudisium',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_tgl_sk_yudisium'); ?>
		<?php echo $form->textField($model,'regpd_tgl_sk_yudisium'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_ipk'); ?>
		<?php echo $form->textField($model,'regpd_ipk',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_no_seri_ijazah'); ?>
		<?php echo $form->textField($model,'regpd_no_seri_ijazah',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_sert_prof'); ?>
		<?php echo $form->textField($model,'regpd_sert_prof',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_a_pindah_mhs_asing'); ?>
		<?php echo $form->textField($model,'regpd_a_pindah_mhs_asing',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_nm_pt_asal'); ?>
		<?php echo $form->textField($model,'regpd_nm_pt_asal',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regpd_nm_prodi_asal'); ?>
		<?php echo $form->textField($model,'regpd_nm_prodi_asal',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->