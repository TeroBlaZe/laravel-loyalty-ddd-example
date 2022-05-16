<?php

declare(strict_types=1);

namespace Domain\Transaction;

use DateTimeInterface;
use Domain\Account\AccountId;
use Domain\Common\DomainEntity;
use Domain\PointsRule\PointsRuleId;
use DomainException;

final class Transaction extends DomainEntity
{
    public function __construct(
        private AccountId $accountId,
        private PointsAmount $pointsAmount,
        private string $description,
        private ?PointsRuleId $pointsRuleId = null,
        private ?Payment $payment = null,
        private ?DateTimeInterface $cancelledTime = null,
        private ?string $cancellationReason = null,
        private ?TransactionId $id = null,
    ) {
    }

    public static function createWithdraw(AccountId $accountId, PointsAmount $pointsAmount, string $description): self
    {
        return new self($accountId, $pointsAmount, $description, new PointsRuleId('withdraw'));
    }

    public static function createDeposit(
        AccountId $accountId,
        PointsRuleId $pointsRuleId,
        PointsAmount $pointsAmount,
        Payment $payment,
        string $description
    ): self {
        return new self($accountId, $pointsAmount, $description, $pointsRuleId, $payment);
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function getPointsRuleId(): ?PointsRuleId
    {
        return $this->pointsRuleId;
    }

    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    public function getPointsAmount(): PointsAmount
    {
        return $this->pointsAmount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getId(): ?TransactionId
    {
        return $this->id;
    }

    public function getCancelledTime(): ?DateTimeInterface
    {
        return $this->cancelledTime;
    }

    public function getCancellationReason(): ?string
    {
        return $this->cancellationReason;
    }

    public function cancel(DateTimeInterface $dateTime, string $reason): void
    {
        if ($this->isCancelled()) {
            throw new DomainException('Transaction is already cancelled');
        }
        $this->cancelledTime = $dateTime;
        $this->cancellationReason = $reason;
        //todo: fire event?
    }

    public function isCancelled(): bool
    {
        return $this->cancelledTime !== null;
    }

    public function isWithdraw(): bool
    {
        if ($id = $this->pointsRuleId) {
            return $id->getValue() === 'withdraw';
        }

        return false;
    }
}
