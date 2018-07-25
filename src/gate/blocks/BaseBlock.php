<?php

namespace ecommpay\gate\blocks;

use ecommpay\gate\ExportableTrait;
use ecommpay\gate\ValidatableTrait;

abstract class BaseBlock
{
    use ValidatableTrait;
    use ExportableTrait;

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
}
