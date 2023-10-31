<?php

include('session.php');

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$code  = $_GET['code'];

 if(!isset($_SESSION['admin'])){

  header("Location: index.php");

 

}else if($code == $_SESSION['_token']){

$table_main = strtolower('import_product_'.$_SESSION['admin']);

$fileName = "Last_import_file_" . date('Y-m-d') . ".csv"; 

$fields = array('Status','Fail Reason','Name','sku','Url Key','Attribute Set','Product Type','Categories','Short Description','description','Mrp','Price','Tax Class','Qty','Stock Status','Visibility','Country of Manufacture','Hsn Code','Product Purchase Limit','Brand','Return Policy','Configurable Variations','Remarks','Youtube Video Link','Related Skus','Upsell Skus');

$excelData = implode("\t", array_values($fields)) . "\n"; 


$query = $conn->prepare("SELECT status,fail_reason,name,sku,url_key,attribute_set,product_type,categories,short_description,description,mrp,price,tax_class,qty,stock_status,visibility,country_of_manufacture,hsn_code,product_purchase_limit,brand,return_policy,configurable_variations,remarks,youtube_video_link,related_skus,upsell_skus FROM ".$table_main." ORDER BY id ASC");

$query->execute();	
$query -> store_result();

$data = $query->bind_result($status,$fail_reason,$name,$sku,$url_key,$attribute_set,$product_type,$categories,$short_description,$description,$mrp,$price,$tax_class,$qty,$stock_status,$visibility,$country_of_manufacture,$hsn_code,$product_purchase_limit,$brand,$return_policy,$configurable_variations,$remarks,$youtube_video_link,$related_skus,$upsell_skus); 

if($query->num_rows > 0){ 

    // Output each row of the data, format line as csv and write to file pointer 
     while ($query->fetch()) { 
	 
        $lineData = array($status,$fail_reason,$name,$sku,$url_key,$attribute_set,$product_type,$categories,$short_description,$description,$mrp,$price,$tax_class,$qty,$stock_status,$visibility,$country_of_manufacture,$hsn_code,$product_purchase_limit,$brand,$return_policy,$configurable_variations,$remarks,$youtube_video_link,$related_skus,$upsell_skus); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n";  
    } 
     
    

}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
 
 
// Render excel data 
echo $excelData; 


 
exit;

}
 
?>