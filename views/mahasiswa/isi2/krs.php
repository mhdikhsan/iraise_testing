<?php
//ID Mhs
	$id_pd=Yii::app()->session->get('username');
//Semester
	$smt=Yii::app()->session->get('semester');
	$getSmt=$_GET['semester'];
	$genap=false;
	$ganjil=false;
	//Semester Aktif
	$modelSmt=Semester::model()->findAll('a_periode_aktif=:a_periode_aktif',array(':a_periode_aktif'=>'1'));
	foreach($modelSmt as $db){}
	if(($db->smt)%2==0){$genap=true;}else{$ganjil=true;}
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
<h1>Mata Kuliah</h1>
<?php if(Yii::app()->user->hasFlash('flash')): ?>
	<div class="col-md-12">                        
		<form action="#" class="form-horizontal">
		 <div class="panel panel-default">
			<div class="panel-body"> 
					<h3><span class="fa fa-check-circle-o"></span> <?php echo Yii::app()->user->getFlash('flash'); ?></h3>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="col-md-12">                        
	<form action="#" class="form-horizontal">
     <div class="panel panel-default">
        <div class="panel-body"> 
			<h3><span class="fa fa-pencil"></span> Pilih Mata Kuliah - <?php echo $modelSms->nm_lemb;?> (<?php echo $modelNilai->totalKrsPreview($smt); ?>)</h3>
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
			<div class="row">          
				<div class="col-md-12">            
					<div class="form-group">
						<div class="col-md-12">
							<div class="row">
								<button class="btn btn-primary pull-right">Simpan </button>
								<?php echo CHtml::link('Preview KRS',array('matkul/preview'),array('class'=>'btn btn-default pull-right')); ?>
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
							<div class="panel-body">                          
								<div class="row">
									<!-- START DATATABLE -->
									<table class="table table-striped table-bordered bootstrap-datatable datatable">
										<thead>
											<tr class="success">
												<th>No</th>
												<th>Kode Mata Kuliah</th>
												<th>Nama Mata Kuliah</th>
												<th>SKS</th>
												<th>Nama Dosen</th>
												<th>Nama Kelas</th>
												<th>Hari</th>
												<th>Jam Mulai</th>
												<th>Kurikulum</th>
												<th>Syarat</th>
												<th>Kuota</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
									<?php
											$no=1;
											foreach($modelSearch->semester($getSmt)->getData() as $db)
											{
												//kuota
												$modelKuota=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$db->id_kls));
												//Kurikulum
												$modelKuri=MatkulKurikulum::model()->find('id_mk=:id_mk',array(':id_mk'=>$db->id_mk));
												echo '
												<tr>
													<td>'.$no.'</td>
													<td>'.$db->mk['kode_mk'].'</td>
													<td>'.$db->mk['nm_mk'].'</td>
													<td>'.$db->mk['sks_mk'].'</td>
													<td>'.$db->dosen2['nm_ptk'].'</td>
													<td>'.$db->nm_kls.'</td>
													<td>'.$db->hari['hari'].'</td>
													<td>'.$db->jadwal['jam_mulai'].'</td>
													<td>'.$modelKuri->kurikulumsp['nm_kurikulum_sp'].'</td>
													<td>'.$this->syarat($db).'</td>
													<td>'.count($modelKuota).'</td>
													<td>'.
													// $form->checkBox($modelSearch,'id_kls',array('value'=>$db->id_kls, 'uncheckValue'=>0)).
													Chtml::hiddenField('total',$no,array()).
													Chtml::hiddenField('isi'.$no,$db->id_kls,array())
													;
												if(($this->syarat2($db)==true)&&(count($modelKuota)<40)):
													echo CHtml::checkbox('id_kls'.$no,false,array('id'=>'checkbox_id','class'=>'checkbox_class'));
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
									<?php 
									// $this->widget('booster.widgets.TbGridView', array(
											// 'id'=>'Arsip',
											// 'selectableRows'=>2,
											// 'dataProvider'=>$modelSearch->semester($semester),
											// 'filter'=>$modelSearch,
											// 'columns'=>array(				
													// array('header'=>'No','value'=>'$row+1'), 
													// array('name'=>'kode_mk','value'=>'$data->mk->kode_mk'), 
													// array('name'=>'nm_mk','value'=>'$data->mk->nm_mk'), 
													// array('name'=>'sks_mk','value'=>'$data->mk->sks_mk'), 
													// 'dosen2.nm_ptk',
													// array(
														// 'header'=>'Syarat Mata Kuliah',
														// 'type'=>'raw',
														// 'value'=>array($this,'syarat2'),
													// ),
													// array('name'=>'nm_kls','value'=>'$data->nm_kls'), 
													// 'hari.hari',
													// 'jadwal.jam_mulai',
													// array('name'=>'nm_kurikulum','value'=>'$data->k->nm_kurikulum'),
													// array(
														// 'id'=>'id_kls',
														// 'value'=>'$data->id_kls',
														// 'class'=>'CCheckBoxColumn',
														// 'visible'=>array($this,'syarat2')=="hidden" ? true:false,
														// 'cssClassExpression'=>'hidden',
														// 'cssClassExpression'=>array($this,'syarat2'),
													// ),
											// ),
									// )); 
									// ?>
								</div>
							</div>		
						</div>
					</div>                    
				</div>
				
			</div>
		</div> 
	</div>
    </form>                                                    
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->