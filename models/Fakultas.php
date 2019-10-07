<?php

/**
 * This is the model class for table "fakultas".
 *
 * The followings are the available columns in table 'fakultas':
 * @property string $id_sms
 * @property string $jabatan
 * @property string $pimpinan
 * @property integer $status
 * @property string $pesan
 * @property string $tgl_mulai_krs
 * @property string $tgl_selesai_krs
 */
class Fakultas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fakultas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_sms, tgl_mulai_krs, tgl_selesai_krs', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('id_sms', 'length', 'max'=>5),
			array('jabatan', 'length', 'max'=>25),
			array('pimpinan, nip', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sms, jabatan, pimpinan, status, pesan, tgl_mulai_krs, tgl_selesai_krs,tgl_mulai_nilai, tgl_selesai_nilai,tgl_mulai_cuti,tgl_selesai_cuti', 'safe', 'on'=>'search'),
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
			'sms'=>array(self::BELONGS_TO, 'Sms', 'id_sms'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sms' => 'Prodi',
			'jabatan' => 'Jabatan',
			'pimpinan' => 'Pimpinan',
			'nip' => 'NIP',
			'status' => 'Status',
			'pesan' => 'Pesan',
			'tgl_mulai_krs' => 'Tgl Mulai Krs',
			'tgl_selesai_krs' => 'Tgl Selesai Krs',

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
		$criteria->compare('jabatan',$this->jabatan,true);
		$criteria->compare('pimpinan',$this->pimpinan,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('pesan',$this->pesan,true);
		$criteria->compare('tgl_mulai_krs',$this->tgl_mulai_krs,true);
		$criteria->compare('tgl_selesai_krs',$this->tgl_selesai_krs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fakultas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
