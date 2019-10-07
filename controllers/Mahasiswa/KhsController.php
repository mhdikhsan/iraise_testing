<?php

class KhsController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','index','xcetak'),
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
	 
	/*
	public function beforeAction() {
		$nim= Yii::app()->session->get('username');
		$ceklengkap = Mahasiswa::model()->findAll('id_pd= :id_pd',array(':id_pd'=>$nim));
		foreach ($ceklengkap as $data) {
			if (strlen($data['nik'])<=1 or strlen($data['ds_kel'])<=1 or strlen($data['id_wil'])<=1) {
				Yii::app()->request->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$nim);
			}else {
				return true;
			}
		}
		
	}*/
	
	
	
	public function actionIndex()
	{
		$get_smt=$_GET['semester'];
		$id_smt=Yii::app()->session->get('smt');
		$id_reg_pd=Yii::app()->session->get('username');
		$cek_id_smt=Yii::app()->db->createCommand("select semester from kuliah_mhs where id_smt LIKE :id_smt AND id_reg_pd LIKE :id_reg_pd")
										->bindParam(":id_smt", $id_smt, PDO::PARAM_STR)
										->bindParam(":id_reg_pd", $id_reg_pd, PDO::PARAM_STR)
										->queryRow();
		
		if($get_smt == $cek_id_smt['semester']){
			$sks_max = $this->Cek_sks_total();
			$model=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND id_smt=:id_smt',array(':id_reg_pd'=>$id_reg_pd,'id_smt'=>$id_smt));
			$model->sks_max = $sks_max;
			$model->save();
			
		}
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$modelSms=Sms::model()->findByPk($sms);
		
		//Setting Fakultas
		$modelFak=Fakultas::model()->findAll('status=:status AND id_sms=:id_sms',array(':status'=>'1','id_sms'=>$modelSms->id_induk_sms));
		foreach($modelFak as $db){}
		//Model Mata Kuliah
		$model=new Nilai;
		$this->render('index',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'StgFak'=>$db,
		));
	}
	
	/*
	public function actionIndex()
	{
		$this->render('maintanance');		
	}
	*/
	
	public function actionCetak($semester)
	{
		//semester = id
		$id=$semester;
		$pdf = new fpdf();
		//(1)
		//Session
		$sNama=Yii::app()->session->get('name');
		$sNim=Yii::app()->session->get('username');
		$sSmt=Yii::app()->session->get('semester');
		//Deklarasi
		$header0="KEMENTERIAN AGAMA RI";
		$header="UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU";
		$judul="KARTU HASIL STUDI";
		//Dosen		
		$modelBak=Bak::model()->findAll('id_pd=:id_pd',array(':id_pd'=>$sNim));
		
		//(1)
		foreach($modelBak as $bak){//(2)
			
		}//(3)
		
		
		$id_ptk=$bak->id_ptk;
		$modelDosen=Dosen::model()->findByPk($id_ptk);
		//Semester
		$modelNilai=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester AND acc_pa="true" AND nilai_huruf!=""',array(':id_reg_pd'=>$sNim,':semester'=>$id));
		//(4)
		foreach($modelNilai as $db){//(5)
			
		}//(6)
		$modelSmt=Semester::model()->findByPk($db->smtKrs['id_smt']);
		$semester=$db->semester .' - ';
		//Tahun
		$modelTahun=TahunAjaran::model()->findByPk($modelSmt->id_thn_ajaran);
		//SMS
		$modelMhs=Mahasiswa::model()->findByPk($sNim);
		$modelSms=Sms::model()->findByPk($modelMhs->regpd_id_sms);
		//Setting Fakultas
		$StgFak=Fakultas::model()->findAll('status=:status AND id_sms=:id_sms',array(':status'=>'1','id_sms'=>$modelSms->id_induk_sms));
		//(7)
		foreach($StgFak as $db){//(8)
			
		}//(9)
		
		//Fakultas
		$modelFak=Sms::model()->findByPk($modelSms->id_induk_sms);
		//model utk table
		//(10)
		$criteria=new CDbCriteria;

		$criteria->select= "*";
		$criteria->join= " left join kelas_kuliah as kk on kk.id_kls=t.id_kls ";
		$criteria->join.= "left join matkul as m on m.id_mk=kk.id_mk ";
		$criteria->condition = "t.id_reg_pd=:id_reg_pd AND t.semester=:semester AND t.acc_pa=:acc_pa AND t.nilai_huruf!=:nilai_huruf AND m.id_mk!=:id_mk GROUP BY m.kode_mk";
		$criteria->params = array (	
			':id_reg_pd'=>$sNim,
			':semester'=>$id, 
			':acc_pa'=>'true',
			':nilai_huruf'=>'',
			':id_mk'=>'',
		);
		// $model=Nilai::model()->findAll('id_reg_pd=:id_reg_pd AND semester=:semester AND acc_pa=:acc_pa',array(':id_reg_pd'=>$sNim,':semester'=>$id, ':acc_pa'=>'true'));
		$model=Nilai::model()->findAll($criteria);
		
		echo '<script>console.log($model);</script>';
		//(11)
		//Kuliah Mhs
		
		$modelKuliah=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$sNim,':semester'=>$id+1)); 
		//(12)
		if(isset($modelKuliah))://(13)
			$sks=$modelKuliah->sks_total;//(14)
		else:
		//(15)
			$sks="-";
		endif;
		//Render
		//(16)
		$this->renderPartial('cetak',array(
			'pdf'=>$pdf,
			'judul'=>$judul,
			'header0'=>$header0,
			'header'=>$header,
			'nama'=>$sNama,
			'nim'=>$sNim,
			'pa'=>$modelDosen->nm_ptk,
			'semester'=>$semester,
			'tahun'=>$modelSmt->nm_smt,
			'prodi'=>$modelSms->nm_lemb,
			'model'=>$model,
			'fakultas'=>$modelFak->nm_lemb,
			'StgFak'=>$db,
			'sks_total'=>$sks,
		));
	}

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Matkul the loaded model
	 * @throws CHttpException
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
	 * @param Matkul $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='matkul-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function sksMaks($smt,$ip,$sks_smt)
	{
		if($ip>=3.00)
		{//(1)
			$sks=24; //(2)
		}else
		if(($ip>=2.50)&&($ip<3))
		{//(3)
			$sks=21; // (4)
		}else
		if(($ip>=2.00)&&($ip<2.50))
		{ // (5)
			$sks=18;//(6)
		}else
		if(($ip>=1.50)&&($ip<2))
		{//(7)
			$sks=15; //(8)
		}else
		if($ip<1.50)
		{ // (9)
			$sks=12;
		}//(10)
		
		//Session id_pd
		$s_id_pd=Yii::app()->session->get('username');		
		//Semester Aktif
		$modelSmt=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		//Mengambil Next Semester
		$modelKuliah=KuliahMhs::model()->find('id_smt=:id_smt',array(':id_smt'=>$modelSmt->id_smt));
		//Mengambil Next Id Semester
		$modelSmt=Semester::model()->find('tgl_mulai > :tgl_mulai',array(':tgl_mulai'=>$modelSmt->tgl_selesai));
		//Input ke Kuliah Mhs		
		$modelKuliahMhs=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND id_smt=:id_smt',array(':id_reg_pd'=>$s_id_pd,':id_smt'=>$modelSmt->id_smt));
		//(11)
		//cek smt sekarang
		if($modelKuliah->semester==$smt)//(12)
		{
			//Current Smt
			$modelKuliah->ips=$ip;
			$modelKuliah->save();
			//(13)
			//Next Smt
			if(isset($modelKuliahMhs)): //(14)
			$modelKuliahMhs->sks_total=$sks;
			$modelKuliahMhs->save();
			//(15)
			endif;//(16)
		
		}//(17)
		//semester dipilih (ex : 1)
		
		$modelSmtNow=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$s_id_pd,':semester'=>$smt));
		//(18)
		if(isset($modelSmtNow)){ //(19)
			$modelSmtNow->ips=$ip;
			$modelSmtNow->sks_smt=$sks_smt;
			$modelSmtNow->save();
			$smt++;
			//20)
		}//21
		//semester next (ex : 2)
		$modelSmtNext=KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$s_id_pd,':semester'=>$smt));
		//(22)
		if(isset($modelSmtNext))
		{//(23)
			$modelSmtNext->sks_total=$sks;
			$modelSmtNext->save();
			//(24)
		}//(25)
		//return value
		return $sks;//(26)
	}
	
	
	public function Cek_sks_total()
	{   $ip = 1.3;
		$id_reg_pd=Yii::app()->session->get('username');
		$id_smt=Yii::app()->session->get('smt');
		$id_reg_pd=Yii::app()->session->get('username');
		$cek_no_urut=Yii::app()->db->createCommand("select no_urut from semester where id_smt LIKE :id_smt")
										->bindParam(":id_smt", $id_smt, PDO::PARAM_STR)
										->queryRow();
		$cek1 = $cek_no_urut['no_urut']-1;
		$cek2 = $cek_no_urut['no_urut']-2;
		$cek3 = $cek_no_urut['no_urut']-3;
		$cek = Yii::app()->db->createCommand("select km.id_stat_mhs,km.semester from kuliah_mhs  as km
												left join semester on semester.id_smt=km.id_smt
												where no_urut LIKE :no_urut and km.id_reg_pd LIKE :id_reg_pd")
										->bindParam(":no_urut", $cek1, PDO::PARAM_STR)
										->bindParam(":id_reg_pd", $id_reg_pd, PDO::PARAM_STR)
										->queryRow();
		//(1)								
		if($cek['id_stat_mhs'] =="A"){ //(2)
				$semester = $cek['semester'];
				$ip=Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' AND n.semester='$semester'
						group by m.kode_mk) t
						")
						->bindParam(":id_pd", $id_reg_pd, PDO::PARAM_STR)
						->queryRow();
				//(3)
				if ($ip['x_sks']==null and $ip['sks_mk']==null) { //(4)
					$ip =0;//(5)
				}else{//(6)
				$ip = $ip['x_sks']/$ip['sks_mk'];//
				}//(7)
				
		}else if($cek['id_stat_mhs'] =="C"){//(8)
			$ip = 1.5;//(9)
		}else if($cek['id_stat_mhs'] =="B"){//(10)
				$cek_cuti = Yii::app()->db->createCommand("select km.id_stat_mhs,km.semester from kuliah_mhs  as km
												left join semester on semester.id_smt=km.id_smt
												where no_urut LIKE :no_urut and km.id_reg_pd LIKE :id_reg_pd")
										->bindParam(":no_urut", $cek2, PDO::PARAM_STR)
										->bindParam(":id_reg_pd", $id_reg_pd, PDO::PARAM_STR)
										->queryRow();
										//(11)
				//var_dump($cek_cuti);die();
				if($cek_cuti['id_stat_mhs'] =="A"){ //(12)
					$semester = $cek_cuti['semester'];
					$ip=Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' AND n.semester='$semester'
						group by m.kode_mk) t
						")
						->bindParam(":id_pd", $id_reg_pd, PDO::PARAM_STR)
						->queryRow();
				
					$ip = $ip['x_sks']/$ip['sks_mk'];
					//(13)
				}else if($cek_cuti['id_stat_mhs'] =="B") {//(14)
						$cek_cuti_2 = Yii::app()->db->createCommand("select km.id_stat_mhs,km.semester from kuliah_mhs  as km
												left join semester on semester.id_smt=km.id_smt
												where no_urut LIKE :no_urut and km.id_reg_pd LIKE :id_reg_pd")
										->bindParam(":no_urut", $cek3, PDO::PARAM_STR)
										->bindParam(":id_reg_pd", $id_reg_pd, PDO::PARAM_STR)
										->queryRow();
						$semester = $cek_cuti_2['semester'];
						$ip=Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' AND n.semester='$semester'
						group by m.kode_mk) t
						")
						->bindParam(":id_pd", $id_reg_pd, PDO::PARAM_STR)
						->queryRow();
				
						$ip = $ip['x_sks']/$ip['sks_mk'];
						//(15)
				}else{ //(16)
					$ip = 1.3;//(17)
				} //(18)
		}//(19)
		
		
		//konversi ke sks
		if($ip>=3)
		{ //(20)
			$sks=24; //(21)
		}else//(22)
		if(($ip>=2.50)&&($ip<3))
		{
			$sks=21; //(23)
		}else 
		if(($ip>=2.00)&&($ip<2.50))
		{ //(24)
			$sks=18;//(25)
		}else //
		if(($ip>=1.50)&&($ip<2))
		{ //(26)
			$sks=15; //(27)
		}else 
		if($ip<1.50)
		{ //(28)
			$sks=12; //(29)
		} 
		
		return $sks; //(31)
	
	} 
}
