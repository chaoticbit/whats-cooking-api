<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe_model extends CI_Model {   
    public function newrecipe($data) {
        $this->db->query("INSERT into recipes(title,ingredients_html,preparation,ingredients,description,cover_imagepath,prep_time,cooking_time,servings,calorie_intake,spicy,food_group,cid,uid) VALUES ('" . $data['title'] . "','" . $data['html_ingredients_list'] . "','" . $data['preparation'] . "','" . $data['ingredients'] . "','" . $data['description'] . "','" . $data['cover_imagepath'] . "','" . $data['prep_time'] . "','" . $data['cooking_time'] . "','" . (int)$data['no_of_servings'] . "','" . (int)$data['calorie_intake'] . "','" . (int)$data['spiciness'] . "','" . (int)$data['food_group'] . "','" . (int)$data['cuisine'] . "','" . (int)$data['user_id'] . "')");        

        $query = $this->db->query("select recipes.srno as recipe_id, recipes.title, recipes.description, recipes.cover_imagepath, recipes.prep_time, recipes.cooking_time, recipes.servings, recipes.spicy, recipes.food_group, recipes.cid, recipes.uid, recipes.timestamp, CONCAT(useraccounts.fname,' ',useraccounts.lname) as fullname, useraccounts.username, cuisines.name as cname FROM recipes, useraccounts, cuisines where recipes.uid = " . (int)$data['user_id']. " AND recipes.uid=useraccounts.srno AND recipes.cid=cuisines.srno order by timestamp DESC LIMIT 1");
        if($query->num_rows() > 0) {
            $result = $query->row_array();    
            if($result['cover_imagepath'] != '')
                $result['cover_imagepath'] = 'userdata/' . $data['user_id'] . '/' . $result['cover_imagepath'];
            else 
                $result['cover_imagepath'] = '';
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
        
        $query = $this->db->query("select recipes.srno as recipe_id, recipes.title, recipes.description, recipes.cover_imagepath, recipes.prep_time, recipes.cooking_time, recipes.servings, recipes.spicy, recipes.food_group, recipes.cid, recipes.uid, recipes.timestamp, CONCAT(useraccounts.fname,' ',useraccounts.lname) as fullname, useraccounts.username, cuisines.name as cname, ratings.rating FROM recipes, useraccounts, userprofile, cuisines, cuisine_user, ratings where userprofile.uid = " . $user_id . " AND userprofile.food_group >= recipes.food_group AND userprofile.spiciness >= recipes.spicy AND recipes.uid = useraccounts.srno AND recipes.srno=ratings.rid AND recipes.cid=cuisines.srno AND recipes.cid=cuisine_user.cid AND cuisine_user.uid=" . $user_id . " order by timestamp DESC LIMIT 10");
        if($query->num_rows() > 0) { 
            $result = $query->result_array();      
            for($i=0;$i<count($result);$i++) {
                if($result[$i]['cover_imagepath'] != '') 
                    $result[$i]['cover_imagepath'] = 'userdata/' . (int)$result[$i]['uid'] . '/' . $result[$i]['cover_imagepath'];
                else 
                    $result[$i]['cover_imagepath'] = '';                

                $query_favourites = $this->db->query("select * from favourites where rid = " . (int)$result[$i]['recipe_id'] . " and uid = " . $user_id . "");                
                if($query_favourites->num_rows() > 0) {
                    $result[$i]['addedToFavourites'] = true;
                } else {
                    $result[$i]['addedToFavourites'] = false;
                }        
                
                $query_upvotes = $this->db->query("SELECT * FROM upvotes WHERE rid = " . $result[$i]['recipe_id']);
                $result[$i]['upvotes'] = $query_upvotes->num_rows();
                $query_replies = $this->db->query("SELECT * FROM reply WHERE rid = " . $result[$i]['recipe_id']);
                $result[$i]['replies'] = $query_replies->num_rows();
                $query_views = $this->db->query("SELECT * FROM views WHERE rid = " . $result[$i]['recipe_id']);
                $result[$i]['views'] = $query_views->num_rows();

                $query_isupvoted = $this->db->query("SELECT * FROM upvotes WHERE rid = " . $result[$i]['recipe_id'] . " and uid = " . $user_id . "");
                if($query_isupvoted->num_rows() > 0) {
                    $result[$i]['isUpvoted'] = true;
                } else {
                    $result[$i]['isUpvoted'] = false;
                }        

            }
            return $result;      
        }
        return false;
    }

    public function fetchSingleRecipe($rid, $userid) {

        $orig = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        
        $this->db->query("INSERT INTO views VALUES(" . $rid . ", " . $userid  . ")");

        $this->db->db_debug = $orig;

        $query = $this->db->query("select recipes.*, cuisines.name as cname, useraccounts.username, concat(useraccounts.fname,' ',useraccounts.lname) as owner, userprofile.profile_imagepath, ratings.srno as rating_id, ratings.rating, (select count(*) from upvotes where upvotes.rid = recipes.srno) as upvotes, (select count(*) from reply where reply.rid = recipes.srno) as replies, (select count(*) from views where views.rid = recipes.srno) as views, (select count(*) from upvotes where upvotes.rid = " . $rid . " and upvotes.uid = " . $userid . ") as is_upvoted, (select count(*) from favourites where favourites.rid = " . $rid . " and favourites.uid = " . $userid . ") as is_favourite, (select count(*) from ratings, ratings_per_user where ratings.rid = " . $rid . " and ratings.srno = ratings_per_user.rating_id and ratings_per_user.uid = " . $userid . ") as is_rated from recipes, useraccounts, ratings, cuisines, userprofile where recipes.srno=" . $rid . " and recipes.uid = userprofile.uid and recipes.srno = ratings.rid and recipes.cid = cuisines.srno and recipes.uid = useraccounts.srno");
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            $result['time_elapsed'] = time_elapsed($result['timestamp']);
            $query_tags = $this->db->query("SELECT recipe_tags.name FROM recipe_tags WHERE rid=" . (int)$result['srno']);
            if($query_tags->num_rows()>0){
                $result['tags'] = $query_tags->result_array();
            }
            else{
                $result['tags'] = false;
            }

            $query_rating = $this->db->query("select ratings.rating from ratings, ratings_per_user where ratings.rid = " . $rid . " and ratings.srno = ratings_per_user.rating_id and ratings_per_user.uid = " . $userid . ""); 
            if($query_rating->num_rows() > 0) {
                $result_rating = $query_rating->row_array();
                $result['user_rating'] = $result_rating['rating'];
            } else {
                $result['user_rating'] = 0;
            }

            $query_gallery = $this->db->query("select gallery.path, gallery.type from gallery where rid = " . (int)$result['srno']);
            if($query_gallery->num_rows()>0){
                $result['gallery'] = $query_gallery->result_array();
            }
            else{
                $result['gallery'] = false;
            }

            $query_replies = $this->db->query("select reply.*, concat(useraccounts.fname, ' ', useraccounts.lname) as fullname, useraccounts.username from reply, useraccounts where rid = " . $rid . " and reply.uid = useraccounts.srno order by timestamp DESC");
            if($query_replies->num_rows() > 0){
                $result_replies = $query_replies->result_array();
                $result['list_of_replies'] = $result_replies;
                for($i=0;$i<count($result['list_of_replies']);$i++) { 
                    $result['list_of_replies'][$i]['time_elapsed'] = time_elapsed($result['list_of_replies'][$i]['timestamp']);
                }                                
            } else {
                $result['list_of_replies'] = [];
            }
            return $result;
        }
        return false;
    }

    public function upvote($data) {
        $rid = (int)$data['rid'];
        $userid = (int)$data['user_id'];            
        $query = $this->db->query("select * from upvotes where rid = " . $rid . " and uid = " . $userid . "");
        if($query->num_rows() > 0) { //remove upvote
            $this->db->query("delete from upvotes where rid = " . $rid . " and uid = " . $userid . "");
            $updated = $this->db->query("SELECT COUNT(*) as upvote_cnt FROM upvotes WHERE rid=" . $rid . "");            
            return $updated->row_array();
        } else { //add upvote
            $this->db->query("insert into upvotes(rid, uid) values(" . $rid . "," . $userid . ")");                        
            $updated = $this->db->query("SELECT COUNT(*) as upvote_cnt FROM upvotes WHERE rid=" . $rid . "");            
            return $updated->row_array();            
        }  
    }

    public function register_view($data){
        $rid = (int)$data['rid'];
        $userid = (int)$data['user_id'];     

        $orig = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        
        $this->db->query("INSERT INTO views VALUES(" . $rid . ", " . $userid  . ")");

        $this->db->db_debug = $orig;
    }

    public function rate($data) {
        $userid = (int)$data['user_id'];
        $rid = (int)$data['rid'];
        $rating_id = (int)$data['rating_id'];
        $rating = (int)$data['rating'];

        $this->db->query("insert into ratings_per_user values (" . $rating_id . "," . $rating . "," . $userid . ") ");
        $query = $this->db->query("select * from ratings where rid = " . $rid . "");
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result;
        }
    }

    public function post_reply($data) {
        $orig = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $rid = $this->security->xss_clean((int)$data['rid']);
        $userid = $this->security->xss_clean((int)$data['user_id']);
        $description = $this->security->xss_clean($data['description']);

        $this->db->query("INSERT into reply(description,rid,uid) VALUES ('" . $description . "'," . $rid . "," . $userid . ")");

        $this->db->db_debug = $orig;

        $query = $this->db->query("select reply.*, concat(useraccounts.fname, ' ', useraccounts.lname) as fullname, useraccounts.username from reply, useraccounts where reply.rid = " . (int)$data['rid'] . " and reply.uid = " . (int)$data['user_id'] . " and reply.uid=useraccounts.srno order by timestamp DESC LIMIT 1");
        if($query->num_rows() > 0) {
            $result = $query->row_array();   
            $result['time_elapsed'] = time_elapsed($result['timestamp']);
            return $result;
        }
        return false;       
    }

    public function per_category_recipes($data) {
        $cid = (int)$data['cid'];
        $user_id = (int)$data['user_id'];

        $query = $this->db->query("select distinct recipes.srno as recipe_id, recipes.title, recipes.description, recipes.cover_imagepath, recipes.prep_time, recipes.cooking_time, recipes.servings, recipes.spicy, recipes.food_group, recipes.cid, recipes.uid, recipes.timestamp, CONCAT(useraccounts.fname,' ',useraccounts.lname) as fullname, useraccounts.username, cuisines.name as cname, ratings.rating FROM recipes, useraccounts, userprofile, cuisines, cuisine_user, ratings where cuisines.srno = " . $cid . " AND recipes.uid = useraccounts.srno AND recipes.srno=ratings.rid AND recipes.cid=cuisines.srno AND recipes.cid=cuisine_user.cid order by timestamp DESC LIMIT 10");
        if($query->num_rows() > 0) { 
            $result = $query->result_array();      
            for($i=0;$i<count($result);$i++) {
                if($result[$i]['cover_imagepath'] != '') 
                    $result[$i]['cover_imagepath'] = 'userdata/' . (int)$result[$i]['uid'] . '/' . $result[$i]['cover_imagepath'];
                else 
                    $result[$i]['cover_imagepath'] = '';                

                $query_favourites = $this->db->query("select * from favourites where rid = " . (int)$result[$i]['recipe_id'] . " and uid = " . $user_id . "");                
                if($query_favourites->num_rows() > 0) {
                    $result[$i]['addedToFavourites'] = true;
                } else {
                    $result[$i]['addedToFavourites'] = false;
                }        
                
                $query_upvotes = $this->db->query("SELECT * FROM upvotes WHERE rid = " . $result[$i]['recipe_id']);
                $result[$i]['upvotes'] = $query_upvotes->num_rows();
                $query_replies = $this->db->query("SELECT * FROM reply WHERE rid = " . $result[$i]['recipe_id']);
                $result[$i]['replies'] = $query_replies->num_rows();
                $query_views = $this->db->query("SELECT * FROM views WHERE rid = " . $result[$i]['recipe_id']);
                $result[$i]['views'] = $query_views->num_rows();

                $query_isupvoted = $this->db->query("SELECT * FROM upvotes WHERE rid = " . $result[$i]['recipe_id'] . " and uid = " . $user_id . "");
                if($query_isupvoted->num_rows() > 0) {
                    $result[$i]['isUpvoted'] = true;
                } else {
                    $result[$i]['isUpvoted'] = false;
                }        

            }
            return $result;      
        }
        return false;
    }

    public function category_related_tags($data) {
        $cid = (int)$data['cid'];
        $user_id = (int)$data['user_id'];

        $query = $this->db->query("select distinct(recipe_tags.name) from recipes, recipe_tags, cuisines where recipes.cid = cuisines.srno and cuisines.srno = " . $cid . " and recipes.srno = recipe_tags.rid");
        if($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        }
        return false;
    }
}

