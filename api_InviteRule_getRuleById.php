<html>
    <head><title>API_INVITERULES_BY_ID</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    if( is_file( __DIR__ . '/../eTrusted_localconfig.php' ) )
    {
        require_once __DIR__ . '/../eTrusted_localconfig.php';
    }  
    TS_CurlWrapper::$DEBUG = true;
        
    $ruleId = 'irl-0c3ee9ee-7546-4de3-b9a5-5b466061559b'; 
    $url = "https://api.etrusted.com/invite-rules/" . $ruleId;
    $wrapper = new MyTSCurlWrapper();    

    $result = $wrapper->get( $url );            