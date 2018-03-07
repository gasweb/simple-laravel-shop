<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 * @property integer id
 * @property string title
 * @property string alias
 * @property string title_alternative
 * @property integer cover_image_id
 * @property integer parent_id
 */
class Category extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
