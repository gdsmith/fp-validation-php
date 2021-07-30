<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use OOValidation\Result\Error;
use OOValidation\Factory\CanSetFactory;
use OOValidation\Result\Result;

class IsString implements Rule, CanSetFactory
{
    use PassFactoryHandling;

    function check(string $key, array $input): Result
    {
        return is_string($input[$key] ?? NULL) ? $this->createPass($input[$key]) : new Error(['Not a string']);
    }
}