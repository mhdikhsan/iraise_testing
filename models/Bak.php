<?php

/**
 * This is the model class for table "bak".
 *
 * The followings are the available columns in table 'bak':
 * @property integer $id_bak
 * @property string $id_ptk
 * @property string $id_pd
 * @property string $tanggal
 */
class Bak extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bak';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $nm_pd,$stat_pd;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ptk, id_pd, tanggal', 'required'),
			array('id_ptk, id_pd', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_bak, id_ptk, id_pd, tanggal', 'safe', 'on'=>'search'),
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
			'mhs'=>array(self::BELONGS_TO, 'Mahasiswa', 'id_pd','select'=>'nm_pd,stat_pd'),
			'dosen'=>array(self::BELONGS_TO, 'Dosen', 'id_ptk'),
			'kuliah'=>array(self::HAS_ONE, 'KuliahMhs', 'id_reg_pd'),
			'stat' => array(self::HAS_ONE, 'StatusMahasiswa', 'stat_pd', 
                'through' => 'mhs'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_bak' => 'Id Bak',
			'id_ptk' => 'NIP',
			'id_pd' => 'NIM',
			'nm_pd' => 'Nama',
			'tanggal' => 'Tanggal',
			'stat_pd' => 'Status',
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
		//Session user
		$id_ptk=Yii::app()->session->get('username');
		$sms=Yii::app()->session->get('sms');
		
		$criteria->compare('id_bak',$this->id_bak);
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		
		$criteria->join='JOIN mahasiswa as m ON t.id_pd=m.id_pd ';
		$criteria->condition = "t.id_ptk = :id_ptk and m.regpd_id_sms =:sms";
		$criteria->params = array (	
			':id_ptk' => $id_ptk,
			':sms' => $sms,
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function admin($id,$angkatan)
	{
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		$id_smt= $modelSmt->id_smt;
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		//Session user
		$id_ptk=$id;

		$criteria->compare('id_bak',$this->id_bak);
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		
		$criteria->join='JOIN kuliah_mhs as k ON t.id_pd=k.id_reg_pd ';
		$criteria->join.='JOIN mahasiswa as m ON t.id_pd=m.id_pd ';
		$criteria->condition = "t.id_ptk = :id_ptk AND k.id_smt = :id_smt AND m.stat_pd=:stat_pd AND m.id_pd!=:mahasiswa AND DATE_FORMAT(m.regpd_tgl_masuk_sp,'%Y')=:regpd_tgl_masuk_sp";
		$criteria->order = 'm.nm_pd';
		$criteria->params = array (	
		':id_ptk' => $id_ptk,
		':stat_pd' => 'A',
		':id_smt' => $id_smt,
		':mahasiswa' => "",
		':regpd_tgl_masuk_sp' => $angkatan,
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	
	public function dosen($angkatan)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		//Session user
		$id_ptk=Yii::app()->session->get('username');
		//Semester Aktif
		$modelSmt=Semester::model()->findAll('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		foreach($modelSmt as $db){}

		$criteria->compare('id_bak',$this->id_bak);
		$criteria->compare('id_ptk',$this->id_ptk,true);
		$criteria->compare('id_pd',$this->id_pd,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		
		$criteria->join='JOIN kuliah_mhs as k ON k.id_reg_pd=t.id_pd ';
		$criteria->join.='JOIN mahasiswa as m ON t.id_pd=m.id_pd ';
		$criteria->condition = "id_ptk = :id_ptk AND k.id_stat_mhs='A' AND k.id_smt=:id_smt AND DATE_FORMAT(m.regpd_tgl_masuk_sp,'%Y')=:regpd_tgl_masuk_sp AND m.stat_pd=:stat_pd";
		$criteria->order = 'm.nm_pd';
		$criteria->params = array (	
			':id_ptk' => $id_ptk,
			':id_smt' => $db->id_smt,
			':regpd_tgl_masuk_sp' => $angkatan,
			':stat_pd' => 'A',
			
			
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	public function acc($nim)
	{
		$smt=Yii::app()->session->get('smt');
		$c=Yii::app()->db;
		$sqlcek="select count(n.id_nilai) as count from nilai as n
					left JOIN kelas_kuliah as kk ON kk.id_kls=n.id_kls
		
				where n.id_reg_pd='$nim' AND kk.id_smt='$smt'" ;
		$nimcek=$c->createCommand($sqlcek)->queryRow();
		
		
		
		
		if($nimcek['count']==0){
			$nim = "Belum Isi KRS";
		}else {
				//kuliah mhs
				$sql_kuliah="select sks_smt FROM kuliah_mhs
					WHERE id_reg_pd='$nim' AND id_smt='$smt'
				" ;
				$kuliah_mhs=$c->createCommand($sql_kuliah)->queryRow();
				$sks_smt = $kuliah_mhs['sks_smt'];
				// $sks_total = '0';
				//sudah sks
				$sql="select sum(mk.sks_mk) as count
					from nilai as n
					left JOIN kelas_kuliah as kk ON kk.id_kls=n.id_kls
					left JOIN matkul as mk ON mk.id_mk=kk.id_mk
		
				where n.id_reg_pd='$nim' AND kk.id_smt='$smt' AND n.acc_pa='true'" ;
				$nimisi=$c->createCommand($sql)->queryRow();
				$totalmatkul = $nimisi['count'];
			
			if($totalmatkul>0){
				$nim = "Sudah Disetujui ".$totalmatkul." / ".$sks_smt." SKS";
			}else {
				$nim = "Belum Disetujui";
			}
		}
		
		return $nim;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bak the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
