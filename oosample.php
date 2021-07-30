<?php

declare(strict_types=1);

use Domain\Address;
use Domain\City;
use Domain\Contact;
use Domain\FirstName;
use Domain\LastName;
use Domain\Street;
use Domain\Street2;
use OOValidation\Factory\ClassFactory;
use OOValidation\Rule\IsBooleanish;
use OOValidation\Rule\IsString;
use OOValidation\Rule\NonEmptyString;
use OOValidation\Rule\Optional;
use OOValidation\Rule\PassesValidation;
use OOValidation\Rule\ValidEmail;
use OOValidation\Rule\ValidPhoneNumber;
use OOValidation\Rule\ValidZipCode;
use OOValidation\Validation;

require_once __DIR__ . '/vendor/autoload.php';

$data = [
    'street' => 'Main Street 1',
    'street2' => '',
    'city' => 'Mega City',
    'zipCode' => '12455',
    'firstName' => 'Bob',
    'lastName' => 'Smith',
    'email' => 'valid@email.com',
    'phoneNumber' => '4242587630',
    'bool' => 'FAlSe',
];

$addressValidation = new Validation($data);
$addressValidation
    ->setRule('street', (new NonEmptyString)->setFactory(new ClassFactory(Street::class)))
    ->setRule('street2', new Optional((new IsString)->setFactory(new ClassFactory(Street2::class))))
    ->setRule('city', (new NonEmptyString)->setFactory(new ClassFactory(City::class)))
    ->setRule('zipCode', new ValidZipCode)
    ->setRule('bool', new IsBooleanish)
    ->setFactory(new ClassFactory(Address::class, true));

$contactValidation = new Validation($data);
$contactValidation
    ->setRule('firstName', (new NonEmptyString)->setFactory(new ClassFactory(FirstName::class)))
    ->setRule('lastName', (new NonEmptyString)->setFactory(new ClassFactory(LastName::class)))
    ->setRule('email', new ValidEmail)
    ->setRule('phoneNumber', new ValidPhoneNumber)
    ->setRule('address', new PassesValidation($addressValidation))
    ->setFactory(new ClassFactory(Contact::class, true));


if ($contactValidation->check()) {
    var_dump($contactValidation->output());
    echo 'All good';
} else {
    var_dump($contactValidation->errors());
    echo 'Some error';
}
