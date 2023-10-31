<?php
include('session.php');

// API access key from Google API's Console

define( 'API_ACCESS_KEY', 'AAAApbZOHo8:APA91bFf6tOqUv6v_l4mkXVIriAzCcK6NSez35x6FEYj49VrKHjteVwD3g5hc8hpNK3FTZnTr1i7AQssSVB3Zzq7UoxpThjDJbKAEPA4IMjN2wlX-Eo0jO3cYkvfjf3SJADETq1TpiTl');

//print_r($_FILES);
//die;


// prep the bundle

if(isset($_POST['action']) && $_POST['action'] == 'sendNotification'){

    if($_POST['title'] == '')
	{
		$title = " ";
	}
	else
	{
		$title = $_POST['title'];
	}
	if($_POST['body'] == '')
	{
		$body = " ";
	}
	else
	{
		$body = $_POST['body'];
	}
	if($_POST['selectupsell'] == '')
	{
		$pid = "0";
		$sku = "0";
		$img = "0";
		$name = "0";
	}
	else
	{
		$pid = $_POST['selectupsell'];
	}
	if($_POST['selectseller'] == '')
	{
		$sid = "0";
	}
	else
	{
		$sid = $_POST['selectseller'];
	}
	if($_POST['cid'] == '')
	{
		$cid = "0";
		$img = "0";
		$name = "0";
	}
	else
	{
		$cid = $_POST['cid'];
		$stmt1 = $conn->prepare("SELECT cat_name, cat_img FROM category WHERE  cat_id = ?");
	   $stmt1->bind_param("s", $cid);
	   $stmt1->execute();	 
	   $data = $stmt1->bind_result( $col1, $col2);
		
		while ($stmt1->fetch()) {
			$name = $col1;
			$finalimage = $col2;
			/*$featured_img = $col2;
			$imgarray = json_decode($featured_img, true);
			$finalimage = $imgarray['430-590']; */ 
		
		}
	}
	if($_POST['search'] == '')
	{
		$search = "0";
	}
	else
	{
		$search = $_POST['search'];
	}
	if($_POST['type'] == '')
	{
		$clicktype = "0";
	}
	else
	{
		$clicktype = $_POST['type'];
	}

		
	$home = 0;

	
	$stmt = $conn->prepare("SELECT prod_name, product_sku, featured_img FROM product_details WHERE  product_unique_id = ?");
   $stmt->bind_param("s", $pid);
   $stmt->execute();	 
   $data = $stmt->bind_result( $col1, $col2, $col3);
	
	while ($stmt->fetch()) {
		$name = $col1;
		$sku = $col2;
		$finalimage = $col3;
		/*$featured_img = $col3;
		$imgarray = json_decode($featured_img, true);
		$finalimage = $imgarray['430-590'];  */
	
	}
    $noti_image = $_FILES;
	//print_r($noti_image['image']);
    //die; 

    $currentimestamp=date("d-m-Y");

   // $obj=new Image();

  // $noti_image['image']['name']
  if($_FILES['notification_image']['name']) {
	  $Common_Function->img_dimension_arr = $img_dimension_arr;
	  $brand_image1 = $Common_Function->file_upload('notification_image',$media_path);
	  $finalimage = json_encode($brand_image1);
  }
  //print_r($brand_image1['430-590']);
 // print_r($finalimage);
  //echo " notiimge ".$finalimage;

    $msg = array

            (

                'body'  => $body,

                'title'     => $title,

                'vibrate'   => 1,

                'sound'     => 1,

                'imageUrl'	=> MEDIAURL.$brand_image1['430-590'],

                'image'	=> MEDIAURL.$brand_image1['430-590']

            );
			
	// clicktype - "1",pid - "12", cid - "0", search -"", home- "0"	
	
//print_r($msg);
  $info = array('clicktype'=>$clicktype,'pid'=>$pid,'sid'=>$sid,'name'=>$name,'sku'=>$sku,'img'=>$finalimage, 'cid' => $cid, 'search' => $search, 'home' => $home);	$stmt11 = $conn->prepare("INSERT INTO firebase_notification( clicktype, pid,prod_name,sid,noti_title,noti_body,sku,noti_img,cid,search,home,created_at)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");	$stmt11->bind_param( "ssssssssssss",  $clicktype, $pid,$name,$sid,$title,$body,$sku,$finalimage,$cid,$search,$home,$datetime);	$stmt11->execute();	
  $stmt11->store_result();
//print_r($info);
// clicktype 1 - tournament , clicktype = 7 homepage

$fields = array

(

    'to'  => '/topics/app_user',

    'notification'          => $msg,

    "data" => $info

);

$headers = array

(

    'Authorization: key=' . API_ACCESS_KEY,

    'Content-Type: application/json'

);



$ch = curl_init();

curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

curl_setopt( $ch,CURLOPT_POST, true );

curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

$result = curl_exec($ch );

curl_close( $ch );

echo $result;
return $result;
}



?>