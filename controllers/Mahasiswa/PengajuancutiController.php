<?php

class PengajuancutiController extends Controller
{
	public $layout='//layouts/main';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','edit'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionDownload()
	{
		$id=Yii::app()->session->get('username');
		$sql = Yii::app()->db->createCommand("select dosen.nm_ptk as dosen, dosen.id_ptk as nipdosen, kuliah_mhs.semester as smt,kuliah_mhs.id_smt as id_smt, kuliah_mhs.ipk , sms.nm_lemb as prodi, sms.pimpinan , sms.pimpinan_nip, fak.nm_lemb as fakul, smt2.nm_smt as smt2, smt3.nm_smt as smt3, pengajuan_cuti.*, mahasiswa.* , thn.nm_thn_ajaran from pengajuan_cuti 
		inner join mahasiswa on mahasiswa.id_pd = pengajuan_cuti.id_pd 
		inner join kuliah_mhs on kuliah_mhs.id_reg_pd = mahasiswa.id_pd
		inner join semester as smt2 on smt2.id_smt = pengajuan_cuti.id_smt2
		inner join semester as smt3 on smt3.id_smt = pengajuan_cuti.id_smt3
		inner join tahun_ajaran  as thn on thn.id_thn_ajaran = smt2.id_thn_ajaran
		inner join sms on sms.id_sms = mahasiswa.regpd_id_sms 
		inner join sms as fak on fak.id_sms = sms.id_induk_sms
		inner join bak on bak.id_pd = mahasiswa.id_pd
		inner join dosen on dosen.id_ptk = bak.id_ptk
		where pengajuan_cuti.id_pd like '".$id."'")->queryAll();
						
						
		//panggil class HTML2PDF
	
		$html2pdf = Yii::app() -> ePdf -> HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
		$BODYHTML = $this -> renderPartial('cetak',
				array(
					'sql'=>$sql,
				),true);
		//tulis text yang akan di buat pdf
		$html2pdf -> WriteHTML ($BODYHTML);
		//kirim output ke bentuk pdf
		$html2pdf -> Output('cetakcuti-'.$id.'.pdf','P'); 			
	}
	
	public function actionIndex()
	{
		//Session id_pd
		$id=Yii::app()->session->get('username');
		$model=Mahasiswa::model()->findByPk($id);

		$this->render('index',array(
			'model'=>$model,
			
		
		));
	}
	
	
}
