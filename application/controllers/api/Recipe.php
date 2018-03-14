<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe extends CI_Controller {    
    public function newrecipe() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->newrecipe($data);        
        return responseWithHeader(true, $result);    		        
    }
}