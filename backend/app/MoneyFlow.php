<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MoneyFlow
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_category_id
 * @property string $amount
 * @property int $deleted
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MoneyFlow whereUserId($value)
 * @mixin \Eloquent
 */
class MoneyFlow extends Model
{
    //
}
