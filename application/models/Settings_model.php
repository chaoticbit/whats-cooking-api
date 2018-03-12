<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {
    public function getUserProfile($data) {
        $result = $this->db->query("SELECT * from userprofile where uid = " . (int)$data['user_id']);
        if($result->num_rows() > 0) {
            return $result->row_array();
        }
        return false;
    }

    public function saveUserProfile($data) {
        $result = $this->db->query("INSERT into userprofile values('" . $data['city'] . "','" . $data['state'] . "','" . $data['country'] . "','" . $data['gender'] . "','" . $data['profile_imagepath'] . "','" . $data['pref_cuisine'] . "','" . $data['food_group'] . "','" . $data['spiciness'] . "','" . $data['calorie_intake'] . "', '" . (int)$data['user_id'] . "')");
        return true;
    }
}