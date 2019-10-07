<?php
use yii\helpers\Html;
//Semester
	$smt=Yii::app()->session->get('semester');
	$getSmt=$semester;
	$genap=false;
	$ganjil=false;
	//Semester Aktif
	$modelSmt=Semester::model()->findAll('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
	foreach($modelSmt as $db){}
	if(($db->smt)%2==0){$genap=true;}else{$ganjil=true;}
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>	
<?php if(Yii::app()->user->hasFlash('flash')): ?>
	<div class="col-md-12">                        
		<form action="#" class="form-horizontal">
		<audio autoplay>
			<source src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/audio/sweeper.mp3" type="audio/mpeg">
		</audio>
		<div class="alert alert-success"> 
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<strong> 			
				<h2 style="color:#fff;"><span class="fa fa-check-circle-o"></span> <?php echo Yii::app()->user->getFlash('flash'); ?></h2>
			</strong>
		</div>
	</div>
<?php endif; ?>
<div class="col-md-12">
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<strong> 
				<h1 style="color:#fff;float:left;">
					<span class="fa fa-exclamation-circle"></span>
				</h1> <br>&nbsp;&nbsp;&nbsp;
				Di Himbau kepada seluruh mahasiswa yang ingin menghubungi Dosen PA terkait persetujuan KRS, agar menghubungi Dosen PA di jam kerja jam 8.00-16.00
			</strong>
	</div>
</div>
<div class="col-md-12">                        
     <div class="panel panel-defaultx">
        <div class="panel-body"> 
			<h4>
				<span class="fa fa-pencil"></span> Pilih Mata Kuliah - <?php echo $jurusan;?> (<?php echo $sks_ambil; ?> dari <?php echo $sks_max;?>)  -   Batas Pengisian KRS sampai tanggal <?php echo date('d/m/Y',strtotime($tanggal_selesai));?>
			</h4>
			
			<div class="row">          
				<div class="col-md-12">            
					<div class="form-group">
						<div class="col-md-12">
							<div class="row">
								<button class="btn btn-primary pull-right"><span class="fa fa-save"></span> Simpan </button>
								<?php echo CHtml::link('<span class="fa fa-file-text-o"></span> Lihat KRS',array('matkul/preview'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
								<?php echo CHtml::link('<span class="fa fa-file-text-o"></span> Kurikulum',array('tugas/kurikulum'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
							</div>
						</div>
					</div>
				</div>
						
				<div class="page-content-wrap">
					<div class="row">
						<div class="col-md-12">
							<?php
							if($ganjil)
							{
								echo CHtml::link('Semester 1',array('isi/krs/semester/1'),array('class'=>'btn btn-default pull-left'));
							}else{
								echo CHtml::link('Semester 2',array('isi/krs/semester/2'),array('class'=>'btn btn-default pull-left'));
							}
							for($i=3;$i<=8;$i++)
							{
								$active1="";
								$active2="";
								if($genap)
								{
									$active2="active";
									if($i%2==0)
									{
										echo CHtml::link('Semester '.$i,array('isi/krs/semester/'.$i),array('class'=>'btn btn-default pull-left'));
									}
								}else{
									$active1="active";
									if($i%2!=0)
									{
										echo CHtml::link('Semester '.$i,array('isi/krs/semester/'.$i),array('class'=>'btn btn-default pull-left'));
									}
								}
							}
								echo CHtml::link('Pilihan',array('isi/krs/semester/0'),array('class'=>'btn btn-default pull-left'));
							?>
							<br>
							<hr>
							<div class="panel-bodyx">                          
								<div class="row table-responsive">
									<!-- START DATATABLE -->
									<table class="table table-stripedx table-bordered bootstrap-datatable datatablex">
										<thead>
											<tr class="success">
												<th>No</th>
												<th>Kode MK</th>
												<th>Nama Mata Kuliah-Kelas</th>
												<th>SKS</th>
												<th>Nama Dosen</th>
												<th>Hari-Ruang</th>
												<th>Jam</th>
												<th>Kurikulum</th>
												<th>Syarat</th>
												<th>Peserta</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
									<?php
											$no=1;
											foreach($modelKelas as $db)
											{
												echo '
												<tr style="background:white;">
													<td>'.$no.'</td>
													<td><a href="https://iraise.uin-suska.ac.id/mahasiswav2/tugas/milis/smt/1/id/'.$db['id_kls'].'" class="btn btn-info btn-xs">'.$db['kode_mk'].'</a></td>
													<td>'.$db['nm_mk'].' - '.$db['nm_kls'].'</td>
													<td>'.$db['sks_mk'].'</td>
													<td>'.$db['nm_ptk'].'</td>
													<td>'.$db['hari'].' - '.$db['kode_ruangan'].'</td>
													<td>'.$db['jam_mulai'].' - '.$db['jam_selesai'].'</td>
													<td>'.$db['kurikulum'].'</td>
													<td>'.$this->syarat($db).'</td>
													<td>'.$db['kuota'].'/'.$db['kuota_pditt'].'</td>
													<td>'.
													Chtml::hiddenField('total',$no,array()).
													Chtml::hiddenField('isi'.$no,$db['id_kls'],array())
													;
													if(($this->syarat2($db)==true)&&($db['kuota']<$db['kuota_pditt'])):
														echo CHtml::checkbox('id_kls'.$no,false,array('id'=>'checkbox_id','class'=>'checkbox_class'));
													elseif($db['kuota']>=$db['kuota_pditt']):
														echo '<p style="color:red;">Kelas Penuh</p>';
													elseif($this->syarat2($db)==false):
														echo '<p style="color:red;">Syarat Tidak Terpenuhi</p>';
													endif;
													echo
													'</td>
												</tr>
												';
												$no++;
											}
									echo '
											</tbody>
										</table>
										<!-- END DATATABLE -->
									';
									?>
									
								</div>
							</div>		
						</div>
					</div>                    
				</div>
				
			</div>
		</div> 
	</div>                                              
</div>
<?php $this->endWidget(); ?>