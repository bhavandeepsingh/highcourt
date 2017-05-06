<?php
namespace common\helpers;

class SmsHelper {
    
    public static $end_point = "http://vnssms.in/quicksms/api/web2sms.php";
    public static $user = "barassociation";
    public static $pass = "bigboss$123";
    public static $from = "BARCHD";
    
    public static function send($to,$msg){
        return CurlHelper::getInstance()->setEndPoint(self::$end_point)->setParam_filter(self::getParam($to,$msg))->send();
    }
    
    public static function getParam($to,$msg){
        return [
            "username"  =>  self::$user, 
            "password"  =>  self::$pass,
            "to"        =>  $to,
            "sender"    =>  self::$from,
            "message"   =>  $msg,
        ];
    }
}

