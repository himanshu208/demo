<?php
define('KEY', 'MYKEYVALUE');
function encrypt($ENTEXT)
{

    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, KEY,

        $ENTEXT, MCRYPT_MODE_ECB, mcrypt_create_iv(

        mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB),

                          MCRYPT_RAND))));

}

function decrypt($DETEXT)
{
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, KEY,
       base64_decode($DETEXT), MCRYPT_MODE_ECB,
       mcrypt_create_iv(mcrypt_get_iv_size(
                       MCRYPT_RIJNDAEL_256,
                      MCRYPT_MODE_ECB), MCRYPT_RAND)));
}
?>