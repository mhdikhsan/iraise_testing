<?php
$pdf->AliasNbPages();
$pdf->SetTitle($nm_jurusan." - ".$mk);
$pdf->AddPage('L','Legal');                     
$pdf->SetFont('Times','b',14);
$pdf->MultiCell(340,5,$header0,0,'C',false);
$pdf->MultiCell(340,5,$header,0,'C',false);
// $pdf->Ln(5); //Line break

$pdf->MultiCell(340,5,"BATAS MATERI KULIAH",0,'C',false);
$pdf->Ln(5); //Line break


$y=$pdf->getY();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(50,5,'MATA KULIAH',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(190,5,': '.$mk,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'SEMESTER',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
	if ($smt%2==0) 
	{ 
		$smth = "Genap"; 
	}else{
		$smth = "Ganjil"; 
	}
	if($smt==0){
		$smt="Pilihan";
	}
	
$pdf->MultiCell(90,5,': '.$smt.' / '.$smth.' / '.$kelas,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'DOSEN',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(190,5,': '.$dosen,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'SKS',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$sks,0,'L',false);
//Selesai biodata mk

//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'Hari / Jam',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$hari." / ".$jam_mulai." - ".$jam_selesai,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'Ruang',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$ruangan,0,'L',false);

		$pdf->Ln(1);
        $pdf->SetFont('Arial','',10);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(244,244,244); //Set background of the cell to be that grey color
        $pdf->SetTextColor(0,0,0);

        $pdf->Ln(1);
        $pdf->Cell(10,10,"NO",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(80,10,"HARI/TGL",1,0,'C',false); 
		$pdf->Cell(200,10,"MATERI",1,0,'C',false); 
		$pdf->Cell(50,10,"PARAF",1,0,'C',false); 
		$pdf->Ln(10);
		
		for ($i=1; $i <17; $i++)
		{
			$pdf->Cell(10,8,$i,1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
			$pdf->Cell(80,8,"",1,0,'C',false); 
			$pdf->Cell(200,8,"",1,0,'C',false); 
			$pdf->Cell(50,8,"",1,0,'C',false);
			$pdf->Ln(8);
		   
		}



$pdf->Ln(100); //Line break
$pdf->SetFont('Times','b',14);
$pdf->MultiCell(340,5,$judul,0,'C',false);
$pdf->Ln(0); //Line break

$pdf->SetFont('Times','',11);
$pdf->MultiCell(340,5,"PROGRAM STUDI ".$nm_jurusan." - FAKULTAS ".$fakultas,0,'C',false);
$pdf->Ln(0); 
$pdf->SetFont('Times','',11);

$y=$pdf->getY();
$pdf->MultiCell(50,5,'MATA KULIAH',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(190,5,': '.$mk,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'SEMESTER',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
	if ($smt%2==0) 
	{ 
		$smth = "Genap"; 
	}else{
		$smth = "Ganjil"; 
	}
	if($smt==0){
		$smt="Pilihan";
	}
$pdf->MultiCell(90,5,': '.$smt.' / '.$smth.' / '.$kelas,0,'L',false);
//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'DOSEN',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$dosen,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'SKS',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$sks,0,'L',false);
//Selesai biodata mk

//Baris baru
$y=$pdf->getY();
$pdf->MultiCell(50,5,'Hari / Jam',0,'L',false);
$pdf->setY($y);
$pdf->setX(60);
$pdf->MultiCell(90,5,': '.$hari." / ".$jam_mulai." - ".$jam_selesai,0,'L',false);
$pdf->setY($y);
$pdf->setX(270);
$pdf->MultiCell(60,5,'Ruang',0,'L',false);
$pdf->setY($y);
$pdf->setX(300);
$pdf->MultiCell(90,5,': '.$ruangan,0,'L',false);

//mulai table nilai
//Line break
        $pdf->Ln(1);
        $pdf->SetFont('Arial','',10);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(244,244,244); //Set background of the cell to be that grey color
        $pdf->SetTextColor(0,0,0);

        $pdf->Ln(1);
        $pdf->Cell(10,14,"NO",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(55,14,"NAMA MAHASISWA",1,0,'C',false);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'false' tells it to fill the cell with the color specified
        $pdf->Cell(25,14,"NIM",1,0,'C',false);
        
        
        $pdf->Cell(224,7,"PERTEMUAN KE / HARI / TANGGAL",1,0,'C',false);
		 $pdf->Cell(30,14,"Ket",1,0,'C',false);
        $pdf->Ln(7);
		  $pdf->Cell(40,7,"",0,0,'C',false);
        $pdf->Cell(50,7,"",0,0,'C',false);
        // $pdf->Cell(10,7,"",0,0,'C',false);
        $pdf->Cell(14,7,"1",1,0,'C',false);
        $pdf->Cell(14,7,"2",1,0,'C',false);
        $pdf->Cell(14,7,"3",1,0,'C',false);
        $pdf->Cell(14,7,"4",1,0,'C',false);
        $pdf->Cell(14,7,"5",1,0,'C',false);
        $pdf->Cell(14,7,"6",1,0,'C',false);
        $pdf->Cell(14,7,"7",1,0,'C',false);
        $pdf->Cell(14,7,"8",1,0,'C',false);
        $pdf->Cell(14,7,"9",1,0,'C',false);
        $pdf->Cell(14,7,"10",1,0,'C',false);
        $pdf->Cell(14,7,"11",1,0,'C',false);
        $pdf->Cell(14,7,"12",1,0,'C',false);
        $pdf->Cell(14,7,"13",1,0,'C',false);
        $pdf->Cell(14,7,"14",1,0,'C',false);
        $pdf->Cell(14,7,"15",1,0,'C',false);
        $pdf->Cell(14,7,"16",1,0,'C',false);

        $pdf->Ln(7);

        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(224,224,224);
        $pdf->SetTextColor(0,0,0);
		//Data dari database
		$no=1;
		$sks=0;
		foreach($modelnilai as $db)
		{
			if(strlen($db['nm_pd'])>23){
				$nm_pd = substr($db['nm_pd'],0,24)."-";
			}else{
				$nm_pd = $db['nm_pd'];
			}
			// $sks=$sks+$db->mk['sks_mk'];
			$pdf->Cell(10,7,$no,1,0,'C',false);
			$pdf->Cell(55,7,$nm_pd,1,0,'L',false);
			$pdf->Cell(25,7,$db['id_pd'],1,0,'C',false);
			
			
			//$pdf->Cell(55,7,$db->mhs['nm_pd'],1,0,'L',false);
			//$pdf->Cell(25,7,$db->mhs['id_pd'],1,0,'C',false);
			// $pdf->Cell(10,7,$db->mk['sks_mk'],1,0,'C',false);
			// $pdf->Cell(20,7,$db->program['nm_jenj_didik'],1,0,'C',false);
			// $pdf->Cell(60,7,$db->dosen2['nm_ptk'],1,0,'C',false);
			// $pdf->Cell(20,7,$db->kls['nm_kls']1,0,'C',false);
			// $pdf->Cell(30,7,$db->k['nm_kurikulum'],1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(30,7,'',1,0,'C',false);
			
			// $pdf->Cell(35,7,'',1,0,'C',false);
			  $pdf->Ln(7);
			 $no++;
		}
			
			$pdf->SetDrawColor(0,0,0);
			$pdf->SetFillColor(224,224,224);
			$pdf->SetTextColor(0,0,0);
			
			$pdf->Cell(90,7,'PARAF DOSEN',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(30,7,'',1,0,'C',false);
			$pdf->Ln(7);
			
			$pdf->Cell(90,7,'PARAF AKADEMIK',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(30,7,'',1,0,'C',false);
			$pdf->Ln(7);
			
			$pdf->Cell(90,7,'JUMLAH MAHASISWA YANG HADIR HARI INI',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(14,7,'',1,0,'C',false);
			$pdf->Cell(30,7,'',1,0,'C',false);
			$pdf->Ln(7);
			
			$y=$pdf->getY();
			$pdf->MultiCell(50,5,'CATATAN :',0,'L',false);
			$pdf->MultiCell(300,5,'* Jumlah tatap muka / pertemuan mahasiswa tidak boleh kurang dari 80% ',0,'L',false);
			$pdf->MultiCell(300,5,'* Absen harus di tandangangi tidak boleh di cheklist ',0,'L',false);
			$pdf->MultiCell(300,5,'* Pakain untuk mahasiswa : tidak boleh memakai sandal, kaos oblong, sandal, anting, kalung, gelang ',0,'L',false);
			$pdf->MultiCell(300,5,'* Pakaian untuk mahasiswi : Tidak boleh memakai sandal, kaos ketat dan baju transparan',0,'L',false);
			
			
			
			
$pdf->Output($judul.'.pdf','I');
?>
