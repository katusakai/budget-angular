<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\moneyTransaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_category_id
 * @property string $amount
 * @property int $deleted
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyTransaction whereUserId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\SubCategory $subCategory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MoneyTransaction whereDeletedAt($value)
 */
class MoneyTransaction extends AbstractModel
{
    protected $table = 'money_transaction';

    protected $casts = [
        'amount' => 'double'
    ];

    /**
     * Returns user of this transaction entry
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns subcategory of this transaction entry
     *
     * @return BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
}
