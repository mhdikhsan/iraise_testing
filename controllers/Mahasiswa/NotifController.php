<?php
class NotifController extends Controller
{
	public function actionIndex()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		
		//render
		$this->render('index',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
		));
	}

}