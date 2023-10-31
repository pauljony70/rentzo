<?php
$url = "http://sms.email-soft.com/sendurl.aspx/?Phonenumber=962796621118&sender=Fleek Mart&msg=749227 is your otp&user=onezone&pass=onezone2022000";
$url = str_replace(' ','%20',$url);

     $ch = curl_init();                       // initialize CURL
        curl_setopt($ch, CURLOPT_POST, false);    // Set CURL Post Data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);    

			print_r($output);