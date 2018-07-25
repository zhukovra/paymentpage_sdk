<?php

namespace ecommpay\gate\blocks;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;

abstract class BaseBlock
{

    public function __construct(array $values = [])
    {
        foreach ($values as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Returns array of validation rules
     *
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * Returns available block classes
     *
     * @return self[]
     */
    public static function blocks(): array
    {
        $classes = \glob(__DIR__ . '/*.php');

        $classes = \array_map(function ($path) {
            return __NAMESPACE__ . '\\' . basename(substr($path, 0, -4));
        }, $classes);

        $classes = \array_filter($classes, function ($class) {
            return (new \ReflectionClass($class))
                ->isSubclassOf(self::class);
        });

        return $classes;
    }

    /**
     * Returns array of not null properties
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        foreach (get_object_vars($this) as $key => $value) {
            if ($value !== null) {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    /**
     * Return all violations for block
     *
     * @param array $propNames
     * @return ConstraintViolationInterface[]
     */
    public function validate($propNames = []): array
    {
        $validator = Validation::createValidator();
        $violations = [];

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
            $propViolations = $validator->validate($value, $this->rules()[$key] ?? []);
            // check that - only one violation in summary
            $violations = array_merge($violations, (array)$propViolations);
        }

        return $violations;
    }
}
