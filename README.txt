Get the demo-code working:

there are 2 ways to achieve this.
1) the "easy" way
- open the file TS_CurlWrapper.php and delete the line
/* <<<delete this, if you want the quick and dirty integration

- fill out the values below( 'xyz' and 'abc' )

2) the harder way, but update-safe
- create a file named "../eTrusted_localconfig.php" (thats outside this dir)

<?php
require_once __DIR__ . '/eTrusted/TS_CurlWrapper.php';
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

- fill out the values and the demo-code will work

3) the harder way, but with multiple IDs/Secrets
- copy the file multipleAccountSolution_example.php to "../eTrusted_localconfig.php" (thats outside this dir)
- fill out the values for the multiple classes
- use the factory function getTSCurlWrapper( $language ) to create new curlWrappers, not new().

