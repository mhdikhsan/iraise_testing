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
'actions'=>array('index','view','admin'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update','profil','transkip','khs','pengajuancuti','setuju','batal'),
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


	public function actionPengajuancuti()
	{
		$model=new PengajuanCuti('searchbak');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PengajuanCuti']))
		$model->attributes=$_GET['PengajuanCuti'];

		$this->render('pengajuancuti',array(
		'model'=>$model,
		));
	}	

	public function actionSetuju($id)
	{
		$id_ptk=Yii::app()->session->get('username');
		$model=PengajuanCuti::model()->findByPk($id);
		
		$bak=Bak::model()->find(array('condition'=>"id_ptk='".$id_ptk."' and id_pd='".$model->id_pd."'"));
		if (isset($bak->id_pd)) {
			
			$model->verifikasi_pa="1";
			$model->save();
		}
		$this->redirect('/dosen/mahasiswa/pengajuancuti');
		
	}
	
	public function actionBatal($id)
	{
		$id_ptk=Yii::app()->session->get('username');
		
		$model=PengajuanCuti::model()->findByPk($id);
		$bak=Bak::model()->find(array('condition'=>"id_ptk='".$id_ptk."' and id_pd='".$model->id_pd."'"));
		if (isset($bak->id_pd)) {
			$model->verifikasi_pa='0';
			$model->save();
		}
		$this->redirect('/dosen/mahasiswa/pengajuancuti');
		
	}
	
	
/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
/*
public function actionCreate()
{		
		$model=new Mahasiswa;
		$modelObj=new LargeObject;
		$modeluser=new User;
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mahasiswa']))
		{
			//cek form or step
			if(isset($_POST['Mahasiswa'] ['nm_wali']))
			{

				$model->attributes=$_POST['Mahasiswa'];
				$modeluser->username=$model->id_pd;
				$modeluser->password=$model->id_pd;
				$modeluser->level='mahasiswa';
				
					if(empty($_FILES['LargeObject']['tmp_name']['blob_content']))
					{
						$model->id_agama=null;
					}
				//$modeluser->save();	
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
	


public function actionUpdate($id)
{
		$model =Mahasiswa::model()->findByPk($id);
		$modelObj=new LargeObject;
		

		if(isset($_POST['Mahasiswa']))
		{
			//cek form or step
			if(isset($_POST['Mahasiswa'] ['nm_wali']))
			{

				$model->attributes=$_POST['Mahasiswa'];
				$modeluser->username=$model->id_pd;
				$modeluser->password=$model->id_pd;
				$modeluser->level='mahasiswa';
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
				$modeluser->save();	
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
					$this->render('update',array(
						'model'=>$model,
						'modelObj'=>$modelObj,
					));				
				}
				
			}
			
		}else{
		$this->render('update',array(
			'model'=>$model,
			'modelObj'=>$modelObj,
		));
		}
}
*/
public function actionProfil($id)
{
		$model =Mahasiswa::model()->findByPk($id);
		$modelObj=new LargeObject;
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		if(!isset($modelSms->nm_lemb))
		{
			// $modelSms->nm_lemb="-";
		}
		
		$this->render('profil',array(
			'model'=>$model,
			'modelObj'=>$modelObj,
			'modelSms'=>$modelSms,
			'sms'=>$sms,
		));
}

public function actionTranskip($id)
{
	$model =new Nilai;
	$this->render('transkip',array(
		'model'=>$model
	));
}
public function actionKhs($id)
{
	
	$this->render('khs');
}



/**
* Lists all models.
*/
/*
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('Mahasiswa');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

*/

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
	}
