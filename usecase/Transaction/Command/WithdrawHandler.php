<?php

declare(strict_types=1);

namespace UseCase\Transaction\Command;

use UseCase\Account\AccountReader;
use UseCase\Common\TransactionManager;
use UseCase\Transaction\TransactionWriter;

final class WithdrawHandler
{
    public function __construct(
        private AccountReader $accountReader,
        private TransactionWriter $transactionWriter,
        private TransactionManager $transactionManager,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function handle(WithdrawCommand $command): void
    {
        $this->transactionManager->startTransaction();
        try {
            $account = $this->accountReader->getByType($command->accountType, $command->accountIdentity);
            $currentBalance = $this->accountReader->getBalance($account->getId());

            $transaction = $account->withdraw($currentBalance, $command->pointsAmount, $command->description);

            $this->transactionWriter->add($transaction);
            $this->transactionManager->commit();
        } catch (\Exception $e) {
            $this->transactionManager->rollback();
            throw $e;
        }
    }
}
