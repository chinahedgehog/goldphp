<?php
namespace goldphp;
interface ModelInterface{
     public function where($where = []);//where设置
     public function one($where = []);//取一条
     public function select($field = '*');//查询字段
     public function all($where = []);//取全部
     public function join($table = '*');//联表查
     public function query($sql = '');//执行sql并返回记录
     public function execute($sql = []);//执行一些或一条sql,返回结果 
     public function delete();//删除 操作
     public function update();//更新操作
     public function insenrt();//添加记录
     public function order($order = '');//orderby字符串 e.g. order by id desc
     public function limit($l1 = '0', $l2 = '10');//limit
   
     public function find($where = [] ,$yii2 = false);//兼容yii2(条件为1) 兼容tp 
     public function getone($where = []);//one的别名
     
     public function getall($where = []);//all的别名
       
     public function get($where = []);//one的别名  
       
     public function del();//delete的别名 
     public function add();//insert的别名
     public function create();//add的别名
     
}