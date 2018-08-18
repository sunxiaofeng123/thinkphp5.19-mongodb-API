<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/12
 * Time: 16:56
 */

namespace app\index\model;
use think\Model;


class MongoBase extends Model
{
    public $connection = [
        // 数据库类型
        'type'           => '\think\mongo\Connection',
        // 设置查询类
        'query'			 => '\think\mongo\Query',
        // 服务器地址
        'hostname'       => '172.17.0.2',
        // 集合名
        'database'       => 'demo',
        // 用户名
        'username'       => '',
        // 密码
        'password'       => '',
        // 端口
        'hostport'       => '27017',
        // 是否_id转换为id
        'pk_convert_id'   => true,
        //因为查出的数据在转换模型对象时，会被过滤掉，所以出此下册，兼容一下不影响mysql模型的使用，返回的数据就是数组类型，不是能使用toArray()。
        'is_mongo_model'  => true,
    ];

    public function __construct($database = '', $data = [])
    {
        //动态设置mongo数据库
        if (!empty($database)) {
            $this->connection['database'] = $database;
        }

        parent::__construct($data);
    }

}