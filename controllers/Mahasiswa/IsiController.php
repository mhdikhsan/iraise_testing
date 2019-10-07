<?php

namespace app\controllers\Mahasiswa;

use app\models\KelasKuliah;
use app\models\Nilai;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Sms;
use app\models\KuliahMhs;
class IsiController extends Controller
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
				'actions'=>array('index','view','syarat','syarat2'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('krs'),
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
	
	/*
	public function beforeAction() {
		$nim= Yii::app()->session->get('username');
		$ceklengkap = Mahasiswa::model()->findAll('id_pd= :id_pd',array(':id_pd'=>$nim));
		foreach ($ceklengkap as $data) {
			if (strlen($data['nik'])<=0 or strlen($data['ds_kel'])<=0) {
				Yii::app()->request->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$nim);
			}else {
				return true;
			}
		}
		
	}
	*/
	
	public function actionIndex()
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::$app->session->get('sms');
		
		$id_pd=Yii::$app->session->get('username');
		$smt=Yii::$app->session->get('semester');
		$sks_max=KuliahMhs::find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id_pd,':semester'=>$smt));
       // $s_sks_max=$sks_max->sks_max;
		$s_sks_max=$sks_max->all();
		//Status Aktif Kuliah
		$status=Yii::$app->session->get('status');
		if($status!="A"){$this->redirect('../mahasiswa/mahasiswa');}
		//Semester aktif
		$modelSms=Sms::findAll($sms);
		//Model Mata Kuliah
		//$model="";
		$model=KelasKuliah::findAll('id_sms=:id_sms',array(':id_sms'=>$sms));
		$modelSearch=new KelasKuliah();
		$modelNilai=new Nilai();
		//(1)
		//Proses Input
		if(isset($_POST['KelasKuliah'])) //(2)
		{
			if(isset($_POST['id_kls'])) //(3)
			{
				$autoIdAll=$_POST['id_kls']; //(4)
				if(count($autoIdAll)>0) //(5)
				{
					$msg="Berhasil dipilih "; //(6)
					for($i=1;$i<=count($autoIdAll);$i++)//(7)
					{
						$modelNilai=new Nilai;
						$modelNilai->id_kls=$autoIdAll[$i-1];
						//Kelas Kuliah
						$modelKelas=KelasKuliah::model()->findByPk($modelNilai->id_kls);
						//Matkul
						$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk);
						//cek sks maks
						//(8)

						if(($modelNilai->totalKrsPreview($smt)+$modelMatkul->sks_mk)>$s_sks_max) //(9)
						{

							$msg="Gagal SKS Tidak Mencukupi ".$modelNilai->totalKrsPreview($smt).'+'.$modelMatkul->sks_mk.'>'.$s_sks_max; //(10)
						}else{ //(11)
							//save
							$modelNilai->id_reg_pd=$id_pd;
							$modelNilai->semester=$smt;
							$modelNilai->save();

						} //(12)
					}

					$msg.=count($autoIdAll)." Mata Kuliah. Klik tombol 'Preview KRS jika sudah selesai.";
					Yii::app()->user->setFlash('flash',$msg);
					$this->refresh();
					//(13)
				}
			} //(14)
		}//(15)


		$this->render('krs',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
			'modelSearch'=>$modelSearch,
			'modelNilai'=>$modelNilai,
		));
		//(16)
	}
	
	public function actionKrs($semester)
	{
		
		//Koneksi Database DAO
		$c=Yii::app()->db;
		
		//SMS = Fakultas dan Jurusan
		$sess_sms=Yii::app()->session->get('sms');
		$sess_id_pd=Yii::app()->session->get('username');
		$sess_smt=Yii::app()->session->get('semester');
		$sess_status=Yii::app()->session->get('status');
		$sess_angkatan=Yii::app()->session->get('angkatan');
		$modelSmtAktif=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
		
		
		//cek email
		$mahasiswa="select email,nisn from mahasiswa where id_pd='$sess_id_pd'";
		$mahasiswa = $c->createCommand($mahasiswa)->queryRow();
		//(1)
		if($mahasiswa['email']== ""){ //(2)
			$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$sess_id_pd);//(3)
		}//(4)
		
		//cek angkatan & nisn
		if(($sess_angkatan==2015) && ($mahasiswa['nisn']=="")){ //(5)
			$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$sess_id_pd);//(6)
		} //(7)
		
		//cek email
		if (filter_var($mahasiswa['email'], FILTER_VALIDATE_EMAIL)) //(8)
		{
			//continue; //(9)
		}else{ //(10)
				$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$sess_id_pd);
		}//(11)
		
		//id Fakultas
		$stgFak="select id_induk_sms from sms where id_sms='$sess_sms'";
		$stgFak = $c->createCommand($stgFak)->queryRow();
		$stgFak=Fakultas::model()->find('id_sms=:id_sms',array(':id_sms'=>$stgFak['id_induk_sms']));
		//(12)
		//Cek Tgl Jadwal isi krs
		if((date('Y-m-d')>=$stgFak->tgl_mulai_krs)&&(date('Y-m-d')<=$stgFak->tgl_selesai_krs))//(13)
		{
			//(14)
		}else{ //(15)
			$this->redirect(Yii::app()->request->baseUrl.'/');
		}//(16)
		//Status Aktif Kuliah
		if($sess_status!="A"){ //(17)
			$this->redirect('../mahasiswa/mahasiswa');//(18)
			}
		//(19)
		
		//Sks Total
		$sql="
			SELECT sks_total as sks_max
			FROM kuliah_mhs
			WHERE id_reg_pd=".$sess_id_pd." AND semester=".$sess_smt."
		";
		$kuliahMhs=$c->createCommand($sql)->queryRow();
		$sks_max=$kuliahMhs['sks_max'];
		//Sks Diambil
		$sql="
			SELECT SUM(mk.sks_mk) as sks_ambil
			FROM nilai as t
			JOIN kelas_kuliah as k ON k.id_kls=t.id_kls
			JOIN matkul as mk ON mk.id_mk=k.id_mk
			WHERE t.id_reg_pd='".$sess_id_pd."' AND k.id_smt='".$modelSmtAktif->id_smt."'
		";
		$modelSksAmbil=$c->createCommand($sql)->queryRow();
		$sks_ambil=0;
		//(20)
		if(!empty($modelSksAmbil['sks_ambil'])): //(21)
			$sks_ambil=$modelSksAmbil['sks_ambil'];//(22)
		endif;//(23)
		//SMS atau Jurusan atau Fakultas
		// $sql="
			// SELECT nm_lemb
			// FROM sms
			// WHERE id_sms='".$sess_sms."'
		// ";
		// $modelSms=$c->createCommand($sql)->queryRow();
		// $jurusan=$modelSms['nm_lemb'];
		$jurusan="";
		//Model Kelas Kuliah
		$modelSearch=new KelasKuliah;
		$sql="
			SELECT mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,mk.syarat,mk.syarat2,t.id_kls,t.nm_kls,dosen.nm_ptk, (select count(id_nilai) FROM nilai where id_kls=t.id_kls) as kuota,ksp.nm_kurikulum_sp as kurikulum, h.hari, j.jam_mulai, j.jam_selesai,r.kode_ruangan,t.kuota_pditt
			FROM kelas_kuliah as t
			LEFT JOIN akt_ajar_dosen as ajar ON ajar.id_kls=t.id_kls
			LEFT JOIN dosen as dosen ON dosen.id_ptk=ajar.id_reg_ptk
			LEFT JOIN matkul as mk ON mk.id_mk=t.id_mk
			LEFT JOIN matkul_kurikulum as mkk ON mkk.id_mk=t.id_mk
			LEFT JOIN kurikulum_sp as ksp ON ksp.id_kurikulum_sp=mkk.id_kurikulum_sp
			LEFT JOIN jadwal as j ON j.id_kls=t.id_kls
			LEFT JOIN hari as h ON h.id=j.hari
			LEFT JOIN ruangan as r ON r.id_ruangan=j.id_ruangan
			WHERE t.id_sms ='".$sess_sms."' AND mk.semester LIKE :semester AND t.id_smt='".$modelSmtAktif->id_smt."'
			ORDER BY mk.nm_mk,t.nm_kls
		";
		$modelKelas=$c->createCommand($sql);
		$modelKelas->bindParam(":semester", $semester, PDO::PARAM_STR);
		$modelKelas=$modelKelas->queryAll();
		//(24)
		//Proses Input
		if(isset($_POST['total']))
		{//(25)
			$msg="Berhasil dipilih ";
			$mk=0;
			//(26)
			for($i=1;$i<=$_POST['total'];$i++)
			{ //(27)
				if(isset($_POST['id_kls'.$i])): //(28)
					if($_POST['id_kls'.$i]=='1'): //(29)
						$kelas=$_POST['isi'.$i];
						// $tes.=$_POST['isi'.$i].'-';			
						$modelNilai=new Nilai;
						$modelNilai->id_kls=$kelas;
						//Kelas Kuliah
						$modelKelas=KelasKuliah::model()->findByPk($modelNilai->id_kls,array('select'=>'id_mk,kuota_pditt'));
						//Matkul
						$modelMatkul=Matkul::model()->findByPk($modelKelas->id_mk,array('select'=>'sks_mk'));
						//(30)
						//cek sks maks
						if(($sks_ambil+=$modelMatkul->sks_mk)>$sks_max)//(31)
						{ 
							$msg="Maaf Jumlah SKS yang anda ambil melebihi kuota ";//(32)
						}else{ //(33)
							//save
							$modelNilai->id_reg_pd=$sess_id_pd;
							$modelNilai->semester=$sess_smt;
							$modelNilai->create_user=$sess_id_pd;
							//cek
							$modelNilaiCek=Nilai::model()->find('id_kls=:id_kls AND id_reg_pd=:id_reg_pd',array(':id_kls'=>$kelas,':id_reg_pd'=>$sess_id_pd));
							$modelKelasCek=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$kelas));
							//(34)
							if((!isset($modelNilaiCek))&&(count($modelKelasCek)<$modelKelas->kuota_pditt))
							{//(35)
								$modelNilai->save();//(36)
							}elseif(isset($modelNilaiCek)){//(37)
								$msg="Mata kuliah sudah diambil ";
							}else{ //(38)
								$msg="Mata kuliah gagal dipilih, kuota penuh ";
							}//(39)
						}//(40)
						$mk++;
						//(41)
					endif; //(42)
				endif;//(43)
			}			
			$msg.=$mk." Mata Kuliah. Klik tombol 'Lihat KRS' jika sudah selesai";
			Yii::app()->user->setFlash('flash',$msg);
			$this->refresh();
			// $this->redirect('tes'.($tes));
			//(44)
		}//(45)
		//End Proses Input
		
		$this->render('krs',array(
			'jurusan'=>$jurusan,
			'modelSearch'=>$modelSearch,
			'modelKelas'=>$modelKelas,
			'semester'=>$semester,
			'sks_ambil'=>$sks_ambil,
			'sks_max'=>$sks_max,
			'tanggal_selesai'=>$stgFak->tgl_selesai_krs,
			'sess_smt'=>$sess_smt,
		));
		//(46)
	}
	
	
	public function actionPreview()
	{
		//SMS = Fakultas dan Jurusan
		$sms=Yii::app()->session->get('sms');
		$id_pd=Yii::app()->session->get('username');
		$modelSms=Sms::model()->findByPk($sms);
		//Model Mata Kuliah
		$model=new Nilai;
		$this->render('preview',array(
			'model'=>$model,
			'modelSms'=>$modelSms,
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
	public function syarat($data)
	{
		$id_reg_pd=Yii::app()->session->get('username');
		$kata=explode(',',$data['syarat']);
		$kata2=explode(',',$data['syarat2']);
		$text="";
		//Syarat 1
		if($kata[0]!="")
		{
			for($i=0;$i<count($kata);$i++)
			{
				$id=$kata[$i];
				//mata kuliah
				$modelCek=Matkul::model()->findByPk($id,array('select'=>'nm_mk'));
				if(empty($modelCek->nm_mk))
				{
					break;
				}
				$belum=false;
				//Cek nilai MK]
				
				
				
				$criteria=new CDbCriteria;	
				//$criteria->select('*,m.*, MIN(nilai_huruf) nnilai ');
				$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
				$criteria->condition = "t.id_reg_pd = :id_reg_pd AND  t.id_kls=k.id_kls AND k.id_mk=m.id_mk AND m.id_mk=:id_mk";
				$criteria->params = array (	
					':id_reg_pd' => $id_reg_pd,
					':id_mk' => $id,
				);
				//$criteria->group ='m.id_mk';
			   // $criteria->order = 'nnilai ASC';
				
				$modelKelas=Nilai::model()->findAll($criteria);
				
				
				
				/*
				$sql = "Select min(nilai.nilai_huruf) as nilai_huruf, matkul.nm_mk, matkul.sks_mk, dosen.nm_ptk  from nilai
						inner join kelas_kuliah on kelas_kuliah.id_kls = nilai.id_kls
						inner join matkul on matkul.id_mk = kelas_kuliah.id_mk 
						left join akt_ajar_dosen on akt_ajar_dosen.id_kls = kelas_kuliah.id_kls
						left join dosen on dosen.id_ptk = akt_ajar_dosen.id_reg_ptk
						where nilai.id_reg_pd='". $id_reg_pd . "' and matkul.id_mk = ". $id .
						" group by matkul.id_mk  
						order by nilai_huruf ASC ";
				
						
				$nnilai =  Yii::app()->db->createCommand($sql);
			    $modelKelas= $nnilai->queryAll();
				*/

				

				
				if((!empty($modelKelas))&&($id!=""))
				{
					foreach($modelKelas as $db)
					{
						//Ambil nama MK dan Nilai
						$model=Matkul::model()->findByPk($id);
						//cek kelulusan MK
						//if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
						if($db->nilai_huruf=="E")
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
				}else{
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id,array('select'=>'nm_mk'));
					$text.='<p>'.$model['nm_mk'].'</p>';
				}
			}
		}
		//Syarat 2
		if($kata2[0]!="")
		{
			for($i=0;$i<count($kata2);$i++)
			{
				$id=$kata2[$i];
				//mata kuliah
				$modelCek=Matkul::model()->findByPk($id);
				if(empty($modelCek->nm_mk))
				{
					break;
				}
				$belum=false;
				//Cek nilai MK
				$criteria=new CDbCriteria;			
				$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
				$criteria->condition = "t.id_reg_pd = :id_reg_pd AND  t.id_kls=k.id_kls AND k.id_mk=m.id_mk AND m.id_mk=:id_mk";
				$criteria->params = array (	
					':id_reg_pd' => $id_reg_pd,
					':id_mk' => $id,
				);
				$modelKelas=Nilai::model()->findAll($criteria);
				if((!empty($modelKelas))&&($id!=""))
				{
					foreach($modelKelas as $db)
					{
						//Ambil nama MK dan Nilai
						$model=Matkul::model()->findByPk($id);
						//cek kelulusan MK
						//if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
						if($db->nilai_huruf=="E")
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
				}else{
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id,array('select'=>'nm_mk'));
					$text.='<p>'.$model['nm_mk'].'</p>';
				}
			}
		}
		return $text;
	}
	//Menampilkan syarat mata kuliah
	public function syarat2($data)
	{
		$id_reg_pd=Yii::app()->session->get('username');
		$kata=explode(',',$data['syarat']);
		$kata2=explode(',',$data['syarat2']);
		$text="";
		$status=true;
		$status2=false;
		//Syarat 1
		if($kata[0]!="")
		{
			for($i=0;$i<count($kata);$i++)
			{
				$id=$kata[$i];
				//mata kuliah
				$modelCek=Matkul::model()->findByPk($id);
				if(empty($modelCek->nm_mk))
				{
					break;
				}
				$status=false;
				//Cek nilai MK
				$criteria=new CDbCriteria;			
				$criteria->join="JOIN kelas_kuliah k JOIN matkul m";
				$criteria->condition = "t.id_reg_pd = :id_reg_pd AND  t.id_kls=k.id_kls AND k.id_mk=m.id_mk AND m.id_mk=:id_mk";
				
				$criteria->params = array (	
					':id_reg_pd' => $id_reg_pd,
					':id_mk' => $id,
				);
				//$criteria->group = 'm.id_mk';
				//$criteria->order ='nilai_huruf ASC';
				
				$modelKelas=Nilai::model()->findAll($criteria);
				if((isset($modelKelas))&&($id!=""))
				{
					foreach($modelKelas as $db)
					{
						//Ambil nama MK dan Nilai
						$model=Matkul::model()->findByPk($id);
						//cek kelulusan MK
						//if(($db->nilai_huruf=="D")||($db->nilai_huruf=="E"))
						if($db->nilai_huruf=="E")
						{
							$warna1='<p style="color:red;">';
							$warna2='</p>';
							$status=false;
							if (count($modelKelas) ==1) break;
						}else{
							$warna1='<p style="color:green;">';
							$warna2='</p>';
							$status=true;
						}
						if($i==count($kata)-1)
						{
							$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.')'.$warna2;
						}else{
							$text.=$warna1.$model['nm_mk'].' ('.$db->nilai_huruf.'), '.$warna2;
						}
					}
				}else{
					//Ambil nama MK dan Nilai
					$model=Matkul::model()->findByPk($id);
					$text.='<p>'.$model['nm_mk'].'</p>';
					$status=false;
					//break;
				}
			}
		}else{
			$status=true;
		}
		//Syarat 2
		if($kata2[0]!="")
		{
			for($i=0;$i<count($kata2);$i++)
			{
				$id=$kata2[$i];
				//mata kuliah
				$modelCek=Matkul::model()->findByPk($id);
				if(empty($modelCek->nm_mk))
				{
					break;
				}
				// $status2=true;
				//Cek nilai MK
				$criteria=new CDbCriteria;			
				$criteria->join="JOIN kelas_kuliah as k ON k.id_kls=t.id_kls ";
				$criteria->join.="JOIN matkul as mk ON mk.id_mk=k.id_mk ";
				$criteria->condition = "t.id_reg_pd = :id_reg_pd AND mk.id_mk=:id_mk";
				$criteria->params = array (	
					':id_reg_pd' => $id_reg_pd,
					':id_mk' => $id,
				);
				$modelKelas=Nilai::model()->find($criteria);
				if((isset($modelKelas))&&($id!=""))
				{
					$status2=true;
				}else{
					$status2=false;
					break;
				}
			}
		}else{
			$status2=true;
		}
		//END SYARAT 2
		if(($status==true)&&($status2==true)){$status=true;}else{$status=false;}
		return $status;
	}
}
