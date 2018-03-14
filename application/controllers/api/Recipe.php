<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe extends CI_Controller {    
    public function new() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->new($data['user_id']);
        if($result) {    
            return responseWithHeader(true, $result);    		
        } else {
            return responseWithHeader(true, []);    		
        }
    }
}