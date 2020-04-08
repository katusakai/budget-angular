<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BaseConfiguration
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Configuration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Configuration whereValue($value)
 * @mixin \Eloquent
 */
class Configuration extends Model
{
    public $timestamps = false;
}
