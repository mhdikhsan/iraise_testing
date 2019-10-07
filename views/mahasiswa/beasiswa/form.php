<?php
$this->breadcrumbs=array(
	$judul,
);
?>
<div class="col-md-12 ">		
	<div class="panel panel-default">
		 <div class="panel-body"> 
			<h3 class="pull-left"><span class="fa fa-pencil"></span> <?php echo $judul;?></h3>
			<?php echo CHtml::link('Cetak Form 3',array('form3Cetak'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
			<?php echo CHtml::link('Cetak Form 2',array('form2Cetak'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
			<?php echo CHtml::link('Cetak Form 1',array('formCetak'),array('class'=>'btn btn-default pull-right','target'=>'blank')); ?>
			<div class="list-group list-group-simple">
				<div class="col-md-12 panel-body form-group-separated"> 
					<br>
					<h1 class="row" align="center">
						FORM 1
					</h1>
					<h2 class="row" align="center">
						
						PELAMAR BEASISWA BIDIK MISI
						<br>
						UIN SUSKA RIAU TAHUN 2014
					</h2>
			<h3>
				<div class="col-md-12">
					<div class="row" >                                        
						<label class="col-md-3 col-xs-3 control-label">NAMA </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $model->nm_pd;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">UMUR </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $umur;?> Tahun
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NPSN </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $row['npsn'];?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NISN </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $modelBBM->nisn;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">TAHUN MASUK </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $modelBBM->tahun_masuk;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">LULUS TAHUN</label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $modelBBM->tahun_keluar;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NAMA SEKOLAH ASAL</label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $row['nama_sekolah'];?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">ALAMAT SEKOLAH </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $modelBBM->alamat_sekolah;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">RERATA NILAI UN</label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $modelBBM->rata2_un;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">RERATA RAPOR </label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $modelBBM->rata2_raport;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">KELAS XI SMTR II </label>
						<div class="col-md-3 col-xs-3">
							: <?php echo $modelBBM->nilai_xi_ii;?>
						</div>
						<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
						<div class="col-md-3 col-xs-3">
							: <?php echo $modelBBM->peringkat_xi_ii;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">KELAS XII SMTR I </label>
						<div class="col-md-3 col-xs-3">
							: <?php echo $modelBBM->nilai_xii_i;?>
						</div>
						<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
						<div class="col-md-3 col-xs-3">
							: <?php echo $modelBBM->peringkat_xii_i;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">KELAS XII SMTR II </label>
						<div class="col-md-3 col-xs-3">
							: <?php echo $modelBBM->nilai_xii_ii;?>
						</div>
						<label class="col-md-3 col-xs-3 control-label">PERINGKAT </label>
						<div class="col-md-3 col-xs-3">
							: <?php echo $modelBBM->peringkat_xii_ii;?>
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NO TELP/HP</label>
						<div class="col-md-9 col-xs-9">
							: <?php echo $model->telepon_seluler; ?>
						</div>
					</div>
				</div>    
			</h3>
			<br>
			<br>
			<br>
							<div class="row" align="center" style="margin-top:5%">
									<h3>
										DATA SETELAH MELAKUKAN REGISTRASI ULANG
									</h3>
							</div>
							<div class="row" align="left" style="margin-top:2%">
									<h3>
									LULUS SELEKSI MASUK UIN SUSKA RIAU
									</h3>	
							</div>
			<h3>
				<div class="col-md-12">
					<div class="row" >                                        
						<label class="col-md-3 col-xs-3 control-label">PADA JALUR </label>
						<div class="col-md-9 col-xs-9">
							: jalur
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NO UJIAN </label>
						<div class="col-md-9 col-xs-9">
							: no ujian
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">KATEGORI UKT </label>
						<div class="col-md-9 col-xs-9">
							: kategori ukt
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NAMA </label>
						<div class="col-md-9 col-xs-9">
							: nama
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">NIM </label>
						<div class="col-md-9 col-xs-9">
							: NIM
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">JURUSAN </label>
						<div class="col-md-9 col-xs-9">
							: jurusan
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-3 control-label">FAKULTAS </label>
						<div class="col-md-9 col-xs-9">
							: fakultas
						</div>
					</div>
				</div>
			</h3>
					<div class="row" align="center" style="margin-top:5%">
									<h3>
										LULUS / TIDAK LULUS<br>SEBAGAI PENERIMA <br> BEASISWA BIDIK MISI UIN SUSKA RIAU <br>TAHUN 2015
									</h3>
							</div>
			</div>
		</div>
	</div>				
</div>

<!-- END PAGE CONTENT WRAPPER --> 		
