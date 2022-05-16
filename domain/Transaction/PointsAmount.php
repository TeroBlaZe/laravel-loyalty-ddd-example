<?php

declare(strict_types=1);

namespace Domain\Transaction;

use Webmozart\Assert\Assert;

final class PointsAmount
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = abs($value);
        Assert::greaterThan($this->value, 0, 'Wrong loyalty points amount');
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
