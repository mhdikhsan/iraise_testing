<?php

class KelasKuliahController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='//layouts/column2';

/**
* @return array action filters
*/
public function filters()
{
return array(
'accessControl', // perform access control for CRUD operations
);
}

/**
* Specifies the access control rules.
* This method is used by the 'accessControl' filter.
* @return array access control rules
*/
public function accessRules()
{
return array(
array('allow',  // allow all users to perform 'index' and 'view' actions
'actions'=>array('index','view'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('dosenJadwal','create','cetak','absen','cetakujian','ajax','index2','delete','update'),
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
public function actionIndex2()
{
	$model=new KelasKuliah;
	$this->render('kelaskuliah',array(
	'model'=>$model,
	));
}
public function actionDelete($id)
	{
		$model=KelasKuliah::model()->findByPk($id);
		$model->delete();
		$modelJadwal=Jadwal::model()->find('id_kls=:id_kls',array(':id_kls'=>$id));
		$modelJadwal->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		echo '
		<script>
			history.back();
		</script>
		';
	}
public function actionIndex()
{
	$model=new KelasKuliah;
	$this->render('index',array(
	'model'=>$model,
	));
}
public function actionAbsen()
{
	
	$model=new KelasKuliah;
	$this->render('absen',array(
	'model'=>$model,
	));
}
public function actionUpdate($id)
{
	$model=$this->loadModel($id);
	if(isset($_POST['KelasKuliah']))
	{	
		$kelas =$_POST['KelasKuliah']['nm_kls'];
		$model->nm_kls = $kelas;
		
		if($model->save()){}
			$this->redirect('../../../kelasKuliah');
	}
	
	$this->render('update',array(
	'model'=>$model,
	));
}
public function actionCreate()
{
	$model=new KelasKuliah;
	//(1)
	if(isset($_POST['KelasKuliah']))
	{//(2)
		$model->attributes=$_POST['KelasKuliah'];
		$sms=Yii::app()->session->get('sms');
		$modelKls=KelasKuliah::model()->find('id_sms=:id_sms AND id_smt=:id_smt ORDER BY id_kls DESC',array(':id_sms'=>$sms,':id_smt'=>$_POST['KelasKuliah']['id_smt']));
		//(3)
		if(isset($modelKls->id_kls))
		{//(4)
			$no_kode=strtok(strip_tags($modelKls->id_kls),"-");
			//(5)
			for ($i=1; $i<=3; $i++)
			{//(6)
				$no_kode=strtok("-");
				//(7)
			}
			// $kode=$modelKls->id_kls[$no_kode-2].$modelKls->id_kls[$no_kode-1].$modelKls->id_kls[$no_kode];
			$kode=$no_kode;
			$kode++;
			//(8)
			if($kode<10)
			{//(9)
				$kode='00'.$kode;
				//(10)
			}else if($kode<100){//(11)
				$kode='0'.$kode;
			}//(12)
		}else{//(13)
			$kode="001";
		}//(14)
		$fak=Sms::model()->find('id_sms=:id_sms',array(':id_sms'=>$sms));
		$model->id_kls=$model->id_smt.'-'.$fak->id_induk_sms.'-'.$sms.'-'.$kode;
		//(15)
		if($model->save())//(16)
			$this->redirect('../../admin/kelasKuliah');//(17)
		//(18)
	}//(19)

	$this->render('create',array(
	'model'=>$model,
	));
	//(20)
}
	public function actionAjax() {
	  if (!empty($_GET['term'])) {
		$sql = 'SELECT id_ptk as id, CONCAT(nm_ptk," ",id_ptk) as value FROM dosen WHERE nm_ptk LIKE :qterm ';
		$sql .= ' ORDER BY nm_ptk ASC LIMIT 15';
		$command = Yii::app()->db->createCommand($sql);
		$qterm = $_GET['term'].'%';
		$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
		$result = $command->queryAll();
		echo CJSON::encode($result); exit;
		} else {
			return false;
		}
	}

public function actionDosenJadwal($id)
{
	//Deklarasi Akt Ajar Dosen
	$modelAkt=AktAjarDosen::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
	//(1)
	foreach($modelAkt as $db){//(2)
		//(3)
	}
	
	if(isset($db))
	{//(4)
		$modelAkt=AktAjarDosen::model()->findByPk($db->id_ajar);
		//(5)
	}else{//(6)
		$modelAkt=new AktAjarDosen;
	}//(7)
	//Deklarasi Jadwal
	$modelJadwal=Jadwal::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
	//(8)
	foreach($modelJadwal as $dbJadwal){//(9)
		//(10)
	}
	if(isset($dbJadwal))
	{//(11)
		$modelJadwal=Jadwal::model()->findByPk($dbJadwal->id_jadwal);
		//(12)
	}else{//(13)
		$modelJadwal=new Jadwal;
	}//(14)
	//Model
	$model=KelasKuliah::model()->findByPk($id);
	//(15)
	if(isset($_POST['AktAjarDosen']))
	{//(16)
		$sms=Yii::app()->session->get('sms');
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//Akta Ajar Dosen
		//Cek jika ada
		$id_reg_ptk=$_POST['AktAjarDosen']['id_reg_ptk'];
		$sks_subst_tot=$_POST['AktAjarDosen']['sks_subst_tot'];
		$sks_tm_subst=$_POST['AktAjarDosen']['sks_tm_subst'];
		$sks_prak_subst=$_POST['AktAjarDosen']['sks_prak_subst'];
		$sks_prak_lap_subst=$_POST['AktAjarDosen']['sks_prak_lap_subst'];
		$sks_sim_subst=$_POST['AktAjarDosen']['sks_sim_subst'];
		$jml_tm_renc=$_POST['AktAjarDosen']['jml_tm_renc'];
		$jml_tm_real=$_POST['AktAjarDosen']['jml_tm_real'];
		$id_subst=$_POST['AktAjarDosen']['id_subst'];
		$id_jns_eval=$_POST['AktAjarDosen']['id_jns_eval'];
		$modelAktCek=AktAjarDosen::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
		//(17)
		foreach($modelAktCek as $db){//(18)
			//(19)
		}
		//Cek jika tidak ada data di db maka input new record
		if(!isset($db)){//(20)
			$modelAkt=new AktAjarDosen;//(21)
			}//(22)
		$modelAkt->id_reg_ptk=$id_reg_ptk;
		$modelAkt->id_kls=$id;
		$modelAkt->sks_subst_tot=$sks_subst_tot;
		$modelAkt->sks_tm_subst=$sks_tm_subst;
		$modelAkt->sks_prak_subst=$sks_prak_subst;
		$modelAkt->sks_prak_lap_subst=$sks_prak_lap_subst;
		$modelAkt->sks_sim_subst=$sks_sim_subst;
		$modelAkt->jml_tm_renc=$jml_tm_renc;
		$modelAkt->id_subst=$id_subst;
		$modelAkt->id_jns_eval=$id_jns_eval;
		$modelAkt->save();
		//(23)
		//Jadwal
		//Cek jika ada
		$modelJadwalCek=Jadwal::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
		//(24)
		foreach($modelJadwalCek as $db){//(25)
			//(26)
		}
		//Cek jika tidak ada data di db maka input new record
		if(!isset($db)){//(27)
			$modelJadwal=new Jadwal;//(28)
			}//(29)
		$modelJadwal->id_sms=$sms;
		$modelJadwal->id_kls=$id;
		$modelJadwal->id_ruangan=$_POST['Jadwal']['id_ruangan'];
		$modelJadwal->hari=$_POST['Jadwal']['hari'];
		$modelJadwal->jam_mulai=$_POST['Jadwal']['jam_mulai'];
		$modelJadwal->jam_selesai=$_POST['Jadwal']['jam_selesai'];
		
		// cek jadwal sama/bentrok
		$jam=date('h:i:s',strtotime($_POST['Jadwal']['jam_mulai']));
		$criteria=new CDbCriteria;
		$criteria->join='JOIN akt_ajar_dosen as dosen ON dosen.id_kls=t.id_kls ';
		$criteria->join.='JOIN kelas_kuliah as kls ON kls.id_kls=t.id_kls';
		$criteria->condition = "
			hari=:hari AND 
			dosen.id_reg_ptk=:id_reg_ptk AND 
			kls.id_smt=:id_smt AND
			t.jam_mulai<=:jam_mulai AND t.jam_selesai>=:jam_mulai
		";
		$criteria->params = array (	
		':hari' => $_POST['Jadwal']['hari'],
		':id_reg_ptk' => $id_reg_ptk,
		':id_smt' => $modelSmt->id_smt,
		':jam_mulai' => $jam,
		);
		$modelJadwalCek=Jadwal::model()->find($criteria);
		//(30)
		if((isset($modelJadwalCek))&&($id!=$modelJadwalCek->id_kls))
		{//(31)
			$msg="Bentrok ".$modelJadwalCek->mk['nm_mk']." Jam : ".$modelJadwalCek->jam_mulai."-".$modelJadwalCek->jam_selesai.", Jurusan : ".$modelJadwalCek->id_sms.", Kelas : ".$modelJadwalCek->kls['nm_kls'].", ".$modelJadwalCek->id_jadwal;
			Yii::app()->user->setFlash('flash',$msg);
			$this->refresh();
			//(32)
		}//(33)
		//cek jadwal ruangan sama/bentrok
		$jam=date('H:i:s',strtotime($_POST['Jadwal']['jam_mulai']));
		$criteria=new CDbCriteria;
		$criteria->join='JOIN akt_ajar_dosen as dosen ON dosen.id_kls=t.id_kls ';
		$criteria->join.='JOIN kelas_kuliah as kls ON kls.id_kls=t.id_kls';
		$criteria->condition = "
			hari=:hari AND 
			t.id_ruangan=:id_ruangan AND 
			kls.id_smt=:id_smt AND
			t.jam_mulai<=:jam_mulai AND t.jam_selesai>=:jam_mulai
		";
		$criteria->params = array (	
		':hari' => $_POST['Jadwal']['hari'],
		':id_ruangan' => $_POST['Jadwal']['id_ruangan'],
		':id_smt' => $modelSmt->id_smt,
		':jam_mulai' => $jam,
		);
		$modelJadwalCek=Jadwal::model()->find($criteria);
		//(34)
		if((isset($modelJadwalCek))&&($id!=$modelJadwalCek->id_kls))
		{//(35)
			$msg=" Ruangan Bentrok dengan mata Kuliah ".$modelJadwalCek->mk['nm_mk'].", Kelas : ".$modelJadwalCek->kls['nm_kls'].", Smt : ".$modelJadwalCek->mk['semester'].", ".$modelJadwalCek->id_jadwal;
			Yii::app()->user->setFlash('flash',$msg);
			$this->refresh();
			//(36)
		}//(37)
		if($modelJadwal->save())
		{//(38)
			$this->redirect('../../../../admin/kelasKuliah');//(39)
		}//(40)
	}//(41)

	$this->render('dosenJadwal',array(
	'model'=>$model,
	'modelAkt'=>$modelAkt,
	'modelJadwal'=>$modelJadwal,
	));
	//(42)
}

	public function actionCetak($id)
	{
		//ini_set('memory_limit', '512M');
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
		$sNim=Yii::app()->session->get('username');
		$sSmt=Yii::app()->session->get('semester');
		
		
		
		
		
		//Deklarasi
		$header0="";
		$header="";
		$judul="DAFTAR HADIR KULIAH";
	
		$c=Yii::app()->db;
		$sql="select m.id_pd,m.nm_pd from 
					nilai as n,
					mahasiswa as m 
						where 
							n.id_kls='$id' and 
							m.id_pd=n.id_reg_pd 
							n.acc_pa='true'
								order by m.nm_pd";
		$modelnilai=$c->createCommand($sql)->queryAll();
		
		// panggil dosen, nama mk, & semester
		$sql2="SELECT m.nm_mk, m.semester, m.sks_mk, nm_ptk, s.nm_lemb,s.id_induk_sms,k.nm_kls, r.kode_ruangan,h.hari,j.jam_mulai,j.jam_selesai FROM kelas_kuliah AS k

					LEFT JOIN matkul AS m ON k.id_mk=m.id_mk
					LEFT JOIN akt_ajar_dosen AS ak ON ak.id_kls = k.id_kls
					LEFT JOIN dosen AS d ON ak.id_reg_ptk = d.id_ptk
					LEFT JOIN sms AS s ON s.id_sms = k.id_sms
					LEFT JOIN jadwal j ON j.id_kls = k.id_kls
					LEFT JOIN ruangan r ON r.id_ruangan = j.id_ruangan
					LEFT JOIN hari h ON h.id=j.hari

				WHERE 

				k.id_kls = '$id'
						";
		$mk=$c->createCommand($sql2)->queryRow();
		$fakultas = Sms::model()->findByPk($mk['id_induk_sms'],array('select'=>"nm_lemb"));
		//(1)
		if(empty($fakultas))
		{//(2)
			$fakultas="-";//(3)
		}else {//(4)
			$fakultas = $fakultas->nm_lemb;
		}//(5)
		
		$judul="DAFTAR HADIR KULIAH";
		
		//(6)
		//Render
		$this->renderPartial('cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'ruangan'=>$mk['kode_ruangan'],
			'kelas'=>$mk['nm_kls'],
			'mk'=>$mk['nm_mk'],
			'smt'=>$mk['semester'],
			'sks'=>$mk['sks_mk'],
			'fakultas'=>$fakultas,
			'nm_jurusan'=>$mk['nm_lemb'],
			'dosen'=>$mk['nm_ptk'],
			'modelnilai'=>$modelnilai,
			'hari'=>$mk['hari'],
			'jam_mulai'=>$mk['jam_mulai'],
			'jam_selesai'=>$mk['jam_selesai'],
			
			
		));
		//(7)
	}
	public function actionCetakujian($id)
	{
		//ini_set('memory_limit', '512M');
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
		$sNim=Yii::app()->session->get('sms');
		$sSmt=Yii::app()->session->get('semester');
		$jurusan = Sms::model()->findByPk($sNim,array('select'=>'nm_lemb'));
		$nm_jurusan = $jurusan->nm_lemb;
		//(1)
		if(empty($nm_jurusan))
		{//(2)
			$nm_jurusan="-";//(3)
		}//(4)
		
		//Deklarasi
		$header0="";
		$header="";
		$judul="ABSENSI MAHASISWA ";
		
		
		$c=Yii::app()->db;
		$sql="select m.id_pd,m.nm_pd from 
					nilai as n,
					mahasiswa as m 
						where 
							n.id_kls='$id' and 
							m.id_pd=n.id_reg_pd 
								order by m.nm_pd";
		$modelnilai=$c->createCommand($sql)->queryAll();
		
		// panggil dosen, nama mk, & semester
		$sql2="SELECT m.nm_mk, m.semester, m.sks_mk, nm_ptk,k.nm_kls FROM kelas_kuliah AS k

					JOIN matkul AS m ON k.id_mk=m.id_mk
					JOIN akt_ajar_dosen AS ak ON ak.id_kls = k.id_kls
					JOIN dosen AS d ON ak.id_reg_ptk = d.id_ptk

				WHERE 

				k.id_kls = '$id'
						";
		$mk=$c->createCommand($sql2)->queryRow();
		//(5)
		
		//Render
		$this->renderPartial('cetakujian',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'mk'=>$mk['nm_mk'],
			'smt'=>$mk['semester'],
			'sks'=>$mk['sks_mk'],
			'kls'=>$mk['nm_kls'],
			'nm_jurusan'=>$nm_jurusan,
			'dosen'=>$mk['nm_ptk'],
			'modelnilai'=>$modelnilai,
		));
		//(6)
	}

	public function loadModel($id)
	{
		$model=KelasKuliah::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dosen-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	}
}
