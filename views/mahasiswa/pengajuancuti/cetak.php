<style>
table {
    border-collapse:collapse;
    margin-left: 30px;

}
h4 {
	font-size:16px;
	text-align:center;
	
}
p {
	margin-left: 30px;
	margin-right: 30px;
	text-align:justify;
	line-height:20px;
}
</style>

<?php

$id_smt='';
$nim='';
$nama='';
$prodi='';
$fakultas='';
$alamat='';
$nohp='';
$tglmasuk='';
$semester='';
$ipk='';
$id_smt='';
$totalsks='';
$dosen='';
$pimpinan='';
$pimpinan_nip='';
$nipdosen='';
 foreach ($sql as $data) :

$smt2 = $data['smt2'];
$smt3 = $data['smt3'];
$nmthn = $data['nm_thn_ajaran'];
$nama = $data['nm_pd'];
$nim = $data['id_pd'];
$fakultas =$data['fakul'];
$nomor = $data['nomor'];
$prodi = $data['prodi'];
$alamat = $data['jln'];
$nohp =$data['telepon_seluler'];
$tglmasuk = substr($data['regpd_tgl_masuk_sp'],0,4);
$semester = $data['smt'];
$ipk = $data['ipk'];
$id_smt = $data['id_smt'];
$totalsks =0;
$dosen = $data['dosen'];
$nipdosen = $data['nipdosen'];
$pimpinan = $data['pimpinan'];
$pimpinan_nip = $data['pimpinan_nip'];

	endforeach;
	
		$sql = Yii::app()->db->createCommand("select sum(sks_smt) as totalsks from kuliah_mhs where id_smt <='". $id_smt . "' and id_reg_pd='".$nim."'")->queryAll();
		
		foreach ($sql as $data) :
			$totalsks = $data['totalsks'];
		endforeach;
		$sksbelum = 144 - $totalsks;
		if ($sksbelum <0) $sksbelum =0;
		
?>


<h4>SURAT PERMOHONAN CUTI KULIAH </h4>
<br><br><br>

<p style="text-align:right"> Pekanbaru, <?=date("d F Y") ?></p>
<p>Kepada Yth. Rektor UIN SUSKA RIAU <br>
c.q Kepala Biro Administrasi Akademik kemahasiswaan dan Kerjasama</p>
			 
<p style="padding-top:30px">Saya yang bertanda tangan dibawah ini : </p>


<table >
	<tr>
		<td>NIM</td>		<td>:</td>	<td><?=$nim ?></td>
	</tr>
	<tr>
		<td style="width: 20mm;">Nama</td>		<td style="width: 10mm;">:</td>	<td ><?=$nama?></td>
	</tr>
	<tr>
		<td style="width: 20mm;">Prodi</td>		<td style="width: 10mm;">:</td>	<td ><?=$prodi?></td>
	</tr>
	<tr>
		<td>Fakultas</td>	<td>:</td>	<td><?=$fakultas?></td>
	</tr>
	<tr>
		<td>Alamat</td>	<td>:</td>	<td><?=$alamat?></td>
	</tr>
	<tr>
		<td>No.HP</td>	<td>:</td>	<td><?=$nohp?></td>
	</tr>
	<tr>
		<td>Alamat Orang Tua</td>	<td>:</td>	<td><?=$alamat?></td>
	</tr>
	<tr>
		<td>Terdaftar pada tahun akademik</td>	<td>:</td>	<td><?=$tglmasuk?></td>
	</tr>
	<tr>
		<td>Semester yang telah di ikuti</td>	<td>:</td>	<td><?=$semester?></td>
	</tr>
	<tr>
		<td>IPK terakhir</td>	<td>:</td>	<td><?=$ipk?></td>
	</tr>
	<tr>
		<td>Jumlah SKS yang telah diselesaikan</td>	<td>:</td>	<td><?=$totalsks?></td>
	</tr>
	<tr>
		<td>Jumlah SKS yang belum diselesaikan</td>	<td>:</td>	<td><?php if ($totalsks>0) echo $sksbelum?></td>
	</tr>	
</table>


		
<p> Dengan ini mengajukan permohonan Cuti Kuliah selama 1 tahun (2 semester berturut-turut).  
<br>
Surat permohonan ini saya ajuan dengan pertimbangan sebagai berikut : <br>
1. <br>
2. <br>
3. <br>
<br>
Demikian permohonan saya, atas perhatian dan kebijaksanaan bapak/ibu saya ucapkan terimakasih.
</p>
		
<table>
	<tr>
		<td style="width: 120mm;">
		
		
		
		</td>
		<td style="width: 200mm;">
			<p> Hormat Saya, <br>
			Pemohon <br><br><br><br>
			
			<u><?=$nama ?></u><br>
			NIM.<?=$nim ?>
			</p>
		
		</td>
	</tr>
</table>

			<p style="text-align:center"> Menyutujui
			</p>
			
<table>

	
	<tr>
		<td style="width: 100mm;">
		<p>Penasehat Akademik
		<br><br><br><br>
		<u><?=$dosen?></u>
		<br>
		NIP.<?=$nipdosen?>
		</p>
		</td>
		
		<td style="width: 100mm;">
		<p>Ketua Prodi
		<br><br><br><br>
		<u><?=$pimpinan?></u>
		<br>
		<?=$pimpinan_nip?>
		</p>
		</td>

		
	</tr>
	
</table>





		
		