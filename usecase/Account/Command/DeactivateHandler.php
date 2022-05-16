<?php

declare(strict_types=1);

namespace UseCase\Account\Command;

use UseCase\Account\AccountReader;
use UseCase\Account\AccountWriter;
use UseCase\Account\Service\AccountEmailSender;
use UseCase\Account\Service\AccountSmsSender;

final class DeactivateHandler
{
    public function __construct(
        private AccountReader $accountReader,
        private AccountWriter $accountWriter,
        private AccountEmailSender $emailSender,
        private AccountSmsSender $smsSender,
    ) {
    }

    public function handle(DeactivateCommand $command): void
    {
        $account = $this->accountReader->getByType($command->type, $command->identity);

        $account->deactivate();

        $this->accountWriter->save($account);

        if ($account->isEmailNotifiable()) {
            $this->emailSender->sendDeactivationMessage($account->getEmail());
        }

        if ($account->isPhoneNotifiable()) {
            $this->smsSender->sendDeactivationMessage($account->getPhoneNumber());
        }
    }
}
