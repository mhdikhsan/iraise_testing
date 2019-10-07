<?php
namespace app\models;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "kelas_kuliah".
 *
 * The followings are the available columns in table 'kelas_kuliah':
 * @property string $id_kls
 * @property string $id_sms
 * @property string $id_smt
 * @property string $id_mk
 * @property string $nm_kls
 * @property string $sks_mk
 * @property string $sks_tm
 * @property string $sks_prak
 * @property string $sks_prak_lap
 * @property string $sks_sim
 * @property string $bahasan_case
 * @property string $tgl_mulai_koas
 * @property string $tgl_selesai_koas
 * @property string $id_mou
 * @property string $a_selenggara_pditt
 * @property string $kuota_pditt
 * @property string $a_pengguna_pditt
 * @property string $id_kls_pditt
 */
class KelasKuliah extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'kelas_kuliah';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $nm_mk="",$kode_mk,$sks_mk,$nm_kurikulum,$nm_ptk="";
	public $id_ptk;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kls, id_sms, id_smt, id_mk, nm_kls', 'required'),
			array('id_kls, id_sms, id_smt, id_mk, kuota_pditt, id_kls_pditt', 'length', 'max'=>25),
			array('nm_kls,log', 'length', 'max'=>5),
			array('sks_mk, sks_tm, sks_prak, sks_prak_lap, sks_sim, a_selenggara_pditt, a_pengguna_pditt', 'length', 'max'=>10),
			array('bahasan_case', 'length', 'max'=>200),
			array('tgl_mulai_koas,tgl_selesai_koas', 'length', 'max'=>60),
			array('id_mou', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_kls, id_sms, id_smt, id_mk, nm_kls, sks_mk, sks_tm, sks_prak, sks_prak_lap, sks_sim, bahasan_case, tgl_mulai_koas, tgl_selesai_koas, id_mou, a_selenggara_pditt, kuota_pditt, a_pengguna_pditt, id_kls_pditt', 'safe', 'on'=>'search'),
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
			'mk'=>array(self::BELONGS_TO, 'Matkul', 'id_mk'),
			'dosen'=>array(self::HAS_ONE, 'AktAjarDosen', 'id_kls'),
			'k'=>array(self::BELONGS_TO, 'Kurikulum', 'id_kurikulum'),
			'dosen2' => array(self::HAS_ONE, 'Dosen', 'id_reg_ptk', 
					'through' => 'dosen','select'=>'nm_ptk'),
			'jadwal'=>array(self::HAS_ONE, 'Jadwal', 'id_kls','select'=>'jam_mulai'),
			'hari' => array(self::BELONGS_TO, 'Hari', 'hari', 
					'through' => 'jadwal','select'=>'hari'),
			'idSms' => array(self::BELONGS_TO, 'Sms', 'id_sms'),
			'syarat' => array(self::BELONGS_TO, 'MatKul', 'syarat', 
					'through' => 'mk'),
			'nilai' => array(self::BELONGS_TO, 'Nilai', 'id_kls'),
			'idSmt'=>array(self::BELONGS_TO, 'Semester', 'id_smt')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_kls' => 'Id Kelas',
			'id_sms' => 'Prodi',
			'id_smt' => 'Semester',
			'id_mk' => 'Mata Kuliah',
			'nm_kls' => 'Nama Kelas',
			'sks_mk' => 'SKS Mata Kuliah',
			'sks_tm' => 'SKS Tatap Muka',
			'sks_prak' => 'SKS Praktikum',
			'sks_prak_lap' => 'SKS Praktik Lapangan',
			'sks_sim' => 'SKS Simulasi',
			'bahasan_case' => 'Bahasan Case',
			'tgl_mulai_koas' => 'Tanggal Mulai Koas',
			'tgl_selesai_koas' => 'Tanggal Selesai Koas',
			'id_mou' => 'MOU',
			'a_selenggara_pditt' => 'Apakah Selenggara PDITT',
			'kuota_pditt' => 'Kuota PDITT',
			'a_pengguna_pditt' => 'Apakah  Pengguna PDITT',
			'id_kls_pditt' => 'Kelas PDITT',
			'syarat.nm_mk' => 'Syarat Mata Kuliah',
			'sbs_deskripsi' => 'Deskripsi Singkat',
			'sbs_tujuan' => 'Tujuan',
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
	public function semester($semester)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$sms=Yii::app()->session->get('sms');
		$sSmt=Yii::app()->session->get('smt');
		
		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('id_smt',$this->id_smt,true);
		$criteria->compare('id_mk',$this->id_mk,true);
		$criteria->compare('nm_kls',$this->nm_kls,true);
		/*
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('bahasan_case',$this->bahasan_case,true);
		$criteria->compare('tgl_mulai_koas',$this->tgl_mulai_koas,true);
		$criteria->compare('tgl_selesai_koas',$this->tgl_selesai_koas,true);
		$criteria->compare('id_mou',$this->id_mou,true);
		$criteria->compare('a_selenggara_pditt',$this->a_selenggara_pditt,true);
		$criteria->compare('kuota_pditt',$this->kuota_pditt,true);
		$criteria->compare('a_pengguna_pditt',$this->a_pengguna_pditt,true);
		$criteria->compare('id_kls_pditt',$this->id_kls_pditt,true);
		*/
		$criteria->select="mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,t.id_kls,t.nm_kls";
		$criteria->join='JOIN akt_ajar_dosen as dosen ON dosen.id_kls=t.id_kls';
		$criteria->join = "JOIN matkul as mk ON mk.id_mk=t.id_mk";
		$criteria->condition = "t.id_sms = :id_sms AND mk.semester= :semester AND t.id_smt= :id_smt";
		
		$criteria->params = array (	
		':id_sms' => $sms,
		':semester' => $semester,
		':id_smt' => $sSmt,
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('id_smt',$this->id_smt,true);
		$criteria->compare('id_mk',$this->id_mk,true);
		$criteria->compare('nm_kls',$this->nm_kls,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('bahasan_case',$this->bahasan_case,true);
		$criteria->compare('tgl_mulai_koas',$this->tgl_mulai_koas,true);
		$criteria->compare('tgl_selesai_koas',$this->tgl_selesai_koas,true);
		$criteria->compare('id_mou',$this->id_mou,true);
		$criteria->compare('a_selenggara_pditt',$this->a_selenggara_pditt,true);
		$criteria->compare('kuota_pditt',$this->kuota_pditt,true);
		$criteria->compare('a_pengguna_pditt',$this->a_pengguna_pditt,true);
		$criteria->compare('id_kls_pditt',$this->id_kls_pditt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beluminputnilai($id,$smt)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_kls',$this->id_kls,true);
		$criteria->compare('id_sms',$this->id_sms,true);
		$criteria->compare('id_smt',$this->id_smt,true);
		$criteria->compare('id_mk',$this->id_mk,true);
		$criteria->compare('nm_kls',$this->nm_kls,true);
		$criteria->compare('sks_mk',$this->sks_mk,true);
		$criteria->compare('sks_tm',$this->sks_tm,true);
		$criteria->compare('sks_prak',$this->sks_prak,true);
		$criteria->compare('sks_prak_lap',$this->sks_prak_lap,true);
		$criteria->compare('sks_sim',$this->sks_sim,true);
		$criteria->compare('bahasan_case',$this->bahasan_case,true);
		$criteria->compare('tgl_mulai_koas',$this->tgl_mulai_koas,true);
		$criteria->compare('tgl_selesai_koas',$this->tgl_selesai_koas,true);
		$criteria->compare('id_mou',$this->id_mou,true);
		$criteria->compare('a_selenggara_pditt',$this->a_selenggara_pditt,true);
		$criteria->compare('kuota_pditt',$this->kuota_pditt,true);
		$criteria->compare('a_pengguna_pditt',$this->a_pengguna_pditt,true);
		$criteria->compare('id_kls_pditt',$this->id_kls_pditt,true);
		
		$criteria->join='LEFT JOIN nilai as n ON n.id_kls=t.id_kls ';
		$criteria->condition = "t.id_sms = :id_sms AND t.id_smt= :id_smt AND n.nilai_huruf=:nilai_huruf AND n.acc_pa=:acc_pa GROUP BY t.id_kls order by n.nilai_huruf DESC";
		
		$criteria->params = array (	
		':id_sms' => $id,
		':id_smt' => $smt,
		':nilai_huruf' => '',
		':acc_pa' => 'true',
		);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KelasKuliah the static model class
	 */

	public function kelas()
    {
        $kategori = array(
            array('value'=>'A', 'text'=>'A'),
            array('value'=>'B', 'text'=>'B'),
            array('value'=>'C', 'text'=>'C'),
            array('value'=>'D', 'text'=>'D'),
            array('value'=>'E', 'text'=>'E'),
            array('value'=>'F', 'text'=>'F'),
            array('value'=>'G', 'text'=>'G'),
			array('value'=>'H', 'text'=>'H'),
		    array('value'=>'I', 'text'=>'I'),
			array('value'=>'J', 'text'=>'J'),
			array('value'=>'K', 'text'=>'K'),
			array('value'=>'L', 'text'=>'L'),
			array('value'=>'M', 'text'=>'M'),
			array('value'=>'N', 'text'=>'N'),
			array('value'=>'O', 'text'=>'O'),
			array('value'=>'Gab', 'text'=>'Gab'),
			array('value'=>'IC', 'text'=>'IC'),
        );
        
        return CHtml::listData($kategori, 'value', 'text');
    }
}
