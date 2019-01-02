<?php
namespace App\Helpers;
use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;
class CypherHelper{
    
    public static function loadEncryptionKeyFromConfig(){
        $thesupersupersecret = 'def00000a14fe033211fdf410004e8ed63536711826a5a87446e6c9231a5a31d436b503cddb3657e3efbd506e5eec003bf6c456726d084ec4e23683cf5d35e06ef24ac97';
        $keyAscii = $thesupersupersecret;
        return Key::loadFromAsciiSafeString($keyAscii);
    }

    public static function cypher($the_string){
        $key = CypherHelper::loadEncryptionKeyFromConfig();
        $secret_data = Key::createNewRandomKey();
        $ciphertext = Crypto::encrypt($the_string, $key);
        // $secret_data2 = Crypto::decrypt($ciphertext, $key);
        return $ciphertext;
    }
    public static function decypher($the_string){
        $key = CypherHelper::loadEncryptionKeyFromConfig();
        // $secret_data = Key::createNewRandomKey();
        // $ciphertext = Crypto::encrypt("kibru demeke", $key);
        $secret_data = Crypto::decrypt($the_string, $key);
        return $secret_data;
    }
}
