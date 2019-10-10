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
				'actions'=>array('index','view','create','ajax2','loadImage','kwnAjax','feb','Autocomplete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','feb','pengumuman','ajukanCuti','spp','grafikip','uploadimage'),
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
	 /*
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	*/
	
	public function actionSpp()
	{
		$this->render('spp');
	}
	public function actionAjax2() {
	  if (!empty($_GET['term'])) {
		$sql = 'SELECT id_wil as id, nm_wil as value FROM wilayah WHERE nm_wil LIKE :qterm AND id_level_wil=3';
		$sql .= ' ORDER BY nm_wil ASC LIMIT 15';
		$command = Yii::app()->db->createCommand($sql);
		$qterm = $_GET['term'].'%';
		$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
		$result = $command->queryAll();
		echo CJSON::encode($result); exit;
		} else {
			return false;
		}
	}

	
	public function actionUpdate($id)
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=$this->loadModel($id);
		//Sms = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$modelSms=Sms::model()->findByPk($sms,array('select'=>'nm_lemb'));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		
		$ceklengkap = Mahasiswa::model()->findAll('id_pd= :id_pd',array(':id_pd'=>$id));
		$pesan=false;
		foreach ($ceklengkap as $data) {
			if (strlen($data['nik'])<=1 or strlen($data['ds_kel'])<=1 or strlen($data['id_wil'])<=1) {
				$pesan=true;
			}else {
				$pesan= false;
			}
		}
		
		
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

		$this->render('update',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'pesan'=>$pesan,
		));
	}

	
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
			$model=Wilayah::model()->findAll(array(
				"select"=>"id_wil,nm_wil",
				"condition"=>"nm_wil like '$request%' and id_level_wil='3'"
				
			));
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
		$name_blob    = "blob".$id;
		$val = Yii::app()->cache->get($name_blob);
		if(!$val):
			$model=LargeObject::model()->find('id_blob=:id_blob',array(':id_blob'=>$id));
			$val = $model->blob_content;
			$time  = 1800; // in seconds
			Yii::app()->cache->set($name_blob , $val, $time);
			
		endif;
			
		$this->renderPartial('image', array(
            'model'=>$val
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
		$smt=Yii::app()->session->get('smt');
		$sessSmt=Yii::app()->session->get('semester');
		if ($sessSmt>1) {
			if($smt[4]=='1')
			{
				$smt2= $smt[0].$smt[1].$smt[2].($smt[3]+1).$smt[4];
				$smt=$smt[0].$smt[1].$smt[2].$smt[3].'2';
				
			}else{
				$smt2= $smt[0].$smt[1].$smt[2].($smt[3]+1).$smt[4];
				$smt=$smt[0].$smt[1].$smt[2].($smt[3]+1).'1';
				
			}
			$smt3=$smt[0].$smt[1].$smt[2].($smt[3]+1).$smt[4];
			
			$modelKuliah=KuliahMhs::model()->find('id_smt=:id_smt AND id_reg_pd=:id_reg_pd',array(':id_smt'=>$smt,':id_reg_pd'=>$sId_pd));
			
			$modelKuliahCek=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND id_smt=:id_smt',array(':id_reg_pd'=>$sId_pd,':id_smt'=>$smt));
			/*if(isset($modelKuliahCek->id_smt))
			{
				echo 
				'
					<script>
						history.back();
					</script>
				';
				$this->redirect($smt);
			}*/
			
			$modelSmt=Semester::model()->find('id_smt=:id_smt',array(':id_smt'=>$smt));
			if(isset($modelSmt))
			{
				$cek=PengajuanCuti::model()->find('id_smt=:id_smt AND id_pd=:id_pd',array(':id_smt'=>$smt,':id_pd'=>$sId_pd));
				if(!isset($cek)){
					$model=new PengajuanCuti;
					$model->id_smt=$smt;
					$model->id_smt2=$smt2;
					$model->id_smt3=$smt3;
					$model->id_pd=$sId_pd;
					$model->status_pengajuan="0";
					$model->save();
				}
			}
			echo 
			'
				<script>
					history.back();
				</script>
			';
		}else{
			$this->redirect('index');
		}
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
		
		
		// }
		foreach($jurusan as $db){}
		echo $db->nm_negara;
	}
	
	public function actionUploadimage()
	{
		$error       = false;

 
				if (!empty($_FILES) && $_FILES['file']['tmp_name']) {    
					
					
					
					$tempFile = $_FILES['file']['tmp_name'];
					$fileName = time().'_'.$_FILES['file']['name'];
					
					$allowed =  array('gif','png' ,'jpg','jpeg');
					$ext = pathinfo($fileName, PATHINFO_EXTENSION);
					
					
					// check image type
					$allowedTypes = array(IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG,IMAGETYPE_BMP,IMAGETYPE_JPEG);// list of allowed image types
					$detectedType = exif_imagetype($tempFile);
					$error = !in_array($detectedType, $allowedTypes);
					// end of check
					
					if(!in_array($ext,$allowed)) {
							 echo '<div class="alert alert-danger">Format Gambar Harus JPG atau JPEG</div>';
					}else
					{
						if(!$error){
								
							$id=Yii::app()->session->get('username');
							//deklarasi blob
							$file = $tempFile;
							$fp = fopen($file, 'r');
							$content = fread($fp, $_FILES['file']['size']);
							fclose($fp);
							$content = addslashes($content);
						
						
						$modelObjek=LargeObject::model()->find('id_blob=:id_blob',array(':id_blob'=>$id));
						if(!empty($modelObjek)){
							
							$modelObjek->blob_content = $content;
							$modelObjek->save();
						}else {
							$modelObjek= new LargeObject;
							$modelObjek->id_blob = $id;
							$modelObjek->blob_content = $content;
							$modelObjek->save();
													
						}
											
					}
						//echo'<script>window.location="http://'.$_SERVER['HTTP_HOST'].'/mahasiswa/mahasiswa/update/id/'.$id.'";</script>';
				}	 		
		
		}
	}
	public function actionGrafikIp()
	{
		$this->render('grafik_ip');
	}
	
	
}
