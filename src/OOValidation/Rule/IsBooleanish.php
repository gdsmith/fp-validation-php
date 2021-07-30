<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use OOValidation\Result\Error;
use OOValidation\Factory\BooleanishFactory;
use OOValidation\Result\Result;

class IsBooleanish implements Rule
{
    private Any $any;
    private BooleanishFactory $factory;

    public function __construct()
    {
        $this->factory = new BooleanishFactory;
        $this->any = (new Any)->addRule(new IsBoolean)
            ->addRule((new MatchesString('true', false))->setFactory($this->factory))
            ->addRule((new MatchesString('false', false))->setFactory($this->factory));
    }


    public function check(string $key, array $input): Result
    {
        $result = $this->any->check($key, $input);
        return $result->success() ? $result : new Error(['Not booleanish']);
    }

}