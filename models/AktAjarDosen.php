<?php

/**
 * This is the model class for table "akt_ajar_dosen".
 *
 * The followings are the available columns in table 'akt_ajar_dosen':
 * @property integer $id_ajar
 * @property string $id_reg_ptk
 * @property string $id_subst
 * @property string $id_kls
 * @property string $sks_subst_tot
 * @property string $sks_tm_subst
 * @property string $sks_prak_subst
 * @property string $sks_prak_lap_subst
 * @property string $sks_sim_subst
 * @property string $jml_tm_renc
 * @property string $jml_tm_real
 * @property integer $id_jns_eval
 */
class AktAjarDosen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'akt_ajar_dosen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_reg_ptk, id_kls', 'required'),
			array('id_ajar, id_jns_eval', 'numerical', 'integerOnly'=>true),
			array('id_reg_ptk, id_subst, id_kls, sks_subst_tot, sks_tm_subst, sks_prak_subst, sks_prak_lap_subst, sks_sim_subst, jml_tm_renc, jml_tm_real', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ajar, id_reg_ptk, id_subst, id_kls, sks_subst_tot, sks_tm_subst, sks_prak_subst, sks_prak_lap_subst, sks_sim_subst, jml_tm_renc, jml_tm_real, id_jns_eval', 'safe', 'on'=>'search'),
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
		 'kls'=>array(self::BELONGS_TO, 'KelasKuliah', 'id_kls'),
		 'mk' => array(self::HAS_ONE, 'Matkul', 'id_mk', 
                'through' => 'kls'),
		 'k' => array(self::HAS_ONE, 'Kurikulum', 'id_kurikulum', 
                'through' => 'kls'),
		 'smt'=>array(self::HAS_ONE, 'Semester', 'id_smt',
				'through' => 'kls'),
		 'sms'=>array(self::HAS_ONE, 'Sms', 'id_sms',
				'through' => 'kls'),
		 'fak'=>array(self::HAS_ONE, 'Fakultas', 'id_induk_sms',
				'through' => 'sms'),
		 'dosen'=>array(self::BELONGS_TO, 'AktAjarDosen', 'id_kls'),
		 'dosen2' => array(self::HAS_ONE, 'Dosen', 'id_reg_ptk', 
                'through' => 'dosen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ajar' => 'Id Ajar',
			'id_reg_ptk' => 'Id Reg Ptk',
			'id_subst' => 'Id Subst',
			'id_kls' => 'Id Kls',
			'sks_subst_tot' => 'Sks Subst Tot',
			'sks_tm_subst' => 'Sks Tm Subst',
			'sks_prak_subst' => 'Sks Prak Subst',
			'sks_prak_lap_subst' => 'Sks Prak Lap Subst',
			'sks_sim_subst' => 'Sks Sim Subst',
			'jml_tm_renc' => 'Jml Tm Renc',
			'jml_tm_real' => 'Jml Tm Real',
			'id_jns_eval' => 'Id Jns Eval',
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
		$sms=Yii::app()->session->get('username');
		$criteria->compare('id_ajar',$this->id_ajar);
		$criteria->compare('id_reg_ptk',$this->id_reg_ptk,true);
		$criteria->compare('id_subst',$this->id_subst,true);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('sks_subst_tot',$this->sks_subst_tot,true);
		$criteria->compare('sks_tm_subst',$this->sks_tm_subst,true);
		$criteria->compare('sks_prak_subst',$this->sks_prak_subst,true);
		$criteria->compare('sks_prak_lap_subst',$this->sks_prak_lap_subst,true);
		$criteria->compare('sks_sim_subst',$this->sks_sim_subst,true);
		$criteria->compare('jml_tm_renc',$this->jml_tm_renc,true);
		$criteria->compare('jml_tm_real',$this->jml_tm_real,true);
		$criteria->compare('id_jns_eval',$this->id_jns_eval);
		$criteria->condition = "t.id_reg_ptk = :id_reg_ptk";
		$criteria->params = array (	
		':id_reg_ptk' => $sms,
		);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function tugasDispensasi()
	{
		
		
		$criteria=new CDbCriteria;
		$id=Yii::app()->session->get('username');
		
		$criteria->compare('id_ajar',$this->id_ajar);
		$criteria->compare('id_reg_ptk',$this->id_reg_ptk,true);
		$criteria->compare('id_subst',$this->id_subst,true);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('sks_subst_tot',$this->sks_subst_tot,true);
		$criteria->compare('sks_tm_subst',$this->sks_tm_subst,true);
		$criteria->compare('sks_prak_subst',$this->sks_prak_subst,true);
		$criteria->compare('sks_prak_lap_subst',$this->sks_prak_lap_subst,true);
		$criteria->compare('sks_sim_subst',$this->sks_sim_subst,true);
		$criteria->compare('jml_tm_renc',$this->jml_tm_renc,true);
		$criteria->compare('jml_tm_real',$this->jml_tm_real,true);
		$criteria->compare('id_jns_eval',$this->id_jns_eval,true);
		$criteria->compare('id_jns_eval',$this->tgl_dispensasi,true);
		
		$criteria->join = "JOIN kelas_kuliah as k ";
		$criteria->join .= "JOIN matkul as m ON k.id_mk=m.id_mk ";
		$criteria->condition = "DATE(t.tgl_dispensasi) >= DATE(NOW()) AND t.id_reg_ptk = :id_reg_ptk AND t.id_kls=k.id_kls";
		$criteria->params = array (	
			':id_reg_ptk' => $id,
			
			
		);
		$criteria->order = "m.nm_mk,k.nm_kls";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
            'pageSize' => 30,
			),  
		));
	}
	public function tugas()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		$smt=$modelSmt->id_smt;
		
		$criteria=new CDbCriteria;
		$id=Yii::app()->session->get('username');
		
		$criteria->compare('id_ajar',$this->id_ajar);
		$criteria->compare('id_reg_ptk',$this->id_reg_ptk,true);
		$criteria->compare('id_subst',$this->id_subst,true);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('sks_subst_tot',$this->sks_subst_tot,true);
		$criteria->compare('sks_tm_subst',$this->sks_tm_subst,true);
		$criteria->compare('sks_prak_subst',$this->sks_prak_subst,true);
		$criteria->compare('sks_prak_lap_subst',$this->sks_prak_lap_subst,true);
		$criteria->compare('sks_sim_subst',$this->sks_sim_subst,true);
		$criteria->compare('jml_tm_renc',$this->jml_tm_renc,true);
		$criteria->compare('jml_tm_real',$this->jml_tm_real,true);
		$criteria->compare('id_jns_eval',$this->id_jns_eval);
		
		$criteria->join = "JOIN kelas_kuliah as k ";
		$criteria->join .= "JOIN matkul as m ON k.id_mk=m.id_mk ";
		$criteria->condition = "t.id_reg_ptk = :id_reg_ptk AND t.id_kls=k.id_kls AND k.id_smt=:smt";
		$criteria->params = array (	
			':id_reg_ptk' => $id,
			':smt'=>$smt,
		);
		$criteria->order = "m.nm_mk,k.nm_kls";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
            'pageSize' => 30,
			),  
		));
	}
	public function history($smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.			
		
		$criteria=new CDbCriteria;
		$id=Yii::app()->session->get('username');
		
		$criteria->compare('id_ajar',$this->id_ajar);
		$criteria->compare('id_reg_ptk',$this->id_reg_ptk,true);
		$criteria->compare('id_subst',$this->id_subst,true);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('sks_subst_tot',$this->sks_subst_tot,true);
		$criteria->compare('sks_tm_subst',$this->sks_tm_subst,true);
		$criteria->compare('sks_prak_subst',$this->sks_prak_subst,true);
		$criteria->compare('sks_prak_lap_subst',$this->sks_prak_lap_subst,true);
		$criteria->compare('sks_sim_subst',$this->sks_sim_subst,true);
		$criteria->compare('jml_tm_renc',$this->jml_tm_renc,true);
		$criteria->compare('jml_tm_real',$this->jml_tm_real,true);
		$criteria->compare('id_jns_eval',$this->id_jns_eval);
		
		$criteria->join = "JOIN kelas_kuliah as k ";
		$criteria->join .= "JOIN matkul as m ON k.id_mk=m.id_mk ";
		$criteria->condition = "t.id_reg_ptk = :id_reg_ptk AND t.id_kls=k.id_kls AND k.id_smt=:smt";
		$criteria->params = array (	
			':id_reg_ptk' => $id,
			':smt'=>$smt,
		);
		$criteria->order = "m.nm_mk,k.nm_kls";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
            'pageSize' => 30,
			),  
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AktAjarDosen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
