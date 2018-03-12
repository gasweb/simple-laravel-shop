<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Lang;

/**
 * Class Brand
 * @package App
 * @property string title
 * @property string alias
 * @property integer id
 * @property integer cover_image_id
 * @property \App\Image image
 * @property \App\Product product
 */
class Brand extends Model
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
        $brands_list = self::all()->pluck('title', 'id');
        $brands_list->prepend(Lang::get('brand.admin_brand_select_empty_option'), '');
        return $brands_list;
    }
}
