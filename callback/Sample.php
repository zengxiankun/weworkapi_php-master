<?php
error_reporting(E_ALL);
include_once "WXBizMsgCrypt.php";

// 假设企业号在公众平台上设置的参数如下
$encodingAesKey = "WH7ldgJz6wdyrWf76iH8zejkroGJiKGMQ5ucWd1Crzz";
$token = "tjwR4B83N9p";
$sReceiveId = "wwa14bb63518c99a45";

/*
------------使用示例一：验证回调URL---------------
*企业开启回调模式时，企业号会向验证url发送一个get请求 
假设点击验证时，企业收到类似请求：
* GET /cgi-bin/wxpush?msg_signature=5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3&timestamp=1409659589&nonce=263014780&echostr=P9nAzCzyDtyTWESHep1vC5X9xho%2FqYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp%2B4RPcs8TgAE7OaBO%2BFZXvnaqQ%3D%3D 
* HTTP/1.1 Host: qy.weixin.qq.com

接收到该请求时，企业应
1.解析出Get请求的参数，包括消息体签名(msg_signature)，时间戳(timestamp)，随机数字串(nonce)以及公众平台推送过来的随机加密字符串(echostr),
这一步注意作URL解码。
2.验证消息体签名的正确性 
3. 解密出echostr原文，将原文当作Get请求的response，返回给公众平台
第2，3步可以用公众平台提供的库函数VerifyURL来实现。

*/
// $sVerifyMsgSig = $_GET['msg_signature'];
 //$sVerifyTimeStamp = $_GET['timestamp'];
 //$sVerifyNonce = $_GET['nonce'];
 //$sVerifyEchoStr= urldecode($_GET['echostr']);
// $sVerifyMsgSig = "5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3";
// $sVerifyTimeStamp = "1409659589";
// $sVerifyNonce = "263014780";
// $sVerifyEchoStr = "P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ==";

// 需要返回的明文
//$sEchoStr = "";

$wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $sReceiveId);
//$errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
 //if ($errCode == 0) {
// 	//print("done VerifyURL, sEchoStr : \n");
  //echo $sEchoStr;
  //file_put_contents('log00.txt',$sEchoStr);exit;
// 	//
// 	// 验证URL成功，将sEchoStr返回
// 	// HttpUtils.SetResponce($sEchoStr);
 //} else {
 //	print("ERR: " . $errCode . "\n\n");
// }
//exit;
// print("===============================\n");
// ;

/*
------------使用示例二：对用户回复的消息解密---------------
用户回复消息或者点击事件响应时，企业会收到回调消息，此消息是经过公众平台加密之后的密文以post形式发送给企业，密文格式请参考官方文档
假设企业收到公众平台的回调消息如下：
POST /cgi-bin/wxpush?msg_signature=1f3153b7abd0ba99b4ab2e57fac2376110d03a3c&timestamp=1409659813&nonce=1372623149 HTTP/1.1

{
	"ToUserName": "wx5823bf96d3bd56c7",
	"Encrypt": "jYKl5gAKBiSvZ694aryRMNxKJhUJFtNCSDS9TgfV7rDtEe0x6FjiuCWenK3dCDOah+qOJ8yS6RERDoFhe4dYsHpyImaoZwiGjTp1RGXr7GEW5Tn21BdmYId4Pzvoi6ieOKWbrzag5v2TzcF9syQtry2Ujg5hLEgmMP1Y3GPKHLJ8Rg1kpASRriNKeoHWnokLHlpVt3Ai45y2Bfqn+GxT7qz+yODK3f9Ygxhkpkvp6EaIDIzvk77r26t6Q/sTGfzBYPsNYI8t811B9UFyr38gwslPQUHYuOUXalAUnqpiZW0=";
	"AgentID": 218
}

企业收到post请求之后应该
1.解析出url上的参数，包括消息体签名(msg_signature)，时间戳(timestamp)以及随机数字串(nonce)
2.验证消息体签名的正确性。
3.将post请求的数据进行xml解析，并将<Encrypt>标签的内容进行解密，解密出来的明文即是用户回复消息的明文，明文格式请参考官方文档
第2，3步可以用公众平台提供的库函数DecryptMsg来实现。
*/

//$sReqMsgSig = "1f3153b7abd0ba99b4ab2e57fac2376110d03a3c";
//$sReqTimeStamp = "1409659813";
//$sReqNonce = "1372623149";
$sReqMsgSig = $_GET['msg_signature'];
$sReqTimeStamp = $_GET['timestamp'];
$sReqNonce = $_GET['nonce'];
//$sReqData = '<xml><ToUserName><![CDATA[wwa14bb63518c99a45]]></ToUserName><Encrypt><![CDATA[nFnoL7x5zi+1hsJuJSq3Wsossey0KdZPibTtJSXm/Ti0o/kDzDbFxfrJmh9ZiObDrpUQESO/cplTQugSPm56xRgv1fSM2PsgoU2YcKbcHAj/kqpVQZt0eVIV0ZhBKMl7F7goSuGPp17rgUoSY2WKBtnyFxghL3d0SPwLt4klhOX4ke/xU3PV0iMeXOl8PPjCw3n0vhPnrTYH6X4UgvmU7taCtiSv9iy7ZG8de5WOn/ny8aoNnzzZHV4Uge4bgoH4TJDfah5aS0mnOCFNamdMypehEDYGNuVRKcCbLUTxN15yVT5WBnU8CsBCXWbrig/zuBI9liiBX2UoKXhFXBVF6xgV3gt9PvKwjnD0P8roJ2TCcju4HZI8jnRmgCWouq9oMb9GFOSI5/9/NNR30rfYA0Km6/DWeSC6x1X5UN0yGUo35kdJ78epbbWp2vVlFTSI1t2WzR4/oejSsQqWu0V+GABmCLXaWqLAU5JAreNdlLWuNj36zSNFoj0nJeeAOm7uiNcav6b9Mgj3yxwYdoukrd1LgDfB30wfledNjSZKmjI=]]></Encrypt><AgentID><![CDATA[1000002]]></AgentID></xml>';


$sReqData = $GLOBALS['HTTP_RAW_POST_DATA'];

//$sReqData = simplexml_load_string($sReqData,'SimpleXMLElement',LIBXML_NOCDATA | LIBXML_NOBLANKS);

//$sReqData = json_encode($sReqData);
//file_put_contents('log2.txt',gettype($sReqData));
//file_put_contents('log2.txt',$sReqData);exit;
//$sReqData = json_decode(simplexml_load_string($sReqData,'SimpleXMLElement',LIBXML_NOCDATA));
// post请求的密文数据
//$sReqData = '{ "ToUserName": "wx5823bf96d3bd56c7", "Encrypt": "pvXgeha3nZ7UQ2DG3WD3IVsNJR38QVl1+h+wmLQHIAwEG3Jey2aTZtvAWzhEZ9JEKGwIUMBWX3JlUhfo7O7WbvI10vHIsdSNr1nr3LuOwAfnwLJAMQNDxi5tHUl08Op59jxOL73r8+g60KOxMTaFwXzlr9Yxgq5ey5nzNb/2vDjjvDZNXkJVmL/XWnv6PXrVbTpNxphqWRv2BpPYqvwRMkHgdFliatljMVlkkRHS40FOHmtBhj/4RXtIexfDx8opBXwi0L9RTlYNQzGx+FA+74xVHG7Le/pmNDwc2Ri5mbw=", "AgentID": 218 }';
$sMsg = "";  // 解析之后的明文
//file_put_contents('log2.txt', "888998");
$errCode = $wxcpt->DecryptMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sReqData, $sMsg);

file_put_contents('log2.txt', date("Y-m-d H:i:s",time())."\r\n"."sReqData是:".$sReqData."\r\n"."errCode是：".$errCode."\r\n"."msg_signature是：".$sReqMsgSig."\r\n"."timestamp是：".$sReqTimeStamp."\r\n"."sReqNonce是：".$sReqNonce."\r\n"."sMsg是：".$sMsg."\r\n");
//if ($errCode == 0) {
	// 解密成功，sMsg即为xml格式的明文
	//print("done DecryptMsg, sMsg : \n");
  //  echo $sMsg;
//}    
    $postObj = simplexml_load_string($sMsg,'SimpleXMLElement',LIBXML_NOCDATA | LIBXML_NOBLANKS); 
   // file_put_contents('log3.txt', $RX_TYPE."\r\n");
   $sReplyMsg = json_encode($postObj);
   //$sReplyMsg = $postObj;
    $postObj = json_decode(json_encode($postObj));
    $RX_TYPE = trim($postObj->MsgType);
    $RX_UserName = trim($postObj->FromUserName);
    $RX_ReceiveName = trim($postObj->ToUserName);
    $RX_CreateTime = trim($postObj->CreateTime);
    $RX_Event = trim($postObj->Event);
   // $MsgType = trim($postObj->MsgType);
    $RX_Content = trim($postObj->Content);
    file_put_contents('log3.txt', "消息类型是：".$RX_TYPE."\r\n"."消息发送者是：".$RX_UserName."\r\n"."消息发送时间是:".$RX_CreateTime."\r\n"."Event是：".$RX_Event."\r\n"."content内容是：".$RX_Content."\r\n");
$sEncryptMsg = ""; //xml格式的密文  1592387630
 $msg_tpl="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
 //$msg_tpl='<xml><ToUserName>%s</ToUserName><FromUserName>%s</FromUserName><CreateTime>%s</CreateTime><MsgType>text</MsgType><Content>你好，我是曾贤坤我2</Content><MsgId>308116262</MsgId><AgentID>1000002</AgentID></xml>';
//$msg_tpl='<xml> <ToUserName>< ![CDATA[%s] ]></ToUserName> <FromUserName>< ![CDATA[%s] ]></FromUserName><CreateTime>%s</CreateTime> <MsgType>< ![CDATA[text] ]></MsgType> <Content>< ![CDATA[你好，我是曾贤坤我2] ]></Content><MsgId>308116262</MsgId><AgentID>1000002</AgentID></xml>';
$msgContent='我来也！';
$sReplyMsg2 = sprintf($msg_tpl,$RX_UserName,$RX_ReceiveName,time(),$RX_TYPE,$msgContent);
//$sReplyMsg2 = simplexml_load_string($sReplyMsg2,'SimpleXMLElement',LIBXML_NOCDATA | LIBXML_NOBLANKS);
//$sReplyMsg2 = json_encode($sReplyMsg2);
//$sReplyMsg2 = '{ "ToUserName": "ZengXianKun", "FromUserName":"wwa14bb63518c99a45", "CreateTime": 1348831860, "MsgType": "text", "Content": "this is a test", "MsgId": 1234567890123456, "AgentID": "1000002"}';
//$sReqTimeStamp = "1409659813";
//$sReqNonce = "1372623149";
//echo $sReplyMsg2;
$errCode2 = $wxcpt->EncryptMsg($sReplyMsg2,$sReqTimeStamp,$sReqNonce,$sEncryptMsg);
if($errCode2 == 0){
file_put_contents('log4.txt',date("Y-m-d H:i:s",time())."\r\n"."errCode2是：".$errCode2."\r\n"."sReqTimeStamp是：".$sReqTimeStamp."\r\n"."sReqNonce是：".$sReqNonce."\r\n"."sReplyMsg2是：".$sReplyMsg2."\r\n"."sEncryptMsg是：".$sEncryptMsg."\r\n");exit;
//HttpUtils.SetResponce($sEncryptMsg);
echo $sEncryptMsg;
//print('<Encrypt>PkaynngbVbcKooWTlx9EWoEIkmuwlURvDnGaZG7LTPss8kk1FNgUzkn8/E2P66mZmIFhDmUQvW6f9wqR75AEsl1sqTojiEXMzgNufU/FSR4yVYmyr9pwWoQABhcKfT6hkMESdu6dMWcGDgUOGq5e2ssgsa1Gf+V1YqS479m083qzXBDeDmJGWsddCLBdYU6L+QxWu6dWx33W937l8PX0d7DBk19rlkl1Jf+dkviBvSCUOkwQK5guoBFpD8YwBw46MJa1tTzvMsFuZLXgUF9La4T0LXtJ7mHXBMB+lpxV+Ss6xPw1m05IrZafa3+Vp0xwq9B4Lj23ZDcvvaZG0piezmU+7g5rOq5WZecbz3X4Xz3Jz3G4fhwSE9z8hixmA6VBv2IKETruT6pj8ZjNjUIdRauAVqvDVS6muvw+x9q07tRY4fzzmnNnRysMq5aBHwAYTkaas1ywwMjA/98b0IWVRQ==</Encrypt><MsgSignature>7654c58226569697de3ac4b4c4efcc30f30f0934</MsgSignature><TimeStamp>1592903605</TimeStamp><Nonce>1592824983</Nonce>');
	// TODO: 对明文的处理
 }else {
	print("ERR: " . $errCode . "\n\n");
	//exit(-1);
}




//print("===============================\n");
//exit;
/*
------------使用示例三：企业回复用户消息的加密---------------
企业被动回复用户的消息也需要进行加密，并且拼接成密文格式的xml串。
假设企业需要回复用户的明文如下：

{ 
	"ToUserName": "mycreate",
	"FromUserName":"wx5823bf96d3bd56c7",
	"CreateTime": 1348831860,
	"MsgType": "text",
	"Content": "this is a test",
	"MsgId": 1234567890123456,
	"AgentID": 128,
}

为了将此段明文回复给用户，企业应：
1.自己生成时间时间戳(timestamp),随机数字串(nonce)以便生成消息体签名，也可以直接用从公众平台的post url上解析出的对应值。
2.将明文加密得到密文。
3.用密文，步骤1生成的timestamp,nonce和企业在公众平台设定的token生成消息体签名。
4.将密文，消息体签名，时间戳，随机数字串拼接成xml格式的字符串，发送给企业号。
以上2，3，4步可以用公众平台提供的库函数EncryptMsg来实现。
*/

// 需要发送的明文
// $sRespData = '{ "ToUserName": "mycreate", "FromUserName":"wx5823bf96d3bd56c7", "CreateTime": 1348831860, "MsgType": "text", "Content": "this is a test", "MsgId": 1234567890123456, "AgentID": 128, }';
// $sEncryptMsg = ""; //xml格式的密文
// $errCode = $wxcpt->EncryptMsg($sRespData, $sReqTimeStamp, $sReqNonce, $sEncryptMsg);
// if ($errCode == 0) {
// 	print("done EncryptMsg, sEncryptMsg : \n");
//     var_dump($sEncryptMsg);
// 	// TODO:
// 	// 加密成功，企业需要将加密之后的sEncryptMsg返回
// 	// HttpUtils.SetResponce($sEncryptMsg);  //回复加密之后的密文
// 	print("done \n");
// } else {
// 	print("ERR: " . $errCode . "\n\n");
// 	// exit(-1);
// }

// print("===============================\n");
