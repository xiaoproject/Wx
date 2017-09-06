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
     * 图灵机器人的AK
     */
    const TL_AK = 'c491e42cc2504d5e80d89c8fd2507f22';
    /**
     * 百度的AK
     */
    const BD_AK = 'uicwoiGqcrvqzCaHGfxOC5fwE4j1KYgp';

    const METHOD_POST = 'post';
    const METHOD_GET = 'get';


    /**
     * 百度地理位置获取周边和的当前位置地址
     * @param $lat 纬度
     * @param $lng 经度
     * @return string
     */
    public static function getApiFromLBS($lat, $lng)
    {
        return trim("http://api.map.baidu.com/geocoder/v2/?location={$lat},{$lng}&output=json&pois=1&ak=".self::BD_AK);
    }



    public static function getApiFromTL($info, $method=self::METHOD_POST)
    {
        if ($method == self::METHOD_GET) {
            return trim("http://www.tuling123.com/openapi/api?info={$info}&key=" . self::TL_AK);
        }elseif ($method == self::METHOD_POST){

        }
    }
}