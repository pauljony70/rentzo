<?php

use Google\Service\CloudIAP\Brand;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class BannerController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('banner_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function getHomeBanners_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$banner_array = $this->banner_model->get_banner_request($language_code, $devicetype);


			if ($banner_array) {
				$this->responses(1, '', $banner_array);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $banner_array);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	public function getCustomBanners_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$delete_array = $this->banner_model->delete_custon_banner_request($devicetype);
			$banner_array = $this->banner_model->get_custon_banner_request($language_code, $devicetype);
			$app_home_title =  $this->db->get_where('settings', array('type' => 'app_home_title'))->row()->description;
			$app_home_subtitle =  $this->db->get_where('settings', array('type' => 'app_home_subtitle'))->row()->description;

			if ($banner_array) {
				$this->responses(1, $app_home_title . '===' . $app_home_subtitle, $banner_array);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $banner_array);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	public function getSpecialDealsBanners_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$this->load->model('home_model');
			$banners = $this->home_model->get_header_banner_request('section_four_banner', '200-200');

			if (count($banners) > 0) {
				$this->responses(1, get_phrase('banner_results', $language_code), $banners);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $banners);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
