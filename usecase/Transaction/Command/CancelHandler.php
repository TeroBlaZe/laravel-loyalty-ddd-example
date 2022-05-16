<?php

declare(strict_types=1);

namespace UseCase\Transaction\Command;

use DateTimeImmutable;
use UseCase\Transaction\TransactionReader;
use UseCase\Transaction\TransactionWriter;

final class CancelHandler
{
    public function __construct(
        private TransactionReader $transactionReader,
        private TransactionWriter $transactionWriter,
    ) {
    }

    public function handle(CancelCommand $command): void
    {
        $transaction = $this->transactionReader->getById($command->transactionId);

        $transaction->cancel(new DateTimeImmutable(), $command->reason);

        $this->transactionWriter->save($transaction);
    }
}
