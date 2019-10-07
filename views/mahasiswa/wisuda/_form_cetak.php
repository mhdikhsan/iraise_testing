<?php
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter');     
$pdf->SetTitle($judul);                
$pdf->Ln(4); //Line break
$pdf->SetFont('Arial','b',14);
$pdf->setX(30);
$y=$pdf->getY();
$pdf->MultiCell(150,5,$header0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->setX(30);
$pdf->MultiCell(250,5,$header,0,'L',false);
$pdf->Ln(5); //Line break
$pdf->Image('images/logo.jpg',10,10,15,15);
$pdf->Image('images/garis.png',25,10,5,15);
$pdf->Image('images/no-image.jpg',170,30,35,40);
$pdf->Image('images/no-image.jpg',170,80,35,40);
$pdf->Image('images/no-image.jpg',170,130,35,40);
$pdf->setY($y);
$pdf->MultiCell(340,5,'No Validasi',0,'C',false);
$pdf->Ln(16); //Line break
$pdf->SetFont('Times','',12);

$y=$pdf->getY();
//Baris baru
$y=$pdf->getY();
$x1=15;$x2=80;
$lb=3;
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Nomor Induk Mahasiswa',0,'L',false);
$pdf->setY($y);
$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$nim,0,'L',false);
$pdf->Ln($lb); //Line break
//Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Nama Mahasiswa',0,'L',false);
$pdf->setY($y);
$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$nama,0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(100,5,'Nomor Surat Keterangan Lulus',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelWisuda->skl_no_fak.$modelWisuda->skl_no.'/'.$modelWisuda->skl_no_tahun,0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(100,5,'Nomor Bebas Pustaka Universitas',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelWisuda->lib_univ.$modelWisuda->lib_univ_no.'/'.$modelWisuda->lib_univ_tahun,0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Jenis Kelamin',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.($modelMhs->jk=='L'?'Laki -Laki':'Perempuan'),0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Tempat / Tanggal Lahir',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelMhs->tmpt_lahir.' / '.($this->ubahTgl($modelMhs->tgl_lahir)),0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Nomor HP/Telepon',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelMhs->telepon_seluler,0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Fakultas',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.ucwords(strtolower($fakultas)),0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Program Studi',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.ucwords(strtolower($prodi)),0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Konsentrasi',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelWisuda->kons['kons_nama'],0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Tanggal Lulus',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.($this->ubahTgl($modelWisuda->wis_tgl_lulus)),0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'IPK',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelWisuda->wis_ipk,0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Predikat Kelulusan',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$modelWP->pred_nama,0,'L',false);
$pdf->Ln($lb); //Line break
// Baris baru
$y=$pdf->getY();
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Judul Skripsi/Tesis/Disertasi',0,'L',false);
$pdf->setY($y);$pdf->setX($x2);
$y=$pdf->getY();
$pdf->MultiCell(85,5,':',0,'J',false);
$pdf->setY($y);$pdf->setX($x2+2);
$pdf->MultiCell(85,5,$modelWisuda->wis_judul,0,'J',false);
$pdf->Ln($lb); //Line break
//Selesai biodata mahasiswa

$pdf->Ln(10);

//tanda tangan
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX($x1);
$pdf->MultiCell(60,5,'Mengetahui ',0,'L',false);
$pdf->setY($y);
$pdf->setX(110);
$pdf->MultiCell(60,5,'Pekanbaru, '.$this->ubahTgl(date('Y-m-d')),0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX($x1);
if(ucwords(strtolower($fakultas))=='Pascasarjana')
{
	$kasubag='Administrasi Umum';
}else{
	$kasubag='Fakultas';
}
$pdf->MultiCell(60,5,ucwords(strtolower($StgFak->jabatan3)).' '.$kasubag,0,'L',false);
$pdf->setY($y);
$pdf->setX(110);
$pdf->MultiCell(60,5,'Wassalam',0,'L',false);
$pdf->setX($x1);
$pdf->MultiCell(60,5,ucwords(strtolower($fakultas)),0,'L',false);
$pdf->Ln(18);
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX($x1);
$pdf->MultiCell(60,5,$StgFak->pimpinan3,0,'L',false);
$pdf->setX($x1);
$pdf->MultiCell(60,5,$StgFak->nip3,0,'L',false);
$pdf->setY($y);
$pdf->setX(110);
$pdf->MultiCell(60,5,$nama,0,'L',false);
$pdf->setX(110);
$pdf->MultiCell(60,5,'Nim.'.$nim,0,'L',false);
$pdf->Ln(10);
$pdf->SetFont('Times','b',12);
$pdf->MultiCell(190,5,'Catatan : Silahkan Cek Hasil Print Out Anda ini, Segala Kesalahan Yang Terjadi Diluar Tanggung Jawab Panitia Wisuda, Apabila Ada Kesalahan Harap Menghubungi Panitia di Bagian Akademik Rektorat UIN SUSKA Riau.',0,'J',false);
//Cetak PDF
$pdf->Output($judul.'.pdf','I');
?>
