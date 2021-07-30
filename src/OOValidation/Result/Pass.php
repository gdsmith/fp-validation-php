<?php
declare(strict_types=1);

namespace OOValidation\Result;

class Pass implements Result
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }


    public function success(): bool
    {
        return true;
    }

    public function errors(): array
    {
        return [];
    }

}