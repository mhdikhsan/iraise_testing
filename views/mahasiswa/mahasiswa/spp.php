<?php
	$this->breadcrumbs=array(
	'Mahasiswa'=>array('spp'),
	'SPP',
	);

	$nim=Yii::app()->session->get('username');
	$c=Yii::app()->db;
	$sql="select semester.nm_smt, k.status_bayar, k.id_smt,k.semester,k.id_stat_mhs,k.tgl_bayar,k.jlh_bayar,k.total_bayar,b.nama_bank from kuliah_mhs as k
			INNER JOIN bank as b ON b.id_bank=k.id_bank
			INNER JOIN semester on semester.id_smt = k.id_smt
			where id_reg_pd='$nim' order by id_smt";
	$kuliahmhs=$c->createCommand($sql)->queryAll();
	
	
	$no = 1;

?>
<div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">History Pembayaran (Pembayaran UKT dapat dilakukan Melalui Bank BRI Syariah / BNI Syariah) </h3>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">No</th>
                                                    <th>ID Semester</th>
													<th>Semester</th>
                                                    <th width="150">Status Mhs</th>
                                                   
                                                    <th width="200">Tanggal</th>
													<th width="200">Besaran Uang Kuliah</th>
                                                    <th width="150">Sudah Dibayar</th>
													 <th width="150">Nama Bank</th>
													 <th width="150">Status Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>          
												<?php 
													$total = 0;
													
													foreach ($kuliahmhs as $data) {
														$jlh_bayar = (int)$data['jlh_bayar'];
														$total_bayar = (int)$data['total_bayar'];
														if ($data['status_bayar']=='1'){ $statusbayar= 'Lunas'; 
														}else{ $statusbayar= 'Belum'; }
														
														if ($data['id_stat_mhs']=='A') {
														$statusmhs = 'Aktif';
														$klas ='label label-success';
														}elseif ($data['id_stat_mhs']=='C') {
															$statusmhs ='Cuti';
															$klas='label label-success';
														}elseif ($data['id_stat_mhs']=='N') {
															$statusmhs ='NonAktif';
															$klas = 'label label-danger';
														}else{	
															$statusmhs = '';
															$klas = 'label label-danger';
														}
														
												?>
                                                <tr id="trow_1">
                                                    <td class="text-center"><?php echo $no; ?></td>
                                                    <td><strong><?php echo $data['nm_smt']; ?></strong></td>
													 <td><strong><?php echo $data['semester']; ?></strong></td>
                                                   
                                                    <td><span class="<?=$klas;?>"><?php echo $statusmhs; ?></span></td>
                                                    <td><?php echo $data['tgl_bayar']; ?></td>
                                                    <td><?php echo "Rp " . number_format($jlh_bayar,2,',','.'); ?></td>
													<td><?php echo "Rp " . number_format($total_bayar,2,',','.'); ?></td>
														<?php if ($data['status_bayar']=='1') { ?>
															<td><?php echo $data['nama_bank']; ?></td>
														<?php }else{ ?>
															<td><?php echo ''; ?></td>	
														<?php } ?>
														
													<td><?php echo $statusbayar; ?></td>
													<?php $total = $total + $data['jlh_bayar']; ?>
                                                   
                                                </tr>
												<?php $no++;}?>
												
												<tr id="trow_1">
                                                    <td colspan='5'>Total</td>
                                                    <td colspan='2'><?php echo "Rp " . number_format($total,2,',','.'); ?></td>
												
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                                

                                </div>
                            </div>                                                

                        </div>
                    </div>