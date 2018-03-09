<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * @package App
 * @property string title
 * @property string alias
 * @property integer id
 */
class Brand extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
