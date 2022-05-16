<?php

declare(strict_types=1);

namespace UseCase\Transaction;

use Domain\Transaction\Transaction;
use Domain\Transaction\TransactionId;

interface TransactionReader
{
    public function getById(TransactionId $id): Transaction;
}
