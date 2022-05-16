<?php

declare(strict_types=1);

namespace Domain\Account;

use Domain\Common\DomainEntity;
use Domain\PointsRule\AbsolutePointsAmountAccrualStrategy;
use Domain\PointsRule\PointsRule;
use Domain\PointsRule\PointsRuleStrategy;
use Domain\PointsRule\RelativeRateAccrualStrategy;
use Domain\Transaction\Payment;
use Domain\Transaction\PointsAmount;
use Domain\Transaction\Transaction;
use DomainException;

final class Account extends DomainEntity
{
    public function __construct(
        private PhoneNumber $phoneNumber,
        private CardNumber $cardNumber,
        private Email $email,
        private bool $isActive = true,
        private bool $isPhoneNotifiable = true,
        private bool $isEmailNotifiable = true,
        private ?AccountId $id = null,
    ) {
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function getCardNumber(): CardNumber
    {
        return $this->cardNumber;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function isPhoneNotifiable(): bool
    {
        return $this->isPhoneNotifiable;
    }

    public function isEmailNotifiable(): bool
    {
        return $this->isEmailNotifiable;
    }

    public function activate(): void
    {
        if ($this->isActive) {
            throw new DomainException('Account is already active');
        }
        $this->isActive = true;
        //todo fire event
    }

    public function deactivate(): void
    {
        if (!$this->isActive) {
            throw new DomainException('Account is already inactive');
        }
        $this->isActive = false;
        //todo fire event
    }

    public function withdraw(float $currentBalance, PointsAmount $withdrawAmount, string $description): Transaction
    {
        $this->ensureIsActive();

        if ($currentBalance < $withdrawAmount->getValue()) {
            throw new DomainException('Insufficient funds');
        }

        //todo: fire event

        return Transaction::createWithdraw($this->id, $withdrawAmount, $description);
    }

    public function ensureIsActive(): void
    {
        if (!$this->isActive) {
            throw new DomainException('Account is not active');
        }
    }

    public function deposit(PointsRule $rule, Payment $payment, string $description): Transaction
    {
        $this->ensureIsActive();

        $strategy = match ($rule->getStrategy()->getName()) {
            PointsRuleStrategy::RELATIVE_RATE => new RelativeRateAccrualStrategy(
                $payment->getAmount(),
                $rule->getPointsModifier()
            ),
            PointsRuleStrategy::ABSOLUTE_POINTS_AMOUNT => new AbsolutePointsAmountAccrualStrategy(
                $rule->getPointsModifier()
            ),
            default => new AbsolutePointsAmountAccrualStrategy(0),
        };

        //todo: fire event

        return Transaction::createDeposit($this->id, $rule->getId(), $strategy->calculate(), $payment, $description);
    }

    public function getId(): AccountId
    {
        return $this->id;
    }
}
