<?php
// GitHub Webhook Secret.
// Keep it the same with the 'Secret' field on your Webhooks / Manage webhook page of your respostory.
$secret = "webhook";
// 项目根目录, 如: "/var/www/fizzday"
$path = "C:\phpStudy\PHPTutorial\WWW\weworkapi_php-master";
// Headers deliveried from GitHub
//$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
//file_put_contents('hook.txt', $signature);
//if ($signature) {
//$HTTP_RAW_POST_DATA=$GLOBALS['HTTP_RAW_POST_DATA'];
   // $hash = "sha1=" . hash_hmac('sha1', $HTTP_RAW_POST_DATA, $secret);
    //if (strcmp($signature, $hash) == 0) {
        //echo shell_exec("cd {$path} && git reset --hard origin/master && git clean -f && git pull 2>&1");
       echo shell_exec("git pull");
        exit();
   // }
//}
//http_response_code(404);
?>