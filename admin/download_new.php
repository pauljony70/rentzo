<?php
include('session.php');

  $files_get = urldecode($_REQUEST["file"]);
  $file= MEDIAURL.$files_get;
  
          ob_end_clean();

  
   header("Content-Type: application/image");
        header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
        readfile($file);
		
		readfile($file);
        exit;  
  
  

?>