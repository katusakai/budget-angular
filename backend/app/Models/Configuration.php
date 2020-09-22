<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BaseConfiguration
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereValue($value)
 * @mixin \Eloquent
 */
class Configuration extends Model
{
    public $timestamps = false;
}
