<?php

class Url {
    
    public static function redirect($url){
        if(!is_string($url)){
            return FALSE;
        }
        
        header('Location: '. $url);
        exit;
    }
    
}