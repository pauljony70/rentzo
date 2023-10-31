<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class WalletController extends REST_Controller
{
    protected $request_method = 'post';

    public function __construct()
    {
        parent::__construct();

        // Load Model
        $this->load->model('wallet_model');
    }

    public function index_get()
    {
        $this->responses(1, 'Server OK');
    }

    public function getIndexPage_post()
    {
        $requiredparameters = array('language', 'user_id');
        $validation = $this->parameterValidation($requiredparameters, $this->post());
        $language_code = removeSpecialCharacters($this->post('language'));
        $user_id = removeSpecialCharacters($this->post('user_id'));
        if ($validation == 'valid') {
            if (!empty($user_id)) {
                $this->data['wallet'] = $this->wallet_model->get_wallet_data($user_id);
                if (!empty($this->data['wallet'])) {
                    $this->data['wallet_summery'] = $this->wallet_model->get_wallet_summery($this->data['wallet']['wallet_id']);
                    $this->response([
                        $this->config->item('rest_status_field_name') => 1,
                        $this->config->item('rest_message_field_name') => get_phrase('get_wallet_data_succesfully', $language_code),
                        $this->config->item('rest_data_field_name') => $this->data
                    ], self::HTTP_OK);
                } else {
                    $this->response([
                        $this->config->item('rest_status_field_name') => 0,
                        $this->config->item('rest_message_field_name') => get_phrase('no_data_found', $language_code),
                        $this->config->item('rest_data_field_name') => ''
                    ], self::HTTP_OK);
                }
            } else {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            }
        } else {
            echo $validation;
        }
    }

    public function getuserWalletTransaction_post()
    {
        $requiredparameters = array('language', 'user_id');
        $validation = $this->parameterValidation($requiredparameters, $this->post());
        $language_code = removeSpecialCharacters($this->post('language'));
        $user_id = removeSpecialCharacters($this->post('user_id'));
        if ($validation == 'valid') {
            if (!empty($user_id)) {
                $this->data['wallet'] = $this->wallet_model->get_wallet_data($user_id);
                if (!empty($this->data['wallet'])) {
                    $this->data['wallet_summery'] = $this->wallet_model->get_wallet_summery_full($this->data['wallet']['wallet_id']);
                    $this->response([
                        $this->config->item('rest_status_field_name') => 1,
                        $this->config->item('rest_message_field_name') => get_phrase('get_wallet_data_succesfully', $language_code),
                        $this->config->item('rest_data_field_name') => $this->data
                    ], self::HTTP_OK);
                } else {
                    $this->response([
                        $this->config->item('rest_status_field_name') => 0,
                        $this->config->item('rest_message_field_name') => get_phrase('no_data_found', $language_code),
                        $this->config->item('rest_data_field_name') => ''
                    ], self::HTTP_OK);
                }
            } else {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            }
        } else {
            echo $validation;
        }
    }

    public function addMoney_post()
    {
        $requiredparameters = array('language', 'user_id', 'amount');
        $language_code = removeSpecialCharacters($this->post('language'));
        $user_id = removeSpecialCharacters($this->post('user_id'));
        $amount = removeSpecialCharacters($this->post('amount'));
        $validation = $this->parameterValidation($requiredparameters, $this->post());

        if ($validation == 'valid') {
            if (empty($user_id)) {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('user_id_missing', $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            } elseif (!isAmountValid($amount)) {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('enter_a_valid_amount', $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            } else {
                $add_money = $this->wallet_model->addMoney($user_id, $amount);
                if ($add_money) {
                    $this->response([
                        $this->config->item('rest_status_field_name') => 1,
                        $this->config->item('rest_message_field_name') => get_phrase('add_money_succesfully', $language_code),
                        $this->config->item('rest_data_field_name') => $amount
                    ], self::HTTP_OK);
                } else {
                    $this->response([
                        $this->config->item('rest_status_field_name') => 0,
                        $this->config->item('rest_message_field_name') => get_phrase('add_money_failed', $language_code),
                        $this->config->item('rest_data_field_name') => ''
                    ], self::HTTP_OK);
                }
            }
        } else {
            echo $validation;
        }
    }
}
