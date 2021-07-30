<?php
declare(strict_types=1);


namespace OOValidation\Rule;

use OOValidation\Result\Error;
use OOValidation\Result\Result;
use OOValidation\Result\Pass;

class MatchesString extends IsString
{
    private string $toMatch;
    private bool $isCaseSensitive;

    public function __construct(string $toMatch, bool $isCaseSensitive)
    {
        $this->toMatch = $isCaseSensitive ? $toMatch : strtolower($toMatch);
        $this->isCaseSensitive = $isCaseSensitive;
    }


    public function check(string $key, array $input): Result
    {
        $parentCheck = parent::check($key, $input);
        if (! $parentCheck->success()) {
            return $parentCheck;
        }
        $value = $this->isCaseSensitive ? $input[$key] : strtolower($input[$key]);

        return $this->toMatch === $value ? new Pass($parentCheck->value()) : new Error(['Does not match']);
    }
}