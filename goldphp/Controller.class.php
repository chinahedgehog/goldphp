<?php
namespace goldphp;
class Controller{
    public function show($tpl_file=''){
        if(!$tpl_file){
            $tpl_file=WEB_ROOT.'/app/'.MODULE_NAME.'/views/'.CONTROLLER_NAME.'/'.ACTION_NAME.'.html';
        }
        if(is_file($tpl_file)) include($tpl_file);
        //如果不存在
        else Error::error('0','没有找到模板','URL','0');
        
    }
    
}