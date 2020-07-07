<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File OauthTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */
 
include_once("../src/CorpAPI.class.php");
include_once("../src/ServiceCorpAPI.class.php");
include_once("../src/ServiceProviderAPI.class.php");

$config = require('./config.php');
// 
$agentId = $config['APP_ID'];
$api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);

$state = md5(uniqid(rand(), TRUE));

 $redirect_url =urlencode("http://wx.dbgoodboy.cn/api/examples/OauthTest.php");
 $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wwa14bb63518c99a45&redirect_uri=".$redirect_url."&response_type=code&agentid=1000002&state=".$state."#wechat_redirect";
 $httputils = new HttpUtils();
$info = $httputils->httpGet($url);
file_put_contents("log.txt", $info);exit;
//var_dump($info);exit;
//$url ="https://open.work.weixin.qq.com/wwopen/sso/qrConnect?appid=wwa14bb63518c99a45&agentid=1000002&redirect_uri=".$redirect_url."&state=".$state;
echo "<a href=".$url.">跳转到企业微信登陆</a>";
$code = $_GET['code'];
//$code = trim(input('get.code'));
if($code){
try {
    $UserInfoByCode = $api->GetUserInfoByCode($code); 
    var_dump($UserInfoByCode);

    $userDetailByUserTicket = $api->GetUserDetailByUserTicket($UserInfoByCode->user_ticket); 
    var_dump($userDetailByUserTicket);

} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}
}