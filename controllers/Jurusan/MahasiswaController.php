<?php //

class MahasiswaController extends Controller
{

public $layout='//layouts/column2';

public function filters()
{
return array(
'accessControl', // perform access control for CRUD operations
);
}

public function accessRules()
{
	return array(
	array('allow',  // allow all users to perform 'index' and 'view' actions
	'actions'=>array('index','view','admin'),
	'users'=>array('*'),
	),
	array('allow', // allow authenticated user to perform 'create' and 'update' actions
	'actions'=>array('create','update','profil','transkip','loadImage','kpCetak','taCetak','akhirCetak','akhirCetakHtml','akhirCetaksementara','cetak','transkipIjazah','laporan','krs','krsCetak','khs','khsCetak','tacetak2','khsHapus','beritaacara','laporan2','Ijazahfix'),
	'users'=>array('@'),
	),
	array('allow', // allow admin user to perform 'admin' and 'delete' actions
	'actions'=>array('admin','delete'),
	'users'=>array('admin'),
	),
	array('deny',  // deny all users
	'users'=>array('*'),
	),
	);
}



public function actionUpdate($id)
{
		$model =Mahasiswa::model()->findByPk($id);
		if(isset($_POST['Mahasiswa']))
		{
				$model->attributes=$_POST['Mahasiswa'];
				$modelMh=MahasiswaHistory::model()->find('nipd=:nipd',array(':nipd'=>$model->id_pd));
				$modelMh->judul_skripsi = $model->regpd_judul_skripsi;
				$modelMh->no_seri_ijazah = $model->regpd_no_seri_ijazah;
				$modelMh->SAVE();
					
				
				if($model->save()):
					$data = "Data Mahasiswa <b>".$model->nm_pd."</b> berhasil di Update";
					Yii::app()->user->setFlash('forgot',$data);
				endif;
				
				
				
				
			
			
		}
		$this->render('update',array(
			'model'=>$model,
			
		));
		
}

public function actionProfil($id)
{
		$model =Mahasiswa::model()->findByPk($id);
		$modelObj=new LargeObject;
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms);
		
		$this->render('profil',array(
			'model'=>$model,
			'modelObj'=>$modelObj,
			'modelSms'=>$modelSms,
		));
}


	public function actionAdmin()
	{
		$model=new Mahasiswa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mahasiswa']))
		$model->attributes=$_GET['Mahasiswa'];

		$this->render('admin',array(
		'model'=>$model,
		));
	}

	
	
	public function actionLoadImage($id)
    {
        $model=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id));
        $this->renderPartial('image', array(
            'model'=>$model
        ));
    }

	public function loadModel($id)
	{
	$model=Mahasiswa::model()->findByPk($id);
	if($model===null)
	throw new CHttpException(404,'The requested page does not exist.');
	return $model;
	}

	
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mahasiswa-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	}


	public function actionKpCetak($nim)
	{
		//Judul
		$judul="TRANSKRIP KERJA PRAKTEK";
		$this->cetak($judul,$nim);
	}
	public function actionTaCetak($nim)
	{
		//Judul
		$judul="TRANSKRIP TUGAS AKHIR";
		$this->cetak($judul,$nim);
	}
	public function actionTaCetak2($nim)
	{
		//Judul
		$judul="TRANSKRIP TUGAS AKHIR";
		$this->cetak2($judul,$nim);
	}
	public function actionAkhirCetak($nim)
	{
		//Judul
		$judul="TRANSKRIP NILAI AKHIR";
		$this->cetak($judul,$nim);
	}
	public function actionAkhirCetakHtml($nim)
	{
		//Judul
		$judul="TRANSKRIP NILAI AKHIR";
		$this->cetakHtml($judul,$nim);
	}
	
	public function actionIjazahfix($nim)
	{
		
		//cari kodem mk
		$array = Yii::app()->db->createCommand("
						SELECT n.id_nilai,m.kode_mk, count(*) as tot, MAX(n.nilai_indeks) FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd  and n.nilai_huruf!=''
						group by m.kode_mk
						having tot>1
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$id_nilai=array();
		$kode_mk=array();
		//(1)
		foreach ($array as $data){//(2)
			$id_nilai[]=$data['id_nilai']; 
			$kode_mk[]="'".$data['kode_mk']."'"; 
			//(3)
		}
		$id_nilai = implode (',',$id_nilai);
		$kode_mk = implode (',',$kode_mk);
		//(4)
		if(empty($array)){//(5)
				$id_nilai = 1;
				$kode_mk = 1;	
			//(6)
		}//(7)
		
		//cari id_nilai yang tidak di tampilkan
		$array2 = Yii::app()->db->createCommand("
						SELECT n.id_nilai FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd  and n.nilai_huruf!='' AND m.kode_mk IN($kode_mk) AND n.id_nilai NOT IN($id_nilai)
		")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		
		$id_nilai2=array();
		//(8)
		foreach ($array2 as $data2){//(9)
			$id_nilai2[]=$data2['id_nilai']; //(10)
		}
		$id_nilai2 = implode (',',$id_nilai2);
		//(11)
		if(empty($array2)){//(12)
				$id_nilai2 = 1;//(13)
								
		}//(14)
		
		$sum =Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' 
						group by m.kode_mk) t
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryRow();
						
		$mhs =Yii::app()->db->createCommand("
						SELECT m.id_pd, m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms,m.regpd_id_sms,j.nm_jenj_didik,mh.no_seri_ijazah,mh.judul_skripsi
							FROM mahasiswa AS m
							LEFT JOIN sms AS s ON s.id_sms = m.regpd_id_sms
							LEFT JOIN bak AS b ON b.id_pd = m.id_pd
							LEFT JOIN dosen AS d ON d.id_ptk = b.id_ptk
							LEFT JOIN jenjang_pendidikan AS j ON j.id_jenj_didik = s.id_jenj_didik
							LEFT JOIN mahasiswa_history as mh ON mh.nipd=m.id_pd
						WHERE m.id_pd LIKE :id_pd
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryRow();
		
		$fak=Sms::model()->findByPk($mhs['id_induk_sms']);
		$JabFak=Fakultas::model()->findByPk($mhs['id_induk_sms']);
		
		
		
		$mhs_smt1 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk, SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='1' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt2 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk,SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='2' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt3 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk,SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='3' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt4 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk, SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='4' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt5 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk, SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='5' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt6 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk, SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='6' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		
		$mhs_smt7 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk, SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='7' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt8 = Yii::app()->db->createCommand("
						select SUBSTR(m.nm_mk, 1, 42) as nm_mk,SUBSTR(m.kode_mk,1,10) as kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and (m.semester='8' OR m.semester='0' )and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		
		$html2pdf = Yii::app() -> ePdf -> HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
		
		$BODYHTML = $this -> renderPartial('ijazahfix',
				array(
					'sum'=>$sum,
					'mhs'=>$mhs,
					'fak'=>$fak,
					'mhs_smt1'=>$mhs_smt1,
					'mhs_smt2'=>$mhs_smt2,
					'mhs_smt3'=>$mhs_smt3,
					'mhs_smt4'=>$mhs_smt4,
					'mhs_smt5'=>$mhs_smt5,
					'mhs_smt6'=>$mhs_smt6,
					'mhs_smt7'=>$mhs_smt7,
					'mhs_smt8'=>$mhs_smt8,
					'JabFak'=>$JabFak,
					'id_nilai'=>$id_nilai,
					
				),true);
		//tulis text yang akan di buat pdf
		$html2pdf -> WriteHTML ($BODYHTML);
		//kirim output ke bentuk pdf
		$html2pdf -> Output('Transkip-ijazah-'.$nim.'.pdf','I'); 
	
		//(15)	
		
	}
	public function actionAkhirCetaksementara($nim)
	{
		//Judul
		$judul="TRANSKRIP NILAI SEMENTARA";
		$this->cetak($judul,$nim);
	}
	
	public function cetak($judul,$id)
	{
		$sum =Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' 
						group by m.kode_mk) t
						")->bindParam(":id_pd", $id, PDO::PARAM_STR)->queryRow();
				
		$data =Yii::app()->db->createCommand("
						SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks,m.nm_mk,m.kode_mk,n.nilai_huruf FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' 
						group by m.kode_mk
						")->bindParam(":id_pd", $id, PDO::PARAM_STR)->queryAll();
						
		$mhs =Yii::app()->db->createCommand("
						SELECT m.id_pd, m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms,m.regpd_id_sms,j.nm_jenj_didik,mh.no_seri_ijazah,mh.judul_skripsi
							FROM mahasiswa AS m
							LEFT JOIN sms AS s ON s.id_sms = m.regpd_id_sms
							LEFT JOIN bak AS b ON b.id_pd = m.id_pd
							LEFT JOIN dosen AS d ON d.id_ptk = b.id_ptk
							LEFT JOIN jenjang_pendidikan AS j ON j.id_jenj_didik = s.id_jenj_didik
							LEFT JOIN mahasiswa_history as mh ON mh.nipd=m.id_pd
						WHERE m.id_pd LIKE :id_pd
						")->bindParam(":id_pd", $id, PDO::PARAM_STR)->queryRow();
		
		$fak=Sms::model()->findByPk($mhs['id_induk_sms']);
		$JabFak=Fakultas::model()->findByPk($mhs['id_induk_sms']);
		//panggil class HTML2PDF
		$html2pdf = Yii::app() -> ePdf -> HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
		$BODYHTML = $this -> renderPartial('cetak',
				array(
					'sum'=>$sum,
					'fak'=>$fak,
					'mhs'=>$mhs,
					'dat'=>$data,
					'judul'=>$judul,
					'JabFak'=>$JabFak,
				),true);
		//tulis text yang akan di buat pdf
		$html2pdf -> WriteHTML ($BODYHTML);
		//kirim output ke bentuk pdf
		$html2pdf -> Output('Transkip-'.$id.'.pdf','P');  
	}
	public function cetakHtml($judul,$id)
	{
		$sum =Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' 
						group by m.kode_mk) t
						")->bindParam(":id_pd", $id, PDO::PARAM_STR)->queryRow();
				
		$data =Yii::app()->db->createCommand("
						SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks,m.nm_mk,m.kode_mk,n.nilai_huruf FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' 
						group by m.kode_mk
						")->bindParam(":id_pd", $id, PDO::PARAM_STR)->queryAll();
						
		$mhs =Yii::app()->db->createCommand("
						SELECT m.id_pd, m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms,m.regpd_id_sms,j.nm_jenj_didik,mh.no_seri_ijazah,mh.judul_skripsi
							FROM mahasiswa AS m
							LEFT JOIN sms AS s ON s.id_sms = m.regpd_id_sms
							LEFT JOIN bak AS b ON b.id_pd = m.id_pd
							LEFT JOIN dosen AS d ON d.id_ptk = b.id_ptk
							LEFT JOIN jenjang_pendidikan AS j ON j.id_jenj_didik = s.id_jenj_didik
							LEFT JOIN mahasiswa_history as mh ON mh.nipd=m.id_pd
						WHERE m.id_pd LIKE :id_pd
						")->bindParam(":id_pd", $id, PDO::PARAM_STR)->queryRow();
		
		$fak=Sms::model()->findByPk($mhs['id_induk_sms']);
		$JabFak=Fakultas::model()->findByPk($mhs['id_induk_sms']);
		$this->renderPartial('cetak_html',array(
					'sum'=>$sum,
					'fak'=>$fak,
					'mhs'=>$mhs,
					'dat'=>$data,
					'judul'=>$judul,
					'JabFak'=>$JabFak,
		));
	}

		
	//laporan
	
	public function actionLaporan($id)
	{
		$model=Mahasiswa::model()->findByPk($id,array('select'=>'nm_pd,id_pd'));	
		
		//cari kodem mk
		$smt = Yii::app()->db->createCommand("
						SELECT semester
							FROM nilai
							WHERE id_reg_pd='$id'
							GROUP BY semester
						")->queryAll();
		
		$this->render('laporan',array(
			'model'=>$model,
			'smt'=>$smt,
		));
	}
	public function actionBeritaacara($id)
	{
		
			$pdf = new fpdf();
		$model=Nilai::model()->findByPk($id,array('select'=>'id_kls,id_reg_pd'));
		
		//nama mahasiswa
		$mahasiswa = Mahasiswa::model()->findByPk($model->id_reg_pd,array('select'=>'nm_pd,id_pd,regpd_id_sms'));
		$nm_mahasiswa = $mahasiswa->nm_pd;
		$nim_mahasiswa = $mahasiswa->id_pd;
		
		//jurusan
		$sms = Sms::model()->findByPk($mahasiswa->regpd_id_sms,array('select'=>'nm_lemb,id_induk_sms'));
		$jurusan = $sms->nm_lemb;
		
		//fakultas
		$fak = Sms::model()->findByPk($sms->id_induk_sms,array('select'=>'nm_lemb'));
		$fak = $fak->nm_lemb;
		
		//matkul
		$kelas = KelasKuliah::model()->findByPk($model->id_kls,array('select'=>'id_mk,id_smt'));
		$matkul = Matkul::model()->findByPk($kelas->id_mk,array('select'=>'kode_mk,nm_mk,sks_mk'));
		$kode_mk  = $matkul->kode_mk;
		$nm_mk = $matkul->nm_mk;
		$sks_mk = $matkul->sks_mk;
		
		//semester
		$smt = Semester::model()->findByPk($kelas->id_smt,array('select'=>'nm_smt'));
		$smt = $smt->nm_smt;
		
		
		$this->renderPartial('beritaacara',array(
			'pdf'=>$pdf,
			'nm_mahasiswa'=>$nm_mahasiswa,
			'nim_mahasiswa'=>$nim_mahasiswa,
			'jurusan'=>$jurusan,
			'fak'=>$fak,
			'kode_mk'=>$kode_mk,
			'nm_mk'=>$nm_mk,
			'sks_mk'=>$sks_mk,
			'smt'=>$smt,
		));
	
		
	}

	public function actionKrs($nim,$semester)
	{
		$id_pd=$nim;
		$getSmt=$semester;
		$modelMhs=Mahasiswa::model()->findByPk($id_pd);
		//SMS = Fakultas dan Jurusan
		$sms=$modelMhs->regpd_id_sms;
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=new Nilai;
		$this->render('krs',array(
			'id_pd'=>$id_pd,
			'getSmt'=>$getSmt,
			'model'=>$model,
			'modelSms'=>$modelSms,
			'modelMhs'=>$modelMhs,
		));
	}	
	
	public function actionKrsCetak($nim,$semester)
	{
		//semester = id
		$id=$semester;
		$pdf = new fpdf();
		//model Mahasiswa
		$model=Mahasiswa::model()->findByPk($nim,array('select'=>'nm_pd,id_pd'));
		//Session
		$sNama=$model->nm_pd;
		$sNim=$model->id_pd;
		// $sSmt=Yii::app()->session->get('semester');
		//Deklarasi
		$header0="KEMENTERIAN AGAMA RI";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="KARTU RENCANA STUDI";
		//Dosen		
		$modelBak=Bak::model()->find('id_pd=:id_pd',array(':id_pd'=>$sNim));
		$bak=$modelBak;
		$id_ptk=$bak->id_ptk;
		$modelDosen=Dosen::model()->findByPk($id_ptk);
		//
		if(!isset($modelDosen))
		{
			$modelDosen=new Dosen;
			$modelDosen->nm_ptk="-";
		}
		//Semester
		$modelNilai=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$sNim,':semester'=>$id));
		foreach($modelNilai as $db){}
		$modelSmt=Semester::model()->findByPk($db->smtKrs['id_smt']);
		$semester=$db->semester .' - ';
		$semester.=($db->semester%2)=="1"? "Ganjil":"Genap";
		//Tahun
		$modelTahun=TahunAjaran::model()->findByPk($modelSmt->id_thn_ajaran);
		//SMS
		$modelMhs=Mahasiswa::model()->findByPk($sNim);
		$modelSms=Sms::model()->findByPk($modelMhs->regpd_id_sms);
		//Fakultas
		$modelFak=Sms::model()->findByPk($modelSms->id_induk_sms);
		//model utk table
		$model=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$sNim,':semester'=>$id));
		//Render
		$this->renderPartial('krs_cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$sNama,
			'nim'=>$sNim,
			'pa'=>$modelDosen->nm_ptk,
			'semester'=>$semester,
			'tahun'=>$modelSmt->nm_smt,
			'prodi'=>$modelSms->nm_lemb,
			'model'=>$model,
			'fakultas'=>$modelFak->nm_lemb,
		));
	}
	
	public function actionKhs($nim,$semester)
	{
		$id_pd=$nim;
		$getSmt=$semester;
		//Model Mahasiswa
		$modelMhs=Mahasiswa::model()->findByPk($id_pd);
		//SMS = Fakultas dan Jurusan
		$sms=$modelMhs->regpd_id_sms;
		$modelSms=Sms::model()->findByPk($sms);
		//Setting Fakultas
		$modelFak=Fakultas::model()->find('status=:status AND id_sms=:id_sms',array(':status'=>'1','id_sms'=>$modelSms->id_induk_sms));
		//Model Mata Kuliah
		$model=new Nilai;
		//Koneksi Database DAO
		$c=Yii::app()->db;
		//ipk
		$ipk="
			SELECT t.*,mk.kode_mk, mk.nm_mk, mk.sks_mk FROM `nilai` as t
			JOIN kelas_kuliah as k ON k.id_kls=t.id_kls
			JOIN matkul as mk ON mk.id_mk=k.id_mk
			WHERE t.`id_reg_pd`='$id_pd' AND t.`semester`<='$semester'
			GROUP BY mk.kode_mk
		";
		$ipk = $c->createCommand($ipk)->queryAll();
		$sks=0;
		$bobot=0;
		foreach($ipk as $db):
			$sks+=$db['sks_mk'];
			$bobot+=$db['nilai_indeks']*$db['sks_mk'];
		endforeach;
		$ipk=number_format(@$bobot/$sks,2);
		$this->render('khs',array(
			'id_pd'=>$id_pd,
			'getSmt'=>$getSmt,
			'model'=>$model,
			'modelSms'=>$modelSms,
			'StgFak'=>$modelFak,
			'modelMhs'=>$modelMhs,
			'ipk'=>$ipk,
		));
	}
	
	public function actionKhsHapus($nim,$semester,$id_nilai)
	{
		
		$sessUser=Yii::app()->session->get('username');
		$model=Nilai::model()->findByPk($id_nilai);
		$modelHapus=NilaiHapus::model()->findByPk($id_nilai);
		if(!isset($modelHapus)):
			$modelHapus=new NilaiHapus;
			$modelHapus->attributes=$model;
			$modelHapus->id_nilai=$model->id_nilai;
			$modelHapus->id_kls=$model->id_kls;
			$modelHapus->id_reg_pd=$model->id_reg_pd;
			$modelHapus->nilai_tugas=$model->nilai_tugas;
			$modelHapus->nilai_quiz=$model->nilai_quiz;
			$modelHapus->nilai_total=$model->nilai_total;
			$modelHapus->nilai_mid=$model->nilai_mid;
			$modelHapus->nilai_uas=$model->nilai_uas;
			$modelHapus->nilai_huruf=$model->nilai_huruf;
			$modelHapus->na=$model->na;
			$modelHapus->nilai_indeks=$model->nilai_indeks;
			$modelHapus->semester=$model->semester;
			$modelHapus->acc_pa=$model->acc_pa;
			$modelHapus->time=date('Y-m-d H:i:s');
			$modelHapus->deleted_by=$sessUser;
			if($modelHapus->save())
				$model->delete();
		endif;
		$this->redirect(array('khs','nim'=>$nim,'semester'=>$semester));
	}
	
	//Menampilkan Kurikulum
	public function kurikulum($data)
	{
		//Kurikulum
		$modelKuri=MatkulKurikulum::model()->find('id_mk=:id_mk',array(':id_mk'=>$data->mk['id_mk']));
		if(isset($modelKuri->kurikulumsp['nm_kurikulum_sp']))
		{
			$kurikulum=$modelKuri->kurikulumsp['nm_kurikulum_sp'];
		}else{
			$kurikulum="-";
		}
		
		return $kurikulum;
	}
	
	public function sksMaks($id_pd,$smt,$ip,$sks_smt)
	{
		if($ip>=3.00)
		{
			$sks=24;
		}else
		if(($ip>=2.50)&&($ip<3))
		{
			$sks=21;
		}else
		if(($ip>=2.00)&&($ip<2.50))
		{
			$sks=18;
		}else
		if(($ip>=1.50)&&($ip<2))
		{
			$sks=15;
		}else
		if($ip<1.50)
		{
			$sks=12;
		}
		
		//Session id_pd
		$s_id_pd=$id_pd;	
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//Mengambil Next Semester
		$modelKuliah=KuliahMhs::model()->find('id_smt=:id_smt',array(':id_smt'=>$modelSmt->id_smt));
		//Mengambil Next Id Semester
		$modelSmt=Semester::model()->find('tgl_mulai > :tgl_mulai',array(':tgl_mulai'=>$modelSmt->tgl_selesai));
		//Input ke Kuliah Mhs		
		$modelKuliahMhs=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND id_smt=:id_smt',array(':id_reg_pd'=>$s_id_pd,':id_smt'=>$modelSmt->id_smt));
		//cek smt sekarang
		if($modelKuliah->semester==$smt)
		{
			//Current Smt
			$modelKuliah->ips=$ip;
			$modelKuliah->save();
			//Next Smt
			if(isset($modelKuliahMhs)):
			$modelKuliahMhs->sks_total=$sks;
			$modelKuliahMhs->save();
			endif;
		}
		//semester dipilih (ex : 1)
		
		$modelSmtNow=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$s_id_pd,':semester'=>$smt));
		if(isset($modelSmtNow)){
			$modelSmtNow->ips=$ip;
			$modelSmtNow->sks_smt=$sks_smt;
			// $modelSmtNow->save();
			$smt++;
		}
		//semester next (ex : 2)
		$modelSmtNext=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$s_id_pd,':semester'=>$smt));
		if(isset($modelSmtNext))
		{
			$modelSmtNext->sks_total=$sks;
			$modelSmtNext->save();
		}
		//return value
		return $sks;
	}
	
	public function actionKhsCetak($nim,$semester)
	{
		//semester = id
		$id=$semester;
		$pdf = new fpdf();
		//model Mahasiswa
		$model=Mahasiswa::model()->findByPk($nim);
		//Session
		$sNama=$model->nm_pd;
		$sNim=$model->id_pd;
		//Deklarasi
		$header0="KEMENTERIAN AGAMA RI";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="KARTU HASIL STUDI";
		//Dosen		
		$modelBak=Bak::model()->findAll('id_pd=:id_pd',array(':id_pd'=>$sNim));
		//(1)
		foreach($modelBak as $bak){//(2)
			//(3)
		}
		$id_ptk=$bak->id_ptk;
		$modelDosen=Dosen::model()->findByPk($id_ptk);
		//Semester
		$modelNilai=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$sNim,':semester'=>$id));
		//(4)
		foreach($modelNilai as $db){//(5)
			if(isset($db->smtKrs['id_smt'])){//(6)
				break;//(7)
				}//(8)
			}
		$modelSmt=Semester::model()->findByPk($db->smtKrs['id_smt']);
		$semester=$db->semester .' - ';
		//Tahun
		$modelTahun=TahunAjaran::model()->findByPk($modelSmt->id_thn_ajaran);
		//SMS
		$modelMhs=Mahasiswa::model()->findByPk($sNim);
		$modelSms=Sms::model()->findByPk($modelMhs->regpd_id_sms);
		//Setting Fakultas
		$StgFak=Fakultas::model()->findAll('status=:status AND id_sms=:id_sms',array(':status'=>'1','id_sms'=>$modelSms->id_induk_sms));
		//(9)
		foreach($StgFak as $db){//(10)
		//(11)	
		}
		
		//Fakultas
		$modelFak=Sms::model()->findByPk($modelSms->id_induk_sms);
		//model utk table
		$criteria=new CDbCriteria;
		$criteria->condition = "t.id_reg_pd = :id_reg_pd AND t.semester=:semester";
		$criteria->join = "JOIN kelas_kuliah as k ON k.id_kls=t.id_kls ";
		$criteria->join .= "JOIN matkul as mk ON mk.id_mk=k.id_mk ";
		$criteria->order = "mk.nm_mk";
		$criteria->params = array (	
		':id_reg_pd' => $sNim,
		':semester' => $id,
		);
		$model=Nilai::model()->findAll($criteria);
		//Kuliah Mhs
		$modelKuliah=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$sNim,':semester'=>($semester+1)));
		//(12)
		if(isset($modelKuliah))://(13)
			$sks=$modelKuliah->sks_total;//(14)
		else:
		//(15)
			$sks="-";
		endif; //(16)
		//IPK
		$ipk_sks=0;
		$ipk_ip=0;
		//Semester
		$criteria=new CDbCriteria;
		$criteria->group="semester";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND acc_pa=:acc_pa";
		$criteria->order="semester ASC";
		$criteria->params = array (	
			':id_reg_pd' => $sNim,
			':acc_pa' => 'true',
		);
		$semester=Nilai::model()->findAll($criteria);		
		$criteria=new CDbCriteria;
		//(17)
		foreach($semester as $smt):
		//(18)
			if($smt->semester!=$id):
			//(19)
				$criteria->condition = "id_reg_pd = :id_reg_pd AND semester=:semester";
				$criteria->params = array (	
					':id_reg_pd' => $sNim,
					':semester' => $smt->semester,
				);
				$temp=KuliahMhs::model()->find($criteria);
				$sks_smt=0;
				$nm=0;
				//(20)
				if(isset($temp))
				{//(21)
					$sks_smt=$temp->sks_smt;
					$nm=$temp->nm;
					//(22)
				}//(23)
				// $ipk_sks.=$sks_smt.'-';
				$ipk_sks=$ipk_sks+$sks_smt;
				$ipk_ip=$ipk_ip+$nm;
				//(24)
			else:
			//(25)
				break;
			endif;//(26)
		endforeach;
		$criteria->condition = "id_reg_pd = :id_reg_pd AND semester=:semester";
		$criteria->params = array (	
			':id_reg_pd' => $sNim,
			':semester' => $id,
		);
		$temp=KuliahMhs::model()->find($criteria);
		$ipk_khs=$temp->ipk;
		
		//Koneksi Database DAO
		$c=Yii::app()->db;
		//ipk
		$ipk_query="
			SELECT t.*,mk.kode_mk, mk.nm_mk, mk.sks_mk, max(t.nilai_indeks) as max
			FROM `nilai` as t
			JOIN kelas_kuliah as k ON k.id_kls=t.id_kls
			JOIN matkul as mk ON mk.id_mk=k.id_mk
			WHERE t.`id_reg_pd`='".$sNim."' AND t.`semester`<='".$id."'
			GROUP BY mk.kode_mk
		";
		$data = $c->createCommand($ipk_query)->query();
		$sks=0;
		$bobot=0;
		//(27)
		while(($row=$data->read())!==false)
		{//(28)
			$sks+=$row['sks_mk'];
			$bobot+=number_format($row['max']*$row['sks_mk'],2);
			//(29)
		}
		$ipk_fix=number_format(@$bobot/$sks,2);
		//Render
		$this->renderPartial('khs_cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$sNama,
			'nim'=>$sNim,
			'pa'=>$modelDosen->nm_ptk,
			'semester'=>$id,
			'tahun'=>$modelSmt->nm_smt,
			'prodi'=>$modelSms->nm_lemb,
			'model'=>$model,
			'fakultas'=>$modelFak->nm_lemb,
			'StgFak'=>$db,
			'sks_total'=>$sks,
			'ipk_sks'=>$ipk_sks,
			'ipk_ip'=>$ipk_ip,
			'ipk_khs'=>$ipk_khs,
			'ipk_fix'=>$ipk_fix,
			'sks_fix'=>$sks,
			'bobot_fix'=>$bobot,
		));
		//(30)
	}
}
