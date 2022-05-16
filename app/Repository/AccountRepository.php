<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\DomainMapper\AccountMapper;
use App\Models\LoyaltyAccount;
use App\Models\LoyaltyPointsTransaction;
use Domain\Account\Account;
use Domain\Account\AccountId;
use Domain\Account\AccountType;
use Domain\Account\CardNumber;
use Domain\Account\Email;
use Domain\Account\PhoneNumber;
use UseCase\Account\AccountReader;
use UseCase\Account\AccountWriter;
use Webmozart\Assert\Assert;

final class AccountRepository implements AccountReader, AccountWriter
{
    public function __construct(private AccountMapper $mapper)
    {
    }

    public function getByType(AccountType $type, string $value): Account
    {
        return match ($type->getName()) {
            AccountType::PHONE => $this->getByPhoneNumber(new PhoneNumber($value)),
            AccountType::CARD => $this->getByCardNumber(new CardNumber($value)),
            AccountType::EMAIL => $this->getByEmail(new Email($value)),
            default => throw new \DomainException('Unknown account type: '.$type)
        };
    }

    public function getByPhoneNumber(PhoneNumber $phoneNumber): Account
    {
        $account = LoyaltyAccount::byPhoneNumber($phoneNumber->getValue())->first();

        Assert::notNull($account, 'No account with such phone number');

        return $this->mapper->toEntity($account);
    }

    public function getByCardNumber(CardNumber $cardNumber): Account
    {
        $account = LoyaltyAccount::byCardNumber($cardNumber->getValue())->first();

        Assert::notNull($account, 'No account with such card number');

        return $this->mapper->toEntity($account);
    }

    public function getByEmail(Email $email): Account
    {
        $account = LoyaltyAccount::byEmail($email->getValue())->first();

        Assert::notNull($account, 'No account with such email');

        return $this->mapper->toEntity($account);
    }

    public function getBalance(AccountId $id): float
    {
        return LoyaltyPointsTransaction::query()
            ->where('canceled', '=', 0)
            ->where('account_id', '=', $id->getValue())
            ->sum('points_amount');
    }

    public function save(Account $account): void
    {
        $model = LoyaltyAccount::find($account->getId()->getValue());
        $model->phone = $account->getPhoneNumber()->getValue();
        $model->card = $account->getCardNumber()->getValue();
        $model->email = $account->getEmail()->getValue();
        $model->active = $account->isActive();
        $model->email_notification = $account->isEmailNotifiable();
        $model->phone_notification = $account->isPhoneNotifiable();
        $model->save();
    }

    public function existsByEmail(Email $email): bool
    {
        return LoyaltyAccount::byEmail($email->getValue())->exists();
    }

    public function existsByPhoneNumber(PhoneNumber $phoneNumber): bool
    {
        return LoyaltyAccount::byPhoneNumber($phoneNumber->getValue())->exists();
    }

    public function existsByCardNumber(CardNumber $cardNumber): bool
    {
        return LoyaltyAccount::byCardNumber($cardNumber->getValue())->exists();
    }
}
