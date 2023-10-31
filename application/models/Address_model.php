<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	//Functiofor for add product into cart
	function add_user_address($user_id, $country_code, $mobile, $username, $email, $fulladdress, $lat, $lng, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $addresstype)
	{
		$query1 = $this->db->get_where('appuser_login', array('user_unique_id' => $user_id));

		if ($query1->num_rows() > 0) {

			$query = $this->db->get_where('address', array('user_id' => $user_id));

			$address = array();
			$status = '';


			if ($query->num_rows() > 0) {
				$all_address = $this->get_user_address_details($user_id)['address'];
				if ($this->checkAddress($all_address, $country_code, $mobile, $username, $email, $fulladdress, $lat, $lng, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $addresstype)) {
					$addressid_count = end($all_address)['address_id'] + 1;
					$address_json_array =	array(
						'address_id' => $addressid_count,
						'fullname' => $username,
						'email' => $email,
						'country_code' => $country_code,
						'mobile' => $mobile,
						'fulladdress' => $fulladdress,
						'lat' => $lat,
						'lng' => $lng,
						'country_id' => $country_id,
						'country' => $country,
						'region_id' => $region_id,
						'region' => $region,
						'governorate_id' => $governorate_id,
						'governorate' => $governorate,
						'area_id' => $area_id,
						'area' => $area,
						'addresstype' => $addresstype,
					);

					$address_json = array_merge($all_address, array($address_json_array));

					$address['addressarray'] = json_encode($address_json);
					$address['defaultaddress'] = $addressid_count;


					$this->db->where(array('user_id' => $user_id));

					$query = $this->db->update('address', $address);
					if ($query) {
						$status = 'done';
					}
				}
			} else {
				$addressid_count = 1;
				$address_json_array =	array(
					'address_id' => $addressid_count,
					'fullname' => $username,
					'email' => $email,
					'country_code' => $country_code,
					'mobile' => $mobile,
					'fulladdress' => $fulladdress,
					'lat' => $lat,
					'lng' => $lng,
					'country_id' => $country_id,
					'country' => $country,
					'region_id' => $region_id,
					'region' => $region,
					'governorate_id' => $governorate_id,
					'governorate' => $governorate,
					'area_id' => $area_id,
					'area' => $area,
					'addresstype' => $addresstype,
				);

				$address['addressarray'] = json_encode(array($address_json_array));
				$address['defaultaddress'] = 1;
				$address['user_id'] = $user_id;


				$query = $this->db->insert('address', $address);
				if ($query) {
					$status = 'done';
				}
			}
		} else {
			$status = 'not_exist';
		}
		return $status;
	}

	function checkAddress($all_address, $country_code, $mobile, $username, $email, $fulladdress, $lat, $lng, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $addresstype)
	{
		$addressExists = false;
		foreach ($all_address as $address) {
			if (
				$address['country_code'] == $country_code &&
				$address['mobile'] == $mobile &&
				$address['fullname'] == $username &&
				$address['email'] == $email &&
				$address['fulladdress'] == $fulladdress &&
				$address['lat'] == $lat &&
				$address['lng'] == $lng &&
				$address['country_id'] == $country_id &&
				$address['country'] == $country &&
				$address['region_id'] == $region_id &&
				$address['region'] == $region &&
				$address['governorate_id'] == $governorate_id &&
				$address['governorate'] == $governorate &&
				$address['area_id'] == $area_id &&
				$address['area'] == $area &&
				$address['addresstype'] == $addresstype
			) {
				$addressExists = true;
				break; // No need to continue checking once a match is found
			}
		}
		if ($addressExists) {
			return false;
		} else {
			return true;
		}
	}

	function edit_user_address($address_id, $user_id, $username, $email, $country_code, $mobile, $fulladdress, $lat, $lng, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $addresstype)
	{

		$this->db->select('user_unique_id');
		$this->db->where(array('user_unique_id' => $user_id));
		$query1 = $this->db->get('appuser_login');

		if ($query1->num_rows() > 0) {

			$this->db->select("user_id");
			$this->db->where(array('user_id' => $user_id));

			$query = $this->db->get('address');

			$address = array();
			$status = '';


			if ($query->num_rows() > 0) {
				$all_address1 = $this->get_user_address_details($user_id);
				$all_address = $all_address1['address'];
				$edited_address = [];
				foreach ($all_address as $address) :
					if ($address['address_id'] == $address_id) :
						$edited_address[] =	[
							'address_id' => $address_id,
							'fullname' => $username,
							'email' => $email,
							'country_code' => $country_code,
							'mobile' => $mobile,
							'fulladdress' => $fulladdress,
							'lat' => $lat,
							'lng' => $lng,
							'country_id' => $country_id,
							'country' => $country,
							'region_id' => $region_id,
							'region' => $region,
							'governorate_id' => $governorate_id,
							'governorate' => $governorate,
							'area_id' => $area_id,
							'area' => $area,
							'addresstype' => $addresstype,
						];
					else :
						$edited_address[] = $address;
					endif;
				endforeach;

				// print_r($edited_address);exit;

				$this->db->where(array('user_id' => $user_id));

				$query = $this->db->update('address', array('addressarray' => json_encode($edited_address)));
				if ($query) {
					$status = 'done';
				}
			}
		} else {
			$status = 'not_exist';
		}
		return $status;
	}


	//Functiofor for delete product from cart
	function delete_address($user_id, $address_id)
	{
		$status = '';
		$valid_id = '';
		$add_arry = $this->get_user_address_details($user_id);

		$address_array = $add_arry['address'];


		foreach ($address_array as $key => $all_address) {

			if ($address_id == $all_address['address_id']) {
				unset($address_array[$key]);
				$valid_id = 'yes';
			}
		}

		if ($valid_id == 'yes') {
			$address_array_new = array_values($address_array);

			$defaultaddress = $add_arry['defaultaddress'];
			if ($defaultaddress == $address_id) {
				$defaultaddress_new = $address_array_new[0]['address_id'];
			} else {
				$defaultaddress_new = $defaultaddress;
			}

			$address['addressarray'] = json_encode($address_array_new);
			$address['defaultaddress'] = $defaultaddress_new;


			$this->db->where(array('user_id' => $user_id));

			$query = $this->db->update('address', $address);
			if ($query) {
				$status = 'delete';
			}
		} else {
			$status = 'invalid';
		}
		return $status;
	}

	//Functiofor for update product from cart
	function update_address($user_id, $address_id)
	{
		$status = '';

		$address['defaultaddress'] = $address_id;

		$this->db->where(array('user_id' => $user_id));

		$query = $this->db->update('address', $address);
		if ($query) {
			$status = 'update';
		}
		return $status;
	}

	//function for get user cart details

	function get_user_address_details($user_id)
	{
		$this->db->select("user_id, addressarray, defaultaddress");
		$this->db->where(array('user_id' => $user_id));

		$query = $this->db->get('address');

		$address = array();
		$address1 = array();
		$defaultaddress = '';
		if ($query->num_rows() > 0) {
			$address_result = $query->result_object();

			$addressarray = $address_result[0]->addressarray;
			$defaultaddress = $address_result[0]->defaultaddress;

			$address1 = json_decode($addressarray, true);
		}

		$address['address'] = $address1;
		$address['defaultaddress'] = $defaultaddress;
		return $address;
	}


	function get_shippinf_details_full($seller_pincode, $user_pincode, $total_value)
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
			CURLOPT_POSTFIELDS => '{
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
			CURLOPT_POSTFIELDS => '{
			"origin" : ' . $user_pincode . ',
			"destination" : ' . $user_pincode . ',
			"payment_type" : "cod",
			"order_amount" : ' . $total_value . ',
			"weight" : "500",
			"length" : "10",
			"breadth" : "10",
			"height" : "10"
		}',

			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: token ' . $token . ''

			),
		));

		$response_rate = curl_exec($curl);

		curl_close($curl);

		$response_rate = json_decode($response_rate);

		foreach ($response_rate->data as $ship_data) {
			if ($ship_data->id != '' && $ship_data->id == 5) {
				$courier_freight_charges = $ship_data->freight_charges;
			} else if ($ship_data->id != '' && $ship_data->id == 3) /* Xpressbees Air */ {
				$courier_freight_charges = $ship_data->freight_charges;
			} else if ($ship_data->id != '' && $ship_data->id == 6) /* Delhivery Surface */ {
				$courier_freight_charges = $ship_data->freight_charges;
			} else if ($ship_data->id != '' && $ship_data->id == 15) /* Ekart */ {
				$courier_freight_charges = $ship_data->freight_charges;
			} else if ($ship_data->id != '' && $ship_data->id == 66) /* Amazon Shipping */ {
				$courier_freight_charges = $ship_data->freight_charges;
			}
		}
		$shiping_price = $courier_freight_charges;

		return $shiping_price;
	}


	//function for get user address details

	function get_user_address_details_full($user_id)
	{
		$this->db->select("user_id, addressarray, defaultaddress");
		$this->db->where(array('user_id' => $user_id));

		$data = $this->db->get('address')->row_array();

		$address = array();
		if (!empty($data)) {
			$address['defaultaddress'] = $data['defaultaddress'];
			$address['address_details'] = array_map('get_object_vars', json_decode($data['addressarray']));
		}
		// echo "<pre>";
		// print_r($address);
		// exit;

		return $address;
	}



	/*
		Break All The Values In Valid Form
	*/

	function getValues($var)
	{
		if (is_array($var)) {
			$values = "'" . implode("','", $var) . "'";
		} else {
			$delm = array(",", "\n");
			$values = "'" . str_replace($delm, "','", $var) . "'";
		}
		return $values;
	}
}
