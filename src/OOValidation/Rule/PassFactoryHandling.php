<?php
declare(strict_types=1);


namespace OOValidation\Rule;


use OOValidation\Factory\CanHaveFactory;
use OOValidation\Result\Pass;

trait PassFactoryHandling
{
    use CanHaveFactory;

    protected function createPass($value): Pass
    {
        if (isset($this->factory)) {
            return new Pass($this->factory->create($value));
        }
        return new Pass($value);
    }
}