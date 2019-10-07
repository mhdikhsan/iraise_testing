<?php

/**
 * This is the model class for table "jadwal".
 *
 * The followings are the available columns in table 'jadwal':
 * @property string $id_jadwal
 * @property integer $id_ruangan
 * @property integer $hari
 * @property string $jam_mulai
 * @property string $jam_selesai
 */
class Jadwal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jadwal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ruangan, hari', 'required'),
			array('id_ruangan, hari', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_jadwal, id_ruangan, hari, jam_mulai, jam_selesai', 'safe', 'on'=>'search'),
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
			'ruangan'=>array(self::BELONGS_TO, 'Ruangan', 'id_ruangan'),
			'kls'=>array(self::BELONGS_TO, 'KelasKuliah', 'id_kls'),
			'mk' => array(self::HAS_ONE, 'Matkul', 'id_mk', 
					'through' => 'kls'),		
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
			'id_jadwal' => 'Id Jadwal',
			'id_ruangan' => 'Id Ruangan',
			'hari' => 'Hari',
			'jam_mulai' => 'Jam Mulai',
			'jam_selesai' => 'Jam Selesai',
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

		$criteria->compare('id_jadwal',$this->id_jadwal,true);
		$criteria->compare('id_ruangan',$this->id_ruangan);
		$criteria->compare('hari',$this->hari);
		$criteria->compare('jam_mulai',$this->jam_mulai,true);
		$criteria->compare('jam_selesai',$this->jam_selesai,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function admin($hari)
	{
		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_jadwal',$this->id_jadwal,true);
		$criteria->compare('id_ruangan',$this->id_ruangan);
		$criteria->compare('hari',$this->hari);
		$criteria->compare('jam_mulai',$this->jam_mulai,true);
		$criteria->compare('jam_selesai',$this->jam_selesai,true);
		
		$criteria->condition = "hari=:hari  AND id_sms=:id_sms";
		$criteria->params = array (	
		':hari' => $hari,
		':id_sms' => $sms,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function dosen($hari)
	{
		$criteria=new CDbCriteria;
		$id_ptk=Yii::app()->session->get('username');
		$sms=Yii::app()->session->get('sms');
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		
		$criteria->compare('id_jadwal',$this->id_jadwal,true);
		$criteria->compare('id_ruangan',$this->id_ruangan);
		$criteria->compare('id_kls',$this->id_kls);
		$criteria->compare('hari',$this->hari);
		$criteria->compare('jam_mulai',$this->jam_mulai,true);
		$criteria->compare('jam_selesai',$this->jam_selesai,true);
		
		$criteria->join='JOIN akt_ajar_dosen as dosen ON dosen.id_kls=t.id_kls ';
		$criteria->join.='JOIN kelas_kuliah as kls ON kls.id_kls=t.id_kls';
		$criteria->condition = "hari=:hari AND dosen.id_reg_ptk=:id_reg_ptk AND kls.id_smt=:id_smt";
		$criteria->params = array (	
		':hari' => $hari,
		':id_reg_ptk' => $id_ptk,
		':id_smt' => $modelSmt->id_smt,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function mhs($hari)
	{
		$criteria=new CDbCriteria;
		$id_pd=Yii::app()->session->get('username');
		$sms=Yii::app()->session->get('sms');
		$semester=Yii::app()->session->get('semester');
		
		$criteria->compare('id_jadwal',$this->id_jadwal,true);
		$criteria->compare('id_ruangan',$this->id_ruangan);
		$criteria->compare('id_kls',$this->id_kls);
		$criteria->compare('hari',$this->hari);
		$criteria->compare('jam_mulai',$this->jam_mulai,true);
		$criteria->compare('jam_selesai',$this->jam_selesai,true);
		
		$criteria->join='JOIN nilai as mhs ON mhs.id_kls=t.id_kls';
		$criteria->condition = "hari=:hari AND id_sms=:id_sms AND mhs.id_reg_pd=:id_reg_pd AND mhs.semester=:semester";
		$criteria->params = array (	
		':hari' => $hari,
		':id_sms' => $sms,
		':id_reg_pd' => $id_pd,
		':semester' => $semester,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jadwal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
