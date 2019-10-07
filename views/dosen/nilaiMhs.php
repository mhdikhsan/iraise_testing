<script type="text/javascript"> 
	function stopRKey(evt) { 
	  var evt = (evt) ? evt : ((event) ? event : null); 
	  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
	  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 
	document.onkeypress = stopRKey; 
</script>
<?php
$judul="Nilai Mahasiswa";
$this->breadcrumbs=array(
	'Nilai Mata Kuliah'=>array('nilaiMatkul'),
	$judul,
);
//ID Mhs
	$id_ptk=Yii::app()->session->get('username');
	$modeldsn=Dosen::model()->findByPk($id_ptk,array('select'=>"nm_ptk,id_ptk"));
	$id_kls=$_GET['id'];
	$modelKls=KelasKuliah::model()->findByPk($id_kls);
?>
<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
	'enableAjaxValidation'=>false,
)); ?>	
<?php echo $form->errorSummary($model); ?>
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
	<div class="form-group">
		<div class="col-md-12 col-xs-5">
			<h1 class="pull-left"><span class="fa fa-copy"></span> <?php echo $judul;?></h1>
			<br/>
			
			<?php echo CHtml::link('Cetak Nilai (P)',array('nilaiMhsCetakP','id'=>$id_kls),array('class'=>'btn btn-primary pull-right','target'=>'_blank')); ?>
			
			<?php echo CHtml::link('Cetak Nilai (L)',array('nilaiMhsCetak','id'=>$id_kls),array('class'=>'btn btn-primary pull-right','target'=>'_blank','style'=>'margin-right:10px;')); ?>
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
			
			<div width="100%" class="row">
				<?php if(isset($modeldsn->nm_ptk)){?>
				<div style="float:left;padding-right:3px;">
					<h5>Nama </h5>
					<h5>NIP </h5>
				</div>
				<div style="float:left;">
					<h5> : <?php echo $modeldsn->nm_ptk; ?> </h5>
					<h5> : <?php echo $id_ptk; ?> </h5>
				</div>
				<?php } ?>
				<div style="float:right;margin-right:50px;">
					<h5>: <?php echo $modelKls->mk->nm_mk;?></h5>
					<h5>: <?php echo $modelKls->nm_kls;?></h5>
					
					</div>
				<div style="float:right;padding-right:3px;margin-right:50px;">
					<h5>Mata Kuliah</h5>
					<h5>Kelas </h5>
				</div>
			</div>
			<hr>
			<!-- START DATATABLE -->
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="success">
						<th>Bobot Mandiri (%)</th>
						<th>Bobot Terstruktur (%)</th>
						<th>Bobot UTS (%)</th>
						<th>Bobot UAS (%)</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				echo'
					<tr>
						<td>'.$form->textField($modelBD,'bobot_tugas',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Nilai Tugas" )).'</td>
						<td>'.$form->textField($modelBD,'bobot_quiz',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Nilai Quiz" )).'</td>
						<td>'.$form->textField($modelBD,'bobot_mid',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Nilai Mid" )).'</td>
						<td>'.$form->textField($modelBD,'bobot_uas',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>"Nilai Uas" )).'</td>
						<td>'.CHtml::submitButton($model->isNewRecord ? 'Simpan Bobot' : 'Simpan Bobot',array('class'=>'btn btn-primary','style'=>'margin-left:3%; margin-top:3%')).'
						</td>
					</tr>
				';
				?>
				</tbody>
			</table>
			<hr>
			<?php $this->endWidget(); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'mahasiswa-form',
				'enableAjaxValidation'=>false,
			)); ?>	
			<div style="color:red;"><?php echo $form->errorSummary($model); ?></div>
			<div class="row">
				<div class="page-content-wrap">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal">
							<div class="">
								<div class="">
									<div class="tab-pane active" id="tab1">
										<div class="panel-body">                          
											<div class="row">
												<?php $no=1;$this->widget('booster.widgets.TbGridView', array(
														'id'=>'Arsip',
														'selectableRows'=>2,
														'dataProvider'=>$model->nilaiMhs($id_kls),
														'filter'=>$model,
														'columns'=>array(	
																array('header'=>'No','value'=>'$row+1','type'=>'raw'), 
																array('name'=>'id_reg_pd','value'=>'$data->id_reg_pd'), 
																'mhs.nm_pd',
																array( //TextBox --- Displays quantity
																	'header'=>'Nilai Tugas Mandiri',
																	'id'=>'nilai_tugas',
																	'value'=>'CHtml::textField("nilai_tugas[$data->id_nilai]",$data->nilai_tugas,array("style"=>"width:50px;","class"=>"form-control"))',
																	'type'=>'raw',
																	'htmlOptions'=>array('width'=>'40px'),
																),
																array( //TextBox --- Displays quantity
																	'header'=>'Nilai Tugas Terstruktur',
																	'id'=>'nilai_quiz',
																	'value'=>'CHtml::textField("nilai_quiz[$data->id_nilai]",$data->nilai_quiz,array("style"=>"width:50px;","class"=>"form-control"))',
																	'type'=>'raw',
																	'htmlOptions'=>array('width'=>'40px'),
																),
																array( //TextBox --- Displays quantity
																	'header'=>'Nilai UTS ',
																	'id'=>'nilai_mid',
																	'value'=>'CHtml::textField("nilai_mid[$data->id_nilai]",$data->nilai_mid,array("style"=>"width:50px;","class"=>"form-control"))',
																	'type'=>'raw',
																	'htmlOptions'=>array('width'=>'40px'),
																),
																array( //TextBox --- Displays quantity
																	'header'=>'Nilai UAS',
																	'id'=>'nilai_uas',
																	'value'=>'CHtml::textField("nilai_uas[$data->id_nilai]",$data->nilai_uas,array("style"=>"width:50px;","class"=>"form-control"))',
																	'type'=>'raw',
																	'htmlOptions'=>array('width'=>'40px'),
																),
																array( //TextBox --- Displays quantity
																	'header'=>'Nilai Angka',
																	'id'=>'na',
																	'value'=>'CHtml::textField("na[$data->id_nilai]",$data->na,array("style"=>"width:50px;","class"=>"form-control"))',
																	'type'=>'raw',
																	'htmlOptions'=>array('width'=>'40px'),
																),
																
																// //dosen
																// array( //TextBox --- Displays quantity
																	// 'header'=>'Nilai Huruf',
																	// 'id'=>'nilai_huruf',
																	// 'value'=>'CHtml::dropDownList("nilai_huruf[$data->id_nilai]", $data->nilai_huruf, $data->getHurufDropDown(),array("class"=>"form-control"))',
																	// 'type'=>'raw',
																	// 'htmlOptions'=>array('width'=>'40px'),
																// ),
																
																//dosen
																array( //TextBox --- Displays quantity
																	'header'=>'Nilai Huruf',
																	'id'=>'nilai_huruf',
																	'value'=>'CHtml::dropDownList("nilai_huruf[$data->id_nilai]", $data->nilai_huruf, $data->getHurufDropDown(),array("style"=>"padding-right:5px;width:60px;","class"=>"form-control"))',
																	'type'=>'raw',
																	'htmlOptions'=>array('width'=>'40px'),
																	
																),
														),
												)); ?>
											</div>
										</div>					 
									</div>
								</div>		
							</div>                                
							</form>
						</div>
					</div>                    
					<button class="btn btn-primary pull-right mb-control" data-box="#mb-simpan">Simpan</button>
				</div>
				<!-- MESSAGE BOX-->
				<div class="message-box animated fadeIn" data-sound="alert" id="mb-simpan">
					<div class="mb-container">
						<div class="mb-middle">
							<div class="mb-title"><span class="fa fa-sign-out"></span> Apakah anda yakin untuk menyimpan nilai ?</div>
							<div class="mb-content">
								<!--p>Nilai hanya bisa di inputkan sekali ?</p-->
								<p>Tekan "Tidak" jika masih ragu. Tekan "Iya" jika yakin ingin menyimpan nilai.</p>
							</div>
							<div class="mb-footer">
								<div class="pull-right">
									<button class="btn btn-primary btn-lg">Simpan</button>
									<button class="btn btn-default btn-lg mb-control-close">Tidak</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php $this->endWidget(); ?>
			</div>
		</div>
	</div> 
	</form>
</div>
	


</div><!-- form -->


<div class="col-md-12">                      
    <div class="panel panel-default">
		<div class="panel-body"> 
		
			<div class="col-md-12">
				<!--Export-->
				<?php echo CHtml::beginForm(array('dosen/exportExcel/id_kls/'.$id_kls));?>
				<div class="col-md-2">Unduh Rincian Nilai</div>
				<div class="col-md-2">
				<select name="fileType" class="form-control">
					<option value="Excel">EXCEL 2007</option>
					
				</select>
				</div>
				<div class="col-md-2">
				<?php echo CHtml::submitButton('Unduh',array(
							'buttonType' => 'submit',
							'context'=>'primary',
							'label'=>'Export Excel',
							'class'=>'btn btn-primary',
						)); ?>
				<?php echo CHtml::endForm(); ?>
				</div>
				
				<!--Import-->
				<div class="col-md-2">Unggah Rincian Nilai (Excel2007)</div>
				<div class="col-md-3">					
					<?php echo CHtml::beginForm('../../../dosen/importExcel/id/'.$id_kls, 'post', array('enctype'=>'multipart/form-data')); ?>
						<?php echo $form->fileField($model,'filee',array('class'=>'btn','required'=>'required')); ?>	
				</div>
				<div class="col-md-1">					
						<?php echo CHtml::submitButton('Unggah',array(
							'buttonType' => 'submit',
							'context'=>'primary',
							'label'=>'Export Excel',
							'class'=>'btn btn-primary',
						)); ?>
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>	
			<div class="col-md-12" style="margin-top:1%">
				<?php echo CHtml::beginForm(array('dosen/exportExcelHuruf/nilaihuruf/'.$id_kls));?>
				<div class="col-md-2">Unduh Nilai Huruf</div>
				<div class="col-md-2">
					<select name="fileType" class="form-control">
						<option value="Excel">EXCEL 2007</option>
						
					</select>
				</div>
				<div class="col-md-2">
				<?php echo CHtml::submitButton('Unduh',array(
							'buttonType' => 'submit',
							'context'=>'primary',
							'label'=>'Export Excel',
							'class'=>'btn btn-primary',
						)); ?>
				<?php echo CHtml::endForm(); ?>
				</div>
				
				<!--Import-->
				<div class="col-md-2">Unggah Nilai Huruf (Excel2007)</div>
				<div class="col-md-3">					
					<?php echo CHtml::beginForm('../../../dosen/importExcelHuruf/id/'.$id_kls, 'post', array('enctype'=>'multipart/form-data')); ?>
						<?php echo $form->fileField($model,'filee',array('class'=>'btn','required'=>'required')); ?>	
				</div>
				<div class="col-md-1">					
						<?php echo CHtml::submitButton('Unggah',array(
							'buttonType' => 'submit',
							'context'=>'primary',
							'label'=>'Export Excel',
							'class'=>'btn btn-primary',
						)); ?>
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>
			<div class="col-md-12" style="margin-top:1%">
				<div class="col-md-2">Unduh Nilai Angka</div>
				<?php echo CHtml::beginForm(array('dosen/exportExcelAngka/nilaiangka/'.$id_kls));?>
				<div class="col-md-2">
					<select name="fileType" class="form-control">
						<option value="Excel">EXCEL 2007</option>
						
					</select>
				</div>
				<div class="col-md-2">
				<?php echo CHtml::submitButton('Unduh',array(
							'buttonType' => 'submit',
							'context'=>'primary',
							'label'=>'Export Excel',
							'class'=>'btn btn-primary',
						)); ?>
				<?php echo CHtml::endForm(); ?>
				</div>
				
				<!--Import-->
				<div class="col-md-2">Unggah Nilai Angka (Excel2007)</div>
				<div class="col-md-3">					
					<?php echo CHtml::beginForm('../../../dosen/importExcelAngka/id/'.$id_kls, 'post', array('enctype'=>'multipart/form-data')); ?>
						<?php echo $form->fileField($model,'filee',array('class'=>'btn','required'=>'required')); ?>	
				</div>
				<div class="col-md-1">					
						<?php echo CHtml::submitButton('Unggah',array(
							'buttonType' => 'submit',
							'context'=>'primary',
							'label'=>'Export Excel',
							'class'=>'btn btn-primary',
						)); ?>
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>
		</div>
	</div>
</div>