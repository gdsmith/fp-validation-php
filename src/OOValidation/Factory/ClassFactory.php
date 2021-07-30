<?php
declare(strict_types=1);


namespace OOValidation\Factory;


use RuntimeException;

class ClassFactory implements Factory
{
    /**
     * @var false
     */
    private bool $inputShouldSpread;
    private string $className;

    public function __construct(string $className, bool $inputShouldSpread = false)
    {
        if (! class_exists($className)) {
            throw new RuntimeException('not a class: '.$className);
        }
        $this->className = $className;
        $this->inputShouldSpread = $inputShouldSpread;
    }

    public function create($value)
    {
        return $this->inputShouldSpread ? new $this->className(...array_values($value)) : new $this->className($value);
    }
}