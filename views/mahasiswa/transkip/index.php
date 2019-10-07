<?php
$this->breadcrumbs=array(
	'Transkip',
	'Rekap Kartu Hasil Studi',
);
?>
<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-5">
			<h3 class="pull-left"><span class="fa fa-file"></span> REKAP KARTU HASIL STUDI</h3>
		</div>
	</div>
</div>
<div class="col-md-12">                        
	<form action="#" class="form-horizontal">
     <div class="panel panel-default">
        <div class="panel-body"> 
			<div class="col-md-12">
				
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
									<?php	$no=1; foreach($data as $data):
											echo "
													<tr>
														<td>$no</td>
														<td>$data[kode_mk]</td>
														<td>$data[nm_mk]</td>
														<td>$data[nilai_huruf]</td>
														<td>$data[nilai_indeks]</td>
														<td>$data[sks_mk]</td>
														<td>".number_format(($data['nilai_indeks']*$data['sks_mk']),2)."</td>
														<td>$data[semester]</td>
													</tr>";
										$no++; endForeach;
									?>
								</thead>
								<tbody>
				 </table>
				
			</div>
		</div> 
	</div>
                                                      
</div>

</div>