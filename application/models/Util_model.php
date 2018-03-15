<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
    public function getCuisines() {
        $result = $this->db->query("SELECT * from cuisines");
        if($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }      

    public function getTags() {
        $response = array();
        $query = $this->db->query("SELECT tags.name FROM tags");
        if($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach($result as $item) {
                $tag_result = array("name"=>$item['name'],"value"=>$item['name'],"text"=>$item['name']);
                array_push($response, $tag_result);
            }
        }
        return $response;
    }

    public function getFavourites($user_id) {
        $result = $this->db->query("SELECT recipes.srno, recipes.title, recipes.cover_imagepath, concat(useraccounts.fname,' ',useraccounts.lname), useraccounts.username from recipes, favourites, useraccounts where favourites.uid=" . (int)$user_id . " and recipes.uid=useraccounts.srno and recipes.srno=favourites.rid ");
        if($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }     

    public function getFeaturedRecipes() {
        $result = $this->db->query("select recipes.srno, recipes.title, concat(useraccounts.fname,' ',useraccounts.lname), useraccounts.username from recipes, useraccounts, weightage where recipes.uid=useraccounts.srno and recipes.srno=weightage.rid and DATE(recipes.timestamp) = CURDATE() ORDER BY weight DESC LIMIT 5");
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