<?php
namespace goldphp;
class Model implements ModelInterface{
    private static $mInstance;
    public $mTable; 
    public $mWhere;
    public $mField='*';
    public $mSql; 
    public $mPrefix;
    public $mOrder;
    public $mLimit;
    public $mDriver;
    public function __construct($table, $link = '0'){
       if(!static::$mInstance){
           $config = \goldphp\Config::getConfig('db'); 
            $driver = '\goldphp\drivers\\'.$config['drivers'];
            static::$mInstance =  new $driver($config,$link); 
       }
       $this->mTable=$table; 
       $this->mDriver=static::$mInstance;
       $this->mPrefix=Config::getConfig('db')['prefix'];
    }
    public function order($order = ''){
        $this->mOrder=$order;
        return $this;
    }
    public function limit($l1 = '0', $l2 = '10'){
        $this->mLimit=' '.$l1.','.$l2.' ';
        return $this;
    }
    public function find($where = [] ,$yii2 = false){//兼容yii的部分功能
         if($yii2)return $this;
         else return $this->one($where);
    }
    public function where($condition=[]){//支持数组,字符串
        $this->mWhere = $condition;
        return $this;
    }
    public function one($where = [])
    {
        if($where)$this->where($where);
        $rs = $this->query( $this->makeSql());
        if(!$rs){
          $errinfo=$this->mDriver->mPdo['read']->errorInfo();
          Error::error($errinfo[0], $errinfo[2], '', $errinfo[1]);
          exit;
        }
        return $this->mDriver->one($rs); 
    }
    public function select($field = '*')
    {
        $this->mField=$field;
        return $this;
    }
    public function table($table = ''){
        return $this->mPrefix.$table;
    }
    public function makeCondtion(){
        $return = '';
        if(!$this->mWhere)return ;
        else if(is_array($this->mWhere)){
            $arr = $this->mWhere;
            foreach($arr as $key => $value){
                $return.="   `$key`='$value'  and ";
            }
        }else if (is_string($this->mWhere)){
            $return = $this->mWhere;
        } 
        return $return.' 1 ';
    }
    public function makeSql(){
        $this->mSql='select ' .$this->mField .' from '.$this->table($this->mTable); 
        $this->mSql.=' where '.$this->makeCondtion().$this->mOrder.$this->mLimit; 
        return $this;
    }
    public function all($where = [])
    {
         if($where)$this->where($where);
          $rs = $this->query( $this->makeSql());
          if(!$rs){
              $errinfo=$this->mDriver->mPdo['read']->errorInfo();
              Error::error($errinfo[0], $errinfo[2], '', $errinfo[1]);
              exit;
          }
          return $this->mDriver->all($rs);
    } 
    public function join($table = '*')
    { 
        return $this;
    }  
    public function query($sql = '')
    { 
        return $this->mDriver->query($this->mSql); 
    } 
    public function execute($sql = array())
    {
          
    } 
    public function delete()
    {
        // TODO Auto-generated method stub
        
    } 
    public function update()
    {
        // TODO Auto-generated method stub
        
    } 
    public function insenrt()
    {
        // TODO Auto-generated method stub
        
    } 
    public function getone($where = [])
    {
        return $this->one($where);
    } 
    public function getall($where = [])
    {
        return $this->all($where);
    } 
    public function get($where = [])
    { 
        return $this->one($where);
    } 
    public function del()
    { 
    } 
    public function add()
    { 
    } 
    public function create()
    { 
    }

}