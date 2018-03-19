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

    public function getrecipes() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->getrecipes($data['user_id']);        
        return responseWithHeader(true, $result);    		        
    }

    public function upvote() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->upvote($data);    
        return responseWithHeader(true, $result);    		                
    }
}