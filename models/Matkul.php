<?php

class Matkul extends CActiveRecord
{
	public function tableName()
	{
		return 'matkul';
	}
	public $ambil;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_sms', 'required'),
			array('id_mk,id_sms', 'length', 'max'=>25),
			array('id_jenj_didik', 'length', 'max'=>10),
			array('kode_mk', 'length', 'max'=>20),
			array('nm_mk,syarat,syarat2', 'length', 'max'=>200),
			array('tgl_mulai_efektif,tgl_akhir_efektif', 'length', 'max'=>60),
			array('jns_mk, kel_mk,m_nilai', 'length', 'max'=>1),
			array('sks_mk, sks_tm, sks_prak, sks_prak_lap, sks_sim, a_sap, a_silabus, a_bahan_ajar, acara_prak, a_diktat', 'length', 'max'=>5),
			array('metode_pelaksanaan_kuliah', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_mk, id_sms, id_jenj_didik, kode_mk, nm_mk, jns_mk, kel_mk, sks_mk, sks_tm, sks_prak, sks_prak_lap, sks_sim, metode_pelaksanaan_kuliah, a_sap, a_silabus, a_bahan_ajar, acara_prak, a_diktat, tgl_mulai_efektif, tgl_akhir_efektif', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'idSms' => array(self::BELONGS_TO, 'Sms', 'id_sms'),
			'matkul' => array(self::BELONGS_TO, 'JenjangPendidikan', 'id_jenj_didik'),
			'kurikulum'=>array(self::HAS_ONE, 'MatkulKurikulum', 'id_mk'),
			'kurikulum2' => array(self::HAS_ONE, 'KurikulumSp', 'id_kurikulum_sp', 
					'through' => 'kurikulum'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_mk' => 'Id Mk',
			'id_sms' => 'Prodi',
			'id_jenj_didik' => 'Jenis Pendidikan',
			'kode_mk' => 'Kode Mata Kuliah',
			'nm_mk' => 'Nama Mata Kuliah',
			'jns_mk' => 'Jenis Mata Kuliah',
			'kel_mk' => 'Kel Mata Kuliah',
			'sks_mk' => 'SKS',
			'sks_tm' => 'SKS Tatap Muka',
			'sks_prak' => 'SKS Praktikum',
			'sks_prak_lap' => 'SKS Praktik Lapapangan',
			'sks_sim' => 'SKS Simulasi',
			'metode_pelaksanaan_kuliah' => 'Metode Pelaksanaan Kuliah',
			'a_sap' => 'A Sap',
			'a_silabus' => 'Apakah Silabus',
			'a_bahan_ajar' => 'Apakah Bahan Ajar',
			'acara_prak' => 'Acara Prak',
			'a_diktat' => 'Apakah Diktat',
			'tgl_mulai_efektif' => 'Tanggal Mulai Efektif',
			'tgl_akhir_efektif' => 'Tanggal Akhir Efektif',
			'syarat2' => 'Syarat (Abaikan Nilai)',
			'm_nilai' => 'Mode Pengisian Nilai',
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
		$sms=Yii::app()->session->get('sms');
		
		$criteria=new CDbCriteria;

		$criteria->compare('id_mk',$this->id_mk);
		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('id_jenj_didik',$this->id_jenj_didik,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nm_mk',$this->nm_mk,true);
		$criteria->compare('jns_mk',$this->jns_mk,true);
		$criteria->compare('kel_mk',$this->kel_mk,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('metode_pelaksanaan_kuliah',$this->metode_pelaksanaan_kuliah,true);
		$criteria->compare('a_sap',$this->a_sap,true);
		$criteria->compare('a_silabus',$this->a_silabus,true);
		$criteria->compare('a_bahan_ajar',$this->a_bahan_ajar,true);
		$criteria->compare('acara_prak',$this->acara_prak,true);
		$criteria->compare('a_diktat',$this->a_diktat,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function sms()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$sms=Yii::app()->session->get('sms');
		$criteria=new CDbCriteria;

		$criteria->compare('id_mk',$this->id_mk);
		$criteria->compare('id_sms',$sms,true);
		$criteria->compare('id_jenj_didik',$this->id_jenj_didik,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nm_mk',$this->nm_mk,true);
		$criteria->compare('jns_mk',$this->jns_mk,true);
		$criteria->compare('kel_mk',$this->kel_mk,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('metode_pelaksanaan_kuliah',$this->metode_pelaksanaan_kuliah,true);
		$criteria->compare('a_sap',$this->a_sap,true);
		$criteria->compare('a_silabus',$this->a_silabus,true);
		$criteria->compare('a_bahan_ajar',$this->a_bahan_ajar,true);
		$criteria->compare('acara_prak',$this->acara_prak,true);
		$criteria->compare('a_diktat',$this->a_diktat,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);

		//$criteria->condition("id_sms=:id_sms");
		// $criteria->condition = "id_sms=:id_sms";
		// $criteria->params = array (	
		// ':id_sms' => $sms,
		// );
		
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function kurikulum($tahun,$smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$user=Yii::app()->session->get('username');
		$sms=Yii::app()->session->get('sms');
		$criteria=new CDbCriteria;

		$criteria->compare('id_mk',$this->id_mk);
		$criteria->compare('id_sms',$sms,true);
		$criteria->compare('id_jenj_didik',$this->id_jenj_didik,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nm_mk',$this->nm_mk,true);
		$criteria->compare('jns_mk',$this->jns_mk,true);
		$criteria->compare('kel_mk',$this->kel_mk,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('metode_pelaksanaan_kuliah',$this->metode_pelaksanaan_kuliah,true);
		$criteria->compare('a_sap',$this->a_sap,true);
		$criteria->compare('a_silabus',$this->a_silabus,true);
		$criteria->compare('a_bahan_ajar',$this->a_bahan_ajar,true);
		$criteria->compare('acara_prak',$this->acara_prak,true);
		$criteria->compare('a_diktat',$this->a_diktat,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);
		
		
		$criteria->select='(SELECT DISTINCT(n.id_reg_pd) 
			 FROM nilai n 
			 LEFT JOIN kelas_kuliah kls ON kls.id_kls=n.id_kls
			 WHERE n.id_reg_pd="'.$user.'" AND kls.id_mk=t.id_mk
			)as ambil ,t.*';
		$criteria->join=' JOIN matkul_kurikulum m ON t.id_mk=m.id_mk';
		$criteria->join.=' JOIN kurikulum_sp k ON m.id_kurikulum_sp=k.id_kurikulum_sp';
		
		// $criteria->join.=' LEFT JOIN kelas_kuliah kls ON t.id_mk=kls.id_mk';
		// $criteria->join.=' LEFT JOIN nilai n ON kls.id_kls=n.id_kls';
		
		$criteria->condition = "k.nm_kurikulum_sp=:nm_kurikulum_sp AND t.id_sms=:id_sms AND t.semester=:semester";
		$criteria->params = array (	
			':nm_kurikulum_sp' => $tahun,
			':id_sms' => $sms,
			':semester' => $smt,
		);
		$criteria->order="semester,nm_mk";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	public function kurikulumprodi($tahun,$smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$user=Yii::app()->session->get('username');
		$sms=Yii::app()->session->get('sms');
		$criteria=new CDbCriteria;

		$criteria->compare('id_mk',$this->id_mk);
		$criteria->compare('id_sms',$sms,true);
		$criteria->compare('id_jenj_didik',$this->id_jenj_didik,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nm_mk',$this->nm_mk,true);
		$criteria->compare('jns_mk',$this->jns_mk,true);
		$criteria->compare('kel_mk',$this->kel_mk,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('metode_pelaksanaan_kuliah',$this->metode_pelaksanaan_kuliah,true);
		$criteria->compare('a_sap',$this->a_sap,true);
		$criteria->compare('a_silabus',$this->a_silabus,true);
		$criteria->compare('a_bahan_ajar',$this->a_bahan_ajar,true);
		$criteria->compare('acara_prak',$this->acara_prak,true);
		$criteria->compare('a_diktat',$this->a_diktat,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);
		
		
		$criteria->select='(SELECT DISTINCT(n.id_reg_pd) 
			 FROM nilai n 
			 LEFT JOIN kelas_kuliah kls ON kls.id_kls=n.id_kls
			 WHERE n.id_reg_pd="'.$user.'" AND kls.id_mk=t.id_mk
			)as ambil ,t.*';
		$criteria->join='LEFT JOIN matkul_kurikulum m ON t.id_mk=m.id_mk';
		//$criteria->join.=' JOIN kurikulum_sp k ON m.id_kurikulum_sp=k.id_kurikulum_sp';
		
		// $criteria->join.=' LEFT JOIN kelas_kuliah kls ON t.id_mk=kls.id_mk';
		// $criteria->join.=' LEFT JOIN nilai n ON kls.id_kls=n.id_kls';
		
		$criteria->condition = "m.id_kurikulum_sp IS NULL and id_sms=:id_sms";
		
		//$criteria->condition = "k.nm_kurikulum_sp=:nm_kurikulum_sp AND t.id_sms=:id_sms AND t.semester=:semester";
		$criteria->params = array (	
			//':nm_kurikulum_sp' => '',
			':id_sms' => $sms,
			//':semester' => $smt,
			
		);
		
		$criteria->order="semester,nm_mk";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	
	
	public function akademikfak()
	{
		$fak=Yii::app()->session->get('sms');
		$sms=Yii::app()->db->createCommand("select id_sms from sms where id_induk_sms LIKE :id_sms")->bindParam(":id_sms", $fak, PDO::PARAM_STR)->queryAll();
		$id_sms=array();
		foreach ($sms as $data){
			$id_sms[]="'".$data['id_sms']."'"; 
		}
		$sms = implode (',',$id_sms);
		$criteria=new CDbCriteria;

		$criteria->compare('id_mk',$this->id_mk);
		//$criteria->compare('id_sms',$sms,true);
		$criteria->compare('id_jenj_didik',$this->id_jenj_didik,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nm_mk',$this->nm_mk,true);
		$criteria->compare('jns_mk',$this->jns_mk,true);
		$criteria->compare('kel_mk',$this->kel_mk,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('metode_pelaksanaan_kuliah',$this->metode_pelaksanaan_kuliah,true);
		$criteria->compare('a_sap',$this->a_sap,true);
		$criteria->compare('a_silabus',$this->a_silabus,true);
		$criteria->compare('a_bahan_ajar',$this->a_bahan_ajar,true);
		$criteria->compare('acara_prak',$this->acara_prak,true);
		$criteria->compare('a_diktat',$this->a_diktat,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);
		$criteria->condition = "id_sms IN ($sms)";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
