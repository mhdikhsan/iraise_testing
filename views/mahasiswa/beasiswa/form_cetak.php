<style>
	table{
	font-family:Arial, Helvetica, sans-serif;
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
<br/><br/><br/><br/>
<h3 class="row" align="center">
	<?php echo $judul;?>
</h3>
<h5 class="row" align="center">
	
	PELAMAR BEASISWA BIDIK MISI
	<br>
	UIN SUSKA RIAU TAHUN <?php echo date('Y');?>
</h5>
</page>
<br/>
<div style='position: absolute; top: 20px; left: 5px; width: 100px;height:120px; background-color: azure; overall width 248px including 2*3px padding and 2*1px border;text-align:center;'><br/><br/><br/>Foto 4 X 6</div>
<br/><br/>
<table style="font-size:13px">
	<tr>
		<td>NAMA</td>
		<td>
			: <?php echo $model->nm_pd;?>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>UMUR</td>
		<td>
			: <?php echo $umur;?> Tahun
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>NPSN</td>
		<td>
			: <?php echo $row['npsn'];?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>NISN</td>
		<td>
			: <?php echo $modelBBM->nisn;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>TAHUN MASUK</td>
		<td>
			: <?php echo $modelBBM->tahun_masuk;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>LULUS TAHUN</td>
		<td>
			: <?php echo $modelBBM->tahun_keluar;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>NAMA SEKOLAH ASAL</td>
		<td>
			: <?php echo $row['nama_sekolah'];?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>ALAMAT SEKOLAH ASAL</td>
		<td>
			: <?php echo $modelBBM->alamat_sekolah;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>RERATA NILAI UN</td>
		<td>
			: <?php echo $modelBBM->rata2_un;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>RERATA RAPOR</td>
		<td>
			: <?php echo $modelBBM->rata2_raport;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>KELAS XI SMTR II</td>
		<td>
			: <?php echo $modelBBM->nilai_xi_ii;?>
		</td>
		<td>PERINGKAT</td><td>: <?php echo $modelBBM->peringkat_xi_ii;?></td>
	</tr>
	<tr>
		<td>KELAS XII SMTR I</td>
		<td>
			: <?php echo $modelBBM->nilai_xii_i;?>
		</td>
		<td>PERINGKAT</td><td>: <?php echo $modelBBM->peringkat_xii_i;?></td>
	</tr>
	<tr>
		<td>KELAS XII SMTR II</td>
		<td>
			: <?php echo $modelBBM->nilai_xii_ii;?>
		</td>
		<td>PERINGKAT</td><td>: <?php echo $modelBBM->peringkat_xii_ii;?></td>
	</tr>
	<tr>
		<td>NO TELP/HP</td>
		<td>
			: <?php echo $model->telepon_seluler; ?>
		</td>
		<td></td><td></td>
	</tr>
</table>
<hr>
<div class="row" align="center">
		<h5>
			DATA SETELAH MELAKUKAN REGISTRASI ULANG
		</h5>
</div>
<div class="row" align="left">
		<h5>
		LULUS SELEKSI MASUK UIN SUSKA RIAU
		</h5>	
</div>

<table style="font-size:13px">
	<tr>
		<td>PADA JALUR</td>
		<td>
			: <?php echo $row['nama_jalur_masuk'];?>
		</td>
	</tr>
	<tr>
		<td>NO UJIAN</td>
		<td>
			: <?php echo $row['no_registrasi'];?>
		</td>
	</tr>
	<tr>
		<td>KATEGORI UKT</td>
		<td>
			: UKT <?php  echo $row['kelompok_ukt'];?>
		</td>
	</tr>
	<tr>
		<td>NAMA</td>
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
		<td>JURUSAN</td>
		<td>
			: <?php echo $jurusan;?>
		</td>
	</tr>
	<tr>
		<td>FAKULTAS</td>
		<td>
			: <?php echo $fakultas;?>
		</td>
	</tr>
</table>

<br/><br/><br/><br/>
<h4 class="row" align="center">
	
	LULUS / TIDAK LULUS
</h4>
<h5 align="center" style="margin-top:-20px;">
	<br/>
	SEBAGAI PENERIMA 
	<br/>
	BEASISWA BIDIK MISI UIN SUSKA RIAU 
	<br/>
	TAHUN <?php echo date('Y');?>
</h5>