<?php


class Mahasiswa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mahasiswa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $filee="";
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pd, nm_pd', 'required','message'=>'kolom {attribute} tidak boleh kosong.'),
			
			// array('id_pd, nm_pd, jk, tmpt_lahir, tgl_lahir, id_agama, rt,rw,nik,telepon_seluler, jln, ,ds_kel, id_jns_tinggal, id_alat_transport, nm_ayah, id_jenjang_pendidikan_ayah, id_pekerjaan_ayah, id_penghasilan_ayah,tgl_lahir_ayah,nm_ibu_kandung, id_penghasilan_ibu, id_pekerjaan_ibu,id_jenjang_pendidikan_ibu,tgl_lahir_ibu, kewarganegaraan', 'required'),
			
			array('id_agama, id_kk, id_pekerjaan_ayah, id_penghasilan_ayah, id_kebutuhan_khusus_ayah, id_penghasilan_ibu, id_pekerjaan_ibu, id_kebutuhan_khusus_ibu, id_pekerjaan_wali, id_penghasilan_wali', 'numerical', 'integerOnly'=>true),
			array('id_pd, id_sp, regpd_id_reg_pd, regpd_id_sms, regpd_id_pd, regpd_id_sp,lock_id', 'length', 'max'=>50),
			array('nm_pd, nm_ayah, nm_ibu_kandung,tgl_lahir,tgl_lahir_ayah,tgl_lahir_ibu,tgl_lahir_wali', 'length', 'max'=>60),
			array('jk, stat_pd, regpd_id_jns_keluar', 'length', 'max'=>1),
			array('nisn, regpd_sks_diakui, regpd_ipk', 'length', 'max'=>10),
			array('nik', 'length', 'max'=>16),
			array('tmpt_lahir', 'length', 'max'=>32),
			array('jln,lock_id', 'length', 'max'=>80),
			array('rt, rw, kode_pos, id_jns_tinggal, id_alat_transport, id_jenjang_pendidikan_ayah, id_jenjang_pendidikan_ibu, id_jenjang_pendidikan_wali, regpd_id_jns_daftar, regpd_a_pernah_paud, regpd_a_pernah_tk, regpd_mulai_smt, regpd_jalur_skripsi, regpd_a_pindah_mhs_asing', 'length', 'max'=>5),
			array('nm_dsn, ds_kel, email, regpd_nm_pt_asal, regpd_nm_prodi_asal', 'length', 'max'=>50),
			array('id_wil', 'length', 'max'=>8),
			array('telepon_rumah, telepon_seluler, regpd_skhun', 'length', 'max'=>20),
			array('a_terima_kps, kewarganegaraan', 'length', 'max'=>2),
			array('no_kps, regpd_sk_yudisium, regpd_no_seri_ijazah, regpd_sert_prof', 'length', 'max'=>40),
			array('nm_wali', 'length', 'max'=>30),
			array('regpd_nipd', 'length', 'max'=>18),
			array('regpd_ket', 'length', 'max'=>128),
			array('regpd_judul_skripsi, beasiswa_bidikmisi', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pd, nm_pd, jk, nisn, nik, tmpt_lahir, tgl_lahir, id_agama, id_kk, id_sp, jln, rt, rw, nm_dsn, ds_kel, id_wil, kode_pos, id_jns_tinggal, id_alat_transport, telepon_rumah, telepon_seluler, email, a_terima_kps, no_kps, stat_pd, nm_ayah, tgl_lahir_ayah, id_jenjang_pendidikan_ayah, id_pekerjaan_ayah, id_penghasilan_ayah, id_kebutuhan_khusus_ayah, nm_ibu_kandung, tgl_lahir_ibu, id_jenjang_pendidikan_ibu, id_penghasilan_ibu, id_pekerjaan_ibu, id_kebutuhan_khusus_ibu, nm_wali, tgl_lahir_wali, id_jenjang_pendidikan_wali, id_pekerjaan_wali, id_penghasilan_wali, kewarganegaraan, regpd_id_reg_pd, regpd_id_sms, regpd_id_pd, regpd_id_sp, regpd_id_jns_daftar, regpd_nipd, regpd_tgl_masuk_sp, regpd_id_jns_keluar, regpd_tgl_keluar, regpd_ket, regpd_skhun, regpd_a_pernah_paud, regpd_a_pernah_tk, regpd_mulai_smt, regpd_sks_diakui, regpd_jalur_skripsi, regpd_judul_skripsi, regpd_bln_awal_bimbingan, regpd_bln_akhir_bimbingan, regpd_sk_yudisium, regpd_tgl_sk_yudisium, regpd_ipk, regpd_no_seri_ijazah, regpd_sert_prof, regpd_a_pindah_mhs_asing, regpd_nm_pt_asal, regpd_nm_prodi_asal', 'safe', 'on'=>'search'),
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
			'bak'=>array(self::HAS_ONE, 'Bak', 'id_pd'),
			'dosen' => array(self::HAS_ONE, 'Dosen', 'id_ptk', 
                'through' => 'bak'),
			'kuliah'=>array(self::HAS_ONE, 'KuliahMhs', 'id_reg_pd'),
			'agama'=>array(self::BELONGS_TO, 'Agama', 'id_agama'),
			'jenjdidikayah'=>array(self::BELONGS_TO,  'JenjangPendidikan', 'id_jenjang_pendidikan_ayah'),
			'jenjdidikibu'=>array(self::BELONGS_TO,  'JenjangPendidikan', 'id_jenjang_pendidikan_ibu'),
			'kerjaayah'=>array(self::BELONGS_TO,  'Pekerjaan', 'id_pekerjaan_ayah'),
			'kerjaibu'=>array(self::BELONGS_TO,  'Pekerjaan', 'id_pekerjaan_ibu'),
			'penghasilanayah'=>array(self::BELONGS_TO,  'Penghasilan', 'id_penghasilan_ayah'),
			'penghasilanibu'=>array(self::BELONGS_TO,  'Penghasilan', 'id_penghasilan_ibu'),
			'kec'=>array(self::BELONGS_TO,  'Wilayah', 'id_wil'),
			'kab' => array(self::HAS_ONE, 'Wilayah', 'id_induk_wilayah', 
                'through' => 'kec'),
			'prov' => array(self::HAS_ONE, 'Wilayah', 'id_induk_wilayah', 
                'through' => 'kab'),
			'negara' => array(self::HAS_ONE, 'Wilayah', 'id_induk_wilayah', 
                'through' => 'prov'),
			'sms'=>array(self::BELONGS_TO, 'Sms', 'regpd_id_sms'),
			'induksms'=>array(self::BELONGS_TO, 'Sms', 'id_induk_sms',
				'through' => 'sms'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pd' => 'NIM',
			'nm_pd' => 'Nama',
			'jk' => 'Jenis Kelamin',
			'nisn' => 'NISN',
			'nik' => 'Nomor Induk Kependudukan',
			'tmpt_lahir' => 'Tempat Lahir',
			'tgl_lahir' => 'Tanggal Lahir',
			'id_agama' => 'Agama dan Foto',
			'id_kk' => 'Kk',
			'id_sp' => 'ID Universitas',
			'jln' => 'Jalan',
			'rt' => 'RT',
			'rw' => 'RW',
			'nm_dsn' => 'Nama Dusun',
			'ds_kel' => 'Kelurahan',
			'id_wil' => 'Wilayah',
			'kode_pos' => 'Kode Pos',
			'id_jns_tinggal' => 'Jenis Tinggal',
			'id_alat_transport' => 'Alat Transport',
			'telepon_rumah' => 'Telepon Rumah',
			'telepon_seluler' => 'Telepon Seluler',
			'email' => 'Email',
			'a_terima_kps' => 'A Terima Kps',
			'no_kps' => 'No Kps',
			'stat_pd' => 'Status Mahasiswa',
			'nm_ayah' => 'Nama Ayah',
			'tgl_lahir_ayah' => 'Tanggal Lahir Ayah',
			'id_jenjang_pendidikan_ayah' => 'Jenjang Pendidikan Ayah',
			'id_pekerjaan_ayah' => 'Pekerjaan Ayah',
			'id_penghasilan_ayah' => 'Penghasilan Ayah',
			'id_kebutuhan_khusus_ayah' => 'Kebutuhan Khusus Ayah',
			'nm_ibu_kandung' => 'Nama Ibu Kandung',
			'tgl_lahir_ibu' => 'Tanggal Lahir Ibu',
			'id_jenjang_pendidikan_ibu' => 'Jenjang Pendidikan Ibu',
			'id_penghasilan_ibu' => 'Penghasilan Ibu',
			'id_pekerjaan_ibu' => 'Pekerjaan Ibu',
			'id_kebutuhan_khusus_ibu' => 'Kebutuhan Khusus Ibu',
			'nm_wali' => 'Nm Wali',
			'tgl_lahir_wali' => 'Tgl Lahir Wali',
			'id_jenjang_pendidikan_wali' => 'Jenjang Pendidikan Wali',
			'id_pekerjaan_wali' => 'Id Pekerjaan Wali',
			'id_penghasilan_wali' => 'Id Penghasilan Wali',
			'kewarganegaraan' => 'Kewarganegaraan',
			'regpd_id_reg_pd' => 'Regpd Id Reg Pd',
			'regpd_id_sms' => 'Regpd Id Sms',
			'regpd_id_pd' => 'Regpd Id Pd',
			'regpd_id_sp' => 'Regpd Id Sp',
			'regpd_id_jns_daftar' => 'Regpd Id Jns Daftar',
			'regpd_nipd' => 'Regpd Nipd',
			'regpd_tgl_masuk_sp' => 'Regpd Tgl Masuk Sp',
			'regpd_id_jns_keluar' => 'Regpd Id Jns Keluar',
			'regpd_tgl_keluar' => 'Regpd Tgl Keluar',
			'regpd_ket' => 'Regpd Ket',
			'regpd_skhun' => 'Regpd Skhun',
			'regpd_a_pernah_paud' => 'Regpd A Pernah Paud',
			'regpd_a_pernah_tk' => 'Regpd A Pernah Tk',
			'regpd_mulai_smt' => 'Regpd Mulai Smt',
			'regpd_sks_diakui' => 'Regpd Sks Diakui',
			'regpd_jalur_skripsi' => 'Regpd Jalur Skripsi',
			'regpd_judul_skripsi' => 'Regpd Judul Skripsi',
			'regpd_bln_awal_bimbingan' => 'Regpd Bln Awal Bimbingan',
			'regpd_bln_akhir_bimbingan' => 'Regpd Bln Akhir Bimbingan',
			'regpd_sk_yudisium' => 'Regpd Sk Yudisium',
			'regpd_tgl_sk_yudisium' => 'Regpd Tgl Sk Yudisium',
			'regpd_ipk' => 'Regpd Ipk',
			'regpd_no_seri_ijazah' => 'Regpd No Seri Ijazah',
			'regpd_sert_prof' => 'Regpd Sert Prof',
			'regpd_a_pindah_mhs_asing' => 'Regpd A Pindah Mhs Asing',
			'regpd_nm_pt_asal' => 'Regpd Nm Pt Asal',
			'regpd_nm_prodi_asal' => 'Regpd Nm Prodi Asal',
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

		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$this->regpd_id_sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function search2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$this->regpd_id_sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp."-07",true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function report($stat,$sms,$smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;	
		
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);
		
		// $criteria->condition = "regpd_id_sms=:regpd_id_sms";
		// $criteria->params = array (	
		// ':regpd_id_sms' => $sms,
		// );
		// $stat = "A";
		$criteria->select='t.id_pd,t.nm_pd,t.jk';
		$criteria->join='JOIN kuliah_mhs k ON t.id_pd=k.id_reg_pd';
		$criteria->condition = "k.id_smt=:id_smt AND regpd_id_sms=:regpd_id_sms AND id_stat_mhs=:id_stat_mhs";
		$criteria->params = array (	
			':id_smt' => $smt,
			':regpd_id_sms' => $sms,
			':id_stat_mhs' => $stat,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function reportFak($stat,$sms,$smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;	
		
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);
		
		// $criteria->condition = "regpd_id_sms=:regpd_id_sms";
		// $criteria->params = array (	
		// ':regpd_id_sms' => $sms,
		// );
		// $stat = "A";
		//$criteria->select='t.id_pd,t.nm_pd,t.jk';
		$criteria->join='INNER JOIN kuliah_mhs k ON t.id_pd=k.id_reg_pd INNER JOIN sms s ON t.regpd_id_sms=s.id_sms';
		
		$criteria->condition = "k.id_smt=". $smt." AND s.id_induk_sms=:id_induk_sms AND k.id_stat_mhs=:id_stat_mhs";
		$criteria->params = array (	

			':id_induk_sms' => $sms,
			':id_stat_mhs' => $stat,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function reportFakultas($stat,$sms,$smt)
	{

		$criteria=new CDbCriteria;	
		
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$this->regpd_id_sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);
		
		$criteria->select='t.id_pd,t.nm_pd,t.jk,t.tmpt_lahir,tgl_lahir,t.regpd_id_sms';
		$criteria->join='JOIN kuliah_mhs k ON t.id_pd=k.id_reg_pd ';
		$criteria->join.='JOIN sms s ON t.regpd_id_sms=s.id_sms';
		$criteria->condition = "k.id_smt=:id_smt AND s.id_induk_sms=:id_induk_sms AND id_stat_mhs=:id_stat_mhs";
		$criteria->params = array (	
			':id_smt' => $smt,
			':id_induk_sms' => $sms,
			':id_stat_mhs' => $stat,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function reportAll($stat,$sms,$smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;	
		
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);
		
		// $criteria->condition = "regpd_id_sms=:regpd_id_sms";
		// $criteria->params = array (	
		// ':regpd_id_sms' => $sms,
		// );
		// $stat = "A";
		$criteria->select='t.id_pd,t.nm_pd,t.jk';
		$criteria->join='JOIN kuliah_mhs k ON t.id_pd=k.id_reg_pd ';
		$criteria->join.='JOIN sms s ON t.regpd_id_sms=s.id_sms';
		$criteria->condition = "k.id_smt=:id_smt AND id_stat_mhs=:id_stat_mhs";
		$criteria->params = array (	
			':id_smt' => $smt,
			// ':id_induk_sms' => $sms,
			':id_stat_mhs' => $stat,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function admin()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');

		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		$criteria->compare('regpd_id_sms',$sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);
		
		// $criteria->condition = "regpd_id_sms=:regpd_id_sms";
		// $criteria->params = array (	
		// ':regpd_id_sms' => $sms,
		// );
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function akademikfak()
	{
		
		$criteria=new CDbCriteria;
		$fak=Yii::app()->session->get('sms');
		$sms=Yii::app()->db->createCommand("select id_sms from sms where id_induk_sms LIKE :id_sms")->bindParam(":id_sms", $fak, PDO::PARAM_STR)->queryAll();
		$id_sms=array();
		foreach ($sms as $data){
			$id_sms[]="'".$data['id_sms']."'"; 
		}
		$sms = implode (',',$id_sms);
		

		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('nm_pd',$this->nm_pd,true);
		$criteria->compare('jk',$this->jk,true);
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('tmpt_lahir',$this->tmpt_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kk',$this->id_kk);
		$criteria->compare('id_sp',$this->id_sp,true);
		$criteria->compare('jln',$this->jln,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('nm_dsn',$this->nm_dsn,true);
		$criteria->compare('ds_kel',$this->ds_kel,true);
		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('id_jns_tinggal',$this->id_jns_tinggal,true);
		$criteria->compare('id_alat_transport',$this->id_alat_transport,true);
		$criteria->compare('telepon_rumah',$this->telepon_rumah,true);
		$criteria->compare('telepon_seluler',$this->telepon_seluler,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('a_terima_kps',$this->a_terima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('stat_pd',$this->stat_pd,true);
		$criteria->compare('nm_ayah',$this->nm_ayah,true);
		$criteria->compare('tgl_lahir_ayah',$this->tgl_lahir_ayah,true);
		$criteria->compare('id_jenjang_pendidikan_ayah',$this->id_jenjang_pendidikan_ayah,true);
		$criteria->compare('id_pekerjaan_ayah',$this->id_pekerjaan_ayah);
		$criteria->compare('id_penghasilan_ayah',$this->id_penghasilan_ayah);
		$criteria->compare('id_kebutuhan_khusus_ayah',$this->id_kebutuhan_khusus_ayah);
		$criteria->compare('nm_ibu_kandung',$this->nm_ibu_kandung,true);
		$criteria->compare('tgl_lahir_ibu',$this->tgl_lahir_ibu,true);
		$criteria->compare('id_jenjang_pendidikan_ibu',$this->id_jenjang_pendidikan_ibu,true);
		$criteria->compare('id_penghasilan_ibu',$this->id_penghasilan_ibu);
		$criteria->compare('id_pekerjaan_ibu',$this->id_pekerjaan_ibu);
		$criteria->compare('id_kebutuhan_khusus_ibu',$this->id_kebutuhan_khusus_ibu);
		$criteria->compare('nm_wali',$this->nm_wali,true);
		$criteria->compare('tgl_lahir_wali',$this->tgl_lahir_wali,true);
		$criteria->compare('id_jenjang_pendidikan_wali',$this->id_jenjang_pendidikan_wali,true);
		$criteria->compare('id_pekerjaan_wali',$this->id_pekerjaan_wali);
		$criteria->compare('id_penghasilan_wali',$this->id_penghasilan_wali);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan,true);
		$criteria->compare('regpd_id_reg_pd',$this->regpd_id_reg_pd,true);
		//$criteria->compare('regpd_id_sms',$sms,true);
		$criteria->compare('regpd_id_pd',$this->regpd_id_pd,true);
		$criteria->compare('regpd_id_sp',$this->regpd_id_sp,true);
		$criteria->compare('regpd_id_jns_daftar',$this->regpd_id_jns_daftar,true);
		$criteria->compare('regpd_nipd',$this->regpd_nipd,true);
		$criteria->compare('regpd_tgl_masuk_sp',$this->regpd_tgl_masuk_sp,true);
		$criteria->compare('regpd_id_jns_keluar',$this->regpd_id_jns_keluar,true);
		$criteria->compare('regpd_tgl_keluar',$this->regpd_tgl_keluar,true);
		$criteria->compare('regpd_ket',$this->regpd_ket,true);
		$criteria->compare('regpd_skhun',$this->regpd_skhun,true);
		$criteria->compare('regpd_a_pernah_paud',$this->regpd_a_pernah_paud,true);
		$criteria->compare('regpd_a_pernah_tk',$this->regpd_a_pernah_tk,true);
		$criteria->compare('regpd_mulai_smt',$this->regpd_mulai_smt,true);
		$criteria->compare('regpd_sks_diakui',$this->regpd_sks_diakui,true);
		$criteria->compare('regpd_jalur_skripsi',$this->regpd_jalur_skripsi,true);
		$criteria->compare('regpd_judul_skripsi',$this->regpd_judul_skripsi,true);
		$criteria->compare('regpd_bln_awal_bimbingan',$this->regpd_bln_awal_bimbingan,true);
		$criteria->compare('regpd_bln_akhir_bimbingan',$this->regpd_bln_akhir_bimbingan,true);
		$criteria->compare('regpd_sk_yudisium',$this->regpd_sk_yudisium,true);
		$criteria->compare('regpd_tgl_sk_yudisium',$this->regpd_tgl_sk_yudisium,true);
		$criteria->compare('regpd_ipk',$this->regpd_ipk,true);
		$criteria->compare('regpd_no_seri_ijazah',$this->regpd_no_seri_ijazah,true);
		$criteria->compare('regpd_sert_prof',$this->regpd_sert_prof,true);
		$criteria->compare('regpd_a_pindah_mhs_asing',$this->regpd_a_pindah_mhs_asing,true);
		$criteria->compare('regpd_nm_pt_asal',$this->regpd_nm_pt_asal,true);
		$criteria->compare('regpd_nm_prodi_asal',$this->regpd_nm_prodi_asal,true);
		$criteria->condition = "regpd_id_sms IN ($sms)";
		//$criteria->params = array(':sms'=>"$sms");	
		
		//var_dump($criteria);die();
		return new CActiveDataProvider($this, array(
			
			'criteria'=>$criteria,
			
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mahasiswa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
