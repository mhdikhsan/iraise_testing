<?php 
		$this->breadcrumbs=array(
			'Mahasiswa'=>array('Grafik Indek Prestasi Semester'),
			'SPP',
		);
	  //IP Persemester
		$id_pd=Yii::app()->session->get('username');
	   	$ip = "SELECT sum( n.nilai_indeks * m.sks_mk ) / sum( m.sks_mk ) AS ip, sum( m.sks_mk ) AS tot_sks, n.semester
		FROM `nilai` AS n
		JOIN kelas_kuliah AS kk ON kk.id_kls = n.id_kls
		JOIN matkul AS m ON m.id_mk = kk.id_mk
		WHERE n.id_reg_pd = '$id_pd'
		GROUP BY n.semester";
	   $dataip=array();
	   $c=Yii::app()->db;
	   $ip=$c->createCommand($ip)->queryAll();
	   foreach($ip as $sqlip){
			$ips= number_format($sqlip['ip'],2);
			$dataip[]=array(
				 'y'=>$sqlip['semester'],'a'=>$ips,'b'=>$sqlip['tot_sks'],
				 ); 
	   }
	   $dataip=json_encode($dataip);
  ?>
  <div class="row">

		<div class="col-md-12">

			<!-- START Area CHART -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Grafik IP Persemester</h3>                                
				</div>
				<div class="panel-body">
					<div id="morris-area-example" style="height: 300px;"></div>
				</div>
			</div>
			<!-- END Area CHART -->                        

		</div>
 </div>
 <script type="text/javascript">
			var morrisCharts = function() {

			Morris.Bar({
				element: 'morris-area-example',
				data: <?php echo $dataip; ?>,
				xkey: 'y',
				ykeys: ['a','b'],
				labels: ['IP','Total SKS'],
				resize: true,
				lineColors: ['#3FBAE4', '#FEA223']
			});



		}();
			</script>