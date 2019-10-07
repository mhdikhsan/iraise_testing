<?php

$pdf->AliasNbPages();
$pdf->SetTitle($nm_jurusan." - ".$mk);
$pdf->AddPage('P','Legal');                     
$pdf->SetFont('Times','b',14);
$pdf->MultiCell(140,5,$header0,0,'C',false);
$pdf->MultiCell(140,5,$header,0,'C',false);
// $pdf->Ln(5); //Line break
// $pdf->MultiCell(340,5,'MODEL : A',0,'R',false);
$pdf->Ln(5); //Line break
$pdf->MultiCell(220,5,$judul,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->SetFont('Times','',8);

$y=$pdf->getY();
$pdf->MultiCell(50,5,'MATA KULIAH',0,'L',false);
$pdf->setY($y);
$pdf->setX(40);
$pdf->MultiCell(90,5,': '.$mk,0,'L',false);
$pdf->setY($y);
$pdf->setX(130);
$pdf->MultiCell(60,5,'SEMESTER/KLS',0,'L',false);
$pdf->setY($y);
$pdf->setX(160);
$pdf->MultiCell(90,5,': '.$smt."/".$kls,0,'L',false);

//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'DOSEN',0,'L',false);
$pdf->setY($y);
$pdf->setX(40);
$pdf->MultiCell(90,5,': '.$dosen,0,'L',false);
$pdf->setY($y);
$pdf->setX(130);
$pdf->MultiCell(60,5,'SKS',0,'L',false);
$pdf->setY($y);
$pdf->setX(160);
$pdf->MultiCell(90,5,': '.$sks,0,'L',false);
//Selesai biodata mk

//mulai table nilai
//Line break
        $pdf->Ln(1);
        $pdf->SetFont('Arial','',10);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(244,244,244); //Set background of the cell to be that grey color
        $pdf->SetTextColor(0,0,0);

        $pdf->Ln(1);
        $pdf->Cell(10,14,"NO",1,0,'C',false); 
        $pdf->Cell(55,14,"NAMA MAHASISWA",1,0,'C',false); 
        $pdf->Cell(25,14,"NIM",1,0,'C',false);
        
        
        $pdf->Cell(100,7,"Pertemuan",1,0,'C',false);
		
        $pdf->Ln(7);
		  $pdf->Cell(40,7,"",0,0,'C',false);
        $pdf->Cell(50,7,"",0,0,'C',false);
        // $pdf->Cell(10,7,"",0,0,'C',false);
        $pdf->Cell(60,7,"Tanda Tangan",1,0,'C',false);
        $pdf->Cell(40,7,"Keterangan",1,0,'C',false);
        

        $pdf->Ln(7);

        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(224,224,224);
        $pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',8);
		//Data dari database
		$no=1;
		$sks=0;
		foreach($modelnilai as $db)
		{
			// $sks=$sks+$db->mk['sks_mk'];
			$pdf->Cell(10,6,$no,1,0,'C',false);
			$pdf->Cell(55,6,$db['nm_pd'],1,0,'L',false);
			$pdf->Cell(25,6,$db['id_pd'],1,0,'L',false);
			if($no% 2 == 1) {
				$pdf->Cell(60,6,$no,1,0,'L',false);
			}
			else{
				$pdf->Cell(60,6,$no,1,0,'C',false);
			}
			
			$pdf->Cell(40,6,'',1,0,'L',false);
			
			$pdf->Ln(6);
			$no++;
		}
			
			$pdf->SetDrawColor(0,0,0);
			$pdf->SetFillColor(224,224,224);
			$pdf->SetTextColor(0,0,0);
			
			$pdf->Cell(90,7,'Paraf Dosen',1,0,'C',false);
			
			$pdf->Cell(60,7,'',1,0,'C',false);
			$pdf->Cell(40,7,'',1,0,'C',false);
		
$pdf->Output($judul.'.pdf','I');
?>
