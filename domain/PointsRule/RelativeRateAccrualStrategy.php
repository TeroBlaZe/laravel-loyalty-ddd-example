<?php

declare(strict_types=1);

namespace Domain\PointsRule;

use Domain\Transaction\PointsAmount;

class RelativeRateAccrualStrategy implements AccrualStrategy
{
    public function __construct(
        private float $paymentAmount,
        private float $multiplier,
    ) {
    }

    public function calculate(): PointsAmount
    {
        return new PointsAmount(($this->paymentAmount / 100) * $this->multiplier);
    }
}
