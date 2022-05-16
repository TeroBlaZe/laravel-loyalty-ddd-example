<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\DomainMapper\RuleMapper;
use App\Models\LoyaltyPointsRule;
use Domain\PointsRule\PointsRule;
use UseCase\PointsRule\PointsRuleReader;
use Webmozart\Assert\Assert;

final class RuleRepository implements PointsRuleReader
{
    public function __construct(private RuleMapper $mapper)
    {
    }

    public function getByName(string $ruleName): PointsRule
    {
        $model = LoyaltyPointsRule::where('points_rule', '=', $ruleName)->first();

        Assert::notNull($ruleName, 'No rule with such name');

        return $this->mapper->toEntity($model);
    }
}
