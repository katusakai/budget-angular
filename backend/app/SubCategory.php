<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $deleted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory whereName($value)
 * @mixin \Eloquent
 */
class SubCategory extends Model
{
    public $timestamps = false;
}
