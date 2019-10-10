<?php

class WisudaController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		/*
		* END
		* Input IPK
		*
		*/

		if(isset($_POST['skl'])){$this->redirect(array('skl'));}
		if(isset($_POST['univ'])){$this->redirect(array('univ'));}
		if(isset($_POST['Mahasiswa']))
		{
			$model->attributes=$_POST['Mahasiswa'];
			$model->id_pd = $id;
			$model->tgl_lahir = $_POST['Mahasiswa']['tgl_lahir'];
			$email= $_POST['Mahasiswa']['email'];
			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$model->email=$email;	
			}else{
				$model->email=null;
			}
			if($model->save()):
				//$this->redirect(array('update','id'=>$model->id_pd));
				$data = "Profil Sukses Di Update";
				Yii::app()->user->setFlash('forgot',$data);
			endif;
			
			//print_r($_POST);
		}
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		if(!isset($modelWisuda))
		{
			$modelWisuda=new Wisuda;
		}
		$this->render('index',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'modelWisuda'=>$modelWisuda,
		));
	}
	
	public function actionSkl()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk, semester";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		$smt=KuliahMhs::model()->find($criteria)->semester;
		/*
		* END
		* Input IPK
		*
		*/
		
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		if(!isset($modelWisuda))
		{
			$modelWisuda=new Wisuda;
		}
		if(isset($_POST['wis_judul']))
		{
			if($modelWisuda->skl_status=='0')
			{
				$modelWisuda->id_pd=$id;
				$modelWisuda->nm_pd=$model->nm_pd;
				$modelWisuda->wis_jurusan=$_POST['wis_jurusan'];
				$modelWisuda->wis_smt=$_POST['wis_smt'];
				$modelWisuda->wis_judul=$_POST['wis_judul'];
				$modelWisuda->wis_tgl_lulus=$_POST['wis_tgl_lulus'];
				$modelWisuda->wis_ipk=$ipk;
				$modelWisuda->skl_status='1';
				$modelWisuda->skl_tgl_daftar=date('Y-m-d H:i:s');
				if($modelWisuda->save()):
					$data = "Profil Sukses Di Update";
					Yii::app()->user->setFlash('forgot',$data);
				endif;
			}
			$this->redirect(array('index'));
			
			//print_r($_POST);
		}

		$this->render('skl',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'smt'=>$smt,
			'modelWisuda'=>$modelWisuda,
		));
	}
	
	public function actionUniv()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		/*
		* Start
		* Input IPK
		*
		*/							
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//criteria
		$criteria=new CDbCriteria;
		$criteria->select="ipk";
		$criteria->condition = "id_reg_pd=:id_reg_pd AND id_smt=:id_smt";
		$criteria->params = array (	
			':id_reg_pd' => $id,
			':id_smt' => $modelSmt->id_smt,
		);
		$ipk=KuliahMhs::model()->find($criteria)->ipk;
		/*
		* END
		* Input IPK
		*
		*/
		
		//Wisuda
		$modelWisuda=Wisuda::model()->find('id_pd=:id_pd',array(':id_pd'=>$id));
		if(!isset($modelWisuda))
		{
			$modelWisuda=new Wisuda;
		}
		if(isset($_POST['id_pd']))
		{
			$modelWisuda->id_pd=$id;
			$modelWisuda->nm_pd=$model->nm_pd;
			$modelWisuda->wis_ipk=$ipk;
			$modelWisuda->lib_univ_status='1';
			$modelWisuda->lib_univ_tgl_daftar=date('Y-m-d H:i:s');
			if($modelWisuda->save()):
				$this->redirect(array('index'));
				$data = "Profil Sukses Di Update";
				Yii::app()->user->setFlash('forgot',$data);
			endif;
			
			//print_r($_POST);
		}

		$this->render('univ',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'ipk'=>$ipk,
			'modelWisuda'=>$modelWisuda,
		));
	}
}
