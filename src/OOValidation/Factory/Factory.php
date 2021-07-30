<?php
declare(strict_types=1);


namespace OOValidation\Factory;


interface Factory
{
    public function create($value);
}