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
$pdf->Image('uploads/'.$model->id_ptk.'.png',185,10,20,20);
$pdf->setY($y-2);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(320,5,'Angkatan',0,'C',false);
$pdf->SetFont('Arial','b',23);
$pdf->Ln(1); //Line break
$pdf->MultiCell(320,5,$tahun,0,'C',false);
$pdf->Ln(10); //Line break


$pdf->SetFont('Times','',12);
//Baris baru
$y1=$pdf->getY();
$x1=10;$x2=40;
$lb=1;
$pdf->setX($x1);
$pdf->MultiCell(50,5,'NIP',0,'L',false);
$pdf->setY($y1);
$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$model->id_ptk,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->SetFont('Arial','',6);
$pdf->setY($y1-2);
$pdf->MultiCell(370,5,'Validation ID : '.$modelNotif->notif_id,0,'C',false);
$pdf->Ln($lb); //Line break

$pdf->SetFont('Times','',12);
//Baris baru
$pdf->setY($y);
$pdf->setX($x1);
$pdf->MultiCell(50,5,'Nama Dosen',0,'L',false);
$pdf->setY($y);
$pdf->setX($x2);
$pdf->MultiCell(90,5,': '.$model->nm_ptk,0,'L',false);
$pdf->Ln($lb); //Line break

//Line break
$pdf->Ln(1);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFillColor(0,10,10); //Set background of the cell to be that grey color
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','b',10);
$w=9;
$pdf->Ln(1);
$pdf->Cell(10,$w,"NO",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with 
$pdf->Cell(30,$w,"NIM",1,0,'C',false);
$pdf->Cell(110,$w,"NAMA",1,0,'C',false);
$pdf->Cell(45,$w,"PARAF",1,0,'C',false);

$pdf->Ln($w);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFillColor(224,224,224);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$no=1;
//Data dari database
foreach($modelBak->dosen($tahun)->getData() as $db)
{
	$w=9;
	$pdf->Cell(10,$w,$no,1,0,'C',false);
	$pdf->Cell(30,$w,$db['id_pd'],1,0,'C',false);
	$pdf->Cell(110,$w,$db['mhs']['nm_pd'],1,0,'L',false);
	$pdf->Cell(45,$w,'',1,0,'C',false);
	$pdf->Ln($w);
	$no++;
}


//tanda tangan

$pdf->SetFont('Times','',12);
$pdf->Ln(16);
//Baris baru
$y=$pdf->getY();
$jarak_kanan=140;
$pdf->setX($jarak_kanan);
$pdf->MultiCell(60,5,'PEKANBARU, '.date('d M Y'),0,'L',false);
$pdf->setX($jarak_kanan);
$pdf->MultiCell(50,5,'MENYETUJUI',0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->setX($jarak_kanan);
$pdf->MultiCell(100,5,'PEMBIMBING AKADEMIS,',0,'L',false);
$pdf->Ln(16);
//Baris baru
$y=$pdf->getY();
$pdf->setX($jarak_kanan);
$pdf->MultiCell(100,5,$model->nm_ptk,0,'L',false);
$pdf->setX($jarak_kanan);
$pdf->MultiCell(100,5,'NIP.'.$model->id_ptk,0,'L',false);

//Cetak PDF
$pdf->Output($judul.'.pdf','I');
?>
