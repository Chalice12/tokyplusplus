<?php

$getopts = [
    "http" => [
        "method" => "GET",
        "header" => "Accept: application/json, text/plain, */*\r\n" .
            "Cookie: " . @$_COOKIE["toky_cookie"] . "\r\n" .
			"User-Agent: toky++ web\r\n"
    ]
];

function get_questions($num, $page) {
    global $getopts;
    $context = stream_context_create($getopts);
    return json_decode(file_get_contents(
	  "https://toky.chat/api/v2/brandCategories/1/questions?count=" . (int) $num . "&page=" . (int) $page . "&skip=0",
	  false, $context
	), true);
}

function get_chats() {
    global $getopts;
    $context = stream_context_create($getopts);
    return json_decode(file_get_contents(
	  "https://toky.chat/api/v2/brandcategories/1/chats?isBrandRestricted=true&page=0",
	  false, $context
	), true);
}

function get_chat($id) {
	global $getopts;
    $context = stream_context_create($getopts);
    return json_decode(file_get_contents(
	  "https://toky.chat/api/v2/brandcategories/1/chats/".(string) $id."/messages?page=0&skip=0",
	  false, $context
	), true);
}

function get_question() {
	global $getopts;
    $context = stream_context_create($getopts);
    return json_decode(file_get_contents(
	  "https://toky.chat/api/v2/brandcategories/1/questions?last=true",
	  false, $context
	), true);
}

function skip_question($id) {
	$data = '{"questionId":'.$id.'}';

	$options = array(
      'http' => array(
		'ignore_errors' => TRUE,
        'method'  => 'POST',
        'content' => $data,
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n" .
					"Cookie: " . $_COOKIE["toky_cookie"] . "\r\n" .
					"User-Agent: ".$_SERVER['HTTP_USER_AGENT']." (toky++ web)\r\n"
        )
    );
	
	$context  = stream_context_create( $options );
    $result = file_get_contents( "https://toky.chat/api/v2/brandcategories/1/questionSkipped", false, $context );
}

//function send_chat($text, $chat, $ourid) {
function send_chat($text, $chat) {
	$data = '{"id":null,"date":'.time().',"chatId":'.$chat.',"text":"'.addslashes($text).'"}';
	//$data = '{"id":null,"date":1609522721911,"chatId":'.$chat.',"text":"'.$text.'","user":{"id":'.$ourid.',"nickname":"swag","profilePicture":null,"isCertified":false,"isAdmin":false,"highestStatus":null,"nbPeopleHelped":0,"isCoach":false,"bio":null,"birthDate":"1905-05-23T00:00:00","age":115,"town":null,"country":null,"nbExperience":0,"isOnline":true,"ranking":0,"dateJoined":null,"roles":[],"flag":null,"bannedState":[],"attributes":null,"language":null}}';

	$options = array(
      'http' => array(
		'ignore_errors' => TRUE,
        'method'  => 'POST',
        'content' => $data,
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n" .
					"Cookie: " . $_COOKIE["toky_cookie"] . "\r\n" .
					"User-Agent: ".$_SERVER['HTTP_USER_AGENT']." (toky++ web)\r\n"
        )
    );
	
	$context  = stream_context_create( $options );
    $result = file_get_contents( "https://toky.chat/api/v2/brandcategories/1/chats/".$chat."/messages", false, $context );
}

function reply_question($text, $chat) {
	$data = '{questionId: '.$chat.', text: "'.addslashes($text).'", platformType: "Widget"}';

	$options = array(
      'http' => array(
		'ignore_errors' => TRUE,
        'method'  => 'POST',
        'content' => $data,
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n" .
					"Cookie: " . $_COOKIE["toky_cookie"] . "\r\n" .
					"User-Agent: ".$_SERVER['HTTP_USER_AGENT']." (toky++ web)\r\n"
        )
    );
	
	$context  = stream_context_create( $options );
    $result = file_get_contents( "https://toky.chat/api/v2/brandcategories/1/answers", false, $context );
}

function send_question($text) {
	$data = '{"text":"'.addslashes($text).'","imageUrl":null,"isOnlyForAdmin":false,"urlPosted":"","customVars":null}';
	
	$options = array(
      'http' => array(
		'ignore_errors' => TRUE,
        'method'  => 'POST',
        'content' => $data,
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n" .
					"Cookie: " . $_COOKIE["toky_cookie"] . "\r\n" .
					"User-Agent: ".$_SERVER['HTTP_USER_AGENT']." (toky++ web)\r\n"
        )
    );
    
    $context  = stream_context_create( $options );
    $result = file_get_contents( "https://toky.chat/api/v2/brandcategories/1/questions", false, $context );
	if ($http_response_header[0] != "HTTP/1.1 204 No Content") return 1;
	
	global $getopts;
	$context = stream_context_create($getopts);
	$piss = substr($http_response_header[7], -7);
	if (substr(substr($http_response_header[7], -7), 0, 1) == "/") {
		$piss = substr($http_response_header[7], -6);
	}
    return json_decode(file_get_contents(
	  "https://toky.chat/api/v2/brandcategories/1/questions?id=" . $piss,
	  false, $context
	), true)[0]["text"];
}

function set_auth_cookies() {
	$data = array('grantType' => 'visitor');
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents("https://toky.chat/api/v2/brandcategories/1/token?grantType=visitor", false, $context);
	//return array(json_decode($result, true), substr($http_response_header[10], 12));
	setcookie("toky_cookie", substr($http_response_header[10], 12), time() + (86400 * 365), "/");
	$_COOKIE["toky_cookie"] = substr($http_response_header[10], 12);
	setcookie("toky_auth_unused", $result, time() + (86400 * 365), "/");
	$_COOKIE["toky_auth_unused"] = $result;
	setcookie("blocklist", "", time() + (86400 * 365), "/");
	$_COOKIE["blocklist"] = "";
}

?>