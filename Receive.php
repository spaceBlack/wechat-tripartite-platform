<?php


use WeChat\library\Authorization;
use WeChat\WeChatServer;

require __DIR__ . '/vendor/autoload.php';


$componentAppId = 'wx9f42dd7989abd9d9';
$componentAppSecret = 'c6f44578a0d99bd54ffe7b9ecb5b26fa';
//消息校验Token
$token = 'xingfuli';
//消息加解密Key
$encodingAesKey = '1CD37E73D5D74B439A167DE3014FD882521XINGFULI';
$timestamp = $_GET['timestamp'];
$nonce = $_GET['nonce'];
$msg_signature = $_GET['msg_signature'];
$msg = file_get_contents("php://input");
file_put_contents('Receive.txt', $msg . PHP_EOL, FILE_APPEND);
$weChat = new WeChatServer(Authorization::class, ['componentAppId' => $componentAppId, 'componentAppSecret' => $componentAppSecret, 'token' => $token, 'encodingAesKey' => $encodingAesKey]);
$object = $weChat->getInstance();
$ticket = $object->getAuthorizationEvents($msg_signature, $timestamp, $nonce, $msg);
switch ($ticket['type']) {
    case 'component_verify_ticket':
        break;
    //授权
    case 'authorized':
//                return $ticket;
//                break;
        //取消授权更新记录
    case 'unauthorized':
//                return $ticket;
//                break;
        //更新权限集
    case 'updateauthorized':
//                break;
    default:
        return $ticket;
}
echo 'success';
file_put_contents('Receive.txt', json_encode($ticket) . PHP_EOL, FILE_APPEND);
echo 'success';









