<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {    
  	public function login() {    
		$_POST = processRequest();
		$this->load->model('Authentication_model');
		
		$result = $this->Authentication_model->validate_credentials($_POST['username'], md5($_POST['password']));        
		
		if($result) {
	  		$data = array(				
				"username" => $_POST['username'],
				"fname" => $result['fname'],
				"lname" => $result['lname'],
				"email" => $result['email'],                
				"avatarpath" => $result['profile_imagepath']
            );              
            $token = array();
            $token['id'] = $result['srno']; 
            $data['token'] = JWT::encode($token, SECRET_SERVER_KEY);
			return responseWithHeader(true, $data);    
		} else {
			return responseWithHeader(false, false);    
		}			
  	}  

	public function getdata() {		
		if(!verifyRequest()) {
			return authenticationFailedRequest();
		}
	    return responseWithHeader(true, array('response'=>$_POST['user_id']));        
  	}

	public function signup() {
		$_POST = processRequest();                
		$_POST['password'] = md5($_POST['password']);
		$this->load->model('Authentication_model');
		$srno = $this->Authentication_model->signup($_POST);
		$data = array(			
			"username" => $_POST['username'],
			"fname" => $_POST['fname'],			
			"lname" => $_POST['lname'],			
			"email" => $_POST['email'],
			"avatarpath" => '' 			
        );
        $token = array();
        $token['id'] = $srno; 
        $data['token'] = JWT::encode($token, SECRET_SERVER_KEY);		
		mkdir(FCPATH . "userdata/" . $this->session->userdata('userid'), 0700, true);
		chmod(FCPATH . "userdata/" . $this->session->userdata('userid'), 0777);
		return responseWithHeader(true, $data);
	}
	
	public function usernameExists() {
		$_POST = processRequest();
		$username = $this->security->xss_clean($_POST['username']);			
		$this->load->model('Authentication_model');
		$result = $this->Authentication_model->usernameExists($username);
		if($result) {
			return responseWithHeader(true, []);
		} else {
			return responseWithHeader(false, []);
		}		
	}
	
	public function emailExists() {
		$_POST = processRequest();
		$email = $this->security->xss_clean($_POST['email']);			
		$this->load->model('Authentication_model');
		$result = $this->Authentication_model->emailExists($email);
		if($result) {
			return responseWithHeader(true, []);
		} else {
			return responseWithHeader(false, []);
		}		
	}

	public function logout() {
		foreach (array('userid', 'username', 'passowrd') as $key => $value) {
	  		$this->session->unset_userdata($key);
		}
		session_destroy();
		return json_encode('User logged out', true);
  	}

	public function upload() {
		foreach($_FILES['uploads']['name'] as $n=>$name) {
			$ext = explode('.', $_FILES['uploads']['name'][$n]);
			$extension = $ext[1];
			$newname = $ext[0].'_'.time();
			$full_path = FCPATH . 'media/' . $newname . '.' . $extension;
			move_uploaded_file($_FILES['uploads']['tmp_name'][$n], $full_path);
		}
		// return json(json_decode($_POST['metadata']), true);
		echo $_POST['metadata'];
	}
}
