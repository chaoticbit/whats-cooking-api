<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe_model extends CI_Model {
    public function newrecipe($data) {
        $this->db->query("INSERT into recipes(title,ingredients_html,preparation,ingredients,description,cover_imagepath,prep_time,cooking_time,servings,calorie_intake,spicy,food_group,cid,uid) VALUES ('" . $data['title'] . "','" . $data['html_ingredients_list'] . "','" . $data['preparation'] . "','" . $data['ingredients'] . "','" . $data['description'] . "','" . $data['cover_imagepath'] . "','" . $data['prep_time'] . "','" . $data['cooking_time'] . "','" . (int)$data['no_of_servings'] . "','" . (int)$data['calorie_intake'] . "','" . (int)$data['spiciness'] . "','" . (int)$data['food_group'] . "','" . (int)$data['cuisine'] . "','" . (int)$data['user_id'] . "')");        

        $query = $this->db->query("select recipes.srno as recipe_id, recipes.title, recipes.description, recipes.cover_imagepath, recipes.prep_time, recipes.cooking_time, recipes.servings, recipes.spicy, recipes.food_group, recipes.cid, recipes.uid, recipes.timestamp, CONCAT(useraccounts.fname,' ',useraccounts.lname) as fullname, cuisines.name as cname FROM recipes, useraccounts, cuisines where recipes.uid = " . (int)$data['user_id']. " AND recipes.uid=useraccounts.srno AND recipes.cid=cuisines.srno order by timestamp DESC LIMIT 1");
        if($query->num_rows() > 0) {
            $result = $query->row_array();            
            $result['cover_imagepath'] = 'userdata/' . $result['user_id'] . '/' . $result['cover_imagepath'];
            $result['rating'] = 0;
            $result['spicy'] = (int)$result['spicy'];

            $this->db->query("INSERT into weightage(rid, timestamp) values('" . (int)$result['recipe_id'] . "','" . $result['timestamp'] . "')");                        
            
            $orig = $this->db->db_debug;
            $this->db->db_debug = FALSE;
            
            $ing_array = explode(',', $data['ingredients']);
            foreach($ing_array as $ing) {
                $this->db->query("insert into ingredients values('$ing')");
            }

            $image_type = 1;
            $video_type = 2;
            
            if($data['uploaded_video'] != '') {
                $this->db->query("insert into gallery(path,type,rid) values('" . $data['uploaded_video'] . "',$video_type," . (int)$result['recipe_id'] . ")");
            }

            $images_array = explode(',', $data['uploaded_images']);
            foreach($images_array as $img) {
                $this->db->query("insert into gallery(path,type,rid) values('" . $img . "',$image_type," . (int)$result['recipe_id'] . ")");
            }

            if($data['tags_array'] != "") {                
                $array = explode(',', $data['tags_array']);
                foreach($array as $element) {
                    $element = preg_replace('/[^A-Za-z0-9\-]/','',$element);
                    $this->db->query("insert into tags values('$element')");
                    $this->db->query("insert into recipe_tags values('" . $element . "','" . (int)$result['recipe_id'] . "')");
                }                
            }
            $this->db->db_debug = $orig;
            return $result;
        }        
    }

    public function getrecipes($user_id) {
        $user_id = (int)$user_id;

        $query = $this->db->query("select recipes.srno as recipe_id, recipes.title, recipes.description, recipes.cover_imagepath, recipes.prep_time, recipes.cooking_time, recipes.servings, recipes.spicy, recipes.food_group, recipes.cid, recipes.uid, recipes.timestamp, CONCAT(useraccounts.fname,' ',useraccounts.lname) as fullname, cuisines.name as cname, ratings.rating FROM recipes, useraccounts, cuisines, ratings where recipes.uid=useraccounts.srno AND recipes.srno=ratings.rid AND recipes.cid=cuisines.srno order by timestamp DESC LIMIT 10");
        if($query->num_rows() > 0) { 
            $result = $query->result_array();      
            for($i=0;$i<count($result);$i++) {
                $result[$i]['cover_imagepath'] = 'userdata/' . (int)$result[$i]['uid'] . '/' . $result[$i]['cover_imagepath'];
                $query_ = $this->db->query("select * from favourites where rid = " . (int)$result[$i]['recipe_id'] . " and uid = " . $user_id . "");                
                if($query_->num_rows() > 0) {
                    $result[$i]['addedToFavourites'] = true;
                } else {
                    $result[$i]['addedToFavourites'] = false;
                }                
            }
            return $result;      
        }
        return false;
    }
}