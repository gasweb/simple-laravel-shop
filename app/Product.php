<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 * @property integer id
 * @property string title
 * @property string alias
 * @property integer parent_id
 */
class Product extends Model
{
    /**
     * Adds Category one to many relationship
     */
    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    /**
     * Adds Brand one to many relationship
     */
    public function brands()
    {
        return $this->hasMany('App\Brand');
    }
}
