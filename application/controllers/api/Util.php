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
    public function upload() {                        
        $token = JWT::decode($_POST['token'], SECRET_SERVER_KEY);
        $userid = $token->id;
        $total_files_uploaded = array();    
        $countfiles = count($_FILES['file']['name']);

        for($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];                                                        
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $temp = explode(".", $_FILES["file"]["name"][$i]);
            $newfilename = rand(1, 999999) . '' . time() . '.' . end($temp);

            move_uploaded_file($_FILES['file']['tmp_name'][$i], 'userdata/' . $userid . '/' . $newfilename);
            array_push($total_files_uploaded, 'userdata/' . $userid . '/' . $newfilename);
        }
        echo json_encode(array('success'=>true, 'files'=>$total_files_uploaded));
    }
}