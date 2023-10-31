<?php
include('session.php');

	
		$p_price = $_POST['p_price'];
		$s_price = $_POST['s_price'];
		$shipping = $_POST['shipping'];
		$shiping_price = $_POST['shiping_price'];
		$weight = $_POST['weight'];
		$shipping_type = $_POST['shipping_type'];
		$state = $_POST['state'];
		$gst_shipping = 0;
		$platform_commission = 0;
		
		$query = $conn->query("SELECT * FROM seller_commission WHERE status='1' and price_from <= $s_price and price_to >= $s_price   ORDER BY id ASC");

		if($query->num_rows > 0){

			while($row = $query->fetch_assoc()){
				
				$platform_commission = $row['commission'];
				
			}
		}
		 
		
		if($platform_commission != '')
		{
			$platform_commission = $s_price*$platform_commission/100;
		}
		
		if($shipping == 2)
		{	
			$gst_shipping = $shiping_price*18/100;
		}
		if($shipping == 1)
		{
			
			$curl1 = curl_init();

		curl_setopt_array($curl1, array(
		  CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"email" : "marurangecommerce@gmail.com",
			"password" : "Borawar@739"
		}',
		  CURLOPT_HTTPHEADER => array(
			'content-type: application/json'
		  ),
		));

		$response1 = curl_exec($curl1);

		curl_close($curl1);
		$token_data = json_decode($response1);
		$token = $token_data->data;
		
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"origin" : '.$_SESSION['seller_pincode'].',
			"destination" : '.$state.',
			"payment_type" : "cod",
			"order_amount" : "999",
			"weight" : '.$weight.',
			"length" : "10",
			"breadth" : "10",
			"height" : "10"
		}',
		
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: token '.$token.''

		  ),
		));

		$response_rate = curl_exec($curl);

		curl_close($curl);
		
		$response_rate = json_decode($response_rate);
		/*$courier_name = $response_rate->data[2]->name;
		$courier_freight_charges = $response_rate->data[2]->freight_charges;
		print_r($response_rate->data);*/
		foreach($response_rate->data as $ship_data)
		{
			if($ship_data->id != '' && $ship_data->id == 5)
			{
				$courier_freight_charges = $ship_data->freight_charges;
			}
			else if($ship_data->id != '' && $ship_data->id == 3) /* Xpressbees Air */
			{
				$courier_freight_charges = $ship_data->freight_charges;
			}
			else if($ship_data->id != '' && $ship_data->id == 6) /* Delhivery Surface */
			{
				$courier_freight_charges = $ship_data->freight_charges;
			}
			else if($ship_data->id != '' && $ship_data->id == 15) /* Ekart */
			{
				$courier_freight_charges = $ship_data->freight_charges;
			}
			else if($ship_data->id != '' && $ship_data->id == 66) /* Amazon Shipping */
			{
				$courier_freight_charges = $ship_data->freight_charges;
			}
			
		}
		$shiping_price = $courier_freight_charges;
		$gst_shipping = $shiping_price*18/100; 
			
		
			
		}
		$total = $s_price - $platform_commission - $shiping_price - $gst_shipping - $p_price;
		
		
		$return = array();
		
		$return = 

        					array(	

        					    'p_price' => $p_price,
        					    's_price' => $s_price,
        					    'platform_commission' => $platform_commission,
        					    'shiping_price' => $shiping_price,
        					    'gst_shipping' => $gst_shipping,
        						'total' =>$total );

              		 

               $status = 1;

                $msg = "Details here";
				
		$information =array( 'status' => $status,

                              'msg' =>   $msg,

                              'data' => $return);

    	  echo  json_encode($information);

	
	?>