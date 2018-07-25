<?php

namespace ecommpay\gate\requests;

use Symfony\Component\Validator\Constraints\Type;

class Sale extends BaseRequest
{
    public $recurring_register;

    public function getRoute(): string
    {
        return '/v2/payment/card/sale';
    }

    public function rules(): array
    {
        return [
            'recurring_register' => [
                new Type(['type' => 'boolean'])
            ]
        ];
    }
}
