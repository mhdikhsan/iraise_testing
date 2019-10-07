<?php
$judul="Info";
$pesan="Anda tidak bisa mengajukan beasiswa bidikmisi :<br><br>";
$pesan.="1. Umur anda melebihi 21 tahun.<br>";
$pesan.="2. IP anda dibawah 3 selama 2 semester berturut-turut.<br>";
$pesan.="3. Jenjang Pendidikan anda bukan S1.<br>";
$this->breadcrumbs=array(
	$judul,
);
?>
<div class="col-md-12 ">		
	<div class="panel panel-default">
		 <div class="panel-body"> 
			<h3><span class="fa fa-pencil"></span> <?php echo $judul;?></h3>
			<div class="list-group list-group-simple">
				<div class="col-md-12 panel-body form-group-separated"> 
					<br>
					<h3 class="row">
						<?php echo $pesan;?>
					</h3>
				</div>       
			</div>
		</div>
	</div>				
</div>

<!-- END PAGE CONTENT WRAPPER --> 		
