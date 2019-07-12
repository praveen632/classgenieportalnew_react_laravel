<?php
 //Common function to genrate pdf
 function genratePdfReport($html, $params=array()){
 	     require_once base_path().'/include/tcpdf/config/lang/eng.php';
	 	 require_once base_path().'/include/tcpdf/tcpdf.php';
	     require_once base_path().'/include/tcpdf/mypdf.php';
	     $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		 $pdf->SetCreator(PDF_CREATOR);
	     $pdf->setPrintHeader(false);
	     $pdf->setPrintFooter(true);
	     $pdf->SetMargins('1', '5', '1');
		 $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		 $pdf->AddPage("L");
		 $pdf->writeHTML($html, true, false, true, false, '');
		 $pdf->Output(base_path()."/public/assets/pdf/Report.pdf", "I");
		 header('Content-Type: application/pdf');
         header('Content-Disposition: attachment;filename="Report.pdf"');
         header('Cache-Control: max-age=0');	
 }

 //Coomon function to genrate csv
 function genrateCsv($csv_header=array(), $rst_email_contents=array()){
 	    header('Content-Type: application/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Report.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, $csv_header);
        if(!empty($rst_email_contents)){
      	    foreach($rst_email_contents as $value){
      	        fputcsv($output, [$value->id, $value->type, $value->subject]);
      	    }
         }
    }
    //*** Use send mail to teacher on Approval account  **/
    function executeCurlBasic($url, $parameters, $method='GET'){
      $ch = curl_init($url); 
  	 	curl_setopt($ch, CURLOPT_HEADER, 0); 
  	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
   	  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  	  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
   		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters); 
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      echo $response = curl_exec($ch);
      curl_close($ch);
      	if(!$response) return false;
   		  return $response;
  }
?>