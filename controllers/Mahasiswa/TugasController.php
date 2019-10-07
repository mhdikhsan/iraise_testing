<?php

class TugasController extends Controller
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
'actions'=>array('create','update','matkul','milis','kurikulum'),
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
public function actionCreate($id)
{
$model=new Tugas;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Tugas']))
{
	$model->attributes=$_POST['Tugas'];
	if($model->save())
		$this->redirect(array('milis','id'=>$model->id_kls));
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
	if(isset($_POST['Tugas']))
	{
	$model->attributes=$_POST['Tugas'];
	if($model->save())
	$this->redirect(array('milis','id'=>$model->id_kls));
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
if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex2()
{
$dataProvider=new CActiveDataProvider('Tugas');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Tugas('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Tugas']))
$model->attributes=$_GET['Tugas'];

$this->render('admin',array(
'model'=>$model,
));
}

	
	public function actionIndex()
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=new Nilai;
		$this->render('index',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
		));
	}
	
	public function actionMilis($id)
	{
		//Model Mata Kuliah
		if($_POST){
			$date = date("Y-m-d H:i:s");
			$id_pd=Yii::app()->session->get('username');
			$model = new KelasKuliahChat;
			$model->user_id = $id_pd;
			$model->pesan = $_POST['pesan'];
			$model->id_kls = $id;
			$model->tanggal = $date;
			$model->stat = 1;
			$model->save();
			$this->refresh();
		}else{
			$model=new Tugas;
			$modelNilai=new Nilai;
			$modelSbs=Silabus::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
			$modelKls=KelasKuliah::model()->findByPk($id);
			$this->render('milis',array(
				'model'=>$model,
				'modelNilai'=>$modelNilai,
				'modelSbs'=>$modelSbs,
				'modelKls'=>$modelKls,
			));
		}
	}
	
	public function actionKurikulum()
	{
		$user=Yii::app()->session->get('username');
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		//Model Mata Kuliah
		$model=new Matkul;
		$modelKur=KurikulumSp::model()->findAll('id_sms=:id_sms ORDER BY nm_kurikulum_sp ASC',array(':id_sms'=>$sms));
		$this->render('kurikulum',array(
			'model'=>$model,
			'modelKur'=>$modelKur,
			'user'=>$user,
		));
	}
/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=Tugas::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='tugas-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
