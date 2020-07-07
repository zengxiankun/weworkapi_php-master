<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File MessageTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */
 
include_once("../src/CorpAPI.class.php");
include_once("../src/ServiceCorpAPI.class.php");
include_once("../src/ServiceProviderAPI.class.php");
// 

$config = require('./config.php');
// 
$agentId = $config['APP_ID'];
$api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);

try { 
    //
    $message = new Message();
    {
        $message->sendToAll = true;
        $message->touser = array("JiaoWoLaoGuan");
        $message->toparty = array(3);
        $message->totag= array(2);
        $message->agentid = $agentId;
        $message->safe = 0;

        $message->messageContent = new NewsMessageContent(
            array(
                new NewsArticle(
                    $title = "Got you !", 
                    $description = "Who's this cute guy testing me ?", 
                    $url = "https://work.weixin.qq.com/wework_admin/ww_mt/agenda", 
                    $picurl = "https://p.qpic.cn/pic_wework/167386225/f9ffc8f0a34f301580daaf05f225723ff571679f07e69f91/0", 
                    $btntxt = "btntxt"
                ),
            )
        );
    }
    $invalidUserIdList = null;
    $invalidPartyIdList = null;
    $invalidTagIdList = null;

    $api->MessageSend($message, $invalidUserIdList, $invalidPartyIdList, $invalidTagIdList);
    var_dump($message);
    echo '<br>';
    echo '<br>';
    var_dump($invalidUserIdList);
    echo '<br>';
    echo '<br>';
    var_dump($invalidPartyIdList);
    echo '<br>';
    echo '<br>';
    var_dump($invalidTagIdList);
    echo '<br>';
    echo '<br>';
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}
