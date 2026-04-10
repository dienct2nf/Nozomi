<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->string('locale')->index()->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('description', 380)->nullable();
            $table->string('title_seo')->nullable();
            $table->string('description_seo', 380)->nullable();
            $table->unique(['post_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
