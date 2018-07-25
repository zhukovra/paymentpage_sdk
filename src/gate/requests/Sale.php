<?php

namespace ecommpay\gate\requests;

class Sale extends BaseRequest
{

    public function getRoute(): string
    {
        return '/v2/payment/card/sale';
    }
}
