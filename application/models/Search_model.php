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

    public function bubble_sort($arr) {
        $size = count($arr)-1;
        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-$i; $j++) {
                $k = $j+1;
                if ($arr[$k]['cosine'] > $arr[$j]['cosine']) {
                    // Swap elements at indices: $j, $k
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }

    public function ingredientSearch($keyword, $userid, $ingredients) {
        /* $query = $this->db->query("SELECT distinct recipes.srno, recipes.title, recipes.ingredients from recipes, userprofile where title LIKE '%" . $keyword . "%'");
        $result = $query->result_array();

        $articles = array();
        for($i = 0; $i < count($result); $i++) {
            $articles[$i] = explode(',',$result[$i]['ingredients']);
            $articles[$i]['title'] = $result[$i]['title'];
        }
        
        $similarity = new Similarity();
        $tags = $similarity::tags_to_point($articles);
        $target = explode(',', $ingredients);
        $compare = array_fill_keys($target, 1) + $tags;

        $resp = array();        
        foreach($articles as $article) {
            $ak = array_fill_keys($article, 1) + $tags;              
            array_push($resp, array(
                'title'=>$article['title'],
                'ingredients'=>implode(',', $article),
                'cosine'=>$similarity::cosine($compare, $ak)
            ));            
        }          
        $resp = $this->bubble_sort($resp);
        header('Content-Type: application/json');
        die(json_encode($resp));         */

        $ing = explode(',', $ingredients);                
        $response = array();

        // $query = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where FIND_IN_SET('" . $ing[0] . "', ingredients) AND FIND_IN_SET('" . $ing[1] . "', ingredients) AND FIND_IN_SET('" . $ing[2] . "', ingredients)");
        // $exact_match_results = $query->result_array();        
        // array_push($response, $exact_match_results);

        // $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where FIND_IN_SET('" . $ing[0] . "', ingredients) OR FIND_IN_SET('" . $ing[1] . "', ingredients) OR FIND_IN_SET('" . $ing[2] . "', ingredients)");
        // $result2 = $query2->result_array();        
        // array_push($response, $result2);        
                
        $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where MATCH (ingredients) AGAINST ('" . $ing[0] . "' IN NATURAL LANGUAGE MODE)");
        $result2 = $query2->result_array();        
        // array_push($response, $result2);        

        header('Content-Type: application/json');
        die(json_encode($result2));
    }
}