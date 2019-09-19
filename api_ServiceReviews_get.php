<html>
    <head><title>API_SERVICEREVIEWS_GET</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';               
    if( is_file( __DIR__ . '/../eTrusted_localconfig.php' ) )
    {
        require_once __DIR__ . '/../eTrusted_localconfig.php';
    }  
    TS_CurlWrapper::$DEBUG = true;
        
    $channelId = '';
    $url = 'https://api.etrusted.com/channels/' . $channelId . '/service-reviews/aggregate-rating';
    $wrapper = new MyTSCurlWrapper();    

    $result = $wrapper->get( $url );     
        
 

