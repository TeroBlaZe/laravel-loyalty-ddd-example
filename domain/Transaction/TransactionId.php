<?php

declare(strict_types=1);

namespace Domain\Transaction;

class TransactionId
{
    public function __construct(private int $value)
    {
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
