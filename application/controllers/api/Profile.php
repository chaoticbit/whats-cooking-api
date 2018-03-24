<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {    
   
	public function userprofile() {
		$data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Profile_model');
        $result = $this->Profile_model->getUserProfile($data);
        if($result) {    
            return responseWithHeader(true, $result);    		
        } else {
            return responseWithHeader(true, []);    		
        }
    }
}