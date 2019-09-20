<html>
    <head><title>API_EVENTS_GET</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    TS_CurlWrapper::$DEBUG = true;
    
    $eventId = 'evt-7e72c879-1b7f-4efd-8e20-a4f1549c27fd';
    $url = 'https://api.etrusted.com/events/' . $eventId;
    
    $wrapper = new MyTSCurlWrapper();   
    $result = $wrapper->get( $url );     
        
 

