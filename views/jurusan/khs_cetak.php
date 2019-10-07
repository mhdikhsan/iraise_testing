<?php
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal');   
$pdf->Ln(15);
$pdf->SetTitle("KHS".$semester.$nama);                
$pdf->SetFont('Arial','b',12);
$pdf->MultiCell(220,5,$header0,0,'C',false);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(220,5,$header,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->MultiCell(340,5,'',0,'R',false);
$pdf->Image('images/logo.jpg',6,27,20,20);
$pdf->Ln(5); //Line break
$pdf->MultiCell(220,5,$judul,0,'C',false);
$pdf->Ln(5); //Line break
$pdf->SetFont('Arial','',8);

$y=$pdf->getY();
$pdf->MultiCell(50,5,'NAMA MAHASISWA',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$nama,0,'L',false);
$pdf->setY($y);
$pdf->setX(140);
$pdf->MultiCell(60,5,'FAKULTAS',0,'L',false);
$pdf->setY($y);
$pdf->setX(160);
$pdf->MultiCell(90,5,': '.$fakultas,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'NIM',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$nim,0,'L',false);
$pdf->setY($y);
$pdf->setX(140);
$pdf->MultiCell(60,5,'PROG.STUDI',0,'L',false);
$pdf->setY($y);
$pdf->setX(160);
$pdf->MultiCell(90,5,': '.$prodi,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'PENASEHAT AKADEMIK',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$pa,0,'L',false);
$pdf->setY($y);
$pdf->setX(140);
$pdf->MultiCell(60,5,'SMT - TAHUN',0,'L',false);
$pdf->setY($y);
$pdf->setX(160);
$pdf->MultiCell(90,5,': '.$semester." - ".$tahun,0,'L',false);
//Selesai biodata mahasiswa

//mulai table nilai
//Line break
        $pdf->Ln(1);
        $pdf->SetFont('Arial','',8);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(244,244,244); //Set background of the cell to be that grey color
        $pdf->SetTextColor(0,0,0);

        $pdf->Ln(1);
        $pdf->Cell(8,14,"NO",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(25,14,"KODE",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(70,14,"NAMA MATA KULIAH",1,0,'C',false);
        $pdf->Cell(13,14,"NILAI ",1,0,'C',false);
        $pdf->Cell(13,14,"BOBOT",1,0,'C',false);
        $pdf->Cell(20,14,"KREDIT",1,0,'C',false);
        $pdf->Cell(25,14,"NILAI MUTU",1,0,'C',false);
        $pdf->Cell(25,14,"KET",1,0,'C',false);
        $pdf->Ln(7);

        $pdf->Cell(8,7,"",0,0,'C',false);
        $pdf->Cell(25,7,"MATA KULIAH",0,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(70,7,"",0,0,'C',false);
        $pdf->Cell(13,7,"(N)",0,0,'C',false);
        $pdf->Cell(13,7,"",0,0,'C',false);
        $pdf->Cell(20,7,"(SKS)",0,0,'C',false);
        $pdf->Cell(25,7,"(N X K)",0,0,'C',false);
        $pdf->Cell(25,7,"",0,0,'C',false);

        $pdf->Ln(7);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(224,224,224);
        $pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',8);
		//Data dari database
		$no=1;
		$sks=0;
		$bobot=0;
		foreach($model as $db)
		{
			$sks=$sks+$db->mk['sks_mk'];
			$bobot=$bobot+($db->mk['sks_mk']*$db->nilai_indeks);
			$x=$db->mk['nm_mk'];
			$n=4;
			// $kata=strtok(strip_tags($x)," "); 
			$kata=substr(strip_tags($x),0,35); 
			$new=$kata;
			// $new="";
			// for ($i=1; $i<=$n; $i++){    //membatasi berapa kata yang akan ditampilkan di halaman utama
				// $new.=$kata;		//tulis isi agenda
				// $new.=" ";
				// $kata=strtok(" ");
			// }
			// $count = count(explode(" ", $x));
			$count = strlen($x);
			if($count>35)
			{			
				$pdf->Cell(199,10,'',1,0,'L',false);
				$pdf->Ln(0);
				$pdf->Cell(8,10,$no,1,0,'C',false);
				$pdf->Cell(25,10,$db->mk['kode_mk'],1,0,'C',false);
				$pdf->Cell(70,5,$new,0,0,'L',false);
				$pdf->Cell(13,10,$db->nilai_huruf,1,0,'C',false);
				$pdf->Cell(13,10,number_format($db->nilai_indeks,1),1,0,'C',false);
				$pdf->Cell(20,10,$db->mk['sks_mk'],1,0,'C',false);
				$pdf->Cell(25,10,number_format(($db->mk['sks_mk']*$db->nilai_indeks),2),1,0,'C',false);
				$pdf->Cell(25,10,'',1,0,'C',false);
				$pdf->Ln(5);
								
				$kata=substr(strip_tags($x),35,100); 
				$new=$kata;
				
				$pdf->Cell(8,5,'',0,0,'C',false);
				$pdf->Cell(25,5,'',0,0,'C',false);
				$pdf->Cell(70,5,$new,0,0,'L',false);
				$pdf->Cell(13,5,'',0,0,'C',false);
				$pdf->Cell(13,5,'',0,0,'C',false);
				$pdf->Cell(20,5,'',0,0,'C',false);
				$pdf->Cell(25,5,'',0,0,'C',false);
				$pdf->Cell(25,5,'',0,0,'C',false);
				$pdf->Ln(5);
			}else{
				$pdf->Cell(8,5,$no,1,0,'C',false);
				$pdf->Cell(25,5,$db->mk['kode_mk'],1,0,'C',false);
				$pdf->Cell(70,5,$new,1,0,'L',false);
				$pdf->Cell(13,5,$db->nilai_huruf,1,0,'C',false);
				$pdf->Cell(13,5,number_format($db->nilai_indeks,1),1,0,'C',false);
				$pdf->Cell(20,5,$db->mk['sks_mk'],1,0,'C',false);
				$pdf->Cell(25,5,number_format(($db->mk['sks_mk']*$db->nilai_indeks),2),1,0,'C',false);
				$pdf->Cell(25,5,'',1,0,'C',false);
				$pdf->Ln(5);
			}
			
			$no++;
		}
        $pdf->Cell(129,7,"JUMLAH",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(20,7,$sks,1,0,'C',false);
        $pdf->Cell(25,7,number_format($bobot,2),1,0,'C',false);
        $pdf->Cell(25,7,'IP : '.$ip=number_format($bobot/$sks,2),1,0,'C',false);
		$pdf->Ln(7);
        $pdf->Cell(129,7,"JUMLAH KUMULATIF DAHULU",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
		
        // $pdf->Cell(20,7,$ipk_sks,1,0,'C',false);
        // $pdf->Cell(25,7,number_format($ipk=($ipk_ip),2),1,0,'C',false);
        $pdf->Cell(20,7,$sks_fix-$sks,1,0,'C',false);
        $pdf->Cell(25,7,number_format($bobot_fix-$bobot,2),1,0,'C',false);
        $pdf->Cell(25,7,'',1,0,'C',false);
		$pdf->Ln(7);
        $pdf->Cell(129,7,"JUMLAH KUMULATIF SEKARANG",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
		
        // $pdf->Cell(20,7,$sks=$sks+$ipk_sks,1,0,'C',false);
        // $pdf->Cell(25,7,number_format($nm=$bobot+$ipk,2),1,0,'C',false);
        $pdf->Cell(20,7,$sks_fix,1,0,'C',false);
        $pdf->Cell(25,7,number_format($bobot_fix,2),1,0,'C',false);
		// if($ipk_khs<=0):
			// $ipk_khs=$nm/$sks;
		// endif;
        $pdf->Cell(25,7,'IPK : '.$ipk_fix,1,0,'C',false);
		$pdf->Ln(10);
		
		
//selesai table nilai
$pdf->MultiCell(300,5,'CATATAN : JUMLAH MAKS. KREDIT YANG BOLEH DIAMBIL PADA SEMESTER BERIKUTNYA : '.$this->sksMaks($nim,$db->semester,$ip,$sks).' SKS',0,'L',false);

$array_bulan = array(1=>'JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','Oktober','NOVEMBER','DESEMBER');
$bulan = $array_bulan[date('n')];
//tanda tangan
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(150);
$pdf->MultiCell(60,5,'PEKANBARU, '.date('d')." ". $bulan." ".date('Y') ,0,'L',false);

$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(146.5);
$pdf->MultiCell(60,5,"AN.Dekan ",0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(150);
$pdf->MultiCell(60,5,$StgFak->jabatan,0,'L',false);
$pdf->Ln(18);
//Baris baru
$y=$pdf->getY();
$pdf->setY($y);
$pdf->setX(150);
$pdf->MultiCell(60,5,$StgFak->pimpinan,0,'L',false);
$pdf->setX(150);
$pdf->MultiCell(60,5,$StgFak->nip,0,'L',false);
//Cetak PDF
$pdf->Output($judul.'.pdf','I');
?>
