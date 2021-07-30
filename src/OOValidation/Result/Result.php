<?php
declare(strict_types=1);

namespace OOValidation\Result;

interface Result
{
    public function value();

    public function success(): bool;

    public function errors(): array;
}