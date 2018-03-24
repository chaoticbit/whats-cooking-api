<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {
    public function getUserProfile($data) {
        $query = $this->db->query("select useraccounts.srno, useraccounts.password, useraccounts.username, useraccounts.fname, useraccounts.lname, useraccounts.email, userprofile.*, cuisines.name as cname, cuisines.srno as cid from useraccounts, userprofile, cuisines where userprofile.pref_cuisine = cuisines.srno and useraccounts.srno = " . (int)$data['user_id'] . " and userprofile.uid = useraccounts.srno");              
            $result = $query->row_array();
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function saveUserProfile($data) {
        $result = $this->db->query("INSERT into userprofile values('" . $data['city'] . "','" . $data['state'] . "','" . $data['country'] . "','" . $data['gender'] . "','" . $data['profile_imagepath'] . "','" . $data['pref_cuisine'] . "','" . $data['food_group'] . "','" . $data['spiciness'] . "','" . $data['calorie_intake'] . "', '" . (int)$data['user_id'] . "')");
        $cuisine_array = explode(',', $data['followed_cuisines']);
        foreach($cuisine_array as $cid) {
            $this->db->query("insert into cuisine_user values(" . (int)$cid . "," . (int)$data['user_id'] . ")");
        }
        return true;
    }
}