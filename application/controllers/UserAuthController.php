<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/third_party/encryptfun.php';
require APPPATH . 'libraries/google-api-php-client/vendor/autoload.php';
require APPPATH . 'libraries/php-graph-sdk/src/Facebook/autoload.php';


class UserAuthController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('sms_model');
		$this->load->model('user_model');
		$this->load->model('email_model');

		// // Load Facebook configuration
		// $this->config->load('facebook', true);
		// $this->facebook_config = $this->config->item('facebook');

		// // Load Facebook library
		// $this->load->library('php-graph-sdk/src/Facebook/Facebook', $this->facebook_config);
	}

	/* Login View */
	public function login_data_get()
	{
		if ($this->session->userdata('user_id')) {
			echo '<script>window.history.go(-1);</script>';
		} else {
			$this->load->view('website/login.php', $this->data);
		}
	}

	/* SignUp View */
	public function signUpView_get()
	{
		if ($this->session->userdata('user_id')) {
			echo '<script>window.history.go(-1);</script>';
		} else {
			$this->load->view('website/signup.php', $this->data);
		}
	}

	public function login_with_facebook_get()
	{

		$fb = new \Facebook\Facebook([
			'app_id' => '227316246913354',
			'app_secret' => '25fb12d75abf9317bf3440867c2895e8',
			'default_graph_version' => 'v13.0', // Replace with the desired Facebook Graph API version
		]);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; // Add any additional permissions you require

		$loginUrl = $helper->getLoginUrl(base_url('callback_url'), $permissions); // Replace 'callback_url' with your callback URL

		redirect($loginUrl);
	}

	public function facebook_callback_get()
	{

		$fb = new \Facebook\Facebook([
			'app_id' => '227316246913354',
			'app_secret' => '25fb12d75abf9317bf3440867c2895e8',
			'default_graph_version' => 'v13.0', // Replace with the desired Facebook Graph API version
		]);

		$helper = $fb->getRedirectLoginHelper();

		try {
			$accessToken = $helper->getAccessToken();
			$response = $fb->get('/me?fields=id,name,email', $accessToken);
			$user = $response->getGraphUser();

			// User is logged in with Facebook
			// Do your logic here, such as storing user data in the database, setting session, etc.
			// Example: $user_id = $user['id'];
			// Example: $user_name = $user['name'];
			// Example: $user_email = $user['email'];

			redirect('dashboard'); // Redirect to the dashboard or any desired page
		} catch (\Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch (\Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
	}

	public function index_get()
	{
		//$this->load->view('welcome_message');
	}

	public function login_post()
	{
		$requiredparameters = array('language', 'phone', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$qouteid  = removeSpecialCharacters($this->post('qouteid'));
		$otp_login  = removeSpecialCharacters($this->post('otp_login'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		$invalid_response = array(
			"id" => "", "user_unique_id" => "", "fullname" => "", "address" => "", "city" => "", "pincode" => "", "state" => "", "country" => "",
			"region" => "", "phone" => "", "email" => "", "password" => "", "profile_pic" => "", "status" => "", "flagid" => "", "create_by" => "",
			"update_by" => ""
		);
		if ($validation == 'valid') {
			if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code), $invalid_response);
			} else if (is_numeric($mobile_number)) {
				$validate_user = $this->user_model->validate_user_login($mobile_number, $qouteid, $otp_login);

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
							$set_data = $this->session->set_userdata($newdata);
						}
						$this->responses(1, get_phrase('login_successfully', $language_code), $validate_user);
					} else if ($validate_user['status'] == 'not_exist') {
						$this->responses(0, get_phrase('user_not_exist', $language_code), $invalid_response);
					} else if ($validate_user['status'] == 'wrong_otp') {
						$this->responses(0, 'Wrong Otp', $invalid_response);
					} else {
						$this->responses(0, get_phrase('user_status_disabled', $language_code), $invalid_response);
					}
				} else {
					$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
				}
			} else {
				$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function login_otp_post()
	{

		$requiredparameters = array('language', 'phone');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$country_code  = removeSpecialCharacters($this->post('country_code'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			if (is_numeric($mobile_number)) {

				$validate_user = $this->user_model->validate_user_login_first($mobile_number);
				if ($validate_user['status'] == 'not_exist') {
					$this->responses(0, get_phrase('user_not_exist', $language_code));
				} else {
					$otp = $this->sms_model->generateNumericOTP(6);

					$message = 'Dear customer welcome onboard ! ' . $otp . ' is your OTP to login your EBuy account. EBUY';
					$sms_sent = $this->sms_model->send_sms_new($message, $country_code, $mobile_number);


					if ($sms_sent == 'disabled') {
						$this->responses(0, get_phrase('sms_disabled', $language_code));
					} else if ($sms_sent == 'sent') {
						$this->user_model->save_user_otp($mobile_number, $otp);
						$this->responses(1, get_phrase('sms_sent', $language_code), array('otp' => $otp, 'user_id' => $mobile_number));
					} else {
						$this->responses(0, get_phrase('sms_failed', $language_code));
					}
				}
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code));
			} else {
				$this->responses(0, get_phrase('mobile_numeric', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	public function signup_post()
	{

		$requiredparameters = array('language', 'fullname', 'phone', 'email');

		$language_code = removeSpecialCharacters($this->post('language'));
		$fullname  = removeSpecialCharacters($this->post('fullname'));
		$country_code = '';
		$phone  = removeSpecialCharacters($this->post('phone'));
		$email  = removeSpecialCharacters($this->post('email'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (!$phone) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code));
			} else if (!$fullname) {
				$this->responses(0, get_phrase('user_name_mandatory', $language_code));
			} else if (!$email) {
				$this->responses(0, get_phrase('user_name_mandatory', $language_code));
			} else {
				$user = $this->db->where('phone', $phone)->or_where('email', $email)->get('appuser_login')->row_array();
				if (empty($user)) {
					$phone_otp = $this->sms_model->generateNumericOTP(6);
					$message = 'Dear customer welcome onboard ! ' . $phone_otp . ' is your OTP to login your EBuy account. EBUY';
					$this->sms_model->send_sms_new($message, $country_code, $phone);
					$this->user_model->save_user_otp($phone, $phone_otp);
					$this->email_model->sendRegistrationEmailOtp($email);
					$this->responses(1, get_phrase('sms_sent', $language_code));
				}
				$this->responses(0, get_phrase('user already exists', $language_code));
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function verify_otp_post()
	{
		// echo $this->session->tempdata('email_otp'); exit;
		$requiredparameters = array('language', 'phone', 'otp', 'user_name');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$otp  = removeSpecialCharacters($this->post('otp'));
		$user_name  = removeSpecialCharacters($this->post('user_name'));
		// print_r($emailotp); exit;

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		$invalid_response = array(
			"id" => "", "user_unique_id" => "", "fullname" => "", "address" => "", "city" => "", "pincode" => "", "state" => "", "country" => "",
			"region" => "", "phone" => "", "email" => "", "password" => "", "profile_pic" => "", "status" => "", "flagid" => "", "create_by" => "",
			"update_by" => ""
		);
		if ($validation == 'valid') {
			$input_type = checkInputType($mobile_number);
			if ($input_type !== 'Nothing') {
				if ($input_type == 'Phone') {
					$otp1 = $this->user_model->get_user_otp($mobile_number);
				} else if ($input_type == 'Email') {
					$otp1 = $this->session->tempdata('email_otp');
				}
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

	public function verify_otp_old_post()
	{

		$requiredparameters = array('language', 'phone', 'otp', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$mobile_number  = removeSpecialCharacters($this->post('phone'));
		$otp  = removeSpecialCharacters($this->post('otp'));
		$qouteid  = removeSpecialCharacters($this->post('qouteid'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values
		$invalid_response = array(
			"id" => "", "user_unique_id" => "", "fullname" => "", "address" => "", "city" => "", "pincode" => "", "state" => "", "country" => "",
			"region" => "", "phone" => "", "email" => "", "password" => "", "profile_pic" => "", "status" => "", "flagid" => "", "create_by" => "",
			"update_by" => ""
		);
		if ($validation == 'valid') {
			$otp1 = $this->user_model->get_user_otp($mobile_number);

			if (!$otp) {
				$this->responses(0, get_phrase('otp_mandatory', $language_code), $invalid_response);
			} else if ($otp != $otp1) {
				$this->responses(0, get_phrase('invalid_otp', $language_code), $invalid_response);
			} else if (!$mobile_number) {
				$this->responses(0, get_phrase('mobile_mandatory', $language_code), $invalid_response);
			} else if (is_numeric($mobile_number) && $otp) {
				$validate_user = $this->user_model->validate_user($mobile_number, $qouteid);
				if ($validate_user) {
					if ($validate_user['status'] == 1) {
						if (empty($this->session->userdata('user_id'))) {
							$newdata = array(
								'user_id'  => $validate_user['user_id'],
								'logged_in' => TRUE
							);
							$set_data = $this->session->set_userdata($newdata);
						}
						$this->responses(1, get_phrase('login_successfully', $language_code), $validate_user);
					} else {
						$this->responses(0, get_phrase('user_status_disabled', $language_code), $invalid_response);
					}
				} else {
					$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
				}
			} else {
				$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
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

	/* 
	||||||||||||||||||||||||||||||||
	|
	|        Email Login 
	|
	||||||||||||||||||||||||||||||||
	*/

	public function sendLoginEmailOtp_post()
	{
		$requiredparameters = array('language', 'email');

		$language_code = removeSpecialCharacters($this->post('language'));
		$email  = removeSpecialCharacters($this->post('email'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$validate_user = $this->user_model->validate_user_login_first('', $email);
			if ($validate_user['status'] == 'not_exist') {
				$this->responses(0, get_phrase('user_not_exist', $language_code));
			} else {
				$otp = $this->sms_model->generateNumericOTP(6);
				$this->email_model->sendEmailOtp($email, $otp);
				$this->session->set_tempdata('email_otp', $otp, 180);
				$this->responses(1, get_phrase('sms_sent', $language_code));
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function emailLogin_post()
	{
		$requiredparameters = array('language', 'email', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$email  = removeSpecialCharacters($this->post('email'));
		$qouteid  = removeSpecialCharacters($this->post('qouteid'));
		$otp_login  = removeSpecialCharacters($this->post('otp_login'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		$invalid_response = array(
			"id" => "", "user_unique_id" => "", "fullname" => "", "address" => "", "city" => "", "pincode" => "", "state" => "", "country" => "",
			"region" => "", "phone" => "", "email" => "", "password" => "", "profile_pic" => "", "status" => "", "flagid" => "", "create_by" => "",
			"update_by" => ""
		);
		if ($validation == 'valid') {
			if (!$email) {
				$this->responses(0, get_phrase('email_mandatory', $language_code), $invalid_response);
			} else {

				$validate_user = $this->user_model->validateEmailLogin($email, $qouteid, $otp_login);

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
					} else if ($validate_user['status'] == 'not_exist') {
						$this->responses(0, get_phrase('user_not_exist', $language_code), $invalid_response);
					} else if ($validate_user['status'] == 'wrong_otp') {
						$this->responses(0, get_phrase('wrong_otp', $language_code), $invalid_response);
					} else {
						$this->responses(0, get_phrase('user_status_disabled', $language_code), $invalid_response);
					}
				} else {
					$this->responses(0, get_phrase('invalid_request', $language_code), $invalid_response);
				}
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	/* Google Login */
	public function googleLogin_get()
	{
		$client = new Google_Client();
		$client->setClientId('503091182039-6fnp57jf6s1b772huk00eleulfl0nbaq.apps.googleusercontent.com');
		$client->setClientSecret('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');
		$client->setRedirectUri(base_url('google-login/callback'));
		$client->addScope("email");
		$client->addScope("profile");
		$client->addScope("phone");

		$authUrl = $client->createAuthUrl();
		redirect($authUrl);
	}

	public function googleCallback_get()
	{
		$client = new Google_Client();
		$client->setClientId('503091182039-6fnp57jf6s1b772huk00eleulfl0nbaq.apps.googleusercontent.com');
		$client->setClientSecret('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');
		$client->setRedirectUri(base_url('google-login/callback'));
		$client->addScope("email");
		$client->addScope("profile");
		$client->addScope("phone");

		if (isset($_GET['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			$client->setAccessToken($token['access_token']);
			$oauth2 = new Google_Service_Oauth2($client);
			$userData = $oauth2->userinfo->get();


			if ($userData['verifiedEmail']) {
				$data['phone'] = isset($userData['phone']) ? $userData['phone'] : '';
				$data['email'] = $userData['email'];
				$data['fullname'] = $userData['name'];
				$data['profile_pic'] = $userData['picture'];

				$validate_user = $this->user_model->createUserUsingThirdPartyLoginMethod($data, 'google');
				if ($validate_user['error'] === 'login_method_error') {
					if ($this->session->userdata('default_language') == 1) {
						$this->session->set_flashdata('login_method_error', 'تسجيل الدخول غير صالح! يرجى محاولة تسجيل الدخول بخيارات أخرى.');
					} else {
						$this->session->set_flashdata('login_method_error', 'Invalid Login! Please try login with other options.');
					}
					redirect('login');
				} else {
					$newdata = array(
						'user_id'  => $validate_user['user_id'],
						'user_name'  => $validate_user['name'],
						'user_phone'  => $validate_user['phone'],
						'user_email'  => $validate_user['email'],
						'logged_in' => TRUE
					);
					// Store the user data in session or database as per your requirements
					$this->session->set_userdata($newdata);
					redirect(base_url());
				}
			} else {
				redirect('login');
			}
		} else {
			redirect('login');
		}
	}
}
