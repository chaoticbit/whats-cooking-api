<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model { 
    public function quickSearch($srno, $key) {
        $response = array();
        $query = $this->db->query("SELECT recipes.srno, recipes.uid, recipes.title, recipes.cover_imagepath, ratings.rating, CONCAT(useraccounts.fname, ' ', useraccounts.lname) as name FROM recipes, useraccounts, ratings WHERE (recipes.title LIKE '%" . $key . "%' OR recipes.ingredients LIKE '%" . $key . "%') AND recipes.uid=useraccounts.srno AND recipes.srno = ratings.rid LIMIT 15");        
        if($query->num_rows() > 0) { 
            return $query->result_array();
        }
        return false;
    }

    public function ingredientSearch($keyword, $userid, $ingredients) {
        // $query = $this->db->query("SELECT recipes.srno, recipes.ingredients from recipes, userprofile where title LIKE '%" . $keyword . "%' AND userprofile.uid = " . $userid . " AND recipes.food_group <= userprofile.food_group AND recipes.spicy <= userprofile.spiciness");
        // $result = $query->result_array();

        // $articles = array();
        // for($i = 0; $i < count($result); $i++) {
        //     $articles[$i] = explode(',',$result[$i]['ingredients']);
        //     $articles[$i]['srno'] = $result[$i]['srno'];
        // }
        
        // $similarity = new Similarity();
        // $tags = $similarity::tags_to_point($articles);
        // $target = explode(',', $ingredients);
        // $compare = array_fill_keys($target, 1) + $tags;

        // $resp = array();        
        // foreach($articles as $article) {
        //     $ak = array_fill_keys($article, 1) + $tags;
        //     echo $article['srno'];
        //     array_push($resp, implode(",", $article) . ' ' . $similarity::cosine($compare, $ak));                        
        // }
        // die(print_r($resp));
        // return $resp;

        $ing = explode(',', $ingredients);
        // if($ing[0]) 
        //     $findset1 = FIND_IN_SET('" . $ing[0] . "');
        // if($ing[1])
        //     $findset2 = FIND_IN_SET('" . $ing[1] . "');
        // if($ing[2])
        //     $findset3 = FIND_IN_SET('" . $ing[2] . "');
        $orig = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        
        $response = array();

        $query = $this->db->query("select recipes.srno, recipes.ingredients from recipes where FIND_IN_SET('" . $ing[0] . "', ingredients) AND FIND_IN_SET('" . $ing[1] . "', ingredients) AND FIND_IN_SET('" . $ing[2] . "', ingredients)");
        $result = $query->result_array();
        array_push($response, $result);

        $query2 = $this->db->query("select recipes.srno, recipes.ingredients from recipes where FIND_IN_SET('" . $ing[0] . "', ingredients) OR FIND_IN_SET('" . $ing[1] . "', ingredients) OR FIND_IN_SET('" . $ing[2] . "', ingredients)");
        $result2 = $query2->result_array();
        array_push($response, $result2);
        $this->db->db_debug = $orig;

        die(json_encode($response));
    }
}