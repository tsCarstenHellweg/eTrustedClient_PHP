<html>
    <head><title>API_QUESTIONAIRE_LINK</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    TS_CurlWrapper::$DEBUG = true;
            
    $url = 'https://api.etrusted.com/questionnaire-links';
    $wrapper = new MyTSCurlWrapper();    

    $payload = array();
    $payload[ 'type' ] = 'sales';
    $payload[ 'system' ] = 'carstenzAPI';
    $payload[ 'systemVersion' ] = '0.1a';
    
    $customer = array();
    $customer[ 'firstName' ] = 'test0r';
    $customer[ 'lastName' ] = 'test';
    $customer[ 'email' ] = 'carsten.hellweg@trustedshops.de';
    $customer[ 'mobile' ] = '+49123456';
    $customer[ 'address' ] = 'testweg 1, 11111 testhausen';
    $payload[ 'customer' ] = $customer;
    
    $channel = array();
    $channel[ 'id' ] = 'chl-3cd85eba-c280-441e-b90a-5760b8b80410';
    $channel[ 'type' ] = 'user_defined';
    $payload[ 'channel' ] = $channel;
    
    $transaction = array();
    $transaction[ 'reference' ] = 'my_order_id1';  
    $transaction[ 'date' ] = '2019-09-16T13:20:27.000Z';
    $payload[ 'transaction' ] = $transaction;
    
    $questionaireTemplate = array();
    $questionaireTemplate[ 'id' ] = 'sales';
    $payload[ 'questionnaireTemplate' ] = $questionaireTemplate;
    
    $result = $wrapper->post( $url, $payload );     
        
 

