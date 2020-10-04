<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $deleted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 */
class Category extends AbstractModel
{
    protected $table = 'category';

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        self::deleted(function ($category) {
            $category->subCategories()->delete();
        });
        self::forceDeleted(function ($category) {
            $category->subCategories()->forceDelete();
        });
    }

    /**
     * Return subcategories of this category
     *
     * @return HasMany
     */
    public function subCategories():HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
