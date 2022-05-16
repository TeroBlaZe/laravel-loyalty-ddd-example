<?php

declare(strict_types=1);

namespace Domain\Transaction;

use DateTimeInterface;
use Webmozart\Assert\Assert;

final class Payment
{
    public function __construct(
        private string $id,
        private float $amount,
        private DateTimeInterface $dateTime
    ) {
        Assert::notEmpty($id);
        Assert::greaterThanEq($amount, 0);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }
}
