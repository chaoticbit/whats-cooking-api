<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model { 
    public function quickSearch($srno, $key, $filter) {
        $response = array();
        $query = '';

        if($filter == 'search_r') {
            $query = $this->db->query("SELECT recipes.srno, recipes.uid, recipes.title, recipes.cover_imagepath,ratings.rating, CONCAT(useraccounts.fname, ' ', useraccounts.lname) as name FROM recipes, useraccounts,ratings WHERE (recipes.title LIKE '%" . $key . "%' OR recipes.ingredients LIKE '%" . $key . "%') AND recipes.uid=useraccounts.srno AND recipes.srno = ratings.rid LIMIT 15");        
        } else if($filter == 'search_p') {
            $query = $this->db->query("SELECT useraccounts.username, CONCAT(useraccounts.fname, ' ', useraccounts.lname) as name, userprofile.profile_imagepath FROM useraccounts, userprofile WHERE (CONCAT(useraccounts.fname, ' ', useraccounts.lname) LIKE '%" . $key . "%' OR useraccounts.username LIKE '%" . $key . "%') AND useraccounts.srno = userprofile.uid LIMIT 15");        
        } else if($filter == 'search_t') {
            $query = $this->db->query("SELECT tags.name FROM tags where tags.name LIKE '%" . $key . "%' LIMIT 15");
        }
        
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

    public function ingredientSearch($keyword, $userid, $ingredients, $exclude) {        
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
        $query2 = '';
        $result2 = '';
        $count = count($ing);

        if($count == 1) {
            if($keyword == '') {
                if($exclude == '') {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where match(ingredients) against('" . $ing[0] . "' in natural language mode)");
                } else {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where FIND_IN_SET('" . $exclude . "', ingredients) = 0 AND match(ingredients) against('" . $ing[0] . "' in natural language mode)");                    
                }
            } else {
                if($exclude == '') {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '%" . $keyword . "%' AND match(ingredients) against('" . $ing[0] . "' in natural language mode)");
                } else {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '%" . $keyword . "%' AND FIND_IN_SET('" . $exclude . "', ingredients) = 0 AND match(ingredients) against('" . $ing[0] . "' in natural language mode)");                    
                }
            }                        
        } else if($count == 2) {
            if($keyword == '') {
                if($exclude == '') {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode))");
                } else {                    
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where FIND_IN_SET('" . $exclude . "', ingredients) = 0 AND match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                }
            } else {
                if($exclude == '') {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '%" . $keyword . "%' AND match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                } else {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '%" . $keyword . "%' AND FIND_IN_SET('" . $exclude . "', ingredients) = 0 AND match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                }
            }                        
        } else if($count == 3) {
            if($keyword == '') {
                if($exclude == '') {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                } else {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where FIND_IN_SET('" . $exclude . "', ingredients) = 0 AND match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                }
            } else {
                if($exclude == '') {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '%" . $keyword . "%' AND match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                } else {
                    $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '%" . $keyword . "%' AND FIND_IN_SET('" . $exclude . "', ingredients) = 0 AND match(ingredients) against('" . $ing[0] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode) OR match(ingredients) against('" . $ing[1] . "' in natural language mode)");
                }
            }                        
        }

        /* if($exclude == '') {
            $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '" . $keyword . "' AND FIND_IN_SET('" . $ing[0] . "', ingredients) OR FIND_IN_SET('" . $ing[1] . "', ingredients) OR FIND_IN_SET('" . $ing[2] . "', ingredients)");
            $result2 = $query2->result_array();         
        } else {
            $query2 = $this->db->query("select recipes.srno, recipes.title, recipes.ingredients from recipes where recipes.title LIKE '" . $keyword . "' AND FIND_IN_SET('" . $ing[0] . "', ingredients) OR FIND_IN_SET('" . $ing[1] . "', ingredients) OR FIND_IN_SET('" . $ing[2] . "', ingredients) AND NOT FIND_IN_SET('" . $exclude . "', ingredients)");
            $result2 = $query2->result_array();         
        } */
        $result2 = $query2->result_array();
        header('Content-Type: application/json');
        die(json_encode($result2));
    }
}