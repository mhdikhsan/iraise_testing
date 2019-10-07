<?php
//Data Kelas

	$nim=Yii::app()->session->get('username');
	// $modelKls=KelasKuliah::model()->findByPk($id_kls);
//Breadcrumbs
$judul='Lapor';
$this->breadcrumbs=array(
	$judul=>'Lapor',
	
);
?>

	<link href="<?php  echo Yii::app()->request->baseUrl; ?>/themes/admin/css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="<?php  echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.cssemoticons.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.text').emoticonize({
				//delay: 800,
				//animate: false,
				//exclude: 'pre, code, .no-emoticons'
			});
		
		})
	</script>

<style type="text/css">
		.text { font-size: 12px; }
		
	</style>
<div class="form">

<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-5">
			
			<br>
			<?php //echo CHtml::link('Upload Materi/Tugas',Yii::app()->createUrl("dosen/tugas/create",array('id'=>$id_kls)),array('class'=>'btn btn-primary pull-right')); ?>
		</div>
	</div>
</div>
<?php if(Yii::app()->user->hasFlash('flash')): ?>
	<div class="col-md-12">                      
		 <div class="panel panel-default">
			<div class="panel-body"> 
					<h4 style="color:red"><?php echo Yii::app()->user->getFlash('flash'); ?> </h4>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="col-md-12">
     <div class="panel panel-default">
        <div class="panel-body"> 

			<div class="row bg-info">
			
				<div class="col-md-12">
				<br>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/c3.jpg" alt="C3 PTIPD" style ="width:30%; float:right" />	
					<div class="panel panel-default tabs">
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#tab1" role="tab" data-toggle="tab">Lapor Permasalahan</a></li>
							<li class=""><a href="#tab2" role="tab" data-toggle="tab">Riwayat Lapor</a></li>
						</ul>
						

							

						<div class="panel-body tab-content">
							<div class="tab-pane active" id="tab1">
								<div class="panel-body"> 
							
									<div class="row">
										<div class="panel panel-default push-up-10">
										
											<div class="panel-body panel-body-search">
											<?php if ($model->tanggal) { ?>
												<table class="table">
													<tr>
														<td style="color:steelblue">
															<b> NOMOR TIKET </b></td>
														<td>:</td>
														<td style="color:steelblue">M<?= substr($model->tanggal,2,2) . substr($model->tanggal,5,2). $model->id_c3_pd  ?> </td>
													</tr>

													<tr>
														<td style="color:steelblue"><b>TANGGAL</b></td>
														<td>:</td>						
														<td style="color:steelblue"><?= $model->tanggal ?></td>
													</tr>
													<tr>
														<td style="color:steelblue"><b>URAIAN PERMASALAHAN</b></td>
														<td>:</td>													
														<td style="color:steelblue"><?=$model->masalah;?></td>
													</tr>
												</table>
											
											
											<?php 
											}
												$x=1;
												if (isset($model->masalah)) {
													
													echo "<table>
															<tr>
																<td>
																	
																</td>
															</tr>
														 </table>";
													
												}
											
												?>
												<hr>
												
												<?php if (isset($model->username)) { ?>
												<h5 style="color:#990000"><b> T R A C E </b></h5>
												<table class="table table-bordered">
												<tr>
													<td style="color:steelblue">No </td>
													<td style="color:steelblue">TANGGAL </td>
													<td style="color:steelblue"> PENGIRIM</td>
													<td style="color:steelblue"> URAIAN </td>
												</tr>
												
													
														<tr>
															<td style="color:steelblue">1 </td>
															<td style="color:steelblue"><?= $model->tanggal ?></td>
															<td style="color:steelblue">Costumer Care Center</td>
															<td style="color:steelblue"> Laporan diterima Costumer Care Center</td>
														</tr>												
													
												
												<?php
												$x=2;
												
													foreach ($loadhistory as $his)
													{
														echo '<tr>
																<td style="color:steelblue">'.$x.'</td>
																<td style="color:steelblue">'.$his['tgl'].'</td>
																<td style="color:steelblue">'.$his->namapegawai($his['username']).'</td>
																<td style="color:steelblue">'.$his['uraian'].'</td>	
															</tr>';
															$x++;
													}
												?> 
												
												</table>
												
												<?php } ?>
												
												<form method="POST" action="">
												<div class="input-group">

													<input type="text" name="masalah" placeholder="Laporkan Permasalahan iRaise Anda dengan Singkat dan Jelas" class="form-control">
													<div class="input-group-btn">
														<button class="btn btn-default">Kirim</button>
													</div>
												</div>
												<p class="text" id="regular">
													
												</p>
												</form>
												
												
																		
												
												
											</div>
										</div>
									</div><!-- endif row-->
								</div>					 
							</div>
							
							
							<div class="tab-pane" id="tab2">
								<div class="panel-body">                          
									<div class="table-responsive">
										<table class="table table-striped table-actions datatable">
											<thead>
												<tr>
													
													<th>No Tiket</th>
													<th>Tanggal</th>
													<th>Uraian</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$y=1;
												$status = "Belum Selesai";
												if (count($modelall)>0) {
													foreach ($modelall as $dt) {
														if ($dt['status']=='1') $status="Selesai";
															echo "<tr>
																		
																		<td style='color:steelblue'>M".substr($dt['tanggal'],2,2) . substr($dt['tanggal'],5,2). $dt['id_c3_pd'] ."</td>
																		<td style='color:steelblue'>$dt[tanggal]</td>
																		<td style='color:steelblue'>$dt[masalah]</td>
																		<td style='color:steelblue'>$status</td>
																</tr>";
														
														$history = C3History::model()->findAll('id_c3data =:id_c3data',array("id_c3data"=>$dt['id_c3_pd']));
														
														foreach ($history as $h) {
															echo "<tr>
																		
																		<td style='color:steelblue'>M".substr($dt['tanggal'],2,2) . substr($dt['tanggal'],5,2). $dt['id_c3_pd'] ."</td>
																		<td style='color:steelblue'>$h[tgl]</td>
																		<td style='color:steelblue'>-- $h[uraian]</td>
																		<td style='color:steelblue'></td>
																</tr>";															
														}
													$y++;	
													}
											
												}
												
												?>
											</tbody>
										</table>
									</div>
									<!-- END Table -->
								</div>					 
							</div>

						</div>		
					</div>         
				</div>
			</div>                    
				
		</div> 
	</div>
</div>

</div><!-- form -->