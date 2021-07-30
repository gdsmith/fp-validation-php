<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use Domain\Email;
use Laminas\Validator\EmailAddress;
use OOValidation\Result\Error;
use OOValidation\Factory\ClassFactory;
use OOValidation\Result\Result;
use OOValidation\Result\Pass;

class ValidEmail extends NonEmptyString
{
    private EmailAddress $validator;

    public function __construct()
    {
        $this->validator = new EmailAddress();
    }

    public function check($key, $input): Result
    {
        $parentCheck = parent::check($key, $input);
        if (! $parentCheck->success()) {
            return $parentCheck;
        }
        return $this->validator->isValid($parentCheck->value())
            ? new Pass((new ClassFactory(Email::class))->create($parentCheck->value()))
            : new Error($this->validator->getMessages());
    }
}