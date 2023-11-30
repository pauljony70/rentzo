<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class SurepassController extends REST_Controller
{

    protected $request_method = 'post';


    public function __construct()
    {
        parent::__construct();
    }

    public function aadhaarVerification_post()
    {
        // $file_path = $_FILES['kyc_document']['tmp_name'];

        // $ch = curl_init();

        // $url = SUREPASS_PRODUCTION_URL . 'api/v1/ocr/aadhaar';
        // $token = 'Bearer ' . SUREPASS_AUTH_TOKEN;

        // $post_fields = array(
        //     'file' => new CURLFile($file_path)
        // );

        // $headers = array(
        //     'Content-Type: multipart/form-data',
        //     'Authorization: ' . $token
        // );

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($ch);

        // curl_close($ch);

        // Handle the response as needed
        // $this->output->set_content_type('application/json')->set_output($response);
        $response = array('success' => true, 'message' => 'Your session is timed out. Please login to continue chat');
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
