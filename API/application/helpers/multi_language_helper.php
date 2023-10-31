<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter
*
* An open source application development framework for PHP 5.1.6 or newer
*
* @package		CodeIgniter
* @author		Sandeep yadav
* @copyright	Copyright (c) 2008 - 2020, EllisLab, Inc.
* @license		http://codeigniter.com/user_guide/license.html
* @link		http://codeigniter.com
* @since		Version 1.0
* @filesource
*/


// This function helps us to get the translated phrase from the file. If it does not exist this function will save the phrase and by default it will have the same form as given
if ( ! function_exists('get_phrase'))
{
	function get_phrase($phrase = '',$language_code) {
		
		$CI	=&	get_instance();
		$CI->load->database();

		$key = strtolower(preg_replace('/\s+/', '_', $phrase));

		$language_array = $CI->db->get_where('language_phrase' , array('language_id' => $language_code,'phrase'=>$key))->row();
		
		if ($language_array) {
			if($language_array->message){
				$language_msg = $language_array->message;
			}else{
				$language_msg = ucfirst(str_replace('_', ' ', $key));
			}
		} else {
			$language_msg = ucfirst(str_replace('_', ' ', $key));
			
			$data['language_id'] =  $language_code;
			$data['phrase'] =  $key;
            $CI->db->insert('language_phrase' , $data);			
		}

		return $language_msg;
	}
}


// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */
