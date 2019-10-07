<?php

class LaporController extends Controller
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
'actions'=>array('index','view','indexnew2'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update'),
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
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/

	public function actionIndex()
	{
		$aksi = '';
		$usr='';
		$loadhistory=[];
		
		$id_pd=Yii::app()->session->get('username');
		$model=C3Data::model()->find("username=:username and status='0'",array(":username"=>$id_pd));
		$modelall=C3Data::model()->findAll("username=:username and status='1'",array(":username"=>$id_pd));
		if (isset($model->id_c3_pd)){
			$loadhistory = C3History::model()->findAll('id_c3data =:id_c3data',array("id_c3data"=>$model->id_c3_pd));
			
		}else{
			$model=new C3Data();
			$aksi ='New';
			
		}
		//Model Mata Kuliah
		if($_POST){
			$date = date("Y-m-d H:i:s");
			if ($aksi=='New') {
			
			
			$model->jns_user = '1';
			$model->username = $id_pd;
			
			$model->jns_mslh= '3';
			$model->masalah = $_POST['masalah'];
			$model->status ='0';
			$model->validasi ='0';
			$model->tanggal = $date;
			$model->user_id='c3';
			$model->save();
			$this->redirect('lapor');
			}else{
				
				foreach ($loadhistory as $dt) {
					$usr = $dt['username'];
				}
				
				if ($usr==$id_pd) {
					$msg= "Laporan Anda Sedang Dalam Proses, Penambahan Komentar dapat dilakukan Jika sudah ada balasan dari Admin";
					Yii::app()->user->setFlash('flash',$msg);					
				}else
				{
					$modelhistory = new C3History();
					$modelhistory->id_c3data = $model->id_c3_pd;
					$modelhistory->username = $id_pd;
					$modelhistory->tgl = $date;
					$modelhistory->uraian=  $_POST['masalah'];
					$modelhistory->save();
				}
				
				$loadhistory = C3History::model()->findAll('id_c3data =:id_c3data',array("id_c3data"=>$model->id_c3_pd));
			}
			
			$this->render('index',array(
				'model'=>$model,
				'loadhistory'=>$loadhistory,
				'modelall'=>$modelall,
			));
			
		}else{
			$this->render('index',array(
				'model'=>$model,
				'loadhistory'=>$loadhistory,
				'modelall'=>$modelall,
			));
		}
	}

	public function actionIndexnew2()
	{
		$aksi = '';
		$usr='';
		$loadhistory=[];
		
		$id_pd=Yii::app()->session->get('username');
		$model=C3Data::model()->find("username=:username and status='0'",array(":username"=>$id_pd));
		$modelall=C3Data::model()->findAll("username=:username and status='1'",array(":username"=>$id_pd));
		//(1)
		if (isset($model->id_c3_pd)){ //(2)
			$loadhistory = C3History::model()->findAll('id_c3data =:id_c3data',array("id_c3data"=>$model->id_c3_pd));//(3)
			
		}else{
			//(4)
			$model=new C3Data();
			$aksi ='New';
			
		}//(5)	
		//Model Mata Kuliah
		if($_POST){//(6)
			$date = date("Y-m-d H:i:s");//(7)
			if ($aksi=='New') { //(8)
			
			
			$model->jns_user = '1';
			$model->username = $id_pd;
			
			$model->jns_mslh= '3';
			$model->masalah = $_POST['masalah'];
			$model->status ='0';
			$model->validasi ='0';
			$model->tanggal = $date;
			$model->user_id='c3';
			$model->save();
			$this->redirect('lapor');
			//(9)
			}else{
				
				
				
				foreach ($loadhistory as $dt) { //(10)
					$usr = $dt['username'];//(11)
				}//(12)
				
				if ($usr==$id_pd) { //(13)
					$msg= "Laporan Anda Sedang Dalam Proses, Penambahan Komentar dapat dilakukan Jika sudah ada balasan dari Admin";
					Yii::app()->user->setFlash('flash',$msg);	
						//(14)
				}else
				{ 
				//(15)
					$modelhistory = new C3History();
					$modelhistory->id_c3data = $model->id_c3_pd;
					$modelhistory->username = $id_pd;
					$modelhistory->tgl = $date;
					$modelhistory->uraian=  $_POST['masalah'];
					$modelhistory->save();
				}
				//(16)
				
				$loadhistory = C3History::model()->findAll('id_c3data =:id_c3data',array("id_c3data"=>$model->id_c3_pd));
			}//(17)
			
			$this->render('indexnew2',array(
				'model'=>$model,
				'loadhistory'=>$loadhistory,
			));
			//(18)
			
		}else{ //(19)
			$this->render('indexnew2',array(
				'model'=>$model,
				'loadhistory'=>$loadhistory,
				'modelall'=>$modelall,
			));
		} //(20)
		//(21)
	}
	
public function loadModel($id)
{
$model=Tugas::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='tugas-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
