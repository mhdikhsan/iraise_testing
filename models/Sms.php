<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sms".
 *
 * The followings are the available columns in table 'sms':
 * @property string $id_sms
 * @property string $nm_lemb
 * @property string $smt_mulai
 * @property string $kode_prodi
 * @property string $id_sp
 * @property string $id_jenj_didik
 * @property string $id_jns_sms
 * @property string $id_pengguna
 * @property string $id_fungsi_lab
 * @property string $id_kel_usaha
 * @property string $id_blob
 * @property string $id_wil
 * @property string $id_jur
 * @property string $id_induk_sms
 * @property string $jln
 * @property string $rt
 * @property string $rw
 * @property string $nm_dsn
 * @property string $ds_kel
 * @property string $kode_pos
 * @property string $lintang
 * @property string $bujur
 * @property string $no_tel
 * @property string $no_fax
 * @property string $email
 * @property string $website
 * @property string $singkatan
 * @property string $tgl_berdiri
 * @property string $sk_selenggara
 * @property string $tgl_sk_selenggara
 * @property string $tmt_sk_selenggara
 * @property string $tst_sk_selenggara
 * @property string $kpst_pd
 * @property string $sks_lulus
 * @property string $gelar_lulusan
 * @property string $stat_prodi
 * @property string $polesei_nilai
 * @property string $luas_lab
 * @property string $kapasitas_prak_satu_shift
 * @property string $jml_mhs_pengguna
 * @property string $jml_jam_penggunaan
 * @property string $jml_prodi_pengguna
 * @property string $jml_modul_prak_sendiri
 * @property string $jml_modul_prak_lain
 * @property string $fungsi_selain_prak
 * @property string $penggunaan_lab
 */
class Sms extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'sms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_sms', 'required'),
			array('id_sms, id_sp, id_pengguna, id_blob, id_induk_sms, lintang, bujur, kpst_pd, luas_lab, jml_mhs_pengguna', 'length', 'max'=>25),
			array('nm_lemb, pimpinan, pimpinan_nip,pimpinan_jab, jln', 'length', 'max'=>80),
			array('nm_lemb_ktm, jln', 'length', 'max'=>80),
			array('smt_mulai, kode_pos,akreditasi', 'length', 'max'=>5),
			array('kode_prodi, id_jenj_didik, id_jns_sms, id_jur, rt,rw, sks_lulus, gelar_lulusan', 'length', 'max'=>10),
			array('id_fungsi_lab, stat_prodi, polesei_nilai, fungsi_selain_prak, penggunaan_lab,bs_pkbl_ptpnv', 'length', 'max'=>1),
			array('id_kel_usaha, id_wil', 'length', 'max'=>8),
			array('nm_dsn, ds_kel, email, singkatan', 'length', 'max'=>50),
			array('tgl_berdiri,tgl_sk_selenggara,tmt_sk_selenggara,tst_sk_selenggara', 'length', 'max'=>60),
			array('no_tel, no_fax, kapasitas_prak_satu_shift, jml_jam_penggunaan, jml_prodi_pengguna, jml_modul_prak_sendiri, jml_modul_prak_lain', 'length', 'max'=>20),
			array('website', 'length', 'max'=>100),
			array('sk_selenggara', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sms, nm_lemb, smt_mulai, kode_prodi, id_sp, id_jenj_didik, id_jns_sms, id_pengguna, id_fungsi_lab, id_kel_usaha, id_blob, id_wil, id_jur, id_induk_sms, jln, rt, rw, nm_dsn, ds_kel, kode_pos, lintang, bujur, no_tel, no_fax, email, website, singkatan, tgl_berdiri, sk_selenggara, tgl_sk_selenggara, tmt_sk_selenggara, tst_sk_selenggara, kpst_pd, sks_lulus, gelar_lulusan, stat_prodi, polesei_nilai, luas_lab, kapasitas_prak_satu_shift, jml_mhs_pengguna, jml_jam_penggunaan, jml_prodi_pengguna, jml_modul_prak_sendiri, jml_modul_prak_lain, fungsi_selain_prak, penggunaan_lab', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'induksms'=>array(self::BELONGS_TO, 'Sms', 'id_induk_sms')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sms' => 'ID Fakultas/Prodi',
			'nm_lemb' => 'Nama Lembaga',
			'nm_lemb_ktm' => 'Nama Lembaga KTM',
			'smt_mulai' => 'Smt Mulai',
			'kode_prodi' => 'Kode Prodi',
			'id_sp' => 'ID UIN',
			'id_jenj_didik' => 'Janjang Didik',
			'id_jns_sms' => 'Jenis SMS',
			'id_pengguna' => 'Id Pengguna',
			'id_fungsi_lab' => 'Fungsi LAB',
			'id_kel_usaha' => 'Id Kel Usaha',
			'id_blob' => 'Id Blob',
			'id_wil' => 'Id Wil',
			'id_jur' => 'Id Jur',
			'id_induk_sms' => 'Induk SMS',
			'jln' => 'Jalan',
			'rt' => 'RT',
			'rw' => 'RW',
			'nm_dsn' => 'Nama Dusun',
			'ds_kel' => 'Desa Kelurahan',
			'kode_pos' => 'Kode Pos',
			'lintang' => 'Lintang',
			'bujur' => 'Bujur',
			'no_tel' => 'No Telp',
			'no_fax' => 'No Fax',
			'email' => 'Email',
			'website' => 'Website',
			'singkatan' => 'Singkatan',
			'tgl_berdiri' => 'Tgl Berdiri',
			'sk_selenggara' => 'Sk Selenggara',
			'tgl_sk_selenggara' => 'Tanggal Sk Selenggara',
			'tmt_sk_selenggara' => 'TMT SK Selenggara',
			'tst_sk_selenggara' => 'Tst SK Selenggara',
			'kpst_pd' => 'Kpst Pd',
			'sks_lulus' => 'SKS Lulus',
			'gelar_lulusan' => 'Gelar Lulusan',
			'stat_prodi' => 'Status Prodi',
			'polesei_nilai' => 'Polesei Nilai',
			'luas_lab' => 'Luas Lab',
			'kapasitas_prak_satu_shift' => 'Kapasitas Prak Satu Shift',
			'jml_mhs_pengguna' => 'Jumlah Mahasiswa Pengguna',
			'jml_jam_penggunaan' => 'Jumlah Jam Penggunaan',
			'jml_prodi_pengguna' => 'Jumlah Prodi Pengguna',
			'jml_modul_prak_sendiri' => 'Jumlah Modul Prak Sendiri',
			'jml_modul_prak_lain' => 'Jumlah Modul Praktikum Lain',
			'fungsi_selain_prak' => 'Fungsi Selain Praktikum',
			'penggunaan_lab' => 'Penggunaan Lab',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('nm_lemb',$this->nm_lemb,true);
		$criteria->compare('smt_mulai',$this->smt_mulai,true);
		$criteria->compare('kode_prodi',$this->kode_prodi,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_jenj_didik',$this->id_jenj_didik,true);
		$criteria->compare('id_jns_sms',$this->id_jns_sms,true);
		$criteria->compare('id_pengguna',$this->id_pengguna,true);
		$criteria->compare('id_fungsi_lab',$this->id_fungsi_lab,true);
		$criteria->compare('id_kel_usaha',$this->id_kel_usaha,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('id_jur',$this->id_jur,true);
		$criteria->compare('id_induk_sms',$this->id_induk_sms,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('lintang',$this->lintang,true);
		$criteria->compare('bujur',$this->bujur,true);
		$criteria->compare('no_tel',$this->no_tel,true);
		$criteria->compare('no_fax',$this->no_fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('singkatan',$this->singkatan,true);
		$criteria->compare('tgl_berdiri',$this->tgl_berdiri,true);
		$criteria->compare('sk_selenggara',$this->sk_selenggara,true);
		$criteria->compare('tgl_sk_selenggara',$this->tgl_sk_selenggara,true);
		$criteria->compare('tmt_sk_selenggara',$this->tmt_sk_selenggara,true);
		$criteria->compare('tst_sk_selenggara',$this->tst_sk_selenggara,true);
		$criteria->compare('kpst_pd',$this->kpst_pd,true);
		$criteria->compare('sks_lulus',$this->sks_lulus,true);
		$criteria->compare('gelar_lulusan',$this->gelar_lulusan,true);
		$criteria->compare('stat_prodi',$this->stat_prodi,true);
		$criteria->compare('polesei_nilai',$this->polesei_nilai,true);
		$criteria->compare('luas_lab',$this->luas_lab,true);
		$criteria->compare('kapasitas_prak_satu_shift',$this->kapasitas_prak_satu_shift,true);
		$criteria->compare('jml_mhs_pengguna',$this->jml_mhs_pengguna,true);
		$criteria->compare('jml_jam_penggunaan',$this->jml_jam_penggunaan,true);
		$criteria->compare('jml_prodi_pengguna',$this->jml_prodi_pengguna,true);
		$criteria->compare('jml_modul_prak_sendiri',$this->jml_modul_prak_sendiri,true);
		$criteria->compare('jml_modul_prak_lain',$this->jml_modul_prak_lain,true);
		$criteria->compare('fungsi_selain_prak',$this->fungsi_selain_prak,true);
		$criteria->compare('penggunaan_lab',$this->penggunaan_lab,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sms the static model class
	 */

}
