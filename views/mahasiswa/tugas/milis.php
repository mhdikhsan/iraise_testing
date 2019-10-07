<?php
//Data Kelas
	$id_kls=$_GET['id'];
	$nim=Yii::app()->session->get('username');
	// $modelKls=KelasKuliah::model()->findByPk($id_kls);
//Breadcrumbs
$judul='Silabus Elektronik';
$this->breadcrumbs=array(
	$judul=>array('index','semester'=>$_GET['smt']),
	$modelKls->mk->nm_mk.' - '.$modelKls->nm_kls,
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
<?php
//Data Dosen
	$modelAkt=AktAjarDosen::model()->find('id_kls=:id_kls',array(':id_kls'=>$id_kls));
	if(isset($modelAkt->id_reg_ptk))
	{
		$id_ptk=$modelAkt->id_reg_ptk;
		$modelDosen=Dosen::model()->findByPk($id_ptk);
		if(isset($modelDosen))
		{
			$namaDosen=$modelDosen->nm_ptk;
		}else{
			$namaDosen="";
		}
		$idDosen=$id_ptk;
	}else{
		$namaDosen="";
		$idDosen="";
	}
?>
<style type="text/css">
		.text { font-size: 12px; }
		
	</style>
<div class="form">

<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-5">
			<h1 class="pull-left"><span class="fa fa-file"></span> <?= $judul; ?> <small><?= $modelKls->mk->nm_mk; ?></small></h1><h1 class="pull-right"><small><small>Kelas</small></small> <?= $modelKls->nm_kls; ?></h1>
			<br>
			<?php //echo CHtml::link('Upload Materi/Tugas',Yii::app()->createUrl("dosen/tugas/create",array('id'=>$id_kls)),array('class'=>'btn btn-primary pull-right')); ?>
		</div>
	</div>
</div>
<?php if(Yii::app()->user->hasFlash('flash')): ?>
	<div class="col-md-12">                      
		 <div class="panel panel-default">
			<div class="panel-body"> 
					<?php echo Yii::app()->user->getFlash('flash'); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="col-md-12">
     <div class="panel panel-default">
        <div class="panel-body"> 
			<div class="col-md-12">
				<div style="float:left;padding-right:3px;">
					<h5><b>Nama / NIP</b></h5>
				</div>
				<div style="float:left;">
					<h5> : <?php echo $namaDosen; ?><small> / <?php echo $idDosen; ?></small></h5>
				</div>
			</div>
			<br>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default tabs">
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#tab1" role="tab" data-toggle="tab">Course Home</a></li>
							<!--li class=""><a href="#tab2" role="tab" data-toggle="tab">Tugas</a></li-->
							<li class=""><a href="#tab3" role="tab" data-toggle="tab">Peserta Didik</a></li>
							<li class=""><a href="#tab4" role="tab" data-toggle="tab">Silabus</a></li>
							<li class=""><a href="#tab5" role="tab" data-toggle="tab">Diskusi</a></li>
							
							
						</ul>
						<div class="panel-body tab-content">
							<div class="tab-pane active" id="tab1">
								<div class="panel-body">    
									<div class="col-md-12 col-sm-12 col-xs-12">	
										<?php $this->renderPartial('_profil',array('id_pd'=>$nim, 'modelKls'=>$modelKls, 'namaDosen'=>$namaDosen, 'idDosen'=>$idDosen));?>
									</div>
								</div>					 
							</div>
							<div class="tab-pane" id="tab4">
								<div class="panel-body">                 
									<!-- Start Deskripsi -->
									<div class="row">
										<div class="form-group-separated">
											<div class="form-group">
												<label class="col-md-2 col-xs-5 control-label"><h3>Deskripsi <small>Singkat</small></h3></label>
												<div class="col-md-10 col-xs-7">
													<?= $modelKls->sbs_deskripsi ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 col-xs-5 control-label"><h3>TUJUAN  <small>INSTRUKSIONAL UMUM</small></h3></label>
												<div class="col-md-10 col-xs-7">
													<?= $modelKls->sbs_tujuan ?>
												</div>
											</div>
										</div>		
									</div>		
									<hr>
									<!-- Start Table -->
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-actions datatable">
											<thead>
												<tr>
													<th width="50">No</th>
													<th>Tujuan</th>
													<th>Pokok</th>
													<th>Sub Pokok</th>
													<th>Metode</th>
													<th>Alat Bantu</th>
													<th>Waktu</th>
													<th>Referensi</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
													$no = 1;
													$sks = 0;
													foreach ($modelSbs as $db):
												?>
												  <tr id="trow_1">
													<td class="text-center"><?php echo $no; ?></td>
													<td><?php echo $db->tujuan; ?></td>
													<td><?php echo $db->pokok; ?></td>
													<td><?php echo $db->sub_pokok; ?></td>
													<td><?php echo $db->metode; ?></td>
													<td><?php echo $db->alat; ?></td>
													<td><?php echo $db->waktu; ?></td>
													<td><?php echo $db->referensi; ?></td>
												  </tr>	
												<?php $no++;endforeach; ?>
											</tbody>
										</table>
									</div>
									<!-- END Table -->
								</div>					 
							</div>
							<div class="tab-pane" id="tab2">
								<div class="panel-body">                          
									<div class="row">
										<?php $no=1;$this->widget('booster.widgets.TbGridView', array(
												'id'=>'Arsip',
												'dataProvider'=>$model->search($_GET['id'],'tugas'),
												'filter'=>$model,
												'columns'=>array(	
													array('header'=>'No','value'=>'$row+1'),
													'judul',
													'ket',
													'link',
												),
										)); ?>
									</div>
								</div>					 
							</div>
							<div class="tab-pane" id="tab3">
								<div class="panel-body">                          
									<div class="table-responsive">
										<table class="table table-striped table-actions datatable">
											<thead>
												<tr>
													<th width="50">No</th>
													<th>Foto</th>
													<th>Nama/Nim</th>
													<th>Jenis Kelamin</th>
													<th>No HP</th>
													<th>Semester</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
													$no = 1;
													$sks = 0;
													foreach ($modelNilai->nilaiMhs($_GET['id'])->getData() as $data):
													if($data['mhs']['nm_pd']=='')
													{
														$nama="<i style='color:red;'>Data tidak lengkap</i>";
													}else{
														$nama=$data['mhs']['nm_pd'];
													}
												?>
												  <tr id="trow_1"><td class="text-center"><?php echo $no; ?></td>
													<td style="width:50px"><img src="https://iraise.uin-suska.ac.id/site/image/id/<?php echo $data['id_reg_pd']; ?>" width="50px"></td>	
													<td>
														<b><?php echo $nama; ?></b><br>
														<?php echo $data['id_reg_pd']; ?>
													</td>	
													<td><?php echo $data['mhs']['jk']=='L'?"Laki-laki":"Perempuan"; ?></td>
													<td><?php echo $data['mhs']['telepon_seluler']; ?></td>
													<td>Semester-<?php echo $data['semester']; ?></td>
												  </tr>	
												<?php $no++;endforeach; ?>
											</tbody>
										</table>
									</div>
									<!-- END Table -->
								</div>					 
							</div>
							<div class="tab-pane" id="tab5">
								<div class="panel-body">                          
									<div class="row">
										<div class="panel panel-default push-up-10">
											<div class="panel-body panel-body-search">
												<form method="POST" action="">
												<div class="input-group">
													<div class="input-group-btn">
														<button class="btn btn-default"><span class="fa fa-camera"></span></button>
														<button class="btn btn-default"><span class="fa fa-chain"></span></button>
													</div>
													<input type="text" name="pesan" placeholder="Your message..." class="form-control">
													<div class="input-group-btn">
														<button class="btn btn-default">Kirim</button>
													</div>
												</div>
												<p class="text" id="regular">
													:-)	:-) :) :o) :c) :^) :-D :-( :-9 ;-) :-P :-p :-Þ :-b :-O :-/ :-X :-# :'( B-) 8-) :-\ ;*( :-* :] :&gt; =] =) 8) :} :D 8D XD xD =D :( :&lt; :[ :{ =( ;) ;] ;D :P :p =P =p :b :Þ :O 8O :/ =/ :S :# :X B) O:) &lt;3 ;( &gt;:) &gt;;) &gt;:( O_o O_O o_o 0_o T_T ^_^ ?-)
												</p>
												</form>
											</div>
										</div>
										<div class="messages messages-img">
											<?php
												$c=Yii::app()->db;
												
												$cek="SELECT * FROM `nilai`  
														WHERE id_kls='$id_kls' and id_reg_pd='$nim'";
												$cek=$c->createCommand($cek)->queryRow();
												if(empty($cek)){
													// $this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$nim);
												}
												$sql="SELECT * FROM `kelas_kuliah_chat`  
														WHERE id_kls='$id_kls'
													      ORDER BY tanggal DESC
												";
												$chat=$c->createCommand($sql)->queryAll();
												foreach($chat as $data){
												if(($data['stat'])==1){
													$id_pd = $data['user_id'];
													$sqlm="SELECT nm_pd,jk FROM mahasiswa WHERE id_pd='$id_pd'";
													$mhs=$c->createCommand($sqlm)->queryRow();
												
											?>
											
											<div class="item in item-visible">
												<div class="image">
													<?php if(($mhs['jk'])=='L') {?>
													<img src="https://cdn1.iconfinder.com/data/icons/users-avatars-2/128/man_avatar_2-128.png" alt="<?php echo substr($mhs['nm_pd'],0,3);?>">
													<?php }else {?>
													<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTi6Vjwndk8FXsYURDzCIUY7ZHV-McPeAfbROxKAFVFRaPY8vbWcg" alt="<?php echo substr($mhs['nm_pd'],0,3);?>">
													<?php }?>
												</div>
												<div class="text">
													<div class="heading">
														<a href="#"><?php echo $mhs['nm_pd'];?></a>
														<span class="date"><?php echo $data['tanggal'];?></span>
													</div>
													<?php echo $data['pesan'];?>
												</div>
											</div>
											<?php } else 
												  {
													$id_pd = $data['user_id'];
													$sqld="SELECT nm_ptk,jk FROM dosen WHERE id_ptk='$id_pd'";
													$dsn=$c->createCommand($sqld)->queryRow();
													
													
											
											?>
											<div class="item item-visible">
												<div class="image">
													<?php if(($dsn['jk'])=='L') {?>
															<img src="http://t3.gstatic.com/images?q=tbn:ANd9GcRy1ikVfeJmrFMq5Zm9p7IgYYzas8ulMw0_U1UJKEfjEn8HMiY-rA" alt="<?php echo substr($dsn['nm_ptk'],0,3);?>">
															<?php }else {?>
															<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTgfUO7sU1tYx1tjQpZB87Vj4uo6GbgFsxfd4LJ_T31hW8qdsK9Sw" alt="<?php echo substr($dsn['nm_ptk'],0,3);?>">
															<?php }?>
												</div>                                
												<div class="text">
													<div class="heading">
														<a href="#"><?php echo $dsn['nm_ptk'];?></a>
														<span class="date"><?php echo $data['tanggal'];?></span>
													</div>                                    
													<?php echo $data['pesan'];?>
												</div>
											</div>
											<?php } }?>
										</div>
										
									</div><!-- endif row-->
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