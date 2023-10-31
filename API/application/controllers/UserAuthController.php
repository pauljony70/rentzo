<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class UserAuthController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();
		require_once APPPATH . 'third_party/encryptfun.php';

		// Load the user model
		$this->load->model('sms_model');
		$this->load->model('user_model');
		$this->load->model('email_model');
	}
	public function index_get()
	{
		//$this->load->view('welcome_message');
	}

	public function login_post()
	{
		$requiredparameters = array('language', 'phone', 'otp');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$otp  = removeSpecialCharacters($this->post('otp'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		$invalid_response = array(
			"id" => "", "user_unique_id" => "", "fullname" => "", "address" => "", "city" => "", "pincode" => "", "state" => "", "country" => "", "region" => "", "phone" => "", "email" => "", "password" => "", "profile_pic" => "", "status" => "", "flagid" => "", "create_by" => "", "update_by" => ""
		);
		if ($validation == 'valid') {
			$input_type = checkInputType($mobile_number);
			if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code), $invalid_response);
			} else if (!$otp) {
				$this->responses(0, get_phrase('otp_mandatory', $language_code));
			} else if ($input_type !== 'Nothing') {
				$otp1 = $this->user_model->get_user_otp($mobile_number);
				if ($otp == $otp1) {
					$validate_user = $this->user_model->validate_user_login($mobile_number);
					if ($validate_user) {
						if ($validate_user['status'] == 1) {
							$this->responses(1, get_phrase('login_successfully', $language_code), $validate_user);
						} else if ($validate_user['status'] == 'not_exist') {
							$this->responses(0, get_phrase('user_not_exist', $language_code), $invalid_response);
						} else {
							$this->responses(0, get_phrase('user_status_disabled', $language_code), $invalid_response);
						}
					} else {
						$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
					}
				} else {
					$this->responses(0, get_phrase('invalid_mobile_or_email_otp', $language_code), $invalid_response);
				}
			} else {
				$this->responses(0, get_phrase('mobile_or_email_invalid', $language_code), $invalid_response);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function loginUsingThirdPartyMethod_post()
	{
		// $this->load->library('form_validation');
		// Set validation rules
		// $this->form_validation->set_rules('language', 'Language', 'required|in_list[1,2]');
		// $this->form_validation->set_rules('fullname', 'Fullname', 'required|regex_match[/^[a-zA-Z\s]+$/]');
		// $this->form_validation->set_rules('phone', 'Phone', 'numeric|callback_validate_phone_or_email');
		// $this->form_validation->set_rules('email', 'Email', 'valid_email|callback_validate_phone_or_email');
		// $this->form_validation->set_rules('login_method', 'Login method', 'required|in_list[google,facebook]');

		// Run the validation
		// if ($this->form_validation->run() === FALSE) {
		// 	// Validation failed, reload the form with validation errors
		// 	$this->responses(0, $this->form_validation->error_array());
		// } else {
		if ($this->post('email') && $this->post('fullname')) {
			// Validation passed, handle the form submission
			$language_code = $this->post('language');
			$data = [
				'email' => $this->post('email'),
				'phone' => $this->post('phone'),
				'fullname' => $this->post('fullname')
			];
			$login_method = $this->post('login_method');
			$validate_user = $this->user_model->createUserUsingThirdPartyLoginMethod($data, $login_method);
			// Perform further actions, e.g., store data in the database
			if ($validate_user) {
				$this->responses(1, get_phrase('login_successfully', $language_code), $validate_user);
			} else {
				$this->responses(0, get_phrase('login_failed', $language_code));
			}
		} else {
			$this->responses(0, 'Required field missing');
		}
	}

	// Define the callback function to validate phone or email
	function validate_phone_or_email($input)
	{
		// Check if either phone or email is provided
		$phone = $this->post('phone');
		$email = $this->post('email');

		if (empty($phone) && empty($email)) {
			$this->form_validation->set_message('validate_phone_or_email', 'You must provide either a phone number or an email address.');
			return false;
		}

		return true;
	}

	public function signup_post()
	{
		$requiredparameters = array('language', 'phone');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		$invalid_response = array('otp' => '', 'user_id' => '');
		if ($validation == 'valid') {
			$input_type = checkInputType($mobile_number);
			if ($input_type !== 'Nothing') {
				$otp = $this->sms_model->generateNumericOTP(6);
				if ($input_type == 'Phone') {
					$message = 'Dear customer welcome onboard ! ' . $otp . ' is your OTP to login your Marurang account. MRURNG';
					$sms_sent = $this->sms_model->send_sms_new($message, $mobile_number);

					if ($sms_sent == 'disabled') {
						$this->responses(0, get_phrase('sms_disabled', $language_code));
					} else if ($sms_sent == 'sent') {
						$this->user_model->save_user_otp($mobile_number, $otp);
						$this->responses(1, get_phrase('sms_sent', $language_code));
					} else {
						$this->responses(0, get_phrase('sms_failed', $language_code));
					}
				} else if ($input_type == 'Email') {
					$otp = $sms_sent = $this->email_model->sendRegistrationEmailOtp($mobile_number);
					$this->user_model->save_user_otp($mobile_number, $otp);
					$this->responses(1, get_phrase('sms_sent', $language_code));
				}
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code));
			} else {
				$this->responses(0, get_phrase('invalid_mobile_or_email', $language_code));
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function forgot_otp_post()
	{
		$requiredparameters = array('language', 'phone');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (is_numeric($mobile_number)) {
				$otp = $this->sms_model->generateNumericOTP(6);
				$message = $otp . ' is your OTP.';
				$sms_sent = $this->sms_model->send_sms($message, $mobile_number);
				if ($sms_sent == 'disabled') {
					$this->responses(0, get_phrase('sms_disabled', $language_code));
				} else if ($sms_sent == "Your Message Has Been Sent") {
					$this->responses(1, get_phrase('sms_sent', $language_code), array('otp' => $otp, 'mobile' => $mobile_number));
				} else {
					$this->responses(0, get_phrase('sms_failed', $language_code));
				}
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code));
			} else {
				$this->responses(0, get_phrase('mobile_numeric', $language_code));
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function  update_password_post()
	{
		$requiredparameters = array('language', 'phone', 'otp', 'password');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$otp  = removeSpecialCharacters($this->post('otp'));

		$publickey_server = $this->config->item("encryption_key");
		$encruptfun = new encryptfun();
		$encryptedpassword = $encruptfun->encrypt($publickey_server, $this->post('password'));
		$user_password  = $encryptedpassword;

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		$invalid_response = array("id" => "", "phone" => "", "password" => "");
		if ($validation == 'valid') {
			$validate_user = $this->user_model->update_user_password($mobile_number, $user_password);

			if ($validate_user['status'] == 1) {
				$this->responses(1, 'Password Update Successfully.');
			} else if ($validate_user['status'] == 'not_exist') {
				$this->responses(0, get_phrase('user_not_exist', $language_code), $invalid_response);
			} else {
				$this->responses(0, get_phrase('user_status_disabled', $language_code), $invalid_response);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function send_otp_post()
	{
		$requiredparameters = array('language', 'phone');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));

		$invalid_response = array('otp' => '', 'user_id' => '');
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			$input_type = checkInputType($mobile_number);
			if ($input_type !== 'Nothing') {
				$validate_user = $this->user_model->validate_user_login_first($mobile_number);
				if ($validate_user['status'] == 'not_exist') {
					$this->responses(0, get_phrase('user_not_exist', $language_code));
				} else {
					if ($input_type == 'Phone') {
						$otp = $this->sms_model->generateNumericOTP(6);
						$message = 'Dear customer welcome onboard ! ' . $otp . ' is your OTP to login your Marurang account. MRURNG';
						$sms_sent = $this->sms_model->send_sms_new($message, $mobile_number);

						if ($sms_sent == 'disabled') {
							$this->responses(0, get_phrase('sms_disabled', $language_code), $invalid_response);
						} else if ($sms_sent == "sent") {
							$this->user_model->save_user_otp($mobile_number, $otp);
							$this->responses(1, get_phrase('sms_sent', $language_code));
						} else {
							$this->responses(0, get_phrase('sms_failed', $language_code), $invalid_response);
						}
					} else if ($input_type == 'Email') {
						$otp = $sms_sent = $this->email_model->sendRegistrationEmailOtp($mobile_number);
						$this->user_model->save_user_otp($mobile_number, $otp);
						$this->responses(1, get_phrase('sms_sent', $language_code));
					}
				}
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_or_email_mandatory', $language_code), $invalid_response);
			} else {
				$this->responses(0, get_phrase('mobile_or_email_invalid', $language_code), $invalid_response);
			}
		} else {
			echo $validation;
		}
	}

	public function send_otp_verify_post()
	{
		$requiredparameters = array('language', 'phone', 'otp');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$otp  = removeSpecialCharacters($this->post('otp'));

		$validation = $this->parameterValidation($requiredparameters, $this->post());
		$invalid_response = array();
		if ($validation == 'valid') {
			$validate_otp = $this->user_model->verify_user_otp($mobile_number, $otp);
			if (!$otp) {
				$this->responses(0, get_phrase('otp_mandatory', $language_code), $invalid_response);
			} else if ($validate_otp['status'] == 0) {
				$this->responses(0, get_phrase('invalid_otp', $language_code), $invalid_response);
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code), $invalid_response);
			} else if ($validate_otp['status'] == 1) {

				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => 'Verify Otp Successfully',
					$this->config->item('rest_data_field_name') => $invalid_response

				], self::HTTP_OK);
			} else {
				$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
			}
		} else {
			echo $validation;
		}
	}

	public function verify_otp_post()
	{

		$requiredparameters = array('language', 'phone', 'otp', 'user_name');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$otp  = removeSpecialCharacters($this->post('otp'));
		$user_name  = removeSpecialCharacters($this->post('user_name'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		$invalid_response = array(
			"id" => "", "user_unique_id" => "", "fullname" => "", "address" => "", "city" => "", "pincode" => "", "state" => "", "country" => "", "region" => "", "phone" => "", "email" => "", "password" => "", "profile_pic" => "", "status" => "", "flagid" => "", "create_by" => "", "update_by" => ""
		);
		if ($validation == 'valid') {
			$input_type = checkInputType($mobile_number);
			if ($input_type !== 'Nothing') {
				$otp1 = $this->user_model->get_user_otp($mobile_number);
				if ($otp == $otp1) {
					$validate_user = $this->user_model->validate_user($mobile_number, $user_name, $input_type);
					if ($validate_user) {
						if ($validate_user['status'] == 1) {
							if (empty($this->session->userdata('user_id'))) {
								$newdata = array(
									'user_id'  => $validate_user['user_id'],
									'user_name'  => $validate_user['name'],
									'user_phone'  => $validate_user['phone'],
									'user_email'  => $validate_user['email'],
									'logged_in' => TRUE
								);
								$this->session->set_userdata($newdata);
							}
							$this->responses(1, get_phrase('login_successfully', $language_code), $validate_user);
						} else if ($validate_user['status'] == 'exist') {
							$this->responses(0, get_phrase('phone_or_email_already_exist', $language_code), $invalid_response);
						} else {
							$this->responses(0, get_phrase('user_status_disabled', $language_code), $invalid_response);
						}
					} else {
						$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
					}
				} else if (!$otp) {
					$this->responses(0, get_phrase('otp_mandatory', $language_code), $invalid_response);
				} else {
					$this->responses(0, get_phrase('invalid_otp', $language_code), $invalid_response);
				}
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code));
			} else if (!$user_name) {
				$this->responses(0, get_phrase('user_name_mandatory', $language_code));
			} else {
				$this->responses(0, get_phrase('invalid_mobile_or_email', $language_code));
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getUserReview_post()
	{
		$requiredparameters = array('language', 'user_id', 'pageno');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id  = removeSpecialCharacters($this->post('user_id'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$review_array = array();
		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		if ($validation == 'valid') {

			if ($user_id) {
				$review_array = $this->user_model->get_user_review_ratings($user_id, $pageno);
				if ($review_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $review_array

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $review_array
					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
					'pageno' => $pageno,
					$this->config->item('rest_data_field_name') => $review_array
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getUserProfile_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id  = removeSpecialCharacters($this->post('user_id'));

		$review_array = array();
		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		if ($validation == 'valid') {

			if ($user_id) {
				$review_array = $this->user_model->get_user_profile($user_id);
				if ($review_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						$this->config->item('rest_data_field_name') => $review_array

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => $review_array
					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
					$this->config->item('rest_data_field_name') => $review_array
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
