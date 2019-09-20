<html>
    <head><title>API_EVENTS_UPDATETYPE</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    TS_CurlWrapper::$DEBUG = true;
        
    $eventId = 'ety-d2ed95b1-7ce1-4055-a385-43b6606ae5c5';
    $url = 'https://api.etrusted.com/event-types/' . $eventId;    
    $wrapper = new MyTSCurlWrapper();    

    $payload = array();
    $payload[ 'active' ] = 'true';
    
    $result = $wrapper->put( $url, $payload );     
        
 

