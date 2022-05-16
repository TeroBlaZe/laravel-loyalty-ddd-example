<?php

declare(strict_types=1);

namespace App\Models\DomainMapper;

use App\Models\LoyaltyPointsTransaction;
use Carbon\Carbon;
use Domain\Account\AccountId;
use Domain\PointsRule\PointsRuleId;
use Domain\Transaction\Payment;
use Domain\Transaction\PointsAmount;
use Domain\Transaction\Transaction;
use Domain\Transaction\TransactionId;

final class TransactionMapper
{
    public function toEntity(LoyaltyPointsTransaction $model): Transaction
    {
        $payment = null;
        if ($model->payment_id) {
            $payment = new Payment(
                $model->payment_id,
                $model->payment_amount,
                Carbon::createFromTimestamp($model->payment_time),
            );
        }
        return new Transaction(
            new AccountId($model->account_id),
            new PointsAmount($model->points_amount),
            $model->description,
            new PointsRuleId((string)$model->points_rule),
            $payment,
            $model->canceled === 0 ? null : Carbon::createFromTimestamp($model->canceled),
            $model->cancellation_reason,
            new TransactionId($model->id),
        );
    }

    public function toModel(LoyaltyPointsTransaction $model, Transaction $entity): LoyaltyPointsTransaction
    {
        $model->description = $entity->getDescription();
        $model->account_id = $entity->getAccountId()->getValue();
        $model->points_rule = $entity->getPointsRuleId()?->getValue();
        $model->points_amount = $entity->isWithdraw()
            ? -1 * $entity->getPointsAmount()->getValue()
            : $entity->getPointsAmount()->getValue();
        $model->canceled = $entity->getCancelledTime() ? $entity->getCancelledTime()->getTimestamp() : 0;
        $model->cancellation_reason = $entity->getCancellationReason();
        if ($payment = $entity->getPayment()) {
            $model->payment_id = $payment->getId();
            $model->payment_amount = $payment->getAmount();
            $model->payment_time = $payment->getDateTime()->getTimestamp();
        }

        return $model;
    }
}
