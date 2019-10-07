<?php

class JadwalController extends Controller
{
	
	public $layout='//layouts/column2';


	public function actionIndex()
	{
		$model=new Jadwal;
		$this->render('index',array(
			'model'=>$model,
		));
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
							SELECT mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,mk.syarat,mk.syarat2,t.id_kls,t.nm_kls,dosen.nm_ptk,ksp.nm_kurikulum_sp as kurikulum, h.hari, j.jam_mulai, j.jam_selesai,r.kode_ruangan
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
		public function actionReportPersonal() {
			
				$sess_sms=Yii::app()->session->get('sms');
				$sess_id_pd=Yii::app()->session->get('username');
				
				$fileName = "Jadwal-".$sess_sms;
				header("Content-type: application/vnd.ms-excel; charset=utf-8");
				header("Content-Disposition: attachment; filename=$fileName.xls");
				$modelSmtAktif=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
				$c=Yii::app()->db;
				$sql="
							SELECT mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,mk.syarat,mk.syarat2,t.id_kls,t.nm_kls,dosen.nm_ptk,ksp.nm_kurikulum_sp as kurikulum, h.hari, j.jam_mulai, j.jam_selesai,r.kode_ruangan
								FROM kelas_kuliah as t
							LEFT JOIN akt_ajar_dosen as ajar ON ajar.id_kls=t.id_kls
							LEFT JOIN nilai ON nilai.id_kls=t.id_kls
							LEFT JOIN dosen as dosen ON dosen.id_ptk=ajar.id_reg_ptk
							LEFT JOIN matkul as mk ON mk.id_mk=t.id_mk
							LEFT JOIN matkul_kurikulum as mkk ON mkk.id_mk=t.id_mk
							LEFT JOIN kurikulum_sp as ksp ON ksp.id_kurikulum_sp=mkk.id_kurikulum_sp
							LEFT JOIN jadwal as j ON j.id_kls=t.id_kls
							LEFT JOIN hari as h ON h.id=j.hari
							LEFT JOIN ruangan as r ON r.id_ruangan=j.id_ruangan
							WHERE t.id_sms ='".$sess_sms."' AND t.id_smt='".$modelSmtAktif->id_smt."' AND nilai.id_reg_pd='".$sess_id_pd."'
							ORDER BY j.hari,j.jam_mulai
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
