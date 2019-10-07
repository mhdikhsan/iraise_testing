<?php
//Deklarasi Id_kls
$id_kls=$_GET['id'];
//breadcrumbs
$this->breadcrumbs=array(
	'Tugases'=>array('index'),
	'Create',
);
?>

<div class="col-md-12">            
	<div class="form-group">
		<div class="col-md-12 col-xs-5">
			<h1 class="pull-left">Upload Materi/Tugas</h1>
			<br>
			<?php echo CHtml::link('<i class="fa fa-arrow-left"></i>Kembali',Yii::app()->createUrl("dosen/tugas/milis",array('id'=>$id_kls)),array('class'=>'btn btn-default pull-right','style'=>'margin-right:10px;')); ?>
		</div>
	</div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
		<div class="panel-body"> 
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>
