<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LoyaltyPointsRule
 *
 * @property int $id
 * @property string $points_rule
 * @property string $accrual_type
 * @property float $accrual_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule whereAccrualType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule whereAccrualValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule wherePointsRule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoyaltyPointsRule whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class LoyaltyPointsRule extends Model
{
    public const ACCRUAL_TYPE_RELATIVE_RATE = 'relative_rate';
    public const ACCRUAL_TYPE_ABSOLUTE_POINTS_AMOUNT = 'absolute_points_amount';
    protected $table = 'loyalty_points_rule';
    protected $guarded = ['id'];
}
