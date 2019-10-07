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
	.row2 h3 {
		font-size: 9pt;
	}
</style>
<page>
<h4 class="row" align="center">
	<?php echo $judul?>
</h4>
<h5 class="row2" align="center">
	
	DATA PELAMAR BEASISWA BIDIK MISI
	<br>
	UNIVERSITAS ISLAM NEGERI
	<br>
	SULTAN SYARIF KASIM RIAU 
	<br>
	TAHUN <?php echo date('Y');?>
</h5>
</page>
<br/>
<p>Assalammu'alaikum wr.wb<br>Dengan Hormat saya yang bertanda tangan dibawah ini:</p>
<h5>SISWA</h5>

<table style="font-size:12px">
	
	<tr>
		
		<td style="width:280px;">Nama Lengkap</td>
		<td>
			: <?php echo $model->nm_pd;?>
		</td>
		<td></td><td></td>
	</tr>
		<tr>
		<td>Jenis Kelamin</td>
		<td>
			: <?php if($model->jk=="L"){ echo "Laki-Laki"; } else { echo "Perempuan";};?> 
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Umur</td>
		<td>
			: <?php echo $umur;?> Tahun
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>NPSN</td>
		<td>
			: <?php echo $row['npsn'];?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Tempat/Tgl-Bln-Thn lahir (Kab-kota-prop).</td>
		<td>
			: <?php echo $model->tmpt_lahir;?> / <?php echo date('d-m-Y',strtotime($model->tgl_lahir));?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Anak ke, Jumlah Saudara</td>
		<td>
			: Ke <?php echo $modelBBM->anak_ke;?> dari <?php echo $modelBBM->jumlah_saudara;?> bersaudara
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>
			: <?php echo $model->agama['nm_agama'];?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>NIM</td>
		<td>
			: <?php echo $model->id_pd;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Jurusan</td>
		<td>
			: <?php echo $jurusan;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Fakultas</td>
		<td>
			: <?php echo $fakultas;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>UKT Kategori</td>
		<td>
			: UKT <?php echo $row['kelompok_ukt'];?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Rerata Nilai UN</td>
		<td>
			: <?php echo $modelBBM->rata2_un;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>Rerata Nilai Rapor Sekolah</td>
		<td>
			: <?php echo $modelBBM->rata2_raport;?>
		</td>
		<td></td><td></td>
	</tr>
	<tr>
		<td>- KELAS XI SMTR II / PERINGKAT</td>
		<td>
			: <?php echo $modelBBM->nilai_xi_ii;?> / <?php echo $modelBBM->peringkat_xi_ii;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- KELAS XII SMTR I / PERINGKAT</td>
		<td>
			: <?php echo $modelBBM->nilai_xii_i;?> / <?php echo $modelBBM->peringkat_xii_i;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- KELAS XII SMTR II / PERINGKAT</td>
		<td>
			: <?php echo $modelBBM->nilai_xii_ii;?> / <?php echo $modelBBM->peringkat_xii_ii;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>Prestasi Akademik Terbaik</td>
		<td></td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Lokal</td>
		<td>
			: <?php echo $modelBBM->prestasi_akademik_lokal;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Regional</td>
		<td>
			: <?php echo $modelBBM->prestasi_akademik_regional;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Nasional</td>
		<td>
			: <?php echo $modelBBM->prestasi_akademik_lokal_nasional;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Internasional</td>
		<td>
			: <?php echo $modelBBM->prestasi_akademik_internasional;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>Prestasi non-Akademik/Ko-Ekstrakulikuler <br>(sesuai sertifikat asli)</td>
		<td></td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Lokal</td>
		<td>
			: <?php echo $modelBBM->prestasi_nonakademik_lokal;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Regional</td>
		<td>
			: <?php echo $modelBBM->prestasi_nonakademik_regional;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Nasional</td>
		<td>
			: <?php echo $modelBBM->prestasi_nonakademik_nasional;?>
		</td><td></td><td></td>
	</tr>
	<tr>
		<td>- Tingkat Internasional</td>
		<td>
			: <?php echo $modelBBM->prestasi_nonakademik_internasional;?>
		</td><td></td><td></td>
	</tr>
</table>
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------</p>

<h5>ORANG TUA</h5>
<table style="font-size:12px">
	<tr>
		<td style="width:280px;">Nama Ayah/Wali</td>
		<td>                              
			: <?php echo $model->nm_ayah;?> 
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>
			: <?php echo $modelBBM->stat_ayah['nama_status'];?>
		</td>
	</tr>
	<tr>
		<td>Tempat tanggal lahir (Kab-kota-prop.)/ usia</td>
		<td>
			: <?php echo $modelBBM->tempat_lahir_ayah;?> / <?php echo date('d-m-Y',strtotime($model->tgl_lahir_ayah));?>
		</td>
	</tr>
	<tr>
		<td>Alamat/No HP</td>
		<td>
			: <?php echo $modelBBM->alamat_ayah;?> / <?php echo $modelBBM->no_hp_ayah;?>
		</td>
	</tr>
	<tr>
		<td>Penghasilan</td>
		<td>
			: <?php echo $model->penghasilanayah['nm_penghasilan'];?>
		</td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>
			  : <?php echo $model->kerjaayah['nm_pekerjaan'];?>
		</td>
	</tr>
	<tr>
		<td>Bekerja Sebagai</td>
		<td>
			: <?php echo $modelBBM->bekerja_ayah;?>
		</td>
	</tr>
	<tr>
		<td>Pendidikan</td>
		<td>
			: <?php echo $model->jenjdidikayah['nm_jenj_didik'];?>
		</td>
	</tr>
	<tr>
		<td>Jml. tanggungan keluarga</td>
		<td>
			: <?php echo $modelBBM->jumlah_tanggungan;?>
		</td>
	</tr>
	<tr>
		<td>Nama Ibu/Wali</td>
		<td>
			: <?php echo $model->nm_ibu_kandung;?>
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>
			: <?php echo $modelBBM->stat_ibu['nama_status'];?>
		</td>
	</tr>
	<tr>
		<td>Tempat tanggal lahir (Kab-Kota-Prop.)</td>
		<td>
			: <?php echo $modelBBM->tempat_lahir_ibu;?> / <?php echo date('d-m-Y',strtotime($model->tgl_lahir_ibu));?>
		</td>
	</tr>
	<tr>
		<td>No HP</td>
		<td>
			: <?php echo $modelBBM->no_hp_ibu;?>
		</td>
	</tr>
	<tr>
		<td>Penghasilan</td>
		<td>
			: <?php echo $model->penghasilanibu['nm_penghasilan'];?>
		</td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>
			: <?php echo $model->kerjaibu['nm_pekerjaan'];?>
		</td>
	</tr>
	<tr>
		<td>Pendidikan</td>
		<td>
			: <?php echo $model->jenjdidikibu['nm_jenj_didik'];?>
		</td>
	</tr>
</table>
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<h5>EKONOMI KELUARGA</h5>
<table style="font-size:13px">
	<tr>
		<td style="width:280px;">Penghasilan Ayah</td>
		<td>                              
			: <?php echo "Rp " . number_format($modelBBM->penghasilan_ayah,2,',','.');?> 
		</td>
	</tr>
	<tr>
		<td>Penghasilan Ibu</td>
		<td>                              
			: <?php echo "Rp " . number_format($modelBBM->penghasilan_ibu,2,',','.');?> 
		</td>
	</tr>
</table>
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<h5>RUMAH TINGGAL KELUARGA</h5>
<table style="font-size:13px">
	<tr>
		<td style="width:280px;">Kepemilikan</td>
		<td>                              
			: <?php echo $modelBBM->rumah['nama'];?> 
		</td>
	</tr>
	<tr>
		<td>Tahun Peroleh</td>
		<td>                              
			: <?php echo $modelBBM->tahun_peroleh_rumah;?> 
		</td>
	</tr>
	<tr>
		<td>Sumber Listrik</td>
		<td>                              
			: <?php echo $modelBBM->listrik['nama_listrik'];?> 
		</td>
	</tr>
</table>
<br>
<p style='text-align: justify !importtant;font-size: 11pt;font-family:Arial;'>
Dengan ini saya menyatakan bahwa seluruh data yang saya berikan sesuai isi formulir ini adalah benar dan saya berserta orang tua saya yang mengetahui permohonan ini bersedia dikenai sanksi dan dituntut secara hukum apabila tidak memberikan data dan informasi dengan benar dalam mengisi formulir ini dan saya akan mengikuti segala ketentuan yang berlaku bagi seluruh pelamar Bidik Misi UIN Suska Riau Tahun <?php echo date('Y');?>.
</p>		
<table style="font-size:13px">
	<tr>
		<td style="width:480px;"></td>
		<td>Pekanbaru, <?php echo date('d/m/Y');?></td>
	</tr>
	<tr>
		<td>Mengetahui :</td>
		<td></td>
	</tr>
	<tr valign="top">
		<td style="height:100px;">Orang Tua</td>
		<td></td>
	</tr>
	<tr>
		<td>( _____________________ )</td>
		<td align="center">( <u><?php echo $model->nm_pd;?> )</u></td>
	</tr>
</table>