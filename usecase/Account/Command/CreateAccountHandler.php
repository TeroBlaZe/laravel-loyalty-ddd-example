<?php

declare(strict_types=1);

namespace UseCase\Account\Command;

use Domain\Account\Account;
use DomainException;
use UseCase\Account\AccountReader;
use UseCase\Account\AccountWriter;

final class CreateAccountHandler
{
    public function __construct(
        private AccountReader $accountReader,
        private AccountWriter $accountWriter,
    ) {
    }

    public function handle(CreateAccountCommand $command): void
    {
        if ($this->accountReader->existsByEmail($command->email)) {
            throw new DomainException('This email is in use');
        }
        if ($this->accountReader->existsByPhoneNumber($command->phone)) {
            throw new DomainException('This phone number is in use');
        }
        if ($this->accountReader->existsByCardNumber($command->card)) {
            throw new DomainException('This card number is in use');
        }

        $account = new Account(
            $command->phone,
            $command->card,
            $command->email,
            $command->isActive,
            $command->isPhoneNotifiable,
            $command->isEmailNotifiable,
        );

        $this->accountWriter->save($account);
    }
}
