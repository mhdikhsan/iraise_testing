<?php
$this->breadcrumbs=array(
	'Transkip',
	'Nilai Akhir',
);
$sess_sms=Yii::app()->session->get('sms');
$sess_id_pd=Yii::app()->session->get('username');
$modelSmtAktif=Semester::model()->find('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
$c=Yii::app()->db;
$sql="
			SELECT (select count(id_nilai) FROM nilai where id_kls=t.id_kls) as kuota,t.id_kls,mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,mk.syarat,mk.syarat2,t.id_kls,t.nm_kls,dosen.nm_ptk,ksp.nm_kurikulum_sp as kurikulum, h.hari, j.jam_mulai, j.jam_selesai,r.kode_ruangan
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

		$sqlpersonal="
			SELECT (select count(id_nilai) FROM nilai where id_kls=t.id_kls) as kuota,t.id_kls,mk.kode_mk,mk.nm_mk,mk.sks_mk,mk.id_mk,mk.syarat,mk.syarat2,t.id_kls,t.nm_kls,dosen.nm_ptk,ksp.nm_kurikulum_sp as kurikulum, h.hari, j.jam_mulai, j.jam_selesai,r.kode_ruangan
			FROM kelas_kuliah as t
			LEFT JOIN akt_ajar_dosen as ajar ON ajar.id_kls=t.id_kls
			LEFT JOIN nilai ON nilai.id_kls=t.id_kls
			LEFT JOIN dosen as dosen ON dosen.id_ptk=ajar.id_reg_ptk
			LEFT JOIN matkul as mk ON mk.id_mk=t.id_mk
			LEFT JOIN matkul_kurikulum as mkk ON mkk.id_mk=t.id_mk
			LEFT JOIN kurikulum_sp as ksp ON ksp.id_kurikulum_sp=mkk.id_kurikulum_sp
			LEFT JOIN jadwal as j ON j.id_kls=nilai.id_kls
			LEFT JOIN hari as h ON h.id=j.hari
			LEFT JOIN ruangan as r ON r.id_ruangan=j.id_ruangan
			WHERE t.id_sms ='".$sess_sms."' AND t.id_smt='".$modelSmtAktif->id_smt."' AND nilai.id_reg_pd='".$sess_id_pd."'
			ORDER BY j.hari, j.jam_mulai
		";
		$modelp=$c->createCommand($sqlpersonal);
		$modelp=$modelp->queryAll();
?>

<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-12">
			<h3><i class="glyphicon glyphicon-time"></i> Jadwal Mahasiswa </h3>
		</div>
	</div>
</div>
<div class="col-md-12">                        
	<form action="#" class="form-horizontal">
     <div class="panel panel-default">
        <div class="panel-body"> 
					<div class="row">
					
						<div class="col-md-12">
							<form class="form-horizontal">
							<div class="panel panel-default tabs">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Personal</a></li>
									<li class=""><a href="#tab2" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Semua</a></li>
								</ul>
								<div class="panel-body tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="panel-body">                          
											<div class="row">
												<div class="col-md-12" style="margin-bottom:10px;">
														<div class="btn-group pull-right"> 
															<?php echo CHtml::link('<i class="fa fa-print"></i> Export Excel','jadwal/reportpersonal',array('class'=>'btn btn-primary pull-right','target'=>'_blank')); ?>
														</div>
												</div>
												<div class="col-md-12">
												<div class="table-responsive">
												<table class="table table-bordered table-striped table-actions">
													<thead>
														<tr>
															<th>No</th>
															<th>Hari</th>
															<th>Kode MK</th>
															<th>Nama Mata Kuliah-Kelas</th>
															<th>SKS</th>
															<th>Nama Dosen</th>
															<th>Ruang</th>
															<th>Jam</th>
															<th>Kurikulum</th>
															<th>Kuota</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$no=1;													
													$jam='';
													$jam_mulai='';
													$jam_selesai='';
													$hari_temp='';
													foreach($modelp as $db)
													{
														$hari=$db['hari'];
														if($hari_temp==$hari)
														{
															if($jam_mulai!='')
															{
																if((($db['jam_mulai']>=$jam_mulai)&&($db['jam_mulai']<=$jam_selesai))||(($db['jam_selesai']>=$jam_mulai)&&($db['jam_selesai']<=$jam_selesai)))
																{
																	$jam='<font color="red">Bentrok <br></font>';
																}
															}
														}else{
															$jam='';
															// $jam_mulai='';
															// $jam_selesai='';
														}
														$jam_mulai=$db['jam_mulai'];
														$jam_selesai=$db['jam_selesai'];
														
														echo '
														<tr style="background:white;">
															<td>'.$no.'</td>
															<td>'.$db['hari'].'</td>
															<td>'.$db['kode_mk'].'</td>
															<td>'.$db['nm_mk'].' - '.$db['nm_kls'].'</td>
															<td>'.$db['sks_mk'].'</td>
															<td>'.$db['nm_ptk'].'</td>
															<td>'.$db['kode_ruangan'].'</td>
															<td>'.$jam.$jam_mulai.' - '.$jam_selesai.'</td>
															<td>'.$db['kurikulum'].'</td>
															<td>'.$db['kuota'].'</td>
														</tr>';
														$no++;
														$hari_temp=$db['hari'];
													}
													?>
													</tbody>
												</table>
												</div>
												</div>
												
											</div>
										</div>					 
									</div>
									<div class="tab-pane " id="tab2">
										<div class="panel-body">                          
											<div class="row">
												<div class="col-md-12" style="margin-bottom:10px;">
														<div class="btn-group pull-right"> 
															<?php echo CHtml::link('<i class="fa fa-print"></i> Export Excel','jadwal/report',array('class'=>'btn btn-primary pull-right','target'=>'_blank')); ?>
														</div>
												</div>
												<div class="col-md-12">
												<div class="table-responsive">
												<table class="table table-bordered table-striped table-actions">
												<thead>
												<tr>
												<th>No</th>
												
												<th>Kode MK</th>
												<th>Nama Mata Kuliah-Kelas</th>
												<th>SKS</th>
												<th>Nama Dosen</th>
												<th>Hari-Ruang</th>
												<th>Jam</th>
												<th>Kurikulum</th>
												</tr>
												</thead>
													<?php
												$no=1;
												foreach($modelKelas as $db)
												{
												echo '
												<tr style="background:white;">
													<td>'.$no.'</td>
													
													<td>'.$db['kode_mk'].'</td>
													<td>'.$db['nm_mk'].' - '.$db['nm_kls'].'</td>
													<td>'.$db['sks_mk'].'</td>
													<td>'.$db['nm_ptk'].'</td>
													<td>'.$db['hari'].' - '.$db['kode_ruangan'].'</td>
													<td>'.$db['jam_mulai'].' - '.$db['jam_selesai'].'</td>
													<td>'.$db['kurikulum'].'</td>
													<td>'.$db['kuota'].'</td>';
													$no++;
												}
												?>
												<tbody>
												</tbody>
												</table>
												</div>
												</div>
												
												
											</div>
										</div>					 
									</div>
									
								</div>		
							</div>                                
							</form>
						</div>
					</div>                    
				
		</div> 
	</div>
    </form>                                                    
</div>