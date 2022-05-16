<?php

declare(strict_types=1);

namespace UseCase\Account\Query;

use Domain\Account\AccountType;

final class GetBalanceQuery
{
    public function __construct(
        private AccountType $type,
        private string $id,
    ) {
    }

    public function getType(): AccountType
    {
        return $this->type;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
