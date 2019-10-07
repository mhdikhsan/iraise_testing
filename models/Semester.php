<?php

/**
 * This is the model class for table "semester".
 *
 * The followings are the available columns in table 'semester':
 * @property string $id_smt
 * @property string $id_thn_ajaran
 * @property string $nm_smt
 * @property string $smt
 * @property string $a_periode_aktif
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 */
class Semester extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'semester';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	 public $tgl0,$bln0,$thn0;
	 public $tgl1,$bln1,$thn1;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_smt, id_thn_ajaran, nm_smt, smt, a_periode_aktif, tgl_mulai, tgl_selesai', 'required'),
			array('id_smt, smt, a_periode_aktif', 'length', 'max'=>5),
			array('id_thn_ajaran', 'length', 'max'=>10),
			array('nm_smt', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_smt, id_thn_ajaran, nm_smt, smt, a_periode_aktif, tgl_mulai, tgl_selesai', 'safe', 'on'=>'search'),
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
			'tahunajaran' => array(self::BELONGS_TO, 'TahunAjaran', 'id_thn_ajaran'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_smt' => 'ID Semester',
			'id_thn_ajaran' => 'Tahun Ajaran',
			'nm_smt' => 'Nama Semester',
			'smt' => 'Semester',
			'a_periode_aktif' => 'Apakah Periode Aktif ?',
			'tgl_mulai' => 'Tanggal Mulai',
			'tgl_selesai' => 'Tanggal Selesai',
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

		$criteria->compare('id_smt',$this->id_smt,true);
		$criteria->compare('id_thn_ajaran',$this->id_thn_ajaran,true);
		$criteria->compare('nm_smt',$this->nm_smt,true);
		$criteria->compare('smt',$this->smt,true);
		$criteria->compare('a_periode_aktif',$this->a_periode_aktif,true);
		$criteria->compare('tgl_mulai',$this->tgl_mulai,true);
		$criteria->compare('tgl_selesai',$this->tgl_selesai,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Semester the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
