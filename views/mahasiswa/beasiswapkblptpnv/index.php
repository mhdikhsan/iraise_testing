
<?php if (!$open) {?>

	<div class="col-md-8">		
		<div class="panel panel-default">
			 <div class="panel-body"> 
			 <h4 class="text-center bg-default"> PENDAFTARAN BEASISWA PKBL PTPN V</h4>
			 <h4 class="text-center bg-warning"> <?= date_format(date_create($config->set1),'d F Y');?> s/d <?= date_format(date_create($config->set2),'d F Y'); ?></h4>
			 <hr>
			 <p class="text-left"> Dibuka Untuk Mahasiswa Semester 7, Fakultas : </p>
			

					<?php
					$x=1;
					echo "<table class='table table-bordered'>";
					foreach ($fakbuka as $dt) {
						echo"
						<tr>
							<td>$x</td>
							<td>$dt->nm_lemb</td>
						</tr>";			
					$x++;
					}
					echo "</table>";
					?>
			</div>	
		</div>
	</div>
		

<?php	
}else{
	?>
	<?php if (!$modelB->isNewRecord) { ?>
		<div class="col-md-8">		
			<div class="panel panel-default">
				 <div class="panel-body"> 
					<table class="table table-bordered table-striped">
						<tr>
							<td> PENDAFTARAN BEASISWA PKBL PTPN V BERHASIL DI AJUKAN PADA TANGGAL <?= $modelB->tgl_daftar ?> <div class="fa fa-check text-success pull-right"></div <td>
						</tr>
						<tr>
							<td> <?php echo CHtml::link('Pengumuman Kelulusan Beasiswa Diumumkan Pada Tanggal 07 November 2018 di https://uin-suska.ac.id','https://uin-suska.ac.id',array('class'=>'btn btn-info pull-left','target'=>'blank')); ?> </td>
						</tr>
					</table>
				</div>
			</div>
		</div>		 
	<?php }?>

	<?php if ($modelB->isNewRecord) { ?>

		<div class="col-md-8">		
			<div class="panel panel-default">
				 <div class="panel-body"> 
				 <h2 class="text-center bg-success"> PENDAFTARAN BEASISWA PKBL PTPN V </h2>
					<h6 class="text-center"> PERIKSA PROFIL SEBELUM MELAKUKAN SUBMIT /PENDAFTARAN BEASISWA </h6>
					<?php
					echo "<table class='table table-bordered'>
						<tr>
							<td>NAMA</td>
							<td>:</td>
							<td>$model->nm_pd</td>
						</tr>
						<tr>
							<td>NIK</td>
							<td>:</td>
							<td>$model->nik</td>
						</tr>
						<tr>
							<td>JENIS KELAMIN</td>
							<td>:</td>
							<td>$model->jk</td>
						</tr>
						<tr>
							<td>TEMPAT LAHIR</td>
							<td>:</td>
							<td>$model->tmpt_lahir</td>
						</tr>	
						</tr>
						<tr>
							<td>TANGGAL LAHIR</td>
							<td>:</td>
							<td>".date_format(date_create($model->tgl_lahir),"d M Y")."</td>
						</tr>
						
						</tr>
						<tr>
							<td>ALAMAT</td>
							<td>:</td>
							<td>$model->jln</td>
						</tr>

						<tr>
							<td>DUSUN</td>
							<td>:</td>
							<td>$model->nm_dsn</td>
						</tr>
						<tr>
							<td>KELURAHAN</td>
							<td>:</td>
							<td>$model->ds_kel</td>
						</tr>

						<tr>
							<td>NO HP</td>
							<td>:</td>
							<td>$model->telepon_seluler</td>
						</tr>
						<tr>
							<td>NAMA IBU KANDUNG</td>
							<td>:</td>
							<td>$model->nm_ibu_kandung</td>
						</tr>				
					</table>";
					?>
					<hr>
				Jika Data Belum Benar silahkan <?= CHtml::link("Update Profil",Yii::app()->createUrl(Yii::app()->controller->module->id."/Mahasiswa/update/id/".$model->id_pd),array("class"=>"btn btn-primary")); ?>
				</div>
			</div>
		</div>


		<div class="col-md-8">		
			<div class="panel panel-default">
				 <div class="panel-body"> 
					<h6 class="text-center"> IPS MAHASISWA / SEMESTER </h6>
					<?php
					echo "<table class='table table-bordered'>
						<tr class='bg-warning'>
							<td>SEMESTER</td>
							<td>STATUS MAHASISWA</td>
							<td>IP SEMESTER</td>
						</tr>";
						
						foreach ($akm as $a) {
						echo "
						<tr>
							<td>$a[semester]</td>
							<td>$a[id_stat_mhs]</td>
							<td>$a[ips]</td>
						</tr>";
						}
					echo"
						</table>";
					?>
				</div>
			</div>
		</div>


							
							
		<div class="col-md-12">
			<div class="form-group">
				<div class="col-md-12 col-xs-12">
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'mahasiswa-form',
							'enableAjaxValidation'=>false,
						)); ?>
					<?php echo $form->hiddenField($modelB, 'id_pd'); ?>
					<button class="btn btn-primary pull-left">Simpan & Ajukan </button> &nbsp;
					<?php echo CHtml::link('Lihat Syarat dan Info','https://uin-suska.ac.id',array('class'=>'btn btn-info pull-left','target'=>'blank')); ?>
				</div>
			</div>
			<br>
			<hr>
		</div>

		<?php $this->endWidget(); ?>
	<?php } ?>
<?php }?>
