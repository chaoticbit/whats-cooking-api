<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {    
   
	public function userprofile() {
        
        $apikey = $this->input->get_request_header('x-api-key');    
        if(empty($apikey) || !$apikey || $apikey == '') { //Check API KEY Existence
            echo 'api key empty';
            return false;
        }
        if($apikey != '') { 
            if($apikey != API_KEY) {                        
                return false;
            }             
        } else {
            return false;
        }
        
        $data = processRequest();

		$this->load->model('Profile_model');
        $result = $this->Profile_model->getUserProfile($data);
        if($result) {    
            return responseWithHeader(true, $result);    		
        } else {
            return responseWithHeader(false, false);    		
        }
    }
}