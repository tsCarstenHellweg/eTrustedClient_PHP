<?php
require_once __DIR__ . '/TS_CurlWrapper.php';

/**
 * Creates an Instance of the relevant cURL-Wrapper.
 * Use instead of "new ....()".
 * 
 * @param String $language
 * @return TS_CurlWrapper
 */
function getTSCurlWrapper( $language = 'de' )
{
    if( $language == 'de' )
    {
        return new deShop();
    }
    if( $language == 'fr' )
    {
        return new frShop();
    }
    if( $language == 'uk' )
    {
        return new ukShop();
    }
    
    die( 'cannot find shop-config for:' . $language . ':' );
}

/**
 * The Configs for the german-shop.
 */
class deShop extends TS_CurlWrapper
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

/**
 * The Configs for the french-shop.
 */
class frShop extends TS_CurlWrapper
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

class ukShop extends TS_CurlWrapper
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