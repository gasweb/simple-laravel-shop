<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_translates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id');
            $table->string('locale_iso');
            $table->string('title');
            $table->text('preview_content')->nullable();
            $table->text('content')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_key_words')->nullable();
            $table->text('seo_descritpion')->nullable();
            $table->unique(['article_id','locale_iso']);
            $table->foreign('article_id')->references('id')->on('content_articles')->onDelete('cascade');
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
        Schema::dropIfExists('article_translates');
    }
}
