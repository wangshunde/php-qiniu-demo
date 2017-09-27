<?php
require_once __DIR__ . '/../autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

$accessKey = getenv('QyxQmdfygGhEX05rYIeGFHSqeRfXsT-cmoG7OSZ_');
$secretKey = getenv('MXubbUyIV2Jw3U94Yi8W5XAAgHCFt-nlmY28elIP');
$bucket = getenv('test');
$auth = new Auth($accessKey, $secretKey);

// 上传文件到七牛后， 七牛将文件名和文件大小回调给业务服务器.
// 可参考文档: http://developer.qiniu.com/docs/v6/api/reference/security/put-policy.html
$policy = array(
    'callbackUrl' => 'http://oww9roef0.bkt.clouddn.com/qn/php-sdk/examples/upload_verify_callback.php',
    'callbackBody' => 'filename=$(fname)&filesize=$(fsize)'
);
$uptoken = $auth->uploadToken($bucket, null, 3600, $policy);

//上传文件的本地路径
$filePath = './php-logo.png';

$uploadMgr = new UploadManager();

list($ret, $err) = $uploadMgr->putFile($uptoken, null, $filePath);
echo "\n====> putFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
