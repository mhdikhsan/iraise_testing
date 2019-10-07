<?php //

/**
 * This is the model class for table "pengajuan_cuti".
 *
 * The followings are the available columns in table 'pengajuan_cuti':
 * @property integer $id_pengajuan_cuti
 * @property string $id_pd
 * @property string $status_pengajuan
 * @property string $id_smt
 */

class PengajuanCuti extends CActiveRecord
{
	public $prodi="";
	public $nama="";
	public $tgl_bimbingan="";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengajuan_cuti';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pd, status_pengajuan, id_smt', 'required'),
			array('id_pd', 'length', 'max'=>25),
			array('nomor', 'length', 'max'=>50),
			array('status_pengajuan', 'length', 'max'=>1),
			array('id_smt', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pengajuan_cuti, id_pd, status_pengajuan, id_smt', 'safe', 'on'=>'search'),
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
		'mhs'=>array(self::BELONGS_TO, 'Mahasiswa', 'id_pd'),
		'bak'=>array(self::HAS_ONE, 'Bak', array('id_pd'=>'id_pd')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pengajuan_cuti' => 'Id Pengajuan Cuti',
			'id_pd' => 'Id Pd',
			'status_pengajuan' => 'Status Pengajuan',
			'id_smt' => 'Id Smt',
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
	public function searchprodi()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$sms=Yii::app()->session->get('sms');
		 
		 
		$criteria=new CDbCriteria;
		$criteria->together = true;
		$criteria->with=array('mhs');
		
		$criteria->compare('mhs.regpd_id_sms',$sms);
		$criteria->compare('t.id_pengajuan_cuti',$this->id_pengajuan_cuti);
		$criteria->compare('t.id_pd',$this->id_pd,true);
		$criteria->compare('t.status_pengajuan',$this->status_pengajuan,true);
		$criteria->compare('t.id_smt',$this->id_smt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function isVisible($status){
		
       if($this->status_pengajuan == '1') return true;
        else return false;
    }
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		 
		 
		$criteria=new CDbCriteria;
		$criteria->together = true;
		$criteria->with=array('mhs');
		
		$criteria->compare('t.id_pengajuan_cuti',$this->id_pengajuan_cuti);
		$criteria->compare('t.id_pd',$this->id_pd,true);
		$criteria->compare('t.status_pengajuan',$this->status_pengajuan,true);
		$criteria->compare('t.id_smt',$this->id_smt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchadmin()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		 
		 
		$criteria=new CDbCriteria;
		$criteria->together = true;
		$criteria->with=array('mhs');
		
		$criteria->compare('t.id_pengajuan_cuti',$this->id_pengajuan_cuti);

		$criteria->compare('t.id_pd',$this->id_pd,true);
		$criteria->compare('t.status_pengajuan',$this->status_pengajuan,true);
		$criteria->compare('t.id_smt',$this->id_smt,true);
		$criteria->addCondition('t.verifikasi_pa=1 or t.verifikasi_prodi=1');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
		public function searchbak()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$username=Yii::app()->session->get('username');
		 
		 
		$criteria=new CDbCriteria;
		$criteria->together = true;
		$criteria->with=array('bak','mhs');
		
		$criteria->compare('bak.id_ptk',$username);
		$criteria->compare('t.id_pengajuan_cuti',$this->id_pengajuan_cuti);
		$criteria->compare('t.id_pd',$this->id_pd,true);
		$criteria->compare('t.status_pengajuan',$this->status_pengajuan,true);
		$criteria->compare('t.id_smt',$this->id_smt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PengajuanCuti the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
