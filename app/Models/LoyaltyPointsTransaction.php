<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LoyaltyPointsTransaction
 *
 * @property int $id
 * @property int $account_id
 * @property float $points_amount
 * @property float|null $payment_amount
 * @property string|null $payment_id
 * @property int|null $payment_time
 * @property string $description
 * @property int|null $points_rule
 * @property int $canceled
 * @property string|null $cancellation_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereCancellationReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction wherePaymentTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction wherePointsAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction wherePointsRule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class LoyaltyPointsTransaction extends Model
{
    protected $table = 'loyalty_points_transaction';
    protected $guarded = ['id'];
}
