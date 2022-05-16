<?php

declare(strict_types=1);

namespace Domain\PointsRule;

use Domain\Common\DomainEntity;

final class PointsRule extends DomainEntity
{
    public function __construct(
        private PointsRuleId $id,
        private float $pointsModifier,
        private PointsRuleStrategy $strategy,
    ) {
    }

    public function getId(): PointsRuleId
    {
        return $this->id;
    }

    public function getPointsModifier(): float
    {
        return $this->pointsModifier;
    }

    public function getStrategy(): PointsRuleStrategy
    {
        return $this->strategy;
    }
}
