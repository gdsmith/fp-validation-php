<?php
declare(strict_types=1);


namespace OOValidation\Rule;


trait HasRules
{
    /** @var Rule[] */
    protected array $rules = [];

    public function addRule(Rule $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }
}