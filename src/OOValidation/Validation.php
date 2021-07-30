<?php
declare(strict_types=1);


namespace OOValidation;

use OOValidation\Factory\CanSetFactory;
use OOValidation\Factory\CanHaveFactory;
use OOValidation\Rule\All;
use OOValidation\Rule\Rule;

class Validation implements CanSetFactory
{
    use CanHaveFactory;

    /**
     * @var Rule[]
     */
    private array $rules = [];
    private array $output = [];
    private array $errors = [];
    private array $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function setRule(string $key, Rule $rule): self {
        $this->rules[$key] = $rule;
        return $this;
    }

    public function check(): bool
    {
        $this->errors = [];
        $this->output = [];
        foreach ($this->rules as $key => $rules) {
            $result = $rules->check($key, $this->input);
            if ($result->success()) {
                $this->output[$key] = $result->value();
            } else {
                $this->errors[$key] = $result->errors();
            }
        }
        return count($this->errors) === 0;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function output()
    {
        if (isset($this->factory)) {
            return $this->factory->create($this->output);
        }
        return $this->output;
    }

}