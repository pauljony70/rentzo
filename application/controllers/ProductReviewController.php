<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class ProductReviewController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('ProductReview_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function productReview_post()
	{

		$requiredparameters = array('language', 'pid', 'user_id', 'review_title', 'review_comment', 'review_rating');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$review_title = removeSpecialCharacters($this->post('review_title'));
		$review_comment = removeSpecialCharacters($this->post('review_comment'));
		$review_rating = removeSpecialCharacters($this->post('review_rating'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_array = $product_array1 = array('user_name' => '', 'rating' => 0, 'review_title' => '', 'review_comment' => '', 'review_date' => '');
			if ($pid && $user_id && $review_title && $review_comment && is_numeric($review_rating) && $review_rating > 0 && $review_rating <= 5) {
				$product_array = $this->ProductReview_model->add_product_review($pid, $user_id, $review_title, $review_comment, $review_rating);

				if ($product_array == 'product_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_product_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array == 'user_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_user_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array == 'user_prod_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_purchased_product', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('review_added', $language_code),
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				}
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!$user_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!$review_title) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('review_title_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!$review_comment) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('review_comment_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!$review_rating || $review_rating == 0) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('review_rating_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!is_numeric($review_rating)) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('review_rating_numeric', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if ($review_rating > 5) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('review_rating_error', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function deleteproductReview_post()
	{
		$requiredparameters = array('language', 'pid', 'user_id', 'review_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$review_id = removeSpecialCharacters($this->post('review_id'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_array = $product_array1 = array();
			if ($pid && $user_id && $review_id) {
				$product_array = $this->ProductReview_model->delete_product_review($pid, $user_id, $review_id);

				if ($product_array == 'product_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_product_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array == 'review_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_review_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array == 'user_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_user_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array == 'user_prod_error') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_purchased_product', $language_code),
						$this->config->item('rest_data_field_name') => $product_array1

					], self::HTTP_OK);
				} else if ($product_array == 'done') {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('review_deleted', $language_code),

					], self::HTTP_OK);
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				}
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!$user_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if (!$review_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('review_id_missing', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
