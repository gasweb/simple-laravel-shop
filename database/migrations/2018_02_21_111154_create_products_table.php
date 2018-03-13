<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            $table->string('alias');
            $table->string('title');
            $table->unsignedDecimal('price')->nullable();
            $table->text('preview_description')->nullable();
            $table->text('description')->nullable();
            $table->text('application')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->onDelete('set null');
            $table->unsignedInteger('category_id')->nullable()->index();
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('set null');
            $table->unsignedInteger('uom_id')->nullable();
            $table->unsignedInteger('cover_image_id')->nullable();
            $table->foreign('cover_image_id')
                ->references('id')->on('images')
                ->onDelete('set null');
            $table->boolean('enable')->nullable();
            $table->boolean('in_stock')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
