<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use OOValidation\Result\Error;
use OOValidation\Result\Result;
use OOValidation\Result\Pass;

class IsBoolean implements Rule
{
    function check(string $key, array $input): Result
    {
        return is_bool($input[$key] ?? NULL) ? new Pass($input[$key]) : new Error(['Not a boolean']);
    }
}