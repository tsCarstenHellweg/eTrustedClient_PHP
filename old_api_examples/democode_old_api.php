<?php


function getTrustedShopsConfig()
{
    return array( 
          'tsID' => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        , 'username' => ''
        , 'password' => ''
    );
}
// */
// otherwise store local config somewhere else
if( is_file( __DIR__ . '/../../trustedshops_local.php' ) )
{
    require_once __DIR__ . '/../../trustedshops_local.php';
}

$config = getTrustedShopsConfig();
$data = array();
$data[ 'tsId ' ] = $config[ 'tsID' ];

// the order part
$order = array();
$order[ 'orderDate' ]             = '2019-05-18';
$order[ 'orderReference' ]        = 'your_order_number';
$order[ 'currency' ]              = 'EUR';
$order[ 'amount' ]                = 11.11;
$order[ 'paymentType' ]           = 'DIRECT_DEBIT';
$order[ 'estimatedDeliveryDate' ] = '2019-05-20';

// subpart oof the order: products
$products = array();

$product = array();
// mandatory parameters
$product[ 'sku' ]        = '1234567';
$product[ 'name' ]       = 'productName';
$product[ 'productUrl' ] = 'https://www.shop123456.html';
// optional parameters
$product[ 'gtin' ]       = '123456787890'; // must be different to sku!
$product[ 'mpn' ]        = '4667801';
$product[ 'brand' ]      = 'Brand';
$product[ 'imageUrl' ]   = 'https://imageurl12345.jpg';

$products[] = $product;
$order[ 'products' ] = $products;
$data[ 'order' ] = $order;

// consumer part
$consumer = array();
$consumer[ 'firstname' ] = 'test0r';
$consumer[ 'lastname' ]  = 'test';
$contact = array();
$contact[ 'email' ]      = 'test@mail.de';
$contact[ 'language' ]   = 'DE';
$consumer[ 'contact' ]   = $contact;
$data[ 'consumer' ] = $consumer;

$sender = array();
$sender[ 'type' ] = 'ThirdParty';
$data[ 'sender' ] = $sender;

$types = array();
$types[ 'key' ] = 'shop';
// $types[ 'key' ] = 'products';
$data[ 'types' ] = $types;

// debug
echo '<pre>sending data:', print_r( $data, 1 ), '</pre>';
// */

$dataString = json_encode( $data );
$loginData = base64_encode( $config[ 'username' ] . ':' . $config[ 'password' ] );
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => 'https://api.trustedshops.com/rest/restricted/v2/shops/'. $config[ 'tsID' ] .'/reviews/requests',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => "",
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => "POST",
    CURLOPT_HTTPHEADER => array(
          'authorization: Basic ' . $loginData
        , 'cache-control: no-cache'
        , 'content-type: application/json'
     ),
));
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$response = curl_exec($curl);
$err = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

$resultJSON = json_decode( $response );
echo '<pre>Result:', print_r( $resultJSON, 1 ), '</pre>';
if( $err )
{
    echo 'ERROR' . PHP_EOL;
    echo '<pre>ERR :', print_r( $err, 1 ), '</pre>';
    echo '<pre>HTTP:', print_r( $httpCode, 1 ), '</pre>';    
}