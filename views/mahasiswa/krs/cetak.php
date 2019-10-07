<?php
$pdf->AliasNbPages();
$pdf->AddPage('L','Legal');  
$pdf->SetTitle("KRS-".$nama.$semester);                   
$pdf->SetFont('Times','b',14);
$y=$pdf->getY();
$pdf->Image('uploads/'.$nim.'.png',318,10,30,30);
$pdf->setY($y-2);
$pdf->setX(316);
$pdf->Cell(34,34,"",1,0,'C',false);  
$pdf->Ln(5); //Line break
$pdf->MultiCell(340,5,$header0,0,'C',false);
$pdf->MultiCell(340,5,$header,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->MultiCell(340,5,'',0,'R',false);
$pdf->Image('images/logo.jpg',10,10,25,25);
$pdf->Ln(5); //Line break
$pdf->MultiCell(340,5,$judul,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->SetFont('Times','',11);

$y=$pdf->getY();
$pdf->MultiCell(50,5,'NAMA MAHASISWA',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(120,5,': '.$nama,0,'L',false);
$pdf->setY($y);
$pdf->setX(200);
$pdf->MultiCell(50,5,'NIM',0,'L',false);
//start validation id
$pdf->SetFont('Times','',7);
$pdf->setY($y-5);
$pdf->setX(320);
$pdf->MultiCell(50,5,'Validation ID : '.$modelNotif->notif_id,0,'L',false);
//end validation id
$pdf->SetFont('Times','',11);
$pdf->setY($y);
$pdf->setX(240);
$pdf->MultiCell(90,5,': '.$nim,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'PENASEHAT AKADEMIK',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$pa,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'FAKULTAS',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$fakultas,0,'L',false);
$pdf->setY($y);
$pdf->setX(200);
$pdf->MultiCell(50,5,'TAHUN',0,'L',false);
$pdf->setY($y);
$pdf->setX(240);
$pdf->MultiCell(90,5,': '.$tahun,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'SEMESTER',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$semester,0,'L',false);
$pdf->setY($y);
$pdf->setX(200);
$pdf->MultiCell(50,5,'PRODI/LOKAL',0,'L',false);
$pdf->setY($y);
$pdf->setX(240);
$pdf->MultiCell(90,5,': '.$prodi,0,'L',false);
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
        $pdf->Cell(80,14,"NAMA MATA KULIAH",1,0,'C',false);
        $pdf->Cell(10,14,"SKS",1,0,'C',false);
        $pdf->Cell(20,14,"PROGRAM",1,0,'C',false);
        $pdf->Cell(60,14,"DOSEN",1,0,'C',false);
        $pdf->Cell(20,14,"KELAS",1,0,'C',false);
        $pdf->Cell(30,14,"THN KURIKULUM",1,0,'C',false);
        $pdf->Cell(70,7,"TANGGAL & PARAF PENGAWAS UJIAN",1,0,'C',false);

        $pdf->Ln(7);
        $pdf->Cell(10,7,"",0,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(40,7,"",0,0,'C',false);
        $pdf->Cell(80,7,"",0,0,'C',false);
        $pdf->Cell(10,7,"",0,0,'C',false);
        $pdf->Cell(20,7,"",0,0,'C',false);
        $pdf->Cell(60,7,"",0,0,'C',false);
        $pdf->Cell(20,7,"",0,0,'C',false);
        $pdf->Cell(30,7,"",0,0,'C',false);
        $pdf->Cell(35,7,"MID SEMESTER",1,0,'C',false);
        $pdf->Cell(35,7,"SEMESTER",1,0,'C',false);

        $pdf->Ln(7);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(224,224,224);
        $pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',8);
		//Data dari database
		$no=1;
		$sks=0;
		foreach($model as $db)
		{
			$sks=$sks+$db['sks_mk'];
			$pdf->Cell(10,6,$no,1,0,'C',false);
			$pdf->Cell(40,6,$db['kode_mk'],1,0,'C',false);
			$pdf->Cell(80,6,$db['nm_mk'],1,0,'L',false);
			$pdf->Cell(10,6,$db['sks_mk'],1,0,'C',false);
			$pdf->Cell(20,6,$db['nm_jenj_didik'],1,0,'C',false);
			$pdf->Cell(60,6,$db['nm_ptk'],1,0,'L',false);
			$pdf->Cell(20,6,$db['nm_kls'],1,0,'C',false);
			$pdf->Cell(30,6,$db['nm_kurikulum_sp'],1,0,'C',false);
			$pdf->Cell(35,6,'',1,0,'C',false);
			$pdf->Cell(35,6,'',1,0,'C',false);
			$pdf->Ln(6);
			$no++;
		}
        $pdf->Cell(130,7,"TOTAL SKS",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(10,7,$sks,1,0,'C',false);
        $pdf->Cell(200,7,"",1,0,'C',false);
		$pdf->Ln(8);
//selesai table nilai

//tanda tangan
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'MENYETUJUI',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(60,5,'PEKANBARU, '.date('d M Y'),0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'PEMBIMBING AKADEMIS,',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(60,5,'MAHASISWA YBS,',0,'L',false);
$pdf->Ln(4.5);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,$pa,0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(60,5,$nama,0,'L',false);
//Cetak PDF
$pdf->Output($judul.'.pdf','I');
?>
