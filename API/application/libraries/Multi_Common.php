<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Rest Controller
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Sandeep Yadav
 * @license         MIT
 * @link           
 * @version         1.0.0
 */
 class Multi_Common  {
   
    /**
     * Constructor for the REST API
     *
     * @access public
     * @param string $config Configuration filename minus the file extension
     * e.g: my_rest.php is passed as 'my_rest'
     */
    public function __construct(){
       
		$CI =& get_instance();
		$CI->load->helper('url');
		$CI->load->library('session');
		$CI->load->database();
    }
	
	

}
