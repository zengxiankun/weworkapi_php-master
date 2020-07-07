<?php 
//error_reporting(0);
/*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File UserTest.php
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
// 需启用 "管理工具" -> "通讯录同步", 并使用该处的secret, 才能通过API管理通讯录
//
$api = new CorpAPI($config['CORP_ID'], $config['CONTACT_SYNC_SECRET']);


try { 
    //
    $user = new User();
    {
        $user->userid = "z5kk";
        $user->name = "曾5453";
        $user->mobile = "13417466010";
        $user->email = "u@i5p.cs.cn";
        $user->department = array(1); 

       // $ExtattrList = new ExtattrList();
       // $ExtattrList->attrs = array(new ExtattrItem("s_a_2", "aaa"), new ExtattrItem("s_a_3", "bbb"));
       // $user->extattr = $ExtattrList;
    } 
  //  $api->UserCreate($user);

    //
     $user = $api->UserGet("zhangsan");
     var_dump($user);exit;

    //
    // $user->mobile = "13565449985";
    // $api->UserUpdate($user); 

    //
    $userList = $api->userSimpleList(1, 1);
    var_dump($userList[1]);
exit;
    //
    $userList = $api->UserList(1, 0);
    var_dump($userList);

    //
    $openId = null;
    $api->UserId2OpenId("ZhuShengBen", $openId);
    echo "openid: $openId\n";

    //
    $userId = null;
    $api->openId2UserId($openId, $userId);
    echo "userid: $userId\n";

    //
    $api->UserAuthSuccess("userid");

    //
    $api->UserBatchDelete(array("userid", "aaa"));

    //
    $api->UserDelete("userid"); 
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
    $api->UserDelete("userid"); 
}
