<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
    public function getCuisines($user_id) {
        $query = $this->db->query("select * from cuisines LEFT JOIN cuisine_user ON cuisines.srno=cuisine_user.cid AND cuisine_user.uid=" . (int)$user_id . " ORDER BY uid DESC");
        if($query->num_rows() > 0) {
            $result = $query->result_array();            
            return $result;
        }
        return false;
    }      

    public function updateCuisine($data) {
        $userid = (int)$data['user_id'];
        $cid = (int)$data['cid'];

        $query = $this->db->query("select * from cuisine_user where cid = " . $cid . " and uid = " . $userid . "");
        if($query->num_rows() > 0) { //unfollow
            $this->db->query("delete from cuisine_user where cid = " . $cid . " and uid = " . $userid . "");
            return true;
        } else {
            $this->db->query("insert into cuisine_user values(" . $cid . "," . $userid . ")");
            return true;
        }        
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

    public function addToFavourites($data) {
        $this->db->query("insert into favourites values(" . (int)$data['rid'] . ", " . (int)$data['user_id'] . ")");
        $query = $this->db->query("select * from favourites where rid = " . (int)$data['rid'] . " and uid = " . (int)$data['user_id'] . "");
        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function removeFromFavourites($data) {
        $this->db->query("delete from favourites where rid = " . (int)$data['rid'] . " and uid = " . (int)$data['user_id'] . "");
        $query = $this->db->query("select * from favourites where rid = " . (int)$data['rid'] . " and uid = " . (int)$data['user_id'] . "");
        return true;
    }

    public function getFavourites($user_id) {
        $result = $this->db->query("SELECT recipes.srno, recipes.title, recipes.uid as recipe_owner_id, recipes.cover_imagepath, concat(useraccounts.fname,' ',useraccounts.lname) as fullname, useraccounts.username from recipes, favourites, useraccounts where favourites.uid=" . (int)$user_id . " and recipes.uid=useraccounts.srno and recipes.srno=favourites.rid ");
        if($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }     

    public function getFeaturedRecipes() {
        $result = $this->db->query("select recipes.srno, recipes.title, concat(useraccounts.fname,' ',useraccounts.lname) as fullname, useraccounts.username from recipes, useraccounts, weightage where recipes.uid=useraccounts.srno and recipes.srno=weightage.rid and DATE(recipes.timestamp) = CURDATE() ORDER BY weight DESC LIMIT 5");
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