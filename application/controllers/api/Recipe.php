<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe extends CI_Controller {        

    public function get($rid) {
        $data = verifyRequest();
        if(!$data) {
			return authenticationFailedRequest();
        }
     
        $this->load->model('Recipe_model');
        $result = $this->Recipe_model->fetchSingleRecipe((int)$rid, (int)$data['user_id']);        
        if($result) {
            return responseWithHeader(true, $result); 
        } else {
            return responseWithHeader(false, []); 
        }
    }

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

    public function load_more() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->load_more($data);        
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
    
    public function rate() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->rate($data);    
        return responseWithHeader(true, $result);    		                
    }

    public function post_reply() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->post_reply($data);    
        return responseWithHeader(true, $result);    		                
    }

    public function per_category_recipes() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->per_category_recipes($data);    
        if($result) {
            return responseWithHeader(true, $result);    		                
        } else {
            return responseWithHeader(true, []);    		                
        }
    }

    public function per_tag_recipes() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->per_tag_recipes($data);    
        if($result) {
            return responseWithHeader(true, $result);    		                
        } else {
            return responseWithHeader(true, []);    		                
        }
    }

    public function category_related_tags() {
        $data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Recipe_model');
        $result = $this->Recipe_model->category_related_tags($data);    
        if($result) {
            return responseWithHeader(true, $result);    		                
        } else {
            return responseWithHeader(true, []);    		                
        }
    }
}