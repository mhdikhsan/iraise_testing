<?php

class BeasiswaController extends Controller
{
	public $batas_umur=31;
	public function actionIndex()
	{
		
		$judul="Bidik Misi";
		
		$id_pd=Yii::app()->session->get('username');
		$sess_smt=Yii::app()->session->get('semester');
		$model=Mahasiswa::model()->findByPk($id_pd);
		$jk=$model->jk;
		//(1)
		if($jk=="L")
		{//(2)
			$jk="Laki-Laki"; //(3)
		}else if($jk=="P")
		{//(4)
			$jk="Perempuan";
		}else{//(5)
			$jk="?";
		}//(6)
		
		//jurusan
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		$jurusan=$modelSms->nm_lemb;
		$jenj_didik=$modelSms->id_jenj_didik; //S1 or D3
		//fakutas
		$modelSms=Sms::model()->findByPk($modelSms->id_induk_sms);
		$fakultas=$modelSms->nm_lemb;
		//Model Beasiswa
		$modelBBM=BidikmisiRincian::model()->findByPk($id_pd);
		//(7)
		if(!isset($modelBBM)){ //(8)
			$modelBBM=new BidikmisiRincian; //(9)
		}//(10)
		
		//POST
		if(isset($_POST['BidikmisiRincian']))
		{//(11)
			
			$modelBBM->attributes=$_POST['BidikmisiRincian'];
			$modelBBM->nim=$id_pd;
			$modelBBM->rata2_un=number_format($_POST['BidikmisiRincian']['rata2_un']			.'',2).'';
			$modelBBM->rata2_raport	=number_format($_POST['BidikmisiRincian']['rata2_raport']	,2).'';
			$modelBBM->nilai_xi_ii	=number_format($_POST['BidikmisiRincian']['nilai_xi_ii']	,2).'';
			$modelBBM->nilai_xii_i	=number_format($_POST['BidikmisiRincian']['nilai_xii_i']	,2).'';
			$modelBBM->nilai_xii_ii	=number_format($_POST['BidikmisiRincian']['nilai_xii_ii']	,2).'';
			//(12)
			if($modelBBM->save(false)): //(13)
				$model->beasiswa_bidikmisi="1";
				
				$model->save();				
				//refresh
				$msg = "Berhasil Registrasi, Berkas diantar saat wawancara"; 
				Yii::app()->user->setFlash('flash',$msg);
				$this->refresh();
				//(14)
			endif;//(15)
		}//(16)
		//Database sireg
		$connection=Yii::app()->db2;
		$sql="
		select *
		FROM mahasiswa as m
		JOIN jalur_masuk as jm ON m.id_jalur_masuk=jm.id_jalur_masuk
		LEFT JOIN agama as ag ON m.id_agama=ag.id_agama
		JOIN riwayat_pendidikan as rp ON m.id_mahasiswa=rp.id_mahasiswa
		JOIN keputusan as k ON m.id_mahasiswa=k.id_mahasiswa
		WHERE m.nim=".($model->id_pd)."";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$row=$dataReader->read();	

		$connection2=Yii::app()->db2;
		$sql2="
		select count(*) AS ttlsaudara
		FROM  mahasiswa as m
		LEFT JOIN keluarga as kel ON kel.id_mahasiswa=m.id_mahasiswa
		WHERE kel.hubungan_keluarga <> 'Ayah' and kel.hubungan_keluarga <> 'Ibu' and m.nim=".($model->id_pd)."";
		$command2=$connection2->createCommand($sql2);
		$dataReader2=$command2->query();
		$row2=$dataReader2->read();

		$connection3=Yii::app()->db2;
		$sql3="
		select kel.*
		FROM  mahasiswa as m
		LEFT JOIN keluarga as kel ON kel.id_mahasiswa=m.id_mahasiswa
		WHERE kel.hubungan_keluarga = 'Ayah' and m.nim='".($model->id_pd)."'";
		$command3=$connection3->createCommand($sql3);
		$dataReader3=$command3->query();
		$rowayah=$dataReader3->read();

		$connection4=Yii::app()->db2;
		$sql4="
		select kel.*
		FROM  mahasiswa as m
		LEFT JOIN keluarga as kel ON kel.id_mahasiswa=m.id_mahasiswa
		WHERE kel.hubungan_keluarga = 'Ibu' and m.nim='".($model->id_pd)."'";
		$command4=$connection4->createCommand($sql4);
		$dataReader4=$command4->query();
		$rowibu=$dataReader4->read();
		
		//Umur
		$tgl_lahir=($model->tgl_lahir);
		$tgl_skrg=(date('Y-m-d'));
		$umur=$tgl_skrg-$tgl_lahir;
		// if($umur>'21')
		// {
			// $this->redirect(array('gagal'));
		// }
		
		
		$this->render('bidikmisi',array(
			'judul'=>$judul,
			'id_pd'=>$id_pd,
			'model'=>$model,
			'jurusan'=>$jurusan,
			'fakultas'=>$fakultas,
			'jk'=>$jk,
			'modelBBM'=>$modelBBM,
			'row'=>$row,
			'row2'=>$row2,
			'rowayah'=>$rowayah,
			'rowibu'=>$rowibu,
			'umur'=>$umur,
			'sess_smt'=>$sess_smt,
			'jenj_didik'=>$jenj_didik, //2016-07-29 by yura
			));
			//(17)
	}


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
		
	}
	
	function objectToArray($d) 
	{
		 if (is_object($d)) {
		 // Gets the properties of the given object
		 // with get_object_vars function
		 $d = get_object_vars($d);
		 }
		 
		 if (is_array($d)) {
		 /*
		 * Return array converted to object
		 * Using __FUNCTION__ (Magic constant)
		 * for recursive call
		 */
		 return array_map(__FUNCTION__, $d);
		 }
		 else {
		 // Return array
		 return $d;
		 }
	 }
	public function actionGagal()
	{
		$judul="Gagal";
		$pesan="Anda tidak bisa mengajukan beasiswa bidikmisi :<br><br>";
		$pesan.="1. Umur anda melebihi 21 tahun.<br>";
		$pesan.="2. IP anda dibawah 3 selama 2 semester berturut-turut.<br>";
		$this->render('gagal',array(
			'pesan'=>$pesan,
			'judul'=>$judul,
		));
	}
	
	public function actionForm()
	{
		$judul="FORM";
		$this->deklarasi($judul,'form');
	}
	public function actionFormCetak()
	{
		$judul="FORM 1";
		$this->deklarasiCetak($judul,'form_cetak');
	}
	
	public function actionForm2()
	{
		$judul="FORM 2";
		
		$this->render('form2',array(
			'judul'=>$judul,
			));
	}
	public function actionForm2Cetak()
	{
		$judul="FORM 2";
		$this->deklarasiCetak($judul,'form2_cetak');
	}
	
	public function actionForm3()
	{
		$judul="FORM 3";
		
		$this->render('form3',array(
			'judul'=>$judul,
			));
	}
	public function actionForm3Cetak()
	{
		$judul="FORM 3";
		$this->deklarasiCetak($judul,'form3_cetak');
	}
	public function deklarasi($judul,$render)
	{
		$id_pd=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id_pd);
		//(1)
		$jk=$model->jk;
		if($jk=="L")
		{//(2)
			$jk="Laki-Laki";//(3)
		}else if($jk=="P")//(4)
		{
			$jk="Perempuan";
		}else{ //(5)
			$jk="?";
		}//(6)
		//jurusan
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		$jurusan=$modelSms->nm_lemb;
		//fakutas
		$modelSms=Sms::model()->findByPk($modelSms->id_induk_sms);
		$fakultas=$modelSms->nm_lemb;
		//Model Beasiswa
		$modelBBM=BidikmisiRincian::model()->findByPk($id_pd);
		//(7)
		if(!isset($modelBBM)){ //(8)
			$modelBBM=new BidikmisiRincian;//(9)
		}//(10)
		//Database sireg
		$connection=Yii::app()->db2;
		$sql="
		select * 
		FROM mahasiswa as m
		JOIN jalur_masuk as jm ON m.id_jalur_masuk=jm.id_jalur_masuk
		JOIN tarif as t ON m.id_tarif=t.id_tarif
		JOIN riwayat_pendidikan as rp ON m.id_mahasiswa=rp.id_mahasiswa
		WHERE m.nim=".($model->id_pd)."";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$row=$dataReader->read();	
		//(11)	
		//Umur
		$tgl_lahir=($model->tgl_lahir);
		$tgl_skrg=(date('Y-m-d'));
		$umur=$tgl_skrg-$tgl_lahir;
		//(12)
		if($umur>'21')//(13)
		{
			$this->redirect(array('gagal'));//(14)
		} //(15)
		
		$this->render($render,array(
			'judul'=>$judul,
			'id_pd'=>$id_pd,
			'model'=>$model,
			'jurusan'=>$jurusan,
			'fakultas'=>$fakultas,
			'jk'=>$jk,
			'modelBBM'=>$modelBBM,
			'row'=>$row,
			'umur'=>$umur,
			));
			//(16)
	}
	public function deklarasiCetak($judul,$render)
	{
		$id_pd=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id_pd);
		$jk=$model->jk;
		//(1)
		if($jk=="L")
		{//(2)
			$jk="Laki-Laki";//(3)
		}else if($jk=="P")
		{ //(4)
			$jk="Perempuan";
		}else{ //(5)
			$jk="?";
		}//(6)
		//jurusan
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		$jurusan=$modelSms->nm_lemb;
		//fakutas
		$modelSms=Sms::model()->findByPk($modelSms->id_induk_sms);
		$fakultas=$modelSms->nm_lemb;
		//Model Beasiswa
		$modelBBM=BidikmisiRincian::model()->findByPk($id_pd);
		//(7)
		if(!isset($modelBBM)){ //(8)
			$modelBBM=new BidikmisiRincian;//(9)
		}//(10)
		//Database sireg
		$connection=Yii::app()->db2;
		$sql="
		select * 
		FROM mahasiswa as m
		JOIN jalur_masuk as jm ON m.id_jalur_masuk=jm.id_jalur_masuk
		JOIN tarif as t ON m.id_tarif=t.id_tarif
		JOIN riwayat_pendidikan as rp ON m.id_mahasiswa=rp.id_mahasiswa
		JOIN keputusan as k ON m.id_mahasiswa=k.id_mahasiswa
		WHERE m.nim=".($model->id_pd)."";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$row=$dataReader->read();	
		//(11)	
		//Umur
		$tgl_lahir=($model->tgl_lahir);
		$tgl_skrg=(date('Y-m-d'));
		$umur=$tgl_skrg-$tgl_lahir;
		//(12)
		if($umur>'21')//(13)
		{
			$this->redirect(array('gagal'));//(14)
		}//(15)
		
		//panggil class HTML2PDF
		$html2pdf = Yii::app() -> ePdf -> HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(20, 5, 5, 5));
		$BODYHTML = $this -> renderPartial($render,
				array(
					'judul'=>$judul,
					'id_pd'=>$id_pd,
					'model'=>$model,
					'jurusan'=>$jurusan,
					'fakultas'=>$fakultas,
					'jk'=>$jk,
					'modelBBM'=>$modelBBM,
					'row'=>$row,
					'umur'=>$umur,
				),true);
		//tulis text yang akan di buat pdf
		$html2pdf -> WriteHTML ($BODYHTML);
		//kirim output ke bentuk pdf
		$html2pdf -> Output('Transkip-'.$id_pd.'.pdf','P');  
		//(16)
	}
}