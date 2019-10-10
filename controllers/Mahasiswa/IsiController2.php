<?php

class IsiController extends Controller
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
				'actions'=>array('index','view','syarat','syarat2'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','preview','krs'),
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
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$smt=Yii::app()->session->get('semester');
		$sks_total=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id_pd,':semester'=>$smt));
		$s_sks_total=$sks_total->sks_total;
		//Status Aktif Kuliah
		$status=Yii::app()->session->get('status');
		if($status!="A"){$this->redirect('../mahasiswa/mahasiswa');}
		//Semester aktif
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model="";
		$model=KelasKuliah::model()->findAll('id_sms=:id_sms',array(':id_sms'=>$sms));
		$modelSearch=new KelasKuliah;
		$modelNilai=new Nilai;
		//Proses Input
		if(isset($_POST['KelasKuliah']))
		{
			if(isset($_POST['id_kls']))
			{
				$autoIdAll=$_POST['id_kls'];			
				if(count($autoIdAll)>0)
				{
					$msg="Berhasil dipilih ";
					for($i=1;$i<=count($autoIdAll);$i++)
					{
						$modelNilai=new Nilai;
						$modelNilai->id_kls=$autoIdAll[$i-1];
						//Kelas Kuliah
						$modelKelas=KelasKuliah::model()->findByPk($modelNilai->id_kls);
						//Matkul
						$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
						//cek sks maks
						if(($modelNilai->totalKrsPreview($smt)+$modelMatkul->sks_mk)>$s_sks_total)
						{
							$msg="Gagal SKS Tidak Mencukupi ".$modelNilai->totalKrsPreview($smt).'+'.$modelMatkul->sks_mk.'>'.$s_sks_total;
						}else{
							//save
							$modelNilai->id_reg_pd=$id_pd;
							$modelNilai->semester=$smt;
							$modelNilai->save();
						}
					}
					$msg.=count($autoIdAll)." Mata Kuliah. Klik tombol 'Preview KRS jika sudah selesai.'<br>";
					Yii::app()->user->setFlash('flash',$msg);
					$this->refresh();
				}
			}
		}
		$this->render('krs',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'modelSearch'=>$modelSearch,
			'modelNilai'=>$modelNilai,
		));
	}
	
	public function actionKrs($semester)
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$smt=Yii::app()->session->get('semester');
		$sks_total=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id_pd,':semester'=>$smt));
		$s_sks_total=$sks_total->sks_total;
		//Status Aktif Kuliah
		$status=Yii::app()->session->get('status');
		//(1)
		if($status!="A"){ //(2)
			$this->redirect('../mahasiswa/mahasiswa'); //(3)
			}//(4)
		//Semester aktif
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model="";
		$model=KelasKuliah::model()->findAll('id_sms=:id_sms',array(':id_sms'=>$sms));
		$modelSearch=new KelasKuliah;
		$modelNilai=new Nilai;
		//(5)
		//Proses Input
		
		if(isset($_POST['total']))//(6)
		{
			$msg="Berhasil dipilih ";
			$mk=0;
			 //(7)     
			for($i=1;$i<=$_POST['total'];$i++)//(8)
			{
				$kelas=$_POST['isi'.$i]; //(9)
				if($_POST['id_kls'.$i]=='1'): //(10)
					// $tes.=$_POST['isi'.$i].'-';			
					$modelNilai=new Nilai;
					$modelNilai->id_kls=$kelas;
					//Kelas Kuliah
					$modelKelas=KelasKuliah::model()->findByPk($modelNilai->id_kls);
					//Matkul
					$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
					//(11)
					//cek sks maks
					
					if(($modelNilai->totalKrsPreview($smt)+$modelMatkul->sks_mk)>$s_sks_total)
					{ //(12
						$msg="Maaf Jumlah SKS yang anda ambil melebihi kuota ";//(13)
					}else{ //(14)
						//save
						$modelNilai->id_reg_pd=$id_pd;
						$modelNilai->semester=$smt;
						$modelNilai->save();
					} // (15)
					$mk++; 
				endif; //(16)
			}
			//(17)	
			$msg.=$mk." Mata Kuliah. Klik tombol 'Preview KRS jika sudah selesai.'<br>";
			Yii::app()->user->setFlash('flash',$msg);
			$this->refresh();
			// $this->redirect('tes'.($tes));
		}
		// if(isset($_POST['KelasKuliah']))
		// {
			// if(isset($_POST['KelasKuliah']['id_kls']))
			// {
				// $modelSearch->attributes=$_POST['KelasKuliah'];
				// $autoIdAll=$_POST['KelasKuliah']['id_kls'];			
				// if(count($autoIdAll)>0)
				// {
					// $msg="Berhasil dipilih ";
					// for($i=1;$i<=count($autoIdAll);$i++)
					// {
						// $modelNilai=new Nilai;
						// $modelNilai->id_kls=$autoIdAll[$i-1];
						// Kelas Kuliah
						// $modelKelas=KelasKuliah::model()->findByPk($modelNilai->id_kls);
						// Matkul
						// $modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
						// cek sks maks
						// if(($modelNilai->totalKrsPreview($smt)+$modelMatkul->sks_mk)>$s_sks_total)
						// {
							// $msg="Maaf Jumlah SKS yang anda ambil melebihi kuota ";
						// }else{
							// save
							// $modelNilai->id_reg_pd=$id_pd;
							// $modelNilai->semester=$smt;
							// $modelNilai->save();
						// }
					// }
					// $msg.=count($autoIdAll)." Mata Kuliah. Klik tombol 'Preview KRS jika sudah selesai.'<br>";
					// Yii::app()->user->setFlash('flash',$msg);
					// $this->refresh();
				// }
			// }
		// }
		
		//(13)
		$this->render('krs',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'modelSearch'=>$modelSearch,
			'modelNilai'=>$modelNilai,
			'semester'=>$semester,
		));
	}
	
	
	public function actionPreview()
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=new Nilai;
		$this->render('preview',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
		));
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
	public function syarat($data)
	{
		$id_reg_pd=Yii::app()->session->get('username');
		$kata=explode(',',$data->mk['syarat']);
		$text="";
		//(1)
		if($kata[0]!="")
		{//(2)
			
			
			for($i=0;$i<count($kata);$i++)
			{
				//(3)
				$id=$kata[$i];
				//mata kuliah
				$modelCek=Matkul::model()->findByPk($id);
				//(4)
				if(empty($modelCek->nm_mk))
				{ //(5)
					break;//(6)
				} //(7)
				$belum=false;
				//(8)
				//Cek nilai MK
				$criteria=new CDbCriteria;			
				$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
				$criteria->condition = "t.id_reg_pd = :id_reg_pd AND  t.id_kls=k.id_kls AND k.id_mk=m.id_mk AND m.id_mk=:id_mk";
				$criteria->params = array (	
					':id_reg_pd' => $id_reg_pd,
					':id_mk' => $id,
				);
				$modelKelas=Nilai::model()->findAll($criteria);
				//(9)
				if((!empty($modelKelas))&&($id!=""))
				{//(10)
					foreach($modelKelas as $db)
					{//(11)
						//Ambil nama MK dan Nilai
						$model=Matkul::model()->findByPk($id);
						//cek kelulusan MK
						//(12)
						if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
						{ //(13)
							$warna1='<p style="color:red;">';
							$warna2='</p>';
							//(14)
						}else{ //(15)
							$warna1='<p style="color:green;">';
							$warna2='</p>';
							
						} //(16)
						if($i==count($kata)-1)
						{
							$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.')'.$warna2;
						}else{
							$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.'), '.$warna2;
						}
					}
				}else{
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id);
					$text.='<p>'.$model['nm_mk'].'</p>';
				}
			}
		}
		return $text;
	}
	//Menampilkan syarat mata kuliah
	public function syarat2($data)
	{
		$id_reg_pd=Yii::app()->session->get('username');
		$kata=explode(',',$data->mk['syarat']);
		$text="";
		$status=true;
		//(1)
		if($kata[0]!="") 
		{//(2)
			for($i=0;$i<count($kata);$i++)
			{ //(3)
				$id=$kata[$i];
				//mata kuliah
				$modelCek=Matkul::model()->findByPk($id);
				//(4)
				if(empty($modelCek->nm_mk))
				{//(5)
					break; //(6)
				}//(7)
				
				$status=false;
				//Cek nilai MK
				$criteria=new CDbCriteria;			
				$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
				$criteria->condition = "t.id_reg_pd = :id_reg_pd AND  t.id_kls=k.id_kls AND k.id_mk=m.id_mk AND m.id_mk=:id_mk";
				$criteria->params = array (	
					':id_reg_pd' => $id_reg_pd,
					':id_mk' => $id,
				);
				$modelKelas=Nilai::model()->findAll($criteria);
				//(8)
				if((isset($modelKelas))&&($id!=""))
				{ //(9)
					foreach($modelKelas as $db)
					{ //(10)
						//Ambil nama MK dan Nilai
						$model=Matkul::model()->findByPk($id);
						//cek kelulusan MK
						//(11)
						if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
						{ //(12)
							$warna1='<p style="color:red;">';
							$warna2='</p>';
							$status=false;
							break;
							//(13)
						}else{
							$warna1='<p style="color:green;">';
							$warna2='</p>';
							$status=true;
							//(14)
						}//(15)
						
						if($i==count($kata)-1)
						{ //(16)
							
						$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.')'.$warna2;
						//(17)
						}else{ //(18)
							$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.'), '.$warna2;
						} //(19)
					}//(10)
				}else{ //(20)
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id);
					$text.='<p>'.$model['nm_mk'].'</p>';
					$status=false;
					break;
				} //(21)
			}
		}else{ //(22)
			$status=true;
		} //(23)
		if($status==true){ //(24)
			$status2=""; //(25)
			}else{
				$status2="hidden"; //(26)
				} //(27)
		return $status; //(28)
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
