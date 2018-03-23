<?php
function json($result, $success, $mime='application/json', $status = 200) {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    $response = array(
      'success' => $success,
      'result' => $result
    );

    // We need to use $CI->output instead of $this->output
    return $CI->output
      ->set_status_header($status)
      ->set_content_type($mime, 'utf-8')
      ->set_output(json_encode($response));
}

function processRequest() {
    return json_decode(file_get_contents('php://input'), true);
}

function responseWithHeader($success, $data) {
    header('Access-Control-Allow-Origin: *');    
    header('Content-Type: application/json');
    echo json_encode(array("success"=>$success,"results"=>$data));
}

function authenticationFailedRequest() {
    $CI =& get_instance();
    $response = array(
        'text' => 'Invalid api key'
    );  
    return $CI->output
        ->set_status_header(401)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response));
}

function verifyRequest() {
    $CI =& get_instance();
    $CI->input->request_headers();
    $apikey = $CI->input->get_request_header('x-api-key');    
    if(empty($apikey) || !$apikey || $apikey == '') { //Check API KEY Existence
        echo 'api key empty';
        return false;
    }
    if($apikey != '') { // IF not NULL or EMPTY
        if($apikey == API_KEY) { //IF EQUAL process ahead            
            //Verify JWT
            $_POST = processRequest();                                                                
            try {
                $token = JWT::decode($CI->input->get_request_header('Authorization'), SECRET_SERVER_KEY);
                $_POST['user_id'] = $token->id;
                return $_POST;
            }
            catch(Exception $e) {
                return false;
            }
            if(!$token || empty($token)) { //Invalid Token
                return false;
            }             
        } 
        else { // return false
            return false;
        }
    }
}

function time_elapsed($datetime, $full = false) {
    date_default_timezone_set("America/New_York");
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
