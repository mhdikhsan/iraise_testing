<?php

class BobotNilaiController extends Controller
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
		'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
			'actions'=>array('admin'),
			'users'=>array('@'),
			),		
		);
	}

	public function actionAdmin()
	{
		$model=new BobotNilai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BobotNilai']))
		$model->attributes=$_GET['BobotNilai'];

		$this->render('admin',array(
		'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=BobotNilai::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
	if(isset($_POST['ajax']) && $_POST['ajax']==='bobot-nilai-form')
	{
	echo CActiveForm::validate($model);
	Yii::app()->end();
	}
	}
}
