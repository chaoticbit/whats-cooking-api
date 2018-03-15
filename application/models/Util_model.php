<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
    public function getCuisines() {
        $result = $this->db->query("SELECT * from cuisines");
        if($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }    

    public function insertCuisineImages() {
        $query = $this->db->query("SELECT * from cuisines");
        $result = $query->result_array();
        
        for($i=0;$i<count($result);$i++) {            
            $this->db->query("update cuisines set imagepath='cuisine_" . strtolower($result[$i]['name']) . ".jpg' where srno=" . $result[$i]['srno'] . "");
        }
    }    
}