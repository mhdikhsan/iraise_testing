<?php
	$id_pd=Yii::app()->session->get('username');
	$smt=Yii::app()->session->get('semester');
	
	$this->breadcrumbs=array(
		'KRS',
		'Semester '.$smt,
	);
	//ID Mhs
	
	
	$c=Yii::app()->db;
	//nilai
	$sql_nilai="select m.kode_mk,m.nm_mk,m.sks_mk,k.nm_kls,ks.nm_kurikulum_sp,jp.nm_jenj_didik,d.nm_ptk,n.acc_pa, j.jam_mulai, j.jam_selesai, h.hari
			from nilai as n
			left JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
			left JOIN matkul as m ON m.id_mk=k.id_mk
			left join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
			left JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
			LEFT JOIN jadwal as j ON j.id_kls=n.id_kls
			LEFT JOIN hari as h ON h.id=j.hari
			left JOIN jenjang_pendidikan as jp ON jp.id_jenj_didik=m.id_jenj_didik
			left JOIN akt_ajar_dosen as akt ON akt.id_kls=k.id_kls
			left JOIN dosen as d ON  d.id_ptk=akt.id_reg_ptk
		where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND m.id_mk!=''
		ORDER BY j.hari, j.jam_mulai
		";
		
	$nilai_dao = $c->createCommand($sql_nilai);
	$nilai_dao->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$nilai_dao->bindParam(":semester", $smt, PDO::PARAM_STR);
	$nilai_dao = $nilai_dao->queryAll();
	//cetak krs harus di acc pa dulu
	$acc_pa=false;
	$sql_nilai_cetak="select m.kode_mk,m.nm_mk,m.sks_mk,k.nm_kls,ks.nm_kurikulum_sp,jp.nm_jenj_didik,d.nm_ptk,n.acc_pa from nilai as n
			left JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
			left JOIN matkul as m ON m.id_mk=k.id_mk
			left join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
			left JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
			left JOIN jenjang_pendidikan as jp ON jp.id_jenj_didik=m.id_jenj_didik
			left JOIN akt_ajar_dosen as akt ON akt.id_kls=k.id_kls
			left JOIN dosen as d ON  d.id_ptk=akt.id_reg_ptk
		where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND n.acc_pa LIKE :acc_pa AND m.id_mk!=''";
		
	$nilai_dao_cetak = $c->createCommand($sql_nilai_cetak);
	$nilai_dao_cetak->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$nilai_dao_cetak->bindParam(":semester", $smt, PDO::PARAM_STR);
	$nilai_dao_cetak->bindParam(":acc_pa", $acc_pa, PDO::PARAM_STR);
	$nilai_dao_cetak = $nilai_dao_cetak->queryAll();
	
	
	//bak
	$sql_bak = "SELECT m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms
					FROM mahasiswa AS m
					LEFT JOIN sms AS s ON s.id_sms = m.regpd_id_sms
					LEFT JOIN bak AS b ON b.id_pd = m.id_pd
					LEFT JOIN dosen AS d ON d.id_ptk = b.id_ptk
				WHERE m.id_pd LIKE :id_pd";
	$bak=$c->createCommand($sql_bak);
	$bak->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$bak= $bak->queryRow();
	
	//fak
	$id_induk_sms = $bak['id_induk_sms'];
	$sql_fak = "SELECT s.nm_lemb	FROM sms AS s	WHERE s.id_sms LIKE :id_induk_sms";
	$fak=$c->createCommand($sql_fak);
	$fak->bindParam(":id_induk_sms", $id_induk_sms, PDO::PARAM_STR);
	$fak= $fak->queryRow();
	
	
	//tahun ajaran
	
	$sql_smt = "SELECT s.nm_smt FROM kuliah_mhs	as km 
				left join semester as s ON s.id_smt = km.id_smt
				WHERE km.id_reg_pd LIKE :id_pd and km.semester LIKE :smt";
	$tahunajaran=$c->createCommand($sql_smt);
	$tahunajaran->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$tahunajaran->bindParam(":smt", $smt, PDO::PARAM_STR);
	$tahunajaran= $tahunajaran->queryRow();
	
	
	


?>
<div class="col-md-12">
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		<strong> 
		
		Di Himbau kepada seluruh mahasiswa yang ingin menghubungi Dosen PA terkait persetujuan KRS, agar menghubungi Dosen PA di jam kerja jam 8.00-16.00
		</strong>
	</div>
</div>
<div class="col-md-12">                        
	   <div class="panel panel-default">
	    <div class="panel-heading">
			<div class="btn-group pull-left">
				<h4><span class="fa fa-paste"></span> Preview</h4>
			</div>
            <div class="btn-group pull-right">
				<?php 
					if(count($nilai_dao_cetak)==0)
					{
						echo CHtml::link('<i class="fa fa-print"></i> Cetak KRS','../krs/cetak/semester/'.$smt,array('class'=>'btn btn-primary pull-right','target'=>'_blank')); 
					}
				?>
			</div>
		</div>
        <div class="panel-body"> 
			<div class="col-md-12">
				<div class="col-md-6">
					<table>
						<tr><td width="150px">Nama Mahasiswa</td><td>:</td><td><?php echo $bak['nm_pd']; ?></td></tr>
						<tr><td>Penasehat Akademis</td><td>:</td><td><?php echo $bak['nm_ptk']; ?></td></tr>
						<tr><td>Fakultas</td><td>:</td><td><?php echo $fak['nm_lemb']; ?></td></tr>
						<tr><td>Semester</td><td>:</td><td><?php echo $smt; ?></td></tr>
						
					</table>
				</div>
				<div class="col-md-6">
					<table>
						<tr><td width="150px">NIM</td><td>:</td><td><?php echo $id_pd; ?></td></tr>
						<tr><td>Tahun</td><td>:</td><td><?php echo $tahunajaran['nm_smt']; ?></td></tr>
						<tr><td>Prodi Lokal</td><td>:</td><td><?php echo $bak['nm_lemb']; ?></td></tr>
						
						
					</table>
					
				</div>			
			</div >
			<div class="col-md-12">
				<div class="table-responsive">
							<table class="table table-bordered table-striped table-actions">
								<thead>
									<tr>
										<th width="50">No</th>
										<th>Kode MK</th>
										<th>Nama MK</th>
										<th>SKS</th>
									   	<th>Program</th>
										<th>Nama Dosen</th>
										<th>Nama Kelas</th>
										<th>Kurikulum</th>
										<th>Persetujuan PA</th>
										<th>Jadwal</th>
									</tr>
								</thead>
								<tbody>
									<?php 	
									$no = 1;
									$sks = 0;
									$hari_temp='';
									$jam='';
									foreach ($nilai_dao as $data) {
										//cek jadwal bentrok
										$hari=$data['hari'];
										$jam_mulai=$data['jam_mulai'];
										$jam_selesai=$data['jam_selesai'];
										if($hari_temp==$hari)
										{
											if($jam_mulai!='')
											{
												if((($data['jam_mulai']>=$jam_mulai)&&($data['jam_mulai']<=$jam_selesai))||(($data['jam_selesai']>=$jam_mulai)&&($data['jam_selesai']<=$jam_selesai)))
												{
													// $jam='<font color="red">Bentrok <br></font>';
												}
											}
										}else{
											$jam='';
										}
									?>
									  <tr id="trow_1"><td class="text-center"><?php echo $no; ?></td>
										<td><?php echo $data['kode_mk']; ?></td>
										<td><?php echo $data['nm_mk']; ?></td>
										<td><?php echo $data['sks_mk']; ?></td>
										<td><?php echo $data['nm_jenj_didik']; ?></td>
										<td><?php echo $data['nm_ptk']; ?></td>
										<td><?php echo $data['nm_kls']; ?></td>
										<td><?php echo $data['nm_kurikulum_sp']; ?></td>
										<td><?php 
											if($data['acc_pa']=="true"){
												echo "Sudah Disetujui";
											}else {
												echo "
													<p style=\"color:red;\">Belum Disetujui</p>
												";
											}
											?>
										</td>
										<td><?php echo $jam.$data['hari'].'<br>'.$data['jam_mulai'].'-'.$data['jam_selesai']; ?></td>

										<?php $sks = $sks + $data['sks_mk']; ?>
										
									  </tr>	
										
									  
									  <?php $no++;  } ?>
										<tr id="trow_1">
											<td colspan='3'>SKS Total</td>
											<td  colspan='4'><?php echo $sks; ?></td>
										</tr>
									  
								</tbody>
							</table>
				</div>
			</div>	
		</div>	
	</div>	
</div>	