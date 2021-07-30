<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use OOValidation\Result\Error;
use OOValidation\Result\Result;

class NonEmptyString extends IsString
{
    public function check($key, $input): Result
    {
        $parentCheck = parent::check($key, $input);
        if (! $parentCheck->success()) {
            return $parentCheck;
        }
        return !empty($input[$key]) ? $this->createPass($input[$key]) : new Error(['Empty string']);
    }
}