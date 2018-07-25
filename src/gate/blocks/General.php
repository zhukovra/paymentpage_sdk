<?php

namespace ecommpay\gate\blocks;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Url;

class General extends BaseBlock
{
    public $project_id;

    public $payment_id;

    public $signature;

    public $terminal_callback_url;

    /**
     * Returns array of validation rules
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'project_id' => [
                new NotBlank(),
                new Type(['type' => 'integer']),
            ],
            'payment_id' => [
                new NotBlank(),
                new Type(['type' => 'string']),
            ],
            'signature' => [
                new NotBlank(),
                new Type(['type' => 'string']),
            ],
            'terminal_callback_url' => [
                new Url(),
            ]
        ];
    }
}
