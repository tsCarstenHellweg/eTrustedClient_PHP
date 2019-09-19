<html>
    <head><title>API_CUSTOMERREVIEWS_GET</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    if( is_file( __DIR__ . '/../eTrusted_localconfig.php' ) )
    {
        require_once __DIR__ . '/../eTrusted_localconfig.php';
    }
    
    TS_CurlWrapper::$DEBUG = true;
        
    $channelId = 'chl-3cd85eba-c280-441e-b90a-5760b8b80410';
    $url = 'https://api.etrusted.com/channels/' . $channelId . '/customer-reviews';
    $wrapper = new MyTSCurlWrapper();    

    $result = $wrapper->get( $url );     
        
 

