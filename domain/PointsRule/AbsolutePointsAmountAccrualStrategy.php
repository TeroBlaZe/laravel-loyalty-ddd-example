<?php

declare(strict_types=1);

namespace Domain\PointsRule;

use Domain\Transaction\PointsAmount;

class AbsolutePointsAmountAccrualStrategy implements AccrualStrategy
{
    public function __construct(private float $points)
    {
    }

    public function calculate(): PointsAmount
    {
        return new PointsAmount($this->points);
    }
}
