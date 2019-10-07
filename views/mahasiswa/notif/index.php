<?php
$this->breadcrumbs=array(
	'Pemberitahuan',
);
$id_pd=Yii::app()->session->get('username');
?>

	
<div class="page-content-wrap">
                    
		<div class="row">                        
			<div class="col-md-3 col-sm-12 col-xs-12">		
				<?php $this->renderPartial('_profil',array('id_pd'=>$id_pd, 'model'=>$model, 'modelSms'=>$modelSms));?>
			</div>
			
			<div class="col-md-9 ">		
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="pull-left"><span class="fa fa-list-ul"></span> Pemberitahuan</h3>
					</div>
					<div class="panel-body" align=""> 
						<?php
						echo '
							<p align="center"><i>Berikut adalah semua pemberitahuan mengenai akun anda, jika ada yang tidak anda kenali harap hubungi C3</i></p>
							<table class="table datatable">
								<thead>
									<tr class="primary">
										<th>No</th>
										<th>Pemberitahuan</th>
									</tr>
								</thead>
								<tbody>
						';
						
								$modelNotif=Notif::model()->findAll('notif_user=:notif_user ORDER BY created_date DESC LIMIT 20',array(':notif_user'=>$model->id_pd));
								$no=1;
								foreach($modelNotif as $db)
								{	
									echo '
									<tr>
										<td>'.$no.'</td>
										<td>
											<h5><i>'.$db->notif_judul.'</i> <small class="pull-right"><small>'.date('H:i:s d/m/Y', strtotime($db->created_date)).'</small></small></h5>
											<p><i>'.$db->notif_body.'</i></p>
										</td>
									</tr>
									';
									$no++;
								}
								echo '
								</tbody>
							</table>
						';
						?>
					</div>
				</div>				
			</div> 	
		</div>
		<!-- END PAGE CONTENT WRAPPER --> 		
		
		  <div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Ubah Foto</h4>
                    </div>                    
                    <form id="cp_upload1" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/upload_image.php">
                    <div class="modal-body form-horizontal form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 control-label">New Photo</label>
                            <div class="col-md-4">
								<input type="hidden" name="id" value="<?php echo $id_pd;?>"/>
                                <input type="file" class="fileinput btn-info" name="file" id="cp_photo" title="Select file"/>
                            </div>                            
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <!--button type="button" class="btn btn-success disabled" id="cp_accept">Accept</button-->
						
						<input type="submit" class="btn btn-success" value="Simpan"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>	