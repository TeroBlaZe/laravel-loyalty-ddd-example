<?php

declare(strict_types=1);

namespace Domain\PointsRule;

final class PointsRuleId
{
    public function __construct(private string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
