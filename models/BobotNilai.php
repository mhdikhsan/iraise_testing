<?php

/**
 * This is the model class for table "bobot_nilai".
 *
 * The followings are the available columns in table 'bobot_nilai':
 * @property integer $kode_bobot_nilai
 * @property string $id_sms
 * @property string $nilai_huruf
 * @property string $bobot_nilai_min
 * @property string $bobot_nilai_maks
 * @property string $nilai_indeks
 * @property string $tgl_mulai_efektif
 * @property string $tgl_akhir_efektif
 */
class BobotNilai extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bobot_nilai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_bobot_nilai, id_sms, nilai_huruf, bobot_nilai_min, bobot_nilai_maks, nilai_indeks, tgl_mulai_efektif, tgl_akhir_efektif', 'required'),
			array('kode_bobot_nilai', 'numerical', 'integerOnly'=>true),
			array('id_sms, bobot_nilai_min, bobot_nilai_maks, nilai_indeks', 'length', 'max'=>25),
			array('nilai_huruf', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kode_bobot_nilai, id_sms, nilai_huruf, bobot_nilai_min, bobot_nilai_maks, nilai_indeks, tgl_mulai_efektif, tgl_akhir_efektif', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kode_bobot_nilai' => 'Kode Bobot Nilai',
			'id_sms' => 'Id Sms',
			'nilai_huruf' => 'Nilai Huruf',
			'bobot_nilai_min' => 'Bobot Nilai Min',
			'bobot_nilai_maks' => 'Bobot Nilai Maks',
			'nilai_indeks' => 'Nilai Indeks',
			'tgl_mulai_efektif' => 'Tgl Mulai Efektif',
			'tgl_akhir_efektif' => 'Tgl Akhir Efektif',
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
		$sms=Yii::app()->session->get('sms');

		$criteria->compare('kode_bobot_nilai',$this->kode_bobot_nilai);
		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('bobot_nilai_min',$this->bobot_nilai_min,true);
		$criteria->compare('bobot_nilai_maks',$this->bobot_nilai_maks,true);
		$criteria->compare('nilai_indeks',$this->nilai_indeks,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);
		
		// $criteria->condition = "id_sms=:id_sms";
		// $criteria->params = array (	
		// ':id_sms' => $sms,
		// );
		$criteria->order="nilai_huruf";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function operator()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('kode_bobot_nilai',$this->kode_bobot_nilai);
		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('bobot_nilai_min',$this->bobot_nilai_min,true);
		$criteria->compare('bobot_nilai_maks',$this->bobot_nilai_maks,true);
		$criteria->compare('nilai_indeks',$this->nilai_indeks,true);
		$criteria->compare('tgl_mulai_efektif',$this->tgl_mulai_efektif,true);
		$criteria->compare('tgl_akhir_efektif',$this->tgl_akhir_efektif,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BobotNilai the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
