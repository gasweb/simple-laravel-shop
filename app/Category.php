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
 * @property \App\Product product
 * @property \App\Category parent
 * @property \App\Image image
 * @property \Illuminate\Database\Eloquent\Collection children
 */
class Category extends Model
{
    /**
     * Foreign key connection with product table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Foreign key connection with categories table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Gets collection of children categories
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Foreign key connection with image table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
