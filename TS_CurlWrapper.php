<?php

/* <<< delete the whole line for a quick and dirty integration 
class MyTSCurlWrapper extends TS_CurlWrapper
{    
    protected function getCredentials()
    {
        return array(
            // your values below here!
              'client_id' => 'abc'
            , 'client_secret' => 'xyz'            
        );
    }
}
// */
// if you use the option above, pls delete the following lines
if( is_file( __DIR__ . '/../eTrusted_localconfig.php' ) )
{
    require_once __DIR__ . '/../eTrusted_localconfig.php';
}


/**
 * This is the wrapper class for the eTrusted API.
 *
 * @category   Helper/Wrapper
 * @package    eTrustedDemo
 * @author     Product Integration Team <productintegration@trustedshops.com>
 * @license    LGPL
 * @version    0.1       
 */
abstract class TS_CurlWrapper
{
    /**
     * @Override to configure your password.
     * 
     * @return array( 'client_id' => 'abc', 'client_secret' => 'xyz' )
     */
    abstract protected function getCredentials();
    
    /**
     * Set this before new TS_CurlWrapper() to enable output.
     * Note: this class was written with no external dependencies in mind, so
     * there will be no Logger-class in there.
     * 
     * @var bool  
     */
    public static $DEBUG = false;
    
    /**
     * is set in constructor.
     * 
     * @var String
     */
    protected $authToken;
    
    /**
     * Default (empty) Constructor, please add your values to the credentials!
     * 
     */
    public function __construct()
    {
        $credentials = $this->getCredentials();
        $credentials[ 'grant_type' ] = 'client_credentials';
        $credentials[ 'audience' ] = 'https://api.etrusted.com';
                
        $curl = curl_init( 'https://login.etrusted.com/auth/realms/business/protocol/openid-connect/token' );
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'cache-control' => 'no-cache'
          , 'Content-Type' => 'application/x-www-form-urlencoded'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query( $credentials, '', '&' ) );
        
        if( $this->isDebugEnabled() )
        {
            $this->log( '<pre>sending credentials:' . print_r( $credentials, true ) . '</pre>' );
        }        
        
        $responseJson = curl_exec( $curl );
        $curlError = curl_error( $curl );
        curl_close( $curl );    

        if( strlen( $curlError ) > 0 )
        {
            die( "curl error: " . $curlError );
        }
        
        $response = json_decode( $responseJson );
        if( $this->isDebugEnabled() )
        {
            $this->log( '<pre>receiving:' . print_r( $response, true ) . '</pre>' );
        }
                        
        if( isset( $response->access_token ) )
        {
            $this->authToken = 'Bearer ' . $response->access_token;            
        }
        else
        {
            die( 'wrong credentials!' );
        }        
    }
    
    /**
     * Use this, if the API-Doku uses "GET" 
     * 
     * @param String $url
     * @return stdClass curl-response
     */
    public function get( $url )
    {
        $payload = array();
        return $this->doCurlCall($url, $payload, 'GET' );        
    }
    
    /**
     * Use this, if the API-Doku uses "POST"
     * 
     * @param String $url
     * @param array()/JSON-String $payload
     * @return stdClass
     */
    public function post( $url, $payload )
    {
        return $this->doCurlCall($url, $payload, 'POST' );
    }
    
    /**
     * Use this, if the API-Doku uses "PUT"
     * 
     * @param String $url
     * @param array()/JSON-String $payload
     * @return stdClass
     */
    public function put( $url, $payload )
    {
        return $this->doCurlCall($url, $payload, 'PUT' );
    }
    
    /**
     * Use this, if the API-Doku uses "DELETE"
     * 
     * @param String $url
     * @param array()/JSON-String $payload
     * @return stdClass
     */
    public function delete( $url, $payload )
    {
        return $this->doCurlCall($url, $payload, 'DELETE' );
    }
    
    /**
     * Does the actual curl-call.
     * Please use the get/post/put/delete method from outside of this class.
     * 
     * @param String $url
     * @param array()/JSON-String $payload
     * @param String $method GET or POST is currently used
     * @return stdClass
     */
    protected function doCurlCall( $url, $payload, $method )
    {
        if( $this->isDebugEnabled() )
        {
            $this->log( '<pre>doCallVia:' . $method . ': on url: ' . $url . ', payload' . print_r( $payload, true ) . '</pre>' );
        }
        $payloadString = $this->createPayloadString( $payload );
        
        $curl = $this->createCurl();
        curl_setopt( $curl, CURLOPT_URL, $url );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, $method );
        if( strlen( $payloadString ) > 0 )
        {
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $payloadString );
        }
        else
        {
            curl_setopt( $curl, CURLOPT_POSTFIELDS, '' );
        }
        
        $responseString = curl_exec( $curl );        
        $response = json_decode( $responseString );
        if( $this->isDebugEnabled() )
        {
            $this->log( '<pre>receiving:' . print_r( $response, true ) . '</pre>' );
        }
        return $response; 
    }
    
    /**
     * @Override, if you want to use a different Logger-class
     * 
     * @return bool
     */
    protected function isDebugEnabled()
    {
        if( $this::$DEBUG == true )
        {
            return true;
        }
        return false;
    }
    
    /**
     * @Override, if you want to use a different Logger-class
     * 
     * @param String $message
     */
    protected function log( $message )
    {
        echo $message;
    }
    
    /**
     * 
     * @param array $payload can be an array or the json-representation
     * @return type
     */
    protected function createPayloadString( $payload )
    {
        if( is_array( $payload ) )                    
        {
            if( count( $payload ) > 0 )
            {
                return json_encode( $payload );
            }
            return '';
        }        
        return $payload;
    }
    
    /**
     * @Override
     * 
     * Override here, if you want to add further curl-options, eg
     * 
     * class MyProxyCurlWrapper extends TS_CurlWrapper
     * {
     *     protected function createCurl()
     *     {
     *         $curl = parent::createCurl();
     *         curl_setopt($curl, CURLOPT_PROXY .... );        
     *         return $curl;
     *     }
     * }
     * 
     * @return curl curl-object
     */
    protected function createCurl()
    {
        $curl = $curl = curl_init();
        curl_setopt_array( $curl, array
        (
            CURLOPT_RETURNTRANSFER => true
            , CURLOPT_HTTPHEADER => array
                (
                    'Authorization: ' . $this->authToken
                    , 'Content-Type: application/json'
                    , 'cache-control: no-cache'
                )            
            , CURLOPT_ENCODING => ''
            , CURLOPT_MAXREDIRS => 10
            , CURLOPT_TIMEOUT => 30
            , CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
        ) );                
        return $curl;
    }
}