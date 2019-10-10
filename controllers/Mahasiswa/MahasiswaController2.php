<?php

class MahasiswaController extends Controller
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
				'actions'=>array('index','view','create','ajax','loadImage','kwnAjax','feb'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','feb','pengumuman','ajukanCuti'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','feb'),
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
		$model=new Mahasiswa;
		$modelObj=new LargeObject;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mahasiswa']))
		{
			//cek form or step
			if(isset($_POST['Mahasiswa'] ['nm_wali']))
			{

				$model->attributes=$_POST['Mahasiswa'];
				//tanggal
				$tgl0=$_POST['Mahasiswa']['tgl0'];
				$tgl1=$_POST['Mahasiswa']['tgl1'];
				$tgl2=$_POST['Mahasiswa']['tgl2'];
				$tgl3=$_POST['Mahasiswa']['tgl3'];
				$bln0=$_POST['Mahasiswa']['bln0'];
				$bln1=$_POST['Mahasiswa']['bln1'];
				$bln2=$_POST['Mahasiswa']['bln2'];
				$bln3=$_POST['Mahasiswa']['bln3'];
				if( $tgl0 < 10)
				{
					$tgl0 = '0'.$tgl0;
				}
				if( $tgl1 < 10)
				{
					$tgl1 = '0'.$tgl1;
				}
				if( $tgl2 < 10)
				{
					$tgl2 = '0'.$tgl2;
				}
				if( $tgl3 < 10)
				{
					$tgl3 = '0'.$tgl3;
				}
				if( $bln0 < 10)
				{
					$bln0 = '0'.$bln0;
				}
				if( $bln1 < 10)
				{
					$bln1 = '0'.$bln1;
				}
				if( $bln2 < 10)
				{
					$bln2 = '0'.$bln2;
				}
				if( $bln3 < 10)
				{
					$bln3 = '0'.$bln3;
				}
				$model->tgl_lahir=$_POST['Mahasiswa']['thn0'].'-'.$bln0.'-'.$tgl0;
				$model->tgl_lahir_ayah=$_POST['Mahasiswa']['thn1'].'-'.$bln1.'-'.$tgl1;
				$model->tgl_lahir_ibu=$_POST['Mahasiswa']['thn2'].'-'.$bln2.'-'.$tgl2;
				$model->tgl_lahir_wali=$_POST['Mahasiswa']['thn3'].'-'.$bln3.'-'.$tgl3;
				//hilangkan value jika null atau 0 pada tanggal
				if(($tgl0<1)||($bln0<1)||($_POST['Mahasiswa']['thn0']=="")){$model->tgl_lahir=null;}
				if(($tgl1<1)||($bln1<1)||($_POST['Mahasiswa']['thn1']=="")){$model->tgl_lahir_ayah=null;}
				if(($tgl2<1)||($bln2<1)||($_POST['Mahasiswa']['thn2']=="")){$model->tgl_lahir_ibu=null;}
				if(($tgl3<1)||($bln3<1)||($_POST['Mahasiswa']['thn3']=="")){$model->tgl_lahir_wali=null;}
				// $this->redirect($model->tgl_lahir);
				// $model->tgl_lahir=$this->tgl($model->tgl_lahir);
				
				// $model->tgl_lahir_ayah=$this->tgl($model->tgl_lahir_ayah);
				// $model->tgl_lahir_ibu=$this->tgl($model->tgl_lahir_ibu);
				// $model->tgl_lahir_wali=$this->tgl($model->tgl_lahir_wali);
					if(empty($_FILES['LargeObject']['tmp_name']['blob_content']))
					{
						$model->id_agama=null;
					}
				if($model->save())
				{
					//convert image to blob
					$modelBlob=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$model->id_pd));
					foreach($modelBlob as $bl){
						$modelBlob=LargeObject::model()->findByPk($model->id_pd)->delete();
					}

					if(!empty($_FILES['LargeObject']['tmp_name']['blob_content']))
					{
						$modelObj->attributes=$_POST['LargeObject'];
						$model->attributes=$_POST['Mahasiswa'];
						$file = CUploadedFile::getInstance($modelObj,'blob_content');
						// $modelObj->fileName = $file->name;
						// $modelObj->fileType = $file->type;
						$fp = fopen($file->tempName, 'r');
						$content = fread($fp, filesize($file->tempName));
						fclose($fp);
						$modelObj->id_blob = $model->id_pd;
						$modelObj->blob_content = file_get_contents($file->tempName);
						if($modelObj->save())
						{

						}
						
					}else{
						$model->id_agama=null;
					}
						$this->render('step5',array(
						'model'=>$model,
						));
				}else{
					$this->render('create',array(
						'model'=>$model,
						'modelObj'=>$modelObj,
					));				
				}
				
			}
			
		}else{
		$this->render('create',array(
			'model'=>$model,
			'modelObj'=>$modelObj,
		));
		}
	}
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		//Session id_pd
		$sId_pd=Yii::app()->session->get('username');
		$id=$sId_pd;
		$model=$this->loadModel($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mahasiswa']))
		{
			$model->attributes=$_POST['Mahasiswa'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id_pd));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
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
	public function actionIndex2()
	{
		$dataProvider=new CActiveDataProvider('Mahasiswa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
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
	
	public function actionFeb()
	{
		$model=new Mahasiswa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mahasiswa']))
			$model->attributes=$_GET['Mahasiswa'];

		$this->render('feb',array(
			'model'=>$model,
		));
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
        $model=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id));
        $this->renderPartial('image', array(
            'model'=>$model
        ));
    }
	
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		$criteria->select = "DATE_FORMAT(datetime,'%Y') as years";
		$criteria->order = "DATE_FORMAT(datetime,'%Y') DESC";
		$criteria->group = "DATE_FORMAT(datetime,'%Y')";
		$criteria->condition = "penerima=:penerima";
		$criteria->params = array (	
		':penerima' => 'mahasiswa',
		);
		$model=Pengumuman::model()->findAll($criteria);
		//SMS
		$sSms=Yii::app()->session->get('sms');
		$this->render('pengumuman',array(
			'model'=>$model,
			'sSms'=>$sSms,
		));
	}
	
	public function actionAjukanCuti()
	{
		//Session id_pd
		$sId_pd=Yii::app()->session->get('username');		
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//Mengambil Next Semester
		$modelKuliah=KuliahMhs::model()->find('id_smt=:id_smt',array(':id_smt'=>$modelSmt->id_smt));
		//Mengambil Next Id Semester
		$modelSmt=Semester::model()->find('tgl_mulai > :tgl_mulai',array(':tgl_mulai'=>$modelSmt->tgl_selesai));
		//Cek Pengajuan Cuti Supaya tidak double
		$modelKuliahCek=KuliahMhs::model()->find('id_smt=:id_smt',array(':id_smt'=>$modelSmt->id_smt));
		if(isset($modelKuliahCek->id_smt))
		{
			echo 
			'
				<script>
					history.back();
				</script>
			';
			$this->redirect($modelSmt->id_smt);
		}
		//Deklarasi model
		$model=new KuliahMhs;
		//Inisialisasi value field
		$model->id_smt=$modelSmt->id_smt;
		$model->id_reg_pd=$sId_pd;
		$model->id_stat_mhs="C";
		$model->semester=$modelKuliah->semester+1;
		$model->save();
		echo 
		'
			<script>
				history.back();
			</script>
		';
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mahasiswa the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mahasiswa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mahasiswa $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mahasiswa-form')
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
}
