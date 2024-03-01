<?php

namespace FullSky\Api\Tools;

trait Sign
{

    /**
     * 签名
     * @param string $body
     * @return string
     */
    public function getSign(string $body): string
    {
        // 签名
        $appId = $this->app->appId;
        $appKey = $this->app->appKey;
        // 签名参数
        $timestamp = date("YmdHis",time());
        $nonce = md5(uniqid(microtime(true),true));
        $str = bin2hex(hash('sha256', $body, true));

        $signature = base64_encode(hash_hmac('sha256', "$appId$timestamp$nonce$str", $appKey, true));

        return "OPEN-BODY-SIG AppId=\"$appId\", Timestamp=\"$timestamp\", Nonce=\"$nonce\", Signature=\"$signature\"";
    }
}