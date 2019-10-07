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
	$sql_nilai="select n.id_kls, m.kode_mk,m.nm_mk,m.sks_mk,n.nilai_indeks,n.nilai_huruf from nilai as n
			JOIN kelas_kuliah as k ON k.id_kls=n.id_kls
			JOIN matkul as m ON m.id_mk=k.id_mk
			
		where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND n.acc_pa='true' order by m.nm_mk";
		// where n.id_reg_pd LIKE :id_pd AND n.semester LIKE :semester AND n.acc_pa='true' AND n.nilai_huruf!='' order by m.nm_mk";
		
	$nilai_dao = $c->createCommand($sql_nilai);
	$nilai_dao->bindParam(":id_pd", $id_pd, PDO::PARAM_STR);
	$nilai_dao->bindParam(":semester", $getSmt, PDO::PARAM_STR);
	$nilai_dao = $nilai_dao->queryAll();
	
	
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
	$tahunajaran->bindParam(":smt", $getSmt, PDO::PARAM_STR);
	$tahunajaran= $tahunajaran->queryRow();


		
	
	
	


?>

<div class="col-md-12">                        
	   <div class="panel panel-default">
	    <div class="panel-heading">
			<div class="btn-group pull-left">
				<h4><span class="fa fa-paste"></span> Kartu Hasil Studi</h4>
			</div>
            <div class="btn-group pull-right">
				<?php  CHtml::link('<i class="fa fa-print"></i> Cetak KHS','khs/cetak/semester/'.$getSmt,array('class'=>'btn btn-primary pull-right','target'=>'_blank')); ?>
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
										<th width="70">NILAI (N)</th>
										<th width="70">BOBOT</th>
										<th width="70">SKS</th>
									   	<th width="50">	NM(N X K)</th>
										<th width="80">KET</th>
										
									</tr>
								</thead>
								<tbody>
									<?php 	$no = 1;
											$sks = 0;
											$nm = 0;
											foreach ($nilai_dao as $data) {
									?>
									  <tr id="trow_1">
										<td class="text-center"><?php echo $no; ?></td>
										<td><?php echo $data['id_kls']; ?></td>	
										<td><?php echo $data['kode_mk']; ?></td>
										<td><?php echo $data['nm_mk']; ?></td>
										<td><?php echo $data['nilai_huruf']; ?></td>
										<td><?php echo $data['nilai_indeks']; ?></td>
										<td><?php echo $data['sks_mk']; ?></td>
										<td><?php echo $data['sks_mk']*$data['nilai_indeks']; ?></td>
										<td></td>

										<?php $sks = $sks + $data['sks_mk']; ?>
										<?php $nm = $nm + ($data['sks_mk']*$data['nilai_indeks']); ?>
										
									  </tr>	
									
									  
									  <?php $no++;  } ?>
										<tr style="margin-bottom:10px;border:1px #eee solid;">
											<td colspan='6'>Total</td>
											<td><?php echo $sks; ?></td>
											<td><?php echo $nm; ?></td>
											<td>IP : <?php echo $ip = number_format(@(@$nm/@$sks),2); ?></td>
										</tr>
									  
								</tbody>	
							</table>
				</div>
			</div>	
		</div>	
	</div>	
</div>	
<?php 
	//sks_tot
	$sks_tot =Yii::app()->db->createCommand("
						select  sum(sks_mk) as sks_mk,sum(x_sks) as  x_sks from 
						(SELECT max(n.nilai_indeks)as nilai_indeks , m.sks_mk as sks_mk,(max(n.nilai_indeks) * m.sks_mk) as x_sks FROM `nilai` as n
							left join kelas_kuliah as kk on kk.id_kls=n.id_kls
							left join matkul as m on m.id_mk=kk.id_mk
						where n.id_reg_pd LIKE :id_pd and n.nilai_huruf!='' and (n.semester BETWEEN 0 AND $getSmt)
						group by m.kode_mk) t
						")
						->bindParam(":id_pd", $id_pd, PDO::PARAM_STR)
						//->bindParam(":semester", $getSmt, PDO::PARAM_STR)
						->queryRow();
	//var_dump($sks_tot['sks_mk']);die();
	/*
	$modelkm =KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester AND paket=:paket',array(':id_reg_pd'=>$id_pd,'semester'=>$getSmt, ':paket'=>'0'));
	if(isset($modelkm))
	{
		// $modelkm->sks_total=$sks_tot['sks_mk'];
		$modelkm->ipk=@(number_format(@$sks_tot['x_sks']/@$sks_tot['sks_mk'],2));
		$modelkm->ips=$ip;
		$modelkm->sks_smt=$sks;
		// $modelkm->save();
	}else{ //paket 1
		$sks=12;
	}
	*/
	
	// echo $sks.'<br>';
	$modelkm =KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester',array(':id_reg_pd'=>$id_pd,'semester'=>$getSmt));
	if(isset($modelkm))
	{
		$modelkm->ipk=@(number_format(@$sks_tot['x_sks']/@$sks_tot['sks_mk'],2));
		$modelkm->ips=$ip;
		$modelkm->sks_smt=$sks;
		$modelkm->save();
		//konversi ke sks
		$ip=$modelkm->ips;
		if($ip>=3)
		{
			$sks=24;
		}else
		if(($ip>=2.50)&&($ip<3))
		{
			$sks=21;
		}else
		if(($ip>=2.00)&&($ip<2.50))
		{
			$sks=18;
		}else
		if(($ip>=1.50)&&($ip<2))
		{
			$sks=15;
		}else
		if($ip<1.50)
		{
			$sks=12;
		}
		// echo $ip.'<br>';
	}else{ //paket 1
		$sks=12;
	}
	//semester depan 2016-02-26 by yura
	// echo $sks.'<br>';
	// echo $getSmt.'<br>';
	$getSmt++;
	// echo $getSmt.'<br>';
	$modelkm2 =KuliahMhs::model()->find('id_reg_pd=:id_reg_pd AND semester=:semester AND paket=:paket',array(':id_reg_pd'=>$id_pd,'semester'=>$getSmt, ':paket'=>'0'));
	if(isset($modelkm2)){
		// echo $modelkm2->sks_total.'<br>';
		$modelkm2->sks_total=$sks;
		$modelkm2->save();
		// echo $modelkm2->sks_total.'<br>';
	}
?>
