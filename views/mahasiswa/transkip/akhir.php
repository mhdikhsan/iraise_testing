<?php
$this->breadcrumbs=array(
	'Transkip',
	'Nilai Akhir',
);
$sum_sks2 =0;
$sum_tot2=0;
?>

<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-12">
			<h3 class="pull-left"><span class="fa fa-file"></span> TRANSKIP NILAI AKHIR</h3>
			<br>
		</div>
	</div>
</div>
<div class="col-md-12">                        
	 <div class="panel panel-default">
        <div class="panel-body"> 
			<div class="">
				<div class="col-md-7">
					<h5><div class="col-md-2 col-xs-5"  style="float:left;">NAMA</div> : <?php echo $mhs['nm_pd'];?> </h5>
					<h5><div class="col-md-2 col-xs-5"  style="float:left;">NIM</div>  : <?php echo $mhs['id_pd'];?></h5>
				</div>
				<div class="col-md-5">
					<h5><div class="col-md-4 col-xs-5"  style="float:left;">FAKULTAS</div> : <?php echo $fak->nm_lemb;?></h5>
					<h5><div class="col-md-4 col-xs-5"  style="float:left;">PROG.STUDI</div> : <?php echo $mhs['nm_lemb'];?> </h5>
				</div>
			</div>
			<div class="row">
						
				<div class="page-content-wrap  table-responsive">
					<div class="row">
					
						
							
							<!-- START DATATABLE EXPORT -->
                            <table class="table table-bordered">
								<thead>
									<tr class="success">
										<th style="width:4%;">No</th>
										<th style="width:20%;">Kode</th>
										<th style="width:50%;">Nama Mata Kuliah</th>
										<th style="width:4%;">N</th>
										<th style="width:4%;">B</th>
										<th style="width:4%;">K</th>
										<th style="width:4%;">NM</th>
										<th style="width:10%;">KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i=1; $i<=8; $i++){
												if($i==1){
													$dat = $mhs_smt1;
												}
												else if($i==2){
													$dat = $mhs_smt2;
												}
												else if($i==3){
													$dat = $mhs_smt3;
												}
												else if($i==4){
													$dat = $mhs_smt4;
												}
												else if($i==5){
													$dat = $mhs_smt5;
												}
												else if($i==6){
													$dat = $mhs_smt6;
												}
												else if($i==7){
													$dat = $mhs_smt7;
												}
												else if($i==8){
													$dat = $mhs_smt8;
												}
											if(!empty($dat)){
												echo "<tr>
													<td colspan='8'>Semester : $i</td>
													</td>
												</tr>";
												$sum_tot =0;
												$sum_sks =0;
												$no_smt=1; foreach ($dat as $data):
												echo "<tr>
														<td style='width:4%;'>$no_smt</td>
														<td style='width:20%'>$data[kode_mk]</td>
														<td style='width:50%'>$data[nm_mk]</td>
														<td style='width:4%;'>$data[nilai_huruf]</td>
														<td style='width:4%;'>$data[nilai_indeks]</td>
														<td style='width:4%;'>$data[sks_mk]</td>
														<td style='width:4%;'>".number_format(($data['nilai_indeks']*$data['sks_mk']),2)."</td>
														<td style='width:10%;'></td>
													  </tr>";
												$sum_tot = $sum_tot + ($data['nilai_indeks']*$data['sks_mk']);
												$sum_tot2 = $sum_tot2 + ($data['nilai_indeks']*$data['sks_mk']);
												$sum_sks = $sum_sks + $data['sks_mk'];
												$sum_sks2 = $sum_sks2 + $data['sks_mk'];
												$no_smt++; endForeach; 
										
												echo "<tr class='success'>
													<td colspan='5'>JUMLAH</td>
													<td></td>
													<td>".number_format($sum_tot,2)."</td>
													<td> IP: ".number_format(@$sum_tot/@$sum_sks,2)."</td>
												</tr>";
											}
									}
										?>
										
										
							
									</tbody>
								</table>                                    
								<table class="table table-bordered">
									<tbody>
										<tr class="info">
											<td colspan="7">NILAI MUTU KUMULATIF</td>
											<td width="10%"><?php echo $nm = number_format($sum_tot2,2);?></td>
										</tr>
										<tr class="info">
											<td colspan="7">KREDIT KUMULATIF</td>
											<td width="10%"><?php echo  $sks =$sum_sks2; ?></td>
										</tr>
										<tr class="info">
											<td colspan="7">INDEKS PRESTASI KUMULATIF</td>
											<td width="10%"><?php  echo $ipk =  number_format(@$nm/$sks,2);?></td>
										</tr>
									</tbody>
								</table>
							<?php
								$ipkk = KuliahMhs::model()->findByAttributes(array('id_reg_pd'=>$id_reg_pd,'id_smt'=>$id_smt));
								$ipkk->ipk =  $ipk;
								$ipkk->save();
							?>
					</div>
					
				</div>
				
			</div>
		</div> 
	</div>
                                                    
</div>
