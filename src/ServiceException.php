<?php

namespace Hlyun;

use Exception;

class ServiceException extends Exception
{
    use Response;

    protected $data; //用来装数据

    /**
     * 构造返回给gateway的api的异常
     *
     * @param string $message
     * @param [type] $data
     * @param integer $code // 对应api返回json的code
     */
    public function __construct($message = '', $code = 600,  $data = null)
    {
        parent::__construct($message, $code);
        $this->data = $data;
    }

    public function render()
    {
        return $this->failJson($this->getMessage(), $this->code, $this->data);
    }
}