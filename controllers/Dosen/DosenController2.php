<?php

class DosenController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','create','ajax','loadImage','kwnAjax','syarat','konversiNilaiHuruf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','step5','admin','delete','deleteAcc','update','bak','nilaiMatkul','nilaiMhs','statusKrs','acc','exportExcel','exportExcelHuruf','exportExcelAngka','importExcel','importExcelHuruf','importExcelAngka'),
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
		$model=new Dosen;
		$modelObj=new LargeObject;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dosen']))
		{
			//cek form or step
			if(isset($_POST['Dosen'] ['nidn']))
			{
			$model->attributes=$_POST['Dosen'];
				//tanggal
						$tgl1=$_POST['Dosen']['tgl1'];
						$bln1=$_POST['Dosen']['bln1'];
						if( $tgl1 < 10)
						{
					$tgl1 = '0'.$tgl1;
						}
						if( $bln1 < 10)
						{
					$bln1 = '0'.$bln1;
						}
					$model->tgl_lahir=$_POST['Dosen']['thn1'].'-'.$bln1.'-'.$tgl1;
					//hilangkan value jika null atau 0 pada tanggal
						if(($tgl1<1)||($bln1<1)||($_POST['Dosen']['thn1']=="")){$model->tgl_lahir=null;}
				//convert image to blob
				if(!empty($_FILES['LargeObject']['tmp_name']['blob_content']))
				{
					$modelObj->attributes=$_POST['LargeObject'];
					$model->attributes=$_POST['Dosen'];
					$file = CUploadedFile::getInstance($modelObj,'blob_content');
					// $modelObj->fileName = $file->name;
					// $modelObj->fileType = $file->type;
					$fp = fopen($file->tempName, 'r');
					$content = fread($fp, filesize($file->tempName));
					fclose($fp);
					$modelObj->id_blob = $model->id_ptk;
					$modelObj->blob_content = file_get_contents($file->tempName);
					if($modelObj->save())
					{
						// $this->redirect($content);
					}
					 // $this->redirect('sfsef');
				}
				
				
				if($model->save())
				{
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
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelObj=LargeObject::model()->findAll('id_blob=:id_blob',array(':id_blob'=>$id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dosen']))
		{
			$model->attributes=$_POST['Dosen'];

			if($model->save())
				$this->redirect(array('update','id'=>$model->id_ptk));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelObj'=>$modelObj,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	public function actionDeleteAcc($id)
	{
		$model=Nilai::model()->findByPk($id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		echo '
		<script>
			history.back();
		</script>
		';
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex2()
	{
		$dataProvider=new CActiveDataProvider('Dosen');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Dosen('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Dosen']))
			$model->attributes=$_GET['Dosen'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionnilaiMatkul()
	{
		
		//Model Mata Kuliah
		$model=new AktAjarDosen;
		$this->render('nilaiMatkul',array(
			'model'=>$model,
			
		));
	}
	
	public function actionnilaiMhs($id)
	{	
		//Model Mata Kuliah
		$cek_nilai_huruf=false;
		$cek_na=false;
		$model=new Nilai;
		if(isset($_POST['Nilai']))
		{
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			if($modelKls->log>=1)
			{
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->refresh();
			}
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//Cek Nilai Huruf
			$check=$_POST['nilai_huruf'];
			if(count($check)>0)
			{
				$temp="";
				foreach($check as $id_nilai=>$nilai_huruf)
				{						
					$modelAcc=Nilai::model()->findByPk($id_nilai);
					if($modelAcc->nilai_huruf!=$nilai_huruf)
					{
						$cek_nilai_huruf=true;
						$modelAcc->nilai_huruf=$nilai_huruf;
						$modelAcc->save();
					}
				}
			}
			//Cek Nilai Angka
			$check=$_POST['na'];
			if(count($check)>0)
			{
				foreach($check as $id_nilai=>$na)
				{						
					$modelAcc=Nilai::model()->findByPk($id_nilai);
					if($modelAcc->na!=$na)
					{
						$cek_na=true;
					}
				}
			}
			//Cek Kondisi
			if($cek_nilai_huruf)
			{
			}else
			if($cek_na)
			
			{
			$this->redirect('../../aaaa');
				//Cek Nilai Angka
				$check=$_POST['na'];
				if(count($check)>0)
				{
					$temp="";
					foreach($check as $id_nilai=>$na)
					{						
						$modelAcc=Nilai::model()->findByPk($id_nilai);
						if($modelAcc->na!=$na)
						{
							$modelAcc->na=$na;
							$modelAcc->save();
						}
					}
				}
				$this->konversiNilaiHuruf($id);
			}else{
				//Nilai Tugas
				if(isset($_POST['nilai_tugas']))
				{
					$check=$_POST['nilai_tugas'];
					if(count($check)>0)
					{
						$a="";
						foreach($check as $id_nilai=>$nilai_tugas)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							$modelAcc->nilai_tugas=$nilai_tugas;
							$modelAcc->save();
						}
					}
				}
				//Nilai Quiz
				if(isset($_POST['nilai_quiz']))
				{
					$check=$_POST['nilai_quiz'];
					if(count($check)>0)
					{
						$a="";
						foreach($check as $id_nilai=>$nilai_quiz)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							$modelAcc->nilai_quiz=$nilai_quiz;
							$modelAcc->save();
						}
					}
				}
				//Nilai Mid
				if(isset($_POST['nilai_mid']))
				{
					$check=$_POST['nilai_mid'];
					if(count($check)>0)
					{
						$a="";
						foreach($check as $id_nilai=>$nilai_mid)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							$modelAcc->nilai_mid=$nilai_mid;
							$modelAcc->save();
						}
					}
				}
				//Nilai Uas
				if(isset($_POST['nilai_uas']))
				{
					$check=$_POST['nilai_uas'];
					if(count($check)>0)
					{
						$a="";
						foreach($check as $id_nilai=>$nilai_uas)
						{						
							$modelAcc=Nilai::model()->findByPk($id_nilai);
							$modelAcc->nilai_uas=$nilai_uas;
							$modelAcc->save();
						}
					}
				}
				
				//Deklarasi Nilai Angka ubah ke Nilai Huruf
				$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
				foreach($modelNa as $na)
				{
					$modelNilai=Nilai::model()->findByPk($na->id_nilai);
					$modelNilai->nilai_total=($modelNilai->nilai_tugas+$modelNilai->nilai_quiz)/2;
					$modelNilai->na=($modelNilai->nilai_tugas+$modelNilai->nilai_quiz+$modelNilai->nilai_mid+$modelNilai->nilai_uas)/4;
					$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>$modelNilai->na));
					foreach($modelBobot as $bobot)
					{
						$modelNilai->nilai_huruf=$bobot->nilai_huruf;
						$modelNilai->nilai_indeks=$bobot->nilai_indeks;
					}
					$modelNilai->save();			
				}
			}
			//Refresh halaman
			$this->refresh();
		}
		$this->render('nilaiMhs',array(
			'model'=>$model,
		
		));
	}
	
	public function konversiNilaiHuruf($id)
	{
				//Deklarasi Nilai Angka ubah ke Nilai Huruf
				$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id));
				foreach($modelNa as $na)
				{
					$modelNilai=Nilai::model()->findByPk($na->id_nilai);
					$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>$modelNilai->na));
					foreach($modelBobot as $bobot)
					{
						$modelNilai->nilai_huruf=$bobot->nilai_huruf;
						$modelNilai->nilai_indeks=$bobot->nilai_indeks;
					}
					$modelNilai->save();			
				}
	}
	
	public function actionExportExcel($id_kls)
    { 	
		$modelKls=KelasKuliah::model()->findByPk($id_kls);
		if(isset($_POST['fileType'])){
			$model = new Nilai();
			if($_POST['fileType']== "Excel"){
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Nilai '.$modelKls->mk->nm_mk.'-'. $modelKls->nm_kls,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->nilaiMhs($id_kls),
					'filter'=>$model,
					'locked'=>array('D2:D41', 'E2:E41', 'F2:F41', 'G2:G41'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						array(
							'header'=>$id_kls,
							'value'=>'$data->id_nilai',
						),
						'id_reg_pd', 
						'mhs.nm_pd',
						'nilai_tugas',
						'nilai_quiz',
						'nilai_mid',
						'nilai_uas',
					),
				));
				 
			} 
		}
    }
	
	public function actionExportExcelHuruf($nilaihuruf)
    { 	
		$modelKls=KelasKuliah::model()->findByPk($nilaihuruf);
		if(isset($_POST['fileType'])){
			$model = new Nilai();
			if($_POST['fileType']== "Excel"){
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Nilai '.$modelKls->mk->nm_mk.'-'. $modelKls->nm_kls,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->nilaiMhs($nilaihuruf),
					'filter'=>$model,
					'locked'=>array('D2:D41'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						array(
							'header'=>$id_kls,
							'value'=>'$data->id_nilai',
						),
						'id_reg_pd', 
						'mhs.nm_pd',
						'nilai_huruf',
					),
				));
				 
			} 
		}
    }
	
	public function actionExportExcelAngka($nilaiangka)
    { 	
		$modelKls=KelasKuliah::model()->findByPk($nilaiangka);
		if(isset($_POST['fileType'])){
			$model = new Nilai();
			if($_POST['fileType']== "Excel"){
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Nilai '.$modelKls->mk->nm_mk.'-'. $modelKls->nm_kls,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->nilaiMhs($nilaiangka),
					'filter'=>$model,
					'locked'=>array('D2:D41'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						array(
							'header'=>$id_kls,
							'value'=>'$data->id_nilai',
						),
						'id_reg_pd', 
						'mhs.nm_pd',
						'na',
					),
				));
				 
			} 
		}
    }
	
	public function actionImportExcel($id)
    { 	
		$id_kls=$id;
		$model=new Nilai;
		if(isset($_POST['Nilai']['filee']))
		{
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			if($modelKls->log>=1)
			{
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(array('nilaiMhs','id'=>$id));
			}
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//Membaca file excel
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($_FILES['Nilai']['tmp_name']['filee']); //$file --> your filepath and filename
            
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			//Pilih Kolom dan baris
			$temp='';
			$id=0;
			$tugas=3;
			$quiz=4;
			$mid=5;
			$uas=6;
			if($objWorksheet->getCellByColumnAndRow(0, 1)->getValue()==$id_kls)
			{
				for ($row = 2; $row <= $highestRow; $row++) 
				{
					$tempId=$objWorksheet->getCellByColumnAndRow($id, $row)->getValue();
					$tempTugas=$objWorksheet->getCellByColumnAndRow($tugas, $row)->getValue();
					$tempQuiz=$objWorksheet->getCellByColumnAndRow($quiz, $row)->getValue();
					$tempMid=$objWorksheet->getCellByColumnAndRow($mid, $row)->getValue();
					$tempUas=$objWorksheet->getCellByColumnAndRow($uas, $row)->getValue();
					$model=Nilai::model()->findByPk($tempId);
					if(isset($model))
					{
						$model->nilai_tugas=$tempTugas;
						$model->nilai_quiz=$tempQuiz;
						$model->nilai_mid=$tempMid;
						$model->nilai_uas=$tempUas;
						$model->save();
					}
				}
			}else{
				$msg="File yang anda upload salah.";
				Yii::app()->user->setFlash('flash',$msg);
			}
			//Auto input nilai angka dan huruf
			//Deklarasi Nilai Angka ubah ke Nilai Huruf
			$modelNa=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$id_kls));
			foreach($modelNa as $na)
			{
				$modelNilai=Nilai::model()->findByPk($na->id_nilai);
				$modelNilai->nilai_total=($modelNilai->nilai_tugas+$modelNilai->nilai_quiz)/2;
				$modelNilai->na=($modelNilai->nilai_tugas+$modelNilai->nilai_quiz+$modelNilai->nilai_mid+$modelNilai->nilai_uas)/4;
				$modelBobot=BobotNilai::model()->findAll('bobot_nilai_min <=:na AND bobot_nilai_maks >=:na',array(':na'=>$modelNilai->na));
				foreach($modelBobot as $bobot)
				{
					$modelNilai->nilai_huruf=$bobot->nilai_huruf;
					$modelNilai->nilai_indeks=$bobot->nilai_indeks;
				}
				$modelNilai->save();			
			}
			//Redirect ke halaman nilai
			$this->redirect('../../nilaiMhs/id/'.$id_kls);
		}
    }
	
	public function actionImportExcelHuruf($id)
    { 	
		$id_kls=$id;
		$model=new Nilai;
		if(isset($_POST['Nilai']['filee']))
		{
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			if($modelKls->log>=1)
			{
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(array('nilaiMhs','id'=>$id));
			}
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//Membaca file excel
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($_FILES['Nilai']['tmp_name']['filee']); //$file --> your filepath and filename
            
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			//Pilih Kolom dan baris
			$temp='';
			$id=0;
			$huruf=3;
			for ($row = 2; $row <= $highestRow; $row++) 
			{
				$tempId=$objWorksheet->getCellByColumnAndRow($id, $row)->getValue();
				$tempHuruf=$objWorksheet->getCellByColumnAndRow($huruf, $row)->getValue();
				$model=Nilai::model()->findByPk($tempId);
				if(isset($model))
				{
					$model->nilai_huruf=$tempHuruf;
					$model->save();
				}
			}
			//Auto input nilai angka dan huruf
			$this->konversiNilaiHuruf($id);
			//Redirect ke halaman nilai
			$this->redirect('../../nilaiMhs/id/'.$id_kls);
		}
    }
	
	public function actionImportExcelAngka($id)
    { 	
		$id_kls=$id;
		$model=new Nilai;
		if(isset($_POST['Nilai']['filee']))
		{
			//Tambah nilai Log
			$modelKls=KelasKuliah::model()->findByPk($id);
			//Cek jika log > 1 maka tidak bisa input nilai
			if($modelKls->log>=1)
			{
				$msg="Anda tidak diberikan akses!";
				Yii::app()->user->setFlash('flash',$msg);
				$this->redirect(array('nilaiMhs','id'=>$id));
			}
			//Tambah nilai Log +1
			$modelKls->log+=1;
			$modelKls->save();
			//Membaca file excel
			Yii::import('application.vendors.PHPExcel',true);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($_FILES['Nilai']['tmp_name']['filee']); //$file --> your filepath and filename
            
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
            $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			//Pilih Kolom dan baris
			$temp='';
			$id=0;
			$angka=3;
			for ($row = 2; $row <= $highestRow; $row++) 
			{
				$tempId=$objWorksheet->getCellByColumnAndRow($id, $row)->getValue();
				$tempAngka=$objWorksheet->getCellByColumnAndRow($angka, $row)->getValue();
				$model=Nilai::model()->findByPk($tempId);
				if(isset($model))
				{
					$model->na=$tempAngka;
					$model->save();
				}
			}
			//Auto input nilai angka dan huruf
			$this->konversiNilaiHuruf($id_kls);
			//Redirect ke halaman nilai
			$this->redirect('../../nilaiMhs/id/'.$id_kls);
		}
    }
	
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
	
	public function actionBak()
	{
		$model=new Bak;
		$this->render('bak',array(
			'model'=>$model,
		));
	}
	
	public function actionAcc()
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=new Nilai;
		if(isset($_POST['Nilai']))
		{
			if(isset($_POST['id_nilai']))
			{
				$check=$_POST['id_nilai'];
				if(count($check)>0)
				{
					foreach($check as $id_nilai)
					{						
						//acc krs
						$modelAcc=Nilai::model()->findByPk($id_nilai);
						$modelAcc->acc_pa='true';
						if($modelAcc->save())
						{										
							//Semester Aktif
							$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
							//Kelas Kuliah
							$modelKelas=KelasKuliah::model()->findByPk($modelAcc->id_kls);
							//Matkul
							$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
							//kuliah mhs
							$modelKuliahMhs=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND id_smt=:id_smt',array(':id_reg_pd'=>$modelAcc->id_reg_pd,':id_smt'=>$modelSmt->id_smt));
							$modelKuliahMhs->sks_smt=$modelKuliahMhs->sks_smt+$modelMatkul->sks_mk;
							$modelKuliahMhs->save();
						}
					}
					
				}
			}
			$this->refresh();
		}
		$this->render('acc',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
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
		':penerima' => 'dosen',
		);
		$model=Pengumuman::model()->findAll($criteria);
		//SMS
		$sSms=Yii::app()->session->get('sms');
		$this->render('pengumuman',array(
			'model'=>$model,
			'sSms'=>$sSms,
		));
	}
	
	//Menampilkan syarat mata kuliah
	public function syarat($data,$row)
	{
		$id_reg_pd=$data->id_reg_pd;
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
	 * @param integer $id the ID of the model to be loaded
	 * @return Dosen the loaded model
	 * @throws CHttpException
	 */ 
	public function loadModel($id)
	{
		$model=Dosen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dosen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dosen-form')
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
		
		// $data= CHtml::listData($jurusan, 'id_negara', 'nm_negara');
		
		// foreach($jurusan as $db)
		// {
			// echo CHtml::tag('option', array(
				// 'value'=>$db->id_negara
			// ), CHtml::encode($db->nm_negara), true);
		// }
		foreach($jurusan as $db){}
		echo $db->nm_negara;
	}
	
	public function tgl($yr)
	{
		if(isset($yr)){
			if($yr!==''){
				$tgl=$yr[0].$yr[1];
				$bln=$yr[3].$yr[4];
				$thn=$yr[6].$yr[7].$yr[8].$yr[9];
				$hasil=$thn.'-'.$bln.'-'.$tgl;
			}else{
				$hasil='';
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
	
	public function bulan($i)
	{
		switch($i)
		{
			case 1:
			$bulan="Januari";
			break;
			
			case 2:
			$bulan="Februari";
			break;
			
			case 3:
			$bulan="Maret";
			break;
			
			case 4:
			$bulan="April";
			break;
			
			case 5:
			$bulan="Mei";
			break;
			
			case 6:
			$bulan="Juni";
			break;
			
			case 7:
			$bulan="Juli";
			break;
			
			case 8:
			$bulan="Agustus";
			break;
			
			case 9:
			$bulan="September";
			break;
			
			case 10:
			$bulan="Oktober";
			break;
			
			case 11:
			$bulan="November";
			break;
			
			case 12:
			$bulan="Desember";
			break;
		}
			return $bulan;
	}
	
	public function statusKrs($nim)
	{
		return $nim;
	}
}

