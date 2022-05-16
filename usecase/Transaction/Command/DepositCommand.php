<?php

declare(strict_types=1);

namespace UseCase\Transaction\Command;

use Domain\Account\AccountType;
use Domain\Transaction\Payment;

final class DepositCommand
{
    public function __construct(
        public AccountType $accountType,
        public string $accountIdentity,
        public Payment $payment,
        public string $pointsRule,
        public string $description,
    ) {
    }
}
