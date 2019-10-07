<?php

class ReportController extends Controller
{
	
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	public function actionIsinilai()
    { 	
		$fak=Yii::app()->session->get('sms');
		$smt=Yii::app()->session->get('smt');
		$fakultas=Yii::app()->db->createCommand("select nm_lemb from sms where id_sms LIKE :id_sms")->bindParam(":id_sms", $fak, PDO::PARAM_STR)->queryRow();
		
		$sms=Yii::app()->db->createCommand("select id_sms from sms where id_induk_sms LIKE :id_sms")->bindParam(":id_sms", $fak, PDO::PARAM_STR)->queryAll();
		$id_sms=array();
		foreach ($sms as $data){
			$id_sms[]="'".$data['id_sms']."'"; 
		}
		$smss = implode (',',$id_sms);
		//var_dump($smss);die();
		$kk=Yii::app()->db->createCommand("select d.nm_ptk, kk.id_kls,m.nm_mk,s.nm_lemb, kk.nm_kls from kelas_kuliah as kk 
											left join matkul as m on m.id_mk=kk.id_mk
											left join sms as s on s.id_sms=kk.id_sms
											left join akt_ajar_dosen as aad on aad.id_kls=kk.id_kls
											left join dosen as d on d.id_ptk=aad.id_reg_ptk
											
											where kk.id_sms IN ($smss) AND kk.id_smt='$smt'")
										   ->queryAll();
		$this->render('isinilai',array(
					'kk'=>$kk,
					'fakultas'=>$fakultas,
					'id_smt'=>$smt,
					));
				
	}
	public function actionMahasiswa()
    { 	
		ini_set('memory_limit', '1028M');
		if(Yii::app()->request->isPostRequest){
			if($_POST['fileType']=="PDF"){
				$fak=Yii::app()->session->get('sms');
				
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('mahasiswa_pdf',
							array(
								'prodi'=>$prodi,
							),true);
				$html2pdf -> WriteHTML ($BODYHTML);
				$html2pdf -> Output();
					
			}
			else if($_POST['fileType']=="Excel"){
				$stat = $_POST['stat'];
				$fak=Yii::app()->session->get('sms');
				$smt = $_POST['smt'];
				
				$model = new Mahasiswa;
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Mahasiswa',
					'filename'=>'Mahasiswa- '.$stat.'-'. $fak,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->reportFakultas($stat,$fak,$smt),
					'filter'=>$model,
					//'locked'=>array('D2:D41'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
						
						'id_pd',
						'nm_pd',
						'jk',
						'tmpt_lahir',
						'tgl_lahir',
						'regpd_id_sms',
									
					),
				));
			}
			else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

		$models2 = StatusMahasiswa::model() -> cache(1000) -> findAll();
		$models4 = Semester::model() -> cache(1000) -> findAll();
        $this->render('mahasiswa',array(
							'models2' => $models2,
							'models4' => $models4,
													
						));
		}
	}
	public function actionListreport()
    { 
		$this->render('listreport');
	}
	public function actionGrafik()
    { 
		$this->render('grafik');
	}
	public function actionKurikulum()
    { 
		//ambil parameter
			$prodi = $_POST['prodi'];
			 
			if($prodi == ''){
				 exit;
			}else{
				 $data = Yii::app()->db->createCommand("SELECT nm_kurikulum_sp FROM `kurikulum_sp` WHERE id_sms='$prodi'				
					")->queryAll();
				 foreach ($data as $data ):
					echo "<option value='$data[nm_kurikulum_sp]'>$data[nm_kurikulum_sp]<option>";
				 endForeach;
				 exit;    
			}
	}
	public function actionIpsUin()
    { 	
		if(Yii::app()->request->isPostRequest){
			if($_POST['fileType']=="PDF"){
				$smt = $_POST['smt'];
				$c=Yii::app()->db;
				$sql="  SELECT 
						sms.nm_lemb,
						count( if( ips>= 0 and ips<=1, `kuliah_mhs`.ips, NULL ) ) AS a, 
						count( if( ips>= 1.001 and ips<=2, `kuliah_mhs`.ips, NULL ) ) AS b,
						count( if( ips>= 2.001 and ips<=3, `kuliah_mhs`.ips, NULL ) ) AS c,
						count( if( ips>= 3.001 and ips<=3.009, `kuliah_mhs`.ips, NULL ) ) AS d,
						count( if( ips =4, `kuliah_mhs`.ips, NULL ) ) AS e
						FROM `kuliah_mhs`,sms, mahasiswa
						where kuliah_mhs.id_reg_pd = mahasiswa.id_pd  and mahasiswa.regpd_id_sms=sms.id_sms and kuliah_mhs.id_smt='$smt'
						group by sms.id_sms 
					";
				$ips=$c->createCommand($sql)->queryAll();

								
				//panggil class HTML2PDF
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('ipsuin_pdf',
						array(
							'ips' =>$ips,
							'smt'=>$smt,
							'sql'=>$sql,
						),true);
				//tulis text yang akan di buat pdf
				$html2pdf -> WriteHTML ($BODYHTML);
				//kirim output ke bentk pdf
				$html2pdf -> Output(); 
				
					
			} else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

	
		$models = Semester::model() -> cache(1000) -> findAll();
        $this->render('ipsuin',array(
							'models' => $models,
																			
						));
		}
	}
	public function actionAktaAjarDosen()
    { 	
		if(Yii::app()->request->isPostRequest){
			if($_POST['fileType']=="PDF"){
				$id_smt = $_POST['id_smt'];
				$id_sms = $_POST['id_sms'];
				$c=Yii::app()->db;
				$sql=" SELECT 
						dosen.nidn,
						dosen.nm_ptk,
						sms.nm_lemb,
						matkul.kode_mk,
						matkul.nm_mk,
						kelas_kuliah.nm_kls,
						matkul.sks_mk,
						akt_ajar_dosen.jml_tm_renc,
						akt_ajar_dosen.jml_tm_real
						FROM dosen,akt_ajar_dosen, matkul, sms, kelas_kuliah
  						where dosen.id_ptk = akt_ajar_dosen.id_reg_ptk  and 
							  akt_ajar_dosen.id_kls=kelas_kuliah.id_kls and 
							  kelas_kuliah.id_mk=matkul.id_mk  and			
							  kelas_kuliah.id_sms='$id_sms' and
							  kelas_kuliah.id_smt='$id_smt'
						
					";
				$aad=$c->createCommand($sql)->queryAll();

								
				//panggil class HTML2PDF
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('aktaajar_dosen_pdf',
						array(
							'sms' =>$id_sms,
							'smt'=>$id_smt,
							'aad'=>$aad,
						),true);
				//tulis text yang akan di buat pdf
				$html2pdf -> WriteHTML ($BODYHTML);
				//kirim output ke bentk pdf
				$html2pdf -> Output(); 
				
					
			} else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

	
		$models = Semester::model() -> cache(1000) -> findAll();
		$models2 = Sms::model() -> cache(1000) -> findAll(array('condition'=>'id_jns_sms = 3'));
        $this->render('aktaajar_dosen',array(
							'models' => $models,
							'models2' => $models2,
																			
						));
		}
	}
	public function actionMatkul()
    { 	
		if(Yii::app()->request->isPostRequest){
			if($_POST['fileType']=="PDF"){
				$id_sms = $_POST['id_sms'];
				$c=Yii::app()->db;
				$sql=" SELECT 
								matkul.kode_mk,
								matkul.nm_mk,
								matkul.sks_mk,
								matkul.jns_mk,
								matkul.kel_mk,
								sms.nm_lemb
								
						FROM matkul,sms
  						where matkul.id_sms=sms.id_sms and matkul.id_sms='$id_sms' LIMIT 0,10
					";
				$matkul=$c->createCommand($sql)->queryAll();
				
				$sqlprodi="select sms.nm_lemb from sms where id_sms='$id_sms'";
				$sms=$c->createCommand($sqlprodi)->queryScalar();

								
				//panggil class HTML2PDF
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('matkul_pdf',
						array(
							'sms' =>$sms,
							'matkul'=>$matkul,
						),true);
				//tulis text yang akan di buat pdf
				$html2pdf -> WriteHTML ($BODYHTML);
				//kirim output ke bentk pdf
				$html2pdf -> Output(); 
				
					
			} else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

	
		$models2 = Sms::model() -> cache(1000) -> findAll(array('condition'=>'id_jns_sms = 3'));
        $this->render('matkul',array(
							
							'models2' => $models2,
																			
						));
		}
	}
	public function actionJumlahMhs()
    { 	
		if(Yii::app()->request->isPostRequest){
			if($_POST['fileType']=="PDF"){
				$id_smt = $_POST['id_smt'];
				$c=Yii::app()->db;
				$sql=" 
						SELECT 
						sms.nm_lemb,
						count( if( id_stat_mhs = 'A', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS a, 
						count( if( id_stat_mhs = 'B', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS b,
						count( if( id_stat_mhs = 'D', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS d,
						count( if( id_stat_mhs = 'G', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS g,
						count( if( id_stat_mhs = 'K', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS k,
						count( if( id_stat_mhs = 'L', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS l,
						count( if( id_stat_mhs = 'N', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS n,
						count( if( id_stat_mhs = 'X', `kuliah_mhs`.id_stat_mhs, NULL ) ) AS x
						FROM `kuliah_mhs`,sms, mahasiswa
						where kuliah_mhs.id_reg_pd = mahasiswa.id_pd  and mahasiswa.regpd_id_sms=sms.id_sms and kuliah_mhs.id_smt='$id_smt'
						group by sms.id_sms 
					";
				$jumlahmhs=$c->createCommand($sql)->queryAll();
				
				//$sqlprodi="select sms.nm_lemb from sms where id_sms='$id_sms'";
				//$sms=$c->createCommand($sqlprodi)->queryScalar();

								
				//panggil class HTML2PDF
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('jumlahmhs_pdf',
						array(
							'jumlahmhs'=>$jumlahmhs,
						),true);
				//tulis text yang akan di buat pdf
				$html2pdf -> WriteHTML ($BODYHTML);
				//kirim output ke bentk pdf
				$html2pdf -> Output(); 
				
					
			} else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

	
		$models2 = Semester::model() -> cache(1000) -> findAll();
        $this->render('jumlahmhs',array(
							
							'models2' => $models2,
																			
						));
		}
	}
	public function actionDosen()
    { 	
		if(Yii::app()->request->isPostRequest){
			if($_POST['fileType']=="PDF"){
				$id_sms = $_POST['id_sms'];
				$c=Yii::app()->db;
				$sql=" 
						SELECT nm_ptk,tmpt_lahir,tgl_lahir 
						FROM dosen
						where regptk_id_sms='$id_sms'
						
					";
				$dosen=$c->createCommand($sql)->queryAll();
				
				$sqlprodi="select sms.nm_lemb from sms where id_sms='$id_sms'";
				$sms=$c->createCommand($sqlprodi)->queryScalar();

								
				//panggil class HTML2PDF
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('dosen_pdf',
						array(
							'dosen'=>$dosen,
							'sms'=>$sms,
						),true);
				//tulis text yang akan di buat pdf
				$html2pdf -> WriteHTML ($BODYHTML);
				//kirim output ke bentk pdf
				$html2pdf -> Output(); 
				
					
			} 
			else if($_POST['fileType']=="Excel"){
				
				$sms = $_POST['id_sms'];
				
				
				$model = new Dosen;
				
				$this->widget('ext.EExcelView', array(
					'title'=>'Daftar Nilai',
					'filename'=>'Laporan-Dosen'. $sms,
					'grid_mode'=>'export',
					'stream'=>true,
					'dataProvider' => $model->reportOperator($sms),
					'filter'=>$model,
					//'locked'=>array('D2:D41'),
					'grid_mode'=>'export',
					'exportType'=>'Excel2007',
					'columns' => array(
							
							'id_ptk','id_ikatan_kerja','nm_ptk','nidn','nip','jk','tmpt_lahir','tgl_lahir','nik','niy_nigk','nuptk','id_stat_pegawai','id_jns_ptk','id_bid_pengawas','id_agama','jln','rt','rw','nm_dsn','ds_kel','id_wil','kode_pos','no_tel_rmh','no_hp','email','id_sp','id_stat_aktif','sk_cpns','tgl_sk_cpns','sk_angkat','tmt_sk_angkat','id_lemb_angkat','id_pangkat_gol','id_keahlian_lab','id_sumber_gaji','nm_ibu_kandung','stat_kawin','nm_suami_istri','nip_suami_istri','id_pekerjaan_suami_istri','tmt_pns','a_lisensi_kepsek','jml_sekolah_binaan','a_diklat_awas','akta_ijin_ajar','nira','stat_data','mampu_handle_kk','a_braille','a_bhs_isyarat','npwp','kewarganegaraan',
					
					),
				));

			}
			else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

	
		$models2 = Sms::model() -> cache(1000) -> findAll(array('condition'=>'id_jns_sms = 3'));
		$this->render('dosen',array(
							
							'models2' => $models2,
							
																			
						));
		}
	}
	public function actionMhsDOandLulus()
    { 	
		
		if(Yii::app()->request->isPostRequest){
		
			if($_POST['fileType']=="PDF"){
				$angkatan = $_POST['angkatan'];
				$c=Yii::app()->db;
				$sql=" 
						SELECT 
							mahasiswa.id_pd, 
							nm_pd, 
							sms.nm_lemb, 
							mahasiswa.jk, 
							mahasiswa.stat_pd, 
							mahasiswa.regpd_tgl_keluar, 
							mahasiswa.regpd_tgl_masuk_sp,
							mahasiswa.regpd_no_seri_ijazah
						FROM mahasiswa, sms
						WHERE mahasiswa.regpd_id_sms = sms.id_sms AND mahasiswa.stat_pd in('D','L')
						AND YEAR(mahasiswa.regpd_tgl_masuk_sp)=  '$angkatan' 
						
				";
				$doandlulus=$c->createCommand($sql)->queryAll();
				
				// $sqlprodi="select sms.nm_lemb from sms where id_sms='$id_sms'";
				// $sms=$c->createCommand($sqlprodi)->queryScalar();

								
				//panggil class HTML2PDF
				$html2pdf = Yii::app() -> ePdf -> HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(5, 5, 5, 5));
				$BODYHTML = $this -> renderPartial('doandlulus_pdf',
						array(
							'doandlulus'=>$doandlulus,
						),true);
				//tulis text yang akan di buat pdf
				$html2pdf -> WriteHTML ($BODYHTML);
				//kirim output ke bentk pdf
				$html2pdf -> Output(); 
				
					
			}

			
			else {
			
				echo "belum tersedia";
			}
			
			
        }
		else{

	
		//$models2 = Sms::model() -> cache(1000) -> findAll(array('condition'=>'id_jns_sms = 3'));
		$this->render('doandlulus',array(
							
						//	'models2' => $models2,
							
																			
						));
		}
	}
	public function actionBelumsisinilai()
    { 	
			$c=Yii::app()->db;
			$sql=" select n.id_kls, SUM(n.nilai_indeks) as total from nilai as n
						LEFT JOIN kelas_kuliah AS k ON k.id_kls=n.id_kls
				
							where k.id_kls IN(select id_kls from kelas_kuliah where id_smt='20142') 
							group by k.id_kls
							having total='0'";
							
			$sql2=$c->createCommand($sql)->queryAll();
			
			
			echo '<table border="1">
					<tr>
						<td>No</td>
						<td>Jurusan</td>
						<td>Mata Kuliah</td>
						<td>SKS</td>
						<td>Dosen</td>
						
						</tr>';
			$no = 1;
			foreach ($sql2 as $data){
				$id = $data['id_kls'];
				$sql2="SELECT m.nm_mk, m.semester, m.sks_mk, nm_ptk, s.nm_lemb,s.id_induk_sms,k.nm_kls, r.kode_ruangan FROM kelas_kuliah 	AS k

					LEFT JOIN matkul AS m ON k.id_mk=m.id_mk
					LEFT JOIN akt_ajar_dosen AS ak ON ak.id_kls = k.id_kls
					LEFT JOIN dosen AS d ON ak.id_reg_ptk = d.id_ptk
					LEFT JOIN sms AS s ON s.id_sms = k.id_sms
					LEFT JOIN jadwal j ON j.id_kls = k.id_kls
					LEFT JOIN ruangan r ON r.id_ruangan = j.id_ruangan

						WHERE 

					k.id_kls = '$id'
						";
					$mk=$c->createCommand($sql2)->queryRow();
				
				
				echo '
				<tr>
						<td>'.$no.'</td>
						<td>'.$mk['nm_lemb'].'</td>
						<td>'.$mk['nm_mk'].'</td>
						<td>'.$mk['sks_mk'].'</td>
						<td>'.$mk['nm_ptk'].'</td>
				</tr>';
			$no++;
			}
			echo '</table>';
			
		
	}
	
	
}
	