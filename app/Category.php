<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Lang;

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
        return $this->belongsTo(Image::class, 'cover_image_id');
    }

    /**
     * Method to get collection for form select
     * @return \Illuminate\Support\Collection
     */
    public static function getSelectList()
    {
        $categories_list = self::all()->pluck('title', 'id');
        $categories_list->prepend(Lang::get('category.admin_category_select_empty_option'), '');
        return $categories_list;
    }
}
