<html>
    <head><title>API_INVITERULES_UPDATE</title></head>
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
       

    $payload = array();
    $payload[ 'name' ] = 'Default checkout rule';
    $payload[ 'templateRef' ] = 'tpl-inv-4ddecd32-fdbf-4562-b15b-e2e2a35fa451';
    $payload[ 'questionnaireTemplateRef' ] = 'tpl-qst-baaec16a-7fd6-4815-b119-9aadea3cf986';
    $payload[ 'sendingDelay' ] = 'P1H';
    $payload[ 'timeOfDay' ] = '10:00:00Z';
    $payload[ 'active' ] = true;        
    
    $wrapper = new MyTSCurlWrapper(); 
    
//    die( "<h1>curl call skipped</h1>" );
    $wrapper->put( $url, $payload );