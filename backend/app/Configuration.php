<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Configuration
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->name  = in_array('name', $attributes) ? $attributes['name'] : '';
        $this->value = in_array('value', $attributes) ? $attributes['value'] : '';;
    }

}
