<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use OOValidation\Result\Error;
use OOValidation\Result\Result;
use OOValidation\Result\Pass;
use OOValidation\Validation;

class PassesValidation implements Rule
{
    private Validation $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

    public function check(string $key, array $input): Result
    {
        if ($this->validation->check()) {
            return new Pass($this->validation->output());
        }
        return new Error($this->validation->errors());
    }

}