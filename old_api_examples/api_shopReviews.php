<?php
/*
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
$loginData = base64_encode( $config[ 'username' ] . ':' . $config[ 'password' ] );

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => 'https://api.trustedshops.com/rest/restricted/v2/shops/'. $config[ 'tsID' ] .'/reviews.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
          'authorization: Basic ' . $loginData
        , 'cache-control: no-cache'
        , 'content-type: application/json'
     ),
));

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
