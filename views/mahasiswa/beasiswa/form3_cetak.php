<style>
	table{
	font-family:Arial;
	width: 100%;
	font-size: 9pt;
	}
	th{
	
	width: 100%;
	padding: 5px 3px 5px 8px;
	text-align:center;
	}
	td{
	padding: 5px 3px 0 8px;
	}
	barcode{
	width:50mm; height:10mm; color:#000000 ; font-size: 4mm;
	}
	.notice{
	font-style: italic;
	font-size: 9pt;
	}
	page_footer{
	text-align: right;
	}
	.tr .garisbawah{
		border-bottom:1px solid #eee;
	}
</style>
<page>
<h5 class="row" >
<?php echo $judul?>
</h5>

<h4 class="row" align="center">
	SURAT PERNYATAAN
</h4>
</page>
<br/>
<p style="font-size:13px">Saya yang bertanda tangan dibawah ini :</p>
<table style="font-size:13px">
	<tr>
		<td>Nama</td>
		<td>
			: <?php echo $model->nm_pd;?>
		</td>
	</tr>
	<tr>
		<td>NIM</td>
		<td>
			: <?php echo $model->id_pd;?>
		</td>
	</tr>
	<tr>
		<td>Jurusan/Fakultas</td>
		<td>
			: <?php echo $jurusan.' ( '.$fakultas.')';?>
		</td>
	</tr>
	<tr>
		<td>No.HP</td>
		<td>
			: <?php echo $model->telepon_seluler; ?>
		</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>
			: <?php echo $model->jln;?>
		</td>
	</tr>
</table>
<p style="font-size:13px">Menyatakan bahwa tidak akan menuntut hasil seleksi Tim Penyeleksi Beasiswa Bidik Misi Universitas Islam Negeri Sultan Syarif Kasim Riau Tahun Anggaran <?php echo date('Y');?>.<br>
Demikian surat pernyataan ini saya buat untuk dapat dipergunakan sebagaimana mestinya.</p>
	
<table style="font-size:13px">
	<tr>
		<td style="width:480px;"></td>
		<td>Pekanbaru, <?php echo date('d/m/Y');?></td>
	</tr>
	<tr valign="top">
		<td style="height:100px;"></td>
		<td>Yang membuat pernyataan</td>
	</tr>
	<tr>
		<td></td>
		<td align="center">( <u><?php echo $model->nm_pd;?> )</u></td>
	</tr>
</table>