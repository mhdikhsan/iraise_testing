<?php

class MatkulController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','syarat'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','preview','preview2','hapus'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**

	* Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Matkul;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Matkul']))
		{
			$model->attributes=$_POST['Matkul'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_mk));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Matkul']))
		{
			$model->attributes=$_POST['Matkul'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_mk));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//Start Redirect
		$genap=false;
		$ganjil=false;
		//Semester Aktif
		$modelSmt=Semester::model()->findAll('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//(1)
		foreach($modelSmt as $db){ //(2)
			
		}//(3)
		
		if(($db->smt)%2==0) //(4)
		{	
			$this->redirect(array('isi/krs/semester/2'));
			$genap=true;
			//(5)
		}else{
			//(6)
			$this->redirect(array('isi/krs/semester/1'));
			$ganjil=true;
		} //(7)
		//End Redirect
		/*
		*
		*
		*/
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$smt=Yii::app()->session->get('semester');
		$sks_total=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id_pd,':semester'=>$smt));
		$s_sks_total=$sks_total->sks_total;
		//Status Aktif Kuliah
		$status=Yii::app()->session->get('status');
		//(8)
		if($status!="A"){ //(9)
			$this->redirect('../mahasiswa/mahasiswa');
			//(10)
			} //(11)
		//Semester aktif
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=""; 
		$model=KelasKuliah::model()->findAll('id_sms=:id_sms',array(':id_sms'=>$sms));
		$modelSearch=new KelasKuliah;
		$modelNilai=new Nilai;
		//(12)
		//Proses Input
		if(isset($_POST['KelasKuliah']))
		{ //(13)
			if(isset($_POST['id_kls']))
			{ //(14)
				$autoIdAll=$_POST['id_kls'];	
					//(15)
				if(count($autoIdAll)>0)
				{ //(16)
					$msg="Berhasil dipilih ";
					//(17)
					for($i=1;$i<=count($autoIdAll);$i++)
					{ //(18)
						$modelNilai=new Nilai;
						$modelNilai->id_kls=$autoIdAll[$i-1];
						//Kelas Kuliah
						$modelKelas=KelasKuliah::model()->findByPk($modelNilai->id_kls);
						//Matkul
						$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
						//cek sks maks
						//(19)
						if(($modelNilai->totalKrsPreview($smt)+$modelMatkul->sks_mk)>$s_sks_total)
						{ //(20)
							$msg="Gagal SKS Tidak Mencukupi ".$modelNilai->totalKrsPreview($smt).'+'.$modelMatkul->sks_mk.'>'.$s_sks_total; //(21)
						}else{
							//(22)
							//save
							$modelNilai->id_reg_pd=$id_pd;
							$modelNilai->semester=$smt;
							$modelNilai->save();
						} //(23)
					} 
					
					$msg.=count($autoIdAll)." Mata Kuliah. Klik tombol 'Preview KRS jika sudah selesai.";
					Yii::app()->user->setFlash('flash',$msg);
					$this->refresh();
					//(24)
				}//(25)
			}//(26)
		}//(27)
		$this->render('krs',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'modelSearch'=>$modelSearch,
			'modelNilai'=>$modelNilai,
			//(28)
		));
	}
	
	
	public function actionPreview()
	{
		
		$this->render('preview');
	}
	public function actionPreview2()
	{
		
		$this->render('preview2');
	}
	public function actionHapus($id)
	{
			$sessUser=Yii::app()->session->get('username');
			$model=Nilai::model()->findByPk($id);
			//(1)
			// BOLEH DIHAPUS JIKA BELUM DI ACC DAN HANYA PUNYA MAHASISWA YANG BERSANGKUTAN
			if ($model['acc_pa']!='true' and $model['id_reg_pd']==$sessUser)  { //(2)
				if(isset($model) ) 
				{ //(3)
					// JIKA DIHAPUS MASUK LOG
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
					$model->delete();
					//(4)
				}//(5)
				$this->redirect(array('preview')); //(6)
			}else { //
				//(7)
				$this->redirect(array('preview'));
			} //(8)
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Matkul('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Matkul']))
			$model->attributes=$_GET['Matkul'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	//Menampilkan syarat mata kuliah
	public function syarat($data,$row)
	{
		$id_reg_pd=Yii::app()->session->get('username');
		$kata=explode(',',$data->mk['syarat']);
		$text="";
		for($i=0;$i<count($kata);$i++)
		{
			$id=$kata[$i];
			$belum=false;
			//Cek nilai MK
			$modelKelas=Nilai::model()->findAll('id_reg_pd=:id_reg_pd',array(':id_reg_pd'=>$id_reg_pd));
			if(isset($modelKelas))
			{
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
						$belum=false;
						break;
					}else{
						$belum=true;
					}
				}
			}
			//cek mk yg blm diambil
			if($belum==true){
				//Ambil nama MK dan Nilai
				$model=Matkul::model()->findByPk($id);
				$text.='<p>'.$model['nm_mk'].'</p>';
			}
		}
		return $text;
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
