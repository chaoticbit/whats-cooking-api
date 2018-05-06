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
        
        $this->load->model('Search_model');
        $result = $this->Search_model->i_search($keyword, $userid, $ingredients);
        if($result) {
            return responseWithHeader(true, $result);    		        
        } else {
            return responseWithHeader(true, []);    		        
        }
    }

    public function g($key) {
        $data = verifyRequest();
        if(!$data) {
			return authenticationFailedRequest();
        }

        $filters = array();
        $filters['key'] = $this->security->xss_clean($key);        
        $filters['spicy'] = $this->security->xss_clean($this->input->get('s'));        
        $filters['food_group'] = $this->security->xss_clean($this->input->get('fg'));
        $filters['calorie_intake'] = $this->security->xss_clean($this->input->get('cal'));
        $filters['cid'] = $this->security->xss_clean($this->input->get('cid'));
        $filters['cooking_time'] = $this->security->xss_clean($this->input->get('ct'));
        $filters['sort_by'] = $this->security->xss_clean($this->input->get('sort_by'));
        
        $this->load->model('Search_model');
        $result = $this->Search_model->g_search($data["user_id"], $filters);
        if($result) {
            return responseWithHeader(true, $result);    		        
        } else {
            return responseWithHeader(true, []);    		        
        }
    }
}