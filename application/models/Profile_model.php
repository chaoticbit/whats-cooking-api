<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {   
    public function getUserProfile($data) {
        $username = $data['username'];

        $validate = $this->db->query("select * from useraccounts where username = '$username'");
        if($validate->num_rows() > 0) {            
            $row = $validate->row_array();
            $query = $this->db->query("select useraccounts.srno, useraccounts.username, concat(useraccounts.fname, ' ', useraccounts.lname) as fullname, useraccounts.email, userprofile.* from useraccounts, userprofile where useraccounts.srno = " . $row['srno'] . " and userprofile.uid = useraccounts.srno");              
            $result = $query->row_array();
            
            $top_rated = $this->db->query("select recipes.srno, recipes.title from recipes, ratings where recipes.srno = ratings.rid order by rating DESC");
        }
        return false;
    }
}