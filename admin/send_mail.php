<?php


    $code = $_POST['code'];
    $subject =  $_POST['subject']; 
    $email =$_POST['email'];
    $message =$_POST['message'];
    
    $code =    stripslashes($code);
    $subject=  stripslashes($subject);
    $email =  stripslashes($email);
    $message =  stripslashes(  $message);
  
  // echo " get data ".$email."-----".  $subject."-----".   $message;

 send_mail($email,  $subject,   $message);
 
function send_mail($toemailid, $subjectmsg, $bodymsg){

   
    if(isset($toemailid) && !empty($subjectmsg)  ) {
          

  // echo " email --".$toemailid."-- admin---".$admin_emailid ;
        //$to = 'maryjane@email.com';
        //$subject = 'Marriage Proposal';
        $from = $admin_emailid;
         echo " from ".$from ."-- to--".$toemailid;
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message = '<html><body><a style="color:000000;font-size:14px;">'.$bodymsg.'<br></a>';
        $message .= '<a style="color:#000000;font-size:16px;"><br><br>Regard <br></a>';
        $message .= '<a style="color:#191919;font-size:15px;">'.$admin_name.'<br></a>';
        $message .= '<a style="color:#191919;font-size:15px;" href="'.$admin_website.'">'.$admin_website.'<br></a>';
        $message .= '<a style="color:#191919;font-size:15px;">'.$admin_phone.'<br></a>';
        $message .= '</body></html>';
         
        // Sending email
        if(mail($toemailid, $subjectmsg, $message, $headers)){
           // echo 'Your mail has been sent successfully.';
           	    $status =1;
    	     	$msg = "email has been sent successfully.";
    
      
        } else{
         //    echo 'Unable to send email. Please try again.';
         	   	$status =0;
    	     	$msg = "Unable to send email. Please try again.";
    
        }   
      	  $information =array( 'status' => $status,
                                    'msg' => $msg);
        
         echo  json_encode( $information);
        
    }
}


?>