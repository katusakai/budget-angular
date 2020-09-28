<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MoneyFlow
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_category_id
 * @property string $amount
 * @property int $deleted
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoneyFlow whereUserId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\SubCategory $subCategory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MoneyFlow whereDeletedAt($value)
 */
class MoneyFlow extends AbstractModel
{
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
