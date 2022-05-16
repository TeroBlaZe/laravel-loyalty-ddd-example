<?php

declare(strict_types=1);

namespace UseCase\Transaction\Command;

use UseCase\Account\AccountReader;
use UseCase\Account\Service\AccountEmailSender;
use UseCase\Account\Service\AccountSmsSender;
use UseCase\PointsRule\PointsRuleReader;
use UseCase\Transaction\TransactionWriter;

final class DepositHandler
{
    public function __construct(
        private AccountReader $accountReader,
        private PointsRuleReader $pointsRuleReader,
        private TransactionWriter $transactionWriter,
        private AccountEmailSender $emailSender,
        private AccountSmsSender $smsSender,
    ) {
    }

    public function handle(DepositCommand $command): void
    {
        $account = $this->accountReader->getByType($command->accountType, $command->accountIdentity);
        $rule = $this->pointsRuleReader->getByName($command->pointsRule);
        $currentBalance = $this->accountReader->getBalance($account->getId());

        $transaction = $account->deposit($rule, $command->payment, $command->description);

        $this->transactionWriter->add($transaction);

        if ($account->isEmailNotifiable()) {
            $this->emailSender->sendPointsReceived(
                $account->getEmail(),
                $transaction->getPointsAmount()->getValue(),
                $currentBalance
            );
        }

        if ($account->isPhoneNotifiable()) {
            $this->smsSender->sendPointsReceived(
                $account->getPhoneNumber(),
                $transaction->getPointsAmount()->getValue(),
                $currentBalance
            );
        }
    }
}
