<?php
//Breadcrumbs
$judul='Kurikulum';
$this->breadcrumbs=array(
	$judul,
);
?>
<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'mahasiswa-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>	
	<?php echo $form->errorSummary($model); ?>
	<div class="col-md-12">            
		<div class="form-group">
			<div class="col-md-12 col-xs-5">
				<h1 class="pull-left"><span class="fa fa-file"></span> <?= $judul; ?> <small>Pilih <?= $judul; ?> anda</small></h1>
			</div>
		</div>
	</div>
	<?php if(Yii::app()->user->hasFlash('flash')): ?>
		<div class="col-md-12">                        
			<form action="#" class="form-horizontal">
			 <div class="panel panel-default">
				<div class="panel-body"> 
						<?php echo Yii::app()->user->getFlash('flash'); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="col-md-12">                        
		<form action="#" class="form-horizontal">
		 <div class="panel panel-default">
			<div class="panel-body"> 
				<div class="col-md-12">
					<div class="panel panel-default tabs">
						<ul class="nav nav-tabs" role="tablist">
							<?php $active="active";foreach($modelKur as $db):?>
								<li class="<?= $active; ?>"><a href="#tab<?= $db->nm_kurikulum_sp; ?>" role="tab" data-toggle="tab">Kurikulum <?= $db->nm_kurikulum_sp; ?></a></li>
								<?php $active=""; ?>
							<?php endforeach;?>
							
						</ul>
						<div class="panel-body tab-content">
							<?php $active="active";foreach($modelKur as $dbkur):?>
								<div class="tab-pane <?= $active; ?>" id="tab<?= $dbkur->nm_kurikulum_sp; ?>">
									<div class="panel-body">
										<p align="center"><i>Berikut adalah data kurikulum tahun <b><i><?= $dbkur->nm_kurikulum_sp; ?></i></b> anda.</i></p>
										<?php 
											for($i=1;$i<=8;$i++): 
											$sks_tot=0;
											$sks_ambil=0;
											$mk_tot=0;
											$mk_ambil=0;
										?>
											<div class="row col-md-12">
												<hr>
												<h4><b>Semester <?= $i ?></b> <i><small>Kurikulum <?= $dbkur->nm_kurikulum_sp; ?></small></i></h4>
												<table class="table datatable">
													<thead>
														<tr class="primary">
															<th>No</th>
															<th>Kode Mata Kuliah</th>
															<th>Nama Mata Kuliah</th>
															<!--th>Kurikulum</th>
															<th>Semester</th-->
															<th>Sks</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$no=1;
													foreach($model->kurikulum($dbkur->nm_kurikulum_sp,$i)->getData() as $db)
													{	
														echo '
														<tr class="'.($db->ambil==$user?"danger":"").'">
															<td>'.$no.'</td>
															<td>'.$db->kode_mk.'</td>
															<td>'.$db->nm_mk.'</td>
															';
															// <td>'.$db['kurikulum2']['nm_kurikulum_sp'].'</td>
															// <td><p class="btn btn-default">Semester-'.$db->semester.'</p></td>
															echo '
															<td><p class="btn btn-default">'.$db->sks_mk.'</p></td>
															<td><p class="btn btn-default col-md-12">'.($db->ambil==$user?"Sudah Ambil":"-").'</p></td>
														</tr>
														';
														$no++;
														$sks_tot+=$db->sks_mk;
														$mk_tot++;
														if($db->ambil==$user)
														{
															$sks_ambil+=$db->sks_mk;
															$mk_ambil++;
														}
													}
													?>
													</tbody>
												</table>
												<p class="btn btn-info"><i>Jumlah SKS Total : <b class="btn btn-default"><?= $sks_tot ?></b> SKS dari <b class="btn btn-default"><?= $mk_tot ?></b> Mata Kuliah</i></p>
												<p class="btn btn-success"><i>Jumlah SKS sudah diambil : <b class="btn btn-default"><?= $sks_ambil ?></b> SKS dari <b class="btn btn-default"><?= $mk_ambil ?></b> Mata Kuliah</i> </p>
												<p class="btn btn-warning"><i>Belum ambil <b class="btn btn-default"><?= ($mk_tot-$mk_ambil) ?></b> Mata Kuliah</i> </p>
											</div>
										<?php endfor; ?>
										<?php 
											$sks_tot=0;
											$sks_ambil=0;
											$mk_tot=0;
											$mk_ambil=0;
										?>
										<div class="row col-md-12">
											<hr>
											<h4><b>Mata Kuliah Pilihan</b> <i><small>Kurikulum <?= $dbkur->nm_kurikulum_sp; ?></small></i></h4>
											<table class="table datatable">
												<thead>
													<tr class="primary">
														<th>No</th>
														<th>Kode Mata Kuliah</th>
														<th>Nama Mata Kuliah</th>
														<!--th>Kurikulum</th>
														<th>Semester</th-->
														<th>Sks</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
												<?php
												$no=1;
												foreach($model->kurikulum($dbkur->nm_kurikulum_sp,0)->getData() as $db)
												{	
													echo '
													<tr class="'.($db->ambil==$user?"danger":"").'">
														<td>'.$no.'</td>
														<td>'.$db->kode_mk.'</td>
														<td>'.$db->nm_mk.'</td>
														';
														// <td>'.$db['kurikulum2']['nm_kurikulum_sp'].'</td>
														// <td><p class="btn btn-default">Semester-'.$db->semester.'</p></td>
														echo '
														<td><p class="btn btn-default">'.$db->sks_mk.'</p></td>
														<td><p class="btn btn-default col-md-12">'.($db->ambil==$user?"Sudah Ambil":"-").'</p></td>
													</tr>
													';
													$no++;
													$sks_tot+=$db->sks_mk;
													$mk_tot++;
													if($db->ambil==$user)
													{
														$sks_ambil+=$db->sks_mk;
														$mk_ambil++;
													}
												}
												?>
												</tbody>
											</table>
											<p class="btn btn-info"><i>Jumlah SKS Total : <b class="btn btn-default"><?= $sks_tot ?></b> SKS dari <b class="btn btn-default"><?= $mk_tot ?></b> Mata Kuliah</i></p>
											<p class="btn btn-success"><i>Jumlah SKS sudah diambil : <b class="btn btn-default"><?= $sks_ambil ?></b> SKS dari <b class="btn btn-default"><?= $mk_ambil ?></b> Mata Kuliah</i> </p>
											<p class="btn btn-warning"><i>Belum ambil <b class="btn btn-default"><?= ($mk_tot-$mk_ambil) ?></b> Mata Kuliah</i> </p>
										</div>
										
									</div>					 
								</div>
								<?php $active=""; ?>
							<?php endforeach;?>
						</div>
					</div><!-- /tabs-->
					
				</div >
							
			</div> 
		</div>
		</form>                                                    
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->