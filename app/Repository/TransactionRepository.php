<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\DomainMapper\TransactionMapper;
use App\Models\LoyaltyPointsTransaction;
use Domain\Transaction\Transaction;
use Domain\Transaction\TransactionId;
use UseCase\Transaction\TransactionReader;
use UseCase\Transaction\TransactionWriter;
use Webmozart\Assert\Assert;

final class TransactionRepository implements TransactionReader, TransactionWriter
{
    public function __construct(private TransactionMapper $mapper)
    {
    }

    public function getById(TransactionId $id): Transaction
    {
        $model = LoyaltyPointsTransaction::find($id);

        Assert::notNull($model, 'No transaction with such id');

        return $this->mapper->toEntity($model);
    }

    public function add(Transaction $transaction): void
    {
        $this->mapper->toModel(new LoyaltyPointsTransaction(), $transaction)->save();
    }

    public function save(Transaction $transaction): void
    {
        $model = $transaction->getId() === null
            ? new LoyaltyPointsTransaction()
            : LoyaltyPointsTransaction::find($transaction->getId()->getValue());

        Assert::notNull($model, 'No transaction with such id');

        $this->mapper->toModel($model, $transaction)->save();
    }
}
