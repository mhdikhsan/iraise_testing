<?php

class WisudaController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','edit'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function beforeAction() {
		$daftarwisuda= Yii::app()->session->get('wisuda');
		
			if ($daftarwisuda=='1') {
				return true;
			}else {
				Yii::app()->request->redirect('Mahasiswa/');
			}
		
		
	}
	public function actionIndex()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		//(1)
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		/*
		* END
		* Input IPK
		*
		*/
		//(2)
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		//(3)
		
		if(!isset($modelWisuda)) //(4)
		{
			$modelWisuda=new Wisuda; //(5)
		}//(6)
		//tombol
		if(isset($_POST['skl'])){ //(7)
			$this->redirect(array('skl'));//(8)
			}//(9)
		if(isset($_POST['univ'])){ //(10)
			$this->redirect(array('univ')); //(11)
			} //(12)
		if(isset($_POST['form'])) //(13)
		{
			$modelWisuda->tgl_daftar_wisuda=date('Y-m-d H:i:s');
			$modelWisuda->save();
			$this->redirect(array('form'));
			//(14)
		}//(15)
		//save
		if(isset($_POST['Mahasiswa']))
		{//(16)
			$model->attributes=$_POST['Mahasiswa'];
			$model->id_pd = $id;
			$model->tgl_lahir = $_POST['Mahasiswa']['tgl_lahir'];
			$email= $_POST['Mahasiswa']['email'];
			//(17)
			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{ //(18)
				$model->email=$email;//(19)
			}else{ 
				$model->email=null; //(20)
			} //(21)
			if($model->save()): //(22)
				//$this->redirect(array('update','id'=>$model->id_pd));
				$data = "Profil Sukses Di Update";
				Yii::app()->user->setFlash('forgot',$data);
				//(23)
			endif; //(24)
			
			//print_r($_POST);
		} //(25)
		//render
		$this->render('index',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'modelWisuda'=>$modelWisuda,
			//(26)
		));
	}
	
	public function actionEdit()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		//(1)
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		/*
		* END
		* Input IPK
		*
		*/
		//(2)
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		//(3)
		if(!isset($modelWisuda))
		{
			$modelWisuda=new Wisuda;
		}
		//tombol
		if(isset($_POST['skl'])){$this->redirect(array('skl'));}
		if(isset($_POST['univ'])){$this->redirect(array('univ'));}
		if(isset($_POST['form']))
		{
			$modelWisuda->tgl_daftar_wisuda=date('Y-m-d H:i:s');
			$modelWisuda->save();
			$this->redirect(array('form'));
		}
		//save
		if(isset($_POST['Mahasiswa']))
		{
			$model->attributes=$_POST['Mahasiswa'];
			$model->id_pd = $id;
			$model->tgl_lahir = $_POST['Mahasiswa']['tgl_lahir'];
			$email= $_POST['Mahasiswa']['email'];
			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$model->email=$email;	
			}else{
				$model->email=null;
			}
			if($model->save()):
				//$this->redirect(array('update','id'=>$model->id_pd));
				$data = "Profil Sukses Di Update";
				Yii::app()->user->setFlash('forgot',$data);
			endif;
			
			//print_r($_POST);
		}
		//render
		$this->render('edit',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'modelWisuda'=>$modelWisuda,
		));
	}
	
	public function actionSkl()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'id_sms,nm_lemb'));
		//(1)
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk, semester";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		$smt=KuliahMhs::model()->find($criteria)->semester;
		/*
		* END
		* Input IPK
		*
		*/
		//(2)
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		//(3)
		if(!isset($modelWisuda))
		{ //(4)
			$modelWisuda=new Wisuda;//(5)
		}//(6)
		if(isset($_POST['wis_judul']))
		{ //(7)
			if($modelWisuda->skl_status=='0')
			{//(8)
				$modelWisuda->skl_status='1';//(9)
			}//(10)
				$modelWisuda->id_pd=$id;
				$modelWisuda->nm_pd=$model->nm_pd;
				$modelWisuda->wis_jurusan=$_POST['wis_jurusan'];
				$modelWisuda->wis_kons=$_POST['wis_kons'];
				$modelWisuda->wis_smt=$_POST['wis_smt'];
				$modelWisuda->wis_judul=$_POST['wis_judul'];
				$modelWisuda->wis_pembimbing=$_POST['wis_pembimbing'];
				$modelWisuda->wis_tgl_lulus=$_POST['wis_tgl_lulus'];
				$modelWisuda->wis_ipk=$ipk;
				$modelWisuda->skl_tgl_daftar=date('Y-m-d H:i:s');
				//(11)
				if($modelWisuda->save())://(12)
					$modelNotif=new Notif;
					$modelNotif->notif_user=$id;
					$modelNotif->notif_foto="wisuda/graduation.png";
					$modelNotif->notif_judul="Wisuda";
					$modelNotif->notif_body="Pengajuan Surat Keterangan Lulus";
					$modelNotif->created_by=$id;
					$modelNotif->created_date=date('Y-m-d H:i:s');
					$modelNotif->save();
					//(13)
				endif;//(14)
			$this->redirect(array('index'));//(15)
			
			//print_r($_POST);
		}

		$this->render('skl',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'smt'=>$smt,
			'modelWisuda'=>$modelWisuda,
		));
		//(16)
	}
	
	public function actionUniv()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		//(1)
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		//(2)
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		/*
		* END
		* Input IPK
		*
		*/
		
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		//(3)
		if(!isset($modelWisuda))
		{//(4)
			$modelWisuda=new Wisuda;//(5)
		}//(6)
		if(isset($_POST['id_pd']))
		{//(7)
			$modelWisuda->id_pd=$id;
			$modelWisuda->nm_pd=$model->nm_pd;
			$modelWisuda->wis_ipk=$ipk;
			$modelWisuda->lib_univ_status='1';
			$modelWisuda->lib_univ_tgl_daftar=date('Y-m-d H:i:s');
			//(8)
			if($modelWisuda->save()): //(9)
				$this->redirect(array('index'));
				$data = "Profil Sukses Di Update";
				Yii::app()->user->setFlash('forgot',$data);
				//(10)
			endif;//(11)
			
			//print_r($_POST);
		} //(12)

		$this->render('univ',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'modelWisuda'=>$modelWisuda,
		));
		//(13)
	}
	
	public function actionForm()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk, semester";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		$smt=KuliahMhs::model()->find($criteria)->semester;
		/*
		* END
		* Input IPK
		*
		*/
		
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		if(!isset($modelWisuda))
		{
			$modelWisuda=new Wisuda;
		}
		if(isset($_POST['wis_judul']))
		{
			if($modelWisuda->skl_status=='0')
			{
				$modelWisuda->id_pd=$id;
				$modelWisuda->nm_pd=$model->nm_pd;
				$modelWisuda->wis_jurusan=$_POST['wis_jurusan'];
				$modelWisuda->wis_smt=$_POST['wis_smt'];
				$modelWisuda->wis_judul=$_POST['wis_judul'];
				$modelWisuda->wis_tgl_lulus=$_POST['wis_tgl_lulus'];
				$modelWisuda->wis_ipk=$ipk;
				$modelWisuda->skl_status='1';
				$modelWisuda->skl_tgl_daftar=date('Y-m-d H:i:s');
				if($modelWisuda->save()):
					$data = "Profil Sukses Di Update";
					Yii::app()->user->setFlash('forgot',$data);
				endif;
			}
			$this->redirect(array('index'));
			
			//print_r($_POST);
		}

		$this->render('_form',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'smt'=>$smt,
			'modelWisuda'=>$modelWisuda,
		));
	}
	
	public function actionFormCetak()
	{
		//semester = id
		$id='1';
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
		$sNim=Yii::app()->session->get('username');
		$sSmt=Yii::app()->session->get('semester');
		//Deklarasi
		$header0="FORMULIR PENDAFTARAN WISUDA ONLINE";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="Form Wisuda - ".$sNama;
		//Semester
		// $modelNilai=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester AND acc_pa="true" AND nilai_huruf!=""',array(':id_reg_pd'=>$sNim,':semester'=>$id));
		// foreach($modelNilai as $db){}
		// $modelSmt=Semester::model()->findByPk($db->smtKrs['id_smt']);
		// $semester=$db->semester .' - ';
		//Tahun
		// $modelTahun=TahunAjaran::model()->findByPk($modelSmt->id_thn_ajaran);
		//SMS
		$modelMhs=Mahasiswa::model()->findByPk($sNim);
		$modelSms=Sms::model()->findByPk($modelMhs->regpd_id_sms);
		//Setting Fakultas
		$StgFak=Fakultas::model()->findAll('status=:status AND id_sms=:id_sms',array(':status'=>'1','id_sms'=>$modelSms->id_induk_sms));
		foreach($StgFak as $db){}
		//Fakultas
		$modelFak=Sms::model()->findByPk($modelSms->id_induk_sms);
		//model utk table
		$criteria=new CDbCriteria;

		$criteria->select= "*";
		$criteria->join= " left join kelas_kuliah as kk on kk.id_kls=t.id_kls ";
		$criteria->join.= "left join matkul as m on m.id_mk=kk.id_mk ";
		$criteria->condition = "t.id_reg_pd=:id_reg_pd AND t.semester=:semester AND t.acc_pa=:acc_pa AND t.nilai_huruf!=:nilai_huruf AND m.id_mk!=:id_mk GROUP BY m.kode_mk";
		$criteria->params = array (	
			':id_reg_pd'=>$sNim,
			':semester'=>$id, 
			':acc_pa'=>'true',
			':nilai_huruf'=>'',
			':id_mk'=>'',
		);
		// $model=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester AND acc_pa=:acc_pa',array(':id_reg_pd'=>$sNim,':semester'=>$id, ':acc_pa'=>'true'));
		$model=Nilai::model()->findAll($criteria);
		
		echo '<script>console.log($model);</script>';
		//Kuliah Mhs
		$modelKuliah=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$sNim,':semester'=>$id+1)); 
		if(isset($modelKuliah)):
			$sks=$modelKuliah->sks_total;
		else:
			$sks="-";
		endif;
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$sNim));
		$modelWP=Predikat::model()->findByPk($modelWisuda->skl_predikat);
		//Render
		$this->renderPartial('_form_cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$sNama,
			'nim'=>$sNim,
			// 'semester'=>$semester,
			// 'tahun'=>$modelSmt->nm_smt,
			'prodi'=>$modelSms->nm_lemb,
			'model'=>$model,
			'fakultas'=>$modelFak->nm_lemb,
			'StgFak'=>$db,
			'sks_total'=>$sks,
			'modelMhs'=>$modelMhs,
			'modelWisuda'=>$modelWisuda,
			'modelWP'=>$modelWP,
		));
	}
	
	
	public function ubahTgl($tgl)
	{
		list($year, $month, $day) = split('[/.-]', $tgl);
		switch($month)
		{
			case '01':$bulan="Januari";break;
			case '02':$bulan="Februari";break;
			case '03':$bulan="Maret";break;
			case '04':$bulan="April";break;
			case '05':$bulan="Mei";break;
			case '06':$bulan="Juni";break;
			case '07':$bulan="Juli";break;
			case '08':$bulan="Agustus";break;
			case '09':$bulan="September";break;
			case '10':$bulan="Oktober";break;
			case '11':$bulan="November";break;
			case '12':$bulan="Desember";break;
			default :$bulan="Lengkapi Data";
		}
		return $day.' '.$bulan.' '.$year;
	}
}
