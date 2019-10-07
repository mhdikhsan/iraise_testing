<?php
namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kuliah_mhs".
 *
 * The followings are the available columns in table 'kuliah_mhs':
 * @property string $id_smt
 * @property string $id_reg_pd
 * @property string $ips
 * @property string $sks_smt
 * @property string $ipk
 * @property string $sks_total
 * @property string $id_stat_mhs
 */
class KuliahMhs extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'kuliah_mhs';
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
			array('id_smt, id_reg_pd, id_stat_mhs', 'required'),
			// array('id_smt', 'length', 'max'=>5),
			// array('semester', 'length','max'=>4),
			// array('id_reg_pd, ips', 'length', 'max'=>25),
			 array('ket,tgl_bayar', 'length', 'max'=>30),
			// array('sks_smt, ipk, sks_total', 'length', 'max'=>10),
			array('jlh_bayar, total_bayar', 'length', 'max'=>10),
			array('status_bayar', 'length', 'max'=>2), 
			// array('id_stat_mhs', 'length', 'max'=>1),
			array('filee', 'file', 'types'=>'xls, xlsx','allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_smt, id_reg_pd, ips, sks_smt, ipk, sks_total, id_stat_mhs,ket,tgl_bayar,total_bayar,status_bayar', 'safe', 'on'=>'search'),
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
			'mhs'=>array(self::BELONGS_TO, 'Mahasiswa', 'id_reg_pd'),
			'sms'=>array(self::BELONGS_TO, 'Sms', 'regpd_id_sms','through' => 'mhs'),
			'induksms'=>array(self::BELONGS_TO, 'Sms', 'id_induk_sms','through' => 'sms'),
			'stat'=>array(self::BELONGS_TO, 'StatusMahasiswa', 'id_stat_mhs'),
			'idStatMhs'=>array(self::BELONGS_TO, 'StatusMahasiswa', 'id_stat_mhs'),
			'idSmt'=>array(self::BELONGS_TO, 'Semester', 'id_smt'),
			'bank'=>array(self::BELONGS_TO, 'Bank', 'id_bank'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_smt' => 'ID SMT',
			'id_reg_pd' => 'NIM',
			'ips' => 'Indek Prestasi Semester',
			'sks_smt' => 'SKS Semester',
			'ipk' => 'IPK',
			'sks_total' => 'JATAH SKS Total',
			'sks_max' => 'Total SKS',
			'id_stat_mhs' => 'Status Mahasiswa',
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
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('ips',$this->ips,true);
		$criteria->compare('sks_smt',$this->sks_smt,true);
		$criteria->compare('ipk',$this->ipk,true);
		$criteria->compare('sks_total',$this->sks_total,true);
		//$criteria->compare('mhs.nm_pd',$this->id_reg_pd,true);
		$criteria->compare('id_stat_mhs',$this->id_stat_mhs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchkeu()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('id_smt',$this->id_smt,true);
		//$criteria->compare('id_stat_mhs','A',true);
		//$criteria->compare('status_bayar','1',true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('ips',$this->ips,true);
		$criteria->compare('sks_smt',$this->sks_smt,true);
		$criteria->compare('ipk',$this->ipk,true);
		$criteria->compare('sks_total',$this->sks_total,true);
		$criteria->compare('ket',$this->ket,true);
		$criteria->compare('tgl_bayar',$this->tgl_bayar,true);
		$criteria->compare('total_bayar',$this->total_bayar,true);
		//$criteria->compare('mhs.nm_pd',$this->id_reg_pd,true);
		$criteria->compare('id_stat_mhs',$this->id_stat_mhs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//by yura
	public function paket($smt, $id_smt, $sms)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_smt',$this->id_smt,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('ips',$this->ips,true);
		$criteria->compare('sks_smt',$this->sks_smt,true);
		$criteria->compare('ipk',$this->ipk,true);
		$criteria->compare('sks_total',$this->sks_total,true);
		$criteria->compare('id_stat_mhs',$this->id_stat_mhs,true);
		
		$criteria->join='JOIN mahasiswa m ON m.id_pd=t.id_reg_pd';
		$criteria->condition = "id_smt=:id_smt AND semester=:semester AND m.regpd_id_sms=:sms AND t.id_stat_mhs=:stat_mhs";
		$criteria->params = array (	
			':semester' => $smt,
			':id_smt' => $id_smt,
			':sms' => $sms,
			':stat_mhs' => 'A',
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KuliahMhs the static model class
	 */

}
