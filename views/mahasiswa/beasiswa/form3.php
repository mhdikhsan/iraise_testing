<?php
$this->breadcrumbs=array(
	$judul,
);
?>
<div class="col-md-12 ">		
	<div class="panel panel-default">
		 <div class="panel-body"> 
			<h3 class="pull-left"><span class="fa fa-pencil"></span> <?php echo $judul;?></h3>
			<?php echo CHtml::link('Form 3',array('form3'),array('class'=>'btn btn-default pull-right')); ?>
			<?php echo CHtml::link('Form 2',array('form2'),array('class'=>'btn btn-default pull-right')); ?>
			<?php echo CHtml::link('Form 1',array('form'),array('class'=>'btn btn-default pull-right')); ?>
			<div class="list-group list-group-simple">
				<div class="col-md-12 panel-body form-group-separated"> 
					<br>
					<h1 class="row" align="center">
						SURAT PERNYATAAN
					</h1>
					
					<h4>Saya yang bertanda tangan dibawah ini:</h4>
			<h3>
			
				<div class="col-md-12" style="margin-top:1%">
					<div class="row" >                                        
						<label class="col-md-3 col-xs-5 control-label">Nama</label>
						<div class="col-md-7 col-xs-9">
							: nama lengkap
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-5 control-label">NIM </label>
						<div class="col-md-7 col-xs-9">
							: nim
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-5 control-label">Jurusan/Fakultas</label>
						<div class="col-md-7 col-xs-9">
							: jur/fak
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-5 control-label">No.HP</label>
						<div class="col-md-7 col-xs-9">
							: hp
						</div>
					</div>
					<div class="row" style="margin-top:1%">                                        
						<label class="col-md-3 col-xs-5 control-label">Alamat </label>
						<div class="col-md-7 col-xs-9">
							: almt
						</div>
					</div>
					
				</div>    
			</h3>
			<div class="row" align="left" style="margin-top:5%">
				<h4 style="margin-left:2%">
			Menyatakan bahwa tidak akan menuntut hasil seleksi tim Penyeleksi Beasiswa Bidik Misi Universitas Islam Negeri Sultan Syarif Kasim Riau Tahun Anggaran 2015.<br> Demikian surat pernyataan ini saya buat untuk dapat dipergunakan sebagaimana mestinya
				</h4>		
							<div class="row" align="right" style="margin-top:3%">
									<h4>
										Pekanbaru, 10 /8/ 2015
									</h4>
								
							</div>
					<h4 style="margin-left:80%">Yang membuat pernyataan</h4>
					<div class="row" align="left" style="margin-top:7%">
									<h4 style="margin-left:88%"> ( bla bla )</h4>
								
							</div>
			</div>
		</div>
	</div>				
</div>

<!-- END PAGE CONTENT WRAPPER --> 		
