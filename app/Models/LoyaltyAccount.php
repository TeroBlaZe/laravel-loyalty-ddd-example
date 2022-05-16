<?php

namespace App\Models;

use App\Mail\AccountActivated;
use App\Mail\AccountDeactivated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * App\Models\LoyaltyAccount
 *
 * @property int $id
 * @property string $phone
 * @property string $card
 * @property string $email
 * @property bool $email_notification
 * @property bool $phone_notification
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|LoyaltyAccount byCardNumber(string $cardNumber)
 * @method static Builder|LoyaltyAccount byEmail(string $email)
 * @method static Builder|LoyaltyAccount byPhoneNumber(string $phoneNumber)
 * @method static Builder|LoyaltyAccount newModelQuery()
 * @method static Builder|LoyaltyAccount newQuery()
 * @method static Builder|LoyaltyAccount query()
 * @method static Builder|LoyaltyAccount whereActive($value)
 * @method static Builder|LoyaltyAccount whereCard($value)
 * @method static Builder|LoyaltyAccount whereCreatedAt($value)
 * @method static Builder|LoyaltyAccount whereEmail($value)
 * @method static Builder|LoyaltyAccount whereEmailNotification($value)
 * @method static Builder|LoyaltyAccount whereId($value)
 * @method static Builder|LoyaltyAccount wherePhone($value)
 * @method static Builder|LoyaltyAccount wherePhoneNotification($value)
 * @method static Builder|LoyaltyAccount whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class LoyaltyAccount extends Model
{
    protected $table = 'loyalty_account';

    protected $guarded = ['id'];

    protected $attributes = [
        'email_notification' => true,
        'phone_notification' => true,
        'active' => true,
    ];

    protected $casts = [
        'active' => 'bool',
        'email_notification' => 'bool',
        'phone_notification' => 'bool',
    ];

    public function scopeByPhoneNumber(Builder $builder, string $phoneNumber): Builder
    {
        return $builder->where('phone', $phoneNumber);
    }

    public function scopeByCardNumber(Builder $builder, string $cardNumber): Builder
    {
        return $builder->where('card', $cardNumber);
    }

    public function scopeByEmail(Builder $builder, string $email): Builder
    {
        return $builder->where('email', $email);
    }

    public function notify()
    {
        if ($this->email != '' && $this->email_notification) {
            if ($this->active) {
                Mail::to($this)->send(new AccountActivated($this->getBalance()));
            } else {
                Mail::to($this)->send(new AccountDeactivated());
            }
        }

        if ($this->phone != '' && $this->phone_notification) {
            // instead SMS component
            Log::info('Account: phone: ' . $this->phone . ' ' . ($this->active ? 'Activated' : 'Deactivated'));
        }
    }
}
