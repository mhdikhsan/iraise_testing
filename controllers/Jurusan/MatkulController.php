<?php

class MatkulController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='//layouts/main';

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
'actions'=>array('create','update','kurikulum'),
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
$this->redirect(array('admin','id'=>$model->id_mk));
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
	if(isset($_POST['Matkul']))
	{
		$model->attributes=$_POST['Matkul'];
		$model->semester = $_POST['Matkul']['semester'];
		// if($model->syarat>1)
		if(!empty($_POST['Matkul']['syarat']))
		{
			$model->syarat=implode(",", $model->syarat);
		}else{
			$model->syarat="";
		}
		if(!empty($_POST['Matkul']['syarat2']))
		{
			$model->syarat2=implode(",", $model->syarat2);
		}else{
			$model->syarat2="";
		}
		if($model->save()){}
			$this->redirect(array('view','id'=>$model->id_mk));
	}
	$model->syarat=explode(",", $model->syarat);
	$model->syarat2=explode(",", $model->syarat2);
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
*/public function actionIndex($id)
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$sSmt=Yii::app()->session->get('smt');
		$id_pd=$id;
		//Kuliah MHS
		$modelKuliah=KuliahMhs::model()->find('id_smt=:id_smt AND id_reg_pd=:id_reg_pd',array(':id_smt'=>$sSmt,':id_reg_pd'=>$id_pd));
		$smt=$modelKuliah->semester;
		//Semester aktif
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model="";
		$model=KelasKuliah::model()->findAll('id_sms=:id_sms',array(':id_sms'=>$sms));
		$modelSearch=new KelasKuliah;
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
						$modelNilai->id_reg_pd=$id_pd;
						$modelNilai->semester=$smt;
						$modelNilai->save();
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
	public function syarat($data,$row)
	{
		$id_reg_pd=Yii::app()->session->get('username');
		$kata=explode(',',$data->mk['syarat']);
		$text="";
		for($i=0;$i<count($kata);$i++)
		{
			$id=$kata[$i];
			//Cek nilai MK
			$modelKelas=Nilai::model()->findAll('id_reg_pd=:id_reg_pd',array(':id_reg_pd'=>$id_reg_pd));
			foreach($modelKelas as $db)
			{
				if($id==$db->mk['id_mk'])
				{
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id);
					//cek kelulusan MK
					if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
					{
						$warna1='<p style="color:red;">';
						$warna2='</p>';
					}else{
						$warna1='<p style="color:green;">';
						$warna2='</p>';
					}
					if($i==count($kata)-1)
					{
						$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.')'.$warna2;
					}else{
						$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.'), '.$warna2;
					}
				}
			}
		}
		return $text;
	}
	
/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
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
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='matkul-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}

public function actionKurikulum($id)
{
	//$modelAkt=new MatkulKurikulum;
	//Deklarasi Akt Ajar Dosen
	$matkul=MatkulKurikulum::model()->findAll('id_mk=:id_mk',array(':id_mk'=>$id));
	
	if(!$matkul){
			$modelAkt=new MatkulKurikulum;
	}else {
			$modelAkt=MatkulKurikulum::model()->find('id_mk=:id_mk',array(':id_mk'=>$id));
	}

	
	$model=Matkul::model()->find('id_mk=:id_mk',array(':id_mk'=>$id));
	if(isset($_POST['MatkulKurikulum']))
	{
		$sms=Yii::app()->session->get('sms');
		//Akta Ajar Dosen
		//Cek jika ada
		$id_mk=$_POST['MatkulKurikulum']['id_mk'];
		$id_kurikulum_sp=$_POST['MatkulKurikulum']['id_kurikulum_sp'];

		$modelAktCek=MatkulKurikulum::model()->findAll('id_mk=:id_mk',array(':id_mk'=>$id));
		foreach($modelAktCek as $db){}
		//Cek jika tidak ada data di db maka input new record
		if(!isset($db)){$modelAkt=new MatkulKurikulum;}
			$modelAkt->id_mk=$id_mk;
			$modelAkt->id_kurikulum_sp=$id_kurikulum_sp;
			$modelAkt->save();
		if($modelAkt->save())
		{
			$this->redirect('../../../../admin/matkul/admin');
		}
	}

	$this->render('kurikulum',array(
	
		'modelAkt'=>$modelAkt,
		'model'=>$model,

	));
}

}
