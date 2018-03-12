<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
    public function getCuisines() {
        $result = $this->db->query("SELECT * from cuisines");
        if($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }    
}