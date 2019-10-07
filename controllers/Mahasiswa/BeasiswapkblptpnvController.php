<?php

class BeasiswapkblptpnvController extends Controller
{
	public $batas_umur=34;
	public function actionIndex()
	{
		$judul="Beasiswa PKBL PTPN V";
		
		$id_pd=Yii::app()->session->get('username');
		$sess_smt=Yii::app()->session->get('semester');
		$model=Mahasiswa::model()->findByPk($id_pd);
		$akm = KuliahMhs::model()->findAll('id_reg_pd=:id_reg_pd',array(':id_reg_pd'=>$id_pd));
		$jk=$model->jk;
		if($jk=="L")
		{
			$jk="Laki-Laki";
		}else if($jk=="P")
		{
			$jk="Perempuan";
		}else{
			$jk="?";
		}
		//jurusan
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		$jurusan=$modelSms->nm_lemb;
		$jenj_didik=$modelSms->id_jenj_didik; //S1 or D3
		//fakutas
		$modelSms=Sms::model()->findByPk($modelSms->id_induk_sms);
		$fakbuka = Sms::model()->findAll('bs_pkbl_ptpnv=:op',array(':op'=>'1'));
		$fakultas=$modelSms->nm_lemb;
		$config = BeasiswapkblptpnvConfig::model()->findByPk(1);
		$today = date('Y-m-d');
		
		$open= false;
		
		if ($sess_smt=='7' and $modelSms->bs_pkbl_ptpnv=='1' && $today >= $config->set1 && $today <=$config->set2){
			$open=true;
		}
		
		
		//Model Beasiswa
		$modelB=Beasiswapkblptpnv::model()->findByPk($id_pd);
		if(!isset($modelB)){
			$modelB=new Beasiswapkblptpnv;
		}
		
		//POST
		if(isset($_POST['Beasiswapkblptpnv']) && $open)
		{
			$modelB->attributes=$_POST['Beasiswapkblptpnv'];
			$modelB->id_pd=$id_pd;
			$modelB->tgl_daftar=date('Y-m-d h:i:s');
			if($modelB->save(false)):
				$msg = "Berhasil Registrasi."; 
				Yii::app()->user->setFlash('flash',$msg);
				$this->refresh();
			endif;
		}

		$tgl_lahir=($model->tgl_lahir);
		$tgl_skrg=(date('Y-m-d'));
		$umur=$tgl_skrg-$tgl_lahir;

		$this->render('index',array(
			'judul'=>$judul,
			'akm'=>$akm,
			'id_pd'=>$id_pd,
			'model'=>$model,
			'jurusan'=>$jurusan,
			'fakultas'=>$fakultas,
			'jk'=>$jk,
			'modelB'=>$modelB,
			'umur'=>$umur,
			'sess_smt'=>$sess_smt,
			'jenj_didik'=>$jenj_didik, 
			'open'=>$open,
			'fakbuka'=>$fakbuka,
			'config'=>$config,
			));
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
		$jk=$model->jk;
		if($jk=="L")
		{
			$jk="Laki-Laki";
		}else if($jk=="P")
		{
			$jk="Perempuan";
		}else{
			$jk="?";
		}
		//jurusan
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		$jurusan=$modelSms->nm_lemb;
		//fakutas
		$modelSms=Sms::model()->findByPk($modelSms->id_induk_sms);
		$fakultas=$modelSms->nm_lemb;
		//Model Beasiswa
		$modelBBM=BidikmisiRincian::model()->findByPk($id_pd);
		if(!isset($modelBBM)){
			$modelBBM=new BidikmisiRincian;
		}
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
		//Umur
		$tgl_lahir=($model->tgl_lahir);
		$tgl_skrg=(date('Y-m-d'));
		$umur=$tgl_skrg-$tgl_lahir;
		if($umur>'21')
		{
			$this->redirect(array('gagal'));
		}
		
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
	}
	public function deklarasiCetak($judul,$render)
	{
		$id_pd=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id_pd);
		$jk=$model->jk;
		if($jk=="L")
		{
			$jk="Laki-Laki";
		}else if($jk=="P")
		{
			$jk="Perempuan";
		}else{
			$jk="?";
		}
		//jurusan
		$modelSms=Sms::model()->findByPk($model->regpd_id_sms);
		$jurusan=$modelSms->nm_lemb;
		//fakutas
		$modelSms=Sms::model()->findByPk($modelSms->id_induk_sms);
		$fakultas=$modelSms->nm_lemb;
		//Model Beasiswa
		$modelBBM=BidikmisiRincian::model()->findByPk($id_pd);
		if(!isset($modelBBM)){
			$modelBBM=new BidikmisiRincian;
		}
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
		//Umur
		$tgl_lahir=($model->tgl_lahir);
		$tgl_skrg=(date('Y-m-d'));
		$umur=$tgl_skrg-$tgl_lahir;
		if($umur>'21')
		{
			$this->redirect(array('gagal'));
		}
		
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
	}
}