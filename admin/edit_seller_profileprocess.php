<?php
include('session.php');
if (!$Common_Function->user_module_premission($_SESSION, $ManageSeller)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);
// exit;
$code = $_POST['code'];
$sellerid = $_POST['sellerid'];
$sellername = $_POST['seller_namevalue'];
$businessname = $_POST['company_namevalue'];
$groupid = $_POST['sellergroupvalue'];
$business_type = $_POST['business_type'];
$buss_address = $_POST['business_addressvalue'];
$buss_desc = $_POST['business_detailsvalue'];
$country_id = $_POST['country_id'];
$country = $_POST['country'];
$region_id = $_POST['region_id'];
$region = $_POST['region'];
$governorate_id = $_POST['governorate_id'];
$governorate = $_POST['governorate'];
$area_id = $_POST['area_id'];
$area = $_POST['area'];
$phone = $_POST['phonevalue'];
$email = $_POST['emailvalue'];
$website = $_POST['websitevalue'];
$facebook = $_POST['facebook'];
$facebook = $_POST['instagram'];
$seller_logo1 =  $_POST['seller_logo1'];
$aadhar_card1 = $_POST['aadhar_card1'];
$commercial_registration1 = $_POST['commercial_registration1'];
$vat_certificate1 = $_POST['vat_certificate1'];
$license1 = $_POST['license1'];
$sellerstatus = $_POST['sellerstatus'];
$reason = $_POST['reason'];

$code =    stripslashes($code);
$sellerid =   stripslashes($sellerid);
$sellername =  stripslashes($sellername);
$businessname = stripslashes($businessname);
$groupid =  stripslashes($groupid);
$business_type = stripslashes($business_type);
$buss_address = stripslashes($buss_address);
$buss_desc =  stripslashes($buss_desc);
$country_id =  stripslashes($country_id);
$country = stripslashes($country);
$region_id =  stripslashes($region_id);
$region =  stripslashes($region);
$governorate_id =  stripslashes($governorate_id);
$governorate = stripslashes($governorate);
$area_id =  stripslashes($area_id);
$area =  stripslashes($area);
$phone =   stripslashes($phone);
$email =   stripslashes($email);
$website = stripslashes($website);
$facebook = stripslashes($facebook);
$facebook = stripslashes($facebook);
$sellerstatus =   stripslashes($sellerstatus);
$reason =   stripslashes($reason);

// echo "sdfsa ".$name.$short.$full.$mrp.$price.$qty.$cat.$brand.$imagejson ;

//echo "seler is ".$sellerid."---".$sellerstatus."---".$phone;
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && isset($sellername)  && isset($groupid) && isset($phone)  && !empty($sellername) && !empty($groupid)  && !empty($phone)) {

	$status = 0;
	// get from db-connection 	date_default_timezone_set("Asia/Kolkata");
	$datetime = date('Y-m-d H:i:s');
	/// status  = 0 -pending  1 accepted , 2 reject, 

	// first check phone, email already exist
	$alreadyexist = false;
	$stmt = $conn->prepare("SELECT sellerid FROM sellerlogin WHERE (phone=? OR email=? ) AND sellerid != '" . $sellerid . "'");
	$stmt->bind_param('ss',  $phone, $email);
	$stmt->execute();
	$data = $stmt->bind_result($col1);
	while ($stmt->fetch()) {

		$alreadyexist = true;
	}

	if ($alreadyexist) {
		$msg = "Phone Number / Email Id already exist";
		$information = array(
			'status' => '0',
			'msg' => $msg, 'img' => ''
		);
		echo  json_encode($information);
	} else {

		//code for upload images - START
		$Common_Function->img_dimension_arr = $img_dimension_arr;
		$seller_logo = '';
		if (strlen($_FILES['seller_logo']['name']) > 1) {
			$seller_logo = $Common_Function->doc_upload('seller_logo', $media_path);
			if ($seller_logo1)
				$Common_Function->remFile('../media/' . $seller_logo1);
		} else {
			$seller_logo = $seller_logo1;
		}

		$aadhar_card = '';
		if (strlen($_FILES['aadhar_card']['name']) > 1) {
			$aadhar_card = $Common_Function->doc_upload('aadhar_card', $media_path);
			if ($aadhar_card1)
				$Common_Function->remFile('../media/' . $aadhar_card1);
		} else {
			$aadhar_card = $aadhar_card1;
		}

		$commercial_registration = '';
		if (strlen($_FILES['commercial_registration']['name']) > 1) {
			$commercial_registration = $Common_Function->doc_upload('commercial_registration', $media_path);
			if ($commercial_registration1)
				$Common_Function->remFile('../media/' . $commercial_registration1);
		} else {
			$commercial_registration = $commercial_registration1;
		}

		$license = '';
		if (strlen($_FILES['license']['name']) > 1) {
			$license = $Common_Function->doc_upload('license', $media_path);
			if ($license1)
				$Common_Function->remFile('../media/' . $license1);
		} else {
			$license = $license1;
		}

		$vat_certificate = '';
		if (strlen($_FILES['vat_certificate']['name']) > 1) {
			$vat_certificate = $Common_Function->doc_upload('vat_certificate', $media_path);
			if ($vat_certificate1)
				$Common_Function->remFile('../media/' . $vat_certificate1);
		} else {
			$vat_certificate = $vat_certificate1;
		}


		//code for upload images - END

		$stmt11 = $conn->prepare("UPDATE sellerlogin SET companyname=?, fullname=?, address=?, description=?, country_id=?, country=?, region_id=?, region=?, governorate_id=?, governorate=?, area_id=?, area=?, phone=?, email=?, logo=?, websiteurl=?, groupid=?, status=?, flagid=?, update_by=?, aadhar_card=?, commercial_registration=?, license=?,vat_certificate=? WHERE sellerid=?");
		$stmt11->bind_param(
			"ssssisisisisssssiiissssss",
			$businessname,
			$sellername,
			$buss_address,
			$buss_desc,
			$country_id,
			$country,
			$region_id,
			$region,
			$governorate_id,
			$governorate,
			$area_id,
			$area,
			$phone,
			$email,
			$seller_logo,
			$website,
			$groupid,
			$sellerstatus,
			$reason,
			$datetime,
			$aadhar_card,
			$commercial_registration,
			$license,
			$vat_certificate,
			$sellerid
		);
		$stmt11->execute();
		echo $stmt11->error;
		$stmt11->store_result();

		//	 echo " insert ";
		$rows = $stmt11->affected_rows;
		$status = 1;
		$msg =  "Update Sucessful";

		$information = array(
			'status' => $status,
			'msg' => $msg,
			'img' => $seller_logo,
			'aadhar_card' => $aadhar_card,
			'commercial_registration' => $commercial_registration,
			'license' => $license,
			'vat_certificate' => $vat_certificate,
		);
		echo  json_encode($information);
	}
} else {
	$status = 0;
	$msg = "Invalid Parameters. Please fill all required fields.";
	$information = array(
		'status' => $status,
		'msg' => $msg, 'img' => ''
	);
	echo  json_encode($information);
}

die;
