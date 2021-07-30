<?php
declare(strict_types=1);


namespace OOValidation\Rule;


use OOValidation\Result\Result;

interface Rule
{
    public function check(string $key, array $input): Result;
}