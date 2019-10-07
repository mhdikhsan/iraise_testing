<?php

class KrsController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update','admin','index','cetak','kurikulum'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	 
	 /*
	public function beforeAction() {
		$nim= Yii::app()->session->get('username');
		$ceklengkap = Mahasiswa::model()->findAll('id_pd= :id_pd',array(':id_pd'=>$nim));
		foreach ($ceklengkap as $data) {
			if (strlen($data['nik'])<=1 or strlen($data['ds_kel'])<=1 or strlen($data['id_wil'])<=1) {
				Yii::app()->request->redirect('Mahasiswa/update/id/'.$nim);
			}else {
				return true;
			}
		}
		
	}*/
	
	public function actionIndex()
	{
		$sess_id_pd=Yii::app()->session->get('username');
		$sess_angkatan=Yii::app()->session->get('angkatan');
		
		//Koneksi Database DAO
		$c=Yii::app()->db;
		//cek email
		$mahasiswa="select email,nisn from mahasiswa where id_pd='$sess_id_pd'";
		$mahasiswa = $c->createCommand($mahasiswa)->queryRow();
		if($mahasiswa['email']== ""){
			$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$sess_id_pd);
		}
		
		//cek angkatan & nisn
		if(($sess_angkatan==2015) && ($mahasiswa['nisn']=="")){
			$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$sess_id_pd);
		} 
		$this->render('index');
	}
	
	public function actionCetak($semester)
	{
		//semester = id
		$getSmt=$semester;
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
	
		//Deklarasi
		$header0="KEMENTERIAN AGAMA RI";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="KARTU RENCANA STUDI";
		//Dosen		
		
		$id_pd=Yii::app()->session->get('username');
		$smt=Yii::app()->session->get('semester');
		//waktu
		$time=date('Y-m-d H:i:s');
		//(1)
		
		$c=Yii::app()->db;
		//nilai
		$sql_nilai="select m.kode_mk,m.nm_mk,m.sks_mk,k.nm_kls,ks.nm_kurikulum_sp,jp.nm_jenj_didik,d.nm_ptk from nilai as n
				INNER JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
				INNER JOIN matkul as m ON m.id_mk=k.id_mk
				INNER join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
				INNER JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
				INNER JOIN jenjang_pendidikan as jp ON jp.id_jenj_didik=m.id_jenj_didik
				INNER JOIN akt_ajar_dosen as akt ON akt.id_kls=k.id_kls
				INNER JOIN dosen as d ON  d.id_ptk=akt.id_reg_ptk
			where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND acc_pa='true' AND m.id_mk!='' order by m.nm_mk";
			
		$nilai_dao = $c->createCommand($sql_nilai);
		$nilai_dao->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
		$nilai_dao->bindParam(":semester", $getSmt, PDO::PARAM_STR);
		$nilai_dao = $nilai_dao->queryAll();
		//(2)
		//cetak krs harus di acc pa dulu
		$acc_pa=false;
		$sql_nilai_cetak="select m.kode_mk,m.nm_mk,m.sks_mk,k.nm_kls,ks.nm_kurikulum_sp,jp.nm_jenj_didik,d.nm_ptk,n.acc_pa from nilai as n
				INNER JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
				INNER JOIN matkul as m ON m.id_mk=k.id_mk
				INNER join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
				INNER JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
				INNER JOIN jenjang_pendidikan as jp ON jp.id_jenj_didik=m.id_jenj_didik
				INNER JOIN akt_ajar_dosen as akt ON akt.id_kls=k.id_kls
				INNER JOIN dosen as d ON  d.id_ptk=akt.id_reg_ptk
			where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND n.acc_pa LIKE :acc_pa AND m.id_mk!=''";
			
		$nilai_dao_cetak = $c->createCommand($sql_nilai_cetak);
		$nilai_dao_cetak->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
		$nilai_dao_cetak->bindParam(":semester", $smt, PDO::PARAM_STR);
		$nilai_dao_cetak->bindParam(":acc_pa", $acc_pa, PDO::PARAM_STR);
		$nilai_dao_cetak = $nilai_dao_cetak->queryAll();
		//(3)
		if(count($nilai_dao_cetak)!=0)
		{ //4)
			$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/matkul/preview');
		//(5)
		}
		//(6)
		//bak
		$sql_bak = "SELECT m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms
						FROM mahasiswa AS m
						INNER JOIN sms AS s ON s.id_sms = m.regpd_id_sms
						INNER JOIN bak AS b ON b.id_pd = m.id_pd
						INNER JOIN dosen AS d ON d.id_ptk = b.id_ptk
					WHERE m.id_pd LIKE :id_pd";
		$bak=$c->createCommand($sql_bak);
		$bak->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
		$bak= $bak->queryRow();
		//(7)
		//fak
		$id_induk_sms = $bak['id_induk_sms'];
		$sql_fak = "SELECT s.nm_lemb	FROM sms AS s	WHERE s.id_sms LIKE :id_induk_sms";
		$fak=$c->createCommand($sql_fak);
		$fak->bindParam(":id_induk_sms", $id_induk_sms, PDO::PARAM_STR);
		$fak= $fak->queryRow();
		//(8)
		
		//tahun ajaran
		
		$sql_smt = "SELECT s.nm_smt FROM kuliah_mhs	as km 
					INNER join semester as s ON s.id_smt = km.id_smt
					WHERE km.id_reg_pd LIKE :id_pd and km.semester LIKE :smt";
		$tahunajaran=$c->createCommand($sql_smt);
		$tahunajaran->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
		$tahunajaran->bindParam(":smt", $getSmt, PDO::PARAM_STR);
		$tahunajaran= $tahunajaran->queryRow();
		//(9)
		//Start QRCode
		$no=1;
		$qr_krs='';
		$qr_krs2='';
		//(10)
		foreach($nilai_dao as $db)
		{//(11)
			$qr_krs.='|'.$no.'|'.$db['kode_mk'].'';
			$qr_krs2.='|'.$no.'|'.$db['kode_mk'].' - '.$db['nm_mk'].' - '.$db['sks_mk'].' SKS - '.$db['nm_ptk'].' - '.$db['nm_kls'].' - '.$db['nm_kurikulum_sp'].'.<br>';
			$no++;
			//(12)
		}
		
		//deklarasi
		$qrcode=
			''.$bak['nm_pd'].
			'/'.$id_pd.
			'/smt '.$getSmt.
			','.$qr_krs.
			',time='.$time.
			''
		;
		//(13)
		$qrcode2=
			'<b>Nama/Nim</b> : '.$bak['nm_pd'].'/'.$id_pd.
			', <b>PA</b> : '.$bak['nm_ptk'].
			', <b>Fakultas</b> : '.$fak['nm_lemb'].
			', <b>Prodi</b> : '.$bak['nm_lemb'].
			', <b>Tahun</b> : '.$tahunajaran['nm_smt'].
			', <b>Semester</b> : '.$getSmt.
			
			'<br><br><br>'.$qr_krs2.
			'<br><br><b>Time</b> : '.$time.
			''
		;
		//(14)
			//Start Notifikasi
			$modelCekNotif=Notif::model()->find('notif_user=:notif_user AND notif_judul=:notif_judul AND DATE_FORMAT(created_date,"%Y-%m-%d %H:%i")=:tgl',array(':notif_user'=>$id_pd,':notif_judul'=>'KRS',':tgl'=>date('Y-m-d H:i')));
			//(15)
			if(!isset($modelCekNotif))
			{//(16)
				$modelNotif=new Notif;
				$modelNotif->notif_user=$id_pd;
				$modelNotif->notif_judul="KRS";
				$modelNotif->notif_body='Anda telah mencetak KRS semester '.$getSmt.'';
				$modelNotif->notif_hidden=$qrcode2;
				$modelNotif->created_by=$id_pd;
				$modelNotif->created_date=$time;
				//(17)
				if($modelNotif->save())
				{ //(18)
					$qrcode.=',kode='.$modelNotif->notif_id;
					$qrcode='https://iraise.uin-suska.ac.id/qrcode/validasi/id/'.$modelNotif->notif_id;
				//(19)
				}//(20)
				
			}else{//(21)
				$modelNotif=$modelCekNotif;
			}//(22)
			
			//End Notifikasi
		//Generate QRcode
		$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
		'data' => $qrcode,
		'filename' => $id_pd.'.png',
		// 'filePath' => Yii::app()->request->baseUrl.'/images/qrcode',
		'subfolderVar' => false,
		'matrixPointSize' => 5,
		'displayImage'=>true, // default to true, if set to false display a URL path
		'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
		'matrixPointSize'=>4, // 1 to 10 only
		));
		//(23)
		//END QRCode
		$this->renderPartial('cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$bak['nm_pd'],
			'nim'=>$id_pd,
			'pa'=>$bak['nm_ptk'],
			'semester'=>$getSmt,
			'tahun'=>$tahunajaran['nm_smt'],
			'prodi'=>$bak['nm_lemb'],
			'model'=>$nilai_dao,
			'fakultas'=>$fak['nm_lemb'],
			'modelNotif'=>$modelNotif,
		));
		//(24)
	}
	
	//Menampilkan Kurikulum
	public function kurikulum($data)
	{
		//Kurikulum
		$modelKuri=MatkulKurikulum::model()->find('id_mk=:id_mk',array(':id_mk'=>$data->mk['id_mk'])); //(1)
		if(isset($modelKuri->kurikulumsp['nm_kurikulum_sp']))
		{//(2)
			$kurikulum=$modelKuri->kurikulumsp['nm_kurikulum_sp'];//(3)
		}else{//(4)
			$kurikulum="-";
		}//(5)
		
		return $kurikulum;//(6)
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Matkul the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Matkul::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Matkul $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='matkul-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
