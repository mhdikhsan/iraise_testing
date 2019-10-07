<?php
$step1="fa fa-circle text-muted pull-right";
$step2="fa fa-circle text-muted pull-right";
$step3="fa fa-circle text-muted pull-right";
$step4="fa fa-circle text-muted pull-right";
$step5="fa fa-circle text-muted pull-right";
switch($status)
{
	case '1':
		$step1="fa fa-check text-success pull-right";
		$step2="fa fa-circle text-success pull-right";
	break;
	case '2':
		$step1="fa fa-check text-success pull-right";
		$step2="fa fa-check text-success pull-right";
		$step3="fa fa-circle text-success pull-right";
	break;
	case '3':
		$step1="fa fa-check text-success pull-right";
		$step2="fa fa-check text-success pull-right";
		$step3="fa fa-check text-success pull-right";
		$step4="fa fa-circle text-success pull-right";
	break;
	case '4':
		$step1="fa fa-check text-success pull-right";
		$step2="fa fa-check text-success pull-right";
		$step3="fa fa-check text-success pull-right";
		$step4="fa fa-check text-success pull-right";
		$step5="fa fa-circle text-success pull-right";
	break;
	case '5':
		$step1="fa fa-times text-danger pull-right";
		$step2="fa fa-times text-danger pull-right";
		$step3="fa fa-times text-danger pull-right";
		$step4="fa fa-times text-danger pull-right";
		$step5="fa fa-times text-danger pull-right";
	break;
}
?>
<div class="list-group ">
	<div class="col-md-5 panel-body form-group-separated"> 
		<h3>
			<a href="#" class="list-group-item"> Registrasi  <div class="<?php echo $step1;?>"></div></a> 
			<a href="#" class="list-group-item"> Verifikasi <div class="<?php echo $step2;?>"></div></a> 
			<a href="#" class="list-group-item"> Lulus Verifikasi <div class="<?php echo $step3;?>"></div></a> 
			<a href="#" class="list-group-item"> Lulus Beasiswa <div class="<?php echo $step4;?>"></div></a> 
			<a href="#" class="list-group-item"> Gagal <div class="<?php echo $step5;?>"></div></a> 
		</h3>
		<hr>
	</div>       
</div>
<!-- END PAGE CONTENT WRAPPER --> 		
