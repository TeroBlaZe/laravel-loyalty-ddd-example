<?php

declare(strict_types=1);

namespace UseCase\Transaction;

use Domain\Transaction\Transaction;

interface TransactionWriter
{
    public function add(Transaction $transaction): void;

    public function save(Transaction $transaction): void;
}
