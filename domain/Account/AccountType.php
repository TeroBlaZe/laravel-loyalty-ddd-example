<?php

declare(strict_types=1);

namespace Domain\Account;

use InvalidArgumentException;

class AccountType
{
    public const PHONE = 'phone';
    public const CARD = 'card';
    public const EMAIL = 'email';

    private function __construct(private string $name)
    {
    }

    public static function phone(): self
    {
        return self::from(self::PHONE);
    }

    public static function from(string $type): self
    {
        if (!in_array($type, self::getAllTypes(), true)) {
            throw new InvalidArgumentException('Invalid account type: '.$type);
        }

        return new self($type);
    }

    public static function getAllTypes(): array
    {
        return [
            self::PHONE,
            self::CARD,
            self::EMAIL,
        ];
    }

    public static function card(): self
    {
        return self::from(self::CARD);
    }

    public static function email(): self
    {
        return self::from(self::EMAIL);
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
