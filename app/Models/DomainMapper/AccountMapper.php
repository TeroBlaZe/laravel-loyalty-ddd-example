<?php

declare(strict_types=1);

namespace App\Models\DomainMapper;

use App\Models\LoyaltyAccount;
use Domain\Account\Account;
use Domain\Account\AccountId;
use Domain\Account\CardNumber;
use Domain\Account\Email;
use Domain\Account\PhoneNumber;

final class AccountMapper
{
    public function toEntity(LoyaltyAccount $account): Account
    {
        return new Account(
            new PhoneNumber($account->phone),
            new CardNumber($account->card),
            new Email($account->email),
            $account->active,
            $account->phone_notification,
            $account->email_notification,
            new AccountId($account->id),
        );
    }
}
