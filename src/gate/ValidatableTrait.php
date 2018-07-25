<?php

namespace ecommpay\gate;

use Symfony\Component\Validator\Validation;

trait ValidatableTrait
{

    /**
     * Return all violations for block
     *
     * @param array $propNames
     * @return array
     */
    public function validate($propNames = []): array
    {
        $validator = Validation::createValidator();
        $result = [];

        $properties = get_object_vars($this);

        if ($propNames) {
            $properties = array_filter(
                $properties,
                function ($key) use ($propNames) {
                    return \in_array($key, $propNames, true);
                },
                ARRAY_FILTER_USE_KEY
            );
        }

        foreach ($properties as $key => $value) {
            $violations = $validator->validate($value, $this->rules()[$key] ?? []);
            foreach ($violations as $v) {
                isset($result[$key]) ? $result[$key][] = $v : $result[$key] = [$v];
            }
        }

        return $result;
    }
}
