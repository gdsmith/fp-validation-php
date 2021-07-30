<?php
declare(strict_types=1);


namespace OOValidation\Factory;


interface CanSetFactory
{
    public function setFactory(Factory $factory): self;
}