<?php
	require('vendor/fpdf/fpdf.php');

	$connect = mysqli_connect('localhost','root','');
	mysqli_select_db($connect,'egm_expense');


	class PDF extends FPDF {
		function Header(){
			$this->SetFont('Arial','B',15);

			$this->Cell(12);

			$this->Image('images/egavilanmedia.jpg',10,10,30);

			$this->Ln(4);
			
			$this->SetTextColor(7, 56, 99);
			$this->SetX(120);
			$this->Write(5, 'EGavilan Media');
			$this->Ln();
			$this->SetX(120);
			$this->Write(5, 'www.egavilanmedia.com');
			$this->SetX(120);
			$this->Ln();
			$this->SetX(120);
			$this->Write(5, 'Web Design & Development');

			$this->SetY(15);
			$this->SetFont('Arial', 'B', 30);
			$this->Ln(30);
			$this->SetX(65);
			$this->Write(5, 'List of Expenses');

			$this->Ln(15);

			$this->SetFont('Arial','B',12);
			$this->SetFillColor(7, 56, 99);
			$this->SetDrawColor(0,0,0);
			$this->SetFont('Arial', '', 12);
			$this->SetTextColor(255,255,255);
			$this->Cell(20,10,'ID',1,0,'',true);
			$this->Cell(70,10,'Description',1,0,'',true);
			$this->Cell(55,10,'Amount',1,0,'',true);
			$this->Cell(45,10,'Date',1,1,'',true);

		}
		function Footer(){
			$this->Cell(190,0,'','T',1,'',true);
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
		}
	}

	$pdf = new PDF('P','mm','A4');

	$pdf->AliasNbPages('{pages}');

	$pdf->SetAutoPageBreak(true,15);
	$pdf->AddPage();

	$pdf->SetFont('Arial','',10);
	$pdf->SetDrawColor(0,0,0);

	$query = mysqli_query($connect,"select * from tbl_expense");
	while($data = mysqli_fetch_array($query)){

		$cellWidth = 70;
		$cellHeight = 5;

		if($pdf->GetStringWidth($data[1]) < $cellWidth){
			$line = 1;
		}else{

			$textLength = strlen($data[1]);
			$errMargin = 10;
			$startChar = 0;
			$maxChar = 0;
			$textArray = array();
			$tmpString = "";

			while($startChar < $textLength){
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString = substr($data[1],$startChar,$maxChar);
				}
				$startChar = $startChar+$maxChar;
				array_push($textArray,$tmpString);
				$maxChar = 0;
				$tmpString = '';

			}
			$line = count($textArray);
		}

		$pdf->Cell(20,($line * $cellHeight),$data[0],1,0);
		$xPos = $pdf->GetX();
		$yPos = $pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$data[1],1);

		$pdf->SetXY($xPos + $cellWidth , $yPos);

		$pdf->Cell(55,($line * $cellHeight),$data[2],1,0);
		$pdf->Cell(45,($line * $cellHeight),$data[3],1,1);
	}

	$pdf->Output('I','List of Expenses.pdf');

?>
