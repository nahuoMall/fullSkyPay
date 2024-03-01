<?php
/**
 * Created by PhpStorm.
 * User: stbz
 * Date: 2020/6/17
 * Time: 4:00 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';

use FullSky\Api\FullSky;
use function Hyperf\Support\make;

$mchId = "89844065399AAAR";
$appId = "e1cf0ddcf6b47b59c351565d8ad717af";
$appKey = "e1cf0ddcf6b47b59c351565d8ad717af";

/** @var FullSky $alipayClient */
$client = make(FullSky::class);

## 初始化配置
$client->setMchId($mchId);
$client->setAppId($appId);
$client->setAppKey($appKey);

## 创建支付宝app订单

##  请求参数
$data = [
    'merOrderId' => uniqid(),
    'orderDesc' => '账单描述',        // 订单描述 展示在支付截图中
    'totalAmount' => 100,           // 支付总金额
    'subAppId' => 'wx0bd72821b0ce53cb',
    'tradeType' => 'APP',
    'attachedData' => [],
    'notifyUrl' => 'https://pay-test.nahuomall.com'
];
## 下单接口
$response = $client->ali_app->createOrder($data);

var_dump($response);exit();

## 订单详情
$data = [
    'instMid' => 'APPDEFAULT',  // 业务类型
    'merOrderId' => '',         // 商户订单号
    'targetOrderId' => ''       // 支付订单号
];
$response = $client->search->getInfo($data);


## 订单退款
$data = [
    'instMid' => 'APPDEFAULT',      // 业务类型
    'targetOrderId' => '',          // 支付订单号
    'refundAmount' => 100,           // 退款金额
    'refundOrderId' => '',           // 退款订单号
    'refundDesc' => '',           // 退款说明
];
$response = $client->refund->refund($data);



## 订单退款查询
$data = [
    'instMid' => 'APPDEFAULT',      // 业务类型
    'merOrderId' => '',          // 商户订单号
    'msgId' => uniqid(),           // 消息ID
];
$response = $client->refund_search->getInfo($data);

var_dump($response);exit();
