<html>
    <head><title>API_INVITES_LIST</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    TS_CurlWrapper::$DEBUG = true;
        
    $channelId = 'chl-3cd85eba-c280-441e-b90a-5760b8b80410';
    $url = 'https://api.etrusted.com/channels/' . $channelId . '/invites';    
    $wrapper = new MyTSCurlWrapper();    

    $result = $wrapper->get( $url );            