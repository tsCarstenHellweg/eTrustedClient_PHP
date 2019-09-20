<html>
    <head><title>API_INVITERULES_DELETE</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    TS_CurlWrapper::$DEBUG = true;
        
    $ruleId = 'irl-0c3ee9ee-7546-4de3-b9a5-5b466061559b'; 
    $url = "https://api.etrusted.com/invite-rules/" . $ruleId;
    $payload = array();       
    
    $wrapper = new MyTSCurlWrapper(); 
    
    die( "<h1>curl call skipped</h1>" );
    $wrapper->put( $url, $payload );