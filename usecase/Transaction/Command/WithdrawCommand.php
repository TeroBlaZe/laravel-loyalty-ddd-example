<?php

declare(strict_types=1);

namespace UseCase\Transaction\Command;

use Domain\Account\AccountType;
use Domain\Transaction\PointsAmount;

final class WithdrawCommand
{
    public function __construct(
        public AccountType $accountType,
        public string $accountIdentity,
        public PointsAmount $pointsAmount,
        public string $description,
    ) {
    }
}
