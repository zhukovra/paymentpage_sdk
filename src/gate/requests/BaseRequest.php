<?php

namespace ecommpay\gate\requests;

use ecommpay\gate\blocks\BaseBlock;

abstract class BaseRequest
{
    /**
     * @var BaseBlock[]
     */
    private $blocks = [];

    abstract public function getRoute(): string;

    public function __construct(array $array = [])
    {
        if (isset($array[0]) && $array[0] instanceof BaseBlock) {
            $this->fromBlocks($array);
        } else {
            $this->fromValues($array);
        }
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }

    private function fromBlocks(array $blocks)
    {
        $this->blocks = $blocks;
    }

    private function fromValues(array $values)
    {
        foreach (BaseBlock::blocks() as $block) {
            $instance = new $block($values);
            if ($instance->toArray()) {
                $this->blocks[] = $instance;
            }
        }
    }
}
