<?php

/**
 * This is the model class for table "dosen".
 *
 * The followings are the available columns in table 'dosen':
 * @property string $id_ptk
 * @property string $id_blob
 * @property string $id_ikatan_kerja
 * @property string $nm_ptk
 * @property string $nidn
 * @property string $nip
 * @property string $jk
 * @property string $tmpt_lahir
 * @property string $tgl_lahir
 * @property string $nik
 * @property string $niy_nigk
 * @property string $nuptk
 * @property integer $id_stat_pegawai
 * @property string $id_jns_ptk
 * @property integer $id_bid_pengawas
 * @property integer $id_agama
 * @property string $jln
 * @property string $rt
 * @property string $rw
 * @property string $nm_dsn
 * @property string $ds_kel
 * @property string $id_wil
 * @property string $kode_pos
 * @property string $no_tel_rmh
 * @property string $no_hp
 * @property string $email
 * @property string $id_sp
 * @property string $id_stat_aktif
 * @property string $sk_cpns
 * @property string $tgl_sk_cpns
 * @property string $sk_angkat
 * @property string $tmt_sk_angkat
 * @property string $id_lemb_angkat
 * @property string $id_pangkat_gol
 * @property integer $id_keahlian_lab
 * @property string $id_sumber_gaji
 * @property string $nm_ibu_kandung
 * @property string $stat_kawin
 * @property string $nm_suami_istri
 * @property string $nip_suami_istri
 * @property integer $id_pekerjaan_suami_istri
 * @property string $tmt_pns
 * @property string $a_lisensi_kepsek
 * @property integer $jml_sekolah_binaan
 * @property string $a_diklat_awas
 * @property string $akta_ijin_ajar
 * @property string $nira
 * @property integer $stat_data
 * @property integer $mampu_handle_kk
 * @property string $a_braille
 * @property string $a_bhs_isyarat
 * @property string $npwp
 * @property string $kewarganegaraan
 * @property string $regptk_id_reg_ptk
 * @property string $regptk_id_ptk
 * @property string $regptk_id_sp
 * @property string $regptk_id_thn_ajaran
 * @property string $regptk_id_sms
 * @property string $regptk_no_srt_tgs
 * @property string $regptk_tgl_srt_tgs
 * @property string $regptk_tmt_srt_tgs
 * @property string $regptk_a_sp_homebase
 * @property string $regptk_a_aktif_bln_1
 * @property string $regptk_a_aktif_bln_2
 * @property string $regptk_a_aktif_bln_3
 * @property string $regptk_a_aktif_bln_4
 * @property string $regptk_a_aktif_bln_5
 * @property string $regptk_a_aktif_bln_6
 * @property string $regptk_a_aktif_bln_7
 * @property string $regptk_a_aktif_bln_8
 * @property string $regptk_a_aktif_bln_9
 * @property string $regptk_a_aktif_bln_10
 * @property string $regptk_a_aktif_bln_11
 * @property string $regptk_a_aktif_bln_12
 * @property string $regptk_id_jns_keluar
 * @property string $regptk_tgl_ptk_keluar
 */
class Dosen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dosen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ptk', 'required'),
			array('id_stat_pegawai, id_bid_pengawas, id_agama, id_keahlian_lab, id_pekerjaan_suami_istri, jml_sekolah_binaan, stat_data, mampu_handle_kk', 'numerical', 'integerOnly'=>true),
			array('id_ptk, id_blob, id_jns_ptk, id_sp, id_stat_aktif, id_sumber_gaji, a_lisensi_kepsek, regptk_id_sms', 'length', 'max'=>25),
			array('id_ikatan_kerja, jk, akta_ijin_ajar, regptk_id_jns_keluar', 'length', 'max'=>1),
			array('nm_ptk, nm_ibu_kandung, nm_suami_istri', 'length', 'max'=>60),
			array('nidn, rt, rw, id_lemb_angkat, id_pangkat_gol, stat_kawin, a_diklat_awas, regptk_id_thn_ajaran, regptk_a_sp_homebase, regptk_a_aktif_bln_1, regptk_a_aktif_bln_2, regptk_a_aktif_bln_3, regptk_a_aktif_bln_4, regptk_a_aktif_bln_5, regptk_a_aktif_bln_6, regptk_a_aktif_bln_7, regptk_a_aktif_bln_8, regptk_a_aktif_bln_9, regptk_a_aktif_bln_10, regptk_a_aktif_bln_11, regptk_a_aktif_bln_12', 'length', 'max'=>10),
			array('nip, nip_suami_istri', 'length', 'max'=>18),
			array('tmpt_lahir', 'length', 'max'=>32),
			array('nik, nuptk', 'length', 'max'=>16),
			array('niy_nigk, nira', 'length', 'max'=>30),
			array('jln', 'length', 'max'=>80),
			array('nm_dsn, ds_kel, email, regptk_id_reg_ptk, regptk_id_ptk, regptk_id_sp', 'length', 'max'=>50),
			array('id_wil', 'length', 'max'=>8),
			array('kode_pos, a_braille, a_bhs_isyarat', 'length', 'max'=>5),
			array('no_tel_rmh, no_hp', 'length', 'max'=>20),
			array('sk_cpns, sk_angkat, regptk_no_srt_tgs', 'length', 'max'=>40),
			array('npwp', 'length', 'max'=>15),
			array('kewarganegaraan', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ptk, id_blob, id_ikatan_kerja, nm_ptk, nidn, nip, jk, tmpt_lahir, tgl_lahir, nik, niy_nigk, nuptk, id_stat_pegawai, id_jns_ptk, id_bid_pengawas, id_agama, jln, rt, rw, nm_dsn, ds_kel, id_wil, kode_pos, no_tel_rmh, no_hp, email, id_sp, id_stat_aktif, sk_cpns, tgl_sk_cpns, sk_angkat, tmt_sk_angkat, id_lemb_angkat, id_pangkat_gol, id_keahlian_lab, id_sumber_gaji, nm_ibu_kandung, stat_kawin, nm_suami_istri, nip_suami_istri, id_pekerjaan_suami_istri, tmt_pns, a_lisensi_kepsek, jml_sekolah_binaan, a_diklat_awas, akta_ijin_ajar, nira, stat_data, mampu_handle_kk, a_braille, a_bhs_isyarat, npwp, kewarganegaraan, regptk_id_reg_ptk, regptk_id_ptk, regptk_id_sp, regptk_id_thn_ajaran, regptk_id_sms, regptk_no_srt_tgs, regptk_tgl_srt_tgs, regptk_tmt_srt_tgs, regptk_a_sp_homebase, regptk_a_aktif_bln_1, regptk_a_aktif_bln_2, regptk_a_aktif_bln_3, regptk_a_aktif_bln_4, regptk_a_aktif_bln_5, regptk_a_aktif_bln_6, regptk_a_aktif_bln_7, regptk_a_aktif_bln_8, regptk_a_aktif_bln_9, regptk_a_aktif_bln_10, regptk_a_aktif_bln_11, regptk_a_aktif_bln_12, regptk_id_jns_keluar, regptk_tgl_ptk_keluar', 'safe', 'on'=>'search'),
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
			'stat'=>array(self::BELONGS_TO, 'StatusKeaktifanPegawai', 'id_stat_aktif'),
			'Akt'=>array(self::HAS_MANY, 'AktAjarDosen', 'id_reg_ptk'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ptk' => 'NIP',
			'id_blob' => 'Id Blob',
			'id_ikatan_kerja' => 'Id Ikatan Kerja',
			'nm_ptk' => 'Nama Dosen',
			'nidn' => 'Nidn',
			'nip' => 'Nip',
			'jk' => 'Jenis Kelamin',
			'tmpt_lahir' => 'Tempat Lahir',
			'tgl_lahir' => 'Tanggal Lahir',
			'nik' => 'Nik',
			'niy_nigk' => 'Niy Nigk',
			'nuptk' => 'Nuptk',
			'id_stat_pegawai' => 'Status Pegawai',
			'id_jns_ptk' => 'Id Jns Ptk',
			'id_bid_pengawas' => 'Id Bid Pengawas',
			'id_agama' => 'Agama',
			'jln' => 'Jln',
			'rt' => 'Rt',
			'rw' => 'Rw',
			'nm_dsn' => 'Nm Dsn',
			'ds_kel' => 'Ds Kel',
			'id_wil' => 'Id Wil',
			'kode_pos' => 'Kode Pos',
			'no_tel_rmh' => 'No Tel Rmh',
			'no_hp' => 'No Hp',
			'email' => 'Email',
			'id_sp' => 'Id Sp',
			'id_stat_aktif' => 'Status Aktif',
			'sk_cpns' => 'Sk Cpns',
			'tgl_sk_cpns' => 'Tgl Sk Cpns',
			'sk_angkat' => 'Sk Angkat',
			'tmt_sk_angkat' => 'Tmt Sk Angkat',
			'id_lemb_angkat' => 'Id Lemb Angkat',
			'id_pangkat_gol' => 'Id Pangkat Gol',
			'id_keahlian_lab' => 'Id Keahlian Lab',
			'id_sumber_gaji' => 'Id Sumber Gaji',
			'nm_ibu_kandung' => 'Nm Ibu Kandung',
			'stat_kawin' => 'Status Pernikahan',
			'nm_suami_istri' => 'Nm Suami Istri',
			'nip_suami_istri' => 'Nip Suami Istri',
			'id_pekerjaan_suami_istri' => 'Id Pekerjaan Suami Istri',
			'tmt_pns' => 'Tmt Pns',
			'a_lisensi_kepsek' => 'A Lisensi Kepsek',
			'jml_sekolah_binaan' => 'Jml Sekolah Binaan',
			'a_diklat_awas' => 'A Diklat Awas',
			'akta_ijin_ajar' => 'Akta Ijin Ajar',
			'nira' => 'Nira',
			'stat_data' => 'Stat Data',
			'mampu_handle_kk' => 'Mampu Handle Kk',
			'a_braille' => 'A Braille',
			'a_bhs_isyarat' => 'A Bhs Isyarat',
			'npwp' => 'Npwp',
			'kewarganegaraan' => 'Kewarganegaraan',
			'regptk_id_reg_ptk' => 'Regptk Id Reg Ptk',
			'regptk_id_ptk' => 'Regptk Id Ptk',
			'regptk_id_sp' => 'Regptk Id Sp',
			'regptk_id_thn_ajaran' => 'Regptk Id Thn Ajaran',
			'regptk_id_sms' => 'Regptk Id Sms',
			'regptk_no_srt_tgs' => 'Regptk No Srt Tgs',
			'regptk_tgl_srt_tgs' => 'Regptk Tgl Srt Tgs',
			'regptk_tmt_srt_tgs' => 'Regptk Tmt Srt Tgs',
			'regptk_a_sp_homebase' => 'Regptk A Sp Homebase',
			'regptk_a_aktif_bln_1' => 'Regptk A Aktif Bln 1',
			'regptk_a_aktif_bln_2' => 'Regptk A Aktif Bln 2',
			'regptk_a_aktif_bln_3' => 'Regptk A Aktif Bln 3',
			'regptk_a_aktif_bln_4' => 'Regptk A Aktif Bln 4',
			'regptk_a_aktif_bln_5' => 'Regptk A Aktif Bln 5',
			'regptk_a_aktif_bln_6' => 'Regptk A Aktif Bln 6',
			'regptk_a_aktif_bln_7' => 'Regptk A Aktif Bln 7',
			'regptk_a_aktif_bln_8' => 'Regptk A Aktif Bln 8',
			'regptk_a_aktif_bln_9' => 'Regptk A Aktif Bln 9',
			'regptk_a_aktif_bln_10' => 'Regptk A Aktif Bln 10',
			'regptk_a_aktif_bln_11' => 'Regptk A Aktif Bln 11',
			'regptk_a_aktif_bln_12' => 'Regptk A Aktif Bln 12',
			'regptk_id_jns_keluar' => 'Regptk Id Jns Keluar',
			'regptk_tgl_ptk_keluar' => 'Regptk Tgl Ptk Keluar',
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

		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchprodi()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',Yii::app()->session->get('sms'),true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sms()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$sms=Yii::app()->session->get('sms');
		$criteria=new CDbCriteria;

		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		//$criteria->compare('regptk_id_sms',$sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		// $criteria->condition = "regptk_id_sms=:regptk_id_sms";
		// $criteria->params = array (	
		// ':regptk_id_sms' => $sms,
		// );
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function statusaktif()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='1'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statustdkaktif()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='2'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statuscuti()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='20'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statuskeluar()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='21'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function reportOperator($sms)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
				if($sms=="All")
				{
					$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);	
				}else
				{
					$criteria->compare('regptk_id_sms',$sms,true);
				}
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		// $criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='27'";
		// $criteria->params = array (	
		// ':regptk_id_sms' => $sms,
		// );
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function statusalm()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='22'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statuspensiun()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='23'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statusbelajar()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='24'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statustugas()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='25'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statusganti()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='26'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statustgsbljr()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='27'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statushapus()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='28'";
		$criteria->params = array (	
		':regptk_id_sms' => $sms,
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function statuslain()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		// $criteria->condition = "regptk_id_sms=:regptk_id_sms and id_stat_aktif='99'";
		// $criteria->params = array (	
		// ':regptk_id_sms' => $sms,
		// );
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function opaktif()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = " id_stat_aktif='1'";
		$criteria->params = array (	
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function optidak()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_blob',$this->id_blob,true);
		$criteria->compare('id_ikatan_kerja',$this->id_ikatan_kerja,true);
		$criteria->compare('nm_ptk',$this->nm_ptk,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('niy_nigk',$this->niy_nigk,true);
		$criteria->compare('nuptk',$this->nuptk,true);
		$criteria->compare('id_stat_pegawai',$this->id_stat_pegawai);
		$criteria->compare('id_jns_ptk',$this->id_jns_ptk,true);
		$criteria->compare('id_bid_pengawas',$this->id_bid_pengawas);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('no_tel_rmh',$this->no_tel_rmh,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('id_stat_aktif',$this->id_stat_aktif,true);
		$criteria->compare('sk_cpns',$this->sk_cpns,true);
		$criteria->compare('tgl_sk_cpns',$this->tgl_sk_cpns,true);
		$criteria->compare('sk_angkat',$this->sk_angkat,true);
		$criteria->compare('tmt_sk_angkat',$this->tmt_sk_angkat,true);
		$criteria->compare('id_lemb_angkat',$this->id_lemb_angkat,true);
		$criteria->compare('id_pangkat_gol',$this->id_pangkat_gol,true);
		$criteria->compare('id_keahlian_lab',$this->id_keahlian_lab);
		$criteria->compare('id_sumber_gaji',$this->id_sumber_gaji,true);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('stat_kawin',$this->stat_kawin,true);
		$criteria->compare('nm_suami_istri',$this->nm_suami_istri,true);
		$criteria->compare('nip_suami_istri',$this->nip_suami_istri,true);
		$criteria->compare('id_pekerjaan_suami_istri',$this->id_pekerjaan_suami_istri);
		$criteria->compare('tmt_pns',$this->tmt_pns,true);
		$criteria->compare('a_lisensi_kepsek',$this->a_lisensi_kepsek,true);
		$criteria->compare('jml_sekolah_binaan',$this->jml_sekolah_binaan);
		$criteria->compare('a_diklat_awas',$this->a_diklat_awas,true);
		$criteria->compare('akta_ijin_ajar',$this->akta_ijin_ajar,true);
		$criteria->compare('nira',$this->nira,true);
		$criteria->compare('stat_data',$this->stat_data);
		$criteria->compare('mampu_handle_kk',$this->mampu_handle_kk);
		$criteria->compare('a_braille',$this->a_braille,true);
		$criteria->compare('a_bhs_isyarat',$this->a_bhs_isyarat,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regptk_id_reg_ptk',$this->regptk_id_reg_ptk,true);
		$criteria->compare('regptk_id_ptk',$this->regptk_id_ptk,true);
		$criteria->compare('regptk_id_sp',$this->regptk_id_sp,true);
		$criteria->compare('regptk_id_thn_ajaran',$this->regptk_id_thn_ajaran,true);
		$criteria->compare('regptk_id_sms',$this->regptk_id_sms,true);
		$criteria->compare('regptk_no_srt_tgs',$this->regptk_no_srt_tgs,true);
		$criteria->compare('regptk_tgl_srt_tgs',$this->regptk_tgl_srt_tgs,true);
		$criteria->compare('regptk_tmt_srt_tgs',$this->regptk_tmt_srt_tgs,true);
		$criteria->compare('regptk_a_sp_homebase',$this->regptk_a_sp_homebase,true);
		$criteria->compare('regptk_a_aktif_bln_1',$this->regptk_a_aktif_bln_1,true);
		$criteria->compare('regptk_a_aktif_bln_2',$this->regptk_a_aktif_bln_2,true);
		$criteria->compare('regptk_a_aktif_bln_3',$this->regptk_a_aktif_bln_3,true);
		$criteria->compare('regptk_a_aktif_bln_4',$this->regptk_a_aktif_bln_4,true);
		$criteria->compare('regptk_a_aktif_bln_5',$this->regptk_a_aktif_bln_5,true);
		$criteria->compare('regptk_a_aktif_bln_6',$this->regptk_a_aktif_bln_6,true);
		$criteria->compare('regptk_a_aktif_bln_7',$this->regptk_a_aktif_bln_7,true);
		$criteria->compare('regptk_a_aktif_bln_8',$this->regptk_a_aktif_bln_8,true);
		$criteria->compare('regptk_a_aktif_bln_9',$this->regptk_a_aktif_bln_9,true);
		$criteria->compare('regptk_a_aktif_bln_10',$this->regptk_a_aktif_bln_10,true);
		$criteria->compare('regptk_a_aktif_bln_11',$this->regptk_a_aktif_bln_11,true);
		$criteria->compare('regptk_a_aktif_bln_12',$this->regptk_a_aktif_bln_12,true);
		$criteria->compare('regptk_id_jns_keluar',$this->regptk_id_jns_keluar,true);
		$criteria->compare('regptk_tgl_ptk_keluar',$this->regptk_tgl_ptk_keluar,true);
		
		$criteria->condition = "id_stat_aktif='2'";
		$criteria->params = array (	
		);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dosen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
