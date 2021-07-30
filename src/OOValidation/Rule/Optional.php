<?php
declare(strict_types=1);


namespace OOValidation\Rule;


use OOValidation\Result\Pass;
use OOValidation\Result\Result;

class Optional implements Rule
{
    private Rule $rule;

    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    public function check(string $key, array $input): Result
    {
        if (is_null($input[$key] ?? null)) {
            return new Pass(null);
        }
        return $this->rule->check($key, $input);
    }

}