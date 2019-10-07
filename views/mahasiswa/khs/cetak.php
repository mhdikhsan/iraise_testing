<?php
$pdf->AliasNbPages();
$pdf->AddPage('L','Legal');     
$pdf->SetTitle("KHS".$semester.$nama);                
$pdf->SetFont('Times','b',14);
$pdf->MultiCell(340,5,$header0,0,'C',false);
$pdf->MultiCell(340,5,$header,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->MultiCell(340,5,'',0,'R',false);
$pdf->Image('images/logo.jpg',10,10,30,30);
$pdf->Ln(5); //Line break
$pdf->MultiCell(340,5,$judul,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->SetFont('Times','',11);

$y=$pdf->getY();
$pdf->MultiCell(50,5,'NAMA MAHASISWA',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$nama,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'FAKULTAS',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$fakultas,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'NIM',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$nim,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'PRODI/LOKAL',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$prodi,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'PENASEHAT AKADEMIK',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$pa,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'SMT - TAHUN',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$semester.$tahun,0,'L',false);
//Selesai biodata mahasiswa

//mulai table nilai
//Line break
        $pdf->Ln(1);
        $pdf->SetFont('Arial','',10);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(244,244,244); //Set background of the cell to be that grey color
        $pdf->SetTextColor(0,0,0);

        $pdf->Ln(1);
        $pdf->Cell(10,14,"NO",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(40,14,"KODE MATA KULIAH",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(110,14,"NAMA MATA KULIAH",1,0,'C',false);
        $pdf->Cell(20,14,"NILAI (N)",1,0,'C',false);
        $pdf->Cell(20,14,"BOBOT",1,0,'C',false);
        $pdf->Cell(30,14,"KREDIT (SKS)",1,0,'C',false);
        $pdf->Cell(40,14,"NILAI MUTU (N X K)",1,0,'C',false);
        $pdf->Cell(60,14,"KETERANGAN",1,0,'C',false);

        $pdf->Ln(14);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(224,224,224);
        $pdf->SetTextColor(0,0,0);
		//Data dari database
		$no=1;
		$sks=0;
		$bobot=0;
		foreach($model as $db)
		{
			$sks=$sks+$db->mk['sks_mk'];
			$bobot=$bobot+($db->mk['sks_mk']*$db->nilai_indeks);
			$pdf->Cell(10,5,$no,1,0,'C',false);
			$pdf->Cell(40,5,$db->mk['kode_mk'],1,0,'C',false);
			$pdf->Cell(110,5,$db->mk['nm_mk'],1,0,'L',false);
			$pdf->Cell(20,5,$db->nilai_huruf,1,0,'C',false);
			$pdf->Cell(20,5,$db->nilai_indeks,1,0,'C',false);
			$pdf->Cell(30,5,$db->mk['sks_mk'],1,0,'C',false);
			$pdf->Cell(40,5,($db->mk['sks_mk']*$db->nilai_indeks),1,0,'C',false);
			$pdf->Cell(60,5,'',1,0,'C',false);
			$pdf->Ln(5);
			$no++;
		}
        $pdf->Cell(200,7,"JUMLAH",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(30,7,$sks,1,0,'C',false);
        $pdf->Cell(40,7,$bobot,1,0,'C',false);
        $pdf->Cell(60,7,'IP : '.@number_format($bobot/$sks,2),1,0,'C',false);
		$pdf->Ln(10);
//selesai table nilai
$pdf->MultiCell(300,5,'Catatan : JUMLAH MAKS. KREDIT YANG BOLEH DIAMBIL PADA SEMESTER BERIKUTNYA : '.$sks_total.' SKS',0,'L',false);

//tanda tangan
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(60,5,'PEKANBARU, '.date('d M Y'),0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(60,5,$StgFak->jabatan,0,'L',false);
$pdf->Ln(18);
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(60,5,$StgFak->pimpinan,0,'L',false);
$pdf->setX(300);
$pdf->MultiCell(60,5,$StgFak->nip,0,'L',false);
//Cetak PDF
$pdf->Output($judul.'.pdf','I');
?>
