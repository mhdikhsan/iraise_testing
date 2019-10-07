<?php

/**
 * This is the model class for table "tahun_ajaran".
 *
 * The followings are the available columns in table 'tahun_ajaran':
 * @property integer $id_thn_ajaran
 * @property string $nm_thn_ajaran
 * @property string $a_periode_aktif
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 */
class TahunAjaran extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tahun_ajaran';
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
			array('nm_thn_ajaran, a_periode_aktif, tgl_mulai, tgl_selesai', 'required'),
			array('nm_thn_ajaran, a_periode_aktif', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_thn_ajaran, nm_thn_ajaran, a_periode_aktif, tgl_mulai, tgl_selesai', 'safe', 'on'=>'search'),
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
			'id_thn_ajaran' => 'Id Thn Ajaran',
			'nm_thn_ajaran' => 'Nama Tahun Ajaran',
			'a_periode_aktif' => 'Apakah Periode Aktif',
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

		$criteria->compare('id_thn_ajaran',$this->id_thn_ajaran);
		$criteria->compare('nm_thn_ajaran',$this->nm_thn_ajaran,true);
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
	 * @return TahunAjaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
