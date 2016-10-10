<?php


namespace Pongtan\Utils;


class Helper
{
     

    public static function toJsonStr($obj)
    {
        return json_encode($obj);
    }

    public static function getClientIP()
    {
        $ip = "unknown";
        /*
         * 访问时用localhost访问的，读出来的是“::1”是正常情况。
         * ：：1说明开启了ipv6支持,这是ipv6下的本地回环地址的表示。
         * 使用ip地址访问或者关闭ipv6支持都可以不显示这个。
         * */
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $ip = $_SERVER['REMOTE_ADDR'];
                return $ip;
            }
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                return $ip;
            }
            if (isset($_SERVER["HTTP_CLIENT_ip"])) {
                $ip = $_SERVER["HTTP_CLIENT_ip"];
                return $ip;
            }
            if (isset($_SERVER["X-Real-IP"])) {
                $ip = $_SERVER["X-Real-IP"];
                return $ip;
            }
            if(isset($_SERVER["HTTP_X_FORWARD_FOR"])){
                return $_SERVER["HTTP_X_FORWARD_FOR"];
            }
            $ip = $_SERVER["REMOTE_ADDR"];
            return $ip;
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_ip')) {
                $ip = getenv('HTTP_CLIENT_ip');
            } else {
                $ip = getenv('REMOTE_ADDR');
            }
        }
        if (trim($ip) == "::1") {
            $ip = "127.0.0.1";
        }
        return $ip;
    }
}