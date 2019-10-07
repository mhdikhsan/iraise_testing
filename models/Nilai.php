<?php
namespace app\models;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "nilai_mahasiswa".
 *
 * The followings are the available columns in table 'nilai_mahasiswa':
 * @property integer $id_nilai
 * @property string $id_kls
 * @property string $id_reg_pd
 * @property string $nilai_tugas
 * @property string $nilai_quiz
 * @property string $nilai_total
 * @property string $nilai_mid
 * @property string $nilai_uas
 * @property string $nilai_huruf
 * @property string $na
 * @property string $semester
 * @property string $acc_pa
 */
class Nilai extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'nilai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $filee="";
	public $status="";
	public $nnilai="";
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('id_kls, semester', 'length', 'max'=>100),
			array('id_reg_pd, nilai_tugas, nilai_quiz, nilai_total, nilai_mid, nilai_uas, nilai_indeks, acc_pa', 'length', 'max'=>20),
			array('nilai_huruf, na', 'length', 'max'=>20),
			array('filee', 'file', 'types'=>'xls, xlsx','allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_nilai, id_kls, id_reg_pd, nilai_tugas, nilai_quiz, nilai_total, nilai_mid, nilai_uas, nilai_huruf, na, semester, acc_pa', 'safe', 'on'=>'search'),
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
			'smt'=>array(self::BELONGS_TO, 'Semester', 'semester'),
			// 'dosen'=>array(self::HAS_ONE, 'AktAjarDosen', 'id_kls'),
			'dosen' => array(self::HAS_ONE, 'AktAjarDosen', array('id_kls'=>'id_kls'), 
					'through' => 'kls'),
			'dosen2' => array(self::HAS_ONE, 'Dosen', 'id_reg_ptk', 
					'through' => 'dosen'),
			'mhs'=>array(self::BELONGS_TO, 'Mahasiswa', 'id_reg_pd','select'=>'nm_pd,jk,telepon_seluler'),
			'bak'=>array(self::BELONGS_TO, 'Bak', 'id_reg_pd'),
			'dosenBak' => array(self::HAS_ONE, 'Dosen', 'id_reg_ptk', 
					'through' => 'bak'),
			'smtKrs' => array(self::HAS_ONE, 'Semester', 'id_smt', 
					'through' => 'kls'),
			'program' => array(self::HAS_ONE, 'JenjangPendidikan', 'id_jenj_didik', 
					'through' => 'mk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_nilai' => 'id_nilai',
			'id_kls' => 'Id Kelas',
			'id_reg_pd' => 'NIM',
			'nilai_tugas' => 'Nilai Tugas Mandiri',
			'nilai_quiz' => 'Nilai Tugas Terstruktur',
			'nilai_total' => 'Nilai Total',
			'nilai_mid' => 'Nilai UTS',
			'nilai_uas' => 'Nilai UAS',
			'nilai_huruf' => 'Nilai Huruf',
			'na' => 'Na',
			'semester' => 'Semester',
			'acc_pa' => 'Acc Pa',
			'nilai_indeks' => 'Nilai Indeks',
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
	
	public function preview($semester)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		
		$criteria=new CDbCriteria;
		$id_reg_pd=Yii::app()->session->get('username');
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':semester' => $semester,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function search($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->condition = "id_kls=:id_kls";
		$criteria->params = array (	
		':id_kls' => $id,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function acc($id,$semester)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id,
		':semester' => $semester,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	
	public function krs($semester)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$id_reg_pd=Yii::app()->session->get('username');
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		
		
		$criteria->select= "t.nilai_huruf,t.nilai_indeks,id_nilai,t.id_kls";
		$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.acc_pa=:acc_pa AND t.semester=:semester AND t.id_kls=k.id_kls AND k.id_mk=m.id_mk";
		$criteria->params = array (	
			':id_reg_pd' => $id_reg_pd,
			':acc_pa' => 'true',
			':semester' => $semester,
		);
		$criteria->order="m.nm_mk";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	
	/*
	* START
	* ADMIN
	*
	*/
	public function adminkrs($id,$semester)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$id_reg_pd=$id;
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.acc_pa=:acc_pa AND t.semester=:semester AND t.id_kls=k.id_kls AND k.id_mk=m.id_mk";
		$criteria->params = array (	
			':id_reg_pd' => $id_reg_pd,
			':acc_pa' => 'true',
			':semester' => $semester,
		);
		$criteria->order="m.kode_mk";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	
	public function adminDeklarasi($id,$semester)
	{	
		$criteria=new CDbCriteria;
		$id_reg_pd=$id;
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.acc_pa=:acc_pa AND t.semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':acc_pa' => 'true',
		':semester' => $semester,
		);
		return $criteria;
	}
	
	public function adminTotalKrs($id,$semester)
	{
		//sks acc
		$criteria=$this->adminDeklarasi($id,$semester);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk'];
		}
		//sks semua
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id,
		':semester' => $semester,
		);
		$model=Nilai::model()->findAll($criteria);
		$total2=0;
		foreach($model as $item)
		{
			$total2+=$item->mk['sks_mk'];
		}
		$modelKuliah=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id,':semester'=>$semester));
		if($modelKuliah->sks_smt!=$total2)
		{
			$modelKuliah->sks_smt=$total2;
			$modelKuliah->save();
			// $this->refresh();
		}
		return $total2;
	}
	
	public function adminSmt($id,$semester)
	{
		$criteria=$this->adminDeklarasi($id,$semester);	
		$model=Nilai::model()->findAll($criteria);
		$result="";
		foreach($model as $item)
		{
			$result=$item->kls['id_smt'];
			if(isset($result)):
				break;
			endif;
		}
		return $result;
	}
	
	public function adminTotalMutu($id,$semester)
	{
		$criteria=$this->adminDeklarasi($id,$semester);
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk']*$item->nilai_indeks;
		}
		return $total;
	}
	/*
	* END
	* ADMIN
	*
	*/
	public function bak($id,$semester)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$id_reg_pd=$id;
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND acc_pa=:acc_pa AND semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':acc_pa' => 'true',
		':semester' => $semester,
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function deklarasi($semester)
	{	
		$criteria=new CDbCriteria;
		$id_reg_pd=Yii::app()->session->get('username');
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.acc_pa=:acc_pa AND t.semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':acc_pa' => 'true',
		':semester' => $semester,
		);
		return $criteria;
	}
	
	public function bakDeklarasi($id,$semester)
	{	
		$criteria=new CDbCriteria;
		$id_reg_pd=$id;
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.acc_pa=:acc_pa AND t.semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':acc_pa' => 'true',
		':semester' => $semester,
		);
		return $criteria;
	}
	
	public function transkipDeklarasi($id)
	{	
		$criteria=new CDbCriteria;
		$id_reg_pd=$id;
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.acc_pa=:acc_pa";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':acc_pa' => 'true',
		);
		return $criteria;
	}
	
	public function totalKrs($semester)
	{
		$criteria=$this->deklarasi($semester);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk'];
		}
		return $total;
	}
	
	public function bakTotalKrs($id,$semester)
	{
		$criteria=$this->bakDeklarasi($id,$semester);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk'];
		}
		return $total;
	}
	
	public function transkipTotalKrs($id)
	{
		$criteria=$this->transkipDeklarasi($id);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk'];
		}
		return $total;
	}
	
	public function totalKrsPreview($semester)
	{
		$criteria=new CDbCriteria;
		$id_reg_pd=Yii::app()->session->get('username');
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND semester=:semester";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':semester' => $semester,
		);
		
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk'];
		}
		return $total;
	}
	
	public function totalMutu($semester)
	{
		$criteria=$this->deklarasi($semester);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk']*$item->nilai_indeks;
		}
		return $total;
	}
	
	public function bakTotalMutu($id,$semester)
	{
		$criteria=$this->bakDeklarasi($id,$semester);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk']*$item->nilai_indeks;
		}
		return $total;
	}
	
	public function transkipTotalMutu($id)
	{
		$criteria=$this->transkipDeklarasi($id);	
		$model=Nilai::model()->findAll($criteria);
		$total=0;
		foreach($model as $item)
		{
			$total+=$item->mk['sks_mk']*$item->nilai_indeks;
		}
		return $total;
	}

	public function nilaiMhs($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		$criteria->compare('status',$this->status,true);

		$criteria->select="t.*,n.status as status";
		
		$criteria->condition = "t.id_kls=:id_kls AND t.acc_pa=:acc_pa";
		$criteria->join = "LEFT JOIN mahasiswa as mhs ON mhs.id_pd=t.id_reg_pd ";
		$criteria->join .= "LEFT JOIN nilai_history as n ON n.id_kls=t.id_kls AND n.id_reg_pd=t.id_reg_pd AND n.semester=t.semester AND n.acc_pa=t.acc_pa ";
		$criteria->order = "mhs.nm_pd";
		$criteria->params = array (	
			':id_kls' => $id,
			':acc_pa' => 'true',
		);
		$criteria->group="t.id_reg_pd";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	public function nilaiMhsAdmin($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		$criteria->compare('status',$this->status,true);

		$criteria->select="t.*,n.status as status";
	
		$criteria->condition = "t.id_kls=:id_kls AND t.acc_pa=:acc_pa";
		$criteria->join = "JOIN mahasiswa as mhs ON mhs.id_pd=t.id_reg_pd ";
		$criteria->join .= "LEFT JOIN nilai_history as n ON n.id_kls=t.id_kls AND n.id_reg_pd=t.id_reg_pd AND n.semester=t.semester AND n.acc_pa=t.acc_pa ";
		$criteria->order = "mhs.nm_pd";
		$criteria->params = array (	
			':id_kls' => $id,
			':acc_pa' => 'true',
		);
		$criteria->group="t.id_reg_pd";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	public function nilaiMhsP($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$id,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		$criteria->compare('status',$this->status,true);

		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	public function matkul_nm_mk($id_kls)
	{
		$smt=Yii::app()->session->get('smt');
		$c=Yii::app()->db;
		$sqlcek="select matkul.nm_mk from kelas_kuliah 
				left join matkul on matkul.id_mk=kelas_kuliah.id_mk where kelas_kuliah.id_kls='$id_kls'";
		$data=$c->createCommand($sqlcek)->queryRow();
		$nm_matkul = $data['nm_mk'];
		
		return $nm_matkul;
		;
	}
	public function matkul_sks_mk($id_kls)
	{
		$smt=Yii::app()->session->get('smt');
		$c=Yii::app()->db;
		$sqlcek="select matkul.sks_mk from kelas_kuliah 
				left join matkul on matkul.id_mk=kelas_kuliah.id_mk where kelas_kuliah.id_kls='$id_kls'";
		$data=$c->createCommand($sqlcek)->queryRow();
		$sks_matkul = $data['sks_mk'];
		
		return $sks_matkul;
		;
	}
	
	
	public function nilaiMhsAdminHapus($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);
		$criteria->compare('status',$this->status,true);

		$criteria->select="t.*,n.status as status";
	
		$criteria->condition = "t.id_kls=:id_kls";
		$criteria->join = "JOIN mahasiswa as mhs ON mhs.id_pd=t.id_reg_pd ";
		$criteria->join .= "LEFT JOIN nilai_history as n ON n.id_kls=t.id_kls AND n.id_reg_pd=t.id_reg_pd AND n.semester=t.semester ";
		$criteria->order = "mhs.nm_pd";
		$criteria->params = array (	
			':id_kls' => $id,
		);
		$criteria->group="t.id_reg_pd";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	
	
	public function transkip()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$id_reg_pd=Yii::app()->session->get('username');
		
		$criteria->compare('id_nilai',$this->id_nilai);
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_reg_pd',$this->id_reg_pd,true);
		$criteria->compare('nilai_tugas',$this->nilai_tugas,true);
		$criteria->compare('nilai_quiz',$this->nilai_quiz,true);
		$criteria->compare('nilai_total',$this->nilai_total,true);
		$criteria->compare('nilai_mid',$this->nilai_mid,true);
		$criteria->compare('nilai_uas',$this->nilai_uas,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('na',$this->na,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('acc_pa',$this->acc_pa,true);

		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND acc_pa=:acc_pa";
		$criteria->params = array (	
		':id_reg_pd' => $id_reg_pd,
		':acc_pa' => 'true',
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' =>false,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NilaiMahasiswa the static model class
	 */

	
	public function getHurufDropDown()
	{
		$huruf = array(''=>'-','A'=>'A','A-'=>'A-','B+'=>'B+','B'=>'B','B-'=>'B-','C+'=>'C+','C'=>'C','D'=>'D','E'=>'E');
		return $huruf;
	}
	public function getSemesterDropDown()
	{
		$huruf = array(''=>'-','1'=>'1','2'=>'2','2.5'=>'2.5','3'=>'3','4'=>'4','4.5'=>'4.5','5'=>'5','6'=>'6','6.5'=>'6.5','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14');
		return $huruf;
	}
	
	public function kurikulum($kls)
	{		
		$c=Yii::app()->db;
		//nilai
		$sql_nilai="select ks.nm_kurikulum_sp
				from kelas_kuliah as k 
				left JOIN matkul as m ON m.id_mk=k.id_mk
				left join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
				left JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
			where k.id_kls LIKE :id_kls  ";
			
		$nilai_dao = $c->createCommand($sql_nilai);
		$nilai_dao->bindParam(":id_kls", $kls, PDO::PARAM_STR);
		$nilai_dao = $nilai_dao->queryRow();
		
		return $nilai_dao['nm_kurikulum_sp'];
	}
	public function list_nilai()
    {
        $kategori = array(
            array('value'=>'A', 'text'=>'A'),
            array('value'=>'B', 'text'=>'B'),
            array('value'=>'C', 'text'=>'C'),
            array('value'=>'D', 'text'=>'D'),
            array('value'=>'E', 'text'=>'E'),
            
        );
        
        return CHtml::listData($kategori, 'value', 'text');
    }
}
