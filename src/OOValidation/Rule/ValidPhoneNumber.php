<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use Domain\PhoneNumber;
use Laminas\I18n\Validator\PhoneNumber as PhoneNumberValidator;
use OOValidation\Result\Error;
use OOValidation\Factory\ClassFactory;
use OOValidation\Result\Result;
use OOValidation\Result\Pass;

class ValidPhoneNumber extends NonEmptyString
{
    private PhoneNumberValidator $validator;

    public function __construct()
    {
        $this->validator = new PhoneNumberValidator();
    }

    public function check($key, $input): Result
    {
        $parentCheck = parent::check($key, $input);
        if (! $parentCheck->success()) {
            return $parentCheck;
        }
        return $this->validator->isValid($parentCheck->value())
            ? new Pass((new ClassFactory(PhoneNumber::class))->create($parentCheck->value()))
            : new Error($this->validator->getMessages());
    }
}