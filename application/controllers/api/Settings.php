<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {    
    public function userprofile() {
		$request_method = $this->input->server('REQUEST_METHOD');
		if($request_method == 'GET') {
			Settings::getUserProfile();
		} else if($request_method == 'POST') {
			Settings::saveUserProfile();
		} else if($request_method == 'PUT') {

		}
	}
	
	public function getUserProfile() {
		$data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}

		$this->load->model('Settings_model');
		$result = $this->Settings_model->getUserProfile($data);
		return responseWithHeader(true, $result);    		
	}

	public function saveUserProfile() {		
		$data = verifyRequest();
		if(!$data) {
			return authenticationFailedRequest();
		}		
		$this->load->model('Settings_model');
		$result = $this->Settings_model->saveUserProfile($data);
		if($result) {
			return responseWithHeader(true, $result);    
		} else {
			return responseWithHeader(false, false);    			
		}
	}

	public function updateUserProfile() {

	}
}