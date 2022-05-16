<?php

declare(strict_types=1);

namespace Domain\PointsRule;

use InvalidArgumentException;

final class PointsRuleStrategy
{
    public const RELATIVE_RATE = 'relative_rate';
    public const ABSOLUTE_POINTS_AMOUNT = 'absolute_points_amount';

    private function __construct(private string $name)
    {
    }

    public static function from(string $name): self
    {
        if (!in_array($name, self::getAllTypes(), true)) {
            throw new InvalidArgumentException('Invalid PointsRuleStrategy: '.$name);
        }

        return new self($name);
    }

    public static function getAllTypes(): array
    {
        return [
            self::RELATIVE_RATE,
            self::ABSOLUTE_POINTS_AMOUNT,
        ];
    }

    public static function relativeRate(): self
    {
        return new self(self::RELATIVE_RATE);
    }

    public static function AbsolutePointsAmount(): self
    {
        return new self(self::ABSOLUTE_POINTS_AMOUNT);
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
