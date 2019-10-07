<?php

class JadwalController extends Controller
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
'actions'=>array('create','update','admin','report'),
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
$model=new Jadwal;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Jadwal']))
{
$model->attributes=$_POST['Jadwal'];
if($model->save())
$this->redirect(array('view','id'=>$model->id_jadwal));
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

if(isset($_POST['Jadwal']))
{
$model->attributes=$_POST['Jadwal'];
if($model->save())
$this->redirect(array('view','id'=>$model->id_jadwal));
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
public function actionIndex()
{
$model=new Jadwal;
$this->render('index',array(
	'model'=>$model,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Jadwal('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Jadwal']))
$model->attributes=$_GET['Jadwal'];

$this->render('admin',array(
'model'=>$model,
));
}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=Jadwal::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='jadwal-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
	public function actionReport() {
			
				$sess_sms=Yii::app()->session->get('sms');
				$sess_id_pd=Yii::app()->session->get('username');
				
				$fileName = "Jadwal-".$sess_sms;
				header("Content-type: application/vnd.ms-excel; charset=utf-8");
				header("Content-Disposition: attachment; filename=$fileName.xls");
				$modelSmtAktif=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
				$c=Yii::app()->db;
				$sql="
							SELECT (select count(id_nilai) FROM nilai where id_kls=t.id_kls) as kuota,mk.semester,mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,mk.syarat,mk.syarat2,t.id_kls,t.nm_kls,dosen.nm_ptk,ksp.nm_kurikulum_sp as kurikulum, h.hari, j.jam_mulai, j.jam_selesai,r.kode_ruangan
							FROM kelas_kuliah as t
							LEFT JOIN akt_ajar_dosen as ajar ON ajar.id_kls=t.id_kls
							LEFT JOIN dosen as dosen ON dosen.id_ptk=ajar.id_reg_ptk
							LEFT JOIN matkul as mk ON mk.id_mk=t.id_mk
							LEFT JOIN matkul_kurikulum as mkk ON mkk.id_mk=t.id_mk
							LEFT JOIN kurikulum_sp as ksp ON ksp.id_kurikulum_sp=mkk.id_kurikulum_sp
							LEFT JOIN jadwal as j ON j.id_kls=t.id_kls
							LEFT JOIN hari as h ON h.id=j.hari
							LEFT JOIN ruangan as r ON r.id_ruangan=j.id_ruangan
							WHERE t.id_sms ='".$sess_sms."' AND t.id_smt='".$modelSmtAktif->id_smt."'
							ORDER BY mk.nm_mk,t.nm_kls
						";
						$modelKelas=$c->createCommand($sql);
						$modelKelas=$modelKelas->queryAll();
				
				$dataExcel = $this -> renderPartial("report_jadwal", array(
					"jadwal" => $modelKelas, 
					)
				);

				echo $dataExcel;
				
	}
}
