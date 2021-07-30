<?php
declare(strict_types=1);


namespace OOValidation\Factory;


class BooleanishFactory implements Factory
{
    public function create($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }
        return (strtolower($value) === 'true');
    }
}