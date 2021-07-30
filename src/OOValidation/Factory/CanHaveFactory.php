<?php
declare(strict_types=1);


namespace OOValidation\Factory;


trait CanHaveFactory
{
    private ?Factory $factory;

    public function setFactory(Factory $factory): self
    {
        $this->factory = $factory;
        return $this;
    }
}