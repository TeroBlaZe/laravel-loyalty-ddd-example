<?php

declare(strict_types=1);

namespace UseCase\PointsRule;

use Domain\PointsRule\PointsRule;

interface PointsRuleReader
{
    public function getByName(string $ruleName): PointsRule;
}
