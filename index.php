<?php
 
/** 
 * GoldPHP[Easy PHP]     Version 3.0.0                                        
 * ---------------------------------------
 * Copyright (c) 2012~2017 http://gold.cn331.com All rights reserved. 
 * ---------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )           
 * ---------------------------------------
 * Author: GoldPHP <GoldPHP@cn331.com>                             
 * ---------------------------------------
 * 统一入口 php5.3++
 */
define('WEB_ROOT',dirname(__FILE__));
include(WEB_ROOT.'/goldphp/core/core.php');//加载常量文件
goldphp\Goldphp::run();

