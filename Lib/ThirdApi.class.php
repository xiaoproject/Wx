<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 10:58
 */
class ThirdApi
{
    /**
     * @param $lat 纬度
     * @param $lng 经度
     * @return string
     */
    public static function getApiFromLBS($lat, $lng)
    {
        return trim("http://api.map.baidu.com/geocoder/v2/?location={$lat},{$lng}&output=json&pois=1&ak=uicwoiGqcrvqzCaHGfxOC5fwE4j1KYgp");
    }
}