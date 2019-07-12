<?php

class MYPDF extends TCPDF {
   //set the header
   public function Header(){
		  //$this->writeHTML("This is my header", true, false, true, false, '');
		  $this->Cell(0,10,"This is my header",1,1,'C');
	   }
	   
  //set the footer
  public function Footer(){
	  // Position at 15 mm from bottom
        $this->SetY(-10);
        // Set font
      $this->SetFont('helvetica', 'I', 8);
	   //$this->writeHTML($footer, true, false, true, false, '');
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }

}
?>