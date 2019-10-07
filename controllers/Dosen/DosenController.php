<?php
// dosen
class DosenController extends Controller
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
				'actions'=>array('index','view','create','ajax2','loadImage','kwnAjax','syarat','konversiNilaiHuruf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','step5','admin','deleteAcc','update','bak','nilaiMatkul','nilaiMhs','nilaiMhs2','nilaiMatkulDispensasi','nilaiMhsCetak','nilaiMhsCetakP','statusKrs','acc','exportExcel','exportExcelHuruf','exportExcelAngka','importExcel','importExcelHuruf','importExcelAngka','nilaiMatkulHistory','bakCetak','bakchat'),
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
		$id_ptk=Yii::app()->session->get('username');
		$model=$this->loadModel($id_ptk);
		$modelObj=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id_ptk));
		$nidn=true;
		//(1)


		
		if(isset($_POST['Dosen'])) //(2)
		{
			$model->attributes=$_POST['Dosen'];
			$model->id_ptk=$id_ptk;
			$model->tgl_lahir = $_POST['Dosen']['tgl_lahir'];
			$model->tgl_sk_cpns = $_POST['Dosen']['tgl_sk_cpns'];
			$model->sk_angkat = $_POST['Dosen']['sk_angkat'];
			$model->id_wil = $_POST['Dosen']['id_wil'];
			$model->tmt_sk_angkat = $_POST['Dosen']['tmt_sk_angkat'];
			$model->tmt_pns = $_POST['Dosen']['tmt_pns'];
			//(3)

			if($model->save()) //(4)
			{
				$data = "Profil Sukses Di Update";
				Yii::app()->user->setFlash('forgot',$data);
				//(5)
			}//(6)
		} //(7)

		$ceklengkap = Dosen::model()->findAll('id_ptk= :id_ptk',array(':id_ptk'=>$id_ptk));
		//(8)
		foreach ($ceklengkap as $data) { //(9)
			if (strlen($data['nidn'])<=3) { //(10)
				$nidn=false;//(11)
			} //(12)
		}
		
		//(13)
		$this->render('update',array(
			'model'=>$model,
			'modelObj'=>$modelObj,
			'nidn'=>$nidn,
		));
	}
	
	public function actionAjax2() {
	  if (!empty($_GET['term'])) {
		$sql = 'SELECT id_wil as id, nm_wil as value FROM wilayah WHERE nm_wil LIKE :qterm AND id_level_wil=3';
		$sql .= ' ORDER BY nm_wil ASC LIMIT 15';
		$command = Yii::app()->db->createCommand($sql);
		$qterm = $_GET['term'].'%';
		$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
		$result = $command->queryAll();
		echo CJSON::encode($result); exit;
		} else {
			return false;
		}
	}

	
	
	public function actionDeleteAcc($id)
	{
		$sessUser=Yii::app()->session->get('username');
		$model=Nilai::model()->findByPk($id);
		//Kelas Kuliah
		$modelKelas=KelasKuliah::model()->findByPk($model->id_kls);
		//Matkul
		$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
		$modelDosen=Dosen::model()->findByPk($sessUser);
		$modelMhs=Mahasiswa::model()->findByPk($model->id_reg_pd);
		$nm_ptk="";
		//(1)
		if(isset($modelDosen))
		{ //(2)
			$nm_ptk=$modelDosen->nm_ptk; //(3)
		}//(4)
		$modelNilaiHapus=new NilaiHapus();
		$modelNilaiHapus->id_kls=$model->id_kls;
		$modelNilaiHapus->id_reg_pd=$model->id_reg_pd;
		$modelNilaiHapus->nilai_tugas=$model->nilai_tugas;
		$modelNilaiHapus->nilai_quiz=$model->nilai_quiz;
		$modelNilaiHapus->nilai_total=$model->nilai_total;
		$modelNilaiHapus->nilai_mid=$model->nilai_mid;
		$modelNilaiHapus->nilai_uas=$model->nilai_uas;
		$modelNilaiHapus->nilai_huruf=$model->nilai_huruf;
		$modelNilaiHapus->na=$model->na;
		$modelNilaiHapus->nilai_indeks=$model->nilai_indeks;
		$modelNilaiHapus->semester=$model->semester;
		$modelNilaiHapus->acc_pa=$model->acc_pa;
		$modelNilaiHapus->time=date('Y-m-d H:i:s');
		$modelNilaiHapus->deleted_by=$sessUser;
		$modelNilaiHapus->save();
		//(5)
		
		if($model->delete())
		{//(6)
			//Start Notifikasi
			/*
			$modelNotif=new Notif;
			$notif_body='Dosen '.$nm_ptk.' telah menolak persetujuan mata kuliah '.$modelMatkul->nm_mk;
			$modelNotif->notif_user=$model->id_reg_pd;
			$modelNotif->notif_judul="KRS";
			$modelNotif->notif_body=$notif_body;
			$modelNotif->created_by=$sessUser;
			$modelNotif->created_date=date('Y-m-d H:i:s');
			$modelNotif->save();
			$modelNotif=new Notif;
			$notif_body='Anda telah menolak persetujuan mata kuliah '.$modelMatkul->nm_mk.' mahasiswa '.$modelMhs->nm_pd;
			$modelNotif->notif_user=$sessUser;
			$modelNotif->notif_judul="KRS";
			$modelNotif->notif_body=$notif_body;
			$modelNotif->created_by=$sessUser;
			$modelNotif->created_date=date('Y-m-d H:i:s');
			$modelNotif->save();
			*/
			//End Notifikasi
			//(7)
		}//(8)

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))//(9)
		echo '
		<script>
			history.back();
		</script>
		';
		//(10)
		
		//(11)
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex2()
	{
		$dataProvider=new CActiveDataProvider('Dosen');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	
	/**
	 * Manages all models.
	 */
	 /*
	public function actionAdmin()
	{
		$model=new Dosen('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Dosen']))
			$model->attributes=$_GET['Dosen'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	*/
	
		public function actionnilaiMatkulDispensasi()
	{
		//Model Mata Kuliah
		$model=new AktAjarDosen;
		$this->render('nilaiMatkulDispensasi',array(
			'model'=>$model,
			
		));
	}
	public function actionnilaiMatkul()
	{

	
		$nip= Yii::app()->session->get('username');
		$ceklengkap = Dosen::model()->findAll('id_ptk= :id_ptk',array(':id_ptk'=>$nip));
		foreach ($ceklengkap as $data) {
			if (strlen($data['nidn'])<=3) {
				Yii::app()->request->redirect(Yii::app()->request->baseUrl.'/dosen/Dosen/update/id/'.$nip);
			}
		}
		

		//Model Mata Kuliah
		$model=new AktAjarDosen;
		$this->render('nilaiMatkul',array(
			'model'=>$model,
			
		));
	}
	public function actionnilaiMatkulHistory()
	{
		// if(isset($_GET['tahun']))
		// {
			// $this->redirect(array('nilaiMatkulHistory','tahun'=>$_GET['tahun']));
		// }
		//Model Mata Kuliah
		$model=new AktAjarDosen;
		$this->render('nilaiMatkulHistory',array(
			'model'=>$model,
			
		));
	}
	
	public function actionnilaiMhs($id)
	{		
		$cek_kelas_kuliah=KelasKuliah::model()->findByPK($id,array('select'=>'id_sms,id_mk'));
		$cek_sms = Sms::model()->findByPK($cek_kelas_kuliah->id_sms,array('select'=>'id_induk_sms'));
		$stgFak=Fakultas::model()->find('id_sms=:id_sms',array(':id_sms'=>$cek_sms->id_induk_sms));
		//time
		$time=date('Y-m-d H:i:s');
		
		
		//dosen
		$id_ptk=Yii::app()->session->get('username');
		$modelDosen=Dosen::model()->findByPk($id_ptk);
		
		//mata kuliah
		$modelMK=Matkul::model()->findByPk($cek_kelas_kuliah->id_mk);
		
		$akt=AktAjarDosen::model()->findByAttributes(array('id_kls'=>$id));
		$akt = $akt->id_reg_ptk;
	
		//Cek Tgl	
		//yura rubah sikit mas haha
		$dispensasi=AktAjarDosen::model()->find('id_reg_ptk=:id_reg_ptk AND id_kls=:id_kls',array(':id_reg_ptk'=>$id_ptk,':id_kls'=>$id));
		//(1)
		if(((date('Y-m-d')>=$stgFak->tgl_mulai_nilai)&&(date('Y-m-d')<=$stgFak->tgl_selesai_nilai))||(date('Y-m-d')<=$dispensasi->tgl_dispensasi))
		{ //(2)
				//(3)
		}else{ 
			$this->redirect(array('Dosen/nilaiMatkul')); //(4)
		} //(5)
		
		// var_dump($akt);die();
		// if($akt!==$id_ptk){
			// $this->redirect(array('Dosen/update/id'));
		// }
		//Bobot dari dosen BD (Bobot Dosen)
		$modelBD=KelasKuliah::model()->findByPk($id);
		$bobot_tugas=0;
		$bobot_quiz=0;
		$bobot_mid=0;
		$bobot_uas=0;
		//(6)
		if(isset($modelBD))
		{	//(7)				
			$bobot_tugas=$modelBD->bobot_tugas/100;
			$bobot_quiz=$modelBD->bobot_quiz/100;
			$bobot_mid=$modelBD->bobot_mid/100;
			$bobot_uas=$modelBD->bobot_uas/100;
			//(8)
		}//(9)
		
		if(isset($_POST['KelasKuliah']))
		{ //(10)
			$modelBD->bobot_tugas=$_POST['KelasKuliah']['bobot_tugas'];
			$modelBD->bobot_quiz=$_POST['KelasKuliah']['bobot_quiz'];
			$modelBD->bobot_mid=$_POST['KelasKuliah']['bobot_mid'];
			$modelBD->bobot_uas=$_POST['KelasKuliah']['bobot_uas'];
			//(11)
			if(($modelBD->bobot_tugas+$modelBD->bobot_quiz+$modelBD->bobot_mid+$modelBD->bobot_uas)=="100")
			{ //(12)
				$modelBD->save(); //(13)
			}else{ 
				$msg="Jumlah Presentase Bobot Nilai Harus Sama dengan 100%";
				Yii::app()->user->setFlash('flash',$msg);
				//(14)
			} //(15)
			$this->refresh(); //(16)
		} //(17)
		//end bobot
		//Model Mata Kuliah
		$cek_nilai_huruf=false;
		$cek_na=false;
		$model=new Nilai;
		//Batas log
		$log=1000;
		//(18)
		if(isset($_POST['Nilai']))
		{ //(19)
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id); //(20)
			//Cek jika log > 1 maka tidak bisa input nilai
			if($modelKls->log>=$log)
			{ //(21)
				$msg="Anda tidak diberikan akses untuk mengubah nilai!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->refresh();
				//(22)
			} //(23)
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//(24)
			//Cek Nilai Huruf
			$check=$_POST['nilai_huruf'];
			//(25)
			if(count($check)>0)
			{ //(26)
				$temp="";
				//(27)
				foreach($check as $id_nilai=>$nilai_huruf)
				{//(28)					
					$modelAcc=Nilai::model()->findByPk($id_nilai);
					//(29)
					if($modelAcc->nilai_huruf!=$nilai_huruf)
					{//(30)
						
						//temp
						$nilai_huruf_lama=$modelAcc->nilai_huruf;
						$nilai_huruf_baru=$nilai_huruf;
						$cek_nilai_huruf=true;
						$modelAcc->nilai_huruf=$nilai_huruf;
						//cek bobot
						$modelBobot=BobotNilai::model()->find('nilai_huruf=:nilai_huruf',array(':nilai_huruf'=>$nilai_huruf));
						//(31)
						//input bobot
						if($nilai_huruf=="")
						{//(32)
							$modelAcc->nilai_indeks=""; //(33)
						}else{ //(34)
							$modelAcc->nilai_indeks=$modelBobot->nilai_indeks;
						} //(35)
						
						if($modelAcc->save())
						{//(36)							
							//Start Notifikasi
							/*
							$modelNotif=new Notif;
							$modelNotif->notif_user=$modelAcc->id_reg_pd;
							$modelNotif->notif_judul="Nilai";
							$modelNotif->notif_body='Dosen '.$modelDosen->nm_ptk.' telah mengubah nilai '.$modelMK->nm_mk.' dari nilai '.$nilai_huruf_lama.' menjadi nilai '.$nilai_huruf_baru.' '; 
							$modelNotif->notif_hidden='';
							$modelNotif->created_by=$id_ptk;
							$modelNotif->created_date=$time;
							$modelNotif->save();
							*/							
							//End Notifikasi
						//-----------------------------------------------------------------------------------------------------------------------------------------
						//(37)
						} //(38)
					}else{ //(39)
						//Start Notifikasi
						/*
						$modelNotif=new Notif;
						$modelNotif->notif_user=$modelAcc->id_reg_pd;
						$modelNotif->notif_judul="Nilai";
						$modelNotif->notif_body='Dosen '.$modelDosen->nm_ptk.' telah memasukkan nilai '.$modelMK->nm_mk.' dengan nilai '.$nilai_huruf.' ';	
						$modelNotif->notif_hidden='';
						$modelNotif->created_by=$id_ptk;
						$modelNotif->created_date=$time;
						$modelNotif->save();
						*/						
						//End Notifikasi
					} //(40)
				}
			} //(41) 
			//Cek Nilai Angka
			$check=$_POST['na'];
			//(42)
			if(count($check)>0)
			{ //(43)
				foreach($check as $id_nilai=>$na)
				{ //(44)						
					$modelAcc=Nilai::model()->findByPk($id_nilai);
					//(45)
					if($modelAcc->na!=$na)
					{//(46)
						$cek_na=true; //(47)
					} //(48)
				}
			} //(49)
			//Cek Kondisi
			if($cek_nilai_huruf)
			{ //(50)
				//(51)
			}else if($cek_na) { 
			
				// $this->redirect('../../aaaa');
				//Cek Nilai Angka
				$check=$_POST['na'];
				//(52)
				if(count($check)>0)
				{ //(53)
					$temp="";
					//(54)
					foreach($check as $id_nilai=>$na)
					{ //(55)						
						$modelAcc=Nilai::model()->findByPk($id_nilai);
						//(56)
						if($modelAcc->na!=$na)
						{ //(57)
							$modelAcc->na=$na;
							$modelAcc->save();
							//(58)
						} //(59)
					} 
				} //(60)
				$this->konversiNilaiHuruf($id);
				//(61)
			}else{ 
				//apakah ada perubahan?
				$cek=false;
				//Nilai Tugas
				//(62)
				if(isset($_POST['nilai_tugas']))
				{ //(63)
					$check=$_POST['nilai_tugas'];
					//(64)
					if(count($check)>0)
					{ //(65)
						foreach($check as $id_nilai=>$nilai_tugas)
						{	//(66)					
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							//(67)
							if($modelAcc->nilai_tugas!=$nilai_tugas)
							{//(68)
								$cek=true;
								$modelAcc->nilai_tugas=$nilai_tugas;
								$modelAcc->save();
								//(69)
							}//(70)
						}
					}//(71)
				}//(72)
				//Nilai Quiz
				if(isset($_POST['nilai_quiz']))
				{ //(73)
					$check=$_POST['nilai_quiz'];
					//(74)
					if(count($check)>0)
					{ //(75)
						foreach($check as $id_nilai=>$nilai_quiz)
						{//(76)					
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							//(77)
							if($modelAcc->nilai_quiz!=$nilai_quiz)
							{ //(78)
								$cek=true;
								$modelAcc->nilai_quiz=$nilai_quiz;
								$modelAcc->save();
								//(79)
							}//(80)
						}
					}//(81)
				}//(82)
				//Nilai Mid
				if(isset($_POST['nilai_mid']))
				{ //(83)
					$check=$_POST['nilai_mid'];
					//(84)
					if(count($check)>0)
					{ //(85)
						foreach($check as $id_nilai=>$nilai_mid)
						{ //(86)						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							//(87)
							if($modelAcc->nilai_mid!=$nilai_mid)
							{ //(88)
								$cek=true;
								$modelAcc->nilai_mid=$nilai_mid;
								$modelAcc->save();
								//(89)
							}//(90)
						}
					} //(91)
				} //(92)
				//Nilai Uas
				if(isset($_POST['nilai_uas']))
				{ //(93)
					$check=$_POST['nilai_uas'];
					//(94)
					if(count($check)>0)
					{//(95)
						foreach($check as $id_nilai=>$nilai_uas)
						{	//(96)					
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							//(97)
							if($modelAcc->nilai_uas!=$nilai_uas)
							{//(98)
								$cek=true;
								$modelAcc->nilai_uas=$nilai_uas;
								$modelAcc->save();
								//(99)
							}//(100)
						}
					}//(101)
				}//(102)
				
				//Deklarasi Nilai Angka ubah ke Nilai Huruf
				if($cek==true)
				{//(103)
					$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
					//(104)
					foreach($modelNa as $na)
					{ //(105)
						$modelNilai=Nilai::model()->findByPk($na->id_nilai);
						$modelNilai->nilai_total=($modelNilai->nilai_tugas+$modelNilai->nilai_quiz)/2;
						$modelNilai->na=number_format((($modelNilai->nilai_tugas*$bobot_tugas)+($modelNilai->nilai_quiz*$bobot_quiz)+($modelNilai->nilai_mid*$bobot_mid)+($modelNilai->nilai_uas*$bobot_uas)),2);
						//(106)
						if($modelNilai->na=="100")
						{//(107)
							$modelNilai->nilai_huruf="A";
							$modelNilai->nilai_indeks="4";
							//(108)
						}else{ //(109)
							$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>$modelNilai->na));
							//(110)
							foreach($modelBobot as $bobot)
							{ //(111)
								$modelNilai->nilai_huruf=$bobot->nilai_huruf;
								$modelNilai->nilai_indeks=$bobot->nilai_indeks;
								//(112)
							}
						} //(113)
						if($modelNilai->save()) //(114)
						{
							//todo
							//(115)
						} //(116)
					}
				}//(117)
			} //(118)
			//Refresh halaman
			// $this->refresh();
		}//(119)
		
		//$this->konversiNilaiHuruf($id);
		$this->render('nilaiMhs',array(
			'model'=>$model,
			'modelBD'=>$modelBD,
		));
		//(120)
	}
	
	public function actionnilaiMhs2($id)
	{		
		$cek_kelas_kuliah=KelasKuliah::model()->findByPK($id,array('select'=>'id_sms,id_mk'));
		$cek_sms = Sms::model()->findByPK($cek_kelas_kuliah->id_sms,array('select'=>'id_induk_sms'));
		$stgFak=Fakultas::model()->find('id_sms=:id_sms',array(':id_sms'=>$cek_sms->id_induk_sms));
		//time
		$time=date('Y-m-d H:i:s');
		
		//dosen
		$id_ptk=Yii::app()->session->get('username');
		$modelDosen=Dosen::model()->findByPk($id_ptk);
		
		//mata kuliah
		$modelMK=Matkul::model()->findByPk($cek_kelas_kuliah->id_mk);
		
		$akt=AktAjarDosen::model()->findByAttributes(array('id_kls'=>$id));
		$akt = $akt->id_reg_ptk;
		//Cek Tgl	
		//yura rubah sikit mas haha
		$dispensasi=AktAjarDosen::model()->find('id_reg_ptk=:id_reg_ptk AND id_kls=:id_kls',array(':id_reg_ptk'=>$id_ptk,':id_kls'=>$id));
		if(((date('Y-m-d')>=$stgFak->tgl_mulai_nilai)&&(date('Y-m-d')<=$stgFak->tgl_selesai_nilai))||(date('Y-m-d')<=$dispensasi->tgl_dispensasi))
		{
		}else{
			$this->redirect(array('Dosen/nilaiMatkul'));
		}
		
		// var_dump($akt);die();
		// if($akt!==$id_ptk){
			// $this->redirect(array('Dosen/update/id'));
		// }
		//Bobot dari dosen BD (Bobot Dosen)
		$modelBD=KelasKuliah::model()->findByPk($id);
		$bobot_tugas=0;
		$bobot_quiz=0;
		$bobot_mid=0;
		$bobot_uas=0;
		if(isset($modelBD))
		{					
			$bobot_tugas=$modelBD->bobot_tugas/100;
			$bobot_quiz=$modelBD->bobot_quiz/100;
			$bobot_mid=$modelBD->bobot_mid/100;
			$bobot_uas=$modelBD->bobot_uas/100;
		}
		if(isset($_POST['KelasKuliah']))
		{
			$modelBD->bobot_tugas=$_POST['KelasKuliah']['bobot_tugas'];
			$modelBD->bobot_quiz=$_POST['KelasKuliah']['bobot_quiz'];
			$modelBD->bobot_mid=$_POST['KelasKuliah']['bobot_mid'];
			$modelBD->bobot_uas=$_POST['KelasKuliah']['bobot_uas'];
			if(($modelBD->bobot_tugas+$modelBD->bobot_quiz+$modelBD->bobot_mid+$modelBD->bobot_uas)=="100")
			{
				$modelBD->save();
			}else{
				$msg="Jumlah Presentase Bobot Nilai Harus Sama dengan 100%";
				Yii::app()->user->setFlash('flash',$msg);
			}
			$this->refresh();
		}
		//end bobot
		//Model Mata Kuliah
		$cek_nilai_huruf=false;
		$cek_na=false;
		$model=new Nilai;
		//Batas log
		$log=1000;
		if(isset($_POST['Nilai']))
		{
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			if($modelKls->log>=$log)
			{
				$msg="Anda tidak diberikan akses untuk mengubah nilai!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->refresh();
			}
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//Cek Nilai Huruf
			$check=$_POST['nilai_huruf'];
			if(count($check)>0)
			{
				$temp="";
				foreach($check as $id_nilai=>$nilai_huruf)
				{						
					$modelAcc=Nilai::model()->findByPk($id_nilai);
					if($modelAcc->nilai_huruf!=$nilai_huruf)
					{
						
						//temp
						$nilai_huruf_lama=$modelAcc->nilai_huruf;
						$nilai_huruf_baru=$nilai_huruf;
						$cek_nilai_huruf=true;
						$modelAcc->nilai_huruf=$nilai_huruf;
						//cek bobot
						$modelBobot=BobotNilai::model()->find('nilai_huruf=:nilai_huruf',array(':nilai_huruf'=>$nilai_huruf));
						//input bobot
						if($nilai_huruf=="")
						{
							$modelAcc->nilai_indeks="";
						}else{
							$modelAcc->nilai_indeks=$modelBobot->nilai_indeks;
						}
						if($modelAcc->save())
						{							
							//Start Notifikasi
							/*
							$modelNotif=new Notif;
							$modelNotif->notif_user=$modelAcc->id_reg_pd;
							$modelNotif->notif_judul="Nilai";
							$modelNotif->notif_body='Dosen '.$modelDosen->nm_ptk.' telah mengubah nilai '.$modelMK->nm_mk.' dari nilai '.$nilai_huruf_lama.' menjadi nilai '.$nilai_huruf_baru.' '; 
							$modelNotif->notif_hidden='';
							$modelNotif->created_by=$id_ptk;
							$modelNotif->created_date=$time;
							$modelNotif->save();
							*/							
							//End Notifikasi
						//-----------------------------------------------------------------------------------------------------------------------------------------
						}
					}else{
						//Start Notifikasi
						/*
						$modelNotif=new Notif;
						$modelNotif->notif_user=$modelAcc->id_reg_pd;
						$modelNotif->notif_judul="Nilai";
						$modelNotif->notif_body='Dosen '.$modelDosen->nm_ptk.' telah memasukkan nilai '.$modelMK->nm_mk.' dengan nilai '.$nilai_huruf.' ';	
						$modelNotif->notif_hidden='';
						$modelNotif->created_by=$id_ptk;
						$modelNotif->created_date=$time;
						$modelNotif->save();
						*/						
						//End Notifikasi
					}
				}
			}
			//Cek Nilai Angka
			$check=$_POST['na'];
			if(count($check)>0)
			{
				foreach($check as $id_nilai=>$na)
				{						
					$modelAcc=Nilai::model()->findByPk($id_nilai);
					if($modelAcc->na!=$na)
					{
						$cek_na=true;
					}
				}
			}
			//Cek Kondisi
			if($cek_nilai_huruf)
			{
			}else if($cek_na)
			{
				// $this->redirect('../../aaaa');
				//Cek Nilai Angka
				$check=$_POST['na'];
				if(count($check)>0)
				{
					$temp="";
					foreach($check as $id_nilai=>$na)
					{						
						$modelAcc=Nilai::model()->findByPk($id_nilai);
						if($modelAcc->na!=$na)
						{
							$modelAcc->na=$na;
							$modelAcc->save();
						}
					}
				}
				$this->konversiNilaiHuruf($id);
			}else{
				//apakah ada perubahan?
				$cek=false;
				//Nilai Tugas
				if(isset($_POST['nilai_tugas']))
				{
					$check=$_POST['nilai_tugas'];
					if(count($check)>0)
					{
						foreach($check as $id_nilai=>$nilai_tugas)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							if($modelAcc->nilai_tugas!=$nilai_tugas)
							{
								$cek=true;
								$modelAcc->nilai_tugas=$nilai_tugas;
								$modelAcc->save();
							}
						}
					}
				}
				//Nilai Quiz
				if(isset($_POST['nilai_quiz']))
				{
					$check=$_POST['nilai_quiz'];
					if(count($check)>0)
					{
						foreach($check as $id_nilai=>$nilai_quiz)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							if($modelAcc->nilai_quiz!=$nilai_quiz)
							{
								$cek=true;
								$modelAcc->nilai_quiz=$nilai_quiz;
								$modelAcc->save();
							}
						}
					}
				}
				//Nilai Mid
				if(isset($_POST['nilai_mid']))
				{
					$check=$_POST['nilai_mid'];
					if(count($check)>0)
					{
						foreach($check as $id_nilai=>$nilai_mid)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							if($modelAcc->nilai_mid!=$nilai_mid)
							{
								$cek=true;
								$modelAcc->nilai_mid=$nilai_mid;
								$modelAcc->save();
							}
						}
					}
				}
				//Nilai Uas
				if(isset($_POST['nilai_uas']))
				{
					$check=$_POST['nilai_uas'];
					if(count($check)>0)
					{
						foreach($check as $id_nilai=>$nilai_uas)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							if($modelAcc->nilai_uas!=$nilai_uas)
							{
								$cek=true;
								$modelAcc->nilai_uas=$nilai_uas;
								$modelAcc->save();
							}
						}
					}
				}
				
				//Deklarasi Nilai Angka ubah ke Nilai Huruf
				if($cek==true)
				{
					$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
					foreach($modelNa as $na)
					{
						$modelNilai=Nilai::model()->findByPk($na->id_nilai);
						$modelNilai->nilai_total=($modelNilai->nilai_tugas+$modelNilai->nilai_quiz)/2;
						$modelNilai->na=number_format((($modelNilai->nilai_tugas*$bobot_tugas)+($modelNilai->nilai_quiz*$bobot_quiz)+($modelNilai->nilai_mid*$bobot_mid)+($modelNilai->nilai_uas*$bobot_uas)),2);
						if($modelNilai->na=="100")
						{
							$modelNilai->nilai_huruf="A";
							$modelNilai->nilai_indeks="4";
						}else{
							$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>$modelNilai->na));
							foreach($modelBobot as $bobot)
							{
								$modelNilai->nilai_huruf=$bobot->nilai_huruf;
								$modelNilai->nilai_indeks=$bobot->nilai_indeks;
							}
						}
						if($modelNilai->save())
						{
							//todo
							
						}
					}
				}
			}
			//Refresh halaman
			// $this->refresh();
		}
		
		//$this->konversiNilaiHuruf($id);
		$this->render('nilaiMhs2',array(
			'model'=>$model,
			'modelBD'=>$modelBD,
		));
	}
	
	public function actionNilaiMhsCetak($id)
	{
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
		$sNim=Yii::app()->session->get('username');
		$sSmt=Yii::app()->session->get('semester');
		//Deklarasi
		$header0="KEMENTERIAN AGAMA RI";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="NILAI";
		
		//kelas dan matakuliah
		$modelKls=KelasKuliah::model()->findByPk($id);
		//model Nilai
		
		//tahun ajaran
		$tahun = Semester::model()->findByPk($modelKls->id_smt,array('select'=>"nm_smt"));
		$tahun = $tahun->nm_smt;
		
		$sms = Sms::model()->findByPk($modelKls->id_sms,array('select'=>"nm_lemb"));
		$sms = $sms->nm_lemb;
		$filename="NILAI-".$modelKls->mk['nm_mk']."-".$sNama."-".$sms."-".$tahun;
		
		$model=new Nilai;
		//Render
		$this->renderPartial('nilaiMhsCetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$sNama,
			'tahun'=>$tahun,
			'nim'=>$sNim,
			'modelKls'=>$modelKls,
			'model'=>$model,
			'id_kls'=>$id,
			'sms'=>$sms,
			'filename'=>$filename,
		));
	}
	public function actionNilaiMhsCetakP($id)
	{
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
		$sNim=Yii::app()->session->get('username');
		$sSmt=Yii::app()->session->get('semester');
		//Deklarasi
		$header0="KEMENTERIAN AGAMA RI";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="NILAI";
		$time=date('Y-m-d H:i:s');
		
		//kelas dan matakuliah
		$modelKls=KelasKuliah::model()->findByPk($id);
		//model Nilai
		
		//tahun ajaran
		$tahun = Semester::model()->findByPk($modelKls->id_smt,array('select'=>"nm_smt"));
		$tahun = $tahun->nm_smt;
		
		$sms = Sms::model()->findByPk($modelKls->id_sms,array('select'=>"nm_lemb"));
		$sms = $sms->nm_lemb;
		$filename="NILAI-".$modelKls->mk['nm_mk']."-".$sNama."-".$sms."-".$tahun;
		
		$model=new Nilai;
		
		//-----------------------------------------------------------------------------------------------------------------------------------------
		//Start QRCode
		$no=1;
		$qr_krs='';
		$qr_krs2='';
		foreach($model->nilaiMhs($id)->getData() as $db)
		{
			$qr_krs2.='|'.$no.'|'.$db->id_reg_pd.' - '.$db['mhs']['nm_pd'].' - '.$db->na.' - '.$db->nilai_huruf.'.<br>';
			$no++;
		}
		//deklarasi
		$qrcode='';
		$qrcode2=
			'<b>Nama</b> : '.$sNama.
			'<br><b>NIP/NIK</b> : '.$sNim.
			'<br><b>Jurusan</b> : '.$sms.
			'<br><b>Mata Kuliah/kelas</b> : '.$modelKls->mk['nm_mk'].'/<b>'.$modelKls->nm_kls.'</b>'.
			
			'<br><br><br>'.$qr_krs2.
			'<br><br><b>Time</b> : '.$time.
			''
		;
			//Start Notifikasi
			$modelNotif=new Notif;
			$modelCekNotif=Notif::model()->find('notif_user=:notif_user AND notif_judul=:notif_judul AND DATE_FORMAT(created_date,"%Y-%m-%d %H:%i")=:tgl',array(':notif_user'=>$sNim,':notif_judul'=>'Cetak',':tgl'=>date('Y-m-d H:i')));
			if(!isset($modelCekNotif))
			{
				$modelNotif->notif_user=$sNim;
				$modelNotif->notif_judul="Cetak";
				$modelNotif->notif_body='Anda telah mencetak nilai mata kuliah '.$modelKls->mk['nm_mk'].' kelas '.$modelKls->nm_kls;
				$modelNotif->notif_hidden=$qrcode2;
				$modelNotif->created_by=$sNim;
				$modelNotif->created_date=$time;
				if($modelNotif->save())
				{
					$qrcode2.=',validation id='.$modelNotif->notif_id;
					$qrcode='https://iraise.uin-suska.ac.id/qrcode/validasi/id/'.$modelNotif->notif_id;
				}
								
				//Generate QRcode
				$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
				'data' => $qrcode,
				'filename' => $sNim.'.png',
				'subfolderVar' => false,
				'matrixPointSize' => 5,
				'displayImage'=>true, // default to true, if set to false display a URL path
				'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
				'matrixPointSize'=>4, // 1 to 10 only
				));
				//END QRCode		
			}
			//End Notifikasi
		//-----------------------------------------------------------------------------------------------------------------------------------------
		
		//Render
		$this->renderPartial('nilaiMhsCetakP',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$sNama,
			'tahun'=>$tahun,
			'nim'=>$sNim,
			'modelKls'=>$modelKls,
			'model'=>$model,
			'id_kls'=>$id,
			'sms'=>$sms,
			'filename'=>$filename,
			'modelNotif'=>$modelNotif,
		));
	}
	
	public function konversiNilaiHuruf($id)
	{
		//Deklarasi Nilai Angka ubah ke Nilai Huruf
		$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
		//(1)
		foreach($modelNa as $na)
		{//(2)
			$modelNilai=Nilai::model()->findByPk($na->id_nilai);
			//(3)
			if($modelNilai->na=="100")
			{ //(4)
				$modelNilai->nilai_huruf="A";
				$modelNilai->nilai_indeks="4";
				//(5)
			}else{
				//(6)
				$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>$modelNilai->na));
				foreach($modelBobot as $bobot)
				{//(7)
					$modelNilai->nilai_huruf=$bobot->nilai_huruf;
					$modelNilai->nilai_indeks=$bobot->nilai_indeks;
					//(8)
				}
			}//(((9)
			$modelNilai->save();	
				//(10)
		}
		//(11)
	}
	
	public function actionExportExcel($id_kls)
    { 	
		if(isset($_POST['fileType']))
		{//(1)
			$filetype=$_POST['fileType']; //(2)
		}else{ //(3)
			$filetype="Excel";
		}//(4)
		$modelKls=KelasKuliah::model()->findByPk($id_kls);
		$jurusan =Sms::model()->findByPk($modelKls->id_sms);
		//(5)
		if(isset($filetype)){	//(6)
			$model = new Nilai();
		//(7)
			if($filetype== "Excel"){//(8)
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Nilai '.$jurusan->nm_lemb.'-'.$modelKls->mk->nm_mk.'-'. $modelKls->nm_kls,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->nilaiMhs($id_kls),
					'filter'=>$model,
					'locked'=>array('D2:D55', 'E2:E55', 'F2:F55', 'G2:G55'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						array(
							'header'=>$id_kls,
							'value'=>'$data->id_nilai',
						),
						'id_reg_pd', 
						'mhs.nm_pd',
						'nilai_tugas',
						'nilai_quiz',
						'nilai_mid',
						'nilai_uas',
					),
				));
				//(9)
				 
			} //(10)
		}//(11)
    }
	
	public function actionExportExcelHuruf($nilaihuruf)
    { 	
		$modelKls=KelasKuliah::model()->findByPk($nilaihuruf); //(1)
		if(isset($_POST['fileType'])){ //(2)
			$model = new Nilai();
			//(3)
			if($_POST['fileType']== "Excel"){ //(4)
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Nilai '.$modelKls->mk->nm_mk.'-'. $modelKls->nm_kls,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->nilaiMhs($nilaihuruf),
					'filter'=>$model,
					'locked'=>array('D2:D54'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						array(
							'header'=>$nilaihuruf,
							'value'=>'$data->id_nilai',
						),
						'id_reg_pd', 
						'mhs.nm_pd',
						'nilai_huruf',
					),
				));
				 //(5)
			} //(6)
		}//(7)
    }
	
	public function actionExportExcelAngka($nilaiangka)
    { 	
		$modelKls=KelasKuliah::model()->findByPk($nilaiangka);//(1)
		if(isset($_POST['fileType'])){ //(2)
			$model = new Nilai();
			//(3)
			if($_POST['fileType']== "Excel"){ //(4)
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Nilai '.$modelKls->mk->nm_mk.'-'. $modelKls->nm_kls,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->nilaiMhs($nilaiangka),
					'filter'=>$model,
					'locked'=>array('D2:D55'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						array(
							'header'=>$nilaiangka,
							'value'=>'$data->id_nilai',
						),
						'id_reg_pd', 
						'mhs.nm_pd',
						'na',
					),
				));
				//(5)
				 
			} //(6)
		}//(7)
    }
	
	public function actionImportExcel($id)
    { 	
		//Bobot dari dosen BD (Bobot Dosen)
		$modelBD=KelasKuliah::model()->findByPk($id);
		$bobot_tugas=0;
		$bobot_quiz=0;
		$bobot_mid=0;
		$bobot_uas=0;
		//(1)
		if(isset($modelBD))
		{//(2)				
			$bobot_tugas=$modelBD->bobot_tugas/100;
			$bobot_quiz=$modelBD->bobot_quiz/100;
			$bobot_mid=$modelBD->bobot_mid/100;
			$bobot_uas=$modelBD->bobot_uas/100;
			//(3)
		} //(4)
		if(isset($_POST['KelasKuliah']))
		{ //(5)
			$modelBD->bobot_tugas=$_POST['KelasKuliah']['bobot_tugas'];
			$modelBD->bobot_quiz=$_POST['KelasKuliah']['bobot_quiz'];
			$modelBD->bobot_mid=$_POST['KelasKuliah']['bobot_mid'];
			$modelBD->bobot_uas=$_POST['KelasKuliah']['bobot_uas'];
			//(6)
			if(($modelBD->bobot_tugas+$modelBD->bobot_quiz+$modelBD->bobot_mid+$modelBD->bobot_uas)=="100")
			{ //(7)
				$modelBD->save();
				//(8)
			}else{ //(9)
				$msg="Jumlah Persentase Bobot Nilai Harus Sama dengan 100%";
				Yii::app()->user->setFlash('flash',$msg);
			} //(10)
			$this->refresh();
			//(11)
		}//(12)
		//end bobot
		$id_kls=$id;
		$model=new Nilai;
		//(13)
		if(isset($_POST['Nilai']['filee']))
		{//(14)
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			$log=1000;
			//(15)
			if($modelKls->log>=$log)
			{ //(16)
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(array('nilaiMhs','id'=>$id));
				//(17)
			}//(18)
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//(19)
			//Membaca file excel
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
			//(20)
			if(($_FILES['Nilai']['type']['filee'])!=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){ //(21)
				$msg = "Format harus Excel 2007";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(Yii::app()->request->baseUrl."/dosen/dosen/nilaiMhs/id/".$id);
				//(22)
			}//(23)
            $objPHPExcel = $objReader->load($_FILES['Nilai']['tmp_name']['filee']); //$file --> your filepath and filename
            
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
		
			//Pilih Kolom dan baris
			$temp='';
			$id=0;
			$tugas=3;
			$quiz=4;
			$mid=5;
			$uas=6;
			//(24)
			if($objWorksheet->getCellByColumnAndRow(0, 1)->getValue()==$id_kls)
			{//(25)
				for ($row = 2; $row <= $highestRow; $row++) 
				{ //(26)
					$tempId=$objWorksheet->getCellByColumnAndRow($id, $row)->getValue();
					$tempTugas=$objWorksheet->getCellByColumnAndRow($tugas, $row)->getValue();
					$tempQuiz=$objWorksheet->getCellByColumnAndRow($quiz, $row)->getValue();
					$tempMid=$objWorksheet->getCellByColumnAndRow($mid, $row)->getValue();
					$tempUas=$objWorksheet->getCellByColumnAndRow($uas, $row)->getValue();
					$model=Nilai::model()->findByPk($tempId);
					//(27)
					if(isset($model))
					{//(28)
						$model->nilai_tugas=$tempTugas;
						$model->nilai_quiz=$tempQuiz;
						$model->nilai_mid=$tempMid;
						$model->nilai_uas=$tempUas;
						$model->save();
						//(29)
					}//(30)
				}
			}else{
				//(31)
				$msg="File yang anda upload salah.";
				Yii::app()->user->setFlash('flash',$msg);
			}//(32)
			//Auto input nilai angka dan huruf
			//Deklarasi Nilai Angka ubah ke Nilai Huruf
			$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id_kls));
			//(33)
			foreach($modelNa as $na)
			{ //(34)
				$modelNilai=Nilai::model()->findByPk($na->id_nilai);
				$modelNilai->nilai_total=@(($modelNilai->nilai_tugas+$modelNilai->nilai_quiz)/2);
				$modelNilai->na=number_format((($modelNilai->nilai_tugas*$bobot_tugas)+($modelNilai->nilai_quiz*$bobot_quiz)+($modelNilai->nilai_mid*$bobot_mid)+($modelNilai->nilai_uas*$bobot_uas)),2);	
				//(35)	
				if($modelNilai->na=="100")
				{//(36)
					$modelNilai->nilai_huruf="A";
					$modelNilai->nilai_indeks="4";
					//(37)
				}else{ //(38)
					$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>($modelNilai->na)));
					foreach($modelBobot as $bobot)
					{ //(39)
						$modelNilai->nilai_huruf=$bobot->nilai_huruf;
						$modelNilai->nilai_indeks=$bobot->nilai_indeks;
						//(40)
					}
				}//(41)
				if(($modelNilai->nilai_huruf=="")){ //(42)
					$this->redirect($modelNilai->nilai_total.'-'.$modelNilai->na.'-'.$modelNilai->nilai_huruf.'-'.$modelNilai->nilai_indeks);
				//(43)
				} //(44)
				$modelNilai->save();	
					//(45)
			}
			//Redirect ke halaman nilai
			$this->redirect('../../nilaiMhs/id/'.$id_kls);
			//(46)
		} //(47)
    }
	
	public function actionImportExcelHuruf($id)
    { 	
		
		$id_kls=$id;
		$model=new Nilai;
		//(1)
		if(isset($_POST['Nilai']['filee']))
		{ //(2)
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			$log=1000;
			//(3)
			if($modelKls->log>=$log)
			{//(4)
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(array('nilaiMhs','id'=>$id));
				//(5)
			}//(6)
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//Membaca file excel
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
			//(7)
			if(($_FILES['Nilai']['type']['filee'])!=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){//(8)
				$msg = "Format harus Excel 2007";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(Yii::app()->request->baseUrl."/dosen/dosen/nilaiMhs/id/".$id);
				//(9)
			}//(10)
            $objPHPExcel = $objReader->load($_FILES['Nilai']['tmp_name']['filee']); //$file --> your filepath and filename
            
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			
			//Pilih Kolom dan baris
			$temp='';
			$id=0;
			$huruf=3;
			//(11)
			for ($row = 2; $row <= $highestRow; $row++) 
			{//(12)
				$tempId=$objWorksheet->getCellByColumnAndRow($id, $row)->getValue();
				$tempHuruf=$objWorksheet->getCellByColumnAndRow($huruf, $row)->getValue();
				$model=Nilai::model()->findByPk($tempId);
				//(13)
				if(isset($model))
				{//(14)
					$modelBobot=BobotNilai::model()->find('nilai_huruf=:nilai_huruf',array(':nilai_huruf'=>($tempHuruf)));
					//(15)
					if(isset($modelBobot))
					{//(16)
						$bobot=$modelBobot->nilai_indeks;
						//(17)
					}else{//(18)
						$bobot="0";
					}//(19)
					
					$model->nilai_huruf=$tempHuruf;
					$model->nilai_indeks=$bobot;
					$model->save();
					//(20)
				}//(21)
			}
			//Auto input nilai angka dan huruf
			// $this->konversiNilaiHuruf($id);
			//Redirect ke halaman nilai
			$this->redirect('../../nilaiMhs/id/'.$id_kls);
			//(22)
		}//(23)
    }
	
	public function actionImportExcelAngka($id)
    { 	
		$id_kls=$id;
		$model=new Nilai;
		//(1)
		if(isset($_POST['Nilai']['filee']))
		{ //(2)
			//Tambah nilai Log
			$log = 1000;
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			//(3)
			if($modelKls->log>$log)
			{//(4)
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(array('nilaiMhs','id'=>$id));
				//(5)
			}//(6)
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			
			//Membaca file excel
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
			//(7)
			if(($_FILES['Nilai']['type']['filee'])!=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){//(8)
				$msg = "Format harus Excel 2007";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(Yii::app()->request->baseUrl."/dosen/dosen/nilaiMhs/id/".$id);
				//(9)
			}//(10)
            $objPHPExcel = $objReader->load($_FILES['Nilai']['tmp_name']['filee']); //$file --> your filepath and filename
            
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			//Pilih Kolom dan baris
			$temp='';
			$id=0;
			$angka=3;
			//(11)
			for ($row = 2; $row <= $highestRow; $row++) 
			{//(12)
				$tempId=$objWorksheet->getCellByColumnAndRow($id, $row)->getValue();
				$tempAngka=$objWorksheet->getCellByColumnAndRow($angka, $row)->getValue();
				$model=Nilai::model()->findByPk($tempId);
				//(13)
				if(isset($model))
				{//(14)
					$model->na=$tempAngka;
					$model->save();
					//(15)
				}//(16)
			}
			//Auto input nilai angka dan huruf
			$this->konversiNilaiHuruf($id_kls);
			//Redirect ke halaman nilai
			$this->redirect('../../nilaiMhs/id/'.$id_kls);
			//(17)
		}//(18)
    }
	
	public function actionAjax(){
    $request=trim($_GET['term']);
    if($request!=''){
        $model=Wilayah::model()->findAll(array("condition"=>"nm_wil like '$request%'"));
        $data=array();
        foreach($model as $get){
            $data[]=$get->nm_wil;
        }
        $this->layout='empty';
        echo json_encode($data);
    }
}

	public function actionLoadImage($id)
    {
        $name_blob    = "blob".$id;
		$val = Yii::app()->cache->get($name_blob);
		if(!$val):
			$model=LargeObject::model()->find('id_blob=:id_blob',array(':id_blob'=>$id));
			$val = $model->blob_content;
			$time  = 1800; // in seconds
			Yii::app()->cache->set($name_blob , $val, $time);
	
		endif;
			
		$this->renderPartial('image', array(
            'model'=>$val
        ));
    }
	
	public function actionBak()
	{
		$model=new Bak;
		$this->render('bak',array(
			'model'=>$model,
		));
	}
	
	public function actionBakChat($id)
	{
		$model=new Bak;
		if($_POST){
			$date = date("Y-m-d H:i:s");
			$id_ptk=Yii::app()->session->get('username');
			$model = new BakChat;
			$model->id_pd = $id;
			$model->id_ptk = $id_ptk;
			$model->pesan = $_POST['pesan'];
			$model->tanggal = $date;
			$model->stat = 2;
			$model->save();
			$this->refresh();
		}
		$this->render('bak_chat',array(
			'model'=>$model,
			'nim'=>$id,
		));
	}
	
	public function actionBakCetak($id)
	{
		$pdf = new fpdf();
		//Session
		$sNama=Yii::app()->session->get('name');
		$id_pd=Yii::app()->session->get('username');
		$smt=Yii::app()->session->get('semester');
		//time
		$time=date('Y-m-d H:i:s');
	
		//Deklarasi
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$header0="Daftar Mahasiswa Bimbingan Akademik ";
		$judul= $header0." ".$sNama." angkatan ".$id;
		
		$model=Dosen::model()->findByPk($id_pd);
		$modelBak=new Bak;
		
		// $c=Yii::app()->db;
		// nilai
		// $sql_nilai="select m.kode_mk,m.nm_mk,m.sks_mk,k.nm_kls,ks.nm_kurikulum_sp,jp.nm_jenj_didik,d.nm_ptk from nilai as n
				// left JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
				// left JOIN matkul as m ON m.id_mk=k.id_mk
				// left join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
				// left JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
				// left JOIN jenjang_pendidikan as jp ON jp.id_jenj_didik=m.id_jenj_didik
				// left JOIN akt_ajar_dosen as akt ON akt.id_kls=k.id_kls
				// left JOIN dosen as d ON  d.id_ptk=akt.id_reg_ptk
			// where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND acc_pa='true' AND m.id_mk!='' order by m.nm_mk";
			
		// $nilai_dao = $c->createCommand($sql_nilai);
		// $nilai_dao->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
		// $nilai_dao->bindParam(":semester", $getSmt, PDO::PARAM_STR);
		// $nilai_dao = $nilai_dao->queryAll();
		//cetak krs harus di acc pa dulu
		
		//Start QRCode
		$no=1;
		$qr_krs='';
		$qr_krs2='';
		//(1)
		foreach($modelBak->dosen($id)->getData() as $db)
		{//(2)
			// $qr_krs.='|'.$no.'|'.$db['kode_mk'].'';
			$qr_krs2.='|'.$no.'|'.$db['id_pd'].' - '.$db['mhs']['nm_pd'].'.<br>';
			$no++;
			//(3)
		}
		//deklarasi
		$qrcode='';
		$qrcode2=
			'<b>Nama</b> : '.$model['nm_ptk'].
			'<br><b>NIP/NIK</b> : '.$id_pd.
			'<br><b>Tahun</b> : '.$id.
			
			'<br><br><br>'.$qr_krs2.
			'<br><br><b>Time</b> : '.$time.
			''
		;
	
		
			//Start Notifikasi
			$modelCekNotif=Notif::model()->find('notif_user=:notif_user AND notif_judul=:notif_judul AND DATE_FORMAT(created_date,"%Y-%m-%d %H:%i")=:tgl',array(':notif_user'=>$id_pd,':notif_judul'=>'Cetak',':tgl'=>date('Y-m-d H:i')));
				//(4)
			if(!isset($modelCekNotif))
			{//(5)
				$modelNotif=new Notif;
				$modelNotif->notif_user=$id_pd;
				$modelNotif->notif_judul="Cetak";
				$modelNotif->notif_body='Anda telah mencetak Daftar Mahasiswa Bimbingan Akademik';
				$modelNotif->notif_hidden=$qrcode2;
				$modelNotif->created_by=$id_pd;
				$modelNotif->created_date=$time;
				//(6)
				if($modelNotif->save())
				{ //(7)
					$qrcode2.=',validation id='.$modelNotif->notif_id;
					$qrcode='https://iraise.uin-suska.ac.id/qrcode/validasi/id/'.$modelNotif->notif_id;
					//(8)
				}//(9)
			}else { //(10)
				$modelNotif=Notif::model()->find('notif_user=:notif_user AND notif_judul=:notif_judul AND DATE_FORMAT(created_date,"%Y-%m-%d %H:%i")=:tgl',array(':notif_user'=>$id_pd,':notif_judul'=>'Cetak',':tgl'=>date('Y-m-d H:i')));
			
			}//(11)
			//End Notifikasi
		//Generate QRcode
		$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
		'data' => $qrcode,
		'filename' => $id_pd.'.png',
		'subfolderVar' => false,
		'matrixPointSize' => 5,
		'displayImage'=>true, // default to true, if set to false display a URL path
		'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
		'matrixPointSize'=>4, // 1 to 10 only
		));
		//(12)
		//END QRCode		
		$this->renderPartial('bak_cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'tahun'=>$id,
			'model'=>$model,
			'modelBak'=>$modelBak,
			'modelNotif'=>$modelNotif,
		));
		//(13)
	}
	// public function statusKrs($id) {
	
		// $sql = 'SELECT count(nilai.id_nilai) FROM nilai 
					// LEFT JOIN kelas_kuliah ON kelas_kuliah.id_kls=nilai.id_kls
						// WHERE nilai.id_reg_pd LIKE :qterm AND kelas_kuliah.id_smt=20151';
	
		// $command = Yii::app()->db->createCommand($sql);
		// $qterm = $id;
		// $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
		// $result = $command->queryAll();
		// if(isset($result)){
			// echo CJSON::encode($result); exit;
		// } else {
			// return false;
		// }
	
	// }
	public function actionAcc()
	{ 
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$modelDosen=Dosen::model()->findByPk($id_pd);
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=new Nilai;
		// if(isset($_POST['Nilai']))
		// {
			//(1)
			if(isset($_POST['id_nilai']))
			{//(2)
							// $this->redirect('a');
				$check=$_POST['id_nilai'];
				//(3)
				if(count($check)>0)
				{//(4)
					foreach($check as $id_nilai)
					{//(5)						
						//acc krs
						$modelAcc=Nilai::model()->findByPk($id_nilai);
						$modelAcc->acc_pa='true';
						//(6)
						if($modelAcc->save())
						{	//(7)									
							//Semester Aktif
							$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
							//Kelas Kuliah
							$modelKelas=KelasKuliah::model()->findByPk($modelAcc->id_kls);
							//Matkul
							$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
							//kuliah mhs
							$modelKuliahMhs=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND id_smt=:id_smt',array(':id_reg_pd'=>$modelAcc->id_reg_pd,':id_smt'=>$modelSmt->id_smt));
							$modelKuliahMhs->sks_smt=$modelKuliahMhs->sks_smt+$modelMatkul->sks_mk;
							$modelKuliahMhs->save();
							
							
							$modelMhs=Mahasiswa::model()->findByPk($modelAcc->id_reg_pd);
							
							$nm_ptk="";
							//(8)
							if(isset($modelDosen))
							{//(9)
								$nm_ptk=$modelDosen->nm_ptk;
								//(10)
							}//(11)
							//Start Notifikasi
							/*
							$modelNotif=new Notif;
							$notif_body='Dosen '.$nm_ptk.' telah menyetujui mata kuliah '.$modelMatkul->nm_mk;
							$modelNotif->notif_user=$modelAcc->id_reg_pd;
							$modelNotif->notif_judul="KRS";
							$modelNotif->notif_body=$notif_body;
							$modelNotif->created_by=$id_pd;
							$modelNotif->created_date=date('Y-m-d H:i:s');
							$modelNotif->save();
							$modelNotif=new Notif;
							$notif_body='Anda telah menyetujui mata kuliah '.$modelMatkul->nm_mk.' mahasiswa '.$modelMhs->nm_pd;
							$modelNotif->notif_user=$id_pd;
							$modelNotif->notif_judul="KRS";
							$modelNotif->notif_body=$notif_body;
							$modelNotif->created_by=$id_pd;
							$modelNotif->created_date=date('Y-m-d H:i:s');
							$modelNotif->save();
							*/
							//End Notifikasi
						}//(12)
					}
					
				}//(13)
			// }
			$this->refresh();
			//(14)
		}//(15)
		$this->render('acc',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
		));
		//(16)
	}
	
	public function actionIndex()
	{
		$id_ptk=Yii::app()->session->get('username');
		
		$mdosen=Dosen::model()->find("id_ptk='".$id_ptk."'");
		
		$criteria=new CDbCriteria;
		$criteria->select = "DATE_FORMAT(datetime,'%Y') as years";
		$criteria->order = "DATE_FORMAT(datetime,'%Y') DESC";
		$criteria->group = "DATE_FORMAT(datetime,'%Y')";
		$criteria->condition = "penerima=:penerima";
		$criteria->params = array (	
		':penerima' => 'dosen',
		);
		$model=Pengumuman::model()->findAll($criteria);
		//SMS
		$sSms=Yii::app()->session->get('sms');
		$this->render('pengumuman',array(
			'model'=>$model,
			'sSms'=>$sSms,
			'mdosen'=>$mdosen,
		));
	}
	
	//Menampilkan syarat mata kuliah
	public function syarat($data,$row)
	{
		$id_reg_pd=$data->id_reg_pd;
		$kata=explode(',',$data->mk['syarat']);
		$text="";
		for($i=0;$i<count($kata);$i++)
		{
			$id=$kata[$i];
			//Cek nilai MK
			$modelKelas=Nilai::model()->findAll('id_reg_pd=:id_reg_pd',array(':id_reg_pd'=>$id_reg_pd));
			foreach($modelKelas as $db)
			{
				if($id==$db->mk['id_mk'])
				{
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id);
					//cek kelulusan MK
					if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
					{
						$warna1='<p style="color:red;">';
						$warna2='</p>';
					}else{
						$warna1='<p style="color:green;">';
						$warna2='</p>';
					}
					if($i==count($kata)-1)
					{
						$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.')'.$warna2;
					}else{
						$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.'), '.$warna2;
					}
				}
			}
		}
		return $text;
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Dosen the loaded model
	 * @throws CHttpException
	 */ 
	public function loadModel($id)
	{
		$model=Dosen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dosen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dosen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	
	public function actionKwnAjax()
	{
		$jurusan=Negara::model()->findAll('id_negara = :id_negara',
			array(':id_negara'=>(int) $_POST['apo'])
		);
		
		// $data= CHtml::listData($jurusan, 'id_negara', 'nm_negara');
		
		// foreach($jurusan as $db)
		// {
			// echo CHtml::tag('option', array(
				// 'value'=>$db->id_negara
			// ), CHtml::encode($db->nm_negara), true);
		// }
		foreach($jurusan as $db){}
		echo $db->nm_negara;
	}
	
	public function tgl($yr)
	{
		if(isset($yr)){
			if($yr!==''){
				$tgl=$yr[0].$yr[1];
				$bln=$yr[3].$yr[4];
				$thn=$yr[6].$yr[7].$yr[8].$yr[9];
				$hasil=$thn.'-'.$bln.'-'.$tgl;
			}else{
				$hasil='';
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
	
	public function bulan($i)
	{
		switch($i)
		{
			case 1:
			$bulan="Januari";
			break;
			
			case 2:
			$bulan="Februari";
			break;
			
			case 3:
			$bulan="Maret";
			break;
			
			case 4:
			$bulan="April";
			break;
			
			case 5:
			$bulan="Mei";
			break;
			
			case 6:
			$bulan="Juni";
			break;
			
			case 7:
			$bulan="Juli";
			break;
			
			case 8:
			$bulan="Agustus";
			break;
			
			case 9:
			$bulan="September";
			break;
			
			case 10:
			$bulan="Oktober";
			break;
			
			case 11:
			$bulan="November";
			break;
			
			case 12:
			$bulan="Desember";
			break;
		}
			return $bulan;
	}
	
	public function statusKrs($nim)
	{
		return $nim;
	}
	
	//Menampilkan Jadwal KRS
	public function jadwalkrs($data)
	{
		//Kurikulum
		$modelKuri=MatkulKurikulum::model()->find('id_mk=:id_mk',array(':id_mk'=>$data->mk['id_mk']));
		if(isset($modelKuri->kurikulumsp['nm_kurikulum_sp']))
		{
			$kurikulum=$modelKuri->kurikulumsp['nm_kurikulum_sp'];
		}else{
			$kurikulum="-";
		}
		$hasil='display:none';
		return $hasil;
	}
}

