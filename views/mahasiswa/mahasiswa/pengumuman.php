<?php
$this->breadcrumbs=array(
	'Mahasiswa',
);
/* @var $this PengumumanController */
/* @var $model Pengumuman */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pengumuman-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START TIMELINE -->
                            <div class="timeline timeline-right">
                                <?php
								foreach($model as $db)
								{
								?>
									<!-- START TIMELINE ITEM -->
									<div class="timeline-item timeline-main">
										<div class="timeline-date"><?php echo $db->years?></div>
									</div>
									<!-- END TIMELINE ITEM -->
									
									<!-- START TIMELINE ITEM -->
									<?php									
									$criteria=new CDbCriteria;
									$criteria->order = "datetime DESC";
									$criteria->condition = "penerima=:penerima AND DATE_FORMAT(datetime,'%Y')=:date AND (id_sms='".$sSms."' OR id_sms='')";
									$criteria->params = array (	
									':penerima' => 'mahasiswa',
									':date' => $db->years,
									);
									$modelPengumuman=Pengumuman::model()->findAll($criteria);
									foreach($modelPengumuman as $dbInfo)
									{
									?>
									<div class="timeline-item timeline-item-right">
										<div class="timeline-item-info"><h5><?php echo $dbInfo->datetime; ?></div>
										<div class="timeline-item-icon"><span class="fa fa-bullhorn"></span></div>
										<div class="timeline-item-content">
											<div class="timeline-heading">
												From &nbsp;: <a href="#"><?php echo $dbInfo->pengirim; ?></a>
												<h4><?php echo $dbInfo->judul; ?></h4>
											</div>
											<div class="timeline-body">
												<p><?php echo $dbInfo->isi; ?></p>
												
												<ul class="list-tags">                                            
													<li><a href="#"><span class="fa fa-tag"></span> <?php echo $dbInfo->sudahbaca; ?></a></li>
													
												</ul>                                            
											</div>
											
											<div class="timeline-footer">
												
											</div>
										</div>
									</div>       
								<?php
									}
								}
								?>
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->
                            </div>
                            <!-- END TIMELINE -->
                            
                        </div>
                    </div>
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                       
                                
                      
            <!-- END PAGE CONTENT -->
        
        <!-- END PAGE CONTAINER -->

        <!-- BLUEIMP GALLERY -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>      
        <!-- END BLUEIMP GALLERY -->        
        
        <!-- MESSAGE BOX-->
        
        <!-- END MESSAGE BOX-->

       
<?php $this->endWidget(); ?>

</div><!-- form -->





