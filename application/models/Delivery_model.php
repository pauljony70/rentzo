<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	function get_country()
	{
		$information = array(
			'status' => 1,
			'msg' =>   'Details here',
			'data' => $this->db->get('country')->result_array()
		);
		return $information;
	}

	function get_state()
	{
		$return = array();
		$i = 0;
		$this->db->select('stateid, name');
		$this->db->where('countryid', 1);
		$this->db->order_by('name', 'ASC');

		$query = $this->db->get('state');
		$state_array = $query->result_object();
		foreach ($state_array as $state_details) {
			$return[$i] =
				array(
					'id' => $state_details->stateid,
					'name' => $state_details->name
				);
			$i = $i + 1;
			$status = 1;
			$msg = "Details here";
		}
		$information = array(
			'status' => $status,
			'msg' =>   $msg,
			'data' => $return
		);
		return $information;
	}

	function get_city($stateid)
	{
		$return = array();
		$i =0;
		$this->db->select('city_id, city_name');
		if($stateid != 0)
		{
			$this->db->where('state_code',$stateid);
		}
		$this->db->order_by('city_name','ASC');
		
		$query = $this->db->get('city');
		$state_array = $query->result_object();
		foreach($state_array as $state_details){
			$return[$i] = 
        					array(	
        					    'id' => $state_details->city_id,
        						'name' => $state_details->city_name);
              		   $i = $i+1;  			  
                $status = 1;
                $msg = "Details here";
		}
		$information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
		return $information;
	}

	function get_region($country_id)
	{
		$query = $this->db->get_where('regions', ['country_id' => $country_id]);

		$state_array = $query->result_array();

		$information = array(
			'status' => 1,
			'msg' =>   "Details here",
			'data' => $state_array
		);
		return $information;
	}

	function get_governorates($region_id)
	{
		$query = $this->db->get_where('governorates', ['region_id' => $region_id]);

		$governorate_array = $query->result_array();

		$information = array(
			'status' => 1,
			'msg' =>   "Details here",
			'data' => $governorate_array
		);
		return $information;
	}

	function get_areas($governorate_id)
	{
		$query = $this->db->get_where('areas', ['governorate_id' => $governorate_id]);

		$area_array = $query->result_array();

		$information = array(
			'status' => 1,
			'msg' =>   "Details here",
			'data' => $area_array
		);
		return $information;
	}

	//Functiofor for get delivery
	function get_delivery_city_request()
	{
		$delivery_result = array();

		$this->db->select('sf.id,ci.city_name');
		$this->db->join('city ci', 'ci.city_id = sf.city_id', 'INNER');

		$this->db->where(array('sf.status' => 1));
		$this->db->order_by('ci.city_name', 'ASC');

		$query = $this->db->get('shipping_fees sf');

		if ($query->num_rows() > 0) {
			$delivery_array = $query->result_object();
			foreach ($delivery_array as $delivery_details) {
				$delivery_response = array();
				$delivery_response['city_id'] = $delivery_details->id;
				$delivery_response['city_name'] = $delivery_details->city_name;

				$delivery_result[] = $delivery_response;
			}
		}

		return $delivery_result;
	}


	//Functiofor for get delivery details
	function get_delivery_city_details_request($city_id)
	{
		$delivery_result = array();

		$this->db->select('basic_fee,order_value,big_item_fee,estimated_delivery_time,prime_delivery_time');

		$this->db->where(array('sf.status' => 1, 'sf.city_id' => $city_id));

		$query = $this->db->get('shipping_fees sf');

		if ($query->num_rows() > 0) {
			$delivery_array = $query->result_object()[0];
			$delivery_result['basic_fee'] = $delivery_array->basic_fee;
			$delivery_result['order_value'] = $delivery_array->order_value;
			$delivery_result['big_item_fee'] = $delivery_array->big_item_fee;

			if ($delivery_array->estimated_delivery_time < 1) {
				$estimated_delivery_time = str_replace(array('0.', '.'), '', $delivery_array->estimated_delivery_time) . " Hours";
			} else {
				$estimated_delivery_time = $delivery_array->estimated_delivery_time . " Days";
			}

			if ($delivery_array->prime_delivery_time < 1) {
				$prime_delivery_time = str_replace(array('0.', '.'), '', $delivery_array->prime_delivery_time) . " Hours";
			} else {
				$prime_delivery_time = $delivery_array->prime_delivery_time . " Days";
			}

			$delivery_result['estimated_delivery_time'] = $estimated_delivery_time;
			$delivery_result['prime_delivery_time'] = $prime_delivery_time;
		}

		return $delivery_result;
	}

	//Functiofor for get delivery details
	function get_delivery_details_byid($city_id)
	{
		$delivery_result = array();

		$this->db->select('basic_fee,order_value,big_item_fee,estimated_delivery_time,prime_delivery_time');

		$this->db->where(array('sf.status' => 1, 'sf.city_id' => $city_id));

		$query = $this->db->get('shipping_fees sf');

		if ($query->num_rows() > 0) {
			return  $delivery_array = $query->result_object()[0];
		}
	}
}
