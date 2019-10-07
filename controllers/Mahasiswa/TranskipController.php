<?php

class TranskipController extends Controller
{
	
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','akhir'),//,'sementaraCetak','kpCetak','taCetak','akhirCetak'),
				'users'=>array('@'),
			),
			
		);
	}

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
	

	
	/*
	public function actionIndex()
	{
		$this->render('maintanance');
	}
	*/
	
	public function actionIndex()
	{
		$nim=Yii::app()->session->get('username');
		$data= Yii::app()->db->createCommand("
			select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks,n.semester FROM `nilai` as n
				inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
				inner join matkul as m on m.id_mk=kk.id_mk
			where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' 
		")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		
			
		$mhs =Yii::app()->db->createCommand("
						SELECT m.id_pd, m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms,m.regpd_id_sms,j.nm_jenj_didik,mh.no_seri_ijazah,mh.judul_skripsi
							FROM mahasiswa AS m
							inner JOIN sms AS s ON s.id_sms = m.regpd_id_sms
							inner JOIN bak AS b ON b.id_pd = m.id_pd
							inner JOIN dosen AS d ON d.id_ptk = b.id_ptk
							inner JOIN jenjang_pendidikan AS j ON j.id_jenj_didik = s.id_jenj_didik
							inner JOIN mahasiswa_history as mh ON mh.nipd=m.id_pd
						WHERE m.id_pd LIKE :id_pd
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryRow();
		
		$fak=Sms::model()->findByPk($mhs['id_induk_sms']);
		$this->render('index',array(
					'mhs'=>$mhs,
					'fak'=>$fak,
					'data'=>$data,
					
					
		));
		
	}
	
	/*
	public function actionAkhir()
	{
		$this->render('maintanance');
	}	
	*/
	
	
	public function actionAkhir()
	{
		//seesion
		$sms=Yii::app()->session->get('sms');
		$id_smt=Yii::app()->session->get('smt');
		$nim=Yii::app()->session->get('username');
		//(1)
		//cari kode mk
		$array = Yii::app()->db->createCommand("
						SELECT m.kode_mk, count(*) as tot, MAX(n.nilai_indeks) as nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd  and n.nilai_huruf!=''
						group by m.kode_mk
						having tot>1
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$id_nilai=array();
		$kode_mk=array();
		//(2)
		//cari id_nilai
		foreach($array as $data): //(3)
			$nilai_indeks = $data['nilai_indeks'];
			$kode_m= $data['kode_mk'];
			$sql = Yii::app()->db->createCommand("
						SELECT n.id_nilai,m.kode_mk FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd  and n.nilai_huruf!=''  and m.kode_mk LIKE :kode_mk and n.nilai_indeks LIKE :nilai_indeks
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)
						  ->bindParam(":kode_mk", $kode_m, PDO::PARAM_STR)
						  ->bindParam(":nilai_indeks", $nilai_indeks, PDO::PARAM_STR)->queryRow();
			$id_nilai[]=$sql['id_nilai']; 
			$kode_mk[]="'".$sql['kode_mk']."'";
			//(4)
		endForeach;
		
		//(3)$id_nilai = implode (',',array_filter($id_nilai));
		$kode_mk = implode (',',array_filter($kode_mk));
		//(5)
		if(empty($array)) //(6)
				$id_nilai = 1;
				$kode_mk = 1;	
				//(7)
		}//(8)
		
		//cari id_nilai yang tidak di tampilkan 
		$array2 = Yii::app()->db->createCommand("
						SELECT n.id_nilai FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd  and n.nilai_huruf!='' AND m.kode_mk IN($kode_mk) AND n.id_nilai NOT IN($id_nilai)
		")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		//(9)
		
		
		$id_nilai2=array();
		//(10)
		foreach ($array2 as $data2){ //(11)
			$id_nilai2[]=$data2['id_nilai']; 
		}//(12)
		$id_nilai2 = implode (',',array_filter($id_nilai2));
		//(13)
		if(empty($array2)){ //(14)
				$id_nilai2 = 1; //(15)						
		}//(16)
		
		$sum =Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' 
						group by m.kode_mk) t
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryRow();
		//(17)				
		$mhs =Yii::app()->db->createCommand("
						SELECT m.id_pd, m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms,m.regpd_id_sms,j.nm_jenj_didik,mh.no_seri_ijazah,mh.judul_skripsi
							FROM mahasiswa AS m
							inner JOIN sms AS s ON s.id_sms = m.regpd_id_sms
							inner JOIN bak AS b ON b.id_pd = m.id_pd
							inner JOIN dosen AS d ON d.id_ptk = b.id_ptk
							inner JOIN jenjang_pendidikan AS j ON j.id_jenj_didik = s.id_jenj_didik
							inner JOIN mahasiswa_history as mh ON mh.nipd=m.id_pd
						WHERE m.id_pd LIKE :id_pd
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryRow();
		//(18)
		$fak=Sms::model()->findByPk($mhs['id_induk_sms'],array('select'=>'nm_lemb'));
		//(19)
		//$JabFak=Fakultas::model()->findByPk($mhs['id_induk_sms']);
		
		
		
		$mhs_smt1 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='1' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt2 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='2' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt3 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='3' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt4 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='4' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt5 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='5' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt6 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='6' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		
		$mhs_smt7 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and m.semester='7' and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		$mhs_smt8 = Yii::app()->db->createCommand("
						select m.nm_mk,m.kode_mk,m.sks_mk,n.nilai_huruf,n.nilai_indeks FROM `nilai` as n
							inner join kelas_kuliah as kk on kk.id_kls=n.id_kls
							inner join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and n.acc_pa='true' and (m.semester='8' OR m.semester='0' )and n.id_nilai NOT IN ($id_nilai2) 
						group by m.kode_mk
						")->bindParam(":id_pd", $nim, PDO::PARAM_STR)->queryAll();
		//(20)
		$this->render('akhir',array(
					'sum'=>$sum,
					'id_smt'=>$id_smt,
					'mhs'=>$mhs,
					'fak'=>$fak,
					'id_reg_pd'=>$nim,
					'mhs_smt1'=>$mhs_smt1,
					'mhs_smt2'=>$mhs_smt2,
					'mhs_smt3'=>$mhs_smt3,
					'mhs_smt4'=>$mhs_smt4,
					'mhs_smt5'=>$mhs_smt5,
					'mhs_smt6'=>$mhs_smt6,
					'mhs_smt7'=>$mhs_smt7,
					'mhs_smt8'=>$mhs_smt8,
					//'JabFak'=>$JabFak,
					'id_nilai'=>$id_nilai,
		));
		//(21)
	}
	
	

	
}
