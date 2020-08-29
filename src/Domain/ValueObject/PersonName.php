<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use JsonSerializable;
use RuntimeException;

class PersonName implements JsonSerializable
{
    private string $personName;

    public function __construct(string $personName)
    {
        $validLength = strlen($personName) === 20;
        if (!$validLength) {
            throw new RuntimeException(
                'Name cannot be longer than 20 characters.'
            );
        }

        $onlyValidChars = ctype_alpha(str_replace(' ', '', $personName)) === TRUE;
        if (!$onlyValidChars) {
            throw new RuntimeException(
                'Name provided is not valid.'
            );
        }

        $this->personName = $personName;
    }

    public function jsonSerialize(): string
    {
        return $this->personName;
    }

    public function __toString()
    {
        return $this->personName;
    }
}
