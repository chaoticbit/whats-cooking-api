<?php

class Similarity {
  public static function tags_to_point($articles) {
    $tags = array();
    foreach($articles as $article) {
      $tags = array_merge($tags, $article);
    }
    $tags = array_unique($tags);
    
    $tags = array_fill_keys($tags, 0);
    ksort($tags);
    return $tags;
  }
  public function dot_product($a, $b) {
    $products = array_map(function($a, $b) {
      return $a * $b;
    }, $a, $b);
    return array_reduce($products, function($a, $b) {
      return $a + $b;
    });
  }
  public function magnitude($point) {
    $squares = array_map(function($x) {
      return pow($x, 2);
    }, $point);
    return sqrt(array_reduce($squares, function($a, $b) {
      return $a + $b;
    }));
  }
  public static function cosine($a, $b) {
    ksort($a);
    ksort($b);    
    return (new Similarity)->dot_product($a, $b) / ((new Similarity)->magnitude($a) * (new Similarity)->magnitude($b)); 
  }
} 

// $articles = array(
//     array("ginger", "garlic", "butter", "potatoes", "raddish"),
//     array("bread", "garlic", "clove", "jam", "chicken", "stock"),
//     array("butter", "eggs", "ginger"),
//     array("chicken", "bread", "jam", "peanuts", "eggs")
// );

// $tags = Similarity::tags_to_point($articles);
// $target = array('chicken', 'bread', 'eggs');
// $compare = array_fill_keys($target, 1) + $tags;

// foreach($articles as $article) {
//     $ak = array_fill_keys($article, 1) + $tags;
//     echo $article;
//     echo '<br />';
//     echo "score: ";
//     echo Similarity::cosine($compare, $ak);
//     echo '<br />';echo '<br />';
// }

?>