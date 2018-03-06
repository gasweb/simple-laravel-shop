<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->unsignedInteger('cover_image_id')->nullable();
            $table->foreign('cover_image_id')
                ->references('id')->on('images')
                ->onDelete('set null');
            $table->string('alias');
            $table->string('title');
            $table->string('title_alternative')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
