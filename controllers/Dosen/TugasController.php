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
'actions'=>array('create','update','matkul','milis','milisc','milisu','milisd'),
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
		//Model Mata Kuliah
		$model=new AktAjarDosen;
		$this->render('matkul',array(
			'model'=>$model,
			
		));
	}
	
	public function actionMilis($id)
	{
		//Model Mata Kuliah
		$modelKls=KelasKuliah::model()->findByPk($id);
		if($_POST){
			if(isset($_POST['KelasKuliah']))
			{
				$modelKls->sbs_deskripsi=$_POST['KelasKuliah']['sbs_deskripsi'];
				$modelKls->sbs_tujuan=$_POST['KelasKuliah']['sbs_tujuan'];
				$modelKls->save();
			}else{
				$date = date("Y-m-d H:i:s");
				$id_ptk=Yii::app()->session->get('username');
				$model = new KelasKuliahChat;
				$model->user_id = $id_ptk;
				$model->pesan = $_POST['pesan'];
				$model->id_kls = $id;
				$model->tanggal = $date;
				$model->stat = 2;
				$model->save();
			}
			$this->refresh();
		}else{
			$model=new Tugas;
			$modelNilai=new Nilai;
			$modelSbs=Silabus::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
			$this->render('milis',array(
				'model'=>$model,
				'modelNilai'=>$modelNilai,
				'modelSbs'=>$modelSbs,
				'modelKls'=>$modelKls,
			));
		}
	}
	public function actionMilisc($id)
	{	
		$model=new Silabus;
		if(isset($_POST['Silabus']))
		{
			$model->id_kls=$id;
			$model->tujuan=$_POST['Silabus']['tujuan'];
			$model->pokok=$_POST['Silabus']['pokok'];
			$model->sub_pokok=$_POST['Silabus']['sub_pokok'];
			$model->metode=$_POST['Silabus']['metode'];
			$model->alat=$_POST['Silabus']['alat'];
			$model->waktu=$_POST['Silabus']['waktu'];
			$model->referensi=$_POST['Silabus']['referensi'];
			$model->save();
			$this->redirect(array('milis','id'=>$id));
		}
		$this->render('milis_create',array(
			'model'=>$model,
		));
	}
	public function actionMilisu($idkls,$id)
	{	
		$model=Silabus::model()->findByPk($id);
		if(isset($_POST['Silabus']))
		{
			$model->tujuan=$_POST['Silabus']['tujuan'];
			$model->pokok=$_POST['Silabus']['pokok'];
			$model->sub_pokok=$_POST['Silabus']['sub_pokok'];
			$model->metode=$_POST['Silabus']['metode'];
			$model->alat=$_POST['Silabus']['alat'];
			$model->waktu=$_POST['Silabus']['waktu'];
			$model->referensi=$_POST['Silabus']['referensi'];
			$model->save();
			$this->redirect(array('milis','id'=>$idkls));
		}
		$this->render('milis_update',array(
			'model'=>$model,
		));
	}
	public function actionMilisd($idkls,$id)
	{
		$model=Silabus::model()->findByPk($id);
		$model->delete();
		$this->redirect(array('milis','id'=>$idkls));
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
