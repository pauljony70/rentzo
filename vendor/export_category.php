<?php

include('session.php');

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$fileName = "category-data_" . date('Y-m-d') . ".csv"; 

$fields = array('Category Id','Category Name'); 

$excelData = implode("\t", array_values($fields)) . "\n"; 


$query = $conn->prepare("SELECT cat_id,cat_name FROM category where status = '1' ORDER BY cat_id ASC");

$query->execute();	
$query -> store_result();

$data = $query->bind_result($cat_id,$cat_name); 

if($query->num_rows > 0){ 

    // Output each row of the data, format line as csv and write to file pointer 
     while ($query->fetch()) { 
	 
        $lineData = array($cat_id,$cat_name); 
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
