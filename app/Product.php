<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Lang;

/**
 * Class Product
 * @package App
 * @property integer id
 * @property string title
 * @property string alias
 * @property integer parent_id
 * @property integer category_id
 * @property integer brand_id
 * @property boolean enable
 * @property boolean available
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

    /**
     * Method to get collection for form select
     * @return \Illuminate\Support\Collection
     */
    public static function getSelectList()
    {
        $products_list = self::where(['parent_id' => null])->pluck('title', 'id');
        $products_list->prepend(Lang::get('product.admin_product_select_empty_option'), '');
        return $products_list;
    }
}
