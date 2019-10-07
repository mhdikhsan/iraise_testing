<?php
/* @var $this MahasiswaController */
/* @var $data Mahasiswa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pd')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pd), array('view', 'id'=>$data->id_pd)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_pd')); ?>:</b>
	<?php echo CHtml::encode($data->nm_pd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jk')); ?>:</b>
	<?php echo CHtml::encode($data->jk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nisn')); ?>:</b>
	<?php echo CHtml::encode($data->nisn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nik')); ?>:</b>
	<?php echo CHtml::encode($data->nik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmpt_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tmpt_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_agama')); ?>:</b>
	<?php echo CHtml::encode($data->id_agama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kk')); ?>:</b>
	<?php echo CHtml::encode($data->id_kk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sp')); ?>:</b>
	<?php echo CHtml::encode($data->id_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jln')); ?>:</b>
	<?php echo CHtml::encode($data->jln); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rt')); ?>:</b>
	<?php echo CHtml::encode($data->rt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rw')); ?>:</b>
	<?php echo CHtml::encode($data->rw); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_dsn')); ?>:</b>
	<?php echo CHtml::encode($data->nm_dsn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ds_kel')); ?>:</b>
	<?php echo CHtml::encode($data->ds_kel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_wil')); ?>:</b>
	<?php echo CHtml::encode($data->id_wil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pos')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jns_tinggal')); ?>:</b>
	<?php echo CHtml::encode($data->id_jns_tinggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_alat_transport')); ?>:</b>
	<?php echo CHtml::encode($data->id_alat_transport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telepon_rumah')); ?>:</b>
	<?php echo CHtml::encode($data->telepon_rumah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telepon_seluler')); ?>:</b>
	<?php echo CHtml::encode($data->telepon_seluler); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_terima_kps')); ?>:</b>
	<?php echo CHtml::encode($data->a_terima_kps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_kps')); ?>:</b>
	<?php echo CHtml::encode($data->no_kps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stat_pd')); ?>:</b>
	<?php echo CHtml::encode($data->stat_pd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_ayah')); ?>:</b>
	<?php echo CHtml::encode($data->nm_ayah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir_ayah')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir_ayah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jenjang_pendidikan_ayah')); ?>:</b>
	<?php echo CHtml::encode($data->id_jenjang_pendidikan_ayah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pekerjaan_ayah')); ?>:</b>
	<?php echo CHtml::encode($data->id_pekerjaan_ayah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_penghasilan_ayah')); ?>:</b>
	<?php echo CHtml::encode($data->id_penghasilan_ayah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kebutuhan_khusus_ayah')); ?>:</b>
	<?php echo CHtml::encode($data->id_kebutuhan_khusus_ayah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_ibu_kandung')); ?>:</b>
	<?php echo CHtml::encode($data->nm_ibu_kandung); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir_ibu')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir_ibu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jenjang_pendidikan_ibu')); ?>:</b>
	<?php echo CHtml::encode($data->id_jenjang_pendidikan_ibu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_penghasilan_ibu')); ?>:</b>
	<?php echo CHtml::encode($data->id_penghasilan_ibu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pekerjaan_ibu')); ?>:</b>
	<?php echo CHtml::encode($data->id_pekerjaan_ibu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kebutuhan_khusus_ibu')); ?>:</b>
	<?php echo CHtml::encode($data->id_kebutuhan_khusus_ibu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_wali')); ?>:</b>
	<?php echo CHtml::encode($data->nm_wali); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir_wali')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir_wali); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jenjang_pendidikan_wali')); ?>:</b>
	<?php echo CHtml::encode($data->id_jenjang_pendidikan_wali); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pekerjaan_wali')); ?>:</b>
	<?php echo CHtml::encode($data->id_pekerjaan_wali); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_penghasilan_wali')); ?>:</b>
	<?php echo CHtml::encode($data->id_penghasilan_wali); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kewarganegaraan')); ?>:</b>
	<?php echo CHtml::encode($data->kewarganegaraan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_id_reg_pd')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_id_reg_pd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_id_sms')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_id_sms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_id_pd')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_id_pd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_id_sp')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_id_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_id_jns_daftar')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_id_jns_daftar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_nipd')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_nipd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_tgl_masuk_sp')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_tgl_masuk_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_id_jns_keluar')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_id_jns_keluar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_tgl_keluar')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_tgl_keluar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_ket')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_ket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_skhun')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_skhun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_a_pernah_paud')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_a_pernah_paud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_a_pernah_tk')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_a_pernah_tk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_mulai_smt')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_mulai_smt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_sks_diakui')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_sks_diakui); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_jalur_skripsi')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_jalur_skripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_judul_skripsi')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_judul_skripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_bln_awal_bimbingan')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_bln_awal_bimbingan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_bln_akhir_bimbingan')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_bln_akhir_bimbingan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_sk_yudisium')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_sk_yudisium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_tgl_sk_yudisium')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_tgl_sk_yudisium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_ipk')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_ipk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_no_seri_ijazah')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_no_seri_ijazah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_sert_prof')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_sert_prof); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_a_pindah_mhs_asing')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_a_pindah_mhs_asing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_nm_pt_asal')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_nm_pt_asal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regpd_nm_prodi_asal')); ?>:</b>
	<?php echo CHtml::encode($data->regpd_nm_prodi_asal); ?>
	<br />

	*/ ?>

</div>