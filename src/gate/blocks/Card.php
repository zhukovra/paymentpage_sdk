<?php

namespace ecommpay\gate\blocks;

class Card extends BaseBlock
{
    public $pan;

    public $year;

    public $month;

    public $card_holder;

    public $cvv;

    public $save;

    public $stored_card_type;

    /**
     * Returns array of validation rules
     *
     * @return array
     */
    protected function rules(): array
    {
        return [];
    }
}
