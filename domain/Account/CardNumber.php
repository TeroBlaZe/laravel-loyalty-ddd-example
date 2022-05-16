<?php

declare(strict_types=1);

namespace Domain\Account;

use Webmozart\Assert\Assert;

class CardNumber
{
    public function __construct(private string $value)
    {
        Assert::notEmpty($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
