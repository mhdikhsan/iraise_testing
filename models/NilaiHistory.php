<?php

/**
 * This is the model class for table "nilai_history".
 *
 * The followings are the available columns in table 'nilai_history':
 * @property integer $id_nilai
 * @property string $id_kls
 * @property string $id_reg_pd
 * @property double $nilai_tugas
 * @property double $nilai_quiz
 * @property double $nilai_total
 * @property double $nilai_mid
 * @property double $nilai_uas
 * @property string $nilai_huruf
 * @property double $na
 * @property double $nilai_indeks
 * @property string $semester
 * @property string $acc_pa
 * @property string $status
 */
class NilaiHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nilai_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kls, id_reg_pd', 'required'),
			array('nilai_tugas, nilai_quiz, nilai_total, nilai_mid, nilai_uas, na, nilai_indeks', 'numerical'),
			array('id_kls, id_reg_pd', 'length', 'max'=>25),
			array('nilai_huruf', 'length', 'max'=>3),
			array('semester', 'length', 'max'=>10),
			array('acc_pa, status', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_nilai, id_kls, id_reg_pd, nilai_tugas, nilai_quiz, nilai_total, nilai_mid, nilai_uas, nilai_huruf, na, nilai_indeks, semester, acc_pa, status', 'safe', 'on'=>'search'),
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
			'kls'=>array(self::BELONGS_TO, 'KelasKuliah', 'id_kls'),
			'dosen'=>array(self::HAS_ONE, 'AktAjarDosen', 'id_kls'),
			'dosen2' => array(self::HAS_ONE, 'Dosen', 'id_reg_ptk', 
					'through' => 'dosen'),
			'mk' => array(self::HAS_ONE, 'Matkul', 'id_mk', 
					'through' => 'kls'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_nilai' => 'Id Nilai',
			'id_kls' => 'ID Kelas ',
			'id_reg_pd' => 'NIM',
			'nilai_tugas' => 'Nilai Tugas Mandiri',
			'nilai_quiz' => 'Nilai Tugas Terstruktur',
			'nilai_total' => 'Nilai Total',
			'nilai_mid' => 'Nilai UTS',
			'nilai_uas' => 'Nilai UAS',
			'nilai_huruf' => 'Nilai Huruf',
			'na' => 'NA',
			'nilai_indeks' => 'Nilai Indeks',
			'semester' => 'Semester',
			'acc_pa' => 'Acc Pa',
			'status' => 'Status',
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

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas);
		$criteria->compare('nilai_quiz',$this->nilai_quiz);
		$criteria->compare('nilai_total',$this->nilai_total);
		$criteria->compare('nilai_mid',$this->nilai_mid);
		$criteria->compare('nilai_uas',$this->nilai_uas);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na);
		$criteria->compare('nilai_indeks',$this->nilai_indeks);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		$criteria->compare('status',$this->status,true);

		$criteria->select="t.*,max(id_nilai) as id_nilai, max(status) as status";
		$criteria->group="id_reg_pd";
		$criteria->order="id_nilai DESC, status DESC";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	public function jurusan()
	{
		//Session
		$sessSms=Yii::app()->session->get('sms');
		//Criteria
		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas);
		$criteria->compare('nilai_quiz',$this->nilai_quiz);
		$criteria->compare('nilai_total',$this->nilai_total);
		$criteria->compare('nilai_mid',$this->nilai_mid);
		$criteria->compare('nilai_uas',$this->nilai_uas);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na);
		$criteria->compare('nilai_indeks',$this->nilai_indeks);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		$criteria->compare('status',$this->status,true);
		
		$criteria->select = "t.*";
		$criteria->join = "JOIN kelas_kuliah as k ON k.id_kls=t.id_kls ";
		$criteria->group = 't.id_kls';
		$criteria->condition = "k.id_sms=:id_sms";
		$criteria->params = array (	
			':id_sms' => $sessSms,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NilaiHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
