<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/02/26
 * Time: 3:13 PM
 */

class Config
{
    public static function get($path = null) {
        if($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            foreach($path as $bit) {
                if(isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }
            return $config;
        }
        return false;
    }
}