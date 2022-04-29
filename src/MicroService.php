<?php

namespace Hlyun;

class MicroService
{
    //封装一些处理微服务交互的一些方法


    /**
     * 聚合层拿微服务返回的数据,取其中的data，抛api异常
     *
     * @param string $json
     * @param int $callerType 0聚合层调用 1微服务之间调用
     * @return void
     */
    public function fetchServiceJsonData(string $json, int $callerType = 0)
    {
        $arr = json_decode($json, true);
        if (!is_array($arr)) {
            if ($callerType === 0) {
                throw new ApiException('微服务返回json字符串非法');
            }
            throw new MicroService('微服务返回json字符串非法');
        }
        if (!isset($arr['data']) || !isset($arr['code'])) {
            if ($callerType === 1) {
                throw new ApiException('微服务返回json字符串格式非法');
            }
            throw new MicroService('微服务返回json字符串格式非法');
        }
        return $arr['data'];
    }

    // /**
    //  * 微服务拿微服务返回的数据，取其中的data,抛Serivice异常
    //  *
    //  * @param string $json
    //  * @return void
    //  */
    // public function fetchWorkmateJsonData(string $json)
    // {
    //     $arr = json_decode($json, true);
    //     if (!is_array($arr)) {
    //         throw new ServiceException('微服务返回json字符串非法');
    //     }
    //     if (!isset($arr['data']) || !isset($arr['code'])) {
    //         throw new ServiceException('微服务返回json字符串格式非法');
    //     }
    //     return $arr['data'];
    // }
}