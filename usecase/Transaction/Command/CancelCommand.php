<?php

declare(strict_types=1);

namespace UseCase\Transaction\Command;

use Domain\Transaction\TransactionId;

final class CancelCommand
{
    public function __construct(
        public TransactionId $transactionId,
        public string $reason,
    ) {
    }
}
