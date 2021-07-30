<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use Domain\ZipCode;
use OOValidation\Factory\ClassFactory;
use OOValidation\Result\Result;
use OOValidation\Result\Pass;

class ValidZipCode extends NonEmptyString
{
    public function check($key, $input): Result
    {
        $parentCheck = parent::check($key, $input);
        if (! $parentCheck->success()) {
            return $parentCheck;
        }
        return new Pass((new ClassFactory(ZipCode::class))->create($parentCheck->value()));
    }
}