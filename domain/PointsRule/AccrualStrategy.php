<?php

declare(strict_types=1);

namespace Domain\PointsRule;

use Domain\Transaction\PointsAmount;

interface AccrualStrategy
{
    public function calculate(): PointsAmount;
}
