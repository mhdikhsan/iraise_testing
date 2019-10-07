<?php
$judul="Nilai Mata Kuliah";
$this->breadcrumbs=array(
	$judul,
);
//ID Mhs
	$id_ptk=Yii::app()->session->get('username');
	$modeldsn=Dosen::model()->findByPk($id_ptk,array('select'=>"nm_ptk,id_ptk"));
	// $id_nl=Yii::app()->session->get('kode_mk');
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
		<div class="col-md-12 col-xs-12">
			<h1><span class="fa fa-copy"></span> <?php echo $judul;?></h1>
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
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
			<div class="row">          
					
						
				<div class="page-content-wrap">
					<div class="row">
						<div class="col-md-12">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-2">
								<h4>Nama Dosen</h4>
							</div>
							<div class="col-md-10">
								<h4>: <?php 	 echo $modeldsn->nm_ptk; ?></h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<h4>NIP</h4>
							</div>
							<div class="col-md-10 col-xs-5">
								<h4>: <?php 	echo $id_ptk;?></h4>
							</div>
						</div>
					</div>
					<div class="col-md-4 pull-right">
						<?= CHtml::link(" - History Nilai", Yii::app()->createUrl(Yii::app()->request->baseUrl."/dosen/dosen/nilaiMatkulHistory",array()),array("class"=>"btn btn-primary fa fa-print pull-right","target"=>"_blank"));?>
					</div>
					<br>
					<hr>
					<!-- START DATATABLE -->
					<div class="col-md-12 col-xs-12">
					<table class="table table-striped table-bordered bootstrap-datatabl ">
						<thead>
							<tr class="success">
								<th>No</th>
								<th>Kode Mata Kuliah</th>
								<th>Nama Mata Kuliah</th>
								<th>Kelas</th>
								<th>SKS</th>
								<th>Semester</th>
								<th>Prodi</th>
								<th>Sudah disetujui / Peserta / Kuota</th>
								<th>Aksi</th>
								<th>Cetak</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1;foreach($model->tugas()->getData() as $db):
							$modelPeserta=Nilai::model()->findAll('id_kls=:id_kls',array(':id_kls'=>$db->id_kls));
							$modelAcc=Nilai::model()->findAll('id_kls=:id_kls AND acc_pa=:acc_pa',array(':id_kls'=>$db->id_kls,':acc_pa'=>'true'));
						?>
							<tr>
								<td><?php echo $no;?></td>
								<?php
								echo '
								<td>'.$db->mk['kode_mk'].'</td>
								<td>'.$db->mk['nm_mk'].'</td>
								<td>'.$db->kls['nm_kls'].'</td>
								<td>'.$db->mk['sks_mk'].'</td>
								<td>'.$db->mk['semester'].'</td>
								<td>'.$db->kls['id_sms'].'</td>
								<td>'.count($modelAcc).' / '.count($modelPeserta).' / '.$db->kls['kuota_pditt'].'</td>
								<td>';
								if(($db->fak['tgl_mulai_nilai']<=date('Y-m-d'))&&($db->fak['tgl_selesai_nilai']>=date('Y-m-d'))):
								echo 
									CHtml::link(" Isi Nilai", Yii::app()->createUrl("dosen/dosen/nilaiMhs",array("id"=>$db->id_kls)),array("class"=>"btn btn-success fa fa-edit")).
									CHtml::link(" Unduh", Yii::app()->createUrl("dosen/dosen/exportexcel/",array("id_kls"=>$db->id_kls)),array("class"=>"btn btn-primary fa fa-download pull-right"))
								;
								elseif(date('Y-m-d')<$db->fak['tgl_mulai_nilai']):
									echo'Jadwal Isi Nilai Belum Mulai';
								elseif($db->fak['tgl_selesai_nilai']<date('Y-m-d')):
									echo'Jadwal Isi Nilai Sudah Tutup';
								endif;
								echo '
								</td>
								'; 
								echo '<td>'.
									CHtml::link("Cetak", Yii::app()->createUrl("dosen/dosen/nilaiMhsCetakP",array("id"=>$db->id_kls)),array("class"=>"btn btn-success fa fa-edit","target"=>"_blank"))
									
									.'</td>';
								
								
								?>
							</tr>
							<?php $no++;endforeach;?>
							
							
							<?php $no=1;foreach($model->tugasDispensasi()->getData() as $db):?>
							<tr>
								<td><?php echo $no;?></td>
								<?php
								echo '
								<td>'.$db->mk['kode_mk'].'</td>
								<td>'.$db->mk['nm_mk'].'</td>
								<td>'.$db->kls['nm_kls'].'</td>
								<td>'.$db->mk['sks_mk'].'</td>
								<td>'.$db->mk['semester'].'</td>
								<td>'.$db->kls['id_sms'].'</td>
								<td>';
								echo 
									CHtml::link(" Isi Nilai", Yii::app()->createUrl("dosen/dosen/nilaiMhs",array("id"=>$db->id_kls)),array("class"=>"btn btn-success fa fa-edit")).
									CHtml::link(" Unduh", Yii::app()->createUrl("dosen/dosen/exportexcel/",array("id_kls"=>$db->id_kls)),array("class"=>"btn btn-primary fa fa-download pull-right"))
								;
								
								echo '
								</td>
								'; 
								echo '<td>'.
									CHtml::link("Cetak", Yii::app()->createUrl("dosen/dosen/nilaiMhsCetakP",array("id"=>$db->id_kls)),array("class"=>"btn btn-success fa fa-edit","target"=>"_blank"))
									
									.'</td>
								<td>'.$db->tgl_dispensasi.'</td>';
								
								
								?>
								<?php $no++;endforeach;?>
							</tr>
						</tbody>
					</table>
					</div>
					<!-- END DATATABLE -->
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