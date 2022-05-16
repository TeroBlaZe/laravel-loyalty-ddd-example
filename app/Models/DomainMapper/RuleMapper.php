<?php

declare(strict_types=1);

namespace App\Models\DomainMapper;

use App\Models\LoyaltyPointsRule;
use Domain\PointsRule\PointsRule;
use Domain\PointsRule\PointsRuleId;
use Domain\PointsRule\PointsRuleStrategy;

final class RuleMapper
{
    public function toEntity(LoyaltyPointsRule $model): PointsRule
    {
        return new PointsRule(
            new PointsRuleId((string) $model->id),
            $model->accrual_value,
            PointsRuleStrategy::from($model->accrual_type)
        );
    }
}
