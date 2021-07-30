<?php
declare(strict_types=1);

namespace OOValidation\Result;

use LogicException;

class Error implements Result
{
    private array $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function value()
    {
        throw new LogicException('Value not available for error');
    }
    public function success(): bool
    {
        return false;
    }

    public function errors(): array
    {
        return $this->errors;
    }

}