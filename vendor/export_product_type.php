<?php

include('session.php');

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$fileName = "product_type_data_" . date('Y-m-d') . ".csv"; 

$fields = array('Type Id','Product Type Name');

$excelData = implode("\t", array_values($fields)) . "\n"; 


$query = $conn->prepare("SELECT id,name FROM product_type ORDER BY id ASC");

$query->execute();	
$query -> store_result();

$data = $query->bind_result($id,$name); 

if($query->num_rows > 0){ 

    // Output each row of the data, format line as csv and write to file pointer 
     while ($query->fetch()) { 
	 
        $lineData = array($id,$name); 
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
 
?>