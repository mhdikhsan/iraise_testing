<?php
	$getSmt=$_GET['semester'];
	$this->breadcrumbs=array(
		'KRS',
		'Semester '.$getSmt,
	);
	//ID Mhs
	$id_pd=Yii::app()->session->get('username');
	$smt=Yii::app()->session->get('semester');
	
	
	$c=Yii::app()->db;
	//nilai
	$sql_nilai="select n.id_kls, m.kode_mk,m.nm_mk,m.sks_mk,k.nm_kls,ks.nm_kurikulum_sp,jp.nm_jenj_didik,d.nm_ptk from nilai as n
			INNER JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
			INNER JOIN matkul as m ON m.id_mk=k.id_mk
			INNER join matkul_kurikulum as mk ON mk.id_mk=m.id_mk
			INNER JOIN kurikulum_sp as ks ON ks.id_kurikulum_sp=mk.id_kurikulum_sp
			INNER JOIN jenjang_pendidikan as jp ON jp.id_jenj_didik=m.id_jenj_didik
			INNER JOIN akt_ajar_dosen as akt ON akt.id_kls=k.id_kls
			INNER JOIN dosen as d ON  d.id_ptk=akt.id_reg_ptk
		where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND n.acc_pa='true' AND m.id_mk!='' order by m.nm_mk";
		
	$nilai_dao = $c->createCommand($sql_nilai);
	$nilai_dao->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$nilai_dao->bindParam(":semester", $getSmt, PDO::PARAM_STR);
	$nilai_dao = $nilai_dao->queryAll();
	
	
	//bak
	$sql_bak = "SELECT m.nm_pd, d.nm_ptk, s.nm_lemb, s.id_induk_sms
					FROM mahasiswa AS m
					INNER JOIN sms AS s ON s.id_sms = m.regpd_id_sms
					INNER JOIN bak AS b ON b.id_pd = m.id_pd
					INNER JOIN dosen AS d ON d.id_ptk = b.id_ptk
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
				INNER join semester as s ON s.id_smt = km.id_smt
				WHERE km.id_reg_pd LIKE :id_pd and km.semester LIKE :smt";
	$tahunajaran=$c->createCommand($sql_smt);
	$tahunajaran->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$tahunajaran->bindParam(":smt", $getSmt, PDO::PARAM_STR);
	$tahunajaran= $tahunajaran->queryRow();
	
	
	


?>

<div class="col-md-12">                        
	   <div class="panel panel-default">
	    <div class="panel-heading">
			<div class="btn-group pull-left">
				<h4><span class="fa fa-paste"></span> Kartu Rencana Studi</h4>
			</div>
            <div class="btn-group pull-right">
				<?php echo CHtml::link('<i class="fa fa-print"></i> Cetak KRS','krs/cetak/semester/'.$getSmt,array('class'=>'btn btn-primary pull-right','target'=>'_blank')); ?>
			</div>
		</div>
        <div class="panel-body"> 
			<div class="col-md-12">
				<div class="col-md-6">
					<table>
						<tr><td>Nama Mahasiswa</td><td>:</td><td><?php echo $bak['nm_pd']; ?></td></tr>
						<tr><td>Penasehat Akademis</td><td>:</td><td><?php echo $bak['nm_ptk']; ?></td></tr>
						<tr><td>Fakultas</td><td>:</td><td><?php echo $fak['nm_lemb']; ?></td></tr>
						<tr><td>Semester</td><td>:</td><td><?php echo $getSmt; ?></td></tr>
						
					</table>
				</div>
				<div class="col-md-6">
					<table>
						<tr><td>NIM</td><td>:</td><td><?php echo $id_pd; ?></td></tr>
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
										<th>ID</th>
										<th>Kode MK</th>
										<th>Nama MK</th>
										<th width="70">SKS</th>
									   	<th width="50">Program</th>
										<th width="250">Nama Dosen</th>
										<th width="50">Nama Kelas</th>
										<th width="50">Kurikulum</th>
									</tr>
								</thead>
								<tbody>
									<?php 	$no = 1;
											$sks = 0;
											foreach ($nilai_dao as $data) {
									?>
									  <tr id="trow_1"><td class="text-center"><?php echo $no; ?></td>
										<td><?php echo $data['id_kls']; ?></td>	
										<td><?php echo $data['kode_mk']; ?></td>
										<td><?php echo $data['nm_mk']; ?></td>
										<td><?php echo $data['sks_mk']; ?></td>
										<td><?php echo $data['nm_jenj_didik']; ?></td>
										<td><?php echo $data['nm_ptk']; ?></td>
										<td><?php echo $data['nm_kls']; ?></td>
										<td><?php echo $data['nm_kurikulum_sp']; ?></td>

										<?php $sks = $sks + $data['sks_mk']; ?>
										
									  </tr>	
										
									  
									  <?php $no++;  } ?>
										<tr id="trow_1">
											<td colspan='3'>SKS Total</td>
											<td  colspan='5'><?php echo $sks; ?></td>
										</tr>
									  
								</tbody>
							</table>
				</div>
			</div>	
		</div>	
	</div>	
</div>	