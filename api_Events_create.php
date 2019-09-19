<html>
    <head><title>API_EVENTS_CREATE</title></head>
    <body>
<?php
    require_once __DIR__ . '/TS_CurlWrapper.php';   
    if( is_file( __DIR__ . '/../eTrusted_localconfig.php' ) )
    {
        require_once __DIR__ . '/../eTrusted_localconfig.php';
    }
    TS_CurlWrapper::$DEBUG = true;
    

    $wrapper = new MyTSCurlWrapper();

    $url = 'https://api.etrusted.com/events';

    $payload = array();
    
    // *************************************************
    // * REQUIRED PARAMETERS IN ORDER OF documentation *
    // *************************************************
    $payload[ 'type' ] = 'checkout';    

    $customer = array();
    $customer[ 'firstName' ] = 'test0r';
    $customer[ 'lastName' ] = 'test';
    $customer[ 'email' ] = 'carsten.hellweg@trustedshops.de';
    $customer[ 'mobile' ] = '+49123456';
    $customer[ 'address' ] = 'testweg 1, 11111 testhausen';
    $payload[ 'customer' ] = $customer;

    $channel = array();
    $channel[ 'id' ] = 'chl-3cd85eba-c280-441e-b90a-5760b8b80410';
    $channel[ 'type' ] = 'etrusted';
    $payload[ 'channel' ] = $channel;
    
    $transaction = array();
    $transaction[ 'reference' ] = 'test_of_api_w_eberhard';    
    $date = new DateTime();    
    $transaction[ 'date' ] = '' . $date->format( 'Y-m-d' ) . 'T' . $date->format( 'H:i:s' ) . '.000Z';
    $payload[ 'transaction' ] = $transaction;

    $payload[ 'system' ] = 'carstenzAPI';
    $payload[ 'systemVersion' ] = '0.1a';
    
    
    // *************************************************
    // * OPTIONAL PARAMETERS IN ORDER OF documentation *
    // *************************************************
    
    /* << delete the whole line, if you want to use this 
    $payload[ 'defaultLocale' ] = 'de_DE';
    // */
    
    /* << delete the whole line, if you want to use this  
    $products = array();
    
    $product = array();
    $product[ 'gtin' ] = '0801213017898';
    $product[ 'imageUrl' ] = 'https://upload.wikimedia.org/wikipedia/en/thumb/8/84/MarvinGayeWhat%27sGoingOnalbumcover.jpg/220px-MarvinGayeWhat%27sGoingOnalbumcover.jpg';
    $product[ 'name' ] = 'Marvin Gaye-Whats going on';
    $product[ 'mpn' ] = 'MarvinGaye-WhatsGoingOn';
    $product[ 'sku' ] = 'MarvinGaye-WhatsGoingOn';
    $product[ 'brand' ] = 'Motown USA';
    $product[ 'url' ] = 'https://en.wikipedia.org/wiki/What%27s_Going_On_(Marvin_Gaye_album)';    
    $parentProduct = array();
    $parentProduct[ 'name' ] = 'Marvin Gaye-Compilation';
    $parentProduct[ 'sku' ] = 'MarvinGaye-AllOfIt';
    $product[ 'parentProduct' ] = $parentProduct;    
    $categories = array();
    $categories[] = 'soul';
    $categories[] = 'rnb';
    $categories[] = 'besteller';
    $categories[] = 'extra bargain';
    $product[ 'categories' ] = $categories;
    $products[] = $product;
    
    $payload[ 'products' ] = $products;
    // */
               
    $result = $wrapper->post( $url, $payload );        
 
    