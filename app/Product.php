<?php
namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Lang,
    Illuminate\Support\Facades\Config;
use SSD\Currency\Currency;

/**
 * Class Product
 * @package App
 * @property integer id
 * @property float price
 * @property string title
 * @property string alias
 * @property string template_name
 * @property integer parent_id
 * @property integer category_id
 * @property integer brand_id
 * @property boolean enable
 * @property boolean in_stock
 * @property \Illuminate\Database\Eloquent\Collection children
 * @property \App\Product parent
 * @property \App\Image image
 * @property \App\Category category
 * @property \App\Brand brand
 */
class Product extends Model
{
    /**
     * Gets parent product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    /**
     * Gets children collection
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    /**
     * Adds Category one to many relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Adds Brand one to many relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
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

    /**
     * Gets cover image path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getImagePath()
    {
        if ($this->image)
        {
            return url($this->image->src_small);
        }

        return url(Config::get('shop.default_image_path'));
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
     * Price formatted with the currency symbol.
     *
     * @return string
     */
    public function priceDisplay()
    {
        return $this->price;
    }
}
