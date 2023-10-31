<?php
class Hashfun
{
    private $iv  = '1234567890123456'; #Same as in JAVA
    private $key = '6543210987654321'; #Same as in JAVA  ///AES only supports key sizes of 16, 24 or 32 bytes.

    public function __construct() {
       // echo "constr";
    }
    
    public function varify_user($userStr,$hash){
        try{
            if (password_verify($userStr, $hash)) {
                 return true;
                }
            else {
                return false;
                }
        }catch(Exception $exc){
                $this->tempVar = $exc->getMessage();
                return false;
        }
    }
    
    public function make_hash($userStr){
        try{
            /** 
             * Used and tested on PHP 7.2x, Salt has been removed manually, it is now added by PHP 
             */
             return password_hash($userStr, PASSWORD_BCRYPT);
        }catch(Exception $exc){
                $this->tempVar = $exc->getMessage();
                return false;
        }
    }

}

?>