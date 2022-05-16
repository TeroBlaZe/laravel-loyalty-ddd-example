<?php

declare(strict_types=1);

namespace UseCase\Account;

use Domain\Account\Account;
use Domain\Account\AccountId;
use Domain\Account\AccountType;
use Domain\Account\CardNumber;
use Domain\Account\Email;
use Domain\Account\PhoneNumber;

interface AccountReader
{
    public function getByEmail(Email $email): Account;

    public function getByPhoneNumber(PhoneNumber $phoneNumber): Account;

    public function getByCardNumber(CardNumber $cardNumber): Account;

    public function getByType(AccountType $type, string $value): Account;

    public function getBalance(AccountId $id): float;

    public function existsByEmail(Email $email): bool;

    public function existsByPhoneNumber(PhoneNumber $phoneNumber): bool;

    public function existsByCardNumber(CardNumber $cardNumber): bool;
}
