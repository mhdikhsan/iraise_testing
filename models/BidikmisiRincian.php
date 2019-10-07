<?php

class BidikmisiRincian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bidikmisi_rincian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nim, nisn, tahun_masuk, tahun_keluar, rata2_un, rata2_raport, nilai_xi_ii, nilai_xii_i, nilai_xii_ii, peringkat_xi_ii, peringkat_xii_i, peringkat_xii_ii, prestasi_akademik_lokal, prestasi_akademik_regional, prestasi_akademik_lokal_nasional, prestasi_akademik_internasional, prestasi_nonakademik_lokal, prestasi_nonakademik_regional, prestasi_nonakademik_nasional, prestasi_nonakademik_internasional, status_ayah, status_ibu, tempat_lahir_ayah, tempat_lahir_ibu, bekerja_ayah, anak_ke, jumlah_saudara, penghasilan_ayah, penghasilan_ibu, kepemilikan_rumah,atap_rumah,dinding_rumah,lantai_rumah,lantai_kamar_mandi, sumber_listrik,alamat_ayah,no_hp_ayah,no_hp_ibu,alamat_sekolah,tahun_peroleh_rumah,jumlah_tanggungan', 'required'),
			array('peringkat_x_i,peringkat_x_ii,peringkat_xi_i,peringkat_xi_ii, peringkat_xii_i, peringkat_xii_ii, status_ayah, status_ibu, anak_ke, jumlah_saudara, penghasilan_ayah, penghasilan_ibu, kepemilikan_rumah, sumber_listrik,jumlah_tanggungan', 'numerical', 'integerOnly'=>true),
			array('rata2_un, rata2_raport, nilai_x_i,nilai_x_ii, nilai_xi_i,nilai_xi_ii, nilai_xii_i, nilai_xii_ii', 'numerical'),
			array('nim', 'length', 'max'=>25),
			array('prestasi_akademik, prestasi_akademik_lokal, prestasi_akademik_regional, prestasi_akademik_lokal_nasional, prestasi_akademik_internasional, prestasi_nonakademik, prestasi_nonakademik_lokal, prestasi_nonakademik_regional, prestasi_nonakademik_nasional, prestasi_nonakademik_internasional, tempat_lahir_ayah, tempat_lahir_ibu,bekerja_ayah, alamat_sekolah, nisn,no_hp_ayah,no_hp_ibu,tahun_peroleh_rumah,', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nim, nisn, tahun_masuk, tahun_keluar, rata2_un, rata2_raport, nilai_xi_ii, nilai_xii_i, nilai_xii_ii, peringkat_xi_ii, peringkat_xii_i, peringkat_xii_ii, prestasi_akademik, prestasi_akademik_lokal, prestasi_akademik_regional, prestasi_akademik_lokal_nasional, prestasi_akademik_internasional, prestasi_nonakademik, prestasi_nonakademik_lokal, prestasi_nonakademik_regional, prestasi_nonakademik_nasional, prestasi_nonakademik_internasional, status_ayah, status_ibu, tempat_lahir_ayah, tempat_lahir_ibu, bekerja_ayah, anak_ke, jumlah_saudara, penghasilan_ayah, penghasilan_ibu, kepemilikan_rumah, sumber_listrik', 'safe', 'on'=>'search'),
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
			'mhs'=>array(self::BELONGS_TO, 'Mahasiswa', 'nim'),
			'rumah'=>array(self::BELONGS_TO, 'BidikmisiKepemilikanRumah', 'kepemilikan_rumah'),
			'listrik'=>array(self::BELONGS_TO, 'BidikmisiListrik', 'sumber_listrik'),
			'stat_ayah'=>array(self::BELONGS_TO, 'BidikmisiStatusOrtu', 'status_ayah'),
			'stat_ibu'=>array(self::BELONGS_TO, 'BidikmisiStatusOrtu', 'status_ibu'),
			'kuliah'=>array(self::HAS_ONE, 'KuliahMhs', 'id_reg_pd'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nim' => 'Nim',
			'nisn' => 'Nisn',
			'tahun_masuk' => 'Tahun Masuk',
			'tahun_keluar' => 'Tahun Keluar',
			'rata2_un' => 'Rata2 Un',
			'rata2_raport' => 'Rata2 Raport',
			'nilai_xi_ii' => 'Nilai Xi Ii',
			'nilai_xii_i' => 'Nilai Xii I',
			'nilai_xii_ii' => 'Nilai Xii Ii',
			'peringkat_xi_ii' => 'Peringkat Xi Ii',
			'peringkat_xii_i' => 'Peringkat Xii I',
			'peringkat_xii_ii' => 'Peringkat Xii Ii',
			'prestasi_akademik' => 'Prestasi Akademik',
			'prestasi_akademik_lokal' => 'Prestasi Akademik Lokal',
			'prestasi_akademik_regional' => 'Prestasi Akademik Regional',
			'prestasi_akademik_lokal_nasional' => 'Prestasi Akademik Lokal Nasional',
			'prestasi_akademik_internasional' => 'Prestasi Akademik Internasional',
			'prestasi_nonakademik' => 'Prestasi Nonakademik',
			'prestasi_nonakademik_lokal' => 'Prestasi Nonakademik Lokal',
			'prestasi_nonakademik_regional' => 'Prestasi Nonakademik Regional',
			'prestasi_nonakademik_nasional' => 'Prestasi Nonakademik Nasional',
			'prestasi_nonakademik_internasional' => 'Prestasi Nonakademik Internasional',
			'status_ayah' => 'Status Ayah',
			'status_ibu' => 'Status Ibu',
			'tempat_lahir_ayah' => 'Tempat Lahir Ayah',
			'tempat_lahir_ibu' => 'Tempat Lahir Ibu',
			'bekerja_ayah' => 'Bekerja Ayah',
			'anak_ke' => 'Anak Ke',
			'jumlah_saudara' => 'Jumlah Saudara',
			'penghasilan_ayah' => 'Penghasilan Ayah',
			'penghasilan_ibu' => 'Penghasilan Ibu',
			'kepemilikan_rumah' => 'Kepemilikan Rumah',
			'sumber_listrik' => 'Sumber Listrik',
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

		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('nisn',$this->nisn);
		$criteria->compare('tahun_masuk',$this->tahun_masuk,true);
		$criteria->compare('tahun_keluar',$this->tahun_keluar,true);
		$criteria->compare('rata2_un',$this->rata2_un);
		$criteria->compare('rata2_raport',$this->rata2_raport);
		$criteria->compare('nilai_xi_ii',$this->nilai_xi_ii);
		$criteria->compare('nilai_xii_i',$this->nilai_xii_i);
		$criteria->compare('nilai_xii_ii',$this->nilai_xii_ii);
		$criteria->compare('peringkat_xi_ii',$this->peringkat_xi_ii);
		$criteria->compare('peringkat_xii_i',$this->peringkat_xii_i);
		$criteria->compare('peringkat_xii_ii',$this->peringkat_xii_ii);
		$criteria->compare('prestasi_akademik',$this->prestasi_akademik,true);
		$criteria->compare('prestasi_akademik_lokal',$this->prestasi_akademik_lokal,true);
		$criteria->compare('prestasi_akademik_regional',$this->prestasi_akademik_regional,true);
		$criteria->compare('prestasi_akademik_lokal_nasional',$this->prestasi_akademik_lokal_nasional,true);
		$criteria->compare('prestasi_akademik_internasional',$this->prestasi_akademik_internasional,true);
		$criteria->compare('prestasi_nonakademik',$this->prestasi_nonakademik,true);
		$criteria->compare('prestasi_nonakademik_lokal',$this->prestasi_nonakademik_lokal,true);
		$criteria->compare('prestasi_nonakademik_regional',$this->prestasi_nonakademik_regional,true);
		$criteria->compare('prestasi_nonakademik_nasional',$this->prestasi_nonakademik_nasional,true);
		$criteria->compare('prestasi_nonakademik_internasional',$this->prestasi_nonakademik_internasional,true);
		$criteria->compare('status_ayah',$this->status_ayah);
		$criteria->compare('status_ibu',$this->status_ibu);
		$criteria->compare('tempat_lahir_ayah',$this->tempat_lahir_ayah);
		$criteria->compare('tempat_lahir_ibu',$this->tempat_lahir_ibu);
		$criteria->compare('bekerja_ayah',$this->bekerja_ayah);
		$criteria->compare('anak_ke',$this->anak_ke);
		$criteria->compare('jumlah_saudara',$this->jumlah_saudara);
		$criteria->compare('penghasilan_ayah',$this->penghasilan_ayah);
		$criteria->compare('penghasilan_ibu',$this->penghasilan_ibu);
		$criteria->compare('kepemilikan_rumah',$this->kepemilikan_rumah);
		$criteria->compare('sumber_listrik',$this->sumber_listrik);
		
		$criteria->select="t.*";
		$criteria->join="JOIN kuliah_mhs as k ON t.nim=k.id_reg_pd";
		$criteria->order = "peringkat_xii_ii";
		$criteria->condition = "k.semester = :semester year(t.regpd_tgl_masuk_sp)='2018'";
		$criteria->params = array (	
		':semester' => "1",
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	
	public function newsearch()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('nisn',$this->nisn);
		$criteria->compare('tahun_masuk',$this->tahun_masuk,true);
		$criteria->compare('tahun_keluar',$this->tahun_keluar,true);
		$criteria->compare('rata2_un',$this->rata2_un);
		$criteria->compare('rata2_raport',$this->rata2_raport);
		$criteria->compare('nilai_xi_ii',$this->nilai_xi_ii);
		$criteria->compare('nilai_xii_i',$this->nilai_xii_i);
		$criteria->compare('nilai_xii_ii',$this->nilai_xii_ii);
		$criteria->compare('peringkat_xi_ii',$this->peringkat_xi_ii);
		$criteria->compare('peringkat_xii_i',$this->peringkat_xii_i);
		$criteria->compare('peringkat_xii_ii',$this->peringkat_xii_ii);
		$criteria->compare('prestasi_akademik',$this->prestasi_akademik,true);
		$criteria->compare('prestasi_akademik_lokal',$this->prestasi_akademik_lokal,true);
		$criteria->compare('prestasi_akademik_regional',$this->prestasi_akademik_regional,true);
		$criteria->compare('prestasi_akademik_lokal_nasional',$this->prestasi_akademik_lokal_nasional,true);
		$criteria->compare('prestasi_akademik_internasional',$this->prestasi_akademik_internasional,true);
		$criteria->compare('prestasi_nonakademik',$this->prestasi_nonakademik,true);
		$criteria->compare('prestasi_nonakademik_lokal',$this->prestasi_nonakademik_lokal,true);
		$criteria->compare('prestasi_nonakademik_regional',$this->prestasi_nonakademik_regional,true);
		$criteria->compare('prestasi_nonakademik_nasional',$this->prestasi_nonakademik_nasional,true);
		$criteria->compare('prestasi_nonakademik_internasional',$this->prestasi_nonakademik_internasional,true);
		$criteria->compare('status_ayah',$this->status_ayah);
		$criteria->compare('status_ibu',$this->status_ibu);
		$criteria->compare('tempat_lahir_ayah',$this->tempat_lahir_ayah);
		$criteria->compare('tempat_lahir_ibu',$this->tempat_lahir_ibu);
		$criteria->compare('bekerja_ayah',$this->bekerja_ayah);
		$criteria->compare('anak_ke',$this->anak_ke);
		$criteria->compare('jumlah_saudara',$this->jumlah_saudara);
		$criteria->compare('penghasilan_ayah',$this->penghasilan_ayah);
		$criteria->compare('penghasilan_ibu',$this->penghasilan_ibu);
		$criteria->compare('kepemilikan_rumah',$this->kepemilikan_rumah);
		$criteria->compare('sumber_listrik',$this->sumber_listrik);
		


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'pagination' =>false,
		));
	}
	
	public function status($angkatan,$status)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('nisn',$this->nisn);
		$criteria->compare('tahun_masuk',$this->tahun_masuk,true);
		$criteria->compare('tahun_keluar',$this->tahun_keluar,true);
		$criteria->compare('rata2_un',$this->rata2_un);
		$criteria->compare('rata2_raport',$this->rata2_raport);
		$criteria->compare('nilai_xi_ii',$this->nilai_xi_ii);
		$criteria->compare('nilai_xii_i',$this->nilai_xii_i);
		$criteria->compare('nilai_xii_ii',$this->nilai_xii_ii);
		$criteria->compare('peringkat_xi_ii',$this->peringkat_xi_ii);
		$criteria->compare('peringkat_xii_i',$this->peringkat_xii_i);
		$criteria->compare('peringkat_xii_ii',$this->peringkat_xii_ii);
		$criteria->compare('prestasi_akademik',$this->prestasi_akademik,true);
		$criteria->compare('prestasi_akademik_lokal',$this->prestasi_akademik_lokal,true);
		$criteria->compare('prestasi_akademik_regional',$this->prestasi_akademik_regional,true);
		$criteria->compare('prestasi_akademik_lokal_nasional',$this->prestasi_akademik_lokal_nasional,true);
		$criteria->compare('prestasi_akademik_internasional',$this->prestasi_akademik_internasional,true);
		$criteria->compare('prestasi_nonakademik',$this->prestasi_nonakademik,true);
		$criteria->compare('prestasi_nonakademik_lokal',$this->prestasi_nonakademik_lokal,true);
		$criteria->compare('prestasi_nonakademik_regional',$this->prestasi_nonakademik_regional,true);
		$criteria->compare('prestasi_nonakademik_nasional',$this->prestasi_nonakademik_nasional,true);
		$criteria->compare('prestasi_nonakademik_internasional',$this->prestasi_nonakademik_internasional,true);
		$criteria->compare('status_ayah',$this->status_ayah);
		$criteria->compare('status_ibu',$this->status_ibu);
		$criteria->compare('tempat_lahir_ayah',$this->tempat_lahir_ayah);
		$criteria->compare('tempat_lahir_ibu',$this->tempat_lahir_ibu);
		$criteria->compare('bekerja_ayah',$this->bekerja_ayah);
		$criteria->compare('anak_ke',$this->anak_ke);
		$criteria->compare('jumlah_saudara',$this->jumlah_saudara);
		$criteria->compare('penghasilan_ayah',$this->penghasilan_ayah);
		$criteria->compare('penghasilan_ibu',$this->penghasilan_ibu);
		$criteria->compare('kepemilikan_rumah',$this->kepemilikan_rumah);
		$criteria->compare('sumber_listrik',$this->sumber_listrik);
		
		$criteria->select='*,((t.penghasilan_ayah+t.penghasilan_ibu)/t.jumlah_saudara) as sumber_listrik';
		$criteria->join='JOIN mahasiswa as m ON t.nim=m.id_pd ';
		$criteria->condition = "DATE_FORMAT(m.regpd_tgl_masuk_sp,'%Y')=:regpd_tgl_masuk_sp AND (m.beasiswa_bidikmisi=:bbm OR m.beasiswa_bidikmisi=:bbm2 OR m.beasiswa_bidikmisi=:bbm3 OR m.beasiswa_bidikmisi=:bbm4 OR m.beasiswa_bidikmisi=:bbm5)";
		$criteria->order = "t.sumber_listrik ASC";
		//Status
		$status2=$status;
		$status3=$status;
		$status4=$status;
		$status5=$status;
		if($status=='3'):
			$status2='4';
		elseif($status=='4'):
			$status2='5';
		elseif($status=='5'):
			$status2='1';
			$status3='2';
			$status4='3';
			$status5='6';
		endif;
		$criteria->params = array (	
			':regpd_tgl_masuk_sp' => $angkatan,
			':bbm' => $status,
			':bbm2' => $status2,
			':bbm3' => $status3,
			':bbm4' => $status4,
			':bbm5' => $status5,
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function exportReg($angkatan)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('nisn',$this->nisn);
		$criteria->compare('tahun_masuk',$this->tahun_masuk,true);
		$criteria->compare('tahun_keluar',$this->tahun_keluar,true);
		$criteria->compare('rata2_un',$this->rata2_un);
		$criteria->compare('rata2_raport',$this->rata2_raport);
		$criteria->compare('nilai_xi_ii',$this->nilai_xi_ii);
		$criteria->compare('nilai_xii_i',$this->nilai_xii_i);
		$criteria->compare('nilai_xii_ii',$this->nilai_xii_ii);
		$criteria->compare('peringkat_xi_ii',$this->peringkat_xi_ii);
		$criteria->compare('peringkat_xii_i',$this->peringkat_xii_i);
		$criteria->compare('peringkat_xii_ii',$this->peringkat_xii_ii);
		$criteria->compare('prestasi_akademik',$this->prestasi_akademik,true);
		$criteria->compare('prestasi_akademik_lokal',$this->prestasi_akademik_lokal,true);
		$criteria->compare('prestasi_akademik_regional',$this->prestasi_akademik_regional,true);
		$criteria->compare('prestasi_akademik_lokal_nasional',$this->prestasi_akademik_lokal_nasional,true);
		$criteria->compare('prestasi_akademik_internasional',$this->prestasi_akademik_internasional,true);
		$criteria->compare('prestasi_nonakademik',$this->prestasi_nonakademik,true);
		$criteria->compare('prestasi_nonakademik_lokal',$this->prestasi_nonakademik_lokal,true);
		$criteria->compare('prestasi_nonakademik_regional',$this->prestasi_nonakademik_regional,true);
		$criteria->compare('prestasi_nonakademik_nasional',$this->prestasi_nonakademik_nasional,true);
		$criteria->compare('prestasi_nonakademik_internasional',$this->prestasi_nonakademik_internasional,true);
		$criteria->compare('status_ayah',$this->status_ayah);
		$criteria->compare('status_ibu',$this->status_ibu);
		$criteria->compare('tempat_lahir_ayah',$this->tempat_lahir_ayah);
		$criteria->compare('tempat_lahir_ibu',$this->tempat_lahir_ibu);
		$criteria->compare('bekerja_ayah',$this->bekerja_ayah);
		$criteria->compare('anak_ke',$this->anak_ke);
		$criteria->compare('jumlah_saudara',$this->jumlah_saudara);
		$criteria->compare('penghasilan_ayah',$this->penghasilan_ayah);
		$criteria->compare('penghasilan_ibu',$this->penghasilan_ibu);
		$criteria->compare('kepemilikan_rumah',$this->kepemilikan_rumah);
		$criteria->compare('sumber_listrik',$this->sumber_listrik);
		
		$criteria->select='*,((t.penghasilan_ayah+t.penghasilan_ibu)/t.jumlah_saudara) as sumber_listrik';
		$criteria->join='JOIN mahasiswa as m ON t.nim=m.id_pd ';
		$criteria->condition = "DATE_FORMAT(m.regpd_tgl_masuk_sp,'%Y')=:regpd_tgl_masuk_sp";
		$criteria->order = "t.peringkat_xi_ii,t.peringkat_xii_i,t.peringkat_xii_ii";
		$criteria->params = array (	
			':regpd_tgl_masuk_sp' => $angkatan,
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BidikmisiRincian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
