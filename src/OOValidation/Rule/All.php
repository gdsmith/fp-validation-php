<?php
declare(strict_types=1);


namespace OOValidation\Rule;


use OOValidation\Result\Error;
use OOValidation\Factory\CanSetFactory;
use OOValidation\Result\Result;

class All implements Rule, CanSetFactory
{
    use PassFactoryHandling;
    use HasRules;

    public function check(string $key, array $input): Result
    {
        $errors = [];
        foreach($this->rules as $rule) {
            $result = $rule->check($key, $input);
            if (! $result->success()) {
                $errors = array_merge($errors, $result->errors());
            }
        }
        return empty($errors) ? $this->createPass($input[$key]) : new Error($errors);
    }
}