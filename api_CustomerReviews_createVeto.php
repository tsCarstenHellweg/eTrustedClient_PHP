<html>
    <head><title>API_CUSTOMERREVIEWS_CREATEVETO</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';      
    TS_CurlWrapper::$DEBUG = true;
        
    $channelId = 'chl-3cd85eba-c280-441e-b90a-5760b8b80410';
    $commentId = 'rev-7b37f77f-c816-439a-8418-d34e9c006055';
    $url = 'https://api.etrusted.com/channels/' . $channelId . '/customer-reviews/' . $commentId . '/vetos';
    
    $payload = array();    
    $payload[ 'comment' ] = 'this is a comment';
    $payload[ 'reason' ] = 'VIOLATES_THE_TERMS_OF_USE'; //options: UNTRUTHFUL, ABUSIVE, VIOLATES_THE_TERMS_OF_USE
    $payload[ 'channelName' ] = 'Name';
    
    $wrapper = new MyTSCurlWrapper();    
    $result = $wrapper->post( $url, $payload );     
        
 

