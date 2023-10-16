<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
$url = "https://";
else
$url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);

//Use the query component of the URL to extract class's ID
parse_str($url_components['query'], $params);
$url_id = $params['id'];

//Set class ID as a session variable
$_SESSION['class_id']=$url_id;
?>


