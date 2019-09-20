<html>
    <head><title>API_EVENTS_GETTYPE</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    TS_CurlWrapper::$DEBUG = true;
        
    $url = 'https://api.etrusted.com/event-types';    
    $wrapper = new MyTSCurlWrapper();    

    $result = $wrapper->get( $url );     
        
 

