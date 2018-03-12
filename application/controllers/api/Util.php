<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util extends CI_Controller {    
    public function getCuisines() {
        $data = verifyRequest();        
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Util_model');
        $result = $this->Util_model->getCuisines();
        if($result) {    
            return responseWithHeader(true, $result);    		
        } else {
            return responseWithHeader(true, []);    		
        }
    }
}