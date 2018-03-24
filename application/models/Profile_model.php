<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {   
    public function getUserProfile($data) {
        $username = $data['username'];

        $validate = $this->db->query("select * from useraccounts where username = '$username'");
        if($validate->num_rows() > 0) {            
            $row = $validate->row_array();
            $query = $this->db->query("select useraccounts.srno, useraccounts.username, concat(useraccounts.fname, ' ', useraccounts.lname) as fullname, useraccounts.email, userprofile.*, cuisines.name as cname from useraccounts, userprofile, cuisines where userprofile.pref_cuisine = cuisines.srno and useraccounts.srno = " . $row['srno'] . " and userprofile.uid = useraccounts.srno");              
            $result = $query->row_array();
            
            $top_rated = $this->db->query("select recipes.srno as recipe_id, recipes.title, concat(useraccounts.fname, ' ', useraccounts.lname) as fullname, useraccounts.username, ratings.rating from recipes, ratings, useraccounts where recipes.uid = " . $result['srno'] . " and recipes.uid = useraccounts.srno and recipes.srno = ratings.rid order by rating DESC");
            if($top_rated->num_rows() > 0) {
                $result['top_rated_recipes'] = $top_rated->result_array();
            } else {
                $result['top_rated_recipes'] = [];
            }

            $recipe_count = $this->db->query("SELECT * FROM recipes where uid = " . $result['srno'] . "");
            $result['recipe_count'] = $recipe_count->num_rows();            

            return $result;
        }
        return false;
    }
}