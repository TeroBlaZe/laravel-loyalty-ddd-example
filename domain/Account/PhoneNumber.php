<?php

declare(strict_types=1);

namespace Domain\Account;

use Webmozart\Assert\Assert;

class PhoneNumber
{
    public function __construct(private string $value)
    {
        Assert::notEmpty($this->value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
