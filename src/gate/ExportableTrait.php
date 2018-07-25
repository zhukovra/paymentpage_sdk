<?php

namespace ecommpay\gate;

trait ExportableTrait
{

    /**
     * Returns array of not null properties
     *
     * @return array
     */
    public function export(): array
    {
        $array = [];

        foreach (get_object_vars($this) as $key => $value) {
            if ($value !== null) {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
