<?php
/**
 * 微信接口插件类
 * @author 码农之家
 * @copyright wemall.cn331.com 微信商城系统
 */
namespace plugins\wechat;
class WeChatAPI
{ 
    var $mToken='weixin';//如果修改验证token.那么修改这里
    var $mWcObj;//微信解析后的对象
    var $mAccessToken;//微信Token
    //以下为基本的微信对象成员
    var $mFromUserName;//发送消息者
    var $mToUserName;//本号
    var $mMsgType;//本消息类型
    
    
     
    /**
     * 获取token
     * 获取微信token . 请注意开启php的openssl
     * @access public
     * @param string $appid
     * @param string $appsecret
     * @return string token 
     */
    public function getToken($appid,$appsecret){
        return json_decode(file_get_contents($url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret"))->access_token;   
    }
    /**
     * 微信demo自带的验证函数 ,进行了个性
     */
	public function valid()
    {
        $echoStr = $_GET["echostr"]; 
        if($this->checkSignature()){
        	 return  $echoStr; 
        }
    }
    /**
     *  解析微信的数据结构
     * @return SimpleXMLElement|boolean
     */
    public function parsePostObj(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; 
        if (!empty($postStr)){
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if($postObj){
                $this->mFromUserName=$postObj->FromUserName;
                $this->mToUserName=$postObj->ToUserName;
                return $this->mWcObj=$postObj; 
            }
            else return false ;
        }
    }
    /**
     * 获取要回复的xml数据结构
     * @param unknown $Msg
     * @return string
     */
    public function getResponseTxtMsg($msg)
    { 
        
            $textTpl = "<xml>
							<ToUserName>$this->mFromUserName</ToUserName>
							<FromUserName>$this->mToUserName</FromUserName>
							<CreateTime>".time()."</CreateTime>
							<MsgType>text</MsgType>
							<Content>$msg</Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            
           return $textTpl;
    }
    /**
     * 生成图文消息
     * @param array|string $title
     * @param array|string $description
     * @param array|string $picurl
     * @param array|string $url
     * @return string
     */
    public function getResponseNewsMsg($title,$description,$picurl,$url){
       
        $rsTpl='';
        if(is_array($title)){
            foreach($title as $key =>$val){
                $rsTpl.="<item>
<Title><![CDATA[{$title[$key]}]]></Title> 
<Description><![CDATA[{$description[$key]}]]></Description>
<PicUrl><![CDATA[{$picurl[$key]}]]></PicUrl>
<Url><![CDATA[{$url[$key]}]]></Url>
</item>
";
            }
            $count=count($title);
        }else{
            $rsTpl="<item>
<Title><![CDATA[$title]]></Title> 
<Description><![CDATA[$description]]></Description>
<PicUrl><![CDATA[$picurl]]></PicUrl>
<Url><![CDATA[$url]]></Url>
</item>
";
            $count=1;
        }
        $textTpl="<xml>
<ToUserName><![CDATA[$this->mFromUserName]]></ToUserName>
<FromUserName><![CDATA[$this->mToUserName]]></FromUserName>
<CreateTime>".time()."</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>$count</ArticleCount>
<Articles>
$rsTpl
</Articles>
</xml> ";
        file_put_contents(__FILE__.'.txt', $textTpl);
        return $textTpl;
    }
	/**
	 * 自带校验计算功能
	 * @return boolean
	 */	
	private function checkSignature()
	{
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = $this->mToken;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>