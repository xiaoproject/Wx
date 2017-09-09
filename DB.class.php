<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/9
 * Time: 19:18
 */
class DB
{
    //声明一个静态的对象
    private static $instance = null;
    //声明私有的构造方法
    private function __construct(){
        self::$instance = new PDO("mysql:host=localhost;dbname=mywx;charset=utf8;","root","myXiao!@.123");
    }
    //声明获取实例的静态方法
    public static function getInstance(){
        if( self::$instance ==null ){
            new DB();
        }
        return self::$instance;
    }

}