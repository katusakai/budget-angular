<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $deleted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubCategory whereName($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MoneyFlow[] $moneyFlows
 * @property-read int|null $money_flows_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereDeletedAt($value)
 */
class SubCategory extends AbstractModel
{
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        self::deleted(function ($subCategory) {
            $subCategory->moneyFlows()->delete();
        });
        self::forceDeleted(function ($subCategory) {
            $subCategory->moneyFlows()->forceDelete();
        });
    }

    /**
     * Return transactions of this subcategory
     *
     * @return HasMany
     */
    public function moneyFlows(): HasMany
    {
        return $this->hasMany(MoneyFlow::class);
    }

    /**
     * Return category of this subcategory
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
