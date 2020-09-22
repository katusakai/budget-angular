<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class SubCategory extends Model
{
    public $timestamps = false;
}
