<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {    
    public function quick($key, $filter) {
        $data = verifyRequest();
        if(!$data) {
			return authenticationFailedRequest();
        }
        
        $this->load->model('Search_model');
        $result = $this->Search_model->quickSearch($data['user_id'], $key, $filter);
        if($result) {
            return responseWithHeader(true, $result);    		        
        } else {
            return responseWithHeader(true, []);    		        
        }
    }

    public function ingredients() {
        $data = verifyRequest();
        if(!$data) {
			return authenticationFailedRequest();
        }

        $keyword = $data['keyword'];
        $userid = (int)$data['user_id'];
        $ingredients = $data['ingredients'];
        $exclude = $data['exclude'];
        
        $this->load->model('Search_model');
        $result = $this->Search_model->ingredientSearch($keyword, $userid, $ingredients, $exclude);
        var_dump($result);
    }
}